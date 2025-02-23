-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 23 fév. 2025 à 19:51
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
-- Base de données : `projet_collabo`
--

-- --------------------------------------------------------

--
-- Structure de la table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fichiers`
--

CREATE TABLE `fichiers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_02_12_075908_add_role_to_users_table', 1),
(5, '2025_02_12_085838_create_projects_table', 1),
(6, '2025_02_12_090540_create_taches_table', 1),
(7, '2025_02_17_160215_create_roleprojets_table', 2),
(8, '2025_02_17_160408_create_statuts_table', 2),
(9, '2025_02_17_160430_create_fichiers_table', 2),
(10, '2025_02_17_161520_create_roleprojet_users_table', 2),
(11, '2025_02_19_101442_create_projectusers_table', 2);

-- --------------------------------------------------------

--
-- Structure de la table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('jauresgz1812@gmail.com', '$2y$12$F8GkKkcHaIHHWR7AhBUg8.d.VGsYoSAo05.5.baOfWXXs/Xwc41A6', '2025-02-23 15:20:27');

-- --------------------------------------------------------

--
-- Structure de la table `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `titre` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `statut` enum('en_attente','en_cours','termine') NOT NULL DEFAULT 'en_attente',
  `owner_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `projects`
--

INSERT INTO `projects` (`id`, `titre`, `description`, `date_debut`, `date_fin`, `statut`, `owner_id`, `created_at`, `updated_at`) VALUES
(1, 'The Game', 'this is a gamez', '2025-02-19', '2025-02-27', 'en_attente', 1, '2025-02-19 08:56:15', '2025-02-23 17:19:59'),
(2, 'Constructions', 'un projet de construction', '2025-02-23', '2025-03-08', 'en_attente', 1, '2025-02-23 17:20:30', '2025-02-23 17:20:30'),
(3, 'Voitures', 'Un projet qui parle de voiture', '2025-02-21', '2025-03-09', 'termine', 1, '2025-02-23 17:21:34', '2025-02-23 17:21:34'),
(4, 'Immobilier', 'L\'immobilier', '2025-03-19', '2025-04-24', 'en_cours', 1, '2025-02-23 17:22:20', '2025-02-23 17:22:20');

-- --------------------------------------------------------

--
-- Structure de la table `projectusers`
--

CREATE TABLE `projectusers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role` enum('admin','member') NOT NULL DEFAULT 'member',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `projectusers`
--

INSERT INTO `projectusers` (`id`, `project_id`, `user_id`, `role`, `created_at`, `updated_at`) VALUES
(5, 1, 7, 'member', '2025-02-21 09:02:24', '2025-02-21 09:02:24'),
(8, 1, 1, 'member', '2025-02-21 19:44:01', '2025-02-21 19:44:01'),
(12, 1, 13, 'member', '2025-02-23 15:12:35', '2025-02-23 15:12:35'),
(13, 2, 14, 'member', '2025-02-23 17:22:38', '2025-02-23 17:22:38'),
(14, 2, 8, 'admin', '2025-02-23 17:22:54', '2025-02-23 17:22:54'),
(15, 3, 7, 'member', '2025-02-23 17:23:42', '2025-02-23 17:23:42'),
(16, 3, 4, 'member', '2025-02-23 17:23:50', '2025-02-23 17:23:50'),
(17, 3, 5, 'member', '2025-02-23 17:24:03', '2025-02-23 17:24:03'),
(18, 4, 9, 'admin', '2025-02-23 17:24:36', '2025-02-23 17:24:36'),
(19, 4, 10, 'member', '2025-02-23 17:24:43', '2025-02-23 17:24:43');

-- --------------------------------------------------------

--
-- Structure de la table `roleprojets`
--

CREATE TABLE `roleprojets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `roleprojet_users`
--

CREATE TABLE `roleprojet_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('GGd3Cvz6APf9BSKdYbGsSXjYbuPgg7xiJAYFx6Ea', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36 Edg/133.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiam5YZnhmVkpZQWY1RzFvZWlLdzRDVEZuUElsWkJRYW1Ca2xQWTc0RCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjMxOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvZGFzaGJvYXJkIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1740336684);

