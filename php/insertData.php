<?php
    session_start();
    require_once("loginValidation.php");
    require_once("conexao.php");
    
    $sql = "SELECT * FROM usuario WHERE iduser = '{$_SESSION['idUser']}' ";

    $return = pg_query($conecta, $sql);
    $login_check = pg_num_rows($return);

    if($login_check > 0){

        $nome = cleanString($_POST['name']); 
        $qnt = cleanString($_POST['quantity']);
        $preco = cleanString($_POST['price']);
        $tipo = cleanString($_POST['type']);

        if(!empty($_POST['name']) && !empty($_POST['quantity']) && !empty($_POST['price']) && !empty($_POST['type']) ){

            $sql = "INSERT INTO registros VALUES(DEFAULT,'{$nome}','{$qnt}','{$tipo}','{$preco}','FALSE','{$_SESSION['idUser']}' )";

            $return = pg_query($conecta, $sql);

            if($return){       
                unset($_POST);
                $_POST = array();
                //print_r("Data saved Successfully");
                header('location: ../public/views/home.php');
                exit;
            }else{
                //print_r("Something Went Wrong");
                header("Location: ../public/views/home.php?erro=1");
                exit();
            }
            
        }
    }else{
        
    }
?>