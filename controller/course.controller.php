<?php 

    class ControladorCursos{
        public function index(){
            $json = array("POST"=>"estas en la vista cursos");
            echo json_encode($json,true);
            return;
        }

    }

?>