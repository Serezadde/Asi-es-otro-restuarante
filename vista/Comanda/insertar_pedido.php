<!DOCTYPE html>
<html>
<head>
  <title>Nuevo Pedido</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container">
    <h1 class="text-center">Nuevo Pedido</h1>
    <div class="row justify-content-center mt-5">
      <div class="col-md-6">
        <form action="controlador/insertar_pedido.php" method="POST">
          <div class="mb-3">
            <label for="precio" class="form-label">Precio:</label>
            <input type="text" class="form-control" id="precio" name="precio">
          </div>
          <div class="mb-3">
            <label for="en_curso" class="form-label">En curso:</label>
            <input type="text" class="form-control" id="en_curso" name="en_curso">
          </div>
          <div class="mb-3">
            <label for="fecha" class="form-label">Fecha:</label>
            <input type="date" class="form-control" id="fecha" name="fecha">
          </div>
          <div class="mb-3">
            <label for="id_mesa" class="form-label">ID de Mesa:</label>
            <input type="text" class="form-control" id="id_mesa" name="id_mesa">
          </div>
          <button type="submit" class="btn btn-primary">Crear Pedido</button>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
