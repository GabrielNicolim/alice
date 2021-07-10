<?php
    session_start();
    if(isset($_SESSION['isAuth'])){
        header("Location: home.php ");
	    exit();
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
                <a href="../../index.php" class="btn">
                    <i class="fas fa-arrow-alt-circle-right"></i>
                </a>
            </div>
        </div>
		<?php
            if(isset($_GET['error'])) {
                if($_GET['error']) {
                    echo "<div class='error-login'>Login invalido!</div>"; 
                }
            }
        ?>
        <form action="../../php/loginLogic.php" onsubmit="return loginValidate(event)" method="POST">
            <input type="email" name="email" id="email" placeholder="Email" maxlength='128'>
            <input type="password" name="password" id="password" placeholder="Senha" maxlength='128'>

            <div onclick="showPassword()">
                <input type="checkbox" name="showPassword" id="showPassword" maxlength='128'>
                <label for="showPassword">Apresentar senha</label>
            </div>
            <input type="submit" class="submitBtn" value="Entrar">
        </form>

        <div class="register">
            <span>Não tem uma conta? <a href="register.php">Cadastre-se</a></span>
        </div>
    </div>

    <script type="text/javascript" src="../scripts/formValidate.js"></script>
    <script type="text/javascript" src="../scripts/loginValidate.js"></script>
</body>
</html>