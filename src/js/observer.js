const defaultConfig = {
  rootMargin: '40px'
}

export function registerObserver(selector, entryCb, config = {}) {
  config = { ...defaultConfig, ...config} ;
  const callback = (entries, observer) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entryCb(entry.target);
        entry.target.setAttribute('data-loaded', '');
        observer.unobserve(entry.target);
      }
    })
  };
  const observer = new IntersectionObserver(callback, config);

  const elements = [...document.querySelectorAll(selector)];
  elements.forEach((el) => {
    observer.observe(el);
  });
}
