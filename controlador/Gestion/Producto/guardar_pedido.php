<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include "../../../modelo/conexion.php";

try {
    $conexion->beginTransaction();

    if (isset($_POST['mesa_id']) && isset($_SESSION['productos']) && count($_SESSION['productos']) > 0) {
        $mesa_id = $_POST['mesa_id'];

        // Crear pedido
        $fecha_actual = date("Y-m-d");
        $en_curso = "true";
        $precio_temporal = 0;

        $statement = $conexion->prepare("INSERT INTO pedido (precio, en_curso, fecha, id_mesa) VALUES (?, ?, ?, ?)");
        $statement->execute([$precio_temporal, $en_curso, $fecha_actual, $mesa_id]);

        $pedido_id = $conexion->lastInsertId();

        // Crear comanda
        $statement = $conexion->prepare("INSERT INTO comanda (id_pedido) VALUES (?)");
        $statement->execute([$pedido_id]);

        $comanda_id = $conexion->lastInsertId();

        // Crear una instancia de `comanda_producto` por fila de la tabla
        $statement = $conexion->prepare("INSERT INTO comanda_producto (id_comanda, id_producto, cantidad) VALUES (?, ?, ?)");
        foreach ($_SESSION['productos'] as $producto) {
            $statement->execute([$comanda_id, $producto['id'], $producto['unidades']]);
        }

        // Calcular el precio final y actualizarlo en el pedido
        $statement = $conexion->prepare("UPDATE pedido SET precio = (SELECT SUM(precio * cantidad) FROM comanda_producto cp JOIN producto p ON cp.id_producto = p.id WHERE cp.id_comanda = ?) WHERE id = ?");
        $statement->execute([$comanda_id, $pedido_id]);

        // Limpiar los productos de la tabla
        unset($_SESSION['productos']);
    }

    $conexion->commit();
} catch (PDOException $e) {
    $conexion->rollBack();
    echo "Error: " . $e->getMessage();
}

header("Location: ../../../vista/Pedidos/menu.php");
exit();
?>
