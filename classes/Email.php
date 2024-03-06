<?php
namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

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
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = $_ENV['EMAIL_HOST'];
            $mail->SMTPAuth = true;
            $mail->Port =  $_ENV['EMAIL_PORT'];
            $mail->Username =  $_ENV['EMAIL_USER'];
            // $mail->SMTPSecure ='ssl';    //Sirve pero cuando lo hago desde gmail
            $mail->Password =  $_ENV['EMAIL_PASS'];


            $mail->setFrom("nicobomen32@gmail.com","AppSalon.com");
            $mail->addAddress($this->email , $this->nombre);
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
            $mail->send();
            
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }          
    }


    public function enviarInstrucciones(){
        //Crear una instancia, passing `true` enables exceptions
        $mail = new PHPMailer(true);
        try {            
            $mail->isSMTP();
            $mail->Host = $_ENV['EMAIL_HOST'];
            $mail->SMTPAuth = true;
            $mail->Username = $_ENV['EMAIL_USER'];
            $mail->Password = $_ENV['EMAIL_PASS'];
            // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; 
            //$mail->SMTPSecure ='ssl'; //Sirve pero cuando lo hago desde gmail
            $mail->Port = $_ENV['EMAIL_PORT'];
            
     
            $mail->setFrom("nicobomen32@gmail.com", "Appsalon");
            $mail->addAddress($this->email , $this->nombre);
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
     
            //Enviar el correo
            $mail->send();             
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }                
    }
}

?>