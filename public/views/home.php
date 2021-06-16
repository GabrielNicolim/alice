<?php
    session_start();
    require_once("../../php/loginValidation.php");
    require_once("../../php/conexao.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Storage - Home</title>

    <link rel="shortcut icon" href="../images/favicon.png" type="image/x-icon">

    <script src="https://kit.fontawesome.com/1ab94d0eba.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/menu.css">
    <link rel="stylesheet" href="../css/home.css">
 
</head>
<body>
    <!-- Header -->
    <header>
        <div class="left">
            STORAGESY
        </div>

        <nav class="right btn" id="user">
            <i class="fas fa-user-circle" id="user" onclick="openMenu()"></i>
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

    <div class="add">
        <div class="left" onclick="openCreate()">
            <i class="fas fa-plus"></i>

            <span>
                Add new 
            </span>
        </div>

        <div></div> <!-- Futura busca -->
    </div>

    <div class="container">

        <!-- Base box -->
        <?php

            $sql = "SELECT nomeprod,qntprod,tipoprod,valorprod FROM registros WHERE '{$_SESSION['idUser']}' = fk_user";

            $return = pg_query($conecta, $sql);
            $linha = pg_fetch_all($return);
            $numero = pg_num_rows($return);

            //print('<pre>');
            //print_r($linha);
            //print('</pre>');

            //Irá instanciar a matriz com os registros e seus arrays internos de dados, printando td na tela
            foreach($linha as $obj){
            
                echo"<div class='box'>";
                echo"<div class='title'>";
                        echo"<span>".$obj['nomeprod']."</span>";
                echo"</div>";

                    echo"<div class='data'>";
                        echo"<div class='quantity'>";
                            echo"Quantidade";
                        echo"</div>";
                        echo"<span>".$obj['qntprod']."</span>";

                        echo"<div class='type'>";
                            echo"Tipo";
                        echo"</div>";
                        echo"<span>".$obj['tipoprod']."</span>";

                        echo"<div class='type'>";
                            echo"Valor";
                        echo"</div>";
                        echo"<span>".$obj['valorprod']."</span>";

                    echo"</div>";

                    echo"<div class='edit'>";
                        echo"<a href='#'>Editar</a>";
                    echo"</div>";
                echo"</div>";
            }
        ?>
        <!-- End Base box -->

    </div>
         
    <footer>
        <div class="left"></div>

        <div class="logo btn">
            <a href="#"><i class="fas fa-box-open"></i></a>
        </div>

        <div class="right">
            <a href="https://github.com/GabrielNicolim/ALICE">Sobre nós</a>
        </div>
    </footer>

    <!-- Formulário para receber dados -->
    <div id="shadow" class="hidden" onclick="closeCreate()"></div>
    <div id="create" class="hidden">
        <div class="top">
            <h3>Create</h3>

            <div class="close" onclick="closeCreate()">
                    <i class="fas fa-times-circle btn"></i>
            </div>
        </div>
        <form action="" onsubmit="return registerValidate(event)" method="POST">
            <input type="text" name="name" id="name" placeholder="Nome">
            <input type="number" name="quantity" id="quantity" placeholder="Quantidade">
            <input type="number" name="price" min="0" step=".01" id="price" placeholder="Preço">
            <input type="text" name="type" id="type" placeholder="Tipo">
            <input type="submit" class="submitBtn" value="Adicionar">
        </form>
    </div>

    <script src="../scripts/menuShow.js"></script>
    <script src="../scripts/createShow.js"></script>
</body>
</html>

<?php

    $sql = "SELECT * FROM usuario WHERE iduser = '{$_SESSION['idUser']}' ";

    $return = pg_query($conecta, $sql);
    $login_check = pg_num_rows($return);
    
    if(!empty($_POST['name']) && !empty($_POST['quantity']) && !empty($_POST['price']) && !empty($_POST['type']) ){
        if($login_check > 0){

            $nome = $_POST['name'];
            $qnt = $_POST['quantity'];
            $preco = $_POST['price'];
            $tipo = $_POST['type'];

            //$linha = pg_fetch_array($return);

            $sql = "INSERT INTO registros VALUES(DEFAULT,'{$nome}','{$qnt}','{$tipo}','{$preco}','FALSE','{$_SESSION['idUser']}' )";

            $return = pg_query($conecta, $sql);
    
            if($return){
                print_r( "Data saved Successfully");
                header('location: home.php');
                exit;
            }else{
                print_r(  "Something Went Wrong");
                //header("Location: register.php?erro=1");
                //exit();
            }
            
        }
    }
?>
