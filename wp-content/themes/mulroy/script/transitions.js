let initializeSlider;
// Add a flag to track when transition is happening
// let isTransitioning = false;
function hoverOverPost() {
  const newsItems = document.querySelectorAll(".home-news-post-item");
  const hoverImageSection = document.querySelector(".hover-image-section");
  const newsPostImage = document.querySelector(".news-post-image");
  // Function to show the image
  function showImage(imageUrl) {
    hoverImageSection.classList.add("visible");
    newsPostImage.style.backgroundImage = `url('${imageUrl}')`;
  }
  // Function to hide the image
  function hideImage() {
    hoverImageSection.classList.remove("visible");
  }
  // Add hover listeners to each news item
  newsItems.forEach((item) => {
    const imageUrl = item.dataset.image;
    item.addEventListener("mouseenter", () => {
      if (imageUrl) {
        showImage(imageUrl);
      }
    });
    item.addEventListener("mouseleave", () => {
      hideImage();
    });
  });
}
async function loadDesignPageModule() {
  try {
    const module = await import("./initialDesignPage.js");
    initializeSlider = module.initializeSlider;
  } catch (error) {
    console.log("Design page module not needed for this page");
  }
}


function initHubspotForm() {
  const container = document.querySelector("#hubspot-form-container");
  if (!container) return;

  // Clear the container in case Barba cached it
  container.innerHTML = "";

  // Ensure the HubSpot script is already loaded
  if (window.hbspt && window.hbspt.forms) {
    hbspt.forms.create({
      portalId: "6491656",
      formId: "32c0eab7-ab42-488e-b931-35b71d970c73",
      region: "na1",
      target: "#hubspot-form-container"
    });
  } else {
    // If script not yet loaded, wait for it to load
    const script = document.createElement("script");
    script.src = "//js.hsforms.net/forms/embed/v2.js";
    script.onload = initHubspotForm;
    document.body.appendChild(script);
  }
}



function customCursor(){
  const cursor = document.getElementById("custom-cursor");
  const header = document.querySelector(".hero-section-height");
  
	
	if(!cursor || !header) return;

  // Show cursor only inside header
  header.addEventListener("mouseenter", () => {
    cursor.style.display = "block";
	  cursor.style.opacity = 1;
  });
  header.addEventListener("mouseleave", () => {
	  cursor.style.opacity = 0;
    cursor.style.display = "none";
  });

  // Move custom cursor
  header.addEventListener("mousemove", (e) => {
	  cursor.style.opacity = 1;
    cursor.style.transform = `translate(${e.clientX}px, ${e.clientY}px) rotate(90deg)`;
  });

  // Click to scroll to first section
  header.addEventListener("click", () => {
  const headerHeight = header.offsetHeight;

  window.scrollBy({
    top: headerHeight, // scroll exactly by header height
    behavior: "smooth"
  });
});
}


customCursor(); 
// barba.hooks.afterEnter(() => {
//   customCursor(); 
// });


