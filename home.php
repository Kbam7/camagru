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
      <a class="btn border border-3 white rounded hover-text-blue text-22" href="php/logout.php" title="Logout of Account">LOGOUT</a>
      <h1>Camagru - <small>Take a photo, have some fun!</small></h1>
    </header>

    <div id="error-messages"></div>
    <div class="row home">
        <section class="col-12" id="imageDisplay">
            <aside class="col-2 overlays">
                <form id="overlayForm">
                    <!-- ADD PHP HERE TO POPULATE OVERLAY LIST. Save overlay to DB and allow users to upload more overlays -->
                    <div class="overlay_images">
                        <div class="form-input">
                            <label class="overlay_label" for="overlay_1"><img src="img/overlays/glasses.png" alt="Glasses" /></label>
                            <input type="radio" name="overlay" id="overlay_1" value="img/overlays/glasses.png" required="true" />
                        </div>
                        <div class="form-input">
                            <label class="overlay_label" for="overlay_2"><img src="img/overlays/whiskers.png" alt="Whiskers" /></label>
                            <input type="radio" name="overlay" id="overlay_2" value="img/overlays/whiskers.png" required="true" />
                        </div>
                        <div class="form-input">
                            <label class="overlay_label" for="overlay_3"><img src="img/overlays/unicorn.png" alt="Unicorn" /></label>
                            <input type="radio" name="overlay" id="overlay_3" value="img/overlays/unicorn.png" required="true" />
                        </div>
                        <div class="form-input">
                            <label class="overlay_label" for="overlay_4"><img src="img/overlays/text/kewl.png" alt="Kewl Text" /></label>
                            <input type="radio" name="overlay" id="overlay_4" value="img/overlays/text/kewl.png" required="true" />
                        </div>
                        <div class="form-input">
                            <label class="overlay_label" for="overlay_5"><img src="img/overlays/text/uhno.png" alt="Uh No Text" /></label>
                            <input type="radio" name="overlay" id="overlay_5" value="img/overlays/text/uhno.png" required="true" />
                        </div>
                    </div>
                    <div class="form-input">
                        <input class="success" type="submit" name="submit" title="First Select an overlay image. . ." value="Take Photo" disabled="true"/>
                    </div>

                </form> <!-- /#overlayForm -->
            </aside> <!-- /.overlays -->
            <div class="col-5 imageDisplay_inner">
                <div class="user-upload-img">
                    
                </div>
                <video autoplay="true" id="videoStream">

                </video>
                <canvas id="canvas">
                </canvas>
                <div class="clearfix"></div>

                <form id="imageUploadForm" method="post" enctype="multipart/form-data">
                    <progress class="during-upload" id="progress" max="100" value="0">
                    </progress>

                    <div class="image-upload-fields">
                        <p>Select image to upload:</p>
                        <input type="file" name="userfile" id="file">
                        <input type="submit" name="submit" value="Upload Image">
                    </div>
                    <button type="button" name="cancelUpload" id="cancelUploadBtn" class="during-upload btn icon l round danger">
                        <i class="fa fa-ban" aria-hidden="true" title="Cancel Upload" ></i>
                    </button>
                </form> <!-- /#imageUploadForm -->
            </div> <!-- /.imageDisplay_inner -->
            <aside id="newGallery" class="col-5">
                <h3>Your Uploads</h3>

            </aside>
        </section> <!-- /#imageDisplay_inner -->
    </div> <!-- ./row -->
<?php
    include './include/gallery.php';

    include './include/footer.php';
} else {
    $_SESSION['errors'] = array('ERROR -- Please log in before accesing this website');
    $_SESSION['logged_on_user'] = '';
    header('Location: index.php');
}
?>
