<?php
session_start();
if (isset($_SESSION['logged_on_user']) && strlen($_SESSION['logged_on_user']) > 0) {
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Chat Room</title>
<?php include './include/header.php'; ?>
  </head>
  <body>
    <header>
      <a href="php/logout.php">LOGOUT</a>
      <h1>Camagru - <small>Take a photo, have some fun!</small></h1>
    </header>

    <section class="col-7 mobile-margin" id="imageDisplay">
        <video autoplay="true" id="videoStream">

        </video>
        <canvas id="canvas" style="display: none;">
        </canvas>
        <div class="clearfix"></div>

        <!-- Custom Switch Start -->
        <div class="group">
            <label class="auto-width pull-left padding-right text-strong">
                <i class="fa fa-video-camera" aria-hidden="true" title="Webcam" ></i>
            </label>
            <label class="toggle xl pull-left round">
                <input id="toggleSwitch" type="checkbox">
                <span class="switch"></span>
                <span class="track"></span>
            </label>
            <label class="auto-width pull-left padding-right text-strong">
                Webcam :
            </label>
        </div>
        <!-- Custom Switch End -->

        <form id="imageUploadForm" method="post" enctype="multipart/form-data">
            <progress class="during-upload" id="progress" max="100" value="0">
            </progress>
            <div id="form-errors"></div>

            <div class="image-upload-fields">
                <p>Select image to upload:</p>
                <input type="file" name="userfile" id="file">
                <input type="submit" value="Upload Image" name="submit">
            </div>
            <button type="button" name="cancelUpload" id="cancelUploadBtn" class="during-upload btn icon l round danger">
                <i class="fa fa-ban" aria-hidden="true" title="Cancel Upload" ></i>
            </button>
        </form>
    </section>

    <aside id="gallery" class="col-5 mobile-margin">

    </aside>

<?php include './include/footer.php';

} else {
    $_SESSION['errors'] = array("ERROR -- Please log in before accesing this website");
    $_SESSION['logged_on_user'] = "";
    header('Location: index.php');

}
?>
