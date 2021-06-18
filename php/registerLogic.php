<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8" />
<title>Registro temporario</title>
</head>
<body>
<?php

        require_once("conexao.php");

        $nomeU = cleanString($_POST['name']);
        $emailU = cleanString($_POST['email']);
        $senhaU = cleanString($_POST['password']);

        if(!empty($emailU) && !empty($senhaU) && !empty($nomeU)){

                $emailcheck = pg_query($conecta,"SELECT * FROM usuarios where email='{$emailU}'");
                $count = pg_num_rows($emailcheck);
                if($count > 0){
                        echo "Email Already Registered -> login";
                
                }else{
                        //INSERT INTO usuarios VALUES(DEFAULT,'{$nomeU}','{$emailU}',md5('{$senhaU}') )
                        $sql = "INSERT INTO usuarios VALUES(DEFAULT,'{$nomeU}','{$emailU}',md5('{$senhaU}') )";
                        $ret = pg_query($conecta, $sql);
                        echo"aaaa";
                        if($ret){
                                echo "Data saved Successfully";
                        }else{
                        
                                echo "Soething Went Wrong";
                        }
                }   

        } 
        else{  
                //echo "<br>Invalid Details";
                header("Location: ../public/views/login.html");
                exit();
        }
?>
</body>
</html>