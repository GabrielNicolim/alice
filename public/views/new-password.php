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
            if ( !isset($_GET['selector']) || !isset($_GET['validator']) ) {
                echo "<div class='error-login'>Não pudemos validar sua requisição!!</div>";
            } else {

                if( isset($_GET['newpwd'])) {
                    switch ($_GET['newpwd']) {
                        case 'error':
                            echo "<div class='error-login'>Ocorreu um erro setando sua nova senha!!</div>";
                        break;
                        case 'invalid':
                            echo "<div class='error-login'>Sua senha precisa ter pelo menos um numero, uma letra maiuscula e 6 caracteres!!</div>";
                        break;
                        case 'pwdnotsame':
                            echo "<div class='error-login'>As senhas precisam ser iguais!!</div>";
                        break;
                        default:
                            echo "<div class='error-login'>Ocorreu um erro brabo!!</div>";
                        break;
                    }
                }   

                $selector = $_GET['selector'];
                $validator = $_GET['validator'];
                
                if ( !empty($selector) && !empty($validator) && ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false) {   
            ?>

                <form action="../../php/changePasswordDB.php" onsubmit="return RecoverValidate(event)" method="POST">
                    <input type="hidden" name="selector" value="<?php echo$selector; ?>">
                    <input type="hidden" name="validator" value="<?php echo$validator; ?>">

                    <div id="password-box">
                        <input type="password" name="password" id="password" placeholder="Senha" maxlength='128' onkeyup="passwordValidate()">
                        <img src="../images/eye-off.svg" id="icon" onclick="showPassword()">

                        <div id="password-error-box"></div>
                    </div>
                    <input type="password" name="password-repeat" id="pwd-repeat" placeholder="Confirme a nova senha" maxlength='128'>

                    <input type="submit" name="reset-password-submit" class="submitBtn" value="Alterar senha">
                </form>

            <?php
                }
            }
            ?>
        
        <div class="register">
            <span>Não tem uma conta? <a href="register.php">Cadastre-se</a></span>
        </div>

        <div class="register">
            <span>Lembrou a senha? <a href="login.php">Entrar</a></span>
        </div>
    </div>

    <script type="text/javascript" src="../scripts/formValidate.js"></script>
    <script type="text/javascript" src="../scripts/registerValidate.js"></script>
    <script type="text/javascript" src="../scripts/showPassword.js"></script>
</body>
</html>