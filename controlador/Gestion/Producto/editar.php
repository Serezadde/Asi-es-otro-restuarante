<?php

require "../../../modelo/conexion.php";
require "../../../modelo/producto.php";

$producto = new Producto($conexion);

if (!empty($_POST["btneditar"])) {
    if (!empty($_POST["id"]) && !empty($_POST["nombre"]) && !empty($_POST["precio"]) && !empty($_POST["seleccionCat"])) {
        $id = $_POST["id"];
        $nombre = $_POST["nombre"];
        $precio = $_POST["precio"];
        $selCat = $_POST["seleccionCat"];

        if ($producto->editarProducto($id, $nombre, $precio, $selCat)) {
            header("Location:../../../vista/Gestion/Producto/producto2.php");
            exit;
        } else {
            echo "<div class='alert alert-danger'>Ocurrió un error al actualizar el producto</div>";
        }
    } else {
        echo "<div class='alert alert-warning'>Todos los campos son obligatorios</div>";
    }
}
