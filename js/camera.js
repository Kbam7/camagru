"use strict";

function activateUsersCamera() {

    var video = document.querySelector('#videoStream'),
        canvas = document.querySelector('#canvas'),
        width = window.innerWidth / (7 / 3),
        height = width / (4 / 3);

    if (width > 1024) {
        width = 1024,
        height = width / (4 / 3);
    }

    if (video && canvas) {

        // Set initial size for video and canvas elements
        video.setAttribute('width', width);
        video.setAttribute('height', height);
        canvas.setAttribute('width', width);
        canvas.setAttribute('height', height);

        // Vendor specific aliases for 'navigator.getUserMedia'
        navigator.getUserMedia =    (navigator.getUserMedia ||
                                    navigator.webkitGetUserMedia ||
                                    navigator.mozGetUserMedia ||
                                    navigator.msGetUserMedia ||
                                    navigator.oGetUserMedia)
        // Access the users webcam
        if (navigator.getUserMedia) {
            var constraints = {
                audio: false,
                video: {
                    width: { ideal: 1280, max: 1920 },
                    height: { ideal: 720, max: 1080 },
                    facingMode: "user"
                }
            };
            navigator.getUserMedia(constraints, displayStream, streamError);
        }

    }

    function displayStream(stream) {
        // Vendor specific aliases for 'window.URL'
        window.URL = (window.URL || window.mozURL || window.webkitURL)
        video.src = window.URL.createObjectURL(stream);

        // Taking a photo
        video.addEventListener('click', takePhoto);
    }

    function streamError(e) {
        alert("There was an error accessing your webcam.");
        console.log("There was an error accessing your webcam.");
    }

    function takePhoto() {
        //  Draw image
        var context = canvas.getContext('2d');
        context.drawImage(video, 0, 0, width, height);

        //  Add image to gallery
        var data = canvas.toDataURL('image/png');
        ajax_upload_webcam_image(data);
    }

    // Function for uploading webcam images
    function ajax_upload_webcam_image(data) {
        var httpRequest,
            imgData;

        imgData = "submit=1&image=" + data.split(",")[1];

        alert(imgData);

    debugger;

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
            httpRequest.send(imgData);
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

                    // Display image in gallery
                    var newImg = document.createElement("img");
                    var gallery = document.getElementById("gallery");
                    if (gallery && newImg) {
                        newImg.setAttribute('src', data);
                        newImg.setAttribute('alt', "ADD SOMETHING HERE");
                        newImg.className = "gallery-img";
                        gallery.appendChild(newImg);
                    }
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



/*
//  Function that will upload the image taken with the webcam
    function ajax_upload_webcam_image(data) {

//        var imgData = JSON.stringify({data});
//        ajax_request('php/image_upload.php', "image=".data);


        var newImg = document.createElement("img");
        var gallery = document.getElementById("gallery");
        if (gallery && newImg) {
            newImg.setAttribute('src', data);
            newImg.setAttribute('alt', "ADD SOMETHING HERE");
            newImg.className = "gallery-img";
            gallery.appendChild(newImg);
        }

    }
*/

}
