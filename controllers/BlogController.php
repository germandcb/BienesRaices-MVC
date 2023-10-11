<?php 

namespace Controllers;

use Model\Admin;
use Model\Entrada;
use MVC\Router;
use Intervention\Image\ImageManagerStatic as Image;

class BlogController {

    public static function crear(Router $router) {

        $emailAdmin = $_SESSION['usuario'] ?? '';

        $admin =  Admin::idUsuario($emailAdmin);

        $entrada = new Entrada;
        
        $errores = Entrada::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Crear una nueva instancia de entrada
            $entrada = new Entrada($_POST['entrada']);

            // Generar un nombre único 
            $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg";
            
            // Setear la imagen
            //Realiza un resize a la imagen con intervention image
            if($_FILES['entrada']['tmp_name']['imagen']) {
                $image = Image::make($_FILES['entrada']['tmp_name']['imagen'])->fit(800,600);
                $entrada->setImagen($nombreImagen);
            }   

            // Validar campos de entrada
            $errores = $entrada->validar();

            if ( empty($errores)) {
                // Crear carpeta para subir imagenes 
                if (!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }

                // Guarda la imagen en el servidor
                $image->save(CARPETA_IMAGENES . $nombreImagen);
                // Id del ususario actual
                $admin = $admin->id;

                $entrada->setUsuarioId($admin);
                $entrada->guardar();
            }
        }
        
        $router->render('blog/crear', [
            'entrada' => $entrada,
            'errores' => $errores
        ]);
    }

    public static function actualizar(Router $router) {
        $id = validarORedireccionar('/admin');

        $entrada = Entrada::find($id);

        $errores = Entrada::getErrores();
        // Método POST para actualizar
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            // Asignar los atributos
            $args = $_POST['entrada'];

            // Sincronizar datos de la propiedad
            $entrada->sincronizar($args);

            // Validacion subida de archivos
            $errores = $entrada->validar();

            // Generar un nombre unico para la imagen
            $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg";

            if($_FILES['entrada']['tmp_name']['imagen']) {
                $image = Image::make($_FILES['entrada']['tmp_name']['imagen'])->fit(800,600);
                $entrada->setImagen($nombreImagen);
            }

            if(empty($errores)) {
                // Almacenar la imagen
                if($_FILES['entrada']['tmp_name']['imagen']) {
                    $image->save(CARPETA_IMAGENES . $nombreImagen);
                }

                $entrada->guardar();
            }
        }

        $router->render('/blog/actualizar', [
            'entrada' => $entrada,
            'errores' => $errores
        ]);
    }

    public static function eliminar() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            // validar id
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if ($id) {
                $tipo = $_POST['tipo'];
                if (validarTipoContenido($tipo)) {
                    $entrada = Entrada::find($id);
                    $entrada->eliminar();
                }
            }
        }
    }
}
?>