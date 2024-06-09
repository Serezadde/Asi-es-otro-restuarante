<?php
// Parámetros de conexión
$cadenaConexion = "pgsql:dbname=Restaurante;host=localhost;port=5432";
$usuario = "postgres";
$clave = "1234";

try {
    // Crear una instancia de PDO con los parámetros de conexión
    $conexion = new PDO($cadenaConexion, $usuario, $clave);
    
    // Establecer el modo de errores de PDO para excepciones
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Establecer el charset a utf8
    $conexion->exec("SET NAMES 'utf8'");
    
} catch (PDOException $e) {
    // Capturar y mostrar el error de conexión
    echo "Error ocurrio un problema en Base de datos: " . $e->getMessage();
    $conexion = null; // Asegurar que la conexión sea nula en caso de error
}

// (Opcional) Cerrar la conexión cuando ya no sea necesaria
// $conexion = null;
?>
