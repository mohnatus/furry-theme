export function node(tag, attrs = {}, children = [], html = '') {
  const n = document.createElement(tag);
  if (attrs) {
    Object.keys(attrs).forEach(k => {
      n.setAttribute(k, attrs[k]);
    });
  }
  if (children) children.forEach(c => n.appendChild(c));
  if (html) n.innerHTML = html;
  return n;
}

export function script(src, onLoad, onError) {
  const s = document.createElement('script');
  s.async = true;
  s.src = src;
  s.onload = onLoad;
  s.onerror = onError;
  return s;
}
