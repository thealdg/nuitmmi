-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 11, 2023 at 06:22 PM
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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `merch`
--

INSERT INTO `merch` (`id`, `name`, `price`, `description`) VALUES
(1, 'T-shirt La Nuit MMI 2024', 10, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut efficitur eu purus in ultricies. Donec feugiat consectetur volutpat. Suspendisse vehicula tortor sit amet justo aliquet, non laoreet enim porta. Donec bibendum ligula erat, sed vulputate dolor volutpat sed. Vivamus quam augue, venenatis scelerisque nunc luctus, sollicitudin aliquet purus. Nunc finibus lectus sit amet sodales ultrices. Vivamus ornare posuere nunc ac molestie. Etiam finibus, nisl non dictum venenatis, ligula nulla sagittis dolor, pellentesque dictum risus est eget leo. Curabitur ligula nunc, accumsan et nisi ut, mattis ornare nibh. '),
(2, 'Tote bag La Nuit MMI 2024', 10, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam ac risus tellus. Nunc est erat, condimentum vel tortor eu, tempus iaculis ex. Cras dignissim dolor in laoreet dapibus. Phasellus sed convallis magna, malesuada dictum neque. Donec blandit feugiat rhoncus. Nunc lacinia lorem eget tellus lobortis aliquet. Duis cursus blandit mattis. Aenean vel risus varius, blandit ligula vitae, condimentum urna. '),
(3, 'Ecocup La Nuit MMI 2024', 3, 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Corporis odit mollitia dolore harum expedita, recusandae placeat obcaecati sit iusto ipsam. Asperiores inventore distinctio ex eligendi blanditiis? Sapiente tempore esse quaerat, dolor temporibus nam incidunt maiores ducimus. Quas quia non vero!');

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
) ENGINE=MyISAM AUTO_INCREMENT=89 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `idMerch`, `color`, `size`, `images`, `sold`) VALUES
(1, 1, 'black', 'XS', 'images/products/tshirts/black', 0),
(2, 1, 'black', 'S', 'images/products/tshirts/black', 0),
(3, 1, 'black', 'M', 'images/products/tshirts/black', 0),
(4, 1, 'black', 'L', 'images/products/tshirts/black', 0),
(5, 1, 'black', 'XL', 'images/products/tshirts/black', 0),
(6, 1, 'white', 'XS', 'images/products/tshirts/white', 0),
(7, 1, 'white', 'S', 'images/products/tshirts/white', 0),
(8, 1, 'white', 'M', 'images/products/tshirts/white', 0),
(9, 1, 'white', 'L', 'images/products/tshirts/white', 0),
(10, 1, 'white', 'XL', 'images/products/tshirts/white', 0),
(11, 2, 'black', NULL, 'images/products/totebags', 0),
(12, 3, 'black', NULL, 'images/products/ecocups', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

DROP TABLE IF EXISTS `tickets`;
CREATE TABLE IF NOT EXISTS `tickets` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `surname` text NOT NULL,
  `email` text NOT NULL,
  `token` text NOT NULL,
  `qrCode` text NOT NULL,
  `activated` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  `newsletter` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `password`, `email`, `phone`, `year`, `linkedin`, `admin`, `profilePicture`, `newsletter`) VALUES
(20, 'Admin', 'Admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin@lanuitmmi.fr', '', '2', NULL, 1, 'images/upload/profilePictures/20.jpg', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `validation`
--

DROP TABLE IF EXISTS `validation`;
CREATE TABLE IF NOT EXISTS `validation` (
  `idWork` int NOT NULL,
  `idCategory` int NOT NULL,
  `idUser` int NOT NULL,
  `proof` text,
  `result` tinyint(1) DEFAULT NULL,
  `commentary` text,
  PRIMARY KEY (`idWork`,`idCategory`,`idUser`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
