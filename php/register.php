<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8" />
<title>registre teste</title>
</head>
<body>
        aaaa
<?php

require_once("conexao.php");

$nomeU = clean($_POST['name']);
$emailU = clean($_POST['email']);
$senhaU = clean($_POST['password']);

if(!empty($emailU) && !empty($senhaU) && !empty($nomeU) ){
    //INSERT INTO usuario VALUES(DEFAULT,'nome','email','senha' )
    $sql = "INSERT INTO usuario VALUES(DEFAULT,'".$_POST['name']."','".$_POST['email']."','".$_POST['password']."' )";
    $ret = pg_query($conecta, $sql);
    echo"aaaa";
    if($ret){
        
            echo "Data saved Successfully";
    }else{
        
            echo "Soething Went Wrong";
    }
}
?>
</body>
</html>