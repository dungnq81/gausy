/******/ (function() { // webpackBootstrap
/*!*******************************************************!*\
  !*** ./wp-content/themes/gausy/resources/js/admin.js ***!
  \*******************************************************/
jQuery(function ($) {
  // Pace
  $(document).ajaxStart(function () {
    Pace.restart();
  });

  // user
  var create_user = $('#createuser');
  create_user.find('#send_user_notification').removeAttr('checked').attr('disabled', true);
});
/******/ })()
;
//# sourceMappingURL=admin.js.map