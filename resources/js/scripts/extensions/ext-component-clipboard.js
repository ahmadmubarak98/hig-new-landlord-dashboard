/*=========================================================================================
    File Name: ext-component-clipboard.js
    Description: Copy to clipboard
    --------------------------------------------------------------------------------------
    Item Name: HIG  - Vuejs, HTML & Laravel Admin Dashboard Template
    Author: sensejo
    Author URL: http://www.themeforest.net/user/sensejo
==========================================================================================*/

'use strict';

var userText = $('#copy-to-clipboard-input');
var btnCopy = $('#btn-copy');

// copy text on click
btnCopy.on('click', function () {
  userText.select();
  document.execCommand('copy');
  toastr['success']('', 'Copied to clipboard!');
});
