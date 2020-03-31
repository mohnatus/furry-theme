import { onKeyDown, ESCAPE_KEY } from "./utils/keyboard";

const drawerOpenClass = 'drawer-open';
const body = document.body;
function openMenu() {
  body.classList.add(drawerOpenClass);
}

function closeMenu() {
  body.classList.remove(drawerOpenClass);
}

export function Drawer() {
  const drawerOpeners = [...document.querySelectorAll('[data-drawer-open]')];
  const drawerClosers = [...document.querySelectorAll('[data-drawer-close]')];

  const drawer = document.querySelector('.drawer');
  const searchField = drawer.querySelector('[name="s"]');

  drawerOpeners.forEach((o) => {
    o.addEventListener('click', () => {
      openMenu();
      searchField.focus();
    });
  });

  drawerClosers.forEach((c) => {
    c.addEventListener('click', closeMenu);
  });

  onKeyDown(ESCAPE_KEY, () => {
    closeMenu();
  })
}
