<!DOCTYPE html>
<html>

<head>
  <title>Administración de Mesas</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
  <h1 class="text-center p-3">Administración de Mesas</h1>
  <script>
    function eliminar(){
      var respuesta=confirm("¿Estas seguro que quieres eliminar?");
return respuesta;
    }


  </script>
  <?php
  include "../../../modelo/conexion.php";
  include "../../../controlador/Gestion/Mesas/crear.php";
  include "../../../controlador/Gestion/Mesas/eliminar.php";
  ?>

  <div class="container-fluid row">
    <div class="col-md-4">
    <form name="CrearCatForm" method="post">
        <div class="mb-3">
          <label for="exampleCrearMesas" class="form-label">Crear Mesas:</label>
          <input type="text" class="form-control" name="nombre">
        </div>
        <button type="submit" class="btn btn-primary" name="btncrear" value="okcrear">Crear</button>
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
            $sql = $conexion->query("SELECT * FROM mesa");
            while ($datos = $sql->fetch(PDO::FETCH_OBJ)) {
            ?>
              <tr>
                <td><?= $datos->id ?></td>
                <td><?= $datos->nombre ?></td>
                <td>
                  <a href="../../../vista/Gestion/Mesas/editar_mesa.php?id=<?= $datos->id ?>" class="btn btn-small btn-warning">Editar <i class="fa-solid fa-pen-to-square"></i></a>

                  <a onclick="return eliminar()" href="mesas2.php?id=<?= $datos->id ?>" class="btn btn-small btn-danger">Borrar <i class="fa-solid fa-trash"></i></a>
                </td>
              </tr>
            <?php
            }
            ?>
          </tbody>
        </table>

      </div>
    </div>
    <footer>
      <a href="../../Administracion/administración_menu.php"><button class="btn btn-primary">Atrás</button></a>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>