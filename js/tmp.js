"use strict";
window.onload = function() {

// --- Global events ---

    // Add animation to input elements
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


// --- NON-Global events ---

    // Submit event for image upload form
    var imageUploadForm = document.querySelector("#imageUploadForm");
    if (imageUploadForm){
        imageUploadForm.addEventListener('submit', function(e) {
            e.preventDefault();
            ajax_upload_image();
        });
    }

//  Functionality for camera
    activateUsersCamera();

}

function ajax_upload_image(/*url, data*/) {
    var httpRequest;

    httpRequest = new XMLHttpRequest();
    httpRequest.open("POST", "php/image_upload.php", true);
    httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

debugger;

    var userfile = encodeURIComponent(document.forms[0]['fileToUpload'].value);
    var data = "image="+userfile;

    httpRequest.onreadystatechange = function() {
        if (httpRequest.readyState == 4 && httpRequest.status == 200) {
            debugger;
            var res = httpRequest.responseText;
            document.getElementById("demo").innerHTML = res;
        }
    };

    try {
        httpRequest.send(data);
    } catch (e){
        document.getElementById("demo").innerHTML = "httpRequest.send error : " + e;
    }
}
