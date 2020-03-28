export function node(tag, attrs = {}, children = []) {
  const n = document.createElement(tag);
  Object.keys(attrs).forEach(k => {
    n.setAttribute(k, attrs[k]);
  });
  children.forEach(c => n.appendChild(c));
  return n;
}

export function script(src, onLoad, onError) {
  const s = document.createElement('script');
  s.async = true;
  s.src = src;
  s.onload = onLoad;
  s.onerror = onError;
  document.body.appendChild(s);
}
