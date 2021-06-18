<?php
    session_start();
    require_once("loginValidation.php");
    require_once("conexao.php");

    if(checkAuth()){

        $exclusao = $_POST['exclude'];
        $data=date('d/m/Y');

        try{
            echo"coisa $exclusao e $data <br>";
            $sql = "UPDATE registros SET excluido= 'TRUE', data_exclusao = '$data' WHERE idregistro = $exclusao AND fk_user = $_SESSION[idUser] ";

            $return = pg_query($conecta, $sql);
            $qtde= pg_affected_rows($return);

            if ($qtde > 0){
                echo "<script type='text/javascript'>alert('DEU TUDO CERTO! Exclusão lógica OK !!!')</script>";
                header('location: ../public/views/home.php');
                exit;
            }
            else{
                echo "<script type='text/javascript'>alert('Erro na exclusao lógica !!! <br>')</script>";
                echo "<a href='../public/views/home.php'>Voltar</a>";
            }
        }
        catch(Exception $e){
            echo"Rolou um erro CABULOSO, contate o ademir";
        }

    }
    else{
        echo "<script type='text/javascript'>alert('Ocorreu um problema no seu login, tente sair e entrar da conta!!!')</script>";
        header('location: ../public/views/home.php');
        exit;
    }
?>