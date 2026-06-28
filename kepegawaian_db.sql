-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 28, 2026 at 01:39 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kepegawaian_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `id` bigint NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `content` mediumtext COLLATE utf8mb4_general_ci,
  `ua` varchar(256) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ip` varchar(64) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `url` text COLLATE utf8mb4_general_ci,
  `browser` varchar(64) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `platform` varchar(64) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`id`, `title`, `content`, `ua`, `ip`, `url`, `browser`, `platform`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 'Login Aplikasi', 'User melakukan login ke sistem', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)', '127.0.0.1', '/site/login', NULL, NULL, NULL, NULL, 1, NULL),
(2, 'Tambah Pegawai', 'Menambah data pegawai baru: Ahmad Fauzi', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)', '127.0.0.1', '/pegawai/create', NULL, NULL, NULL, NULL, 1, NULL),
(3, 'Update Data Jabatan', 'Mengubah data jabatan Kepala Dinas', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)', '127.0.0.1', '/master-data/update?id=1', NULL, NULL, NULL, NULL, 1, NULL),
(4, 'Login System', 'Pengguna superadmin berhasil login.', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '::1', '/site/login', NULL, NULL, '2026-06-27 19:33:12', NULL, 1, NULL),
(5, 'Logout System', 'Pengguna superadmin melakukan logout.', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '::1', '/site/logout', NULL, NULL, '2026-06-27 19:45:58', NULL, 1, NULL),
(6, 'Login System', 'Pengguna superadmin berhasil login.', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '::1', '/site/login', NULL, NULL, '2026-06-27 19:46:06', NULL, 1, NULL),
(7, 'Logout System', 'Pengguna superadmin melakukan logout.', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '::1', '/site/logout', NULL, NULL, '2026-06-27 19:48:28', NULL, 1, NULL),
(8, 'Login System', 'Pengguna manager_hrd berhasil login.', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '::1', '/site/login', NULL, NULL, '2026-06-27 19:51:42', NULL, 2, NULL),
(9, 'Logout System', 'Pengguna manager_hrd melakukan logout.', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '::1', '/site/logout', NULL, NULL, '2026-06-28 07:35:36', NULL, 2, NULL),
(10, 'Login System', 'Pengguna manager_hrd berhasil login.', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '::1', '/site/login', NULL, NULL, '2026-06-28 07:35:48', NULL, 2, NULL),
(11, 'Modul Pegawai', 'Sistem mencatat aksi Update pada tabel pegawai (ID Record: 1)', NULL, '::1', NULL, NULL, NULL, '2026-06-28 00:39:16', NULL, 2, NULL),
(12, 'Modul Pegawai', 'Sistem mencatat aksi Update pada tabel pegawai (ID Record: 1)', NULL, '::1', NULL, NULL, NULL, '2026-06-28 00:39:47', NULL, 2, NULL),
(13, 'Modul Pegawai', 'Sistem mencatat aksi Update pada tabel pegawai (ID Record: 1)', NULL, '::1', NULL, NULL, NULL, '2026-06-28 00:46:47', NULL, 2, NULL),
(14, 'Modul Pegawai', 'Sistem mencatat aksi Update pada tabel pegawai (ID Record: 1)', NULL, '::1', NULL, NULL, NULL, '2026-06-28 00:47:20', NULL, 2, NULL),
(15, 'Modul Pegawai', 'Sistem mencatat aksi Update pada tabel pegawai (ID Record: 1)', NULL, '::1', NULL, NULL, NULL, '2026-06-28 02:07:10', NULL, 2, NULL),
(16, 'Logout System', 'Pengguna manager_hrd melakukan logout.', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '::1', '/site/logout', NULL, NULL, '2026-06-28 09:38:05', NULL, 2, NULL),
(17, 'Login System', 'Pengguna manager_hrd berhasil login.', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '::1', '/site/login', NULL, NULL, '2026-06-28 09:38:15', NULL, 2, NULL),
(18, 'Logout System', 'Pengguna manager_hrd melakukan logout.', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '::1', '/site/logout', NULL, NULL, '2026-06-28 10:24:36', NULL, 2, NULL),
(19, 'Login System', 'Pengguna admin_hrd berhasil login.', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '::1', '/site/login', NULL, NULL, '2026-06-28 10:26:06', NULL, 3, NULL),
(20, 'Modul Pegawai', 'Sistem mencatat aksi Update pada tabel pegawai (ID Record: 1)', NULL, '::1', NULL, NULL, NULL, '2026-06-28 03:26:30', NULL, 3, NULL),
(21, 'Modul Pegawai', 'Sistem mencatat aksi Update pada tabel pegawai (ID Record: 1)', NULL, '::1', NULL, NULL, NULL, '2026-06-28 03:26:40', NULL, 3, NULL),
(22, 'Logout System', 'Pengguna admin_hrd melakukan logout.', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '::1', '/site/logout', NULL, NULL, '2026-06-28 10:38:29', NULL, 3, NULL),
(23, 'Login System', 'Pengguna manager_hrd berhasil login.', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '::1', '/site/login', NULL, NULL, '2026-06-28 10:38:41', NULL, 2, NULL),
(24, 'Logout System', 'Pengguna manager_hrd melakukan logout.', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '::1', '/site/logout', NULL, NULL, '2026-06-28 11:10:50', NULL, 2, NULL),
(25, 'Login System', 'Pengguna superadmin berhasil login.', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '::1', '/site/login', NULL, NULL, '2026-06-28 11:11:12', NULL, 1, NULL),
(26, 'Logout System', 'Pengguna superadmin melakukan logout.', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '::1', '/site/logout', NULL, NULL, '2026-06-28 11:53:13', NULL, 1, NULL),
(27, 'Login System', 'Pengguna manager_hrd berhasil login.', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '::1', '/site/login', NULL, NULL, '2026-06-28 11:53:22', NULL, 2, NULL),
(28, 'Logout System', 'Pengguna manager_hrd melakukan logout.', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '::1', '/site/logout', NULL, NULL, '2026-06-28 11:53:39', NULL, 2, NULL),
(29, 'Login System', 'Pengguna admin_hrd berhasil login.', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '::1', '/site/login', NULL, NULL, '2026-06-28 11:53:49', NULL, 3, NULL),
(30, 'Logout System', 'Pengguna admin_hrd melakukan logout.', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '::1', '/site/logout', NULL, NULL, '2026-06-28 11:55:30', NULL, 3, NULL),
(31, 'Login System', 'Pengguna superadmin berhasil login.', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '::1', '/site/login', NULL, NULL, '2026-06-28 11:56:46', NULL, 1, NULL),
(32, 'Logout System', 'Pengguna superadmin melakukan logout.', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '::1', '/site/logout', NULL, NULL, '2026-06-28 05:37:03', NULL, 1, NULL),
(33, 'Dashboard', 'Melihat halaman Dashboard', NULL, '::1', '/', NULL, NULL, '2026-06-28 08:37:17', NULL, 1, NULL),
(34, 'Modul Kelola User', 'Melihat daftar pengguna (Read)', NULL, '::1', '/user/index', NULL, NULL, '2026-06-28 08:37:33', NULL, 1, NULL),
(35, 'Login System', 'Pengguna superadmin berhasil login.', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '::1', '/site/login', NULL, NULL, '2026-06-28 08:39:03', NULL, 1, NULL),
(36, 'Dashboard', 'Melihat halaman Dashboard', NULL, '::1', '/', NULL, NULL, '2026-06-28 08:39:03', NULL, 1, NULL),
(37, 'Modul Kelola User', 'Melihat daftar pengguna (Read)', NULL, '::1', '/user/index', NULL, NULL, '2026-06-28 08:39:13', NULL, 1, NULL),
(38, 'Modul Kelola User', 'Memperbarui data user (Update) ID: 5 - ahmadfauzi', NULL, '::1', '/user/update?id=5', NULL, NULL, '2026-06-28 08:39:26', NULL, 1, NULL),
(39, 'Modul Kelola User', 'Melihat daftar pengguna (Read)', NULL, '::1', '/user/index', NULL, NULL, '2026-06-28 08:39:26', NULL, 1, NULL),
(40, 'Modul Kelola User', 'Melihat daftar pengguna (Read)', NULL, '::1', '/user/index', NULL, NULL, '2026-06-28 08:39:36', NULL, 1, NULL),
(41, 'Modul Kelola User', 'Memperbarui data user (Update) ID: 5 - ahmadfauzi', NULL, '::1', '/user/update?id=5', NULL, NULL, '2026-06-28 08:39:46', NULL, 1, NULL),
(42, 'Modul Kelola User', 'Melihat daftar pengguna (Read)', NULL, '::1', '/user/index', NULL, NULL, '2026-06-28 08:39:46', NULL, 1, NULL),
(43, 'Dashboard', 'Melihat halaman Dashboard', NULL, '::1', '/', NULL, NULL, '2026-06-28 08:46:48', NULL, 1, NULL),
(44, 'Logout System', 'Pengguna superadmin melakukan logout.', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '::1', '/site/logout', NULL, NULL, '2026-06-28 08:49:10', NULL, 1, NULL),
(45, 'Login System', 'Pengguna manager_hrd berhasil login.', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '::1', '/site/login', NULL, NULL, '2026-06-28 08:49:27', NULL, 2, NULL),
(46, 'Dashboard', 'Melihat halaman Dashboard', NULL, '::1', '/', NULL, NULL, '2026-06-28 08:49:27', NULL, 2, NULL),
(47, 'Logout System', 'Pengguna manager_hrd melakukan logout.', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '::1', '/site/logout', NULL, NULL, '2026-06-28 08:50:13', NULL, 2, NULL),
(48, 'Login System', 'Pengguna admin_hrd berhasil login.', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '::1', '/site/login', NULL, NULL, '2026-06-28 08:50:46', NULL, 3, NULL),
(49, 'Dashboard', 'Melihat halaman Dashboard', NULL, '::1', '/', NULL, NULL, '2026-06-28 08:50:46', NULL, 3, NULL),
(50, 'Modul Kelola User', 'Melihat daftar pengguna (Read)', NULL, '::1', '/user/index', NULL, NULL, '2026-06-28 08:53:40', NULL, 1, NULL),
(51, 'Modul Kelola User', 'Melihat daftar pengguna (Read)', NULL, '::1', '/user/index', NULL, NULL, '2026-06-28 08:57:01', NULL, 1, NULL),
(52, 'Modul Data Pegawai', 'Membuka halaman form tambah/edit pegawai (Read)', NULL, '::1', '/pegawai/tambah?id=2', NULL, NULL, '2026-06-28 09:04:05', NULL, 3, NULL),
(53, 'Modul Pegawai', 'Sistem mencatat aksi Update pada tabel pegawai (ID Record: 2)', NULL, '::1', NULL, NULL, NULL, '2026-06-28 09:05:17', NULL, 3, NULL),
(54, 'Modul Data Pegawai', 'Melakukan aksi UPDATE data pegawai: Memperbarui data milik Rina Marlina', NULL, '::1', '/api/pegawai/update?id=2', NULL, NULL, '2026-06-28 09:05:17', NULL, 3, NULL),
(55, 'Modul Data Pegawai', 'Membuka halaman daftar pegawai (Read)', NULL, '::1', '/pegawai/index', NULL, NULL, '2026-06-28 09:05:19', NULL, 3, NULL),
(56, 'Modul Data Pegawai', 'Membuka halaman form tambah/edit pegawai (Read)', NULL, '::1', '/pegawai/tambah?id=1', NULL, NULL, '2026-06-28 09:05:28', NULL, 3, NULL),
(57, 'Logout System', 'Pengguna admin_hrd melakukan logout.', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '::1', '/site/logout', NULL, NULL, '2026-06-28 09:09:20', NULL, 3, NULL),
(58, 'Logout System', 'Pengguna superadmin melakukan logout.', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '::1', '/site/logout', NULL, NULL, '2026-06-28 09:09:34', NULL, 1, NULL),
(59, 'Login System', 'Pengguna admin_hrd berhasil login.', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '::1', '/site/login', NULL, NULL, '2026-06-28 09:09:43', NULL, 3, NULL),
(60, 'Dashboard', 'Melihat halaman Dashboard', NULL, '::1', '/', NULL, NULL, '2026-06-28 09:09:44', NULL, 3, NULL),
(61, 'Modul Data Pegawai', 'Membuka halaman daftar pegawai (Read)', NULL, '::1', '/pegawai/index', NULL, NULL, '2026-06-28 09:09:45', NULL, 3, NULL),
(62, 'Modul Data Pegawai', 'Membuka halaman form tambah/edit pegawai (Read)', NULL, '::1', '/pegawai/tambah?id=2', NULL, NULL, '2026-06-28 09:09:50', NULL, 3, NULL),
(63, 'Modul Pegawai', 'Sistem mencatat aksi Update pada tabel pegawai (ID Record: 2)', NULL, '::1', NULL, NULL, NULL, '2026-06-28 09:09:59', NULL, 3, NULL),
(64, 'Modul Data Pegawai', 'Melakukan aksi UPDATE data pegawai: Memperbarui data milik Rina Marlina', NULL, '::1', '/api/pegawai/update?id=2', NULL, NULL, '2026-06-28 09:09:59', NULL, 3, NULL),
(65, 'Modul Data Pegawai', 'Membuka halaman daftar pegawai (Read)', NULL, '::1', '/pegawai/index', NULL, NULL, '2026-06-28 09:10:01', NULL, 3, NULL),
(66, 'Modul Data Pegawai', 'Membuka halaman form tambah/edit pegawai (Read)', NULL, '::1', '/pegawai/tambah?id=2', NULL, NULL, '2026-06-28 09:10:05', NULL, 3, NULL),
(67, 'Modul Pegawai', 'Sistem mencatat aksi Update pada tabel pegawai (ID Record: 2)', NULL, '::1', NULL, NULL, NULL, '2026-06-28 09:10:10', NULL, 3, NULL),
(68, 'Modul Data Pegawai', 'Melakukan aksi UPDATE data pegawai: Memperbarui data milik Rina Marlina', NULL, '::1', '/api/pegawai/update?id=2', NULL, NULL, '2026-06-28 09:10:10', NULL, 3, NULL),
(69, 'Modul Data Pegawai', 'Membuka halaman daftar pegawai (Read)', NULL, '::1', '/pegawai/index', NULL, NULL, '2026-06-28 09:10:11', NULL, 3, NULL),
(70, 'Modul Data Pegawai', 'Membuka halaman form tambah/edit pegawai (Read)', NULL, '::1', '/pegawai/tambah', NULL, NULL, '2026-06-28 09:10:14', NULL, 3, NULL),
(71, 'Modul Pegawai', 'Sistem mencatat aksi Create pada tabel pegawai (ID Record: 6)', NULL, '::1', NULL, NULL, NULL, '2026-06-28 09:11:14', NULL, 3, NULL),
(72, 'Modul Data Pegawai', 'Melakukan aksi CREATE data pegawai: Pegawai baru atas nama Giska Saputra', NULL, '::1', '/api/pegawai/create', NULL, NULL, '2026-06-28 09:11:14', NULL, 3, NULL),
(73, 'Modul Data Pegawai', 'Membuka halaman daftar pegawai (Read)', NULL, '::1', '/pegawai/index', NULL, NULL, '2026-06-28 09:11:17', NULL, 3, NULL),
(74, 'Logout System', 'Pengguna admin_hrd melakukan logout.', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '::1', '/site/logout', NULL, NULL, '2026-06-28 09:11:22', NULL, 3, NULL),
(75, 'Login System', 'Pengguna superadmin berhasil login.', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '::1', '/site/login', NULL, NULL, '2026-06-28 09:11:36', NULL, 1, NULL),
(76, 'Dashboard', 'Melihat halaman Dashboard', NULL, '::1', '/', NULL, NULL, '2026-06-28 09:11:36', NULL, 1, NULL),
(77, 'Logout System', 'Pengguna superadmin melakukan logout.', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '::1', '/site/logout', NULL, NULL, '2026-06-28 09:21:55', NULL, 1, NULL),
(78, 'Login System', 'Pengguna superadmin berhasil login.', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '::1', '/site/login', NULL, NULL, '2026-06-28 09:22:04', NULL, 1, NULL),
(79, 'Dashboard', 'Melihat halaman Dashboard', NULL, '::1', '/', NULL, NULL, '2026-06-28 09:22:05', NULL, 1, NULL),
(80, 'Logout System', 'Pengguna superadmin melakukan logout.', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '::1', '/site/logout', NULL, NULL, '2026-06-28 09:22:12', NULL, 1, NULL),
(81, 'Login System', 'Pengguna admin_hrd berhasil login.', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '::1', '/site/login', NULL, NULL, '2026-06-28 09:22:21', NULL, 3, NULL),
(82, 'Dashboard', 'Melihat halaman Dashboard', NULL, '::1', '/', NULL, NULL, '2026-06-28 09:22:21', NULL, 3, NULL),
(83, 'Modul Data Pegawai', 'Membuka halaman daftar pegawai (Read)', NULL, '::1', '/pegawai/index', NULL, NULL, '2026-06-28 09:22:23', NULL, 3, NULL),
(84, 'Modul Data Pegawai', 'Membuka halaman daftar pegawai (Read)', NULL, '::1', '/pegawai/index', NULL, NULL, '2026-06-28 09:32:59', NULL, 3, NULL),
(85, 'Modul Data Pegawai', 'Melihat detail data pegawai ID: 1 (Read)', NULL, '::1', '/pegawai/detail?id=1', NULL, NULL, '2026-06-28 09:33:03', NULL, 3, NULL),
(86, 'Modul Data Pegawai', 'Membuka halaman daftar pegawai (Read)', NULL, '::1', '/pegawai/index', NULL, NULL, '2026-06-28 09:33:10', NULL, 3, NULL),
(87, 'Modul Data Pegawai', 'Membuka halaman form tambah/edit pegawai (Read)', NULL, '::1', '/pegawai/tambah?id=6', NULL, NULL, '2026-06-28 09:33:16', NULL, 3, NULL),
(88, 'Modul Pegawai', 'Sistem mencatat aksi Update pada tabel pegawai (ID Record: 6)', NULL, '::1', NULL, NULL, NULL, '2026-06-28 09:33:33', NULL, 3, NULL),
(89, 'Modul Pegawai', 'Sistem mencatat aksi Update pada tabel pegawai (ID Record: 6)', NULL, '::1', NULL, NULL, NULL, '2026-06-28 09:33:33', NULL, 3, NULL),
(90, 'Modul Data Pegawai', 'Melakukan aksi UPDATE data pegawai: Memperbarui data milik Giska Saputra', NULL, '::1', '/api/pegawai/update?id=6', NULL, NULL, '2026-06-28 09:33:33', NULL, 3, NULL),
(91, 'Modul Data Pegawai', 'Membuka halaman daftar pegawai (Read)', NULL, '::1', '/pegawai/index', NULL, NULL, '2026-06-28 09:33:35', NULL, 3, NULL),
(92, 'Dashboard', 'Melihat halaman Dashboard', NULL, '::1', '/site/index', NULL, NULL, '2026-06-28 09:33:41', NULL, 3, NULL),
(93, 'Modul Data Pegawai', 'Membuka halaman daftar pegawai (Read)', NULL, '::1', '/pegawai/index', NULL, NULL, '2026-06-28 09:35:49', NULL, 3, NULL),
(94, 'Modul Data Pegawai', 'Melihat detail data pegawai ID: 1 (Read)', NULL, '::1', '/pegawai/detail?id=1', NULL, NULL, '2026-06-28 09:35:54', NULL, 3, NULL),
(95, 'Modul Data Pegawai', 'Membuka halaman daftar pegawai (Read)', NULL, '::1', '/pegawai/index', NULL, NULL, '2026-06-28 09:36:05', NULL, 3, NULL),
(96, 'Dashboard', 'Melihat halaman Dashboard', NULL, '::1', '/site/index', NULL, NULL, '2026-06-28 09:36:18', NULL, 3, NULL),
(97, 'Modul Data Pegawai', 'Membuka halaman daftar pegawai (Read)', NULL, '::1', '/pegawai/index', NULL, NULL, '2026-06-28 09:36:19', NULL, 3, NULL),
(98, 'Logout System', 'Pengguna admin_hrd melakukan logout.', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '::1', '/site/logout', NULL, NULL, '2026-06-28 09:39:37', NULL, 3, NULL),
(99, 'Login System', 'Pengguna admin_hrd berhasil login.', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '::1', '/site/login', NULL, NULL, '2026-06-28 09:39:58', NULL, 3, NULL),
(100, 'Dashboard', 'Melihat halaman Dashboard', NULL, '::1', '/', NULL, NULL, '2026-06-28 09:39:58', NULL, 3, NULL),
(101, 'Logout System', 'Pengguna admin_hrd melakukan logout.', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '::1', '/site/logout', NULL, NULL, '2026-06-28 09:40:28', NULL, 3, NULL),
(102, 'Login System', 'Pengguna admin_hrd berhasil login.', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '::1', '/site/login', NULL, NULL, '2026-06-28 09:41:36', NULL, 3, NULL),
(103, 'Dashboard', 'Melihat halaman Dashboard', NULL, '::1', '/', NULL, NULL, '2026-06-28 09:41:36', NULL, 3, NULL),
(104, 'Modul Data Pegawai', 'Membuka halaman daftar pegawai (Read)', NULL, '::1', '/pegawai/index', NULL, NULL, '2026-06-28 09:43:16', NULL, 3, NULL),
(105, 'Dashboard', 'Melihat halaman Dashboard', NULL, '::1', '/site/index', NULL, NULL, '2026-06-28 09:43:18', NULL, 3, NULL),
(106, 'Modul Data Pegawai', 'Membuka halaman daftar pegawai (Read)', NULL, '::1', '/pegawai/index', NULL, NULL, '2026-06-28 09:44:34', NULL, 3, NULL),
(107, 'Modul Data Pegawai', 'Membuka halaman form tambah/edit pegawai (Read)', NULL, '::1', '/pegawai/tambah?id=6', NULL, NULL, '2026-06-28 09:44:39', NULL, 3, NULL),
(108, 'Modul Pegawai', 'Sistem mencatat aksi Update pada tabel pegawai (ID Record: 6)', NULL, '::1', NULL, NULL, NULL, '2026-06-28 09:44:49', NULL, 3, NULL),
(109, 'Modul Data Pegawai', 'Melakukan aksi UPDATE data pegawai: Memperbarui data milik Giska Saputra', NULL, '::1', '/api/pegawai/update?id=6', NULL, NULL, '2026-06-28 09:44:49', NULL, 3, NULL),
(110, 'Modul Data Pegawai', 'Membuka halaman daftar pegawai (Read)', NULL, '::1', '/pegawai/index', NULL, NULL, '2026-06-28 09:44:50', NULL, 3, NULL),
(111, 'Logout System', 'Pengguna admin_hrd melakukan logout.', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '::1', '/site/logout', NULL, NULL, '2026-06-28 09:44:53', NULL, 3, NULL),
(112, 'Login System', 'Pengguna superadmin berhasil login.', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', '::1', '/site/login', NULL, NULL, '2026-06-28 09:45:01', NULL, 1, NULL),
(113, 'Dashboard', 'Melihat halaman Dashboard', NULL, '::1', '/', NULL, NULL, '2026-06-28 09:45:01', NULL, 1, NULL),
(114, 'Modul Kelola User', 'Melihat daftar pengguna (Read)', NULL, '::1', '/user/index', NULL, NULL, '2026-06-28 10:33:35', NULL, 1, NULL),
(115, 'Modul Kelola User', 'Memperbarui data user (Update) ID: 5 - ahmadfauzi123', NULL, '::1', '/user/update?id=5', NULL, NULL, '2026-06-28 10:33:50', NULL, 1, NULL),
(116, 'Modul Kelola User', 'Melihat daftar pengguna (Read)', NULL, '::1', '/user/index', NULL, NULL, '2026-06-28 10:33:50', NULL, 1, NULL),
(117, 'Dashboard', 'Melihat halaman Dashboard', NULL, '::1', '/site/index', NULL, NULL, '2026-06-28 11:57:11', NULL, 1, NULL),
(118, 'Modul Kelola User', 'Melihat daftar pengguna (Read)', NULL, '::1', '/user/index', NULL, NULL, '2026-06-28 12:24:49', NULL, 1, NULL),
(119, 'Modul Kelola User', 'Menambah user baru (Create) dengan username: giskasaputra', NULL, '::1', '/user/create', NULL, NULL, '2026-06-28 12:31:19', NULL, 1, NULL),
(120, 'Modul Kelola User', 'Melihat daftar pengguna (Read)', NULL, '::1', '/user/index', NULL, NULL, '2026-06-28 12:31:19', NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `master_data`
--

CREATE TABLE `master_data` (
  `id` int NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tipe` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `master_data`
