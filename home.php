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

<div id="progress">

</div>

        <form id="imageUploadForm" method="post" enctype="multipart/form-data">
            Select image to upload:
            <input type="file" name="userfile" id="file">
            <input type="submit" value="Upload Image" name="submit">
        </form>
    </section>

    <aside id="gallery" class="col-5 mobile-margin">

    </aside>

    <div id="demo">

    </div>

<?php include './include/footer.php';

} else {
    $_SESSION['errors'] = array("ERROR -- Please log in before accesing this website");
    $_SESSION['logged_on_user'] = "";
    header('Location: index.php');

}
?>
