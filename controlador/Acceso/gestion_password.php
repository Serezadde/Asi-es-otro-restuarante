<?php
include "../../modelo/usuario.php";

// Verificar si se enviaron los datos del formulario por POST
if (
    isset($_POST['contrasenaActual'])
    && isset($_POST['nuevaContrasena'])
    && isset($_POST['repetirContrasena'])
) {
    $contrasenaActual = $_POST['contrasenaActual'];
    $nuevaContrasena = $_POST['nuevaContrasena'];
    $repetirContrasena = $_POST['repetirContrasena'];

    $usuario = new Usuario();
    $mensaje = $usuario->actualizarUsuarios($contrasenaActual, $nuevaContrasena, $repetirContrasena);

    echo $mensaje;
}

