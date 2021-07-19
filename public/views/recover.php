<?php
    session_start();
    
    if(isset($_SESSION['isAuth'])) {
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
    <title>Recuperar Senha</title>

    <link rel="shortcut icon" href="../images/favicon.png" type="image/x-icon">

    <script src="https://kit.fontawesome.com/1ab94d0eba.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/form.css">
</head>
<body>
    <div class="container">
        <div class="top">
            <h1>Recuperar Senha</h1>

            <div class="return">
                <a href="../../index.php" class="btn">
                    <i class="fas fa-arrow-alt-circle-right"></i>
                </a>
            </div>
        </div>
		<?php
            if (isset($_GET['message'])) {
                if ($_GET['message'] == 0) {
                    echo "<div class='error-login'>Se esse email estiver cadastrado, enviaremos um email para ele!</div>";
                } else {
                    echo "<div class='error-login'>Campos vazios ou com caracteres não permitidos!</div>";
                }
            }
            include("../../php/functions.php");
            $ipRequest = getUserIP();
        ?>
        
        <form action="../../php/recoverLogic.php" onsubmit="return RecoverValidate(event)" method="POST">
            <input type="hidden" name="ipRequest" value="<?php echo$ipRequest ?>">
            <input type="email" name="email" id="email" placeholder="Email" maxlength='128'>

            <input type="submit" class="submitBtn" value="Recuperar senha">
        </form>

        <div class="register">
            <span>Não tem uma conta? <a href="register.php">Cadastre-se</a></span>
        </div>

        <div class="register">
            <span>Lembrou da senha? <a href="login.php">Entrar</a></span>
        </div>
    </div>

    <script type="text/javascript" src="../scripts/formValidate.js"></script>
    <script type="text/javascript" src="../scripts/recoverValidate.js"></script>
</body>
</html>