<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8" />
<title>Grava os produtos na tabela = testeBD1</title>
</head>
<body>
<?php
include "conexao.php"; 
$descricao=$_POST['descricao'];
$qtde=$_POST['qtde'];
$preco=$_POST['preco'];
$cod_fornecedor=$_POST['cod_fornecedor'];
$excluido='n';
$sql="INSERT INTO produtos VALUES(DEFAULT, '$descricao', $qtde, $preco, $cod_fornecedor, '$excluido');";
$resultado=pg_query($conecta,$sql);
$linhas=pg_affected_rows($resultado);
if ($linhas > 0)
echo "Produto gravado !!!<br><br>";
else	
echo "Erro na gravação do produto!!!<br><br>";
// Fecha a conexão com o PostgreSQL
pg_close($conecta);
echo "A conexão com o banco de dados foi encerrada!"
?>  
</body>
</html>