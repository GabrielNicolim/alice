<?php

session_start();

try{

    if(!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confirmPassword'])  ){
        require_once("connect.php");
        require_once("functions.php");

        $name_user = cleanString($_POST['name']) ;
        $email_user = cleanString($_POST['email']) ;
        $password_user = cleanString($_POST['password']) ;
        $confirmPassword_user = cleanString($_POST['confirmPassword']) ;

        if(!empty($name_user) && !empty($email_user) && !empty($password_user) && 
        !empty($confirmPassword_user) && $password_user == $confirmPassword_user){

            $query = "SELECT email_user FROM users where email_user = :email_user "; 

            $stmt = $conn -> prepare($query);

            $stmt -> bindValue(':email_user', $email_user);

            $stmt -> execute(); 

            $return = $stmt -> fetchAll(PDO::FETCH_ASSOC);

            if(count($return) == 0) {    

                $password_user = password_hash($password_user, PASSWORD_BCRYPT);

                $query = "INSERT INTO users VALUES(DEFAULT, :name_user , :email_user , :password_user, DEFAULT)";

                $stmt = $conn -> prepare($query);
        
                $stmt -> bindValue(':email_user', $email_user);
        
                $stmt -> execute( array(':name_user' => $name_user , ':email_user' => $email_user, ':password_user' => $password_user ) ); //execute(array(":user" => $user));

                if($stmt){

                    $query = "SELECT id_user FROM users WHERE email_user = :email_user";

                    $stmt = $conn -> prepare($query);

                    $stmt -> bindValue(':email_user', $email_user);

                    $stmt -> execute(); 

                    $return = $stmt -> fetch(PDO::FETCH_ASSOC);
                    
                    $_SESSION['isAuth'] = TRUE;
                    $_SESSION['idUser'] = $return['id_user'];

                    header("Location: ../public/views/home.php");
                    exit();
                } 
            }
            else {
                //Error: Email já cadastrado
                throw new Exception("?error=2");
            }
        }
        else {
            //Error: Insira dados corretos
            throw new Exception("?error=1");
        }
        
    }
    else {
        //Error: Insira dados corretos
        throw new Exception("?error=1");
    }

}catch(Exception $e){
    header("Location: ../public/views/register.php".$e->getMessage());
    exit();
}