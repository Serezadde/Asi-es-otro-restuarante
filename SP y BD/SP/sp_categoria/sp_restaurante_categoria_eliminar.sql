DELIMITER //

CREATE PROCEDURE sp_restaurante_categoria_eliminar(
    IN categoria_id INT
)
BEGIN
    DELETE FROM categoria WHERE id = categoria_id;
END //

DELIMITER ;