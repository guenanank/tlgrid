/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/ajaxForm.js":
/*!**********************************!*\
  !*** ./resources/js/ajaxForm.js ***!
  \**********************************/
/***/ (() => {

/**
 * jQuery AJAX form
 *
 * @author http://guenanank.com
 */
(function ($) {
  $.fn.ajaxForm = function (obj) {
    var setting = $.fn.extend({
      url: '',
      data: {},
      beforeSend: function beforeSend() {},
      afterSend: function afterSend() {},
      refresh: true
    }, obj);
    return this.each(function () {
      $.ajax({
        type: $(this).attr('method'),
        url: setting.url ? setting.url : $(this).attr('action'),
        data: typeof setting.data === 'undefined' ? setting.data : new FormData(this),
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: setting.beforeSend ? setting.beforeSend : function () {},
        statusCode: {
          200: function _(data) {
            Swal.fire({
              icon: 'success',
              title: 'Your work has been saved',
              showConfirmButton: false,
              timer: 1750
            }).then(function () {
              if (setting.refresh) {
                location.reload(true);
              }
            });
          },
          422: function _(response) {
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'Something went wrong!',
              showConfirmButton: false,
              timer: 1750
            });
            $.each(response.responseJSON.errors, function (k, v) {
              $('#' + k).addClass('is-invalid');
              $('#' + k + 'Help').text(v);
            });
          }
        }
      }).always(setting.afterSend ? setting.afterSend : function () {});
    });
  };

  $.fn.ajaxDelete = function () {
    return this.each(function () {
      var _this = this;

      Swal.fire({
        icon: 'warning',
        title: 'Are you sure?',
        text: 'You won\'t be able to revert this!',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!'
      }).then(function (result) {
        if (result.value) {
          $.ajax({
            type: 'DELETE',
            url: $(_this).attr('href'),
            data: {
              _method: 'DELETE'
            },
            success: function success() {
              Swal.fire({
                icon: 'success',
                title: 'Your work has been deleted',
                showConfirmButton: false,
                timer: 1750
              }).then(function () {
                location.reload(true);
              });
            }
          });
        } else if (result.dismiss === swal.DismissReason.cancel) {
          Swal.fire({
            title: 'Your data is safe :)',
            icon: 'error',
            showConfirmButton: false,
            timer: 1750
          }).then(function () {
            location.reload(true);
          });
        }
      });
    });
  };
})(jQuery);

/***/ }),

