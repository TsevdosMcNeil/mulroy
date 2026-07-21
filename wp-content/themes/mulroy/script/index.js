// JavaScript for hover functionality
document.addEventListener("DOMContentLoaded", function () {
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
});
