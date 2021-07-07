<?php
    session_start();
    require_once("../../php/loginValidation.php");
    require_once("../../php/connect.php");
    require_once("../../php/showData.php");
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
        
        <div class="right">
            <form action="" method="POST">
                <select name="typeSearch" id="typeSearch">
                    <option value="">Tipo</option>
                    <?php
                        $query = "SELECT id_record,name_record,quantity_record,type_record FROM user_records WHERE fk_user = :id AND deleted = 'FALSE'";

                        $stmt = $conn -> prepare($query);

                        $stmt -> bindValue(':id',$_SESSION['idUser']);

                        $stmt -> execute();

                        $result = $stmt -> fetchAll(PDO::FETCH_ASSOC);
                        
                        foreach($result as $i){
                             echo"<option value='".$i['type_record']."'>
                                Tipo ".$i['type_record']; 
                                if(empty($i['type_record']))echo"Vazio";
                             echo"</option>";
                        }

                        $restriction = $_POST;
                    ?>
                </select>
                <input type="text" name="textSearch" id="textSearch" placeholder="Pesquisa">
                
                <input type="submit" id="submitSearch" class="hidden">
                <label for="submitSearch"><i class="fas fa-search"></i></label>
            </form>
        </div>
    </div>

    <div class="container">
        <?php
            showBoxes($restriction);
        ?>      
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
            <input type="text" name="name" id="name" placeholder="Nome" maxlength="20">
            <input type="number" name="quantity" id="quantity" placeholder="Quantidade" min="0" max="9999999999">
            <input type="number" name="price" min="0" step=".01" id="price" placeholder="Preço" min="0" max="9999999999">
            <input type="text" name="type" id="type" placeholder="Tipo" maxlength="20">
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
            <input type="text" name="name" id="editName" placeholder="Nome" maxlength="20">
            <input type="number" name="quantity" id="editQuantity" placeholder="Quantidade" min="0" max="9999999999">
            <input type="number" name="price" min="0" step=".01" id="editPrice" placeholder="Preço" min="0" max="9999999999">
            <input type="text" name="type" id="editType" placeholder="Tipo" maxlength="20">
            <input type="submit" class="submitBtn" value="Salvar Edição">
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
            <input type="text" name="name" id="excludeName" placeholder="Nome" disabled>
            <input type="number" name="quantity" id="excludeQuantity" placeholder="Quantidade" disabled>
            <input type="number" name="price" min="0" step=".01" id="excludePrice" placeholder="Preço" disabled>
            <input type="text" name="type" id="excludeType" placeholder="Tipo" disabled>
            <input type="submit" class="submitBtn" value="Confirmar">
        </form>
    </div>

    <script type="text/javascript" src="../scripts/menuShow.js"></script>
    <script type="text/javascript" src="../scripts/modalShow.js"></script>
    <script type="text/javascript" src="../scripts/formValidate.js"></script>
    <script type="text/javascript" src="../scripts/createValidate.js"></script>
</body>
</html>
