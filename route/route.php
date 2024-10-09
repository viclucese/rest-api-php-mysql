<?php

    $arrayRutas = explode("/",$_SERVER['REQUEST_URI']);
    echo $_SERVER['REQUEST_URI'];

    echo "<pre>";
    print_r($arrayRutas);
    echo "</pre>";

    //en el ejemplo se compara con 2
    //yo lo tengo en 1 porque tengo un nivel menos de directorio

    if(count(array_filter($arrayRutas)) == 1) { 
        $json = array("detalle"=>"no encontrado");
        echo json_encode($json,true);
        return;
    }
    

?>