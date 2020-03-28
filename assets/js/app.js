// modules are defined as an array
// [ module function, map of requires ]
//
// map of requires is short require name -> numeric require
//
// anything defined in a previous bundle is accessed via the
// orig method which is the require for previous bundles
parcelRequire = (function (modules, cache, entry, globalName) {
  // Save the require from previous bundle to this closure if any
  var previousRequire = typeof parcelRequire === 'function' && parcelRequire;
  var nodeRequire = typeof require === 'function' && require;

  function newRequire(name, jumped) {
    if (!cache[name]) {
      if (!modules[name]) {
        // if we cannot find the module within our internal map or
        // cache jump to the current global require ie. the last bundle
        // that was added to the page.
        var currentRequire = typeof parcelRequire === 'function' && parcelRequire;
        if (!jumped && currentRequire) {
          return currentRequire(name, true);
        }

        // If there are other bundles on this page the require from the
        // previous one is saved to 'previousRequire'. Repeat this as
        // many times as there are bundles until the module is found or
        // we exhaust the require chain.
        if (previousRequire) {
          return previousRequire(name, true);
        }

        // Try the node require function if it exists.
        if (nodeRequire && typeof name === 'string') {
          return nodeRequire(name);
        }

        var err = new Error('Cannot find module \'' + name + '\'');
        err.code = 'MODULE_NOT_FOUND';
        throw err;
      }

      localRequire.resolve = resolve;
      localRequire.cache = {};

      var module = cache[name] = new newRequire.Module(name);

      modules[name][0].call(module.exports, localRequire, module, module.exports, this);
    }

    return cache[name].exports;

    function localRequire(x){
      return newRequire(localRequire.resolve(x));
    }

    function resolve(x){
      return modules[name][1][x] || x;
    }
  }

  function Module(moduleName) {
    this.id = moduleName;
    this.bundle = newRequire;
    this.exports = {};
  }

  newRequire.isParcelRequire = true;
  newRequire.Module = Module;
  newRequire.modules = modules;
  newRequire.cache = cache;
  newRequire.parent = previousRequire;
  newRequire.register = function (id, exports) {
    modules[id] = [function (require, module) {
      module.exports = exports;
    }, {}];
  };

  var error;
  for (var i = 0; i < entry.length; i++) {
    try {
      newRequire(entry[i]);
    } catch (e) {
      // Save first error but execute all entries
      if (!error) {
        error = e;
      }
    }
  }

  if (entry.length) {
    // Expose entry point to Node, AMD or browser globals
    // Based on https://github.com/ForbesLindesay/umd/blob/master/template.js
    var mainExports = newRequire(entry[entry.length - 1]);

    // CommonJS
    if (typeof exports === "object" && typeof module !== "undefined") {
      module.exports = mainExports;

    // RequireJS
    } else if (typeof define === "function" && define.amd) {
     define(function () {
       return mainExports;
     });

    // <script>
    } else if (globalName) {
      this[globalName] = mainExports;
    }
  }

  // Override the current require with this new one
  parcelRequire = newRequire;

  if (error) {
    // throw error from earlier, _after updating parcelRequire_
    throw error;
  }

  return newRequire;
})({"js/observer.js":[function(require,module,exports) {
"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.registerObserver = registerObserver;

function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _nonIterableSpread(); }

function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance"); }

function _iterableToArray(iter) { if (Symbol.iterator in Object(iter) || Object.prototype.toString.call(iter) === "[object Arguments]") return Array.from(iter); }

function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) { for (var i = 0, arr2 = new Array(arr.length); i < arr.length; i++) { arr2[i] = arr[i]; } return arr2; } }

function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); if (enumerableOnly) symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; }); keys.push.apply(keys, symbols); } return keys; }

function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i] != null ? arguments[i] : {}; if (i % 2) { ownKeys(Object(source), true).forEach(function (key) { _defineProperty(target, key, source[key]); }); } else if (Object.getOwnPropertyDescriptors) { Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)); } else { ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } } return target; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

var defaultConfig = {
  rootMargin: '100px'
};

function registerObserver(selector, entryCb) {
  var config = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : {};
  config = _objectSpread({}, defaultConfig, {}, config);

  var callback = function callback(entries, observer) {
    entries.forEach(function (entry) {
      if (entry.isIntersecting) {
        entryCb(entry.target);
        entry.target.setAttribute('data-loaded', '');
        observer.unobserve(entry.target);
      }
    });
  };

  var observer = new IntersectionObserver(callback, config);

  var elements = _toConsumableArray(document.querySelectorAll(selector));

  elements.forEach(function (el) {
    observer.observe(el);
  });
}
},{}],"js/drawer.js":[function(require,module,exports) {
"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.Drawer = Drawer;

function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _nonIterableSpread(); }

function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance"); }

function _iterableToArray(iter) { if (Symbol.iterator in Object(iter) || Object.prototype.toString.call(iter) === "[object Arguments]") return Array.from(iter); }

function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) { for (var i = 0, arr2 = new Array(arr.length); i < arr.length; i++) { arr2[i] = arr[i]; } return arr2; } }

