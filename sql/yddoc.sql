-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : sam. 01 juin 2024 à 11:00
-- Version du serveur : 8.2.0
-- Version de PHP : 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `yddoc`
--

-- --------------------------------------------------------

--
-- Structure de la table `countries`
--

DROP TABLE IF EXISTS `countries`;
CREATE TABLE IF NOT EXISTS `countries` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `dailymovie`
--

DROP TABLE IF EXISTS `dailymovie`;
CREATE TABLE IF NOT EXISTS `dailymovie` (
  `id` int NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `idMovie` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idMovie` (`idMovie`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `directors`
--

DROP TABLE IF EXISTS `directors`;
CREATE TABLE IF NOT EXISTS `directors` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `idtmdb` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idtmdb` (`idtmdb`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `genres`
--

DROP TABLE IF EXISTS `genres`;
CREATE TABLE IF NOT EXISTS `genres` (
  `id` int NOT NULL AUTO_INCREMENT,
  `genre` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- --------------------------------------------------------

--
-- Structure de la table `moviecountries`
--

DROP TABLE IF EXISTS `moviecountries`;
CREATE TABLE IF NOT EXISTS `moviecountries` (
  `idMovie` int NOT NULL,
  `idCountry` int NOT NULL,
  PRIMARY KEY (`idMovie`,`idCountry`),
  KEY `idCountry` (`idCountry`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `moviedirectors`
--

DROP TABLE IF EXISTS `moviedirectors`;
CREATE TABLE IF NOT EXISTS `moviedirectors` (
  `idMovie` int NOT NULL,
  `idDirector` int NOT NULL,
  PRIMARY KEY (`idMovie`,`idDirector`),
  KEY `idDirector` (`idDirector`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `moviegenres`
--

DROP TABLE IF EXISTS `moviegenres`;
CREATE TABLE IF NOT EXISTS `moviegenres` (
  `idMovie` int NOT NULL,
  `idGenre` int NOT NULL,
  PRIMARY KEY (`idMovie`,`idGenre`),
  KEY `idGenre` (`idGenre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- --------------------------------------------------------

--
-- Structure de la table `movies`
--

DROP TABLE IF EXISTS `movies`;
CREATE TABLE IF NOT EXISTS `movies` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `releaseDate` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `runtime` int NOT NULL,
  `posterPath` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `overview` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tagline` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `idtmdb` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idtmdb` (`idtmdb`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `playerhistory`
--

DROP TABLE IF EXISTS `playerhistory`;
CREATE TABLE IF NOT EXISTS `playerhistory` (
  `idUser` int NOT NULL,
  `idDailyMovie` int NOT NULL,
  `tryNumber` int NOT NULL DEFAULT '0',
  `success` tinyint DEFAULT NULL,
  PRIMARY KEY (`idUser`,`idDailyMovie`),
  KEY `playerhistory_ibfk_1` (`idDailyMovie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `pseudo` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `isAdmin` tinyint(1) NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `lastRequestedDate` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `dailymovie`
--
ALTER TABLE `dailymovie`
  ADD CONSTRAINT `dailymovie_ibfk_1` FOREIGN KEY (`idMovie`) REFERENCES `movies` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `moviecountries`
--
ALTER TABLE `moviecountries`
  ADD CONSTRAINT `moviecountries_ibfk_1` FOREIGN KEY (`idCountry`) REFERENCES `countries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `moviecountries_ibfk_2` FOREIGN KEY (`idMovie`) REFERENCES `movies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `moviedirectors`
--
ALTER TABLE `moviedirectors`
  ADD CONSTRAINT `moviedirectors_ibfk_1` FOREIGN KEY (`idDirector`) REFERENCES `directors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `moviedirectors_ibfk_2` FOREIGN KEY (`idMovie`) REFERENCES `movies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `moviegenres`
--
ALTER TABLE `moviegenres`
  ADD CONSTRAINT `moviegenres_ibfk_1` FOREIGN KEY (`idGenre`) REFERENCES `genres` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `moviegenres_ibfk_2` FOREIGN KEY (`idMovie`) REFERENCES `movies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `playerhistory`
--
ALTER TABLE `playerhistory`
  ADD CONSTRAINT `playerhistory_ibfk_1` FOREIGN KEY (`idDailyMovie`) REFERENCES `dailymovie` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `playerhistory_ibfk_2` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
