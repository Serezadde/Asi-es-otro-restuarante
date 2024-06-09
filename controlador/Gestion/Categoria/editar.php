<?php
require "../../../modelo/conexion.php";
require "../../../modelo/categoria.php";

$categoria = new Categoria($conexion); 
if (!empty($_POST["btneditar"])) {
    if (!empty($_POST["nombre"])) {
        $id = $_POST["id"];
        $nombre = $_POST["nombre"];

        if ($categoria->editarCategoria($id, $nombre)) {
            header("Location: ../../../vista/Gestion/Categoria/categoria2.php");
        } else {
            echo '<div class="alert alert-danger">Ocurrió un error</div>';
        }
    } else {
        echo '<div class="alert alert-warning">Campo vacío</div>';
    }
}
?>
