<!DOCTYPE html>
<html>
<head>
  <title>Administración de Productos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://kit.fontawesome.com/aec7d72014.js" crossorigin="anonymous"></script>
  <style>
    body { font-family: Arial, sans-serif; font-size: 16px; }
    tbody tr { cursor: pointer; }
    .form-label, .form-control { font-size: 17px; }
    .btn { font-size: 17px; }
    #productosTable th, #productosTable td { font-size: 17px; }
  </style>
</head>
<body>
  <h1 class="text-center p-3">Productos:</h1>
  <script>
    function eliminar() {
      var respuesta = confirm("¿Estás seguro que quieres eliminar?");
      return respuesta;
    }
  </script>
  <?php include "../../modelo/conexion.php"; ?>
  <div class="container-fluid row">
    <div class="col-md-4">
      <h2 class="text-left p-3">Nuevo Pedido:</h2>
      <form name="CrearProdForm" method="post" action="../../../controlador/Gestion/Producto/crear.php">
        <div>
          <?php include "../../componentes/seleccionproducto.php"; ?>
        </div>
        <button type="submit" class="btn btn-primary" name="btncrear" value="okcrear">Crear</button>
      </form>
    </div>
    <div class="col-md-8">
    <?php include "../../controlador/Pedido/pedido_finalizado.php"; ?>
    <table class="table">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Unidades</th>
                <th>Precio Unitario</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($detalle_comandas as $comanda) { ?>
                <tr>
                    <td><?= $comanda['nombre'] ?></td>
                    <td><?= $comanda['cantidad'] ?></td>
                    <td><?= $comanda['precio'] ?>€</td>
                    <td><?= $comanda['precio'] * $comanda['cantidad'] ?>€</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    </div>
  </div>
  <footer>
    <a href="../Administracion/administración_menu.php"><button class="btn btn-primary">Atrás</button></a>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
