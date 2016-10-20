<?php

session_start();

include '../config/database.php';

$statusMsg = '';

function validNewUser($conn, $uname, $email)
{
    global $statusMsg;
    $flag = true;
    $results = $conn->query('SELECT `username`, `email` FROM `users`;');

    while ($row = $results->fetch(PDO::FETCH_ASSOC)) {
        if (strcasecmp($row['username'], $uname) == 0) {
            $statusMsg .= '<p class="warning">The username '.$uname.' is already in use!</p>';
            $flag = false;
        }
        if (strcasecmp($row['email'], $email) == 0) {
            $statusMsg .= '<p class="warning">The email address '.$email.' is already in use!</p>';
            $flag = false;
        }
        if ($flag == false) {
            break;
        }
    }

    return $flag;
}

if ($_POST['submit'] === '1' && $_POST['fname'] && $_POST['lname'] && $_POST['uname'] && $_POST['email'] && $_POST['passwd']) {
    try {
        $dbname = 'camagru';
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $uname = $_POST['uname'];
        $email = $_POST['email'];
        $passwd = hash('whirlpool', $_POST['passwd']);

        $conn = new PDO("$DB_DSN;dbname=$dbname", $DB_USER, $DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if (validNewUser($conn, $uname, $email) == true) {
            $sql = $conn->prepare('INSERT INTO `users` (`firstname`, `lastname`, `username`, `email`, `password`) VALUES (:fname, :lname, :uname, :email, :passwd);');
            $sql->execute(['fname' => $fname, 'lname' => $lname, 'uname' => $uname, 'email' => $email, 'passwd' => $passwd]);

            $statusMsg .= '<p class="success">Yay! You have been sent a validation email, please check your email for the verification link.</p>';
            $response = array('status' => true, 'statusMsg' => $statusMsg);
        } else {
            $response = array('status' => false, 'statusMsg' => $statusMsg);
        }
        echo json_encode($response);
    } catch (PDOException $e) {
        //        echo "<p class=\"danger\"><b><u>Error Message :</u></b><br /> '.$e.' <br /><br /> <b><u>For error details, check :</u></b><br /> \"/home/kbam7/lampstack-7.0.11-2/apache2/htdocs/camagru/log/errors.log\"</p>";
        error_log($e, 3, '/home/kbam7/lampstack-7.0.11-2/apache2/htdocs/camagru/log/errors.log');
        $response = array('status' => false, 'statusMsg' => "<p class=\"danger\"><b><u>Error Message :</u></b><br /> '.$e.' <br /><br /> <b><u>For error details, check :</u></b><br /> \"/home/kbam7/lampstack-7.0.11-2/apache2/htdocs/camagru/log/errors.log\"</p>");
        echo json_encode($response);
    }
    $conn = null;
} else {
    $response = array('status' => false, 'statusMsg' => '<p class="danger">Invalid data sent via POST method</p>');
    echo json_encode($response);
}
