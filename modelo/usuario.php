<?php

require_once "bd.php";


class Usuario
{
    private $db;
    private $id;
    private $nombre;
    private $password;
    private $disponible;
    private $nuevaContrasena;
    private $repetirContrasena;
    private $contrasenaActual;






    function __construct()
    {
        $bd = new bd();
        $this->db = $bd->conectarBD();
    }

 




    function guardar()
    {
        if ($this->id) {
            $sql = "CALL sp_restaurante_usuario_editar(?, ?, ?, ?)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(1, $this->id, PDO::PARAM_INT);
            $stmt->bindParam(2, $this->nombre, PDO::PARAM_STR);
            $stmt->bindParam(3, $this->password, PDO::PARAM_STR);
            $stmt->bindParam(4, $this->disponible, PDO::PARAM_INT);
        } else {
            $sql = "CALL sp_restaurante_usuario_insertar(?, ?, ?)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(1, $this->nombre, PDO::PARAM_STR);
            $stmt->bindParam(2, $this->password, PDO::PARAM_STR);
            $stmt->bindParam(3, $this->disponible, PDO::PARAM_INT);
        }
    
        if ($stmt->execute()) {
            return true; 
        } else {
            return false; 
        }
    }
    



    function cambiarContrasena($nuevaContrasena)
    {

        $this->password = password_hash($nuevaContrasena, PASSWORD_DEFAULT);

        return $this->guardar();
    }



    function obtenerPorId($idUsuario)
    {
  
        $sql = "SELECT * FROM usuario WHERE id=?";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(1, $idUsuario, PDO::PARAM_INT);

 
        $stmt->execute();

        $stmt->bindColumn('id', $idUsuario);
        $stmt->bindColumn('nombre', $nombre);
        $stmt->bindColumn('password', $password);
        $stmt->bindColumn('disponible', $disponible);

        $resultados = array();
        while ($stmt->fetch(PDO::FETCH_BOUND)) {
       
            $usuario = new Usuario();
            $usuario->setId($idUsuario);
            $usuario->setNombre($nombre);
            $usuario->setPassword($password);
            $usuario->setDisponible($disponible);

        
            $resultados[] = $usuario;
        }

    
        return $resultados;
    }



    // Función para verificar las credenciales del usuario
    function verificarCredenciales()
    {
        try {
            // Preparar la llamada a la función almacenada
            $sql = "SELECT sp_restaurante_usuario_verificar_credenciales(:nombre, :password) AS resultado";
            $stmt = $this->db->prepare($sql);
            
            // Vincular parámetros
            $stmt->bindParam(":nombre", $this->nombre, PDO::PARAM_STR);
            $stmt->bindParam(":password", $this->password, PDO::PARAM_STR);
            
            // Ejecutar la consulta
            $stmt->execute();
            
            // Obtener el resultado
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // Verificar si el resultado es 'true'
            if ($result && $result['resultado'] == true) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $ex) {

            echo "Ocurrió un error: " . $ex->getMessage();
            return false;
        }
    }
    









    function obtenerUsuarios()
    {
        try {
            $querySelect = "SELECT * FROM usuario WHERE id = :idusuario";

            $instanciaDB = $this->db->prepare($querySelect);
            $instanciaDB->bindParam(":idusuario", $this->id);
            $instanciaDB->execute();

            // Verificar si se encontraron resultados
            $usuario = $instanciaDB->fetch(PDO::FETCH_OBJ);
            if ($usuario) {
                return $usuario;
            } else {
                echo "No se encontró ningún usuario con el ID especificado.";
                return null;
            }
        } catch (PDOException $ex) {
            echo "Ocurrió un error: " . $ex->getMessage();
            return null;
        }
    }

    function actualizarUsuarios($contrasenaActual, $nuevaContrasena, $repetirContrasena)
{
    try {
        // Llamar a la función almacenada para verificar la contraseña actual
        $queryVerify = "SELECT sp_restaurante_usuario_verificar_contra(:contrasenaActual) AS valido";
        $instanciaDB = $this->db->prepare($queryVerify);
        $instanciaDB->bindParam(":contrasenaActual", $contrasenaActual);
        $instanciaDB->execute();

        // Obtener el resultado de la función almacenada
        $contrasenaValida = $instanciaDB->fetchColumn();

        if (!$contrasenaValida) {
            return "La contraseña actual no es válida";
        }

        // Verificar si las contraseñas nueva y repetida coinciden
        if ($nuevaContrasena !== $repetirContrasena) {
            return "Las contraseñas nueva y repetida no coinciden";
        }

        // Actualizar la contraseña en la base de datos
        $queryUpdate = "UPDATE usuario SET password = :password WHERE password = :contrasenaActual";
        $instanciaDB = $this->db->prepare($queryUpdate);
        $instanciaDB->bindParam(":password", $nuevaContrasena);
        $instanciaDB->bindParam(":contrasenaActual", $contrasenaActual);
        $instanciaDB->execute();

        if ($instanciaDB->rowCount() > 0) {
            return '<div class="alert alert-success">Contraseña actualizada correctamente</div>';
        } else {
            return '<div class="alert alert-warning">La contraseña actual no coincide con la registrada en la base de datos</div>';
        }
    } catch (Exception $ex) {
        // Manejar errores aquí
        return '<div class="alert alert-warning">Ocurrió un error al actualizar la contraseña</div>';
    }
}



    
    











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

    public function getPassword()
    {
        return $this->password;
    }
    public function setPassword($password): self
    {
        $this->password = $password;
        return $this;
    }

    public function getDisponible()
    {
        return $this->disponible;
    }
    public function setDisponible($disponible): self
    {
        $this->disponible = $disponible;
        return $this;
    }
}
