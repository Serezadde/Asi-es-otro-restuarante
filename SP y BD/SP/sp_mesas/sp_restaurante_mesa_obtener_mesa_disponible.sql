DELIMITER $$

CREATE PROCEDURE sp_restaurante_mesa_obtener_mesa_disponible()
BEGIN
    SELECT id, nombre
    FROM mesa
    WHERE id NOT IN (SELECT id_mesa FROM pedido WHERE en_curso = 'true');
END$$

DELIMITER ;