<?php
    session_start();
    require_once("loginValidation.php");
    require_once("connect.php");
    require_once("functions.php");

    $choosen_id= $_POST['exclude'];
    $data=date('d/m/Y');

    try{ print_r($_SESSION);
        //echo"coisa $exclusao e $data <br>";
        $query = "UPDATE user_records SET deleted = TRUE, timeDeleted = NOW() WHERE id_record = $choosen_id AND fk_user = $_SESSION[idUser] ";

        $return = $conn -> query($query);

        $return= $return -> fetchAll(PDO::FETCH_ASSOC);

        $qtde= count($return);

        //Se deu tudo certo
        if (!$qtde){
            echo "<script type='text/javascript'>alert('DEU TUDO CERTO! Exclusão lógica OK !!!')</script>";
            header('location: ../public/views/home.php');
            exit;
        }
        else{
            echo "<script type='text/javascript'>alert('Erro na exclusao lógica !!! <br>')</script>";
            //echo "<a href='../public/views/home.php'>Voltar</a>";
        }
    }
    catch(Exception $e){
        echo"Rolou um erro CABULOSO, contate o ademir";
    }

?>