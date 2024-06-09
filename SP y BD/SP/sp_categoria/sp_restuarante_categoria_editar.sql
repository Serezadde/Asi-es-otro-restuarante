DELIMITER //

CREATE PROCEDURE sp_restaurante_categoria_editar(
    IN categoria_id INT,
    IN nuevo_nombre VARCHAR(255)
)
BEGIN
    UPDATE categoria SET nombre = nuevo_nombre WHERE id = categoria_id;
END //

DELIMITER ;
