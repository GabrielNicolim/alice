<?php
    session_start();
    require_once("../../php/loginValidation.php");
    require_once("../../php/conexao.php");
    include("../../php/insertData.php");
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
        <!--
        <div class="right">
            <form action="" class="fas fa-plus left">
                Pesquisa <input type="text">
            </form>
        </div>  Futura busca -->
    </div>

    <div class="container">
        <!-- Base box -->
        <?php 

            $sql = "SELECT idregistro,nomeprod,qntprod,tipoprod,valorprod FROM registros WHERE '{$_SESSION['idUser']}' = fk_user AND excluido = 'FALSE'";

            $return = pg_query($conecta, $sql);
            $_SESSION['ids'] = pg_fetch_all($return);
            $numero = pg_num_rows($return);

            //print('<pre>');
            //print_r($linha);
            //print('</pre>');

            //Irá instanciar a matriz com os registros e seus arrays internos de dados, printando a informação na tela
            foreach($_SESSION['ids'] as $obj){
                
                echo"<div class='box'>";
                echo"<div class='title'>";
                        echo"<span>".$obj['nomeprod']; if( $obj['nomeprod'] == '' || $obj['nomeprod'] == ' ' || $obj['nomeprod'] == null) echo"Registro #".$obj['idregistro']."</span>";

                        echo"<i class='fas fa-trash-alt trash' onclick='openExclude(".$obj['idregistro'].")'></i>";
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

                    echo"<div class='edit' onclick='openEdit(".$obj['idregistro'].")'>";
                        echo"Editar";
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

    <!-- Create -->
    <div id="shadow" class="hidden" onclick="closeCreate(),closeEdit(), closeExclude()"></div>
    <div id="create" class="hidden">
        <div class="top">
            <h3>Criar</h3>

            <div class="close" onclick="closeCreate()">
                    <i class="fas fa-times-circle btn"></i>
            </div>
        </div>
        <form action="../../php/insertData.php" onsubmit="return createValidate(event);" method="POST">
            <input type="text" name="name" id="name" placeholder="Nome">
            <input type="number" name="quantity" id="quantity" placeholder="Quantidade">
            <input type="number" name="price" min="0" step=".01" id="price" placeholder="Preço">
            <input type="text" name="type" id="type" placeholder="Tipo">
            <input type="submit" class="submitBtn" value="Adicionar">
        </form>
    </div>

    <!-- Edit -->
    <div id="edit" class="hidden">
        <div class="top">
            <h3>Editar</h3>

            <div class="close" onclick="closeEdit()">
                    <i class="fas fa-times-circle btn"></i>
            </div>
        </div>
        <form action="../../php/editData.php" onsubmit="return createValidate(event)" method="POST">
            <input type="text" class="hidden" name="editInput" id="editInput">
            <input type="text" name="name" id="name" value="<?php echo"aaaa"; ?>">
            <input type="number" name="quantity" id="quantity" placeholder="Quantidade">
            <input type="number" name="price" min="0" step=".01" id="price" placeholder="Preço">
            <input type="text" name="type" id="type" placeholder="Tipo">
            <input type="submit" class="submitBtn" value="Adicionar">
        </form>
    </div>

    <!-- Exclude: exclusão lógica-->
    <div id="exclude" class="hidden">
        <div class="top">
            <h3>Excluir</h3>

            <div class="close" onclick="closeExclude()">
                    <i class="fas fa-times-circle btn"></i>
            </div>
        </div>
        
        <form action="../../php/deleteData.php" method="POST">
            <input type="text" class="hidden" name="exclude" id="excludeInput">
            <input type="text" name="name" id="name" value="<?php $exclusao = $_POST['exclude'];  echo$exclusao; ?>" disabled>
            <input type="number" name="quantity" id="quantity" placeholder="Quantidade" disabled>
            <input type="number" name="price" min="0" step=".01" id="price" placeholder="Preço" disabled>
            <input type="text" name="type" id="type" placeholder="Tipo" disabled>
            <input type="submit" class="submitBtn" value="Confirmar">
        </form>
    </div>

    <script src="../scripts/menuShow.js"></script>
    <script src="../scripts/modalShow.js"></script>
    <script src="../scripts/formValidate.js"></script>
    <script src="../scripts/createValidate.js"></script>
</body>
</html>
