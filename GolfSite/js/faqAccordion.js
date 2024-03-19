const faqs = document.querySelectorAll(".faq");
let activeAccordion = null;

faqs.forEach((faq) => {
  const faqHeader = faq.querySelector(".faq-header");
  const faqContent = faq.querySelector(".faq-content");
  faqContent.style.display = "none";

  faq.addEventListener("click", () => {
    if (activeAccordion && activeAccordion !== faq) {
      activeAccordion.classList.remove("active");
      activeAccordion.querySelector(".faq-content").style.display = "none";
    }

    faq.classList.toggle("active");
    if (faqContent.style.display === "none") {
      faqContent.style.display = "block";
      activeAccordion = faq;
    } else {
      faqContent.style.display = "none";
      activeAccordion = null;
    }
  });
});