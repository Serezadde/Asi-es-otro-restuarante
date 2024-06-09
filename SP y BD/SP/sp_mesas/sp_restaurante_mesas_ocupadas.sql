DELIMITER $$

CREATE PROCEDURE `sp_restaurante_mesas_ocupadas`()
BEGIN
    SELECT m.id, m.nombre, p.id AS id_pedido
    FROM mesa m
    INNER JOIN pedido p ON m.id = p.id_mesa
    WHERE p.en_curso = 'true';
END$$

DELIMITER ;
