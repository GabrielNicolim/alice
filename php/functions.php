<?php
    
    function cleanString($string){
        $badWords = array('DROP','TABLE','GROUP BY');      
        return trim(preg_replace('/[^A-Za-zà-úÀ-Ú0-9\@\.\,\s]/', '', str_replace($badWords, '', $string)));
    }

    function cleanNumber($string) {
        return preg_replace('/[^0-9\.\,]/', '', $string);
    }

    function checkAuth(){

        require("connect.php");

        $query= "SELECT email_user FROM users WHERE id_user = $_SESSION[idUser] ";

        $stmt = $conn -> query($query);

        $login_check = $stmt -> fetchAll(PDO::FETCH_ASSOC);

        $login_check= count($login_check);

        if($login_check > 0) return true;
        else return false;
    }

?>