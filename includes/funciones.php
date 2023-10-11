<?php
use Model\Admin;

// Definicion de constatntes
define('TEMPLATE_URL', __DIR__ . '/templates');
define('FUNCIONES_URL', __DIR__ . 'funciones.php');
define('CARPETA_IMAGENES',$_SERVER['DOCUMENT_ROOT'] . '/imagenes/');

function inculirTemplate( string $nombre, bool $inicio = false ) {
    include TEMPLATE_URL . "/{$nombre}.php";
} 

function estaAutenticado() : bool {
    session_start();

    if (!$_SESSION['login']) {
        header('Location: /');
    }
    return true;
    
}

function debuguear($variable) {
    echo"<pre>";
    var_dump($variable);
    echo"</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function s($html) {
    $s = htmlspecialchars($html);
    return $s;
}

// Validar tipo de contenido
function validarTipoContenido ($tipo) {
    $tipos = ['vendedor', 'propiedad', 'entrada'];
    return in_array($tipo, $tipos);
}

// Muestra los mensajes
function mostrarNotificacion($codigo) {
    $mensaje = '';

    switch ($codigo) {
        case 1:
            $mensaje = 'Creado Correctamente';
            break;
        case 2:
            $mensaje = 'Actualizado Correctamente';
            break;
        case 3:
            $mensaje = 'Eliminado Correctamente';
            break;
        
        default:
            # code...
            break;
    }
    return $mensaje;
}

function validarORedireccionar(string $url) {
    // Validar la URL por ID Válid
    $id = $_GET['id'];
    $id = filter_var( $id, FILTER_VALIDATE_INT);

    if (!$id) {
        header("Location: {$url}");
    }

    return $id;
}

function nombreUsuario($id) {

    $usuario = Admin::find($id);

    return $usuario->nombre;
}