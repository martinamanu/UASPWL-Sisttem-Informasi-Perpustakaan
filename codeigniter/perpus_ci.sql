-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 17 Bulan Mei 2020 pada 08.19
-- Versi server: 10.4.13-MariaDB-log
-- Versi PHP: 7.3.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpus_ci`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth`
--

CREATE TABLE `auth` (
  `id` int(20) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `level` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `auth`
--

INSERT INTO `auth` (`id`, `nama`, `email`, `password`, `token`, `level`) VALUES
(1, 'Administrator', 'admin@bla.com', '$2y$10$RyT.GbDfFS98Tss/L4h54uJSMKCnQU5oMqR0D344S/8VlCvIvtLsy', 'ec97c2095c513c12e4cb1f8b99bd235d5761f43f9a8b90eb46bd33da157af371 ', 1),
(3, 'User Biasa', 'user@bla.com', '$2y$10$ZgQj985GMJZj0yFsooMDlO5z2r/Adc3iLlBZJXcK85RgwJLZDOd0y', '78f7b98f7d246fa1b94406d3db1f511872e167b925d671998e3d41ac1e53d4ad', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `id` bigint(20) NOT NULL,
  `nama_buku` varchar(255) NOT NULL,
  `penerbit` varchar(255) NOT NULL,
  `penulis` varchar(255) NOT NULL,
  `jumlah` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`id`, `nama_buku`, `penerbit`, `penulis`, `jumlah`) VALUES
(2, 'Matematika Kelas 12', 'Pintar Jaya', 'Edi Suparno', 12),
(5, 'Fisika Kelas 12', 'Pintar Jaya', 'Dadang Sudadang', 12);

-- --------------------------------------------------------

--
-- Struktur dari tabel `level`
--

CREATE TABLE `level` (
  `id` bigint(20) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `can_see_book` tinyint(1) NOT NULL,
  `can_add_book` tinyint(1) NOT NULL,
  `can_edit_book` tinyint(1) NOT NULL,
  `can_delete_book` tinyint(1) NOT NULL,
  `can_see_user` tinyint(1) NOT NULL,
  `can_add_user` tinyint(1) NOT NULL,
  `can_edit_user` tinyint(1) NOT NULL,
  `can_delete_user` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `level`
--

INSERT INTO `level` (`id`, `nama`, `can_see_book`, `can_add_book`, `can_edit_book`, `can_delete_book`, `can_see_user`, `can_add_user`, `can_edit_user`, `can_delete_user`) VALUES
(1, 'Administrator', 1, 1, 1, 1, 1, 1, 1, 1),
(2, 'User Biasa', 1, 0, 0, 0, 0, 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `auth`
--
ALTER TABLE `auth`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `auth`
--
ALTER TABLE `auth`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `buku`
--
ALTER TABLE `buku`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `level`
--
ALTER TABLE `level`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
