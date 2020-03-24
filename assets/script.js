const defaultConfig = {
  rootMargin: '100px'
}

function registerObserver(selector, entryCb, config = {}) {
  config = { ...defaultConfig, ...config };
  const callback = (entries, observer) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entryCb(entry.target);
        entry.target.setAttribute('data-loaded', '');
        observer.unobserve(entry.target);
      }
    })
  }
  const observer = new IntersectionObserver(callback, config);

  const elements = [...document.querySelectorAll(selector)];
  elements.forEach(el => observer.observe(el));
}

function onLoad() {
  registerObserver('[data-src]', (target) => {
    target.src = target.dataset.src;
    target.removeAttribute('data-src');
  })

  registerObserver('[data-srcset]', (target) => {
    target.srcset = target.dataset.srcset;
    target.removeAttribute('data-srcset');
  })

  registerObserver('[data-background]', (target) => {
    target.style.backgroundImage = `url(${target.dataset.background})`;
    target.removeAttribute('data-background');
  })

  registerObserver('.entry-preview.transformed', (target) => {
    target.classList.remove('transformed');
  }, {
    rootMargin: '-250px'
  });

  const drawerOpeners = Array.from(document.querySelectorAll('[data-drawer-open]'));
  const drawerClosers = Array.from(document.querySelectorAll('[data-drawer-close]'));

  const drawer = document.querySelector('.drawer');
  const searchField = drawer.querySelector('[name="s"]');
  const drawerOpenClass = 'drawer-open';

  function openMenu() {
    document.body.classList.add(drawerOpenClass);
    searchField.focus();
  }

  function closeMenu() {
    document.body.classList.remove(drawerOpenClass);
  }

  drawerOpeners.forEach(o => {
    o.addEventListener('click', openMenu);
  });

  drawerClosers.forEach(c => {
    c.addEventListener('click', closeMenu);
  })
}

onLoad();
