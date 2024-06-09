<!DOCTYPE html>
<html>
<?php
include "../../componentes/head.php";
?>

<head>
    <title>Administración:</title>
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

        <h1>Administración</h1>
        <a href="../Gestion/Categoria/categoria2.php"><button class="btn btn-primary">Gestión de Categorías</button></a>
        <br>
        <a href="../Gestion/Producto/producto2.php"><button class="btn btn-primary">Gestión de Productos</button></a>
        <br>
        <a href="../Gestion/Mesas/mesas2.php"><button class="btn btn-primary">Gestión de Mesas</button></a>
        <br>
        <a href="../Historial/historial.php"><button class="btn btn-primary">Historial de Pedidos</button></a>
        <br>
        <a href="../Acceso/gestion_password.php"><button class="btn btn-primary">Cambiar Contraseña</button></a>
        <br>
        <a href="../../inicio.php"><button class="btn btn-primary">Atrás</button></a>
    </div>
</body>

</html>