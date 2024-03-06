<?php
namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

// Clase helper- util
//Clase que nos va permitir enviar un correo

class Email{

    public $email;
    public $nombre;
    public $token;
    

    public function __construct($email, $nombre, $token){
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion(){

        //Crear el objeto de mailer
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port =  $_ENV['EMAIL_PORT'];
        $mail->Username =  $_ENV['EMAIL_USER'];
        $mail->Password =  $_ENV['EMAIL_PASS'];


        $mail->setFrom("cuentaSalon@gmail.com");
        $mail->addAddress("cuenta1@gmail.com", 'AppSalon.com');
        $mail->Subject = "Confirmar tu cuenta";

        // Indicar que el correo va enviar en formato html
        $mail->isHTML(TRUE);
        $mail->CharSet = "UTF-8";


        $contenido = "<html>";
        $contenido .= "<p><strong>Hola ". $this->nombre ."</strong> Has creado
        tu cuenta en AppSalon, solo debes confirmarla presionando el siguiente enlace</p>";
        $contenido .= "<p>Presiona aqui: <a href='" . $_ENV['APP_URL'] . "/confirmar-cuenta?token="
        . $this->token . "'>Confirmar Cuenta</a> </p>";
        $contenido .= "<p> Si tu no soliciste esta cuenta, puedes ignorar el mensaje </p>";
        $contenido .= "</html>";

        $mail->Body = $contenido;

        // Enviar correo
        //$mail->send();


        //send the message, check for errors
        if (!$mail->send()) {
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } 
        // else {
        //     echo 'Message sent!';
        // }
    }
    public function enviarInstrucciones(){
         //Crear el objeto de mailer
         $mail = new PHPMailer();
         $mail->isSMTP();
         $mail->Host = $_ENV['EMAIL_HOST'];
         $mail->SMTPAuth = true;
         $mail->Port = $_ENV['EMAIL_PORT'];
         $mail->Username = $_ENV['EMAIL_USER'];
         $mail->Password = $_ENV['EMAIL_PASS'];
 
 
         $mail->setFrom("nicobomen32@gmail.com");
         $mail->addAddress("cuenta1@gmail.com", 'AppSalon.com');
         $mail->Subject = "Reestablece tu cuenta";
 
         // Indicar que el correo va enviar en formato html
         $mail->isHTML(TRUE);
         $mail->CharSet = "UTF-8";
 
 
         $contenido = "<html>";
         $contenido .= "<p><strong>Hola ". $this->nombre ."</strong> Has solicitado reestablecer tu contraseña, sigue el siguiente enlace para hacerlo</p>";
         $contenido .= "<p>Presiona aqui: <a href='" . $_ENV['APP_URL'] . "/recuperar?token="
         . $this->token . "'>Reestablecer Cuenta</a> </p>";
         $contenido .= "<p> Si tu no soliciste esta cambio, puedes ignorar el mensaje </p>";
         $contenido .= "</html>";
 
         $mail->Body = $contenido;
 
         //send the message, check for errors
         if (!$mail->send()) {
             echo 'Mailer Error: ' . $mail->ErrorInfo;
         } 
    }
}

?>