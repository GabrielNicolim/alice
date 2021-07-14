<?php

    session_start();
    require_once("loginValidation.php");
    require_once("connect.php");
    require_once("functions.php");

    $name_user = cleanString($_POST['name']); 
    $email_user = cleanString($_POST['email']);
    $confirmPassword = cleanString($_POST['confirmPassword']);

    try{
        if(!empty($name_user) && !empty($email_user) && !empty($confirmPassword)){
            $query = "SELECT email_user, id_user FROM users WHERE email_user = :email";
    
            $stmt = $conn -> prepare($query);
    
            $stmt -> bindValue(':email', $email_user);
    
            $stmt -> execute();
    
            $return = $stmt -> fetchAll(PDO::FETCH_ASSOC);
    
            $emailcheck = count($return);
    
            if($emailcheck > 0 && $return[0]['id_user'] != $_SESSION['idUser'] ){
                throw new Exception("error=0");
            }
            else{
    
                $query = "SELECT * FROM users WHERE id_user = :id";
    
                $stmt = $conn -> prepare($query);
    
                $stmt -> bindValue(':id', $_SESSION['idUser']);
    
                $stmt -> execute();
    
                $return = $stmt -> fetchAll(PDO::FETCH_ASSOC);
                
                if(password_verify($confirmPassword, $return[0]['password_user'])){
    
                    $query = "UPDATE users SET name_user = :name_user, email_user = :email_user WHERE id_user = :id";
                    
                    $stmt = $conn -> prepare($query);
    
                    $stmt -> bindValue(':email_user', $email_user);
                    $stmt -> bindValue(':name_user', $name_user);
                    $stmt -> bindValue(':id', $_SESSION['idUser']);
    
                    $return = $stmt -> execute(); 
                    
                    if ($return){   
                        header('location: ../public/views/user.php');
                        exit;
                    }
                    else throw new Exception("error=1"); // Failed to change user data

                } 
                else throw new Exception("error=1"); // Incorrect password
                    
            }
        }
        else throw new Exception("error=0"); //Empty fields
            
    }catch(Exception $e){

        header("Location: ../public/views/user.php?".$e->getMessage());
        exit();

    }
    