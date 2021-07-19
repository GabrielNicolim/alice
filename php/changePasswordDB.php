<?php

require_once("functions.php");
require_once("connect.php");

if (isset($_POST['reset-password-submit'])) {
    
    $selector = $_POST['selector'];
    $validator = $_POST['validator'];
    $password = cleanString($_POST['pwd']);
    $passwordRepeat = cleanString($_POST['pwd-repeat']);

    if ( empty($password) || empty($passwordRepeat) ) {
        header("location: ../public/views/new-password.php?newpwd=empty");
        exit();
    } else if ( $password !== $passwordRepeat ) {
        header("location ../public/views/new-password.php?newpwd=pwdnotsame");
        exit();
    }
    
    $currentDate = date("U");

    $query = "SELECT * FROM pwdReset WHERE pwdResetSelector = :selector AND pwdResetExpires >= :expires";

    $stmt = $conn -> prepare($query);

    $stmt -> bindValue(":selector", $selector);
    $stmt -> bindValue(":expires", $currentDate);

    $stmt -> execute();

    $row = $stmt -> fetchAll(PDO::FETCH_ASSOC);

    if (!$stmt || count($row) != 1) {
        header("location: ../public/views/new-password.php?newpwd=error");
        exit();
    }
    echo"aaa";
    
    $tokenBin = hex2bin($validator);
    $tokenCheck = password_verify($tokenBin, $row[0]["pwdResetToken"]);
    print_r($row);
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

            $newPassword = password_hash($password, PASSWORD_BCRYPT);

            $query = "UPDATE users SET password_user = :newpassword WHERE email_user = :email_user";
            $stmt = $conn -> prepare($query);
            $stmt -> bindValue(":newpassword", $newPassword);
            $stmt -> bindValue(":email_user", $tokenEmail);
            $stmt -> execute();

            $query = "DELETE FROM pwdreset WHERE pwdResetEmail = :email_user";
            $stmt2 = $conn -> prepare($query);
            $stmt2 -> bindValue(':email_user', $tokenEmail);
            $stmt2 -> execute();

            if( !$stmt || !$stmt2) {
                header("location: ../public/views/new-password.php?newpwd=error");
                exit();
            } else {
                header("location: ../public/views/login.php?newpwd=passwordupdated");
                exit();
            }

        }

    }

} else {
    header("location: ../index.php");
    exit();
}