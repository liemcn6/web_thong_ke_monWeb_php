(function () {
  document.querySelectorAll('.custom-sidebar-collapse').forEach((ele) => {
    const toggler = document.querySelector(`div[collapse-target="#${ele.id}"]`);
    const togglerIcon = toggler.querySelector('i');

    toggler.addEventListener('click', () => {
      ele.classList.toggle('show');
      togglerIcon.classList.toggle('ps-3');
    });
  });
})();