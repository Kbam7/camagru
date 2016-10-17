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
    if (imageUploadForm) {
        imageUploadForm.addEventListener('submit', function(e) {
            e.preventDefault();
            ajax_upload_image();
        });
    }

    //  Functionality for camera
    activateUsersCamera();

}

function ajax_upload_image( /*url, data*/ ) {
    var httpRequest,
        uploadForm = document.forms[0],
        formdata = new FormData(uploadForm);

    formdata.append("submit", "1");

    httpRequest = new XMLHttpRequest();

    httpRequest.upload.addEventListener("progress", progressUpdate);
    httpRequest.upload.addEventListener("load", finishedLoading);
    httpRequest.upload.addEventListener("abort", uploadAborted);
    httpRequest.upload.addEventListener("error", uploadError);

    try {
        httpRequest.open("POST", "php/user_image_upload.php", true);
        //        httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        httpRequest.send(formdata);
    } catch (e) {
        document.getElementById("form-errors").innerHTML = "httpRequest.send error : " + e;
    }




    function progressUpdate(event) {
        if (event.lengthComputable) {
            var percent = event.loaded / event.total * 100;
            document.getElementById("progress").innerHTML = percent.toFixed(1) + "%";
        }
    }

    function finishedLoading(event) {
        httpRequest.onreadystatechange = function() {
            if (httpRequest.readyState == 4 && httpRequest.status == 200) {
                var res = httpRequest.responseText;
                document.getElementById("form-errors").innerHTML = res;
            }
        };
    }

    function uploadAborted(event) {
        console.log("User aborted file upload or the connection was lost. ERROR : " + event.message);
    }

    function uploadError(event) {
        console.log("An error has occured. ERROR : " + event.message);
    }

}
