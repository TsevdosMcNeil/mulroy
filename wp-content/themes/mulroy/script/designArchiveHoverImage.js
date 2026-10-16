(() => {
  "use strict";

  const SELECTORS = {
    table: "#designTable",
    row: "tr.data-row",
    container: ".design__archive__hover__image__container",
  };

  const PRELOAD_ALL = true;
  const PRELOAD_CONCURRENCY = 4;

  class DesignArchiveHover {
    constructor() {
      this.table = null;
      this.image = null;
      this.activeRow = null;
      this.currentUrl = null;

      this.preloaded = new Set();
      this.failed = new Set();
      this.queue = [];
      this.inflight = new Set();
      this.generation = 0;
      this.idleId = null;
      this.timerId = null;
      this.loadHandler = null;

      this.onPointerOver = this.onPointerOver.bind(this);
      this.onImageError = this.onImageError.bind(this);
    }

    init(root = document) {
      this.destroy();

      const table = root.querySelector(SELECTORS.table);
      const container = root.querySelector(SELECTORS.container);
      if (!table || !container) return;

      let image = container.querySelector("img");
      if (!image) {
        image = document.createElement("img");
        image.alt = "";
        container.appendChild(image);
      }

      this.table = table;
      this.image = image;

      this.table.addEventListener("pointerover", this.onPointerOver);
      this.image.addEventListener("error", this.onImageError);

      if (PRELOAD_ALL) this.schedulePreload();
    }

    destroy() {
      if (this.table) {
        this.table.removeEventListener("pointerover", this.onPointerOver);
      }
      if (this.image) {
        this.image.removeEventListener("error", this.onImageError);
      }

      this.generation++;
      if (this.loadHandler) {
        window.removeEventListener("load", this.loadHandler);
        this.loadHandler = null;
      }
      if (this.idleId !== null && "cancelIdleCallback" in window) {
        window.cancelIdleCallback(this.idleId);
      }
      if (this.timerId !== null) window.clearTimeout(this.timerId);
      this.idleId = null;
      this.timerId = null;

      this.inflight.forEach((img) => {
        img.onload = null;
        img.onerror = null;
        img.removeAttribute("src");
      });
      this.inflight.clear();

      this.table = null;
      this.image = null;
      this.activeRow = null;
      this.currentUrl = null;
      this.queue = [];
      this.preloaded.clear();
      this.failed.clear();
    }

    onPointerOver(event) {
      if (event.pointerType !== "mouse") return;

      const row = event.target.closest(SELECTORS.row);
      if (!row || row === this.activeRow || !this.table.contains(row)) return;

      this.activeRow = row;
      this.swap(row);
    }

    swap(row) {
      const url = this.sanitize(row.dataset.image);

      if (!url || this.failed.has(url)) {
        this.clear();
        return;
      }

      this.preloaded.add(url);
      this.currentUrl = url;

      const label = row.querySelector("td")?.textContent.trim() ?? "";

      this.image.removeAttribute("srcset");
      this.image.removeAttribute("sizes");
      this.image.loading = "eager";
      this.image.fetchPriority = "high";
      this.image.alt = label;
      this.image.src = url;
      this.image.style.visibility = "";
    }

    clear() {
      this.currentUrl = null;
      this.image.removeAttribute("srcset");
      this.image.removeAttribute("sizes");
      this.image.removeAttribute("src");
      this.image.alt = "";
      this.image.style.visibility = "hidden";
    }

    onImageError() {
      if (this.currentUrl) this.failed.add(this.currentUrl);
      this.clear();
    }

    schedulePreload() {
      const generation = this.generation;

      const start = () => {
        this.idleId = null;
        this.timerId = null;
        if (generation !== this.generation) return;
        this.startPreload();
      };

      const run = () => {
        this.loadHandler = null;
        if (generation !== this.generation) return;
        if ("requestIdleCallback" in window) {
          this.idleId = window.requestIdleCallback(start, { timeout: 1500 });
        } else {
          this.timerId = window.setTimeout(start, 200);
        }
      };

      if (document.readyState === "complete") {
        run();
      } else {
        this.loadHandler = run;
        window.addEventListener("load", run, { once: true });
      }
    }

    startPreload() {
      const queued = new Set();
      this.table.querySelectorAll(SELECTORS.row).forEach((row) => {
        const url = this.sanitize(row.dataset.image);
        if (url && !queued.has(url)) {
          queued.add(url);
          this.queue.push(url);
        }
      });
      this.pump();
    }

    pump() {
      while (this.inflight.size < PRELOAD_CONCURRENCY && this.queue.length) {
        const url = this.queue.shift();
        if (this.preloaded.has(url) || this.failed.has(url)) continue;
        this.load(url);
      }
    }

    load(url) {
      const generation = this.generation;
      const img = new Image();

      this.preloaded.add(url);
      this.inflight.add(img);

      const done = (ok) => {
        img.onload = null;
        img.onerror = null;
        if (generation !== this.generation) return;
        this.inflight.delete(img);
        if (!ok) this.failed.add(url);
        this.pump();
      };

      img.decoding = "async";
      img.onload = () => done(true);
      img.onerror = () => done(false);
      img.src = url;
    }

    sanitize(raw) {
      if (!raw || !raw.trim()) return null;
      try {
        const parsed = new URL(raw.trim(), window.location.href);
        return parsed.protocol === "http:" || parsed.protocol === "https:"
          ? parsed.href
          : null;
      } catch {
        return null;
      }
    }
  }

  const archiveHover = new DesignArchiveHover();

  if (window.barba && window.barba.hooks) {
    window.barba.hooks.beforeLeave(() => archiveHover.destroy());
    window.barba.hooks.afterEnter((data) => {
      archiveHover.init(data?.next?.container ?? document);
    });
  }

  if (document.readyState === "loading") {
    document.addEventListener(
      "DOMContentLoaded",
      () => archiveHover.init(document),
      { once: true },
    );
  } else {
    archiveHover.init(document);
  }
})();
