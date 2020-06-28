-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 28, 2020 at 05:46 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simda`
--

-- --------------------------------------------------------

--
-- Table structure for table `access`
--

CREATE TABLE `access` (
  `users_id` smallint(5) UNSIGNED NOT NULL,
  `role_id` smallint(5) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` varchar(10) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `access`
--

INSERT INTO `access` (`users_id`, `role_id`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(7, 1, '2020-06-28 19:41:34', '', '2020-06-28 12:41:34', ''),
(7, 2, '2020-06-28 19:41:34', '', '2020-06-28 12:41:34', ''),
(7, 3, '2020-06-28 19:41:34', '', '2020-06-28 12:41:34', ''),
(7, 4, '2020-06-28 19:41:34', '', '2020-06-28 12:41:34', ''),
(7, 5, '2020-06-28 19:41:34', '', '2020-06-28 12:41:34', ''),
(7, 6, '2020-06-28 19:41:34', '', '2020-06-28 12:41:34', ''),
(7, 7, '2020-06-28 19:41:34', '', '2020-06-28 12:41:34', ''),
(7, 8, '2020-06-28 19:41:34', '', '2020-06-28 12:41:34', '');

-- --------------------------------------------------------

--
-- Table structure for table `competency`
--

CREATE TABLE `competency` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `role_id` smallint(5) UNSIGNED NOT NULL,
  `competency` varchar(30) NOT NULL,
  `details` tinytext NOT NULL,
  `bobot` tinyint(3) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` varchar(10) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `competency`
--

INSERT INTO `competency` (`id`, `role_id`, `competency`, `details`, `bobot`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 1, 'Kompetensi 1', 'Kompetensi sikap spiritual.', 4, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(2, 1, 'Kompetensi 2', 'Kompetensi sikap sosial.', 4, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(3, 1, 'Kompetensi 3', 'Kompetensi pengetahuan.', 4, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(4, 1, 'Kompetensi 4', 'Kompetensi keterampilan.', 3, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(5, 1, 'Kompetensi 5', 'Kesesuaian perangkat pembelajaran dengan tingkat kompetensi dan ruang lingkup materi.', 4, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(6, 1, 'Kompetensi 6', 'Dokumen unsur yang terlibat dalam Tim Pengembang Kurikulum di Sekolah/Madrasah.', 3, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(7, 1, 'Kompetensi 7', 'Komponen-komponen KTSP.', 4, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(8, 1, 'Kompetensi 8', 'Tahapan Prosedur Operasional Pengembangan KTSP.', 3, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(9, 1, 'Kompetensi 9', 'Ketentuan pelaksanaan kurikulum.', 4, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(10, 2, 'Kompetensi 10', 'Ketersediaan komponen dalam pengembangan silabus setiap mata pelajaran.', 3, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(11, 2, 'Kompetensi 11', 'Mata Pelajaran yang RPP-nya lengkap dan sistematis.', 4, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(12, 2, 'Kompetensi 12', 'Alokasi waktu dan beban belajar.', 3, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(13, 2, 'Kompetensi 13', 'Jumlah siswa tiap rombongan belajar.', 3, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(14, 2, 'Kompetensi 14', 'Penggunaan buku teks pelajaran.', 3, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(15, 2, 'Kompetensi 15', 'Pengelolaan kelas.', 3, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(16, 2, 'Kompetensi 16', 'Pelaksanaan pendahuluan pembelajaran.', 3, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(17, 2, 'Kompetensi 17', 'Pelaksanaan model pembelajaran.', 3, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(18, 2, 'Kompetensi 18', 'Pelaksanaan metode pembelajaran.', 4, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(19, 2, 'Kompetensi 19', 'Pelaksanaan media pembelajaran.', 3, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(20, 2, 'Kompetensi 20', 'Pelaksanaan sumber belajar pembelajaran.', 3, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(21, 2, 'Kompetensi 21', 'Pelaksanaan pendekatan pembelajaran.', 3, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(22, 2, 'Kompetensi 22', 'Pelaksanaan penutup pembelajaran.', 3, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(23, 2, 'Kompetensi 23', 'Penggunaan Penilaian otentik oleh guru.', 3, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(24, 2, 'Kompetensi 24', 'Pemanfaatan hasil penilaian otentik untuk 4 kegiatan.', 4, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(25, 2, 'Kompetensi 25', 'Pelaksanaan pengawasan kepala sekolah/madrasah.', 3, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(26, 2, 'Kompetensi 26', 'Pelaksanaan supervisi proses pembelajaran dalam tiga tahun terakhir.', 4, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(27, 2, 'Kompetensi 27', 'Pemantauan proses pembelajaran oleh kepala sekolah/madrasah.', 3, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(28, 2, 'Kompetensi 28', 'pelaksanaan tindak lanjut supervisi proses pembelajaran oleh kepala sekolah/madrasah.', 3, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(29, 2, 'Kompetensi 29', 'Laporan pemantauan dan program tindak lanjut.', 3, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(30, 2, 'Kompetensi 30', 'Pelaksanaan tindak lanjut hasil pengawasan proses pembelajaranoleh kepala sekolah/madrasah.', 3, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(31, 3, 'Kompetensi 31', 'Mengembangkan sikap orang beriman.', 4, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(32, 3, 'Kompetensi 32', 'Mengembangkan sikap sosial dengan karakter.', 4, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(33, 3, 'Kompetensi 33', 'Mengembangkan gerakan literasi.', 4, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(34, 3, 'Kompetensi 34', 'Mengembangkan perilaku sehat jasmani dan rohani.', 3, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(35, 3, 'Kompetensi 35', 'Dimensi pengetahuan yang dikembangkan oleh sekolah/madrasah.', 4, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(36, 3, 'Kompetensi 36', 'Kegiatan yang menunjukkan kemampuan siswa berpikir kreatif, produktif, dan kritis.', 3, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(37, 3, 'Kompetensi 37', 'Kegiatan yang mencerminkan keterampilan bertindak secara mandiri, kolaboratif, dan komunikatif.', 4, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(38, 4, 'Kompetensi 38', 'Jumlah guru yang dimiliki sekolah/madrasah.', 4, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(39, 4, 'Kompetensi 39', 'Kualifikasi guru yang dimiliki sekolah/madrasah.', 3, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(40, 4, 'Kompetensi 40', 'Latar belakang pendidikan dan mata pelajaran yang diampu.', 4, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(41, 4, 'Kompetensi 41', 'Kompetensi pedagogik guru.', 4, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(42, 4, 'Kompetensi 42', 'Kompetensi profesional guru.', 4, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(43, 4, 'Kompetensi 43', 'Kompetensi kepribadian guru.', 4, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(44, 4, 'Kompetensi 44', 'Kompetensi sosial guru.', 4, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(45, 4, 'Kompetensi 45', 'Kompetensi guru bimbingan dan konseling.', 3, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(46, 4, 'Kompetensi 46', 'Rasio guru BK dan jumlah siswa.', 3, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(47, 4, 'Kompetensi 47', 'Kepala sekolah/madrasah memenuhi persyaratan sesuai standar.', 4, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(48, 4, 'Kompetensi 48', 'Kepala sekolah/madrasah memiliki kompetensi manajerial.', 4, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(49, 4, 'Kompetensi 49', 'Kepala sekolah/madrasah memiliki kemampuan wirausaha.', 3, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(50, 4, 'Kompetensi 50', 'Kepala sekolah/madrasah memiliki kemampuan supervisi akademik.', 4, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(51, 4, 'Kompetensi 51', 'Kepala tenaga administrasi.', 3, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(52, 4, 'Kompetensi 52', 'Tenaga administrasi.', 2, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(53, 4, 'Kompetensi 53', 'Kepala perpustakaan.', 3, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(54, 4, 'Kompetensi 54', 'Tenaga perpustakaan.', 2, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(55, 4, 'Kompetensi 55', 'Tenaga laboran.', 3, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(56, 4, 'Kompetensi 56', 'Petugas layanan khusus.', 2, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(57, 5, 'Kompetensi 57', 'Jumlah rombongan belajar dan luas lahan sekolah/madrasah.', 3, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(58, 5, 'Kompetensi 58', 'Kondisi lahan sekolah/madrasah.', 4, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(59, 5, 'Kompetensi 59', 'Luas lantai bangunan sekolah/madrasah.', 3, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(60, 5, 'Kompetensi 60', 'Persyaratan keselamatan sekolah/madrasah.', 4, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(61, 5, 'Kompetensi 61', 'Persyaratan kesehatan sekolah/madrasah.', 3, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(62, 5, 'Kompetensi 62', 'Daya listrik yang dimiliki sekolah/madrasah.', 3, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(63, 5, 'Kompetensi 63', 'Pemeliharaan berkala.', 2, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(64, 5, 'Kompetensi 64', 'Prasarana yang dimiliki sekolah/madrasah.', 3, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(65, 5, 'Kompetensi 65', 'Ruang kelas.', 3, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(66, 5, 'Kompetensi 66', 'Sekolah/madrasah memiliki ruang perpustakaan dengan luas dan sarana sesuai ketentuan.', 3, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(67, 5, 'Kompetensi 67', 'Ruang laboratorium IPA.', 3, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(68, 5, 'Kompetensi 68', 'Luas ruang pimpinan.', 3, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(69, 5, 'Kompetensi 69', 'Ruang guru.', 3, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(70, 5, 'Kompetensi 70', 'Ruang tenaga administrasi.', 3, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(71, 5, 'Kompetensi 71', 'Tempat ibadah.', 3, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(72, 5, 'Kompetensi 72', 'Ruang konseling.', 2, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(73, 5, 'Kompetensi 73', 'Ruang UKS.', 2, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(74, 5, 'Kompetensi 74', 'Luas ruang organisasi kesiswaan.', 2, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(75, 5, 'Kompetensi 75', 'Jamban dan sarana jamban.', 4, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(76, 5, 'Kompetensi 76', 'Luas dan sarana gudang.', 2, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(77, 5, 'Kompetensi 77', 'Tempat bermain, berolahraga, berkesenian, keterampilan dan upacara.', 3, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(78, 5, 'Kompetensi 78', 'Ruang sirkulasi.', 3, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(79, 5, 'Kompetensi 79', 'Kantin.', 2, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(80, 5, 'Kompetensi 80', 'Tempat parkir.', 1, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(81, 6, 'Kompetensi 81', 'Uraian visi, misi, dan tujuan sekolah/madrasah.', 4, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(82, 6, 'Kompetensi 82', 'Rencana kerja jangka menengah (RKJM) 4 tahunan dan Rencana Kerja Tahunan (RKT).', 4, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(83, 6, 'Kompetensi 83', 'Dokumen pedoman pengelolaan pendidikan.', 4, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(84, 6, 'Kompetensi 84', 'Dokumen struktur organisasi sekolah/madrasah.', 2, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(85, 6, 'Kompetensi 85', 'Pelaksanaan kegiatan sekolah/madrasah sesuai rencana kerja tahunan (RKT).', 3, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(86, 6, 'Kompetensi 86', 'Kegiatan kesiswaan yang dilakukan sekolah/madrasah.', 4, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(87, 6, 'Kompetensi 87', 'Pengelolaan bidang kurikulum dan kegiatan pembelajaran.', 3, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(88, 6, 'Kompetensi 88', 'Pelaksanaan program pendayagunaan pendidik dan tenaga kependidikan.', 3, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(89, 6, 'Kompetensi 89', 'Pelaksanaan penilaian kinerja pendidik dan tenaga kependidikan.', 3, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(90, 6, 'Kompetensi 90', 'Penyusunan pedoman pengelolaan pembiayaan investasi dan operasional pendidikan.', 3, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(91, 6, 'Kompetensi 91', 'Kegiatan Pengelolaan pendidikan yang melibatkan peran serta masyarakat dan kemitraan dengan lembaga lain yang relevan.', 4, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(92, 6, 'Kompetensi 92', 'Hasil evaluasi diri dalam rangka pemenuhan SNP.', 4, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(93, 6, 'Kompetensi 93', 'Pelaksanaan tugas kepemimpinan kepala sekolah/madrasah.', 4, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(94, 6, 'Kompetensi 94', 'Penerapan prinsip-prinsip kepemimpinan pembelajaran kepala sekolah/madrasah.', 4, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(95, 6, 'Kompetensi 95', 'Komponen Sistem Informasi Manajemen.', 3, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(96, 7, 'Kompetensi 96', 'Alokasi anggaran untuk investasi dalam RKA selama 3 (tiga) tahun terakhir.', 3, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(97, 7, 'Kompetensi 97', 'Alokasi Biaya Operasional Nonpersonalia dalam RKA selama 3 (tiga) tahun terakhir.', 3, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(98, 7, 'Kompetensi 98', 'Dokumen investasi sarana dan prasarana dalam 3 (tiga) tahun terakhir.', 2, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(99, 7, 'Kompetensi 99', 'Biaya pengembangan pendidik dan tenaga kependidikan (biaya pendidikan lanjut, pelatihan, seminar, dan lain-lain) dalam RKA selama 3 (tiga) tahun terakhir.', 3, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(100, 7, 'Kompetensi 100', 'Modal kerja untuk kebutuhan pendidikan dalam RKA selama 3 (tiga) tahun terakhir.', 3, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(101, 7, 'Kompetensi 101', 'Biaya operasional untuk guru dan tenaga kependidikan dalam RKA pada tahun berjalan.', 2, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(102, 7, 'Kompetensi 102', 'Realisasi anggaran pengadaan alat tulis dalam RKA selama 3 (tiga) tahun terakhir.', 3, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(103, 7, 'Kompetensi 103', 'Realisasi anggaran pengadaan bahan dan alat habis pakai dalam RKA selama 3 (tiga) tahun terakhir.', 3, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(104, 7, 'Kompetensi 104', 'Realisasi biaya pemeliharaan dan perbaikan berkala sarana dan prasarana dalam RKA selama 3 (tiga) tahun terakhir.', 3, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(105, 7, 'Kompetensi 105', 'Realisasi biaya daya dan jasa dalam RKA selama 3 (tiga) tahun terakhir.', 2, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(106, 7, 'Kompetensi 106', 'Realisasi transportasi, perjalanan dinas, dan konsumsi dalam RKA selama 3 (tiga) tahun terakhir.', 2, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(107, 7, 'Kompetensi 107', 'Realisasi kegiatan pembinaan siswa dan ekstrakulikuler dalam RKA selama 3 (tiga) tahun terakhir.', 3, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(108, 7, 'Kompetensi 108', 'Realisasi anggaran untuk pelaporan dalam RKA selama 3 (tiga) tahun terakhir.', 2, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(109, 7, 'Kompetensi 109', 'Pengelolaan sumbangan pendidikan atau dana dari masyarakat/pemerintah dalam RKA selama 3 (tiga) tahun terakhir.', 3, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(110, 7, 'Kompetensi 110', 'Pembukaan keuangan sekolah/madrasah.', 3, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(111, 7, 'Kompetensi 111', 'Laporan pertanggungjawaban keuangan selama 3 (tiga) tahun terakhir.', 4, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(112, 8, 'Kompetensi 112', 'Prinsip penilaian hasil belajar siswa.', 4, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(113, 8, 'Kompetensi 113', 'Penentuan Kriteria Ketuntasan Minimal (KKM).', 4, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(114, 8, 'Kompetensi 114', 'Bentuk pelaksanaan penilaian hasil belajar oleh guru.', 4, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(115, 8, 'Kompetensi 115', 'Penggunaan hasil penilaian kompetensi pengetahuan.', 4, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(116, 8, 'Kompetensi 116', 'Penilaian kompetensi sikap sesuai karakteristik kompetensi dasar.', 4, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(117, 8, 'Kompetensi 117', 'Penilaian kompetensi pengetahuan sesuai karakteristik kompetensi dasar.', 4, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(118, 8, 'Kompetensi 118', 'Penilaian kompetensi keterampilan sesuai karakteristik kompetensi dasar.', 4, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(119, 8, 'Kompetensi 119', 'Tahapan penilaian kompetensi sikap.', 3, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(120, 8, 'Kompetensi 120', 'Jenis penilaian kompetensi pengetahuan.', 3, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(121, 8, 'Kompetensi 121', 'Jenis penilaian kompetensi keterampilan.', 3, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(122, 8, 'Kompetensi 122', 'Dokumen penilaian hasil belajar.', 3, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(123, 8, 'Kompetensi 123', 'Penentuan kelulusan siswa.', 3, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', ''),
(124, 8, 'Kompetensi 124', 'Langkah penilaian proses dan hasil belajar.', 3, '0000-00-00 00:00:00', '', '2020-06-28 13:08:28', '');

-- --------------------------------------------------------

--
-- Table structure for table `document`
--

CREATE TABLE `document` (
  `id` bigint(20) NOT NULL,
  `competency_id` smallint(5) UNSIGNED NOT NULL,
  `reference` varchar(10) NOT NULL,
  `type` varchar(30) NOT NULL,
  `location` varchar(100) NOT NULL,
  `year` year(4) NOT NULL,
  `status` enum('terdata','diajukan','tervalidasi','revisi') NOT NULL,
  `note` tinytext NOT NULL,
  `created_by` varchar(10) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `type` varchar(30) NOT NULL,
  `reference` varchar(10) NOT NULL,
  `message` tinytext NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` varchar(10) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mapel`
--

CREATE TABLE `mapel` (
  `id` int(10) UNSIGNED NOT NULL,
  `mapel` varchar(30) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` varchar(10) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mapel`
--

INSERT INTO `mapel` (`id`, `mapel`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(2, 'Enim molestiae inven', '2020-06-28 21:15:38', '', '2020-06-28 14:15:38', ''),
(3, 'Update In', '2020-06-28 21:26:57', '', '2020-06-28 15:03:02', '');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `role` varchar(30) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` varchar(10) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `role`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'Standar Isi', '2020-06-21 00:52:42', '', '2020-06-20 17:52:42', ''),
(2, 'Standar Proses', '2020-06-21 00:52:42', '', '2020-06-20 17:52:42', ''),
(3, 'Standar Kompetensi Lulusan', '2020-06-21 00:52:42', '', '2020-06-20 17:52:42', ''),
(4, 'Standar Pendidik dan Tendik', '2020-06-21 00:52:42', '', '2020-06-20 17:52:42', ''),
(5, 'Standar Sarana dan Prasarana', '2020-06-21 00:52:42', '', '2020-06-20 17:52:42', ''),
(6, 'Standar Pengelolaan', '2020-06-21 00:52:42', '', '2020-06-20 17:52:42', ''),
(7, 'Standar Pembiayaan', '2020-06-21 00:52:42', '', '2020-06-20 17:52:42', ''),
(8, 'Standar Penilaian Pendidikan', '2020-06-21 00:52:42', '', '2020-06-20 17:52:42', '');

