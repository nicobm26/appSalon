<?php

namespace Controllers;

use Model\Cita;
use Model\CitaServicio;
use Model\Servicio;

class APIController{

    public static function index(){
        $servicios = Servicio::all();
        // debuguear($servicios);
        echo json_encode($servicios);
    }

    public static function guardar(){
        //Almacena la cita y devuelve el id
        $cita = new Cita($_POST);
        $resultado = $cita->guardar();
        $idCita = $resultado['id'];

        //Almacena los servicios con el id de la cita
        $idServicios = explode(',', $_POST['servicios'] );
        foreach ($idServicios as $idServicio ) {
            $args = [
                'citaId'=> $idCita,
                'servicioId' => $idServicio,
            ];
            $citaServicio = new CitaServicio($args);
            $citaServicio->guardar();
        }
    
        //Retornamos una respuesta

        echo json_encode(['resultado' => $resultado]);  //Segun el profesor en el video 526 3:12 esta "retornando" un resultado

        /*Otro dato interesante, cuando se inspecciona desde la red en google
        buscas en fetch, te aparece citas
        aqui aparece varios encabezados: encabezados, carga util, vista previa, respuesta, iniciador, tiempos, cookies
        Cuando se quita el "echo json_encode($resultado);" en el campo de respuesta se queda vacio
        mientras que cuado se le pone muestra la el contenido que resultado
        */ 
    }

}
