import { node } from '../utils/dom';

const { client, config } = window.adata.google;

const className = 'a-block';
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

  const attrs = {...insAttrs, ...config[name]};
  const ins = node('ins', attrs);
  el.appendChild(ins);

  const aBlock = {
    el,
    set loaded(value) {
      el.classList.toggle(loadedClassName, value);
    },
    set error(value) {
      el.classList.toggle(errorClassName, value);
      if (value)
        el.innerHTML = '<span>Пожалуйста, не блокируйте рекламу :(</span>';
    },
  };

  el.aBlock = aBlock;
  return aBlock;
}
