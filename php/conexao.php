<?php
    $conecta = pg_connect("host=localhost port=5432 dbname=a06felipeestevanatto user=a06felipeestevanatto password=cti");
    if (!$conecta){
        //echo "Não foi possível estabelecer conexão com o banco de dados!<br><br>";
        exit;
    }
    else{
        //echo "Conexão estabelecida com o banco de dados!<br><br>";
    }
        

    function clean($string) {
        return preg_replace('/[^A-Za-z0-9\@\.]/', '', $string); // Sanitiza a string
    }

?>