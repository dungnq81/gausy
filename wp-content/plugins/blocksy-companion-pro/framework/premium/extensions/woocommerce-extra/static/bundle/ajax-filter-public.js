!function(){"use strict";var e={};function t(e,t){(null==t||t>e.length)&&(t=e.length);for(var r=0,n=new Array(t);r<t;r++)n[r]=e[r];return n}function r(e,r){if(e){if("string"==typeof e)return t(e,r);var n=Object.prototype.toString.call(e).slice(8,-1);return"Object"===n&&e.constructor&&(n=e.constructor.name),"Map"===n||"Set"===n?Array.from(e):"Arguments"===n||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)?t(e,r):void 0}}function n(e,t){return function(e){if(Array.isArray(e))return e}(e)||function(e,t){var r=null==e?null:"undefined"!=typeof Symbol&&e[Symbol.iterator]||e["@@iterator"];if(null!=r){var n,a,o=[],i=!0,c=!1;try{for(r=r.call(e);!(i=(n=r.next()).done)&&(o.push(n.value),!t||o.length!==t);i=!0);}catch(e){c=!0,a=e}finally{try{i||null==r.return||r.return()}finally{if(c)throw a}}return o}}(e,t)||r(e,t)||function(){throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}()}function a(e){return function(e){if(Array.isArray(e))return t(e)}(e)||function(e){if("undefined"!=typeof Symbol&&null!=e[Symbol.iterator]||null!=e["@@iterator"])return Array.from(e)}(e)||r(e)||function(){throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}()}e.n=function(t){var r=t&&t.__esModule?function(){return t.default}:function(){return t};return e.d(r,{a:r}),r},e.d=function(t,r){for(var n in r)e.o(r,n)&&!e.o(t,n)&&Object.defineProperty(t,n,{enumerable:!0,get:r[n]})},e.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)};var o=window.ctFrontend,i=window.ctEvents,c=e.n(i);function u(e,t,r){return t in e?Object.defineProperty(e,t,{value:r,enumerable:!0,configurable:!0,writable:!0}):e[t]=r,e}function l(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}function s(e,t){for(var r=0;r<t.length;r++){var n=t[r];n.enumerable=n.enumerable||!1,n.configurable=!0,"value"in n&&(n.writable=!0),Object.defineProperty(e,n.key,n)}}function d(e,t,r){return t&&s(e.prototype,t),r&&s(e,r),Object.defineProperty(e,"prototype",{writable:!1}),e}var f=function(){function e(){l(this,e),u(this,"id","toggle-filter-panel")}return d(e,[{key:"beforeReplace",value:function(){var e=document.querySelector(".woo-listing-top");return{wasTopExanded:e&&!!e.querySelector('.ct-toggle-filter-panel[aria-expanded="true"]')}}},{key:"afterReplace",value:function(e){var t=e.wasTopExanded,r=document.querySelector(".ct-products-container").parentNode;if(r.querySelector(".ct-filter-content")){r.querySelector(".ct-toggle-filter-panel")?r.querySelector(".ct-toggle-filter-panel").ariaExpanded=t:t=!1;var n=r.querySelector("#woo-filters-panel");n&&(n.ariaHidden=!t)}}}]),e}(),p=function(){function e(){l(this,e),u(this,"id","pagination")}return d(e,[{key:"beforeReplace",value:function(){var e=document.querySelector(".ct-pagination");e&&(e.infiniteScroll&&e.infiniteScroll.destroy(),e.remove())}},{key:"afterReplace",value:function(){}}]),e}(),m=function(e){for(var t=[],r=e;r&&r!==document;r=r.parentNode)t.push(r);return(t=t.reverse()).filter((function(e){return!e.matches("body, html")})).map((function(t){if(t===document.body)return"body";var r=t.tagName;if(t!==e&&(r+=""!=t.id?"#"+t.id:"",r+=t.dataset.target?'[data-target="'.concat(t.dataset.target,'"]'):""),t.className)for(var n=t.className.split(/\s/),a=0;a<n.length;a++)n[a]&&"active"!==n[a]&&"ct-active"!==n[a]&&(r+="."+n[a]);return r})).join(" > ")},v=function(){function e(){l(this,e),u(this,"id","search")}return d(e,[{key:"beforeReplace",value:function(){return{previousSearchInputValue:a(document.querySelectorAll('.ct-filter-search input[type="search"]')).map((function(e){return{selector:m(e),value:e.value}})).filter((function(e){return e.value}))}}},{key:"afterReplace",value:function(e){var t=e.previousSearchInputValue;(void 0===t?[]:t).map((function(e){var t=e.selector,r=e.value,n=document.querySelector(t);n&&(n.value=r,ctEvents.trigger("blocksy:filters:search",{el:n,value:r}))}))}}]),e}(),y=function(){function e(){l(this,e),u(this,"id","accordions")}return d(e,[{key:"getAllExpandables",value:function(){return a(document.querySelectorAll(".ct-filter-item-inner .ct-expandable-trigger, .ct-block-wrapper > .ct-expandable-trigger"))}},{key:"generateElIdentifier",value:function(e){return{selector:m(e),text:(e.innerText||e.parentNode.innerText).replace(/[\(\)0-9]/g,"")}}},{key:"elementMatchesIdentifier",value:function(e,t){var r=(e.innerText||e.parentNode.innerText).replace(/[\(\)0-9]/g,"");return t.text===r&&e.matches(t.selector)}},{key:"beforeReplace",value:function(){var e=this;return{allTriggersStates:this.getAllExpandables().map((function(t){return e.generateElIdentifier(t)})),previousExpandedTriggersStates:this.getAllExpandables().filter((function(e){return"true"===e.ariaExpanded})).map((function(t){return e.generateElIdentifier(t)}))}}},{key:"afterReplace",value:function(e){var t=this,r=e.previousExpandedTriggersStates,n=e.allTriggersStates;this.getAllExpandables().map((function(e){if(n.some((function(r){return t.elementMatchesIdentifier(e,r)}))){var a="true"===e.ariaExpanded,o=r.some((function(r){return t.elementMatchesIdentifier(e,r)}));if(!a||!o){e.ariaExpanded=o?"true":"false";var i=function(e){if(e.hasAttribute("data-target"))return document.querySelector(e.getAttribute("data-target"));var t=e.parentNode.querySelector("[aria-hidden]");if(t)return t;var r=e.parentNode.parentNode.querySelector("[aria-hidden]");return r||null}(e);i&&(i.ariaHidden=o?"false":"true")}}}))}}]),e}();function h(e,t){var r=Object.keys(e);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(e);t&&(n=n.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),r.push.apply(r,n)}return r}function g(e){for(var t=1;t<arguments.length;t++){var r=null!=arguments[t]?arguments[t]:{};t%2?h(Object(r),!0).forEach((function(t){u(e,t,r[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(r)):h(Object(r)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(r,t))}))}return e}var b=[new f,new p,new v,new y],S=function(e){return e.querySelector(".ct-filter-widget")||e.className.includes("ct-active-filters")||e.querySelector(".ct-active-filters")||e.querySelector(".ct-price-filter")},w=function(e){var t=document.createElement("div");t.innerHTML=e;var r=a(new Set(Array.from(document.querySelectorAll(".ct-filter-widget, .ct-price-filter, .ct-active-filters")).map((function(e){var t=null;return e.closest(".ct-block-wrapper")&&(t=e.closest(".ct-block-wrapper").parentNode),e.closest(".ct-widget")&&(t=e.closest(".ct-widget").parentNode),t?m(t):null})).filter((function(e){return e})))),n=function(e){var t=b.reduce((function(e,t){var r=t.beforeReplace();return g(g({},e),r?u({},t.id,r):{})}),{});return document.body.insertAdjacentHTML("beforeend",'<div class="ct-tmp-filter-buffer"></div>'),e.map((function(e){var t=document.querySelector(e);t&&a(t.children).map((function(e){S(e)?e.remove():document.querySelector(".ct-tmp-filter-buffer").appendChild(e)}))})),t}(r);!function(e,t){var r=document.querySelector(".ct-products-container").parentNode,n=null;e.querySelector(".ct-products-container")&&(n=e.querySelector(".ct-products-container").parentNode),n||(n=e.querySelector(".ct-no-results").parentNode),n&&(a(r.children).map((function(e){e.matches(".ct-products-container")?a(e.children).map((function(e){e.matches(".ct-filters-loading")||e.remove()})):e.remove()})),a(n.children).map((function(e){if(e.matches(".ct-products-container")){var t=r.querySelector(".ct-products-container");return a(e.children).map((function(e){e.matches(".ct-filters-loading")||t.appendChild(e)})),void r.appendChild(t)}r.insertAdjacentHTML("beforeend",e.outerHTML)})),t.map((function(t){var r=e.querySelector(t),n=document.querySelector(t);r&&n&&(n.innerHTML="",a(r.children).map((function(e){if(S(e))n.insertAdjacentHTML("beforeend",e.outerHTML);else if(e.id){var t=document.querySelector(".ct-tmp-filter-buffer #".concat(e.id));t&&n.appendChild(t)}})))})))}(t,r),function(e){if(e.previousExpandedTriggersStates){var t=e.previousExpandedTriggersStates.map((function(e){return document.querySelector(e)})).filter((function(e){return e})),r=e.previousExpandedTriggersStates.map((function(e){return document.querySelector(e)})).filter((function(e){return e}));a(document.querySelectorAll(".ct-filter-item-inner .ct-expandable-trigger, .ct-block-wrapper > .ct-expandable-trigger")).map((function(e){if(("true"!==e.ariaExpanded||!r.includes(e))&&t.includes(e)){e.ariaExpanded="false";var n=e.dataset.target;if(document.querySelector(n)&&(document.querySelector(n).ariaHidden="true"),r.includes(e)){e.ariaExpanded="true";var a=e.dataset.target;document.querySelector(a)&&(document.querySelector(a).ariaHidden="false")}}}))}document.querySelector(".ct-tmp-filter-buffer").remove(),b.forEach((function(t){var r=e[t.id]?e[t.id]:{};t.afterReplace(r)}))}(n)},q={},x=function(e){var t=new URL(e);t.searchParams.delete("blocksy_ajax"),window.history.replaceState({},"",t.toString())},k=function(e){return new Promise((function(t){var r=document.querySelector(".ct-products-container");document.querySelector('[data-ajax-filters*="scroll"]')&&r&&r.closest(".ct-container")&&r.closest(".ct-container").getBoundingClientRect().top<0&&function(e){if(e){var t=window.scrollY,r=null,n=function n(a){r||(r=a);var i=a-r,c=e.getBoundingClientRect(),u=0,l=document.querySelector("[data-sticky*=yes], [data-sticky*=fixed]");l&&(u=parseFloat(getComputedStyle(l).top)||0);var s,d,f,p=window.scrollY+c.top-(parseFloat(getComputedStyle(document.body).getPropertyValue("--header-sticky-height"))||0)-20-u,m=Math.max((s=i,d=t,f=-t,(s/=350)<1?f/2*s*s+d:-f/2*(--s*(s-2)-1)+d),p);o.areWeDealingWithSafari?(scrollTo(0,m),i<700&&requestAnimationFrame(n)):scrollTo(0,p)};o.areWeDealingWithSafari?requestAnimationFrame(n):n(0)}}(r.closest(".ct-container"));var n=document.querySelector(".ct-filters-loading");!e&&n&&n.classList.add("active"),r.dataset.animate="leave:start",requestAnimationFrame((function(){r.dataset.animate="leave:end",T(a(r.children).find((function(e){return e.matches("[data-products], .woocommerce-no-products-found")})),(function(){r.dataset.animate="leave",t()}))}))}))},A=function(e){var t=new URL(e,location.href);t.searchParams.delete("blocksy_ajax"),e=t.toString(),window.history.pushState({},document.title,e)},E=function(e,t){return new Promise((function(r){(function(e){var t=arguments.length>1&&void 0!==arguments[1]&&arguments[1];return q[e]?new Promise((function(t){t(q[e]);var r=q[e].silent_redirect;r&&x(q[e].url),window.ct_customizer_localizations||(q[e]=q[e].clone(),q[e].silent_redirect=r)})):new Promise((function(r){return fetch(e,{headers:{"X-Requested-With":"XMLHttpRequest"}}).then((function(n){if(n.redirected){if(!t)return void window.location.replace(n.url);x(n.url)}r(n),window.ct_customizer_localizations||(q[e]=n.clone(),q[e].silent_redirect=t)}))}))})(e,t).then((function(e){return e.text()})).then((function(e){w(e),r()}))}))},j=function(e,t){var r=!!q[e];k(r).then((function(){E(e,t).then((function(){setTimeout((function(){!function(){var e=document.querySelector(".ct-filters-loading");if(e){var t=function(){var e=document.querySelector(".ct-products-container");e.dataset.animate="appear:start",requestAnimationFrame((function(){e.dataset.animate="appear:end",T(a(e.children).find((function(e){return e.matches("[data-products], .woocommerce-no-products-found")})),(function(){e.removeAttribute("data-animate")}))})),c().trigger("blocksy:frontend:init")};e.classList.contains("active")?(e.classList.remove("active"),T(e,(function(){t()}))):t()}}()}),50)}))}))};function T(e,t){var r=function(){e.removeEventListener("transitionend",n),t()},n=function(t){t.target===e&&r()};e.addEventListener("transitionend",n)}(0,o.registerDynamicChunk)("blocksy_ext_woo_extra_ajax_filters",{mount:function(e,t){var r=t.event,o=document.querySelector('[data-ajax-filters*="yes"]');if("INPUT"===e.tagName&&"checkbox"===e.type&&"change"===r.type){var i=e.closest(".ct-filter-item").querySelector("a");if(!o)return void(window.location.href=i.getAttribute("href"));e=i}if("A"===e.tagName){var c=e.closest(".ct-filter-item");if(c&&(c.classList.contains("active")?c.classList.remove("active"):c.classList.add("active")),e.closest(".ct-filter-item")){var u=e.closest(".ct-filter-item").querySelector('[type="checkbox"]');if(u){u.getAttribute("checked")?(u.checked=!1,u.removeAttribute("checked")):(u.checked=!0,u.setAttribute("checked","checked"));var l=u.cloneNode(!0);u.parentNode.replaceChild(l,u)}}if(!o)return void(window.location.href=e.getAttribute("href"))}if("FORM"!==e.tagName&&o){if("SELECT"===e.tagName&&e.closest(".woocommerce-ordering")){var s=new URL(window.location.href);a(new FormData(e.closest(".woocommerce-ordering")).entries()).map((function(e){var t=n(e,2),r=t[0],a=t[1];"paged"!==r&&s.searchParams.set(r,a)}));var d=new URLSearchParams(s.search);d.set("blocksy_ajax","yes");var f="".concat(s.origin).concat(s.pathname,"?").concat(d.toString());return A(f),void j(f)}var p=e.getAttribute("href"),m=!1;if(e.classList.contains("page-numbers")){var v=new URL(p),y=new URLSearchParams(v.search);y.set("blocksy_ajax","yes"),p="".concat(v.origin).concat(v.pathname,"?").concat(y.toString()),m=!0}A(p),j(p,m)}}}),window.addEventListener("popstate",(function(e){e.state&&j(window.location.href)}),!1)}();