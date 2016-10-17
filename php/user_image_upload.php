<?php
session_start();

$target_dir = "../uploads/";
$target_file = $target_dir . basename($_FILES["userfile"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["userfile"]["tmp_name"]);
    if($check !== false) {
//        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
//        echo "File is not an image.";
        $_SESSION['errors'] = array("ERROR -- File is not an image.");
        $uploadOk = 0;
    }
}

// Check if file already exists
if (!file_exists($target_dir))
  mkdir($target_dir, 0777);
if (file_exists($target_file)) {
    // echo "Sorry, file already exists.";
    $_SESSION['errors'] = array("ERROR -- Sorry, file already exists.", "ERROR -- Sorry, file already exists -- AGAIN.");
    $uploadOk = 0;
}

// Check file size not bigger than 10mb or 0 bytes
if ($_FILES["userfile"]["size"] > 10000000) {
// echo "Sorry, your file is too large. Maximum size of '10mb' allowed.";
    $_SESSION['errors'] = array("ERROR -- Sorry, your file is too large. Maximum size of '10mb' allowed.");
    $uploadOk = 0;
} else if ($_FILES["userfile"]["size"] == 0){
    echo "Sorry, your file has no size. Please select a valid image.";
    $_SESSION['errors'] = array("ERROR -- Sorry, your file is too large. Maximum size of '10mb' allowed.");
  $uploadOk = 0;
}

// Allow certain file formats
if($uploadOk && $imageFileType != "jpg" && $imageFileType != "png" &&
  $imageFileType != "jpeg" && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["userfile"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["userfile"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}



/*
$target_dir = "../uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

// Check if file already exists
if (!file_exists($target_dir))
  mkdir($target_dir, 0777);
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
*/
?>
