<?php

    session_start();
    require_once("loginValidation.php");
    require_once("conexao.php");
    
    $sql = "SELECT * FROM usuario WHERE iduser = '{$_SESSION['idUser']}' ";

    $return = pg_query($conecta, $sql);
    $login_check = pg_num_rows($return);

    if($login_check > 0){

        $nome = cleanString($_POST['name']); 
        $email = cleanString($_POST['email']);
        $password = cleanString($_POST['password']);
        $confirmPassword = cleanString($_POST['confirmPassword']);

        if( $confirmPassword == $password && !empty($confirmPassword) && !empty($password)){
            
            $sql = "UPDATE usuario SET nome='$nome', email = '$email', senha = md5('{$senhaU}') WHERE  iduser = {$_SESSION['idUser']}";
        
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
    else{
        echo "<script type='text/javascript'>alert('Ocorreu um problema no seu login, tente sair e entrar da conta!!!')</script>";
        header('location: ../public/views/home.php');
        exit;
    }
?>