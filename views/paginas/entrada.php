<main class="contenedor  seccion contenido-centrado">
    <h1><?php echo $entrada->titulo; ?></h1>

    <img loading="lazy" src="imagenes/<?php echo $entrada->imagen; ?>" alt="Imagen de la entrada">

    <p class="informacion-meta">Escrito el: <span><?php echo $entrada->fechaCreacion; ?></span> por <span><?php echo nombreUsuario($entrada->usuarioId); ?></span></p>

    <p><?php echo $entrada->body; ?></p>
    </div>
</main>