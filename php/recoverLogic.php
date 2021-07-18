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

        $query = "SELECT email_user, password_user FROM users WHERE email_user = :email_user";

        $stmt = $conn -> prepare($query);

        $stmt -> bindValue(':email_user', $email_user);

        $stmt -> execute();

        $return = $stmt -> fetchAll(PDO::FETCH_ASSOC);

        if (count($return) > 0) {
            
            $selector = bin2hex(random_bytes(8));
            $token = random_bytes(32);

            $url = "http://localhost/ALICE/public/views/public/new-password.php?selector=" . $selector . "&validator=" . bin2hex($token);
            
            $expires = date("U") + 3600;

            $query = "DELETE FROM pwdreset WHERE pwdResetEmail = :email_user";
            $stmt = $conn -> prepare($query);
            $stmt -> bindValue(':email_user', $email_user);
            $stmt -> execute();

            $query = "INSERT INTO pwdreset VALUES(DEFAULT, :pwdResetEmail , :pwdResetSelector , :pwdResetToken, :pwdResetExpires );";

            $stmt = $conn -> prepare($query);

            $stmt -> bindValue(':pwdResetEmail', $email_user);
            $stmt -> bindValue(':pwdResetSelector', $selector);
            $stmt -> bindValue(':pwdResetToken', $token);
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
                $mail->addAddress('fefegamer858@gmail.com', 'Joe User');     //Add a recipient
                //$mail->addAddress('ellen@example.com');               //Name is optional
                $mail->addReplyTo('no-reply@gmail.com', 'No Reply');
                //$mail->addCC('cc@example.com');
                //$mail->addBCC('bcc@example.com');

                //Attachments
                //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
                //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = "Storagesy - New Password";
                $mail->Body    = "<h1>Recuperação de senha</h1>
                Nós recebemos uma requisição de recuperação de senha, se você não foi o responsável por
                essa requisição, você pode ignorar este email<br>
                Aqui está o seu link de recuperação de senha:<br>
                <a href'".$url."'> ".$url." </a>";
                $mail->AltBody = "Seu provedor de Email tem HTML por mensagens desativado ou você desativou
                essa feature manualmente, portante copie e cole o link abaixo para acessar a pagina de
                recuperação de senha<br>".$url;

                $mail->send();
                echo$url;
                echo 'Message has been sent';
                
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }

        }

        header("Location: ../public/views/recover.php?message=0");
        exit(); 

    } else {
        header("Location: ../public/views/recover.php?message=1"); // Campos vazios
        exit();
    }
