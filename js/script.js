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
    var httpRequest,
        uploadForm = document.forms[0],
        formdata = new FormData(uploadForm);

    formdata.append("submit", "1");

    httpRequest = new XMLHttpRequest();

    httpRequest.upload.addEventListener("onloadend", finishedLoading);
    httpRequest.upload.addEventListener("progress", progressUpdate);

    try {
        httpRequest.open("POST", "php/user_image_upload.php", true);
        httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        httpRequest.send(formdata);
    } catch (e){
        document.getElementById("demo").innerHTML = "httpRequest.send error : " + e;
    }




    function progressUpdate(event) {
        if(event.lengthComputable) {
            var percent = event.loaded / event.total * 100;
            document.getElementById("progress").innerHTML = percent+ "%";
        }
    }

    function finishedLoading() {

debugger;

        if (httpRequest.readyState == 4 && httpRequest.status == 200) {
            var res = httpRequest.responseText;
        }else {
            var res = "An error occured. ERROR : " + httpRequest.statusText;
        }
        document.getElementById("demo").innerHTML = res;
    }
}
