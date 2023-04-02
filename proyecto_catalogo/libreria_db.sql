-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-11-2021 a las 14:56:06
-- Versión del servidor: 10.4.19-MariaDB
-- Versión de PHP: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `libreria_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargos`
--

CREATE TABLE `cargos` (
  `Id_Cargo` int(3) NOT NULL,
  `Cargo` varchar(25) NOT NULL,
  `Id_Superior` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cargos`
--

INSERT INTO `cargos` (`Id_Cargo`, `Cargo`, `Id_Superior`) VALUES
(1, 'SuperUsuario', 0),
(11, 'Administrador', 0),
(22, 'V1', 11),
(23, 'V2', 11),
(24, 'Ayudante', 22);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `Id_Categoria` int(3) NOT NULL,
  `Categoria` varchar(25) NOT NULL,
  `Descripcion` varchar(30) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`Id_Categoria`, `Categoria`, `Descripcion`) VALUES
(3, 'Ciencias', ''),
(6, 'Tecnologia', ''),
(7, 'Lengua', ''),
(8, 'Matematicas', ''),
(11, 'Infantiles', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `Id_Producto` int(3) NOT NULL,
  `Producto` varchar(25) NOT NULL,
  `Id_Categoria` int(3) NOT NULL,
  `Id_Usuario` int(3) NOT NULL,
  `Autor` varchar(30) CHARACTER SET utf8 NOT NULL,
  `Precio` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`Id_Producto`, `Producto`, `Id_Categoria`, `Id_Usuario`, `Autor`, `Precio`) VALUES
(4, 'Libro99', 8, 3, '99', 99),
(5, 'il,l', 3, 3, 'ok,', 999),
(10, 'nvdknfgd', 3, 3, 'sad', 0),
(11, 'Libro1', 3, 3, 'sad', 0),
(13, 'fgsd', 11, 3, 'gdsg', 0),
(15, 'Libro1', 6, 3, 'gdf', 222);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `Id_Usuario` int(3) NOT NULL,
  `Id_Cargo` int(3) NOT NULL,
  `Nombre` varchar(30) CHARACTER SET utf8 NOT NULL,
  `Apellido` varchar(30) CHARACTER SET utf8 NOT NULL,
  `Dni` varchar(10) NOT NULL,
  `Usuario` varchar(30) CHARACTER SET utf8 NOT NULL,
  `Clave` varchar(50) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`Id_Usuario`, `Id_Cargo`, `Nombre`, `Apellido`, `Dni`, `Usuario`, `Clave`) VALUES
(4, 22, 'kghf', 'khg', 'khg', 'kf', '3994b0f776913f8934f0a5c633371b2f'),
(5, 1, 'hgd', 'hgfd', 'hgfd', 'hgfdhgjghj', 'e677ac9a398d6a804df43df775278d80'),
(7, 24, 'njhgd', 'hgfs', 'hfs', 'hngfs', '428c18b7f5520ea180e34c591299b3c4'),
(13, 11, 'Mauro', 'Baier', '2233344466', 'Baier', '202cb962ac59075b964b07152d234b70'),
(15, 1, 'Mauro', 'Baier', '22333444', 'asfsf', '81dc9bdb52d04dc20036dbd8313ed055'),
(16, 1, 'dfd', 'dfd', '545', 'fdf', 'd41d8cd98f00b204e9800998ecf8427e');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cargos`
--
ALTER TABLE `cargos`
  ADD PRIMARY KEY (`Id_Cargo`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`Id_Categoria`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`Id_Producto`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`Id_Usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cargos`
--
ALTER TABLE `cargos`
  MODIFY `Id_Cargo` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `Id_Categoria` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `Id_Producto` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `Id_Usuario` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
