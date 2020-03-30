import { ABlock } from "./ablock";
import { script, node } from "../utils/dom";
import { registerObserver } from "../observer";

const url = 'https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js';

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
  if (!window.adata || !window.adata.google) return;
  const googleData = window.adata.google;
  const blocks = googleData.blocks|| {};

  window.adsbygoogle = window.adsbygoogle || [];
  const loading = new Promise((res, rej) => {
    const s = script(url, res, rej);
    document.body.appendChild(s);
  });

  if (isSingular()) {
    if (blocks.inPost) setInPost();
    else if (blocks.header) setTop();
  } else {
    if (blocks.header) setTop();
  }

  if (blocks.footer) setBottom();

  registerObserver('[data-a-block]', (b) => {
    const name = b.dataset.aName;
    if (!name) return;

    const aBlock = ABlock(b, name);
    window.adsbygoogle.push({});

    loading
      .then(() => aBlock.loaded = true)
      .catch(() => aBlock.error = true);
  })
}
