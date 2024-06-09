DELIMITER //

CREATE PROCEDURE sp_restaurante_producto_insertar(
    IN nombre_producto VARCHAR(255),
    IN precio_producto DECIMAL(10, 2),
    IN id_categoria_producto INT
)
BEGIN
    DECLARE exit_handler BOOLEAN DEFAULT FALSE;
    DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET exit_handler = TRUE;

    START TRANSACTION;
    
    INSERT INTO producto(nombre, precio, id_categoria)
    VALUES (nombre_producto, precio_producto, id_categoria_producto);
    
    IF exit_handler THEN
        ROLLBACK;
    ELSE
        COMMIT;
    END IF;
END //

DELIMITER ;