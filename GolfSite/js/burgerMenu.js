// Burger menu
const burger = document.querySelector(".burger-wrapper");
const burgerContent = document.querySelector(".burger-content");
const navLinks = document.querySelector(".nav-links");
const navLinksUl = document.querySelector(".nav-links ul");

if (burger !== null) {
  burger.addEventListener("click", () => {
    burgerContent.classList.toggle("active");
    navLinks.classList.toggle("active");
    navLinksUl.classList.toggle("active");
  });
}

// Close burger menu when a link is clicked
if (navLinksUl !== null) {
  navLinksUl.addEventListener("click", () => {
    if (navLinks.classList.contains("active")) {
      burgerContent.classList.remove("active");
      navLinks.classList.remove("active");
      navLinksUl.classList.remove("active");
    }
  });
}