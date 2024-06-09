<?php

require_once "bd.php";
class Mesas {
    private $bd;
    private $id;
    private $nombre;

    public function __construct($bd) {
        $this->bd = $bd;
    }

    public function insertarMesa($nombre) {
        try {
            $queryInsertar = "SELECT sp_restaurante_mesa_insertar(:nombre)";
            $instanciaDB = $this->bd->prepare($queryInsertar);
    
            if ($instanciaDB === false) {
                throw new Exception("Falló la preparación: " . $this->bd->errorInfo()[2]);
            }
            $instanciaDB->bindParam(':nombre', $nombre, PDO::PARAM_STR);

            if ($instanciaDB->execute()) {
                $nuevo_id_query = $this->bd->query("SELECT currval(pg_get_serial_sequence('mesa','id'))");
                $nuevo_id = $nuevo_id_query->fetchColumn();
    
                return array('success' => true, 'mensaje' => 'Mesa creada correctamente, ID: ' . $nuevo_id);
            } else {
                throw new Exception("Falló la ejecución: " . $instanciaDB->errorInfo()[2]);
            }
        } catch (Exception $ex) {
            return array('success' => false, 'mensaje' => 'Error al registrar: ' . $ex->getMessage());
        }
    }
    

    public function editarMesa($id, $nombre) {
        try {

            $queryEditar = "SELECT sp_restaurante_mesa_editar(:id, :nombre)";
            $instanciaDB = $this->bd->prepare($queryEditar);
    
            if ($instanciaDB === false) {
                throw new Exception("Falló la preparación: " . $this->bd->errorInfo()[2]);
            }

            $instanciaDB->bindParam(':id', $id, PDO::PARAM_INT);
            $instanciaDB->bindParam(':nombre', $nombre, PDO::PARAM_STR);

            if ($instanciaDB->execute()) {
                return array('success' => true, 'mensaje' => 'Mesa editada correctamente');
            } else {
                throw new Exception("Falló la ejecución: " . $instanciaDB->errorInfo()[2]);
            }
        } catch (Exception $ex) {
            return array('success' => false, 'mensaje' => 'Error al editar: ' . $ex->getMessage());
        }
    }
    

    public function eliminarMesa($id) {
        try {
            $queryEliminar = "SELECT sp_restaurante_mesa_eliminar(:mesa_id)";
            $instanciaDB = $this->bd->prepare($queryEliminar);
    
            if ($instanciaDB === false) {
                throw new Exception("Falló la preparación: " . $this->bd->errorInfo()[2]);
            }

            $instanciaDB->bindParam(':mesa_id', $id, PDO::PARAM_INT);

            if ($instanciaDB->execute()) {
                return array('success' => true, 'mensaje' => 'Mesa eliminada correctamente');
            } else {
                throw new Exception("Falló la ejecución: " . $instanciaDB->errorInfo()[2]);
            }
        } catch (Exception $ex) {
            return array('success' => false, 'mensaje' => 'Error al eliminar la mesa: ' . $ex->getMessage());
        }
    }
    

    /*
    public function obtenerMesasOcupadas() {
        try {
            $query = "SELECT * FROM mesa WHERE id IN (SELECT DISTINCT id_mesa FROM pedido WHERE en_curso = 'true')";
            $result = $this->bd->query($query);
            $mesas = [];
            while ($row = $result->fetch_assoc()) {
                $mesas[] = $row;
            }
            return $mesas;
        } catch (Exception $ex) {
            echo "Ocurrió un error: " . $ex->getMessage();
            return [];
        }
    }
    */





    public function getId()
    {
        return $this->id;
    }
    public function setId($id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getNombre()
    {
        return $this->nombre;
    }
    public function setNombre($nombre): self
    {
        $this->nombre = $nombre;
        return $this;
    }



}


?>