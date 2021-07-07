<?php

    session_start();
    require_once("loginValidation.php");
    require_once("connect.php");
    require_once("functions.php");

    if(checkAuth()){

        $name_user = cleanString($_POST['name']); 
        $email_user = cleanString($_POST['email']);
        $confirmPassword = cleanString($_POST['confirmPassword']);
        
        if(!empty($name_user) && !empty($email_user) && !empty($confirmPassword)){
            print_r($_POST);

            $sql = "SELECT * FROM users WHERE email_user = '$email_user' AND id_user != $_SESSION[idUser] ";

            $emailcheck = $conn -> query($sql);

            $result = $emailcheck -> fetchAll(PDO::FETCH_ASSOC);
            $emailcheck = count($result);
            print_r($result);
            if($emailcheck > 0){
                header("Location: ../public/views/user.php?error=0");
                exit();
            }else{

                if( password_verify($confirmPassword, $result['password_user'])){

                    $confirmPassword = password_hash($confirmPassword, PASSWORD_BCRYPT);

                    $query = "UPDATE users SET name_user='$name_user', email_user = '$email_user' WHERE id_user = $_SESSION[idUser] ";
                    
                    $return = $conn -> query($query);

                    $return = $return -> fetchAll(PDO::FETCH_ASSOC);
                    echo$confirmPassword;
                    if (count($return) > 0){
                        
                        //header('location: ../public/views/user.php');
                        //exit;
                    }
                    else{
                        //Senha incorreta ou alteração mal sucedida
                        header('location: ../public/views/user.php?error=1');
                        exit;
                    }
                } 
            }
        }

    }
    else{
        header('location: ../public/views/login.php');
        exit;
    }
?>