DELIMITER //

CREATE PROCEDURE sp_restaurante_mesa_insertar(
    IN mesa_nombre VARCHAR(255)
)
BEGIN
    INSERT INTO mesa(nombre) VALUES (mesa_nombre);
END //

DELIMITER ;
