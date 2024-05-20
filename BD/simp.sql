-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-05-2024 a las 01:07:14
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `simp`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `simp`
--

CREATE TABLE `simp` (
  `nom` varchar(255) NOT NULL DEFAULT '',
  `correo` varchar(255) NOT NULL,
  `ID` int(12) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `simp`
--

INSERT INTO `simp` (`nom`, `correo`, `ID`, `pass`, `img`) VALUES
('Jose ola como estas', 'comoquieras@tusieresmihermano.com', 1, '$2y$15$3Mnd2FL1SEYxC/ZdBRhRCet8q1elsjLgjJPv7tbGRRSXdIgaWK2Vi', 'Jose ola como estas.png'),
('Jose ola como estas 2', 'comoquieras@tusieresmihermana.com', 2, '$2y$15$E0pJUYycKxyEGIaO4ypK0ucngTg2uuSTNWc1thdPndHUImuTpAS5i', 'Jose ola como estas 2.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `ID` int(12) NOT NULL,
  `Correo` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `access` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `simp`
--
ALTER TABLE `simp`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
