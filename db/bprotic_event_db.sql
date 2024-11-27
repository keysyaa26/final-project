-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 27, 2024 at 05:04 AM
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
CREATE DATABASE IF NOT EXISTS `bprotic_event_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `bprotic_event_db`;

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
(1, 'keysya', 'if23.keysyaaulia@mhs.ubpkarawang.ac.id', ''),
(2, 'keysya', 'if23.keysyaaulia@mhs.ubpkarawang.ac.id', ''),
(3, 'keysya', 'if23.keysyaaulia@mhs.ubpkarawang.ac.id', '');

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
  `status` varchar(20) DEFAULT NULL,
  `attendance` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_ID`, `title`, `event_type_ID`, `venue_ID`, `start_date`, `end_date`, `description`, `poster`, `status`, `attendance`) VALUES
(1, 'ACARA CONTOH 1', NULL, 1, '2024-11-30 12:00:00', '2024-11-30 15:00:00', 'Misalnya, Anda memiliki tabel bernama events dengan kolom event_name (string) dan event_date (datetime), dan Anda ingin memasukkan data ke dalam tabel tersebut.', NULL, NULL, 0),
(2, 'ACARA CONTOH 2', NULL, 2, '2024-11-30 12:00:00', '2024-11-30 15:00:00', 'Misalnya, Anda memiliki tabel bernama events dengan kolom event_name (string) dan event_date (datetime), dan Anda ingin memasukkan data ke dalam tabel tersebut.', NULL, NULL, 0);

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
  `purchase_date` datetime DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `QR_code` varchar(225) NOT NULL,
  `attendance_status` enum('Hadir','Absen') DEFAULT 'Absen'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `event_type`
--

