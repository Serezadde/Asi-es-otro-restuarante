<!DOCTYPE html>
<html>
<head>
    <title>Administración de Categorías</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/aec7d72014.js" crossorigin="anonymous"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        tbody tr {
            cursor: pointer;
        }
    </style>
</head>
<body>
    <script>
        function eliminar() {
            return confirm("¿Estás seguro que quieres eliminar?");
        }
    </script>
    <h1 class="text-center p-3">Administración de Categorías</h1>
    <div class="container-fluid row">
        <div class="col-md-4">
            <form name="CrearCatForm" method="post" action="../../../controlador/Gestion/Categoria/crear2.php">
                <div class="mb-3">
                    <label for="exampleInputCrear" class="form-label">Crear Categoría:</label>
                    <input type="text" class="form-control" name="nombre" required>
                </div>
                <button type="submit" class="btn btn-primary">Crear</button>
            </form>
        </div>
        <div class="col-md-8">
            <table class="table" id="categoriasTable">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Operaciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include "../../../modelo/conexion.php";
                    $sql = $conexion->query("SELECT * FROM categoria");
                    while ($datos = $sql->fetch(PDO::FETCH_OBJ)) {
                    ?>
                    <tr>
                        <td><?= $datos->id ?></td>
                        <td><?= $datos->nombre ?></td>
                        <td>
                            <a href="../../../vista/Gestion/Categoria/editar_cat.php?id=<?= $datos->id ?>" class="btn btn-small btn-warning">Editar 
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <a onclick="return eliminar()" href="../../../controlador/Gestion/Categoria/eliminar.php?id=<?= $datos->id ?>" class="btn btn-small btn-danger">Borrar 
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <footer>
        <a href="../../Administracion/administración_menu.php"><button class="btn btn-primary">Atrás</button></a>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
