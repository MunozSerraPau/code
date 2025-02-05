-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-02-2025 a las 20:21:42
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pt04_pau_munoz`
--
CREATE DATABASE IF NOT EXISTS `pt04_pau_munoz` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `pt04_pau_munoz`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `campeones`
--

DROP TABLE IF EXISTS `campeones`;
CREATE TABLE `campeones` (
  `id` int(1) NOT NULL COMMENT 'Id del Campio',
  `name` varchar(50) NOT NULL COMMENT 'Nom del campio',
  `description` text NOT NULL COMMENT 'Descripcio del Campio',
  `resource` varchar(30) NOT NULL COMMENT 'Que consumeixen les seves habilitats (mana, energia, vida...)',
  `role` varchar(30) NOT NULL COMMENT 'El rol que te (Mago, Assesion, Tanque...)',
  `creator` varchar(50) NOT NULL COMMENT 'Usuari que ha creat el campio'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `campeones`
--

INSERT INTO `campeones` (`id`, `name`, `description`, `resource`, `role`, `creator`) VALUES
(1, 'Ahrirgrgrg', 'Ahri es una maga de mid con gran movilidad y control de masas, capaz de atraer a sus enemigos con su Encanto para luego desatar poderosas ráfagas de daño con sus orbes, lo que la convierte en una gran amenaza en duelos 1v1.', 'Mana', '', 'XinLu'),
(2, 'Lee Sin', 'Lee Sin es un luchador y asesino jungla que utiliza energía para ejecutar combos ágiles y devastadores. Con su patada del dragón y su capacidad de movilidad, es una amenaza constante en el mapa.', 'Energy', 'Assassin', 'XinLu'),
(3, 'Jinx', 'Jinx es una tiradora explosiva que destaca en el late game. Con su arsenal de armas, puede causar un gran caos en las peleas gracias a su rango y daño masivo, especialmente con sus cohetes globales.', 'Mana', 'Marksman', 'XinLu'),
(4, 'Leona', 'Leona es una support tanque con habilidades de control de masas que puede iniciarse con su Espada del Zenith y absorber daño para su equipo, protegiendo a sus aliados mientras inmoviliza a los enemigos.', 'Mana', 'Tank', 'XinLu'),
(5, 'Riven', 'Riven es una luchadora con gran movilidad y capacidad de ejecución. Su habilidad para cancelar animaciones y encadenar ataques hace que sea un campeón altamente técnico, peligroso en peleas prolongadas.', 'None', 'Fighter', 'XinLu'),
(7, 'Senna Isla de la Muerte', 'Senna es un support tirador que combina daño a distancia con habilidades de apoyo. Con su definitiva global y su capacidad de curar y dañar al mismo tiempo, es una campeona versátil que puede proteger y atacar.', 'Mana', 'Marksman', 'XinLu'),
(8, 'Thresh', 'Thresh es un support tanque que puede atrapar a sus enemigos con su Gancho Mortal y crear jugadas agresivas con su linterna, capaz de iniciar peleas o proteger a su equipo con su kit de habilidades únicas.', 'Mana', 'Tank', 'XinLu'),
(9, 'Zed', 'Zed es un asesino de energía que sobresale en eliminar objetivos vulnerables con sus sombras y daño explosivo. Su habilidad definitiva le permite entrar y salir de peleas rápidamente, asegurando muertes cruciales.', 'Energy', '', 'XinLu'),
(10, 'Garen', 'Garen es un luchador tanque con regeneración pasiva y habilidades que le permiten dominar su línea. Con su Justicia Demaciana, puede eliminar rápidamente a los campeones enemigos con poca vida.', 'None', '', 'XinLu'),
(11, 'Lux', 'Lux es una maga con habilidades de largo alcance que puede aturdir a múltiples enemigos y desatar poderosos rayos de luz. Su definitiva global la hace peligrosa a grandes distancias, ideal para rematar enemigos.', 'Mana', 'Mage', 'XinLu'),
(12, 'Irelia', 'Irelia es una luchadora ágil y peligrosa, con habilidades que le permiten enfrentarse a varios enemigos al mismo tiempo. Su capacidad para lanzar cuchillas y encadenar saltos la convierte en una gran duelista.', 'Mana', 'Fighter', 'XinLu'),
(13, 'Ekko', 'Ekko es un asesino con la habilidad única de retroceder en el tiempo para corregir errores y recuperar vida. Su capacidad de burst y su movilidad lo hacen mortal en situaciones de emboscada y peleas en equipo.', 'Mana', 'Assassin', 'XinLu'),
(14, 'Kai’Sa', 'Kai’Sa es una tiradora híbrida que escala fuertemente en el late game. Con su capacidad para evolucionar sus habilidades, puede adaptarse a diferentes estilos de juego y maximizar su daño en peleas prolongadas.', 'Mana', 'Marksman', 'XinLu'),
(15, 'Vayne', 'Vayne es una tiradora de alta movilidad que destaca en el late game. Con su Rollo y su habilidad de derribar enemigos tanques gracias a sus golpes plateados, es una amenaza constante en las peleas largas.', 'Mana', 'Marksman', 'XinLu'),
(17, 'Shen', 'Shen es un tanque con capacidad de proteger a sus aliados en todo el mapa gracias a su definitiva. Con su habilidad para bloquear ataques y su presencia global, Shen es una pieza clave en las composiciones de equipo.', 'Energy', 'Tank', 'PauMunozSerra'),
(18, 'Miss Fortune', 'Miss Fortune es una tiradora con habilidades de gran dañogr en área. Su definitiva es devastadora en peleas en equipo, especialmente cuando consigue alinear a varios enemigos con su lluvia de balas.', 'Mana', '', 'PauMunozSerra'),
(19, 'Nautilus', '', 'Mana', '', 'PauMunozSerra'),
(20, 'Rengar', 'Rengar es un asesino feroz que caza a sus presas saltando desde la maleza. Acumula ferocidad y puede volverse invisible con su definitiva, lo que lo convierte en una amenaza constante para los tiradores enemigos.', 'Ferocity', 'Assassin', 'PauMunozSerra'),
(21, 'Anivia', 'Anivia es una maga especializada en controlar zonas y ralentizar enemigos. Su muro de hielo y su tormenta glacial hacen que sea una campeona excepcional para controlar el ritmo de las peleas en equipo.', 'Mana', 'Mage', 'PauMunozSerra'),
(22, 'Ezreal', 'Ezreal es un tirador con gran movilidad y habilidades de poke. Su capacidad de moverse rápidamente y lanzar habilidades desde la distancia lo convierte en un campeón seguro pero altamente letal en peleas largas.', 'Mana', '', 'PauMunozSerra'),
(23, 'Morgana', 'Morgana es una maga y support que destaca por su capacidad de controlar a los enemigos y proteger a sus aliados con su escudo antihechizos. Su definitiva puede ser devastadora en peleas en equipo bien coordinadas.', 'Mana', 'Mage', 'PauMunozSerra'),
(24, 'Olaf', 'Olaf es un luchador que se vuelve imparable en medio de las peleas, capaz de lanzarse hacia los enemigos sin preocuparse por el control de masas. Su capacidad de curación y daño sostenido lo hacen muy resistente.', 'Mana', 'Fighter', 'PauMunozSerra'),
(25, 'Cassiopeia', 'Cassiopeia es una maga especializada en infligir daño por segundo a sus enemigos. Su capacidad de envenenar y lanzar hechizos repetidamente la convierte en una amenaza constante, especialmente en peleas prolongadas.', 'Mana', '', 'PauMunozSerra'),
(26, 'Kha’Zix', 'Kha’Zix es un asesino que evoluciona sus habilidades conforme asesina enemigos. Con su capacidad de camuflaje y saltos, es una amenaza constante para los campeones que se quedan aislados o en el backline enemigo.', 'Mana', 'Assassin', 'PauMunozSerra'),
(27, 'Sejuani', 'Sejuani es una tanque con gran capacidad de iniciación, gracias a su definitiva que congela a los enemigos en un área grande. Es ideal para iniciar peleas en equipo y mantener a los enemigos bajo control.', 'Mana', '', 'PauMunozSerra'),
(28, 'Aatrox', 'Aatrox es un luchador que brilla en peleas prolongadas gracias a su gran capacidad de curación y daño. Su definitiva le permite resucitar tras la muerte, lo que lo convierte en un oponente difícil de eliminar.', 'None', '', 'PauMunozSerra'),
(29, 'Veigar', 'Veigar es un mago que escala infinitamente con su habilidad pasiva, acumulando poder de habilidad a lo largo del juego. Su capacidad de burst y su jaula de aturdimiento lo hacen letal en el late game.', 'Mana', 'Mage', 'PauMunozSerra'),
(30, 'Tristana', 'Tristana es una tiradora con gran capacidad de asedio y movilidad. Su salto y su definitiva la convierten en una campeona segura en peleas, mientras destruye torretas y enemigos con su rango creciente.', 'Mana', 'Marksman', 'PauMunozSerra'),
(31, 'Zac', 'Zac es el resultado de un vertido tóxico que recorría una veta tecnoquímica y fue a parar a una profunda caverna apartada en el sumidero de Zaun. A pesar de sus humildes orígenes, Zac ha pasado de ser un flujo primitivo a un ser pensante que habita en las cañerías de la ciudad y que, de vez en cuando, abandona su morada para ayudar a los más desvalidos o reconstruir las infraestructuras destruidas de Zaun.', 'vida', 'Tank', 'PauMunozSerra'),
(39, 'Zoei', 'Dona espacial', 'Mana', '', 'PauMunozSerra'),
(50, 'yjhrtg', 'uytjrhge', 'Mana', 'Assassin', 'PauMunozSerra'),
(51, '`-OPIÑLIK', '`-OPI.OUI', 'p`-OP.IO', 'Marksman', 'PauMunozSerra'),
(52, 'fwe', 'fwe', 'fwe', 'Mage', 'LuisG'),
(53, 'ads', 'asd', 'asd', 'Controller', 'PauMunozSerra');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `campeons_api`
--

