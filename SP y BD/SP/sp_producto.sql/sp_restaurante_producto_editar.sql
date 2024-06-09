DELIMITER //

CREATE PROCEDURE sp_restaurante_producto_editar(
    IN producto_id INT,
    IN producto_nombre VARCHAR(255),
    IN producto_precio DECIMAL(10,2),
    IN producto_id_categoria INT
)
BEGIN
    UPDATE producto
    SET nombre = producto_nombre, precio = producto_precio, id_categoria = producto_id_categoria
    WHERE id = producto_id;
END //

DELIMITER ;
