<?php

function auth($login, $passwd)
{
    include '../config/database.php';

    $passwd = hash('whirlpool', $passwd);
    try {
        $dbname = 'camagru';
        $conn = new PDO("$DB_DSN;dbname=$dbname", $DB_USER, $DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = $conn->prepare('SELECT `id`, `firstname` FROM `users` WHERE username=:login AND password=:passwd;');
        $sql->execute(['login' => $login, 'passwd' => $passwd]);

        if ($sql->rowCount() == 1) {
            $user = $sql->fetch(PDO::FETCH_ASSOC);
        } else {
            $user = null;
            echo '<p class="danger">Username or password is incorrect.</p>';
        }
        $conn = null;

        return $user;
    } catch (PDOException $e) {
        echo "<p class=\"danger\">Error Message: '.$e.'. Check \"/home/kbam7/lampstack-7.0.11-2/apache2/htdocs/camagru/log/errors.log\" for error details.</p>";
        error_log($e, 3, '/home/kbam7/lampstack-7.0.11-2/apache2/htdocs/camagru/log/errors.log');
    }
    $conn = null;

    return null;
}
