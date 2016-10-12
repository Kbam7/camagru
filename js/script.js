"use strict";
window.onload = function() {

    //  Get input elements and add focus and blur events
    var formInputList = document.querySelectorAll('input[type=text], input[type=password]');
    for (var i = 0; i < formInputList.length; ++i) {
        formInputList[i].addEventListener('click', function() {
            this.previousElementSibling.className = 'fade-in-up medium';
        });
        formInputList[i].addEventListener('blur', function() {
            var item = this;
            item.previousElementSibling.className = 'fade-out-down medium';
            setTimeout(function() {
                item.previousElementSibling.className = '';
            }, 750);
        });
    }

    //  Functionality for camera
    activateUsersCamera();

}
