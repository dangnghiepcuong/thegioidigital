import './bootstrap';

import.meta.glob([
  '../images/**',
  '../fonts/**',
]);

import $ from 'jquery';
window.jQuery = $;
export default $;

$('body').click(function (event) {
  if ($(event.target).closest('.filter').length === 0) {
    $('.layout-filter .filter .pointer-arrow').css('display', 'none')
    $('.layout-filter .filter .layout-panel-dropdown').css('display', 'none')
  }
})
