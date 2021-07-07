<?php
    session_start();

    require_once("loginValidation.php");
    require_once("connect.php");
    require_once("functions.php");
    
    if(!empty($_POST['name']) && !empty($_POST['quantity']) && !empty($_POST['price']) && !empty($_POST['type']) ){
        
        $name = cleanString($_POST['name']); 
        $qnt = cleanString($_POST['quantity']);
        $price = cleanString($_POST['price']);
        $type = cleanString($_POST['type']);

        $query = "INSERT INTO user_records VALUES(DEFAULT,'$name',$qnt,'$type',$price,'FALSE', NULL , :id)";

        $stmt = $conn -> prepare($query);

        $stmt -> bindValue(":id", $_SESSION['idUser']);

        $return = $stmt -> execute();

        if($return){       
            unset($_POST);
            $_POST = array();
            header('location: ../public/views/home.php');
            exit;
        }else{
            header("Location: ../public/views/home.php?error=1");
            exit();
        } 
            
    }else{
        header("Location: ../public/views/home.php?erro=1");
        exit();
    }

?>