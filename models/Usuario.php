<?php

namespace Model;

class Usuario extends ActiveRecord{
    
    // Base de Datos
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id','nombre','apellido','imagen','email','password','telefono','admin','confirmado','token'];

    public $id;
    public $nombre;
    public $apellido;
    public $imagen;
    public $email;      
    public $password;
    public $telefono;
    public $admin;
    public $confirmado;
    public $token;

    public function __construct($args=[]){
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->admin = $args['admin'] ?? null;
        $this->confirmado = $args['confirmado'] ?? null;
        $this->token = $args['token'] ?? '';
    }

    // Mensajes de validacion para la creacion de una cuenta
    public function validarNuevaCuenta(){
        if(!$this->nombre){
            self::$alertas[] = 'El nombre es obligatorio';
        }else if (! preg_match("/^[a-zA-Z ]+$/", $this->nombre)){
            self::$alertas[] = 'El nombre no puede llevar numeros o caraceteres especiales';
        }

        if(!$this->apellido){
            self::$alertas[] = 'El Apellido es obligatorio';
        }else if (! preg_match("/^[a-zA-Z ]+$/", $this->apellido)){
            self::$alertas[] = 'El Apellido no puede llevar numeros o caraceteres especiales';
        }
        
        // No es obligatorio el telefono, pero si debe tener el formato de 10 numeros
        if(!empty($this->telefono)  && !preg_match("/^[0-9]{10}$/", $this->telefono)){
            self::$alertas[] = 'El numero de telefono solo puede tener 10 numeros';
        }

        if( !empty($this->telefono)  && !filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            self::$alertas[] = 'El correo tiene un formato invalido';
        }

        if(!$this->password){
            self::$alertas[] = 'La contraseña es obligatoria';
        }else if( !preg_match("/^(?=(?:.*[A-Z]){1})(?=(?:.*[a-z]){5,})(?=(?:.*[0-9]){1})/", $this->password)){
            self::$alertas[] = "La contraseña no es válida. Debe contener al menos 5 letras minúsculas, un número y una letra mayúscula.";
        }

        return self::$alertas;
    }
}