-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 25 Des 2024 pada 02.02
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
(118, 'Muhammad Ariel Ramo', 'arielramo200sdadadadadad5@gmail.com', '085771282700'),
(119, 'Muhammad Ariel Ramo', 'kotsofo4682@iminko.com', '085771282700'),
(120, 'Muhammad Ariel Ramo', 'hacelin400@eoilup.com', '085771282700'),
(121, 'Muhammad Ariel Ramo', 'hipopo6736@iminko.com', '085771282700'),
(122, 'Muhammad Ariel Ramo', 'pojoxoh719@pokeline.com', '085771282700'),
(123, 'Muhammad Ariel Ramo', 'ada5@gmail.com', '085771282700'),
(124, 'Muhammad Ariel Ramo', 'adw5@gmail.com', '085771282700'),
(125, 'Muhammad Ariel Ramo', 'ada@gmail.com', '085771282700'),
(126, 'Muhammad Ariel Ramo', 'fakib56308@pokeline.com', '085771282700'),
(127, 'Muhammad Ariel Ramo', 'pifoced914@iminko.com', '085771282700'),
(128, 'Muhammad Ariel Ramo', 'fabod87265@rustetic.com', '085771282700'),
(129, 'Muhammad Ariel Ramo', 'lifes76953@ckuer.com', '085771282700'),
(130, 'Muhammad Ariel Ramo', 'hadexal725@datingel.com', '085771282700'),
(131, 'Muhammad Ariel Ramo', 'riwov43668@lofiey.com', '085771282700'),
(132, 'Muhammad Ariel Ramo', 'wemex43182@bawsny.com', '085771282700'),
(133, 'Muhammad Ariel Ramo', 'xahel23230@eoilup.com', '085771282700'),
(134, 'Muhammad Ariel Ramo', 'woyak39382@datingel.com', '085771282700'),
(135, 'Muhammad Ariel Ramo', 'adw@dadad', '085771282700'),
(136, 'Muhammad Ariel Ramo', 'arielramo20adadad5@gmail.com', '085771282700'),
(137, 'Muhammad Ariel Ramo', 'sowisod410@ckuer.com', '085771282700'),
(138, 'Muhammad Ariel Ramo', 'nipidiv690@iminko.com', '085771282700'),
(139, 'Muhammad Ariel Ramo', 'kafop72865@pokeline.com', '085771282700'),
(140, 'Muhammad Ariel Ramo', 'mapiheb948@iminko.com', '085771282700'),
(141, 'Muhammad Ariel Ramo', 'pevih50129@eoilup.com', '085771282700'),
(142, 'Muhammad Ariel Ramo', 'vevoh12091@pokeline.com', '085771282700'),
(143, 'Muhammad Ariel Ramo', 'rocogox952@bawsny.com', '085771282700'),
(144, 'Muhammad Ariel Ramo', 'dijoj43149@ckuer.com', '085771282700'),
(145, 'Muhammad Ariel Ramo', 'helosa9760@bawsny.com', '085771282700'),
(1151, 'Muhammad Ariel Ramo', 'nitobel303@cctoolz.com', '085771282700'),
(1152, 'Muhammad Ariel Ramo', 'dofim58548@kelenson.com', '085771282700'),
(1153, 'Muhammad Ariel Ramo', 'vobom64595@kelenson.com', '085771282700'),
(1154, 'Muhammad Ariel Ramo', 'voxefom649@cctoolz.com', '085771282700'),
(1155, 'Muhammad Ariel Ramo', 'mixamo6571@cctoolz.com', '085771282700'),
(1156, 'Muhammad Ariel Ramo', 'lomit55417@chosenx.com', '085771282700'),
(1157, 'Muhammad Ariel Ramo', 'nayik30332@mowline.com', '085771282700'),
(1158, 'Muhammad Ariel Ramo', 'vagoyi4396@mowline.com', '085771282700'),
(1159, 'Muhammad Ariel Ramo', 'xihaw65053@rabitex.com', '085771282700'),
(1160, 'Muhammad Ariel Ramo', 'cajov43053@cctoolz.com', '085771282700'),
(1161, 'Muhammad Ariel Ramo', 'pifol57796@ronete.com', '085771282700'),
(1162, 'Muhammad Ariel Ramo', 'kowade7153@ronete.com', '085771282700'),
(1163, 'Muhammad Ariel Ramo', 'felav66974@rabitex.com', '085771282700'),
(1164, 'Muhammad Ariel Ramo', 'gonopev597@rabitex.com', '085771282700'),
(1165, 'Muhammad Ariel Ramo', 'kelesa9067@kelenson.com', '085771282700'),
(1166, 'Muhammad Ariel Ramo', 'vayap69348@kelenson.com', '085771282700'),
(1167, 'Muhammad Ariel Ramo', 'pawis91673@ronete.com', '085771282700'),
(1168, 'Muhammad Ariel Ramo', 'kepoxom165@kelenson.com', '085771282700'),
(1169, 'Muhammad Ariel Ramo', 'sokgoi@tempmailto.org', '085771282700'),
(1170, 'Muhammad Ariel Ramo', 'tarlaf@tempmailto.org', '085771282700'),
(1171, 'Muhammad Ariel Ramo', 'rabavik697@ronete.com', '085771282700'),
(1172, 'Muhammad Ariel Ramo', 'vocigir378@mowline.com', '085771282700'),
(1173, 'Muhammad Ariel Ramo', 'kegayit627@ronete.com', '085771282700'),
(1174, 'Muhammad Ariel Ramo', 'gegat95020@mowline.com', '085771282700'),
(1175, 'Muhammad Ariel Ramo', 'notolo7982@owube.com', '085771282700'),
(1176, 'Muhammad Ariel Ramo', 'poroxak158@owube.com', '085771282700'),
(1177, 'Muhammad Ariel Ramo', 'arietimate@gmail.com', '085771282700'),
(1178, 'Muhammad Ariel Ramo', 'ramocr25@gmail.com', '085771282700'),
(1179, 'Muhammad Ariel Ramo', 'if23.muhammadramo@mhs.ubpkarawang.ac.id', '085771282700'),
(1180, 'Muhammad Ariel Ramo', 'libisof301@owube.com', '085771282700'),
(1181, 'Muhammad Ariel Ramo', 'noseg64657@rabitex.com', '085771282700'),
(1182, 'Muhammad Ariel Ramo', 'gofagal772@rabitex.com', '085771282700'),
(1183, 'Muhammad Ariel Ramo', 'bokaga5494@mowline.com', '085771282700');

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
(7, 'judul', 1, 1, '2024-12-03 20:00:00', '2024-12-07 20:00:00', 'ini nyambungin ke database', 'Upcoming', 0, 0.00, 'UPCOMING', 0),
(8, 'dadada', 1, 1, '2024-12-04 11:27:00', '2024-12-04 17:27:00', 'adada', 'poster_1733286481.png', 0, 0.00, 'UPCOMING', 0),
(9, 'ada', 1, 1, '2024-12-05 16:44:00', '2025-01-03 15:44:00', 'd', 'poster_1733370286.jpg', 0, 0.00, 'UPCOMING', 0),
(10, 'ba', 1, 1, '2024-12-06 10:28:00', '2024-12-27 10:28:00', 'dadada', 'poster_1733455753.jpg', 0, 0.00, 'UPCOMING', 0),
(11, 'qq', 1, 1, '2024-12-06 10:46:00', '2024-12-26 10:46:00', 'ee', 'poster_1733456780.jpg', 0, 1.00, 'UPCOMING', 0),
(12, 'qq', 1, 1, '2024-12-06 10:46:00', '2024-12-31 10:46:00', 'ee', 'poster_1733456829.jpg', 0, 0.00, 'UPCOMING', 0),
(13, 'aa', 1, 1, '2024-12-06 10:51:00', '2024-12-31 10:51:00', 'zz', 'poster_1733457095.jpg', 0, 1.00, 'UPCOMING', 0),
(14, 'gratis', 1, 1, '2024-12-07 07:52:00', '2024-12-31 07:52:00', 'aa', NULL, 0, 0.00, 'UPCOMING', 0),
(15, 'aa', 1, 1, '2024-12-07 09:15:00', '2024-12-18 09:15:00', 'adwdas', 'poster_1733537739.jpg', 0, 0.00, 'UPCOMING', 0),
(16, 'test', 1, 1, '2024-12-07 11:40:00', '2025-01-08 11:40:00', 'aaadawda', 'poster_1733546456.jpg', 0, 0.00, 'UPCOMING', 0),
(17, 'aaaaaa', 1, 1, '2024-12-07 12:41:00', '2024-12-18 12:41:00', 'wdadwadwd', 'poster_1733550083.jpg', 0, 10000.00, 'UPCOMING', 0),
(18, 'aaaaaa', 1, 1, '2024-12-07 12:41:00', '2024-12-18 12:41:00', 'wdadwadwd', 'poster_1733550085.jpg', 0, 10000.00, 'UPCOMING', 0),
(19, 'adawdad', 1, 1, '2024-12-07 12:43:00', '2024-12-25 12:43:00', 'adadadadaa', 'poster_1733550203.jpg', 0, 10000.00, 'UPCOMING', 0),
(20, 'bayar', 1, 1, '2024-12-17 23:13:00', '2024-12-17 23:13:00', 'a', NULL, 0, 10000.00, 'UPCOMING', 1),
(21, 'gratis', 1, 1, '2024-12-27 23:13:00', '2025-01-11 23:13:00', 'a', NULL, 0, 0.00, 'UPCOMING', 1),
(22, 'aaaaaaaaaaaaaaaaaaaaaaaaaaa', 1, 1, '2024-12-21 16:03:00', '2024-12-02 16:03:00', 'adad', NULL, 0, 10000.00, 'UPCOMING', 1),
(23, 'ADAFOTO', 1, 1, '2024-12-21 16:16:00', '2025-01-04 16:16:00', 'desc', NULL, 0, 10000.00, 'UPCOMING', 1),
(24, 'dafoto', 1, 1, '2024-12-21 16:18:00', '2025-01-02 16:18:00', 'adawdadadadada', 'poster_1734772751.jpg', 0, 10000.00, 'UPCOMING', 1),
(25, 'gratis 2', 1, 1, '2024-12-23 20:59:00', '2024-12-31 20:54:00', 'desc', 'poster_1734962079.jpg', 0, 0.00, 'UPCOMING', 1),
(26, 'bayar 2', 1, 1, '2024-12-30 20:54:00', '2025-01-09 20:54:00', 'desc', 'poster_1734962111.jpeg', 0, 10000.00, 'UPCOMING', 1),
(27, 'acara1', 1, 1, '2024-12-24 15:04:00', '2024-12-26 15:07:00', 'desc', NULL, 0, 0.00, 'UPCOMING', 1),
(28, 'acara2', 1, 1, '2024-12-24 15:09:00', '2025-01-10 15:09:00', 'dse', NULL, 0, 0.00, 'UPCOMING', 1),
(29, 'acara 3', 1, 1, '2024-12-24 15:09:00', '2025-01-08 15:09:00', 'desc', NULL, 0, 0.00, 'UPCOMING', 1),
(30, 'acara 4', 1, 1, '2024-12-24 15:10:00', '2024-12-27 15:10:00', 'desc', NULL, 0, 0.00, 'UPCOMING', 1),
(31, 'acara 5', 1, 1, '2025-01-03 15:10:00', '2025-03-07 15:10:00', 'desc', NULL, 0, 0.00, 'UPCOMING', 1),
(32, 'acara 6', 1, 1, '2025-01-02 15:10:00', '2025-01-17 15:10:00', 'dsesd', NULL, 0, 0.00, 'UPCOMING', 1),
(33, 'acara 7', 1, 1, '2024-12-24 15:11:00', '2025-01-10 15:11:00', 'dsessssssssss', NULL, 0, 0.00, 'UPCOMING', 1),
(34, 'acara 8', 1, 1, '2025-01-08 15:12:00', '2025-01-31 15:12:00', 'ddesc', 'poster_1735027958.jpg', 0, 0.00, 'UPCOMING', 1),
(35, 'acara 9', 1, 1, '2024-12-24 19:12:00', '2025-02-01 15:12:00', 'desc', NULL, 0, 0.00, 'UPCOMING', 1),
(36, 'acara 10', 1, 1, '2024-12-24 15:13:00', '2025-02-07 15:13:00', 'desc', NULL, 0, 0.00, 'UPCOMING', 1),
(37, 'acara telat', 1, 1, '2024-12-24 15:21:00', '2024-12-24 15:22:00', 'udah telat', 'poster_1735028499.jpg', 0, 0.00, 'UPCOMING', 1),
(38, 'bayar2', 1, 1, '2024-12-24 16:12:00', '2025-01-10 16:12:00', 'desc', 'poster_1735031544.png', 0, 100000.00, 'UPCOMING', 1);

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
  `transaction_status` enum('Pending','Success') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'Success',
  `QR_code` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `attendance_status` enum('Hadir','Absen') DEFAULT 'Absen',
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `event_ticket_assignment`
--

