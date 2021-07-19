<?php

    require_once("env.php");
    require 'vendor/autoload.php';
    require "vendor/phpmailer/phpmailer/src/PHPMailer.php";
    require "vendor/phpmailer/phpmailer/src/Exception.php";
    require "vendor/phpmailer/phpmailer/src/SMTP.php";
    
    require_once("connect.php");
    require_once("functions.php");
    
    $email_user = strtolower( cleanEmail($_POST['email']) );

    if (!empty($email_user) ) {

        $query = "SELECT email_user, password_user, name_user FROM users WHERE email_user = :email_user";

        $stmt = $conn -> prepare($query);

        $stmt -> bindValue(':email_user', $email_user);

        $stmt -> execute();

        $return = $stmt -> fetchAll(PDO::FETCH_ASSOC);

        if (count($return) > 0) {

            $name_user = $return[0]['name_user'];
            $ipRequest = cleanEmail($_POST['ipRequest']);
            $selector = bin2hex(random_bytes(8));
            $token = random_bytes(32);
            $hashedToken = password_hash($token, PASSWORD_BCRYPT);

            $url = 'http://'.$_SERVER['HTTP_HOST']."/ALICE/public/views/";
            $url .= "new-password.php?selector=" . $selector . "&validator=" . bin2hex($token);
            
            $expires = date("U") + 3600; // 1 hours token validation

            //$query = "DELETE FROM pwdreset WHERE pwdresetEmail = :email_user AND dateRequest < DATEADD(day, -30, GETDATE())";
            //$stmt = $conn -> prepare($query);
            //$stmt -> bindValue(':email_user', $email_user);
            //$stmt -> execute();

            $query = "INSERT INTO pwdreset VALUES(DEFAULT, :ipRequest , DEFAULT, :pwdResetEmail , :pwdResetSelector , :pwdResetToken, :pwdResetExpires );";

            $stmt = $conn -> prepare($query);

            $stmt -> bindValue(':ipRequest', $ipRequest);
            $stmt -> bindValue(':pwdResetEmail', $email_user);
            $stmt -> bindValue(':pwdResetSelector', $selector);
            $stmt -> bindValue(':pwdResetToken', $hashedToken);
            $stmt -> bindValue(':pwdResetExpires', $expires);

            $stmt -> execute();

            $mail = new PHPMailer\PHPMailer\PHPMailer(true);

            try {
                //Server settings
                $mail->isSMTP();                                        //Send using SMTP
                $mail->Host       = $ENV_MAIL_HOST;                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                               //Enable SMTP authentication
                $mail->Username   = $ENV_MAIL_USER;                     //SMTP username
                $mail->Password   = $ENV_MAIL_PASSWORD;                 //SMTP password
                $mail->SMTPSecure = $mail::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port       = $ENV_MAIL_PORT;                     //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom($ENV_MAIL_USER, 'Storagesy');
                $mail->addAddress($email_user, $name_user);             //Add a recipient
                $mail->addReplyTo('no-reply@gmail.com', 'No Reply');
                //$mail->addCC('cc@example.com');
                //$mail->addBCC('bcc@example.com');

                //Attachments
                //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
                //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = "Storagesy - Password Recover";
                $mail->Body    = "<html>
                <body style='text-align: center;
                width: 50%;
                margin: auto;
                font-family: Roboto;
                background: rgb(230, 230, 230);'>
                <div height='70px' width='100%' style='background: rgb(224, 24, 64); color: white;'>
                <h2 style='padding-top: 30px; padding-botton: 30px;'>Storagesy</h2>
                </div>
                <h1>Recuperação de senha</h1>
                <p style='text-align: justify; padding-right: 10px; padding-left: 10px'>
                Olá ".$name_user.", nós recebemos uma requisição de recuperação de senha da sua conta no Storagesy pelo IP ".getUserIP().", 
                se você não foi o responsável por essa requisição, você pode ignorar completamente este email.<br><br>
                Clique no botão para ser redirecionado para a página de recriação de senha ou no link abaixo:
                </p><br>
                <a href='".$url."'> 
                <button style='background-color:black;color: white;font-size: 2em; cursor: pointer;'>Redefinir senha</button>
                </a><br>
                <a href='".$url."'> ".$url." </a><br><br>
                <img src='https://safepackaginguk.com/wp-content/uploads/2020/05/CB-.jpg' alt='Imagem box' width='100%'/>
                </body>
                </html>
                ";
                
                $mail->AltBody = "Olá ".$name_user.", seu provedor de Email tem HTML por mensagens desativado ou você
                desativou essa feature manualmente, portanto, se você requisitou a troca de senha da sua conta do
                Storagesy pelo IP ".getUserIP().", copie e cole o link abaixo para acessar a pagina de
                recuperação de senha: ".$url;

                $mail->send();
                //echo 'Message has been sent';
                
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }

        }

        header("Location: ../public/views/recover.php?message=0"); // Everything okay
        exit(); 

    } else {
        header("Location: ../public/views/recover.php?message=1"); // Campos vazios
        exit();
    }
