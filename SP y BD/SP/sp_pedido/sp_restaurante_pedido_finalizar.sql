DELIMITER $$

CREATE PROCEDURE `sp_restaurante_pedido_finalizar`(IN pedido_id INT)
BEGIN
    UPDATE pedido
    SET en_curso = 'false'
    WHERE id = pedido_id;
END$$

DELIMITER ;