<?php
include "../../modelo/conexion.php";

// Verificar si la sesión está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// id de la categoría desde la sesión
$categoria_id = isset($_SESSION['categoria_id']) ? $_SESSION['categoria_id'] : '';

echo '<div class="form-group">';
echo '<label for="seleccionProd">Producto</label>';
echo '<select class="form-select" name="seleccionProd" id="seleccionProd" aria-label="Seleccionar Producto" style="font-size: 18px;">';

// Verifico id de categoría
if (!empty($categoria_id)) {
    try {
        $sql = "SELECT id, nombre, precio FROM producto WHERE id_categoria = :categoria_id";
        $statement = $conexion->prepare($sql);
        $statement->bindParam(':categoria_id', $categoria_id, PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        if (count($result) > 0) {
            // select con los productos
            foreach ($result as $producto) {
                echo "<option value='" . htmlspecialchars($producto['id']) . "'>" . htmlspecialchars($producto['nombre']) . " - $" . htmlspecialchars($producto['precio']) . "</option>";
            }
        } else {
            echo "<option value=''>No hay productos disponibles</option>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "<option value=''>Selecciona una categoría primero</option>";
}

echo '</select>';
echo '</div>';
?>
