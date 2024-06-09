<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Categoría</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <h1 class="text-center p-3">Editar Categorías</h1>

    <?php
    include "../../../modelo/conexion.php";
    $id = $_GET["id"];
    $sql = $conexion->query("SELECT * FROM categoria WHERE id=$id");
    $datos = $sql->fetch(PDO::FETCH_OBJ);
    ?>

    <form class="col-4 p-3 m-auto" name="editarCatForm" method="post" action="../../../controlador/Gestion/Categoria/editar.php">
        <input type="hidden" name="id" value="<?= $id ?>">

        <div class="mb-3">
            <label for="exampleInputEditar" class="form-label">Editar Categoría:</label>
            <input type="text" class="form-control" name="nombre" value="<?= $datos->nombre ?>" required>
        </div>

        <button type="submit" class="btn btn-primary" name="btneditar" value="okeditar">Editar</button>
    </form>

</body>
</html>
