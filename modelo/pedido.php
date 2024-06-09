<?php
class Pedido {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function obtenerPedido($id_pedido) {
        $query = "SELECT * FROM pedido WHERE id = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param('i', $id_pedido);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
    public function finalizarPedido($id_pedido) {
        try {
            $sql = 'CALL sp_restaurante_pedido_finalizar(:pedido_id)';
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':pedido_id', $id_pedido, PDO::PARAM_INT);
    
            $stmt->execute();
    
            return true;
        } catch (PDOException $ex) {
            echo "Error al finalizar el pedido: " . $ex->getMessage();
            return false; 
        }
    }
    
    
    
    
    public function obtenerPedidoPorId($id_pedido) {
        try {
            // Preparar la consulta
            $sql = "SELECT p.*, m.nombre as nombre_mesa 
                    FROM pedido p
                    JOIN mesa m ON p.id_mesa = m.id
                    WHERE p.id = :id_pedido";
            $stmt = $this->conexion->prepare($sql);
            
           
            $stmt->bindParam(":id_pedido", $id_pedido, PDO::PARAM_INT);
            

            $stmt->execute();
            
        
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            
            return $resultado;
        } catch (PDOException $ex) {
            
            echo "Error al ejecutar la consulta: " . $ex->getMessage();
            return false; 
        }
    }
    

    function obtenerPedidoPorMesa($id_mesa) {
        global $pdo; 
    
        try {
            // llama función almacenada
            $stmt = $pdo->prepare("sp_restaurante_pedido_pedido_por_mesa(:id_mesa)");
    
            // Vincular el parámetro de entrada
            $stmt->bindParam(':id_mesa', $id_mesa, PDO::PARAM_INT);
    

            $stmt->execute();
            
            // Obtener el resultado
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $pedido_id = $result['sp_restaurante_pedido_por_mesa_obtener'];
    
            // Verificar si se encontró un pedido
            if ($pedido_id !== null) {
                return $pedido_id;
            } else {
                return false; 
            }
        } catch (PDOException $e) {
            // error de la base de datos
            echo "Ocurrió un error: " . $e->getMessage();
            return false;
        }
    }
    

    function insertarPedido($precio, $en_curso, $fecha, $id_mesa) {
        global $pdo; 
    
        try {
           
            $stmt = $pdo->prepare("SELECT sp_restaurante_pedido_insertar(:precio, :en_curso, :fecha, :id_mesa)");
    
        
            $stmt->bindParam(':precio', $precio, PDO::PARAM_STR);
            $stmt->bindParam(':en_curso', $en_curso, PDO::PARAM_BOOL);
            $stmt->bindParam(':fecha', $fecha, PDO::PARAM_STR);
            $stmt->bindParam(':id_mesa', $id_mesa, PDO::PARAM_INT);
    

            $stmt->execute();
            
            // Obtener el resultado
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $id_pedido = $result['sp_restaurante_pedido_insertar'];
    
            return $id_pedido; 
        } catch (PDOException $e) {
            // error de la base de datos
            echo "Error al insertar el pedido: " . $e->getMessage();
            return false;
        }
    }
    
public function obtenerProductosPorPedido($id_pedido) {
    $productos = array();

    try {

        $sql = "SELECT * FROM sp_restaurante_obtener_productos_xpedido(?)";
        
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $id_pedido);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $productos[] = $row;
        }
    } catch (Exception $ex) {
        echo "Ocurrió un error: " . $ex->getMessage();
    }

    return $productos;
}



}



?>
