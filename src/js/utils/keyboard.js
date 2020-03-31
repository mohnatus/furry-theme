export const ESCAPE_KEY = {
  name: 'Escape',
  code: 27
};

export function getName(event) {
  return event.code;
}

export function getCode(event) {
  return event.keyCode;
}

export function isEscape(event) {
  return getKey(event) === ESCAPE_KEY.key;
}

export function onKeyDown(key, cb) {
  document.addEventListener('keydown', e => {
    if (getCode(e) === key.code || getName(e) === key.name) cb();
  })
}
