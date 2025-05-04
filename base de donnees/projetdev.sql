-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 04 mai 2025 à 13:58
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projetdev`
--

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_type` varchar(255) NOT NULL,
  `cne` varchar(255) DEFAULT NULL,
  `matricule` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `user_type`, `cne`, `matricule`) VALUES
(4, 'Professeur Test', 'prof@example.com', NULL, '$2y$12$pC2K4NylcfztVJjj70QJCeNHLJS5YPZIxD8eujIs.WCLB517mQJo.', NULL, '2025-05-03 13:21:41', '2025-05-03 13:21:41', 'professor', NULL, 'PROF123'),
(5, 'Étudiant Test', 'student@example.com', NULL, '$2y$12$6KNsIuNqC9uCqOuzUi06UeL7dSjpj92Pge4EeFh3nQQ42oupEW4RO', NULL, '2025-05-03 13:21:41', '2025-05-03 13:21:41', 'student', 'STU123456', NULL),
(6, 'mohamed amine ', 'mohamedaminebaichh@gmail.com', NULL, '$2y$12$7FaKk6ht9L0kdpZ9t4FiZe3N9OYUMyOqMcMRJTT1YHhKIiVMmwq3C', NULL, '2025-05-03 14:36:01', '2025-05-03 14:36:01', 'professor', NULL, 'amine2003'),
(7, 'BAICH', 'amine@gmail.com', NULL, '$2y$12$f3XijEIaGUA.mUwDze0cDOMQSSsEggkygsOI7J5HCdRq7VenXpRmO', NULL, '2025-05-03 18:48:58', '2025-05-03 18:48:58', 'student', '1111111111', NULL),
(8, 'imad imad', 'imad@gmail.com', NULL, '$2y$12$fC3oNwHYUXzieiEpzCXOB.oyHWfnDw5shnBP1nAD5pWlfGnMbXkMa', NULL, '2025-05-03 19:00:57', '2025-05-03 19:00:57', 'professor', NULL, 'imadimad'),
(9, 'kamal', 'kamal@gmail.com', NULL, '$2y$12$7c91NqW8HKW4PwQFbwI9VeeCzKmZtvHjqa99pR5KOExvAoFRvtLAK', NULL, '2025-05-03 19:44:03', '2025-05-03 19:44:03', 'student', 'kamalkamal', NULL),
(11, 'hiba el ouafi', 'hiba@gmail.com', NULL, '$2y$12$oRWqAurvVcpoG4QZjz4nl.6LynYgyGOARPDUz3T6GepDqoCSOJh2W', NULL, '2025-05-03 23:39:55', '2025-05-03 23:39:55', 'professor', 'C136061193', NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
