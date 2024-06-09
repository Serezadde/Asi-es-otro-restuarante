DELIMITER $$

CREATE TRIGGER `AfterPedidoFinalizadoInsertHistorico`
AFTER UPDATE ON `pedido`
FOR EACH ROW
BEGIN
    IF OLD.en_curso = 'true' AND NEW.en_curso = 'false' THEN
        INSERT INTO `pedido_historico` (`pedido_id`, `precio`, `en_curso`, `fecha`, `id_mesa`, `fecha_registro`)
        VALUES (NEW.id, NEW.precio, NEW.en_curso, NEW.fecha, NEW.id_mesa, NOW());
    END IF;
END$$

DELIMITER ;
