<?php

    session_start();
    require_once("loginValidation.php");
    require_once("connect.php");
    require_once("functions.php");

    $name_user = cleanString($_POST['name']); 
    $email_user = cleanString($_POST['email']);
    $confirmPassword = cleanString($_POST['confirmPassword']);

    if(!empty($name_user) && !empty($email_user) && !empty($confirmPassword)){
        $query = "SELECT * FROM users WHERE email_user = :email";

        $stmt = $conn -> prepare($query);

        $stmt -> bindValue(':email', $email_user);

        $stmt -> execute();

        $result = $stmt -> fetchAll(PDO::FETCH_ASSOC);

        $emailcheck = count($result);

        if($emailcheck > 0){
            header("Location: ../public/views/user.php?error=0");
            exit();
        }
        else {

            $query = "SELECT * FROM users WHERE id_user = :id";

            $stmt = $conn -> prepare($query);

            $stmt -> bindValue(':id', $_SESSION['idUser']);

            $stmt -> execute();

            $result = $stmt -> fetchAll(PDO::FETCH_ASSOC);

            if(password_verify($confirmPassword, $result[0]['password_user'])){

                $query = "UPDATE users SET name_user='$name_user', email_user = '$email_user' WHERE id_user = :id";
                
                $stmt = $conn -> prepare($query);

                $stmt -> bindValue(':id', $_SESSION['idUser']);

                $return = $stmt -> execute(); 

                if ($return){   
                    header('location: ../public/views/user.php');
                    exit;
                }
                else{
                    // Alteração mal sucedida
                    header('location: ../public/views/user.php?error=1');
                    exit;
                }
            } 
            else {
                // Senha incorreta 
                header('location: ../public/views/user.php?error=1');
                exit;
            }
        }
    }
    else {
        header("Location: ../public/views/user.php?error=0");
        exit();
    }
?>