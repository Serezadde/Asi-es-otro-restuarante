<?php
include "../../../modelo/conexion.php";
$id = $_GET["id"];

$sql = $conexion->query("SELECT * FROM mesa WHERE id=$id");
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EditarMesa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<body>

    <h1 class="text-center p-3">Editar Mesas</h1>

    <form class="col-4 p-3 m-auto" name="editarMesasForm" method="post" action="../../../controlador/Gestion/Mesas/editar.php">
        <input type="text" name= "id" value= "<?= $_GET["id"] ?>" readonly>

        <?php

        while ($datos = $sql->fetch(PDO::FETCH_OBJ)) { ?>
            <div class="mb-3">
                <label for="exampleInputeditar" class="form-label">Nombre de la Mesa:</label>
                <input type="text" class="form-control" name="nombre" value="<?= $datos->nombre ?>">
            </div>
        <?php }
        ?>

        <button type="submit" class="btn btn-primary" name="btneditar" value="okeditar">editar</button>
    </form>
</body>

</html>