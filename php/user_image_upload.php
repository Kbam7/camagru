<?php

$target_dir = '../images/';
$imageFileType = pathinfo($_FILES['userfile']['name'], PATHINFO_EXTENSION);
$target_file = $target_dir.uniqid().'.'.$imageFileType;
$uploadOk = 1;

// Check if image file is a actual image or fake image
if (isset($_POST['submit']) && $_POST['submit'] === '1') {
    $check = getimagesize($_FILES['userfile']['tmp_name']);
    if ($check !== false) {
        //        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        die('<p class="info">Select a valid image to upload. <br />E.G:   JPG, JPEG, PNG or GIF');
    }

    // Check if file already exists
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777);
    }
    if (file_exists($target_file)) {
        echo "<p class=\"info\">The file you want to upload already exists. '".$target_file."'</p>";
        $uploadOk = 0;
    }

    // Check file size not bigger than 10mb or 0 bytes
    if ($_FILES['userfile']['size'] > 10000000) {
        echo "<p class=\"danger scale-in slow\">Your file is too large. Maximum size of '10mb' allowed.</p>";
        $uploadOk = 0;
    } elseif ($_FILES['userfile']['size'] == 0) {
        echo '<p class="info">Your file has no size. Please select a valid image.</p>';
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($uploadOk && $imageFileType != 'jpg' && $imageFileType != 'png' &&
      $imageFileType != 'jpeg' && $imageFileType != 'gif') {
        echo '<p class="info">Only JPG, JPEG, PNG & GIF files are allowed.</p>';
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo '<p class="infow">Your file was not uploaded!</p>';
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES['userfile']['tmp_name'], $target_file)) {
            echo '<p class="success">The file '.basename($_FILES['userfile']['name']).' has been uploaded.</p>';
        } else {
            echo '<p class="warning">Oops! There was an error uploading your file.</p>';
        }
    }
}
