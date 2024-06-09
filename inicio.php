<!DOCTYPE html>
<html>
<?php
include "componentes/head.php";
include "modelo/usuario.php";

?>

<head>
    <title>RESTAURANTE VILLA DE AGÜIMES</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('img/titulo.jpg');
            background-size: cover;
        }

        .container-fluid {
            text-align: center;
            margin-top: 50px;
        }

        .btn {
            font-size: 20px;
            padding: 10px 20px;
            margin: 10px;
            border: none;
            background-color: #007bff;
            color: white;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .label {
            font-size: 15px;
            color: black;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="jumbotron">

            <h1>RESTAURANTE VILLA DE AGÜIMES</h1>

            <a href="vista/Pedidos/menu.php"><button button class="btn btn-primary">Sistema de Pedidos</button></a>
            <a href="vista/Acceso/inicio_sesion.php"><button button class="btn btn-primary">Administración</button></a>
            <br>
            <div class="label">Christian José Quintana Perera, Fernando Zerpa Niño y Moisés Antonio Pestano Castro</div>
            <br>
            <div class="label">Curso: 1º DAW</div>
            <br>
            <div class="label">Base de datos</div>
        </div>
    </div>
</body>

</html>