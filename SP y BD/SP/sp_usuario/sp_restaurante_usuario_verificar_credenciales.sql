DELIMITER //

CREATE PROCEDURE sp_restaurante_usuario_verificar_credenciales(
    IN p_nombre VARCHAR(255),
    IN p_password VARCHAR(255)
)
BEGIN
    DECLARE v_existe INT;
    
    SELECT COUNT(*)
    INTO v_existe
    FROM usuario
    WHERE nombre = p_nombre AND password = p_password;

    IF v_existe > 0 THEN
        SELECT 'true' AS resultado;
    ELSE
        SELECT 'false' AS resultado;
    END IF;
END //

DELIMITER ;