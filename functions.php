
<?php

function eliminarVideojuego($id)
{
    $bd = obtenerConexion();
    $sentencia = $bd->prepare("DELETE FROM videojuegos WHERE id = ?");
    return $sentencia->execute([$id]);
}

function obtenerCredenciales()
{
    $bd = obtenerConexion();
    $sentencia = $bd->query("SELECT * FROM registro");
    return $sentencia->fetchAll();
}

function guardarCredenciales($credenciales)
{
    $bd = obtenerConexion();
    $sentencia = $bd->prepare("INSERT INTO registro(user, pass, document_type, document_number, created_date) VALUES (?, ?, ?, ?, ?)");
    return $sentencia->execute([$credenciales->username, $credenciales->password, $credenciales->type, $credenciales->document, $credenciales->created]);
}

function obtenerVariableDelEntorno($key)
{
    if (defined("_ENV_CACHE")) {
        $vars = _ENV_CACHE;
    } else {
        $file = "env.php";
        if (!file_exists($file)) {
            throw new Exception("El archivo de las variables de entorno ($file) no existe. Favor de crearlo");
        }
        $vars = parse_ini_file($file);
        define("_ENV_CACHE", $vars);
    }
    if (isset($vars[$key])) {
        return $vars[$key];
    } else {
        throw new Exception("La clave especificada (" . $key . ") no existe en el archivo de las variables de entorno");
    }
}
function obtenerConexion()
{
    $password = obtenerVariableDelEntorno("MYSQL_PASSWORD");
    $user = obtenerVariableDelEntorno("MYSQL_USER");
    $dbName = obtenerVariableDelEntorno("MYSQL_DATABASE_NAME");
    $database = new PDO('mysql:host=remotemysql.com;dbname=' . $dbName, $user, $password);
    $database->query("set names utf8;");
    $database->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
    $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $database->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    return $database;
}
