<?php
namespace Controllers;

use MVC\Router;

class CitaController{
    public static function index(Router $router){    

        //ver si existe la sesión, en caso de que no exista, redirigir al usuario al inicio de la web:
        if (!isset($_SESSION['nombre'])){
            header('Location: /');
        }  

        $router->render('/cita/index',[
            'nombre'  => $_SESSION['nombre'] 
        ]);
    }

}

?>