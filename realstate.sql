-- phpMyAdmin SQL Dump
-- version 4.0.8
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 07-03-2016 a las 10:21:00
-- Versión del servidor: 5.1.73-community
-- Versión de PHP: 5.2.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `educ4r_pomares`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_ptg_detalles_propiedad`
--

CREATE TABLE IF NOT EXISTS `tb_ptg_detalles_propiedad` (
  `pro_id_i` int(10) unsigned DEFAULT NULL,
  `tdt_id_i` int(11) DEFAULT NULL,
  `dpr_descripcion_s` varchar(100) DEFAULT NULL,
  `dpr_id_i` int(6) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`dpr_id_i`),
  KEY `reference_6_fk` (`pro_id_i`),
  KEY `reference_7_fk` (`tdt_id_i`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Volcado de datos para la tabla `tb_ptg_detalles_propiedad`
--

INSERT INTO `tb_ptg_detalles_propiedad` (`pro_id_i`, `tdt_id_i`, `dpr_descripcion_s`, `dpr_id_i`) VALUES
(2, 1, 'en suite', 3),
(3, 4, 'Por radiadores', 4),
(3, 3, 'chico', 6),
(2, 1, 'ensuit', 7),
(3, 1, 'reciclado con hidro', 8),
(3, 2, 'techada', 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_ptg_estados`
--

