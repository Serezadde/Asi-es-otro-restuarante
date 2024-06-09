DELIMITER $$

CREATE PROCEDURE sp_restaurante_categoria_seleccionar ()
BEGIN
    SELECT * FROM categoria;
END $$

DELIMITER ;
