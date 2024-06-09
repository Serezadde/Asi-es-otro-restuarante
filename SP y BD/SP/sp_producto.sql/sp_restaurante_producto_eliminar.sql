DELIMITER //

CREATE PROCEDURE sp_restaurante_producto_eliminar(
    IN producto_id INT
)
BEGIN
    DELETE FROM producto WHERE id = producto_id;
END //

DELIMITER ;
