import { node } from "./dom";

const loaderHTML = '<svg width="64" height="64"><use xlink:href="#loader-icon" href="#loader-icon"></use></svg>';

export function Loader() {
  const el = node('div', { class: 'loader '}, null, loaderHTML);
  return {
    el,
    remove: () => el.remove()
  }
}
