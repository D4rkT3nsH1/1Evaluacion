-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-11-2023 a las 02:18:17
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
-- Base de datos: `gabonak`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `abenduaren24_24diciembre`
--

CREATE TABLE `abenduaren24_24diciembre` (
  `id_erab_usuario` int(11) NOT NULL,
  `opariak_regalos` varchar(500) NOT NULL,
  `urtea_año` year(4) NOT NULL DEFAULT current_timestamp(),
  `puntuak_puntos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `egindakoak_accionesrealizadas`
--

CREATE TABLE `egindakoak_accionesrealizadas` (
  `erab_usuario` varchar(20) NOT NULL,
  `egindakoa_realizado` varchar(200) NOT NULL,
  `data_fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `egindakoak_accionesrealizadas`
--

INSERT INTO `egindakoak_accionesrealizadas` (`erab_usuario`, `egindakoa_realizado`, `data_fecha`) VALUES
('Jokin98', 'Monster edan/Ekintza matxistak egin', '2023-11-21 00:49:07'),
('mikel14', 'Haginak garbitu/Baten bat iraindu', '2023-11-21 00:50:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ekintzak_acciones`
--

CREATE TABLE `ekintzak_acciones` (
  `id_ekintzak_acciones` int(11) NOT NULL,
  `izena_nombre` varchar(100) NOT NULL,
  `adina_edad` varchar(20) NOT NULL,
  `puntuak_puntuacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ekintzak_acciones`
--

INSERT INTO `ekintzak_acciones` (`id_ekintzak_acciones`, `izena_nombre`, `adina_edad`, `puntuak_puntuacion`) VALUES
(1, 'Haginak garbitu', 'Umeak/Nerabeak/Gazte', 10),
(2, 'Monster edan', 'Nerabeak/Gazteak', -20),
(3, 'Ekintza matxistak egin', 'Nerabeak/Gazteak', -30),
(4, 'Ondokoak zaindu', 'Umeak/Nerabeak/Gazte', 15),
(5, 'Logela txukun eta garbi mantendu', 'Umeak/Nerabeak/Gazte', 20),
(6, 'Baten bat iraindu', 'Umeak/Nerabeak/Gazte', -20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `erabiltzaileak_usuarios`
--

CREATE TABLE `erabiltzaileak_usuarios` (
  `id_erab_usuario` int(11) NOT NULL,
  `erab_usuario` varchar(20) NOT NULL,
  `pasahitza_contraseña` varchar(20) NOT NULL,
  `izena_nombre` varchar(30) NOT NULL,
  `jaiotze_data_fecha_nacimiento` date NOT NULL,
  `olentzero_MariDomingi` tinyint(1) NOT NULL,
  `puntuazioa_puntuacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `erabiltzaileak_usuarios`
--

INSERT INTO `erabiltzaileak_usuarios` (`id_erab_usuario`, `erab_usuario`, `pasahitza_contraseña`, `izena_nombre`, `jaiotze_data_fecha_nacimiento`, `olentzero_MariDomingi`, `puntuazioa_puntuacion`) VALUES
(1, 'nahia', '111', 'Nahia', '2013-08-13', 0, 0),
(2, 'Jokin98', '111', 'Jokin', '1998-04-13', 0, -150),
(3, 'mikel14', '111', 'Mikel', '2014-11-24', 0, -10),
(4, 'Olen', '111', 'Olentzero', '0134-11-05', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gutunak_cartas`
--

CREATE TABLE `gutunak_cartas` (
  `erab_usuario` varchar(20) NOT NULL,
  `urtea` int(11) NOT NULL,
  `eskatutakoak_pedidos` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `gutunak_cartas`
--

INSERT INTO `gutunak_cartas` (`erab_usuario`, `urtea`, `eskatutakoak_pedidos`) VALUES
('nahia', 2023, 'Gitarra/Fornite');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `opariak_regalos`
--

CREATE TABLE `opariak_regalos` (
  `id_opari_regalo` int(11) NOT NULL,
  `izena_nombre` varchar(50) NOT NULL,
  `adina_edad` varchar(20) NOT NULL,
  `puntuazioa_puntuacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `opariak_regalos`
--

INSERT INTO `opariak_regalos` (`id_opari_regalo`, `izena_nombre`, `adina_edad`, `puntuazioa_puntuacion`) VALUES
(1, 'Bizikleta', 'Umeak/Nerabeak/Gazte', 200),
(2, 'Gitarra', 'Nerabeak/Gazteak', 100),
(3, 'Trizikloa', 'Umeak', 50),
(4, 'Tanborra', 'Umeak', 15),
(5, 'Nintendo Switch', 'Umeak/Nerabeak/Gazte', 250),
(6, 'Fornite', 'Nerabeak/Gazteak', 50);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `egindakoak_accionesrealizadas`
--
ALTER TABLE `egindakoak_accionesrealizadas`
  ADD PRIMARY KEY (`data_fecha`),
  ADD UNIQUE KEY `erab_usuario` (`erab_usuario`);

--
-- Indices de la tabla `ekintzak_acciones`
--
ALTER TABLE `ekintzak_acciones`
  ADD PRIMARY KEY (`id_ekintzak_acciones`);

--
-- Indices de la tabla `erabiltzaileak_usuarios`
--
ALTER TABLE `erabiltzaileak_usuarios`
  ADD PRIMARY KEY (`id_erab_usuario`),
  ADD UNIQUE KEY `erab_usuario` (`erab_usuario`);

--
-- Indices de la tabla `gutunak_cartas`
--
ALTER TABLE `gutunak_cartas`
  ADD PRIMARY KEY (`erab_usuario`,`urtea`);

--
-- Indices de la tabla `opariak_regalos`
--
ALTER TABLE `opariak_regalos`
  ADD PRIMARY KEY (`id_opari_regalo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ekintzak_acciones`
--
ALTER TABLE `ekintzak_acciones`
  MODIFY `id_ekintzak_acciones` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `erabiltzaileak_usuarios`
--
ALTER TABLE `erabiltzaileak_usuarios`
  MODIFY `id_erab_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `opariak_regalos`
--
ALTER TABLE `opariak_regalos`
  MODIFY `id_opari_regalo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
