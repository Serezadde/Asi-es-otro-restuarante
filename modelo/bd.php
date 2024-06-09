<?php
class bd
{
    private $cadenaConexion = "pgsql:dbname=Restaurante;host=localhost;port=5432";
    private $usuario = "postgres";
    private $clave = "1234";

    function conectarBD()
    {
        try {
            return new PDO($this->cadenaConexion, $this->usuario, $this->clave);
        } catch (PDOException $e) {
            echo "Error ocurrio un problema en Base de datos: " . $e->getMessage();
            return null;
        }
    }
}