-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 03, 2024 at 11:13 PM
-- Server version: 8.0.40
-- PHP Version: 8.3.13

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
-- Table structure for table `admins`
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
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_ID`, `admin_role`, `name`, `phone`, `username`, `password`) VALUES
(1, 'panitia', 'Keysya', '09090', 'admin key', '$2a$12$Gw6n/tvW5dnp0Vk2myTNRuEUnIvMzXF/6m.AKXri7CfibhWlor4T6');

-- --------------------------------------------------------

--
-- Table structure for table `attendee`
--

CREATE TABLE `attendee` (
  `attendee_ID` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `attendee`
--

INSERT INTO `attendee` (`attendee_ID`, `name`, `email`, `phone`) VALUES
(33, 'Aulia', 'littlefoxxy323+10@gmail.com', '000'),
(34, 'Aulia', 'littlefoxxy323@gmail.com', ''),
(35, 'Aulia', 'littlefoxxy323+9@gmail.com', ''),
(38, 'tsukasa', 'keysyaa28@gmail.com', '');

-- --------------------------------------------------------

--
-- Table structure for table `events`
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
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_ID`, `title`, `event_type_ID`, `venue_ID`, `start_date`, `end_date`, `description`, `poster`, `attendance`, `price`, `status_acara`, `status_aktif`) VALUES
(1, 'ACARA CONTOH 1', NULL, 1, '2024-11-30 12:00:00', '2024-11-30 15:00:00', 'Misalnya, Anda memiliki tabel bernama events dengan kolom event_name (string) dan event_date (datetime), dan Anda ingin memasukkan data ke dalam tabel tersebut.', NULL, 0, NULL, 'UPCOMING', 1),
(2, 'ACARA CONTOH 2', NULL, 2, '2024-11-30 12:00:00', '2024-11-30 15:00:00', 'Misalnya, Anda memiliki tabel bernama events dengan kolom event_name (string) dan event_date (datetime), dan Anda ingin memasukkan data ke dalam tabel tersebut.', NULL, 0, NULL, 'UPCOMING', 1),
(3, 'ACARA CONTOH 3', NULL, 2, '2024-11-30 00:00:00', '2024-11-30 12:00:00', 'Misalnya, Anda memiliki tabel bernama events dengan kolom event_name (string) dan event_date (datetime), dan Anda ingin memasukkan data ke dalam tabel tersebut.', NULL, 0, '0.00', 'UPCOMING', 1),
(4, 'ini contoh juga', 1, 1, '2024-11-29 12:00:00', '2024-11-20 18:00:00', 'contoh untuk add view', NULL, 0, '0.00', 'UPCOMING', 0),
(5, 'contoh lain', 1, 2, '2024-11-30 00:00:00', '2024-12-01 00:00:00', 'contoh', NULL, 0, '0.00', 'UPCOMING', 0),
(6, 'contoj acara berbayar', 1, 1, '2024-12-15 12:00:00', '2024-12-20 00:00:00', NULL, NULL, 0, '20000.00', 'UPCOMING', 0),
(7, 'judul', 1, 1, '2024-12-03 20:00:00', '2024-12-07 20:00:00', 'ini nyambungin ke database', 'Upcoming', 0, '0.00', 'UPCOMING', 0),
(8, 'contoh poster', 1, 1, '2024-12-05 20:59:00', '2024-12-07 20:59:00', 'ini contoh untuk tes upload poster', 'Upcoming', 0, '0.00', 'UPCOMING', 0),
(9, 'contoh poster', 1, 1, '2024-12-05 20:59:00', '2024-12-07 20:59:00', 'ini contoh untuk tes upload poster', 'poster_1732976109.jpg', 0, '20000.00', 'UPCOMING', 0),
(10, 'contoh poster', 1, 1, '2024-12-05 20:59:00', '2024-12-07 20:59:00', 'ini contoh untuk tes upload poster', 'poster_1732976168.jpg', 0, '20000.00', 'UPCOMING', 0),
(11, 'contoh', 1, 1, '2024-12-19 14:40:00', '2024-12-21 14:40:00', 'fssssssssssssssssds', 'poster_1733125245.jpg', 0, '0.00', 'UPCOMING', 0),
(12, 'Seminat Contoh 1', 1, 1, '2024-12-05 08:00:00', '2024-12-09 10:00:00', 'lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Curabitur pretium tincidunt lacus, vitae lacinia elit bibendum a. Mauris id metus eu nunc eleifend ullamcorper. Sed sit amet tortor tincidunt, tincidunt arcu id, tempor neque.', 'poster_1733267426.png', 0, '0.00', 'UPCOMING', 1);

-- --------------------------------------------------------

--
-- Table structure for table `event_tickets`
--

