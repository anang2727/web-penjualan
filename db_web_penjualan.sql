-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 15, 2025 at 01:00 PM
-- Server version: 8.0.30
-- PHP Version: 8.3.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_web_penjualan`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('livewire-rate-limiter:16d36dff9abd246c67dfac3e63b993a169af77e6', 'i:1;', 1759971331),
('livewire-rate-limiter:16d36dff9abd246c67dfac3e63b993a169af77e6:timer', 'i:1759971331;', 1759971331);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detail_pedagang`
--

CREATE TABLE `detail_pedagang` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `no_telepon` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `alamat_lengkap` text NOT NULL,
  `bank_nama` varchar(255) DEFAULT NULL,
  `rekening_nomor` varchar(255) DEFAULT NULL,
  `rekening_nama` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `detail_pedagang`
--

INSERT INTO `detail_pedagang` (`id`, `user_id`, `no_telepon`, `email`, `alamat_lengkap`, `bank_nama`, `rekening_nomor`, `rekening_nama`, `created_at`, `updated_at`) VALUES
(1, 4, '82370646625', NULL, 'orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'qw', 'qwe', 'qwewq', '2025-10-06 04:39:35', '2025-10-06 04:46:32');

-- --------------------------------------------------------

--
-- Table structure for table `detail_petani`
--

CREATE TABLE `detail_petani` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `no_telepon` varchar(255) NOT NULL,
  `email_opsional` varchar(255) DEFAULT NULL,
  `alamat_lengkap` text NOT NULL,
  `komoditas_utama` varchar(255) DEFAULT NULL,
  `bank_nama` varchar(255) DEFAULT NULL,
  `rekening_nomor` varchar(255) DEFAULT NULL,
  `rekening_nama` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `detail_petani`
--

INSERT INTO `detail_petani` (`id`, `user_id`, `no_telepon`, `email_opsional`, `alamat_lengkap`, `komoditas_utama`, `bank_nama`, `rekening_nomor`, `rekening_nama`, `created_at`, `updated_at`) VALUES
(1, 3, '82370646625', 'anangkurniawan2727@gmail.com', 'Jalan simpang Tanjong dusun TM ALI', 'sawi', 'BCA', 'wqeqw', 'qweqw', '2025-10-04 14:37:32', '2025-10-04 14:37:32'),
(2, 3, '82370646625', 'anangkurniawan2727@gmail.com', 'hjgjh', 'sawi', 'BSI', 'wqeqw', 'qweqw', '2025-10-04 14:38:16', '2025-10-04 14:38:16');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hasil_pertanians`
--

CREATE TABLE `hasil_pertanians` (
  `id` bigint UNSIGNED NOT NULL,
  `petani_id` bigint UNSIGNED NOT NULL,
  `nama_hasil` varchar(255) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `stok` int NOT NULL,
  `tanggal_panen` date DEFAULT NULL,
  `deskripsi` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_09_27_135617_add_role_to_users_table', 1),
(5, '2025_09_30_121811_create_hasil_pertanian_table', 1),
(6, '2025_09_30_150550_create_penawarans_table', 1),
(7, '2025_09_30_150719_create_pengajuans_table', 1),
(9, '2025_10_04_215538_create_detail_petani_table', 2),
(10, '2025_10_06_115329_create_detail_pedagang_table', 3),
(11, '2025_10_06_131743_create_stok_pengepul_table', 4),
(12, '2025_10_06_131646_add_stok_fields_to_pengajuan_table', 5),
(13, '2025_10_08_010357_create_postingan_dagangan_table', 6),
(14, '2025_10_08_024009_add_deleted_at_to_postingan_dagangan_table', 7),
(15, '2025_10_08_124407_create_transaksi_pembelian_table', 8),
(16, '2025_10_09_010758_add_payment_proof_to_transaksi_pembelian_table', 9),
(17, '2025_10_10_161609_add_menunggu_pembayaran_to_status_enum_in_transaksi_pembelians_table', 10);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penawarans`
--

CREATE TABLE `penawarans` (
  `id` bigint UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `deskripsi` text,
  `jumlah_kebutuhan` int NOT NULL,
  `harga_perkiraan` decimal(12,2) DEFAULT NULL,
  `tanggal_batas` date DEFAULT NULL,
  `status` enum('aktif','selesai','dibatalkan') NOT NULL DEFAULT 'aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `penawarans`
--

INSERT INTO `penawarans` (`id`, `judul`, `foto`, `deskripsi`, `jumlah_kebutuhan`, `harga_perkiraan`, `tanggal_batas`, `status`, `created_at`, `updated_at`) VALUES
(8, 'Wortel', 'penawarans/01K6HYEXK7BBC19XGM01MDRYR9.png', 'weqww', 231, '132423.00', '0667-06-05', 'selesai', '2025-10-01 23:51:19', '2025-10-01 23:51:19'),
(9, 'Labu siam', 'penawarans/01K6JFZRH8M1JN04YSDYWF5H4R.png', 'kjhkj', 65687, '897698.00', '2007-05-06', 'aktif', '2025-10-02 04:57:37', '2025-10-02 04:57:37');

-- --------------------------------------------------------

--
-- Table structure for table `pengajuans`
--

CREATE TABLE `pengajuans` (
  `id` bigint UNSIGNED NOT NULL,
  `penawaran_id` bigint UNSIGNED NOT NULL,
  `petani_id` bigint UNSIGNED NOT NULL,
  `nama_hasil` varchar(255) NOT NULL,
  `stok_ditawarkan` int NOT NULL,
  `tanggal_panen` date DEFAULT NULL,
  `deskripsi` text,
  `foto` varchar(255) DEFAULT NULL,
  `status` enum('menunggu','diterima','ditolak') NOT NULL DEFAULT 'menunggu',
  `is_stok_generated` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `stok_pengepul_id` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pengajuans`
--

INSERT INTO `pengajuans` (`id`, `penawaran_id`, `petani_id`, `nama_hasil`, `stok_ditawarkan`, `tanggal_panen`, `deskripsi`, `foto`, `status`, `is_stok_generated`, `created_at`, `updated_at`, `stok_pengepul_id`) VALUES
(2, 8, 3, 'sawi', 32, '3234-04-23', 'dsrwe', 'pengajuans/wHHGJ0p79k3nb5hf2ZTRrS8Yij9JcRgK2J9X8bcx.png', 'diterima', 1, '2025-10-02 03:55:49', '2025-10-06 17:29:11', 1);

-- --------------------------------------------------------

--
-- Table structure for table `postingan_dagangans`
--

CREATE TABLE `postingan_dagangans` (
  `id` bigint UNSIGNED NOT NULL,
  `pengepul_id` bigint UNSIGNED NOT NULL,
  `stok_pengepul_id` bigint UNSIGNED NOT NULL,
  `judul_postingan` varchar(255) NOT NULL,
  `deskripsi` text,
  `foto_postingan` varchar(255) DEFAULT NULL,
  `harga_jual_satuan` decimal(12,2) NOT NULL COMMENT 'Harga per satuan yang dipilih',
  `kuantitas_dijual` decimal(10,2) NOT NULL,
  `minimum_order` decimal(10,2) NOT NULL DEFAULT '0.00',
  `satuan` varchar(50) NOT NULL COMMENT 'Satuan penjualan: Kg, Kuintal, Ton',
  `lokasi_stok` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'draft',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `postingan_dagangans`
--

INSERT INTO `postingan_dagangans` (`id`, `pengepul_id`, `stok_pengepul_id`, `judul_postingan`, `deskripsi`, `foto_postingan`, `harga_jual_satuan`, `kuantitas_dijual`, `minimum_order`, `satuan`, `lokasi_stok`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 1, 'dffgh', 'sfdsefretef', 'postingan-dagangan/01K70W37SHWSPVBSGZEB3FV660.png', '54356.00', '252.00', '4.00', 'Kg', 'Mdgffasukkan Kota Anda', 'aktif', '2025-10-07 18:58:35', '2025-10-10 08:17:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text,
  `payload` longtext NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('0XWuuUMC6TsFmcvDIn6dW1KYVS9gVz5YVWe6iXJ3', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36 Edg/141.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiWWEzem93dXdXdDVMbFF6NU9rTzk3djgwN0xUVlB0ZW5WZjVGT2hrTiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQvcGVkYWdhbmcvcGVzYW5hbiI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjQ7fQ==', 1759972778),
('4O0lYVU6soNz5j3MbH0qJS2tHJtbHbH20J72jN8F', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36 Edg/141.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiaXc3WUxsMWVGZjdHWTEzQndEQ1RDYjh1RVJWQVFpTkMzeGZMbzJQNSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQvcGVkYWdhbmcvcGVzYW5hbiI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjQ7fQ==', 1760113119),
('VTD0oEYaRRQ4dZXZnDFk1tvVDlxNBgrtbzZmNwCm', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36 Edg/141.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiTDlsbGNSNWpKU1dod1VxWlluSWpwdTVYbnZBNmx6VTBBODZBd2xoZCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjQ7fQ==', 1760108543),
('zaeYFnxqQENU7H7fY6nuoZChVjS3qQ6Cwr8m0fsB', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36 Edg/141.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSjRUTHJkSXFkVURCUTBuWGFUbWpPWnoxV3FqVUlzZjBiVUdKbzloMSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1759998209);

-- --------------------------------------------------------

--
-- Table structure for table `stok_pengepul`
--

CREATE TABLE `stok_pengepul` (
  `id` bigint UNSIGNED NOT NULL,
  `pengepul_id` bigint UNSIGNED NOT NULL,
  `nama_komoditas` varchar(255) NOT NULL,
  `jumlah_stok_saat_ini` int NOT NULL DEFAULT '0',
  `satuan` varchar(50) NOT NULL,
  `tanggal_masuk` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `stok_pengepul`
--

INSERT INTO `stok_pengepul` (`id`, `pengepul_id`, `nama_komoditas`, `jumlah_stok_saat_ini`, `satuan`, `tanggal_masuk`, `created_at`, `updated_at`) VALUES
(1, 2, 'sawi', 32, 'Kg', '2025-10-07 01:29:11', '2025-10-06 17:29:11', '2025-10-06 17:29:11');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_pembelians`
--

CREATE TABLE `transaksi_pembelians` (
  `id` bigint UNSIGNED NOT NULL,
  `pedagang_id` bigint UNSIGNED NOT NULL,
  `postingan_dagangan_id` bigint UNSIGNED NOT NULL,
  `pengepul_id` bigint UNSIGNED NOT NULL,
  `kode_transaksi` varchar(255) NOT NULL,
  `kuantitas_pesanan` decimal(10,2) NOT NULL,
  `satuan` varchar(15) NOT NULL,
  `harga_satuan` decimal(15,0) NOT NULL,
  `total_harga` decimal(15,0) NOT NULL,
  `status` enum('menunggu_konfirmasi','menunggu_pembayaran','menunggu_verifikasi_pembayaran','diproses','dikirim','selesai','dibatalkan') NOT NULL DEFAULT 'menunggu_konfirmasi',
  `catatan` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transaksi_pembelians`
--

INSERT INTO `transaksi_pembelians` (`id`, `pedagang_id`, `postingan_dagangan_id`, `pengepul_id`, `kode_transaksi`, `kuantitas_pesanan`, `satuan`, `harga_satuan`, `total_harga`, `status`, `catatan`, `created_at`, `updated_at`) VALUES
(10, 4, 1, 2, 'TRX-0LEEMM', '4.00', 'Kg', '54356', '217424', 'menunggu_konfirmasi', NULL, '2025-10-10 07:38:54', '2025-10-10 07:38:54'),
(11, 4, 1, 2, 'TRX-9422W3', '4.00', 'Kg', '54356', '217424', 'menunggu_konfirmasi', NULL, '2025-10-10 07:52:15', '2025-10-10 07:52:15'),
(12, 4, 1, 2, 'TRX-EK7GOU', '4.00', 'Kg', '54356', '217424', 'menunggu_pembayaran', NULL, '2025-10-10 08:17:20', '2025-10-10 08:17:20');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'petani',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Test User', 'test@example.com', '2025-09-30 20:14:34', '$2y$12$62TpumOSoPgBXZ9iO4GQX.nEz1NpeBhxrEq8YnSHJ6VVUEMifFxji', 'petani', 'UH4DlT7YWF', '2025-09-30 20:14:35', '2025-09-30 20:14:35'),
(2, 'Pengepul Utama', 'pengepul@example.com', NULL, '$2y$12$z5nbPtUI/4IlXhiMtwhwKeYlyTMMJr3W2h0.voZy5iUYbsY.MsH8e', 'pengepul', NULL, '2025-09-30 20:22:11', '2025-09-30 20:22:11'),
(3, 'petani1', 'petani1@gmail.com', NULL, '$2y$12$bdP3PQ27KKOO1FczZ6QeB.TFyr94yhry8qjm3HZ8JzKTtKjt8Kl.e', 'petani', NULL, '2025-10-01 23:56:50', '2025-10-01 23:56:50'),
(4, 'pedagang', 'pedagang@gmail.com', NULL, '$2y$12$/CC10sTF4BGdsAGgAOGrYu1eOoM4I9QNNOPrImLungIQyfoGy.p.O', 'pedagang', NULL, '2025-10-04 19:12:43', '2025-10-04 19:12:43');

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
-- Indexes for table `detail_pedagang`
--
ALTER TABLE `detail_pedagang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_pedagang_user_id_foreign` (`user_id`);

--
-- Indexes for table `detail_petani`
--
ALTER TABLE `detail_petani`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_petani_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `hasil_pertanians`
--
ALTER TABLE `hasil_pertanians`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hasil_pertanians_petani_id_foreign` (`petani_id`);

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
-- Indexes for table `penawarans`
--
ALTER TABLE `penawarans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengajuans`
--
ALTER TABLE `pengajuans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengajuans_penawaran_id_foreign` (`penawaran_id`),
  ADD KEY `pengajuans_petani_id_foreign` (`petani_id`),
  ADD KEY `pengajuans_stok_pengepul_id_foreign` (`stok_pengepul_id`);

--
-- Indexes for table `postingan_dagangans`
--
ALTER TABLE `postingan_dagangans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `postingan_dagangans_pengepul_id_foreign` (`pengepul_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `stok_pengepul`
--
ALTER TABLE `stok_pengepul`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stok_pengepul_pengepul_id_foreign` (`pengepul_id`);

--
-- Indexes for table `transaksi_pembelians`
--
ALTER TABLE `transaksi_pembelians`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transaksi_pembelians_kode_transaksi_unique` (`kode_transaksi`),
  ADD KEY `transaksi_pembelians_pedagang_id_foreign` (`pedagang_id`),
  ADD KEY `transaksi_pembelians_postingan_dagangan_id_foreign` (`postingan_dagangan_id`),
  ADD KEY `transaksi_pembelians_pengepul_id_foreign` (`pengepul_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_pedagang`
--
ALTER TABLE `detail_pedagang`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `detail_petani`
--
ALTER TABLE `detail_petani`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hasil_pertanians`
--
ALTER TABLE `hasil_pertanians`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `penawarans`
--
ALTER TABLE `penawarans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pengajuans`
--
ALTER TABLE `pengajuans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `postingan_dagangans`
--
ALTER TABLE `postingan_dagangans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `stok_pengepul`
--
ALTER TABLE `stok_pengepul`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transaksi_pembelians`
--
ALTER TABLE `transaksi_pembelians`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_pedagang`
--
ALTER TABLE `detail_pedagang`
  ADD CONSTRAINT `detail_pedagang_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `detail_petani`
--
ALTER TABLE `detail_petani`
  ADD CONSTRAINT `detail_petani_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `hasil_pertanians`
--
ALTER TABLE `hasil_pertanians`
  ADD CONSTRAINT `hasil_pertanians_petani_id_foreign` FOREIGN KEY (`petani_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pengajuans`
--
ALTER TABLE `pengajuans`
  ADD CONSTRAINT `pengajuans_penawaran_id_foreign` FOREIGN KEY (`penawaran_id`) REFERENCES `penawarans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pengajuans_petani_id_foreign` FOREIGN KEY (`petani_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pengajuans_stok_pengepul_id_foreign` FOREIGN KEY (`stok_pengepul_id`) REFERENCES `stok_pengepul` (`id`);

--
-- Constraints for table `postingan_dagangans`
--
ALTER TABLE `postingan_dagangans`
  ADD CONSTRAINT `postingan_dagangans_pengepul_id_foreign` FOREIGN KEY (`pengepul_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stok_pengepul`
--
ALTER TABLE `stok_pengepul`
  ADD CONSTRAINT `stok_pengepul_pengepul_id_foreign` FOREIGN KEY (`pengepul_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `transaksi_pembelians`
--
ALTER TABLE `transaksi_pembelians`
  ADD CONSTRAINT `transaksi_pembelians_pedagang_id_foreign` FOREIGN KEY (`pedagang_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaksi_pembelians_pengepul_id_foreign` FOREIGN KEY (`pengepul_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaksi_pembelians_postingan_dagangan_id_foreign` FOREIGN KEY (`postingan_dagangan_id`) REFERENCES `postingan_dagangans` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
