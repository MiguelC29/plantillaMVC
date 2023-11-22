<?php
    //CLASE PARA CONECTARSE A LA BASE DE DATOS Y EJECUTAR CONSULTAS (USANDO PDO PHP)
    class Base {
        private $host = DB_HOST;
        private $usuario = DB_USUARIO;
        private $password = DB_PASSWORD;
        private $nombre_base = DB_NOMBRE;

        private $dbh; //Database Handler (DBH)
        private $stmt; //Statement
        private $error;

        public function __construct() {
            //Configurar la conexion
            $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->nombre_base;
            $opciones = array(
                PDO::ATTR_PERSISTENT => true, //Conexion persistente
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION //Manejo de errores
            );

            //Crear una instancia de PDO
            try {
                $this->dbh = new PDO($dsn, $this->usuario, $this->password, $opciones);
                $this->dbh->exec('set names utf8');
            } catch (PDOException $e) {
                $this->error = $e->getMessage();
                echo $this->error;
            }
        }

        //Preparamos la consulta
        public function query($sql) {
            $this->stmt = $this->dbh->prepare($sql);
        }

        // Vincular la consulta con bind
        public function bind($parametro, $valor, $tipo = null) {
            if (is_null($tipo)) {
                switch (true) {
                    case is_int($valor):
                        $tipo = PDO::PARAM_INT;
                        break;
                    case is_bool($valor):
                        $tipo = PDO::PARAM_BOOL;
                        break;
                    case is_null($valor):
                        $tipo = PDO::PARAM_NULL;
                        break;
                    default:
                        $tipo = PDO::PARAM_STR;
                        break;
                }
            }
            $this->stmt->bindValue($parametro, $valor, $tipo);
        }

        //Ejecuta la consulta
        public function execute() {
            return $this->stmt->execute();
        }

        //Obtener los registros de la consulta
        public function registros() {
            $this->execute();
            return $this->stmt->fetchAll(PDO::FETCH_OBJ);
        }

        //Obtener un solo registro de la consulta
        public function registro() {
            $this->execute();
            return $this->stmt->fetch(PDO::FETCH_OBJ);
        }

        //Obtener cantidad de filas o cantidad de registros con el metodo rowCount
        public function rowCount() {
            return $this->stmt->rowCount();
        }
    }
?>