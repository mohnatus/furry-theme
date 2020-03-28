import { registerObserver } from './js/observer';
import { Drawer } from './js/drawer';
import { ASet } from './js/advert/init';
import { loadFonts } from './js/fonts';
import { onLoad } from './js/utils/onLoad';

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

registerObserver('[data-style]', function(target) {
  target.setAttribute('style', target.dataset.style);
  target.removeAttribute('data-style');
})

registerObserver('.entry-preview.transformed', function(target) {
  target.classList.remove('transformed');
}, {
  rootMargin: '-250px'
});

onLoad(loadFonts);

ASet();
