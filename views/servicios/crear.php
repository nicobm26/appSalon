<h1 class="nombre-pagina">Nuevo Servicio</h1>
<p class="descripcion-pagina">LLena todos los campos para añadir un nuevo servicio</p>
<?php
    include_once __DIR__ . '/../templates/barra.php';
?>

<form action="/servicios/crear" method="post">
    <?php include_once __DIR__ . "/formulario.php"; ?>
    
    <input type="submit" class="boton" value="Guardar Servicio">
</form>