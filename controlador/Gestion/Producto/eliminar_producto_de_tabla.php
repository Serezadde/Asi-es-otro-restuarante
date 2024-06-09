<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include "../../../modelo/conexion.php";

if (isset($_POST['producto_id'])) {
    $producto_id = $_POST['producto_id'];

    if (isset($_SESSION['productos'])) {
        foreach ($_SESSION['productos'] as $key => $producto) {
            if ($producto['id'] == $producto_id) {
                unset($_SESSION['productos'][$key]);
                break;
            }
        }
        $_SESSION['productos'] = array_values($_SESSION['productos']);
    }
}

$mesa_id = $_POST['mesa_id'];
$redirect_url = "../../../vista/Pedidos/nuevo_pedido.php?id=" . $mesa_id;
header("Location: $redirect_url");
exit();
?>