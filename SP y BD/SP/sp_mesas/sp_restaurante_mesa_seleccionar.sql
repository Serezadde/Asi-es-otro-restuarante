DELIMITER //

CREATE PROCEDURE sp_restaurante_mesa_seleccionar(
)
BEGIN
    SELECT * FROM mesa;
END //

DELIMITER ;