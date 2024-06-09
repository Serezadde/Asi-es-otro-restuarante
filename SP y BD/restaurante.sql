-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-04-2024 a las 10:56:17
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `restaurante`
--
CREATE DATABASE restaurante;
USE restaurante;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--
DROP TABLE IF EXISTS `categoria`;

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `nombre`) VALUES
(3, 'Batidos'),
(4, 'Bocadillos'),
(2, 'Cervezas'),
(5, 'Combinados'),
(8, 'Hamburguesas'),
(7, 'Menús'),
(1, 'Refrescos'),
(6, 'Sandwiches2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comanda`
--

CREATE TABLE `comanda` (
  `id` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `comanda`
--

INSERT INTO `comanda` (`id`, `id_pedido`) VALUES
(9, 5), -- Comanda del Pedido 1
(10, 6), -- Comanda del Pedido 2
(11, 7); -- Comanda del Pedido 3

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comanda_producto`
--

CREATE TABLE `comanda_producto` (
  `id_comanda` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `comanda_producto`
--

INSERT INTO `comanda_producto` (`id_comanda`, `id_producto`, `cantidad`) VALUES
(9, 1, 2),  -- CocaCola
(9, 2, 1),  -- CocaCola Zero
(9, 4, 1),  -- Fanta Limon
(10, 13, 1), -- Bocata Jamon Serrano
(10, 14, 1), -- Bocata Lomo
(10, 16, 1), -- Bocata Tortilla
(11, 5, 1),  -- Red Bull
(11, 8, 1),  -- Mahou Sin
(11, 9, 1);  -- Mahou Negra

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesa`
--

CREATE TABLE `mesa` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mesa`
--

INSERT INTO `mesa` (`id`, `nombre`) VALUES
(1, 'mesa 1'),
(2, 'mesa 2');


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `id` int(11) NOT NULL,
  `precio` float NOT NULL,
  `en_curso` varchar(5) NOT NULL,
  `fecha` date NOT NULL,
  `id_mesa` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`id`, `precio`, `en_curso`, `fecha`, `id_mesa`) VALUES
(5, 8, 'false', '2024-05-01', 1), 
(6, 13, 'true', '2024-05-02', 2),  
(7, 8, 'true', '2024-05-03', 2); 

UPDATE `pedido` SET `id_mesa` = 1 WHERE `id` = 5;
UPDATE `pedido` SET `id_mesa` = 2 WHERE `id` IN (6, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nombre` varchar(255) NOT NULL,
  `precio` float NOT NULL,
  `id_categoria` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `nombre`, `precio`, `id_categoria`) VALUES
(1, 'CocaCola', 2, 1),
(2, 'CocaCola Zero', 2, 1),
(3, 'Fanta Naranja', 2, 1),
(4, 'Fanta Limon', 2, 1),
(5, 'Red Bull', 3, 1),
(6, 'Mahou Clásica', 1, 2),
(7, 'Mahou Cinco Estrellas', 1, 2),
(8, 'Mahou Sin', 3, 2),
(9, 'Mahou Negra', 2, 2),
(10, 'Batido Fresa', 2, 3),
(11, 'Batido Chocolate', 2, 3),
(12, 'Batido Vainilla', 2, 3),
(13, 'Bocata Jamon Serrano', 5, 4),
(14, 'Bocata Lomo', 4, 4),
(15, 'Bocata Panceta', 4, 4),
(16, 'Bocata Tortilla', 4, 4);

CREATE TABLE `pedido_historico` (
    `id` int(11) NOT NULL ,
    `pedido_id` INT NOT NULL,
    `precio` FLOAT NOT NULL,
    `en_curso` VARCHAR(5) NOT NULL,
    `fecha` DATE NOT NULL,
    `id_mesa` INT NOT NULL,
    `fecha_registro` DATETIME NOT NULL
);


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `disponible` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `usuario` (`id`, `nombre`, `password`, `disponible`) VALUES
(1, 'Pepe', 'qwer', 1),
(2, 'Serena', 'nier', 1),
(3, 'Fernando', 'mgs2', 1),
(4, 'Moises', 'zeldatp', 0);
--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--



ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `comanda`
--
ALTER TABLE `comanda`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pedido` (`id_pedido`);

--
-- Indices de la tabla `comanda_producto`
--
ALTER TABLE `comanda_producto`
  ADD PRIMARY KEY (`id_comanda`,`id_producto`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `mesa`
--

ALTER TABLE `mesa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_mesa` (`id_mesa`);

  ALTER TABLE `pedido_historico`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `categoria` MODIFY COLUMN `id` INT AUTO_INCREMENT;
ALTER TABLE `mesa` MODIFY COLUMN `id` INT AUTO_INCREMENT;
ALTER TABLE `pedido` MODIFY COLUMN `id` INT AUTO_INCREMENT;
ALTER TABLE `comanda` MODIFY COLUMN `id` INT AUTO_INCREMENT;
ALTER TABLE `usuario` MODIFY COLUMN `id` INT AUTO_INCREMENT PRIMARY KEY;






ALTER TABLE `producto`
  ADD UNIQUE KEY `nombre` (`nombre`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comanda`
--
ALTER TABLE `comanda`
  ADD CONSTRAINT `comanda_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedido` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `comanda_producto`
--
ALTER TABLE `comanda_producto`
  ADD CONSTRAINT `comanda_producto_ibfk_1` FOREIGN KEY (`id_comanda`) REFERENCES `comanda` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comanda_producto_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`id_mesa`) REFERENCES `mesa` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id`) ON DELETE CASCADE;

ALTER TABLE `pedido_historico`
ADD CONSTRAINT `fk_pedido_historico_pedido` FOREIGN KEY (`pedido_id`) REFERENCES `pedido` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `fk_pedido_historico_mesa` FOREIGN KEY (`id_mesa`) REFERENCES `mesa` (`id`) ON DELETE CASCADE;

--Usuario

--Editar

DELIMITER //

CREATE PROCEDURE sp_restaurante_usuario_editar(
    IN p_id INT,
    IN p_nombre VARCHAR(255),
    IN p_password VARCHAR(255),
    IN p_disponible TINYINT(1)
)
BEGIN
    UPDATE usuario
    SET nombre = p_nombre,
        password = p_password,
        disponible = p_disponible
    WHERE id = p_id;
END //

DELIMITER ;

--Insertar

DELIMITER //

CREATE PROCEDURE sp_restaurante_usuario_insertar(
    IN p_nombre VARCHAR(255),
    IN p_password VARCHAR(255),
    IN p_disponible TINYINT(1)
)
BEGIN
    DECLARE exit_handler BOOLEAN DEFAULT FALSE;
    DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET exit_handler = TRUE;
    
    START TRANSACTION;
    
    INSERT INTO usuario (nombre, password, disponible)
    VALUES (p_nombre, p_password, p_disponible);
    
    IF exit_handler THEN
        ROLLBACK;
    ELSE
        COMMIT;
    END IF;
END //

DELIMITER ;

--Verificar credenciales:

DELIMITER //

CREATE PROCEDURE sp_restaurante_usuario_verificar_credenciales(
    IN p_nombre VARCHAR(255),
    IN p_password VARCHAR(255)
)
BEGIN
    DECLARE v_existe INT;
    
    SELECT COUNT(*)
    INTO v_existe
    FROM usuario
    WHERE nombre = p_nombre AND password = p_password;

    IF v_existe > 0 THEN
        SELECT 'true' AS resultado;
    ELSE
        SELECT 'false' AS resultado;
    END IF;
END //

DELIMITER ;

--cambiar contra

DELIMITER //

CREATE PROCEDURE sp_restaurante_usuario_verificar_contra(IN p_contrasena VARCHAR(255))
BEGIN
    DECLARE v_valido BOOLEAN DEFAULT FALSE;

    SELECT IF(COUNT(*) > 0, TRUE, FALSE) INTO v_valido
    FROM usuario
    WHERE password = p_contrasena;

    SELECT v_valido AS valido;
END//

DELIMITER ;

--Categoria

--Insertar
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

--Seleccionar

DELIMITER $$

CREATE PROCEDURE sp_restaurante_categoria_seleccionar ()
BEGIN
    SELECT * FROM categoria;
END $$

DELIMITER ;

--Editar
DELIMITER //

CREATE PROCEDURE sp_restaurante_categoria_editar(
    IN categoria_id INT,
    IN nuevo_nombre VARCHAR(255)
)
BEGIN
    UPDATE categoria SET nombre = nuevo_nombre WHERE id = categoria_id;
END //

DELIMITER ;

--Eliminar

DELIMITER //

CREATE PROCEDURE sp_restaurante_categoria_eliminar(
    IN categoria_id INT
)
BEGIN
    DELETE FROM categoria WHERE id = categoria_id;
END //

DELIMITER ;

--Producto

--Insertar
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

--Actualizar
DELIMITER //

CREATE PROCEDURE sp_restaurante_producto_editar(
    IN producto_id INT,
    IN producto_nombre VARCHAR(255),
    IN producto_precio DECIMAL(10,2),
    IN producto_id_categoria INT
)
BEGIN
    UPDATE producto
    SET nombre = producto_nombre, precio = producto_precio, id_categoria = producto_id_categoria
    WHERE id = producto_id;
END //

DELIMITER ;
--Borrar
DELIMITER //

CREATE PROCEDURE sp_restaurante_producto_eliminar(
    IN producto_id INT
)
BEGIN
    DELETE FROM producto WHERE id = producto_id;
END //

DELIMITER ;

--Seleccionar


--Mesas

--Insertar
DELIMITER //

CREATE PROCEDURE sp_restaurante_mesa_insertar(
    IN mesa_nombre VARCHAR(255)
)
BEGIN
    INSERT INTO mesa(nombre) VALUES (mesa_nombre);
END //

DELIMITER ;

--Editar

DELIMITER //

CREATE PROCEDURE sp_restaurante_mesa_editar(
    IN mesa_id INT,
    IN mesa_nombre VARCHAR(255)
)
BEGIN
    UPDATE mesa
    SET nombre = mesa_nombre
    WHERE id = mesa_id;
END //

DELIMITER ;

--Eliminar

DELIMITER //

CREATE PROCEDURE sp_restaurante_mesa_eliminar(
    IN mesa_id INT
)
BEGIN
    DELETE FROM mesa WHERE id = mesa_id;
END //

DELIMITER ;

--Seleccionar

DELIMITER //

CREATE PROCEDURE sp_restaurante_mesa_seleccionar(
)
BEGIN
    SELECT * FROM mesa;
END //

DELIMITER ;

--Sin ordenar

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

----

DELIMITER $$

CREATE PROCEDURE sp_comanda_producto_crear(IN id_comanda INT, IN id_producto INT, IN cantidad INT)
BEGIN
    INSERT INTO comanda_producto (id_comanda, id_producto, cantidad) VALUES (id_comanda, id_producto, cantidad);
END$$

DELIMITER ;

--Historial

DELIMITER //

CREATE PROCEDURE sp_restaurante_obtener_historial_pedidos()
BEGIN
    SELECT * FROM pedido;
END //

DELIMITER ;

--Primera parte de detalles del pedido
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

    CALL sp_restaurante_producto_precio_calcularpreciofinalpedidocursor(pedido_id, total_pedido);

    SELECT v_pedido_id AS id_pedido, v_en_curso AS en_curso, v_fecha AS fecha, v_nombre_mesa AS nombre_mesa, total_pedido AS precio_total;
END //

DELIMITER ;

--segunda parte de detalles del pedido, para los productos



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


------Cursor

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

----
DELIMITER $$

CREATE PROCEDURE `sp_restaurante_comanda_crear`(IN id_pedido INT)
BEGIN
    INSERT INTO comanda (id_pedido) VALUES (id_pedido);
END$$

DELIMITER ;

-----

DELIMITER $$

CREATE PROCEDURE `sp_restaurante_pedido_crear`(IN precio FLOAT, IN en_curso VARCHAR(5), IN fecha DATE, IN id_mesa INT)
BEGIN
    INSERT INTO pedido (precio, en_curso, fecha, id_mesa) VALUES (precio, en_curso, fecha, id_mesa);
END$$

DELIMITER ;

----

DELIMITER $$

CREATE PROCEDURE `sp_restaurante_pedido_finalizar`(IN pedido_id INT)
BEGIN
    UPDATE pedido
    SET en_curso = 'false'
    WHERE id = pedido_id;
END$$

DELIMITER ;

-------

DELIMITER $$

CREATE PROCEDURE `sp_restaurante_mesas_ocupadas`()
BEGIN
    SELECT m.id, m.nombre, p.id AS id_pedido
    FROM mesa m
    INNER JOIN pedido p ON m.id = p.id_mesa
    WHERE p.en_curso = 'true';
END$$

DELIMITER ;

-------

DELIMITER $$

CREATE PROCEDURE `sp_restaurante_mesas_disponibles`()
BEGIN
    SELECT id, nombre
    FROM mesa
    WHERE id NOT IN (SELECT id_mesa FROM pedido WHERE en_curso = 'true');
END$$

DELIMITER ;

-----

DELIMITER $$

CREATE PROCEDURE `sp_restaurante_producto_porcategoria` (IN categoria_id INT)
BEGIN
    SELECT id, nombre, precio
    FROM producto
    WHERE id_categoria = categoria_id;
END$$

DELIMITER ;


----

DELIMITER $$

CREATE PROCEDURE `sp_restaurante_pedido_obtenerenCurso`()
BEGIN
    SELECT pedido.id AS id_pedido, pedido.precio, pedido.fecha, mesa.nombre AS nombre_mesa
    FROM pedido
    INNER JOIN mesa ON pedido.id_mesa = mesa.id
    WHERE pedido.en_curso = 'true';
END$$

DELIMITER ;


  
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;