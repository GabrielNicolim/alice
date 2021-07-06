<?php

    session_start();
    require_once("loginValidation.php");
    require_once("connect.php");
    require_once("functions.php");

    if(checkAuth()){

        $name_user = cleanString($_POST['name']); 
        $email_user = cleanString($_POST['email']);
        $confirmPassword = cleanString($_POST['confirmPassword']);
        //echo"aaaaa";
        if(!empty($confirmPassword)){
            
            $emailcheck = $conn -> query("SELECT * FROM users WHERE email_user = '$email_user' EXCEPT id_user = $_SESSION[idUser] ");
            $count = pg_num_rows($emailcheck);

            if($count > 0){
                header("Location: ../public/views/user.php?error=0");
                exit();
            }else{

                $confirmPassword = password_hash($senhaU, PASSWORD_DEFAULT);

                $sql = "UPDATE users SET name_user='$name_user', email_user = '$email_user' WHERE id_user = $_SESSION[idUser] AND password_user = '$confirmPassword' ";
            
                $return = $conn -> query($sql);
                $qtde= pg_affected_rows($return);

                if ($qtde > 0){

                    header('location: ../public/views/user.php');
                    exit;
                }
                else{
                    header('location: ../public/views/user.php?error=1');
                    exit;
                }
            }
        }

    }
    else{
        header('location: ../public/views/login.php');
        exit;
    }
?>