function customHtmlPopover(html, containerId) {
  const containerEle = document.getElementById(containerId);
  if (!containerEle) return;

  new bootstrap.Popover(containerEle, {
    html: true,
    content: html
  });
}