<?php
require "../../../modelo/conexion.php";
require "../../../modelo/categoria.php";

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $categoria = new Categoria($conexion);

    $resultado = $categoria->eliminarCategoria($id);
    
    if ($resultado === true) {
        header("Location: ../../../vista/Gestion/Categoria/categoria2.php");
        exit();
    } else {
        echo $resultado; 
    }
}
?>


