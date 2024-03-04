<?php

namespace Controllers;

use Model\Servicio;
use MVC\Router;

class ServicioController{
    public static function index(Router $router){
        $nombre = $_SESSION['nombre'];
        $servicios = Servicio::all();
        
        $router->render('/servicios/index',[        
            'nombre'=> $nombre,
            'servicios' => $servicios
        ]);
    }

    public static function crear(Router $router){
        $nombre = $_SESSION['nombre'];
        $servicio = new Servicio();
        $alertas=[];
        if($_SERVER['REQUEST_METHOD' ]==='POST'){
            $servicio->sincronizar($_POST);
            $alertas = $servicio->validar();

            if(empty($alertas)){
                $servicio->guardar();
                header('Location: /servicios');
            }
        }
        
        $router->render('/servicios/crear',[
            'nombre'=> $nombre,
            'servicio' => $servicio,
            'alertas'=> $alertas
        ]);
    }

    public static function actualizar(Router $router){
        $nombre = $_SESSION['nombre'];
        $id = filter_var($_GET['id'], FILTER_VALIDATE_INT);        
        if(! $id) return;
        $servicio = Servicio::find($id);     
        $alertas=[];
        if($_SERVER['REQUEST_METHOD' ]==='POST'){
            $servicio->sincronizar($_POST);            
            $alertas = $servicio->validar();
            if(empty($alertas)){
                $servicio->guardar();
                header('Location: /servicios');
            }
            
        }
        $router->render('/servicios/actualizar',[
            'nombre'=> $nombre,
            'servicio'=>$servicio,
            'alertas'=>$alertas
        ]);
    }

    public static function eliminar(Router $router){
        echo "para Eliminar";
        if($_SERVER['REQUEST_METHOD' ]==='POST'){
            
        }
    }
}
?>