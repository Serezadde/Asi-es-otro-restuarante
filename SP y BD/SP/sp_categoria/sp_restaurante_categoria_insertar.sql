DELIMITER $$

CREATE PROCEDURE sp_restaurante_categoria_insertar(
    IN nombre VARCHAR(255),
    OUT id INT
)
BEGIN
    DECLARE exit_handler BOOLEAN DEFAULT FALSE;
    DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET exit_handler = TRUE;

    START TRANSACTION;
    
    INSERT INTO categoria (nombre) 
    VALUES (nombre);
    
    SET id = LAST_INSERT_ID();
    
    IF exit_handler THEN
        ROLLBACK;
    ELSE
        COMMIT;
    END IF;
END $$

DELIMITER ;
