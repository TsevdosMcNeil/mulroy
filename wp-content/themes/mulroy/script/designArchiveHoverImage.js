(() => {
  "use strict";

  const SELECTORS = {
    table: "#designTable",
    row: "tr.data-row",
    container: ".design__archive__hover__image__container",
  };

  const PRELOAD_ALL = true;

  class DesignArchiveHover {
    constructor() {
      this.table = null;
      this.image = null;
      this.activeRow = null;
      this.preloaded = new Set();
      this.hasPreloaded = false;

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
    }

    destroy() {
      if (this.table) {
        this.table.removeEventListener("pointerover", this.onPointerOver);
      }
      if (this.image) {
        this.image.removeEventListener("error", this.onImageError);
      }
      this.table = null;
      this.image = null;
      this.activeRow = null;
      this.hasPreloaded = false;
      this.preloaded.clear();
    }

    onPointerOver(event) {
      if (event.pointerType !== "mouse") return;

      const row = event.target.closest(SELECTORS.row);
      if (!row || row === this.activeRow || !this.table.contains(row)) return;

      this.activeRow = row;
      this.swap(row);

      if (PRELOAD_ALL && !this.hasPreloaded) {
        this.hasPreloaded = true;
        this.preloadAll();
      }
    }

    swap(row) {
      const url = this.sanitize(row.dataset.image);

      if (!url) {
        this.clear();
        return;
      }

      const label = row.querySelector("td")?.textContent.trim() ?? "";

      this.image.removeAttribute("srcset");
      this.image.removeAttribute("sizes");
      this.image.loading = "eager";
      this.image.alt = label;
      this.image.src = url;
      this.image.style.visibility = "";
    }

    clear() {
      this.image.removeAttribute("srcset");
      this.image.removeAttribute("sizes");
      this.image.removeAttribute("src");
      this.image.alt = "";
      this.image.style.visibility = "hidden";
    }

    onImageError() {
      this.clear();
    }

    preloadAll() {
      const rows = this.table.querySelectorAll(SELECTORS.row);
      const run = () => {
        rows.forEach((row) => {
          const url = this.sanitize(row.dataset.image);
          if (!url || this.preloaded.has(url)) return;
          this.preloaded.add(url);
          new Image().src = url;
        });
      };

      if ("requestIdleCallback" in window) {
        window.requestIdleCallback(run, { timeout: 2000 });
      } else {
        window.setTimeout(run, 200);
      }
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
