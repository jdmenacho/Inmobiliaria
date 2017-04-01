-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 06, 2017 at 11:00 
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inmobex`
--

-- --------------------------------------------------------

--
-- Table structure for table `empleados`
--

CREATE TABLE `empleados` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_usuario` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `empleados`
--

INSERT INTO `empleados` (`id`, `id_usuario`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `imagenes_inmuebles`
--

CREATE TABLE `imagenes_inmuebles` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `id_inmueble` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `imagenes_inmuebles`
--

INSERT INTO `imagenes_inmuebles` (`id`, `nombre`, `id_inmueble`) VALUES
(1, '3-1.jpg', 15),
(2, '74-1.jpg', 15),
(3, '74-1.jpg', 16),
(4, '3-1.jpg', 16),
(5, 'foto3416594.jpg', 17),
(6, '74-1.jpg', 17),
(7, '3-1.jpg', 17),
(8, '74-1.jpg', 18),
(9, 'foto3416594.jpg', 19),
(10, '74-1.jpg', 20),
(11, '3-1.jpg', 21),
(12, '3-1.jpg', 22),
(13, 'foto3416594.jpg', 23),
(14, 'joe.png', 23),
(15, 'joe.png', 24);

-- --------------------------------------------------------

--
-- Table structure for table `inmuebles`
--

CREATE TABLE `inmuebles` (
  `id` int(10) UNSIGNED NOT NULL,
  `tipo_pago` int(11) NOT NULL,
  `provincia` int(11) NOT NULL,
  `localidad` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `superficie` int(11) NOT NULL,
  `habitaciones` int(11) NOT NULL,
  `banos` int(11) NOT NULL,
  `fotos` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `garaje` tinyint(1) NOT NULL,
  `terraza` tinyint(1) NOT NULL,
  `piscina` tinyint(1) NOT NULL,
  `tipo_via` int(11) NOT NULL,
  `nombre_via` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `numero_via` int(11) NOT NULL,
  `piso` int(11) NOT NULL,
  `letra` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `codigo` int(11) NOT NULL,
  `amueblado` tinyint(1) NOT NULL,
  `calefaccion` tinyint(1) NOT NULL,
  `aire_acondicionado` tinyint(1) NOT NULL,
  `trastero` tinyint(1) NOT NULL,
  `ascensor` tinyint(1) NOT NULL,
  `precio` int(11) NOT NULL,
  `descripcion` longtext COLLATE utf8_spanish_ci NOT NULL,
  `creado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tipo_inmueble` int(11) NOT NULL,
  `titulo` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `id_usuario` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `inmuebles`
--

INSERT INTO `inmuebles` (`id`, `tipo_pago`, `provincia`, `localidad`, `superficie`, `habitaciones`, `banos`, `fotos`, `garaje`, `terraza`, `piscina`, `tipo_via`, `nombre_via`, `numero_via`, `piso`, `letra`, `codigo`, `amueblado`, `calefaccion`, `aire_acondicionado`, `trastero`, `ascensor`, `precio`, `descripcion`, `creado`, `tipo_inmueble`, `titulo`, `id_usuario`) VALUES
(15, 1, 1, 'a', 1, 1, 1, '', 0, 0, 0, 1, 'a', 1, 1, 'a', 11111, 1, 0, 0, 0, 0, 1, 'a', '0000-00-00 00:00:00', 1, 'Casa1', 2),
(16, 1, 2, 'b', 2, 2, 2, '', 0, 0, 0, 1, 'b', 2, 2, 'b', 22222, 0, 0, 1, 0, 0, 2, 'b', '0000-00-00 00:00:00', 1, 'Casa2', 3),
(17, 1, 1, 'c', 3, 3, 3, '', 0, 0, 0, 1, 'c', 3, 3, 'c', 33333, 0, 1, 0, 0, 0, 3, 'c', '2017-01-10 22:32:08', 1, 'Casa3', 4),
(18, 1, 1, 'd', 4, 4, 4, '', 0, 1, 1, 1, 'd', 4, 4, 'd', 44444, 0, 0, 0, 1, 0, 4, 'd', '2017-01-10 23:12:52', 1, 'Casa4', 7),
(19, 1, 2, 'e', 5, 5, 5, '', 1, 0, 0, 1, 'e', 5, 5, 'e', 55555, 0, 0, 0, 1, 1, 5, 'e', '2017-01-10 23:13:33', 1, 'Casa5', 6),
(20, 1, 2, 'f', 6, 6, 6, '', 1, 1, 1, 1, 'f', 6, 6, 'f', 66666, 1, 1, 1, 1, 1, 6, 'f', '2017-01-10 23:14:23', 1, 'Casa6', 8),
(21, 2, 1, 'Badajoz', 7, 7, 7, '', 0, 0, 0, 2, 'Ricardo Carapeto', 7, 7, 'g', 77777, 0, 0, 0, 0, 0, 7, 'g', '2017-01-10 23:14:58', 2, 'Casa7', 8),
(22, 1, 1, 'd', 4, 4, 4, '', 0, 1, 1, 1, 'd', 4, 4, 'd', 44444, 0, 0, 0, 1, 0, 4, 'd', '2017-01-10 23:12:52', 1, 'Casa4', 5);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `creado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `autor` int(10) UNSIGNED NOT NULL,
  `titulo` text COLLATE utf8_spanish_ci NOT NULL,
  `contenido` longtext COLLATE utf8_spanish_ci NOT NULL,
  `imagen` varchar(255) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `creado`, `autor`, `titulo`, `contenido`, `imagen`) VALUES
(1, '2017-01-14 18:43:15', 1, 'Hola mundo', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'entrada.png'),
(2, '2017-01-14 22:05:11', 1, 'Hola mundo 2', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\n\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum\r\n\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum\r\n\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum\r\n\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum\r\n\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum\r\n\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum\r\n\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', 'entrada.png'),
(3, '2017-01-15 00:13:56', 0, 'adfadf', '<p><strong>adfadf</strong></p>\r\n<p>&nbsp;</p>\r\n<p style="text-align: center;"><em><strong>adfadfadf</strong></em></p>\r\n<p style="text-align: center;">&nbsp;</p>\r\n<p style="text-align: justify;"><em><strong>adfad a fad fad fadf ad af</strong></em></p>\r\n<p style="text-align: justify;">&nbsp;</p>\r\n<h1 style="text-align: justify;"><em><strong>adfadf</strong></em></h1>', ''),
(4, '2017-01-15 10:30:38', 0, 'Prueba tinymce', '<p style="text-align: justify;"><strong>Lorem ipsum</strong> dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n<p style="text-align: justify;">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n<blockquote>\r\n<p style="text-align: right;"><em>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</em></p>\r\n</blockquote>\r\n<p><code>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</code></p>\r\n<p>&nbsp;</p>', ''),
(5, '2017-01-15 22:11:36', 0, 'asdfasd', '<p>asdfasdfasdfasdfasdfa</p>', ''),
(6, '2017-01-16 22:35:41', 0, 'asdfadf', '<p>asdfadfasdf</p>', ''),
(7, '2017-01-16 22:37:09', 0, 'asdfadf', '<p>asdfadfasdf</p>', ''),
(8, '2017-01-18 22:25:43', 0, 'asdfadsf', '<p>adfadsfad</p>', '4618-200.png'),
(18, '2017-01-18 23:13:21', 0, '1111', '<p>1111</p>', 'bg.png'),
(19, '2017-01-18 23:14:08', 0, '1111', '<p>1111</p>', 'bg.png'),
(20, '2017-01-19 22:16:04', 0, 'asdfadsf', '<p>asdfadfasdf</p>', '4618-200.png'),
(21, '2017-01-19 22:20:45', 0, 'asdfadsf', '<p>asdfadfasdf</p>', '4618-200.png'),
(24, '2017-01-19 22:25:50', 0, 'asdfadsf2222222', '<p>asdfadfasdf</p>', '4618-200.png'),
(25, '2017-01-19 22:37:25', 0, 'asdfadsf', '', ''),
(26, '2017-01-19 22:37:56', 0, 'asdfad', '', ''),
(27, '2017-01-19 22:38:14', 0, 'asdfad', '', ''),
(28, '2017-01-19 23:11:18', 0, 'sfdgafdg', '<p>adgadsga</p>', '4618-200.png');

-- --------------------------------------------------------

--
-- Table structure for table `provincias`
--

CREATE TABLE `provincias` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `provincias`
--

INSERT INTO `provincias` (`id`, `nombre`) VALUES
(1, 'Badajoz'),
(2, 'Cáceres');

-- --------------------------------------------------------

--
-- Table structure for table `tipos_inmueble`
--

CREATE TABLE `tipos_inmueble` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `tipos_inmueble`
--

INSERT INTO `tipos_inmueble` (`id`, `nombre`) VALUES
(1, 'Vivienda'),
(2, 'Local'),
(3, 'Garaje');

-- --------------------------------------------------------

--
-- Table structure for table `tipos_pago`
--

CREATE TABLE `tipos_pago` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `tipos_pago`
--

INSERT INTO `tipos_pago` (`id`, `nombre`) VALUES
(1, 'Venta'),
(2, 'Mensual'),
(3, 'Trimestral'),
(4, 'Anual');

-- --------------------------------------------------------

--
-- Table structure for table `tipos_via`
--

CREATE TABLE `tipos_via` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `abreviatura` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `tipos_via`
--

INSERT INTO `tipos_via` (`id`, `nombre`, `abreviatura`) VALUES
(1, 'Calle', 'C/'),
(2, 'Avenida', 'Avda.'),
(3, 'Plaza', 'Pza.');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre_usuario` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `contrasena` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` int(11) NOT NULL,
  `administrador` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre_usuario`, `contrasena`, `nombre`, `apellidos`, `email`, `telefono`, `administrador`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin', 'admin', 'a@a.com', 666666666, NULL),
(2, 'anapar', 'e9206ffd35125ded04e3a1eb0490c2ce94268c13', 'Ana', 'Paredes', 'anapar@gmail.com', 654321234, NULL),
(3, 'pikachu', 'e4409822ba1d95bebcec2dfaf8f8b3d2e7c8291e', 'Pikachu', 'Pokemon', 'pikachu@pikachu.com', 666778899, NULL),
(4, 'char', '71fafc4e2fc1e47e234762a96b80512b6b5534c2', 'Charmander', 'Pokemon', 'char@char.com', 666554433, NULL),
(5, 'anapar', 'e9206ffd35125ded04e3a1eb0490c2ce94268c13', 'Ana', 'Paredes', 'anapar@gmail.com', 666775522, NULL),
(7, 'robustiano_segismundo', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'Robus', 'Pérez', 'robus@robus.com', 678543212, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `imagenes_inmuebles`
--
ALTER TABLE `imagenes_inmuebles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inmuebles`
--
ALTER TABLE `inmuebles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `provincias`
--
ALTER TABLE `provincias`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tipos_inmueble`
--
ALTER TABLE `tipos_inmueble`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tipos_pago`
--
ALTER TABLE `tipos_pago`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tipos_via`
--
ALTER TABLE `tipos_via`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `imagenes_inmuebles`
--
ALTER TABLE `imagenes_inmuebles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `inmuebles`
--
ALTER TABLE `inmuebles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `provincias`
--
ALTER TABLE `provincias`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tipos_inmueble`
--
ALTER TABLE `tipos_inmueble`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tipos_pago`
--
ALTER TABLE `tipos_pago`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tipos_via`
--
ALTER TABLE `tipos_via`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
