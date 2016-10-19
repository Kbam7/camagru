<?php

$target_dir = '../images/';
$target_file = $target_dir.uniqid().'.png';

// Check if image file is a actual image or fake image
if (isset($_POST['submit']) && isset($_POST['image'])) {
    // Check if directory exists
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777);
    }

    if (file_put_contents($target_file, base64_decode($base64_data))) {
        echo '<p class="success scale-in slow">Your new image has been uploaded!</p>';
    } else {
        echo '<p class="warning scale-in slow">Oops! There was an error uploading your image.</p>';
    }
}
