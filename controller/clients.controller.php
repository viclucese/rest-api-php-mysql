<?php 

    class ControladorClientes{
        public function create(){
            $json = array("POST"=>"estas en la vista clientes");
            echo json_encode($json,true);
            return;
        }
    }

?>