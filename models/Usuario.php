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
        $this->admin = $args['admin'] ?? '0';
        $this->confirmado = $args['confirmado'] ?? '0';
        $this->token = $args['token'] ?? '';
    }

    // Mensajes de validacion para la creacion de una cuenta
    public function validarNuevaCuenta(){
        if(!$this->nombre){
            self::$alertas['error'][] = 'El nombre es obligatorio';
        }else if (! preg_match("/^[a-zA-Z ]+$/", $this->nombre)){
            self::$alertas['error'][] = 'El nombre no puede llevar numeros o caraceteres especiales';
        }

        if(!$this->apellido){
            self::$alertas['error'][] = 'El Apellido es obligatorio';
        }else if (! preg_match("/^[a-zA-Z ]+$/", $this->apellido)){
            self::$alertas['error'][] = 'El Apellido no puede llevar numeros o caraceteres especiales';
        }
        
        // No es obligatorio el telefono, pero si debe tener el formato de 10 numeros
        if(!empty($this->telefono)  && !preg_match("/^[0-9]{10}$/", $this->telefono)){
            self::$alertas['error'][] = 'El numero de telefono solo puede tener 10 numeros';
        }

        if(empty($this->email) ){
            self::$alertas['error'][] = 'El correo es obligatorio';
        }else if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alertas['error'][] = 'El correo no tiene el formato correcto';
        }

        if(!$this->password){
            self::$alertas['error'][] = 'La contraseña es obligatoria';
        }else if( !preg_match("/^(?=(?:.*[A-Z]){1})(?=(?:.*[a-z]){5,})(?=(?:.*[0-9]){1})/", $this->password)){
            self::$alertas['error'][] = "La contraseña no es válida. Debe contener al menos 5 letras minúsculas, un número y una letra mayúscula.";
        }

        return self::$alertas;
    }

    public function existeUsario(){
        $query = "select * from " . self::$tabla . " where email = '" . $this->email . "' LIMIT 1";
        // debuguear($query);
        $resultado = self::$db->query($query);
        if($resultado->num_rows){
            self::$alertas[] = "El usuario ya esta registrado";
        }
        // debuguear( $resultado);
        return $resultado;
    }

    public function hashPassword(){
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    public function crearToken(){
        // $this->token = uniqid();
        $this->token = bin2hex(random_bytes(8)); // "8" genera un string aleatorio de 16 caracteres, un poco mas seguro
    }
}