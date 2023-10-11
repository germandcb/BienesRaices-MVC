<?php foreach ($entradas as $entrada):?>
<article class="entrada-blog">
    <div class="imagen">
        <img loading="lazy" src="imagenes/<?php echo $entrada->imagen; ?>" alt="Imagen de la entrada">
    </div>

    <div class="texto-entrada">
        <a href="/entrada?id=<?php echo $entrada->id; ?>">
            <h4><?php echo $entrada->titulo ?></h4>
            <p class="informacion-meta">Esrito el: <span><?php echo $entrada->fechaCreacion; ?></span> por: <span><?php echo nombreUsuario($entrada->usuarioId); ?></span></p>
        </a>

        <p>
            <?php echo $entrada->estracto(); ?>
        </p>
    </div>
</article><!--.entrada-blog-->
<?php endforeach; ?>