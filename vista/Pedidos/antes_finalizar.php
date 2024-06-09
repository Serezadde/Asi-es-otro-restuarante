<?php
include "../../modelo/conexion.php";
include "../../modelo/util.php";

try {
    // Preparar y ejecutar la función almacenada usando PDO
    $sql = $conexion->prepare("SELECT * FROM sp_restaurante_pedido_obtenercurso()");
    $sql->execute();
    $resultado = $sql->fetchAll(PDO::FETCH_OBJ);
} catch (PDOException $ex) {
    // Manejar cualquier excepción que ocurra durante la ejecución de la consulta
    echo "Error al ejecutar la consulta: " . $ex->getMessage();
}
?>

<!DOCTYPE html>
<html>
<?php include "../../componentes/head.php"; ?>
<head>
    <title>Historial de Pedidos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 16px;
        }
        h2 {
            font-size: 24px;
        }
        .container {
            text-align: center;
            margin-top: 50px;
        }
        .table-container {
            margin: auto;
            width: 80%;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        .btn {
            font-size: 18px;
            padding: 10px 20px;
            margin: 10px;
            border: none;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
    <script src="https://kit.fontawesome.com/aec7d72014.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <h2>Pedidos por finalizar:</h2>
        <div class="table-container">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Precio</th>
                    <th>Fecha</th>
                    <th>Mesa</th>
                    <th>Detalles</th>
                </tr>
                <tbody>
                    <?php foreach ($resultado as $datos) { ?>
                        <tr>
                            <td><?= htmlspecialchars($datos->id_pedido) ?></td>
                            <td><?= htmlspecialchars($datos->precio) ?> €</td>
                            <td><?= htmlspecialchars($datos->fecha) ?></td>
                            <td><?= htmlspecialchars($datos->nombre_mesa) ?></td>
                            <td><a href="finalizar_pedido.php?id_pedido=<?= htmlspecialchars($datos->id_pedido) ?>" class="btn btn-small btn-success">Finalizar <i class="fa-solid fa-cart-shopping"></i></a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <a href="../Pedidos/menu.php"><button class="btn btn-primary">Atrás</button></a>
    </div>
</body>
</html>
