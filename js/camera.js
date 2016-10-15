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

        // Taking a photo
        video.addEventListener('click', function() {
            //  Draw image
            var context = canvas.getContext('2d');
            context.drawImage(video, 0, 0, width, height);

            //  Add image to gallery
            var data = canvas.toDataURL('image/png');
            addNewImage(data);
        })
    }

    function displayStream(stream) {
        // Vendor specific aliases for 'window.URL'
        window.URL = (window.URL || window.mozURL || window.webkitURL)
        video.src = window.URL.createObjectURL(stream);
    }

    function streamError(e) {
        alert("There was an error accessing your webcam.");
        console.log("There was an error accessing your webcam.");
    }

    function addNewImage(data) {

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

}
