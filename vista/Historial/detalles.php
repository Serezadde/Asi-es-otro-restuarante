<!DOCTYPE html>
<html>
<?php include "../../componentes/head.php"; ?>

<head>
    <title>Detalles del Pedido</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            font-size: 16px;
        }

        .container {
            width: 80%;
            margin: 20px auto;
        }

        h1 {
            text-align: center;
            font-size: 24px;
        }

        .details {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .details-column {
            flex-basis: 45%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .details-column h2 {
            margin-top: 0;
            font-size: 18px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th,
        table td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
            font-size: 16px;
        }

        table th {
            background-color: #f2f2f2;
        }

        .btn {
            display: block;
            margin-top: 20px;
            padding: 10px 20px;
            border: none;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            text-align: center;
            border-radius: 5px;
            font-size: 25px;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .details p {
            font-size: 18px;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/aec7d72014.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <h1>Detalles del Pedido:</h1>

        <?php include "../../controlador/Historial/info_pedido.php"; ?>

        <h2>Productos:</h2>
        <table>
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Unidades</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php include "../../controlador/Historial/info_producto.php"; ?>
            </tbody>
        </table>
        <a href="../Historial/historial.php"><button button class="btn btn-primary" style="font-size: 18px">Atrás</button></a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
