-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2024 at 08:25 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `refiasa`
--

-- --------------------------------------------------------

--
-- Table structure for table `atencion`
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
-- Dumping data for table `atencion`
--

INSERT INTO `atencion` (`id`, `id_cita`, `id_mascota`, `descripcion`, `observaciones`, `diagnosticos`, `tratamiento`, `fecha`, `creado_por`, `actualizado_por`, `created_at`, `updated_at`, `estado`, `id_estadoatencion`, `veterinario`) VALUES
(1, 2, 1, 'Consulta de seguimiento', 'Control de evolución post-tratamiento\r\n', 'Gastroenteritis leve.', 'Antibióticos prescritos por 5 días y dieta blanda recomendada.', '2024-06-12 15:00:00', 2, NULL, '2024-06-13 00:58:31', '2024-06-13 01:00:06', 1, 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `atencion_servicio`
--

CREATE TABLE `atencion_servicio` (
  `id_atencion` int(11) NOT NULL,
  `id_servicio` int(11) NOT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `atencion_servicio`
--

INSERT INTO `atencion_servicio` (`id_atencion`, `id_servicio`, `descripcion`) VALUES
(1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cita`
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
-- Dumping data for table `cita`
--

INSERT INTO `cita` (`id`, `id_mascota`, `creado_por`, `id_hora`, `fecha`, `descripcion`, `created_at`, `updated_at`, `estado`, `actualizado_por`, `id_estadocita`, `comentario`, `id_tipocita`) VALUES
(2, 1, 2, 3, '2024-06-13', 'Cita para vacunación anual y revisión de salud', '2024-06-12 20:02:31', '2024-06-14 01:17:33', 1, NULL, 1, '', 1),
(3, 2, 2, 4, '2024-06-13', 'Cita para vacunación anual y revisión de salud', '2024-06-12 20:03:40', '2024-06-14 01:17:37', 1, NULL, 1, '', 1),
(5, 3, 2, 19, '2024-06-14', 'TEST', '2024-06-14 17:26:47', '2024-06-14 17:26:47', 1, NULL, 1, 'TEST', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cita_servicio`
--

CREATE TABLE `cita_servicio` (
  `id_cita` int(11) NOT NULL,
  `id_servicio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cita_servicio`
--

INSERT INTO `cita_servicio` (`id_cita`, `id_servicio`) VALUES
(2, 1),
(3, 4);

-- --------------------------------------------------------

--
-- Table structure for table `cliente`
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
-- Dumping data for table `cliente`
--

INSERT INTO `cliente` (`id`, `nombre`, `apellido_paterno`, `apellido_materno`, `direccion`, `telefono`, `correo`, `creado_por`, `actualizado_por`, `documento`, `tipo_documento_id`, `created_at`, `updated_at`, `estado`, `fecha_nac`, `sexo`) VALUES
(3, 'Juan', 'Pérez', 'Gómez', 'Calle 123', '12345678', 'juan@example.com', 2, NULL, '12345678', 1, '2024-06-12 00:54:29', '2024-06-12 22:58:28', 1, '1995-05-05', 'M'),
(4, 'María', 'López', 'Martínez', 'Avenida 456', '23456789', 'maria@example.com', 2, NULL, '87654321', 1, '2024-06-12 00:54:29', '2024-06-12 22:58:52', 1, '1995-05-05', 'F'),
(5, 'Carlos', 'García', 'Hernández', 'Calle Principal', '34567890', 'carlos@example.com', 2, NULL, '65432187', 1, '2024-06-12 00:54:29', '2024-06-12 22:58:55', 1, '1995-05-05', 'M'),
(6, 'Laura', 'Rodríguez', 'Díaz', 'Avenida Central', '45678901', 'laura@example.com', 2, NULL, '43218765', 1, '2024-06-12 00:54:29', '2024-06-12 22:59:04', 1, '1995-05-05', 'F'),
(7, 'Pedro', 'Martínez', 'Gómez', 'Calle Secundaria', '56789012', 'pedro@example.com', 2, NULL, '21876543', 1, '2024-06-12 00:54:29', '2024-06-12 22:59:02', 1, '1995-05-05', 'M');

-- --------------------------------------------------------

--
-- Table structure for table `especie`
--

CREATE TABLE `especie` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `especie`
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
-- Table structure for table `estadoatencion`
--

CREATE TABLE `estadoatencion` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `clasecolor` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `estadoatencion`
--

INSERT INTO `estadoatencion` (`id`, `nombre`, `clasecolor`) VALUES
(1, 'atendido', 'bg-success'),
(2, 'pendiente', 'bg-warning'),
(3, 'terminado', 'bg-info');

-- --------------------------------------------------------

--
-- Table structure for table `estadocita`
--

CREATE TABLE `estadocita` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `clasecolor` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `estadocita`
--

INSERT INTO `estadocita` (`id`, `nombre`, `clasecolor`) VALUES
(1, 'Pendiente', 'bg-warning'),
(2, 'Asistida', 'bg-success'),
(3, 'Reprogramada', 'bg-info'),
(4, 'No asistida', 'bg-danger'),
(5, 'Cancelada', 'bg-danger');

-- --------------------------------------------------------

--
-- Table structure for table `lista_horas`
--

CREATE TABLE `lista_horas` (
  `id` int(11) NOT NULL,
  `hora` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lista_horas`
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
-- Table structure for table `mascota`
--

CREATE TABLE `mascota` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `especie_id` int(11) NOT NULL,
  `raza` varchar(50) DEFAULT NULL,
  `edad` int(11) DEFAULT NULL,
  `peso` decimal(5,2) DEFAULT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `creado_por` int(11) DEFAULT NULL,
  `actualizado_por` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `estado` int(11) NOT NULL,
  `fecha_nac` date DEFAULT NULL,
  `sexo` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mascota`
--

INSERT INTO `mascota` (`id`, `nombre`, `especie_id`, `raza`, `edad`, `peso`, `id_cliente`, `creado_por`, `actualizado_por`, `created_at`, `updated_at`, `estado`, `fecha_nac`, `sexo`) VALUES
(1, 'Firulais', 1, 'Labrador', 5, '30.50', 3, 2, NULL, '2024-06-12 17:18:40', '2024-06-12 22:59:42', 1, '2020-05-06', 'M'),
(2, 'Misu', 2, 'Siamés', 3, '4.20', 4, 2, NULL, '2024-06-12 17:18:40', '2024-06-12 22:59:43', 1, '2020-05-06', 'F'),
(3, 'Rex', 1, 'Pastor Alemán', 4, '35.00', 5, 2, NULL, '2024-06-12 17:18:40', '2024-06-12 22:59:47', 1, '2020-05-06', 'M'),
(4, 'Luna', 2, 'Mestizo', 2, '3.50', 6, 2, NULL, '2024-06-12 17:18:40', '2024-06-12 22:59:49', 1, '2020-05-06', 'F'),
(5, 'Toby', 1, 'Beagle', 7, '12.00', 3, 2, NULL, '2024-06-12 17:18:40', '2024-06-12 22:59:51', 1, '2020-05-06', 'M');

-- --------------------------------------------------------

--
-- Table structure for table `perfil`
--

CREATE TABLE `perfil` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `perfil`
--

INSERT INTO `perfil` (`id`, `nombre`, `estado`) VALUES
(1, 'Administrador', 1),
(2, 'Veterinario', 1),
(3, 'Recepcionista', 1),
(4, 'Inventario', 1);

-- --------------------------------------------------------

--
-- Table structure for table `servicio`
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
-- Dumping data for table `servicio`
--

INSERT INTO `servicio` (`id`, `nombre`, `descripcion`, `precio`, `estado`, `creado_por`, `actualizado_por`, `created_at`, `updated_at`) VALUES
(1, 'Baño', 'Baño y cuidado básico de la mascota', '30.00', 1, 2, NULL, '2024-06-12 19:50:56', '2024-06-12 19:50:56'),
(2, 'Consulta', 'Consulta veterinaria para revisión de salud de la mascota', '50.00', 1, 2, NULL, '2024-06-12 19:50:56', '2024-06-12 19:50:56'),
(3, 'Vacunación', 'Vacunación contra enfermedades comunes en mascotas', '40.00', 1, 2, NULL, '2024-06-12 19:50:57', '2024-06-12 19:50:57'),
(4, 'Corte de uñas', 'Corte de uñas para prevenir problemas de salud', '20.00', 1, 2, NULL, '2024-06-12 19:50:57', '2024-06-12 19:50:57'),
(5, 'Desparasitación', 'Tratamiento para eliminar parásitos internos y externos', '35.00', 1, 2, NULL, '2024-06-12 19:50:57', '2024-06-12 19:50:57');

-- --------------------------------------------------------

--
-- Table structure for table `tipo_cita`
--

CREATE TABLE `tipo_cita` (
  `id` int(11) NOT NULL,
  `nombre` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tipo_cita`
--

INSERT INTO `tipo_cita` (`id`, `nombre`) VALUES
(1, 'Agendada'),
(2, 'Intermitente');

-- --------------------------------------------------------

--
-- Table structure for table `tipo_documento`
--

CREATE TABLE `tipo_documento` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tipo_documento`
--

INSERT INTO `tipo_documento` (`id`, `nombre`) VALUES
(2, 'Carnet Extranjeria'),
(1, 'D.N.I.'),
(4, 'Pasaporte'),
(3, 'R.U.C.');

-- --------------------------------------------------------

--
-- Table structure for table `user`
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
  `imagen` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `status`, `name`, `lastname`, `phone`, `mail`, `date_creation`, `date_update`, `document`, `type_doc`, `id_perfil`, `imagen`) VALUES
(2, 'admin', '$2y$10$YPP8I0G8n34GvNUo19lpYuilVHQ2kmeAl1bSvJja2gTQkZFBUV0Ue', 1, 'Anderson', 'Romer', '123456789', 'andersonromeroloarte@gmail.com', '2024-06-11 12:31:56', '2024-06-11 12:31:56', '12345678', 1, 1, 'img/usuarios/2.png'),
(3, 'vet1', '$2y$10$TGDbvDvRAPi4D3R1dG5ZDujn4p.O0OOeU5MNGqYPxfvffqAJ3M3xG', 1, 'Ronald', 'Mancilla', '123456789', 'ronald@gmail.com', '2024-06-12 14:25:38', '2024-06-12 14:25:38', '12345678', 1, 2, 'img/usuarios/3.png'),
(4, 'vet2', '$2y$10$vKWhon9tvcDNLuYaUnBvXO1rvPJHdGx/oe5Ew2guMT6LHDqFezDd2', 1, 'Maria', 'Perez', '123456789', 'maria@gmail.com', '2024-06-12 14:26:27', '2024-06-12 14:26:27', '12345678', 1, 2, 'img/usuarios/4.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `atencion`
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
-- Indexes for table `atencion_servicio`
--
ALTER TABLE `atencion_servicio`
  ADD PRIMARY KEY (`id_atencion`,`id_servicio`),
  ADD KEY `id_servicio` (`id_servicio`);

--
-- Indexes for table `cita`
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
-- Indexes for table `cita_servicio`
--
ALTER TABLE `cita_servicio`
  ADD PRIMARY KEY (`id_cita`,`id_servicio`),
  ADD KEY `id_servicio` (`id_servicio`);

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo` (`correo`),
  ADD KEY `creado_por` (`creado_por`),
  ADD KEY `actualizado_por` (`actualizado_por`),
  ADD KEY `tipo_documento_id` (`tipo_documento_id`);

--
-- Indexes for table `especie`
--
ALTER TABLE `especie`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `estadoatencion`
--
ALTER TABLE `estadoatencion`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `estadocita`
--
ALTER TABLE `estadocita`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lista_horas`
--
ALTER TABLE `lista_horas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mascota`
--
ALTER TABLE `mascota`
  ADD PRIMARY KEY (`id`),
  ADD KEY `especie_id` (`especie_id`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `creado_por` (`creado_por`),
  ADD KEY `actualizado_por` (`actualizado_por`);

--
-- Indexes for table `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indexes for table `servicio`
--
ALTER TABLE `servicio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `servicio_ibfk_1` (`creado_por`),
  ADD KEY `servicio_ibfk_2` (`actualizado_por`);

--
-- Indexes for table `tipo_cita`
--
ALTER TABLE `tipo_cita`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tipo_documento`
--
ALTER TABLE `tipo_documento`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_perfil` (`id_perfil`),
  ADD KEY `fk_tipodoc` (`type_doc`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `atencion`
--
ALTER TABLE `atencion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cita`
--
ALTER TABLE `cita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `especie`
--
ALTER TABLE `especie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `estadoatencion`
--
ALTER TABLE `estadoatencion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `estadocita`
--
ALTER TABLE `estadocita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `lista_horas`
--
ALTER TABLE `lista_horas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `mascota`
--
ALTER TABLE `mascota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `perfil`
--
ALTER TABLE `perfil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `servicio`
--
ALTER TABLE `servicio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tipo_cita`
--
ALTER TABLE `tipo_cita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tipo_documento`
--
ALTER TABLE `tipo_documento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `atencion`
--
ALTER TABLE `atencion`
  ADD CONSTRAINT `atencion_ibfk_1` FOREIGN KEY (`id_cita`) REFERENCES `cita` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `atencion_ibfk_2` FOREIGN KEY (`id_mascota`) REFERENCES `mascota` (`id`),
  ADD CONSTRAINT `atencion_ibfk_3` FOREIGN KEY (`creado_por`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `atencion_ibfk_4` FOREIGN KEY (`actualizado_por`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `atencion_ibfk_5` FOREIGN KEY (`id_estadoatencion`) REFERENCES `estadoatencion` (`id`),
  ADD CONSTRAINT `atencion_ibfk_6` FOREIGN KEY (`veterinario`) REFERENCES `user` (`id`);

--
-- Constraints for table `atencion_servicio`
--
ALTER TABLE `atencion_servicio`
  ADD CONSTRAINT `atencion_servicio_ibfk_1` FOREIGN KEY (`id_atencion`) REFERENCES `atencion` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `atencion_servicio_ibfk_2` FOREIGN KEY (`id_servicio`) REFERENCES `servicio` (`id`);

--
-- Constraints for table `cita`
--
ALTER TABLE `cita`
  ADD CONSTRAINT `cita_ibfk_1` FOREIGN KEY (`id_mascota`) REFERENCES `mascota` (`id`),
  ADD CONSTRAINT `cita_ibfk_3` FOREIGN KEY (`id_hora`) REFERENCES `lista_horas` (`id`),
  ADD CONSTRAINT `cita_ibfk_5` FOREIGN KEY (`creado_por`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `cita_ibfk_6` FOREIGN KEY (`actualizado_por`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `cita_ibfk_7` FOREIGN KEY (`id_estadocita`) REFERENCES `estadocita` (`id`),
  ADD CONSTRAINT `cita_ibfk_8` FOREIGN KEY (`id_tipocita`) REFERENCES `tipo_cita` (`id`);

--
-- Constraints for table `cita_servicio`
--
ALTER TABLE `cita_servicio`
  ADD CONSTRAINT `cita_servicio_ibfk_1` FOREIGN KEY (`id_cita`) REFERENCES `cita` (`id`),
  ADD CONSTRAINT `cita_servicio_ibfk_2` FOREIGN KEY (`id_servicio`) REFERENCES `servicio` (`id`);

--
-- Constraints for table `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`creado_por`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `cliente_ibfk_2` FOREIGN KEY (`actualizado_por`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `cliente_ibfk_3` FOREIGN KEY (`tipo_documento_id`) REFERENCES `tipo_documento` (`id`);

--
-- Constraints for table `mascota`
--
ALTER TABLE `mascota`
  ADD CONSTRAINT `mascota_ibfk_1` FOREIGN KEY (`especie_id`) REFERENCES `especie` (`id`),
  ADD CONSTRAINT `mascota_ibfk_2` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id`),
  ADD CONSTRAINT `mascota_ibfk_3` FOREIGN KEY (`creado_por`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `mascota_ibfk_4` FOREIGN KEY (`actualizado_por`) REFERENCES `user` (`id`);

--
-- Constraints for table `servicio`
--
ALTER TABLE `servicio`
  ADD CONSTRAINT `servicio_ibfk_1` FOREIGN KEY (`creado_por`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `servicio_ibfk_2` FOREIGN KEY (`actualizado_por`) REFERENCES `user` (`id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_perfil` FOREIGN KEY (`id_perfil`) REFERENCES `perfil` (`id`),
  ADD CONSTRAINT `fk_tipodoc` FOREIGN KEY (`type_doc`) REFERENCES `tipo_documento` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
