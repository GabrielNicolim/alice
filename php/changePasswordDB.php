<?php

require_once("functions.php");
require_once("connect.php");

if (isset($_POST['reset-password-submit'])) {
    
    $selector = $_POST['selector'];
    $validator = $_POST['validator'];
    $new_password = cleanString($_POST['password']);
    $passwordRepeat = cleanString($_POST['password-repeat']);

    if ( empty($new_password) || empty($passwordRepeat) ) {
        header("location: ../public/views/new-password.php?selector=".$selector."&validator=".$validator."&newpwd=empty");
        exit();
    } else if ( $new_password !== $passwordRepeat ) {
        header("location: ../public/views/new-password.php?selector=".$selector."&validator=".$validator."&newpwd=pwdnotsame");
        exit();
    } else if( !isPasswordSecure($new_password) ) {
        header("location: ../public/views/new-password.php?selector=".$selector."&validator=".$validator."&newpwd=invalid");
        exit();
    }
    
    $currentDate = date("U");

    $query = "SELECT * FROM pwdReset WHERE pwdResetSelector = :selector AND pwdResetExpires >= :currentTime";

    $stmt = $conn -> prepare($query);

    $stmt -> bindValue(":selector", $selector);
    $stmt -> bindValue(":currentTime", $currentDate);

    $stmt -> execute();

    $row = $stmt -> fetchAll(PDO::FETCH_ASSOC);

    if (!$stmt || count($row) != 1) {
        header("location: ../public/views/new-password.php?newpwd=error");
        exit();
    }

    $tokenBin = hex2bin($validator);
    $tokenCheck = password_verify($tokenBin, $row[0]["pwdResetToken"]);

    if ($tokenCheck === false) {
        header("location: ../public/views/new-password.php?newpwd=error");
        exit();
    } elseif ($tokenCheck === true) {

        $tokenEmail = $row[0]['pwdResetEmail'];

        $query = "SELECT * FROM users WHERE email_user = :email";
        $stmt = $conn -> prepare($query);
        $stmt -> bindValue(":email", $tokenEmail);
        $stmt -> execute();

        $row = $stmt -> fetchAll(PDO::FETCH_ASSOC);

        if (!$stmt || count($row) != 1) {
            header("location: ../public/views/new-password.php?newpwd=error");
            exit();
        } else {

            $new_Password = password_hash($new_password, PASSWORD_BCRYPT);

            $query = "UPDATE users SET password_user = :newpassword WHERE email_user = :email_user";
            $stmt = $conn -> prepare($query);
            $stmt -> bindValue(":newpassword", $new_Password);
            $stmt -> bindValue(":email_user", $tokenEmail);
            $stmt -> execute();

            $query = "DELETE FROM pwdreset WHERE pwdResetEmail = :email_user";
            $stmt2 = $conn -> prepare($query);
            $stmt2 -> bindValue(':email_user', $tokenEmail);
            $stmt2 -> execute();

            if ( !$stmt || !$stmt2) {
                header("location: ../public/views/new-password.php?newpwd=error");
                exit();
            } else {
                header("location: ../public/views/login.php?newpwd=passwordupdated");
                exit();
            }
            echo"aaaaa";
        }

    }

} else {
    header("location: ../index.php");
    exit();
}
