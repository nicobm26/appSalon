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
            />
        </div>
    </form>
</div>

<div class="citas-admin">
    <ul class="citas">
    <?php $idCita = 0;?>
    <?php foreach($citas as $cita): ?>        
        <?php if($idCita !== $cita->id): ?>
            <li>
                <p>ID: <span><?php echo $cita->id; ?></span></p>
                <p>HORA: <span><?php echo $cita->hora; ?></span></p>
                <p>CLIENTE: <span><?php echo $cita->cliente; ?></span></p>
                <p>EMAIL: <span><?php echo $cita->email; ?></span></p>
                <p>TELEFONO: <span><?php echo $cita->telefono; ?></span></p>

                <h3>Servicios</h3>
                <?php $idCita = $cita->id ?>
        <?php endif ?>
        <p class="servicio"><?php echo $cita->servicio . " " . $cita->precio ?></p>
            </li>

    <?php endforeach ?>
    </ul>
</div>