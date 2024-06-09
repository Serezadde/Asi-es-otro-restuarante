<?php
require_once("../../../modelo/conexion.php");

$sql = "SELECT * FROM sp_restaurante_mesas_ocupadas()";
$result = $conexion->query($sql);
$mesas = [];

if ($result && $result->rowCount() > 0) {
    $mesas = $result->fetchAll(PDO::FETCH_ASSOC);
}

if (!empty($mesas)) {
    // Ponemos estas etiquetas aquí para que se visualicen correctamente después
    echo '<div class="form-group">';
    echo '<label for="seleccionMesa">Mesas</label>';
    echo '<select class="form-select" name="seleccionMesa" id="seleccionMesa" aria-label="Seleccionar Mesa" style="font-size: 18px;">';
    foreach ($mesas as $mesa) {
        echo "<option value='" . $mesa['id'] . "'>" . $mesa['nombre'] . "</option>";
    }
    echo '</select>';
    echo '</div>';
}
?>
