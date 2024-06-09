DELIMITER //

CREATE PROCEDURE sp_restaurante_obtener_historial_pedidos()
BEGIN
    SELECT * FROM pedido;
END //

DELIMITER ;