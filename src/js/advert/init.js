import { ABlock } from "./ablock";
import { script, node } from "../utils/dom";
import { url } from "./data";

function isSingular() {
  return document.body.classList.contains('single') || document.body.classList.contains('page');
}

function createBlock(name) {
  return node('div', { 'data-a-name': name, 'data-a-block': '' });
}

function setInPost() {
  const post = document.querySelector('.entry__content');
  const headers = [...post.querySelectorAll('h2, h3')];
  const step = 4;

  for (let i = 0, limit = headers.length - 2; i <= limit; i += step) {
    let header = headers[i];
    header.insertAdjacentElement('beforebegin', createBlock('inPost'));
  }

  const comments = document.getElementById('comments');
  if (comments) {
    comments.insertAdjacentElement('beforebegin', createBlock('inPost'));
  }
}

function setTop() {
  const main = document.querySelector('.page-main');
  main.querySelector('.container').insertAdjacentElement('afterbegin', createBlock('header'));
}

function setBottom() {
  const pageContent = document.querySelector('.page-content');
  pageContent.querySelector('.container').insertAdjacentElement('beforeend', createBlock('footer'));
}

export function ASet() {
  // if (isSingular()) {
  //   setInPost();
  // } else {
  //   setTop();
  // }

  setBottom();

  AInit();
}

export function AInit() {
  const blocks = [...document.querySelectorAll('[data-a-block]')];
  if (!blocks.length) return;

  window.adsbygoogle = window.adsbygoogle || [];
  const aBlocks = blocks.map(b => {
    const name = b.dataset.aName;
    if (!name) return;

    const aBlock = ABlock(b, name);
    window.adsbygoogle.push({});
    return aBlock;
  });

  script(url, () => {
    aBlocks.forEach(b => b.loaded = true);
  }, () => {
    aBlocks.forEach(b => b.error = true);
  })
}
