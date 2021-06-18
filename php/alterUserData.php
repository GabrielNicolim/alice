<?php

    session_start();
    require_once("loginValidation.php");
    require_once("conexao.php");

    if(checkAuth()){

        $nome = cleanString($_POST['name']); 
        $email = cleanString($_POST['email']);
        $password = cleanString($_POST['password']);
        $confirmPassword = cleanString($_POST['confirmPassword']);

        if( $confirmPassword == $password && !empty($confirmPassword) && !empty($password)){
            
            $emailcheck = pg_query($conecta,"SELECT * FROM usuarios where email = '$email' ");
            $count = pg_num_rows($emailcheck);
            if($count > 0){
                header("Location: ../public/views/user.php?erro=emailexistente");
                exit();

            }else{
                $sql = "UPDATE usuarios SET nome='$nome', email = '$email' WHERE id_user = $_SESSION[idUser] AND senha = md5('$password')";
            
                $return = pg_query($conecta, $sql);
                $qtde= pg_affected_rows($return);

                if ($qtde > 0){

                    echo "<script type='text/javascript'>alert('DEU TUDO CERTO! Dados alterados !!!')</script>";
                    header('location: ../public/views/user.php');
                    exit;

                }
                else{
                    echo "<script type='text/javascript'>alert('Erro na alteração de dados !!! <br>')</script>";
                }
            }
        }

    }
    else{
        echo "<script type='text/javascript'>alert('Ocorreu um problema no seu login, tente sair e entrar da conta!!!')</script>";
        header('location: ../public/views/home.php');
        exit;
    }
?>