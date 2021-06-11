<?php
include "conexao.php";

//dados enviados do script exclui_prod_chamada_confirma_exclusao_logica.php
$cod_produto = $_POST['cod_produto'];
$data=date('d/m/Y'); //'Y' (maiúsculo) para ano com 4 dígitos

$sql="update produtos 
set excluido = 's', data_exclusao = '$data' 
WHERE cod_produto = $cod_produto";
//inserida a data de exclusao do produto para documentação

$resultado=pg_query($conecta,$sql);
$qtde=pg_affected_rows($resultado);
if ($qtde > 0 )
{
echo "<script type='text/javascript'>alert('Exclusão OK !!!')</script>";
echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=exclui_prod.php'>";
}
else
{
echo "Erro na exclusão !!!<br>";
echo "<a href='exclui_prod.php'>Voltar</a>";
}
?>
