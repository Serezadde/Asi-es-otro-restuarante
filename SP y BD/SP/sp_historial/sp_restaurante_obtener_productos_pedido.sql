DELIMITER $$

CREATE PROCEDURE `sp_restaurante_obtener_productos_pedido` (IN pedido_id INT)
BEGIN
    SELECT 
        producto.nombre AS Producto, 
        producto.precio AS Precio, 
        comanda_producto.cantidad AS Unidades, 
        (producto.precio * comanda_producto.cantidad) AS Subtotal
    FROM 
        producto
    INNER JOIN 
        comanda_producto ON producto.id = comanda_producto.id_producto
    INNER JOIN 
        comanda ON comanda.id = comanda_producto.id_comanda
    INNER JOIN 
        pedido ON pedido.id = comanda.id_pedido
    WHERE 
        pedido.id = pedido_id;
END$$

DELIMITER ;