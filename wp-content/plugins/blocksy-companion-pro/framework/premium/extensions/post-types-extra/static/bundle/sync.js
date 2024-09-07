!function(){"use strict";var e={};function t(e,t){(null==t||t>e.length)&&(t=e.length);for(var r=0,o=new Array(t);r<t;r++)o[r]=e[r];return o}function r(e){return function(e){if(Array.isArray(e))return t(e)}(e)||function(e){if("undefined"!=typeof Symbol&&null!=e[Symbol.iterator]||null!=e["@@iterator"])return Array.from(e)}(e)||function(e,r){if(e){if("string"==typeof e)return t(e,r);var o=Object.prototype.toString.call(e).slice(8,-1);return"Object"===o&&e.constructor&&(o=e.constructor.name),"Map"===o||"Set"===o?Array.from(e):"Arguments"===o||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(o)?t(e,r):void 0}}(e)||function(){throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}()}function o(e,t,r){return t in e?Object.defineProperty(e,t,{value:r,enumerable:!0,configurable:!0,writable:!0}):e[t]=r,e}e.n=function(t){var r=t&&t.__esModule?function(){return t.default}:function(){return t};return e.d(r,{a:r}),r},e.d=function(t,r){for(var o in r)e.o(r,o)&&!e.o(t,o)&&Object.defineProperty(t,o,{enumerable:!0,get:r[o]})},e.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)};var i=window.ctEvents,n=e.n(i),a=window.blocksyCustomizerSync;function c(e,t){var r=Object.keys(e);if(Object.getOwnPropertySymbols){var o=Object.getOwnPropertySymbols(e);t&&(o=o.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),r.push.apply(r,o)}return r}function l(e){for(var t=1;t<arguments.length;t++){var r=null!=arguments[t]?arguments[t]:{};t%2?c(Object(r),!0).forEach((function(t){o(e,t,r[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(r)):c(Object(r)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(r,t))}))}return e}n().on("ct:customizer:sync:collect-variable-descriptors",(function(e){var t,r;e.result=l(l(l({},e.result),{},(o(t={},"".concat(s,"_filter_items_horizontal_spacing"),{selector:(0,a.applyPrefixFor)(".ct-dynamic-filter",s),variable:"items-horizontal-spacing",responsive:!0,unit:"px"}),o(t,"".concat(s,"_filter_items_vertical_spacing"),{selector:(0,a.applyPrefixFor)(".ct-dynamic-filter",s),variable:"items-vertical-spacing",responsive:!0,unit:"px"}),o(t,"".concat(s,"_filter_container_spacing"),{selector:(0,a.applyPrefixFor)(".ct-dynamic-filter",s),variable:"container-spacing",responsive:!0,unit:"px"}),o(t,"".concat(s,"_horizontal_alignment"),{selector:(0,a.applyPrefixFor)(".ct-dynamic-filter",s),variable:"filter-items-alignment",unit:"",responsive:!0}),t),(0,a.typographyOption)({id:"".concat(s,"_filter_font"),selector:(0,a.applyPrefixFor)(".ct-dynamic-filter",s)})),{},(o(r={},"".concat(s,"_filter_font_color"),[{selector:(0,a.applyPrefixFor)('.ct-dynamic-filter[data-type="simple"]',s),variable:"theme-link-initial-color",type:"color:default"},{selector:(0,a.applyPrefixFor)('.ct-dynamic-filter[data-type="simple"]',s),variable:"theme-link-hover-color",type:"color:hover"},{selector:(0,a.applyPrefixFor)('.ct-dynamic-filter[data-type="buttons"]',s),variable:"theme-link-initial-color",type:"color:default_2"},{selector:(0,a.applyPrefixFor)('.ct-dynamic-filter[data-type="buttons"]',s),variable:"theme-link-hover-color",type:"color:hover_2"}]),o(r,"".concat(s,"_filter_button_color"),[{selector:(0,a.applyPrefixFor)('.ct-dynamic-filter[data-type="buttons"]',s),variable:"theme-button-background-initial-color",type:"color:default"},{selector:(0,a.applyPrefixFor)('.ct-dynamic-filter[data-type="buttons"]',s),variable:"theme-button-background-hover-color",type:"color:hover"}]),o(r,"".concat(s,"_filter_button_padding"),{selector:(0,a.applyPrefixFor)('.ct-dynamic-filter[data-type="buttons"]',s),type:"spacing",variable:"padding",responsive:!0,unit:""}),o(r,"".concat(s,"_filter_button_border_radius"),{selector:(0,a.applyPrefixFor)('.ct-dynamic-filter[data-type="buttons"]',s),type:"spacing",variable:"theme-border-radius",responsive:!0}),r))}));var s=(0,a.getPrefixFor)({allowed_prefixes:["blog","woo_categories"],default_prefix:"blog"});function p(e,t){var r=Object.keys(e);if(Object.getOwnPropertySymbols){var o=Object.getOwnPropertySymbols(e);t&&(o=o.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),r.push.apply(r,o)}return r}function f(e){for(var t=1;t<arguments.length;t++){var r=null!=arguments[t]?arguments[t]:{};t%2?p(Object(r),!0).forEach((function(t){o(e,t,r[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(r)):p(Object(r)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(r,t))}))}return e}(0,a.watchOptionsWithPrefix)({getPrefix:function(){return s},getOptionsForPrefix:function(){return["".concat(s,"_filter_visibility"),"".concat(s,"_filter_type")]},render:function(){r(document.querySelectorAll(".ct-dynamic-filter")).map((function(e){(0,a.responsiveClassesFor)((0,a.getOptionFor)("filter_visibility",s),e),e.closest("main").classList.add("ct-no-transition"),requestAnimationFrame((function(){e.dataset.type=(0,a.getOptionFor)("filter_type",s),setTimeout((function(){e.closest("main").classList.remove("ct-no-transition")}))}))}))}});var u=(0,a.getPrefixFor)();n().on("ct:customizer:sync:collect-variable-descriptors",(function(e){var t;e.result=f(f({},e.result),{},(o(t={},"".concat(u,"_read_progress_height"),[{selector:(0,a.applyPrefixFor)(".ct-read-progress-bar",u),variable:"progress-bar-height",unit:"px"}]),o(t,"".concat(u,"_progress_bar_filled_color"),[{selector:(0,a.applyPrefixFor)(".ct-read-progress-bar",u),variable:"progress-bar-scroll",type:"color:default",responsive:!0}]),o(t,"".concat(u,"_progress_bar_background_color"),[{selector:(0,a.applyPrefixFor)(".ct-read-progress-bar",u),variable:"progress-bar-background",type:"color:default",responsive:!0}]),t))})),(0,a.watchOptionsWithPrefix)({getPrefix:function(){return u},getOptionsForPrefix:function(){return["".concat(u,"_read_progress_visibility"),"".concat(u,"_has_auto_hide")]},render:function(){r(document.querySelectorAll(".ct-read-progress-bar")).map((function(e){(0,a.responsiveClassesFor)((0,a.getOptionFor)("read_progress_visibility",u),e),e.classList.remove("ct-auto-hide"),"yes"===(0,a.getOptionFor)("has_auto_hide",u)&&e.classList.add("ct-auto-hide")}))}})}();