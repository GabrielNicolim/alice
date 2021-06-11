<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8" />
<title>Lista de Produtos Cadastrados para Alteração - testeBD1</title>
</head>
<body>
<?php
include "conexao.php";
$sql="SELECT * FROM produtos WHERE excluido='n' ORDER BY cod_produto;";
$resultado= pg_query($conecta, $sql);
$qtde=pg_num_rows($resultado);
if ($qtde > 0)
{
echo "Produtos Encontrados<br><br>";
for ($cont=0; $cont < $qtde; $cont++)
{
$linha=pg_fetch_array($resultado);
echo "Código do produto...: ".$linha['cod_produto']."<br>";
echo "Descrição...........: ".$linha['descricao']."<br>";
echo "Quantidade..........: ".$linha['qtde']."<br>";
echo "Preço...............: ".$linha['preco']."<br>";
echo "Código do fornecedor: ".$linha['cod_fornecedor']."<br>";
echo "<a href='altera_prod_lista.php?cod_produto=".$linha[cod_produto]."'> Alterar</a><br><br>"; 
} 
}
else
echo "Não foi encontrado nenhum produto !!!<br><br>";
pg_close($conecta);
echo "A conexão com o banco de dados foi encerrada!"
?>    
</body>
</html>