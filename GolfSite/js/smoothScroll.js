document.addEventListener("DOMContentLoaded", function () {
    const links = document.querySelectorAll(".scrollLink");
  
    for (const link of links) {
      link.addEventListener("click", smoothScroll);
    }
  
    function smoothScroll(e) {
      e.preventDefault();
      const targetId = e.target.getAttribute("href");
      let targetPosition;
  
      if (targetId === "#") {
        targetPosition = 0; // Scroll to the top of the page
      } else {
        const targetElement = document.querySelector(targetId);
        if (targetElement) {
          const headerHeight = document.querySelector("header").offsetHeight;
          targetPosition = targetElement.offsetTop - 20 - headerHeight;
        } else {
          targetPosition = 0; // Fallback to top if target element not found
        }
      }
  
      const startPosition = window.pageYOffset;
      const distance = targetPosition - startPosition;
      const duration = 500;
      let start = null;
  
      window.requestAnimationFrame(step);
  
      function step(timestamp) {
        if (!start) start = timestamp;
        const progress = timestamp - start;
        window.scrollTo(
          0,
          easeInOutQuad(progress, startPosition, distance, duration)
        );
        if (progress < duration) window.requestAnimationFrame(step);
      }
  
      function easeInOutQuad(t, b, c, d) {
        t /= d / 2;
        if (t < 1) return (c / 2) * t * t + b;
        t--;
        return (-c / 2) * (t * (t - 2) - 1) + b;
      }
    }
  });