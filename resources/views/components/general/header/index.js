import { popupLocationSelect } from '/resources/js/animation';

window.popupLocationSelect = popupLocationSelect;

setInterval(function(){
    document.querySelector('#slider-advertise .next').click();
},3000);
