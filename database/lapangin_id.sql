-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Bulan Mei 2024 pada 12.49
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
-- Database: `lapangin.id`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `akun_pengguna`
--

CREATE TABLE `akun_pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `saldo` decimal(10,2) DEFAULT 0.00,
  `nama_lengkap` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` enum('admin','pengguna') NOT NULL DEFAULT 'pengguna'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `akun_pengguna`
--

INSERT INTO `akun_pengguna` (`id_pengguna`, `username`, `password`, `saldo`, `nama_lengkap`, `email`, `role`) VALUES
(2, 'ahmadyuyu', '$2y$10$0EESCOO0Nopy6W6SZIGaluxF.IBXOM6QuhLxuXPvKq/jbq0AOxg/6', 9999999.00, '', 'pakhamers47@gmail.com', 'pengguna'),
(4, 'YustikaSlamet', '$2y$10$SgZb70XbCpqzsdQeDg.JzudKFbbkQycfFc0xzKCpXBnacR/rZiAGe', 999.00, '', 'pakhamers47@gmail.com', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `booking`
--

CREATE TABLE `booking` (
  `id_booking` int(11) NOT NULL,
  `id_lapangan` int(11) NOT NULL,
  `id_pemesan` int(11) NOT NULL,
  `tanggal_booking` date NOT NULL,
  `jam_mulai` time NOT NULL,
  `lama_booking` int(11) NOT NULL,
  `total_biaya` int(11) NOT NULL,
  `status_pembayaran` enum('Belum Bayar','Sudah Bayar') NOT NULL DEFAULT 'Belum Bayar'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `booking`
--

INSERT INTO `booking` (`id_booking`, `id_lapangan`, `id_pemesan`, `tanggal_booking`, `jam_mulai`, `lama_booking`, `total_biaya`, `status_pembayaran`) VALUES
(1, 2, 1, '2024-05-20', '03:34:00', 1, 50, 'Sudah Bayar'),
(2, 3, 2, '2024-05-20', '15:36:00', 1, 120, 'Sudah Bayar');

-- --------------------------------------------------------

--
-- Struktur dari tabel `lapangan`
--

CREATE TABLE `lapangan` (
  `id_lapangan` int(11) NOT NULL,
  `nama_lapangan` varchar(255) NOT NULL,
  `jenis_lapangan` enum('Futsal','Badminton') NOT NULL,
  `harga_sewa` int(11) NOT NULL,
  `kapasitas_pemain` int(11) NOT NULL,
  `status` enum('Tersedia','Dipesan','Digunakan') NOT NULL DEFAULT 'Tersedia'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `lapangan`
--

INSERT INTO `lapangan` (`id_lapangan`, `nama_lapangan`, `jenis_lapangan`, `harga_sewa`, `kapasitas_pemain`, `status`) VALUES
(1, 'futsal 1', 'Futsal', 120, 11, 'Digunakan'),
(2, 'badminton 1', 'Badminton', 50, 4, 'Dipesan'),
(3, 'furtsal 2', 'Futsal', 120, 11, 'Dipesan'),
(4, 'badminton 2', 'Badminton', 65, 4, 'Tersedia');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemesan`
--

CREATE TABLE `pemesan` (
  `id_pemesan` int(11) NOT NULL,
  `nama_pemesan` varchar(255) NOT NULL,
  `nomor_telepon` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pemesan`
--

INSERT INTO `pemesan` (`id_pemesan`, `nama_pemesan`, `nomor_telepon`, `email`) VALUES
(1, 'yayat guardo', '088667', 'pakhamers47@gmail.com'),
(2, 'aang ceceng', '0886675', 'pakhamers@gmail.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `riwayat_booking`
--

CREATE TABLE `riwayat_booking` (
  `id_riwayat_booking` int(11) NOT NULL,
  `id_booking` int(11) NOT NULL,
  `tanggal_riwayat` date NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `akun_pengguna`
--
ALTER TABLE `akun_pengguna`
  ADD PRIMARY KEY (`id_pengguna`);

--
-- Indeks untuk tabel `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id_booking`),
  ADD KEY `id_lapangan` (`id_lapangan`),
  ADD KEY `id_pemesan` (`id_pemesan`);

--
-- Indeks untuk tabel `lapangan`
--
ALTER TABLE `lapangan`
  ADD PRIMARY KEY (`id_lapangan`);

--
-- Indeks untuk tabel `pemesan`
--
ALTER TABLE `pemesan`
  ADD PRIMARY KEY (`id_pemesan`);

--
-- Indeks untuk tabel `riwayat_booking`
--
ALTER TABLE `riwayat_booking`
  ADD PRIMARY KEY (`id_riwayat_booking`),
  ADD KEY `id_booking` (`id_booking`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `akun_pengguna`
--
ALTER TABLE `akun_pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `booking`
--
ALTER TABLE `booking`
  MODIFY `id_booking` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `lapangan`
--
ALTER TABLE `lapangan`
  MODIFY `id_lapangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `pemesan`
--
ALTER TABLE `pemesan`
  MODIFY `id_pemesan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `riwayat_booking`
--
ALTER TABLE `riwayat_booking`
  MODIFY `id_riwayat_booking` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`id_lapangan`) REFERENCES `lapangan` (`id_lapangan`),
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`id_pemesan`) REFERENCES `pemesan` (`id_pemesan`);

--
-- Ketidakleluasaan untuk tabel `riwayat_booking`
--
ALTER TABLE `riwayat_booking`
  ADD CONSTRAINT `riwayat_booking_ibfk_1` FOREIGN KEY (`id_booking`) REFERENCES `booking` (`id_booking`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
