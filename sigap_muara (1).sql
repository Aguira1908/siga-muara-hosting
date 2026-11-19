-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Nov 2026 pada 18.01
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sigap_muara`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `activities`
--

CREATE TABLE `activities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `location_name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `meeting_point` varchar(255) NOT NULL,
  `volunteer_needed` int(11) NOT NULL DEFAULT 0,
  `pic_name` varchar(255) NOT NULL,
  `pic_phone` varchar(255) NOT NULL,
  `safety_notes` text DEFAULT NULL,
  `status` enum('draft','published','done','cancelled') NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `activities`
--

INSERT INTO `activities` (`id`, `title`, `description`, `location_name`, `date`, `time`, `meeting_point`, `volunteer_needed`, `pic_name`, `pic_phone`, `safety_notes`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Gotong Royong Bersihkan Eceng Gondok di Pelabuhan', 'Kegiatan rutin membersihkan eceng gondok yang menutupi area pelabuhan.', 'Pelabuhan Muara', '2026-11-03', '08:00:00', 'Kantor Desa Muara', 50, 'Budi (Operator)', '081234567890', 'Wajib membawa sarung tangan dan memakai pelampung jika turun ke perahu.', 'done', '2026-10-31 01:05:00', '2026-11-16 11:21:50'),
(2, 'jadwal memberikan ikan hama', 'eceng gondog tempat berkembangbiak ikan hama', 'pelabuhan', '2026-11-18', '07:00:00', 'depan bakmi', 25, 'martha', '8778254', 'intinya jaga kesehatan wlee', 'published', '2026-11-16 11:20:55', '2026-11-16 11:20:55'),
(3, 'gotong royong', 'bersama bersihkan ecenggondok dan sampah diarea pelabuhan', 'pelabuhan', '2026-11-25', '09:00:00', 'sekitarnya', 25, 'joy siregar', '791765975', 'yang sehat sehat aja ikut yaa:)', 'published', '2026-11-19 06:22:21', '2026-11-19 06:22:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('sigap-muara-cache-902ba3cda1883801594b6e1b452790cc53948fda', 'i:1;', 1795107431),
('sigap-muara-cache-902ba3cda1883801594b6e1b452790cc53948fda:timer', 'i:1795107431;', 1795107431);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
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
-- Struktur dari tabel `jobs`
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
-- Struktur dari tabel `job_batches`
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
-- Struktur dari tabel `media_galleries`
--

CREATE TABLE `media_galleries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('photo','video') NOT NULL,
  `category` varchar(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `video_url` varchar(255) DEFAULT NULL,
  `thumbnail_path` varchar(255) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `is_published` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `media_galleries`
--

INSERT INTO `media_galleries` (`id`, `type`, `category`, `title`, `description`, `file_path`, `video_url`, `thumbnail_path`, `sort_order`, `is_published`, `created_at`, `updated_at`) VALUES
(1, 'video', 'pelabuhan', 'Keindahan Pelabuhan Muara — Video 1', 'Panorama pelabuhan Muara.', 'gallery/videos/11.mp4', NULL, NULL, 1, 1, '2026-10-31 00:34:08', '2026-10-31 00:34:08'),
(2, 'video', 'pelabuhan', 'Keindahan Pelabuhan Muara — Video 2', 'Aktivitas di sekitar pelabuhan Muara.', 'gallery/videos/12.mp4', NULL, NULL, 2, 1, '2026-10-31 00:34:08', '2026-10-31 00:34:08'),
(6, 'photo', 'gotong_royong', 'gotong royong', 'gotong royong bersihkan eceng gondok', 'gallery/images/XxacTgW1z1IuP8JtGZGx7b6WCE3WbqykIQcZ1oXw.jpg', NULL, NULL, 4, 1, '2026-11-16 13:44:54', '2026-11-16 13:44:54'),
(7, 'video', 'pelabuhan', 'Keindahan Muara Danau Toba', 'Panorama sekitar pelabuhan Muara.', 'gallery/videos/3fETOdJwfhXzIXxnsLqtfDkTgZ0kkcua6TLpwLUU.mp4', NULL, NULL, 5, 1, '2026-11-19 06:35:45', '2026-11-19 06:35:45'),
(8, 'video', 'pelabuhan', 'Keindahan Pelabuhan Muara', 'Panorama pelabuhan Muara.', 'gallery/videos/rZ0n8qblXnieOJ66G623A4xVa1Ev5DsAfXOFdRDy.mp4', NULL, NULL, 6, 1, '2026-11-19 06:37:14', '2026-11-19 06:37:14'),
(9, 'video', 'pelabuhan', 'Keindahan Muara', 'ayo jaga kelestarian sekitar danau', 'gallery/videos/ECTsvCxbxrZXjoxFZpOhUSMM8nNZgl9sNXsKARsA.mp4', NULL, NULL, 7, 1, '2026-11-19 06:44:54', '2026-11-19 06:44:54'),
(10, 'photo', 'eceng_gondok', 'eceng gondok', '-', 'gallery/images/hC8yJ6baU9gfNA0gpwKhGgajROta5GhDRZF388xX.jpg', NULL, NULL, 8, 1, '2026-11-19 06:46:43', '2026-11-19 06:46:43'),
(11, 'photo', 'gotong_royong', 'gotong royog', '-', 'gallery/images/clxL8m7Ja3P0rdy0JinSoQgDkJFs3p2lxjHPWDWc.jpg', NULL, NULL, 9, 1, '2026-11-19 06:47:37', '2026-11-19 06:47:37'),
(12, 'photo', 'eceng_gondok', 'eceng gondok', '-', 'gallery/images/4m6NiWEPuDOYjNkoGLIpb3sAmG1AsW2JUVRNNmbx.jpg', NULL, NULL, 10, 1, '2026-11-19 06:48:44', '2026-11-19 06:48:44'),
(13, 'photo', 'gotong_royong', 'gotong royong', '-', 'gallery/images/eEzn0iWuF2I122BwmhJAyKZtuykyTabHCdHmTAvo.jpg', NULL, NULL, 11, 1, '2026-11-19 06:49:28', '2026-11-19 06:49:28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_10_31_070137_create_media_galleries_table', 2),
(5, '2026_10_31_073654_create_reports_table', 3),
(6, '2026_10_31_075227_add_role_to_users_table', 4),
(7, '2026_10_31_080221_create_activities_table', 5),
(8, '2026_10_31_080222_create_volunteer_registrations_table', 5),
(9, '2026_10_31_085649_create_supports_table', 6),
(10, '2026_11_16_140416_create_report_status_histories_table', 7),
(11, '2026_11_16_140529_create_report_comments_table', 7),
(12, '2026_11_16_154628_add_address_details_and_make_coordinates_nullable_to_reports_table', 8),
(13, '2026_11_16_204019_fix_category_column_in_media_galleries_table', 9),
(14, '2026_11_19_093712_add_payment_fields_to_supports_table', 10),
(15, '2026_11_19_101724_create_payment_methods_table', 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `account_name` varchar(255) NOT NULL,
  `account_number` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `reports`
--

CREATE TABLE `reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ticket_number` varchar(255) NOT NULL,
  `is_anonymous` tinyint(1) NOT NULL DEFAULT 0,
  `reporter_name` varchar(255) DEFAULT NULL,
  `reporter_phone` varchar(255) DEFAULT NULL,
  `photo_path` varchar(255) NOT NULL,
  `latitude` decimal(10,7) DEFAULT NULL,
  `longitude` decimal(10,7) DEFAULT NULL,
  `location_name` varchar(255) NOT NULL,
  `density_level` enum('ringan','sedang','berat') NOT NULL,
  `impacts` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`impacts`)),
  `notes` text DEFAULT NULL,
  `status` enum('BARU','DIVERIFIKASI','DIJADWALKAN','DITANGANI','SELESAI','DITOLAK','DITUNDA','BUTUH_DUKUNGAN') NOT NULL DEFAULT 'BARU',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `address_details` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `reports`
