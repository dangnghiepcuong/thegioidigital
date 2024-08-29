import { navigateSlider } from '/resources/js/animation';

window.navigateSlider = navigateSlider;

import $ from 'jquery';
window.jQuery = $;
export default $;

setInterval(function(){
    document.querySelector('#nav-slider-dual-banner .next').click();
},3000);