CREATE TABLE `event_tickets` (
  `ticket_ID` varchar(32) NOT NULL,
  `event_ID` int NOT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `event_ticket_assignment`
--

CREATE TABLE `event_ticket_assignment` (
  `ticket_ID` char(36) NOT NULL DEFAULT (uuid()),
  `attendee_ID` int DEFAULT NULL,
  `event_ID` int DEFAULT NULL,
  `purchase_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `price` decimal(10,2) DEFAULT NULL,
  `QR_code` varchar(225) NOT NULL,
  `attendance_status` enum('Hadir','Absen') DEFAULT 'Absen',
  `snap_token` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `event_ticket_assignment`
--

INSERT INTO `event_ticket_assignment` (`ticket_ID`, `attendee_ID`, `event_ID`, `purchase_date`, `price`, `QR_code`, `attendance_status`, `snap_token`, `status`) VALUES
('065f26a4-b082-11ef-be8b-ecbce95c1142', 34, 9, '2024-12-02 14:49:57', '20000.00', 'qr_9_34.png', 'Absen', NULL, 1),
('086b62c8-b0fc-11ef-be8b-ecbce95c1142', NULL, 9, '2024-12-03 05:23:19', '20000.00', 'qr_9_.png', 'Absen', NULL, 1),
('180f1caf-b098-11ef-be8b-ecbce95c1142', 34, 9, '2024-12-02 17:27:55', '20000.00', 'qr_9_34.png', 'Absen', NULL, 1),
('1a20c87a-b08f-11ef-be8b-ecbce95c1142', 34, 11, '2024-12-02 16:23:33', '0.00', 'qr_11_34.png', 'Absen', NULL, 1),
('2c93695a-b082-11ef-be8b-ecbce95c1142', 35, 9, '2024-12-02 14:51:01', '20000.00', 'qr_9_35.png', 'Absen', NULL, 1),
('38ca0bce-b09a-11ef-be8b-ecbce95c1142', 34, 9, '2024-12-02 17:43:09', '20000.00', 'qr_9_34.png', 'Absen', NULL, 1),
('42be192d-b098-11ef-be8b-ecbce95c1142', 34, 9, '2024-12-02 17:29:07', '20000.00', 'qr_9_34.png', 'Absen', NULL, 1),
('46f1fe10-b099-11ef-be8b-ecbce95c1142', 34, 9, '2024-12-02 17:36:23', '20000.00', 'qr_9_34.png', 'Absen', NULL, 1),
('6426bdf8-b0fc-11ef-be8b-ecbce95c1142', 38, 9, '2024-12-03 05:25:53', '20000.00', 'qr_9_38.png', 'Absen', NULL, 1),
('6e22f01e-b0f9-11ef-be8b-ecbce95c1142', 34, 9, '2024-12-03 05:04:41', '20000.00', 'qr_9_34.png', 'Absen', NULL, 1),
('822a33f9-b0fa-11ef-be8b-ecbce95c1142', 34, 9, '2024-12-03 05:12:24', '20000.00', 'qr_9_34.png', 'Absen', NULL, 1),
('86186ff9-b092-11ef-be8b-ecbce95c1142', 34, 9, '2024-12-02 16:48:03', '20000.00', 'qr_9_34.png', 'Absen', NULL, 1),
('927afdcd-b093-11ef-be8b-ecbce95c1142', 34, 9, '2024-12-02 16:55:33', '20000.00', 'qr_9_34.png', 'Absen', NULL, 1),
('988d1f9e-b0f9-11ef-be8b-ecbce95c1142', 34, 9, '2024-12-03 05:05:52', '20000.00', 'qr_9_34.png', 'Absen', NULL, 1),
('c1074c73-b09a-11ef-be8b-ecbce95c1142', 34, 10, '2024-12-02 17:46:58', '20000.00', 'qr_10_34.png', 'Absen', NULL, 1),
('c553683e-b0fc-11ef-be8b-ecbce95c1142', 38, 9, '2024-12-03 05:28:36', '20000.00', 'qr_9_38.png', 'Absen', NULL, 1),
('c863c700-b096-11ef-be8b-ecbce95c1142', 34, 9, '2024-12-02 17:18:32', '20000.00', 'qr_9_34.png', 'Absen', NULL, 1),
('ca4386ca-b081-11ef-be8b-ecbce95c1142', 33, 10, '2024-12-02 14:48:16', '20000.00', 'qr_10_33.png', 'Absen', NULL, 1),
('cecf1831-b08f-11ef-be8b-ecbce95c1142', 34, 9, '2024-12-02 16:28:36', '20000.00', 'qr_9_34.png', 'Absen', NULL, 1),
('f69bc142-b08e-11ef-be8b-ecbce95c1142', 34, 9, '2024-12-02 16:22:34', '20000.00', 'qr_9_34.png', 'Absen', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `event_type`
--

CREATE TABLE `event_type` (
  `event_type_ID` int NOT NULL,
  `event_type_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `event_type`
--

INSERT INTO `event_type` (`event_type_ID`, `event_type_name`) VALUES
(1, 'Seminar');

-- --------------------------------------------------------

--
-- Table structure for table `venue`
--

CREATE TABLE `venue` (
  `venue_ID` int NOT NULL,
  `name` varchar(60) DEFAULT NULL,
  `capacity` int DEFAULT NULL,
  `addres_line` varchar(60) DEFAULT NULL,
  `city` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `venue`
--

INSERT INTO `venue` (`venue_ID`, `name`, `capacity`, `addres_line`, `city`) VALUES
(1, 'Aula 1', 100, 'Universitas Buana Perjuangan', 'Karawang'),
(2, 'Aula 2', 500, 'Universitas Buana Perjuangan', 'Karawang');

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_attendee_data`
-- (See below for the actual view)
--
CREATE TABLE `vw_attendee_data` (
`attendee_ID` int
,`name` varchar(100)
,`email` varchar(50)
,`phone` varchar(25)
,`nama_acara` varchar(100)
,`ID_acara` int
,`QR_code` varchar(225)
,`attendance_status` enum('Hadir','Absen')
,`snap_token` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_events_data`
-- (See below for the actual view)
--
CREATE TABLE `vw_events_data` (
`event_ID` int
,`title` varchar(100)
,`event_type_ID` int
,`venue_ID` int
,`start_date` datetime
,`end_date` datetime
,`description` text
,`poster` varchar(255)
,`attendance` int
,`price` decimal(10,2)
,`status_acara` enum('UPCOMING','ON GOING','COMPLETED')
,`status_aktif` tinyint(1)
,`event_type_name` varchar(50)
,`venue_name` varchar(122)
);

-- --------------------------------------------------------

--
-- Structure for view `vw_attendee_data`
--
DROP TABLE IF EXISTS `vw_attendee_data`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_attendee_data`  AS SELECT `attendee`.`attendee_ID` AS `attendee_ID`, `attendee`.`name` AS `name`, `attendee`.`email` AS `email`, `attendee`.`phone` AS `phone`, `events`.`title` AS `nama_acara`, `events`.`event_ID` AS `ID_acara`, `event_ticket_assignment`.`QR_code` AS `QR_code`, `event_ticket_assignment`.`attendance_status` AS `attendance_status`, `event_ticket_assignment`.`snap_token` AS `snap_token` FROM ((`event_ticket_assignment` join `events` on((`event_ticket_assignment`.`event_ID` = `events`.`event_ID`))) join `attendee` on((`event_ticket_assignment`.`attendee_ID` = `attendee`.`attendee_ID`)))  ;

-- --------------------------------------------------------

--
-- Structure for view `vw_events_data`
--
DROP TABLE IF EXISTS `vw_events_data`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_events_data`  AS SELECT `events`.`event_ID` AS `event_ID`, `events`.`title` AS `title`, `events`.`event_type_ID` AS `event_type_ID`, `events`.`venue_ID` AS `venue_ID`, `events`.`start_date` AS `start_date`, `events`.`end_date` AS `end_date`, `events`.`description` AS `description`, `events`.`poster` AS `poster`, `events`.`attendance` AS `attendance`, `events`.`price` AS `price`, `events`.`status_acara` AS `status_acara`, `events`.`status_aktif` AS `status_aktif`, `event_type`.`event_type_name` AS `event_type_name`, concat(`venue`.`name`,', ',`venue`.`addres_line`) AS `venue_name` FROM ((`events` join `event_type` on((`events`.`event_type_ID` = `event_type`.`event_type_ID`))) join `venue` on((`events`.`venue_ID` = `venue`.`venue_ID`)))  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_ID`);

--
-- Indexes for table `attendee`
--
ALTER TABLE `attendee`
  ADD PRIMARY KEY (`attendee_ID`),
  ADD UNIQUE KEY `email_atd` (`email`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_ID`),
  ADD KEY `event_type_ID` (`event_type_ID`),
  ADD KEY `venue_ID` (`venue_ID`);

--
-- Indexes for table `event_tickets`
--
ALTER TABLE `event_tickets`
  ADD PRIMARY KEY (`ticket_ID`);

--
-- Indexes for table `event_ticket_assignment`
--
ALTER TABLE `event_ticket_assignment`
  ADD PRIMARY KEY (`ticket_ID`),
  ADD KEY `event_ID` (`event_ID`),
  ADD KEY `attendee_ID` (`attendee_ID`);

--
-- Indexes for table `event_type`
--
ALTER TABLE `event_type`
  ADD PRIMARY KEY (`event_type_ID`);

--
-- Indexes for table `venue`
--
ALTER TABLE `venue`
  ADD PRIMARY KEY (`venue_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `attendee`
--
ALTER TABLE `attendee`
  MODIFY `attendee_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `event_type`
--
ALTER TABLE `event_type`
  MODIFY `event_type_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `venue`
--
ALTER TABLE `venue`
  MODIFY `venue_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`event_type_ID`) REFERENCES `event_type` (`event_type_ID`),
  ADD CONSTRAINT `events_ibfk_2` FOREIGN KEY (`venue_ID`) REFERENCES `venue` (`venue_ID`);

--
-- Constraints for table `event_ticket_assignment`
--
ALTER TABLE `event_ticket_assignment`
  ADD CONSTRAINT `event_ticket_assignment_ibfk_1` FOREIGN KEY (`event_ID`) REFERENCES `events` (`event_ID`),
  ADD CONSTRAINT `event_ticket_assignment_ibfk_2` FOREIGN KEY (`attendee_ID`) REFERENCES `attendee` (`attendee_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
