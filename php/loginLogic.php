<?php
//print_r($_POST); //Para debug
if(!empty($_POST['email']) && !empty($_POST['password'])){
    require_once("../../php/conexao.php");

    $emailU = strtolower( cleanString($_POST['email']));
    $senhaU = cleanString($_POST['password']);

    //Se os campos não estiverem vazios depois da limpeza:
    if(!empty($emailU) && !empty($senhaU)){
        try {

            $sql = "SELECT * FROM usuarios WHERE email ='$emailU' ";
            
            $return = pg_query($conecta, $sql);
            $login_check = pg_num_rows($return);

            if($login_check > 0){ 

                $linha = pg_fetch_array($return);
                
                if( password_verify($senhaU, $linha['senha']) ){

                    $_SESSION['isAuth'] = TRUE; 
                    $_SESSION['idUser'] = $linha['id_user'];

                    header("Location: home.php");
                    exit();
                }

            }else{  
                header("Location: login.php?erro=1");
                exit();
            }
        } catch (PDOException $e) {
            echo "Error: '.$e->getCode()' Mensagem: ' .$e->getMessage()'";
        }
    }
}
?>