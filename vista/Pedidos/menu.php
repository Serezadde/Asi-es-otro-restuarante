<!DOCTYPE html>
<html>
<?php
include "../../componentes/head.php";


?>

<head>
    <title>Menu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container-fluid {
            text-align: center;
            margin-top: 50px;
        }

        .btn {
            font-size: 16px;
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

        .label {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }
    </style>

</head>

<body>
    <div class="container-fluid">
        <div class="jumbotron">

            <h1>Sistemas de Pedidos:</h1>

            <a href="../../vista/Gestion/Mesas/mesas_disponibles.php"><button button class="btn btn-primary">Nuevo Pedido</button></a>
            <a href="../../vista/Gestion/Mesas/mesas_ocupadas.php"><button button class="btn btn-primary">Añadir comanda a pedido</button></a>
            <a href="../../vista/Pedidos/antes_finalizar.php"><button button class="btn btn-primary">Finalizar pedido</button></a>

        </div>
    </div>
    <a href="../../inicio.php"><button button class="btn btn-primary">Atrás</button></a>

</body>

</html>