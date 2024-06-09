<?php



require "../../modelo/conexion.php";
require "../../modelo/mesas.php";
require "../../modelo/pedido.php";
require "../../modelo/comanda.php";

if (isset($_POST['mesa'])) {
    $mesa_id = $_POST['mesa'];

    // Obtener el pedido asociado a la mesa seleccionada
    $sql = "SELECT id FROM pedido WHERE id_mesa = $mesa_id AND en_curso = 'true'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $pedido_row = mysqli_fetch_assoc($result);
        $pedido_id = $pedido_row['id'];

        // Redirigir a la página de agregar comanda con el pedido seleccionado
        header("Location: ../../vista/Comanda/listar.php?pedido_id=$pedido_id");
        
    } else {
        echo "Error: No se encontró un pedido en curso para la mesa seleccionada.";
    }
}