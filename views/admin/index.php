<h1 class="nombre-pagina">Panel de Administración</h1>

<?php include_once __DIR__. '/../templates/barra.php';?>


<h2>Buscar citas</h2>
<div class="busqueda">
    <form class="formulario">
        <div class="campo">
            <label for="fecha">Fecha</label>
            <input 
                type="date"
                id="fecha"
                name="fecha" 
                value="<?php echo $fecha; ?>"              
            />
        </div>
    </form>
</div>

<?php
    if(count($citas) === 0) {
        echo "<h2>No hay citas en esta fecha</h2>";
    }
?>

<div class="citas-admin">
    <ul class="citas">
    <?php $idCita = 0;?>
    <?php foreach($citas as $key => $cita): ?>        
        <?php if($idCita !== $cita->id): ?>
            <?php   $total = 0;   ?>
            <li>
                <p>ID: <span><?php echo $cita->id; ?></span></p>
                <p>HORA: <span><?php echo $cita->hora; ?></span></p>
                <p>CLIENTE: <span><?php echo $cita->cliente; ?></span></p>
                <p>EMAIL: <span><?php echo $cita->email; ?></span></p>
                <p>TELEFONO: <span><?php echo $cita->telefono; ?></span></p>

                <h3>Servicios</h3>
                <?php $idCita = $cita->id ?>
        <?php endif ?>
        <?php 
            $total += $cita->precio;
            ?>
            <p class="servicio"><?php echo $cita->servicio . " " . number_format($cita->precio, 0 , ',', '.') ?></p>
            <?php

            $actual = $cita->id;
            $proximo = $citas[$key+1]->id ?? 0;

            if(esUltimo($actual, $proximo)){ ?>
                <p class="total">Total: <span> <?php echo number_format($total, 0, ',', '.'); ?></span></p>
                <form method='POST' action="/api/eliminar" id="formEliminarCita">
                    <input type="hidden" name="id" value="<?php echo $cita->id?>">
                    <input type="submit" class="boton-eliminar" value="Eliminar" onclick="confirmDelete(event, 'formEliminarCita')">
                </form>
            <?php
            }
        ?>
    <?php endforeach ?>
    </ul>
</div>

<?php 
    $script = "
    <script src='build/js/alertas.js'></script>
    <script src='build/js/buscador.js'> </script>
    <script src='//cdn.jsdelivr.net/npm/sweetalert2@10'></script>
    <script src='https://kit.fontawesome.com/d74a8aa5fa.js' crossorigin='anonymous'></script>
    ";
?>