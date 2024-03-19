/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 2);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/shave.js":
/*!*******************************!*\
  !*** ./resources/js/shave.js ***!
  \*******************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_AMD_DEFINE_RESULT__;function _typeof(obj) { "@babel/helpers - typeof"; if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

/**
  shave - Shave is a javascript plugin that truncates multi-line text within a html element based on set max height
  @version v2.5.6
  @link https://github.com/dollarshaveclub/shave#readme
  @author Jeff Wainwright <yowainwright@gmail.com> (jeffry.in)
  @license MIT
**/
(function (global, factory) {
  ( false ? undefined : _typeof(exports)) === 'object' && typeof module !== 'undefined' ? module.exports = factory() :  true ? !(__WEBPACK_AMD_DEFINE_FACTORY__ = (factory),
				__WEBPACK_AMD_DEFINE_RESULT__ = (typeof __WEBPACK_AMD_DEFINE_FACTORY__ === 'function' ?
				(__WEBPACK_AMD_DEFINE_FACTORY__.call(exports, __webpack_require__, exports, module)) :
				__WEBPACK_AMD_DEFINE_FACTORY__),
				__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__)) : (undefined);
})(this, function () {
  'use strict';

  function shave(target, maxHeight) {
    var opts = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : {};
    if (typeof maxHeight === 'undefined' || isNaN(maxHeight)) throw Error('maxHeight is required');
    var els = typeof target === 'string' ? document.querySelectorAll(target) : target;
    if (!els) return;
    var character = opts.character || '…';
    var classname = opts.classname || 'js-shave';
    var spaces = typeof opts.spaces === 'boolean' ? opts.spaces : true;
    var charHtml = "<span class=\"js-shave-char\">".concat(character, "</span>");
    if (!('length' in els)) els = [els];

    for (var i = 0; i < els.length; i += 1) {
      var el = els[i];
      var styles = el.style;
      var span = el.querySelector(".".concat(classname));
      var textProp = el.textContent === undefined ? 'innerText' : 'textContent'; // If element text has already been shaved

      if (span) {
        // Remove the ellipsis to recapture the original text
        el.removeChild(el.querySelector('.js-shave-char'));
        el[textProp] = el[textProp]; // eslint-disable-line
        // nuke span, recombine text
      }

      var fullText = el[textProp];
      var words = spaces ? fullText.split(' ') : fullText; // If 0 or 1 words, we're done

      if (words.length < 2) continue; // Temporarily remove any CSS height for text height calculation

      var heightStyle = styles.height;
      styles.height = 'auto';
      var maxHeightStyle = styles.maxHeight;
      styles.maxHeight = 'none'; // If already short enough, we're done

      if (el.offsetHeight <= maxHeight) {
        styles.height = heightStyle;
        styles.maxHeight = maxHeightStyle;
        continue;
      } // Binary search for number of words which can fit in allotted height


      var max = words.length - 1;
      var min = 0;
      var pivot = void 0;

      while (min < max) {
        pivot = min + max + 1 >> 1; // eslint-disable-line no-bitwise

        el[textProp] = spaces ? words.slice(0, pivot).join(' ') : words.slice(0, pivot);
        el.insertAdjacentHTML('beforeend', charHtml);
        if (el.offsetHeight > maxHeight) max = pivot - 1;else min = pivot;
      }

      el[textProp] = spaces ? words.slice(0, max).join(' ') : words.slice(0, max);
      el.insertAdjacentHTML('beforeend', charHtml);
      var diff = spaces ? " ".concat(words.slice(max).join(' ')) : words.slice(max);
      var shavedText = document.createTextNode(diff);
      var elWithShavedText = document.createElement('span');
      elWithShavedText.classList.add(classname);
      elWithShavedText.style.display = 'none';
      elWithShavedText.appendChild(shavedText);
      el.insertAdjacentElement('beforeend', elWithShavedText);
      styles.height = heightStyle;
      styles.maxHeight = maxHeightStyle;
    }
  }

  return shave;
});

/***/ }),

/***/ 2:
/*!*************************************!*\
  !*** multi ./resources/js/shave.js ***!
  \*************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! E:\OSPanel\domains\riibTV\resources\js\shave.js */"./resources/js/shave.js");


/***/ })

/******/ });