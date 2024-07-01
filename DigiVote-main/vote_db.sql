-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 01 juil. 2024 à 07:55
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `vote_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `enregistrement`
--

CREATE TABLE `enregistrement` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `postnom` varchar(50) DEFAULT NULL,
  `adresse` varchar(100) NOT NULL,
  `numero_identite` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `enregistrement`
--

INSERT INTO `enregistrement` (`id`, `nom`, `prenom`, `postnom`, `adresse`, `numero_identite`, `photo`) VALUES
(51, 'MANASSE', 'Esther', 'KITUMAINI', '28 Av.Equateur', 'ID-843260', ''),
(52, 'NTUMBA', 'Tracy', 'ABOL', 'Av. Prince de Liège', 'ID-959671', ''),
(53, 'MAYELE', 'Emmanuel', 'ZAMBA', '46, Av. Limaya', 'ID-818231', ''),
(54, 'Banza', 'Merveil', 'Kalumba', 'Av Bononge Nu', 'ID-283555', ''),
(55, 'MAYELE', 'Esther', 'ABOL', 'Av Bononge', 'ID-348025', ''),
(56, 'MANASSE', 'Esther', 'KITUMAINI', '28 Av.Equateur', 'ID-645280', ''),
(57, 'MANASSE', 'Esther', 'KITUMAINI', '28 Av.Equateur', 'ID-818225', ''),
(58, 'MANASSE', 'Esther', 'KITUMAINI', '28 Av.Equateur', 'ID-547242', ''),
(59, 'MANASSE', 'Adassa', 'KITUMAINI', '28 Av.Equateur', 'ID-532534', ''),
(60, 'MANASSE', 'Adassa', 'ZAMBA', '28 Av.Equateur', 'ID-279394', ''),
(61, 'NTUMBA', 'Adassa', 'Nabintu', '28 Av.Equateur', 'ID-774257', 'uploads/images (1).jpg'),
(62, 'MANASSE', 'Esther', 'KITUMAINI', '28 Av.Equateur', 'ID-290845', 'uploads/images (7).jpg'),
(63, 'MANASSE', 'Esther', 'KITUMAINI', '28 Av.Equateur', 'ID-774953', 'uploads/images (7).jpg');

-- --------------------------------------------------------

--
-- Structure de la table `unique_codes`
--

CREATE TABLE `unique_codes` (
  `id` int(11) NOT NULL,
  `code` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `unique_codes`
--

INSERT INTO `unique_codes` (`id`, `code`) VALUES
(1, 'b77af22334'),
(2, '1276839c4c'),
(3, '9dd2be5aa3'),
(4, 'a44efa8e75'),
(5, 'f669bdf246'),
(6, '26a12274d7'),
(7, '3315a8ed86'),
(8, 'cbd82a8648'),
(9, '0a45aabb8d'),
(10, '9d6ce6a9ce'),
(11, 'a82831d0af'),
(12, '00fbdcdcaa'),
(13, '51122da126'),
(14, 'd16cc5d17d'),
(15, '8353acc293'),
(16, '8cd1ba111d'),
(17, 'c6fbae380f'),
(18, 'd494592238'),
(19, 'ed279bb915'),
(20, 'eec1f597d7'),
(21, 'f2c13bf9eb'),
(22, '2084109214'),
(23, '11160aebac'),
(24, 'c1e39f5091'),
(25, '6ddda191e2'),
(26, '9f226c77c4'),
(27, 'a12bd19a53'),
(28, '2fcf34d172'),
(29, 'ba9678cb41'),
(30, '61f87195dc'),
(31, '45b8657bcb'),
(32, '2594a66744'),
(33, 'e9892d109c'),
(34, 'ef96d20962'),
(35, 'dc880e29cd'),
(36, '09966921be'),
(37, '9f95fed054'),
(38, '6001b11e53'),
(39, '5d041426f1'),
(40, '70fa12e3fa'),
(41, '01ba85a840'),
(42, '43feaa8cb7'),
(43, '50a6cec8bc'),
(44, 'c897d0edfc'),
(45, 'd42397aa61'),
(46, '15209ce48c'),
(47, '56e1ce372b'),
(48, '34448936c7'),
(49, '9ca5eff638'),
(50, '407f08f0e0'),
(51, '4a1d856303'),
(52, '92466c70eb'),
(53, 'c41e7ab1b0'),
(54, '1cf9d1b7c3'),
(55, '3e9c71958c'),
(56, '3d01f5c635'),
(57, '9ca920242a'),
(58, '2ee3b58888'),
(59, 'cf93f3dd4e'),
(60, '783e63b453'),
(61, 'a1c12b4543'),
(62, '67f13166c0'),
(63, '3ea45f36a7'),
(64, '0619bf2a19'),
(65, '23a7c149f6'),
(66, 'db04dd0baa'),
(67, 'c172c3736c'),
(68, '3a3ec6f184'),
(69, 'c9ea13e393'),
(70, '31b2971c43'),
(71, 'c2c9bf3fa5'),
(72, 'f15b33d891'),
(73, 'b4c154a2c7'),
(74, '452000baf4'),
(75, 'b5c1c38af0'),
(76, '8a2ae24c12'),
(77, 'e266eb1d9a'),
(78, 'c9a9a3e1af'),
(79, '3d9bfb4bae'),
(80, '61cc1303fd'),
(81, 'd69f8e52e0'),
(82, '126923fd82'),
(83, 'b978fd4b00'),
(84, 'b47ac5d806'),
(85, '9d517fc867'),
(86, 'e28ae72ffe'),
(87, '28d1bf4dd1'),
(88, '8655ce82e1'),
(89, '92e2c49bdd'),
(90, 'b5996dce54'),
(91, '992442f1f9'),
(92, '74d4a9235a'),
(93, '9f61217925'),
(94, '1bac300810'),
(95, 'e905bb54c9'),
(96, 'e2b479903b');

-- --------------------------------------------------------

--
-- Structure de la table `votes`
--

CREATE TABLE `votes` (
  `id` int(11) NOT NULL,
  `option_name` varchar(50) NOT NULL,
  `unique_code` varchar(10) NOT NULL,
  `numero_identite` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `votes`
--

INSERT INTO `votes` (`id`, `option_name`, `unique_code`, `numero_identite`) VALUES
(14, 'Option 1', 'b77af22334', 'ID-843260'),
(16, 'Option 3', 'f669bdf246', 'ID-283555'),
(17, 'Option 3', 'b4c154a2c7', 'ID-959671'),
(18, 'Option 2', '8a2ae24c12', 'ID-818231'),
(19, 'Option 2', 'e28ae72ffe', 'ID-818225');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `enregistrement`
--
ALTER TABLE `enregistrement`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `numero_identite` (`numero_identite`);

--
-- Index pour la table `unique_codes`
--
ALTER TABLE `unique_codes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `numero_identite` (`numero_identite`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `enregistrement`
--
ALTER TABLE `enregistrement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT pour la table `unique_codes`
--
ALTER TABLE `unique_codes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT pour la table `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `votes`
--
ALTER TABLE `votes`
  ADD CONSTRAINT `votes_ibfk_1` FOREIGN KEY (`numero_identite`) REFERENCES `enregistrement` (`numero_identite`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
