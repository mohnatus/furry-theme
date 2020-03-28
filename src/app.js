import { registerObserver } from './js/observer';
import { Drawer } from './js/drawer';
import { ASet } from './js/advert/init';

Drawer();

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

ASet();