-- --------------------------------------------------------

--
-- Structure de la table `statuts`
--

CREATE TABLE `statuts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `taches`
--

CREATE TABLE `taches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `titre` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `date_echeance` date DEFAULT NULL,
  `statut` enum('suspendue','en_cours','termine') NOT NULL DEFAULT 'suspendue',
  `file_path` varchar(255) DEFAULT NULL,
  `assigned_to` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `taches`
--

INSERT INTO `taches` (`id`, `project_id`, `titre`, `description`, `date_echeance`, `statut`, `file_path`, `assigned_to`, `created_at`, `updated_at`) VALUES
(4, 1, 'une tache de The game', 'dfedyhzgjhà_zhegnzuçvgçèzg', '2025-03-09', 'en_cours', 'taches_files/tKMVKaU3Q9oJ1tCedpQuFM9n4ADM9P6ZWvK7lQzZ.png', 1, '2025-02-21 08:33:29', '2025-02-21 08:49:50'),
(5, 1, 'a tache', 'qefgqdqg', '2025-03-07', 'en_cours', 'taches_files/uzG0DWAkPaCCEFzTF74lBvjhWTK2FfwONNZvyFzo.png', 13, '2025-02-23 15:47:02', '2025-02-23 15:49:10'),
(6, 2, 'construire', 'un tache de construction', '2025-02-28', 'en_cours', NULL, 14, '2025-02-23 17:44:38', '2025-02-23 17:44:38'),
(7, 2, 'crépissagf', 'raclage du mur', '2025-02-26', 'suspendue', NULL, 8, '2025-02-23 17:46:37', '2025-02-23 17:46:37'),
(8, 3, 'lavage', 'laver les voitures', '2025-02-27', 'termine', NULL, 5, '2025-02-23 17:47:20', '2025-02-23 17:47:20');

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
  `role` varchar(255) NOT NULL DEFAULT 'member'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(1, 'GZ', 'gz.gozo@gmail.com', NULL, '$2y$12$U5wLvuakgAVCSPrjhpE7s.0Jb2Sei679YxH1ejReGbF6WYm7gLOp.', NULL, '2025-02-12 19:19:15', '2025-02-12 19:19:15', 'member'),
