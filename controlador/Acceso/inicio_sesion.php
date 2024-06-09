<?php
require_once "../../modelo/usuario.php";

if (isset($_POST['usuario']) && isset($_POST['password'])) {
    $nombre = $_POST['usuario'];
    $password = $_POST['password'];

    $usuario = new Usuario();
    $usuario->setNombre($nombre);
    $usuario->setPassword($password);

    // Verificar credenciales
    $credenciales_validas = $usuario->verificarCredenciales();

    if ($credenciales_validas) {
        // Credenciales válidas, lleva a la página de administración
        header("Location: ../Administracion/administración_menu.php");
        exit();
    } else {
        // mostrar un mensaje de error
        echo '<div class="alert alert-warning">Credenciales inválidas. Por favor, inténtelo de nuevo</div>';
    
    }
}

