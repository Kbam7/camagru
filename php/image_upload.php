<?php

echo $_FILES['file'];

echo "<br /><br />";

var_dump($_POST);

echo "<br /><br />";

var_dump($_FILES['userfile']);

echo "<br /><br />";

print_r($_FILES['userfile']);

/*
echo "YOU DID IT! <br /> Umm ... ";

var_dump($_POST['image']);

if (isset($_POST['image'])) {
    $img = $_POST['image'];
    echo '<img src="'.$img.'" alt="mypic" />';
}
*/
?>
