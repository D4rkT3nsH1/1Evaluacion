-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 20-12-2021 a las 13:21:30
-- Versión del servidor: 5.7.31
-- Versión de PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `guredendak`
--

DELIMITER $$
--
-- Procedimientos
--
DROP PROCEDURE IF EXISTS ` spInsertIkaslea`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE ` spInsertIkaslea` (IN `pNombre` VARCHAR(100), IN `pApellido1` VARCHAR(100), IN `pApellido2` VARCHAR(100), IN `pidCiclo` INT(100), IN `pCurso` VARCHAR(100))  NO SQL
begin	
          
 INSERT INTO ikasleak (nombre,apellido1,apellido2,idciclo,curso) 
 VALUES (pNombre,pApellido1,pApellido2,pidCiclo,pCurso);
end$$

DROP PROCEDURE IF EXISTS `spAllIkasleak`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spAllIkasleak` ()  NO SQL
SELECT * FROM ikasleak$$

DROP PROCEDURE IF EXISTS `spAllZikloak`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spAllZikloak` ()  NO SQL
SELECT * from ciclos$$

DROP PROCEDURE IF EXISTS `spCicloIkaslea`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spCicloIkaslea` (IN `pId` INT(100))  NO SQL
BEGIN
SELECT ciclos.*  FROM ciclos WHERE ciclos.id=pId;
END$$

DROP PROCEDURE IF EXISTS `sp_borrar_produktua`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_borrar_produktua` (IN `p_id_produktua` INT)  NO SQL
DELETE FROM produltuak where produltuak.id_produktuak= p_id_produktua$$

DROP PROCEDURE IF EXISTS `sp_insertar_produktuak`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_insertar_produktuak` (IN `p_nombre` VARCHAR(30), IN `p_tipo` VARCHAR(30), IN `p_precio` INT, IN `p_cantidad` INT, IN `p_foto` VARCHAR(50))  NO SQL
INSERT INTO produltuak(nombre,tipo,precio,cantidad,foto)                 SELECT p_nombre,p_tipo,p_precio,p_cantidad,p_foto
WHERE NOT EXISTS (SELECT nombre FROM produltuak WHERE nombre = p_nombre)$$

DROP PROCEDURE IF EXISTS `sp_modificar_CantidadProd`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_modificar_CantidadProd` (IN `p_id_produktuak` INT, IN `p_cantidad` INT)  NO SQL
BEGIN
UPDATE produltuak SET cantidad = p_cantidad  

where id_produktuak = p_id_produktuak;

END$$

DROP PROCEDURE IF EXISTS `sp_modificar_produktuak`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_modificar_produktuak` (IN `p_id_produktuak` INT, IN `p_nombre` VARCHAR(30), IN `p_tipo` VARCHAR(30), IN `p_precio` INT, IN `p_cantidad` INT, IN `p_foto` VARCHAR(50))  NO SQL
BEGIN
UPDATE produltuak SET nombre = p_nombre, tipo = p_tipo , precio = p_precio, cantidad = p_cantidad, foto = p_foto  

where id_produktuak = p_id_produktuak;

END$$

DROP PROCEDURE IF EXISTS `sp_mostrar_dendak`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_mostrar_dendak` ()  NO SQL
SELECT * from dendak$$

DROP PROCEDURE IF EXISTS `sp_mostrar_erabiltzaileak`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_mostrar_erabiltzaileak` ()  NO SQL
SELECT * FROM erabiltzaileak$$

DROP PROCEDURE IF EXISTS `sp_mostrar_produktuak`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_mostrar_produktuak` ()  NO SQL
select * from produltuak$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `produltuak`
--

DROP TABLE IF EXISTS `produltuak`;
CREATE TABLE IF NOT EXISTS `produltuak` (
  `id_produktuak` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  `tipo` varchar(30) NOT NULL,
  `precio` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `foto` varchar(50) NOT NULL,
  PRIMARY KEY (`id_produktuak`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `produltuak`
--

INSERT INTO `produltuak` (`id_produktuak`, `nombre`, `tipo`, `precio`, `cantidad`, `foto`) VALUES
(1, 'Avellana rellena de chocolate', 'chocolates', 5, 147, 'avellana_rellena.jpg'),
(2, 'Surtido tres chocolates', 'chocolates', 9, 19, 'surtido_chocolates.jpg'),
(18, 'pasta', 'pastas', 20, 6, 'pastaste.jpg'),
(4, 'trufa', 'chocolate', 20, 23, 'tartatrufa.jpg'),
(14, 'Tarta de frutas', 'tartas', 99, 4, 'tartafrutas.jpg'),
(26, 'huevo chocolate', 'especiales', 9, 7, 'mifoto'),
(17, 'tabletas', 'chocolates', 10, 10, 'mifoto'),
(15, 'Surtido de Pastas', 'pastas', 12, 23, 'surtidopastas.jpg'),
(28, 'cerdito choco', 'infantil', 13, 5, 'mifoto'),
(22, 'bombon', 'bonbones', 20, 200, 'mifoto'),
(35, 'qqqqqq', 'qqqq', 12, 12, 'mifoto');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
