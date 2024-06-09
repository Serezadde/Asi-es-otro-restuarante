<div class="form-group">
    <label for="seleccionCat">Categoría</label>
    <select class="form-select" name="seleccionCat" id="seleccionCat" aria-label="Seleccionar Categoría" style="font-size: 18px;" onchange="this.form.submit()">
        <?php
        include "../../../modelo/conexion.php";
        $sql = "SELECT * FROM categoria";
        $stmt = $conexion->query($sql);

        if ($stmt === false) {
            die("Error en la consulta: " . implode(", ", $conexion->errorInfo()));
        }

        $categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);
        //Para cuando haya que poner un select de categoria
        if (count($categorias) > 0) {
            foreach ($categorias as $categoria) {

                $selected = ($categoria['id'] == $_SESSION['categoria_id']) ? 'selected' : '';
                echo "<option value='" . $categoria['id'] . "' $selected>" . htmlspecialchars($categoria['nombre']) . "</option>";
            }
        } else {
            echo "<option value=''>No hay categorías disponibles</option>";
        }
        ?>
    </select>
</div>
