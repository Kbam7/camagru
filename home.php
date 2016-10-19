<?php
session_start();
if (isset($_SESSION['logged_on_user'])) {
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

    <div id="error-messages"></div>

    <section class="col-7 mobile-margin" id="imageDisplay">
        <video autoplay="true" id="videoStream">

        </video>
        <canvas id="canvas" style="display: none;">
        </canvas>
        <div class="clearfix"></div>

        <form id="imageUploadForm" method="post" enctype="multipart/form-data">
            <progress class="during-upload" id="progress" max="100" value="0">
            </progress>

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
    $_SESSION['errors'] = array('ERROR -- Please log in before accesing this website');
    $_SESSION['logged_on_user'] = '';
    header('Location: index.php');
}
?>
