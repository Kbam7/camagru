<?php

include '../config/database.php';

function auth($login, $passwd)
{
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
        }
        $conn = null;

        return $user;
    } catch (PDOException $e) {
        echo "<p class=\"danger\">Error Message: '.$e->getMessage().'. Check \"~/Desktop/camagru/log/errors.log\" for error details.</p>";
        error_log($e, 3, '~/Desktop/camagru/log/errors.log');
    }
    $conn = null;

    return null;
}
