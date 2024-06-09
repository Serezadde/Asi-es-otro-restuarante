<?php
require "../../../modelo/conexion.php";
require "../../../modelo/producto.php";

$producto = new Producto($conexion); 

if (!empty($_POST["btncrear"])) {
    if (!empty($_POST["nombre"]) && !empty($_POST["precio"]) && !empty($_POST["seleccionCat"])) {
        $nombre = $_POST["nombre"];
        $precio = $_POST["precio"];
        $id_categoria = $_POST["seleccionCat"];

        if ($producto->insertarProducto($nombre, $precio, $id_categoria)) {
            header("Location: ../../../vista/Gestion/Producto/producto2.php");
        } else {
            echo '<div class="alert alert-danger">Error al registrar el producto</div>';
        }
    } else {
        echo '<div class="alert alert-warning">Todos los campos son obligatorios</div>';
    }
}
?>

