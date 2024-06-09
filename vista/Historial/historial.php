<?php
include "../../modelo/conexion.php";
include "../../modelo/util.php";

$sql = $conexion->prepare("SELECT * FROM sp_restaurante_obtener_historial_pedidos()");
$sql->execute();
$resultado = $sql->fetchAll(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html>
<?php include "../../componentes/head.php"; ?>
<head>
    <title>Historial de Pedidos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 80%;
            max-width: 800px;
        }

        h2 {
            margin-top: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .btn {
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 4px;
            border: none;
            background-color: blue;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #45a049;
        }

    </style>
    <script src="https://kit.fontawesome.com/aec7d72014.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <h2>Historial de Pedidos:</h2>
        <div class="table-container">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Precio</th>
                    <th>En curso</th>
                    <th>Fecha</th>
                    <th>Mesa</th>
                    <th>Detalles</th>
                </tr>
                <tbody>
                    <?php foreach ($resultado as $datos) { ?>
                        <tr>
                            <td><?= $datos->id ?></td>
                            <td><?= $datos->precio ?> €</td>
                            <td><?= obtenerIcono($datos->en_curso) ?></td>
                            <td><?= $datos->fecha ?></td>
                            <td><?= $datos->id_mesa ?></td>
                            <td><a href="detalles.php?id=<?= $datos->id ?>" class="btn btn-small btn-success"><i class="fa-solid fa-eye"></i>Detalles </a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <a href="../Administracion/administración_menu.php" class="btn btn-primary">Atrás</a>
    </div>
</body>
</html>
