<?php

    $stringdeconexao = "host=localhost port=5432 dbname=testeBD1 user=alunocti password=alunocti";
    
    $conecta = pg_connect($stringdeconexao);
    
    if (!$conecta) {
        
        echo "Não foi possível estabelecer conexão com o banco de dados!<br><br>";
        
        exit;
    }

    else
        
        echo "Conexão estabelecida com o banco de dados!<br><br>";
?>