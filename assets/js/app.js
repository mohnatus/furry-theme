parcelRequire=function(e,r,t,n){var i,o="function"==typeof parcelRequire&&parcelRequire,u="function"==typeof require&&require;function f(t,n){if(!r[t]){if(!e[t]){var i="function"==typeof parcelRequire&&parcelRequire;if(!n&&i)return i(t,!0);if(o)return o(t,!0);if(u&&"string"==typeof t)return u(t);var c=new Error("Cannot find module '"+t+"'");throw c.code="MODULE_NOT_FOUND",c}p.resolve=function(r){return e[t][1][r]||r},p.cache={};var l=r[t]=new f.Module(t);e[t][0].call(l.exports,p,l,l.exports,this)}return r[t].exports;function p(e){return f(p.resolve(e))}}f.isParcelRequire=!0,f.Module=function(e){this.id=e,this.bundle=f,this.exports={}},f.modules=e,f.cache=r,f.parent=o,f.register=function(r,t){e[r]=[function(e,r){r.exports=t},{}]};for(var c=0;c<t.length;c++)try{f(t[c])}catch(e){i||(i=e)}if(t.length){var l=f(t[t.length-1]);"object"==typeof exports&&"undefined"!=typeof module?module.exports=l:"function"==typeof define&&define.amd?define(function(){return l}):n&&(this[n]=l)}if(parcelRequire=f,i)throw i;return f}({"j64w":[function(require,module,exports) {
"use strict";function e(e){return n(e)||t(e)||r()}function r(){throw new TypeError("Invalid attempt to spread non-iterable instance")}function t(e){if(Symbol.iterator in Object(e)||"[object Arguments]"===Object.prototype.toString.call(e))return Array.from(e)}function n(e){if(Array.isArray(e)){for(var r=0,t=new Array(e.length);r<e.length;r++)t[r]=e[r];return t}}function o(e,r){var t=Object.keys(e);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(e);r&&(n=n.filter(function(r){return Object.getOwnPropertyDescriptor(e,r).enumerable})),t.push.apply(t,n)}return t}function c(e){for(var r=1;r<arguments.length;r++){var t=null!=arguments[r]?arguments[r]:{};r%2?o(Object(t),!0).forEach(function(r){i(e,r,t[r])}):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(t)):o(Object(t)).forEach(function(r){Object.defineProperty(e,r,Object.getOwnPropertyDescriptor(t,r))})}return e}function i(e,r,t){return r in e?Object.defineProperty(e,r,{value:t,enumerable:!0,configurable:!0,writable:!0}):e[r]=t,e}Object.defineProperty(exports,"__esModule",{value:!0}),exports.registerObserver=u;var a={rootMargin:"40px"};function u(r,t){var n=arguments.length>2&&void 0!==arguments[2]?arguments[2]:{};n=c({},a,{},n);var o=new IntersectionObserver(function(e,r){e.forEach(function(e){e.isIntersecting&&(t(e.target),e.target.setAttribute("data-loaded",""),r.unobserve(e.target))})},n);e(document.querySelectorAll(r)).forEach(function(e){o.observe(e)})}
},{}],"sqhT":[function(require,module,exports) {
"use strict";function e(e){return n(e)||t(e)||r()}function r(){throw new TypeError("Invalid attempt to spread non-iterable instance")}function t(e){if(Symbol.iterator in Object(e)||"[object Arguments]"===Object.prototype.toString.call(e))return Array.from(e)}function n(e){if(Array.isArray(e)){for(var r=0,t=new Array(e.length);r<e.length;r++)t[r]=e[r];return t}}Object.defineProperty(exports,"__esModule",{value:!0}),exports.Drawer=u;var o="drawer-open",c=document.body;function a(){c.classList.add(o)}function i(){c.classList.remove(o)}function u(){var r=e(document.querySelectorAll("[data-drawer-open]")),t=e(document.querySelectorAll("[data-drawer-close]")),n=document.querySelector(".drawer").querySelector('[name="s"]');r.forEach(function(e){e.addEventListener("click",function(){a(),n.focus()})}),t.forEach(function(e){e.addEventListener("click",i)})}
},{}],"O8Ck":[function(require,module,exports) {
"use strict";function e(e){var t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{},r=arguments.length>2&&void 0!==arguments[2]?arguments[2]:[],n=document.createElement(e);return Object.keys(t).forEach(function(e){n.setAttribute(e,t[e])}),r.forEach(function(e){return n.appendChild(e)}),n}function t(e,t,r){var n=document.createElement("script");return n.async=!0,n.src=e,n.onload=t,n.onerror=r,n}Object.defineProperty(exports,"__esModule",{value:!0}),exports.node=e,exports.script=t;
},{}],"vSIC":[function(require,module,exports) {
"use strict";Object.defineProperty(exports,"__esModule",{value:!0}),exports.ABlock=u;var e=require("../utils/dom");function t(e,t){var r=Object.keys(e);if(Object.getOwnPropertySymbols){var o=Object.getOwnPropertySymbols(e);t&&(o=o.filter(function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable})),r.push.apply(r,o)}return r}function r(e){for(var r=1;r<arguments.length;r++){var n=null!=arguments[r]?arguments[r]:{};r%2?t(Object(n),!0).forEach(function(t){o(e,t,n[t])}):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):t(Object(n)).forEach(function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))})}return e}function o(e,t,r){return t in e?Object.defineProperty(e,t,{value:r,enumerable:!0,configurable:!0,writable:!0}):e[t]=r,e}var n=window.adata?window.adata.google:{},a=n.client,c=n.config,l="a-block",i="a-block--loaded",s="a-block--error",d={class:"adsbygoogle",style:"display:block; text-align: center;","data-ad-client":a,"data-ad-format":"fluid","data-full-width-responsive":"true"};function u(t,o){t.classList.add(l);var n=r({},d,{},c[o]),a=(0,e.node)("ins",n);t.appendChild(a);var u={el:t,set loaded(e){t.classList.toggle(i,e)},set error(e){t.classList.toggle(s,e),e&&(t.innerHTML="<span>Пожалуйста, не блокируйте рекламу :(</span>")}};return t.aBlock=u,u}
},{"../utils/dom":"O8Ck"}],"FR5i":[function(require,module,exports) {
"use strict";Object.defineProperty(exports,"__esModule",{value:!0}),exports.ASet=f;var e=require("./ablock"),t=require("../utils/dom"),n=require("../observer");function o(e){return i(e)||a(e)||r()}function r(){throw new TypeError("Invalid attempt to spread non-iterable instance")}function a(e){if(Symbol.iterator in Object(e)||"[object Arguments]"===Object.prototype.toString.call(e))return Array.from(e)}function i(e){if(Array.isArray(e)){for(var t=0,n=new Array(e.length);t<e.length;t++)n[t]=e[t];return n}}var c="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js";function d(){return document.body.classList.contains("single")||document.body.classList.contains("page")}function s(e){return(0,t.node)("div",{"data-a-name":e,"data-a-block":""})}function u(){for(var e=o(document.querySelector(".entry__content").querySelectorAll("h2, h3")),t=0,n=e.length-2;t<=n;t+=4){e[t].insertAdjacentElement("beforebegin",s("inPost"))}var r=document.getElementById("comments");r&&r.insertAdjacentElement("beforebegin",s("inPost"))}function l(){document.querySelector(".page-main").querySelector(".container").insertAdjacentElement("afterbegin",s("header"))}function g(){document.querySelector(".page-content").querySelector(".container").insertAdjacentElement("beforeend",s("footer"))}function f(){if(window.adata&&window.adata.google){var o=window.adata.google.blocks||{};window.adsbygoogle=window.adsbygoogle||[];var r=new Promise(function(e,n){var o=(0,t.script)(c,e,n);document.body.appendChild(o)});d()&&o.inPost?u():o.header&&l(),o.footer&&g(),(0,n.registerObserver)("[data-a-block]",function(t){var n=t.dataset.aName;if(n){var o=(0,e.ABlock)(t,n);window.adsbygoogle.push({}),r.then(function(){return o.loaded=!0}).catch(function(){return o.error=!0})}})}}
},{"./ablock":"vSIC","../utils/dom":"O8Ck","../observer":"j64w"}],"WBPA":[function(require,module,exports) {
"use strict";function e(e){window.contentLoaded?e():document.addEventListener("DOMContentLoaded",e)}function n(n){var o=function e(){window.removeEventListener("scroll",e),n()};e(function(){window.addEventListener("scroll",o,{passive:!0})})}Object.defineProperty(exports,"__esModule",{value:!0}),exports.onLoad=e,exports.onScroll=n;
},{}],"SPMd":[function(require,module,exports) {
"use strict";function t(t){return n(t)||r(t)||e()}function e(){throw new TypeError("Invalid attempt to spread non-iterable instance")}function r(t){if(Symbol.iterator in Object(t)||"[object Arguments]"===Object.prototype.toString.call(t))return Array.from(t)}function n(t){if(Array.isArray(t)){for(var e=0,r=new Array(t.length);e<t.length;e++)r[e]=t[e];return r}}function o(){t(document.querySelectorAll("[data-async-style]")).forEach(function(t){t.href=t.dataset.href,t.removeAttribute("data-async-style")})}Object.defineProperty(exports,"__esModule",{value:!0}),exports.loadAsyncStyles=o;
},{}],"iD3b":[function(require,module,exports) {
"use strict";function a(){if(window.adata&&window.adata.yandex&&window.adata.yandex.id){var a,e,t,n,i,d=window.adata.yandex.id;a=window,e=document,t="script",a.ym=a.ym||function(){(a.ym.a=a.ym.a||[]).push(arguments)},a.ym.l=1*new Date,n=e.createElement(t),i=e.getElementsByTagName(t)[0],n.async=1,n.src="https://mc.yandex.ru/metrika/tag.js",i.parentNode.insertBefore(n,i),ym(d,"init",{clickmap:!0,trackLinks:!0,accurateTrackBounce:!0})}}Object.defineProperty(exports,"__esModule",{value:!0}),exports.AnalyticsTurnOn=a;
},{}],"A2T1":[function(require,module,exports) {
"use strict";var e=require("./js/observer"),r=require("./js/drawer"),t=require("./js/advert/init"),s=require("./js/utils/onLoad"),a=require("./js/styles"),i=require("./js/analytics/init");(0,r.Drawer)(),(0,e.registerObserver)("[data-src]",function(e){e.src=e.dataset.src,e.removeAttribute("data-src")}),(0,e.registerObserver)("[data-srcset]",function(e){e.srcset=e.dataset.srcset,e.removeAttribute("data-srcset")}),(0,e.registerObserver)("[data-background]",function(e){e.style.backgroundImage="url("+e.dataset.background+")",e.removeAttribute("data-background")}),(0,e.registerObserver)("[data-style]",function(e){e.setAttribute("style",e.dataset.style),e.removeAttribute("data-style")}),(0,e.registerObserver)(".entry-preview.transformed",function(e){e.classList.remove("transformed")},{rootMargin:"-250px"}),(0,s.onLoad)(a.loadAsyncStyles),(0,s.onScroll)(i.AnalyticsTurnOn),(0,s.onLoad)(t.ASet);
},{"./js/observer":"j64w","./js/drawer":"sqhT","./js/advert/init":"FR5i","./js/utils/onLoad":"WBPA","./js/styles":"SPMd","./js/analytics/init":"iD3b"}]},{},["A2T1"], null)