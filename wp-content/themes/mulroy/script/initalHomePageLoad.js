document.addEventListener("DOMContentLoaded", () => {
	
  // Check if we're on home page
  const homeContainer = document.querySelector('[data-barba-namespace="home"]');
  if (!homeContainer) return;

  // Check if animation has played in this session
  const hasAnimationPlayed = sessionStorage.getItem("homeAnimationPlayed");
  if (hasAnimationPlayed) return;

  // Set the flag for this session
  // sessionStorage.setItem("homeAnimationPlayed", "true");
  const overlay = document.querySelector(".hero-overlay");
  const pageTitles = document.querySelectorAll(".page-title svg");
  const pageDesc = document.querySelector(".page-desc");
	const letters = document.querySelectorAll(".hero-letter");
	const customCursor = document.querySelector(".custom-cursor");
  // Initial state
  
	letters.forEach((el)=>{
		el.style.color='black'
	})
  gsap.set(overlay, {
    background: "#00a7e1",
  });
  gsap.set([overlay, pageTitles], {
    autoAlpha: 0,
  });
  gsap.set(pageDesc, {
    opacity: 0,
    visibility: "hidden",
  });
  gsap.set(pageTitles, {
    fill: "#000000",
  });
	
	gsap.set(customCursor,{
	  opacity:0,
  })

  // Create animation timeline
  const tl = gsap.timeline({
    defaults: { ease: "power2.inOut" },
    delay: 2,
  });

  tl.to(overlay, {
    autoAlpha: 1,
    duration: 0,
  })
	.to(customCursor,{
	  opacity:1,
  })
    .to(
      pageTitles,
      {
        autoAlpha: 1,
        duration: 0,
      },
      "<"
    ) // Start at same time as overlay
    .to(
      overlay,
      {
        background: "rgba(0,0,0,.2)",
        duration: 0.8,
      },
      "<"
    ) // Start at same time as previous
    .to(
      pageDesc,
      {
        duration: 0.8,
        opacity: 1,
    visibility: "visible",
      },
      "<"
    ) // Start at same time as previous
    .to(
      pageTitles,
      {
        fill: "#FFFFFF",
        duration: 0.8,
		  onStart:()=>{
			  letters.forEach((el)=>{
		el.style.color='white'
	})
		  }
      },
      "<"
    ); // Start at same time as previous
  function initializeScroll() {
    // Clean up any existing ScrollTriggers first
    ScrollTrigger.getAll().forEach((st) => st.kill());

    const panels = gsap.utils.toArray(".scroll-section");
    let snapping = false; // Flag to prevent scroll during animation

    panels.forEach((panel, i) => {
      ScrollTrigger.create({
        trigger: panel,
        start: "top 100%", // More precise trigger point
        end: "bottom 0%",
        onEnter: () => {
          if (!snapping) {
            snapping = true;
            gsap.to(window, {
              scrollTo: { y: panel, autoKill: false },
              duration: 0.8,
              ease: "power2.out",
              onComplete: () => (snapping = false),
            });
          }
        },
        onEnterBack: () => {
          if (!snapping) {
            snapping = true;
            gsap.to(window, {
              scrollTo: { y: panel, autoKill: false },
              duration: 0.8,
              ease: "power2.out",
              onComplete: () => (snapping = false),
            });
          }
        },
      });
    });

    // Prevent default scroll behavior during snapping
    document.addEventListener(
      "wheel",
      (e) => {
        if (snapping) {
          e.preventDefault();
        }
      },
      { passive: false }
    );

    return () => {
      // Cleanup function
      ScrollTrigger.getAll().forEach((st) => st.kill());
    };
  }
//   initializeScroll();
  // function hoverOverPost() {
  //   const newsItems = document.querySelectorAll(".home-news-post-item");
  //   const hoverImageSection = document.querySelector(".hover-image-section");
  //   const newsPostImage = document.querySelector(".news-post-image");

  //   // Function to show the image
  //   function showImage(imageUrl) {
  //     hoverImageSection.classList.add("visible");
  //     newsPostImage.style.backgroundImage = `url('${imageUrl}')`;
  //   }

  //   // Function to hide the image
  //   function hideImage() {
  //     hoverImageSection.classList.remove("visible");
  //   }

  //   // Add hover listeners to each news item
  //   newsItems.forEach((item) => {
  //     const imageUrl = item.dataset.image;

  //     item.addEventListener("mouseenter", () => {
  //       if (imageUrl) {
  //         showImage(imageUrl);
  //       }
  //     });

  //     item.addEventListener("mouseleave", () => {
  //       hideImage();
  //     });
  //   });
  // }
  // hoverOverPost();
});
