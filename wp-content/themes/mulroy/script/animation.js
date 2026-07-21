gsap.registerPlugin(ScrollTrigger);

// Function to create animations for a section
function createSectionAnimation(section) {
  const elements = gsap.utils.toArray(".on-scroll-fade-in", section);

  // Skip if no elements found in this section
  if (elements.length === 0) return;

  // Set initial state for elements in this section
  elements.forEach((element) => {
    gsap.set(element, {
      opacity: 0,
      y: 10,
    });
  });

  // Create timeline for this section
  const tl = gsap.timeline({
    scrollTrigger: {
      trigger: section,
      start: "top center+=100",
      toggleActions: "play none none none",
      // markers: true, // Uncomment to debug
    },
  });

  // Add staggered animations
  tl.to(elements, {
    opacity: 1,
    y: 0,
    duration: 1,
    ease: "power1.out",
    stagger: 0.2,
  });
}

// Get all sections and create animations for each
const sections = gsap.utils.toArray("section"); // Or use your section class/selector
sections.forEach(createSectionAnimation);