--

INSERT INTO `reports` (`id`, `ticket_number`, `is_anonymous`, `reporter_name`, `reporter_phone`, `photo_path`, `latitude`, `longitude`, `location_name`, `density_level`, `impacts`, `notes`, `status`, `created_at`, `updated_at`, `address_details`) VALUES
(1, 'SM-2026-0001', 0, 'joy', '082384901141', 'reports/VF6BaT2ZHEhWgHsZVtlb8aZw8U1qfcwYGAyuQr2Y.png', 3.5754349, 98.6560893, 'plabuhan muara', 'ringan', '[\"bau\"]', NULL, 'SELESAI', '2026-10-31 00:42:36', '2026-11-16 11:27:08', NULL),
(3, 'SM-2026-0002', 0, 'sisca', '099978', 'reports/Sc7fL1jmNaZuEj96qnZAuvEVAfGwEdeQEIOMljdZ.jpg', NULL, NULL, 'muara', 'ringan', '[\"bau\"]', NULL, 'BARU', '2026-11-16 09:01:35', '2026-11-16 09:01:35', 'depan bakmi muara pelabuhan'),
(4, 'SM-2026-0003', 0, 'yaya', '858789', 'reports/yBjRu5W9V8xORXguvf9GSuJdPRSD1fD9B68plQof.jpg', NULL, NULL, 'pelabuhan', 'berat', '[\"lingkungan\"]', 'gaenak dilihat', 'SELESAI', '2026-11-18 04:51:27', '2026-11-19 06:33:15', 'depan rumah joy');

