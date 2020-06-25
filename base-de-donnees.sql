-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 25 juin 2020 à 09:25
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `dashboard`
--

-- --------------------------------------------------------

--
-- Structure de la table `light_change`
--

DROP TABLE IF EXISTS `light_change`;
CREATE TABLE IF NOT EXISTS `light_change` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_change` date NOT NULL,
  `floor` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `position` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `power` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `brand` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `light_change`
--

INSERT INTO `light_change` (`id`, `date_change`, `floor`, `position`, `power`, `brand`) VALUES
(1, '2020-06-10', 'floor 1', 'left', '25W', 'Philips'),
(17, '2020-06-16', 'floor 15', 'right', '85W', 'Xiaomi'),
(18, '2020-06-26', 'floor 9', 'right', '60W', 'Philips'),
(19, '2020-06-21', 'floor 1', 'background', '85W', 'Edison'),
(21, '2020-06-15', 'floor 9', 'right', '85W', 'Philips'),
(22, '2020-06-06', 'floor 18', 'background', '85W', 'Xiaomi'),
(23, '2020-06-20', 'floor 9', 'left', '60W', 'Xiaomi');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
