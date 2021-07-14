<?php
    session_start();
    if(isset($_SESSION['isAuth'])){
        header("Location: public/views/home.php ");
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

    <div id="about">
        <h2>Sobre Nós</h2>
        <div class="content">
            <div class="left">
                <p>
                    Somos uma inciativa independente de gerenciamento de estoque, possuímos diversas funcionalidades para a interação com o usuário. 
                    Você pode se cadastrar de forma simplificada utilizando nosso formulário de registro, as informações do usuário podem ser facilmente
                    atualizandas utilizando nosso sistema de gerenciamento de perfil. 
                </p>
            </div>

            <div class="right">
                <i class="fas fa-boxes"></i>
            </div>
        </div> 
    </div>
    
    <div class="container">
        <h2>Nossos Usuários</h2>
        <div class="slider">
            <div class="box">
                <img src="public/images/people1.jpg" alt="">
                <p>Minha empresa vinha procurando um estoque assim a meses, estamos muito felizes que achamos o Storagesy e muito contentes com o resultado. A taxa que é cobrada é a mais honesta no mercado, e a plataforma on-line é muito visual e fácil de manusear. Ótima qualidade!</p>
            </div>
    
            <div class="box">
                <img src="public/images/people2.jpg" alt="">
                <p>Estou muito satisfeito com o Storagesy. Além de um atendimento muito gentil e de fácil acesso, nunca vi um site para estoques com tamanha qualidade, e de maneira simplificada para quem não é muito bom com esse tipo de coisa. Estou feliz com essa empresa, e recomendo.</p>
            </div>
    
            <div class="box">
                <img src="public/images/people3.jpg" alt="">
                <p>Minha família vem procurando um estoque para armazenar nossos bens há anos! Uma pena que achei o Storagesy a pouco tempo. Sempre fui muito preocupada com confiabilidade e qualidade de atendimento, mas a Storagesy atendeu essas preocupações com facilidade. Eu e minha família recomendamos!</p>
            </div>
        </div>
    </div>

    <footer>
        <div class="left"></div>

        <div class="logo btn">
            <a href="index.php"><i class="fas fa-box-open"></i></a>
        </div>

        <div class="right">
            <a href="https://github.com/GabrielNicolim/ALICE">Sobre nós</a>
        </div>
    </footer>
</body>
</html>