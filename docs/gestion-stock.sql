-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3307
-- Généré le : lun. 10 mai 2021 à 14:17
-- Version du serveur :  10.5.4-MariaDB
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestion-stock`
--

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20210510105847', '2021-05-10 11:00:01', 268),
('DoctrineMigrations\\Version20210510111024', '2021-05-10 11:10:33', 61),
('DoctrineMigrations\\Version20210510112026', '2021-05-10 11:20:33', 53),
('DoctrineMigrations\\Version20210510112212', '2021-05-10 11:22:25', 57),
('DoctrineMigrations\\Version20210510122808', '2021-05-10 12:28:20', 50);

--
-- Déchargement des données de la table `paper`
--

INSERT INTO `paper` (`id`, `name`, `reference`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 'TEST', '00001', 5500, '2021-05-10 14:21:58', '2021-05-10 14:21:58'),
(2, 'Nom#2', '00002', 6500, '2021-05-10 14:43:26', '2021-05-10 14:43:26');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
