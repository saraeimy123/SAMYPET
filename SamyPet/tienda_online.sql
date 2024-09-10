-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-07-2023 a las 11:16:41
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tienda_online`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `descripcion` text NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `descuento` tinyint(3) NOT NULL DEFAULT 0,
  `id_categoria` int(11) NOT NULL,
  `activo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `precio`, `descuento`, `id_categoria`, `activo`) VALUES
(1, 'PILSEN DOG\r\n', '<p>¡PELUCHE CON SONIDO CRUJIENTE!</p>\n<br>\nPeluche de cerveza Pilsen para que tu engreído se embriague de diversión !!! Juguete con diseño super atractivo.', '30.00', 10, 1, 1),
(2, 'CRAZY CHICKEN CAT TOY\r\n', '<p><b>Juguete interactivo para gatos:</b></p> las plumas y campanas en el exterior de la bola de comida que gotea, y las luces LED internas pueden atraer la atención del gato, el columpio de resorte elástico lo hace más divertido.\nLa descompresión alivia el aburrimiento, calma las emociones y es duradera.\n', '33.15', 0, 1, 1),
(3, 'BANDANA KEN\r\n', 'BANDANA KEN\r\n', '16.00', 0, 1, 1),
(4, 'PELUCHE SUMMER JENGI\r\n', '<p><b>¡NUEVO PELUCHE!</p></b>\r\n\r\nPeluche 100% hipoalergénico\r\nDiseño llamativo y único\r\nTela resistente y con malla que simula sonido de botella crujiendo', '35.00', 0, 1, 1),
(5, 'ZEEBED SMALL\r\n', '<p>¡ZeeDOG!</p>\r\n<br>\r\n\r\nZee.Bed es la cama para perros más cómoda del mundo. Con espuma viscoelástica, una tecnología desarrollada por la NASA, y microfibra Ultrasoft anti-rayado, las siestas de tu perro nunca volverán a ser las mismas. ¡Eso es consuelo!', '349.00', 0, 1, 1),
(6, 'PONCHO ANDINO AZUL\r\n', '<p>¡NUEVOS PONCHOS ANDINOS!</p>\r\n<br>\r\nDiseño atractivo y súper cómodo para tu bebé!\r\nPerfecto para la temporada, tela resistente y duradera a numerosos lavados\r\n100% hipoalergénico\r\n\r\nDisponible en tallas del XS al XXL\r\nConsultar medidas en las imágenes del producto', '45.00', 15, 1, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
