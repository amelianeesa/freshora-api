-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Jun 2026 pada 06.50
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
-- Database: `laundry`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `whatsapp` varchar(20) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `messages`
--

INSERT INTO `messages` (`id`, `name`, `whatsapp`, `message`, `created_at`) VALUES
(1, 'amelianeesa', '12345678', 'HAYYYYYY PESANANKU YANG CEPERTTT YAAA', '2026-06-02 05:54:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `service_name` varchar(100) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `whatsapp` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `pickup_time` varchar(50) NOT NULL,
  `notes` text DEFAULT NULL,
  `promo_code` varchar(50) DEFAULT NULL,
  `resi_code` varchar(50) NOT NULL,
  `status` enum('Pending','Proses','Selesai') DEFAULT 'Pending',
  `payment_method` varchar(50) DEFAULT 'COD',
  `weight` float DEFAULT 0,
  `total_price` decimal(10,2) DEFAULT 0.00,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `payment_proof` varchar(255) DEFAULT NULL,
  `laundry_photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `price_daily` decimal(10,2) DEFAULT 6000.00,
  `price_express` decimal(10,2) DEFAULT 10000.00,
  `price_dry` decimal(10,2) DEFAULT 8000.00,
  `price_iron` decimal(10,2) DEFAULT 4000.00,
  `price_complete` decimal(10,2) DEFAULT 7000.00,
  `bank_name` varchar(50) DEFAULT 'BNI',
  `bank_number` varchar(50) DEFAULT '1846646794',
  `bank_holder` varchar(100) DEFAULT 'Freshora Laundry',
  `whatsapp_admin` varchar(20) DEFAULT '6282313051938',
  `qris_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `settings`
--

INSERT INTO `settings` (`id`, `price_daily`, `price_express`, `price_dry`, `price_iron`, `price_complete`, `bank_name`, `bank_number`, `bank_holder`, `whatsapp_admin`, `qris_image`) VALUES
(1, 10000.00, 14000.00, 8000.00, 4000.00, 7000.00, 'BRI', '18967345', 'Freshora Laundry', '081326811456', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT 'default.png',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `fullname`, `password`, `role`, `phone`, `address`, `profile_image`, `created_at`) VALUES
(1, 'amelianeesa', 'annisa', '$2y$10$Qf4Y4VNPZz3SIlcLuAYUiu.ddj3MsObwq2iTqLiYrfqaaTy5fc2b.', 'user', '082313051938', 'jl . munggur barat', 'default.png', '2026-06-02 05:49:24'),
(2, 'amelianeesa1', '123456789', '$2y$10$O5Lgy0BpZ5kidZ5eVooEbe8rRpQx7MmjtO69Q9nq9aE5FixTfhoXS', 'user', NULL, NULL, 'default.png', '2026-06-09 10:38:13'),
(3, 'amelia', '123456789', '$2y$10$GdaL/mqb7RpzWlhcB1KtK.KFTbKOTLlVsw40BniJNYAgCaq8AAdkO', 'user', NULL, NULL, 'default.png', '2026-06-09 10:39:59');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
