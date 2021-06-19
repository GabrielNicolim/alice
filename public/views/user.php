<?php
    session_start();
    require_once("../../php/conexao.php");
    require("../../php/loginValidation.php");
    
    $sql = "SELECT * FROM usuarios WHERE id_user = $_SESSION[idUser] ";

    $return = pg_query($conecta, $sql);
    $login_check = pg_num_rows($return);

    if($login_check > 0){
          
        $linha = pg_fetch_array($return);

        $nome = $linha['nome'];
        $idUser = $_SESSION['idUser'];
        $email = $linha['email'];

        //Quantidade de registros
        $sql = "SELECT COUNT(*) FROM registros WHERE $idUser = fk_user AND excluido = 'FALSE'";
        $return = pg_fetch_row(pg_query($conecta, $sql));    
        $numRegistros = $return[0];

        //Calcular o valor total do estoque
        $sql = "SELECT valorprod,qntprod FROM registros WHERE $idUser = fk_user AND excluido = 'FALSE'";
        $return = pg_fetch_all(pg_query($conecta, $sql));
        $valor = 0;
        foreach($return as $i){
            $valor = $valor + $i['valorprod']*$i['qntprod'];
        }

        //Monta os tipos
        $sql = "SELECT tipoprod FROM registros WHERE $idUser = fk_user AND excluido = 'FALSE' GROUP BY tipoprod ORDER BY tipoprod";
        $tipo = pg_fetch_all(pg_query($conecta, $sql));

    }else{
        echo "<script type='text/javascript'>alert('Ocorreu um problema no seu login, tente sair e entrar da conta!!!')</script>";
        //header('location: home.php');
        //exit;
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
                Olá <?php echo$nome; if(empty($nome))echo"Usuário".$_SESSION['idUser'];?>!
            </div>

            <div class="statics">
                <div id="statics-field">
                    
                    <div class="field">Registros</div>
                    <?php echo"<span class='full-screen'>".$numRegistros."</span>"; ?>
    
                    <div class="field">Valor em Estoque</div>
                    <?php echo"<span class='full-screen'>R$ ".$valor."</span>";?>
    
                    <div class="field" id="showTypes">Tipos em Estoque</div>
                    <?php 
                    echo"<span class='full-screen'>";
                    if( empty($i) ) echo "Tipos Vazio";
                    else{
                        foreach($tipo as $i){
                            if( !empty($i['tipoprod']) ){
                                echo$i['tipoprod'].", ";
                            }
                        }
                    }
                    echo"</span>";
                    ?>
                </div>

                <div class="responsive">
                    <?php
                    echo "<span>".$numRegistros."</span>";
                    echo "<span>R$ ".$valor."</span>";
                    //echo "<span>"; foreach($tipo as $i){ echo$i['tipoprod'].", "; }"</span>";
                    ?>
                </div>
            </div>
        </div>

        <div class="right">
            <div class="top">
                <h1>Alterar Dados</h1>
            </div>
            <?php
            if(isset($_GET['error'])){
            echo "<div class='error-edit'>"; if($_GET['error'] == 0) echo"Seus dados não podem ser alterados!</div>"; else echo"Senha incorreta ou alteração mal sucedida!</div>";} //"; 
            ?>
            <form action="../../php/alterUserData.php" onsubmit="return userEditValidate(event)" method="POST">
                <?php 
                echo"<div class='little-title'>Nome</div>";
                echo"<input type='text' name='name' id='name' value='$nome' maxlength='40' required>";
                echo"<div class='little-title'>Email</div>";
                echo"<input type='email' name='email' id='email' value='$email' maxlength='128' required>";
                echo"<div class='clear'></div>";
                echo"<input type='password' name='confirmPassword' id='confirmPassword' placeholder='Confirmar senha' required>";
                ?>
                <input type="submit" class="submitBtn" value="Salvar Alterações">
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
    <script src="../scripts/userEditValidate.js"></script>
</body>
</html>