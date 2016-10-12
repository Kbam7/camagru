<?php
session_start();
if (isset($_SESSION['logged_on_user']) && strlen($_SESSION['logged_on_user']) > 0) {
?>
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

<?php include './include/video_stream.php'; ?>
<?php include './include/gallery.php'; ?>
<?php include './include/footer.php';
} else {
    $_SESSION['errors'] = array("ERROR -- Please log in before accesing this website");
    $_SESSION['logged_on_user'] = "";
    header('Location: index.php');

}
?>
