<?php

    include 'database.php';

    try {

        // Create new PDO object. i.e. Connection to the database
        $db_conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);

        // Set attributes/options for this connection
        $db_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Remove the database if it already exists
        $db_conn->exec('DROP DATABASE IF EXISTS camagru;');

        // Create the database
        $db_conn->exec('CREATE DATABASE IF NOT EXISTS camagru;');

        // Use this database
        $db_conn->exec('USE camagru;');

        // Make user TABLE
        $db_conn->exec('CREATE TABLE IF NOT EXISTS users (
    		id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(32) NOT NULL,
            password VARCHAR(128) NOT NULL,
    		firstname VARCHAR(32) NOT NULL,
    		lastname VARCHAR(32) NOT NULL,
    		email VARCHAR(64) NOT NULL)');

        // Make image table
        $db_conn->exec('CREATE TABLE IF NOT EXISTS images (
    		id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    		userid INT(6) UNSIGNED NOT NULL,
    		title VARCHAR(128) NOT NULL,
    		path VARCHAR(128) NOT NULL,
    		date datetime NOT NULL)');
    } catch (PDOException $e) {
        error_log($e, 3, '/home/kbam7/Desktop/errors.log');
        die('DB ERROR: '.$e->getMessage());
    }
    $db_conn = null;
