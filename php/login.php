<?php
session_start();
include('auth.php');

$login = $_POST['login'];
$passwd = $_POST['passwd'];
if ($_POST['submit'] !== "OK"){
    $_SESSION['errors'] = array("ERROR -- No okay received from 'submit' input.");
    $_SESSION['logged_on_user'] = "";
    header('Location: ../index.php');
}
else if ($login === "" || $login === null || $passwd === "" || $passwd === null){
    $_SESSION['errors'] = array("ERROR -- No login or password entered.");
    $_SESSION['logged_on_user'] = "";
    header('Location: ../index.php');
}
else if (auth($login, $passwd)){
    $_SESSION['logged_on_user'] = $login;
    header('Location: ../home.php');
}
else{
    $_SESSION['errors'] = array("ERROR -- User '" . $login . "' does not exist.");
    $_SESSION['logged_on_user'] = "";
    header('Location: ../index.php');
}
?>
