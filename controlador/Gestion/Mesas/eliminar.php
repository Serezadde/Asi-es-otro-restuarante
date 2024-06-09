<?php 
require_once "../../../modelo/conexion.php";
require_once "../../../modelo/mesas.php";

$mesas = new Mesas($conexion); 

if (!empty($_GET["id"])) {
    $id = $_GET["id"];

    if ($mesas->eliminarMesa($id)) {
        echo '<div class="alert alert-success">Mesa eliminada</div>';
    } else {
        echo '<div class="alert alert-danger">Ocurrió un error</div>';
    }
}

