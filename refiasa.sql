-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-06-2024 a las 14:02:50
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `refiasa`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `altura`
--

CREATE TABLE `altura` (
  `id` int(11) NOT NULL,
  `id_mascota` int(11) NOT NULL,
  `altura` decimal(5,2) NOT NULL,
  `creado_por` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `altura`
--

INSERT INTO `altura` (`id`, `id_mascota`, `altura`, `creado_por`, `created_at`) VALUES
(1, 1, '1.20', 2, '2024-06-18 02:12:10'),
(2, 2, '1.00', 2, '2024-06-18 02:12:11'),
(3, 3, '0.80', 2, '2024-06-18 02:12:11'),
(4, 4, '0.50', 2, '2024-06-18 02:12:11'),
(5, 5, '1.00', 2, '2024-06-18 02:12:11'),
(6, 7, '1.20', 2, '2024-06-18 22:45:24'),
(7, 12, '1.20', 2, '2024-06-18 22:50:48'),
(8, 13, '1.20', 2, '2024-06-18 22:51:06'),
(9, 14, '1.20', 2, '2024-06-18 22:52:57'),
(10, 15, '2.20', 2, '2024-06-18 22:53:27'),
(11, 16, '2.20', 2, '2024-06-18 22:57:19'),
(12, 17, '2.20', 2, '2024-06-18 22:58:12'),
(13, 18, '2.20', 2, '2024-06-18 22:59:47'),
(14, 19, '2.20', 2, '2024-06-18 23:00:37'),
(15, 20, '2.20', 2, '2024-06-18 23:01:38'),
(16, 21, '2.20', 2, '2024-06-18 23:01:57'),
(17, 22, '2.20', 2, '2024-06-18 23:02:06'),
(18, 23, '2.20', 2, '2024-06-18 23:02:26'),
(19, 24, '2.20', 2, '2024-06-18 23:02:37'),
(20, 25, '2.20', 2, '2024-06-18 23:02:53'),
(21, 26, '2.20', 2, '2024-06-18 23:03:00'),
(22, 27, '2.20', 2, '2024-06-18 23:03:05'),
(23, 28, '2.20', 2, '2024-06-18 23:03:25'),
(24, 29, '2.20', 2, '2024-06-18 23:03:49'),
(25, 30, '1.20', 2, '2024-06-18 23:05:52'),
(26, 31, '1.20', 2, '2024-06-18 23:08:17'),
(27, 32, '1.20', 2, '2024-06-18 23:19:05'),
(28, 33, '1.20', 2, '2024-06-18 23:20:49'),
(29, 34, '1.20', 2, '2024-06-18 23:22:43'),
(30, 35, '1.20', 2, '2024-06-19 00:05:08'),
(31, 36, '1.20', 2, '2024-06-19 00:07:09'),
(32, 37, '12.00', 2, '2024-06-21 23:09:28'),
(33, 38, '2.20', 2, '2024-06-22 00:28:18'),
(34, 39, '1.20', 2, '2024-06-22 00:40:39'),
(35, 40, '1.20', 2, '2024-06-22 02:27:00'),
(36, 41, '2.20', 2, '2024-06-22 02:27:41');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atencion`
--

CREATE TABLE `atencion` (
  `id` int(11) NOT NULL,
  `id_cita` int(11) DEFAULT NULL,
  `id_mascota` int(11) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `observaciones` text DEFAULT NULL,
  `diagnosticos` text DEFAULT NULL,
  `tratamiento` text DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `creado_por` int(11) DEFAULT NULL,
  `actualizado_por` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `estado` int(11) NOT NULL,
  `id_estadoatencion` int(11) NOT NULL,
  `veterinario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `atencion`
--

INSERT INTO `atencion` (`id`, `id_cita`, `id_mascota`, `descripcion`, `observaciones`, `diagnosticos`, `tratamiento`, `fecha`, `creado_por`, `actualizado_por`, `created_at`, `updated_at`, `estado`, `id_estadoatencion`, `veterinario`) VALUES
(1, 2, 1, 'Consulta de seguimiento', 'Control de evolución post-tratamiento\r\n', 'Gastroenteritis leve.', 'Antibióticos prescritos por 5 días y dieta blanda recomendada.', '2024-06-21 15:30:00', 2, NULL, '2024-06-13 00:58:31', '2024-06-21 22:33:46', 1, 2, 3),
(4, NULL, 1, 'test', 'test', 'test', 'test', '2024-06-21 17:29:00', 2, NULL, '2024-06-21 22:38:36', '2024-06-21 22:38:36', 1, 1, 4),
(5, NULL, 1, 'test', 'test', 'test', 'test', '2024-06-21 17:53:00', 2, NULL, '2024-06-21 22:53:57', '2024-06-21 22:53:57', 1, 1, 4),
(6, NULL, 1, 'test', 'test', 'test', 'test', '2024-06-21 18:05:00', 2, NULL, '2024-06-21 23:05:31', '2024-06-21 23:05:31', 1, 1, 3),
(7, NULL, 1, 'test', 'test', 'test', 'test', '2024-06-21 18:09:00', 2, NULL, '2024-06-21 23:09:57', '2024-06-21 23:09:57', 1, 1, 4),
(8, NULL, 37, 'test', 'test', 'test', 'test', '2024-06-21 18:11:00', 2, NULL, '2024-06-21 23:13:10', '2024-06-21 23:13:10', 1, 1, 3),
(9, NULL, 39, 'test', 'test', 'test', 'test', '2024-06-21 20:16:00', 2, NULL, '2024-06-22 01:16:39', '2024-06-22 01:16:39', 1, 1, 4),
(10, NULL, 37, 'test', 'test', 'tess', 'test', '2024-06-22 13:17:00', 2, NULL, '2024-06-22 01:17:38', '2024-06-22 01:19:44', 1, 2, 4),
(11, NULL, 1, 'test', 'test', 'test', '', '2024-06-22 20:18:00', 2, NULL, '2024-06-22 01:18:24', '2024-06-22 01:19:46', 1, 2, 4),
(12, NULL, 37, 'TEST', 'TEST', 'TEST', 'TEST', '2024-06-27 13:00:00', 2, NULL, '2024-06-24 04:22:34', '2024-06-24 04:24:50', 1, 2, 3),
(13, NULL, 37, 'TEST', 'TEST', '', '', '2024-06-23 12:02:00', 2, NULL, '2024-06-24 04:23:27', '2024-06-24 04:24:53', 1, 2, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atencion_producto`
--

CREATE TABLE `atencion_producto` (
  `id` int(11) NOT NULL,
  `id_atencion` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atencion_servicio`
--

CREATE TABLE `atencion_servicio` (
  `id_atencion` int(11) NOT NULL,
  `id_servicio` int(11) NOT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `atencion_servicio`
--

INSERT INTO `atencion_servicio` (`id_atencion`, `id_servicio`, `descripcion`) VALUES
(1, 1, NULL),
(4, 2, NULL),
(5, 4, NULL),
(6, 3, NULL),
(7, 3, NULL),
(8, 3, NULL),
(9, 1, NULL),
(10, 3, NULL),
(11, 2, NULL),
(12, 2, NULL),
(13, 2, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cita`
--

CREATE TABLE `cita` (
  `id` int(11) NOT NULL,
  `id_mascota` int(11) DEFAULT NULL,
  `creado_por` int(11) DEFAULT NULL,
  `id_hora` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `estado` int(11) NOT NULL,
  `actualizado_por` int(11) DEFAULT NULL,
  `id_estadocita` int(11) NOT NULL,
  `comentario` text NOT NULL,
  `id_tipocita` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cita`
--

INSERT INTO `cita` (`id`, `id_mascota`, `creado_por`, `id_hora`, `fecha`, `descripcion`, `created_at`, `updated_at`, `estado`, `actualizado_por`, `id_estadocita`, `comentario`, `id_tipocita`) VALUES
(2, 1, 2, 3, '2024-06-13', 'Cita para vacunación anual y revisión de salud', '2024-06-12 20:02:31', '2024-06-14 01:17:33', 1, NULL, 1, '', 1),
(3, 2, 2, 4, '2024-06-13', 'Cita para vacunación anual y revisión de salud', '2024-06-12 20:03:40', '2024-06-14 01:17:37', 1, NULL, 1, '', 1),
(9, 2, 2, 23, '2024-06-15', 'TEST', '2024-06-14 23:57:52', '2024-06-14 23:57:52', 1, NULL, 1, 'TEST', 1),
(10, 2, 2, 3, '2024-06-15', 'test', '2024-06-15 00:10:06', '2024-06-15 00:10:06', 1, NULL, 1, 'tesst', 1),
(11, 2, 2, 13, '2024-06-25', 'TEST', '2024-06-15 01:20:03', '2024-06-15 01:20:03', 1, NULL, 1, 'TEST', 1),
(12, 1, 2, 3, '2024-06-15', 'TEST', '2024-06-15 01:37:45', '2024-06-15 01:37:45', 1, NULL, 1, 'TEST', 2),
(13, 1, 2, 23, '2024-06-15', 'TEST', '2024-06-15 01:43:29', '2024-06-15 01:43:29', 1, NULL, 1, 'TEST', 2),
(14, 1, 2, 13, '2024-06-25', 'TEST', '2024-06-15 01:45:30', '2024-06-15 01:45:30', 1, NULL, 1, 'TEST', 2),
(15, 5, 2, 15, '2024-06-21', 'test', '2024-06-15 02:19:33', '2024-06-15 02:19:33', 1, NULL, 1, 'test', 1),
(16, 5, 2, 19, '2024-06-28', 'TEST', '2024-06-15 02:20:24', '2024-06-15 02:20:24', 1, NULL, 1, 'TEST', 1),
(17, 5, 2, 17, '2024-07-20', 'TEST', '2024-06-15 02:20:51', '2024-06-15 02:20:51', 1, NULL, 1, 'TEST', 1),
(18, 5, 2, 15, '2024-06-19', 'TEST', '2024-06-16 19:27:10', '2024-06-16 19:27:10', 1, NULL, 1, 'TEST', 1),
(19, 1, 2, 5, '2024-06-21', 'test', '2024-06-21 23:22:19', '2024-06-21 23:22:19', 1, NULL, 1, 'test', 1),
(20, 1, 2, 3, '2024-06-22', 'TEST', '2024-06-22 02:22:24', '2024-06-22 02:22:24', 1, NULL, 1, 'TEST', 1),
(21, 1, 2, 3, '2024-06-22', 'TEST', '2024-06-22 02:23:19', '2024-06-22 02:23:19', 1, NULL, 1, 'TEST', 2),
(22, 40, 2, 13, '2024-06-22', 'rest', '2024-06-22 02:42:22', '2024-06-22 02:42:22', 1, NULL, 1, 'rest', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cita_servicio`
--

CREATE TABLE `cita_servicio` (
  `id_cita` int(11) NOT NULL,
  `id_servicio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cita_servicio`
--

INSERT INTO `cita_servicio` (`id_cita`, `id_servicio`) VALUES
(2, 1),
(3, 4),
(9, 1),
(9, 3),
(10, 2),
(11, 3),
(12, 2),
(13, 2),
(14, 3),
(15, 2),
(16, 2),
(16, 4),
(17, 2),
(18, 3),
(19, 2),
(20, 2),
(21, 3),
(22, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido_paterno` varchar(100) NOT NULL,
  `apellido_materno` varchar(100) NOT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `correo` varchar(100) NOT NULL,
  `creado_por` int(11) DEFAULT NULL,
  `actualizado_por` int(11) DEFAULT NULL,
  `documento` varchar(20) DEFAULT NULL,
  `tipo_documento_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `estado` int(11) NOT NULL,
  `fecha_nac` date DEFAULT NULL,
  `sexo` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id`, `nombre`, `apellido_paterno`, `apellido_materno`, `direccion`, `telefono`, `correo`, `creado_por`, `actualizado_por`, `documento`, `tipo_documento_id`, `created_at`, `updated_at`, `estado`, `fecha_nac`, `sexo`) VALUES
(3, 'Juan', 'Pérez', 'Gómez', 'Calle 123', '12345678', 'juan@example.com', 2, NULL, '12345678', 1, '2024-06-12 00:54:29', '2024-06-12 22:58:28', 1, '1995-05-05', 'M'),
(4, 'María', 'López', 'Martínez', 'Avenida 456', '23456789', 'maria@example.com', 2, NULL, '87654321', 1, '2024-06-12 00:54:29', '2024-06-12 22:58:52', 1, '1995-05-05', 'F'),
(5, 'Carlos', 'García', 'Hernández', 'Calle Principal', '34567890', 'carlos@example.com', 2, NULL, '65432187', 1, '2024-06-12 00:54:29', '2024-06-12 22:58:55', 1, '1995-05-05', 'M'),
(6, 'Laura', 'Rodríguez', 'Díaz', 'Avenida Central', '45678901', 'laura@example.com', 2, NULL, '43218765', 1, '2024-06-12 00:54:29', '2024-06-12 22:59:04', 1, '1995-05-05', 'F'),
(7, 'Pedro', 'Martínez', 'Gómez', 'Calle Secundaria', '56789012', 'pedro@example.com', 2, NULL, '21876543', 1, '2024-06-12 00:54:29', '2024-06-12 22:59:02', 1, '1995-05-05', 'M');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especie`
--

CREATE TABLE `especie` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `especie`
--

INSERT INTO `especie` (`id`, `nombre`, `estado`) VALUES
(1, 'Perro', 1),
(2, 'Gato', 1),
(3, 'Ave', 1),
(4, 'Pez', 1),
(5, 'Reptil', 1),
(6, 'Hamster', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadoatencion`
--

CREATE TABLE `estadoatencion` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `clasecolor` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estadoatencion`
--

INSERT INTO `estadoatencion` (`id`, `nombre`, `clasecolor`) VALUES
(1, 'atendido', 'bg-success'),
(2, 'en espera', 'bg-warning'),
(3, 'terminado', 'bg-info');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadocita`
--

CREATE TABLE `estadocita` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `clasecolor` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estadocita`
--

INSERT INTO `estadocita` (`id`, `nombre`, `clasecolor`) VALUES
(1, 'Pendiente', 'bg-warning'),
(2, 'Asistida', 'bg-success'),
(3, 'Reprogramada', 'bg-info'),
(4, 'No asistida', 'bg-danger'),
(5, 'Cancelada', 'bg-danger');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lista_horas`
--

CREATE TABLE `lista_horas` (
  `id` int(11) NOT NULL,
  `hora` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `lista_horas`
--

INSERT INTO `lista_horas` (`id`, `hora`) VALUES
(1, '08:00:00'),
(2, '09:00:00'),
(3, '10:00:00'),
(4, '11:00:00'),
(5, '12:00:00'),
(11, '13:00:00'),
(13, '14:00:00'),
(15, '15:00:00'),
(17, '16:00:00'),
(19, '17:00:00'),
(21, '18:00:00'),
(23, '19:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mascota`
--

CREATE TABLE `mascota` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `edad` int(11) DEFAULT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `creado_por` int(11) DEFAULT NULL,
  `actualizado_por` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `estado` int(11) NOT NULL,
  `fecha_nac` date DEFAULT NULL,
  `sexo` varchar(10) DEFAULT NULL,
  `id_raza` int(11) NOT NULL,
  `comentario` text NOT NULL,
  `foto` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `mascota`
--

INSERT INTO `mascota` (`id`, `nombre`, `edad`, `id_cliente`, `creado_por`, `actualizado_por`, `created_at`, `updated_at`, `estado`, `fecha_nac`, `sexo`, `id_raza`, `comentario`, `foto`) VALUES
(1, 'Firulais', 5, 3, 2, NULL, '2024-06-12 17:18:40', '2024-06-22 00:38:23', 1, '2020-05-06', 'M', 1, '', '66761aa1babc1.png'),
(2, 'Misu', 3, 4, 2, NULL, '2024-06-12 17:18:40', '2024-06-22 00:38:23', 1, '2020-05-06', 'F', 2, '', '66761aa1babc1.png'),
(3, 'Rex', 4, 5, 2, NULL, '2024-06-12 17:18:40', '2024-06-22 00:38:23', 1, '2020-05-06', 'M', 3, '', '66761aa1babc1.png'),
(4, 'Luna', 2, 6, 2, NULL, '2024-06-12 17:18:40', '2024-06-22 00:38:23', 1, '2020-05-06', 'F', 4, '', '66761aa1babc1.png'),
(5, 'Toby', 7, 3, 2, NULL, '2024-06-12 17:18:40', '2024-06-22 00:38:23', 1, '2020-05-06', 'M', 5, '', '66761aa1babc1.png'),
(6, 'Test mascota', NULL, 7, 2, 2, '2024-06-18 22:44:18', '2024-06-22 00:38:23', 0, '2024-06-04', 'M', 3, 'saada', '66761aa1babc1.png'),
(7, 'Test mascota', NULL, 7, 2, NULL, '2024-06-18 22:45:24', '2024-06-22 00:38:23', 1, '2024-06-04', 'M', 3, 'saada', '66761aa1babc1.png'),
(8, 'Test mascota', NULL, 7, 2, 2, '2024-06-18 22:46:19', '2024-06-22 00:38:23', 0, '2024-06-04', 'M', 3, 'saada', '66761aa1babc1.png'),
(9, 'Test mascota', NULL, 7, 2, 2, '2024-06-18 22:46:30', '2024-06-22 00:38:23', 0, '2024-06-04', 'M', 3, 'saada', '66761aa1babc1.png'),
(10, 'Test mascota', NULL, 7, 2, 2, '2024-06-18 22:46:39', '2024-06-22 00:38:23', 0, '2024-06-04', 'M', 3, 'saada', '66761aa1babc1.png'),
(11, 'Test mascota', NULL, 7, 2, 2, '2024-06-18 22:48:16', '2024-06-22 00:38:23', 0, '2024-06-04', 'M', 3, 'saada', '66761aa1babc1.png'),
(12, 'Test mascota', NULL, 7, 2, 2, '2024-06-18 22:50:48', '2024-06-22 00:38:23', 0, '2024-06-04', 'M', 3, 'saada', '66761aa1babc1.png'),
(13, 'Test mascota', NULL, 7, 2, 2, '2024-06-18 22:51:05', '2024-06-22 00:38:23', 0, '2024-06-04', 'M', 3, 'saada', '66761aa1babc1.png'),
(14, 'Test mascota', NULL, 7, 2, 2, '2024-06-18 22:52:56', '2024-06-22 00:38:23', 0, '2024-06-04', 'M', 3, 'saada', '66761aa1babc1.png'),
(15, 'Test mascota', NULL, 7, 2, NULL, '2024-06-18 22:53:26', '2024-06-22 00:38:23', 1, '2024-06-04', 'M', 3, 'saada', '66761aa1babc1.png'),
(16, 'Test mascota', NULL, 7, 2, 2, '2024-06-18 22:57:19', '2024-06-22 00:38:23', 0, '2024-06-04', 'M', 3, 'saada', '66761aa1babc1.png'),
(17, 'Test mascota', NULL, 7, 2, 2, '2024-06-18 22:58:12', '2024-06-22 00:38:23', 0, '2024-06-04', 'M', 3, 'saada', '66761aa1babc1.png'),
(18, 'Test mascota', NULL, 7, 2, 2, '2024-06-18 22:59:47', '2024-06-22 00:38:23', 0, '2024-06-04', 'M', 3, 'saada', '66761aa1babc1.png'),
(19, 'Test mascota', NULL, 7, 2, 2, '2024-06-18 23:00:37', '2024-06-22 00:38:23', 0, '2024-06-04', 'M', 3, 'saada', '66761aa1babc1.png'),
(20, 'Test mascota', NULL, 7, 2, 2, '2024-06-18 23:01:38', '2024-06-22 00:38:23', 0, '2024-06-04', 'M', 3, 'saada', '66761aa1babc1.png'),
(21, 'Test mascota', NULL, 7, 2, 2, '2024-06-18 23:01:57', '2024-06-22 00:38:23', 0, '2024-06-04', 'M', 3, 'saada', '66761aa1babc1.png'),
(22, 'Test mascota', NULL, 7, 2, 2, '2024-06-18 23:02:06', '2024-06-22 00:38:23', 0, '2024-06-04', 'M', 3, 'saada', '66761aa1babc1.png'),
(23, 'Test mascota', NULL, 7, 2, 2, '2024-06-18 23:02:26', '2024-06-22 00:38:23', 0, '2024-06-04', 'M', 3, 'saada', '66761aa1babc1.png'),
(24, 'Test mascota', NULL, 7, 2, 2, '2024-06-18 23:02:37', '2024-06-22 00:38:23', 0, '2024-06-04', 'M', 3, 'saada', '66761aa1babc1.png'),
(25, 'Test mascota', NULL, 7, 2, 2, '2024-06-18 23:02:53', '2024-06-22 00:38:23', 0, '2024-06-04', 'M', 3, 'saada', '66761aa1babc1.png'),
(26, 'Test mascota', NULL, 7, 2, 2, '2024-06-18 23:03:00', '2024-06-22 00:38:23', 0, '2024-06-04', 'M', 3, 'saada', '66761aa1babc1.png'),
(27, 'Test mascota', NULL, 7, 2, 2, '2024-06-18 23:03:05', '2024-06-22 00:38:23', 0, '2024-06-04', 'M', 3, 'saada', '66761aa1babc1.png'),
(28, 'Test mascota', NULL, 7, 2, NULL, '2024-06-18 23:03:25', '2024-06-22 00:38:23', 1, '2024-06-04', 'M', 3, 'saada', '66761aa1babc1.png'),
(29, 'Test mascota', NULL, 7, 2, 2, '2024-06-18 23:03:49', '2024-06-22 00:38:23', 0, '2024-06-04', 'M', 3, 'saada', '66761aa1babc1.png'),
(30, 'Test mascota', NULL, 3, 2, 2, '2024-06-18 23:05:51', '2024-06-22 00:38:23', 0, '2024-06-18', 'M', 4, '', '66761aa1babc1.png'),
(31, 'test', NULL, 7, 2, 2, '2024-06-18 23:08:17', '2024-06-22 00:38:23', 0, '2024-06-18', 'M', 3, 'test', '66761aa1babc1.png'),
(32, 'Test mascota', NULL, 3, 2, 2, '2024-06-18 23:19:05', '2024-06-22 00:38:23', 0, '2024-05-09', 'M', 2, '', '66761aa1babc1.png'),
(33, 'Test mascota', NULL, 3, 2, 2, '2024-06-18 23:20:48', '2024-06-22 00:38:23', 0, '2024-04-11', 'M', 4, '', '66761aa1babc1.png'),
(34, 'Test mascota', NULL, 3, 2, 2, '2024-06-18 23:22:43', '2024-06-22 00:38:23', 0, '2024-06-18', 'M', 1, '', '66761aa1babc1.png'),
(35, 'hola', NULL, 3, 2, 2, '2024-06-19 00:05:08', '2024-06-22 00:38:23', 0, '2024-06-18', 'F', 1, 'test', '66761aa1babc1.png'),
(36, 'Test mascota', NULL, 3, 2, 2, '2024-06-19 00:07:09', '2024-06-22 00:38:23', 0, '2024-06-18', 'M', 3, '', '66761aa1babc1.png'),
(37, 'misu 2', NULL, 4, 2, NULL, '2024-06-21 23:09:28', '2024-06-22 00:38:23', 1, '2024-05-29', 'F', 2, '', '66761aa1babc1.png'),
(38, 'hola', NULL, 4, 2, NULL, '2024-06-22 00:28:17', '2024-06-22 00:28:17', 1, '2024-05-28', 'F', 1, 'test', '66761aa1babc1.png'),
(39, 'Test mascota', NULL, 7, 2, NULL, '2024-06-22 00:40:39', '2024-06-22 00:40:39', 1, '2024-05-02', 'M', 4, '', '66761d877d7cd.jpg'),
(40, 'MASCOTA 1', NULL, 6, 2, NULL, '2024-06-22 02:26:59', '2024-06-22 02:26:59', 1, '2024-06-06', 'M', 1, '', ''),
(41, 'MASCOTA 1', NULL, 3, 2, NULL, '2024-06-22 02:27:40', '2024-06-22 02:27:40', 1, '2024-06-21', 'M', 1, 'TEST', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE `perfil` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`id`, `nombre`, `estado`) VALUES
(1, 'Administrador', 1),
(2, 'Veterinario', 1),
(3, 'Recepcionista', 1),
(4, 'Inventario', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `peso`
--

CREATE TABLE `peso` (
  `id` int(11) NOT NULL,
  `id_mascota` int(11) NOT NULL,
  `peso` decimal(5,2) NOT NULL,
  `creado_por` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `peso`
--

INSERT INTO `peso` (`id`, `id_mascota`, `peso`, `creado_por`, `created_at`) VALUES
(1, 1, '30.00', 2, '2024-06-18 02:11:27'),
(2, 2, '20.00', 2, '2024-06-18 02:11:27'),
(3, 3, '30.20', 2, '2024-06-18 02:11:27'),
(4, 4, '30.00', 2, '2024-06-18 02:11:27'),
(5, 5, '50.00', 2, '2024-06-19 02:11:27'),
(6, 7, '999.99', 2, '2024-06-18 22:45:24'),
(7, 8, '999.99', 2, '2024-06-18 22:46:19'),
(8, 9, '999.99', 2, '2024-06-18 22:46:30'),
(9, 10, '999.99', 2, '2024-06-18 22:46:39'),
(10, 11, '999.99', 2, '2024-06-18 22:48:27'),
(11, 12, '999.99', 2, '2024-06-18 22:50:48'),
(12, 13, '999.99', 2, '2024-06-18 22:51:06'),
(13, 14, '50.00', 2, '2024-06-18 22:52:57'),
(14, 15, '50.00', 2, '2024-06-18 22:53:26'),
(15, 16, '50.00', 2, '2024-06-18 22:57:19'),
(16, 17, '50.00', 2, '2024-06-18 22:58:12'),
(17, 18, '50.00', 2, '2024-06-18 22:59:47'),
(18, 19, '50.00', 2, '2024-06-18 23:00:37'),
(19, 20, '50.00', 2, '2024-06-18 23:01:38'),
(20, 21, '50.00', 2, '2024-06-18 23:01:57'),
(21, 22, '50.00', 2, '2024-06-18 23:02:06'),
(22, 23, '50.00', 2, '2024-06-18 23:02:26'),
(23, 24, '50.00', 2, '2024-06-18 23:02:37'),
(24, 25, '50.00', 2, '2024-06-18 23:02:53'),
(25, 26, '50.00', 2, '2024-06-18 23:03:00'),
(26, 27, '50.00', 2, '2024-06-18 23:03:05'),
(27, 28, '50.00', 2, '2024-06-18 23:03:25'),
(28, 29, '50.00', 2, '2024-06-18 23:03:49'),
(29, 30, '50.00', 2, '2024-06-18 23:05:52'),
(30, 31, '50.00', 2, '2024-06-18 23:08:17'),
(31, 32, '50.00', 2, '2024-06-18 23:19:05'),
(32, 33, '50.00', 2, '2024-06-18 23:20:49'),
(33, 34, '50.00', 2, '2024-06-18 23:22:43'),
(34, 35, '50.00', 2, '2024-06-19 00:05:08'),
(35, 36, '50.00', 2, '2024-06-19 00:07:09'),
(36, 37, '12.00', 2, '2024-06-21 23:09:28'),
(37, 38, '50.00', 2, '2024-06-22 00:28:17'),
(38, 39, '50.00', 2, '2024-06-22 00:40:39'),
(39, 40, '999.99', 2, '2024-06-22 02:27:00'),
(40, 41, '50.00', 2, '2024-06-22 02:27:41');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `creado_por` int(11) DEFAULT NULL,
  `actualizado_por` int(11) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `raza`
--

CREATE TABLE `raza` (
  `id` int(11) NOT NULL,
  `nombre` varchar(120) NOT NULL,
  `estado` int(11) NOT NULL,
  `id_especie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `raza`
--

INSERT INTO `raza` (`id`, `nombre`, `estado`, `id_especie`) VALUES
(1, 'Labrador', 1, 1),
(2, 'Siamés', 1, 2),
(3, 'Pastor Alemán', 1, 1),
(4, 'Mestizo', 1, 2),
(5, 'Beagle', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE `servicio` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `estado` int(11) DEFAULT NULL,
  `creado_por` int(11) DEFAULT NULL,
  `actualizado_por` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `servicio`
--

INSERT INTO `servicio` (`id`, `nombre`, `descripcion`, `precio`, `estado`, `creado_por`, `actualizado_por`, `created_at`, `updated_at`) VALUES
(1, 'Baño', 'Baño y cuidado básico de la mascota', '30.00', 1, 2, NULL, '2024-06-12 19:50:56', '2024-06-12 19:50:56'),
(2, 'Consulta', 'Consulta veterinaria para revisión de salud de la mascota', '50.00', 1, 2, NULL, '2024-06-12 19:50:56', '2024-06-12 19:50:56'),
(3, 'Vacunación', 'Vacunación contra enfermedades comunes en mascotas', '40.00', 1, 2, NULL, '2024-06-12 19:50:57', '2024-06-12 19:50:57'),
(4, 'Corte de uñas', 'Corte de uñas para prevenir problemas de salud', '20.00', 1, 2, NULL, '2024-06-12 19:50:57', '2024-06-12 19:50:57'),
(5, 'Desparasitación', 'Tratamiento para eliminar parásitos internos y externos', '35.00', 1, 2, NULL, '2024-06-12 19:50:57', '2024-06-12 19:50:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_cita`
--

CREATE TABLE `tipo_cita` (
  `id` int(11) NOT NULL,
  `nombre` varchar(120) NOT NULL,
  `clase` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipo_cita`
--

INSERT INTO `tipo_cita` (`id`, `nombre`, `clase`) VALUES
(1, 'Agendada', 'bg-primary'),
(2, 'En Espera', 'bg-secondary');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_documento`
--

CREATE TABLE `tipo_documento` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipo_documento`
--

INSERT INTO `tipo_documento` (`id`, `nombre`) VALUES
(2, 'Carnet Extranjeria'),
(1, 'D.N.I.'),
(4, 'Pasaporte'),
(3, 'R.U.C.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `status` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `mail` varchar(120) NOT NULL,
  `date_creation` datetime NOT NULL DEFAULT current_timestamp(),
  `date_update` datetime NOT NULL DEFAULT current_timestamp(),
  `document` varchar(100) NOT NULL,
  `type_doc` int(11) NOT NULL,
  `id_perfil` int(11) DEFAULT NULL,
  `imagen` varchar(250) NOT NULL,
  `creado_por` int(11) NOT NULL,
  `actualizado_por` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `status`, `name`, `lastname`, `phone`, `mail`, `date_creation`, `date_update`, `document`, `type_doc`, `id_perfil`, `imagen`, `creado_por`, `actualizado_por`) VALUES
(2, 'admin', '$2y$10$YPP8I0G8n34GvNUo19lpYuilVHQ2kmeAl1bSvJja2gTQkZFBUV0Ue', 1, 'Anderson', 'Romer', '123456789', 'andersonromeroloarte@gmail.com', '2024-06-11 12:31:56', '2024-06-11 12:31:56', '12345678', 1, 1, 'img/usuarios/2.png', 2, NULL),
(3, 'vet1', '$2y$10$TGDbvDvRAPi4D3R1dG5ZDujn4p.O0OOeU5MNGqYPxfvffqAJ3M3xG', 1, 'Ronald', 'Mancilla', '123456789', 'ronald@gmail.com', '2024-06-12 14:25:38', '2024-06-12 14:25:38', '12345678', 1, 2, 'img/usuarios/3.png', 2, NULL),
(4, 'vet2', '$2y$10$vKWhon9tvcDNLuYaUnBvXO1rvPJHdGx/oe5Ew2guMT6LHDqFezDd2', 1, 'Maria', 'Perez', '123456789', 'maria@gmail.com', '2024-06-12 14:26:27', '2024-06-20 17:01:33', '12345678', 1, 2, 'img/usuarios/4.png', 2, 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `altura`
--
ALTER TABLE `altura`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_mascota` (`id_mascota`),
  ADD KEY `creado_por` (`creado_por`);

--
-- Indices de la tabla `atencion`
--
ALTER TABLE `atencion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cita` (`id_cita`),
  ADD KEY `id_mascota` (`id_mascota`),
  ADD KEY `creado_por` (`creado_por`),
  ADD KEY `actualizado_por` (`actualizado_por`),
  ADD KEY `id_estadoatencion` (`id_estadoatencion`),
  ADD KEY `veterinario` (`veterinario`);

--
-- Indices de la tabla `atencion_producto`
--
ALTER TABLE `atencion_producto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_atencion` (`id_atencion`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `atencion_servicio`
--
ALTER TABLE `atencion_servicio`
  ADD PRIMARY KEY (`id_atencion`,`id_servicio`),
  ADD KEY `id_servicio` (`id_servicio`);

--
-- Indices de la tabla `cita`
--
ALTER TABLE `cita`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_mascota` (`id_mascota`),
  ADD KEY `id_hora` (`id_hora`),
  ADD KEY `creado_por` (`creado_por`),
  ADD KEY `actualizado_por` (`actualizado_por`),
  ADD KEY `created_at` (`created_at`),
  ADD KEY `id_estadocita` (`id_estadocita`),
  ADD KEY `id_tipocita` (`id_tipocita`);

--
-- Indices de la tabla `cita_servicio`
--
ALTER TABLE `cita_servicio`
  ADD PRIMARY KEY (`id_cita`,`id_servicio`),
  ADD KEY `id_servicio` (`id_servicio`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo` (`correo`),
  ADD KEY `creado_por` (`creado_por`),
  ADD KEY `actualizado_por` (`actualizado_por`),
  ADD KEY `tipo_documento_id` (`tipo_documento_id`);

--
-- Indices de la tabla `especie`
--
ALTER TABLE `especie`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estadoatencion`
--
ALTER TABLE `estadoatencion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estadocita`
--
ALTER TABLE `estadocita`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `lista_horas`
--
ALTER TABLE `lista_horas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mascota`
--
ALTER TABLE `mascota`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `creado_por` (`creado_por`),
  ADD KEY `actualizado_por` (`actualizado_por`),
  ADD KEY `id_raza` (`id_raza`);

--
-- Indices de la tabla `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `peso`
--
ALTER TABLE `peso`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_mascota` (`id_mascota`),
  ADD KEY `creado_por` (`creado_por`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `creado_por` (`creado_por`),
  ADD KEY `actualizado_por` (`actualizado_por`);

--
-- Indices de la tabla `raza`
--
ALTER TABLE `raza`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_especie` (`id_especie`);

--
-- Indices de la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `servicio_ibfk_1` (`creado_por`),
  ADD KEY `servicio_ibfk_2` (`actualizado_por`);

--
-- Indices de la tabla `tipo_cita`
--
ALTER TABLE `tipo_cita`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_perfil` (`id_perfil`),
  ADD KEY `fk_tipodoc` (`type_doc`),
  ADD KEY `creado_por` (`creado_por`),
  ADD KEY `actualizado_por` (`actualizado_por`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `altura`
--
ALTER TABLE `altura`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `atencion`
--
ALTER TABLE `atencion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `atencion_producto`
--
ALTER TABLE `atencion_producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cita`
--
ALTER TABLE `cita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `especie`
--
ALTER TABLE `especie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `estadoatencion`
--
ALTER TABLE `estadoatencion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `estadocita`
--
ALTER TABLE `estadocita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `lista_horas`
--
ALTER TABLE `lista_horas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `mascota`
--
ALTER TABLE `mascota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de la tabla `perfil`
--
ALTER TABLE `perfil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `peso`
--
ALTER TABLE `peso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `raza`
--
ALTER TABLE `raza`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `servicio`
--
ALTER TABLE `servicio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tipo_cita`
--
ALTER TABLE `tipo_cita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `altura`
--
ALTER TABLE `altura`
  ADD CONSTRAINT `altura_ibfk_1` FOREIGN KEY (`id_mascota`) REFERENCES `mascota` (`id`),
  ADD CONSTRAINT `altura_ibfk_2` FOREIGN KEY (`creado_por`) REFERENCES `user` (`id`);

--
-- Filtros para la tabla `atencion`
--
ALTER TABLE `atencion`
  ADD CONSTRAINT `atencion_ibfk_1` FOREIGN KEY (`id_cita`) REFERENCES `cita` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `atencion_ibfk_2` FOREIGN KEY (`id_mascota`) REFERENCES `mascota` (`id`),
  ADD CONSTRAINT `atencion_ibfk_3` FOREIGN KEY (`creado_por`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `atencion_ibfk_4` FOREIGN KEY (`actualizado_por`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `atencion_ibfk_5` FOREIGN KEY (`id_estadoatencion`) REFERENCES `estadoatencion` (`id`),
  ADD CONSTRAINT `atencion_ibfk_6` FOREIGN KEY (`veterinario`) REFERENCES `user` (`id`);

--
-- Filtros para la tabla `atencion_producto`
--
ALTER TABLE `atencion_producto`
  ADD CONSTRAINT `atencion_producto_ibfk_1` FOREIGN KEY (`id_atencion`) REFERENCES `atencion` (`id`),
  ADD CONSTRAINT `atencion_producto_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id`);

--
-- Filtros para la tabla `atencion_servicio`
--
ALTER TABLE `atencion_servicio`
  ADD CONSTRAINT `atencion_servicio_ibfk_1` FOREIGN KEY (`id_atencion`) REFERENCES `atencion` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `atencion_servicio_ibfk_2` FOREIGN KEY (`id_servicio`) REFERENCES `servicio` (`id`);

--
-- Filtros para la tabla `cita`
--
ALTER TABLE `cita`
  ADD CONSTRAINT `cita_ibfk_1` FOREIGN KEY (`id_mascota`) REFERENCES `mascota` (`id`),
  ADD CONSTRAINT `cita_ibfk_3` FOREIGN KEY (`id_hora`) REFERENCES `lista_horas` (`id`),
  ADD CONSTRAINT `cita_ibfk_5` FOREIGN KEY (`creado_por`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `cita_ibfk_6` FOREIGN KEY (`actualizado_por`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `cita_ibfk_7` FOREIGN KEY (`id_estadocita`) REFERENCES `estadocita` (`id`),
  ADD CONSTRAINT `cita_ibfk_8` FOREIGN KEY (`id_tipocita`) REFERENCES `tipo_cita` (`id`);

--
-- Filtros para la tabla `cita_servicio`
--
ALTER TABLE `cita_servicio`
  ADD CONSTRAINT `cita_servicio_ibfk_1` FOREIGN KEY (`id_cita`) REFERENCES `cita` (`id`),
  ADD CONSTRAINT `cita_servicio_ibfk_2` FOREIGN KEY (`id_servicio`) REFERENCES `servicio` (`id`);

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`creado_por`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `cliente_ibfk_2` FOREIGN KEY (`actualizado_por`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `cliente_ibfk_3` FOREIGN KEY (`tipo_documento_id`) REFERENCES `tipo_documento` (`id`);

--
-- Filtros para la tabla `mascota`
--
ALTER TABLE `mascota`
  ADD CONSTRAINT `mascota_ibfk_2` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id`),
  ADD CONSTRAINT `mascota_ibfk_3` FOREIGN KEY (`creado_por`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `mascota_ibfk_4` FOREIGN KEY (`actualizado_por`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `mascota_ibfk_5` FOREIGN KEY (`id_raza`) REFERENCES `raza` (`id`);

--
-- Filtros para la tabla `peso`
--
ALTER TABLE `peso`
  ADD CONSTRAINT `peso_ibfk_1` FOREIGN KEY (`id_mascota`) REFERENCES `mascota` (`id`),
  ADD CONSTRAINT `peso_ibfk_2` FOREIGN KEY (`creado_por`) REFERENCES `user` (`id`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`creado_por`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`actualizado_por`) REFERENCES `user` (`id`);

--
-- Filtros para la tabla `raza`
--
ALTER TABLE `raza`
  ADD CONSTRAINT `raza_ibfk_1` FOREIGN KEY (`id_especie`) REFERENCES `especie` (`id`);

--
-- Filtros para la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD CONSTRAINT `servicio_ibfk_1` FOREIGN KEY (`creado_por`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `servicio_ibfk_2` FOREIGN KEY (`actualizado_por`) REFERENCES `user` (`id`);

--
-- Filtros para la tabla `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_perfil` FOREIGN KEY (`id_perfil`) REFERENCES `perfil` (`id`),
  ADD CONSTRAINT `fk_tipodoc` FOREIGN KEY (`type_doc`) REFERENCES `tipo_documento` (`id`),
  ADD CONSTRAINT `user_ibfk_3` FOREIGN KEY (`creado_por`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `user_ibfk_4` FOREIGN KEY (`actualizado_por`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
