<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8" />
<title>Conexão com o Banco de Dados - teste</title>
</head>
<body>
<?php
    $conecta = pg_connect("host=localhost port=5432 dbname=a06felipeestevanatto user=a06felipeestevanatto password=cti");
    if (!$conecta) {
        echo "Não foi possível estabelecer conexão com o banco de dados!<br><br>";
        exit;
    }
    else
        echo "Conexão estabelecida com o banco de dados!<br><br>";
?>     
</body>
</html>   