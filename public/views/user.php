<?php
    session_start();
    require_once("../../php/connect.php");
    require("../../php/loginValidation.php");
    
    try{
        
        $query = "SELECT id_user, name_user, email_user, password_user FROM users WHERE id_user = $_SESSION[idUser] ";

        $stmt = $conn -> query($query);

        $data = $stmt -> fetchAll(PDO::FETCH_ASSOC);
        
        if(count($data) > 0){

            $nome = $data[0]['name_user'];
            $idUser = $_SESSION['idUser'];
            $email = $data[0]['email_user'];

            //Quantity of records
            $query = "SELECT * FROM user_records WHERE fk_user = $_SESSION[idUser] AND deleted = 'FALSE' "; 

            $stmt = $conn -> query($query);
            $return = $stmt -> fetchAll(PDO::FETCH_ASSOC);
            $numRegistros = count($return);

            //Calculate the net worth of the stock
            $query = "SELECT price_record, quantity_record FROM user_records WHERE $idUser = fk_user AND deleted = 'FALSE'";
            $stmt = $conn -> query($query);
            
            $valor = 0;
            foreach($stmt as $i){
                $valor = $valor + $i['price_record']*$i['quantity_record'];
            }

            //Build the types
            $query = "SELECT type_record FROM user_records WHERE $idUser = fk_user AND deleted = 'FALSE' GROUP BY type_record ORDER BY type_record";
            $stmt = $conn -> query($query);
            $tipos = $stmt -> fetchAll(PDO::FETCH_ASSOC);

        }else throw new Exception("Ocorreu um erro no seu login, tente entrar novamente");

    }catch(Exception $e){
        //echo"Exceção capturada: ".$e->getMessage();
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
    <title>Storage - Usuário</title>

    <link rel="shortcut icon" href="../images/favicon.png" type="image/x-icon">

    <script src="https://kit.fontawesome.com/1ab94d0eba.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/menu.css">
    <link rel="stylesheet" href="../css/user.css">
    <link rel="stylesheet" href="../css/modal.css">
    <!-- Magic Ajax to make Image Preview-->
    <script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>
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

    <div id="bgMenu" onclick="closeMenu()" class="hidden"></div>
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
            <?php
            
                $query = "SELECT filename FROM user_picture WHERE fk_user = ".$_SESSION['idUser'];
        
                $stmt = $conn -> query($query);
                
                $filename = $stmt -> fetchAll(PDO::FETCH_ASSOC);
            
                echo "<div class='photo'>";
  
                    try {
                        if (count($filename) > 0) {

                            $path = $_SERVER['DOCUMENT_ROOT']."/ALICE/public/profile_pictures/".$filename[0]['filename'];
                            //If file exists in database but not in the folder
                            if (!file_exists($path)) {
                                throw new Exception('Arquivo não foi encontrado na pasta de imagens');
                            }
    
                            echo"<img src='../profile_pictures/".$filename[0]['filename']."' alt='".$filename[0]['filename']."' width='150px' height='150px'>";
                            
                        } else {
                            throw new Exception('Arquivo não foi encontrado no DB');
                        }
                    }
                    catch (Exception $e) {
                        //echo"Exceção capturada: ".$e->getMessage();

                        //Remove bugged photos from DB
                        if (count($filename) > 0) {
                            $query = "DELETE FROM user_picture WHERE filename = '".$filename[0]['filename']."' AND fk_user = ".$_SESSION['idUser'];
        
                            $stmt = $conn -> query($query);
                        }
                        //Rollback photo
                        echo"<i class='fas fa-user-circle'></i>";
                    }

                    echo "<i class='fas fa-edit' onclick='openEditUser(".$_SESSION['idUser'].")'></i>
                    </div>
            
                    <span>Olá ".$nome; 
                    if (empty($nome)) echo"Usuário".$_SESSION['idUser'];
                    echo"!
                    </span>";
                
                ?>
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
                        if ( !empty($i) ) {
                            foreach($tipos as $i){
                                if ( !empty($i['type_record']) ) {
                                    echo$i['type_record'].", ";
                                }
                            }
                        } else echo "Nenhum tipo";
                        echo"</span>";
                    ?>
                </div>

                <div class="responsive">
                    <?php
                    echo "<span>".$numRegistros."</span>";
                    echo "<span>R$ ".$valor."</span>";
                    ?>
                </div>
            </div>
        </div>

        <div class="right">
            <div class="top">
                <h1>Alterar Dados</h1>
            </div>
            
            <?php

            if (isset($_GET['error'])) {
                
                echo "<div class='error-edit'>"; 

                switch ($_GET['error']) {
                    case 0:
                        echo"Seus dados não puderam ser alterados!";
                        break;
                    case 1:
                        echo"A foto de perfil não pode ser maior que 4MB!";
                        break;
                    case 2:
                        echo"Esse formato de arquivo não é suportado!";
                        break;
                    case 3:
                        echo"Ocorreu um erro no upload do seu arquivo!";
                        break;
                    default:
                        echo"Senha incorreta ou alteração mal sucedida!";
                        break;
                }
                
                echo"</div>";
            }
            ?>

            <form action='../../php/alterUserData.php' onsubmit='return userEditValidate(event)' method='POST' enctype='multipart/form-data'>
                <div class='little-title'>Nome</div>
                    <input type='text' name='name' id='name' value='<?php echo$nome; ?>' maxlength='40' required>
                <div class='little-title'>Email</div>
                    <input type='email' name='email' id='email' value='<?php echo$email; ?>' maxlength='128' required>
                <div class='clear'></div>
                    <input type='password' name='confirmPassword' id='confirmPassword' placeholder='Confirmar senha' maxlength='128' required>
                <input type='submit' class='submitBtn' value='Salvar Alterações'>
            </form>
            
        </div>
    </div>

    <div id="shadow" class="hidden" onclick="closeEditUser()"></div>

    <!-- Exclude: Edição de imagem -->
    <div id="editUser" class="hidden modal">
        <div class="top">
            <h3>Alterar Imagem</h3>

            <div class="close" onclick="closeEditUser()">
                <i class="fas fa-times-circle btn"></i>
            </div>
        </div>

        <div class="image">
            <img id="imagePreview" src="#" alt="your image" class="hidden"/>
        </div>
        
        <form action="../../php/alterPicture.php" method="POST" enctype='multipart/form-data' id="fileForm">
            <input type="text" class="hidden" name="user" id="userInput">

            <input type='file' class="hidden" id="uploadfile" name='uploadfile' onchange="readURL(this);" accept='.png,.PNG,.JPG,.jpg,.JPEG,.webpm'/>
            <label id="uploadfile-label" class="dark-btn" for="uploadfile">
                <span>Adicionar Imagem</span>
                <i class="fas fa-upload"></i>
            </label>
            <input type="checkbox" id='cleanfiles' name="removepictures" class="hidden" value="1">
            <label id="removeimage-label" class="dark-btn" for="cleanfiles">
                <span onclick="removeValidate()" Checked>Remover Imagem</span>
                <i class="fas fa-minus-square"></i>
            </label>
            <input type="submit" class="submitBtn" value="Confirmar Alteração">
        </form>
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
    <script type="text/javascript" src="../scripts/userModalShow.js"></script>
    <script type="text/javascript" src="../scripts/userImage.js"></script>
</body>
</html>