<?php
    session_start();
    require_once("loginValidation.php");
    require_once("connect.php");
    require_once("functions.php");

    $choosen_id= $_POST['exclude'];
    $data=date('d/m/Y');

    try{
 
        $query = "UPDATE user_records SET deleted = TRUE, timeDeleted = NOW() WHERE id_record = $choosen_id AND fk_user = $_SESSION[idUser] ";

        $return = $conn -> query($query);

        $return= $return -> fetchAll(PDO::FETCH_ASSOC);

        $qtde= count($return);

        //If everything went okay
        if (!$qtde){
            header('location: ../public/views/home.php');
            exit;
        }
        else throw new Exception('Seus dados não puderam ser alterados');

    }
    catch(Exception $e){
        echo "<script type='text/javascript'>alert(' Exceção capturada: ".$e->getMessage()."')</script>";
    }