<?php
require "../../../modelo/conexion.php";
require "../../../modelo/categoria.php";

if (isset($_POST['nombre'])) {
    $categoria = new Categoria($conexion);
    $resultado = $categoria->insertarCategoria($_POST['nombre']);
    
    if ($resultado === true) {
        header("Location: ../../../vista/Gestion/Categoria/categoria2.php");
        exit();
    } else {
        echo $resultado; 
    }
}
?>