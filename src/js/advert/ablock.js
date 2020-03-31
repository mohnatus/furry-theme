import { node } from '../utils/dom';
import { Loader } from '../utils/loader';

const { client, config } = window.adata ? window.adata.google : {};

const className = 'a-block';
const loadingClassName = 'a-block--loading';
const loadedClassName = 'a-block--loaded';
const errorClassName = 'a-block--error';


const insAttrs = {
  'class': 'adsbygoogle',
  'style': 'display:block; text-align: center;',
  'data-ad-client': client,
  'data-ad-format': 'fluid',
  'data-full-width-responsive': 'true'
}

export function ABlock(el, name) {
  el.classList.add(className);
  let loader = Loader();
  el.appendChild(loader.el);
  el.classList.add(loadingClassName);

  const attrs = {...insAttrs, ...config[name]};
  const ins = node('ins', attrs);
  el.appendChild(ins);

  function stopLoading() {
    loader.remove();
    el.classList.remove(loadingClassName);
  }

  const aBlock = {
    el,
    set loaded(value) {
      stopLoading();
      el.classList.toggle(loadedClassName, value);
    },
    set error(value) {
      stopLoading();
      el.classList.toggle(errorClassName, value);
      if (value)
        el.innerHTML = '<span>Пожалуйста, не блокируйте рекламу :(</span>';
    },
  };

  el.aBlock = aBlock;
  return aBlock;
}
