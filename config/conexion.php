<?php
    /* Inicializando la sesión del usuario */
    session_start();    
    /* Clase Conectar */
    class conectar{
        protected $dbh;
        /* función protegida cadena de conexion */
        protected function conexion(){
            try{
                /* cadena de conexión */
                $conectar = $this->dbh =new PDO("mysql:local=localhost;dbname=certificado","root","");
                return $conectar;
            }catch(Exception $e){
                /* En caso de error en la cadena de conexión */
                print "¡Error BD!: " . $e->getMessage()."<br/>";
                die();
            }
        }
        /* para impedir problemas con las ñ o tilde */
        public function set_names(){
            return $this->dbh->query("SET NAMES 'utf8'");
        }
        /* ruta principal del proyecto */
        public static function ruta(){
            return "http://localhost/certificados/";
        }
    }
?>