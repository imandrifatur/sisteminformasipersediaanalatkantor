-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Apr 2023 pada 18.20
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `daftar_barang`
--

CREATE TABLE `daftar_barang` (
  `id` int(255) NOT NULL,
  `kode` varchar(20) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `jenis` varchar(32) NOT NULL,
  `stock` int(10) NOT NULL,
  `satuan` varchar(15) NOT NULL,
  `spek` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `daftar_barang`
--

INSERT INTO `daftar_barang` (`id`, `kode`, `nama_barang`, `jenis`, `stock`, `satuan`, `spek`) VALUES
(2, 'BR2', 'EPSON EX12', 'Printer', 27, 'Unit', '-'),
(4, 'BR3', 'ASUS ROG', 'Laptop', 8, 'UNIT', ''),
(5, 'BR4', 'MOUSE', 'Lainnya', 17, 'UNIT', ''),
(6, 'BR10', 'SOUND', 'Lainnya', 18, 'UNIT', ''),
(7, 'BR11', 'MODEM', 'Lainnya', 14, 'UNIT', ''),
(8, 'BR9', 'ASUS XP', 'Laptop', 7, 'Unit', '- Intel i3 2.50GHz\r\n- RAM 4GB\r\n- Bluetooth\r\n- VGA ATI Radeon 1GB   '),
(9, 'BR12', 'BB 9300', 'Handphone', 9, 'Unit', '- Touch Screen\r\n- Dual Core\r\n- RAM 1GB'),
(11, 'KIH124', 'RAM CORSAIR 2000', 'Lainnya', 8, 'Pcs', ''),
(12, 'KIH122', 'HARDISK 500GB', 'Lainnya', 15, 'Pcs', ''),
(13, 'KIH2344', 'MOUSE GAMER', 'Lainnya', 10, 'Pcs', ''),
(14, 'KIH2132', 'KABEL RJ45', 'Lainnya', 15, 'Unit', ''),
(16, 'R29', 'LENOVO THINKPAD', 'Laptop', 19, 'UNIT', '- Core i5\r\n- Ram 4GB\r\n- Windows 8.1 Pro'),
(17, 'HU11', 'ACER ASPIRE 10', 'Laptop', -1, 'UNIT', '- Core i3 1.8GHz\r\n- Ram 2 Gb\r\n- Touch Screen\r\n- Windows 8 Pro\r\n- VGA iNvidia GT2000'),
(18, 'E2', 'NOKIA ASHA', 'Handphone', 6, 'UNIT', '- GSM\r\n- Dual SIM\r\n- 2 Gb Memory '),
(19, 'BRG 012', 'ACER', 'Laptop', 23, 'UNIT', 'core i5');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis`
--

CREATE TABLE `jenis` (
  `jenis_barang` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jenis`
--

INSERT INTO `jenis` (`jenis_barang`) VALUES
('Laptop'),
('Handphone'),
('Lainnya'),
('PC'),
('Printer');

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporan_trans`
--

CREATE TABLE `laporan_trans` (
  `id` int(255) NOT NULL,
  `kode_trans` varchar(32) NOT NULL,
  `nama_brg` varchar(100) NOT NULL,
  `jenis_trans` varchar(32) NOT NULL,
  `brg_to` varchar(100) NOT NULL,
  `jumlah_trans` int(10) NOT NULL,
  `stock_awal` varchar(10) NOT NULL,
  `stock_akhir` varchar(10) NOT NULL,
  `tanggal` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `laporan_trans`
--

INSERT INTO `laporan_trans` (`id`, `kode_trans`, `nama_brg`, `jenis_trans`, `brg_to`, `jumlah_trans`, `stock_awal`, `stock_akhir`, `tanggal`) VALUES
(2, 'TR0', 'LENOVO G405S', 'Keluar', '', 4, '29', '25', '2015-11-30'),
(3, 'TR1', 'ASUS ROG', 'Masuk', '', 4, '4', '8', '2015-12-01'),
(4, 'TR2', 'LENOVO THINKPAD', 'Masuk', '', 10, '9', '19', '2015-12-02'),
(13, 'TR3', 'ACER ASPIRE 10', 'Keluar', 'saya', 4, '3', '-1', '2015-12-14'),
(14, 'TR4', 'EPSON EX12', 'Masuk', '-', 7, '0', '7', '2015-12-14'),
(15, 'TR5', 'RAM CORSAIR 2000', 'Keluar', 'saya', 2, '10', '8', '2015-12-18'),
(16, 'TR6', 'EPSON EX12', 'Keluar', 'HRD', 3, '7', '4', '2023-04-11'),
(17, 'TR7', 'EPSON EX12', 'Masuk', 'Hrd', 23, '4', '27', '2023-04-12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `satuan`
--

CREATE TABLE `satuan` (
  `satuan_barang` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `satuan`
--

INSERT INTO `satuan` (`satuan_barang`) VALUES
('Unit'),
('Pcs'),
('Roll');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(255) NOT NULL,
  `kode_trans` varchar(32) NOT NULL,
  `barang` varchar(32) NOT NULL,
  `jenis_trans` varchar(32) NOT NULL,
  `brg_to` varchar(100) NOT NULL,
  `jumlah_trans` int(10) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id`, `kode_trans`, `barang`, `jenis_trans`, `brg_to`, `jumlah_trans`, `tanggal`) VALUES
(17, 'TR0', 'LENOVO G405S', 'Keluar', '', 4, '2015-11-30'),
(18, 'TR1', 'ASUS ROG', 'Masuk', '', 4, '2015-12-01'),
(19, 'TR2', 'LENOVO THINKPAD', 'Masuk', '', 10, '2015-12-02'),
(30, 'TR3', 'ACER ASPIRE 10', 'Keluar', 'saya', 4, '2015-12-14'),
(31, 'TR4', 'EPSON EX12', 'Masuk', '-', 7, '2015-12-14'),
(32, 'TR5', 'RAM CORSAIR 2000', 'Keluar', 'saya', 2, '2015-12-18'),
(33, 'TR6', 'EPSON EX12', 'Keluar', 'HRD', 3, '2023-04-11'),
(34, 'TR7', 'EPSON EX12', 'Masuk', 'Hrd', 23, '2023-04-12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin', 'admin1234', 'admin'),
(2, 'opratorgudang', 'user1234', 'user');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `daftar_barang`
--
ALTER TABLE `daftar_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `laporan_trans`
--
ALTER TABLE `laporan_trans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `daftar_barang`
--
ALTER TABLE `daftar_barang`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `laporan_trans`
--
ALTER TABLE `laporan_trans`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
