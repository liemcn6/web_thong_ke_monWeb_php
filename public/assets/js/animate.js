(function () {
  window.addEventListener('scroll', (event) => {
    let currentScrollPos = window.scrollY;
    let boundingRect = document.querySelector('.top-spending-customer').getBoundingClientRect();

    if (boundingRect.top + currentScrollPos <= currentScrollPos + window.innerHeight) {
      document.querySelectorAll('.need-slide').forEach((element, index) => {
        setTimeout(() => {
          element.classList.add('slide-left');
          element.classList.remove('need-slide');
        }, index*300);
      });
    }
  });

  window.dispatchEvent(new Event('scroll'));
})();