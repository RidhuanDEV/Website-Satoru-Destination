-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Agu 2024 pada 19.16
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wisata`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `username` varchar(30) NOT NULL,
  `password` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `product`
--

CREATE TABLE `product` (
  `id_product` int(11) NOT NULL,
  `id_wisata` int(11) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `product`
--

INSERT INTO `product` (`id_product`, `id_wisata`, `harga`) VALUES
(1, 1, 50000),
(2, 2, 75000),
(3, 3, 60000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `nama` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`nama`, `email`, `password`, `id`) VALUES
('Wan1', 'ridhuankeren@gmail.com', '9061e5fdb0190d88967bf45be66cf7e7', 1),
('daw', 'daw@daw.com', 'ed2e60750f6b4026525b63ab128e35fb', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_wisata`
--

CREATE TABLE `tbl_wisata` (
  `nama` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `id` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `diskon` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_wisata`
--

INSERT INTO `tbl_wisata` (`nama`, `foto`, `id`, `deskripsi`, `diskon`) VALUES
('Pantai Kuta', 'pantai_kuta.jpg', 1, 'Pantai Kuta adalah salah satu tempat wisata yang paling terkenal di Bali. Pantai ini memiliki pemandangan matahari terbenam yang indah.', 'true'),
('Gunung Bromo', 'gunung_bromo.jpg', 2, 'Gunung Bromo adalah gunung berapi yang terletak di Jawa Timur. Tempat ini terkenal dengan pemandangan matahari terbit yang menakjubkan.', 'false'),
('Danau Toba', 'danau_toba.jpg', 3, 'Danau Toba adalah danau vulkanik yang terbesar di Indonesia. Terletak di Sumatera Utara, danau ini memiliki pulau Samosir di tengahnya.', 'true');

-- --------------------------------------------------------

--
-- Struktur dari tabel `test_wisata`
--

CREATE TABLE `test_wisata` (
  `id_transaksi` int(11) NOT NULL,
  `id_wisata` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `pelayanan` varchar(50) NOT NULL,
  `hari` int(11) NOT NULL,
  `peserta` int(11) NOT NULL,
  `total_pembayaran` int(11) NOT NULL,
  `tanggal_pemesanan` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tiket_wisata`
--

CREATE TABLE `tiket_wisata` (
  `id_transaksi` int(11) NOT NULL,
  `id_wisata` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `pelayanan` varchar(50) NOT NULL,
  `hari` int(11) NOT NULL,
  `peserta` int(11) NOT NULL,
  `total_pembayaran` int(11) NOT NULL,
  `tanggal_pemesanan` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tiket_wisata`
--

INSERT INTO `tiket_wisata` (`id_transaksi`, `id_wisata`, `id_users`, `pelayanan`, `hari`, `peserta`, `total_pembayaran`, `tanggal_pemesanan`) VALUES
(9, 1, 1, 'VIP', 3, 1, 150000, '2024-08-01 15:15:37');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id_product`),
  ADD KEY `id_wisata` (`id_wisata`);

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_wisata`
--
ALTER TABLE `tbl_wisata`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `test_wisata`
--
ALTER TABLE `test_wisata`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_wisata` (`id_wisata`),
  ADD KEY `fk_id_users` (`id_users`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `product`
--
ALTER TABLE `product`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbl_wisata`
--
ALTER TABLE `tbl_wisata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `test_wisata`
--
ALTER TABLE `test_wisata`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`id_wisata`) REFERENCES `tbl_wisata` (`id`);

--
-- Ketidakleluasaan untuk tabel `test_wisata`
--
ALTER TABLE `test_wisata`
  ADD CONSTRAINT `fk_id_users` FOREIGN KEY (`id_users`) REFERENCES `tbl_user` (`id`),
  ADD CONSTRAINT `test_wisata_ibfk_1` FOREIGN KEY (`id_wisata`) REFERENCES `tbl_wisata` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
