<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8" />
<title>Conexão com o Banco de Dados - testeBD1</title>
</head>
<body>
<?php
$conecta = pg_connect("host=localhost port=5432 dbname=testeBD1 user=alunocti password=alunocti");
if (!$conecta)
{
echo "Não foi possível estabelecer conexão com o banco de dados!<br><br>";
exit;
}
else
echo "Conexão estabelecida com o banco de dados!<br><br>";
?>    
</body>
</html>