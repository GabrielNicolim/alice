<?php
include "conexao.php"; 
//dados enviados do script altera_prod_lista.php
$cod_produto=$_POST["cod_produto"];
$descricao=$_POST["descricao"];
$qtde_=$_POST["qtde_"];
$preco=$_POST["preco"];
$cod_fornecedor=$_POST["cod_fornecedor"];
$sql="UPDATE produtos 
SET
descricao = '$descricao',
qtde = $qtde_,
preco = '$preco', 
cod_fornecedor = $cod_fornecedor 
WHERE cod_produto = $cod_produto;";
$resultado=pg_query($conecta,$sql);
$qtde=pg_affected_rows($resultado);
if ($qtde > 0)
{
echo "<script type='text/javascript'>alert('Gravação OK !!!')</script>";
echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=altera_prod.php'>";
}
else	
echo "Erro na gravacao !!!<br><br>";
pg_close($conecta);
echo "A conexão com o banco de dados foi encerrada!"
?>