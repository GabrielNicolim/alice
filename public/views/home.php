<?php
    session_start();
    if(!isset($_SESSION['isAuth'])){
        header("Location: login.php ");
	exit();
    }
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
    
            <a href="">
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
        <div class="box">
            <div class="title">
                Name
            </div>

            <div class="data">
                <div class="quantity">
                    Quantidade
                </div>

                <span>123</span>

                <div class="type">
                    Tipo
                </div>

                <span>Eletrônico</span>
            </div>

            <div class="edit">
                <a href="#">Editar</a>
            </div>
        </div>

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
            <input type="number" name="price" id="price" placeholder="Preço">
            <input type="text" name="type" id="type" placeholder="Tipo">
            <input type="submit" class="submitBtn" value="Adicionar">
        </form>
    </div>

    <script src="../scripts/menuShow.js"></script>
    <script src="../scripts/createShow.js"></script>
</body>
</html>