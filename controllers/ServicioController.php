<?php

namespace Controllers;

use MVC\Router;

class ServicioController{
    public static function index(Router $router){
        $router->render('/servicios/index',[
            
        ]);
    }

    public static function crear(Router $router){
        echo "para crear";
        if($_SERVER['REQUES_METHOD' ]==='POST'){

        }
    }

    public static function actualizar(Router $router){
        echo "para Actualizar";
        if($_SERVER['REQUES_METHOD' ]==='POST'){
            
        }
    }

    public static function eliminar(Router $router){
        echo "para Eliminar";
        if($_SERVER['REQUES_METHOD' ]==='POST'){
            
        }
    }
}
?>