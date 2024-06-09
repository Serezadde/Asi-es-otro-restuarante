DELIMITER $$

CREATE PROCEDURE sp_restaurante_comanda_crear(IN id_pedido INT,
OUT id INT)
BEGIN
    INSERT INTO comanda (id_pedido) VALUES (id_pedido);
    SET id = LAST_INSERT_ID();
END$$

DELIMITER ;