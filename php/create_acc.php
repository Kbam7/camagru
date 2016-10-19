<?php

session_start();

include '../config/database.php';

if ($_POST['submit'] === '1' && $_POST['fname'] && $_POST['lname'] && $_POST['uname'] && $_POST['email'] && $_POST['passwd']) {
    try {
        $dbname = 'camagru';
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $uname = $_POST['uname'];
        $email = $_POST['email'];
        $passwd = hash('whirlpool', $_POST['passwd']);
/*
        $conn = new PDO("$DB_DSN;dbname=$dbname", $DB_USER, $DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = $conn->prepare('INSERT INTO `users` (`firstname`, `lastname`, `username`, `email`, `password`) VALUES (:fname, :lname, :uname, :email, :passwd);');
        $sql->execute(['fname' => $fname, 'lname' => $lname, 'uname' => $uname, 'email' => $email, 'passwd' => $passwd]);
*/
//        echo json_encode(true);
    echo "<p class=\"success\">User Added</p>"
    } catch (PDOException $e) {
        echo "<p class=\"danger\">Error Message: '.$e->getMessage().'. Check \"~/Desktop/camagru/log/errors.log\" for error details.</p>";
        error_log($e, 3, '~/Desktop/camagru/log/errors.log');
//        echo json_encode(false);
    }
    $conn = null;
} else {
//    echo json_encode(false);

}
