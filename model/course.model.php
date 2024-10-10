<?php

    require_once "conexion.php";

    class ModeloCursos{

        static public function index($tabla){
            $sql = "SELECT * FROM $tabla";
            $stmt = Conexion::conectar()->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_CLASS);
            $stmt->close();
            $stmt=null;
        }
    }

?>