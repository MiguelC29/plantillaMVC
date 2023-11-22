<?php
    class Paginas extends Controlador {

        public function __construct() {
            //echo 'Controlador páginas cargadas';
            //ACCEDER AL MODELO
            $this->articuloModelo = $this->modelo('Articulo');
        }

        public function index() {

            $articulos = $this->articuloModelo->obtenerArticulos();

            $datos = [
                'titulo' => 'Bienvenido a MVC',
                'articulos' => $articulos
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