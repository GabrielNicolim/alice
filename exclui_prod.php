<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8" />
<title>Lista de Produtos Cadastrados para Exclusão (Lógica) - testeBD1</title>
</head>
<body>
<?php
include "conexao.php";
$sql="SELECT * FROM produtos WHERE excluido != 's' ORDER BY cod_produto;";
$resultado= pg_query($conecta, $sql);
$qtde=pg_num_rows($resultado);
if ($qtde > 0){echo "Produtos encontrados<br><br>";
for ($cont=0; $cont < $qtde; $cont++)
{
$linha=pg_fetch_array($resultado);
echo "Código do produto...: ".$linha[cod_produto]."<br>";//ou $linha[0]
echo "Descrição...........: ".$linha[descricao]."<br>";
echo "Quantidade..........: ".$linha[qtde]."<br>";
echo "Preço...............: ".$linha[preco]."<br>";
echo "Código do fornecedor: ".$linha[cod_fornecedor]."<br>";
echo "<a href='exclui_prod_chamada_alteracao.php?cod_produto=$linha[0]'>
Alterar</a>&nbsp&nbsp";
echo "<a href='exclui_prod_chamada_confirma_exclusao_logica.php?cod_produto=$linha[0]'>
Excluir</a><br><br>";					   
}
}
else
echo "Não foi encontrado nenhum produto !!!<br><br>";
?>    
</body>
</html>