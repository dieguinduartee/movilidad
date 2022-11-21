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
(47, '1151337', 'Luis Vicente Albarracin', 'Estudiante', 'luis@gmail.com', '$2y$10$Ckn10CJB9LUX/QSHgoQEd.tLCx7.D/MpG6wsUzk0F.uM9hT0Jn/RG', 'user');


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

INSERT INTO movilidad (author,tipo_movilidad, actividad, descripcion_actividad, instituto, ciudad, modalidad, lugar) 
VALUES ('Elizabeth Ramírez Villamizar', 'Saliente', 'Semestre académico en el extrajero', 'Desarrollo de asignaturas', 'Universidad en el exterior', 'España', 'Presencial', 'Internacional'),
('Deiby Camilo Navarro Galvis','Saliente', 'Semestre académico en el extranjero', 'Desarrollo de asignaturas', 'Movilidad académica Colombia- Argentina (MACA) ASCUN-CIN Universidad Nacional de Catamarca', 'Argentina', 'Presencial', 'Internacional'),
('Edgar Jair Osorio Martínez', 'Saliente', 'Semestre Académico UFPS', 'Desarrollo de asignaturas', 'Benemérita Universidad Autónoma de Puebla', 'Mexico', 'Presencial', 'Internacional'),
('Amanda Xoxocatla Mar', 'Saliente', 'Semestre Académico UFPS', 'Desarrollo de asignaturas', 'Convenio Específico de Cooperación Interinstitucional de Movilidad Académica Colombia-México (MACMEX) ASCUN-ANUIES Instituto Tecnológico Superior de Poza Rica', 'Mexico', 'Presencial', 'Internacional'),
('Jesús Alberto Durán Juárez', 'Saliente', 'Semestre Académico UFPS', 'Desarrollo de asignaturas', 'Instituto Politécnico Nacional (IPN)', 'Mexico', 'Presencial', 'Internacional'),
('David Alejandro Tolosa Zabala', 'Saliente', 'Actividad de corta duración en el extranjero', 'Participación en la 4° Invernal Campamento de Programación Competitiva en Chile', 'Universidad Diego Portales', 'Chile', 'Presencial', 'Internacional'),
('José Manuel Salazar Meza', 'Saliente', 'Actividad de corta duración en el extranjero', 'Participación en la 4° Invernal Campamento de Programación Competitiva en Chile', 'Universidad Diego Portales', 'Chile', 'Presencial', 'Internacional'),
('Carlos Fernando Calderón Rivero', 'Saliente', 'Actividad de corta duración en el extranjero', 'Participación en la 4° Invernal Campamento de Programación Competitiva en Chile', 'Universidad Diego Portales', 'Chile', 'Presencial', 'Internacional'),
('Crisel Jazmín Ayala LLanes', 'Saliente', 'Actividad de corta duración en el extranjero', 'Participación en la 4° Invernal Campamento de Programación Competitiva en Chile', 'Universidad Diego Portales', 'Chile', 'Presencial', 'Internacional'),
('William Yesid Moreno Hernández', 'Saliente', 'Actividad de corta duración en el extranjero', 'Participación en la IX edición del evento Training Camp Argentina', 'Universidad de Buenos Aires', 'Argentina', 'Presencial', 'Internacional'),
('Brayan Fabián Godoy Ruíz', 'Saliente', 'Actividad de corta duración en el extranjero', 'Participación en la IX edición del evento Training Camp Argentina', 'Universidad de Buenos Aires', 'Argentina', 'Presencial', 'Internacional'),
('David Alejandro Tolosa Zabala', 'Saliente', 'Actividad de corta duración en el extranjero', 'Participación en la IX edición del evento Training Camp Argentina', 'Universidad de Buenos Aires', 'Argentina', 'Presencial', 'Internacional'),
('José Manuel Salazar Meza', 'Saliente', 'Actividad de corta duración en el extranjero', 'Participación en la IX edición del evento Training Camp Argentina', 'Universidad de Buenos Aires', 'Argentina', 'Presencial', 'Internacional'),
('Carlos Fernando Calderón Rivero', 'Saliente', 'Actividad de corta duración en el extranjero', 'Participación en la IX edición del evento Training Camp Argentina', 'Universidad de Buenos Aires', 'Argentina', 'Presencial', 'Internacional'),
('Crisel Jazmín Ayala LLanes', 'Saliente', 'Actividad de corta duración en el extranjero', 'Participación en la IX edición del evento Training Camp Argentina', 'Universidad de Buenos Aires', 'Argentina', 'Presencial', 'Internacional'),
('Edinsson Adrián Melo Calvo', 'Saliente', 'Semestre Académico en el extranjero', 'Desarrollo de asignaturas', 'Convenio de Intercambio Academico - Programa de Intercambio Académico Latinoamericano (PILA) ASCUN-ANUIES-CIN Universidad de Buenos Aires (UBA)', 'Argentina', 'Presencial', 'Internacional'),
('Elizabeth Ramírez Villamizar', 'Saliente', 'Actividad de corta duración en el extranjero', 'Asistencia a eventos', 'Fundación ICPC-Universidad de la Ciencias Informáticas', 'Cuba', 'Presencial', 'Internacional'),
('Brayan Sebastian Vega García', 'Saliente', 'Actividad de corta duración en el extranjero', 'Asistencia a eventos', 'Fundación ICPC-Universidad de la Ciencias Informáticas', 'Cuba', 'Presencial', 'Internacional'),
('José Manuel Salazar Mesa', 'Saliente', 'Actividad de corta duración en el extranjero', 'Asistencia a eventos', 'Fundación ICPC-Universidad de la Ciencias Informáticas', 'Cuba', 'Presencial', 'Internacional'),
('Cristian Leonardo Peñaranda Mora', 'Saliente', 'Semestre Académico en el extranjero', 'Desarrollo de asignaturas', 'Convenio Intercambio Académico Programa de Intercambio Académico Latinoamericano (PILA) ASCUN-ANUIES-CIN Universidad de Hipócrates', 'México', 'Presencial', 'Internacional'),
('Jairo Andrés Castañeda Pacheco', 'Saliente', 'Actividad de corta duración en el extranjero', 'Se planeo migrar una plataforma Moodle a la nube. La migración tuvo en cuenta la arquitectura de despliegue, el proveedor de nube, los aspectos críticos en seguridad y el impacto en los usuarios', 'REDCLARA', 'México', 'Presencial', 'Internacional'),
('José Manolo Pinzón Hernández', 'Saliente', 'Actividad de corta duración', 'Ponente (What?s massive aplicación web que implementa las API? De whatsapp para el envío de mensajería masiva) (modalidad póster)', 'Univerisidad de Santander (UDES) REDCOLSI', 'Valledupar', 'Presencial', 'Nacional');

