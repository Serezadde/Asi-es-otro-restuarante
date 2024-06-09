<!DOCTYPE html>
<html>
<head>
    <title>Seleccionar Mesa Ocupada</title>
</head>
<body>
    <h2>Seleccionar Mesa Ocupada</h2>
    <form method="post" action="../../controlador/Pedido/mesas_ocupada.php">
        <?php
        include "../../modelo/conexion.php";

        try {
            // Preparar y ejecutar la función almacenada usando PDO
            $sql = $conexion->prepare("SELECT * FROM sp_restaurante_mesas_ocupadas()");
            $sql->execute();
            $mesas = $sql->fetchAll(PDO::FETCH_ASSOC);

            if (!empty($mesas)) {
                echo '<div class="form-group">';
                echo '<label for="seleccionMesa">Mesas</label>';
                echo '<select class="form-select" name="seleccionMesa" id="seleccionMesa" aria-label="Seleccionar Mesa" style="font-size: 18px;">';
                foreach ($mesas as $mesa) {
                    echo "<option value='" . $mesa['id'] . "'>" . $mesa['nombre'] . "</option>";
                }
                echo '</select>';
                echo '</div>';
            } else {
                echo "No hay mesas ocupadas disponibles.";
            }
        } catch (PDOException $ex) {
            // Manejar cualquier excepción que ocurra durante la ejecución de la consulta
            echo "Error al ejecutar la consulta: " . $ex->getMessage();
        }
        ?>
        <br>
        <input type="submit" value="Seleccionar Mesa">
    </form>
</body>
</html>
