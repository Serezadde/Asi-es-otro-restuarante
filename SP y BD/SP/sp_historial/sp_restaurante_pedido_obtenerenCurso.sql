DELIMITER $$

CREATE PROCEDURE sp_restaurante_pedido_obtenerenCurso()
BEGIN
    SELECT pedido.id AS id_pedido, pedido.precio, pedido.fecha, mesa.nombre AS nombre_mesa
    FROM pedido
    INNER JOIN mesa ON pedido.id_mesa = mesa.id
    WHERE pedido.en_curso = 'true';
END$$

DELIMITER ;
