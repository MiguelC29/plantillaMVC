<?php
    class Paginas extends Controlador {
        public function __construct() {
            //echo 'Controlador páginas cargadas';
        }

        public function index() {

            $datos = [
                'titulo' => 'Bienvenido a MVC'
            ];

            $this->vista('paginas/inicio', $datos);
        }

        public function articulo() {
            // $this->vista('paginas/articulo');
        }

        public function actualizar($num_registro) {
            echo $num_registro;
        }
    }
?>