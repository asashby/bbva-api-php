<?php
include_once "cors.php";
include_once "funciones.php";
$credenciales = obtenerCredenciales();
echo json_encode($credenciales);