<?php

session_start();

if(!empty($_POST['email']) && !empty($_POST['password'])){

    require_once("connect.php");
    require_once("functions.php");

    $email_user = strtolower( cleanString($_POST['email']) );
    $password_user = cleanString($_POST['password']);

    if(!empty($email_user) && !empty($password_user)){

        $query = "SELECT id_user, email_user, password_user FROM users WHERE email_user = :email_user";

        $stmt = $conn -> prepare($query);

        $stmt -> bindValue(':email_user', $email_user);

        $stmt -> execute(); 

        $return= $stmt -> fetchAll(PDO::FETCH_ASSOC);

        if(count($return) > 0) {
            if(password_verify($password_user, $return[0]['password_user'])) {
                
                $_SESSION['isAuth'] = TRUE; 
                $_SESSION['idUser'] = $return[0]['id_user'];

                header("Location: ../public/views/home.php");
                exit();
            }
            else {
                header("Location: ../public/views/login.php?error=1");
                exit();
            }
        }else{  
            header("Location: ../public/views/login.php?error=1");
            exit();
        }
    }
}