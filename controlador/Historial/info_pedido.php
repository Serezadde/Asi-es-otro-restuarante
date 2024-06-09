<?php
require "../../modelo/conexion.php";
require "../../modelo/util.php";

if (isset($_GET['id'])) {
    $id_pedido = $_GET['id'];

    try {
        // Preparar la consulta para obtener los detalles del pedido
        $sql = $conexion->prepare("SELECT * FROM sp_restaurante_pedido_detalle(:pedido_id)");
        
        // Vincular el parámetro de la consulta preparada
        $sql->bindParam(':pedido_id', $id_pedido, PDO::PARAM_INT);
        
        // Ejecutar la consulta
        $sql->execute();
        
        // Obtener el resultado de la función
        $result = $sql->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            echo "<div class='details'>
                    <div class='details-column'>
                        <h2>Información del Pedido</h2>
                        <p><strong>ID Pedido:</strong> {$result['id_pedido']}</p>
                        <p><strong>En Curso:</strong> " . obtenerIcono($result['en_curso']) . "</p>
                        <p><strong>Fecha:</strong> {$result['fecha']}</p>
                        <p><strong>Nombre Mesa:</strong> {$result['nombre_mesa']}</p>
                        <p><strong>Precio Total:</strong> {$result['precio_total']}</p>
                    </div>
                  </div>";
        } else {
            echo "<p>No se encontraron detalles del pedido.</p>";
        }
    } catch (PDOException $ex) {
        // Manejar cualquier excepción que ocurra durante la ejecución de la consulta
        echo "Error al ejecutar la consulta: " . $ex->getMessage();
    }
}
?>