DELIMITER $$

CREATE PROCEDURE sp_comanda_producto_crear(IN id_comanda INT, IN id_producto INT, IN cantidad INT)
BEGIN
    INSERT INTO comanda_producto (id_comanda, id_producto, cantidad) VALUES (id_comanda, id_producto, cantidad);
END$$

DELIMITER ;