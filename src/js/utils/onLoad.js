export function onLoad(cb) {
  if (window.contentLoaded) cb();
  else {
    document.addEventListener('DOMContentLoaded', cb);
  }
}
