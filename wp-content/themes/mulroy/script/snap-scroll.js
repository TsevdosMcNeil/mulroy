// class ScrollController {
//   constructor(options = {}) {
//     this.options = {
//       sectionClass: ".scroll-section",
//       duration: 0.8,
//       ease: "power2.out",
//       touchThreshold: 50,
//       scrollCooldown: 1000,
//       ...options,
//     };

//     this.state = {
//       currentSection: 0,
//       isAnimating: false,
//       touchStart: null,
//       touchMove: null,
//       isCoolingDown: false,
//     };

//     this.init();
//   }

//   init() {
//     // Check for reduced motion preference
//     this.prefersReducedMotion = window.matchMedia(
//       "(prefers-reduced-motion: reduce)"
//     ).matches;
//     // Add this
//     this.scrollContainer = document.querySelector(".scroll-container");
//     this.containerBounds = null;
//     this.updateContainerBounds(); // New method we'll add
//     // Get panels
//     this.panels = gsap.utils.toArray(this.options.sectionClass);

//     // Setup event listeners
//     this.setupEventListeners();

//     // Handle initial hash
//     this.handleDeepLink();

//     // Setup ResizeObserver
//     this.setupResizeObserver();
//   }
//   updateContainerBounds() {
//     if (this.scrollContainer) {
//       const bounds = this.scrollContainer.getBoundingClientRect();
//       const scrollTop =
//         window.pageYOffset || document.documentElement.scrollTop;

//       this.containerBounds = {
//         top: bounds.top + scrollTop,
//         bottom: bounds.bottom + scrollTop,
//         height: bounds.height,
//       };
//     }
//   }
//   setupEventListeners() {
//     // Wheel events
//     document.addEventListener("wheel", this.handleWheel.bind(this), {
//       passive: false,
//     });

//     // Touch events
//     document.addEventListener("touchstart", this.handleTouchStart.bind(this), {
//       passive: false,
//     });
//     document.addEventListener("touchmove", this.handleTouchMove.bind(this), {
//       passive: false,
//     });
//     document.addEventListener("touchend", this.handleTouchEnd.bind(this), {
//       passive: false,
//     });

//     // Keyboard navigation
//     document.addEventListener("keydown", this.handleKeydown.bind(this));

//     // History changes
//     window.addEventListener("popstate", this.handlePopState.bind(this));
//   }

//   handleWheel(e) {
//     if (this.prefersReducedMotion) return;
//     this.updateContainerBounds(); // Update bounds on each wheel event
//     const currentScroll = window.pageYOffset;
//     const containerEndPosition =
//       this.containerBounds.bottom - window.innerHeight;

//     // If we're beyond container, allow normal scroll
//     if (currentScroll >= containerEndPosition) {
//       return;
//     }
//     e.preventDefault();

//     if (this.state.isAnimating || this.state.isCoolingDown) {
//       return;
//     }

//     const direction = Math.sign(e.deltaY);
//     this.scrollToSection(this.state.currentSection + direction);
//   }

//   handleTouchStart(e) {
//     if (this.state.isAnimating || this.state.isCoolingDown) return; // Add this check
//     this.state.touchStart = e.touches[0].clientY;
//     this.state.touchMove = null;
//   }
//   handleTouchMove(e) {
//     // Get current scroll position
//     const currentScroll = window.pageYOffset;
//     const containerEndPosition =
//       this.containerBounds.bottom - window.innerHeight;
//     // If we're beyond container, allow normal scroll
//     if (currentScroll >= containerEndPosition) {
//       return;
//     }

//     if (this.state.isAnimating || this.state.isCoolingDown) {
//       // Updated condition
//       e.preventDefault();
//       return;
//     }

//     this.state.touchMove = e.touches[0].clientY;
//     const diff = this.state.touchStart - this.state.touchMove;

//     if (Math.abs(diff) > this.options.touchThreshold) {
//       e.preventDefault();
//     }
//   }

//   handleTouchEnd(e) {
//     if (this.state.isAnimating || this.state.isCoolingDown) return;
//     if (this.state.touchStart === null || this.state.touchMove === null) return;

//     const diff = this.state.touchStart - this.state.touchMove;
//     if (Math.abs(diff) > this.options.touchThreshold) {
//       const direction = Math.sign(diff);
//       this.scrollToSection(this.state.currentSection + direction);
//     }
//   }

//   handleKeydown(e) {
//     if (this.state.isAnimating || this.state.isCoolingDown) return;

//     switch (e.key) {
//       case "ArrowDown":
//       case "PageDown":
//         e.preventDefault();
//         this.scrollToSection(this.state.currentSection + 1);
//         break;
//       case "ArrowUp":
//       case "PageUp":
//         e.preventDefault();
//         this.scrollToSection(this.state.currentSection - 1);
//         break;
//     }
//   }

//   scrollToSection(index) {
//     if (this.state.isAnimating || this.state.isCoolingDown) return;

//     const targetIndex = Math.max(0, Math.min(index, this.panels.length - 1));
//     if (targetIndex === this.state.currentSection) return;

//     this.state.isAnimating = true;
//     this.state.isCoolingDown = true;

//     this.state.currentSection = targetIndex;

//     const targetPanel = this.panels[targetIndex];
//     const id = targetPanel.id;
//     if (id) {
//       history.pushState(null, null, `#${id}`);
//     }

//     const duration = this.prefersReducedMotion ? 0 : this.options.duration;

//     gsap.to(window, {
//       scrollTo: { y: targetPanel, autoKill: false },
//       duration,
//       ease: this.options.ease,
//       onComplete: () => {
//         // Changed this part - both states are cleared together after cooldown
//         setTimeout(() => {
//           this.state.isAnimating = false;
//           this.state.isCoolingDown = false;
//         }, this.options.scrollCooldown);
//       },
//     });
//   }

//   handleDeepLink() {
//     const hash = window.location.hash;
//     if (hash) {
//       const targetPanel = document.querySelector(hash);
//       if (targetPanel) {
//         const index = this.panels.indexOf(targetPanel);
//         if (index !== -1) {
//           this.scrollToSection(index);
//         }
//       }
//     }
//   }

//   setupResizeObserver() {
//     const observer = new ResizeObserver((entries) => {
//       // Recalculate positions after resize
//       ScrollTrigger.refresh();
//       this.updateContainerBounds(); // Add this
//       // Update current section position
//       this.scrollToSection(this.state.currentSection);
//     });

//     this.panels.forEach((panel) => observer.observe(panel));
//     observer.observe(this.scrollContainer); // Add this
//   }

//   destroy() {
//     // Remove all event listeners
//     document.removeEventListener("wheel", this.handleWheel);
//     document.removeEventListener("touchstart", this.handleTouchStart);
//     document.removeEventListener("touchmove", this.handleTouchMove);
//     document.removeEventListener("touchend", this.handleTouchEnd);
//     document.removeEventListener("keydown", this.handleKeydown);
//     window.removeEventListener("popstate", this.handlePopState);

//     // Kill all GSAP animations
//     ScrollTrigger.getAll().forEach((st) => st.kill());
//   }
// }
// // Initialize
// const scrollController = new ScrollController({
//   sectionClass: ".scroll-section",
//   duration: 0.8,
//   touchThreshold: 50,
//   scrollCooldown: 500,
// });

// // Cleanup when needed
// scrollController.destroy();
