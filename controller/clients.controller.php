<?php 

    class ControladorClientes{
        public function index(){
            $json = array("POST"=>"estas en la vista clientes");
            echo json_encode($json,true);
            return;
        }
    }

?>