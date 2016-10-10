function activateUsersCamera(){

  var video = document.querySelector("#videoStream"),
      canvas = document.querySelector("#canvas"),
      photo = document.querySelector('#photo'),

  //  Make width dependant on window width. Height will be equal to $width / (4/3).
  //  If height is 0, it should be calculated automatically using the width and current aspect ratio
      width = 500,
      height = 350;

  video.setAttribute('width', width);
  video.setAttribute('height', height);
  canvas.setAttribute('width', width);
  canvas.setAttribute('height', height);

  navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia || navigator.oGetUserMedia;
  if (navigator.getUserMedia) {
      navigator.getUserMedia({video: true}, displayStream, streamError);
  }

// Taking a photo
  video.addEventListener('click', function(){
//  Draw image
    var context = canvas.getContext('2d');
    context.drawImage(video, 0, 0, width, height);

//  Add image to gallery
    var data = canvas.toDataURL('image/png');
    addNewImage(data);
  });

  function displayStream(stream) {
    video.src = window.URL.createObjectURL(stream);
  }

  function streamError(e) {
    alert("There was an error accessing your webcam.");
    console.log("There was an error accessing your webcam.");
  }

  function addNewImage(data){
    var newImg = document.createElement("img");
    newImg.setAttribute('src', data);
    newImg.setAttribute('alt', "ADD SOMETHING HERE");
    newImg.className = 'gallery-img';

    var gallery = document.getElementById("gallery");
    document.body.insertBefore(newImg, gallery);
  };


};