<?php
if (!isset($_SESSION)) {
    session_start();
}

$auth = $_SESSION['login'] ?? false;

if (!isset($inicio)) {
    $inicio = false;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raices</title>
    <link rel="stylesheet" href="../build/css/app.css">
</head>

<body>

    <header class="header <?php echo $inicio ? 'inicio' : ''; ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/">
                    <img src="/build/img/logo.svg" alt="Logotipo de Bienes Raices">
                </a>

                <div class="mobile-menu">
                    <img src="/build/img/barras.svg" alt="icono menu responsive">
                </div>
                <div class="derecha">
                    <img src="/build/img/dark-mode.svg" alt="Dark mode" class="dark-mode-boton">
                    <nav class="navegacion">
                        <a href="/nosotros">Nosotros</a>
                        <a href="/propiedades">Anuncios</a>
                        <a href="/blog">Blog</a>
                        <a href="/contacto">Contacto</a>
                        <?php if ($auth): ?>
                            <a href="/logout">Cerrar Sesion</a>
                        <?php elseif (!$auth): ?>
                            <a href="/login">Iniciar Sesion</a>
                        <?php endif; ?>
                    </nav>
                </div>
            </div> <!-- .barra -->
            <!-- <?php if ($inicio) { ?>
                <h1>Venta de Casas y Departamentos Exclusivos de lujo</h1>
            <?php } ?> -->
            <?php echo $inicio ? "<h1>Venta de Casas y Departamentos Exclusivos de Lujo</h1>" : ''; ?>
        </div>
    </header>

    <?php echo $contenido; ?>

    <footer class="footer seccion">
        <div class="contenedor contenido-footer">
            <nav class="navegacion">
                <a href="/nosotros">Nosotros</a>
                <a href="/propiedades">Anuncios</a>
                <a href="/blog">Blog</a>
                <a href="/contacto">Contacto</a>
            </nav>
        </div>
        <p class="copyrigth">Todos los derechos reservados &copy;
            <?php echo date('Y') ?>
        </p>
    </footer>
    <script src="../build/js/bundle.min.js" type="module"></script>
</body>

</html>