<fieldset>
    <legend>Información Cabecera</legend>

    <label for="titulo">Titulo:</label>
    <input type="text" id="titulo" name="entrada[titulo]" placeholder="Titulo Entrada" value="<?php echo s($entrada->titulo); ?>">

    <label for="imagen">Imagen destacada:</label>
    <input type="file" id="imagen" accept="image/jpeg, image/png" name="entrada[imagen]">

    <?php if($entrada->imagen) { ?>
        <img src="/imagenes/<?php echo $entrada->imagen ?>" class="imagen-small">
    <?php } ?> 
</fieldset>

<fieldset>
    <legend>Información adicional</legend>

    <label for="body">Cuerpo de la entrada</label>
    <textarea name="entrada[body]" id="body" cols="30" rows="10" placeholder="Informacion para el cuerpo de la entrada del blog" ><?php echo s($entrada->body); ?></textarea>

</fieldset>
