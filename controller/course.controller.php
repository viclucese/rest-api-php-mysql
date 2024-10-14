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

        public function create($datos){

            /**
             * Validando credenciales
             */
            $clientes =  ModeloClientes::index("clientes");

            if(isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])){
                foreach ($clientes as $key => $valueCliente) {
                    if(base64_encode($_SERVER['PHP_AUTH_USER'].":".$_SERVER['PHP_AUTH_PW']) ==
                        base64_encode($valueCliente["id_cliente"].":".$valueCliente["llave_secreta"])){

                            foreach ($datos as $key => $valueDatos) {
                                if(isset($valueDatos) && !preg_match('/^[(\\)\\=\\&\\$\\;\\-\\_\\*\\"\\<\\>\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $valueDatos)){
                                    $json = array(
                                        "Status"=>404,
                                        "Detalle"=>"Error en el campo ". $key
                                    );
                                    echo json_encode($json, true);
                                    return;
                                }
                            }

                            $cursos = ModeloCursos::index("cursos");

                            foreach ($cursos as $key => $value) {
                                if($value->titulo == $datos['titulo']){
                                    $json = array(
                                        "Status"=>404,
                                        "Detalle"=>"Título repetido."
                                    );
                                    echo json_encode($json, true);
                                    return;
                                }
                                if($value->descripcion == $datos['descripcion']){
                                    $json = array(
                                        "Status"=>404,
                                        "Detalle"=>"Descripcion repetida."
                                    );
                                    echo json_encode($json, true);
                                    return;
                                }
                            }

                            /**
                             * Enviar datos al modelo
                             */

                             $datos = array(
                                "titulo"=>$datos['titulo'],
                                "descripcion"=>$datos['descripcion'],
                                "instructor"=>$datos['instructor'],
                                "imagen"=>$datos['imagen'],
                                "precio"=>$datos['precio'],
                                "id_creador"=>$valueCliente['id'],
                                "precio"=>date('Y-m-d h:i:s'),
                                "precio"=>date('Y-m-d h:i:s')
                            );

                            $create = ModeloCursos::create("cursos",$datos);

                            if($create == "ok"){
                                $json = array(
                                    "Status" => 200,
                                    "Detalle" => "Curso añadido."
                                );
                                echo json_encode($json, true);
                                return;
                            }


                    }


                }
                // $user = $_SERVER['PHP_AUTH_USER'];
                // $pass = $_SERVER['PHP_AUTH_PW'];


                
            }
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