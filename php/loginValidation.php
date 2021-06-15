<?php
    if(!isset($_SESSION['isAuth'])){
        header("Location: login.php ");
        exit();
    }
?>