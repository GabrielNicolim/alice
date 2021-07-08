<?php
    require_once("connect.php");

    session_start();
    unset($_SESSION['isAuth']);
    session_destroy();
    $conn = null;
    header('Location: ../index.php');
    exit();
?>

