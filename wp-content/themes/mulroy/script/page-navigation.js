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

    this.onPageReady = options.onPageReady || (() => {});

    this.handleClick = this.handleClick.bind(this);
    this.handleScroll = this.handleScroll.bind(this);
    this.handlePageHide = this.handlePageHide.bind(this);
  }

  readPositions() {
    try {
      return JSON.parse(sessionStorage.getItem(this.storageKey) || "{}");
    } catch (error) {
      return {};
    }
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
  }

  handleClick(event) {
    const link = event.target.closest(this.backSelector);

    if (!link) return;

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

    const fallback = link.href;

    // The first entry in a tab may have no page to return to.
    if (window.history.length > 1) {
      window.history.back();
    } else if (fallback) {
      window.location.assign(fallback);
    }
  }

  waitForLayout() {
    return new Promise((resolve) => {
      requestAnimationFrame(() => {
        requestAnimationFrame(resolve);
      });
    });
  }

  async restoreScroll(shouldRestore) {
    const token = ++this.restoreToken;
    this.restoring = true;

    const id = this.currentId;
    const saved = shouldRestore ? this.positions[id] : null;

    const target = saved || { x: 0, y: 0 };

    await this.waitForLayout();

    if (token !== this.restoreToken) return;

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

    await this.waitForLayout();

    if (token !== this.restoreToken) return;

    html.style.scrollBehavior = oldHtmlBehavior;
    body.style.scrollBehavior = oldBodyBehavior;

    this.restoring = false;
    this.saveScroll();
  }

  async pageEntered(data) {
    this.ensureEntryId();

    const isHistoryNavigation =
      data.trigger === "back" || data.trigger === "forward";

    try {
      await Promise.resolve(this.onPageReady(data.next.container, data));
    } catch (error) {
      console.error("Page initialization failed:", error);
    }

    await this.restoreScroll(isHistoryNavigation);
  }

  registerBarbaHooks() {
    if (!window.barba) {
      console.warn("Barba.js not found.");
      return;
    }

    // Save the outgoing page position before its DOM is removed.
    barba.hooks.beforeLeave(() => {
      this.saveScroll();
    });

    // Run after the transition and initialize the new page.
    barba.hooks.after(async (data) => {
      await this.pageEntered(data);
    });
  }

  init() {
    if (this.initialized) return this;

    this.initialized = true;

    if ("scrollRestoration" in window.history) {
      window.history.scrollRestoration = "manual";
    }

    this.ensureEntryId();

    document.addEventListener("click", this.handleClick);

    window.addEventListener("scroll", this.handleScroll, { passive: true });

    window.addEventListener("pagehide", this.handlePageHide);

    this.registerBarbaHooks();

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
