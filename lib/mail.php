<?php 

    use  PHPMailer\PHPMailer\PHPMailer;

    

    function enviar_email($destinatario, $assunto, $mensagem){

    

        require '../vendor/autoload.php';
        


        $mail = new PHPMailer();
        $mail->IsSMTP(); 
        $mail->CharSet = 'UTF-8';
        $mail->SMTPDebug = 2;
        $mail->True;
        $mail->Host = "smtp.gmail.com"; // Servidor SMTP
        $mail->SMTPSecure = '**tls**'; // conexão segura com TLS
        
        $mail->Port = 587; 
        $mail->SMTPAuth = true; // Caso o servidor SMTP precise de autenticação
        $mail->Username = 'kassio077@gmail.com'; // SMTP username
        $mail->Password = ''; // SMTP password

        $mail->From = 'kassio077@gmail.com'; // From
        $mail->FromName = "kassio" ; // Nome de quem envia o email
        $mail->AddAddress($destinatario); // Email e nome de quem receberá //Responder

        $mail->WordWrap = 50; // Definir quebra de linha
        $mail->IsHTML = true ; // Enviar como HTML

        
        
        $mail->Subject = $assunto ; // Assunto
        $mail->Body = $mensagem ; //Corpo da mensagem caso seja HTML
        $mail->AltBody = $mensagem ; //PlainText, para caso quem receber o email não aceite o corpo HTML

        if($mail->send()){ // Envia o email
            echo "E-mail enviado com sucesso!";
            return true;
        }else{
            echo "Falha ao enviar e-mail 3";
            return false;
        }
    } 
?>