(function () {
  const listenLoadingEle = document.querySelector('.search-result');

  if (!listenLoadingEle) return;

  listenLoadingEle.addEventListener('scroll', function (event) {
    const loadingMoreEle = document.querySelector('.loading-more');

    if (this.scrollTop + this.offsetHeight >= this.scrollHeight
      && !loadingMoreEle.classList.contains('visible')) {
        loadingMoreEle.classList.add('visible');
    }
  });
})();