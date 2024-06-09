DELIMITER $$

CREATE PROCEDURE sp_restaurante_mesas_disponibles()
BEGIN
    SELECT id, nombre
    FROM mesa
    WHERE id NOT IN (SELECT id_mesa FROM pedido WHERE en_curso = 'true');
END$$

DELIMITER ;