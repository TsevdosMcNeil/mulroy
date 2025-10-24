console.log(themePath);
const burgerMenu = document.querySelector(".burger-menu");
const nav = document.querySelector("nav");
const body = document.body;
const menuLinks = document.querySelectorAll("nav a");
const menuBtn = document.querySelector(".menu-btn");
//
document.getElementById("menu-animation-div").style.display = "none";
menuBtn.style.display = "none";
gsap.set(menuBtn, { opacity: 0 });
var animation = lottie.loadAnimation({
  container: document.getElementById("menu-animation-div"),
  renderer: "svg",
  loop: true,
  autoplay: true,
  path: themePath + "/assets/arrow_animation.json",
});
gsap.to(menuBtn, {
//   opacity: 1,
  duration: 0.1,
//   ease: "power-in",
  delay: 3,
  onComplete: function() {
    menuBtn.style.display = "flex";
	  menuBtn.style.opacity = "1";
  }
});
gsap.to("#menu-animation-div", {
//   opacity: 1,
  delay: 0,
  duration:0,
// 	delay: 2.8,
//   duration:5,
  onStart: () => {
    document.getElementById("menu-animation-div").style.display = "block";
  },
  onComplete: function() {
    document.getElementById("menu-animation-div").style.display = "none";
  }
});
burgerMenu.addEventListener("click", () => {
  burgerMenu.classList.toggle("active");
  nav.classList.toggle("open");
  
  // Toggle body scroll lock when menu opens/closes
  if (nav.classList.contains("open")) {
    // Disable scrolling on the body
    body.style.overflow = "hidden";
  } else {
    // Re-enable scrolling on the body
    body.style.overflow = "auto";
  }
});

// Add click event listeners to all menu links
menuLinks.forEach(link => {
  link.addEventListener("click", () => {
    // Close the menu
    burgerMenu.classList.remove("active");
    nav.classList.remove("open");
    
    // Re-enable scrolling
    body.style.overflow = "auto";
  });
});