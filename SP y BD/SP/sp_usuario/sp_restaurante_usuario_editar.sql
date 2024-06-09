DELIMITER //

CREATE PROCEDURE sp_restaurante_usuario_editar(
    IN p_id INT,
    IN p_nombre VARCHAR(255),
    IN p_password VARCHAR(255),
    IN p_disponible TINYINT(1)
)
BEGIN
    UPDATE usuario
    SET nombre = p_nombre,
        password = p_password,
        disponible = p_disponible
    WHERE id = p_id;
END //

DELIMITER ;
