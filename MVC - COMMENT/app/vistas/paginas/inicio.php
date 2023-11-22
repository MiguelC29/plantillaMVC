<?php require RUTA_APP . '/vistas/inc/header.php';?>
<p><?php echo $datos['titulo'];?></p>
<ul>
    <?php foreach($datos['articulos'] as $articulo) : ?>
        <li><?php echo $articulo->titulo;?></li>
    <?php endforeach;?>
</ul>
<?php require RUTA_APP . '/vistas/inc/footer.php';?>