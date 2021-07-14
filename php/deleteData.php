<?php
    session_start();
    require_once("loginValidation.php");
    require_once("connect.php");
    require_once("functions.php");

    $choosen_id= $_POST['exclude'];
    //$data=date('d/m/Y');

    $query = "UPDATE user_records SET deleted = TRUE, timeDeleted = NOW() WHERE id_record = :choosen_id AND fk_user = :id ";

    $stmt = $conn -> prepare($query);
    
    $stmt -> bindValue(":choosen_id", $choosen_id);
    $stmt -> bindValue(":id", $_SESSION['idUser']);

    $return = $stmt -> execute();

    //If everything went okay
    if ($return){
        header('location: ../public/views/home.php');
        exit;
    }
    else{
        echo "<script type='text/javascript'> 
            window.alert(' Exceção capturada: Seus dados não puderam ser alterados \\n Voltar para home?')
            window.location = '../public/views/home.php';
            </script>";
    }
