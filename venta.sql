-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-02-2025 a las 18:20:42
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
-- Base de datos: `venta`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `idcategoria` int(11) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`idcategoria`, `nombre`, `status`) VALUES
(1, 'PRENDAS DE VESTIR', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `idcliente` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `tipo_documento` int(11) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`idcliente`, `nombre`, `tipo_documento`, `telefono`, `direccion`, `status`) VALUES
(1, 'SARITA MOZOMBITE', 63263265, '953416833', 'SISA', 1),
(2, 'Claudia Tuanama', 32696326, '956321526', 'jr. lima', 1),
(3, 'JOSE LINARES', 42516325, '963256326', 'MOYOBAMBA', 0),
(4, 'LUIS JOSE', 12345632, '963265236', 'LOLO', 0),
(7, 'LAURA TAPULLIMA', 9632653, '96356329', 'MOYOBAMBA', 0),
(8, 'JOSE', 6326532, '96325236', 'HH', 0),
(9, 'MARIELA', 1236526, '96323652', 'RIOJA', 1),
(10, 'carlos', 4251263, '96325165', 'moyobamba', 0),
(11, 'CLIENTE VARIOS', 0, '96325632', 'SIN DIRECCION', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `id` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `fecha` date NOT NULL,
  `id_proveedor` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `sede_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`id`, `total`, `fecha`, `id_proveedor`, `id_usuario`, `estado`, `sede_id`) VALUES
(1, 50.00, '2025-02-07', 1, 1, 1, 0),
(2, 100.00, '2025-02-07', 1, 1, 1, 0),
(3, 90.00, '2025-02-07', 1, 1, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE `configuracion` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `ruc` int(11) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `direccion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`id`, `nombre`, `ruc`, `telefono`, `email`, `direccion`) VALUES
(1, 'CARITAS DE LA PRELATURA DE MOYOBAMBA', 2147483647, '953146833', 'info.caritasmoyobamba@gmail.com', 'JR. SAN MARTIN 314 - MOYOBAMBA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_compras`
--

CREATE TABLE `detalle_compras` (
  `id` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL DEFAULT 0.00,
  `cantidad` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_compra` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_compras`
--

INSERT INTO `detalle_compras` (`id`, `precio`, `cantidad`, `id_producto`, `id_compra`) VALUES
(1, 10.00, 5, 1, 1),
(2, 10.00, 10, 1, 2),
(3, 10.00, 9, 1, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_permisos`
--

CREATE TABLE `detalle_permisos` (
  `id` int(11) NOT NULL,
  `id_permiso` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_permisos`
--

INSERT INTO `detalle_permisos` (`id`, `id_permiso`, `id_usuario`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1),
(5, 5, 1),
(6, 6, 1),
(7, 7, 1),
(8, 8, 1),
(9, 9, 1),
(10, 10, 1),
(11, 11, 1),
(12, 14, 1),
(27, 3, 5),
(28, 5, 5),
(29, 6, 5),
(30, 9, 5),
(43, 3, 4),
(44, 4, 4),
(45, 5, 4),
(46, 6, 4),
(47, 9, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_stock_sede`
--

CREATE TABLE `detalle_stock_sede` (
  `id` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_sede` int(11) NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `detalle_stock_sede`
--

INSERT INTO `detalle_stock_sede` (`id`, `id_producto`, `id_sede`, `stock`) VALUES
(1, 1, 1, 5),
(2, 1, 2, 0),
(3, 1, 3, 9),
(4, 1, 4, 0),
(5, 2, 1, 0),
(6, 2, 2, 0),
(7, 2, 3, 0),
(8, 2, 4, 0),
(9, 3, 1, 0),
(10, 3, 2, 0),
(11, 3, 3, 0),
(12, 3, 4, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_ventas`
--

CREATE TABLE `detalle_ventas` (
  `id` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_venta` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_ventas`
--

INSERT INTO `detalle_ventas` (`id`, `id_producto`, `id_venta`, `cantidad`, `precio`) VALUES
(1, 1, 1, 3, 10.00),
(2, 1, 2, 1, 10.00),
(3, 1, 3, 1, 10.00),
(4, 1, 4, 3, 10.00),
(5, 1, 5, 1, 10.00),
(6, 1, 6, 1, 10.00),
(7, 1, 7, 1, 10.00),
(8, 1, 8, 2, 10.00),
(9, 1, 9, 1, 10.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE `perfil` (
  `id` int(11) NOT NULL,
  `nombre_perfil` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`id`, `nombre_perfil`, `status`) VALUES
(1, 'ADMINISTRADOR', 1),
(2, 'ASISTENTE', 1),
(3, 'TESORERIA', 1),
(4, 'MONSEÑOR', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id`, `nombre`) VALUES
(1, 'Configuracion'),
(2, 'Usuarios'),
(3, 'Clientes'),
(4, 'Productos'),
(5, 'Ventas'),
(6, 'Nueva venta'),
(7, 'Compras'),
(8, 'Nueva compra'),
(9, 'Proveedores'),
(10, 'sede'),
(11, 'categoria'),
(14, 'traslado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `codproducto` int(11) NOT NULL,
  `idcategoria` varchar(20) NOT NULL,
  `nombre` varchar(80) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`codproducto`, `idcategoria`, `nombre`, `descripcion`, `precio`, `status`) VALUES
(1, '1', 'Polera ', 'Hombre Azul Marino Land´s And', 10.00, 1),
(2, '1', 'Chompa', 'Mujer peluche negra', 15.00, 1),
(3, '1', 'Vestido', 'Mujer Rojo Land´s And', 10.00, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `idproveedor` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL DEFAULT '',
  `ruc` int(11) NOT NULL,
  `telefono` varchar(15) NOT NULL DEFAULT '',
  `direccion` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`idproveedor`, `nombre`, `ruc`, `telefono`, `direccion`, `status`) VALUES
(1, 'CONTENDOR', 2052136256, '963258415', 'JR. CALLAO - TARAPOTO', 1),
(2, 'LIBRERIA PARROQUIA', 2147483647, '963265236', 'TARAPOTO', 1),
(3, 'LIBRERIA CHACHA', 2147483647, '963265369', 'JR. 2 DE MAYO', 0),
(4, 'TEXTELERIA MOYOBAMBA', 2013265262, '963265212', 'JR. LIMA', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sede`
--

CREATE TABLE `sede` (
  `sede_id` int(11) NOT NULL,
  `nombre` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `direccion` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `estado` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `sede`
--

INSERT INTO `sede` (`sede_id`, `nombre`, `direccion`, `estado`) VALUES
(1, 'MOYOBAMBA', 'JR. SAN MARTIN 314', 'ACTIVO'),
(2, 'PICOTA', 'JR. PICOTA', 'ACTIVO'),
(3, 'SISA', 'JR. TACNA', 'ACTIVO'),
(4, 'TARAPOTO', 'JR. JUAN VARGS', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temp_compras`
--

CREATE TABLE `temp_compras` (
  `id` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL DEFAULT 0.00,
  `cantidad` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `sede_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temp_ventas`
--

CREATE TABLE `temp_ventas` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `descuento` decimal(10,2) NOT NULL DEFAULT 0.00,
  `precio` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `traslado`
--

CREATE TABLE `traslado` (
  `idtraslado` int(11) NOT NULL,
  `sede_origen` varchar(40) NOT NULL,
  `sede_destino` varchar(40) NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `fecha_aceptacion` datetime NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `perfil` int(11) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `clave` varchar(150) NOT NULL,
  `sede_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `nombre`, `perfil`, `correo`, `clave`, `sede_id`, `status`) VALUES
(1, 'ADMIN GENERAL', 1, 'admin@gmail.com', '$2y$10$eVouXr4.yN5jROwGL1e7VO/SX01k67Sy8avO8T1jLXSHM6Vz1Wfku', 1, 1),
(4, 'HALI HUACCHA', 2, 'saridhuaccha@gmail.com', '$2y$10$sJSkVn3Zf9LufGT6qopAaeaO3J15nEhb9jXZmKB5NhPLDT1MDC5im', 3, 1),
(5, 'MARILIN', 2, 'marilin@gmail.com', '$2y$10$yEX7JRpodYTAFymvDxnK9uYGPJ6o60iuibd62sLhH6AiNvmEeOUHK', 2, 0),
(6, 'ARACELY TUANAMA', 2, 'aracelytuanama@gmail.com', '$2y$10$PCeXEEmjOdOQh6Fk92nwIOKKMMAv2WMzryY6dJla/MIRG9Kr401du', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `metodo` varchar(80) NOT NULL DEFAULT '',
  `id_usuario` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `id_sede` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `id_cliente`, `total`, `metodo`, `id_usuario`, `fecha`, `id_sede`) VALUES
(1, 11, 30.00, 'EFECTIVO', 4, '2025-02-07', 1),
(2, 11, 10.00, 'EFECTIVO', 4, '2025-02-07', 1),
(3, 11, 10.00, 'EFECTIVO', 4, '2025-02-07', 1),
(4, 1, 30.00, 'EFECTIVO', 4, '2025-02-07', 1),
(5, 11, 10.00, 'YAPE', 4, '2025-02-07', 3),
(6, 11, 10.00, 'DONACION', 1, '2025-02-07', 1),
(7, 11, 10.00, 'EFECTIVO', 1, '2025-02-08', 1),
(8, 11, 20.00, 'EFECTIVO', 1, '2025-02-10', 1),
(9, 2, 10.00, 'DONACION', 1, '2025-02-10', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idcategoria`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`idcliente`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_proveedor` (`id_proveedor`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_compras`
--
ALTER TABLE `detalle_compras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_compra` (`id_compra`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `detalle_permisos`
--
ALTER TABLE `detalle_permisos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_permiso` (`id_permiso`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `detalle_stock_sede`
--
ALTER TABLE `detalle_stock_sede`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_producto_detalle` (`id_producto`),
  ADD KEY `fk_detalle_Sede` (`id_sede`);

--
-- Indices de la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `id_venta` (`id_venta`);

--
-- Indices de la tabla `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`codproducto`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`idproveedor`);

--
-- Indices de la tabla `sede`
--
ALTER TABLE `sede`
  ADD PRIMARY KEY (`sede_id`);

--
-- Indices de la tabla `temp_compras`
--
ALTER TABLE `temp_compras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_temp_compras_producto` (`id_producto`),
  ADD KEY `FK_temp_compras_usuario` (`id_usuario`);

--
-- Indices de la tabla `temp_ventas`
--
ALTER TABLE `temp_ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `traslado`
--
ALTER TABLE `traslado`
  ADD PRIMARY KEY (`idtraslado`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`),
  ADD KEY `fk_user_perfil` (`perfil`),
  ADD KEY `fk_user_sede` (`sede_id`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idcategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `idcliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `detalle_compras`
--
ALTER TABLE `detalle_compras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `detalle_permisos`
--
ALTER TABLE `detalle_permisos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de la tabla `detalle_stock_sede`
--
ALTER TABLE `detalle_stock_sede`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `perfil`
--
ALTER TABLE `perfil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `codproducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `idproveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `sede`
--
ALTER TABLE `sede`
  MODIFY `sede_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `temp_compras`
--
ALTER TABLE `temp_compras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `temp_ventas`
--
ALTER TABLE `temp_ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `traslado`
--
ALTER TABLE `traslado`
  MODIFY `idtraslado` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `compras`
--
ALTER TABLE `compras`
  ADD CONSTRAINT `compras_ibfk_1` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`idproveedor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `compras_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_compras`
--
ALTER TABLE `detalle_compras`
  ADD CONSTRAINT `detalle_compras_ibfk_1` FOREIGN KEY (`id_compra`) REFERENCES `compras` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_compras_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`codproducto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_permisos`
--
ALTER TABLE `detalle_permisos`
  ADD CONSTRAINT `detalle_permisos_ibfk_1` FOREIGN KEY (`id_permiso`) REFERENCES `permisos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_permisos_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_stock_sede`
--
ALTER TABLE `detalle_stock_sede`
  ADD CONSTRAINT `fk_detalle_Sede` FOREIGN KEY (`id_sede`) REFERENCES `sede` (`sede_id`),
  ADD CONSTRAINT `fk_producto_detalle` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`codproducto`);

--
-- Filtros para la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  ADD CONSTRAINT `detalle_ventas_ibfk_1` FOREIGN KEY (`id_venta`) REFERENCES `ventas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_ventas_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`codproducto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `temp_compras`
--
ALTER TABLE `temp_compras`
  ADD CONSTRAINT `temp_compras_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `temp_compras_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`codproducto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `temp_ventas`
--
ALTER TABLE `temp_ventas`
  ADD CONSTRAINT `temp_ventas_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `temp_ventas_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`codproducto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_user_perfil` FOREIGN KEY (`perfil`) REFERENCES `perfil` (`id`),
  ADD CONSTRAINT `fk_user_sede` FOREIGN KEY (`sede_id`) REFERENCES `sede` (`sede_id`);

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`idcliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ventas_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
