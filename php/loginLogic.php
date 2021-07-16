<?php

try {

    require_once("connect.php");
    require_once("functions.php");

    $email_user = strtolower( cleanEmail($_POST['email']) );
    $password_user = cleanString($_POST['password']);

    if (!empty($email_user) && !empty($password_user) ) {

        $dbpassword = generateFakePassword();

        $query = "SELECT id_user, email_user, password_user FROM users WHERE email_user = :email_user";

        $stmt = $conn -> prepare($query);

        $stmt -> bindValue(':email_user', $email_user);

        $stmt -> execute();

        $return = $stmt -> fetchAll(PDO::FETCH_ASSOC);

        if (count($return) > 0) {
            
            $password_user = cleanString($_POST['password']);
            $dbpassword = $return[0]['password_user'];
            
        }

        if ( password_verify($password_user, $dbpassword) && count($return) > 0) {

            session_start();
            session_regenerate_id(true);

            $_SESSION['isAuth'] = true;
            $_SESSION['idUser'] = $return[0]['id_user'];

            header("Location: ../public/views/home.php");
            exit();

        } else throw new Exception("?error=1"); // Wrong password

    } else throw new Exception("?error=0"); // Campos vazios

} catch(Exception $e) {
    header("Location: ../public/views/login.php".$e->getMessage());
    exit();
}
