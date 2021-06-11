<?php

    include "conexao_explo.php"; 

    $desc = 'Açúcar';
    $qtde = 33;
    $prec = 2.50;
    $codf = 1;
    $excl = 'n';

    $sql  = "INSERT INTO produtos VALUES (DEFAULT, '$desc', $qtde, $prec, $codf, '$excl');";
    
    $resultado=pg_query($conecta,$sql);

    $linhas=pg_affected_rows($resultado);

    if ($linhas > 0)
    
        echo "Produto gravado!<br><br>";

    else	

        echo "Erro na gravação do produto!<br><br>";

    // Fecha a conexão com o PostgreSQL

    pg_close($conecta);

    echo "A conexão com o banco de dados foi encerrada!"
?>    
