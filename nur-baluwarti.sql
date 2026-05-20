-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2026 at 04:59 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nur-baluwarti`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `activity` text NOT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `user_id`, `user_name`, `activity`, `ip_address`, `created_at`, `updated_at`) VALUES
(1, 1, 'admin', 'Memperbarui tata letak komponen teks dan muatan visual foto pada Hero Banner Landing Page Beranda', '127.0.0.1', '2026-05-20 14:44:08', '2026-05-20 14:44:08');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `delivery_schedules`
--

CREATE TABLE `delivery_schedules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `delivery_date` date NOT NULL,
  `delivery_time` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `status` enum('Antrean Dapur','Proses Masak','Siap Kirim','Selesai') NOT NULL DEFAULT 'Antrean Dapur',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `delivery_schedules`
--

INSERT INTO `delivery_schedules` (`id`, `order_id`, `delivery_date`, `delivery_time`, `location`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, '2026-05-21', '12:00', 'Alamat Belum Ditentukan (Edit di Panel)', 'Antrean Dapur', '2026-05-19 22:30:00', '2026-05-19 22:30:00'),
(2, 3, '2026-05-22', '12:00', 'Alamat Belum Ditentukan (Edit di Panel)', 'Antrean Dapur', '2026-05-19 22:56:50', '2026-05-19 22:56:50'),
(3, 4, '2026-05-22', '19:50', 'Alamat Belum Ditentukan (Edit di Panel)', 'Antrean Dapur', '2026-05-20 01:47:03', '2026-05-20 01:47:03'),
(4, 5, '2026-05-21', '20:00', 'Alamat Belum Ditentukan (Edit di Panel)', 'Antrean Dapur', '2026-05-20 01:53:41', '2026-05-20 01:53:41'),
(5, 6, '2026-05-22', '18:59', 'Alamat Belum Ditentukan (Edit di Panel)', 'Antrean Dapur', '2026-05-20 01:56:16', '2026-05-20 01:56:16'),
(6, 7, '2026-05-23', '18:02', 'Alamat Belum Ditentukan (Edit di Panel)', 'Antrean Dapur', '2026-05-20 02:00:53', '2026-05-20 02:00:53'),
(7, 8, '2026-05-22', '20:07', 'Alamat Belum Ditentukan (Edit di Panel)', 'Antrean Dapur', '2026-05-20 02:03:22', '2026-05-20 02:03:22'),
(8, 9, '2026-05-22', '19:10', 'Alamat Belum Ditentukan (Edit di Panel)', 'Antrean Dapur', '2026-05-20 02:07:27', '2026-05-20 02:07:27'),
(9, 10, '2026-05-22', '17:08', 'Alamat Belum Ditentukan (Edit di Panel)', 'Antrean Dapur', '2026-05-20 02:09:03', '2026-05-20 02:09:03'),
(10, 11, '2026-05-23', '19:12', 'Alamat Belum Ditentukan (Edit di Panel)', 'Antrean Dapur', '2026-05-20 02:10:06', '2026-05-20 02:10:06'),
(11, 12, '2026-05-26', '19:17', 'Alamat Belum Ditentukan (Edit di Panel)', 'Antrean Dapur', '2026-05-20 02:13:34', '2026-05-20 02:13:34'),
(12, 13, '2026-05-28', '19:18', 'Alamat Belum Ditentukan (Edit di Panel)', 'Antrean Dapur', '2026-05-20 02:15:13', '2026-05-20 02:15:13'),
(13, 14, '2026-05-29', '20:22', 'Alamat Belum Ditentukan (Edit di Panel)', 'Antrean Dapur', '2026-05-20 02:18:13', '2026-05-20 02:18:13'),
(14, 15, '2026-05-22', '20:23', 'Alamat Belum Ditentukan (Edit di Panel)', 'Antrean Dapur', '2026-05-20 02:20:00', '2026-05-20 02:20:00'),
(15, 16, '2026-05-26', '20:25', 'Alamat Belum Ditentukan (Edit di Panel)', 'Antrean Dapur', '2026-05-20 02:21:53', '2026-05-20 02:21:53'),
(16, 17, '2026-05-26', '20:25', 'jonggol', 'Antrean Dapur', '2026-05-20 02:21:54', '2026-05-20 13:23:11'),
(17, 18, '2026-05-22', '20:29', 'Alamat Belum Ditentukan (Edit di Panel)', 'Antrean Dapur', '2026-05-20 02:25:36', '2026-05-20 02:25:36'),
(18, 19, '2026-05-30', '21:32', 'Alamat Belum Ditentukan (Edit di Panel)', 'Antrean Dapur', '2026-05-20 02:28:34', '2026-05-20 02:28:34'),
(19, 20, '2026-05-25', '20:34', 'Alamat Belum Ditentukan (Edit di Panel)', 'Antrean Dapur', '2026-05-20 02:30:17', '2026-05-20 02:30:17'),
(20, 22, '2026-05-22', '20:14', 'Alamat Belum Ditentukan (Edit di Panel)', 'Antrean Dapur', '2026-05-20 03:11:33', '2026-05-20 03:11:33'),
(21, 23, '2026-05-28', '20:20', 'Alamat Belum Ditentukan (Edit di Panel)', 'Antrean Dapur', '2026-05-20 10:17:35', '2026-05-20 10:17:35'),
(22, 24, '2026-05-21', '22:38', 'Alamat Belum Ditentukan (Edit di Panel)', 'Antrean Dapur', '2026-05-20 12:35:38', '2026-05-20 12:35:38'),
(23, 25, '2026-05-30', '22:51', 'Alamat Belum Ditentukan (Edit di Panel)', 'Proses Masak', '2026-05-20 12:48:20', '2026-05-20 13:28:32'),
(24, 26, '2026-05-20', '11:00 WIB', 'asdasd', 'Antrean Dapur', '2026-05-20 13:47:45', '2026-05-20 13:47:45'),
(25, 27, '2026-06-17', '11:00', 'aaasasas', 'Antrean Dapur', '2026-05-20 13:48:18', '2026-05-20 14:05:59');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` varchar(255) NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `food_packages`
--

CREATE TABLE `food_packages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `package_name` varchar(255) NOT NULL,
  `price` bigint(20) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `description` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_available` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `food_packages`
--

INSERT INTO `food_packages` (`id`, `package_name`, `price`, `stock`, `description`, `image`, `is_available`, `created_at`, `updated_at`) VALUES
(2, 'nasi cokot', 10000, 3, 'asdasdasdas', 'packages/SB3PzA4m4dPBTIvf3UR59jKZ3iD6xkvDjbBROdRT.png', 1, '2026-05-19 09:34:22', '2026-05-20 12:48:20');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` smallint(5) UNSIGNED NOT NULL,
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
-- Table structure for table `landing_settings`
--

