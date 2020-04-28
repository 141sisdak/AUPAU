-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-04-2020 a las 18:37:34
-- Versión del servidor: 10.4.6-MariaDB
-- Versión de PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `aupaubd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adoptante`
--

CREATE TABLE `adoptante` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) DEFAULT NULL,
  `apellidos` varchar(100) DEFAULT NULL,
  `telefono1` varchar(9) DEFAULT NULL,
  `telefono2` varchar(9) DEFAULT NULL,
  `num_adopciones` int(11) DEFAULT NULL,
  `comentarios` varchar(300) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `provincia` varchar(30) DEFAULT NULL,
  `localidad` varchar(50) DEFAULT NULL,
  `dni` varchar(10) DEFAULT NULL,
  `edad` int(11) DEFAULT NULL,
  `num_mascostas` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentas`
--

CREATE TABLE `cuentas` (
  `id` int(11) NOT NULL,
  `concepto` varchar(100) DEFAULT NULL,
  `precio` decimal(10,0) NOT NULL,
  `comentario` varchar(300) NOT NULL,
  `pagado` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `enfermedades`
--

CREATE TABLE `enfermedades` (
  `id` int(11) NOT NULL,
  `enfermedad` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `enfermedades`
--

INSERT INTO `enfermedades` (`id`, `enfermedad`) VALUES
(1, 'Otitis'),
(2, 'Moquillo'),
(3, 'Sarna'),
(4, 'Parasitos internos'),
(5, 'Artrosis'),
(6, 'Parvovirus'),
(7, 'Grastritis'),
(8, 'Leishmaniosis'),
(9, 'Conjuntivitis'),
(10, 'Rabia'),
(11, 'Leucemia felina'),
(12, 'Panleocopenia felina'),
(13, 'Inmunodeficiencia'),
(14, 'Peritonitis'),
(15, 'Problemas gastro intestinales');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `enfermedades_animal`
--

CREATE TABLE `enfermedades_animal` (
  `id` int(11) NOT NULL,
  `id_animal` varchar(20) NOT NULL,
  `id_enfermedad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `enfermedades_animal`
--

