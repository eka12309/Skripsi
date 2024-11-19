-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 23, 2024 at 10:27 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qurban`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('00b87e921299de163959fb29d4d1ae59', 'i:1;', 1725862563),
('00b87e921299de163959fb29d4d1ae59:timer', 'i:1725862563;', 1725862563),
('064c78e1d8b0bb5a20e38f599686147b', 'i:1;', 1727078325),
('064c78e1d8b0bb5a20e38f599686147b:timer', 'i:1727078325;', 1727078325),
('0799c968d3ac5c44b529bdea17372053', 'i:1;', 1727075447),
('0799c968d3ac5c44b529bdea17372053:timer', 'i:1727075447;', 1727075447),
('271668873c892ef92cecb1ed23e556ee', 'i:1;', 1727076540),
('271668873c892ef92cecb1ed23e556ee:timer', 'i:1727076540;', 1727076540),
('534d236df4b379ca3ecf0763b2694c93', 'i:1;', 1727077593),
('534d236df4b379ca3ecf0763b2694c93:timer', 'i:1727077593;', 1727077593),
('5abe44f4e34aa684dbbb20ebcb4a0705', 'i:1;', 1725857145),
('5abe44f4e34aa684dbbb20ebcb4a0705:timer', 'i:1725857145;', 1725857145),
('5c9d7c59975718a679ebf909e576a843', 'i:1;', 1727078336),
('5c9d7c59975718a679ebf909e576a843:timer', 'i:1727078336;', 1727078336),
('9bf86d1f29d72a353a44ecbc3bc0730d', 'i:1;', 1727077519),
('9bf86d1f29d72a353a44ecbc3bc0730d:timer', 'i:1727077519;', 1727077519),
('9eb3d2feed031725bb942e014f125820', 'i:1;', 1727078659),
('9eb3d2feed031725bb942e014f125820:timer', 'i:1727078659;', 1727078659),
('9ef4b8733d806c5be3bf23a65a340e0e', 'i:1;', 1726989960),
('9ef4b8733d806c5be3bf23a65a340e0e:timer', 'i:1726989960;', 1726989960),
('admin@admin.com|192.168.82.155', 'i:1;', 1727076540),
('admin@admin.com|192.168.82.155:timer', 'i:1727076540;', 1727076540),
('bc3b12920666397b463da4b3f9883c40', 'i:1;', 1726992492),
('bc3b12920666397b463da4b3f9883c40:timer', 'i:1726992492;', 1726992492),
('c0f0d65649ce15a7ff4861506ffed749', 'i:1;', 1726749840),
('c0f0d65649ce15a7ff4861506ffed749:timer', 'i:1726749840;', 1726749840),
('c525a5357e97fef8d3db25841c86da1a', 'i:2;', 1727079758),
('c525a5357e97fef8d3db25841c86da1a:timer', 'i:1727079758;', 1727079758),
('d84aefc1403f389542ca02eefd834ee4', 'i:1;', 1726992434),
('d84aefc1403f389542ca02eefd834ee4:timer', 'i:1726992434;', 1726992434),
('ecd154699de8a31d31ab8d66d30bc85e', 'i:1;', 1726749856),
('ecd154699de8a31d31ab8d66d30bc85e:timer', 'i:1726749856;', 1726749856),
('f295b4d2d757ff01d0644db9a362c337', 'i:1;', 1726987734),
('f295b4d2d757ff01d0644db9a362c337:timer', 'i:1726987734;', 1726987734),
('fca352abfe1b6e2de9e86285f59af160', 'i:1;', 1727076559),
('fca352abfe1b6e2de9e86285f59af160:timer', 'i:1727076559;', 1727076559);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `daftar_qurban`
--

CREATE TABLE `daftar_qurban` (
  `id_daftar_qurban` bigint(20) UNSIGNED NOT NULL,
  `id_user` varchar(255) NOT NULL,
  `id_seller` varchar(255) NOT NULL,
  `status_pembayaran` varchar(255) DEFAULT NULL,
  `snap_token` varchar(255) NOT NULL,
  `tipe_qurban` varchar(255) NOT NULL,
  `no_hp` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `masjid` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `latitude` decimal(10,7) NOT NULL,
  `longitude` decimal(10,7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
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
-- Table structure for table `group`
--

CREATE TABLE `group` (
  `id_group` bigint(20) UNSIGNED NOT NULL,
  `tipe_hewan` varchar(255) NOT NULL,
  `penjual` varchar(255) NOT NULL,
  `pendaftar` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`pendaftar`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
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
-- Table structure for table `job_batches`
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
-- Table structure for table `masjid`
--

CREATE TABLE `masjid` (
  `id_masjid` bigint(20) UNSIGNED NOT NULL,
  `nama_masjid` varchar(255) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2023_12_08_131611_create_settings_table', 1),
(5, '2024_08_30_013850_add_two_factor_columns_to_users_table', 1),
(6, '2024_08_30_013957_create_personal_access_tokens_table', 1),
(7, '2024_08_30_080025_create_qurban', 2),
(8, '2024_08_30_162029_create_qurbans', 3),
(9, '2024_08_30_162059_create_seller', 3),
(10, '2024_08_30_165529_create_pembayaran', 4),
(11, '2024_09_02_070419_create_daftar_qurban', 5),
(12, '2024_09_02_073039_create_seller', 6),
(13, '2024_09_02_084021_create_daftar_qurban', 7),
(14, '2024_09_02_105820_add_filed_to_daftar_qurban', 8),
(15, '2024_09_02_110108_add_filed_to_seller', 9),
(16, '2024_09_04_142621_create_pembayaran_table', 10),
(17, '2024_09_04_222102_create_transaksi_table', 11),
(18, '2024_09_21_170905_create_group_table', 12),
(19, '2024_09_22_015658_create_group_table', 13),
(20, '2024_09_22_230017_create_masjid_table', 14);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `seller`
--

CREATE TABLE `seller` (
  `id_seller` bigint(20) UNSIGNED NOT NULL,
  `id_user` varchar(255) NOT NULL,
  `tipe_hewan` varchar(255) NOT NULL,
  `umur_qurban` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `quota` int(11) NOT NULL DEFAULT 0,
  `registered` int(11) NOT NULL DEFAULT 0,
  `harga` varchar(255) NOT NULL,
  `harga_per_orang` varchar(255) NOT NULL,
  `latitude` decimal(10,7) DEFAULT NULL,
  `longitude` decimal(10,7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
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
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('9eAHMxwNmiHGp1MRnDitzwse66KvlHnSEU8Y43di', 31, '192.168.82.17', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoic2N1RVpNVG16OXBMaE9MelpzenBLcTFldUxpaFNZaTU5c0U4d1JDNyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly8xOTIuMTY4LjgyLjE3OjgwMDAvZGFmdGFyX3F1cmJhbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjMxO3M6MjE6InBhc3N3b3JkX2hhc2hfc2FuY3R1bSI7czo2MDoiJDJ5JDEyJEViNE9Ia2loSGxTU25DbHZmZTNiT3VPc3VTUXVyTzJOeGk4SGQ1eXZianJXWC4wclMzWC4yIjt9', 1727079366),
('i9arN4tgfGhYyxgOg7Hls2fOTX8KZv7dOfKAso2v', 31, '192.168.82.155', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Mobile Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiQ0VVU29pUWd5SWxnRmsxdmF5bEZ3ZzZVOE9mOXFRYzZtaFFSSTZYMyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly8xOTIuMTY4LjgyLjE3OjgwMDAvZGFmdGFyX3F1cmJhbiI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjMxO3M6MjE6InBhc3N3b3JkX2hhc2hfc2FuY3R1bSI7czo2MDoiJDJ5JDEyJEViNE9Ia2loSGxTU25DbHZmZTNiT3VPc3VTUXVyTzJOeGk4SGQ1eXZianJXWC4wclMzWC4yIjt9', 1727079381),
('IuV01Aj0maWkYjxAxxuShau3nLU1mibIkUh7gjWV', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36', 'YTo2OntzOjM6InVybCI7YTowOnt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9zZXR0aW5nIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo2OiJfdG9rZW4iO3M6NDA6IjgxemlxNldibFhPTnBySWRSQjN5bEFmSmNaTHlBdEdSSml2ZGNrc3oiO3M6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czoyMToicGFzc3dvcmRfaGFzaF9zYW5jdHVtIjtzOjYwOiIkMnkkMTIkNWpzU0QveGVXSEtZYkIweFJYdGdVLlFudFlleHYvVElCRGI1SjhydEpGZEdDUHZCaHVBZUMiO30=', 1727080017);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id_setting` int(10) UNSIGNED NOT NULL,
  `instansi_setting` varchar(255) NOT NULL,
  `pimpinan_setting` varchar(255) NOT NULL,
  `logo_setting` varchar(255) NOT NULL,
  `favicon_setting` varchar(255) NOT NULL,
  `tentang_setting` varchar(255) NOT NULL,
  `keyword_setting` varchar(255) NOT NULL,
  `alamat_setting` varchar(255) NOT NULL,
  `instagram_setting` varchar(255) NOT NULL,
  `youtube_setting` varchar(255) NOT NULL,
  `email_setting` varchar(255) NOT NULL,
  `no_hp_setting` varchar(255) NOT NULL,
  `maps_setting` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id_setting`, `instansi_setting`, `pimpinan_setting`, `logo_setting`, `favicon_setting`, `tentang_setting`, `keyword_setting`, `alamat_setting`, `instagram_setting`, `youtube_setting`, `email_setting`, `no_hp_setting`, `maps_setting`, `created_at`, `updated_at`) VALUES
(1, 'Qurban', 'Qurban', 'asd', 'asd', 'Qurban Ini', 'Qurban', 'Qurban', 'asd', 'asd', 'qurban@gmail.com', '082163725362', 'asds', NULL, '2024-08-30 00:06:47');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` bigint(20) UNSIGNED NOT NULL,
  `id_user` varchar(255) NOT NULL,
  `id_seller` varchar(255) NOT NULL,
  `id_daftar_qurban` varchar(255) NOT NULL,
  `invoice_number` varchar(255) NOT NULL,
  `harga` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `alamat_ts` varchar(255) NOT NULL,
  `masjid_ts` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `name`, `email`, `email_verified_at`, `password`, `role`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', NULL, '$2y$12$5jsSD/xeWHKYbB0xRXtgU.QntYexv/TIBDb5J8rtJFdGCPvBhuAeC', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-29 23:21:35', '2024-08-29 23:21:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `daftar_qurban`
--
ALTER TABLE `daftar_qurban`
  ADD PRIMARY KEY (`id_daftar_qurban`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `group`
--
ALTER TABLE `group`
  ADD PRIMARY KEY (`id_group`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `masjid`
--
ALTER TABLE `masjid`
  ADD PRIMARY KEY (`id_masjid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `seller`
--
ALTER TABLE `seller`
  ADD PRIMARY KEY (`id_seller`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id_setting`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `daftar_qurban`
--
ALTER TABLE `daftar_qurban`
  MODIFY `id_daftar_qurban` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `group`
--
ALTER TABLE `group`
  MODIFY `id_group` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `masjid`
--
ALTER TABLE `masjid`
  MODIFY `id_masjid` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `seller`
--
ALTER TABLE `seller`
  MODIFY `id_seller` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id_setting` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