-- --------------------------------------------------------

--
-- Struktur dari tabel `report_comments`
--

CREATE TABLE `report_comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `report_id` bigint(20) UNSIGNED NOT NULL,
  `sender_type` enum('WARGA','ADMIN') NOT NULL,
  `sender_name` varchar(255) DEFAULT NULL,
  `message` text NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `report_status_histories`
--

CREATE TABLE `report_status_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `report_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `changed_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `report_status_histories`
--

INSERT INTO `report_status_histories` (`id`, `report_id`, `status`, `description`, `changed_by`, `created_at`, `updated_at`) VALUES
(1, 3, 'BARU', 'Laporan berhasil dikirim dan menunggu verifikasi.', NULL, '2026-11-16 09:01:35', '2026-11-16 09:01:35'),
(2, 1, 'DIVERIFIKASI', 'Status laporan diperbarui oleh admin.', NULL, '2026-11-16 10:38:39', '2026-11-16 10:38:39'),
(3, 1, 'SELESAI', 'Status laporan diperbarui oleh admin.', NULL, '2026-11-16 11:27:08', '2026-11-16 11:27:08'),
(4, 4, 'BARU', 'Laporan berhasil dikirim dan menunggu verifikasi.', NULL, '2026-11-18 04:51:27', '2026-11-18 04:51:27'),
(5, 4, 'DITANGANI', 'Status laporan diperbarui oleh admin.', NULL, '2026-11-18 04:53:04', '2026-11-18 04:53:04'),
(6, 4, 'SELESAI', 'Status laporan diperbarui oleh admin.', NULL, '2026-11-19 06:33:15', '2026-11-19 06:33:15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
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
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('m4Lo3h0JZajUSRRzE4xPYyYbro7LrmtArESLn6jN', 7, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/157.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoibzN3MjA1YzB1ZlhENExNbEk5cEhIbUtiUmZRZGpvMUNCU2dyRHJjRiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kdWt1bmdhbi9yaW5na2FzYW4iO3M6NToicm91dGUiO3M6MTY6InN1cHBvcnRzLnN1bW1hcnkiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo3O3M6MTc6InBhc3N3b3JkX2hhc2hfd2ViIjtzOjY0OiI1NmMxM2MwMTk2YThkYjUwZWVjOWE5YjdmMzQwZDJkNDAxYjIwZDEyNjExMGFkMDM2YTJmZTZlMDU1OTdmYWJlIjt9', 1795107392),
('pprAcRZULhSkIsHX449lVXA0pyzvdfSjHNE2JTaQ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.147.0 Chrome/150.0.7871.250 Electron/43.8.9 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRGp6bEh5dmdsM1ZkM1VvMm1xT1dpYlRzWTJVNTBSSzFxVzFlM2pSdyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kdWt1bmdhbiI7czo1OiJyb3V0ZSI7czoxNToic3VwcG9ydHMuY3JlYXRlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1795103015),
('z6jNb9Q2cutt8N0422ebqpWIaOSY7dJ85s04HhJ8', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/157.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUElsRmN0Y3g4ZVpFVDlIRUpYNzRudkFNeUVTZEp4YWpidVZIY0hyYSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9fQ==', 1795095122);

-- --------------------------------------------------------

--
-- Struktur dari tabel `supports`
--

CREATE TABLE `supports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `donor_name` varchar(255) DEFAULT NULL,
  `is_anonymous` tinyint(1) NOT NULL DEFAULT 0,
  `origin_rantau` varchar(255) NOT NULL,
  `type` enum('barang','sponsorship') NOT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  `transfer_amount` bigint(20) UNSIGNED DEFAULT NULL,
  `item_details` text NOT NULL,
  `proof_path` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `status` enum('MENUNGGU_VERIFIKASI','TERVERIFIKASI','DIGUNAKAN','DITUTUP','DITOLAK') NOT NULL DEFAULT 'MENUNGGU_VERIFIKASI',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `supports`
--

INSERT INTO `supports` (`id`, `donor_name`, `is_anonymous`, `origin_rantau`, `type`, `payment_method`, `transfer_amount`, `item_details`, `proof_path`, `message`, `status`, `created_at`, `updated_at`) VALUES
(1, 'joy', 0, 'medan', 'sponsorship', NULL, NULL, '5 juta', 'supports/dKFfeO1NoSwAeNuc5ElACMzZrsavqlFjfx2wQYSI.jpg', 'semangat', 'TERVERIFIKASI', '2026-10-31 02:02:42', '2026-11-19 03:13:05'),
(2, NULL, 1, 'medan', 'sponsorship', NULL, NULL, '1 juta', 'supports/FstgUT6oqML7xGvleQroFmYqMe9L9FOc87OJeqXU.jpg', 'semangat', 'TERVERIFIKASI', '2026-10-31 02:03:20', '2026-11-15 20:45:01'),
(3, 'joy', 0, 'medan', 'sponsorship', NULL, NULL, '10 juta', 'supports/Kd0uoKRD0c4zXKosDy8Pdvxk9rlvdiFhea91dexC.jpg', NULL, 'TERVERIFIKASI', '2026-10-31 02:07:08', '2026-11-19 03:12:56'),
(4, 'memei', 0, 'jakarta', 'sponsorship', NULL, NULL, '10000000000', NULL, 'semoga lancar jayaa', 'MENUNGGU_VERIFIKASI', '2026-11-18 04:48:28', '2026-11-18 04:48:28'),
(5, 'dwi', 0, 'belawan', 'sponsorship', 'transfer_bank', 250000, 'semoga bermanfaat', 'supports/4L3IsrPDPewJByYgUiCeqfVIaJKXFaHkxJgwSDhD.png', 'jaya terus muaraa', 'TERVERIFIKASI', '2026-11-19 09:48:01', '2026-11-19 09:56:26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` enum('operator','camat') NOT NULL DEFAULT 'operator',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Operator Kecamatan', 'adminsigap@gmail.com\r\n', 'operator', NULL, '123456', NULL, '2026-10-31 00:54:23', '2026-10-31 00:54:23'),
(2, 'Camat Muara', 'camatsigap@gmail.com', 'camat', NULL, '$2y$12$XOaXTh8qL9PZMHxVglImX.j/lufEafDm1H6Y53NthVc3dTrwd.2Qe', NULL, '2026-10-31 00:54:24', '2026-10-31 04:06:24'),
(3, 'Operator Muara', 'operator@sigapmuara.com', 'operator', NULL, '$2y$12$GO5D2zf6Jk6qHOUxhzvXquvTPWbEpBlgElDaFzNeApMq/jU/c61am', NULL, '2026-11-13 00:28:57', '2026-11-13 00:28:57'),
(4, 'Camat Muara', 'camat@sigapmuara.com', 'camat', NULL, '$2y$12$YgTYSazxvg8hZZKJi5DF6.kHUXQZlb5byTnr3E.TYBxjhruObJ5Ha', NULL, '2026-11-13 00:29:12', '2026-11-13 00:29:12'),
(5, 'Admin Muara', 'admin@gmail.com', 'operator', NULL, '$2y$12$4NAEOpfcOik0HM.9PHgyHOgm3EdkPrSEKNiJOxOy8dlW.V4HIIXoi', NULL, '2026-11-15 12:09:14', '2026-11-15 12:09:14'),
(7, 'Admin Utama', 'admin@sigap.com', 'operator', NULL, '$2y$12$hW.kqPNKVUyH9NPfD7QRn.Eqmxmh/GyZ.r1qYuC/WvQGRCBuTW3g2', NULL, '2026-11-15 12:16:42', '2026-11-15 12:16:42');

-- --------------------------------------------------------

--
-- Struktur dari tabel `volunteer_registrations`
--

CREATE TABLE `volunteer_registrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `activity_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `origin` varchar(255) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `role` enum('pengangkut','pencatat','dokumentasi','logistik','alat') NOT NULL,
  `health_statement` tinyint(1) NOT NULL DEFAULT 0,
  `status` enum('MENDAFTAR','DIKONFIRMASI','HADIR','SELESAI','DAFTAR_TUNGGU','TIDAK_HADIR','DITOLAK') NOT NULL DEFAULT 'MENDAFTAR',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `volunteer_registrations`
--

INSERT INTO `volunteer_registrations` (`id`, `activity_id`, `name`, `phone`, `origin`, `age`, `role`, `health_statement`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'joi', '082384901141', 'simaremare', 20, 'logistik', 1, 'SELESAI', '2026-10-31 01:11:54', '2026-11-16 11:22:05'),
(2, 2, 'joy', '652478', 'tg', 25, 'pencatat', 1, 'MENDAFTAR', '2026-11-16 11:23:32', '2026-11-16 11:23:32');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `media_galleries`
--
ALTER TABLE `media_galleries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `media_galleries_category_is_published_index` (`category`,`is_published`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reports_ticket_number_unique` (`ticket_number`);

--
-- Indeks untuk tabel `report_comments`
--
ALTER TABLE `report_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `report_comments_report_id_created_at_index` (`report_id`,`created_at`);

--
-- Indeks untuk tabel `report_status_histories`
--
ALTER TABLE `report_status_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `report_status_histories_report_id_created_at_index` (`report_id`,`created_at`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `supports`
--
ALTER TABLE `supports`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indeks untuk tabel `volunteer_registrations`
--
ALTER TABLE `volunteer_registrations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `volunteer_registrations_activity_id_foreign` (`activity_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `activities`
--
ALTER TABLE `activities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `media_galleries`
--
ALTER TABLE `media_galleries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `reports`
--
ALTER TABLE `reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `report_comments`
--
ALTER TABLE `report_comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `report_status_histories`
--
ALTER TABLE `report_status_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `supports`
--
ALTER TABLE `supports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `volunteer_registrations`
--
ALTER TABLE `volunteer_registrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `report_comments`
--
ALTER TABLE `report_comments`
  ADD CONSTRAINT `report_comments_report_id_foreign` FOREIGN KEY (`report_id`) REFERENCES `reports` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `report_status_histories`
--
ALTER TABLE `report_status_histories`
  ADD CONSTRAINT `report_status_histories_report_id_foreign` FOREIGN KEY (`report_id`) REFERENCES `reports` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `volunteer_registrations`
--
ALTER TABLE `volunteer_registrations`
  ADD CONSTRAINT `volunteer_registrations_activity_id_foreign` FOREIGN KEY (`activity_id`) REFERENCES `activities` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
