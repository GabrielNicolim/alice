<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>

    <link rel="shortcut icon" href="../images/favicon.png" type="image/x-icon">

    <script src="https://kit.fontawesome.com/1ab94d0eba.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/form.css">
</head>
<body>
    <div class="container">
        <div class="top">
            <h1>Cadastro</h1>

            <div class="return">
                <a href="../../index.html" class="btn">
                    <i class="fas fa-arrow-alt-circle-right"></i>
                </a>
            </div>
        </div>

        <form action="" onsubmit="return registerValidate(event)" method="POST">
            <input type="text" name="name" id="name" placeholder="Nome">
            <input type="email" name="email" id="email" placeholder="Email">
            <input type="password" name="password" id="password" placeholder="Senha">
            <input type="password" name="confirmPassword" id="confirmPassword" placeholder="Confirmar senha">
            <input type="submit" class="submitBtn" value="Cadastrar-se">
        </form>

        <div class="register">
            <span>Já possui um cadastro? <a href="login.html">Entrar</a></span>
        </div>
    </div>

    <script src="../scripts/formValidate.js"></script>
    <script src="../scripts/registerValidate.js"></script>
</body>
</html>

<?php

if(!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['name'])){

        require_once("../../php/conexao.php");

        $nomeU = pg_escape_string( clean($_POST['name']) );
        $emailU = pg_escape_string( clean($_POST['email']) );
        $senhaU = pg_escape_string( clean($_POST['password']) );

        if(!empty($emailU) && !empty($senhaU) && !empty($nomeU) ){

                $emailcheck = pg_query($conecta,"SELECT * FROM usuario where email='{$emailU}'");
                $count = pg_num_rows($emailcheck);
                if($count > 0){
                        print_r( "Email Already Registered -> login");
                
                }else{
                        //INSERT INTO usuario VALUES(DEFAULT,'{$nomeU}','{$emailU}',md5('{$senhaU}') )
                        $sql = "INSERT INTO usuario VALUES(DEFAULT,'{$nomeU}','{$emailU}',md5('{$senhaU}') )";
                        $ret = pg_query($conecta, $sql);
                        echo"aaaa";
                        if($ret){
                                print_r( "Data saved Successfully");
				
                        }else{
                        
                                print_r(  "Something Went Wrong");
                        }
                }   
        }else{  
                //echo "<br>Invalid Details";
                header("Location: register.php");
                exit();
        }
}
?>
