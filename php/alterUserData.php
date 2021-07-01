<?php

    session_start();
    require_once("loginValidation.php");
    require_once("conexao.php");

    if(checkAuth()){

        $nome = cleanString($_POST['name']); 
        $email = cleanString($_POST['email']);
        $confirmPassword = cleanString($_POST['confirmPassword']);
        //echo"aaaaa";
        if(!empty($confirmPassword)){
            
            $emailcheck = pg_query($conecta,"SELECT * FROM usuarios WHERE email = '$email' EXCEPT id_user = $_SESSION[idUser] ");
            $count = pg_num_rows($emailcheck);

            if($count > 0){
                header("Location: ../public/views/user.php?error=0");
                exit();
            }else{

                $confirmPassword = password_hash($senhaU, PASSWORD_DEFAULT);

                $sql = "UPDATE usuarios SET nome='$nome', email = '$email' WHERE id_user = $_SESSION[idUser] AND senha = '$confirmPassword' ";
            
                $return = pg_query($conecta, $sql);
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