CREATE TABLE `event_type` (
  `event_type_ID` int NOT NULL,
  `event_type_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  ADD PRIMARY KEY (`attendee_ID`);

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
  MODIFY `attendee_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `event_type`
--
ALTER TABLE `event_type`
  MODIFY `event_type_ID` int NOT NULL AUTO_INCREMENT;

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
--
-- Database: `event_db`
--
CREATE DATABASE IF NOT EXISTS `event_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `event_db`;

-- --------------------------------------------------------

--
-- Table structure for table `acara_has_peserta`
--

CREATE TABLE `acara_has_peserta` (
  `id` int NOT NULL,
  `id_acara` int NOT NULL,
  `id_peserta` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$jgsrBjVWuOttsQW9BuE./uQ.H227fZ8Q8KSDmvT9WB2rQeT.HG3we'),
(2, 'admin1', '$2y$10$f3j4nHLkepkxj08DgKOHI.Cskpb0Gfxug5T4OPE8z3sxzDiXsmIPe');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int NOT NULL,
  `registration_id` int DEFAULT NULL,
  `event_id` int DEFAULT NULL,
  `attendance_time` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `date` date NOT NULL,
  `poster` varchar(255) DEFAULT NULL,
  `location` varchar(100) DEFAULT '-',
  `status` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `description`, `date`, `poster`, `location`, `status`) VALUES
(15, 'conroh ', 'ini contoh', '2024-11-30', 'poster_1732337159.jpg', 'Kab. Karawang, Jawa Barat', 'upcoming');

-- --------------------------------------------------------

--
-- Table structure for table `peserta`
--

CREATE TABLE `peserta` (
  `id_peserta` int NOT NULL,
  `nama_peserta` varchar(50) DEFAULT NULL,
  `email_peserta` varchar(45) DEFAULT NULL,
  `prodi_peserta` varchar(45) DEFAULT NULL,
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `no_tlp` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `peserta`
--

INSERT INTO `peserta` (`id_peserta`, `nama_peserta`, `email_peserta`, `prodi_peserta`, `create_at`, `no_tlp`) VALUES
(21, 'Aulia', 'littlefoxxy323@gmail.com', NULL, '2024-11-23 08:17:18', '81314145558'),
(22, 'keysya', 'if23.keysyaaulia@mhs.ubpkarawang.ac.id', NULL, '2024-11-23 09:20:50', '000'),
(24, 'keysya', 'if23.keysyaaulia+2@mhs.ubpkarawang.ac.id', NULL, '2024-11-23 09:49:01', '0000'),
(26, 'keysya', 'if23.keysyaaulia+3@mhs.ubpkarawang.ac.id', NULL, '2024-11-23 09:52:51', '0000'),
(27, 'keysya', 'if23.keysyaaulia+5@mhs.ubpkarawang.ac.id', NULL, '2024-11-23 10:07:09', '0000');

-- --------------------------------------------------------

--
-- Table structure for table `registrations`
--

CREATE TABLE `registrations` (
  `id` int NOT NULL,
  `event_id` int DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `attendance_status` enum('Belum Hadir','Hadir') DEFAULT 'Belum Hadir'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
-- Indexes for dumped tables
--

--
-- Indexes for table `acara_has_peserta`
--
ALTER TABLE `acara_has_peserta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_acara` (`id_acara`),
  ADD KEY `id_peserta` (`id_peserta`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `registration_id` (`registration_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Indexes for table `peserta`
--
ALTER TABLE `peserta`
  ADD PRIMARY KEY (`id_peserta`),
  ADD UNIQUE KEY `unique_email` (`email_peserta`);

--
-- Indexes for table `registrations`
--
ALTER TABLE `registrations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `venue`
--
ALTER TABLE `venue`
  ADD PRIMARY KEY (`venue_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acara_has_peserta`
--
ALTER TABLE `acara_has_peserta`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `peserta`
--
ALTER TABLE `peserta`
  MODIFY `id_peserta` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `registrations`
--
ALTER TABLE `registrations`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `acara_has_peserta`
--
ALTER TABLE `acara_has_peserta`
  ADD CONSTRAINT `acara_has_peserta_ibfk_1` FOREIGN KEY (`id_acara`) REFERENCES `events` (`id`),
  ADD CONSTRAINT `acara_has_peserta_ibfk_2` FOREIGN KEY (`id_peserta`) REFERENCES `peserta` (`id_peserta`);

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`registration_id`) REFERENCES `registrations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `attendance_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `registrations`
--
ALTER TABLE `registrations`
  ADD CONSTRAINT `registrations_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE;
--
-- Database: `pemweb-db`
--
CREATE DATABASE IF NOT EXISTS `pemweb-db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `pemweb-db`;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image`, `created_at`, `updated_at`) VALUES
(39, 'sabun', 5000, '/upload/WhatsApp Image 2023-11-02 at 19.44.03.jpeg', '2023-11-02 13:30:25', NULL),
(40, 'detergen', 5000, '/upload/1698932052-WhatsApp Image 2023-11-02 at 19.44.03.jpeg', '2023-11-02 13:34:12', NULL),
(41, 'detergen', 5000, '/upload/1698932166-2b83cde3f290082bed3f41594bda2383-WhatsApp Image 2023-11-02 at 19.44.03.jpeg', '2023-11-02 13:36:06', NULL),
(42, 'so klin', 10000, '/upload/1698932550-f83bb0e67d37431c69b06cdccc1a58ca-panduan wisuda 2023-Gladi Mahasiswa.pdf', '2023-11-02 13:42:30', NULL),
(43, 'contoh1', 20000, '/upload/1731807533-6ea3faaeb603b8dc72152e42506b7342-Screenshot (340).png', '2024-11-17 01:38:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `role` enum('admin','user') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'user',
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `password`, `photo`, `created_at`, `updated_at`) VALUES
(6, 'keysya', 'if23.keysyaaulia@mhs.ubpkarawang.ac.id', 'admin', '$2y$10$5beLm1FLT9/HScCk556mAuV0mpFkssDWv8EUIWLerIrP9CN6YYB2e', NULL, '2024-11-22 01:19:42', NULL),
(7, 'keysya', 'if23.keysyaaulia+2@mhs.ubpkarawang.ac.id', 'user', '$2y$10$/fHpPOG6raax6aYBafWl8OJAZRRkdvXolOX5jBLMDwGOcPXtBH8N6', NULL, '2024-11-22 01:23:02', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- Database: `reservasi_studio`
--
CREATE DATABASE IF NOT EXISTS `reservasi_studio` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `reservasi_studio`;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `invoice_id` int NOT NULL,
  `reservation_id` int DEFAULT NULL,
  `invoice_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `paid_amount` decimal(10,2) DEFAULT NULL,
  `status` enum('unpaid','partially_paid','paid') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notification_id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `message` text,
  `type` enum('reservation','payment') DEFAULT NULL,
  `status` enum('unread','read') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int NOT NULL,
  `reservation_id` int DEFAULT NULL,
  `payment_method` enum('credit_card','bank_transfer','cash') DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `status` enum('pending','paid','failed') DEFAULT NULL,
  `payment_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `reservation_id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `studio_id` int DEFAULT NULL,
  `reservation_date` date DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `duration` int DEFAULT NULL,
  `extra_requests` text,
  `booking_notes` text,
  `total_price` decimal(10,2) DEFAULT NULL,
  `status` enum('pending','confirmed','completed','canceled','booking') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `studios`
--

CREATE TABLE `studios` (
  `studio_id` int NOT NULL,
  `foto` varchar(255) NOT NULL,
  `studio_name` varchar(100) DEFAULT NULL,
  `description` text,
  `facilities` text,
  `price_per_hour` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `studios`
--

INSERT INTO `studios` (`studio_id`, `foto`, `studio_name`, `description`, `facilities`, `price_per_hour`, `created_at`) VALUES
(2, 'Designer.png', 'Studio 2', 'Dask Studio 2', 'Fasilitas Studio 2', '50000.00', '2024-10-29 22:08:55'),
(3, '_d81d8a89-02e1-4471-a326-9cfcbf2108d1.jpeg', 'Studio 3', 'Desk Studio 3', 'Fasilitas Studio 3', '100000.00', '2024-10-29 22:09:40'),
(4, 'Untitled_design__7_-removebg-preview.png', 'Studio 3', 'Desk Studio 3', 'Fasilitas 3', '55000.00', '2024-10-30 22:47:56');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `nomor_hp` varchar(15) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('user','admin') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`invoice_id`),
  ADD KEY `reservation_id` (`reservation_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notification_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `reservation_id` (`reservation_id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`reservation_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `studio_id` (`studio_id`);

--
-- Indexes for table `studios`
--
ALTER TABLE `studios`
  ADD PRIMARY KEY (`studio_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `invoice_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `reservation_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `studios`
--
ALTER TABLE `studios`
  MODIFY `studio_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_ibfk_1` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`reservation_id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`reservation_id`) ON DELETE CASCADE;

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reservations_ibfk_2` FOREIGN KEY (`studio_id`) REFERENCES `studios` (`studio_id`) ON DELETE CASCADE;
--
-- Database: `sample_db_laragon`
--
CREATE DATABASE IF NOT EXISTS `sample_db_laragon` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `sample_db_laragon`;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
