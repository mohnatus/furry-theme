export function loadFonts() {
  const links = [...document.querySelectorAll('[data-font]')];
  links.forEach(l => {
    l.href = l.dataset.href;
    l.removeAttribute('data-href');
  });
}
