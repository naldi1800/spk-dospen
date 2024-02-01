-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table spk.departments
CREATE TABLE IF NOT EXISTS `departments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `department_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `singkatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table spk.departments: ~4 rows (approximately)
INSERT INTO `departments` (`id`, `department_name`, `singkatan`, `created_at`, `updated_at`) VALUES
	(1, 'Sistem Informasi', 'SI', '2024-01-29 22:41:40', '2024-01-29 22:41:40'),
	(2, 'Teknik Informatika', 'TI', '2024-01-29 22:42:03', '2024-01-29 22:42:03'),
	(3, 'Manajemen Informatika', 'MI', '2024-01-29 22:42:22', '2024-01-29 22:42:22'),
	(4, 'Rekayasa Perangkat Lunak', 'RPL', '2024-01-30 00:59:55', '2024-01-30 00:59:55');

-- Dumping structure for table spk.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table spk.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table spk.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table spk.migrations: ~0 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
	(3, '2014_10_12_100000_create_password_resets_table', 1),
	(4, '2019_08_19_000000_create_failed_jobs_table', 1),
	(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(6, '2024_01_27_042628_create_teachers_table', 1),
	(7, '2024_01_27_045302_create_skills_table', 1),
	(8, '2024_01_27_045652_create_positions_table', 1),
	(9, '2024_01_30_140251_create_titles_table', 1),
	(10, '2024_01_30_142406_create_departments_table', 1);

-- Dumping structure for table spk.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table spk.password_resets: ~0 rows (approximately)

-- Dumping structure for table spk.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table spk.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table spk.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table spk.personal_access_tokens: ~0 rows (approximately)

-- Dumping structure for table spk.positions
CREATE TABLE IF NOT EXISTS `positions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `position_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` int NOT NULL,
  `control` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table spk.positions: ~5 rows (approximately)
INSERT INTO `positions` (`id`, `position_name`, `level`, `control`, `created_at`, `updated_at`) VALUES
	(1, 'REKTOR', 1, 0, '2024-01-27 08:49:15', '2024-01-27 08:49:15'),
	(2, 'WR1', 2, 1, '2024-01-27 08:49:29', '2024-01-27 08:49:29'),
	(3, 'WR 2', 2, 1, '2024-01-27 09:06:20', '2024-01-27 09:06:20'),
	(4, 'KETUA JURUSAN TI', 3, 2, '2024-01-27 09:08:27', '2024-01-27 09:08:27'),
	(5, 'Dosen', 3, 2, '2024-01-27 18:07:57', '2024-01-27 18:07:57');

-- Dumping structure for table spk.skills
CREATE TABLE IF NOT EXISTS `skills` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `skill_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `singkatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table spk.skills: ~2 rows (approximately)
INSERT INTO `skills` (`id`, `skill_name`, `singkatan`, `created_at`, `updated_at`) VALUES
	(1, 'Artifitial Intelegent', 'AI', '2024-01-27 09:15:35', '2024-01-27 09:15:35'),
	(2, 'Internet Of Think', 'IOT', '2024-01-27 09:15:41', '2024-01-27 09:15:41');

