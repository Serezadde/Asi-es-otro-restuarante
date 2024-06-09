DELIMITER //

CREATE PROCEDURE sp_restaurante_mesa_editar(
    IN mesa_id INT,
    IN mesa_nombre VARCHAR(255)
)
BEGIN
    UPDATE mesa
    SET nombre = mesa_nombre
    WHERE id = mesa_id;
END //

DELIMITER ;
