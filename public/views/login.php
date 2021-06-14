<?php
    session_start();
    if(isset($_SESSION['isAuth'])){
        header("Location: home.html ");
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="shortcut icon" href="../images/favicon.png" type="image/x-icon">

    <script src="https://kit.fontawesome.com/1ab94d0eba.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/form.css">
</head>
<body>
    <div class="container">
        <div class="top">
            <h1>Login</h1>

            <div class="return">
                <a href="../../index.html" class="btn">
                    <i class="fas fa-arrow-alt-circle-right"></i>
                </a>
            </div>
        </div>

        <form action="" onsubmit="return loginValidate(event)" method="POST">
            <input type="email" name="email" id="email" placeholder="Email">
            <input type="password" name="password" id="password" placeholder="Senha">

            <div onclick="showPassword()">
                <input type="checkbox" name="showPassword" id="showPassword">
                <label for="showPassword">Apresentar senha</label>
            </div>

            <input type="submit" class="submitBtn" value="Entrar">
        </form>

        <div class="register">
            <span>Não tem uma conta? <a href="register.html">Cadastre-se</a></span>
        </div>
    </div>

    <script src="../scripts/formValidate.js"></script>
    <script src="../scripts/loginValidate.js"></script>
</body>
</html>

<?php print_r($_POST);
//Provar que funcionou mostrando os dados que você enviou
if(!empty($_POST['email']) && !empty($_POST['password'])){
    require_once("conexao.php");
    

    $emailU = pg_escape_string( clean($_POST['email']) );
    $senhaU = pg_escape_string( clean($_POST['password']) );

    //Se os campos não estiverem vazios depois da limpeza:
    if(!empty($emailU) && !empty($senhaU)){
        try {

            $sql = "SELECT * FROM usuario WHERE email ='{$emailU}' AND senha = md5('{$senhaU}')";
            
            $resultado = pg_query($conecta, $sql);  echo $resultado;
            $login_check = pg_num_rows($resultado);
            
            if($login_check > 0){ 
                
                //echo "<br>Login Successfully";
                unset($_SESSION['OLD_DATA']);
                $_SESSION['usuario'] = $emailU;
                $_SESSION['isAuth'] = true;
        
                //redireciona a pessoa para a home     
                header("Location: home.html");
                exit();
        
            }else{  
                //echo "<br>Invalid Details";
                header("Location: login.html");
                exit();
            }
        } catch (PDOException $e) {
            echo "Error: '.$e->getCode()' Mensagem: ' .$e->getMessage()'";
        }
    }
}

?>