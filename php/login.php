<?php
//print_r($_POST);
//Provar que funcionou mostrando os dados que você enviou

require_once("conexao.php");
 
$emailU = clean($_POST['email']);
$senhaU = clean($_POST['password']);

//Se os campos não estiverem vazios depois da limpeza:
if(!empty($emailU) && !empty($senhaU)){
    try {

        $sql = "SELECT * FROM usuario WHERE email ='$emailU' AND senha ='$senhaU'";

        $resultado = pg_query($conecta, $sql);
        $login_check = pg_num_rows($resultado);
        
        if($login_check > 0){ 
            
            echo "<br>Login Successfully";
            $_SESSION['username'] = $user['name'];
            $_SESSION['userEmail'] = $email;
            $_SESSION['isAuth'] = true;
    
            //redireciona a pessoa para a home
            unset($_SESSION['OLD_DATA']);
            header("Location: ../public/views/home.html");
        exit();
    
        }else{  
            echo "<br>Invalid Details";
        }
    } catch (PDOException $e) {
        echo "Error: '.$e->getCode()' Mensagem: ' .$e->getMessage()'";
    }
}

?>
</body>
</html>