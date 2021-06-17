<?php
//print_r($_POST);
//Provar que funcionou mostrando os dados que você enviou
if(!empty($_POST['email']) && !empty($_POST['password'])){
    require_once("conexao.php");
    
    $emailU = cleanString($_POST['email']);
    $senhaU = cleanString($_POST['password']);

    //Se os campos não estiverem vazios depois da limpeza:
    if(!empty($emailU) && !empty($senhaU)){
        try {

            $sql = "SELECT * FROM usuario WHERE email ='{$emailU}' AND senha = md5('{$senhaU}')";
            
            $resultado = pg_query($conecta, $sql);  echo $resultado;
            $login_check = pg_num_rows($resultado);
            
            if($login_check > 0){ 
                
                //echo "<br>Login Successfully";
                unset($_SESSION['OLD_DATA']);
                $_SESSION['usuario'] = $emailU;
                $_SESSION['isAuth'] = true;
        
                //redireciona a pessoa para a home     
                header("Location: ../public/views/home.html");
                exit();
        
            }else{  
                //echo "<br>Invalid Details";
                header("Location: ../public/views/login.html");
                exit();
            }
        } catch (PDOException $e) {
            echo "Error: '.$e->getCode()' Mensagem: ' .$e->getMessage()'";
        }
    }
}

?>
</body>
</html>