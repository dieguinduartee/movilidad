-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-10-2022 a las 21:57:04
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `latest`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `posts`
--

CREATE TABLE `posts` (
  `id` int(4) NOT NULL,
  `actividad` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `descripcion_actividad` text COLLATE utf8mb4_spanish2_ci NOT NULL,
  `tipo_movilidad` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `instituto` varchar(255) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `ciudad` varchar(255) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `author` varchar(225) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `postdate` date NOT NULL,
  `image` text COLLATE utf8mb4_spanish2_ci NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(225) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `lugar` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL DEFAULT 'nacional',
  `dependencia` varchar(255) COLLATE utf8mb4_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `posts`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(4) NOT NULL,
  `username` varchar(225) NOT NULL,
  `firstname` varchar(225) NOT NULL,
  `lastname` varchar(225) NOT NULL,
  `email` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL,
  `role` varchar(225) NOT NULL DEFAULT 'user'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `firstname`, `lastname`, `email`, `password`, `role`) VALUES
(1, 'diego', 'Diego Alexis', 'Docente', 'admin@gmail.com', '$2y$10$aAmN2D98aEXP9RLxLYrMfO8JeyI8wGjM2DvSxSK37PO4HL8ZC5kdu', 'superadmin'),
(44, '1151605', 'diego alexis duarte martinez', 'Estudiante', 'diego.duartee5555@gmail.com', '$2y$10$d55Ep3nLUauN16r7N.ioieS9roBFj4tHHyyIQH4cjxsZK6H.Olx12', 'user'),
(45, '1151606', 'juan', 'Docente', 'juancarlos@gmail.com', '$2y$10$QTvR3tFDAfg7U4hrX1D86OYcOWp2YDSzSrE7UKDePVCXKKFZh3jUq', 'admin'),
(46, '1151604', 'MARIA FERNANDA MARTINEZ', 'Estudiante', 'maria@gmail.com', '$2y$10$p7yxasQztmA7bQxiZ0yXvu//kb47uGQgPNCwRfR4qrSOAei/kE1um', 'user'),
(47, 'luis', 'luis', 'Estudiante', 'luis@gmail.com', '$2y$10$Ckn10CJB9LUX/QSHgoQEd.tLCx7.D/MpG6wsUzk0F.uM9hT0Jn/RG', 'user');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
