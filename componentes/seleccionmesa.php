<?php
require_once("../../../modelo/conexion.php");

// Cuando haya un select para las mesas
$sql = "SELECT * FROM sp_restaurante_mesas_disponibles()";
$result = $conexion->query($sql);

if ($result) {
    $mesas = $result->fetchAll(PDO::FETCH_ASSOC);
    
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
        echo "No hay mesas disponibles.";
    }
} else {
    echo "Error al obtener las mesas disponibles: " . $conexion->errorInfo()[2];
}
?>
