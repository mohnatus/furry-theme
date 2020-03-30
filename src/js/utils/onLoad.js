export function onLoad(cb) {
  if (window.contentLoaded) cb();
  else {
    document.addEventListener('DOMContentLoaded', cb);
  }
}

export function onScroll(cb) {
  const scrollCb = () => {
    window.removeEventListener('scroll', scrollCb);
    cb();
  }
  onLoad(() => {
    window.addEventListener('scroll', scrollCb, { passive: true })
  });
}
