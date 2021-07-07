<?php
    session_start();

    if(!isset($_SESSION['isAuth'])){
        header("Location: ../public/views/login.php ");
        exit();
    }

    require_once("connect.php");
    require_once("functions.php");
    
    if(!empty($_POST['name']) && !empty($_POST['quantity']) && !empty($_POST['price']) && !empty($_POST['type']) ){
        
        if(checkAuth()){

            $name = cleanString($_POST['name']); 
            $qnt = cleanString($_POST['quantity']);
            $price = cleanString($_POST['price']);
            $type = cleanString($_POST['type']);

            $sql = "INSERT INTO user_records VALUES(DEFAULT,'$name',$qnt,'$type',$price,'FALSE', NULL ,$_SESSION[idUser] )";

            $return = $conn -> query($sql);

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
        else{
            echo "<script type='text/javascript'>alert('Ocorreu um problema no seu login, tente sair e entrar da conta: $_SESSION[idUser]')</script>";
            //header('location: ../public/views/home.php');
            //exit;
        }
    }else{
        header("Location: ../public/views/home.php?erro=1");
        exit();
    }

?>