function designCustomCursor() {
  const cursor = document.querySelector(".design__cursor");
  const header = document.querySelector(".design__header");
  const slides = document.querySelectorAll(".slide");
	const slideTitle = document.querySelectorAll(".slide-title");
	
	slideTitle.forEach((el)=>{
		el.addEventListener("mouseenter", () => {
    		cursor.style.display = "none";
  		});
		
		el.addEventListener("mouseleave", () => {
    		cursor.style.display = "block";
  		});
	})

  if (!cursor || !header || slides.length === 0) return;

  let currentSlide = 0;
  const totalSlides = slides.length;

  // activate first slide
  slides[0].classList.add("active");

  function goToSlide(nextSlide) {
    slides[nextSlide].classList.add("next");
    setTimeout(() => {
      slides[currentSlide].classList.remove("active");
      slides[nextSlide].classList.remove("next");
      slides[nextSlide].classList.add("active");
      currentSlide = nextSlide;
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
	
	

  // Show/hide cursor
  header.addEventListener("mouseenter", () => {
    cursor.style.display = "block";
  });
  header.addEventListener("mouseleave", () => {
    cursor.style.display = "none";
  });
	
	

  // Move cursor + rotate
  header.addEventListener("mousemove", (e) => {
    const rect = header.getBoundingClientRect();
    const width = rect.width;
    const x = e.clientX - rect.left;

    let rotation = "rotate(90deg)"; // default down
    let zone = "down";

    if (x < width * 0.33) {
      rotation = "rotate(180deg)"; // left
      zone = "left";
    } else if (x > width * 0.66) {
      rotation = "rotate(360deg)"; // right
      zone = "right";
    }

    cursor.dataset.zone = zone;
    cursor.style.transform = `translate(${e.clientX}px, ${e.clientY}px) ${rotation}`;
  });

  // Click actions
  header.addEventListener("click", () => {
    const zone = cursor.dataset.zone;

    if (zone === "left") {
      prevSlide();
    } else if (zone === "right") {
      nextSlide();
    } else if (zone === "down") {
      const headerHeight = header.offsetHeight;
      window.scrollBy({
        top: headerHeight,
        behavior: "smooth",
      });
    }
  });

  // keyboard navigation too
  document.addEventListener("keydown", (e) => {
    if (e.key === "ArrowRight") nextSlide();
    if (e.key === "ArrowLeft") prevSlide();
  });
}



const views = [
		{
		  namespace: "contact",
		  afterEnter:()=>{
			  console.log("CONTact working");
			  initHubspotForm()
			  			  console.log("CONTact working after function");
		  },
    beforeEnter: () => {
      const footer = document.querySelector('footer');
		const menu = document.querySelector('.burger-menu')
		console.log(menu)
		if(menu){
			menu.classList.add('contact-menu-btn')
		}
          if (footer) {
            footer.classList.add('footer-hidden');
          }
    },
	  beforeLeave:() => {
		  const menu = document.querySelector('.burger-menu')
		  
		if(menu){
			menu.classList.remove('contact-menu-btn')
		}
		  const footer = document.querySelector('footer');
          if (footer) {
            footer.classList.remove('footer-hidden');
          }
	  }
  },
  {
    namespace: "person",
    beforeEnter: () => {
      const footer = document.querySelector('footer');
          if (footer) {
            footer.classList.add('footer-hidden');
          }
    },
	  beforeLeave:() => {
		  const footer = document.querySelector('footer');
          if (footer) {
            footer.classList.remove('footer-hidden');
          }
	  }
  },
  {
    namespace: "design",
    beforeEnter: async () => {
	
		
      await loadDesignPageModule();
      if (initializeSlider) {
        initializeSlider();
		  designCustomCursor();
      }

    },
  },
  {
    namespace: "default",
    beforeEnter: () => {
      hoverOverPost(); 
      window.scrollTo({ top: 0, behavior: "instant" });
    },
  },
];

const transitions = {
  general: {
    name: "general-transition",
    beforeEnter() {
      const nav = document.querySelector("nav");
      nav.classList.remove("open", "active", "visible");
      const burgerButton = document.querySelector(".burger-menu");
      burgerButton?.classList.remove("active");
      // Clean up any existing ScrollTriggers
      // Force scroll to top
      window.scrollTo({ top: 0, behavior: "instant" });
    },
    leave({ current }) {
      return gsap.to(".header", {
        autoAlpha: 0,
        yPercent: -5,
        duration: 0.3,
        ease: "power2.out",
      });
    },
    after() {
		customCursor(); 
    },
    enter({ next }) {
		customCursor(); 
	  const overlay = document.querySelector(".transition-overlay");
	  overlay.style.opacity = 0;
      window.scrollTo({ top: 0 });
      // Set initial states
      gsap.set(".header", {
        autoAlpha: 0,
        yPercent: 0,
      });

      gsap.set(next.container, {
        autoAlpha: 1,
        y: "100vh",
        position: "fixed",
        top: 0,
        zIndex: 99,
        width: "100%",
      });
      return gsap
        .timeline()
// 		.to(overlay,{
// // 		 	opacity:1,
// // 		  	duration:0.02,
// 	  	})
//         .to(next.container, {
// //           duration: 0.35,
// //           autoAlpha: 1,
// //           y: "-5vh",
// //           ease: "power1.out",
//         })
// 		.to(overlay,{
// // 		  opacity:0,
// // 		  duration:0.01,
// 	     })
//         .to(next.container, {
// //           duration: 0.2,
// //           y: "1.01vh",
// //           ease: "power1.out",
//         })
        .to(next.container, {
//           duration: 0.1,
//           y: "0vh",
//           ease: "power2.out",
          onComplete: () => {
            gsap.set(next.container, { clearProps: "all" });
            gsap.fromTo(
              ".header",
              { autoAlpha: 0, yPercent: 5 },
              { autoAlpha: 1, yPercent: 0, duration: 0, ease: "power2.out" }
            );
          },
        });
    },
  },
  rightToLeft: {
    name: "right-to-left-page-transition",
    to: { namespace: ["person","atrium"] },
//     from: { namespace: ["person"] },
    beforeEnter() {
      const nav = document.querySelector("nav");
      nav.classList.remove("open", "active", "visible");
      const burgerButton = document.querySelector(".burger-menu");
      burgerButton?.classList.remove("active");
      // Clean up any existing ScrollTriggers
      ScrollTrigger.getAll().forEach((st) => st.kill());

      // Force scroll to top
      window.scrollTo({ top: 0, behavior: "instant" });
    },
    leave({ current }) {
		customCursor(); 
      return gsap.timeline().to(".header", {
        autoAlpha: 0,
        yPercent: -5,
        duration: 0.3,
        ease: "power2.out",
      });
    },
		 after() {
		customCursor(); 
    },
    enter({ next }) {
		customCursor(); 
	  const overlay = document.querySelector(".transition-overlay");
	  overlay.style.opacity = "0";
      window.scrollTo({ top: 0 });

      gsap.set(next.container, {
        xPercent: 100,
        autoAlpha: 1,
        position: "fixed",
        top: 0,
        right: 0,
        zIndex: 991,
      });

      return gsap
        .timeline()
// 		.to(overlay,{
// 		 	opacity:1,
// 		  	duration:0.02,
// 	  	})
//         .to(next.container, {
//           xPercent: -1,
//           duration: 0.35,
//           autoAlpha: 1,
//           ease: "power1.out",
//         })
// 		.to(overlay,{
// 		  opacity:0,
// 		  duration:0.01,
// 	     })
//         .to(next.container, {
//           duration: 0.2,
//           xPercent: 1.01,
//           ease: "power1.out",
//         })
        .to(next.container, {
//           duration: 0.1,
//           xPercent: 0,
//           ease: "power2.out",
          onComplete: () => {
            gsap.set(next.container, { clearProps: "all" });
            gsap.fromTo(
              ".header",
              { autoAlpha: 0, yPercent: 5 },
              { autoAlpha: 1, yPercent: 0, duration: 0, ease: "power2.out" }
            );
          },
        });
    },
  },
};

barba.init({
  views,
  transitions: [transitions.general, transitions.rightToLeft],
});

// gsap.registerPlugin(ScrollTrigger, ScrollToPlugin);
// function initializeScroll() {
//   ScrollTrigger.getAll().forEach((st) => st.kill());

//   const panels = gsap.utils.toArray(".scroll-section");
//   let snapping = false;
//   let lastScrollTime = 0;
//   const scrollDelay = 1000; // Delay in milliseconds before next scroll

//   panels.forEach((panel, i) => {
//     ScrollTrigger.create({
//       trigger: panel,
//       start: "top 100%",
//       end: "bottom 0%",
//       onEnter: () => handleSnap(panel),
//       onEnterBack: () => handleSnap(panel),
//     });
//   });

//   function handleSnap(panel) {
//     const currentTime = Date.now();
//     if (!snapping && currentTime - lastScrollTime > scrollDelay) {
//       snapping = true;
//       lastScrollTime = currentTime;

//       gsap.to(window, {
//         scrollTo: { y: panel, autoKill: false },
//         duration: 0.8,
//         ease: "power2.out",
//         onComplete: () => {
//           snapping = false;
//         },
//       });
//     }
//   }

//   document.addEventListener(
//     "wheel",
//     (e) => {
//       if (snapping || Date.now() - lastScrollTime < scrollDelay) {
//         e.preventDefault();
//       }
//     },
//     { passive: false }
//   );

//   return () => {
//     ScrollTrigger.getAll().forEach((st) => st.kill());
//   };
// }
// // Modify the barba.hooks.after to check the transition state
// barba.hooks.after(() => {
//   hoverOverPost();
// //   isTransitioning = false;
//   if (!isTransitioning) {
// //     initializeScroll();
// //     isTransitioning = true;
//   } else {
//     // Just scroll to top if we're transitioning
//     window.scrollTo({ top: 0, behavior: "instant" });
//   }
// });