CREATE TABLE `landing_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slogan_title` varchar(255) NOT NULL DEFAULT 'CITARASA PRIMA, KUALITAS UTAMA',
  `slogan_description` text DEFAULT NULL,
  `instagram_url` varchar(255) DEFAULT NULL,
  `whatsapp_number` varchar(255) DEFAULT NULL,
  `hero_subtitle` varchar(255) NOT NULL DEFAULT 'Homemade Premium Catering & Cakes',
  `hero_description` text DEFAULT NULL,
  `hero_image_1` varchar(255) DEFAULT NULL,
  `hero_image_2` varchar(255) DEFAULT NULL,
  `hero_image_3` varchar(255) DEFAULT NULL,
  `hero_image_4` varchar(255) DEFAULT NULL,
  `hero_image_5` varchar(255) DEFAULT NULL,
  `hero_image_6` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `landing_settings`
--

INSERT INTO `landing_settings` (`id`, `slogan_title`, `slogan_description`, `instagram_url`, `whatsapp_number`, `hero_subtitle`, `hero_description`, `hero_image_1`, `hero_image_2`, `hero_image_3`, `hero_image_4`, `hero_image_5`, `hero_image_6`, `created_at`, `updated_at`) VALUES
(1, 'NAUFALDI RISKI GANTENG MEMPESONAaaa', 'mari pesan kesukaan anda karena semua ini dibuat dengan tangan naufaldi reski ganteng', 'msdrhlmi_', '6285870536367', 'Homemade Premium Catering & Cakes', 'Menyajikan berbagai aneka makanan untuk keperluan hajatan anda', 'landing/AB5PDGBWMwXJfMwMihcgOiIu5ICzfdYJVNxq6Gk4.png', 'landing/SigHXKqInKCsxlBTgMJEObOEEjAsL6hcg7jBoIvh.png', 'landing/DKIRLDkhACktz4HnnIEcncRv0p8yKTC71q1wZM9d.png', 'landing/UjbWQ0FOnfx8oIFDi0MyhaYmtyeoKcI3yALzjU0K.png', NULL, NULL, '2026-05-19 10:22:47', '2026-05-20 14:44:08');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_paket` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `harga` int(11) NOT NULL,
  `minimal_order` int(11) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `kategori` varchar(255) NOT NULL DEFAULT 'Umum',
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
(4, '2026_05_19_123526_create_menus_table', 1),
(5, '2026_05_19_123720_create_orders_table', 2),
(6, '2026_05_19_155622_create_orders_table', 3),
(7, '2026_05_19_161146_create_food_packages_table', 4),
(8, '2026_05_19_163318_add_image_to_food_packages_table', 5),
(9, '2026_05_19_163952_create_delivery_schedules_table', 6),
(10, '2026_05_19_165411_fix_columns_in_orders_table', 7),
(11, '2026_05_19_171649_create_landing_settings_table', 8),
(12, '2026_05_19_174441_add_social_links_to_landing_settings_table', 9),
(13, '2026_05_20_044710_add_stock_to_food_packages_table', 10),
(14, '2026_05_20_062208_add_customer_details_to_orders_table', 11),
(15, '2026_05_20_084540_add_snap_token_to_orders_table', 12),
(16, '2026_05_20_100741_add_tempat_antar_to_orders_table', 13),
(17, '2026_05_20_195505_drop_driver_name_from_delivery_schedules_table', 14),
(18, '2026_05_20_213709_create_activity_logs_table', 15);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_code` varchar(255) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `package_name` varchar(255) NOT NULL,
  `delivery_time` varchar(255) NOT NULL,
  `tempat_antar` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nama_pemesan` varchar(255) NOT NULL,
  `nomor_wa` varchar(255) NOT NULL,
  `tanggal_acara` date NOT NULL,
  `jumlah_porsi` int(11) NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `snap_token` varchar(255) DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'menunggu',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_code`, `customer_name`, `package_name`, `delivery_time`, `tempat_antar`, `user_id`, `nama_pemesan`, `nomor_wa`, `tanggal_acara`, `jumlah_porsi`, `total_bayar`, `snap_token`, `catatan`, `status`, `created_at`, `updated_at`) VALUES
