
<?php
include_once "cors.php";
$credenciales = json_decode(file_get_contents("php://input"));
include_once "funciones.php";
$resultado = guardarCredenciales($credenciales);
echo json_encode($resultado);
