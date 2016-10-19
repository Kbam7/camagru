<?php

session_start();
include 'auth.php';

$login = $_POST['login'];
$passwd = $_POST['passwd'];

if ($_POST['submit'] !== '1') {
    $response = array("status" => 0, "statusMessage" => "<p class=\"danger\">No okay received from 'submit' input.</p>";
    $_SESSION['logged_on_user'] = '';
//    header('Location: ../index.php');
} elseif ($login === '' || $login === null || $passwd === '' || $passwd === null) {
    $response = array("status" => 0, "statusMessage" => '<p class="danger">No login or password entered.</p>';
    $_SESSION['logged_on_user'] = '';
//    header('Location: ../index.php');
} elseif ($user = auth($login, $passwd)) {
    $_SESSION['logged_on_user'] = $user;
    $response = array("status" => 1, "statusMessage" => "<p class=\"danger\">Hey ".$user["username"]."! You successfully logged in.</p>");
    echo json_encode($response);
//    header('Location: ../home.php');
}
