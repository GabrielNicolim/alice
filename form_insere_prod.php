<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8" />
<title>Formulário de Cadastro de Produtos - testeBD1</title>
</head>
<body>
<h1>Cadastro de Produtos - testeBD1</h1>
<form action="insere_prod.php" method="post">
<label>
<strong>Descricao:</strong><br />    
<input type="text" name="descricao" /><br />
<br />
</label>
<label>
<strong>Quantidade:</strong><br />
<input type="text" name="qtde" /><br />
<br />
</label>
<label>
<strong>Preço:</strong><br />
<input type="text" name="preco"  /><br />
<br />
</label>
<label>
<strong>Código do Fornecedor:</strong><br />
<input type="text" name="cod_fornecedor" /><br />
<br />
</label>
<input type="submit" name="button" id="button" value="Enviar" />
</form> 
</body>
</html>