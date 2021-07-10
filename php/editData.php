<?php

    session_start();
    require_once("loginValidation.php");
    require_once("connect.php");
    require_once("functions.php");

    try{

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
    
            //If everything went right
            if (count($return) == 0){
                header('location: ../public/views/home.php');
                exit;
            }
            else throw new Exception("Erro na alteração dos dados no BD");
            
        }
        else throw new Exception("Dados muito contaminados");

    }catch(Exception $e){
        echo "<script type='text/javascript'>alert(' Exceção capturada: ".$e->getMessage()."')</script>";
    }
    

