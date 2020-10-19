-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-10-2020 a las 22:03:25
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `inventario`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `area`
--

CREATE TABLE `area` (
  `id_area` int(11) NOT NULL COMMENT 'Id del area',
  `nombre_area` varchar(45) DEFAULT NULL COMMENT 'Nombre del area',
  `estado` int(1) DEFAULT 1 COMMENT 'Estado logico en sistema'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargo`
--

CREATE TABLE `cargo` (
  `id_cargo` int(11) NOT NULL COMMENT 'Id del cargo',
  `nombre_cargo` varchar(45) DEFAULT NULL COMMENT 'Nombre del cargo',
  `estado` int(1) NOT NULL DEFAULT 1 COMMENT 'Estado logico en sistema'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipo`
--

CREATE TABLE `equipo` (
  `id_equipo` int(11) NOT NULL COMMENT 'Id del equipo',
  `serial_equipo` varchar(45) NOT NULL COMMENT 'No de serial del equipo',
  `fkID_tipo_equipo` int(11) NOT NULL COMMENT 'Llave foránea del tipo de equipo',
  `fkID_marca` int(11) NOT NULL COMMENT 'Llave foranea de la marca',
  `fkID_sistema_operativo` int(11) NOT NULL COMMENT 'Llave foránea del sistema operativo.',
  `fkID_memoria` int(11) NOT NULL COMMENT 'Llave foranea de la memoria',
  `fkID_procesador` int(11) NOT NULL COMMENT 'Llave foránea del procesador.',
  `fkID_estado` int(11) NOT NULL COMMENT 'Llave foránea del estado del equipo.',
  `fkID_modelo` int(11) NOT NULL COMMENT 'Llave foránea del modelo.',
  `estado` int(1) NOT NULL DEFAULT 1 COMMENT 'Estado lógico en el sistema-'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_equipo`
--

CREATE TABLE `estado_equipo` (
  `id_estado_equipo` int(11) NOT NULL COMMENT 'Id del estado del equipo.',
  `nombre_estado_equipo` varchar(45) DEFAULT NULL COMMENT 'Nombre del estado del equipo.',
  `estado` int(1) NOT NULL DEFAULT 1 COMMENT 'Estado lógico en el sistema.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historico_equipo`
--

CREATE TABLE `historico_equipo` (
  `id_historico_equipo` int(11) NOT NULL COMMENT 'Id del histórico del equipo.',
  `fecha_historico_equipo` date NOT NULL COMMENT 'Fecha del histórico del equipo.',
  `fkID_equipo` int(11) NOT NULL COMMENT 'Llave foránea del ID del equipo.',
  `fkID_persona_entrega` int(11) NOT NULL COMMENT 'Llave foránea de la persona que entrega.',
  `fkID_persona_recibe` int(11) NOT NULL COMMENT 'Llave foránea de la persona que recibe.',
  `fkID_tipo_movimiento` int(11) NOT NULL COMMENT 'Llave foránea del tipo de movimiento.',
  `fkID_area` int(11) NOT NULL COMMENT 'Llave foranea del area.',
  `obs_historico_equipo` longtext DEFAULT NULL COMMENT 'Observaciones del histórico del equipo.',
  `conse_historico_equipo` varchar(45) DEFAULT NULL COMMENT 'Consecutivo del histórico del equipo.',
  `estado` int(1) NOT NULL DEFAULT 1 COMMENT 'Estado lógico en el sistema.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `id_inventario` int(11) NOT NULL COMMENT 'Id del inventario',
  `fkID_equipo` int(11) NOT NULL COMMENT 'Llave foránea del equipo.',
  `fkID_persona_a_cargo` int(11) NOT NULL COMMENT 'Llave foranea de la persona a cargo.',
  `fkID_area` int(11) NOT NULL COMMENT 'Llave foranea del area.',
  `obs_inventario` longtext DEFAULT NULL COMMENT 'observaciones del inventario.',
  `estado` int(1) NOT NULL DEFAULT 1 COMMENT 'Estado logico en sistema.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

CREATE TABLE `marca` (
  `id_marca` int(11) NOT NULL COMMENT 'Id de la marca',
  `nombre_marca` varchar(45) DEFAULT NULL COMMENT 'Nombre de la marca',
  `estado` int(1) DEFAULT 1 COMMENT 'Estado lógico en el sistema.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `memoria`
--

CREATE TABLE `memoria` (
  `id_memoria` int(11) NOT NULL COMMENT 'Id de la memoria',
  `nombre_memoria` varchar(45) DEFAULT NULL COMMENT 'Nombre de la memoria',
  `estado` int(1) NOT NULL DEFAULT 1 COMMENT 'Estado lógico en sistema.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modelo`
--

CREATE TABLE `modelo` (
  `id_modelo` int(11) NOT NULL COMMENT 'Id del modelo',
  `nombre_modelo` varchar(45) DEFAULT NULL COMMENT 'Nombre del modelo',
  `estado` int(1) DEFAULT 1 COMMENT 'Estado lógico en el sistema.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulo`
--

CREATE TABLE `modulo` (
  `id_modulo` int(11) NOT NULL COMMENT 'Id del modulo.',
  `nombre_modulo` varchar(45) DEFAULT NULL COMMENT 'Nombre del modulo.',
  `estado` int(1) NOT NULL DEFAULT 1 COMMENT 'Estado lógico en sistema.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id_permisos` int(11) NOT NULL COMMENT 'Id del permiso.',
  `fkID_rol` int(11) NOT NULL COMMENT 'Llave foranea del Rol.',
  `fkID_modulo` int(11) NOT NULL COMMENT 'Llave foranea del modulo.',
  `creacion` int(11) DEFAULT NULL COMMENT 'Permiso para creación.',
  `edicion` int(11) DEFAULT NULL COMMENT 'Permiso para edicion.',
  `consulta` int(11) DEFAULT NULL COMMENT 'Permiso para consulta.',
  `eliminacion` int(11) DEFAULT NULL COMMENT 'Permiso para eliminación. '
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `id_persona` int(11) NOT NULL COMMENT 'Id de la persona.',
  `nombres_persona` varchar(45) DEFAULT NULL COMMENT 'Nombres de la persona.',
  `apellidos_persona` varchar(45) DEFAULT NULL COMMENT 'Apellidos de la persona.',
  `documento_persona` varchar(45) DEFAULT NULL COMMENT 'Documento de la persona',
  `telefono_persona` varchar(45) DEFAULT NULL COMMENT 'Teléfono de la persona.',
  `celular_persona` varchar(45) DEFAULT NULL COMMENT 'Celular de la persona.',
  `email_persona` varchar(45) DEFAULT NULL COMMENT 'Email de la persona.',
  `fkID_cargo` int(11) DEFAULT NULL COMMENT 'Llave foranea del cargo.',
  `fkID_area` int(11) DEFAULT NULL COMMENT 'Llave foranea del area.',
  `estado` int(1) NOT NULL DEFAULT 1 COMMENT 'Estado logico en el sistema.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `procesador`
--

CREATE TABLE `procesador` (
  `id_procesador` int(11) NOT NULL COMMENT 'Id del procesador.',
  `nombre_procesador` varchar(45) DEFAULT NULL COMMENT 'Nombre del procesador.',
  `estado` int(1) NOT NULL DEFAULT 1 COMMENT 'Estado lógico en sistema.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id_rol` int(11) NOT NULL COMMENT 'ID del rol',
  `nombre_rol` varchar(45) DEFAULT NULL COMMENT 'Nombre del rol.',
  `estado` int(1) NOT NULL DEFAULT 1 COMMENT 'Estado lógico en el sistema.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sistema_operativo`
--

CREATE TABLE `sistema_operativo` (
  `id_sistema_operativo` int(11) NOT NULL COMMENT 'Id del sistema operativo.',
  `nombre_sistema_operativo` varchar(45) DEFAULT NULL COMMENT 'Nombre del sistema operativo.',
  `estado` int(1) DEFAULT 1 COMMENT 'Estado lógico en el sistema.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_equipo`
--

CREATE TABLE `tipo_equipo` (
  `id_tipo_equipo` int(11) NOT NULL COMMENT 'Id del tipo de equipo',
  `nombre_tipo_equipo` varchar(45) DEFAULT NULL COMMENT 'Nombre del tipo de equipo.',
  `estado` int(1) NOT NULL DEFAULT 1 COMMENT 'Estado lógico en el sistema.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_movimiento`
--

CREATE TABLE `tipo_movimiento` (
  `id_tipo_movimiento` int(11) NOT NULL COMMENT 'Id del tipo de movimiento.',
  `inicial_tipo_movimiento` varchar(45) DEFAULT NULL COMMENT 'Letras iniciales del tipo de movimiento.',
  `conse_tipo_movimieneto` varchar(45) DEFAULT NULL COMMENT 'Número consecutivo del tipo de movimiento.',
  `nombre_tipo_movimiento` varchar(45) DEFAULT NULL COMMENT 'Nombre del tipo de movimiento.',
  `estado` int(1) NOT NULL DEFAULT 1 COMMENT 'Estado lógico en el sistema.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo_movimiento`
--

INSERT INTO `tipo_movimiento` (`id_tipo_movimiento`, `inicial_tipo_movimiento`, `conse_tipo_movimieneto`, `nombre_tipo_movimiento`, `estado`) VALUES
(1, 'AE', '0', 'ASIGNACION EMPLEADO (TECNICO)', 1),
(2, 'DE', '0', 'DEVOLUCIÓN', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL COMMENT 'Id del usuario.',
  `nombre_usuario` varchar(45) DEFAULT NULL COMMENT 'Nombre del usuario.',
  `pass_usuario` varchar(45) DEFAULT NULL COMMENT 'Password del usuario.',
  `fkID_rol` int(11) NOT NULL COMMENT 'Llave foranea del rol.',
  `fkID_persona` int(11) NOT NULL COMMENT 'Llave foranea de la persona.',
  `estado` int(1) NOT NULL DEFAULT 1 COMMENT 'Estado lógico en el sistema.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`id_area`);

--
-- Indices de la tabla `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`id_cargo`);

--
-- Indices de la tabla `equipo`
--
ALTER TABLE `equipo`
  ADD PRIMARY KEY (`id_equipo`),
  ADD KEY `fkID_marca_idx` (`fkID_marca`),
  ADD KEY `fkID_sistema_operativo_idx` (`fkID_sistema_operativo`),
  ADD KEY `fkID_estado_idx` (`fkID_estado`),
  ADD KEY `fkID_procesador_idx` (`fkID_procesador`),
  ADD KEY `fkID_memoria_idx` (`fkID_memoria`),
  ADD KEY `fkID_tipo_equipo_idx` (`fkID_tipo_equipo`),
  ADD KEY `fkID_modelo_idx` (`fkID_modelo`);

--
-- Indices de la tabla `estado_equipo`
--
ALTER TABLE `estado_equipo`
  ADD PRIMARY KEY (`id_estado_equipo`);

--
-- Indices de la tabla `historico_equipo`
--
ALTER TABLE `historico_equipo`
  ADD PRIMARY KEY (`id_historico_equipo`,`fecha_historico_equipo`),
  ADD KEY `fkID_equipo_idx` (`fkID_equipo`),
  ADD KEY `fkID_persona_entrega_idx` (`fkID_persona_entrega`),
  ADD KEY `fkID_persona_recibe_idx` (`fkID_persona_recibe`),
  ADD KEY `fkID_tipo_movimiento_idx` (`fkID_tipo_movimiento`),
  ADD KEY `fkID_area_idx` (`fkID_area`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`id_inventario`),
  ADD KEY `fkID_equipo_idx` (`fkID_equipo`),
  ADD KEY `fkID_persona_a_cargo_idx` (`fkID_persona_a_cargo`),
  ADD KEY `fkID_area_idx` (`fkID_area`);

--
-- Indices de la tabla `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`id_marca`);

--
-- Indices de la tabla `memoria`
--
ALTER TABLE `memoria`
  ADD PRIMARY KEY (`id_memoria`);

--
-- Indices de la tabla `modelo`
--
ALTER TABLE `modelo`
  ADD PRIMARY KEY (`id_modelo`);

--
-- Indices de la tabla `modulo`
--
ALTER TABLE `modulo`
  ADD PRIMARY KEY (`id_modulo`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id_permisos`),
  ADD KEY `fkID_rol_idx` (`fkID_rol`),
  ADD KEY `fkID_modulo_idx` (`fkID_modulo`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`id_persona`),
  ADD KEY `fkID_cargo_idx` (`fkID_cargo`),
  ADD KEY `fkID_area_idx` (`fkID_area`);

--
-- Indices de la tabla `procesador`
--
ALTER TABLE `procesador`
  ADD PRIMARY KEY (`id_procesador`,`estado`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `sistema_operativo`
--
ALTER TABLE `sistema_operativo`
  ADD PRIMARY KEY (`id_sistema_operativo`);

--
-- Indices de la tabla `tipo_equipo`
--
ALTER TABLE `tipo_equipo`
  ADD PRIMARY KEY (`id_tipo_equipo`);

--
-- Indices de la tabla `tipo_movimiento`
--
ALTER TABLE `tipo_movimiento`
  ADD PRIMARY KEY (`id_tipo_movimiento`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `fkID_persona_idx` (`fkID_persona`),
  ADD KEY `fkID_rol_idx` (`fkID_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `area`
--
ALTER TABLE `area`
  MODIFY `id_area` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id del area';

--
-- AUTO_INCREMENT de la tabla `cargo`
--
ALTER TABLE `cargo`
  MODIFY `id_cargo` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id del cargo';

--
-- AUTO_INCREMENT de la tabla `equipo`
--
ALTER TABLE `equipo`
  MODIFY `id_equipo` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id del equipo';

--
-- AUTO_INCREMENT de la tabla `estado_equipo`
--
ALTER TABLE `estado_equipo`
  MODIFY `id_estado_equipo` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id del estado del equipo.';

--
-- AUTO_INCREMENT de la tabla `historico_equipo`
--
ALTER TABLE `historico_equipo`
  MODIFY `id_historico_equipo` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id del histórico del equipo.';

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `id_inventario` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id del inventario';

--
-- AUTO_INCREMENT de la tabla `marca`
--
ALTER TABLE `marca`
  MODIFY `id_marca` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id de la marca';

--
-- AUTO_INCREMENT de la tabla `memoria`
--
ALTER TABLE `memoria`
  MODIFY `id_memoria` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id de la memoria';

--
-- AUTO_INCREMENT de la tabla `modelo`
--
ALTER TABLE `modelo`
  MODIFY `id_modelo` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id del modelo';

--
-- AUTO_INCREMENT de la tabla `modulo`
--
ALTER TABLE `modulo`
  MODIFY `id_modulo` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id del modulo.';

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `id_persona` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id de la persona.';

--
-- AUTO_INCREMENT de la tabla `procesador`
--
ALTER TABLE `procesador`
  MODIFY `id_procesador` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id del procesador.';

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID del rol';

--
-- AUTO_INCREMENT de la tabla `sistema_operativo`
--
ALTER TABLE `sistema_operativo`
  MODIFY `id_sistema_operativo` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id del sistema operativo.';

--
-- AUTO_INCREMENT de la tabla `tipo_equipo`
--
ALTER TABLE `tipo_equipo`
  MODIFY `id_tipo_equipo` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id del tipo de equipo';

--
-- AUTO_INCREMENT de la tabla `tipo_movimiento`
--
ALTER TABLE `tipo_movimiento`
  MODIFY `id_tipo_movimiento` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id del tipo de movimiento.', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id del usuario.';
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
