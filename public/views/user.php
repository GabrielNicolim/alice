<?php
    session_start();
    require_once("../../php/connect.php");
    require("../../php/loginValidation.php");
    
    $query = "SELECT id_user, name_user, email_user, password_user FROM users WHERE id_user = $_SESSION[idUser] ";

    $stmt = $conn -> query($query);

    $data = $stmt -> fetchAll(PDO::FETCH_ASSOC);
    
    if(count($data) > 0){
        //  print_r($data);

        $nome = $data[0]['name_user'];
        $idUser = $_SESSION['idUser'];
        $email = $data[0]['email_user'];

        //Quantidade de registros

        $query = "SELECT * FROM user_records WHERE fk_user = $_SESSION[idUser] AND deleted = 'FALSE' "; 

        $stmt = $conn -> query($query);
        $result = $stmt -> fetchAll(PDO::FETCH_ASSOC);
        $numRegistros = $return[0] = count($result);

        //Calcular o valor total do estoque
        $query = "SELECT price_record, quantity_record FROM user_records WHERE $idUser = fk_user AND deleted = 'FALSE'";
        $return = $stmt = $conn -> query($query);
        $valor = 0;
        foreach($return as $i){
            $valor = $valor + $i['price_record']*$i['quantity_record'];
        }

        //Monta os tipos
        $query = "SELECT type_record FROM user_records WHERE $idUser = fk_user AND deleted = 'FALSE' GROUP BY type_record ORDER BY type_record";
        
        $stmt = $conn -> query($query);
        
        $tipo = $stmt -> fetchAll(PDO::FETCH_ASSOC);

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
                            if( !empty($i['type_record']) ){
                                echo$i['type_record'].", ";
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
                echo "<div class='error-edit'>"; 
                if($_GET['error'] == 0) 
                    echo"Seus dados não podem ser alterados!</div>";
                else 
                    echo"Senha incorreta ou alteração mal sucedida!</div>";
            }
            
            $forms = "
            <form action='../../php/alterUserData.php' onsubmit='return userEditValidate(event)' method='POST'>
                <div class='little-title'>Nome</div>
                    <input type='text' name='name' id='name' value='$nome' maxlength='40' required>
                <div class='little-title'>Email</div>
                    <input type='email' name='email' id='email' value='$email' maxlength='128' required>
                <div class='clear'></div>
                    <input type='password' name='confirmPassword' id='confirmPassword' placeholder='Confirmar senha' maxlength='128' required>
                    <input type='submit' class='submitBtn' value='Salvar Alterações'>
            </form>
            ";
            echo$forms;
            ?>
            
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

    <script type="text/javascript" src="../scripts/menuShow.js"></script>
    <script type="text/javascript" src="../scripts/formValidate.js"></script>
    <script type="text/javascript" src="../scripts/userEditValidate.js"></script>
</body>
</html>