<?php
require "../../../modelo/conexion.php";
require "../../../modelo/producto.php";

$producto = new Producto($conexion);

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if ($producto->eliminarProducto($id)) {
        header("location:../../../vista/Gestion/Producto/producto2.php");
    } else {
        echo '<div class="alert alert-danger">Error al eliminar el producto</div>';
    }
} else {
    echo '<div class="alert alert-warning">ID de producto no especificado</div>';
}
?>
