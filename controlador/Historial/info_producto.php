<?php
require "../../modelo/conexion.php";

if (isset($_GET['id'])) {
    $id_pedido = $_GET['id'];

    try {
        // Preparar la consulta para obtener los productos del pedido
        $sql = $conexion->prepare("SELECT * FROM sp_restaurante_obtener_productos_pedido(:pedido_id)");
        
        // Vincular el parámetro de la consulta preparada
        $sql->bindParam(':pedido_id', $id_pedido, PDO::PARAM_INT);
        
        // Ejecutar la consulta
        $sql->execute();
        
        // Obtener los resultados de la función
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);

        // Mostrar los productos en la tabla
        foreach ($result as $row) {
            echo "<tr>
                    <td>{$row['producto']}</td>
                    <td>{$row['precio']}</td>
                    <td>{$row['unidades']}</td>
                    <td>{$row['subtotal']}</td>
                  </tr>";
        }
    } catch (PDOException $ex) {
        // Manejar cualquier excepción que ocurra durante la ejecución de la consulta
        echo "Error al ejecutar la consulta: " . $ex->getMessage();
    }
}
?>
