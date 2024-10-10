<?php
    require_once "controller/route.controller.php";
    require_once "controller/course.controller.php";
    require_once "controller/clients.controller.php";
    require_once "model/client.model.php";
    require_once "model/course.model.php";

    $rutas = new ControladorRutas();
    $rutas->inicio();
?>