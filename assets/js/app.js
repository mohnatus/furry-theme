parcelRequire=function(e,r,t,n){var i,o="function"==typeof parcelRequire&&parcelRequire,u="function"==typeof require&&require;function f(t,n){if(!r[t]){if(!e[t]){var i="function"==typeof parcelRequire&&parcelRequire;if(!n&&i)return i(t,!0);if(o)return o(t,!0);if(u&&"string"==typeof t)return u(t);var c=new Error("Cannot find module '"+t+"'");throw c.code="MODULE_NOT_FOUND",c}p.resolve=function(r){return e[t][1][r]||r},p.cache={};var l=r[t]=new f.Module(t);e[t][0].call(l.exports,p,l,l.exports,this)}return r[t].exports;function p(e){return f(p.resolve(e))}}f.isParcelRequire=!0,f.Module=function(e){this.id=e,this.bundle=f,this.exports={}},f.modules=e,f.cache=r,f.parent=o,f.register=function(r,t){e[r]=[function(e,r){r.exports=t},{}]};for(var c=0;c<t.length;c++)try{f(t[c])}catch(e){i||(i=e)}if(t.length){var l=f(t[t.length-1]);"object"==typeof exports&&"undefined"!=typeof module?module.exports=l:"function"==typeof define&&define.amd?define(function(){return l}):n&&(this[n]=l)}if(parcelRequire=f,i)throw i;return f}({"j64w":[function(require,module,exports) {
"use strict";function e(e){return n(e)||t(e)||r()}function r(){throw new TypeError("Invalid attempt to spread non-iterable instance")}function t(e){if(Symbol.iterator in Object(e)||"[object Arguments]"===Object.prototype.toString.call(e))return Array.from(e)}function n(e){if(Array.isArray(e)){for(var r=0,t=new Array(e.length);r<e.length;r++)t[r]=e[r];return t}}function o(e,r){var t=Object.keys(e);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(e);r&&(n=n.filter(function(r){return Object.getOwnPropertyDescriptor(e,r).enumerable})),t.push.apply(t,n)}return t}function c(e){for(var r=1;r<arguments.length;r++){var t=null!=arguments[r]?arguments[r]:{};r%2?o(Object(t),!0).forEach(function(r){i(e,r,t[r])}):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(t)):o(Object(t)).forEach(function(r){Object.defineProperty(e,r,Object.getOwnPropertyDescriptor(t,r))})}return e}function i(e,r,t){return r in e?Object.defineProperty(e,r,{value:t,enumerable:!0,configurable:!0,writable:!0}):e[r]=t,e}Object.defineProperty(exports,"__esModule",{value:!0}),exports.registerObserver=u;var a={rootMargin:"40px"};function u(r,t){var n=arguments.length>2&&void 0!==arguments[2]?arguments[2]:{};n=c({},a,{},n);var o=new IntersectionObserver(function(e,r){e.forEach(function(e){e.isIntersecting&&(t(e.target),e.target.setAttribute("data-loaded",""),r.unobserve(e.target))})},n);e(document.querySelectorAll(r)).forEach(function(e){o.observe(e)})}
},{}],"sqhT":[function(require,module,exports) {
"use strict";function e(e){return n(e)||t(e)||r()}function r(){throw new TypeError("Invalid attempt to spread non-iterable instance")}function t(e){if(Symbol.iterator in Object(e)||"[object Arguments]"===Object.prototype.toString.call(e))return Array.from(e)}function n(e){if(Array.isArray(e)){for(var r=0,t=new Array(e.length);r<e.length;r++)t[r]=e[r];return t}}Object.defineProperty(exports,"__esModule",{value:!0}),exports.Drawer=u;var o="drawer-open",c=document.body;function a(){c.classList.add(o)}function i(){c.classList.remove(o)}function u(){var r=e(document.querySelectorAll("[data-drawer-open]")),t=e(document.querySelectorAll("[data-drawer-close]")),n=document.querySelector(".drawer").querySelector('[name="s"]');r.forEach(function(e){e.addEventListener("click",function(){a(),n.focus()})}),t.forEach(function(e){e.addEventListener("click",i)})}
},{}],"hS4Y":[function(require,module,exports) {
"use strict";Object.defineProperty(exports,"__esModule",{value:!0}),exports.config=exports.url=exports.client=void 0;var t="ca-pub-3389773486006292";exports.client=t;var a="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js";exports.url=a;var e={header:{"data-ad-slot":"5208556855"},footer:{"data-ad-slot":"3190281066"},inPost:{"data-ad-slot":"8843408867","data-ad-layout":"in-article"}};exports.config=e;
},{}],"O8Ck":[function(require,module,exports) {
"use strict";function e(e){var t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{},n=arguments.length>2&&void 0!==arguments[2]?arguments[2]:[],r=document.createElement(e);return Object.keys(t).forEach(function(e){r.setAttribute(e,t[e])}),n.forEach(function(e){return r.appendChild(e)}),r}function t(e,t,n){var r=document.createElement("script");r.async=!0,r.src=e,r.onload=t,r.onerror=n,document.body.appendChild(r)}Object.defineProperty(exports,"__esModule",{value:!0}),exports.node=e,exports.script=t;
},{}],"vSIC":[function(require,module,exports) {
"use strict";Object.defineProperty(exports,"__esModule",{value:!0}),exports.ABlock=s;var e=require("./data"),t=require("../utils/dom");function r(e,t){var r=Object.keys(e);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(e);t&&(n=n.filter(function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable})),r.push.apply(r,n)}return r}function n(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?r(Object(n),!0).forEach(function(t){o(e,t,n[t])}):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):r(Object(n)).forEach(function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))})}return e}function o(e,t,r){return t in e?Object.defineProperty(e,t,{value:r,enumerable:!0,configurable:!0,writable:!0}):e[t]=r,e}var a="a-block",c="a-block--loaded",i="a-block--error",l={class:"adsbygoogle",style:"display:block; text-align: center;","data-ad-client":e.client,"data-ad-format":"fluid","data-full-width-responsive":"true"};function s(r,o){r.classList.add(a);var s=n({},l,{},e.config[o]),u=(0,t.node)("ins",s);return r.appendChild(u),{el:r,set loaded(e){r.classList.toggle(c,e)},set error(e){r.classList.toggle(i,e),e&&(r.innerHTML="<span>Пожалуйста, не блокируйте рекламу :(</span>")}}}
},{"./data":"hS4Y","../utils/dom":"O8Ck"}],"FR5i":[function(require,module,exports) {
"use strict";Object.defineProperty(exports,"__esModule",{value:!0}),exports.ASet=f,exports.AInit=m;var e=require("./ablock"),t=require("../utils/dom"),n=require("./data");function r(e){return c(e)||a(e)||o()}function o(){throw new TypeError("Invalid attempt to spread non-iterable instance")}function a(e){if(Symbol.iterator in Object(e)||"[object Arguments]"===Object.prototype.toString.call(e))return Array.from(e)}function c(e){if(Array.isArray(e)){for(var t=0,n=new Array(e.length);t<e.length;t++)n[t]=e[t];return n}}function i(){return document.body.classList.contains("single")||document.body.classList.contains("page")}function u(e){return(0,t.node)("div",{"data-a-name":e,"data-a-block":""})}function l(){for(var e=r(document.querySelector(".entry__content").querySelectorAll("h2, h3")),t=0,n=e.length-2;t<=n;t+=4){e[t].insertAdjacentElement("beforebegin",u("inPost"))}var o=document.getElementById("comments");o&&o.insertAdjacentElement("beforebegin",u("inPost"))}function d(){document.querySelector(".page-main").querySelector(".container").insertAdjacentElement("afterbegin",u("header"))}function s(){document.querySelector(".page-content").querySelector(".container").insertAdjacentElement("beforeend",u("footer"))}function f(){s(),m()}function m(){var o=r(document.querySelectorAll("[data-a-block]"));if(o.length){window.adsbygoogle=window.adsbygoogle||[];var a=o.map(function(t){var n=t.dataset.aName;if(n){var r=(0,e.ABlock)(t,n);return window.adsbygoogle.push({}),r}});(0,t.script)(n.url,function(){a.forEach(function(e){return e.loaded=!0})},function(){a.forEach(function(e){return e.error=!0})})}}
},{"./ablock":"vSIC","../utils/dom":"O8Ck","./data":"hS4Y"}],"Ur1Y":[function(require,module,exports) {
"use strict";function t(t){return n(t)||e(t)||r()}function r(){throw new TypeError("Invalid attempt to spread non-iterable instance")}function e(t){if(Symbol.iterator in Object(t)||"[object Arguments]"===Object.prototype.toString.call(t))return Array.from(t)}function n(t){if(Array.isArray(t)){for(var r=0,e=new Array(t.length);r<t.length;r++)e[r]=t[r];return e}}function o(){t(document.querySelectorAll("[data-font]")).forEach(function(t){t.href=t.dataset.href,t.removeAttribute("data-href")})}Object.defineProperty(exports,"__esModule",{value:!0}),exports.loadFonts=o;
},{}],"WBPA":[function(require,module,exports) {
"use strict";function e(e){window.contentLoaded?e():document.addEventListener("DOMContentLoaded",e)}Object.defineProperty(exports,"__esModule",{value:!0}),exports.onLoad=e;
},{}],"A2T1":[function(require,module,exports) {
"use strict";var e=require("./js/observer"),r=require("./js/drawer"),t=require("./js/advert/init"),s=require("./js/fonts"),a=require("./js/utils/onLoad");(0,r.Drawer)(),(0,e.registerObserver)("[data-src]",function(e){e.src=e.dataset.src,e.removeAttribute("data-src")}),(0,e.registerObserver)("[data-srcset]",function(e){e.srcset=e.dataset.srcset,e.removeAttribute("data-srcset")}),(0,e.registerObserver)("[data-background]",function(e){e.style.backgroundImage="url("+e.dataset.background+")",e.removeAttribute("data-background")}),(0,e.registerObserver)("[data-style]",function(e){e.setAttribute("style",e.dataset.style),e.removeAttribute("data-style")}),(0,e.registerObserver)(".entry-preview.transformed",function(e){e.classList.remove("transformed")},{rootMargin:"-250px"}),(0,a.onLoad)(s.loadFonts),(0,t.ASet)();
},{"./js/observer":"j64w","./js/drawer":"sqhT","./js/advert/init":"FR5i","./js/fonts":"Ur1Y","./js/utils/onLoad":"WBPA"}]},{},["A2T1"], null)