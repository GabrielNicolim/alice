<?php
    define("Host","host=localhost port=3306 dbname=alice_db user=root password=");
    
    $conecta = pg_connect(Host);
    if (!$conecta){
        echo "Não foi possível estabelecer conexão com o banco de dados! Contate um admin<br><br>";
        exit;
    }
    else{
        //echo "Conexão estabelecida com o banco de dados!<br><br>";
    }
        
    function cleanString($string) {
        $badWords = array('DROP','TABLE','GROUP BY');      
        return trim(pg_escape_string(preg_replace('/[^A-Za-zà-úÀ-Ú0-9\@\.\,\s]/', '', str_replace($badWords, '', $string))));
    }

    function cleanNumber($string) {
        return preg_replace('/[^0-9\.\,]/', '', $string);
    }

    function checkAuth(){

        $sql = "SELECT * FROM usuarios WHERE id_user = $_SESSION[idUser] ";

        $return = pg_query(pg_connect(Host), $sql);
        $login_check = pg_num_rows($return);

        if($login_check > 0) return true;
        else return false;
    }
?>