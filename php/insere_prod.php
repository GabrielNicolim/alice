<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8" />
<title>Grava os produtos na tabela = testeBD1</title>
</head>
<body>

<form action="" method="POST">
    Nome produto: <input type="text" name="nome_prod"><br>
    Quantidade: <input type="text" name="qtd"><br>
    Tipo: <input type="text" name="tipo"><br>
    Preço: <input type="text" name="preco"><br>
    <input type="submit" value="Enviar"><br>
</form> 

<?php
    //$_POST = 'null';
    //print_r($_POST);
    require_once("conexao.php");
    //INSERT INTO registros VALUES(DEFAULT, 'Jamelão', 50 ,'Fruta', 10.50, 'FALSE', 1);
    $nome_prod = $_POST['nome_prod'];
    $qtde = $_POST['qtd'];
    $tipo = $_POST['tipo'];
    $preco = $_POST['preco'];
    $excluido='FALSE';
    $fk_user = 1;

    if(!empty($nome_prod) && !empty($qtde) && !empty($preco) ){
        $sql ="INSERT INTO registros VALUES(DEFAULT, '{$nome_prod}', {$qtde}, '{$tipo}', {$preco}, '{$excluido}', {$fk_user} );";
        
        $resultado = pg_query($conecta,$sql);
        $linhas = pg_affected_rows($resultado);
        if ($linhas > 0)
            echo "Produto gravado !!!<br><br>";
        else	
            echo "Erro na gravação do produto!!!<br><br>";
        //Fecha a conexão com o PostgreSQL
        pg_close($conecta);
        echo "A conexão com o banco de dados foi encerrada!";
    }
?>

</body>
</html>

