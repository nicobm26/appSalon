<?php

namespace Controllers;

use Model\AdminCita;
use MVC\Router;

class AdminController{

    public static function index(Router $router){
        if(!isset($_SESSION['login'])){
            header('Location: /');
        }

        //Consultar la base de datos
        $consulta = "SELECT citas.id, citas.hora, CONCAT( usuarios.nombre, ' ', usuarios.apellido) as cliente, ";
        $consulta .= " usuarios.email, usuarios.telefono, servicios.nombre as servicio, servicios.precio  ";
        $consulta .= " FROM citas  ";
        $consulta .= " LEFT OUTER JOIN usuarios ";
        $consulta .= " ON citas.usuarioId=usuarios.id  ";
        $consulta .= " LEFT OUTER JOIN citasServicios ";
        $consulta .= " ON citasServicios.citaId=citas.id ";
        $consulta .= " LEFT OUTER JOIN servicios ";
        $consulta .= " ON servicios.id=citasServicios.servicioId ";
        // $consulta .= " WHERE fecha =  '${fecha}' ";

        $citas = AdminCita::sql($consulta);
        // debuguear($citas);
        
        $router->render('admin/index',[
            'nombre' => $_SESSION['nombre'],
            'citas'=> $citas
        ]);
    }

}