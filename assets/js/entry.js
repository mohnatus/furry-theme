function createItem(item) {
  const el = document.createElement('li');
  const link = document.createElement('a');
  link.href = '#' + item.id;
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

function initContentList() {
  const content = document.querySelector('.entry__content');
  const headers = Array.from(content.querySelectorAll('h2, h3'));

  const structure = headers.map(function(el) {
    const text = el.textContent;
    const id = text.replace(/[\s-]/g, '_');

    const anchor = document.createElement('a');
    anchor.className = 'anchor';
    anchor.href = '#' + id;
    anchor.name = id;
    el.insertAdjacentElement('afterbegin', anchor);

    return {
      root: el.tagName.toUpperCase() === 'H2',
      text: text,
      id: id,
    };
  });

  const contentList = document.querySelector('.contentlist');
  if (contentList) {
    let currentRoot = null;
    let list = [];

    structure.forEach(function(el) {
      if (el.root) {
        currentRoot = {
          id: el.id,
          text: el.text,
          items: [],
        };
        list.push(currentRoot);
      } else {
        if (contentList.hasAttribute('data-root')) return;
        if (currentRoot) {
          currentRoot.items.push({
            id: el.id,
            text: el.text,
          });
        }
      }
    });

    const title = createTitle('contentlist__title');
    contentList.appendChild(title);
    title.addEventListener('click', function(e) {
      contentList.classList.toggle('contentlist--closed');
    });

    contentList.appendChild(createList(list, 'contentlist__root'));
    contentList.classList.add('contentlist--loaded');
  }
}

console.log(1234);
initContentList();
