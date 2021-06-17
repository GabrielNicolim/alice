<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8" />
<title>registre teste</title>
</head>
<body>
<?php

if(!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['name'])){

        require_once("conexao.php");

        $nomeU = clean($_POST['name']);
        $emailU = clean($_POST['email']);
        $senhaU = clean($_POST['password']);

        if(!empty($emailU) && !empty($senhaU) && !empty($nomeU) ){

                $emailcheck = pg_query($conecta,"SELECT * FROM usuario where email='{$emailU}'");
                $count = pg_num_rows($emailcheck);
                if($count > 0){
                        echo "Email Already Registered -> login";
                
                }else{
                        //INSERT INTO usuario VALUES(DEFAULT,'{$nomeU}','{$emailU}',md5('{$senhaU}') )
                        $sql = "INSERT INTO usuario VALUES(DEFAULT,'{$nomeU}','{$emailU}',md5('{$senhaU}') )";
                        $ret = pg_query($conecta, $sql);
                        echo"aaaa";
                        if($ret){
                                echo "Data saved Successfully";
                        }else{
                        
                                echo "Soething Went Wrong";
                        }
                }   
        }else{  
                //echo "<br>Invalid Details";
                header("Location: ../public/views/login.html");
                exit();
        }
}
?>
</body>
</html>