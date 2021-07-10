<?php

    session_start();
    require_once("loginValidation.php");
    require_once("connect.php");
    require_once("functions.php");
    

    if( isset($_POST['removepictures']) && $_POST['removepictures'] == '1' ){
        deletePictures();
        exit;   
    }else{

        if(isset($_FILES)){

            if( $_FILES['uploadfile']['size'] >= 4194304 ){
                header('location: ../public/views/user.php?error=1');
                exit;
            }
    
            $permitedFormats = array("jpg","png","jpeg","webpm");
            $filetype = $_FILES['uploadfile']['type'];
            $extension = explode("/",$filetype);
    
            if( !in_array( end($extension) , $permitedFormats ) ){
                header('location: ../public/views/user.php?error=2');
                exit;
            }
    
            $tempname = $_FILES["uploadfile"]["tmp_name"];   
            $folder = "../public/profile_pictures/";
    
            $rename = $_SESSION['idUser'].'Upload'.date('Ymd').$_SESSION['idUser']*100+rand(0,100000).".".end($extension);
    
            if (move_uploaded_file($tempname, $folder.$rename)){
            
                $query = "INSERT INTO user_picture VALUES(DEFAULT,'$rename', ".$_SESSION['idUser'].")";
    
                $stmt = $conn -> query($query);
            
                if($stmt){
                    header('location: ../public/views/user.php');
                    exit;
                }else{
                    //Failed to insert into user_picture table
                    header('location: ../public/views/user.php?error=3');
                    exit;
                }
            }else{
                //Failed to upload image
                header('location: ../public/views/user.php?error=3');
                exit;
            }
        }else{
            header('location: ../public/views/user.php?error=3');
            exit;
        }
    }
      
    function deletePictures(){

        include("connect.php");

        try{
            
            //Pick only the files from the user
            $files = glob("../public/profile_pictures/".$_SESSION['idUser']."Upload*.*");

            array_map('unlink', $files);

            if( !empty(glob("../public/profile_pictures/".$_SESSION['idUser']."Upload*.*")) ){
                
                throw new Exception('Algo deu errado deletando as imagens do diretório');
            }

            $query = "DELETE FROM user_picture WHERE fk_user = ".$_SESSION['idUser'];
            
            $stmt = $conn -> query($query);

            //If removed fine from the DB and files
            if($stmt){
                unset($_FILES);
                header('location: ../public/views/user.php' );
                exit;

            }else{
                throw new Exception('Algo deu errado deletando as imagens do BD');
            }
        }catch(Exception $e){
            echo "<script type='text/javascript'>alert(' Exceção capturada: ".$e->getMessage()."')</script>";
        }
        
    }