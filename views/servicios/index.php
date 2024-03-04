<h1 class="nombre-pagina">Servicios</h1>
<p class="descripcion-pagina">Administración de Servicios</p>
<?php
    include_once __DIR__ . '/../templates/barra.php';
?>

<ul class="servicios">
    <?php foreach($servicios as $servicio): ?>
        <li>
            <p>Nombre: <span><?php echo $servicio->nombre?></span></p>
            <p>Precio: <span><?php echo  number_format($servicio->precio, 0,',','.')?></span></p>
        </li>
        <div class="acciones">
            <a href="/servicios/actualizar?id=<?php echo $servicio->id?>" class="boton">Actualizar</a>
            <form action="/servicios/eliminar" method="POST" id="formEliminarServicio-<?php echo $servicio->id; ?>">
                <input type="hidden" name="id" value="<?php echo $servicio->id?>">
                <input 
                    type="submit" 
                    value="Borrar" 
                    class="boton-eliminar" 
                    onclick="confirmDelete(event,'formEliminarServicio-<?php echo $servicio->id; ?>')"
                />
            </form>
        </div>

    <?php endforeach ?>
</ul>

<?php
    $script = "
    <script src='//cdn.jsdelivr.net/npm/sweetalert2@10'></script>
    <script src='/build/js/alertas.js'></script>
    <script src='https://kit.fontawesome.com/d74a8aa5fa.js' crossorigin='anonymous'></script>
    ";
?>