/***/ "./node_modules/bootstrap-colorpicker/src/sass/colorpicker.scss":
/*!**********************************************************************!*\
  !*** ./node_modules/bootstrap-colorpicker/src/sass/colorpicker.scss ***!
  \**********************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./node_modules/bootstrap-fileinput/scss/fileinput.scss":
/*!**************************************************************!*\
  !*** ./node_modules/bootstrap-fileinput/scss/fileinput.scss ***!
  \**************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/scss/loader.scss":
/*!************************************!*\
  !*** ./resources/scss/loader.scss ***!
  \************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/css/app.css":
/*!*******************************!*\
  !*** ./resources/css/app.css ***!
  \*******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = __webpack_modules__;
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/chunk loaded */
/******/ 	(() => {
/******/ 		var deferred = [];
/******/ 		__webpack_require__.O = (result, chunkIds, fn, priority) => {
/******/ 			if(chunkIds) {
/******/ 				priority = priority || 0;
/******/ 				for(var i = deferred.length; i > 0 && deferred[i - 1][2] > priority; i--) deferred[i] = deferred[i - 1];
/******/ 				deferred[i] = [chunkIds, fn, priority];
/******/ 				return;
/******/ 			}
/******/ 			var notFulfilled = Infinity;
/******/ 			for (var i = 0; i < deferred.length; i++) {
/******/ 				var [chunkIds, fn, priority] = deferred[i];
/******/ 				var fulfilled = true;
/******/ 				for (var j = 0; j < chunkIds.length; j++) {
/******/ 					if ((priority & 1 === 0 || notFulfilled >= priority) && Object.keys(__webpack_require__.O).every((key) => (__webpack_require__.O[key](chunkIds[j])))) {
/******/ 						chunkIds.splice(j--, 1);
/******/ 					} else {
/******/ 						fulfilled = false;
/******/ 						if(priority < notFulfilled) notFulfilled = priority;
/******/ 					}
/******/ 				}
/******/ 				if(fulfilled) {
/******/ 					deferred.splice(i--, 1)
/******/ 					var r = fn();
/******/ 					if (r !== undefined) result = r;
/******/ 				}
/******/ 			}
/******/ 			return result;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/jsonp chunk loading */
/******/ 	(() => {
/******/ 		// no baseURI
/******/ 		
/******/ 		// object to store loaded and loading chunks
/******/ 		// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 		// [resolve, reject, Promise] = chunk loading, 0 = chunk loaded
/******/ 		var installedChunks = {
/******/ 			"/js/ajaxForm": 0,
/******/ 			"css/app": 0,
/******/ 			"css/loader": 0,
/******/ 			"css/fileinput": 0,
/******/ 			"css/colorpicker": 0
/******/ 		};
/******/ 		
/******/ 		// no chunk on demand loading
/******/ 		
/******/ 		// no prefetching
/******/ 		
/******/ 		// no preloaded
/******/ 		
/******/ 		// no HMR
/******/ 		
/******/ 		// no HMR manifest
/******/ 		
/******/ 		__webpack_require__.O.j = (chunkId) => (installedChunks[chunkId] === 0);
/******/ 		
/******/ 		// install a JSONP callback for chunk loading
/******/ 		var webpackJsonpCallback = (parentChunkLoadingFunction, data) => {
/******/ 			var [chunkIds, moreModules, runtime] = data;
/******/ 			// add "moreModules" to the modules object,
/******/ 			// then flag all "chunkIds" as loaded and fire callback
/******/ 			var moduleId, chunkId, i = 0;
/******/ 			if(chunkIds.some((id) => (installedChunks[id] !== 0))) {
/******/ 				for(moduleId in moreModules) {
/******/ 					if(__webpack_require__.o(moreModules, moduleId)) {
/******/ 						__webpack_require__.m[moduleId] = moreModules[moduleId];
/******/ 					}
/******/ 				}
/******/ 				if(runtime) var result = runtime(__webpack_require__);
/******/ 			}
/******/ 			if(parentChunkLoadingFunction) parentChunkLoadingFunction(data);
/******/ 			for(;i < chunkIds.length; i++) {
/******/ 				chunkId = chunkIds[i];
/******/ 				if(__webpack_require__.o(installedChunks, chunkId) && installedChunks[chunkId]) {
/******/ 					installedChunks[chunkId][0]();
/******/ 				}
/******/ 				installedChunks[chunkId] = 0;
/******/ 			}
/******/ 			return __webpack_require__.O(result);
/******/ 		}
/******/ 		
/******/ 		var chunkLoadingGlobal = self["webpackChunk"] = self["webpackChunk"] || [];
/******/ 		chunkLoadingGlobal.forEach(webpackJsonpCallback.bind(null, 0));
/******/ 		chunkLoadingGlobal.push = webpackJsonpCallback.bind(null, chunkLoadingGlobal.push.bind(chunkLoadingGlobal));
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module depends on other loaded chunks and execution need to be delayed
/******/ 	__webpack_require__.O(undefined, ["css/app","css/loader","css/fileinput","css/colorpicker"], () => (__webpack_require__("./resources/js/ajaxForm.js")))
/******/ 	__webpack_require__.O(undefined, ["css/app","css/loader","css/fileinput","css/colorpicker"], () => (__webpack_require__("./node_modules/bootstrap-colorpicker/src/sass/colorpicker.scss")))
/******/ 	__webpack_require__.O(undefined, ["css/app","css/loader","css/fileinput","css/colorpicker"], () => (__webpack_require__("./node_modules/bootstrap-fileinput/scss/fileinput.scss")))
/******/ 	__webpack_require__.O(undefined, ["css/app","css/loader","css/fileinput","css/colorpicker"], () => (__webpack_require__("./resources/scss/loader.scss")))
/******/ 	var __webpack_exports__ = __webpack_require__.O(undefined, ["css/app","css/loader","css/fileinput","css/colorpicker"], () => (__webpack_require__("./resources/css/app.css")))
/******/ 	__webpack_exports__ = __webpack_require__.O(__webpack_exports__);
/******/ 	
/******/ })()
;