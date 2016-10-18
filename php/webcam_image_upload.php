<?php
session_start();

$target_dir = "../images/";
$imageFileType = pathinfo($_FILES["userfile"]["name"], PATHINFO_EXTENSION);
$target_file = $target_dir . uniqid() . "." . $imageFileType;
$uploadOk = 1;
/*
$target_dir = "../uploads/";
$target_file = $target_dir . basename($_FILES["userfile"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
*/
//print_r($_FILES);

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    // Check if directory exists
    if (!file_exists($target_dir))
      mkdir($target_dir, 0777);

}


// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "<p class=\"info scale-in slow\">Your file was not uploaded!</p>";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["userfile"]["tmp_name"], $target_file)) {
        echo "<p class=\"success scale-in slow\">The file ". basename( $_FILES["userfile"]["name"]). " has been uploaded.</p>";
    } else {
        echo "<p class=\"warning scale-in slow\">Oops! There was an error uploading your file.</p>";
    }
}

?>
