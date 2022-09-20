-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-11-2021 a las 14:27:11
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `inka-pizza3`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `full_name`, `username`, `password`) VALUES
(1, 'Administrator', 'admin', '21232f297a57a5a743894a0e4a801fc3'),
(2, 'jesus', 'jesus', '8f3a64983a9740beee1a8583edc8d4a7'),
(15, 'juan', 'juan', 'a94652aa97c7211ba8954dd15a3cf838'),
(16, 'cristian', 'cristian', 'b08c8c585b6d67164c163767076445d6'),
(17, 'steve', 'steve', 'd69403e2673e611d4cbd3fad6fd1788e');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `title`, `image_name`, `featured`, `active`) VALUES
(12, 'Entradas', 'Food_Category_386.jpg', 'Yes', 'Yes'),
(13, 'Pizzas', 'Food_Category_483.jpg', 'Yes', 'Yes'),
(15, 'Postres', 'Food_Category_732.jpg', 'Yes', 'Yes'),
(16, 'Bebidas', 'Food_Category_621.jpg', 'Yes', 'Yes'),
(17, 'Licores', 'Food_Category_322.jpg', 'Yes', 'Yes'),
(18, 'Pastas', 'Food_Category_453.jpg', 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_food`
--

CREATE TABLE `tbl_food` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_food`
--

INSERT INTO `tbl_food` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES
(12, 'Pizza Alemana Grande', 'Pizza con mozzarella,chorizo,aceitunas negras  y cebolla blanca', '38.00', 'Food-Name-8530.jpg', 13, 'Yes', 'Yes'),
(13, 'Bruschettas de la casa', 'Pan campesino de la casa,tomates, aceitunas verdes,albahaca y aceite de oliva', '20.00', 'Food-Name-1205.jpg', 12, 'Yes', 'Yes'),
(14, 'Helado del Inka', 'Bola de helado con base de mermelada y vino de sauco', '18.00', 'Food-Name-9353.jpg', 15, 'Yes', 'Yes'),
(15, 'Pastas a la huancaina', 'Pasta a la huancaina con carne de 100 gr lomo en trozos', '30.00', 'Food-Name-9421.jpg', 18, 'Yes', 'Yes'),
(16, 'Spaguetti o fetuccini a la bolognesa', 'Spaguetti o Fetuccini a la bolognesa con carne molida', '24.00', 'Food-Name-5963.jpg', 18, 'Yes', 'Yes'),
(17, 'Spaguetti o fetuccini a lo alfredo', 'Spaghetti o fetuccini a lo alfredo con jamón inglés y champiñones', '26.00', 'Food-Name-1528.jpg', 18, 'Yes', 'Yes'),
(18, 'Pastas al pesto ', 'Spaguetti o fettucini al pesto con tocino ahumado', '34.00', 'Food-Name-7354.jpg', 18, 'Yes', 'Yes'),
(19, 'Lasagna bolognesa', 'Lasagna bolognesa con carne molida de 500 gr', '39.00', 'Food-Name-9247.jpg', 18, 'Yes', 'Yes'),
(20, 'Pizza Vegetariana', 'Pizza con mozzarella,champiñones,aceitunas verdes,pimentos,aceite de oliva', '38.00', 'Food-Name-8140.jpg', 13, 'Yes', 'Yes'),
(21, 'Pan al ajo especial', 'Pan campesino de la casa con queso mozzarella y parmesano(6 rodajas)', '12.00', 'Food-Name-753.jpg', 12, 'Yes', 'Yes'),
(22, 'Tapas serranas', 'Con jamón serrano, champiñones, parmesano sobre una tapa fina de hierbas', '20.00', 'Food-Name-6186.jpg', 12, 'Yes', 'Yes'),
(23, 'Panqueque con helado y manjarblanco', 'Panqueque con helado y manjarblanco y fudge', '22.00', 'Food-Name-2849.jpg', 15, 'Yes', 'Yes'),
(24, 'Panqueque de frutas ', 'Panqueque de frutas con fresas, duraznos con manjar blanco y fudge', '22.00', 'Food-Name-5684.jpg', 15, 'Yes', 'Yes'),
(25, 'Panqueque de fresas', 'Panqueque de fresas con fudge y manjarblanco', '20.00', 'Food-Name-2177.jpg', 15, 'Yes', 'Yes'),
(26, 'Bruschettas Mediterraneas', 'Bruschettas Mediterraneas con jamón serrano, aceites verdes y negras', '20.00', 'Food-Name-5932.jpg', 12, 'Yes', 'Yes'),
(27, 'Fetuccini al pesto', 'Spaguetti o fetuccini al pesto con pollo al panko', '30.00', 'Food-Name-4316.jpg', 18, 'Yes', 'Yes'),
(28, 'Pizza Cuchi', 'Pizza Cuchi con mozzarella, tocino ahumado', '38.00', 'Food-Name-8005.jpg', 13, 'Yes', 'Yes'),
(29, 'Pizza K-nibal', 'Pizza K-nibal con jamón inglés,chorizo', '46.00', 'Food-Name-9526.jpg', 13, 'Yes', 'Yes'),
(30, 'Pizza Verme', 'Con mozzarella, jamón inglés, salame, carne de res,con champiñones, parmesano y piña', '50.00', 'Food-Name-3135.jpg', 13, 'Yes', 'Yes'),
(31, 'Pizza Tumi', 'Con mozzarella, jamón inglés, champiñones, aceitunas verdes,pimentón y cebolla blanca', '42.00', 'Food-Name-3063.jpg', 13, 'Yes', 'Yes'),
(32, 'Pizza Mosaico', 'Con mozzarella, salame, aceitunas verdes y cebolla blanca', '38.00', 'Food-Name-1030.jpg', 13, 'Yes', 'Yes'),
(33, 'Pizza Tropical', 'Pizza Tropical con mozzarella, jamón inglés, duraznos y piña', '42.00', 'Food-Name-5134.jpg', 13, 'Yes', 'Yes'),
(34, 'Jarra de Limonada', 'Jarra de Limonada 1 litro', '12.00', 'Food-Name-3065.jpg', 16, 'Yes', 'Yes'),
(35, 'Jarra de chicha morada', 'Jarra de chicha morada 1 litro', '10.00', 'Food-Name-1334.jpg', 16, 'Yes', 'Yes'),
(36, 'Sangría-Jarra', 'Sangría-Jarra 1 litro', '28.00', 'Food-Name-865.jpg', 17, 'Yes', 'Yes'),
(37, 'Chilcano', 'Chilcano -Cuatro gallos', '24.00', 'Food-Name-6969.jpg', 17, 'Yes', 'Yes'),
(38, 'Pisco Sour', 'Pisco Sour-Cuatro Gallos', '24.00', 'Food-Name-2097.jpg', 17, 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(10) UNSIGNED NOT NULL,
  `food` varchar(150) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `customer_contact` varchar(20) NOT NULL,
  `customer_email` varchar(150) NOT NULL,
  `customer_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `food`, `price`, `qty`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES
(1, 'Bruschettas de la casa', '20.00', 1, '20.00', '2021-11-18 07:44:49', 'Delivered', 'jesus', '956272331', 'jesusherbert98@gmail.com', 'Calle Ciro Alegria Mz F Lote 39, La Molina'),
(4, 'Pizza Vegetariana', '38.00', 1, '38.00', '2021-11-19 12:19:39', 'Delivered', 'jesus', '956272331', 'jesusherbert98@gmail.com', 'Calle Ciro Alegria Mz F Lote 39, La Molina '),
(5, 'Helado del Inka', '18.00', 1, '18.00', '2021-11-21 18:12:42', 'Delivered', 'juan', '983922311', 'juan1@gmail.com', 'Av La molina 1153');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_food`
--
ALTER TABLE `tbl_food`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `tbl_food`
--
ALTER TABLE `tbl_food`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
