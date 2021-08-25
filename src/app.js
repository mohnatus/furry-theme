import { registerObserver } from './js/observer';
import { Drawer } from './js/drawer';
import { onLoad, onScroll } from './js/utils/onLoad';
import { loadAsyncStyles } from './js/styles';
import { AnalyticsTurnOn } from './js/analytics/init';
import { insertAds } from './js/ads';

Drawer();

registerObserver('[data-src]', function(target) {
  target.src = target.dataset.src;
  target.removeAttribute('data-src');
})

registerObserver('[data-srcset]',function(target) {
  target.srcset = target.dataset.srcset;
  target.removeAttribute('data-srcset');
})

registerObserver('.entry-preview .transformed', function(target) {
  target.classList.remove('transformed');
}, {
  rootMargin: '-150px'
});

onLoad(loadAsyncStyles);
onLoad(insertAds);
onScroll(AnalyticsTurnOn);
