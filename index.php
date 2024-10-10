<?php
    require_once "controller/route.controller.php";
    require_once "controller/course.controller.php";
    require_once "controller/clients.controller.php";

    $rutas = new ControladorRutas();
    $rutas->inicio();
?>