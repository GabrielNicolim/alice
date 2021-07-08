<?php

    session_start();
    require_once("loginValidation.php");
    require_once("connect.php");
    require_once("functions.php");

    $name_user = cleanString($_POST['name']); 
    $email_user = cleanString($_POST['email']);
    $confirmPassword = cleanString($_POST['confirmPassword']);

    if(!empty($name_user) && !empty($email_user) && !empty($confirmPassword)){
        $query = "SELECT email_user, id_user FROM users WHERE email_user = :email";

        $stmt = $conn -> prepare($query);

        $stmt -> bindValue(':email', $email_user);

        $stmt -> execute();

        $result = $stmt -> fetchAll(PDO::FETCH_ASSOC);

        $emailcheck = count($result);

        if($emailcheck > 0 && $result[0]['id_user'] != $_SESSION['idUser'] ){
            header("Location: ../public/views/user.php?error=0");
            exit();
        }
        else {

            $query = "SELECT * FROM users WHERE id_user = :id";

            $stmt = $conn -> prepare($query);

            $stmt -> bindValue(':id', $_SESSION['idUser']);

            $stmt -> execute();

            $result = $stmt -> fetchAll(PDO::FETCH_ASSOC);
            
            if(password_verify($confirmPassword, $result[0]['password_user'])){

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

                    //$filename = $_FILES["uploadfile"]["name"];
                    $tempname = $_FILES["uploadfile"]["tmp_name"];   
                    $folder = "../public/profile_pictures/";

                    $rename = 'Upload'.date('Ymd').$_SESSION['idUser']*100+rand(0,100000).".".end($extension);

                    $query = "INSERT INTO user_picture VALUES(DEFAULT,'$rename', ".$_SESSION['idUser'].")";

                    $stmt = $conn -> query($query);
                    
                    //Se a inserção na tabela foi um sucesso
                    if($stmt){
                        
                        if (!move_uploaded_file($tempname, $folder.$rename)){
                            //Failed to upload image

                            header('location: ../public/views/user.php?error=3');
                            exit;
                        }
                    }
                }

                $query = "UPDATE users SET name_user = '$name_user', email_user = '$email_user' WHERE id_user = :id";
                
                $stmt = $conn -> prepare($query);

                $stmt -> bindValue(':id', $_SESSION['idUser']);

                $return = $stmt -> execute(); 
                
                if ($return){   
                    header('location: ../public/views/user.php');
                    exit;
                }
                else{
                    // Failed to change user data
                    header('location: ../public/views/user.php?error=1');
                    exit;
                }
            } 
            else {
                // Incorrect password
                header('location: ../public/views/user.php?error=1');
                exit;
            }
        }
    }
    else {
        //Empty fields
        header("Location: ../public/views/user.php?error=0");
        exit();
    }
?>