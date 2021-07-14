<?php

    session_start();
    require_once("loginValidation.php");
    require_once("connect.php");
    require_once("functions.php");

    try{

        if(!empty($_POST['name']) && !empty($_POST['quantity']) && !empty($_POST['price']) && !empty($_POST['price']) ){
        
            $choosen_id = $_POST['editInput'];
    
            $name = cleanString($_POST['name']); 
            $qnt = cleanNumber($_POST['quantity']);
            $type= cleanString($_POST['type']);
            $price = cleanNumber($_POST['price']);
        
            $query = "UPDATE user_records SET name_record = :nameprod, quantity_record = :qnt, 
            type_record = :type, price_record = :price WHERE fk_user = :id AND id_record = :id_record";

            $stmt = $conn -> prepare($query);

            $stmt -> bindValue(":nameprod", $name);
            $stmt -> bindValue(":qnt", $qnt);
            $stmt -> bindValue(":type", $type);
            $stmt -> bindValue(":price", $price);
            $stmt -> bindValue(":id", $_SESSION['idUser']);
            $stmt -> bindValue(":id_record", $choosen_id);

            $return = $stmt -> execute();
    
            //If everything went right
            if ($return){
                header('location: ../public/views/home.php');
                exit;
            }
            else throw new Exception("Erro na alteração dos dados no BD");
            
        }
        else throw new Exception("Dados muito contaminados");

    }catch(Exception $e){
        echo "<script type='text/javascript'> 
                window.alert(' Exceção capturada: ".$e->getMessage()." \\n Voltar para home?')
                window.location = '../public/views/home.php';
             </script>";
    }
    

