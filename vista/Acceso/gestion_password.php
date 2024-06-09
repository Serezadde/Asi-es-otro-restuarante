<!DOCTYPE html>
<html>
<?php
include "../../componentes/head.php";

?>

<head>
    <title>Cambiar Contrasenna</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
        }

        .container {
            width: 400px;
            margin: 50px auto;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        .form-group input[type="text"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .btn {
            padding: 10px 20px;
            font-size: 16px;
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
</head>

<body>
    <div class="container-fluid">
        <div class="jumbotron">
            <h2>Cambiar Contraseña</h2>
            <br>

            <?php
            include "../../controlador/Acceso/gestion_password.php";
            ?>
            <div class="container-fluid">
                <form id="editarContrasena" action="gestion_password.php" method="post">
                    <div class="form-group">
                        <label>Contraseña Actual:</label>
                        <input type="password" class="form-control" name="contrasenaActual" required>
                    </div>
                    <div class="form-group">
                        <label>Nueva Contraseña:</label>
                        <input type="password" class="form-control" name="nuevaContrasena" required>
                    </div>
                    <div class="form-group">
                        <label for="repetirContrasena">Repetir Contraseña:</label>
                        <input type="password" id="repetirContrasena" name="repetirContrasena" required>
                    </div>
                    <?php
                    include "../../controlador/Acceso/inicio_sesion.php";
                    ?>
                    <button type="submit" class="btn btn-primary">Aceptar</button>
                </form>
                <br>

                <a href="../Administracion/administración_menu.php"><button button class="btn btn-primary">Atrás</button></a>
            </div>
        </div>
</body>

</html>