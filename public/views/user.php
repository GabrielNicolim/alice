<?php
    session_start();
    require_once("../../php/conexao.php");
    require("../../php/loginValidation.php");
    $sql = "SELECT * FROM usuario WHERE iduser = '{$_SESSION['idUser']}' ";

    $return = pg_query($conecta, $sql);
    $login_check = pg_num_rows($return);
    
    if($login_check > 0){
          
        $linha = pg_fetch_array($return);

        $nome = $linha['nome'];
        $id = $_SESSION['idUser'];
        $email = $linha['email'];

        //Quantidade de registros
        $sql = "SELECT COUNT(*) FROM registros WHERE '{$_SESSION['idUser']}' = fk_user AND excluido = 'FALSE'";
        $return = pg_fetch_row(pg_query($conecta, $sql));    
        $numRegistros = $return[0];

        //Calcular o valor total do estoque
        $sql = "SELECT valorprod,qntprod FROM registros WHERE '{$_SESSION['idUser']}' = fk_user AND excluido = 'FALSE'";
        $return = pg_fetch_all(pg_query($conecta, $sql));
        $valor = 0;
        foreach($return as $i){
            $valor = $valor + $i['valorprod']*$i['qntprod'];
        }

        //Monta os tipos
        $sql = "SELECT tipoprod FROM registros WHERE '{$_SESSION['idUser']}' = fk_user AND excluido = 'FALSE' GROUP BY tipoprod ORDER BY tipoprod";
        $tipo = pg_fetch_all(pg_query($conecta, $sql));

        //echo"<pre>";
        //print_r($tipo);
        //echo"</pre>";
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Storage - Usuário</title>

    <link rel="shortcut icon" href="../images/favicon.png" type="image/x-icon">

    <script src="https://kit.fontawesome.com/1ab94d0eba.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/menu.css">
    <link rel="stylesheet" href="../css/user.css">
</head>
<body>
    <!-- Header -->
    <header>
        <div class="left">
            STORAGESY
        </div>

        <nav class="right btn" id="user">
            <a><i class="fas fa-user-circle" onclick="openMenu()"></i></a>
        </nav>
    </header>

    <div id="menu" class="hidden">
        <div class="close" onclick="closeMenu()">
            <i class="fas fa-times-circle btn"></i>
        </div>

        <div class="body-menu">
            <a href="home.php">
                <div class="menu-btn">Home</div>
            </a>
    
            <a href="user.php">
                <div class="menu-btn">Usuário</div>
            </a>

            <a href="../../php/logout.php">
                <div class="menu-btn">Logout</div>
            </a>
        </div>
    </div>

    <div class="clear"></div>

    <!-- End Header -->

    <div class="container">
        <div class="left">
            <div class="welcome">
                Olá usuário!<br> <?php echo$nome; ?>
            </div>

            <div class="statics">
                <div id="statics-field">
                    
                    <div class="field">Registros</div>
                    <?php echo"<span class='full-screen'>".$numRegistros."</span>"; ?>
    
                    <div class="field">Valor em Estoque</div>
                    <?php echo"<span class='full-screen'>R$ ".$valor."</span>";?>
    
                    <div class="field">Tipos em Estoque</div>
                    <?php 
                    echo"<span class='full-screen'>";
                    foreach($tipo as $i){
                        echo$i['tipoprod'].", ";
                    }
                    echo"</span>";
                    ?>
                </div>

                <div class="responsive">
                    <?php
                    echo "<span>".$email."</span>";
                    echo "<span>".$id."</span>";
                    echo "<span>".$nome."</span>";
                    ?>
                </div>
            </div>
        </div>

        <div class="right">
            <div class="top">
                <h1>Alterar Dados</h1>
            </div>

            <form action="../../php/changeUserData.php" onsubmit="return registerValidate(event)" method="POST">
                <?php 
                echo"<div class='little-title'>Nome</div>";
                echo"<input type='text' name='name' id='name' value='$nome'>";
                echo"<div class='little-title'>Email</div>";
                echo"<input type='email' name='email' id='email' value='$email'>";
                echo"<input type='password' name='password' id='password' placeholder='Senha'>";
                echo"<input type='password' name='confirmPassword' id='confirmPassword' placeholder='Confirmar senha'>";
                ?>
                <input type="submit" class="submitBtn" value="Salvar">
            </form>
        </div>
    </div>

    <footer>
        <div class="left"></div>

        <div class="logo btn">
            <a href="home.php"><i class="fas fa-box-open"></i></a>
        </div>

        <div class="right">
            <a href="https://github.com/GabrielNicolim/ALICE">Sobre nós</a>
        </div>
    </footer>

    <script src="../scripts/menuShow.js"></script>
    <script src="../scripts/formValidate.js"></script>
    <script src="../scripts/registerValidate.js"></script>
</body>
</html>