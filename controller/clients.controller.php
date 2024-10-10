<?php 

    class ControladorClientes{
        public function create(){
            $json = array("GET"=>"estas en la vista clientes");
            echo json_encode($json,true);
            return;
        }
    }

?>