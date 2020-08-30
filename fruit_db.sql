-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 08 jan. 2020 à 18:19
-- Version du serveur :  5.7.23
-- Version de PHP :  7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `fruit_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `camion`
--

DROP TABLE IF EXISTS `camion`;
CREATE TABLE IF NOT EXISTS `camion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `matricule` varchar(45) NOT NULL,
  `marque` varchar(45) NOT NULL,
  `couleur` varchar(45) DEFAULT NULL,
  `capacite_en_kg` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `camion`
--

INSERT INTO `camion` (`id`, `matricule`, `marque`, `couleur`, `capacite_en_kg`) VALUES
(1, 'TH-1516-L', 'Berlingo', 'blank', 10000),
(2, 'TH-4875-F', 'Omazda', 'red', 1000),
(3, 'TH-7858-F', 'Mitshibushi', 'pink', 12000);

-- --------------------------------------------------------

--
-- Structure de la table `chargement`
--

DROP TABLE IF EXISTS `chargement`;
CREATE TABLE IF NOT EXISTS `chargement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `numero_chargement` int(10) NOT NULL,
  `destination` varchar(45) DEFAULT NULL,
  `camion` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_chargement_camion1_idx` (`camion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `chargement_fruit`
--

DROP TABLE IF EXISTS `chargement_fruit`;
CREATE TABLE IF NOT EXISTS `chargement_fruit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quantite` int(11) NOT NULL,
  `fruit` int(11) NOT NULL,
  `chargement` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_chargement_fruit_fruit1_idx` (`fruit`),
  KEY `fk_chargement_fruit_chargement1_idx` (`chargement`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `depot`
--

DROP TABLE IF EXISTS `depot`;
CREATE TABLE IF NOT EXISTS `depot` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) NOT NULL,
  `adresse` varchar(45) NOT NULL,
  `nom_gardien` varchar(145) NOT NULL,
  `telephone` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `depot`
--

INSERT INTO `depot` (`id`, `nom`, `adresse`, `nom_gardien`, `telephone`) VALUES
(1, 'Depot Dakar', 'Dakar, Pikine, Wakhinane 3', 'Alassane Samb', '778589658'),
(2, 'Depot Thiès', 'Thiès, Cité Malick Sy', 'Amadou Sarr', '778569856');

-- --------------------------------------------------------

--
-- Structure de la table `fruit`
--

DROP TABLE IF EXISTS `fruit`;
CREATE TABLE IF NOT EXISTS `fruit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) NOT NULL,
  `provenance` varchar(45) NOT NULL,
  `prix_unitaire` int(11) NOT NULL,
  `quantite_stock` varchar(45) DEFAULT NULL,
  `depot` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nom_UNIQUE` (`nom`),
  KEY `fk_fruit_depot_idx` (`depot`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `fruit`
--

INSERT INTO `fruit` (`id`, `nom`, `provenance`, `prix_unitaire`, `quantite_stock`, `depot`) VALUES
(1, 'Mangue', 'Casamance', 150, '12000', 1),
(2, 'Orange', 'Maroc', 200, '8000', 2),
(3, 'Pamplemousse', 'Maroc', 250, '50000', 1),
(4, 'Banane', 'Senegal', 100, '3000', 2),
(5, 'Avocat', 'France', 400, '1000', 1);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `chargement`
--
ALTER TABLE `chargement`
  ADD CONSTRAINT `fk_chargement_camion1` FOREIGN KEY (`camion`) REFERENCES `camion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `chargement_fruit`
--
ALTER TABLE `chargement_fruit`
  ADD CONSTRAINT `fk_chargement_fruit_chargement1` FOREIGN KEY (`chargement`) REFERENCES `chargement` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_chargement_fruit_fruit1` FOREIGN KEY (`fruit`) REFERENCES `fruit` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `fruit`
--
ALTER TABLE `fruit`
  ADD CONSTRAINT `fk_fruit_depot` FOREIGN KEY (`depot`) REFERENCES `depot` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
