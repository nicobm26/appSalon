<h1 class="nombre-pagina">Crear nueva cita</h1>
<p class="descripcion-pagina">Elige tus servicios y coloca tus datos</p>

<div id="app">
    <div class="tabs">
        <button type="button" class="actual" data-paso="1">Servicios</button>
        <button type="button" data-paso="2">información Cita</button>
        <button type="button" data-paso="3">Resumen</button>
    </div>

    <div id="paso-1" class="seccion">
        <h2>Servicios</h2>
        <p class="text-center">Elige tus servicios a continuación</p>
        <div id="servicios" class="listado-servicios"></div>
    </div>

    <div id="paso-2" class="seccion">     
        <h2>Tus datos y cita</h2>
        <p class="text-center">Coloca los datos y fecha de tu cita</p> 
        <div class="formulario">
            <div class="campo">
                <label for="nombre">Nombre</label>
                <input 
                    type="text" 
                    id="nombre" 
                    placeholder="Tu nombre"
                    value="<?php echo $nombre; ?>"
                    disabled
                />
            </div>

            <div class="campo">
                <label for="fecha">Fecha</label>
                <input 
                    type="date" 
                    id="fecha"             
                    min="<?php echo date('Y-m-d', strtotime('+1 day'))?>"                
                />
            </div>

            <div class="campo">
                <label for="hora">Fecha</label>
                <input 
                    type="time" 
                    id="hora"             
                />
            </div>
        </div>  
    </div>

    <div id="paso-3" class="seccion">
        <h2>Resumen</h2>
        <p>Verifica que la información sea correcta</p>
    </div>

    <div class="paginacion">
        <button id="anterior" class="boton">
            &laquo; Anterior 
        </button>

        <button id="siguiente" class="boton">
            Siguiente &raquo;
        </button>

    </div>

</div>


<?php

    $script = "
    <script src='build/js/app.js'> </script> 
    ";
?>