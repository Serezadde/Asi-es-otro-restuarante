<?php
require "../../../modelo/conexion.php";
require "../../../modelo/mesas.php";

$mesas = new Mesas($conexion);

if (isset($_POST["btneditar"])) {
    if (!empty($_POST["id"]) && !empty($_POST["nombre"])) {
        $id = $_POST["id"];
        $nombre = $_POST["nombre"];

        $resultado = $mesas->editarMesa($id, $nombre);
        if ($resultado['success']) {
            header("Location: ../../../vista/Gestion/Mesas/mesas2.php");
        } else {
            echo '<div class="alert alert-danger">' . $resultado['mensaje'] . '</div>';
        }
    } else {
        echo '<div class="alert alert-warning">Todos los campos son obligatorios</div>';
    }
} 

?>
