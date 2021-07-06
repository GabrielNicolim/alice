<?php
    require_once("connect.php");

    function cleanString($string){
        $badWords = array('DROP','TABLE','GROUP BY');      
        return trim(trim(preg_replace('/[^A-Za-zà-úÀ-Ú0-9\@\.\,\s]/', '', str_replace($badWords, '', $string))));
    }

    function cleanNumber($string) {
        return preg_replace('/[^0-9\.\,]/', '', $string);
    }

    function checkAuth(){

        $sql = "SELECT * FROM usuarios WHERE id_user = $_SESSION[idUser] ";

        $return = $conn -> query($sql);
        $login_check = mysqli_num_rows($return);

        if($login_check > 0) return true;
        else return false;
    }

?>