DROP TABLE IF EXISTS `campeons_api`;
CREATE TABLE `campeons_api` (
  `id` int(11) NOT NULL COMMENT 'id del campio',
  `nameCampio` varchar(50) NOT NULL COMMENT 'Nom del campio no es repetiran',
  `tagsCampio` varchar(50) NOT NULL COMMENT 'Tipus que consumeixen',
  `imgCampio` varchar(50) NOT NULL COMMENT 'Nom de la img'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `campeons_api`
--

INSERT INTO `campeons_api` (`id`, `nameCampio`, `tagsCampio`, `imgCampio`) VALUES
(1, 'Fiddlesticks', 'Mage', 'Fiddlesticks.png'),
(2, 'Hecarim', 'Fighter', 'Hecarim.png'),
(3, 'Morgana', 'Mage', 'Morgana.png'),
(4, 'Ornn', 'Tank', 'Ornn.png'),
(5, 'Zac', 'Tank', 'Zac.png'),
(6, 'Aatrox', 'Fighter', 'Aatrox.png'),
(7, 'Ahri', 'Mage', 'Ahri.png'),
(8, 'Akali', 'Assassin', 'Akali.png'),
(9, 'Akshan', 'Marksman', 'Akshan.png'),
(10, 'Alistar', 'Tank', 'Alistar.png'),
(11, 'Anivia', 'Mage', 'Anivia.png'),
(12, 'Amumu', 'Tank', 'Amumu.png'),
(13, 'Annie', 'Mage', 'Annie.png'),
(14, 'Aurelion Sol', 'Mage', 'AurelionSol.png'),
(15, 'Aphelios', 'Marksman', 'Aphelios.png'),
(16, 'Ashe', 'Marksman', 'Ashe.png'),
(17, 'Blitzcrank', 'Tank', 'Blitzcrank.png'),
(18, 'Zed', 'Assassin', 'Zed.png'),
(19, 'Zeri', 'Marksman', 'Zeri.png'),
(20, 'Ziggs', 'Mage', 'Ziggs.png'),
(21, 'Zilean', 'Support', 'Zilean.png'),
(22, 'Zoe', 'Mage', 'Zoe.png'),
(23, 'Aurora', 'Mage', 'Aurora.png'),
(24, 'Briar', 'Fighter', 'Briar.png'),
(25, 'ChoGath', 'Tank', 'Chogath.png'),
(26, 'Dr. Mundo', 'Tank', 'DrMundo.png'),
(27, 'RekSai', 'Fighter', 'RekSai.png'),
(28, 'Renata Glasc', 'Support', 'Renata.png'),
(29, 'Rek Sai', 'Fighter', 'RekSai.png'),
(30, 'Vladimir', 'Mage', 'Vladimir.png'),
(31, 'Yuumi', 'Support', 'Yuumi.png'),
(32, 'Vel Koz', 'Mage', 'Velkoz.png'),
(33, 'Kalista', 'Marksman', 'Kalista.png'),
(34, 'Diana', 'Fighter', 'Diana.png'),
(35, 'Neeko', 'Mage', 'Neeko.png'),
(36, 'Nunu y Willump', 'Tank', 'Nunu.png'),
(37, 'Cho Gath', 'Tank', 'Chogath.png'),
(38, 'Braum', 'Tank', 'Braum.png'),
(39, 'Darius', 'Fighter', 'Darius.png'),
(40, 'Poppy', 'Tank', 'Poppy.png'),
(41, 'Corki', 'Marksman', 'Corki.png'),
(42, 'Olaf', 'Fighter', 'Olaf.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equips`
--

DROP TABLE IF EXISTS `equips`;
CREATE TABLE `equips` (
  `id` int(255) NOT NULL COMMENT 'Id del equip',
  `nom_equip` varchar(100) NOT NULL COMMENT 'Nom del equip no es pot repetir',
  `creator` varchar(50) NOT NULL COMMENT 'Nom del creador (enllaçada amb el nickname del Usuari)',
  `data_creacio` date NOT NULL COMMENT 'La data en el que s''ha creat',
  `qrImage` varchar(255) DEFAULT NULL COMMENT 'URL del qr per poder-ho mostrar'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `equips`
--

INSERT INTO `equips` (`id`, `nom_equip`, `creator`, `data_creacio`, `qrImage`) VALUES
(1, 'Team Main', 'PauMunozSerra', '2025-01-24', 'http://localhost/code/vista/editarEquips.vista.php?idEquip=1'),
(12, 'asda', 'XinLu', '2025-01-27', 'http://localhost/code/vista/editarEquips.vista.php?idEquip=12'),
(36, 'dsaasdsaddsa', 'PauMunozSerra', '2025-01-31', 'http://localhost/code/vista/editarEquips.vista.php?idEquip=36'),
(37, 'hewgeaf', 'PauMunozSerra', '2025-02-01', 'http://localhost/code/vista/editarEquips.vista.php?idEquip=37'),
(38, 'sd', 'PauMunozSerra', '2025-02-03', 'http://localhost/code/vista/editarEquips.vista.php?idEquip=38'),
(39, 'a', 'PauMunozSerra', '2025-02-03', 'http://localhost/code/vista/editarEquips.vista.php?idEquip=39'),
(40, 'k,jmhg', 'PauMunozSerra', '2025-02-03', 'http://localhost/code/vista/editarEquips.vista.php?idEquip=40'),
(41, 'dasadasdasdas', 'PauMunozSerra', '2025-02-03', 'http://localhost/code/vista/editarEquips.vista.php?idEquip=41'),
(42, 'noms raros', 'PauMunozSerra', '2025-02-03', 'http://localhost/code/vista/editarEquips.vista.php?idEquip=42'),
(43, 'Nomas', 'PauMunozSerra', '2025-02-03', 'http://localhost/code/vista/editarEquips.vista.php?idEquip=43'),
(44, 'hoansndasd', 'PauMunozSerra', '2025-02-05', 'http://localhost/code/vista/editarEquips.vista.php?idEquip=44'),
(45, 'lkjhgfds', 'PauMunozSerra', '2025-02-05', 'http://localhost/code/vista/editarEquips.vista.php?idEquip=45'),
(46, 'Full Tank', 'PauMunozSerra', '2025-02-05', 'http://localhost/code/vista/editarEquips.vista.php?idEquip=46'),
(53, 'gaddas', 'PauMunozSerra', '2025-02-05', 'http://localhost/code/vista/editarEquips.vista.php?idEquip=53'),
(54, 'das', 'PauMunozSerra', '2025-02-05', 'http://localhost/code/vista/editarEquips.vista.php?idEquip=54');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equip_campio`
--

DROP TABLE IF EXISTS `equip_campio`;
CREATE TABLE `equip_campio` (
  `idEquip` int(11) NOT NULL,
  `idCampio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `equip_campio`
--

INSERT INTO `equip_campio` (`idEquip`, `idCampio`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(12, 7),
(12, 8),
(12, 9),
(12, 15),
(12, 16),
(36, 7),
(36, 15),
(36, 16),
(36, 14),
(36, 17),
(37, 11),
(37, 13),
(37, 15),
(37, 16),
(37, 14),
(38, 18),
(38, 19),
(38, 20),
(38, 21),
(38, 22),
(39, 10),
(39, 12),
(39, 16),
(39, 14),
(39, 23),
(40, 13),
(40, 15),
(40, 16),
(40, 14),
(40, 17),
(41, 6),
(41, 7),
(41, 8),
(41, 9),
(41, 10),
(42, 24),
(42, 25),
(42, 26),
(42, 27),
(42, 28),
(43, 26),
(43, 29),
(43, 28),
(43, 30),
(43, 31),
(44, 8),
(44, 17),
(44, 23),
(44, 32),
(44, 33),
(45, 17),
(45, 16),
(45, 34),
(45, 35),
(45, 36),
(46, 24),
(46, 37),
(46, 26),
(46, 29),
(46, 28),
(53, 17),
(53, 38),
(53, 39),
(53, 40),
(53, 41),
(54, 24),
(54, 37),
(54, 26),
(54, 42),
(54, 28);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuaris`
--

DROP TABLE IF EXISTS `usuaris`;
CREATE TABLE `usuaris` (
  `nom` varchar(50) DEFAULT NULL COMMENT 'Nom del Usuari',
  `cognoms` varchar(100) NOT NULL COMMENT 'Cognoms del Usuari',
  `correu` varchar(150) NOT NULL COMMENT 'Correu del Usuari',
  `nickname` varchar(50) NOT NULL COMMENT 'NickName del Usuari (Identificador del Uusari i per el que filtrarem la gran majoria de vegadas)',
  `contrasenya` text DEFAULT NULL COMMENT 'Contrasneya del Usuari encriptada',
  `xarxa_social` varchar(25) NOT NULL COMMENT 'Per quan inicis secció amb una xarxa social',
  `administrador` tinyint(1) NOT NULL COMMENT 'Unicamnet per diferenciar l''usuari administrador de la resta',
  `imgPerfil` varchar(255) NOT NULL COMMENT 'Ruta on es guarda la foto de perfil',
  `token_recuperar` varchar(64) DEFAULT NULL COMMENT 'Token per recuperar la contrasenya',
  `token_expiration` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuaris`
--

INSERT INTO `usuaris` (`nom`, `cognoms`, `correu`, `nickname`, `contrasenya`, `xarxa_social`, `administrador`, `imgPerfil`, `token_recuperar`, `token_expiration`) VALUES
('efnir', 'kognr', 'Agile-Dig82246750ab95863c8@gmail.com', 'Agile-Dig8224', NULL, 'Reddit', 0, '/vistaGlobal/imgPerfil/img6750abaf064d6Fons Pau Muñoz Serra.png', NULL, NULL),
('Elena', 'Ruiz Morales', 'elena.ruiz@example.com', 'ElenaR', '$2y$10$1Vr4wmIxfy4X6NF023NuOOi8B9gB1LMcumCpYbRfJlJiQEA80bTfC', '', 0, '/vistaGlobal/imgPerfil/img674738fc2b5acbackground.webpimg674738fc2b5acbackground.webp	', NULL, NULL),
('Isabel', 'Castro Jiménez', 'isabel.castro@example.com', 'IsabelC', '$2y$10$1Vr4wmIxfy4X6NF023NuOOi8B9gB1LMcumCpYbRfJlJiQEA80bTfC', '', 0, '/vistaGlobal/imgPerfil/img674738fc2b5acbackground.webpimg674738fc2b5acbackground.webp	', NULL, NULL),
('Joan', 'Martínez López', 'joan.martinez@example.com', 'JoanM', '$2y$10$1Vr4wmIxfy4X6NF023NuOOi8B9gB1LMcumCpYbRfJlJiQEA80bTfC', '', 1, '/vistaGlobal/imgPerfil/img674738fc2b5acbackground.webpimg674738fc2b5acbackground.webp	', NULL, NULL),
('Laura', 'López Gómez', 'laura.lopez@example.com', 'LauraL', '$2y$10$1Vr4wmIxfy4X6NF023NuOOi8B9gB1LMcumCpYbRfJlJiQEA80bTfC', '', 0, '/vistaGlobal/imgPerfil/img674740a5926bfbackground.jpg', NULL, NULL),
('Luis', 'Gómez Torres', 'luis.gomez@example.com', 'LuisG', '$2y$10$1Vr4wmIxfy4X6NF023NuOOi8B9gB1LMcumCpYbRfJlJiQEA80bTfC', '', 0, '/vistaGlobal/imgPerfil/default.png', NULL, NULL),
('Marta', 'Sánchez Fernández', 'marta.sanchez@example.com', 'MartaS', '$2y$10$1Vr4wmIxfy4X6NF023NuOOi8B9gB1LMcumCpYbRfJlJiQEA80bTfC', '', 0, '/vistaGlobal/imgPerfil/img674740a5926bfbackground.jpg', NULL, NULL),
('Miguel', 'Díaz García', 'miguel.diaz@example.com', 'MiguelD', '$2y$10$1Vr4wmIxfy4X6NF023NuOOi8B9gB1LMcumCpYbRfJlJiQEA80bTfC', '', 0, '/vistaGlobal/imgPerfil/default.png', NULL, NULL),
('Pablo', 'Hernández Ruiz', 'pablo.hernandez@example.com', 'PabloH', '$2y$10$1Vr4wmIxfy4X6NF023NuOOi8B9gB1LMcumCpYbRfJlJiQEA80bTfC', '', 0, '/vistaGlobal/imgPerfil/default.png', NULL, NULL),
('Pau', 'Muñoz', 'p.muhh6h6hnoz3@sapalomera.cat', 'Pau', '$2y$10$1Vr4wmIxfy4X6NF023NuOOi8B9gB1LMcumCpYbRfJlJiQEA80bTfC', '', 0, '/vistaGlobal/imgPerfil/img674740a5926bfbackground.jpg', NULL, NULL),
('Pau', 'Muñoz', 'paui@gmail.com', 'Pauii', '$2y$10$0CtOOe75TgLmc.IouHMX/uGWt3aglFlOUq7hFxkOQPJPidtAQVxyW', '', 0, '/vistaGlobal/imgPerfil/img674740a5926bfbackground.jpg', NULL, NULL),
('Pau', 'Munoz Serra ', 'munozserrap@gmail.com', 'PauMunozSerra', '$2y$10$z9TYENVT/PNWEhwckSYVWeRsoO7Jx9GHP/McsucQGNjBbQbGC7Btq', '', 1, '/vistaGlobal/imgPerfil/img676303258c41abackground.jpg', 'dad2122f7a286b2bcb7fcc35b8ff66a5ce7b095e889bd5330eed025e8e5c98ed', '2024-12-08 21:32:14'),
('Pol', 'Roig', 'progi@gamil.com', 'proig', '$2y$10$MmJCvMDebg/m2LiCvWvaSeGrVaoocJGXumqZ22/DlWIjq9ohiOona', '', 0, '/vistaGlobal/imgPerfil/default.png', NULL, NULL),
('Pol', 'Roig', 'progi@gamil.comgr', 'proigr', '$2y$10$7jgeD9Qe8yLkZwq9AVtQIuPfTYdA0sugR4QFOXbLPOX7bh9WT201e', '', 0, '/vistaGlobal/imgPerfil/default.png', NULL, NULL),
('Pau', 'Muñoz', 'p.munoz3@sapalomera.cat', 'XinLu', '$2y$10$/Bp5RiTDAaBGf1RzkiAoXuSIWlFUuiYWpjmmG3.tKQPF1Q7UMv7eO', '', 0, '/vistaGlobal/imgPerfil/default.png', NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `campeones`
--
ALTER TABLE `campeones`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `creator` (`creator`);

--
-- Indices de la tabla `campeons_api`
--
ALTER TABLE `campeons_api`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nameCampio` (`nameCampio`);

--
-- Indices de la tabla `equips`
--
ALTER TABLE `equips`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nom_equip` (`nom_equip`),
  ADD KEY `creator` (`creator`);

--
-- Indices de la tabla `equip_campio`
--
ALTER TABLE `equip_campio`
  ADD KEY `idEquip` (`idEquip`),
  ADD KEY `idCampio` (`idCampio`);

--
-- Indices de la tabla `usuaris`
--
ALTER TABLE `usuaris`
  ADD PRIMARY KEY (`nickname`),
  ADD UNIQUE KEY `correu` (`correu`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `campeones`
--
ALTER TABLE `campeones`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT COMMENT 'Id del Campio', AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT de la tabla `campeons_api`
--
ALTER TABLE `campeons_api`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id del campio', AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de la tabla `equips`
--
ALTER TABLE `equips`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT COMMENT 'Id del equip', AUTO_INCREMENT=55;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `campeones`
--
ALTER TABLE `campeones`
  ADD CONSTRAINT `campeones_ibfk_1` FOREIGN KEY (`creator`) REFERENCES `usuaris` (`nickname`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `equips`
--
ALTER TABLE `equips`
  ADD CONSTRAINT `equips_ibfk_1` FOREIGN KEY (`creator`) REFERENCES `usuaris` (`nickname`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `equip_campio`
--
ALTER TABLE `equip_campio`
  ADD CONSTRAINT `equip_campio_ibfk_1` FOREIGN KEY (`idEquip`) REFERENCES `equips` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `equip_campio_ibfk_2` FOREIGN KEY (`idCampio`) REFERENCES `campeons_api` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
