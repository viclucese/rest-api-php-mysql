<?php 

    class ControladorCursos{
        public function index(){

            /**
             * Validando credenciales
             */
            //así se recogen de un basic auth con php

            $clientes =  ModeloClientes::index("clientes");

            

            if(isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])){
                foreach ($clientes as $key => $value) {
                    if(base64_encode($_SERVER['PHP_AUTH_USER'].":".$_SERVER['PHP_AUTH_PW']) ==
                        base64_encode($value["id_cliente"].":".$value["llave_secreta"])){

                            $cursos = ModeloCursos::index("cursos");
                            $json = array("Statusllll"=>200,
                                            "total_registros"=>count($cursos));
                            echo json_encode($json,true);
                            return;

                    }
                }
                // $user = $_SERVER['PHP_AUTH_USER'];
                // $pass = $_SERVER['PHP_AUTH_PW'];
                
            }

            
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