INSERT INTO `event_ticket_assignment` (`ticket_ID`, `order_id`, `attendee_ID`, `event_ID`, `purchase_date`, `price`, `transaction_status`, `QR_code`, `attendance_status`, `status`) VALUES
('f7015b14-c1d2-11ef-b38c-a81e848c9657', 'ORD001', 100, 20, '2024-12-24 15:42:10', 100.00, 'Success', 'QR001', 'Hadir', 1),
('f7024e88-c1d2-11ef-b38c-a81e848c9657', 'ORD002', 101, 20, '2024-12-24 15:42:10', 150.00, 'Pending', 'QR002', 'Absen', 1),
('f702534e-c1d2-11ef-b38c-a81e848c9657', 'ORD003', 102, 20, '2024-12-24 15:42:10', 120.00, 'Success', 'QR003', 'Hadir', 1),
('f70255cd-c1d2-11ef-b38c-a81e848c9657', 'ORD004', 103, 20, '2024-12-24 15:42:10', 200.00, 'Success', 'QR004', 'Absen', 1),
('f7025e53-c1d2-11ef-b38c-a81e848c9657', 'ORD005', 104, 20, '2024-12-24 15:42:10', 180.00, 'Pending', 'QR005', 'Hadir', 1),
('f702612d-c1d2-11ef-b38c-a81e848c9657', 'ORD006', 105, 20, '2024-12-24 15:42:10', 90.00, 'Success', 'QR006', 'Absen', 1),
('f702634e-c1d2-11ef-b38c-a81e848c9657', 'ORD007', 106, 20, '2024-12-24 15:42:10', 110.00, 'Pending', 'QR007', 'Hadir', 1),
('f702679a-c1d2-11ef-b38c-a81e848c9657', 'ORD008', 107, 20, '2024-12-24 15:42:10', 140.00, 'Success', 'QR008', 'Absen', 1),
('f7026a94-c1d2-11ef-b38c-a81e848c9657', 'ORD009', 108, 20, '2024-12-24 15:42:10', 160.00, 'Success', 'QR009', 'Hadir', 1),
('f7026cce-c1d2-11ef-b38c-a81e848c9657', 'ORD010', 109, 20, '2024-12-24 15:42:10', 130.00, 'Pending', 'QR010', 'Absen', 1),
('ticket_6761a33f4929b7.88422507', 'order_6761a33f492a77.21767990', 16, 21, '2024-12-17 16:13:51', 0.00, 'Success', 'qr_21_16.png', 'Absen', 1),
('ticket_6761a48f17fa33.27977873', 'order_6761a48f17fac2.51994953', 16, 20, '2024-12-17 23:19:41', 10000.00, 'Pending', 'null', 'Absen', 1),
('ticket_6761a51f2e0972.26716254', 'order_6761a51f2e0a07.12752344', 1151, 20, '2024-12-17 23:21:54', 10000.00, 'Pending', NULL, 'Absen', 1),
('ticket_6761ab16c2af88.90762781', 'order_6761ab16c2b022.73281503', 1152, 20, '2024-12-17 23:47:33', 10000.00, 'Success', 'qr_20_.png', 'Absen', 1),
('ticket_6761ac11e0bb45.23822811', 'order_6761ac11e0bc29.43058057', 1153, 21, '2024-12-17 16:51:29', 0.00, 'Success', 'qr_21_1153.png', 'Absen', 1),
('ticket_6761ac1ccc5fc0.68917044', 'order_6761ac1ccc6085.70044996', 1153, 20, '2024-12-17 23:51:43', 10000.00, 'Success', 'qr_20_.png', 'Absen', 1),
('ticket_676251c5acb446.37491077', 'order_676251c5acb5b3.26612206', 1160, 20, '2024-12-18 11:42:57', 10000.00, 'Pending', NULL, 'Absen', 1),
('ticket_676251eb4af062.69050942', 'order_676251eb4af163.08693228', 1160, 21, '2024-12-18 04:39:07', 0.00, 'Success', 'qr_21_1160.png', 'Absen', 1),
('ticket_67625333b94c90.85538748', 'order_67625333b94d77.30103271', 1161, 20, '2024-12-18 11:44:51', 10000.00, 'Success', 'qr_20_.png', 'Absen', 1),
('ticket_6762da5954d9d1.92807875', 'order_6762da5954da95.94469201', 1162, 21, '2024-12-18 14:21:13', 0.00, 'Success', 'qr_21_1162.png', 'Absen', 1),
('ticket_6762dfeaac3396.08146752', 'order_6762dfeaac3462.06501908', 1163, 20, '2024-12-18 21:45:06', 10000.00, 'Success', 'qr_20_.png', 'Absen', 1),
('ticket_6762e7a1e73ba1.14872633', 'order_6762e7a1e73c75.40856501', 1165, 6, '2024-12-18 22:17:57', 20000.00, 'Success', 'qr_6_.png', 'Absen', 1),
('ticket_6762ec149b4004.64172367', 'order_6762ec149b4114.20707983', 1166, 21, '2024-12-18 15:36:52', 0.00, 'Success', 'qr_21_1166.png', 'Absen', 1),
('ticket_676381680329b0.07489652', 'order_67638168032a74.01683189', 1169, 21, '2024-12-19 02:14:00', 0.00, 'Success', 'qr_21_1169.png', 'Absen', 1),
('ticket_676381edb52db7.81523041', 'order_676381edb52eb6.86687495', 1169, 20, '2024-12-19 09:16:20', 10000.00, 'Pending', NULL, 'Absen', 1),
('ticket_6763906f20bb12.92541211', 'order_6763906f20be54.92430207', 1170, 6, '2024-12-19 10:18:10', 20000.00, 'Success', 'qr_6_.png', 'Absen', 1),
('ticket_676392ed130e88.97864650', 'order_676392ed131005.77741236', 1171, 6, '2024-12-19 10:28:49', 20000.00, 'Success', 'qr_6_.png', 'Absen', 1),
('ticket_676395f74aaff7.74125059', 'order_676395f74ab0f2.17325511', 1172, 6, '2024-12-19 10:41:46', 20000.00, 'Success', 'qr_6_.png', 'Absen', 1),
('ticket_67639824c0d252.97229006', 'order_67639824c0d323.53553367', 1173, 6, '2024-12-19 10:51:03', 20000.00, 'Success', 'qr_6_.png', 'Absen', 1),
('ticket_6763997e4fd0f5.94925187', 'order_6763997e4fd244.06686310', 1174, 6, '2024-12-19 10:56:50', 20000.00, 'Success', 'qr_6_.png', 'Absen', 1),
('ticket_67639f45360e31.57151933', 'order_67639f45360fb2.48274379', 1176, 6, '2024-12-19 11:21:27', 20000.00, 'Success', 'qr_6_.png', 'Absen', 1),
('ticket_676624b0439419.40877192', 'order_676624b0439512.00365293', 1178, 20, '2024-12-21 09:15:15', 10000.00, 'Pending', NULL, 'Absen', 1),
('ticket_676626145eb0c6.67253737', 'order_676626145eb179.44520014', 1179, 20, '2024-12-21 09:21:10', 10000.00, 'Success', 'qr_20_.png', 'Absen', 1),
('ticket_6766346b49f906.94877221', 'order_6766346b49f9f4.68664750', 1177, 6, '2024-12-21 10:22:23', 20000.00, 'Success', 'qr_6_.png', 'Absen', 1),
('ticket_67663794c8feb6.34925341', 'order_67663794c90013.63276458', 1177, 17, '2024-12-21 10:35:55', 10000.00, 'Pending', NULL, 'Absen', 1),
('ticket_67663a3e005b49.01428389', 'order_67663a3e005d26.18847642', 16, 17, '2024-12-21 10:47:28', 10000.00, 'Pending', NULL, 'Absen', 1),
('ticket_6766489dddcc27.34454912', 'order_6766489dddcce4.90832017', 1178, 17, '2024-12-21 11:48:33', 10000.00, 'Pending', NULL, 'Absen', 1),
('ticket_67667d056051c4.08239279', 'order_67667d056054b5.96499633', 16, 4, '2024-12-21 08:32:05', 0.00, 'Success', 'qr_4_16.png', 'Absen', 1),
('ticket_67667ebed4a294.10275301', 'order_67667ebed4a3c0.12053418', 16, 4, '2024-12-21 08:39:26', 0.00, 'Success', 'qr_4_16.png', 'Absen', 1),
('ticket_67667f47508041.56774018', 'order_67667f47508115.79148252', 16, 20, '2024-12-21 15:41:55', 10000.00, 'Success', 'qr_20_.png', 'Absen', 1),
('ticket_67668b962b8d58.73661185', 'order_67668b962b8e22.32064778', 16, 24, '2024-12-21 16:34:17', 10000.00, 'Success', 'qr_24_.png', 'Absen', 1),
('ticket_67668c0bb7e4d9.86503405', 'order_67668c0bb7e562.10988921', 16, 22, '2024-12-21 16:36:14', 10000.00, 'Success', 'qr_22_.png', 'Absen', 1),
('ticket_676960e4201023.63897288', 'order_676960e4201132.21386037', 1182, 20, '2024-12-23 20:08:58', 10000.00, 'Success', 'qr_20_.png', 'Absen', 1),
('ticket_676961b9d5ad49.52510684', 'order_676961b9d5ae83.85103774', 1182, 20, '2024-12-23 20:12:33', 10000.00, 'Success', 'qr_20_.png', 'Absen', 1),
('ticket_67696203b87796.60048388', 'order_67696203b87896.00079701', 1182, 20, '2024-12-23 20:13:44', 10000.00, 'Success', 'qr_20_.png', 'Absen', 1),
('ticket_67696412eef045.02467372', 'order_67696412eef3e5.28565102', 1182, 20, '2024-12-23 20:22:32', 10000.00, 'Success', 'qr_20_.png', 'Absen', 1),
('ticket_6769675599cce3.13754813', 'order_6769675599cdf9.45432591', 1182, 20, '2024-12-23 20:36:26', 10000.00, 'Pending', NULL, 'Absen', 1),
('ticket_676967872b23e3.05266846', 'order_676967872b2495.88105725', 1183, 20, '2024-12-23 20:37:14', 10000.00, 'Success', 'qr_20_.png', 'Absen', 1),
('ticket_676967e498c642.17358240', 'order_676967e498c6d5.97569262', 1183, 20, '2024-12-23 20:38:48', 10000.00, 'Success', 'qr_20_.png', 'Absen', 1),
('ticket_67696a2ddc6d16.07084866', 'order_67696a2ddc6e25.84818813', 1183, 20, '2024-12-23 20:48:33', 10000.00, 'Success', 'qr_20_.png', 'Absen', 1),
('ticket_67696c06a07990.63747979', 'order_67696c06a07a44.04917623', 16, 25, '2024-12-23 13:56:22', 0.00, 'Success', 'qr_25_16.png', 'Absen', 1),
('ticket_67696e79ac89c6.86904234', 'order_67696e79ac8a59.44663910', 1177, 25, '2024-12-23 14:06:49', 0.00, 'Success', 'qr_25_1177.png', 'Absen', 1),
('ticket_67696eb966c7b8.54394920', 'order_67696eb966c860.26321619', 1177, 26, '2024-12-23 21:07:57', 10000.00, 'Success', 'qr_26_1177.png', 'Absen', 1),
('ticket_676a700f1d66b8.96919998', 'order_676a700f1d6919.29044159', 16, 27, '2024-12-24 08:25:51', 0.00, 'Success', 'qr_27_16.png', 'Absen', 1),
('ticket_676a7182743042.69802651', 'order_676a7182743645.29671990', 16, 28, '2024-12-24 08:32:02', 0.00, 'Success', 'qr_28_16.png', 'Absen', 1),
('ticket_676a71c6cf0d70.75798948', 'order_676a71c6cf0f74.39255401', 16, 29, '2024-12-24 08:33:10', 0.00, 'Success', 'qr_29_16.png', 'Absen', 1),
('ticket_676a7b0e432f16.02024243', 'order_676a7b0e4331b4.86260198', 16, 38, '2024-12-24 16:12:51', 100000.00, 'Success', 'qr_38_16.png', 'Hadir', 1);

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
`attendance_status` enum('Hadir','Absen')
,`attendee_ID` int
,`email` varchar(50)
,`event_ID` int
,`name` varchar(100)
,`phone` varchar(25)
,`QR_code` varchar(225)
,`transaction_status` enum('Pending','Success')
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

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_attendee_data`  AS SELECT `a`.`attendee_ID` AS `attendee_ID`, `a`.`name` AS `name`, `a`.`email` AS `email`, `a`.`phone` AS `phone`, `event_ticket_assignment`.`event_ID` AS `event_ID`, `event_ticket_assignment`.`QR_code` AS `QR_code`, `event_ticket_assignment`.`attendance_status` AS `attendance_status`, `event_ticket_assignment`.`transaction_status` AS `transaction_status` FROM (`attendee` `a` join `event_ticket_assignment` on((`a`.`attendee_ID` = `event_ticket_assignment`.`attendee_ID`))) ;

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
  MODIFY `attendee_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1184;

--
-- AUTO_INCREMENT untuk tabel `events`
--
ALTER TABLE `events`
  MODIFY `event_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

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
