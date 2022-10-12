-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-10-2022 a las 00:08:14
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 7.4.29

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
  `title` varchar(225) NOT NULL,
  `author` varchar(225) NOT NULL,
  `postdate` date NOT NULL,
  `image` text NOT NULL,
  `content` text NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(225) NOT NULL,
  `tag` varchar(300) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `posts`
--

INSERT INTO `posts` (`id`, `title`, `author`, `postdate`, `image`, `content`, `updated_on`, `status`, `tag`) VALUES
(40, 'Viaje a Argentina', 'juan', '2022-10-12', '309091.png', 'liquidaci&oacute;n de comisiones del &aacute;rea comercial, armado de premios de productividad, liquidaci&oacute;n de vi&aacute;ticos seg&uacute;n convenio, armado de presupuestos.', '2022-10-12 21:37:22', 'published', 'aregentina'),
(41, 'HERMOSOS VIAJE QUE SE VIVIO EN CHILE', 'diego alexis duarte martinez', '2022-10-12', '359500.jpeg', 'UNO DE LOS MEJORES VIAJES QUE TUVIMOS UNA EXPERIENCIA UNICA AQUI VA MAS TEXTO', '2022-10-12 21:53:56', 'published', 'CHILE'),
(42, 'EXPERICIA DE CIENCIAS DE COMPUTACION EN PERU', 'diego alexis duarte martinez', '2022-10-12', '234302.jpg', 'GRAN VIAJE QUE SE VIVIO LA CIENCIA DE LA COMPUTACION', '2022-10-12 21:55:35', 'published', 'PERU');

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
(46, '1151604', 'MARIA FERNANDA MARTINEZ', 'Estudiante', 'maria@gmail.com', '$2y$10$p7yxasQztmA7bQxiZ0yXvu//kb47uGQgPNCwRfR4qrSOAei/kE1um', 'user');

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
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
