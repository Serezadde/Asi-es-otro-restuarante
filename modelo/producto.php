<?php

require_once "conexion.php";
require_once "categoria.php";


class Producto
{

    private $conexion;



    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function eliminarProducto($id) {
        try {
            $queryEliminar = "SELECT sp_restaurante_producto_eliminar(:producto_id)";
            $instanciaDB = $this->conexion->prepare($queryEliminar);
    
            if ($instanciaDB === false) {
                throw new Exception("Falló la preparación: " . $this->conexion->errorInfo()[2]);
            }
            $instanciaDB->bindParam(':producto_id', $id, PDO::PARAM_INT);
            if ($instanciaDB->execute()) {
                return true;
            } else {
                throw new Exception("Falló la ejecución: " . $instanciaDB->errorInfo()[2]);
            }
        } catch (Exception $ex) {
            return "Ocurrió un error: " . $ex->getMessage();
        }
    }
    



    public function editarProducto($id, $nombre, $precio, $id_categoria) {
        try {
            $queryEditar = "SELECT sp_restaurante_producto_editar(:id, :nombre, :precio, :id_categoria)";
            $instanciaDB = $this->conexion->prepare($queryEditar);
    
            if ($instanciaDB === false) {
                throw new Exception("Falló la preparación: " . $this->conexion->errorInfo()[2]);
            }

            $instanciaDB->bindParam(':id', $id, PDO::PARAM_INT);
            $instanciaDB->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $instanciaDB->bindParam(':precio', $precio, PDO::PARAM_STR); 
            $instanciaDB->bindParam(':id_categoria', $id_categoria, PDO::PARAM_INT);

            if ($instanciaDB->execute()) {
                return true;
            } else {
                throw new Exception("Falló la ejecución: " . $instanciaDB->errorInfo()[2]);
            }
        } catch (Exception $ex) {
            return "Ocurrió un error: " . $ex->getMessage();
        }
    }
    

    public function insertarProducto($nombre, $precio, $id_categoria) {
        try {
            $queryInsertar = "SELECT sp_restaurante_producto_insertar(:nombre, :precio, :id_categoria)";
            $instanciaDB = $this->conexion->prepare($queryInsertar);
    
            if ($instanciaDB === false) {
                throw new Exception("Falló la preparación: " . $this->conexion->errorInfo()[2]);
            }

            $instanciaDB->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            //Esto da decimales
            $instanciaDB->bindParam(':precio', $precio, PDO::PARAM_STR); 
            $instanciaDB->bindParam(':id_categoria', $id_categoria, PDO::PARAM_INT);

            if ($instanciaDB->execute()) {
                return true;
            } else {
                throw new Exception("Falló la ejecución: " . $instanciaDB->errorInfo()[2]);
            }
        } catch (Exception $ex) {
            return "Ocurrió un error: " . $ex->getMessage();
        }
    }
    

}

