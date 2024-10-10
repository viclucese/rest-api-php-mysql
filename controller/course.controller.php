<?php 

    class ControladorCursos{
        public function index(){
            $cursos = ModeloCursos::index("cursos");
            $json = array("GET"=>$cursos,);
            echo json_encode($json,true);
            return;
        }

        public function create(){
            $json = array("POST"=>"estas en la vista create cursos");
            echo json_encode($json,true);
            return;
        }

        public function show($id){
            $json = array("GET"=>"Este es el curso con el id:  " . $id);
            echo json_encode($json,true);
            return;
        }

        public function update($id){
            $json = array("PUT"=>"Haciendo update en el curso con el id:  " . $id);
            echo json_encode($json,true);
            return;
        }

        public function delete($id){
            $json = array("DELETE"=>"Borrando el curso con el id:  " . $id);
            echo json_encode($json,true);
            return;
        }

    }

?>