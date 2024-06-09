<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include "../../../modelo/conexion.php";

if (isset($_POST['mesa_id']) && isset($_SESSION['productos']) && count($_SESSION['productos']) > 0) {
    $mesa_id = $_POST['mesa_id'];

    try {
        // Obtener el ID del pedido dado la mesa_id
        $sql = "SELECT sp_restaurante_pedido_por_mesa_obtener(:mesa_id) AS pedido_id";
        $statement = $conexion->prepare($sql);
        $statement->bindParam(":mesa_id", $mesa_id, PDO::PARAM_INT);
        $statement->execute();
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        $pedido_id = $row['pedido_id'];

        if (!$pedido_id) {
            throw new Exception("No se encontró un pedido en curso para la mesa proporcionada.");
        }

        // Crear comanda
        $sql = "CALL sp_restaurante_comanda_crear(:pedido_id)";
        $statement = $conexion->prepare($sql);
        $statement->bindParam(":pedido_id", $pedido_id, PDO::PARAM_INT);
        $statement->execute();

        // Obtener el ID de la comanda (obtenido de lastval())
        $statement = $conexion->query("SELECT lastval() AS comanda_id");
        $comanda_id = $statement->fetch(PDO::FETCH_ASSOC)['comanda_id'];

        // Crear instancias de `comanda_producto` por cada producto
        $sql = "CALL sp_comanda_producto_crear(:comanda_id, :producto_id, :unidades)";
        $statement = $conexion->prepare($sql);
        foreach ($_SESSION['productos'] as $producto) {
            $producto_id = $producto['id'];
            $unidades = $producto['unidades'];
            $statement->bindParam(":comanda_id", $comanda_id, PDO::PARAM_INT);
            $statement->bindParam(":producto_id", $producto_id, PDO::PARAM_INT);
            $statement->bindParam(":unidades", $unidades, PDO::PARAM_INT);
            $statement->execute();
        }

        // Calcular el precio final y actualizarlo en el pedido
        $sql = "SELECT sp_restaurante_producto_precio_calcularpreciofinalpedidocursor(:pedido_id) AS precio_final";
        $statement = $conexion->prepare($sql);
        $statement->bindParam(":pedido_id", $pedido_id, PDO::PARAM_INT);
        $statement->execute();
        $total = $statement->fetch(PDO::FETCH_ASSOC)['precio_final'];

        // Actualizar el precio en el pedido
        $sql = "UPDATE pedido SET precio = :total WHERE id = :pedido_id";
        $statement = $conexion->prepare($sql);
        $statement->bindParam(":total", $total, PDO::PARAM_STR); // Cambiar el tipo de dato a STR
        $statement->bindParam(":pedido_id", $pedido_id, PDO::PARAM_INT);
        $statement->execute();

        // Limpiar los productos de la tabla
        unset($_SESSION['productos']);
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}

$redirect_url = "../../../vista/Pedidos/menu.php";
header("Location: $redirect_url");
exit();
?>
