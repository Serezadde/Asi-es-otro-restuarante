<?php


include_once "../../modelo/conexion.php";
include_once "../../modelo/pedido.php"; 


$pedido = new Pedido($conexion);


if (isset($_GET['id'])) {
    $id_pedido = $_GET['id'];

 
    $pedido_detalle = $pedido->obtenerPedidoPorId($id_pedido);


    if ($pedido_detalle) {

        $productos_pedido = $pedido->obtenerProductosPorPedido($id_pedido);

        include "../../vista/detalles_pedido_vista.php";
    } else {
        echo "No se encontró ningún pedido con el ID proporcionado.";
    }
} else {
    echo "No se proporcionó ningún ID de pedido.";
}
?>
