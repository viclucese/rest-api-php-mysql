<?php

    $arrayRutas = explode("/",$_SERVER['REQUEST_URI']);
    // echo $_SERVER['REQUEST_URI'];

    // echo "<pre>";
    // print_r($arrayRutas);
    // echo "</pre>";

    //en el ejemplo se compara con 2
    //yo lo tengo en 1 porque tengo un nivel menos de directorio

    if(count(array_filter($arrayRutas)) == 1) { 
        $json = array("Mensaje"=>"No hay API");
        echo json_encode($json,true);
        return;
    } else {
        if(count(array_filter($arrayRutas)) == 2) { 

            /*
            Peticiones de cursos
            */
            if(array_filter($arrayRutas)[2] == "cursos") {

                /*
                    Petición POST
                */
                if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "POST"){
                    $cursos = new ControladorCursos();
                    $cursos->create();
                } else if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "GET") {
                    $cursos = new ControladorCursos();
                    $cursos->index();
                }
            }

            /**
             * Peticiones de clientes/registros
             * 
             */

             /**
              * POST a clientes
              */

            if(array_filter($arrayRutas)[2] == "registro") {
                if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "POST"){
                    $datos = array("nombre"=>$_POST["nombre"],"apellido"=>$_POST["apellido"],"email"=>$_POST["email"]);
                    //print_r($datos);
                    $clientes = new ControladorClientes();
                    $clientes->create($datos);
                }
            }            
        } else {
            if(array_filter($arrayRutas)[2] == "cursos" && is_numeric(array_filter($arrayRutas)[3])){
                if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "GET"){
                    $cursos = new ControladorCursos();
                    $cursos->show(array_filter($arrayRutas)[3]);
                }
                
                if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "PUT"){
                    $editarCurso = new ControladorCursos();
                    $editarCurso->update(array_filter($arrayRutas)[3]);
                }  

                if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "DELETE"){
                    $borrarCurso = new ControladorCursos();
                    $borrarCurso->delete(array_filter($arrayRutas)[3]);
                } 
            }
        }
    }
    

?>