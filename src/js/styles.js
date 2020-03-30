export function loadAsyncStyles() {
  const links = [...document.querySelectorAll('[data-async-style]')];
  links.forEach(l => {
    l.href = l.dataset.href;
    l.removeAttribute('data-async-style');
  });
}
