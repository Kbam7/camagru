"use strict";

// Timeout variables
var class_tO, remove_tO;

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

    // Select switch for upload/webcam
    var toggleSwitch = document.getElementById("toggleSwitch");
    if (toggleSwitch) {

        toggleSwitch.addEventListener('click', function(){
            if (this.getAttribute('checked') == "true"){
                this.removeAttribute('checked');
            } else {
                this.setAttribute('checked', "true")
            }
            if (this.getAttribute('checked') == "true"){
                //alert("Its been checked");
                this.parentElement.nextElementSibling.innerHTML = "Webcam : ON";
            } else {
                //alert("Its NOT YET checked");
                this.parentElement.nextElementSibling.innerHTML = "Webcam : OFF"
            }
        });
    }

    // Select Error div for observation
    var errorDiv = document.getElementById("form-errors");
    if (errorDiv) {
        observeErrors(errorDiv);
    }

    // Submit event for image upload form
    var imageUploadForm = document.querySelector("#imageUploadForm");
    if (imageUploadForm) {
        imageUploadForm.addEventListener('submit', function(e) {
            e.preventDefault();
            clearTimeout(class_tO);
            clearTimeout(remove_tO);
            ajax_upload_image();
        });
    }

    //  Functionality for camera
    activateUsersCamera();

}

function observeErrors(errorDiv) {

    // Vendor specific aliases for 'MutationObserver'
    var MutationObserver = window.MutationObserver || window.WebKitMutationObserver || window.MozMutationObserver;

    // create an observer instance
    var observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
                var newNodes = mutation.addedNodes;
                console.log(newNodes);
                class_tO = setTimeout(function(){
                    for (let i = 0; i < newNodes.length; ++i){
                        newNodes[i].className += " scale-out";
                    }
                    remove_tO = setTimeout(function(){
                        while (errorDiv.children.length){
                            errorDiv.removeChild(errorDiv.children[0]);
                        }
                    }, 2000);
                }, 10000);
        })
    });

    // configuration of the observer:
    var config = { attributes: true, childList: true, characterData: true };

    // pass in the target node, as well as the observer options
    observer.observe(errorDiv, config);
}

// Function for uploading webcam images
function ajax_upload_webcam_image(data) {
    var httpRequest;

    formdata.append("submit", "1");

    httpRequest = new XMLHttpRequest();

    httpRequest.upload.addEventListener("progress", uploadProgress);
    httpRequest.upload.addEventListener("loadstart", uploadStarted);
    httpRequest.upload.addEventListener("load", uploadSuccess);
    httpRequest.upload.addEventListener("loadend", uploadFinished);
    httpRequest.upload.addEventListener("abort", uploadAborted);
    httpRequest.upload.addEventListener("error", uploadError);
    document.getElementById("cancelUploadBtn").addEventListener("click", cancelUpload)

    try {
        httpRequest.open("POST", "php/webcam_image_upload.php", true);
        httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        httpRequest.send(formdata);
    } catch (e) {
        document.getElementById("form-errors").innerHTML = "httpRequest.send error : " + e;
    }




    function uploadProgress(event) {
        if (event.lengthComputable) {
            let percent = event.loaded / event.total * 100;
            document.getElementById("progress").setAttribute("value", percent.toFixed(1));
            document.querySelector("progress[value]").setAttribute("data-content", percent.toFixed(1) + "%");

        }
    }

    function uploadStarted(event) {
        document.querySelector("#imageUploadForm .image-upload-fields").className += " hidden absolute";
        let items = document.querySelector("#imageUploadForm").children;
        for (let item of items) {
            if (item.classList.contains("during-upload")){
                item.setAttribute("style", "display: inline-block;");
            }
        }
    }

    function uploadSuccess(event) {
        httpRequest.onreadystatechange = function() {
            if (httpRequest.readyState == 4 && httpRequest.status == 200) {
                let res = httpRequest.responseText;
                document.getElementById("form-errors").innerHTML = res;
            }
        };
    }

    function uploadFinished(event){
        document.querySelector("#imageUploadForm .image-upload-fields.hidden").className = "image-upload-fields";
        document.getElementById("progress").value = "0";
        document.querySelector("progress[value]").setAttribute("data-content", "");
        let items = document.querySelector("#imageUploadForm").children;
        for (let item of items) {
            if (item.classList.contains("during-upload")){
                item.removeAttribute("style");
            }
        }
    }

    function uploadAborted(event) {
        console.log("User aborted file upload or the connection was lost. ERROR : " + event.message);
    }

    function uploadError(event) {
        console.log("An error has occured. ERROR : " + event.message);
    }

    function cancelUpload() {
        httpRequest.abort();
    }

}


// Function for uploading users images
function ajax_upload_image( /*url, data*/ ) {
    var httpRequest,
        uploadForm = document.forms[0],
        formdata = new FormData(uploadForm);

    formdata.append("submit", "1");

    httpRequest = new XMLHttpRequest();

    httpRequest.upload.addEventListener("progress", uploadProgress);
    httpRequest.upload.addEventListener("loadstart", uploadStarted);
    httpRequest.upload.addEventListener("load", uploadSuccess);
    httpRequest.upload.addEventListener("loadend", uploadFinished);
    httpRequest.upload.addEventListener("abort", uploadAborted);
    httpRequest.upload.addEventListener("error", uploadError);
    document.getElementById("cancelUploadBtn").addEventListener("click", cancelUpload)

    try {
        httpRequest.open("POST", "php/user_image_upload.php", true);
        //        httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        httpRequest.send(formdata);
    } catch (e) {
        document.getElementById("form-errors").innerHTML = "httpRequest.send error : " + e;
    }




    function uploadProgress(event) {
        if (event.lengthComputable) {
            let percent = event.loaded / event.total * 100;
            document.getElementById("progress").setAttribute("value", percent.toFixed(1));
            document.querySelector("progress[value]").setAttribute("data-content", percent.toFixed(1) + "%");

        }
    }

    function uploadStarted(event) {
        document.querySelector("#imageUploadForm .image-upload-fields").className += " hidden absolute";
        let items = document.querySelector("#imageUploadForm").children;
        for (let item of items) {
            if (item.classList.contains("during-upload")){
                item.setAttribute("style", "display: inline-block;");
            }
        }
    }

    function uploadSuccess(event) {
        httpRequest.onreadystatechange = function() {
            if (httpRequest.readyState == 4 && httpRequest.status == 200) {
                let res = httpRequest.responseText;
                document.getElementById("form-errors").innerHTML = res;
            }
        };
    }

    function uploadFinished(event){
        document.querySelector("#imageUploadForm .image-upload-fields.hidden").className = "image-upload-fields";
        document.getElementById("progress").value = "0";
        document.querySelector("progress[value]").setAttribute("data-content", "");
        let items = document.querySelector("#imageUploadForm").children;
        for (let item of items) {
            if (item.classList.contains("during-upload")){
                item.removeAttribute("style");
            }
        }
    }

    function uploadAborted(event) {
        console.log("User aborted file upload or the connection was lost. ERROR : " + event.message);
    }

    function uploadError(event) {
        console.log("An error has occured. ERROR : " + event.message);
    }

    function cancelUpload() {
        httpRequest.abort();
    }

}
