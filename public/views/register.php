<?php
    session_start();
?>
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
                <a href="../../index.php" class="btn">
                    <i class="fas fa-arrow-alt-circle-right"></i>
                </a>
            </div>
        </div>
        <?php 
            if($_GET['erro'] == 1)
                echo "<div class='error-login'>Login ou senha estão invalidos!</div>";
            if($_GET['erro'] == 2)
                echo "<div class='error-login'>Email já cadastrado! <a class='btn' href='login.php'>Faça login</a></div>";
        ?>
        <form action="" onsubmit="return registerValidate(event)" method="POST">
            <input type="text" name="name" id="name" placeholder="Nome"  maxlength='40'>
            <input type="email" name="email" id="email" placeholder="Email" maxlength='128'>
            <input type="password" name="password" id="password" placeholder="Senha">
            <input type="password" name="confirmPassword" id="confirmPassword" placeholder="Confirmar senha">
            <input type="submit" class="submitBtn" value="Cadastrar-se">
        </form>

        <div class="register">
            <span>Já possui um cadastro? <a href="login.php">Entrar</a></span>
        </div>
    </div>

    <script src="../scripts/formValidate.js"></script>
    <script src="../scripts/registerValidate.js"></script>
</body>
</html>

<?php

if(!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password']) ){

        require_once("../../php/conexao.php");

        $nomeU = cleanString($_POST['name']) ;
        $emailU = cleanString($_POST['email']) ;
        $senhaU = cleanString($_POST['password']) ;

        if(!empty($emailU) && !empty($senhaU) && !empty($nomeU) ){

            $emailcheck = pg_query($conecta,"SELECT * FROM usuarios where email='$emailU' ");
            $count = pg_num_rows($emailcheck);
            if($count > 0){
                header("Location: register.php?erro=2");
                exit();
            }else{

                    $sql = "INSERT INTO usuarios VALUES(DEFAULT,'$nomeU','$emailU',md5('$senhaU') )";
                    $return = pg_query($conecta, $sql);

                    if($return){
                        $sql = "SELECT id_user FROM usuarios WHERE email ='$emailU' AND senha = md5('$senhaU')";
                        
                        $linha = pg_fetch_array(pg_query($conecta, $sql));

                        //print_r( "Data saved Successfully");
                        $_SESSION['isAuth'] = TRUE;
                        $_SESSION['idUser'] = $linha['id_user'];
                        header("Location: home.php");
                        exit();
                    }else{
                        //print_r(  "Something Went Wrong");
                        header("Location: register.php?erro=1");
                        exit();
                    }
            }   
        }else{  
                header("Location: register.php?erro=1");
                exit();
        }
}
?>