--

INSERT INTO `master_data` (`id`, `nama`, `tipe`) VALUES
(1, 'Manager', 'jabatan'),
(2, 'Staf', 'jabatan'),
(3, 'Magang', 'jabatan'),
(4, 'Marketing', 'departemen'),
(5, 'HRD', 'departemen'),
(6, 'Production', 'departemen'),
(7, 'Executive', 'departemen'),
(8, 'Commissioner', 'departemen'),
(9, 'Sekretariat', 'departemen'),
(10, 'Bagian Umum', 'departemen'),
(11, 'Bagian Keuangan', 'departemen');

-- --------------------------------------------------------

--
-- Table structure for table `master_wilayah`
--

CREATE TABLE `master_wilayah` (
  `id` int NOT NULL,
  `kecamatan` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kabupaten` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `provinsi` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `master_wilayah`
--

INSERT INTO `master_wilayah` (`id`, `kecamatan`, `kabupaten`, `provinsi`) VALUES
(1, 'Cempaka Putih', 'Jakarta Pusat', 'DKI Jakarta'),
(2, 'Johar Baru', 'Jakarta Pusat', 'DKI Jakarta'),
(3, 'Kemayoran', 'Jakarta Pusat', 'DKI Jakarta'),
(4, 'Sawah Besar', 'Jakarta Pusat', 'DKI Jakarta'),
(5, 'Senen', 'Jakarta Pusat', 'DKI Jakarta'),
(6, 'Tanah Abang', 'Jakarta Pusat', 'DKI Jakarta'),
(7, 'Menteng', 'Jakarta Pusat', 'DKI Jakarta'),
(8, 'Gambir', 'Jakarta Pusat', 'DKI Jakarta'),
(9, 'Kebon Jeruk', 'Jakarta Barat', 'DKI Jakarta'),
(10, 'Kebayoran Baru', 'Jakarta Selatan', 'DKI Jakarta');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id` int NOT NULL,
  `foto_pegawai` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nip` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nama_pegawai` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Laki-laki',
  `email` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nomor_hp` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tempat_lahir` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_kecamatan` int DEFAULT NULL,
  `alamat_lengkap` text COLLATE utf8mb4_general_ci,
  `jarak_rumah_kantor` tinyint DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `status_kawin` enum('kawin','tidak kawin') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jumlah_anak` tinyint DEFAULT '0',
  `tanggal_masuk` date DEFAULT NULL,
  `id_jabatan` int DEFAULT NULL,
  `id_departemen` int DEFAULT NULL,
  `usia` int DEFAULT NULL,
  `status` enum('Aktif','Nonaktif') COLLATE utf8mb4_general_ci DEFAULT 'Aktif',
  `status_kontrak` enum('PKWTT','PKWT','Magang') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'PKWTT',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id`, `foto_pegawai`, `nip`, `nama_pegawai`, `jenis_kelamin`, `email`, `nomor_hp`, `tempat_lahir`, `id_kecamatan`, `alamat_lengkap`, `jarak_rumah_kantor`, `tanggal_lahir`, `status_kawin`, `jumlah_anak`, `tanggal_masuk`, `id_jabatan`, `id_departemen`, `usia`, `status`, `status_kontrak`, `created_at`, `updated_at`) VALUES
(1, NULL, '198501012010011001', 'Ahmad Fauzi', 'Laki-laki', 'ahmad.fauzi@kepegawaian.go.id', '+6281234567890', 'Jakarta', 1, 'Jl. Merdeka No. 10, Cempaka Putih', 5, '1985-01-01', 'kawin', 2, '2010-01-15', 1, 5, 41, 'Aktif', 'PKWTT', '2026-06-27 12:32:49', '2026-06-28 03:26:40'),
(2, NULL, '199002152012022001', 'Rina Marlina', 'Laki-laki', 'rina.marlina@kepegawaian.go.id', '+6281234567891', 'Bandung', NULL, 'Jl. Kemayoran Jaya No. 25', 8, '1990-02-15', 'kawin', 1, '2012-02-20', 1, 11, 36, 'Aktif', 'PKWTT', '2026-06-27 12:32:49', '2026-06-28 09:10:10'),
(3, NULL, '199208302015032002', 'Budi Santoso', 'Laki-laki', 'budi.santoso@kepegawaian.go.id', '081234567892', 'Surabaya', 5, 'Jl. Senen Raya No. 88', 3, '1992-08-30', 'tidak kawin', 0, '2015-03-10', 2, 10, 33, 'Aktif', 'PKWT', '2026-06-27 12:32:49', '2026-06-27 12:32:49'),
(4, NULL, '198811112013011003', 'Dewi Lestari', 'Laki-laki', 'dewi.lestari@kepegawaian.go.id', '081234567893', 'Yogyakarta', 8, 'Jl. Gambir No. 5', 2, '1988-11-11', 'kawin', 3, '2013-01-05', 2, 9, 37, 'Aktif', 'PKWT', '2026-06-27 12:32:49', '2026-06-27 12:32:49'),
(5, NULL, '199506202018012004', 'Siti Aminah', 'Laki-laki', 'siti.aminah@kepegawaian.go.id', '081234567894', 'Semarang', 6, 'Jl. Tanah Abang No. 12', 6, '1995-06-20', 'tidak kawin', 0, '2018-01-20', 3, 11, 31, 'Aktif', 'Magang', '2026-06-27 12:32:49', '2026-06-27 12:32:49'),
(6, 'pegawai_1782639213_6.png', '000000000', 'Giska Saputra', 'Laki-laki', 'giskasaputra2005@gmail.com', '+6285867688482', 'Tegal', 1, 'Jalan Serayu', 80, '2020-01-28', 'tidak kawin', 0, '2026-06-16', 1, 5, 6, 'Aktif', 'PKWTT', '2026-06-28 09:11:14', '2026-06-28 09:44:49');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai_pendidikan`
--

CREATE TABLE `pegawai_pendidikan` (
  `id` int NOT NULL,
  `id_pegawai` int NOT NULL,
  `tingkat` varchar(50) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Contoh: SD, SMP, SMA, S1',
  `nama_sekolah` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `tahun_lulus` year NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pegawai_pendidikan`
--

INSERT INTO `pegawai_pendidikan` (`id`, `id_pegawai`, `tingkat`, `nama_sekolah`, `tahun_lulus`) VALUES
(10, 5, 'SD', 'SD Negeri 12 Semarang', 2005),
(11, 5, 'SMP', 'SMP Negeri 07 Semarang', 2008),
(12, 5, 'SMA', 'SMA Negeri 02 Semarang', 2011),
(13, 5, 'S1', 'Universitas Diponegoro', 2015),
(22, 2, 'SD', 'SD Negeri 05 Bandung', 2000),
(23, 2, 'SMP', 'SMP Negeri 08 Bandung', 2003),
(24, 2, 'SMA', 'SMA Negeri 03 Bandung', 2006),
(25, 2, 'S1', 'Universitas Padjadjaran', 2010);

-- --------------------------------------------------------

--
-- Table structure for table `role_permission`
--

CREATE TABLE `role_permission` (
  `id` int NOT NULL,
  `id_role` smallint DEFAULT NULL,
  `modul_fitur` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `akses` tinyint(1) DEFAULT '0',
  `create` tinyint(1) DEFAULT '0',
  `read` enum('All','Own','No') COLLATE utf8mb4_general_ci DEFAULT 'No',
  `update` enum('All','Own','No') COLLATE utf8mb4_general_ci DEFAULT 'No',
  `delete` enum('All','Own','No') COLLATE utf8mb4_general_ci DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role_permission`
--

INSERT INTO `role_permission` (`id`, `id_role`, `modul_fitur`, `akses`, `create`, `read`, `update`, `delete`) VALUES
(1, 1, 'kelola_role', 1, 0, 'All', '', ''),
(2, 1, 'kelola_user', 1, 1, 'All', 'All', 'All'),
(3, 1, 'my_profile', 1, 0, 'All', 'All', ''),
(4, 1, 'dashboard', 1, 0, 'All', '', ''),
(5, 1, 'modul_pegawai', 0, 0, 'No', '', ''),
(6, 1, 'modul_tunjangan_transport', 0, 0, 'No', '', ''),
(7, 1, 'setting_tunjangan_transport', 0, 0, 'No', '', ''),
(8, 1, 'modul_log', 1, 0, 'All', '', ''),
(9, 2, 'kelola_role', 0, 0, 'No', '', ''),
(10, 2, 'kelola_user', 0, 0, 'No', '', ''),
(11, 2, 'my_profile', 1, 0, 'All', 'All', ''),
(12, 2, 'dashboard', 1, 0, 'All', '', ''),
(13, 2, 'modul_pegawai', 1, 0, 'All', '', ''),
(14, 2, 'modul_tunjangan_transport', 1, 0, 'All', '', ''),
(15, 2, 'setting_tunjangan_transport', 0, 0, 'No', '', ''),
(16, 2, 'modul_log', 0, 0, 'No', '', ''),
(17, 3, 'kelola_role', 0, 0, 'No', '', ''),
(18, 3, 'kelola_user', 0, 0, 'No', '', ''),
(19, 3, 'my_profile', 1, 0, 'All', 'All', ''),
(20, 3, 'dashboard', 1, 0, 'All', '', ''),
(21, 3, 'modul_pegawai', 1, 1, 'All', 'All', 'All'),
(22, 3, 'modul_tunjangan_transport', 1, 0, 'All', '', ''),
(23, 3, 'setting_tunjangan_transport', 1, 1, 'All', 'All', 'All'),
(24, 3, 'modul_log', 0, 0, 'No', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tunjangan_bulan`
--

CREATE TABLE `tunjangan_bulan` (
  `id` int NOT NULL,
  `nama_bulan` varchar(20) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Contoh: Januari, Februari',
  `tahun` year NOT NULL,
  `total_penerima` int DEFAULT '0',
  `total_tunjangan` bigint DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tunjangan_bulan`
--

INSERT INTO `tunjangan_bulan` (`id`, `nama_bulan`, `tahun`, `total_penerima`, `total_tunjangan`, `created_at`) VALUES
(1, 'June', 2026, 0, 0, '2026-06-26 10:29:05'),
(2, 'June', 2026, 0, 0, '2026-06-26 10:35:26'),
(3, 'June', 2026, 0, 0, '2026-06-27 02:39:34');

-- --------------------------------------------------------

--
-- Table structure for table `tunjangan_detail`
--

CREATE TABLE `tunjangan_detail` (
  `id` bigint NOT NULL,
  `id_tunjangan_bulan` int NOT NULL,
  `id_pegawai` int NOT NULL,
  `km` decimal(5,2) NOT NULL,
  `hari_masuk` int NOT NULL,
  `nominal` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tunjangan_detail`
--

INSERT INTO `tunjangan_detail` (`id`, `id_tunjangan_bulan`, `id_pegawai`, `km`, `hari_masuk`, `nominal`) VALUES
(2, 1, 1, '4.00', 20, 0),
(22, 2, 1, '4.00', 16, 0),
(23, 2, 3, '0.00', 22, 0),
(46, 3, 1, '5.00', 18, 0),
(47, 3, 2, '8.00', 17, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tunjangan_setting`
--

CREATE TABLE `tunjangan_setting` (
  `id` int NOT NULL,
  `base_fare` int NOT NULL COMMENT 'Tarif per km',
  `berlaku_mulai` date NOT NULL,
  `min_km` int NOT NULL,
  `max_km` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tunjangan_setting`
--

INSERT INTO `tunjangan_setting` (`id`, `base_fare`, `berlaku_mulai`, `min_km`, `max_km`, `created_at`, `updated_at`) VALUES
(1, 1000, '2026-02-05', 5, 25, '2026-06-26 10:33:08', '2026-06-26 10:33:08'),
(2, 5000, '2026-02-05', 5, 25, '2026-06-26 10:34:28', '2026-06-26 10:34:28'),
(3, 5000, '2026-06-26', 5, 25, '2026-06-26 10:38:20', '2026-06-26 10:38:20'),
(4, 5000, '2026-06-27', 5, 25, '2026-06-27 02:38:45', '2026-06-27 02:38:45'),
(5, 5000, '2026-05-01', 5, 25, '2026-06-27 02:39:23', '2026-06-27 02:39:23');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `id_role` smallint DEFAULT NULL,
  `id_pegawai` int DEFAULT NULL,
  `username` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password_hash` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nama` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `last_session` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `disabled` tinyint DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `id_role`, `id_pegawai`, `username`, `password_hash`, `nama`, `email`, `last_session`, `last_login`, `updated_at`, `created_at`, `disabled`) VALUES
(1, 1, NULL, 'superadmin', '$2y$13$T9i4jdtWRuHwl5IX2sB9W.D.1vwrSORCXa.WpQNDV6ihx59za2sCu', 'Superadmin', 'superadmin@kepegawaian.go.id', NULL, NULL, '2026-06-27 12:32:49', '2026-06-27 12:32:49', 0),
(2, 2, NULL, 'manager_hrd', '$2y$13$FnIX.lN3sCPm7QWNNxjN0eZEs6JO3LpMwlK8u9jOzGZ9svKPMQBUW', 'Agus Prasetyo', 'agus.prasetyo@kepegawaian.go.id', NULL, NULL, '2026-06-27 12:32:49', '2026-06-27 12:32:49', 0),
(3, 3, NULL, 'admin_hrd', '$2y$13$P4/nTnvtLSGyehlUSgxuquOdAt0crflrfU.aEs4hlITieknh1j1SC', 'Rina Marlina', 'rina.marlina@kepegawaian.go.id', NULL, NULL, '2026-06-27 12:32:49', '2026-06-27 12:32:49', 0),
(5, 2, 1, 'ahmadfauzi123', '$2y$13$5VRBiH7hkePl317NFxIyVuwXYBPW.2Q7nsfZMoDAijaWQFIVOELYa', NULL, NULL, NULL, NULL, '2026-06-28 10:33:50', '2026-06-28 05:08:09', 0),
(6, 2, 6, 'giskasaputra', '$2y$13$9681Z4IzeUKLtiANtjtuau3jV/VpwnF8TfBhSYOK4vzLn2y9JBp4y', NULL, NULL, NULL, NULL, '2026-06-28 12:31:19', '2026-06-28 12:31:19', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` smallint NOT NULL,
  `nama_role` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `nama_role`, `created_at`) VALUES
(1, 'Superadmin', '2026-06-27 12:32:46'),
(2, 'Manager HRD', '2026-06-27 12:32:46'),
(3, 'Admin HRD', '2026-06-27 12:32:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_activities_created` (`created_by`),
  ADD KEY `fk_activities_updated` (`updated_by`);

--
-- Indexes for table `master_data`
--
ALTER TABLE `master_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_wilayah`
--
ALTER TABLE `master_wilayah`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_kecamatan` (`kecamatan`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nip` (`nip`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_pegawai_jabatan` (`id_jabatan`),
  ADD KEY `fk_pegawai_departemen` (`id_departemen`),
  ADD KEY `fk_pegawai_kecamatan` (`id_kecamatan`);

--
-- Indexes for table `pegawai_pendidikan`
--
ALTER TABLE `pegawai_pendidikan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pendidikan_pegawai` (`id_pegawai`);

--
-- Indexes for table `role_permission`
--
ALTER TABLE `role_permission`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_permission_role` (`id_role`);

--
-- Indexes for table `tunjangan_bulan`
--
ALTER TABLE `tunjangan_bulan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tunjangan_detail`
--
ALTER TABLE `tunjangan_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_detail_tunjangan_bulan` (`id_tunjangan_bulan`),
  ADD KEY `fk_detail_tunjangan_pegawai` (`id_pegawai`);

--
-- Indexes for table `tunjangan_setting`
--
ALTER TABLE `tunjangan_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `username` (`username`) USING BTREE,
  ADD KEY `user_ibfk_1` (`id_role`),
  ADD KEY `fk_user_pegawai` (`id_pegawai`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `master_data`
--
ALTER TABLE `master_data`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `master_wilayah`
--
ALTER TABLE `master_wilayah`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pegawai_pendidikan`
--
ALTER TABLE `pegawai_pendidikan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `role_permission`
--
ALTER TABLE `role_permission`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tunjangan_bulan`
--
ALTER TABLE `tunjangan_bulan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tunjangan_detail`
--
ALTER TABLE `tunjangan_detail`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `tunjangan_setting`
--
ALTER TABLE `tunjangan_setting`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` smallint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activities`
--
ALTER TABLE `activities`
  ADD CONSTRAINT `fk_activities_created` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_activities_updated` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `fk_pegawai_departemen` FOREIGN KEY (`id_departemen`) REFERENCES `master_data` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pegawai_jabatan` FOREIGN KEY (`id_jabatan`) REFERENCES `master_data` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pegawai_kecamatan` FOREIGN KEY (`id_kecamatan`) REFERENCES `master_wilayah` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `pegawai_pendidikan`
--
ALTER TABLE `pegawai_pendidikan`
  ADD CONSTRAINT `fk_pendidikan_pegawai` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_permission`
--
ALTER TABLE `role_permission`
  ADD CONSTRAINT `fk_permission_role` FOREIGN KEY (`id_role`) REFERENCES `user_role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tunjangan_detail`
--
ALTER TABLE `tunjangan_detail`
  ADD CONSTRAINT `fk_detail_tunjangan_bulan` FOREIGN KEY (`id_tunjangan_bulan`) REFERENCES `tunjangan_bulan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_detail_tunjangan_pegawai` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_pegawai` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `user_role` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
