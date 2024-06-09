DELIMITER $$

CREATE PROCEDURE sp_restaurante_producto_porcategoria(IN categoria_id INT)
BEGIN
    SELECT id, nombre, precio
    FROM producto
    WHERE id_categoria = categoria_id;
END$$

DELIMITER ;
