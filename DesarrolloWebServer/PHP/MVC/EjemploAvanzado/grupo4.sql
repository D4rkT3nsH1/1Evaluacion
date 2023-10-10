-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 10, 2022 at 12:35 AM
-- Server version: 10.3.37-MariaDB-log
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `grupo4ze_4rbike`
--

DELIMITER $$
--
-- Procedures
--
$$

$$

$$

$$

$$

$$

$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `componentes`
--

CREATE TABLE `componentes` (
  `id_componentes` int(11) NOT NULL,
  `id_marca` int(11) NOT NULL,
  `img_componentes` varchar(2000) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `stock` int(11) DEFAULT NULL,
  `precio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `componentes`
--

INSERT INTO `componentes` (`id_componentes`, `id_marca`, `img_componentes`, `tipo`, `stock`, `precio`) VALUES
(10, 2, '/view/img/productos/sillin_2.png', 'zela', 89, 12),
(11, 3, '/view/img/productos/sillin_3.png', 'zela', 76, 32),
(12, 2, '/view/img/productos/sillin_4.png', 'zela', 12, 36),
(25, 4, '/view/img/productos/manillar_1.png', 'eskulekua', 21, 98),
(26, 4, '/view/img/productos/manillar_2.png', 'eskulekua', 4, 57),
(27, 4, '/view/img/productos/manillar_3.png', 'eskulekua', 45, 81),
(28, 4, '/view/img/productos/manillar_4.png', 'eskulekua', 34, 75),
(30, 1, '/view/img/productos/rueda_2.png', 'gurpila', 98, 45),
(31, 4, '/view/img/productos/rueda_3.png', 'gurpila', 12, 43),
(32, 1, '/view/img/productos/rueda_4.png', 'gurpila', 65, 21),
(33, 1, '/view/img/productos/pedales_1.png', 'pedala', 1, 1),
(34, 3, '/view/img/productos/pedales_2.png', 'pedala', 1, 1),
(35, 1, '/view/img/productos/pedales_3.png', 'pedala', 1, 1),
(36, 1, '/view/img/productos/suspension_1.png', 'etetea', 1, 1),
(37, 1, '/view/img/productos/suspension_2.png', 'etetea', 1, 1),
(38, 2, '/view/img/productos/suspension_3.png', 'etetea', 1, 1),
(39, 5, '/view/img/productos/freno_1.png', 'frenoa', 1, 1),
(40, 6, '/view/img/productos/freno_2.png', 'frenoa', 1, 1),
(41, 5, '/view/img/productos/freno_3.png', 'frenoa', 1, 1),
(42, 6, '/view/img/productos/cadena_1.png', 'katea', 1, 1),
(43, 5, '/view/img/productos/cadena_2.png', 'katea', 1, 1),
(44, 6, '/view/img/productos/cadena_3.png', 'katea', 10, 112);

-- --------------------------------------------------------

--
-- Table structure for table `marca`
--

CREATE TABLE `marca` (
  `id_marca` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `marca`
--

INSERT INTO `marca` (`id_marca`, `nombre`) VALUES
(1, 'michelin'),
(2, 'DPV'),
(3, 'MTB'),
(4, 'VELMIA'),
(5, 'SHIMANO'),
(6, 'GALFER');

-- --------------------------------------------------------

--
-- Table structure for table `noticias`
--

CREATE TABLE `noticias` (
  `id_noticias` int(11) NOT NULL,
  `titulo` varchar(50) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `entrada` varchar(1000) DEFAULT NULL,
  `cuerpo` varchar(5000) DEFAULT NULL,
  `autor` varchar(50) DEFAULT NULL,
  `img_noticia` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuarios` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `pasahitza` varchar(20) NOT NULL,
  `tipo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id_usuarios`, `nombre`, `correo`, `pasahitza`, `tipo`) VALUES
(1, 'usuario', 'usuario@gmail.com', '1234', 'usuario'),
(2, 'hodei', 'hodei@gmail.com', 'hodei', 'usuario'),
(3, 'peio', 'peio@gmail.com', 'hola', 'usuario'),
(5, 'admin', 'admin@gmail.com', 'admin123', 'admin'),
(8, 'julen', 'julenRK@gmail.com', 'julen', 'usuario'),
(17, 'patxi', 'patxi@gmail.com', 'patxi', 'usuario'),
(20, 'markel', 'markel@gmail.com', 'hola', 'usuario'),
(21, 'joselito', 'joselito@gmail.com', 'joselito', 'usuario'),
(22, 'Juab', 'juan@gmail.com', '12345', 'usuario'),
(23, 'coco', 'coco@gmail.com', 'coco', 'usuario');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `componentes`
--
ALTER TABLE `componentes`
  ADD PRIMARY KEY (`id_componentes`),
  ADD KEY `id_marca` (`id_marca`);

--
-- Indexes for table `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`id_marca`);

--
-- Indexes for table `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`id_noticias`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuarios`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `componentes`
--
ALTER TABLE `componentes`
  MODIFY `id_componentes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `marca`
--
ALTER TABLE `marca`
  MODIFY `id_marca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `noticias`
--
ALTER TABLE `noticias`
  MODIFY `id_noticias` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuarios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `componentes`
--
ALTER TABLE `componentes`
  ADD CONSTRAINT `componentes_ibfk_1` FOREIGN KEY (`id_marca`) REFERENCES `marca` (`id_marca`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