INSERT INTO `enfermedades_animal` (`id`, `id_animal`, `id_enfermedad`) VALUES
(5, 'P-1', 6),
(6, 'P-1', 4),
(7, 'P-1', 12),
(52, 'G-1', 5),
(54, 'G-1', 6),
(56, '', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especie`
--

CREATE TABLE `especie` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `especie`
--

INSERT INTO `especie` (`id`, `nombre`) VALUES
(1, 'perro'),
(2, 'gato'),
(3, 'roedor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ficha_animal`
--

CREATE TABLE `ficha_animal` (
  `id` varchar(20) NOT NULL,
  `adoptante` int(4) DEFAULT NULL,
  `comentarios` varchar(600) DEFAULT NULL,
  `descripcion` varchar(600) DEFAULT NULL,
  `edad` int(4) DEFAULT NULL,
  `especie` int(4) DEFAULT NULL,
  `estadoAdop` varchar(20) DEFAULT NULL,
  `fechaIngreso` date DEFAULT NULL,
  `fechaNac` date DEFAULT NULL,
  `ult_despa` date DEFAULT NULL,
  `esterilizado` varchar(30) DEFAULT NULL,
  `localidad` int(4) DEFAULT NULL,
  `nombre` varchar(30) DEFAULT NULL,
  `numchip` varchar(30) DEFAULT NULL,
  `raza` int(4) DEFAULT NULL,
  `refugio` int(4) DEFAULT NULL,
  `tamanyo` int(4) DEFAULT NULL,
  `sexo` varchar(20) DEFAULT NULL,
  `activo` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ficha_animal`
--

INSERT INTO `ficha_animal` (`id`, `adoptante`, `comentarios`, `descripcion`, `edad`, `especie`, `estadoAdop`, `fechaIngreso`, `fechaNac`, `ult_despa`, `esterilizado`, `localidad`, `nombre`, `numchip`, `raza`, `refugio`, `tamanyo`, `sexo`, `activo`) VALUES
('G-1', NULL, 'comentarios gato1', NULL, 0, 2, 'no adoptado', '2020-03-01', '2020-03-01', '2020-01-01', 'si', 19, NULL, '941111111181171', 207, 1, 1, 'macho', 1),
('G-2', 1, 'comentarios gato 2', 'descripcion gato 2', 4, 2, 'no adoptado', '2020-04-01', '2020-02-03', '2020-01-09', 'no', 28, 'gato2', 'asdfasdf4556', 75, 1, 1, 'macho', 1),
('G-3', 1, 'comentarios gato 3', 'descripcion gato 3', 1, 2, 'adoptado', '2019-08-01', '2019-12-09', '2019-07-30', 'no', 22, 'gato3', '654654', 76, 1, 1, 'hembra', 1),
('G-4', 1, 'comentarios gato 4', 'descripcion gato 4', 3, 2, 'adoptado', '2019-07-08', '2019-09-16', '2019-07-30', 'no', 22, 'gato3', '654654', 76, 1, 1, 'hembra', 1),
('G-5', 1, 'comentarios gato 5', 'descripcion gato 5', 6, 2, 'no adoptado', '2019-09-10', '2020-02-03', '2020-04-06', 'si', 7, 'gato 5', 'dfgdsgdf454', 87, 1, 2, 'hembra', 1),
('P-10', NULL, 'com', 'desc', 2, 1, '', '2020-04-02', '2020-04-10', '2020-04-01', 'on', NULL, 'asdfds', '941111111111111', 174, 1, 1, 'macho', 1),
('P-11', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'ffff', '941111111111111', NULL, NULL, NULL, NULL, 1),
('P-12', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '941111111111111', NULL, NULL, NULL, NULL, 1),
('P-13', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'prueba', '941111111111111', NULL, NULL, NULL, NULL, 1),
('P-14', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '941111111111111', NULL, NULL, NULL, NULL, 1),
('P-15', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'asccc', '941111111111111', NULL, NULL, NULL, NULL, 1),
('P-16', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '941111111111111', NULL, NULL, NULL, NULL, 1),
('P-17', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '941111111111111', NULL, NULL, NULL, NULL, 1),
('P-18', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '941111111111111', NULL, NULL, NULL, NULL, 1),
('P-19', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '941111111111111', NULL, NULL, NULL, NULL, 1),
('P-2', 2, 'comentarios perro2', 'descripcion perro2', 1, 1, 'adoptado', '2020-03-03', '2020-03-03', '2020-01-10', 'no', 13, 'perro2', 'asdfs1122', 133, 1, 2, 'hembra', 1),
('P-20', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '941111111111111', NULL, NULL, NULL, NULL, 1),
('P-21', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '941111111111111', NULL, NULL, NULL, NULL, 1),
('P-22', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '941111111111111', NULL, NULL, NULL, NULL, 1),
('P-3', 0, 'comentarios perro 3', 'descripcion perro 3', 6, 1, 'adoptado', '2020-04-06', '2020-03-09', '2020-04-01', 'no', 244, 'perro3', 'sdfsdf4', 117, NULL, 3, 'macho', 1),
('P-5', 2, 'comentarios perro 5', 'descripcion perro 5', 8, 1, 'adoptado', '2020-03-02', '2020-03-03', '2019-04-02', 'si', 27, 'perro5', 'ssdfgdsfg', 248, 1, 3, 'hembra', 1),
('P-6', 2, 'comentarios perro 6', 'descripcion perro 6', 8, 1, 'adoptado', '2020-01-02', '2019-04-03', '2019-04-01', 'si', 27, 'perro5', 'ssdfgdsfg', 248, 1, 3, 'hembra', 1),
('P-7', 2, 'comentarios perro 7', 'descripcion perro 7', 10, 1, ' no adoptado', '2020-04-01', '2019-09-09', '2020-02-17', 'no', 28, 'perro7', 'ljhkhgggg', NULL, NULL, NULL, 'macho', 1),
('P-8', 1, 'comentarios perro 8', 'descripcion perro 8', 5, 1, 'no adoptado', '2020-03-07', '2019-06-10', '2020-03-30', 'si', 222, 'perro8', 'asdfasdf343', 37, 1, 3, 'macho', 1),
('P-9', NULL, 'com', 'desc', 3, 1, 'adoptado', '2020-02-03', '2020-02-03', '2020-02-03', 'si', NULL, 'sadfsa', '1212331', 3, 1, 1, 'macho', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `localidades`
--

CREATE TABLE `localidades` (
  `id` int(11) NOT NULL,
  `localidad` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `localidades`
--

INSERT INTO `localidades` (`id`, `localidad`) VALUES
(1, 'Ademuz'),
(2, 'Ador'),
(3, 'Agullent'),
(4, 'Aielo de Malferit'),
(5, 'Aielo de Rugat'),
(6, ' Alaquàs'),
(7, 'Albaida'),
(8, 'Albal'),
(9, ' Albalat de la Ribera'),
(10, 'Albalat dels Sorells'),
(11, 'Albalat dels Tarongers'),
(12, 'Alberic'),
(13, 'Alborache'),
(14, 'Alboraia'),
(15, 'Albuixech'),
(16, 'Alcublas'),
(17, 'Alcàntera de Xúquer'),
(18, 'Alcàsser'),
(19, 'Aldaia'),
(20, 'Alfafar'),
(21, 'Alfara de la Baronia'),
(22, 'Alfara del Patriarca'),
(23, 'Alfarp'),
(24, 'Alfarrasí'),
(25, 'Alfauir'),
(26, 'Algar de Palancia'),
(27, 'Algemesí'),
(28, ' Algimia de Alfara'),
(29, 'Alginet'),
(30, 'Almiserà'),
(31, 'Almoines'),
(32, 'Almussafes'),
(33, 'Almàssera'),
(34, 'Alpuente'),
(35, 'Alzira'),
(36, 'Andilla'),
(37, 'Anna'),
(38, 'Antella'),
(39, ' Aras de los Olmos'),
(40, 'Atzeneta d\'Albaida'),
(41, 'Ayora'),
(42, 'Barx'),
(43, 'Barxeta'),
(44, 'Bellreguard'),
(45, 'Bellús'),
(46, 'Benaguasil'),
(47, 'Benagéber'),
(48, 'Benavites'),
(49, 'Beneixida'),
(50, 'Benetússer'),
(51, 'Beniarjó'),
(52, 'Beniatjar'),
(53, 'Benicolet'),
(54, 'Benicull de Xúquer'),
(55, 'Benifairó de la Valldigna'),
(56, 'Benifairó de les Valls'),
(57, 'Benifaió'),
(58, 'Beniflá'),
(59, 'Benigànim'),
(60, 'Benimodo'),
(61, 'Benimuslem'),
(62, 'Beniparrell'),
(63, 'Benirredrà'),
(64, 'Benisanó'),
(65, 'Benissoda'),
(66, 'Benisuera'),
(67, 'Bicorp'),
(68, 'Bocairent'),
(69, 'Bolbaite'),
(70, 'Bonrepòs i Mirambell'),
(71, 'Bufali'),
(72, 'Bugarra'),
(73, 'Burjassot'),
(74, 'Buñol'),
(75, 'Bèlgida'),
(76, 'Bétera'),
(77, 'Calles'),
(78, 'Calpe'),
(79, 'Camporrobles'),
(80, 'Canals'),
(81, 'Canet d\'En Berenguer'),
(82, 'Carcaixent'),
(83, 'Carlet'),
(84, 'Carrícola'),
(85, 'Casas Altas'),
(86, 'Casas Bajas'),
(87, 'Casinos'),
(88, 'Castellonet de la Conquesta'),
(89, 'Castelló de Rugat'),
(90, 'Castielfabib'),
(91, 'Catadau'),
(92, 'Catarroja'),
(93, 'Caudete de las Fuentes'),
(94, 'Cerdà'),
(95, 'Chella'),
(96, 'Chelva'),
(97, 'Chera'),
(98, 'Cheste'),
(99, 'Chiva'),
(100, 'Chulilla'),
(101, 'Cofrentes'),
(102, 'Corbera'),
(103, 'Cortes de Pallás'),
(104, 'Cotes'),
(105, 'Cullera'),
(106, 'Càrcer'),
(107, 'Daimús'),
(108, 'Domeño'),
(109, 'Dos Aguas'),
(110, 'Enguera'),
(111, 'Estivella'),
(112, 'Estubeny'),
(113, 'Faura'),
(114, 'Foios'),
(115, 'Fontanars dels Alforins'),
(116, 'Fortaleny'),
(117, 'Fuenterrobles'),
(118, 'Gavarda'),
(119, 'Genovés'),
(120, 'Gestalgar'),
(121, 'Gilet'),
(122, 'Godella'),
(123, 'Godelleta'),
(124, 'Guadasequies'),
(125, 'Guadassuar'),
(126, 'Guardamar de la Safor'),
(127, 'Gátova'),
(128, 'Higueruelas'),
(129, 'Jalance'),
(130, 'Jarafuel'),
(131, 'L\'Eliana'),
(132, 'La Font d\'En Carròs'),
(133, 'La Font de la Figuera'),
(134, ' La Granja de la Costera'),
(135, 'La Llosa de Ranes'),
(136, ' La Pobla Llarga'),
(137, 'La Pobla de Farnals'),
(138, 'La Pobla de Vallbona'),
(139, 'La Pobla del Duc'),
(140, 'La Yesa'),
(141, 'Llanera de Ranes'),
(142, 'Llaurí'),
(143, 'Llocnou d\'En Fenollet'),
(144, 'Llocnou de Sant Jeroni'),
(145, 'Llocnou de la Corona'),
(146, 'Llombai'),
(147, 'Llutxent'),
(148, 'Llíria'),
(149, 'Loriguilla'),
(150, 'Losa del Obispo'),
(151, 'Macastre'),
(152, 'Manises'),
(153, 'Manuel'),
(154, 'Marines'),
(155, 'Massalavés'),
(156, 'Massalfassar'),
(157, 'Massamagrell'),
(158, 'Massanassa'),
(159, 'Meliana'),
(160, 'Millares'),
(161, 'Miramar'),
(162, 'Mislata'),
(163, 'Moncada'),
(164, 'Montaverner'),
(165, 'Montesa'),
(166, 'Montroy'),
(167, 'Montserrat'),
(168, 'Museros'),
(169, 'Navarrés'),
(170, 'Náquera'),
(171, 'Oliva'),
(172, 'Olocau'),
(173, 'Ontinyent'),
(174, 'Otos'),
(175, 'Paiporta'),
(176, 'Palma de Gandía'),
(177, 'Paterna'),
(178, 'Pedralba'),
(179, 'Petrés'),
(180, 'Picanya'),
(181, 'Picassent'),
(182, 'Piles'),
(183, 'Pinet'),
(184, ' Polinyà de Xúquer'),
(185, 'Potríes'),
(186, 'Puebla de San Miguel'),
(187, 'Puçol'),
(188, 'Quart de Poblet'),
(189, 'Quart de les Valls'),
(190, 'Quartell'),
(191, 'Quatretonda'),
(192, 'Quesa'),
(193, 'Rafelcofer'),
(194, 'Rafelguaraf'),
(195, 'Real'),
(196, 'Real de Gandía'),
(197, 'Requena'),
(198, 'Riba-roja de Túria'),
(199, 'Riola'),
(200, 'Rocafort'),
(201, 'Rotglà i Corberà'),
(202, 'Rugat'),
(203, ' Ráfol de Salem'),
(204, 'Rótova'),
(205, 'Sagunto'),
(206, 'Salem'),
(207, 'San Antonio de Benagéber'),
(208, ' Sant Joanet'),
(209, 'Sedaví'),
(210, 'Segart'),
(211, 'Sellent'),
(212, 'Sempere'),
(213, 'Senyera'),
(214, 'Serra'),
(215, 'Siete Aguas'),
(216, 'Silla'),
(217, 'Simat de la Valldigna'),
(218, 'Sinarcas'),
(219, 'Sollana'),
(220, 'Sot de Chera'),
(221, 'Sueca'),
(222, 'Sumacàrcer'),
(223, 'Tavernes Blanques'),
(224, ' Tavernes de la Valldigna'),
(225, ' Teresa de Cofrentes'),
(226, 'Terrateig'),
(227, 'Titaguas'),
(228, 'Torrebaja'),
(229, 'Torrella'),
(230, 'Torrent'),
(231, 'Torres Torres'),
(232, 'Tous'),
(233, 'Turís'),
(234, 'Tuéjar'),
(235, 'Utiel'),
(236, 'Valencia'),
(237, 'Vallada'),
(238, 'Vallanca'),
(239, 'Vallés'),
(240, 'Venta del Moro'),
(241, 'Vilamarxant'),
(242, ' Villalonga'),
(243, ' Villanueva de Castellón'),
(244, ' Villar del Arzobispo'),
(245, 'Villargordo del Cabriel'),
(246, ' Vinalesa'),
(247, 'Xeraco'),
(248, 'Xeresa'),
(249, 'Xirivella'),
(250, 'Xàtiva'),
(251, 'Yátova'),
(252, 'Zarra');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `raza`
--

CREATE TABLE `raza` (
  `id` int(11) NOT NULL,
  `especie` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `raza`
--

INSERT INTO `raza` (`id`, `especie`, `nombre`) VALUES
(1, 1, 'Mestizo'),
(2, 1, 'Husky inu'),
(3, 1, 'Aïdi'),
(4, 1, 'Mal-shi'),
(5, 1, 'Schnocker'),
(6, 1, 'Shih-poo'),
(7, 1, 'Braco francés'),
(8, 1, 'Bullhuahua'),
(9, 1, 'Aussiedoodle o aussiepoo'),
(10, 1, 'Azawakh'),
(11, 1, 'Cavapoo'),
(12, 1, 'Puggle'),
(13, 1, 'Schnoodle'),
(14, 1, 'Cavachón'),
(15, 1, 'Yorkie poo'),
(16, 1, 'Chorkie'),
(17, 1, 'Morkie'),
(18, 1, 'Australian cobberdog'),
(19, 1, 'Kelpie Australiano'),
(20, 1, 'Cockapoo'),
(21, 1, 'Goldendoodle'),
(22, 1, 'Maltipoo'),
(23, 1, 'Labradoodle'),
(24, 1, 'Podenco Portugués'),
(25, 1, 'Eurasier'),
(26, 1, 'Pastor del Cáucaso'),
(27, 1, 'Thai ridgeback'),
(28, 1, 'Berguer de Picardie'),
(29, 1, 'Alaskan malamute'),
(30, 1, 'Podenco andaluz'),
(31, 1, 'Podenco Ibicenco'),
(32, 1, 'Caniche'),
(33, 1, 'Spitz Finlandés'),
(34, 1, 'Elkhound'),
(35, 1, 'Foxhound americano'),
(36, 1, 'Foxhound Inglés'),
(37, 1, 'Podenco Canario'),
(38, 1, 'Mastín del Pirineo'),
(39, 1, 'Mastín Español'),
(40, 1, 'Sloughi'),
(41, 1, 'Braco italiano'),
(42, 1, 'Spaniel Bretón'),
(43, 1, 'Can de Palleiro'),
(44, 1, 'Lobero Irlandés'),
(45, 1, 'Kuvasz'),
(46, 1, 'Dandie dinmont terrier'),
(47, 1, 'Pastor Holandes'),
(48, 1, 'Perro de agua Portugués'),
(49, 1, 'Bedlington terrier'),
(50, 1, 'Scotish terrier'),
(51, 1, 'San Huberto'),
(52, 1, 'Affenpinscher'),
(53, 1, 'Bóxer'),
(54, 1, 'American Bully'),
(55, 1, 'Borzoi'),
(56, 1, 'Cavalier King Charles Spaniel'),
(57, 1, 'Terrier Tibetano'),
(58, 1, 'Perro lobo Checoslovaco'),
(59, 1, 'Perro pomsky'),
(60, 1, 'Xolotzcuintle'),
(61, 1, 'Rata Valenciana'),
(62, 1, 'Parson russell terrier'),
(63, 1, 'Cocker spainel Americano'),
(64, 1, 'Chihuahua'),
(65, 1, 'Rottweiler'),
(66, 1, 'Galgo Italiano'),
(67, 1, 'Harrier'),
(68, 1, 'Perro peruano'),
(69, 1, 'Bodeguero andaluz'),
(70, 1, 'Labrador Retriever'),
(71, 1, 'Border Collie'),
(72, 1, 'Bull terrier Inglés'),
(73, 1, 'Chow chow'),
(74, 1, 'Bichón habanero'),
(75, 1, 'Bichón boloñés'),
(76, 1, 'Grifón Belga'),
(77, 1, 'Petit brabançon'),
(78, 1, 'Grifón de Bruselas'),
(79, 1, 'Pinscher miniatura'),
(80, 1, 'West highland white terrier'),
(81, 1, 'Schnauzer'),
(82, 1, 'Cain terrier'),
(83, 1, 'Border terrier'),
(84, 1, 'Perro crestado chino'),
(85, 1, 'Samoyedo'),
(86, 1, 'Caniche'),
(87, 1, 'Pastor catalán'),
(88, 1, 'Pit bull terrier americano'),
(89, 1, 'Keeshond'),
(90, 1, 'Collie de pelo largo'),
(91, 1, 'Mastín tibetano'),
(92, 1, 'Pastor Belga'),
(93, 1, 'Bulldog Americano'),
(94, 1, 'Welsh corgi Cardigan'),
(95, 1, 'Terrier negro ruso'),
(96, 1, 'Perro lobo de Saarloos'),
(97, 1, 'Pastor de Shetland'),
(98, 1, 'Weslh Corgi Pembroke'),
(99, 1, 'Collie de pelo corto'),
(100, 1, 'Presa Canario '),
(101, 1, 'Galgo Inglés'),
(102, 1, 'Cocker Spaniel Inglés'),
(103, 1, 'Perro de montaña de los Pirineos'),
(104, 1, 'Pekinés'),
(105, 1, 'Terranova'),
(106, 1, 'Bichón Maltés'),
(107, 1, 'Mastín Italiano'),
(108, 1, 'Collie barbudo'),
(109, 1, 'Pastor bergamasco'),
(110, 1, 'Yorskire terrier'),
(111, 1, 'Perro de agua español'),
(112, 1, 'Appenzeller'),
(113, 1, 'Golden Retriever'),
(114, 1, 'San Bernardo'),
(115, 1, 'Boyero de Berna'),
(116, 1, 'Bull terrier Inglés'),
(117, 1, 'Akita inu'),
(118, 1, 'Pastor de los Pirineos'),
(119, 1, 'Breco alemán de pelo corto'),
(120, 1, 'Airedale terrier'),
(121, 1, 'Ratón de Praga'),
(122, 1, 'Beagle'),
(123, 1, 'Pastor belga laekenois'),
(124, 1, 'Norfolk terrie'),
(125, 1, 'Perro crestado rodesiano'),
(126, 1, 'Poiner inglés'),
(127, 1, 'Schipperke'),
(128, 1, 'Teckel'),
(129, 1, 'Pomerania'),
(130, 1, 'Akita Americano'),
(131, 1, 'Pastor Alemán'),
(132, 1, 'Pastor belga malinois'),
(133, 1, 'Retriever de la bahía de Chesapeake'),
(134, 1, 'Basset artesiano normando'),
(135, 1, 'Gran Danés'),
(136, 1, 'Basset hound'),
(137, 1, 'Perro pastor polaco de las llanuras'),
(138, 1, 'Skye terrier'),
(139, 1, 'Nova Scotia duck tolling retriever'),
(140, 1, 'Dogo Mallorquín'),
(141, 1, 'Broholmer'),
(142, 1, 'Terrier Brasileño'),
(143, 1, 'Staffordshire bull terrier'),
(144, 1, 'Carlino-Pug'),
(145, 1, 'Jack russell terrier'),
(146, 1, 'Galgo español'),
(147, 1, 'Perro pastor croata'),
(148, 1, 'Weimaraner'),
(149, 1, 'Gran sabueso anglo-francés'),
(150, 1, 'Saluki'),
(151, 1, 'Perro pastor de los Pirineos de cara rasa'),
(152, 1, 'Pequeño perro león'),
(153, 1, 'Setter Irlandés rojo'),
(154, 1, 'Bullmastiff'),
(155, 1, 'Braco Húngaro '),
(156, 1, 'Dálmata'),
(157, 1, 'Kangal'),
(158, 1, 'Spitz Alemán'),
(159, 1, 'Perro pastor blanco suizo'),
(160, 1, 'Boyero Australiano'),
(161, 1, 'Pastor de Beauce'),
(162, 1, 'Shih tzu'),
(163, 1, 'Bichón frisé'),
(164, 1, 'Boyero de Flandes'),
(165, 1, 'Mastín Napolitano'),
(166, 1, 'Pinscher austriaco'),
(167, 1, 'Staffordshire terrier americano'),
(168, 1, 'Tosa Inu'),
(169, 1, 'Whippet'),
(170, 1, 'Dogo Argentino'),
(171, 1, 'Fila Brasileño'),
(172, 1, 'Lebrel Escocés'),
(173, 1, 'Dogo de Burdeos'),
(174, 1, 'Basenji'),
(175, 1, 'Soft coated wheaten terrier Irlandés'),
(176, 1, 'Terrier Australiano'),
(177, 1, 'Papillón'),
(178, 1, 'Husky siberiano'),
(179, 1, 'Galgo Afgano'),
(180, 1, 'Boerboel'),
(187, 1, 'Shiba inu'),
(188, 1, 'Shar pei'),
(189, 1, 'Bobtail'),
(190, 1, 'Bulldog Francés'),
(191, 1, 'Bulldog Inglés'),
(192, 1, 'Doberman pinscher'),
(193, 1, 'Pastor ovejero australiano'),
(194, 1, 'Fox terrier de pelo alambre'),
(195, 1, 'Pastor belga groenendael'),
(196, 1, 'Boston terrier'),
(197, 1, 'Cotón de Tuléar'),
(198, 1, 'Fox terrier de pelo liso'),
(199, 1, 'Lhasa apso'),
(201, 2, 'Bosque de Noruega'),
(202, 2, 'Burmilla'),
(203, 2, 'Gato LaPerm'),
(204, 2, 'Tonkinés'),
(205, 2, 'Pixie bob'),
(206, 2, 'American wirehair'),
(207, 2, 'Mestizo'),
(208, 2, 'Selkirk rex'),
(209, 2, 'Nebelung'),
(210, 2, 'Lykoi - Gato lobo'),
(211, 2, 'Cornish rex'),
(212, 2, 'Ocelote'),
(213, 2, 'Peterbald'),
(214, 2, 'Gato Oriental de pelo corto'),
(215, 2, 'Siberiano'),
(216, 2, 'Manx'),
(217, 2, 'Gato exótico de pelo corto'),
(218, 2, 'Gato Birmano'),
(219, 2, 'Sokoke'),
(220, 2, 'Cartujo'),
(221, 2, 'Savannah'),
(222, 2, 'Gato Montés'),
(223, 2, 'Burmés'),
(224, 2, 'Munchkin'),
(225, 2, 'Chausie'),
(226, 2, 'Devo rex'),
(227, 2, 'Javanés'),
(228, 2, 'Scottish fold'),
(229, 2, 'Van turco'),
(230, 2, 'Korat'),
(231, 2, 'Somalí'),
(232, 2, 'Sphynx o esfinge'),
(233, 2, 'Siamés'),
(234, 2, 'Persa'),
(235, 2, 'Habana'),
(236, 2, 'Himalayo'),
(237, 2, 'Australian Mist'),
(238, 2, 'Mau Egipcio'),
(239, 2, 'Europeo'),
(240, 2, 'Bombay'),
(241, 2, 'Gato azul ruso'),
(242, 2, 'Británico de pelo corto'),
(243, 2, 'Snowshoe'),
(244, 2, 'Bengala'),
(245, 2, 'Ashera'),
(246, 2, 'Abisinio'),
(247, 2, 'Balinés'),
(248, 2, 'Main Coon'),
(249, 2, 'Curl Americano'),
(250, 2, 'Ragdoll');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `refugios`
--

CREATE TABLE `refugios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `refugios`
--

INSERT INTO `refugios` (`id`, `nombre`) VALUES
(1, 'refugio1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `rol` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `rol`) VALUES
(1, 'admin'),
(2, 'usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tamanyos`
--

CREATE TABLE `tamanyos` (
  `id` int(11) NOT NULL,
  `tamanyo` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tamanyos`
--

INSERT INTO `tamanyos` (`id`, `tamanyo`) VALUES
(1, 'pequeño'),
(2, 'mediano'),
(3, 'grande');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tratamientos`
--

CREATE TABLE `tratamientos` (
  `id` int(11) NOT NULL,
  `tratamiento` varchar(200) NOT NULL,
  `comentarios` varchar(350) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tratamientos`
--

INSERT INTO `tratamientos` (`id`, `tratamiento`, `comentarios`) VALUES
(1, 'Otican Limpiador de Oídos 125 ml', ''),
(2, 'Coatex Champú Tratamiento Dérmico', ''),
(3, 'Vet Gastril, 50 ml', ''),
(4, 'Dentican Spray 125 ml', ''),
(5, 'Lubrithal Gel Ocular, 10 gr', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tratamientos_animal`
--

CREATE TABLE `tratamientos_animal` (
  `id` int(11) NOT NULL,
  `id_animal` varchar(20) NOT NULL,
  `id_tratamiento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tratamientos_animal`
--

INSERT INTO `tratamientos_animal` (`id`, `id_animal`, `id_tratamiento`) VALUES
(1, 'P-1', 2),
(2, 'P-1', 1),
(4, 'G-1', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `password` varchar(8) NOT NULL,
  `rol` int(11) NOT NULL,
  `fecha_alta` date NOT NULL,
  `fecha_baja` date DEFAULT NULL,
  `num_avisos` int(11) DEFAULT NULL,
  `telefono` varchar(9) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `password`, `rol`, `fecha_alta`, `fecha_baja`, `num_avisos`, `telefono`, `email`) VALUES
(1, 'admin', '123', 1, '2020-03-15', NULL, 0, '963635758', 'admin@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vacunas`
--

CREATE TABLE `vacunas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `vacunas`
--

INSERT INTO `vacunas` (`id`, `nombre`) VALUES
(1, 'Primovacunacion'),
(2, 'Polivalente'),
(3, 'Rec. Polivalente'),
(4, 'Rabia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vacunas_animal`
--

CREATE TABLE `vacunas_animal` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `id_animal` varchar(20) NOT NULL,
  `id_vacuna` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `vacunas_animal`
--

INSERT INTO `vacunas_animal` (`id`, `fecha`, `id_animal`, `id_vacuna`) VALUES
(1, '2020-03-15', 'P-1', 2),
(2, '2020-02-03', 'P-1', 3),
(3, '2020-03-04', 'P-1', 1),
(7, '0000-00-00', 'G-1', 4);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `adoptante`
--
ALTER TABLE `adoptante`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cuentas`
--
ALTER TABLE `cuentas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `enfermedades`
--
ALTER TABLE `enfermedades`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `enfermedades_animal`
--
ALTER TABLE `enfermedades_animal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_animal` (`id_animal`),
  ADD KEY `id_enfermedad` (`id_enfermedad`);

--
-- Indices de la tabla `especie`
--
ALTER TABLE `especie`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ficha_animal`
--
ALTER TABLE `ficha_animal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `raza` (`raza`),
  ADD KEY `refugio` (`refugio`),
  ADD KEY `tamanyo` (`tamanyo`),
  ADD KEY `localidad` (`localidad`),
  ADD KEY `especie` (`especie`),
  ADD KEY `adoptante` (`adoptante`);

--
-- Indices de la tabla `localidades`
--
ALTER TABLE `localidades`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `raza`
--
ALTER TABLE `raza`
  ADD PRIMARY KEY (`id`),
  ADD KEY `especie` (`especie`);

--
-- Indices de la tabla `refugios`
--
ALTER TABLE `refugios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tamanyos`
--
ALTER TABLE `tamanyos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tratamientos`
--
ALTER TABLE `tratamientos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tratamientos_animal`
--
ALTER TABLE `tratamientos_animal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_animal` (`id_animal`),
  ADD KEY `id_tratamiento` (`id_tratamiento`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rol` (`rol`);

--
-- Indices de la tabla `vacunas`
--
ALTER TABLE `vacunas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `vacunas_animal`
--
ALTER TABLE `vacunas_animal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_vacuna` (`id_vacuna`),
  ADD KEY `id_animal` (`id_animal`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `adoptante`
--
ALTER TABLE `adoptante`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cuentas`
--
ALTER TABLE `cuentas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `enfermedades`
--
ALTER TABLE `enfermedades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `enfermedades_animal`
--
ALTER TABLE `enfermedades_animal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT de la tabla `especie`
--
ALTER TABLE `especie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `localidades`
--
ALTER TABLE `localidades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=253;

--
-- AUTO_INCREMENT de la tabla `raza`
--
ALTER TABLE `raza`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=251;

--
-- AUTO_INCREMENT de la tabla `refugios`
--
ALTER TABLE `refugios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tamanyos`
--
ALTER TABLE `tamanyos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tratamientos`
--
ALTER TABLE `tratamientos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tratamientos_animal`
--
ALTER TABLE `tratamientos_animal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `vacunas`
--
ALTER TABLE `vacunas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `vacunas_animal`
--
ALTER TABLE `vacunas_animal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `enfermedades_animal`
--
ALTER TABLE `enfermedades_animal`
  ADD CONSTRAINT `enfermedades_animal_ibfk_2` FOREIGN KEY (`id_enfermedad`) REFERENCES `enfermedades` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `ficha_animal`
--
ALTER TABLE `ficha_animal`
  ADD CONSTRAINT `ficha_animal_ibfk_1` FOREIGN KEY (`raza`) REFERENCES `raza` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ficha_animal_ibfk_2` FOREIGN KEY (`localidad`) REFERENCES `localidades` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ficha_animal_ibfk_3` FOREIGN KEY (`refugio`) REFERENCES `refugios` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ficha_animal_ibfk_4` FOREIGN KEY (`tamanyo`) REFERENCES `tamanyos` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ficha_animal_ibfk_5` FOREIGN KEY (`especie`) REFERENCES `especie` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `raza`
--
ALTER TABLE `raza`
  ADD CONSTRAINT `raza_ibfk_1` FOREIGN KEY (`especie`) REFERENCES `especie` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `tratamientos_animal`
--
ALTER TABLE `tratamientos_animal`
  ADD CONSTRAINT `tratamientos_animal_ibfk_1` FOREIGN KEY (`id_tratamiento`) REFERENCES `tratamientos` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`rol`) REFERENCES `roles` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `vacunas_animal`
--
ALTER TABLE `vacunas_animal`
  ADD CONSTRAINT `vacunas_animal_ibfk_1` FOREIGN KEY (`id_vacuna`) REFERENCES `vacunas` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
