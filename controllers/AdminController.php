<?php

namespace Controllers;

use MVC\Router;

class AdminController{

    public static function index(Router $router){
        if(!isset($_SESSION['login'])){
            header('Location: /');
        }
        
        $router->render('admin/index',[
            'nombre' => $_SESSION['nombre']
        ]);
    }

}