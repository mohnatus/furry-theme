var defaultConfig = {
  rootMargin: '100px'
}

function registerObserver(selector, entryCb, config) {
  config = config || {};
  config = Object.assign(defaultConfig, config);
  var callback = function(entries, observer) {
    entries.forEach(function(entry) {
      if (entry.isIntersecting) {
        entryCb(entry.target);
        entry.target.setAttribute('data-loaded', '');
        observer.unobserve(entry.target);
      }
    })
  };
  var observer = new IntersectionObserver(callback, config);

  var elements = Array.from(document.querySelectorAll(selector));
  elements.forEach(function(el) {
    observer.observe(el);
  });
}

function onLoad() {
  registerObserver('[data-src]', function(target) {
    target.src = target.dataset.src;
    target.removeAttribute('data-src');
  })

  registerObserver('[data-srcset]',function(target) {
    target.srcset = target.dataset.srcset;
    target.removeAttribute('data-srcset');
  })

  registerObserver('[data-background]', function(target) {
    target.style.backgroundImage = "url(" + target.dataset.background + ")";
    target.removeAttribute('data-background');
  })

  registerObserver('.entry-preview.transformed', function(target) {
    target.classList.remove('transformed');
  }, {
    rootMargin: '-250px'
  });

  var drawerOpeners = Array.from(document.querySelectorAll('[data-drawer-open]'));
  var drawerClosers = Array.from(document.querySelectorAll('[data-drawer-close]'));

  var drawer = document.querySelector('.drawer');
  var searchField = drawer.querySelector('[name="s"]');
  var drawerOpenClass = 'drawer-open';

  function openMenu() {
    document.body.classList.add(drawerOpenClass);
    searchField.focus();
  }

  function closeMenu() {
    document.body.classList.remove(drawerOpenClass);
  }

  drawerOpeners.forEach(function(o) {
    o.addEventListener('click', openMenu);
  });

  drawerClosers.forEach(function(c) {
    c.addEventListener('click', closeMenu);
  })
}

onLoad();
