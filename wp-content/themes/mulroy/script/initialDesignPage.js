export function initializeSlider() {
  const designHeroContent = document.querySelector(".design-hero-content");
  const prevBtn = document.querySelector(".prev");
  const nextBtn = document.querySelector(".next");
  const slideTitle = document.querySelector(".slide-title");
  const slides = document.querySelectorAll(".slide");
  const totalSlides = slides.length;

  if (totalSlides === 0) return;

  // Initially set opacity to 0 (arrows + title only, dots will be handled later)
  gsap.set([prevBtn, nextBtn, slideTitle], {
    ease: "power1.in",
    duration: 0.5,
    opacity: 0,
  });

  // --- DOTS ---
  // Remove existing dots if they already exist
  const existingDots = document.querySelector(".slider-dots");
  if (existingDots) existingDots.remove();

  const dotsContainer = document.createElement("div");
  dotsContainer.classList.add("slider-dots");
  gsap.set(dotsContainer, { opacity: 0 }); // make sure dots are hidden initially

  slides.forEach((_, index) => {
    const dot = document.createElement("span");
    dot.classList.add("dot");
    if (index === 0) dot.classList.add("active");
    dot.addEventListener("click", () => goToSlide(index));
    dotsContainer.appendChild(dot);
  });
  document.querySelector(".carousel-wrapper")?.appendChild(dotsContainer);
  const dots = dotsContainer.querySelectorAll(".dot");

  // Fade out designHeroContent, then fade in arrows, title, and dots
  gsap.to(designHeroContent, {
    ease: "power1.in",
    duration: 0.5,
    opacity: 0,
    delay: 2,
    onComplete: () => {
      designHeroContent.style.visibility = "hidden";
	  gsap.to(dotsContainer,{
		  ease: "power1.out",
        duration: 0.5,
        opacity: 1,
        delay: 1,
	  })
      gsap.to([prevBtn, nextBtn, slideTitle], {
        ease: "power1.out",
        duration: 0.5,
        opacity: 1,
        delay: 0.5,
      });
    },
  });

  let currentSlide = 0;
  slides[0].classList.add("active");

  function updateDots(index) {
    dots.forEach((dot, i) => {
      dot.classList.toggle("active", i === index);
    });
  }

  function goToSlide(nextSlide) {
    slides[nextSlide].classList.add("next");
    setTimeout(() => {
      slides[currentSlide].classList.remove("active");
      slides[nextSlide].classList.remove("next");
      slides[nextSlide].classList.add("active");

      currentSlide = nextSlide;
      updateDots(currentSlide);
    }, 50);
  }

  function nextSlide() {
    const next = (currentSlide + 1) % totalSlides;
    goToSlide(next);
  }

  function prevSlide() {
    const prev = (currentSlide - 1 + totalSlides) % totalSlides;
    goToSlide(prev);
  }

  // --- Arrows ---
  if (nextBtn) nextBtn.addEventListener("click", nextSlide);
  if (prevBtn) prevBtn.addEventListener("click", prevSlide);

  // --- Keyboard ---
  document.addEventListener("keydown", (e) => {
    if (e.key === "ArrowRight") nextSlide();
    if (e.key === "ArrowLeft") prevSlide();
  });

  // --- Swipe for Mobile ---
  let touchStartX = 0;
  let touchEndX = 0;

  document.addEventListener("touchstart", (e) => {
    touchStartX = e.changedTouches[0].screenX;
  });

  document.addEventListener("touchend", (e) => {
    touchEndX = e.changedTouches[0].screenX;
    handleSwipe();
  });

  function handleSwipe() {
    const swipeThreshold = 50; // min px to count as swipe
    const deltaX = touchEndX - touchStartX;

    if (Math.abs(deltaX) > swipeThreshold) {
      if (deltaX < 0) {
        nextSlide(); // swipe left
      } else {
        prevSlide(); // swipe right
      }
    }
  }
}


// Initialize on first load
document.addEventListener("DOMContentLoaded", initializeSlider);

// Initialize after Barba page transitions
barba.hooks.before(() => {
  initializeSlider();
});

// Optional: Clean up GSAP animations before leaving the page
barba.hooks.before(() => {
  gsap.killTweensOf(".hero-content");
  gsap.killTweensOf(".slide");
});
