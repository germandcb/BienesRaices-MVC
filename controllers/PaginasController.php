<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use Model\Entrada;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController {
    public static function index(Router $router) {

        $propiedades = Propiedad::get(3);
        $entradas = Entrada::get(2);
        $inicio = true;

        $router->render('paginas/index', [
            'propiedades' => $propiedades,
            'entradas' => $entradas,
            'inicio' => $inicio
        ]);
    }
    public static function nosotros(Router $router) {
        $router->render('paginas/nosotros');
    }
    public static function propiedades(Router $router) {

        $propiedades = Propiedad::all();

        $router->render('paginas/propiedades', [
            'propiedades' => $propiedades
        ]);
    }
    public static function propiedad(Router $router) {

        $id = validarORedireccionar('/propiedades');

        // buscar la propiedad por su id 
        $propiedad = Propiedad::find($id);

        $router->render('paginas/propiedad',[
            'propiedad' => $propiedad
        ]);
    }
    public static function blog(Router $router) {
        
        $entradas = Entrada::all();
        $router->render('paginas/blog', [
            'entradas' => $entradas
        ]);
    }
    public static function entrada(Router $router) {
        $id = validarORedireccionar('/entrada');

        // buscar la propiedad por su id 
        $entrada = Entrada::find($id);

        $router->render('paginas/entrada',[
            'entrada' => $entrada
        ]);
    }
    public static function contacto(Router $router) {

        $mensaje = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST'){

            $respuestas = $_POST['contacto'];

            // Crear una instancia de PHPMailer
            $mail = new PHPMailer();

            // Configurar SMTP
            $mail->isSMTP();
            $mail->Host = 'sandbox.smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Port = 2525;
            $mail->Username = '59dd4f4ed0cf7a';
            $mail->Password = '26ffea4cddf82b';
            $mail->SMTPSecure = 'tls';

            // Configura el contenido del email
            $mail->setFrom('admin@bienesraices.com');
            $mail->addAddress('admin@bienesraices.com', 'BienesRaices.com');
            $mail->Subject = 'Tienes un nuevo Mensaje';

            // Habilitar HTML
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';



            // Definir el contenido
            $contenido = '<html>';
            $contenido .= '<p>Tienes un nuevo mensaje</p>';
            $contenido .= '<p>Nombre: ' . $respuestas['nombre'] . ' </p>';

            //Enviar de forma condicional algunos campos de email o teléfono
            if ($respuestas['contacto'] === 'contacto') {
                $contenido .= '<p>Eligio ser contactado por Teléfono</p>';
                $contenido .= '<p>Teléfono: ' . $respuestas['telefono'] . ' </p>';
                $contenido .= '<p>Fecha Contacto: ' . $respuestas['fecha'] . ' </p>';
                $contenido .= '<p>Hora: ' . $respuestas['hora'] . ' </p>';
            } else {
                // Es email, entonces agregarmos el campo de email
                $contenido .= '<p>Eligio ser contactado por email</p>';
                $contenido .= '<p>Email: ' . $respuestas['email'] . ' </p>';
            }
            $contenido .= '<p>Mensaje: ' . $respuestas['mensaje'] . ' </p>';
            $contenido .= '<p>Vende o Compra: ' . $respuestas['tipo'] . ' </p>';
            $contenido .= '<p>Precio o Presupuesto: $' . $respuestas['precio'] . ' </p>';
            $contenido .= '<p>Prefiere ser contactado por: ' . $respuestas['contacto'] . ' </p>';
            $contenido .= '</html>';

            $mail->Body = $contenido;
            $mail->AltBody = 'Esto es texto alternativo sin HTML';

            // Enviar el email
            if ($mail->send()) {
                $mensaje = "Mensaje enviado correctamente";
            } else {
                $mensaje = "El mensaje no se pudo enviar...";
            }

        }
        $router->render('paginas/contacto', [
            'mensaje' => $mensaje
        ]);
    }
    
}