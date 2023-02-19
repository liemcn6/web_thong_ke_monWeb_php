(function () {
  const scrollTopBtn = document.getElementById("scroll-top-btn");

  window.addEventListener('scroll', () => {
    // scroll greater than 200px to show button
    if (window.scrollY > 200) {
      scrollTopBtn.style.visibility = "visible";
    } else {
      scrollTopBtn.style.visibility = "hidden";
    }
  });

  // add event click scroll top
  scrollTopBtn.addEventListener('click', () => {
    document.body.scrollTop = 0; // For Safari
    document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
  });
})();