-- --------------------------------------------------------

--
-- Table structure for table `submission`
--

CREATE TABLE `submission` (
  `id` bigint(20) NOT NULL,
  `type` varchar(30) NOT NULL,
  `reference` varchar(10) NOT NULL,
  `status` enum('belum dicek','sudah dicek') NOT NULL,
  `note` tinytext NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` varchar(10) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `mapel_id` int(10) UNSIGNED NOT NULL,
  `nip` varchar(18) DEFAULT NULL,
  `teacher_name` varchar(40) DEFAULT NULL,
  `address` tinytext DEFAULT NULL,
  `phone` varchar(13) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `last_ed` enum('SMA/MA','D1','D2','D3','S1/D4','S2','S3') NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` varchar(10) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`id`, `mapel_id`, `nip`, `teacher_name`, `address`, `phone`, `email`, `last_ed`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(2, 2, '38', 'Briar Clark uapsd asda d', 'Quisquam dicta qui n', '57', 'miwibi@mailinator.com', 'D3', '2020-06-28 21:30:35', '', '2020-06-28 14:36:47', ''),
(4, 3, '95', 'Dorian Cameron', 'Tempora sunt simili', '62', 'qucag@mailinator.com', 'D1', '2020-06-28 21:30:51', '', '2020-06-28 14:30:51', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `address` tinytext DEFAULT NULL,
  `phone` varchar(13) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` tinytext NOT NULL,
  `photo` tinytext DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `created_by` varchar(10) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `address`, `phone`, `email`, `password`, `photo`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(7, 'Ghany AE', 'Perumahan Griyashanta Eksekutif P360 asdad', '082164028264', 'ghanyersa24@gmail.com', '$2y$10$39tvNOG8ZfEW3ZDU3Zbua.cC41LvCVuwV0En6089mmg6eliaclsLm', NULL, '2020-06-28 19:41:34', '', '2020-06-28 15:19:20', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access`
--
ALTER TABLE `access`
  ADD PRIMARY KEY (`users_id`,`role_id`),
  ADD KEY `users_has_role_FKIndex1` (`users_id`),
  ADD KEY `users_has_role_FKIndex2` (`role_id`);

--
-- Indexes for table `competency`
--
ALTER TABLE `competency`
  ADD PRIMARY KEY (`id`),
  ADD KEY `competences_FKIndex1` (`role_id`);

--
-- Indexes for table `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`id`),
  ADD KEY `document_FKIndex1` (`competency_id`);

--
-- Indexes for table `mapel`
--
ALTER TABLE `mapel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `submission`
--
ALTER TABLE `submission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `teacher_unique` (`email`,`phone`),
  ADD KEY `teacher_FKIndex1` (`mapel_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_unique` (`email`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `competency`
--
ALTER TABLE `competency`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT for table `document`
--
ALTER TABLE `document`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mapel`
--
ALTER TABLE `mapel`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `submission`
--
ALTER TABLE `submission`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `access`
--
ALTER TABLE `access`
  ADD CONSTRAINT `access_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `access_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `competency`
--
ALTER TABLE `competency`
  ADD CONSTRAINT `competency_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `document`
--
ALTER TABLE `document`
  ADD CONSTRAINT `document_ibfk_1` FOREIGN KEY (`competency_id`) REFERENCES `competency` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `teacher`
--
ALTER TABLE `teacher`
  ADD CONSTRAINT `teacher_ibfk_1` FOREIGN KEY (`mapel_id`) REFERENCES `mapel` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
