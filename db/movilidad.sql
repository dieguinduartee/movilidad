-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-10-2022 a las 21:57:04
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 7.2.34

CREATE TABLE movilidad (
  id int(4) NOT NULL,
  actividad varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  descripcion_actividad text COLLATE utf8mb4_spanish2_ci NOT NULL,
  tipo_movilidad varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  instituto varchar(255) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  fecha_inicio date DEFAULT NULL,
  fecha_fin date DEFAULT NULL,
  ciudad varchar(255) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  author varchar(225) COLLATE utf8mb4_spanish2_ci NOT NULL,
  tipo_author VARCHAR(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  postdate date NOT NULL,
  updated_on timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  status varchar(225) COLLATE utf8mb4_spanish2_ci default 'draft',
  lugar varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  modalidad varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL
);


CREATE TABLE evidencia(
  id int(6) PRIMARY KEY AUTO_INCREMENT,
  movilidad int(4) NOT NULL,
  image text COLLATE utf8mb4_spanish2_ci NOT NULL,
  descripcion text COLLATE utf8mb4_spanish2_ci NOT NULL,
  updated_on timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  status varchar(225) COLLATE utf8mb4_spanish2_ci default 'draft'
);

CREATE TABLE users (
  id int(4) NOT NULL,
  username varchar(225) NOT NULL,
  firstname varchar(225) NOT NULL,
  lastname varchar(225) NOT NULL,
  email varchar(225) NOT NULL,
  password varchar(225) NOT NULL,
  role varchar(225) NOT NULL DEFAULT 'user'
);


INSERT INTO `users` (`id`, `username`, `firstname`, `lastname`, `email`, `password`, `role`) VALUES
(1, 'diego', 'Diego Duarte', 'Docente', 'diego_duarte@gmail.com', '$2y$10$aAmN2D98aEXP9RLxLYrMfO8JeyI8wGjM2DvSxSK37PO4HL8ZC5kdu', 'superadmin'),
(44, '1151605', 'diego alexis duarte martinez', 'Estudiante', 'diego.duartee5555@gmail.com', '$2y$10$d55Ep3nLUauN16r7N.ioieS9roBFj4tHHyyIQH4cjxsZK6H.Olx12', 'user'),
(45, '1151606', 'juan', 'Docente', 'juancarlos@gmail.com', '$2y$10$QTvR3tFDAfg7U4hrX1D86OYcOWp2YDSzSrE7UKDePVCXKKFZh3jUq', 'admin'),
(46, '1151604', 'MARIA FERNANDA MARTINEZ', 'Estudiante', 'maria@gmail.com', '$2y$10$p7yxasQztmA7bQxiZ0yXvu//kb47uGQgPNCwRfR4qrSOAei/kE1um', 'user'),
(47, '1151337', 'Luis Vicente Albarracin', 'Estudiante', 'luis@gmail.com', '$2y$10$aAmN2D98aEXP9RLxLYrMfO8JeyI8wGjM2DvSxSK37PO4HL8ZC5kdu', 'user');


ALTER TABLE `movilidad`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

ALTER TABLE `movilidad`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

ALTER TABLE `users`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

ALTER TABLE evidencia
  ADD CONSTRAINT evidencia_movilidad_fk FOREIGN KEY (movilidad) REFERENCES movilidad(id);
