<?php

namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class LoginController{

    public static function login(Router $router){
        $alertas = [];
        $auth = new Usuario($_POST);

        if($_SERVER["REQUEST_METHOD"]=== "POST"){
            $auth = new Usuario($_POST);
            // debuguear($auth);
            $alertas = $auth->validarLogin();
            if(empty($alertas)){
                //Usuario agrego tanto email como password
                //1.Comprobar que exista email
                $usuario = Usuario::where('email',$auth->email);
                //debuguear($usuario);
                if($usuario){
                    //Existe Usuario, Proseguir a verificar password                       
                    if( $usuario->comprobarPasswordAndVerificado($auth->password)){
                        //Autenticar el usuario
                        if(!isset($_SESSION)) {  
                            //Pregunto si ya esta definida PORQUE por el momento ya se definio en el archivo router.php
                            //en teoria como el router se ejecuta primero, entonces ya la sesion fue iniciada, y si no hago
                            // este if puede saldria la advertencia de que la sesion ya fue iniciada
                            session_start();
                        }
                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['nombre'] = $usuario->nombre . " " . $usuario->apellido;
                        $_SESSION['email'] = $usuario->email;
                        $_SESSION['login'] = true;

                        //Redireccionamiento
                        if($usuario->admin === "1"){
                            $_SESSION['admin'] = $usuario->admin ?? null;
                            // header("Location: /admin");
                        }else{
                            // header("Location: /cita");
                        }
                        debuguear($_SESSION);

                    }
                }else{
                    Usuario::setAlerta('error', 'Usuario NO encontrado');
                }
            }
        }

        $alertas = Usuario::getAlertas();

        $router->render('auth/login',[
            "alertas" => $alertas,
            "auth"=>$auth
        ]);
    }

    public static function logout(){
        echo 'desde logout';
    }

    public static function olvide(Router $router){
        $router->render('auth/olvide-password',[
            
        ]);
    }

    public static function recuperar(){
        echo 'desde recuperar';
    }
    
    public static function crear(Router $router){
        $usuario = new Usuario();
        $alertas=[];
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarNuevaCuenta();
            if(empty($alertas)){
                // Verificar que el usuario no este registrado
                $resultado = $usuario->existeUsario();
                if($resultado->num_rows){
                    $alertas = Usuario::getAlertas();
                }else{
                    // hashear Password
                    $usuario->hashPassword();

                    // Generar token unico
                    $usuario->crearToken();
                    // debuguear($usuario);

                    // Enviar Email
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    
                    $email->enviarConfirmacion();

                    //Crear Usuario
                    $resultado = $usuario->guardar();
                    if($resultado){
                        echo "Guardado Correctamente";
                        header("Location: /mensaje");
                    }

                }
            }
        }
        $router->render('auth/crear-cuenta',[
            "usuario" => $usuario,
            "alertas"=> $alertas
        ]);
    }

    public static function mensaje(Router $router){
        $router->render('auth/mensaje');
    }   

    public static function confirmar(Router $router){
        
        $alertas = [];
        $token=s($_GET['token']);
        $usuario = Usuario::where('token',$token);
        // debuguear($usuario);
        if(empty($usuario)){
            //mostrar mensaje de error
            Usuario::setAlerta('error' , 'token no valido');
        }else{
            // Modificar a usuario confirmado
            $usuario->confirmado = '1';
            $usuario->token = null;
            $usuario->guardar();
            // debuguear($usuario);
            Usuario::setAlerta('exito', 'Cuenta Comprobada Correctamente');
        }

        $alertas = Usuario::getAlertas();
        $router->render('auth/confirmar-cuenta', [
            'alertas'=> $alertas
        ]);
    }
}
