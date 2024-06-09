<?php
$mesas = [];
$sql = "SELECT id, nombre FROM mesa";
$resultado = $conexion->query($sql);

if ($resultado->rowCount() > 0) {
    $mesas = $resultado->fetchAll(PDO::FETCH_ASSOC);
}
?>
<div class="form-group">
    <label for="mesaSelect">Seleccionar Mesa</label>
    <select class="form-select" name="id" id="mesaSelect" required>
        <?php foreach ($mesas as $mesa) { ?>
            <option value="<?= $mesa['id'] ?>"><?= $mesa['nombre'] ?></option>
        <?php } ?>
    </select>
</div>
