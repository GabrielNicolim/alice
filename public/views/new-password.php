<?php

require("../../php/loginValidation.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nova senha</title>

    <link rel="shortcut icon" href="../images/favicon.png" type="image/x-icon">

    <script src="https://kit.fontawesome.com/1ab94d0eba.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/form.css">
</head>
<body>
    <div class="container">
        <div class="top">
            <h1>Criar nova senha</h1>

            <div class="return">
                <a href="../../index.php" class="btn">
                    <i class="fas fa-arrow-alt-circle-right"></i>
                </a>
            </div>
        </div>
		<?php
            $selector = $_GET['selector'];
            $validator = $_GET['validator'];
            if (empty($selector) || empty($validator) ) {
                echo "<div class='error-login'>Não pudemos validar sua requisição!!</div>";
            } else if(ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false){
            ?>

            <form action="../../php/recoverLogic.php" onsubmit="return RecoverValidate(event)" method="POST">
                <input type="hidden" name="selector" value="<?php echo$selector; ?>">
                <input type="hidden" name="validator" value="<?php echo$validator; ?>">

                <input type="password" name="pwd" id="pwd" placeholder="Senha" maxlength='128'>
                <input type="password" name="pwd-repeat" id="pwd" placeholder="Repita a senha" maxlength='128'>

                <input type="submit" name="reset-password-submit" class="submitBtn" value="Recuperar senha">
            </form>

        <?php
            }
        ?>
        
        <div class="register">
            <span>Não tem uma conta? <a href="register.php">Cadastre-se</a></span>
        </div>

        <div class="register">
            <span>Já possui um cadastro? <a href="login.php">Entrar</a></span>
        </div>
    </div>

    <script type="text/javascript" src="../scripts/formValidate.js"></script>
    <script type="text/javascript" src="../scripts/recoverValidate.js"></script>
</body>
</html>