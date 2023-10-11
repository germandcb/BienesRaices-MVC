<?php 

namespace Model;

class Entrada extends ActiveRecord {
    protected static $tabla = 'entradas';
    protected static $columnasDB = ['id', 'titulo', 'imagen', 'body', 'fechaCreacion', 'usuarioId'];

    public $id;
    public $titulo;
    public $imagen;
    public $body;
    public $fechaCreacion;
    public $usuarioId;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->body = $args['body'] ?? '';
        $this->fechaCreacion = $args['fechaCreacion'] ?? date("Y-m-d H:i:s");
        $this->usuarioId = $args['usuarioId'] ?? '';
    }

    public function setUsuarioId($id) {
        $this->usuarioId = $id;
    }

    public function validar() {
        if (!$this->titulo) {
            self::$errores[] = "Debes añadir un titulo";
        }
        if (!$this->imagen) {
            self::$errores[] = "La imagen descada es obligatoria";
        }
        if (!$this->body) {
            self::$errores[] = "Necesita colocar informacion a la entrada";
        }

        return self::$errores;
    }

    public function estracto() {
        $query = "SELECT LEFT(body, 100) FROM " . static::$tabla . " WHERE id = " . $this->id . " LIMIT 1;" ;

        $resultado = self::$db->query($query);

        $estracto = $resultado->fetch_assoc();
        
        return implode($estracto) . "...";
    }
}
?>