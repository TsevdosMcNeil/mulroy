class PageNavigation {
  constructor(options = {}) {
    this.backSelector = options.backSelector || ".js-go-back";
    this.storageKey = "site_scroll_positions_v1";
    this.entryKey = "__siteScrollEntry";
    this.positions = this.readPositions();
    this.currentId = null;
    this.restoring = false;
    this.initialized = false;
    this.scrollFrame = null;
    this.restoreToken = 0;
    this.enteredTarget = null;

    // Back-arrow trail: for each history entry, the on-site page
    // (URL + scroll) the visitor came from. Never uses history.back(),
    // so the arrow can't send anyone to another website.
    this.trailKey = "site_back_trail_v1";
    this.leftKey = "site_last_left_v1";
    this.pendingKey = "site_back_pending_v1";
    this.maxTrailDepth = 20;
    this.maxTrailEntries = 50;
    this.trail = this.readJSON(this.trailKey, {});
    this.lastLeft = null;

    // URLs Barba must not handle (keep in sync with barba.init prevent).
    this.fullReload = options.fullReload || (() => false);

    this.onPageReady = options.onPageReady || (() => {});

    this.handleClick = this.handleClick.bind(this);
    this.handleScroll = this.handleScroll.bind(this);
    this.handlePageHide = this.handlePageHide.bind(this);
  }

  readJSON(key, fallback) {
    try {
      const value = JSON.parse(sessionStorage.getItem(key));
      return value && typeof value === "object" ? value : fallback;
    } catch (error) {
      return fallback;
    }
  }

  writeJSON(key, value) {
    try {
      if (value === null) {
        sessionStorage.removeItem(key);
      } else {
        sessionStorage.setItem(key, JSON.stringify(value));
      }
    } catch (error) {
      console.warn("Session storage unavailable:", error);
    }
  }

  readPositions() {
    return this.readJSON(this.storageKey, {});
  }

  persistPositions() {
    try {
      sessionStorage.setItem(this.storageKey, JSON.stringify(this.positions));
    } catch (error) {
      console.warn("Scroll storage unavailable:", error);
    }
  }

  createId() {
    return "page_" + Date.now() + "_" + Math.random().toString(36).slice(2);
  }

  getEntryId() {
    const state = window.history.state;

    return state && typeof state === "object"
      ? state[this.entryKey] || null
      : null;
  }

  ensureEntryId() {
    let id = this.getEntryId();

    if (id) {
      this.currentId = id;
      return id;
    }

    id = this.createId();

    const state = window.history.state;
    const nextState = state && typeof state === "object" ? { ...state } : {};

    nextState[this.entryKey] = id;

    window.history.replaceState(nextState, "", window.location.href);

    this.currentId = id;
    return id;
  }

  // --- Back-arrow trail -------------------------------------------------

  // Same page = same URL, ignoring #hash and a trailing slash.
  cleanUrl(url) {
    try {
      const parsed = new URL(url, window.location.href);
      parsed.hash = "";
      if (parsed.pathname.length > 1) {
        parsed.pathname = parsed.pathname.replace(/\/+$/, "");
      }
      return parsed.href;
    } catch (error) {
      return "";
    }
  }

  isSameOrigin(url) {
    try {
      return new URL(url, window.location.href).origin === window.location.origin;
    } catch (error) {
      return false;
    }
  }

  // Copy a record, capping how far back the chain goes.
  trimRecord(record, depth = 0) {
    if (!record || !record.url || depth >= this.maxTrailDepth) return null;

    return {
      url: record.url,
      x: record.x || 0,
      y: record.y || 0,
      prev: this.trimRecord(record.prev, depth + 1),
    };
  }

  // Snapshot of the page being left: its URL, scroll, and its own back target.
  makeRecord(url) {
    return {
      url: this.cleanUrl(url),
      x: window.scrollX,
      y: window.scrollY,
      prev: this.trail[this.currentId] || null,
    };
  }

  setPrev(id, record) {
    if (!id) return;

    delete this.trail[id];
    const trimmed = this.trimRecord(record);
    if (trimmed) this.trail[id] = trimmed;

    const keys = Object.keys(this.trail);
    keys
      .slice(0, Math.max(0, keys.length - this.maxTrailEntries))
      .forEach((key) => delete this.trail[key]);

    this.writeJSON(this.trailKey, this.trail);
  }

  takePending() {
    const pending = this.readJSON(this.pendingKey, null);
    this.writeJSON(this.pendingKey, null);

    if (!pending || Date.now() - (pending.time || 0) > 30000) return null;
    return pending;
  }

  // Page left by a full page load. Matched by where Barba was heading
  // (Barba falls back to a full load on timeout, after it already changed
  // the URL) or by the referrer (links Barba skips, e.g. /studio).
  takeStoredLeft() {
    const stored = this.readJSON(this.leftKey, null);
    this.writeJSON(this.leftKey, null);

    if (!stored || !stored.url) return null;
    if (Date.now() - (stored.time || 0) > 600000) return null;

    const here = this.cleanUrl(window.location.href);
    if (stored.to && stored.to === here) return stored;

    if (!document.referrer) return null;
    if (this.cleanUrl(document.referrer) !== stored.url) return null;

    return stored;
  }

  // Applies per history entry: without it the browser scrolls the old page
  // on back/forward before the Barba transition has started.
  manualScrollRestoration() {
    if ("scrollRestoration" in window.history) {
      window.history.scrollRestoration = "manual";
    }

    // ScrollTrigger.refresh() puts back the value it remembers, so tell it too.
    if (window.ScrollTrigger) {
      ScrollTrigger.clearScrollMemory("manual");
    }
  }

  // barba.init() replaces history.state, dropping our entry id.
  reattachEntryId() {
    if (!this.currentId || this.getEntryId() === this.currentId) return;

    const state = window.history.state;
    const nextState = state && typeof state === "object" ? { ...state } : {};

    nextState[this.entryKey] = this.currentId;
    window.history.replaceState(nextState, "", window.location.href);
    this.manualScrollRestoration();
  }

  isHistoryLoad() {
    const entries = performance.getEntriesByType
      ? performance.getEntriesByType("navigation")
      : [];
    const type = entries[0] ? entries[0].type : "navigate";

    return type === "reload" || type === "back_forward";
  }

  // Decide where this entry's back arrow points. Returns a scroll target
  // when this page was reached by the back arrow.
  recordEntry(isHistory, leaving) {
    const here = this.cleanUrl(window.location.href);
    const pending = this.takePending();

    if (pending && pending.url === here) {
      this.setPrev(this.currentId, pending.prev);
      return { x: pending.x || 0, y: pending.y || 0 };
    }

    // Browser back/forward or reload: keep what this entry already had.
    if (isHistory) return null;

    if (leaving && leaving.url !== here && this.isSameOrigin(leaving.url)) {
      this.setPrev(this.currentId, leaving);
    }

    return null;
  }

  goTo(url, record) {
    const target = this.cleanUrl(url);

    if (target === this.cleanUrl(window.location.href)) {
      this.jumpTo({ x: record.x, y: record.y });
      return;
    }

    this.writeJSON(this.pendingKey, { ...record, url: target, time: Date.now() });

    if (window.barba && !this.fullReload(target)) {
      barba.go(target);
    } else {
      window.location.assign(target);
    }
  }

  // ---------------------------------------------------------------------

  saveScroll() {
    if (this.restoring || !this.currentId) {
      return;
    }

    this.positions[this.currentId] = {
      x: window.scrollX,
      y: window.scrollY,
    };

    this.persistPositions();
  }

  handleScroll() {
    if (this.restoring || this.scrollFrame !== null) {
      return;
    }

    this.scrollFrame = requestAnimationFrame(() => {
      this.scrollFrame = null;
      this.saveScroll();
    });
  }

  handlePageHide() {
    this.saveScroll();

    // Mid-Barba-transition the URL is already the next page, so prefer
    // the record captured in beforeLeave.
    const recent =
      this.lastLeft && Date.now() - (this.lastLeft.time || 0) < 15000;
    const record = recent
      ? this.lastLeft
      : this.makeRecord(window.location.href);

    this.writeJSON(this.leftKey, { ...record, time: Date.now() });
  }

  // Remember the page being left the moment an on-site link is clicked,
  // before Barba changes the URL (or falls back to a full page load).
  rememberLeaving(event) {
    const anchor = event.target.closest("a[href]");

    if (!anchor || anchor.closest(this.backSelector)) return;
    if (event.button !== 0 || event.metaKey || event.ctrlKey) return;
    if (event.shiftKey || event.altKey) return;
    if (anchor.target && anchor.target !== "_self") return;
    if (!this.isSameOrigin(anchor.href)) return;

    const to = this.cleanUrl(anchor.href);
    if (to === this.cleanUrl(window.location.href)) return;

    this.lastLeft = {
      ...this.makeRecord(window.location.href),
      to,
      time: Date.now(),
    };
  }

  handleClick(event) {
    const link = event.target.closest(this.backSelector);

    if (!link) {
      this.rememberLeaving(event);
      return;
    }

    if (
      event.defaultPrevented ||
      event.button !== 0 ||
      event.metaKey ||
      event.ctrlKey ||
      event.shiftKey ||
      event.altKey
    ) {
      return;
    }

    event.preventDefault();

    this.saveScroll();

    const prev = this.trail[this.currentId];

    if (prev && this.isSameOrigin(prev.url)) {
      // Return to the exact page and scroll position we came from.
      this.goTo(prev.url, prev);
      return;
    }

    // No on-site page to return to: use the link's back_url (or home).
    const href = link.getAttribute("href");
    const fallback =
      href && href !== "#" && this.isSameOrigin(link.href)
        ? link.href
        : window.location.origin + "/";

    this.goTo(fallback, { x: 0, y: 0, prev: null });
  }

  waitForLayout() {
    return new Promise((resolve) => {
      requestAnimationFrame(() => {
        requestAnimationFrame(resolve);
      });
    });
  }

  jumpTo(target) {
    const html = document.documentElement;
    const body = document.body;

    const oldHtmlBehavior = html.style.scrollBehavior;
    const oldBodyBehavior = body.style.scrollBehavior;

    html.style.setProperty("scroll-behavior", "auto", "important");
    body.style.setProperty("scroll-behavior", "auto", "important");

    window.scrollTo({
      left: target.x,
      top: target.y,
      behavior: "instant",
    });

    return () => {
      html.style.scrollBehavior = oldHtmlBehavior;
      body.style.scrollBehavior = oldBodyBehavior;
    };
  }

  // Images loading above the target can push content down; re-apply the
  // position once they finish, unless the visitor has started scrolling.
  async settleOnImages(target, root) {
    const pending = Array.from(root.querySelectorAll("img")).filter(
      (img) => !img.complete,
    );

    if (pending.length === 0) return;

    let interacted = false;
    const stop = () => {
      interacted = true;
    };
    const events = ["wheel", "touchstart", "keydown", "mousedown"];

    events.forEach((type) =>
      window.addEventListener(type, stop, { passive: true }),
    );

    await Promise.race([
      Promise.all(
        pending.map(
          (img) =>
            new Promise((resolve) => {
              img.addEventListener("load", resolve, { once: true });
              img.addEventListener("error", resolve, { once: true });
            }),
        ),
      ),
      new Promise((resolve) => setTimeout(resolve, 2000)),
    ]);

    events.forEach((type) => window.removeEventListener(type, stop));

    if (!interacted && Math.abs(window.scrollY - target.y) > 1) {
      const resetBehavior = this.jumpTo(target);
      await this.waitForLayout();
      resetBehavior();
    }
  }

  isHistoryTrigger(data) {
    return (
      data.trigger === "back" ||
      data.trigger === "forward" ||
      data.trigger === "popstate"
    );
  }

  // Where an incoming Barba page will land: its saved position on browser
  // back/forward, the #hash element on a link, otherwise the top.
  entryTarget(data) {
    const top = { x: 0, y: 0 };

    if (this.isHistoryTrigger(data)) {
      return this.positions[this.getEntryId()] || top;
    }

    // Read from the clicked link: Barba drops the hash from the URL when the
    // request redirects (/studio to /studio/).
    const hash = (data.trigger.hash || "").slice(1);
    const el = hash && data.next.container.querySelector("#" + CSS.escape(hash));

    if (!el) return top;

    return {
      x: 0,
      y:
        el.getBoundingClientRect().top -
        data.next.container.getBoundingClientRect().top,
    };
  }

  // For transitions that place the page themselves; pageEntered keeps this spot.
  jumpToEntry(data) {
    this.enteredTarget = this.entryTarget(data);
    this.jumpTo(this.enteredTarget)();
  }

  async restoreScroll(shouldRestore, explicitTarget = null, root = null) {
    const token = ++this.restoreToken;
    this.restoring = true;

    const id = this.currentId;
    const saved = shouldRestore ? this.positions[id] : null;

    const target = explicitTarget || saved || { x: 0, y: 0 };

    await this.waitForLayout();

    if (token !== this.restoreToken) return;

    const resetBehavior = this.jumpTo(target);

    await this.waitForLayout();

    if (token !== this.restoreToken) return;

    resetBehavior();

    this.restoring = false;
    this.saveScroll();

    if (explicitTarget && root) {
      await this.settleOnImages(target, root);
    }
  }

  async pageEntered(data) {
    this.ensureEntryId();
    this.manualScrollRestoration();

    const isHistoryNavigation = this.isHistoryTrigger(data);

    const backTarget =
      this.recordEntry(isHistoryNavigation, this.lastLeft) || this.enteredTarget;
    this.lastLeft = null;
    this.enteredTarget = null;

    try {
      await Promise.resolve(this.onPageReady(data.next.container, data));
    } catch (error) {
      console.error("Page initialization failed:", error);
    }

    if (backTarget) {
      await this.restoreScroll(true, backTarget, data.next.container);
    } else {
      await this.restoreScroll(isHistoryNavigation);
    }
  }

  registerBarbaHooks() {
    if (!window.barba) {
      console.warn("Barba.js not found.");
      return;
    }

    // Save the outgoing page position before its DOM is removed.
    barba.hooks.beforeLeave((data) => {
      this.saveScroll();

      const leavingUrl =
        (data && data.current && data.current.url && data.current.url.href) ||
        window.location.href;
      const nextUrl = data && data.next && data.next.url && data.next.url.href;

      this.lastLeft = {
        ...this.makeRecord(leavingUrl),
        to: nextUrl ? this.cleanUrl(nextUrl) : null,
        time: Date.now(),
      };
    });

    // Run after the transition and initialize the new page.
    barba.hooks.after(async (data) => {
      await this.pageEntered(data);
    });
  }

  init() {
    if (this.initialized) return this;

    this.initialized = true;

    this.manualScrollRestoration();

    this.ensureEntryId();

    const backTarget = this.recordEntry(
      this.isHistoryLoad(),
      this.takeStoredLeft(),
    );

    document.addEventListener("click", this.handleClick);

    window.addEventListener("scroll", this.handleScroll, { passive: true });

    window.addEventListener("pagehide", this.handlePageHide);

    this.registerBarbaHooks();

    // Runs once this script finishes, i.e. right after barba.init().
    queueMicrotask(() => this.reattachEntryId());

    if (backTarget) {
      this.restoreScroll(true, backTarget, document);
    }

    return this;
  }

  destroy() {
    document.removeEventListener("click", this.handleClick);

    window.removeEventListener("scroll", this.handleScroll);

    window.removeEventListener("pagehide", this.handlePageHide);

    if (this.scrollFrame !== null) {
      cancelAnimationFrame(this.scrollFrame);
    }

    this.initialized = false;

    // Barba hooks remain registered. Do not call init()
    // again on this instance after destroy().
  }
}
