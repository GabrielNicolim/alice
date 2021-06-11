<?php
include "conexao.php"; 
//dados enviados do script exclui_prod_chamada_alteracao.php
$cod_produto=$_POST["cod_produto"];
$descricao=$_POST["descricao"];
$qtde_=$_POST["qtde_"];
$preco=$_POST["preco"];
$cod_fornecedor=$_POST["cod_fornecedor"];
$sql="update produtos 
set
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
echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=exclui_prod.php'>";
}
else	
{
echo "Erro na exclusao !!!<br>";
echo "<a href='exclui_prod.php'>Voltar</a>";
}
?>