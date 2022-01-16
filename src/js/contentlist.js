function getHeaders() {
  const content = document.querySelector('.entry__content');
  if (content) {
    const headers = [...content.querySelectorAll('h2, h3')];

    return headers.map((el) => {
      const text = el.textContent;
      const id = text.replace(/[\s-]/g, '_');
      return {
        el,
        root: el.tagName.toUpperCase() === 'H2',
        text: text,
        id: id
      };
    });
  }

  return [];
}

function createAnchor(id) {
  const anchor = document.createElement('a');
  anchor.className = 'anchor';
  anchor.href = `#${id}`;
  anchor.name = id;
  return anchor;
}

function createItem(item) {
  const el = document.createElement('li');
  const link = document.createElement('a');
  link.href = `#${item.id}`;
  link.textContent = item.text;
  el.appendChild(link);
  return el;
}

function createList(items, className) {
  let list = document.createElement('ul');
  if (className) list.className = className;
  items.forEach((itemData) => {
    let el = createItem(itemData);
    if (itemData.items) {
      let innerList = createList(itemData.items);
      el.appendChild(innerList);
    }
    list.appendChild(el);
  });
  return list;
}

function createTitle(className, text) {
  const el = document.createElement('h2');
  el.textContent = text;
  el.className = className;
  return el;
}

function collapseBlock(el) {
  if (el.hasAttribute('data-collapsed')) {
    el.style.height = el.scrollHeight + 'px';
    el.removeAttribute('data-collapsed');
  } else {
    el.style.height = '';
    el.setAttribute('data-collapsed', true);
  }
}

export function ContentList() {
  const headers = getHeaders();
  headers.forEach((h) => {
    h.el.insertAdjacentElement('afterbegin', createAnchor(h.id));
  });

  const contentList = document.querySelector('[data-contentlist]');

  if (contentList) {
    const titleText = contentList.hasAttribute('data-title')
      ? contentList.getAttribute('data-title')
      : 'Содержание';
    const toggle = contentList.hasAttribute('data-toggle');
    const hideText = contentList.hasAttribute('data-hide-text')
      ? contentList.getAttribute('data-hide-text')
      : 'Скрыть содержание';
    const showText = contentList.hasAttribute('data-show-text')
      ? contentList.getAttribute('data-show-text')
      : 'Показать содержание';

    contentList.classList.add('contentlist');
    const oneLevelList = contentList.hasAttribute('data-root');

    const list = headers.reduce((acc, h) => {
      if (h.root) {
        const { id, text } = h;
        return [...acc, { id, text, items: [] }];
      }

      if (oneLevelList) return acc;

      const root = acc[acc.length - 1];
      if (!root) return acc;

      const { id, text } = h;
      root.items.push({ id, text });
      return acc;
    }, []);

    const $list = createList(list, 'contentlist__root');

    const $wrapper = document.createElement('div');
    $wrapper.classList.add('contentlist__wrapper');
    contentList.appendChild($wrapper);

    if (titleText) {
      const $title = createTitle('contentlist__title', titleText);
      $wrapper.appendChild($title);

      if (toggle) {
        $title.addEventListener('click', function (e) {
          collapseBlock($wrapper);
        });
      }
    }

    $wrapper.appendChild($list);

    if (toggle) {
      $wrapper.setAttribute('data-collapsed', true);

      const $collapse = document.createElement('div');
      $collapse.classList.add('contentlist__collapse');
      $collapse.setAttribute('data-show', showText);
      $collapse.setAttribute('data-hide', hideText);
      contentList.append($collapse);
      contentList.classList.add('contentlist--collapsible');

      $collapse.addEventListener('click', function () {
        collapseBlock($wrapper);
      });
    }

    contentList.classList.add('contentlist--loaded');
  }
}
