// gsap.registerPlugin(ScrollTrigger, ScrollToPlugin);

// // Helper functions
// export function goToSection(panel, index) {
//   gsap.to(window, {
//     scrollTo: { y: panel, autoKill: false },
//     duration: 1,
//     ease: "power2.out",
//   });
// }

// export function snapIn(panels) {
//   const tlSnapIn = gsap.timeline();
//   panels.forEach((panel, i) => {
//     tlSnapIn.to(panel, {
//       duration: 1,
//       scrollTrigger: {
//         trigger: panel,
//         onEnter: () => goToSection(panel),
//         onEnterBack: () => goToSection(panel),
//       },
//     });
//   });
//   return tlSnapIn;
// }

// // Main initialization function
// export function initializeScroll() {
//   // Clean up any existing ScrollTriggers first
//   ScrollTrigger.getAll().forEach((st) => st.kill());

//   const panels = gsap.utils.toArray(".scroll-section");
//   let snapping = false; // Flag to prevent scroll during animation

//   panels.forEach((panel, i) => {
//     ScrollTrigger.create({
//       trigger: panel,
//       start: "top center", // More precise trigger point
//       end: "bottom center",
//       onEnter: () => {
//         if (!snapping) {
//           snapping = true;
//           gsap.to(window, {
//             scrollTo: { y: panel, autoKill: false },
//             duration: 0.8,
//             ease: "power2.out",
//             onComplete: () => (snapping = false),
//           });
//         }
//       },
//       onEnterBack: () => {
//         if (!snapping) {
//           snapping = true;
//           gsap.to(window, {
//             scrollTo: { y: panel, autoKill: false },
//             duration: 0.8,
//             ease: "power2.out",
//             onComplete: () => (snapping = false),
//           });
//         }
//       },
//     });
//   });

//   // Prevent default scroll behavior during snapping
//   document.addEventListener(
//     "wheel",
//     (e) => {
//       if (snapping) {
//         e.preventDefault();
//       }
//     },
//     { passive: false }
//   );

//   return () => {
//     // Cleanup function
//     ScrollTrigger.getAll().forEach((st) => st.kill());
//   };
// }

// // Clean up function
// export function cleanupScroll() {
//   ScrollTrigger.getAll().forEach((st) => st.kill());
// }
