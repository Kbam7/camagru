<?php

session_start();
include 'auth.php';

$login = $_POST['login'];
$passwd = $_POST['passwd'];

if ($_POST['submit'] !== '1') {
    echo "<p class=\"danger\">No okay received from 'submit' input.</p>";
    $_SESSION['logged_on_user'] = "";
//    header('Location: ../index.php');
} elseif ($login === '' || $login === null || $passwd === '' || $passwd === null) {
    echo "<p class="danger">No login or password entered.</p>";
    $_SESSION['logged_on_user'] = "";
//    header('Location: ../index.php');
} elseif ($user = auth($login, $passwd)) {
    $_SESSION['logged_on_user'] = $user;
    header('Location: ../home.php');
} else {
    echo "<p class=\"danger\">User '".$login."' does not exist.</p>";
    $_SESSION['logged_on_user'] = "";
//    header('Location: ../index.php');
}
