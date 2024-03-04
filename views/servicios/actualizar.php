<h1 class="nombre-pagina">actualizar Servicio</h1>
<p class="descripcion-pagina">Modifica los valores del formulario</p>
<?php
    include_once __DIR__ . '/../templates/barra.php';
?>

<form method="post">
    <?php include_once __DIR__ . "/formulario.php"; ?>
    
    <input type="submit" class="boton" value="Actualizar Servicio">
</form>
