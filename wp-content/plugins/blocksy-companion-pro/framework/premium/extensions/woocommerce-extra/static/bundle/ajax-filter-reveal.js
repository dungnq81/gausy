!function(){"use strict";var e={n:function(t){var n=t&&t.__esModule?function(){return t.default}:function(){return t};return e.d(n,{a:n}),n},d:function(t,n){for(var o in n)e.o(n,o)&&!e.o(t,o)&&Object.defineProperty(t,o,{enumerable:!0,get:n[o]})},o:function(e,t){return Object.prototype.hasOwnProperty.call(e,t)}},t=window.ctFrontend,n=window.ctEvents,o=e.n(n),r={},i=function(e){return r[e]?new Promise((function(t){t(r[e]),r[e]=r[e].clone()})):new Promise((function(t){return fetch(e,{headers:{"X-Requested-With":"XMLHttpRequest"}}).then((function(n){t(n),r[e]=n.clone()}))}))},c=function(e){var t=new URLSearchParams(location.search);window.wp&&window.wp.customize&&(t.append("filter_panel_position",wp.customize("filter_panel_position")()),t.append("filter_source",wp.customize("filter_source")())),t.append("blocksy_ajax","yes");var n="".concat(location.origin).concat(location.pathname,"?").concat(t.toString());return{isCached:!!r[n],fetch:function(){return new Promise((function(e){i(n).then((function(e){return e.text()})).then((function(t){var n=(new DOMParser).parseFromString(t,"text/html");e(n.querySelector("#woo-filters-panel"))}))}))}}},a=function(e){var t=e.event,n=(e.el,e.completeAction);if(document.querySelector("#woo-filters-panel")){var r=document.querySelector("#woo-filters-panel");n({finalState:"",onCompleted:function(){o().trigger("ct:overlay:handle-click",{event:t,options:{openStrategy:"fast",container:r}})}})}else{c().fetch().then((function(e){n({finalState:"",onCompleted:function(){document.querySelector(".ct-drawer-canvas").appendChild(e);var n=document.querySelector("#woo-filters-panel");setTimeout((function(){o().trigger("ct:overlay:handle-click",{event:t,options:{openStrategy:"fast",container:n}}),function(e,t){o().trigger("blocksy:frontend:init"),setTimeout((function(){o().trigger("ct:overlay:handle-click",{e:t,href:"#".concat(e.id),options:{openStrategy:"skip",isModal:!0,computeScrollContainer:function(){return e.closest("body")?e.querySelector(".ct-panel-content-inner"):null},clickOutside:!0,focus:!1}})}))}(n,t)}),10)}})}))}};(0,t.registerDynamicChunk)("blocksy_ext_woo_extra_filters_ajax_reveal",{mount:function(e,t){var n=t.event,r=t.completeAction;(n.preventDefault(),n.stopPropagation(),e.dataset.togglePanel)?a({event:n,el:e,completeAction:r}):c().fetch().then((function(t){r({finalState:"",onCompleted:function(){!function(e,t){document.querySelector("#woo-filters-panel").innerHTML=e.innerHTML;var n=t.cloneNode(!0);n.classList.add("ct-expandable-trigger"),n.setAttribute("aria-expanded","true"),t.parentNode.replaceChild(n,t),setTimeout((function(){o().trigger("blocksy:frontend:init"),n.click()}),200)}(t,e)}})}))},maybeGetPanelContent:function(e,t){t.event;return new Promise((function(e){e("")}))}})}();