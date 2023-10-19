-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-10-2023 a las 18:06:52
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
-- Base de datos: `jokoa`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jokalariak`
--

CREATE TABLE `jokalariak` (
  `erabiltzailea` varchar(20) NOT NULL,
  `pasahitza` int(11) NOT NULL,
  `puntuazio_max` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `jokalariak`
--

INSERT INTO `jokalariak` (`erabiltzailea`, `pasahitza`, `puntuazio_max`) VALUES
('Ane', 111, 239),
('Ekain', 111, 200),
('Jon', 1234, 130),
('Jone', 1234, 10),
('Maitane', 1234, 58),
('Patxi', 111, 2200);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `jokalariak`
--
ALTER TABLE `jokalariak`
  ADD PRIMARY KEY (`erabiltzailea`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
