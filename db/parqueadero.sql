-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-10-2023 a las 01:15:50
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
-- Base de datos: `parqueadero`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comprobante`
--

CREATE TABLE `comprobante` (
  `id` int(100) NOT NULL,
  `id_vehiculo` int(100) NOT NULL,
  `id_tarifa` int(100) DEFAULT NULL,
  `fecha_salida` timestamp NOT NULL DEFAULT current_timestamp(),
  `valor_pagar` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Disparadores `comprobante`
--
DELIMITER $$
CREATE TRIGGER `calcular_valor_pagar` BEFORE INSERT ON `comprobante` FOR EACH ROW BEGIN
  DECLARE horas_permanencia INT;
  DECLARE tarifa_hora INT;
  DECLARE id_tarifa_comprobante INT;

  SET horas_permanencia = TIMESTAMPDIFF(HOUR, (SELECT fecha_ingreso FROM Vehiculos WHERE id = NEW.id_vehiculo), NEW.fecha_salida);

  SELECT precio_tarifa, id INTO tarifa_hora, id_tarifa_comprobante
  FROM Tarifas
  WHERE tipo_vehiculo = (SELECT tipo_vehiculo FROM Vehiculos WHERE id = NEW.id_vehiculo);

  SET NEW.id_tarifa = id_tarifa_comprobante;

  SET NEW.valor_pagar = horas_permanencia * tarifa_hora;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarifas`
--

CREATE TABLE `tarifas` (
  `id` int(100) NOT NULL,
  `precio_tarifa` int(100) DEFAULT NULL,
  `tipo_vehiculo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tarifas`
--

INSERT INTO `tarifas` (`id`, `precio_tarifa`, `tipo_vehiculo`) VALUES
(1, 500, 'moto'),
(2, 1000, 'carro'),
(3, 1200, 'camion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculos`
--

CREATE TABLE `vehiculos` (
  `id` int(100) NOT NULL,
  `tipo_vehiculo` varchar(100) NOT NULL,
  `marca` varchar(255) NOT NULL,
  `placa` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `fecha_ingreso` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comprobante`
--
ALTER TABLE `comprobante`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_vehiculo` (`id_vehiculo`),
  ADD KEY `id_tarifa` (`id_tarifa`);

--
-- Indices de la tabla `tarifas`
--
ALTER TABLE `tarifas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comprobante`
--
ALTER TABLE `comprobante`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT de la tabla `tarifas`
--
ALTER TABLE `tarifas`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comprobante`
--
ALTER TABLE `comprobante`
  ADD CONSTRAINT `comprobante_ibfk_1` FOREIGN KEY (`id_vehiculo`) REFERENCES `vehiculos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comprobante_ibfk_2` FOREIGN KEY (`id_tarifa`) REFERENCES `tarifas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
