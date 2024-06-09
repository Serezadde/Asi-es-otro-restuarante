<?php
class Comanda {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function obtenerComandas() {
        $query = "SELECT c.*, p.nombre AS producto_nombre, ped.nombre AS pedido_nombre 
                  FROM comanda c 
                  JOIN producto p ON c.id_producto = p.id 
                  JOIN pedido ped ON c.id_pedido = ped.id";
        $result = $this->conexion->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function obtenerComanda($id) {
        $query = "SELECT * FROM comanda WHERE id = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }



    public function actualizarComanda($id, $id_pedido, $id_producto, $unidades) {
        $query = "UPDATE comanda SET id_pedido = ?, id_producto = ?, unidades = ? WHERE id = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param('iiii', $id_pedido, $id_producto, $unidades, $id);
        return $stmt->execute();
    }

    public function eliminarComanda($id) {
        $query = "DELETE FROM comanda WHERE id = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }
    public function obtenerComandasPorPedido($id_pedido) {
        try {
            $sql = 'SELECT p.nombre, p.precio, cp.cantidad 
                    FROM comanda_producto cp
                    INNER JOIN producto p ON cp.id_producto = p.id
                    INNER JOIN comanda c ON cp.id_comanda = c.id
                    WHERE c.id_pedido = :pedido_id';
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':pedido_id', $id_pedido, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            echo "Error al obtener comandas: " . $ex->getMessage();
            return [];
        }
    }

    
    public function agregarComanda($id_pedido, $id_producto, $cantidad) {
        try {
            // Preparar la consulta para insertar la nueva comanda
            $query = "INSERT INTO comanda_producto (id_comanda, id_producto, cantidad) VALUES (?, ?, ?)";
            $stmt = $this->conexion->prepare($query);
    
            // Vincular los parámetros
            $stmt->bind_param("iii", $id_pedido, $id_producto, $cantidad);
    
            // Ejecutar la consulta
            $stmt->execute();
    
            // Verificar si la inserción fue exitosa
            if ($stmt->affected_rows > 0) {
                // La comanda se agregó correctamente
                return true;
            } else {
                // La inserción falló
                return false;
            }
        } catch (Exception $ex) {
            // Ocurrió un error durante la ejecución de la consulta
            echo "Ocurrió un error: " . $ex->getMessage();
            return false;
        }
    }

    public function obtenerProductos() {
        try {
            // Preparar la consulta SQL
            $query = "SELECT * FROM producto";
            // Ejecutar la consulta
            $stmt = $this->conexion->query($query);
            // Obtener y retornar los resultados
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            // Manejar cualquier error que ocurra durante la ejecución de la consulta
            echo "Error al obtener productos: " . $ex->getMessage();
            return [];
        }
    }


    public function obtenerUltimaComandaPorPedido($id_pedido) {
        $sql = "SELECT id FROM comanda WHERE id_pedido = ? ORDER BY id DESC LIMIT 1";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $id_pedido);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function obtenerMesasOcupadas() {
        $query = $this->conexion->prepare("CALL ObtenerMesasOcupadas()");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPedidoPorMesa($mesa_id) {
        $query = $this->conexion->prepare("SELECT * FROM pedido WHERE id_mesa = :mesa_id AND en_curso = 'true'");
        $query->bindParam(':mesa_id', $mesa_id, PDO::PARAM_INT);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function obtenerCategorias() {
        $query = $this->conexion->prepare("CALL sp_restaurante_categoria_seleccionar()");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerProductosPorCategoria($categoria_id) {
        $query = $this->conexion->prepare("CALL ObtenerProductosPorCategoria(:categoria_id)");
        $query->bindParam(':categoria_id', $categoria_id, PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    public function crearComanda($id_pedido) {
        try {
            // Preparar la llamada al procedimiento almacenado con los parámetros de entrada
            $stmt = $this->conexion->prepare("SELECT sp_restaurante_comanda_crear(:id_pedido)");
            
            // Vincular los parámetros de entrada
            $stmt->bindParam(':id_pedido', $id_pedido, PDO::PARAM_INT);
            
            // Ejecutar la consulta preparada
            $stmt->execute();
            
            // No es necesario obtener el lastInsertId() porque la función en PostgreSQL no devuelve un ID generado automáticamente.
            
            // Puedes retornar true si la operación fue exitosa
            return true;
        } catch (PDOException $e) {
            // Manejar cualquier error de la base de datos
            echo "Error al crear la comanda: " . $e->getMessage();
            return false;
        }
    }
    

    public function anadirProductoAComanda($id_comanda, $id_producto, $cantidad) {
        try {
            $stmt = $this->conexion->prepare("CALL sp_comanda_producto_crear(:id_comanda, :id_producto, :cantidad)");
            $stmt->bindParam(':id_comanda', $id_comanda, PDO::PARAM_INT);
            $stmt->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
            $stmt->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $ex) {
            echo "Error al añadir producto a comanda: " . $ex->getMessage();
        }
    }
    
    
}


?>
