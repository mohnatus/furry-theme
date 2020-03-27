const slots = {
  inPost: '8843408867',
  header: '5208556855',
  footer: '3190281066'
};

function createBlock(el, config) {
  if (!el) {
    el = document.createElement('div');
  }
  el.classList.add('a-block');

  const attrs = [
    ['class', 'adsbygoogle'],
    ['style', 'display:block; text-align: center;'],
    ['data-ad-format', config.format],
    ['data-ad-slot', config.slot],
    ['data-ad-client', 'ca-pub-3389773486006292'],
    ['data-full-width-responsive', 'true']
  ];

  if (config.layout) {
    attrs.push(['data-ad-layout', config.layout]);
  }

  const string = attrs.map(function(attr) {
    return attr[0] + '="' + attr[1] + '"';
  }).join(' ');

  el.innerHTML = '<ins ' + string + '></ins>';
  return el;
}

document.addEventListener('DOMContentLoaded', function() {
  window.adsbygoogle = window.adsbygoogle || [];

  const main = document.getElementById('main');
  const blocks = [];

  const contentBlocks = Array.from(document.querySelectorAll('.a-content'));
  contentBlocks.forEach(function(block) {
    blocks.push(createBlock(block, {
      layout: 'in-article',
      format: 'fluid',
      slot: slots.inPost
    }));

    window.adsbygoogle.push({});
  });

  if (contentBlocks.length === 0) {
    const headerABlock = createBlock(null, {
      format: 'auto',
      slot: slots.header
    })
    main.insertBefore(headerABlock, main.firstElementChild);
    window.adsbygoogle.push({});
    blocks.push(headerABlock);
  }

  const footerABlock = createBlock(null, {
    format: 'auto',
    slot: slots.footer
  })
  main.appendChild(footerABlock);
  window.adsbygoogle.push({});
  blocks.push(footerABlock);

  const aScript = document.createElement('script');
  document.body.appendChild(aScript);
  aScript.src =
    'https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js';
  aScript.onload = function() {
    blocks.forEach(function(block) {
      block.classList.add('a-block--load');
    })
  };
  aScript.onerror = function() {
    blocks.forEach(function(block) {
      block.classList.add('a-block--error');
      block.innerHTML = "<span>Пожалуйста, не блокируйте рекламу :(</span>"
    })
  };
});
