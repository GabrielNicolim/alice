<?php

    $DB_dsn = 'mysql:host=localhost;dbname=alice_db';
    $DB_user = "root";
    $DB_password = "";

    try {
        $conn = new PDO($DB_dsn, $DB_user, $DB_password);
    }
    catch (PDOException $e) {
        echo 'Error: '.$e->getCode().' Message: '.$e->getMessage();
    }
