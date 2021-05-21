-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 07-05-2021 a las 20:40:52
-- Versión del servidor: 10.3.28-MariaDB
-- Versión de PHP: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `xtnghjvd_pedidosColombia`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `app_presentacion_producto`
--

CREATE TABLE `app_presentacion_producto` (
  `idPresentacion` bigint(20) NOT NULL,
  `idTienda` bigint(20) DEFAULT NULL,
  `variacion` int(11) DEFAULT 1,
  `idProducto` bigint(20) NOT NULL,
  `idSubcategoria` bigint(11) DEFAULT NULL,
  `nombrePresentacion` varchar(100) NOT NULL,
  `marca` varchar(255) DEFAULT NULL,
  `codigoProducto` varchar(50) DEFAULT NULL,
  `fotoPresentacion` blob NOT NULL,
  `foto2` blob NOT NULL,
  `foto3` blob NOT NULL,
  `foto4` blob NOT NULL,
  `foto5` blob DEFAULT NULL,
  `descuento` int(11) DEFAULT 0,
  `valorPresentacion` int(11) NOT NULL,
  `valorAntes` int(11) DEFAULT 0,
  `descripcionCorta` text DEFAULT NULL,
  `descripcionPres` text NOT NULL,
  `agotado` enum('Si','No') DEFAULT 'No',
  `nuevo` enum('Si','No') DEFAULT 'No',
  `likes` int(11) DEFAULT 0,
  `idEstado` int(11) DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `app_productos`
--

CREATE TABLE `app_productos` (
  `idProducto` bigint(20) NOT NULL,
  `idTienda` bigint(20) DEFAULT NULL,
  `nombreProducto` text DEFAULT NULL,
  `foto` blob NOT NULL,
  `descProducto` text NOT NULL,
  `orden` int(11) DEFAULT 1,
  `idEstado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `app_subproductos`
--

CREATE TABLE `app_subproductos` (
  `idSubcategoria` bigint(11) UNSIGNED NOT NULL,
  `idTienda` bigint(20) DEFAULT NULL,
  `nombreSubcategoria` varchar(250) DEFAULT NULL,
  `idProducto` bigint(20) DEFAULT NULL,
  `foto` blob DEFAULT NULL,
  `idEstado` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `app_presentacion_producto`
--
ALTER TABLE `app_presentacion_producto`
  ADD PRIMARY KEY (`idPresentacion`);

--
-- Indices de la tabla `app_productos`
--
ALTER TABLE `app_productos`
  ADD PRIMARY KEY (`idProducto`);

--
-- Indices de la tabla `app_subproductos`
--
ALTER TABLE `app_subproductos`
  ADD PRIMARY KEY (`idSubcategoria`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `app_presentacion_producto`
--
ALTER TABLE `app_presentacion_producto`
  MODIFY `idPresentacion` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `app_productos`
--
ALTER TABLE `app_productos`
  MODIFY `idProducto` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `app_subproductos`
--
ALTER TABLE `app_subproductos`
  MODIFY `idSubcategoria` bigint(11) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
