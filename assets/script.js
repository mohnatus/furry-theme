const defaultConfig = {
  rootMargin: '100px'
}

function registerObserver(selector, entryCb, config = {}) {
  config = { ...defaultConfig, ...config };
  const callback = (entries, observer) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entryCb(entry.target);
        observer.unobserve(entry.target);
      }
    })
  }
  const observer = new IntersectionObserver(callback, config);

  const elements = [...document.querySelectorAll(selector)];
  elements.forEach(el => observer.observe(el));
}

document.addEventListener('DOMContentLoaded', () => {
  registerObserver('[data-src]', (target) => {
    target.src = target.dataset.src;
    target.removeAttribute('data-src');
  })

  registerObserver('[data-background]', (target) => {
    target.style.backgroundImage = `url(${target.dataset.background})`;
    target.removeAttribute('data-background');
  })
})
