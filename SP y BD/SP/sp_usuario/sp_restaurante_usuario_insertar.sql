DELIMITER //

CREATE PROCEDURE sp_restaurante_usuario_insertar(
    IN p_nombre VARCHAR(255),
    IN p_password VARCHAR(255),
    IN p_disponible TINYINT(1)
)
BEGIN
    DECLARE exit_handler BOOLEAN DEFAULT FALSE;
    DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET exit_handler = TRUE;
    
    START TRANSACTION;
    
    INSERT INTO usuario (nombre, password, disponible)
    VALUES (p_nombre, p_password, p_disponible);
    
    IF exit_handler THEN
        ROLLBACK;
    ELSE
        COMMIT;
    END IF;
END //

DELIMITER ;