var drawerOpenClass = 'drawer-open';
var body = document.body;

function openMenu() {
  body.classList.add(drawerOpenClass);
}

function closeMenu() {
  body.classList.remove(drawerOpenClass);
}

function Drawer() {
  var drawerOpeners = _toConsumableArray(document.querySelectorAll('[data-drawer-open]'));

  var drawerClosers = _toConsumableArray(document.querySelectorAll('[data-drawer-close]'));

  var drawer = document.querySelector('.drawer');
  var searchField = drawer.querySelector('[name="s"]');
  drawerOpeners.forEach(function (o) {
    o.addEventListener('click', function () {
      openMenu();
      searchField.focus();
    });
  });
  drawerClosers.forEach(function (c) {
    c.addEventListener('click', closeMenu);
  });
}
},{}],"js/advert/data.js":[function(require,module,exports) {
"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.config = exports.url = exports.client = void 0;
var client = 'ca-pub-3389773486006292';
exports.client = client;
var url = 'https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js';
exports.url = url;
var config = {
  header: {
    'data-ad-slot': '5208556855',
    'data-ad-format': 'auto'
  },
  footer: {
    'data-ad-slot': '3190281066',
    'data-ad-format': 'auto'
  },
  inPost: {
    'data-ad-slot': '8843408867',
    'data-ad-layout': 'in-article',
    'data-ad-format': 'fluid'
  }
};
exports.config = config;
},{}],"js/utils/dom.js":[function(require,module,exports) {
"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.node = node;
exports.script = script;

function node(tag) {
  var attrs = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};
  var children = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : [];
  var n = document.createElement(tag);
  Object.keys(attrs).forEach(function (k) {
    n.setAttribute(k, attrs[k]);
  });
  children.forEach(function (c) {
    return n.appendChild(c);
  });
  return n;
}

function script(src, onLoad, onError) {
  var s = document.createElement('script');
  s.async = true;
  s.src = src;
  s.onload = onLoad;
  s.onerror = onError;
  document.body.appendChild(s);
}
},{}],"js/advert/ablock.js":[function(require,module,exports) {
"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.ABlock = ABlock;

var _data = require("./data");

var _dom = require("../utils/dom");

function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); if (enumerableOnly) symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; }); keys.push.apply(keys, symbols); } return keys; }

function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i] != null ? arguments[i] : {}; if (i % 2) { ownKeys(Object(source), true).forEach(function (key) { _defineProperty(target, key, source[key]); }); } else if (Object.getOwnPropertyDescriptors) { Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)); } else { ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } } return target; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

var className = 'a-block';
var loadedClassName = 'a-block--loaded';
var errorClassName = 'a-block--error';
var insAttrs = {
  'class': 'adsbygoogle',
  'style': 'display:block; text-align: center;',
  'data-ad-client': _data.client,
  'data-full-width-responsive': 'true'
};

function ABlock(el, name) {
  el.classList.add(className);

  var attrs = _objectSpread({}, insAttrs, {}, _data.config[name]);

  var ins = (0, _dom.node)('ins', attrs);
  el.appendChild(ins);
  return {
    el: el,

    set loaded(value) {
      el.classList.toggle(loadedClassName, value);
    },

    set error(value) {
      el.classList.toggle(errorClassName, value);
      if (value) el.innerHTML = '<span>Пожалуйста, не блокируйте рекламу :(</span>';
    }

  };
}
},{"./data":"js/advert/data.js","../utils/dom":"js/utils/dom.js"}],"js/advert/init.js":[function(require,module,exports) {
"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.ASet = ASet;
exports.AInit = AInit;

var _ablock = require("./ablock");

var _dom = require("../utils/dom");

var _data = require("./data");

function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _nonIterableSpread(); }

function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance"); }

function _iterableToArray(iter) { if (Symbol.iterator in Object(iter) || Object.prototype.toString.call(iter) === "[object Arguments]") return Array.from(iter); }

function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) { for (var i = 0, arr2 = new Array(arr.length); i < arr.length; i++) { arr2[i] = arr[i]; } return arr2; } }

