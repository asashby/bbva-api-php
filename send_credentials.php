<?php
include_once "cors.php";
include_once "functions.php";
$credenciales = json_decode(file_get_contents("php://input"));
$resultado = guardarCredenciales($credenciales);
echo json_encode($resultado);
?>