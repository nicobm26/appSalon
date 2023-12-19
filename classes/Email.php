<?php
namespace Classes;

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
}

?>