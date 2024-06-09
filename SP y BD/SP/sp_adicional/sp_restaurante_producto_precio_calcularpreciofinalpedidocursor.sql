/*DELIMITER $$

CREATE PROCEDURE `CalcularPrecioFinalPedido`(IN pedido_id INT, OUT precio_final FLOAT)
BEGIN
    DECLARE total FLOAT;
    SELECT SUM(producto.precio * comanda_producto.cantidad) INTO total
    FROM comanda
    INNER JOIN comanda_producto ON comanda.id = comanda_producto.id_comanda
    INNER JOIN producto ON comanda_producto.id_producto = producto.id
    WHERE comanda.id_pedido = pedido_id;
    SET precio_final = total;
END$$

DELIMITER ;

*/

DELIMITER $$

CREATE PROCEDURE `sp_restaurante_producto_precio_calcularpreciofinalpedidocursor`(IN pedido_id INT, OUT precio_final FLOAT)
BEGIN
    DECLARE done INT DEFAULT FALSE;
    DECLARE comanda_id INT;
    DECLARE producto_precio FLOAT;
    DECLARE cantidad INT;
    DECLARE total FLOAT DEFAULT 0;

    DECLARE cur CURSOR FOR
        SELECT c.id, p.precio, cp.cantidad
        FROM comanda c
        INNER JOIN comanda_producto cp ON c.id = cp.id_comanda
        INNER JOIN producto p ON cp.id_producto = p.id
        WHERE c.id_pedido = pedido_id;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

    SET total = 0;
    
    START TRANSACTION;

    OPEN cur;

    read_loop: LOOP
        FETCH cur INTO comanda_id, producto_precio, cantidad;
        IF done THEN
            LEAVE read_loop;
        END IF;
        SET total = total + (producto_precio * cantidad);
    END LOOP;

    CLOSE cur;

    SET precio_final = total;
    
    COMMIT;
END$$

DELIMITER ;
