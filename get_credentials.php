<?php
include_once "cors.php";
include_once "functions.php";
$credenciales = obtenerCredenciales();
echo json_encode($credenciales);