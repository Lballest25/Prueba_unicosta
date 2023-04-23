<?php 
    const SERVIDOR="127.0.0.1:3306";
    const BD="prueba_unicosta";
    const USUARIO="root";
    const CONTRASENA="";
    const UTF8="utf8";

    const SGBD= "mysql:host=".SERVIDOR.";dbname=".BD.";charset=".UTF8;

    class bdconexion{  
        protected function conexion()
        {
            $con = new PDO(SGBD,USUARIO,CONTRASENA);
            return $con;
        }
    }
?>