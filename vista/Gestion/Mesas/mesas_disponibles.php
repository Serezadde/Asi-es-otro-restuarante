<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mesas disponibles</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/aec7d72014.js" crossorigin="anonymous"></script>
</head>
<body>
    <h1>Mesas</h1>

    <form name="SelMesaForm" method="get" action="../../../vista/Pedidos/nuevo_pedido.php">
        <div>
            <?php
                include "../../../modelo/conexion.php";
                include "../../../componentes/selecciontodaslasmesas.php";
            ?>
        </div>
        <button type="submit" class="btn btn-primary">Seleccionar<i class="fa-solid fa-pen-to-square"></i></button>
    </form>

    <?php if (empty($mesas)) { ?>
        <a href="#" class="btn btn-primary disabled">No hay mesas disponibles</a>
    <?php } ?>
    <br>
    <br>
    <br>
    <br>
    <a href="../../../vista/Pedidos/menu.php"><button class="btn btn-primary">Atrás</button></a>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>