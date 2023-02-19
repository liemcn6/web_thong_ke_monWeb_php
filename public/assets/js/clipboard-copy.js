(function () {
  const copyBtnEle = document.getElementById('copy-btn');
  if (!copyBtnEle) {
    console.error('Copy button not found!');
    return;
  }

  const tooltip = new bootstrap.Tooltip(copyBtnEle, {
    placement: 'top',
    title: 'Copy to clipboard',
    trigger: 'hover'
  })

  copyBtnEle.addEventListener('click', () => {
    /* Get copy target */
    const copyFieldValue = copyBtnEle.getAttribute('copyField');
    const copyFieldEle = document.querySelector(copyFieldValue);

    /* Copy the text inside the text field */
    navigator.clipboard.writeText(copyFieldEle.getAttribute('value'));

    // update tooltip
    tooltip._config.title = 'Copied!';
    tooltip.show()
  });

  // revert tooltip
  copyBtnEle.addEventListener('mouseout', () => {
    tooltip._config.title = 'Copy to clipboard';
  });
})();