-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : Dim 28 nov. 2021 à 16:42
-- Version du serveur :  8.0.21
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `php04-01-223905`
--

-- --------------------------------------------------------

--
-- Structure de la table `highschool`
--

DROP TABLE IF EXISTS `highschool`;
CREATE TABLE IF NOT EXISTS `highschool` (
  `id` int NOT NULL AUTO_INCREMENT,
  `school_name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `highschool`
--

INSERT INTO `highschool` (`id`, `school_name`) VALUES
(1, 'École A'),
(2, 'École B'),
(3, 'École C');

-- --------------------------------------------------------

--
-- Structure de la table `pupils`
--

DROP TABLE IF EXISTS `pupils`;
CREATE TABLE IF NOT EXISTS `pupils` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `school_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `pupils`
--

INSERT INTO `pupils` (`id`, `name`, `school_id`) VALUES
(1, 'Margaret', 3),
(2, 'Linda', 3);

-- --------------------------------------------------------

--
-- Structure de la table `pupil_sport`
--

DROP TABLE IF EXISTS `pupil_sport`;
CREATE TABLE IF NOT EXISTS `pupil_sport` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pupil_id` int NOT NULL,
  `sport_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `pupil_sport`
--

INSERT INTO `pupil_sport` (`id`, `pupil_id`, `sport_id`) VALUES
(1, 1, 3),
(2, 1, 3),
(3, 2, 3),
(4, 2, 1),
(5, 2, 4);

-- --------------------------------------------------------

--
-- Structure de la table `sports`
--

DROP TABLE IF EXISTS `sports`;
CREATE TABLE IF NOT EXISTS `sports` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sport` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `sports`
--

INSERT INTO `sports` (`id`, `sport`) VALUES
(1, 'Boxe'),
(2, 'Judo'),
(3, 'Football'),
(4, 'Natation'),
(5, 'Cyclisme');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
