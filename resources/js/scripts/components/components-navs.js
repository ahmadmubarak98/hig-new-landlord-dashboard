/*=========================================================================================
    File Name: navs.js
    Description: Navigation available in Bootstrap share general markup and styles, from the base .nav class to the active and disabled states. Swap modifier classes to switch between each style.
    ----------------------------------------------------------------------------------------
    Item Name: HIG  - Vuejs, HTML & Laravel Admin Dashboard Template
    Author: sensejo
    Author URL: http://www.themeforest.net/user/sensejo
==========================================================================================*/
(function (window, document, $) {
  'use strict';

  var heightLeft = $('.nav-left + .tab-content').height();
  $('ul.nav-left').height(heightLeft);
  var heightRight = $('.nav-right + .tab-content').height();
  $('ul.nav-right').height(heightRight);
})(window, document, jQuery);
