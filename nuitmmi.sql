-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 29, 2023 at 06:52 PM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nuitmmi`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int NOT NULL,
  `name` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Audiovisuel'),
(2, 'Campagne de communication'),
(3, 'Production graphique'),
(4, 'Développement web');

-- --------------------------------------------------------

--
-- Table structure for table `merch`
--

DROP TABLE IF EXISTS `merch`;
CREATE TABLE IF NOT EXISTS `merch` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` tinytext NOT NULL,
  `price` int NOT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `merch`
--

INSERT INTO `merch` (`id`, `name`, `price`, `description`) VALUES
(1, 'T-shirt La Nuit MMI 2024', 10, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut efficitur eu purus in ultricies. Donec feugiat consectetur volutpat. Suspendisse vehicula tortor sit amet justo aliquet, non laoreet enim porta. Donec bibendum ligula erat, sed vulputate dolor volutpat sed. Vivamus quam augue, venenatis scelerisque nunc luctus, sollicitudin aliquet purus. Nunc finibus lectus sit amet sodales ultrices. Vivamus ornare posuere nunc ac molestie. Etiam finibus, nisl non dictum venenatis, ligula nulla sagittis dolor, pellentesque dictum risus est eget leo. Curabitur ligula nunc, accumsan et nisi ut, mattis ornare nibh. '),
(2, 'Tote bag La Nuit MMI 2024', 10, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam ac risus tellus. Nunc est erat, condimentum vel tortor eu, tempus iaculis ex. Cras dignissim dolor in laoreet dapibus. Phasellus sed convallis magna, malesuada dictum neque. Donec blandit feugiat rhoncus. Nunc lacinia lorem eget tellus lobortis aliquet. Duis cursus blandit mattis. Aenean vel risus varius, blandit ligula vitae, condimentum urna. ');

-- --------------------------------------------------------

--
-- Table structure for table `participation`
--

DROP TABLE IF EXISTS `participation`;
CREATE TABLE IF NOT EXISTS `participation` (
  `idWork` int NOT NULL,
  `idCategory` int NOT NULL,
  `idUser` int NOT NULL,
  PRIMARY KEY (`idCategory`,`idUser`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `preorders`
--

DROP TABLE IF EXISTS `preorders`;
CREATE TABLE IF NOT EXISTS `preorders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `orderNumber` int NOT NULL,
  `name` tinytext NOT NULL,
  `surname` tinytext NOT NULL,
  `email` tinytext NOT NULL,
  `phone` int DEFAULT NULL,
  `idProduct` int NOT NULL,
  `quantity` int NOT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=85 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `preorders`
--

INSERT INTO `preorders` (`id`, `orderNumber`, `name`, `surname`, `email`, `phone`, `idProduct`, `quantity`, `date`) VALUES
(83, 376239, 'Lucas', 'Dombrowski', 'lucas.dombrowski.62129@gmail.com', NULL, 1, 3, NULL),
(84, 275001, 'Lucas', 'Dombrowski', 'lucas.dombrowski.62129@gmail.com', NULL, 11, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idMerch` int NOT NULL,
  `color` tinytext,
  `size` tinytext,
  `images` tinytext NOT NULL,
  `sold` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `idMerch`, `color`, `size`, `images`, `sold`) VALUES
(1, 1, 'black', 'XS', 'images/products/tshirts/black', 3),
(2, 1, 'black', 'S', 'images/products/tshirts/black', 0),
(3, 1, 'black', 'M', 'images/products/tshirts/black', 0),
(4, 1, 'black', 'L', 'images/products/tshirts/black', 0),
(5, 1, 'black', 'XL', 'images/products/tshirts/black', 0),
(6, 1, 'white', 'XS', 'images/products/tshirts/white', 0),
(7, 1, 'white', 'S', 'images/products/tshirts/white', 0),
(8, 1, 'white', 'M', 'images/products/tshirts/white', 0),
(9, 1, 'white', 'L', 'images/products/tshirts/white', 0),
(10, 1, 'white', 'XL', 'images/products/tshirts/white', 0),
(11, 2, 'black', NULL, 'images/products/totebags', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` tinytext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `surname` tinytext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `phone` tinytext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `year` tinytext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `linkedin` tinytext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `admin` tinyint(1) DEFAULT NULL,
  `profilePicture` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `password`, `email`, `phone`, `year`, `linkedin`, `admin`, `profilePicture`) VALUES
(17, 'Lucas', 'Dombrowski', '3e46995bca649e75861e8356567ecbfff8defe08', 'lucas.dombrowski.62129@gmail.com', '06 30 78 50 45', '2', 'https://www.linkedin.com/in/lucas-dombrowski/', 1, 'images/upload/profilePictures/17.png');

-- --------------------------------------------------------

--
-- Table structure for table `validation`
--

DROP TABLE IF EXISTS `validation`;
CREATE TABLE IF NOT EXISTS `validation` (
  `idWork` int NOT NULL,
  `idCategory` int NOT NULL,
  `idUser` int NOT NULL,
  `result` tinyint(1) DEFAULT NULL,
  `commentary` text,
  PRIMARY KEY (`idWork`,`idCategory`,`idUser`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `validation`
--

INSERT INTO `validation` (`idWork`, `idCategory`, `idUser`, `result`, `commentary`) VALUES
(38, 2, 17, 1, NULL),
(36, 1, 17, 1, 'Atteinte aux droits d\'auteurs<br>Non respect des conditions de participation<br>');

-- --------------------------------------------------------

--
-- Table structure for table `works`
--

DROP TABLE IF EXISTS `works`;
CREATE TABLE IF NOT EXISTS `works` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` tinytext NOT NULL,
  `authors` tinytext NOT NULL,
  `link` tinytext,
  `thumbnail` tinytext NOT NULL,
  `description` text NOT NULL,
  `video` tinytext,
  `tools` tinytext NOT NULL,
  `date` date NOT NULL,
  `competition` tinyint(1) NOT NULL DEFAULT '0',
  `context` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `works`
--

INSERT INTO `works` (`id`, `name`, `authors`, `link`, `thumbnail`, `description`, `video`, `tools`, `date`, `competition`, `context`) VALUES
(38, 'Test', 'Dombrowski Lucas', NULL, 'images/upload/1695844704_17.png', 'zrefergetgtr', NULL, 'Photoshop', '2023-09-04', 0, 'Projet personnel'),
(36, 'Test', 'erfjhtuig', NULL, 'images/upload/1695662930_17.png', 'efierogt', NULL, 'rtgtrg', '2023-09-25', 0, 'SAE'),
(37, 'Test', 'Dombrowski Lucas', NULL, 'images/upload/1695844629_17.png', 'zrefergetgtr', NULL, 'Photoshop', '2023-09-04', 0, 'Projet personnel'),
(35, 'Test', 'erfjhtuig', NULL, 'C:\\Users\\lucas\\Desktop\\git\\nuitmmi\\public\\images/upload/1695662916_17.png', 'efierogt', NULL, 'rtgtrg', '2023-09-25', 0, 'SAE');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
