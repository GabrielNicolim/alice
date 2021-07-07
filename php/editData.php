<?php

    session_start();
    require_once("loginValidation.php");
    require_once("connect.php");
    require_once("functions.php");

    if(!empty($_POST['name']) && !empty($_POST['quantity']) && !empty($_POST['price']) && !empty($_POST['price']) ){
        
        $choosen_id = $_POST['editInput'];

        $nome = cleanString($_POST['name']); 
        $qnt = cleanNumber($_POST['quantity']);
        $valor = cleanNumber($_POST['price']);
        $tipo = cleanString($_POST['type']);
    
        $query = "UPDATE user_records SET name_record='$nome', quantity_record = $qnt, type_record = '$tipo',
        price_record = $valor WHERE fk_user = $_SESSION[idUser] AND id_record = $choosen_id";

        $return = $conn -> query($query);

        $return= $return -> fetchAll(PDO::FETCH_ASSOC);

        //$qtde= count($return);

        //Se deu tudo certo
        if (count($return) == 0){
            header('location: ../public/views/home.php');
            exit;
        }
        else{
            echo "<script type='text/javascript'>alert('Erro na alteração de dados !!! <br>')</script>";
        } 
    }
    else{
        echo "<script type='text/javascript'>alert('Erro, dados contaminados de mais!!! <br>')</script>";
        print_r($_POST);
    }

?>