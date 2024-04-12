-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 12 avr. 2024 à 14:21
-- Version du serveur : 8.0.31
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `petflix`
--

-- --------------------------------------------------------

--
-- Structure de la table `adopter`
--

DROP TABLE IF EXISTS `adopter`;
CREATE TABLE IF NOT EXISTS `adopter` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `adopter`
--

INSERT INTO `adopter` (`id`, `name`, `first_name`, `address`, `email`) VALUES
(24, 'Varieur', 'Henri', '79, place Stanislas 44000 NANTES', 'varieur.henri@mail.fr'),
(25, 'Thibodeau', 'Eustache', '31, rue du Faubourg National 57100 THIONVILLE', 'thibodeau.eustache@mail.fr');

-- --------------------------------------------------------

--
-- Structure de la table `member`
--

DROP TABLE IF EXISTS `member`;
CREATE TABLE IF NOT EXISTS `member` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `member`
--

INSERT INTO `member` (`id`, `name`, `city`, `email`, `phone`) VALUES
(3, 'Susanne Ollivier', 'Cordier-sur-Mercier', 'susanne.ollivier@mail.fr', '02 98 90 74 81'),
(4, 'Vincent Guédry', 'Cayenne', 'guedry.vincent@mail.fr', '05 37 82 86 58');

-- --------------------------------------------------------

--
-- Structure de la table `pet`
--

DROP TABLE IF EXISTS `pet`;
CREATE TABLE IF NOT EXISTS `pet` (
  `id` int NOT NULL AUTO_INCREMENT,
  `adopter_id` int DEFAULT NULL,
  `video_id` int DEFAULT NULL,
  `type_id` int NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `age` int NOT NULL,
  `arrival_date` datetime NOT NULL,
  `adoption_date` datetime DEFAULT NULL,
  `control_date` datetime DEFAULT NULL,
  `total_cost` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E4529B85A0D47673` (`adopter_id`),
  KEY `IDX_E4529B8529C1004E` (`video_id`),
  KEY `IDX_E4529B85C54C8C93` (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `pet`
--

INSERT INTO `pet` (`id`, `adopter_id`, `video_id`, `type_id`, `name`, `age`, `arrival_date`, `adoption_date`, `control_date`, `total_cost`) VALUES
(9, 24, 22, 11, 'Joseph', 3, '2023-11-24 07:52:35', '2024-04-09 00:00:00', '2024-10-09 00:00:00', 87),
(10, NULL, 26, 9, 'Pauline', 1, '2024-01-02 18:53:24', NULL, NULL, 79),
(11, 25, 26, 8, 'Isabelle', 6, '2024-04-03 15:34:44', '2024-04-12 00:00:00', '2024-10-12 00:00:00', 96),
(12, NULL, NULL, 9, 'Bernard', 10, '2023-09-03 17:45:37', NULL, NULL, 79),
(13, NULL, NULL, 9, 'Martin', 8, '2023-08-17 09:04:15', NULL, NULL, 79),
(14, NULL, NULL, 12, 'Alexandre', 9, '2023-05-12 04:46:57', NULL, NULL, 105),
(15, NULL, 23, 8, 'Véronique', 9, '2023-07-05 18:01:15', NULL, NULL, 96),
(16, NULL, 23, 8, 'Laurent', 15, '2023-09-25 09:32:59', NULL, NULL, 96),
(17, NULL, 25, 10, 'René', 7, '2024-04-10 00:00:00', NULL, NULL, 96),
(18, NULL, 24, 13, 'Roland', 15, '2023-06-02 07:14:13', NULL, NULL, 88);

-- --------------------------------------------------------

--
-- Structure de la table `pet_type`
--

DROP TABLE IF EXISTS `pet_type`;
CREATE TABLE IF NOT EXISTS `pet_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `label` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cost` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `pet_type`
--

INSERT INTO `pet_type` (`id`, `label`, `cost`) VALUES
(8, 'Chien', 86),
(9, 'Chat', 69),
(10, 'Oiseau', 78),
(11, 'Poisson', 77),
(12, 'Reptile', 63),
(13, 'Rongeur', 78);

-- --------------------------------------------------------

--
-- Structure de la table `video`
--

DROP TABLE IF EXISTS `video`;
CREATE TABLE IF NOT EXISTS `video` (
  `id` int NOT NULL AUTO_INCREMENT,
  `member_id` int DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `add_date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_7CC7DA2C7597D3FE` (`member_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `video`
--

INSERT INTO `video` (`id`, `member_id`, `url`, `title`, `description`, `add_date`) VALUES
(22, 3, 'https://www.youtube.com/embed/r2vZIfukiGI', 'Joseph le poisson', 'Adoptez Joseph le poisson, il est gentil il fait des bulles', '2023-04-01 13:21:48'),
(23, 3, 'https://www.youtube.com/embed/6hBPvXm3Ovo', 'Véronique et Laurent, couple', 'Véronique ne fait qu\'aboyer sur Laurent ces temps ci depuis que Laurent renifle le derrière de Dorothée notre canin royal à la pause du midi.', '2024-01-05 13:26:59'),
(24, 4, 'https://www.youtube.com/embed/jdN8acYWijk', 'Roland s\'amuse', 'Atelier avec les enfants du mercredi après-midi, une maison pour Roland', '2023-08-25 13:34:33'),
(25, 4, 'https://www.youtube.com/embed/1bq9BeRV15A', 'René s\'ambiance sur la piste', 'René a des goûts musicaux douteux mais il est gentil et il sait très bien voler', '2024-03-18 13:39:23'),
(26, 3, 'https://www.youtube.com/embed/dXFSlbm2ahk', 'Pauline rencontre Isabelle', 'Elles sont devenues meilleures amies 👯‍♀️ du monde 🌍', '2024-01-10 14:05:40');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `pet`
--
ALTER TABLE `pet`
  ADD CONSTRAINT `FK_E4529B8529C1004E` FOREIGN KEY (`video_id`) REFERENCES `video` (`id`),
  ADD CONSTRAINT `FK_E4529B85A0D47673` FOREIGN KEY (`adopter_id`) REFERENCES `adopter` (`id`),
  ADD CONSTRAINT `FK_E4529B85C54C8C93` FOREIGN KEY (`type_id`) REFERENCES `pet_type` (`id`);

--
-- Contraintes pour la table `video`
--
ALTER TABLE `video`
  ADD CONSTRAINT `FK_7CC7DA2C7597D3FE` FOREIGN KEY (`member_id`) REFERENCES `member` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