(2, 'Admin User', 'admin@example.com', NULL, '$2y$12$HtWicE.xaQyKYg6FjDf5DuxVPB4MKaj3tKyQMB04pwqfWk2xiGMWO', NULL, '2025-02-19 09:36:21', '2025-02-19 09:36:21', 'admin'),
(4, 'Jerad Greenfelder I', 'timmy03@example.com', '2025-02-19 09:36:22', '$2y$12$ZZMfDzOJcT8S/X//8A6iLOHGmP4eo2DStj8jsJyRN7ZdbtHWEUAwK', 'kKUpIb4OE1', '2025-02-19 09:36:22', '2025-02-19 09:36:22', 'member'),
(5, 'Coy Mraz IV', 'nschaden@example.org', '2025-02-19 09:36:22', '$2y$12$ZZMfDzOJcT8S/X//8A6iLOHGmP4eo2DStj8jsJyRN7ZdbtHWEUAwK', 'bgMYfdpsdt', '2025-02-19 09:36:22', '2025-02-19 09:36:22', 'member'),
(6, 'Edmond Balistreri', 'paucek.karine@example.net', '2025-02-19 09:36:22', '$2y$12$ZZMfDzOJcT8S/X//8A6iLOHGmP4eo2DStj8jsJyRN7ZdbtHWEUAwK', 't9dKIwxEU9', '2025-02-19 09:36:22', '2025-02-19 09:36:22', 'member'),
(7, 'Veronica Jenkins', 'vherzog@example.org', '2025-02-19 09:36:22', '$2y$12$ZZMfDzOJcT8S/X//8A6iLOHGmP4eo2DStj8jsJyRN7ZdbtHWEUAwK', 'JWMEPEDe6b', '2025-02-19 09:36:22', '2025-02-19 09:36:22', 'member'),
(8, 'Mr. Elwyn Mayer', 'njerde@example.net', '2025-02-19 09:36:22', '$2y$12$ZZMfDzOJcT8S/X//8A6iLOHGmP4eo2DStj8jsJyRN7ZdbtHWEUAwK', 'kRn7xXYrTR', '2025-02-19 09:36:22', '2025-02-19 09:36:22', 'member'),
(9, 'Mozelle Beer', 'qharris@example.org', '2025-02-19 09:36:22', '$2y$12$ZZMfDzOJcT8S/X//8A6iLOHGmP4eo2DStj8jsJyRN7ZdbtHWEUAwK', '17kEJgOWV9', '2025-02-19 09:36:22', '2025-02-19 09:36:22', 'member'),
(10, 'Monte Hettinger', 'rmorissette@example.org', '2025-02-19 09:36:22', '$2y$12$ZZMfDzOJcT8S/X//8A6iLOHGmP4eo2DStj8jsJyRN7ZdbtHWEUAwK', 'ULkm2Pw3TV', '2025-02-19 09:36:22', '2025-02-19 09:36:22', 'member'),
(11, 'Golda Metz', 'deangelo.weimann@example.org', '2025-02-19 09:36:22', '$2y$12$ZZMfDzOJcT8S/X//8A6iLOHGmP4eo2DStj8jsJyRN7ZdbtHWEUAwK', 'lws2NfEb99', '2025-02-19 09:36:22', '2025-02-19 09:36:22', 'member'),
(13, 'jauresgz1812', 'jauresgz1812@gmail.com', NULL, '$2y$12$EsjGFTER/9Yc7xqThYtbcOAjWU1iEjvoDEGTvo/UTzvDgHaS.Uo7O', NULL, '2025-02-23 13:51:47', '2025-02-23 13:51:47', 'member'),
(14, 'Dorthy Wehner', 'towne.devan@example.org', '2025-02-23 13:51:48', '$2y$12$9bP5JMuJwdWiu4ybLDeYVOas9/b1wD.ACRVI/psCqWTELTndnPd3K', 'SzAmaNFFxF', '2025-02-23 13:51:48', '2025-02-23 13:51:48', 'member');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Index pour la table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `fichiers`
--
ALTER TABLE `fichiers`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Index pour la table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Index pour la table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `projects_owner_id_foreign` (`owner_id`);

--
-- Index pour la table `projectusers`
--
ALTER TABLE `projectusers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `projectusers_project_id_foreign` (`project_id`),
  ADD KEY `projectusers_user_id_foreign` (`user_id`);

--
-- Index pour la table `roleprojets`
--
ALTER TABLE `roleprojets`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `roleprojet_users`
--
ALTER TABLE `roleprojet_users`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Index pour la table `statuts`
--
ALTER TABLE `statuts`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `taches`
--
ALTER TABLE `taches`
  ADD PRIMARY KEY (`id`),
  ADD KEY `taches_project_id_foreign` (`project_id`),
  ADD KEY `taches_assigned_to_foreign` (`assigned_to`);

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
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `fichiers`
--
ALTER TABLE `fichiers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `projectusers`
--
ALTER TABLE `projectusers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `roleprojets`
--
ALTER TABLE `roleprojets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `roleprojet_users`
--
ALTER TABLE `roleprojet_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `statuts`
--
ALTER TABLE `statuts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `taches`
--
ALTER TABLE `taches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_owner_id_foreign` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `projectusers`
--
ALTER TABLE `projectusers`
  ADD CONSTRAINT `projectusers_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `projectusers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `taches`
--
ALTER TABLE `taches`
  ADD CONSTRAINT `taches_assigned_to_foreign` FOREIGN KEY (`assigned_to`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `taches_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
