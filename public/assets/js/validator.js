(function () {
  'use strict'

  let formEles = document.querySelectorAll('.needs-validation');

  Array.prototype.slice.call(formEles).forEach((formEle) => {
    formEle.addEventListener('submit', (event) => {
      event.preventDefault();
      event.stopPropagation();

      if (formEle.checkValidity()) {
        formEle.submit();
      }

      formEle.classList.add('was-validated');
    }, false);
  })
})();