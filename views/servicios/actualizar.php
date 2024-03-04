<h1 class="nombre-pagina">actualizar Servicio</h1>
<p class="descripcion-pagina">Modifica los valores del formulario</p>
<?php
    include_once __DIR__ . '/../templates/barra.php';
    include_once __DIR__ . '/../templates/alertas.php';
?>

<form method="post">
    <?php include_once __DIR__ . "/formulario.php"; ?>
    
    <input 
        type="submit" 
        class="boton" 
        value="Actualizar Servicio"
        onclick="servicioActualizado(event)"
    />
</form>

<?php

$script = "
    <script src='//cdn.jsdelivr.net/npm/sweetalert2@10'></script>
    <script src='/build/js/alertas.js'></script>
    <script src='https://kit.fontawesome.com/d74a8aa5fa.js' crossorigin='anonymous'></script>
";
?>