(1, 'LOG-9H1T', 'admin', 'Memperbarui tata letak teks dan unggahan foto pada Hero Banner Landing Page', '04:41 WIB', NULL, 1, '', '', '2026-05-20', 0, 0, NULL, NULL, 'Sistem', '2026-05-19 21:41:48', '2026-05-19 21:41:48'),
(2, 'NUR-EUJQC', 'Masdar Helmi', 'nasi cokot', '12:00', NULL, 2, '', '', '2026-05-21', 23, 230000, NULL, NULL, 'Pending', '2026-05-19 22:30:00', '2026-05-19 22:30:00'),
(3, 'NUR-PDZTJ', 'Masdar Helmi', 'nasi cokot', '12:00', NULL, 2, '', '', '2026-05-22', 7, 70000, NULL, NULL, 'Pending', '2026-05-19 22:56:49', '2026-05-19 22:56:49'),
(4, 'NUR-WEEAX', 'Masdar Helmi', 'nasi cokot', '19:50', NULL, 2, 'agus', '0856548975120', '2026-05-22', 2, 20000, '49d6535b-eadb-4580-b8fe-7e953e08b071', 'ausvdha', 'Pending', '2026-05-20 01:47:03', '2026-05-20 01:47:03'),
(5, 'NUR-ZXYNE', 'Masdar Helmi', 'nasi cokot', '20:00', NULL, 2, 'parrjo', '08567895512', '2026-05-21', 2, 20000, 'f659e158-afb2-45b5-a25d-c97b2182d6ec', 'asdeas', 'Pending', '2026-05-20 01:53:41', '2026-05-20 01:53:42'),
(6, 'NUR-QE6HT', 'Masdar Helmi', 'nasi cokot', '18:59', NULL, 2, 'Masdar Helmi', '085645451', '2026-05-22', 3, 30000, '93f2dc6e-6d9c-400b-82d0-fd99de27f7ce', 'fghdf', 'Pending', '2026-05-20 01:56:16', '2026-05-20 01:56:17'),
(7, 'NUR-D8RGC', 'Masdar Helmi', 'nasi cokot', '18:02', NULL, 2, 'Masdar Helmi', '085654747', '2026-05-23', 2, 20000, 'deaa41d0-ed12-4bdf-abea-f68965d29676', 'yhdfsdfas', 'Sukses', '2026-05-20 02:00:53', '2026-05-20 02:02:26'),
(8, 'NUR-3HG6X', 'Masdar Helmi', 'nasi cokot', '20:07', NULL, 2, 'Masdar Helmi', '0651206216030', '2026-05-22', 3, 30000, '3d7a2ac9-745c-4ac2-a3dc-63ac2f0f70ce', 'sfas', 'Sukses', '2026-05-20 02:03:22', '2026-05-20 02:03:59'),
(9, 'NUR-UFPWL', 'Masdar Helmi', 'nasi cokot', '19:10', NULL, 2, 'Masdar Helmi', '0651206216030', '2026-05-22', 3, 30000, 'a4ccdd01-4f1f-4d86-acef-a641968ff986', 'sdgfsws', 'Pending', '2026-05-20 02:07:27', '2026-05-20 02:07:28'),
(10, 'NUR-AGNXD', 'Masdar Helmi', 'nasi cokot', '17:08', NULL, 2, 'Masdar Helmi', '0651206216030', '2026-05-22', 3, 30000, 'cca0117b-860d-4fa0-a7c7-3ec8ce98a565', NULL, 'Pending', '2026-05-20 02:09:03', '2026-05-20 02:09:03'),
(11, 'NUR-IURWT', 'Masdar Helmi', 'nasi cokot', '19:12', NULL, 2, 'Masdar Helmi', '0856548975120', '2026-05-23', 4, 40000, '96fb6701-300b-443c-bf2b-4a5a8fe48a13', 'adasd', 'Pending', '2026-05-20 02:10:06', '2026-05-20 02:10:07'),
(12, 'NUR-XPYON', 'Masdar Helmi', 'nasi cokot', '19:17', NULL, 2, 'Masdar Helmi', '085614216535', '2026-05-26', 4, 40000, 'e650a279-e64d-47f8-8468-c62aea129c91', '121r4qwr', 'Pending', '2026-05-20 02:13:34', '2026-05-20 02:13:34'),
(13, 'NUR-N5ETV', 'Masdar Helmi', 'nasi cokot', '19:18', NULL, 2, 'Masdar Helmi', '0581512745121', '2026-05-28', 2, 20000, '7215511b-e008-41c0-ba2e-057c8a8d1d04', 'aqswdfasd', 'Pending', '2026-05-20 02:15:13', '2026-05-20 02:15:14'),
(14, 'NUR-GLTJ6', 'Masdar Helmi', 'nasi cokot', '20:22', NULL, 2, 'Masdar Helmi', '08145321521', '2026-05-29', 3, 30000, 'f8b8011a-e51d-406e-81d4-98ad1d52e84c', NULL, 'Pending', '2026-05-20 02:18:13', '2026-05-20 02:18:13'),
(15, 'NUR-OSJXZ', 'Masdar Helmi', 'nasi cokot', '20:23', NULL, 2, 'Masdar Helmi', '0856548975120', '2026-05-22', 2, 20000, '63a63257-bcbd-4afa-b543-6cb4c75e352e', NULL, 'Pending', '2026-05-20 02:20:00', '2026-05-20 02:20:00'),
(16, 'NUR-FHVLF', 'Masdar Helmi', 'nasi cokot', '20:25', NULL, 2, 'Masdar Helmi', '698458121240', '2026-05-26', 3, 30000, '4367d2c9-17b9-4ca2-9169-0a810ca1f80e', 'qswda', 'Pending', '2026-05-20 02:21:53', '2026-05-20 02:21:54'),
(17, 'NUR-ZSM8Y', 'Masdar Helmi', 'nasi cokot', '20:25', NULL, 2, 'Masdar Helmi', '698458121240', '2026-05-26', 3, 30000, 'e6e6b9bb-68a9-425b-9e60-8fd604c20705', 'qswda', 'Sukses', '2026-05-20 02:21:54', '2026-05-20 02:24:41'),
(18, 'NUR-FGCJW', 'Masdar Helmi', 'nasi cokot', '20:29', NULL, 2, 'Masdar Helmi', '045205404', '2026-05-22', 1, 10000, '0137f923-aa2c-46ce-a77d-07488e244749', NULL, 'Pending', '2026-05-20 02:25:36', '2026-05-20 02:25:37'),
(19, 'NUR-QEIQD', 'Masdar Helmi', 'nasi cokot', '21:32', NULL, 2, 'Masdar Helmi', '0561845120', '2026-05-30', 1, 10000, '6dff9caa-3df4-4e38-a632-15f0dbd02f24', NULL, 'Pending', '2026-05-20 02:28:34', '2026-05-20 02:28:35'),
(20, 'NUR-MWELT', 'Masdar Helmi', 'nasi cokot', '20:34', NULL, 2, 'Masdar Helmi', '0856548975120', '2026-05-25', 2, 20000, 'd41dc153-4434-4cad-ba2e-483e1f497d0d', NULL, 'Sukses', '2026-05-20 02:30:17', '2026-05-20 02:30:17'),
(21, 'LOG-XBSB', 'admin', 'Memperbarui tata letak teks dan unggahan foto pada Hero Banner Landing Page', '09:47 WIB', NULL, 1, 'Sistem Log', '-', '2026-05-20', 0, 0, NULL, NULL, 'Sistem', '2026-05-20 02:47:46', '2026-05-20 02:47:46'),
(22, 'NUR-KNDL3', 'Masdar Helmi', 'nasi cokot', '20:14', NULL, 2, 'Masdar Helmi', '065150120', '2026-05-22', 2, 20000, '337d0a4e-08f3-4b01-be84-14637fd19bd8', 'as', 'Sukses', '2026-05-20 03:11:33', '2026-05-20 03:11:33'),
(23, 'NUR-DZUCZ', 'Masdar Helmi', 'nasi cokot', '20:20', NULL, 2, 'Masdar Helmi', '0561845120', '2026-05-28', 1, 10000, '246b21be-976c-43aa-9f44-4137bb7417ba', NULL, 'Pending', '2026-05-20 10:17:35', '2026-05-20 10:17:35'),
(24, 'NUR-9GVV9', 'Masdar Helmi', 'nasi cokot', '22:38', NULL, 2, 'Masdar Helmi', '085629842151', '2026-05-21', 1, 10000, '1406a740-3e16-45a4-af68-6b5bfb8d5e9d', '121', 'Pending', '2026-05-20 12:35:38', '2026-05-20 12:35:39'),
(25, 'NUR-PQD47', 'Masdar Helmi', 'nasi cokot', '22:51', 'jalan pijnasn', 2, 'Masdar Helmi', '085629842151', '2026-05-30', 2, 20000, '5e75e2ac-7341-4675-9255-f7d2e37ca479', 'AQSWDA', 'Pending', '2026-04-20 12:48:20', '2026-04-20 12:48:20'),
(26, 'INV-7I1T1J', 'agus', 'nasi cokot', '11:00 WIB', 'asdasd', 1, 'agus', '065846512', '2026-05-20', 2, 0, NULL, NULL, 'Sukses', '2026-05-20 13:47:45', '2026-05-20 13:47:45'),
(27, 'INV-QWED89', 'asd', 'nasi cokot', '11:00', 'aaasasas', 1, 'asd', '0651206216030', '2026-06-17', 1, 10000, NULL, NULL, 'Sukses', '2026-05-20 13:48:18', '2026-05-20 14:05:59');

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
('azSc5KFB2720y2rpFqgcts5xg8napBEF9IPxxLwL', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'eyJfdG9rZW4iOiJaelBhMFZnR0JGVzQ5RGxxUXFLOGVBQjlNMkw2MWNKMmR2TUFXU1VNIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDBcL293bmVyXC9sb2dzIiwicm91dGUiOiJvd25lci5sb2dzIn0sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjo0fQ==', 1779288253),
('mJxpKGTonv4plpLzoI40SkO9SOQ2LculBGwyitFh', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiIxNjYwZWRQYUpXOHhmc2t1c0d4QWhLbkZIOUNHekozWVNTaks5QmdzIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDBcL2FkbWluXC9sYW5kaW5nLXNldHRpbmdzIiwicm91dGUiOiJhZG1pbi5sYW5kaW5nLnNldHRpbmdzIn0sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjoxfQ==', 1779288249);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', NULL, '$2y$12$onoRGIrI.EV8QuqEdY6Jk.G1m8yGzys2KOYm9m.AvEjlYMxBC6pZG', 'admin', NULL, '2026-05-19 05:43:59', '2026-05-19 05:43:59'),
(2, 'Masdar Helmi', 'masdarhelmi23@gmail.com', NULL, '$2y$12$ob1FlXGasx5aSgUYUTzOZ.sh1Ay.8ayLLgdE60qwj/JHAzbV6whKy', 'user', NULL, '2026-05-19 08:43:00', '2026-05-19 08:43:00'),
(3, 'helmi', 'masdarhelmi2301@gmail.com', NULL, '$2y$12$5fxiJRTwXBrGQkTAWbBJuO2XLzuURGOEaZLKUnpC17wDq4eIxz/ra', 'user', NULL, '2026-05-19 08:43:43', '2026-05-19 08:43:43'),
(4, 'Owner Utama Nur Baluwarti', 'owner@gmail.com', NULL, '$2y$12$1HL9sQlrPSEv3qrwRH8GFezu9FbDh4vLML7XqIK.Vrc2ZgTVAk/a6', 'owner', NULL, '2026-05-20 14:19:50', '2026-05-20 14:19:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `delivery_schedules`
--
ALTER TABLE `delivery_schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `delivery_schedules_order_id_foreign` (`order_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  ADD KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`);

--
-- Indexes for table `food_packages`
--
ALTER TABLE `food_packages`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `landing_settings`
--
ALTER TABLE `landing_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_order_code_unique` (`order_code`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

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
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `delivery_schedules`
--
ALTER TABLE `delivery_schedules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `food_packages`
--
ALTER TABLE `food_packages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `landing_settings`
--
ALTER TABLE `landing_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `delivery_schedules`
--
ALTER TABLE `delivery_schedules`
  ADD CONSTRAINT `delivery_schedules_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