-- Dumping structure for table spk.teachers
CREATE TABLE IF NOT EXISTS `teachers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `position_id` bigint unsigned NOT NULL,
  `NIDN` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `skills` json NOT NULL,
  `title` json NOT NULL,
  `pembimbing` tinyint(1) NOT NULL DEFAULT '0',
  `penguji` tinyint(1) NOT NULL DEFAULT '0',
  `login` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `teachers_nidn_unique` (`NIDN`),
  UNIQUE KEY `teachers_email_unique` (`email`),
  UNIQUE KEY `teachers_telp_unique` (`telp`),
  KEY `teachers_position_id_foreign` (`position_id`),
  CONSTRAINT `teachers_position_id_foreign` FOREIGN KEY (`position_id`) REFERENCES `positions` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table spk.teachers: ~2 rows (approximately)
INSERT INTO `teachers` (`id`, `position_id`, `NIDN`, `name`, `email`, `telp`, `skills`, `title`, `pembimbing`, `penguji`, `login`, `created_at`, `updated_at`) VALUES
	(1, 1, '1234567', 'NALDI AHMAD NUR PATTY', 'nalditampan23@gmail.com', '12345', '["1", "2"]', '{"S1": ["S.Kom", "S.T"], "S2": "M.Kom"}', 1, 1, 0, '2024-01-28 09:04:30', '2024-01-28 09:04:30'),
	(2, 4, '12345678', 'Admin', 'add@gmail.com', '1234', '["1"]', '{"S2": "M.Kom", "S3": ["Dr", "Egr"]}', 1, 1, 0, '2024-01-28 11:34:27', '2024-01-30 22:34:04');

-- Dumping structure for table spk.titles
CREATE TABLE IF NOT EXISTS `titles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `mahasiswa_i` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mahasiswa_ii` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pembimbing_i` bigint unsigned NOT NULL,
  `pembimbing_ii` bigint unsigned NOT NULL,
  `penguji_i` bigint unsigned NOT NULL,
  `penguji_ii` bigint unsigned NOT NULL,
  `skill` json NOT NULL,
  `jurusan_id` bigint unsigned NOT NULL,
  `tanggal_proposal` date DEFAULT NULL,
  `tanggal_skripsi` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `titles_pembimbing_i_foreign` (`pembimbing_i`),
  KEY `titles_pembimbing_ii_foreign` (`pembimbing_ii`),
  KEY `titles_penguji_i_foreign` (`penguji_i`),
  KEY `titles_penguji_ii_foreign` (`penguji_ii`),
  KEY `titles_jurusan_id_foreign` (`jurusan_id`),
  CONSTRAINT `titles_jurusan_id_foreign` FOREIGN KEY (`jurusan_id`) REFERENCES `departments` (`id`),
  CONSTRAINT `titles_pembimbing_i_foreign` FOREIGN KEY (`pembimbing_i`) REFERENCES `teachers` (`id`),
  CONSTRAINT `titles_pembimbing_ii_foreign` FOREIGN KEY (`pembimbing_ii`) REFERENCES `teachers` (`id`),
  CONSTRAINT `titles_penguji_i_foreign` FOREIGN KEY (`penguji_i`) REFERENCES `teachers` (`id`),
  CONSTRAINT `titles_penguji_ii_foreign` FOREIGN KEY (`penguji_ii`) REFERENCES `teachers` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table spk.titles: ~1 rows (approximately)
INSERT INTO `titles` (`id`, `mahasiswa_i`, `mahasiswa_ii`, `title`, `pembimbing_i`, `pembimbing_ii`, `penguji_i`, `penguji_ii`, `skill`, `jurusan_id`, `tanggal_proposal`, `tanggal_skripsi`, `created_at`, `updated_at`) VALUES
	(1, 'Naldi|182209', '123|1822091', 'GAME Android', 1, 2, 1, 2, '["2"]', 2, '2024-01-30', '2024-01-30', '2024-01-29 23:20:53', '2024-01-30 10:29:06');

-- Dumping structure for table spk.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NIDN` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_nidn_foreign` (`NIDN`),
  CONSTRAINT `users_nidn_foreign` FOREIGN KEY (`NIDN`) REFERENCES `teachers` (`NIDN`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table spk.users: ~2 rows (approximately)
INSERT INTO `users` (`id`, `name`, `NIDN`, `email`, `email_verified_at`, `password`, `remember_token`, `role`, `created_at`, `updated_at`) VALUES
	(1, 'Admin', NULL, 'admin@gmail.com', NULL, '$2y$12$M4ZqfNVtA5XbWuABA1KyeOV5xV/jCEGSjEFhNu.1BzFhpoBvb4VhK', NULL, 0, '2024-01-30 21:41:34', '2024-01-30 21:41:34'),
	(2, 'Admin', NULL, 'admin2@gmail.com', NULL, '$2y$12$M4ZqfNVtA5XbWuABA1KyeOV5xV/jCEGSjEFhNu.1BzFhpoBvb4VhK', NULL, 1, '2024-01-30 21:41:34', '2024-01-30 21:41:34');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