function isSingular() {
  return document.body.classList.contains('single');
}

function createBlock(name) {
  return (0, _dom.node)('div', {
    'data-a-name': name,
    'data-a-block': ''
  });
}

function setInPost() {
  var post = document.querySelector('.entry__content');

  var headers = _toConsumableArray(post.querySelectorAll('h2, h3'));

  var step = 4;

  for (var i = 0, limit = headers.length - 2; i <= limit; i += step) {
    var header = headers[i];
    header.insertAdjacentElement('beforebegin', createBlock('inPost'));
  }

  var comments = document.getElementById('comments');

  if (comments) {
    comments.insertAdjacentElement('beforebegin', createBlock('inPost'));
  }
}

function setTop() {
  var main = document.querySelector('.page-main');
  main.querySelector('.container').insertAdjacentElement('afterbegin', createBlock('header'));
}

function setBottom() {
  var pageContent = document.querySelector('.page-content');
  pageContent.querySelector('.container').insertAdjacentElement('beforeend', createBlock('footer'));
}

function ASet() {
  if (isSingular()) {
    setInPost();
  } else {
    setTop();
  }

  setBottom();
  AInit();
}

function AInit() {
  var blocks = _toConsumableArray(document.querySelectorAll('[data-a-block]'));

  if (!blocks.length) return;
  window.adsbygoogle = window.adsbygoogle || [];
  var aBlocks = blocks.map(function (b) {
    var name = b.dataset.aName;
    if (!name) return;
    var aBlock = (0, _ablock.ABlock)(b, name);
    window.adsbygoogle.push({});
    return aBlock;
  });
  (0, _dom.script)(_data.url, function () {
    aBlocks.forEach(function (b) {
      return b.loaded = true;
    });
  }, function () {
    aBlocks.forEach(function (b) {
      return b.error = true;
    });
  });
}
},{"./ablock":"js/advert/ablock.js","../utils/dom":"js/utils/dom.js","./data":"js/advert/data.js"}],"app.js":[function(require,module,exports) {
"use strict";

var _observer = require("./js/observer");

var _drawer = require("./js/drawer");

var _init = require("./js/advert/init");

(0, _drawer.Drawer)();
(0, _observer.registerObserver)('[data-src]', function (target) {
  target.src = target.dataset.src;
  target.removeAttribute('data-src');
});
(0, _observer.registerObserver)('[data-srcset]', function (target) {
  target.srcset = target.dataset.srcset;
  target.removeAttribute('data-srcset');
});
(0, _observer.registerObserver)('[data-background]', function (target) {
  target.style.backgroundImage = "url(" + target.dataset.background + ")";
  target.removeAttribute('data-background');
});
(0, _observer.registerObserver)('.entry-preview.transformed', function (target) {
  target.classList.remove('transformed');
}, {
  rootMargin: '-250px'
});
(0, _init.ASet)();
},{"./js/observer":"js/observer.js","./js/drawer":"js/drawer.js","./js/advert/init":"js/advert/init.js"}],"../../../../../../../Users/catinweb/AppData/Roaming/npm/node_modules/parcel-bundler/src/builtins/hmr-runtime.js":[function(require,module,exports) {
var global = arguments[3];
var OVERLAY_ID = '__parcel__error__overlay__';
var OldModule = module.bundle.Module;

function Module(moduleName) {
  OldModule.call(this, moduleName);
  this.hot = {
    data: module.bundle.hotData,
    _acceptCallbacks: [],
    _disposeCallbacks: [],
    accept: function (fn) {
      this._acceptCallbacks.push(fn || function () {});
    },
    dispose: function (fn) {
      this._disposeCallbacks.push(fn);
    }
  };
  module.bundle.hotData = null;
}

module.bundle.Module = Module;
var checkedAssets, assetsToAccept;
var parent = module.bundle.parent;

if ((!parent || !parent.isParcelRequire) && typeof WebSocket !== 'undefined') {
  var hostname = "" || location.hostname;
  var protocol = location.protocol === 'https:' ? 'wss' : 'ws';
  var ws = new WebSocket(protocol + '://' + hostname + ':' + "49621" + '/');

  ws.onmessage = function (event) {
    checkedAssets = {};
    assetsToAccept = [];
    var data = JSON.parse(event.data);

    if (data.type === 'update') {
      var handled = false;
      data.assets.forEach(function (asset) {
        if (!asset.isNew) {
          var didAccept = hmrAcceptCheck(global.parcelRequire, asset.id);

          if (didAccept) {
            handled = true;
          }
        }
      }); // Enable HMR for CSS by default.

      handled = handled || data.assets.every(function (asset) {
        return asset.type === 'css' && asset.generated.js;
      });

      if (handled) {
        console.clear();
        data.assets.forEach(function (asset) {
          hmrApply(global.parcelRequire, asset);
        });
        assetsToAccept.forEach(function (v) {
          hmrAcceptRun(v[0], v[1]);
        });
      } else if (location.reload) {
        // `location` global exists in a web worker context but lacks `.reload()` function.
        location.reload();
      }
    }

    if (data.type === 'reload') {
      ws.close();

      ws.onclose = function () {
        location.reload();
      };
    }

    if (data.type === 'error-resolved') {
      console.log('[parcel] ✨ Error resolved');
      removeErrorOverlay();
    }

    if (data.type === 'error') {
      console.error('[parcel] 🚨  ' + data.error.message + '\n' + data.error.stack);
      removeErrorOverlay();
      var overlay = createErrorOverlay(data);
      document.body.appendChild(overlay);
    }
  };
}

function removeErrorOverlay() {
  var overlay = document.getElementById(OVERLAY_ID);

  if (overlay) {
    overlay.remove();
  }
}

function createErrorOverlay(data) {
  var overlay = document.createElement('div');
  overlay.id = OVERLAY_ID; // html encode message and stack trace

  var message = document.createElement('div');
  var stackTrace = document.createElement('pre');
  message.innerText = data.error.message;
  stackTrace.innerText = data.error.stack;
  overlay.innerHTML = '<div style="background: black; font-size: 16px; color: white; position: fixed; height: 100%; width: 100%; top: 0px; left: 0px; padding: 30px; opacity: 0.85; font-family: Menlo, Consolas, monospace; z-index: 9999;">' + '<span style="background: red; padding: 2px 4px; border-radius: 2px;">ERROR</span>' + '<span style="top: 2px; margin-left: 5px; position: relative;">🚨</span>' + '<div style="font-size: 18px; font-weight: bold; margin-top: 20px;">' + message.innerHTML + '</div>' + '<pre>' + stackTrace.innerHTML + '</pre>' + '</div>';
  return overlay;
}

function getParents(bundle, id) {
  var modules = bundle.modules;

  if (!modules) {
    return [];
  }

  var parents = [];
  var k, d, dep;

  for (k in modules) {
    for (d in modules[k][1]) {
      dep = modules[k][1][d];

      if (dep === id || Array.isArray(dep) && dep[dep.length - 1] === id) {
        parents.push(k);
      }
    }
  }

  if (bundle.parent) {
    parents = parents.concat(getParents(bundle.parent, id));
  }

  return parents;
}

function hmrApply(bundle, asset) {
  var modules = bundle.modules;

  if (!modules) {
    return;
  }

  if (modules[asset.id] || !bundle.parent) {
    var fn = new Function('require', 'module', 'exports', asset.generated.js);
    asset.isNew = !modules[asset.id];
    modules[asset.id] = [fn, asset.deps];
  } else if (bundle.parent) {
    hmrApply(bundle.parent, asset);
  }
}

function hmrAcceptCheck(bundle, id) {
  var modules = bundle.modules;

  if (!modules) {
    return;
  }

  if (!modules[id] && bundle.parent) {
    return hmrAcceptCheck(bundle.parent, id);
  }

  if (checkedAssets[id]) {
    return;
  }

  checkedAssets[id] = true;
  var cached = bundle.cache[id];
  assetsToAccept.push([bundle, id]);

  if (cached && cached.hot && cached.hot._acceptCallbacks.length) {
    return true;
  }

  return getParents(global.parcelRequire, id).some(function (id) {
    return hmrAcceptCheck(global.parcelRequire, id);
  });
}

function hmrAcceptRun(bundle, id) {
  var cached = bundle.cache[id];
  bundle.hotData = {};

  if (cached) {
    cached.hot.data = bundle.hotData;
  }

  if (cached && cached.hot && cached.hot._disposeCallbacks.length) {
    cached.hot._disposeCallbacks.forEach(function (cb) {
      cb(bundle.hotData);
    });
  }

  delete bundle.cache[id];
  bundle(id);
  cached = bundle.cache[id];

  if (cached && cached.hot && cached.hot._acceptCallbacks.length) {
    cached.hot._acceptCallbacks.forEach(function (cb) {
      cb();
    });

    return true;
  }
}
},{}]},{},["../../../../../../../Users/catinweb/AppData/Roaming/npm/node_modules/parcel-bundler/src/builtins/hmr-runtime.js","app.js"], null)
//# sourceMappingURL=/app.js.map