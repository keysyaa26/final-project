-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 12 Des 2024 pada 07.57
-- Versi server: 8.0.30
-- Versi PHP: 8.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bprotic_event_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admins`
--

CREATE TABLE `admins` (
  `admin_ID` int NOT NULL,
  `admin_role` enum('panitia','ketua_panitia') DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `admins`
--

INSERT INTO `admins` (`admin_ID`, `admin_role`, `name`, `phone`, `username`, `password`) VALUES
(1, 'panitia', 'Keysya', '09090', 'admin key', '$2a$12$Gw6n/tvW5dnp0Vk2myTNRuEUnIvMzXF/6m.AKXri7CfibhWlor4T6');

-- --------------------------------------------------------

--
-- Struktur dari tabel `attendee`
--

CREATE TABLE `attendee` (
  `attendee_ID` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `attendee`
--

INSERT INTO `attendee` (`attendee_ID`, `name`, `email`, `phone`) VALUES
(1, 'keysya', 'if23.keysyaaulia@mhs.ubpkarawang.ac.id', ''),
(2, 'keysya', 'if23.keysyaaulia@mhs.ubpkarawang.ac.id', ''),
(3, 'keysya', 'if23.keysyaaulia@mhs.ubpkarawang.ac.id', ''),
(4, 'Keysya', 'keysyaulia20@gmail.com', ''),
(5, 'keysya', 'if23.keysyaaulia@mhs.ubpkarawang.ac.id', '000'),
(6, 'keysya', 'if23.keysyaaulia@mhs.ubpkarawang.ac.id', '0000'),
(7, 'keysya', 'if23.keysyaaulia@mhs.ubpkarawang.ac.id', '00'),
(8, 'keysya', 'if23.keysyaaulia@mhs.ubpkarawang.ac.id', '00'),
(9, 'keysya', 'if23.keysyaaulia@mhs.ubpkarawang.ac.id', '9'),
(10, 'keysya', 'if23.keysyaaulia@mhs.ubpkarawang.ac.id', '000'),
(11, 'keysya', 'if23.keysyaaulia@mhs.ubpkarawang.ac.id', '000'),
(12, 'keysya', 'if23.keysyaaulia@mhs.ubpkarawang.ac.id', '99'),
(13, 'keysya', 'if23.keysyaaulia@mhs.ubpkarawang.ac.id', '2'),
(14, 'keysya', 'if23.keysyaaulia@mhs.ubpkarawang.ac.id', '99'),
(15, 'keysya', 'if23.keysyaaulia@mhs.ubpkarawang.ac.id', ''),
(16, 'Muhammad Ariel Ramo', 'arielramo2005@gmail.com', '085771282700'),
(17, 'adada', 'ariel@gmail.com', '123'),
(18, 'adada', 'ariel@gmail.com', '123'),
(19, 'Muhammad Ariel Ramo', 'arielramo2005@gmail.com', '085771282700'),
(20, 'Muhammad Ariel Ramo', 'arielramo2005@gmail.com', '085771282700'),
(21, 'Muhammad Ariel Ramo', 'arielramo2005@gmail.com', '085771282700'),
(22, 'asa', 'filoke4329@luxyss.com', '085771282700'),
(23, 'qwqw', 'yadepe5831@ikowat.com', '12'),
(24, 'Muhammad Ariel Ramo', 'janolof858@confmin.com', '1'),
(25, 'Muhammad Ariel Ramo', 'gidar63863@confmin.com', '085771282700'),
(26, 'ada', 'ridikek889@kindomd.com', ''),
(27, 'Muhammad Ariel Ramo', 'cokofos191@jonespal.com', '1'),
(28, 'amo', 'befaya8696@cantozil.com', '1'),
(29, 'as', 'woxafa3846@kindomd.com', '1'),
(30, 'asaa', 'saxani3717@cantozil.com', '1'),
(31, 'Muhammad Ariel Ramo', 'famey59340@nausard.com', '085771282700'),
(32, 'Muhammad Ariel Ramo', 'dirisa1397@ikowat.com', '085771282700'),
(33, 'adadaddadadadadadada', 'betoxo4612@jonespal.com', 'asad'),
(34, 'ksksk', 'selaxo3064@luxyss.com', '1'),
(35, 'jjjjjj', 'xibiya4196@jonespal.com', '1'),
(36, 'Muhammad Ariel Ramo', 'arielradadsa5@gmail.com', '085771282700'),
(37, 'Muhammad Ariel Ramo', 'adadawdad@gmail.com', '085771282700'),
(38, 'Muhammad Ariel Ramo', 'ariadda@gmail.com', '085771282700'),
(39, 'Muhammad Ariel Ramo', 'adadadad2005@gmail.com', '085771282700'),
(40, 'Muhammad Ariel Ramo', 'arielramosdaa2005@gmail.com', '085771282700'),
(41, 'Muhammad Ariel Ramo', 'arielramo2005@gmail.com', '085771282700'),
(42, 'Muhammad Ariel Ramo', 'ariedaasda05@gmail.com', '085771282700'),
(43, 'Muhammad Ariel Ramo', 'farow99928@kindomd.com', '085771282700'),
(44, 'amo', 'tegejoc420@luxyss.com', '085771282700'),
(45, 'Muhammad Ariel Ramo', 'nawiw46660@nausard.com', '085771282700'),
(46, 'Muhammad Ariel Ramo', 'towaf61564@jonespal.com', '085771282700'),
(47, 'Muhammad Ariel Ramo', 'adadadawdawdada05@gmail.com', '085771282700'),
(48, 'Muhammad Ariel Ramo', 'vahip76490@datingel.com', '085771282700'),
(49, 'Muhammad Ariel Ramo', 'rorocaw802@iminko.com', '085771282700'),
(50, 'Muhammad Ariel Ramo', 'mayepa8581@ckuer.com', '085771282700'),
(51, 'Muhammad Ariel Ramo', 'foyena6683@eoilup.com', '085771282700'),
(52, 'Muhammad Ariel Ramo', 'vagiwam488@bawsny.com', '085771282700'),
(53, 'Muhammad Ariel Ramo', 'noxepeb593@bawsny.com', '085771282700'),
(54, 'Muhammad Ariel Ramo', 'mabikaf676@lofiey.com', '085771282700'),
(55, 'Muhammad Ariel Ramo', 'leponip689@lofiey.com', '085771282700'),
(56, 'Muhammad Ariel Ramo', 'veyoji9410@rustetic.com', '085771282700'),
(57, 'Muhammad Ariel Ramo', 'fewapek691@lofiey.com', '085771282700'),
(58, 'Muhammad Ariel Ramo', 'fewapek691@lofiey.com', '085771282700'),
(59, 'Muhammad Ariel Ramo', 'rovoj39554@iminko.com', '085771282700'),
(60, 'Muhammad Ariel Ramo', 'rovoj39554@iminko.com', '085771282700'),
(61, 'Muhammad Ariel Ramo', 'feleco2205@pokeline.com', '085771282700'),
(62, 'Muhammad Ariel Ramo', 'vaniyax757@datingel.com', '085771282700'),
(63, 'Muhammad Ariel Ramo', 'vaniyax757@datingel.com', '085771282700'),
(64, 'Muhammad Ariel Ramo', 'gibowig288@bawsny.com', '085771282700'),
(65, 'Muhammad Ariel Ramo', 'padec75359@rustetic.com', '085771282700'),
(66, 'Muhammad Ariel Ramo', 'padec75359@rustetic.com', '085771282700'),
(67, 'Muhammad Ariel Ramo', 'padec75359@rustetic.com', '085771282700'),
(68, 'Muhammad Ariel Ramo', 'fewen46429@rustetic.com', '085771282700'),
(69, 'Muhammad Ariel Ramo', 'fewen46429@rustetic.com', '085771282700'),
(70, 'Muhammad Ariel Ramo', 'likise7284@eoilup.com', '085771282700'),
(71, 'Muhammad Ariel Ramo', 'likise7284@eoilup.com', '085771282700'),
(72, 'Muhammad Ariel Ramo', 'likise7284@eoilup.com', '085771282700'),
(73, 'Muhammad Ariel Ramo', 'darata3676@pokeline.com', '085771282700'),
(74, 'Muhammad Ariel Ramo', 'cajoy83736@bawsny.com', '085771282700'),
(75, 'Muhammad Ariel Ramo', 'cafode5891@rustetic.com', '085771282700'),
(76, 'Aulia', 'keysyaa28@gmail.com', ''),
(77, 'Muhammad Ariel Ramo', 'mipon42214@rustetic.com', '085771282700'),
(78, 'Muhammad Ariel Ramo', 'bevafe5314@datingel.com', '085771282700'),
(79, 'Ramo', 'pogebax195@pokeline.com', '085771282700'),
(80, 'Muhammad Ariel Ramo', 'pixefek334@lofiey.com', '085771282700'),
(81, 'Muhammad Ariel Ramo', 'hiyaxi1852@bawsny.com', '085771282700'),
(82, 'Muhammad Ariel Ramo', 'kotofo4682@iminko.com', '085771282700'),
(83, 'Muhammad Ariel Ramo', 'mevif31808@datingel.com', '085771282700'),
(84, 'Ramo', 'lipag47582@rustetic.com', '085771282700'),
(85, 'Muhammad Ariel Ramo', 'miwac81087@lofiey.com', '085771282700'),
(86, 'Muhammad Ariel Ramo', 'yonahic670@datingel.com', '085771282700'),
(87, 'Muhammad Ariel Ramo', 'faxoka4614@pokeline.com', '085771282700'),
(88, 'Muhammad Ariel Ramo', 'ronof13608@ckuer.com', '085771282700'),
(89, 'Muhammad Ariel Ramo', 'xikef72348@lofiey.com', '085771282700'),
(90, 'Muhammad Ariel Ramo', 'nason37086@pokeline.com', '085771282700'),
(91, 'Muhammad Ariel Ramo', 'lirako6203@ckuer.com', '085771282700'),
(92, 'Muhammad Ariel Ramo', 'arielramo2a005@gmail.com', '085771282700'),
(93, 'Muhammad Ariel Ramo', 'xinag20271@pokeline.com', '085771282700'),
(94, 'Muhammad Ariel Ramo', 'wiyoki9143@bawsny.com', '085771282700'),
(95, 'Muhammad Ariel Ramo', 'hahaw31984@eoilup.com', '085771282700'),
(96, 'Muhammad Ariel Ramo', 'jaton45104@bawsny.com', '085771282700'),
(97, 'Muhammad Ariel Ramo', '005@gmail.com', '085771282700'),
(98, 'Muhammad Ariel Ramo', 'aradawda005@gmail.com', '085771282700'),
(99, 'Muhammad Ariel Ramo', 'cehen70849@datingel.com', '085771282700'),
(100, 'Muhammad Ariel Ramo', 'jonedo2351@iminko.com', '085771282700'),
(101, 'Muhammad Ariel Ramo', 'arielradawawdawdadasdmo2005@gmail.com', '085771282700'),
(102, 'Muhammad Ariel Ramo', 'xicime6598@ckuer.com', '085771282700'),
(103, 'Muhammad Ariel Ramo', 'meses42544@rustetic.com', '085771282700'),
(104, 'Muhammad Ariel Ramo', 'doyepah415@pokeline.com', '085771282700'),
(105, 'Muhammad Ariel Ramo', 'pewoli1932@datingel.com', '085771282700'),
(106, 'Muhammad Ariel Ramo', 'bevor56496@datingel.com', '085771282700'),
(107, 'Muhammad Ariel Ramo', 'wasoho1084@lofiey.com', '085771282700'),
(108, 'Muhammad Ariel Ramo', 'fimato2710@pokeline.com', '085771282700'),
(109, 'Muhammad Ariel Ramo', 'satefiw591@iminko.com', '085771282700'),
(110, 'Muhammad Ariel Ramo', 'xetofa7165@eoilup.com', '085771282700'),
(111, 'Muhammad Ariel Ramo', 'rahobiy119@ckuer.com', '085771282700'),
(112, 'Muhammad Ariel Ramo', 'tifimol199@rustetic.com', '085771282700'),
(113, 'Muhammad Ariel Ramo', 'adad5@gmail.com', '085771282700'),
(114, 'Muhammad Ariel Ramo', 'adeadawdada05@gmail.com', '085771282700'),
(115, 'Muhammad Ariel Ramo', 'arieldawdawdadada005@gmail.com', '085771282700'),
(116, 'Muhammad Ariel Ramo', 'awdadawd05@gmail.com', '085771282700'),
(117, 'Muhammad Ariel Ramo', 'xomay59690@iminko.com', '085771282700'),
(118, 'Muhammad Ariel Ramo', 'arielramo200sdadadadadad5@gmail.com', '085771282700');

-- --------------------------------------------------------

--
-- Struktur dari tabel `events`
--

CREATE TABLE `events` (
  `event_ID` int NOT NULL,
  `title` varchar(100) NOT NULL,
  `event_type_ID` int DEFAULT NULL,
  `venue_ID` int DEFAULT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `description` text,
  `poster` varchar(255) DEFAULT NULL,
  `attendance` int DEFAULT '0',
  `price` decimal(10,2) DEFAULT (0),
  `status_acara` enum('UPCOMING','ON GOING','COMPLETED') NOT NULL,
  `status_aktif` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `events`
--

INSERT INTO `events` (`event_ID`, `title`, `event_type_ID`, `venue_ID`, `start_date`, `end_date`, `description`, `poster`, `attendance`, `price`, `status_acara`, `status_aktif`) VALUES
(1, 'ACARA CONTOH 1', NULL, 1, '2024-11-30 12:00:00', '2024-11-30 15:00:00', 'Misalnya, Anda memiliki tabel bernama events dengan kolom event_name (string) dan event_date (datetime), dan Anda ingin memasukkan data ke dalam tabel tersebut.', NULL, 0, NULL, 'UPCOMING', 1),
(2, 'ACARA CONTOH 2', NULL, 2, '2024-11-30 12:00:00', '2024-11-30 15:00:00', 'Misalnya, Anda memiliki tabel bernama events dengan kolom event_name (string) dan event_date (datetime), dan Anda ingin memasukkan data ke dalam tabel tersebut.', NULL, 0, NULL, 'UPCOMING', 1),
(3, 'ACARA CONTOH 3', NULL, 2, '2024-11-30 00:00:00', '2024-11-30 12:00:00', 'Misalnya, Anda memiliki tabel bernama events dengan kolom event_name (string) dan event_date (datetime), dan Anda ingin memasukkan data ke dalam tabel tersebut.', NULL, 0, 0.00, 'UPCOMING', 1),
(4, 'ini contoh juga', 1, 1, '2024-11-29 12:00:00', '2024-11-20 18:00:00', 'contoh untuk add view', NULL, 0, 0.00, 'UPCOMING', 1),
(5, 'contoh lain', 1, 2, '2024-11-30 00:00:00', '2024-12-01 00:00:00', 'contoh', NULL, 0, 0.00, 'UPCOMING', 1),
(6, 'contoj acara berbayar', 1, 1, '2024-12-15 12:00:00', '2024-12-20 00:00:00', NULL, NULL, 0, 20000.00, 'UPCOMING', 1),
(7, 'judul', 1, 1, '2024-12-03 20:00:00', '2024-12-07 20:00:00', 'ini nyambungin ke database', 'Upcoming', 0, 0.00, 'UPCOMING', 1),
(8, 'dadada', 1, 1, '2024-12-04 11:27:00', '2024-12-04 17:27:00', 'adada', 'poster_1733286481.png', 0, 0.00, 'UPCOMING', 0),
(9, 'ada', 1, 1, '2024-12-05 16:44:00', '2025-01-03 15:44:00', 'd', 'poster_1733370286.jpg', 0, 0.00, 'UPCOMING', 0),
(10, 'ba', 1, 1, '2024-12-06 10:28:00', '2024-12-27 10:28:00', 'dadada', 'poster_1733455753.jpg', 0, 0.00, 'UPCOMING', 0),
(11, 'qq', 1, 1, '2024-12-06 10:46:00', '2024-12-26 10:46:00', 'ee', 'poster_1733456780.jpg', 0, 1.00, 'UPCOMING', 0),
(12, 'qq', 1, 1, '2024-12-06 10:46:00', '2024-12-31 10:46:00', 'ee', 'poster_1733456829.jpg', 0, 0.00, 'UPCOMING', 0),
(13, 'aa', 1, 1, '2024-12-06 10:51:00', '2024-12-31 10:51:00', 'zz', 'poster_1733457095.jpg', 0, 1.00, 'UPCOMING', 0),
(14, 'gratis', 1, 1, '2024-12-07 07:52:00', '2024-12-31 07:52:00', 'aa', NULL, 0, 0.00, 'UPCOMING', 1),
(15, 'aa', 1, 1, '2024-12-07 09:15:00', '2024-12-18 09:15:00', 'adwdas', 'poster_1733537739.jpg', 0, 0.00, 'UPCOMING', 1),
(16, 'test', 1, 1, '2024-12-07 11:40:00', '2025-01-08 11:40:00', 'aaadawda', 'poster_1733546456.jpg', 0, 0.00, 'UPCOMING', 1),
(17, 'aaaaaa', 1, 1, '2024-12-07 12:41:00', '2024-12-18 12:41:00', 'wdadwadwd', 'poster_1733550083.jpg', 0, 10000.00, 'UPCOMING', 1),
(18, 'aaaaaa', 1, 1, '2024-12-07 12:41:00', '2024-12-18 12:41:00', 'wdadwadwd', 'poster_1733550085.jpg', 0, 10000.00, 'UPCOMING', 1),
(19, 'adawdad', 1, 1, '2024-12-07 12:43:00', '2024-12-25 12:43:00', 'adadadadaa', 'poster_1733550203.jpg', 0, 10000.00, 'UPCOMING', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `event_tickets`
--

CREATE TABLE `event_tickets` (
  `ticket_ID` varchar(32) NOT NULL,
  `event_ID` int NOT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `event_ticket_assignment`
--

CREATE TABLE `event_ticket_assignment` (
  `ticket_ID` char(36) NOT NULL DEFAULT (uuid()),
  `order_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `attendee_ID` int DEFAULT NULL,
  `event_ID` int DEFAULT NULL,
  `purchase_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `price` decimal(10,2) DEFAULT NULL,
  `transaction_status` enum('Unpaid','Pending','Paid') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'Unpaid',
  `QR_code` varchar(225) NOT NULL,
  `attendance_status` enum('Hadir','Absen') DEFAULT 'Absen',
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `event_ticket_assignment`
--

INSERT INTO `event_ticket_assignment` (`ticket_ID`, `order_id`, `attendee_ID`, `event_ID`, `purchase_date`, `price`, `transaction_status`, `QR_code`, `attendance_status`, `status`) VALUES
('01d4c2ec-b128-11ef-b00b-a81e848c9657', NULL, NULL, 6, '2024-12-03 10:38:05', 20000.00, 'Unpaid', 'qr_6_.png', 'Absen', 1),
('161fb8eb-b194-11ef-89fb-a81e848c9657', NULL, NULL, 6, '2024-12-03 23:31:45', NULL, 'Unpaid', 'qr_6_.png', 'Absen', 1),
('169e8ab4-b194-11ef-89fb-a81e848c9657', NULL, NULL, 6, '2024-12-03 23:31:46', NULL, 'Unpaid', 'qr_6_.png', 'Absen', 1),
('18614c39-b194-11ef-89fb-a81e848c9657', NULL, NULL, 6, '2024-12-03 23:31:49', NULL, 'Unpaid', 'qr_6_.png', 'Absen', 1),
('2a75967d-b0bc-11ef-b00b-a81e848c9657', NULL, 27, 6, '2024-12-02 21:46:08', 20000.00, 'Unpaid', 'qr_6_27.png', 'Absen', 1),
('3d3d0f33-b2b4-11ef-860f-a81e848c9657', NULL, 41, 6, '2024-12-05 09:54:26', 20000.00, 'Unpaid', 'qr_6_41.png', 'Absen', 1),
('41c5e192-b093-11ef-aa52-a81e848c9657', NULL, 18, 7, '2024-12-02 16:53:18', 0.00, 'Unpaid', 'qr_7_18.png', 'Absen', 1),
('4da05a2e-b093-11ef-aa52-a81e848c9657', NULL, 19, 7, '2024-12-02 16:53:38', 0.00, 'Unpaid', 'qr_7_19.png', 'Absen', 1),
('4e7b1660-b2b4-11ef-860f-a81e848c9657', NULL, 42, 6, '2024-12-05 09:54:55', 20000.00, 'Unpaid', 'qr_6_42.png', 'Absen', 1),
('4efaa4a0-b128-11ef-b00b-a81e848c9657', NULL, NULL, 6, '2024-12-03 10:40:15', 20000.00, 'Unpaid', 'qr_6_.png', 'Absen', 1),
('517ccbe5-b0bc-11ef-b00b-a81e848c9657', NULL, NULL, 6, '2024-12-02 21:47:13', 20000.00, 'Unpaid', 'qr_6_.png', 'Absen', 1),
('60d9138c-aea5-11ef-9a1b-037233a7ae71', NULL, 4, 5, '2024-11-30 05:57:58', 30000.00, 'Unpaid', 'sasdas231', 'Absen', 1),
('64e656c9-b1f1-11ef-ac0d-a81e848c9657', NULL, 16, 6, '2024-12-04 10:39:40', 20000.00, 'Unpaid', 'qr_6_16.png', 'Absen', 1),
('6d58de2f-b1f1-11ef-ac0d-a81e848c9657', NULL, 16, 6, '2024-12-04 10:39:55', 20000.00, 'Unpaid', 'qr_6_16.png', 'Absen', 1),
('76207e24-b1f1-11ef-ac0d-a81e848c9657', NULL, 16, 6, '2024-12-04 10:40:09', 20000.00, 'Unpaid', 'qr_6_16.png', 'Absen', 1),
('768a3e5b-aea2-11ef-9a1b-037233a7ae71', NULL, 13, 1, '2024-11-30 05:37:06', 20000.00, 'Unpaid', 'ini wr', 'Hadir', 1),
('7be221f9-b093-11ef-aa52-a81e848c9657', NULL, 20, 7, '2024-12-02 16:54:55', 0.00, 'Unpaid', 'qr_7_20.png', 'Absen', 1),
('819fc1f9-b1de-11ef-ac0d-a81e848c9657', NULL, NULL, 6, '2024-12-04 08:24:28', NULL, 'Unpaid', 'qr_6_.png', 'Absen', 1),
('9aaa8d61-b1ef-11ef-ac0d-a81e848c9657', NULL, 16, 6, '2024-12-04 10:26:52', 20000.00, 'Unpaid', 'qr_6_16.png', 'Absen', 1),
('a2291293-ae5f-11ef-9a1b-037233a7ae71', NULL, 12, 1, '2024-11-29 21:39:00', 10000.00, 'Unpaid', 'inikekir', 'Absen', 1),
('b0ba976c-b116-11ef-b00b-a81e848c9657', NULL, NULL, 6, '2024-12-03 08:34:08', 20000.00, 'Unpaid', 'qr_6_.png', 'Absen', 1),
('b1bbc642-b1ee-11ef-ac0d-a81e848c9657', NULL, 16, 6, '2024-12-04 10:20:21', 20000.00, 'Unpaid', 'qr_6_16.png', 'Absen', 1),
('bcb01ed4-b0b8-11ef-b00b-a81e848c9657', NULL, NULL, 6, '2024-12-02 21:21:35', 20000.00, 'Unpaid', 'qr_6_.png', 'Absen', 1),
('c5f5a05c-b1ef-11ef-ac0d-a81e848c9657', NULL, NULL, 6, '2024-12-04 10:28:04', 20000.00, 'Unpaid', 'qr_6_.png', 'Absen', 1),
('df682308-b127-11ef-b00b-a81e848c9657', NULL, 16, 6, '2024-12-03 10:37:08', 20000.00, 'Unpaid', 'qr_6_16.png', 'Absen', 1),
('e1f21ca6-b1ef-11ef-ac0d-a81e848c9657', NULL, NULL, 6, '2024-12-04 10:28:51', 20000.00, 'Unpaid', 'qr_6_.png', 'Absen', 1),
('e55234b4-b12d-11ef-b00b-a81e848c9657', NULL, 16, 6, '2024-12-03 11:20:15', 20000.00, 'Unpaid', 'qr_6_16.png', 'Absen', 1),
('e672d0a4-b11b-11ef-b00b-a81e848c9657', NULL, NULL, 6, '2024-12-03 09:11:26', 20000.00, 'Unpaid', 'qr_6_.png', 'Absen', 1),
('e72c69b8-b127-11ef-b00b-a81e848c9657', NULL, 16, 6, '2024-12-03 10:37:21', 20000.00, 'Unpaid', 'qr_6_16.png', 'Absen', 1),
('e893e0ae-b193-11ef-89fb-a81e848c9657', NULL, NULL, NULL, '2024-12-03 23:30:29', NULL, 'Unpaid', 'qr__.png', 'Absen', 1),
('ea457cf7-b193-11ef-89fb-a81e848c9657', NULL, NULL, NULL, '2024-12-03 23:30:32', NULL, 'Unpaid', 'qr__.png', 'Absen', 1),
('f26f5fdf-b11c-11ef-b00b-a81e848c9657', NULL, NULL, 6, '2024-12-03 09:18:55', 20000.00, 'Unpaid', 'qr_6_.png', 'Absen', 1),
('f3832330-b094-11ef-aa52-a81e848c9657', NULL, 21, 6, '2024-12-02 17:05:25', 20000.00, 'Unpaid', 'qr_6_21.png', 'Absen', 1),
('fc153140-b127-11ef-b00b-a81e848c9657', NULL, 16, 6, '2024-12-03 10:37:56', 20000.00, 'Unpaid', 'qr_6_16.png', 'Absen', 1),
('ticket_67567065817368.40358030', NULL, 82, 6, '2024-12-09 04:21:57', 20000.00, 'Unpaid', 'qr_6_82.png', 'Absen', 1),
('ticket_67567176702db4.67870593', NULL, 16, 16, '2024-12-09 04:26:30', NULL, 'Unpaid', 'qr_16_16.png', 'Absen', 1),
('ticket_675671cff089f5.42134823', NULL, 83, 16, '2024-12-09 04:27:59', NULL, 'Unpaid', 'qr_16_83.png', 'Absen', 1),
('ticket_675673fd3c9363.75798204', NULL, 83, 19, '2024-12-09 04:37:17', NULL, 'Unpaid', 'qr_19_83.png', 'Absen', 1),
('ticket_6756bfd22cfc55.33716506', NULL, 84, 19, '2024-12-09 10:00:50', NULL, 'Unpaid', 'qr_19_84.png', 'Absen', 1),
('ticket_6756c348825203.83254072', NULL, 85, 19, '2024-12-09 10:15:36', NULL, 'Unpaid', 'qr_19_85.png', 'Absen', 1),
('ticket_6756c36a77f972.19000062', NULL, 85, 16, '2024-12-09 10:16:10', NULL, 'Paid', 'qr_16_85.png', 'Absen', 1),
('ticket_6756c49d1f4546.55781161', NULL, 86, 16, '2024-12-09 10:21:17', NULL, 'Paid', 'qr_16_86.png', 'Absen', 1),
('ticket_6756c850729547.84127109', 'order_6756c850803c59.98169682', 86, 15, '2024-12-09 10:37:04', NULL, 'Paid', 'qr_15_86.png', 'Absen', 1),
('ticket_6756c8765102f8.23774384', 'order_6756c8765cbc58.32620111', 86, 14, '2024-12-09 10:37:42', NULL, 'Paid', 'qr_14_86.png', 'Absen', 1),
('ticket_67571899ad00c5.53874488', 'order_6757189a96e082.67562086', 27, 14, '2024-12-09 16:19:37', NULL, 'Paid', 'qr_14_27.png', 'Absen', 1),
('ticket_67571e1287c083.97075744', NULL, 87, 6, '2024-12-09 16:42:58', NULL, 'Unpaid', 'qr_6_87.png', 'Absen', 1),
('ticket_67571e2e0adff2.45180803', NULL, 88, 6, '2024-12-09 16:43:26', NULL, 'Unpaid', 'qr_6_88.png', 'Absen', 1),
('ticket_67571ece128370.44590836', NULL, 88, 19, '2024-12-09 16:46:06', NULL, 'Unpaid', 'qr_19_88.png', 'Absen', 1),
('ticket_67572100be7912.76685204', NULL, 89, 19, '2024-12-09 16:55:28', NULL, 'Unpaid', 'qr_19_89.png', 'Absen', 1),
('ticket_6757219fb17d15.00266008', NULL, 90, 19, '2024-12-09 16:58:07', NULL, 'Unpaid', 'qr_19_90.png', 'Absen', 1),
('ticket_6757221cb7a418.06888996', NULL, 91, 19, '2024-12-09 17:00:12', NULL, 'Unpaid', 'qr_19_91.png', 'Absen', 1),
('ticket_6757224599f779.05256096', NULL, 92, 19, '2024-12-09 17:00:53', NULL, 'Unpaid', 'qr_19_92.png', 'Absen', 1),
('ticket_67572731122607.21260752', NULL, 93, 19, '2024-12-09 17:21:53', NULL, 'Unpaid', 'qr_19_93.png', 'Absen', 1),
('ticket_675727d40f4cd1.08820515', NULL, 94, 19, '2024-12-09 17:24:36', NULL, 'Unpaid', 'qr_19_94.png', 'Absen', 1),
('ticket_675728d3908275.92013847', NULL, 95, 19, '2024-12-09 17:28:51', NULL, 'Unpaid', 'qr_19_95.png', 'Absen', 1),
('ticket_675729ae70b015.64733738', NULL, 96, 19, '2024-12-09 17:32:30', NULL, 'Unpaid', 'qr_19_96.png', 'Absen', 1),
('ticket_67572a6283ca03.06899431', NULL, 97, 19, '2024-12-09 17:35:30', NULL, 'Unpaid', 'qr_19_97.png', 'Absen', 1),
('ticket_67572eb91bd852.42860579', NULL, 98, 6, '2024-12-09 17:54:01', NULL, 'Unpaid', 'qr_6_98.png', 'Absen', 1),
('ticket_67572fad1a4297.62604475', NULL, 99, 6, '2024-12-09 17:58:05', NULL, 'Unpaid', 'qr_6_99.png', 'Absen', 1),
('ticket_6757a95917c514.05889781', NULL, 100, 6, '2024-12-10 02:37:13', NULL, 'Unpaid', 'qr_6_100.png', 'Absen', 1),
('ticket_6757aa3be7bf64.67974335', NULL, 101, 6, '2024-12-10 02:40:59', NULL, 'Unpaid', 'qr_6_101.png', 'Absen', 1),
('ticket_6757ab3a4f46d8.01186101', NULL, 102, 6, '2024-12-10 02:45:14', NULL, 'Unpaid', 'qr_6_102.png', 'Absen', 1),
('ticket_6757ad0f65c6e5.87278599', NULL, 103, 6, '2024-12-10 02:53:03', NULL, 'Unpaid', 'qr_6_103.png', 'Absen', 1),
('ticket_6757b28b4134a7.34924092', NULL, 104, 6, '2024-12-10 03:16:27', 20000.00, 'Unpaid', 'qr_6_104.png', 'Absen', 1),
('ticket_6757b6c431df58.33765328', 'order_6757b6c4433454.07929246', 105, 6, '2024-12-10 03:34:28', 20000.00, 'Unpaid', 'qr_6_105.png', 'Absen', 1),
('ticket_6757b74ad5b4b3.90590918', 'order_6757b74aed7b60.71291547', 106, 6, '2024-12-10 03:36:42', 20000.00, 'Unpaid', 'qr_6_106.png', 'Absen', 1),
('ticket_6757b930a83da4.50172275', 'order_6757b930babae4.62890230', 107, 6, '2024-12-10 03:44:48', 20000.00, 'Unpaid', 'qr_6_107.png', 'Absen', 1),
('ticket_6757bc6909cf60.90522192', 'order_6757bc69184867.18839918', 108, 6, '2024-12-10 03:58:33', 20000.00, 'Unpaid', 'qr_6_108.png', 'Absen', 1),
('ticket_6757bda1bbef80.04456732', 'order_6757bda1ca8976.81536962', 109, 6, '2024-12-10 04:03:45', 20000.00, 'Unpaid', 'qr_6_109.png', 'Absen', 1),
('ticket_6757bfadc9bbb2.15999937', 'order_6757bfadd81627.97606129', 110, 6, '2024-12-10 04:12:29', 20000.00, 'Unpaid', 'qr_6_110.png', 'Absen', 1),
('ticket_67586bfeeb3bf8.68792082', 'order_67586bff061df0.05884887', 111, 6, '2024-12-10 16:27:42', 20000.00, 'Paid', 'qr_6_111.png', 'Absen', 1),
('ticket_67586d4d587c17.45583613', 'order_67586d4d6c2018.11679694', 112, 6, '2024-12-10 16:33:17', 20000.00, 'Paid', 'qr_6_112.png', 'Absen', 1),
('ticket_67586e24941c20.06746970', 'order_67586e24a243e3.12274009', 113, 6, '2024-12-10 16:36:52', 20000.00, 'Paid', 'qr_6_113.png', 'Absen', 1),
('ticket_67586e6224ec36.28531072', 'order_67586e6232ac74.44312633', 114, 6, '2024-12-10 16:37:54', 20000.00, 'Paid', 'qr_6_114.png', 'Absen', 1),
('ticket_675871655fcf03.49343797', 'order_675871665f6290.89908897', 115, 6, '2024-12-10 16:50:45', 20000.00, 'Unpaid', 'qr_6_115.png', 'Absen', 1),
('ticket_6758754f1d3388.11638173', 'order_6758754f30e2a6.82151939', 116, 6, '2024-12-10 17:07:27', 20000.00, 'Pending', 'qr_6_116.png', 'Absen', 1),
('ticket_6759441e63d2f2.69647000', 'order_6759441f65dc38.71220733', 117, 6, '2024-12-11 07:49:50', 20000.00, 'Paid', 'qr_6_117.png', 'Absen', 1),
('ticket_675944e785a7d3.67468056', 'order_675944e7a1e401.37755912', 118, 6, '2024-12-11 07:53:11', 20000.00, 'Pending', 'qr_6_118.png', 'Absen', 1),
('TICKET-675121b72e070', NULL, 16, 9, '2024-12-05 03:44:55', 0.00, 'Unpaid', 'assets/uploads/qr_TICKET-675121b72e070.png', 'Absen', 1),
('TICKET-6751268edeca9', NULL, 44, 9, '2024-12-05 04:05:34', 0.00, 'Unpaid', 'qr_9_44.png', 'Absen', 1),
('TICKET-6751282ac2652', NULL, 45, 9, '2024-12-05 04:12:26', 0.00, 'Unpaid', 'uploads/qr_code/', 'Absen', 1),
('TICKET-6751289436293', NULL, 46, 9, '2024-12-05 04:14:12', 0.00, 'Unpaid', 'qr_9_46.png', 'Absen', 1),
('TICKET-67512da40747d', NULL, 47, 9, '2024-12-05 04:35:48', 0.00, 'Unpaid', 'qr_9_47.png', 'Absen', 1),
('TICKET-675270367ef8a', NULL, 48, 10, '2024-12-06 03:32:06', 0.00, 'Unpaid', 'qr_10_48.png', 'Absen', 1),
('TICKET-675273ca2ac02', NULL, 48, 12, '2024-12-06 03:47:22', 0.00, 'Unpaid', 'qr_12_48.png', 'Absen', 1),
('TICKET-6752a03e1acba', NULL, 48, 13, '2024-12-06 06:57:02', NULL, 'Unpaid', 'qr_13_48.png', 'Absen', 1),
('TICKET-6752a2093381a', NULL, 49, 13, '2024-12-06 07:04:41', NULL, 'Unpaid', 'qr_13_49.png', 'Absen', 1),
('TICKET-6752a2464f5f5', NULL, 49, 13, '2024-12-06 07:05:42', NULL, 'Unpaid', 'qr_13_49.png', 'Absen', 1),
('TICKET-6752a2e4dee98', NULL, 49, 13, '2024-12-06 07:08:20', NULL, 'Unpaid', 'qr_13_49.png', 'Absen', 1),
('TICKET-6752a2e5ed269', NULL, 49, 13, '2024-12-06 07:08:21', NULL, 'Unpaid', 'qr_13_49.png', 'Absen', 1),
('TICKET-6752a2e6b99d7', NULL, 49, 13, '2024-12-06 07:08:22', NULL, 'Unpaid', 'qr_13_49.png', 'Absen', 1),
('TICKET-6752a2e7513c2', NULL, 49, 13, '2024-12-06 07:08:23', NULL, 'Unpaid', 'qr_13_49.png', 'Absen', 1),
('TICKET-6752a2e7cb2fc', NULL, 49, 13, '2024-12-06 07:08:23', NULL, 'Unpaid', 'qr_13_49.png', 'Absen', 1),
('TICKET-6752a2e830c33', NULL, 49, 13, '2024-12-06 07:08:24', NULL, 'Unpaid', 'qr_13_49.png', 'Absen', 1),
('TICKET-6752a2e870b1b', NULL, 49, 13, '2024-12-06 07:08:24', NULL, 'Unpaid', 'qr_13_49.png', 'Absen', 1),
('TICKET-6752a2e8d7014', NULL, 49, 13, '2024-12-06 07:08:24', NULL, 'Unpaid', 'qr_13_49.png', 'Absen', 1),
('TICKET-6752a2e93d87b', NULL, 49, 13, '2024-12-06 07:08:25', NULL, 'Unpaid', 'qr_13_49.png', 'Absen', 1),
('TICKET-6752a34246124', NULL, 50, 13, '2024-12-06 07:09:54', NULL, 'Unpaid', 'qr_13_50.png', 'Absen', 1),
('TICKET-6752a761365b2', NULL, 52, 13, '2024-12-06 07:27:29', 1.00, 'Unpaid', 'qr_13_52.png', 'Absen', 1),
('TICKET-6752d5c59a9b4', NULL, 55, 10, '2024-12-06 10:45:25', 0.00, 'Unpaid', 'qr_10_55.png', 'Absen', 1),
('TICKET-6752d7ac9857e', NULL, 56, 10, '2024-12-06 10:53:32', 0.00, 'Unpaid', 'qr_10_56.png', 'Absen', 1),
('TICKET-6753a35837f29', NULL, 57, 6, '2024-12-07 01:22:32', 20000.00, 'Unpaid', 'qr_6_57.png', 'Absen', 1),
('TICKET-6753a3af90fd4', NULL, 58, 14, '2024-12-07 01:23:59', 0.00, 'Unpaid', 'qr_14_58.png', 'Absen', 1),
('TICKET-6753a3e1a3a2c', NULL, 59, 14, '2024-12-07 01:24:49', 0.00, 'Unpaid', 'qr_14_59.png', 'Absen', 1),
('TICKET-6753a41c0c44a', NULL, 60, 6, '2024-12-07 01:25:48', 20000.00, 'Unpaid', 'qr_6_60.png', 'Absen', 1),
('TICKET-6753ad78e1dcc', NULL, 62, 6, '2024-12-07 02:05:44', 20000.00, 'Unpaid', 'qr_6_62.png', 'Absen', 1),
('TICKET-6753ad99a4cc8', NULL, 63, 14, '2024-12-07 02:06:17', 0.00, 'Unpaid', 'qr_14_63.png', 'Absen', 1),
('TICKET-6753aeae7fb25', NULL, 64, 6, '2024-12-07 02:10:54', 20000.00, 'Unpaid', 'qr_6_64.png', 'Absen', 1),
('TICKET-6753af007e3cd', NULL, 65, 6, '2024-12-07 02:12:16', 20000.00, 'Unpaid', 'qr_6_65.png', 'Absen', 1),
('TICKET-6753af3913a58', NULL, 66, 14, '2024-12-07 02:13:13', 0.00, 'Unpaid', 'qr_14_66.png', 'Absen', 1),
('TICKET-6753afd729f49', NULL, 67, 15, '2024-12-07 02:15:51', 0.00, 'Unpaid', 'qr_15_67.png', 'Absen', 1),
('TICKET-6753b74b99deb', NULL, 68, 15, '2024-12-07 02:47:39', 0.00, 'Unpaid', 'qr_15_68.png', 'Absen', 1),
('TICKET-6753b77583c77', NULL, 69, 14, '2024-12-07 02:48:21', 0.00, 'Unpaid', 'qr_14_69.png', 'Absen', 1),
('TICKET-6753b8f20bfb6', NULL, 71, 14, '2024-12-07 02:54:42', 0.00, 'Unpaid', 'qr_14_71.png', 'Absen', 1),
('TICKET-6753b90dbdbe6', NULL, 72, 15, '2024-12-07 02:55:09', 0.00, 'Unpaid', 'qr_15_72.png', 'Absen', 1),
('TICKET-6753ba3a4bb12', NULL, 73, 15, '2024-12-07 03:00:10', 0.00, 'Unpaid', 'qr_15_73.png', 'Absen', 1),
('TICKET-6753bace2918d', NULL, 73, 14, '2024-12-07 03:02:38', 0.00, 'Unpaid', 'qr_14_73.png', 'Absen', 1),
('TICKET-6753df4b98037', NULL, 76, 14, '2024-12-07 05:38:19', 0.00, 'Unpaid', 'qr_14_76.png', 'Absen', 1),
('TICKET-67564debde8cd', NULL, 79, 16, '2024-12-09 01:54:51', 0.00, 'Paid', 'qr_16_79.png', 'Absen', 1),
('TICKET-67565854845b9', NULL, 80, 16, '2024-12-09 02:39:16', 0.00, 'Paid', 'qr_16_80.png', 'Absen', 1);

--
-- Trigger `event_ticket_assignment`
--
DELIMITER $$
CREATE TRIGGER `set_payment_status` BEFORE INSERT ON `event_ticket_assignment` FOR EACH ROW BEGIN
    IF NEW.price = 0 THEN
        SET NEW.payment_status = 'Paid';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `event_type`
--

CREATE TABLE `event_type` (
  `event_type_ID` int NOT NULL,
  `event_type_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `event_type`
