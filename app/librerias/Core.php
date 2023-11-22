<?php
    /* Mapear la url ingresada en el navegador,
    FUNCIONALIDAD:
    1- Controlador
    2- Método
    3- Parámetro
    Ejemplo: /articulos/actualizar/4
                1           2      3

    arrayIndices = 0,1,2
    0=controlador
    1=metodoActual
    3=parametro
    */
    class Core {
        protected $controladorActual = 'paginas';
        protected $metodoActual = 'index';
        protected $parametros = [];

        //Constructor
        public function __construct() {
            // Verificar como separa la url
            // print_r($this->getUrl());
            $url = $this->getUrl();

            //Buscar en controladores si el archivo(controlador) existe
            //ucword es para poner en mayuscula la primera letra, y le concatenamos la extension .php para no escribirla

            if (file_exists('../app/controladores/' . ucwords($url[0]) . '.php')) {
                //si existe se setea o configura como controlador por defecto, es decir se cambia el controlador por defecto y se toma el actual
                $this->controladorActual = ucwords($url[0]);

                //unset del indice 0
                unset($url[0]);
            }

            //Requerir el nuevo controlador
            require_once '../app/controladores/' . $this->controladorActual . '.php';
            $this->controladorActual = new $this->controladorActual;

            //chequear la segunda parte de la url que seria el método
            if (isset($url[1])) {
                if (method_exists($this->controladorActual, $url[1])) {
                    //chequeamos el método
                    $this->metodoActual = $url[1];

                    //unset del indice 1
                    unset($url[1]);
                }
            }

            // para probar traer el método
            // echo $this->metodoActual;

            // obtener los parámetros
            $this->parametros = $url ? array_values($url) : [];

            // llamar callback con parametros array
            call_user_func_array([$this->controladorActual, $this->metodoActual], $this->parametros);
        }

        public function getUrl() {
            // echo $_GET['url'];
            if (isset($_GET['url'])) {
                //rtrim para cortar todos los espacios que pueda tener la url
                $url = rtrim($_GET['url'], '/');
                //Validar la url - El FILTER_SANITIZE_URL -> funcion nativa de php para este sea interpretado como una url
                $url = filter_var($url, FILTER_SANITIZE_URL);
                //Separar la url ej: articulo/actualizar/8 , esto nos permite separar estos 3 elementos de la url en un array
                $url = explode('/', $url);
                return $url;
            }
        }
    }
?>