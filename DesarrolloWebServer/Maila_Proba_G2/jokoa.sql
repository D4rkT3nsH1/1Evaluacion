-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-10-2023 a las 13:52:13
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

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
-- Estructura de tabla para la tabla `galderaktaula`
--

CREATE TABLE `galderaktaula` (
  `galderaId` int(11) NOT NULL,
  `galdera` varchar(30) DEFAULT NULL,
  `erantzunPosibleak` varchar(15) DEFAULT NULL,
  `erantzunOna` varchar(10) DEFAULT NULL,
  `galderarenBalioa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `galderaktaula`
--

INSERT INTO `galderaktaula` (`galderaId`, `galdera`, `erantzunPosibleak`, `erantzunOna`, `galderarenBalioa`) VALUES
(1, 'Zein da urrearen elemento kimi', 'Fr/Au/Ur', 'Au', 13),
(2, 'Urdina eta gorria nahasten da ', 'Berdea/Morea', 'Morea', 7),
(3, 'Zenbat da 4x4?', '8/16/14/15', '16', 5);

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
('Ekain', 111, 200),
('Gontzal', 1221, 5064),
('Jon', 1234, 130),
('Jone', 1234, 43),
('Maitane', 1234, 58),
('Patxi', 111, 2200);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partidataula`
--

CREATE TABLE `partidataula` (
  `erabiltzailea` varchar(20) NOT NULL,
  `partidaOrdua` timestamp NOT NULL DEFAULT current_timestamp(),
  `galderaId` int(11) NOT NULL,
  `galderaZuzena` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `partidataula`
--

INSERT INTO `partidataula` (`erabiltzailea`, `partidaOrdua`, `galderaId`, `galderaZuzena`) VALUES
('Gontzal', '2023-10-24 10:42:17', 1, 1),
('Gontzal', '2023-10-24 10:42:17', 2, 0),
('Gontzal', '2023-10-24 10:42:17', 3, 1),
('Gontzal', '2023-10-24 11:59:10', 1, 0),
('Gontzal', '2023-10-24 12:00:06', 1, 1),
('Gontzal', '2023-10-24 12:00:13', 2, 1),
('Gontzal', '2023-10-24 12:00:16', 3, 0),
('Gontzal', '2023-10-24 12:01:35', 1, 1),
('Gontzal', '2023-10-24 12:01:35', 2, 1),
('Gontzal', '2023-10-24 12:01:35', 3, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `galderaktaula`
--
ALTER TABLE `galderaktaula`
  ADD PRIMARY KEY (`galderaId`);

--
-- Indices de la tabla `jokalariak`
--
ALTER TABLE `jokalariak`
  ADD PRIMARY KEY (`erabiltzailea`);

--
-- Indices de la tabla `partidataula`
--
ALTER TABLE `partidataula`
  ADD PRIMARY KEY (`erabiltzailea`,`partidaOrdua`,`galderaId`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `galderaktaula`
--
ALTER TABLE `galderaktaula`
  MODIFY `galderaId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
