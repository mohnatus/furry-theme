import hljs from 'highlight.js';
import xml from 'highlight.js/lib/languages/xml';
import css from 'highlight.js/lib/languages/css';
import js from 'highlight.js/lib/languages/javascript';

hljs.registerLanguage('xml', xml);
hljs.registerLanguage('css', css);
hljs.registerLanguage('js', js);

export function highlight() {
  document.querySelectorAll('.wp-block-code').forEach(el => {
    setTimeout(() =>  hljs.highlightElement(el));
  });
}
