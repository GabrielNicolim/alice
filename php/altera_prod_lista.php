<?php
include "conexao.php";
//dados enviados do script altera_prod.php
$cod_produto = $_GET["cod_produto"];
$sql="SELECT * FROM produtos WHERE cod_produto = $cod_produto;";
$resultado=pg_query($conecta,$sql);
$qtde=pg_num_rows($resultado);
if ( $qtde == 0 )
{
echo "Produto nao encontrado  !!!<br><br>";
exit;
}
$linha = pg_fetch_array($resultado);
?>
<form action="grava_prod_alterado.php" method="post">
<h1>Alteração de Produtos - testeBD1</h1>
Código do produto <input type="text" name="cod_produto" 
value="<?php echo $linha[cod_produto]; ?>" readonly><br>
Descrição <input type="text" name="descricao" 
value="<?php echo $linha[descricao]; ?>" ><br>
Quantidade <input type="text" name="qtde_" 
 value="<?php echo $linha[qtde]; ?>" ><br>
Preço <input type="text" name="preco" 
 value="<?php echo $linha[preco]; ?>" ><br>
Código do fornecedor <input type="text" name="cod_fornecedor" 
value="<?php echo $linha[cod_fornecedor]; ?>" ><br>
<input type="submit" value="Gravar">
<input type="reset" value="Voltar"> //Não está voltando
</form>