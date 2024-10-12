<?php 

    class ControladorClientes{
        public function create($datos){

            // echo "<pre>"; print_r($datos); echo "</pre>";
            // $json = array("POST"=>"estas en la vista clientes");
            // echo json_encode($json,true);

            /**
             * Validando nombre
             */

            if(isset($datos["nombre"]) && !preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/' , $datos["nombre"])){
                $json = array(
                    "Status"=>404,
                    "Mensaje"=>"Error en el campo de nombre"
                );
                echo json_encode($json, true);
            } 

            if(isset($datos["apellido"]) && !preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/' , $datos["apellido"])){
                $json = array(
                    "Status"=>404,
                    "Mensaje"=>"Error en el campo de apellido"
                );
                echo json_encode($json,true);
            } 

            if(isset($datos["email"]) && !preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $datos["email"])){
                $json = array(
                    "Status"=>404,
                    "Mensaje"=>"Error en el campo de email"
                );
                echo json_encode($json,true);
            } 

            $clientes = ModeloClientes::index("clientes");

            foreach ($clientes as $key => $value) {
                if($value["email"] == $datos["email"]){
                    $json = array(
                        "Status"=>200,
                        "Mensaje"=>"El email está repetido"
                    );
                    echo json_encode($json,true);
                    return;
                }
            }
            // $json = array(
            //     "Status"=>200,
            //     "Mensaje"=>$clientes
            // );

            /**
             * 
             * Generar credenciales del cliente
             */

            

            $id_cliente = str_replace("$","c",crypt($datos["nombre"].$datos["apellido"].$datos["email"],'$2a$07$afartwetsdAD52356FEDGsfhsd$'));
             //echo "<pre>"; print_r($id_cliente); echo "</pre>";
            $llave_secreta = str_replace("$","a",crypt($datos["email"].$datos["apellido"].$datos["nombre"],'$2a$07$afartwetsdAD52356FEDGsfhsd$'));
             //echo "<pre>"; print_r($llave_secreta); echo "</pre>";

            $datos = array("nombre"=>$datos["nombre"],
                            "apellido"=>$datos["apellido"],
                            "email"=>$datos["email"],
                            "id_cliente"=>$id_cliente,
                            "llave_secreta"=>$llave_secreta,
                            "created_at"=>date('Y-m-d h:i:s'),
                            "updated_at"=>date('Y-m-d h:i:s')
                        );

             $create = ModeloClientes::create("clientes",$datos);
             if($create == "ok"){
                $json = array(
                        "Status"=>200,
                        "Mensaje"=>"Cliente registrado correctamente"
                    );
                echo json_encode($json,true);
                return;
             }
        }
    }

?>