<?php

    require_once("connect.php");
    require_once("functions.php");
    
    $email_user = strtolower( cleanEmail($_POST['email']) );

    if (!empty($email_user) ) {

        $query = "SELECT email_user, password_user FROM users WHERE email_user = :email_user";

        $stmt = $conn -> prepare($query);

        $stmt -> bindValue(':email_user', $email_user);

        $stmt -> execute();

        $return = $stmt -> fetchAll(PDO::FETCH_ASSOC);

        if (count($return) > 0 || true) {
            
            // print_r($return);
            // $token = rand(0000, 9999);
            
        }

        //header("Location: ../public/views/recover.php?message=0");
        //exit();   

    } else {
        header("Location: ../public/views/recover.php?message=1"); // Campos vazios
        exit();
    }
