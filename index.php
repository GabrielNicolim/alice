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
    <title>Storagesy</title>

    <link rel="shortcut icon" href="public/images/favicon.png" type="image/x-icon">
    
    <script src="https://kit.fontawesome.com/1ab94d0eba.js" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="public/css/index.css">

</head>
<body>
    <header>
        <div class="left">
            STORAGESY
        </div>

        <nav class="right">
            <a href="public/views/login.php" class="btn">
                <span>Login</span> <i class="fas fa-sign-in-alt"></i>
            </a>
        </nav>
    </header>

    <div id="hero">
        <span>Seu estoque na palma da mão</span>
    </div>
    
    <div class="container">
        <h2>Nossos parceiros</h2>
        <div class="slider">
            <div class="box">
                <img src="/public/images/#" alt="">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero quis esse, nisi unde exercitationem dignissimos cum, vel quasi, reprehenderit ipsam neque fugiat excepturi corporis laborum eos ipsa rerum quisquam nihil!</p>
            </div>
    
            <div class="box">
                <img src="/public/images/#" alt="">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia modi ex, doloribus quo, in vel dolorem fugiat facere deserunt maxime explicabo dolore! Porro assumenda repellendus aliquam corrupti consequuntur dolorem nihil!</p>
            </div>
    
            <div class="box">
                <img src="/public/images/#" alt="">
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nihil labore sapiente consectetur esse facilis corporis, fuga odio? Quod cum, corrupti perferendis voluptas id nihil eaque modi non eligendi. Provident, natus.</p>
            </div>
        </div>
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
</body>
</html>