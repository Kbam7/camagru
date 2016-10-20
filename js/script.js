"use strict";

// Timeout variables for error messages
var addClass_timeout, removeError_timeout;

window.onload = function() {


    // Select Error div for observation
    var errorDiv = document.getElementById("error-messages");
    if (errorDiv) {
        observeErrors(errorDiv);
    }

    /* --- Global events --- */

    // Add animation to input elements
    var formInputList = document.querySelectorAll('input[type=text], input[type=password], input[type=email]');
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

    /* --- NON-Global events --- */

    // Submit event for new user form
    var createUserForm = document.querySelector("#createUserForm");
    if (createUserForm) {
        createUserForm.addEventListener('submit', function(e) {
            e.preventDefault();
            createUser();
        });
    }

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

/* --- FUNCTION DEFINITIONS --- */

// Add class to element
function addClass(el, className) {
    if (el.classList && !el.classList.contains(className)) {
        el.classList.add(className);
    }
}

// Remove class from element
function removeClass(el, className) {
    if (el.classList && el.classList.contains(className)) {
        el.classList.remove(className);
    }
}

function createUser() {
    let fname = encodeURIComponent(document.getElementById("fname").value);
    let lname = encodeURIComponent(document.getElementById("lname").value);
    let uname = encodeURIComponent(document.getElementById("uname").value);
    let email = encodeURIComponent(document.getElementById("email").value);
    let passwd = encodeURIComponent(document.getElementById("passwd").value);

    let data = "submit=1" +
        "&fname=" + fname +
        "&lname=" + lname +
        "&uname=" + uname +
        "&email=" + email +
        "&passwd=" + passwd;

    ajax_post("php/create_acc.php", data, function(httpRequest) {
        //        displayError(httpRequest.responseText);
        let response = JSON.parse(httpRequest.responseText);

        debugger;
        console.log(response);

        if (response.status === true) {
            displayError(response.statusMsg + " <p class=\"info\">Redirecting to login page . . .</p>");
            setTimeout(function() {
                window.location = "index.php";
            }, 3000);
        } else {
            displayError(response.statusMsg);
        }
    });
}

// Function for uploading users images
function ajax_upload_image() {
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
        displayError("<p class=\"info\">ajax send error : " + e);
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
            if (item.classList.contains("during-upload")) {
                item.setAttribute("style", "display: inline-block;");
            }
        }
    }

    function uploadSuccess(event) {
        httpRequest.onreadystatechange = function() {
            if (httpRequest.readyState == 4 && httpRequest.status == 200) {
                displayError(httpRequest.responseText);

            }
        };
    }

    function uploadFinished(event) {
        document.querySelector("#imageUploadForm .image-upload-fields.hidden").className = "image-upload-fields";
        document.getElementById("progress").value = "0";
        document.querySelector("progress[value]").setAttribute("data-content", "");
        let items = document.querySelector("#imageUploadForm").children;
        for (let item of items) {
            if (item.classList.contains("during-upload")) {
                item.removeAttribute("style");
            }
        }
    }

    function uploadAborted(event) {
        displayError("<p class=\"warning\">User aborted file upload or the connection was lost. ERROR : " + event.message + "</p>");
    }

    function uploadError(event) {
        displayError("<p class=\"danger\">An error has occured. ERROR : " + event.message + "</p>");
    }

    function cancelUpload() {
        httpRequest.abort();
    }

}

// A lightweight function for ajax POST
function ajax_post(url, data, callback) {
    var httpRequest = new XMLHttpRequest();
    httpRequest.addEventListener("error", function(event) {
        console.log("An error has occured. ERROR : " + event.message);
    });
    httpRequest.addEventListener("readystatechange", function() {
        if (httpRequest.readyState == 4 && httpRequest.status == 200) {
            callback(httpRequest);
        }
    });
    httpRequest.open("POST", url, true);
    httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    httpRequest.send(data);

}

// Function to display errors
function displayError(errMsg) {

    let errDiv = document.getElementById("error-messages");
    clearTimeout(addClass_timeout);
    clearTimeout(removeError_timeout);
    if (errDiv) {
        errDiv.innerHTML = errMsg;
        let msgs = errDiv.childNodes;
        for (let msg of msgs) {
            addClass(msg, "scale-in");
            addClass(msg, "slow");
        }
    }

    // Remove html. i.e. Get text only
    let tmp = document.createElement("div");
    tmp.innerHTML = errMsg;
    errMsg = tmp.textContent || tmp.innerText || "No error message found.";

    console.log(errMsg);
}

function observeErrors(errorDiv) {

    // Vendor specific aliases for 'MutationObserver'
    var MutationObserver = window.MutationObserver || window.WebKitMutationObserver || window.MozMutationObserver;

    // create an observer instance
    var observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            var newNodes = mutation.addedNodes;
            //        console.log(newNodes);
            addClass_timeout = setTimeout(function() {
                for (let i = 0; i < newNodes.length; ++i) {
                    addClass(newNodes[i], "scale-out");
                    //    newNodes[i].className += " scale-out";
                }
                removeError_timeout = setTimeout(function() {
                    while (errorDiv.children.length) {
                        errorDiv.removeChild(errorDiv.children[0]);
                    }
                }, 2000);
            }, 30000);
        })
    });

    // configuration of the observer:
    var config = {
        attributes: true,
        childList: true,
        characterData: true
    };

    // pass in the target node, as well as the observer options
    observer.observe(errorDiv, config);
}
