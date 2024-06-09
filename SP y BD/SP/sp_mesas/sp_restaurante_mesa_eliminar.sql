DELIMITER //

CREATE PROCEDURE sp_restaurante_mesa_eliminar(
    IN mesa_id INT
)
BEGIN
    DELETE FROM mesa WHERE id = mesa_id;
END //

DELIMITER ;