--

INSERT INTO `event_type` (`event_type_ID`, `event_type_name`) VALUES
(1, 'Seminar');

-- --------------------------------------------------------

--
-- Struktur dari tabel `venue`
--

CREATE TABLE `venue` (
  `venue_ID` int NOT NULL,
  `name` varchar(60) DEFAULT NULL,
  `capacity` int DEFAULT NULL,
  `addres_line` varchar(60) DEFAULT NULL,
  `city` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `venue`
--

INSERT INTO `venue` (`venue_ID`, `name`, `capacity`, `addres_line`, `city`) VALUES
(1, 'Aula 1', 100, 'Universitas Buana Perjuangan', 'Karawang'),
(2, 'Aula 2', 500, 'Universitas Buana Perjuangan', 'Karawang');

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `vw_attendee_data`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `vw_attendee_data` (
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `vw_events_data`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `vw_events_data` (
`attendance` int
,`description` text
,`end_date` datetime
,`event_ID` int
,`event_type_ID` int
,`event_type_name` varchar(50)
,`poster` varchar(255)
,`price` decimal(10,2)
,`start_date` datetime
,`status_acara` enum('UPCOMING','ON GOING','COMPLETED')
,`status_aktif` tinyint(1)
,`title` varchar(100)
,`venue_ID` int
,`venue_name` varchar(122)
);

-- --------------------------------------------------------

--
-- Struktur untuk view `vw_attendee_data`
--
DROP TABLE IF EXISTS `vw_attendee_data`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_attendee_data`  AS SELECT `attendee`.`attendee_ID` AS `attendee_ID`, `attendee`.`name` AS `name`, `attendee`.`email` AS `email`, `attendee`.`phone` AS `phone`, `events`.`title` AS `nama_acara`, `events`.`event_ID` AS `ID_acara`, `event_ticket_assignment`.`QR_code` AS `QR_code`, `event_ticket_assignment`.`attendance_status` AS `attendance_status`, `event_ticket_assignment`.`snap_token` AS `snap_token` FROM ((`event_ticket_assignment` join `events` on((`event_ticket_assignment`.`event_ID` = `events`.`event_ID`))) join `attendee` on((`event_ticket_assignment`.`attendee_ID` = `attendee`.`attendee_ID`))) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `vw_events_data`
--
DROP TABLE IF EXISTS `vw_events_data`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_events_data`  AS SELECT `events`.`event_ID` AS `event_ID`, `events`.`title` AS `title`, `events`.`event_type_ID` AS `event_type_ID`, `events`.`venue_ID` AS `venue_ID`, `events`.`start_date` AS `start_date`, `events`.`end_date` AS `end_date`, `events`.`description` AS `description`, `events`.`poster` AS `poster`, `events`.`attendance` AS `attendance`, `events`.`price` AS `price`, `events`.`status_acara` AS `status_acara`, `events`.`status_aktif` AS `status_aktif`, `event_type`.`event_type_name` AS `event_type_name`, concat(`venue`.`name`,', ',`venue`.`addres_line`) AS `venue_name` FROM ((`events` join `event_type` on((`events`.`event_type_ID` = `event_type`.`event_type_ID`))) join `venue` on((`events`.`venue_ID` = `venue`.`venue_ID`))) ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_ID`);

--
-- Indeks untuk tabel `attendee`
--
ALTER TABLE `attendee`
  ADD PRIMARY KEY (`attendee_ID`);

--
-- Indeks untuk tabel `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_ID`),
  ADD KEY `event_type_ID` (`event_type_ID`),
  ADD KEY `venue_ID` (`venue_ID`);

--
-- Indeks untuk tabel `event_tickets`
--
ALTER TABLE `event_tickets`
  ADD PRIMARY KEY (`ticket_ID`);

--
-- Indeks untuk tabel `event_ticket_assignment`
--
ALTER TABLE `event_ticket_assignment`
  ADD PRIMARY KEY (`ticket_ID`),
  ADD UNIQUE KEY `order_id` (`order_id`),
  ADD KEY `event_ID` (`event_ID`),
  ADD KEY `attendee_ID` (`attendee_ID`);

--
-- Indeks untuk tabel `event_type`
--
ALTER TABLE `event_type`
  ADD PRIMARY KEY (`event_type_ID`);

--
-- Indeks untuk tabel `venue`
--
ALTER TABLE `venue`
  ADD PRIMARY KEY (`venue_ID`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `attendee`
--
ALTER TABLE `attendee`
  MODIFY `attendee_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT untuk tabel `events`
--
ALTER TABLE `events`
  MODIFY `event_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `event_type`
--
ALTER TABLE `event_type`
  MODIFY `event_type_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `venue`
--
ALTER TABLE `venue`
  MODIFY `venue_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`event_type_ID`) REFERENCES `event_type` (`event_type_ID`),
  ADD CONSTRAINT `events_ibfk_2` FOREIGN KEY (`venue_ID`) REFERENCES `venue` (`venue_ID`);

--
-- Ketidakleluasaan untuk tabel `event_ticket_assignment`
--
ALTER TABLE `event_ticket_assignment`
  ADD CONSTRAINT `event_ticket_assignment_ibfk_1` FOREIGN KEY (`event_ID`) REFERENCES `events` (`event_ID`),
  ADD CONSTRAINT `event_ticket_assignment_ibfk_2` FOREIGN KEY (`attendee_ID`) REFERENCES `attendee` (`attendee_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
