/*
DELIMITER //

CREATE PROCEDURE sp_restaurante_pedido_detalle(IN pedido_id INT)
BEGIN
    SELECT p.*, m.nombre AS nombre_mesa, SUM(pr.precio * cp.cantidad) AS precio_total
    FROM pedido p
    LEFT JOIN mesa m ON p.id_mesa = m.id
    LEFT JOIN comanda c ON p.id = c.id_pedido
    LEFT JOIN comanda_producto cp ON c.id = cp.id_comanda
    LEFT JOIN producto pr ON cp.id_producto = pr.id
    WHERE p.id = pedido_id
    GROUP BY p.id;
END //

DELIMITER ;
*/

DELIMITER //

CREATE PROCEDURE sp_restaurante_pedido_detalle(IN pedido_id INT)
BEGIN
    DECLARE total_pedido DECIMAL(10,2);
    DECLARE v_pedido_id INT;
    DECLARE v_en_curso VARCHAR(5);
    DECLARE v_fecha DATE;
    DECLARE v_nombre_mesa VARCHAR(255);

    SELECT p.id, p.en_curso, p.fecha, m.nombre
    INTO v_pedido_id, v_en_curso, v_fecha, v_nombre_mesa
    FROM pedido p
    LEFT JOIN mesa m ON p.id_mesa = m.id
    WHERE p.id = pedido_id;

    CALL CalcularPrecioFinalPedidoConCursor(pedido_id, total_pedido);

    SELECT v_pedido_id AS id_pedido, v_en_curso AS en_curso, v_fecha AS fecha, v_nombre_mesa AS nombre_mesa, total_pedido AS precio_total;
END //

DELIMITER ;


