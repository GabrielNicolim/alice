<?php
include "conexao.php";
//dados enviados do script exclui_prod.php
$cod_produto = $_GET["cod_produto"];
$sql="SELECT * FROM produtos WHERE cod_produto = $cod_produto;";
$resultado=pg_query($conecta,$sql);
$qtde=pg_num_rows($resultado);
if ( $qtde == 0 )
{
echo "Produto não encontrado  !!!<br><br>";
exit;
}
$linha = pg_fetch_row($resultado);
?>
<form action="exclui_prod_chamada_alteracao_gravar.php" method="post">
Código do produto <input type="text" name="cod_produto" 
value="<?php echo $linha[0]; ?>" readonly><br>
Descrição <input type="text" name="descricao" 
value="<?php echo $linha[1]; ?>" ><br>
Quantidade <input type="text" name="qtde_" 
value="<?php echo $linha[2]; ?>" ><br>
Preço <input type="text" name="preco" 
value="<?php echo $linha[3]; ?>" ><br>
Código do fornecedor <input type="text" name="cod_fornecedor" 
value="<?php echo $linha[4]; ?>" ><br>
<input type="submit" value="Salvar">	
</form>
