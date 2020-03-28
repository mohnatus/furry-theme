function getHeaders() {
  const content = document.querySelector('.entry__content');
  const headers = [...content.querySelectorAll('h2, h3')];

  return headers.map((el) => {
    const text = el.textContent;
    const id = text.replace(/[\s-]/g, '_');
    return {
      el,
      root: el.tagName.toUpperCase() === 'H2',
      text: text,
      id: id,
    };
  });
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

function createTitle(className) {
  const el = document.createElement('h2');
  el.textContent = 'Содержание';
  el.className = className;
  return el;
}

export function ContentList() {
  const headers = getHeaders();
  headers.forEach(h => {
    h.el.insertAdjacentElement('afterbegin', createAnchor(h.id));
  });

  const contentList = document.querySelector('.contentlist');
  if (contentList) {
    const oneLevelList = contentList.hasAttribute('data-root');

    const list = headers.reduce((acc, h) => {
      if (h.root) {
        const { id, text } = h;
        return [
          ...acc,
          { id, text, items: [] }
        ];
      }

      if (oneLevelList) return acc;

      const root = acc[acc.length - 1];
      if (!root) return acc;

      const { id, text } = h;
      root.items.push({ id, text });
      return acc;

    }, []);


    const title = createTitle('contentlist__title');
    contentList.appendChild(title);
    title.addEventListener('click', function(e) {
      contentList.classList.toggle('contentlist--closed');
    });

    contentList.appendChild(createList(list, 'contentlist__root'));
    contentList.classList.add('contentlist--loaded');
  }
}