CREATE TABLE IF NOT EXISTS `tb_ptg_estados` (
  `est_id_i` int(11) NOT NULL,
  `est_descripcion_s` varchar(100) DEFAULT NULL,
  `est_grupo_c` char(2) DEFAULT NULL,
  PRIMARY KEY (`est_id_i`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tb_ptg_estados`
--

INSERT INTO `tb_ptg_estados` (`est_id_i`, `est_descripcion_s`, `est_grupo_c`) VALUES
(1, 'Activo', 'GN'),
(2, 'Baja', 'GN');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_ptg_grupos_tipo_detalle`
--

CREATE TABLE IF NOT EXISTS `tb_ptg_grupos_tipo_detalle` (
  `gtd_id_i` int(11) NOT NULL,
  `gtd_descripcion_s` varchar(100) DEFAULT NULL,
  `gtd_orden` int(11) DEFAULT NULL,
  PRIMARY KEY (`gtd_id_i`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tb_ptg_grupos_tipo_detalle`
--

INSERT INTO `tb_ptg_grupos_tipo_detalle` (`gtd_id_i`, `gtd_descripcion_s`, `gtd_orden`) VALUES
(1, 'Características', 2),
(2, 'Confort', 1),
(3, 'Seguridad', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_ptg_imagenes_propiedad`
--

CREATE TABLE IF NOT EXISTS `tb_ptg_imagenes_propiedad` (
  `img_id_i` int(6) NOT NULL AUTO_INCREMENT,
  `pro_id_i` int(10) unsigned DEFAULT NULL,
  `img_descripcion_s` varchar(150) DEFAULT NULL,
  `img_url_s` varchar(255) DEFAULT NULL,
  `img_orden_lista_i` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`img_id_i`),
  KEY `reference_8_fk` (`pro_id_i`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `tb_ptg_imagenes_propiedad`
--

INSERT INTO `tb_ptg_imagenes_propiedad` (`img_id_i`, `pro_id_i`, `img_descripcion_s`, `img_url_s`, `img_orden_lista_i`) VALUES
(1, 2, 'Gran Living', '6EF30_1.jpg', 2),
(2, 3, 'Parte de atras', 'maine-manufactured-home.jpg', 2),
(3, 3, 'entrada autos', 'entrada autos.jpg', 1),
(4, 2, 'iopiop', 'fqsf8maine-manufactured-home.jpg', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_ptg_monedas`
--

CREATE TABLE IF NOT EXISTS `tb_ptg_monedas` (
  `mon_id_i` int(4) NOT NULL,
  `mon_descripcion_s` varchar(40) CHARACTER SET utf8 NOT NULL,
  `mon_simbolo_s` varchar(10) NOT NULL,
  PRIMARY KEY (`mon_id_i`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tb_ptg_monedas`
--

INSERT INTO `tb_ptg_monedas` (`mon_id_i`, `mon_descripcion_s`, `mon_simbolo_s`) VALUES
(1, 'Pesos', '$'),
(2, 'Dolar', 'U$S');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_ptg_propiedades`
--

CREATE TABLE IF NOT EXISTS `tb_ptg_propiedades` (
  `pro_id_i` int(6) NOT NULL AUTO_INCREMENT,
  `tcm_id_i` int(10) unsigned DEFAULT NULL,
  `tpr_id_i` int(10) unsigned DEFAULT NULL,
  `zon_id_i` int(10) unsigned DEFAULT NULL,
  `est_id_i` int(10) unsigned DEFAULT NULL,
  `pro_descripcion_corta_s` varchar(100) DEFAULT NULL,
  `pro_descripcion_extendida_s` text,
  `pro_cant_ambientes_i` int(10) unsigned DEFAULT NULL,
  `pro_cantidad_metros_i` int(10) unsigned DEFAULT NULL,
  `pro_hubicacion_s` varchar(100) DEFAULT NULL,
  `pro_domicilio_real_s` varchar(150) DEFAULT NULL,
  `pro_precio_venta_i` int(10) unsigned DEFAULT NULL,
  `pro_precio_visible_b` varchar(1) DEFAULT NULL,
  `pro_imagen_url_s` varchar(255) DEFAULT NULL,
  `pro_destacada_b` varchar(1) DEFAULT NULL,
  `pro_texto_destacada_s` varchar(150) DEFAULT NULL,
  `aud_login_insert_s` varchar(50) DEFAULT NULL,
  `aud_date_insert_d` datetime DEFAULT NULL,
  `aud_login_update_s` varchar(50) DEFAULT NULL,
  `aud_date_update_d` datetime DEFAULT NULL,
  PRIMARY KEY (`pro_id_i`),
  KEY `reference_1_fk` (`tcm_id_i`),
  KEY `reference_2_fk` (`tpr_id_i`),
  KEY `reference_3_fk` (`zon_id_i`),
  KEY `reference_4_fk` (`est_id_i`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `tb_ptg_propiedades`
--

INSERT INTO `tb_ptg_propiedades` (`pro_id_i`, `tcm_id_i`, `tpr_id_i`, `zon_id_i`, `est_id_i`, `pro_descripcion_corta_s`, `pro_descripcion_extendida_s`, `pro_cant_ambientes_i`, `pro_cantidad_metros_i`, `pro_hubicacion_s`, `pro_domicilio_real_s`, `pro_precio_venta_i`, `pro_precio_visible_b`, `pro_imagen_url_s`, `pro_destacada_b`, `pro_texto_destacada_s`, `aud_login_insert_s`, `aud_date_insert_d`, `aud_login_update_s`, `aud_date_update_d`) VALUES
(2, 1, 1, 8, 1, 'Gran Casa Reciclada', 'Esta casa es bla bla bla bla', 6, 3000, 'Marco Sastre y Acevedo', 'luro 9876', 200000, '1', '2.jpg', '1', '', NULL, NULL, NULL, NULL),
(3, 1, 1, 8, 1, 'Buena Propiedad', 'BLABLABLABALABLABA', 3, 500, 'Villa primera', '', 80000, '0', 'home-picture-2.jpeg', '0', '', NULL, NULL, NULL, NULL),
(4, 1, 1, 8, 1, '', '', 4, 254, 'Mitre y San Martin', 'lala', 12, '0', 'casita.jpg', '0', '', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_ptg_tipos_comercializacion`
--

CREATE TABLE IF NOT EXISTS `tb_ptg_tipos_comercializacion` (
  `tcm_id_i` int(11) NOT NULL,
  `tcm_descripcion_s` varchar(50) DEFAULT NULL,
  `tcm_orden_lista_i` int(11) DEFAULT NULL,
  PRIMARY KEY (`tcm_id_i`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tb_ptg_tipos_comercializacion`
--

INSERT INTO `tb_ptg_tipos_comercializacion` (`tcm_id_i`, `tcm_descripcion_s`, `tcm_orden_lista_i`) VALUES
(1, 'Venta', 1),
(2, 'Alquiler', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_ptg_tipos_detalle`
--

CREATE TABLE IF NOT EXISTS `tb_ptg_tipos_detalle` (
  `tdt_id_i` int(11) NOT NULL,
  `tdt_descripcion_s` varchar(100) DEFAULT NULL,
  `gtd_id_i` int(11) DEFAULT NULL,
  PRIMARY KEY (`tdt_id_i`),
  KEY `reference_5_fk` (`gtd_id_i`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tb_ptg_tipos_detalle`
--

INSERT INTO `tb_ptg_tipos_detalle` (`tdt_id_i`, `tdt_descripcion_s`, `gtd_id_i`) VALUES
(1, 'Baño', 1),
(2, 'Cochera', 1),
(3, 'Living-comedor', 1),
(4, 'Calefacción', 2),
(5, 'Carpintería', 2),
(6, 'Muebles', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_ptg_tipos_propiedades`
--

CREATE TABLE IF NOT EXISTS `tb_ptg_tipos_propiedades` (
  `tpr_id_i` int(11) NOT NULL,
  `tpr_descripcion_s` varchar(50) DEFAULT NULL,
  `tpr_orden_lista_i` int(11) DEFAULT NULL,
  PRIMARY KEY (`tpr_id_i`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tb_ptg_tipos_propiedades`
--

INSERT INTO `tb_ptg_tipos_propiedades` (`tpr_id_i`, `tpr_descripcion_s`, `tpr_orden_lista_i`) VALUES
(1, 'Casa', 1),
(2, 'Departamento', 2),
(3, 'Local', 3),
(4, 'Fondo de comercio', 4),
(5, 'Galpon', 5),
(6, 'Terreno', 6),
(7, 'Campo', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_ptg_usuarios`
--

CREATE TABLE IF NOT EXISTS `tb_ptg_usuarios` (
  `usu_id_i` int(11) NOT NULL AUTO_INCREMENT,
  `est_id_i` int(11) DEFAULT NULL,
  `usu_apellido_s` varchar(50) DEFAULT NULL,
  `usu_nombres_s` varchar(100) DEFAULT NULL,
  `usu_login_s` varchar(50) DEFAULT NULL,
  `usu_password_s` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`usu_id_i`),
  KEY `reference_9_fk` (`est_id_i`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `tb_ptg_usuarios`
--

INSERT INTO `tb_ptg_usuarios` (`usu_id_i`, `est_id_i`, `usu_apellido_s`, `usu_nombres_s`, `usu_login_s`, `usu_password_s`) VALUES
(7, 1, 'Administrator', 'System', 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_ptg_zonas`
--

CREATE TABLE IF NOT EXISTS `tb_ptg_zonas` (
  `zon_id_i` int(6) NOT NULL AUTO_INCREMENT,
  `zon_descripcion_s` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`zon_id_i`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Volcado de datos para la tabla `tb_ptg_zonas`
--

INSERT INTO `tb_ptg_zonas` (`zon_id_i`, `zon_descripcion_s`) VALUES
(8, 'Centro'),
(9, 'GÃ¼emes'),
(10, 'Centro');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
