-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Mar 2021 pada 16.55
-- Versi server: 10.4.17-MariaDB
-- Versi PHP: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `penjualan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `berita`
--

CREATE TABLE `berita` (
  `id_berita` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `jenis_berita` varchar(20) NOT NULL,
  `judul_berita` varchar(255) NOT NULL,
  `slug_berita` varchar(255) NOT NULL,
  `keywords` text DEFAULT NULL,
  `status_berita` varchar(20) NOT NULL,
  `keterangan` text NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `tanggal_post` datetime NOT NULL,
  `tanggal_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `gambar`
--

CREATE TABLE `gambar` (
  `id_gambar` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `judul_gambar` varchar(255) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `tanggal_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `gambar`
--

INSERT INTO `gambar` (`id_gambar`, `id_produk`, `judul_gambar`, `gambar`, `tanggal_update`) VALUES
(15, 20, 'TAS RAFAELA NETT', '0d59974f9b01332f4cedee2d0451c68c_tn.jpg', '2021-03-07 08:27:28'),
(16, 20, 'TAS RAFAELA NETT', 'beb118e571aeb59813b6293cbe0688a6_tn.jpg', '2021-03-07 08:27:40'),
(17, 20, 'TAS RAFAELA NETT', 'bc71e32c86eb381ff24230e2bfe815ce.jpg', '2021-03-07 08:27:49'),
(18, 20, 'TAS RAFAELA NETT', '00efacf434607b381cefa1a6ff53a52f_tn1.jpg', '2021-03-17 12:19:58'),
(19, 21, 'SASA WALLET HANGING CUTS SADOW', 'f33b5ace79d9442b571a334589d2cd6e_tn.jpg', '2021-03-17 15:04:31'),
(20, 21, 'SASA WALLET HANGING CUTS SADOW', '94f99b0bda3d104b22154d6df71b3293_tn.jpg', '2021-03-17 15:04:39'),
(21, 21, 'SASA WALLET HANGING CUTS SADOW', '79d05c4357ea4498f7ed01b2345cd51d_tn.jpg', '2021-03-17 15:04:47'),
(22, 21, 'SASA WALLET HANGING CUTS SADOW', 'ae092c8beafabeb9f0cf6d4dc737ebee_tn.jpg', '2021-03-17 15:04:56'),
(23, 21, 'SASA WALLET HANGING CUTS SADOW', 'b5e241bdc2457380e3bb9e98c378bb9a_tn.jpg', '2021-03-17 15:05:06'),
(24, 21, 'SASA WALLET HANGING CUTS SADOW', 'b7c9be2b19970380952e6a836681f0ac_tn.jpg', '2021-03-17 15:05:13'),
(25, 21, 'SASA WALLET HANGING CUTS SADOW', '81f2895d191733f2e57108cab6cb9fc8_tn.jpg', '2021-03-17 15:05:21'),
(26, 21, 'SASA WALLET HANGING CUTS SADOW', 'b5e241bdc2457380e3bb9e98c378bb9a.jpg', '2021-03-17 15:05:28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `header_transaksi`
--

CREATE TABLE `header_transaksi` (
  `id_header_transaksi` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `nama_pelanggan1` varchar(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telepon` varchar(50) DEFAULT NULL,
  `alamat` varchar(300) DEFAULT NULL,
  `kode_transaksi` varchar(255) NOT NULL,
  `tanggal_transaksi` datetime NOT NULL,
  `batas_bayar` datetime NOT NULL,
  `jumlah_transaksi` int(11) NOT NULL,
  `status_bayar` varchar(20) NOT NULL,
  `jumlah_bayar` int(11) DEFAULT NULL,
  `rekening_pembayaran` varchar(255) DEFAULT NULL,
  `rekening_pelanggan` varchar(255) DEFAULT NULL,
  `bukti_bayar` varchar(255) DEFAULT NULL,
  `id_rekening` int(11) DEFAULT NULL,
  `tanggal_bayar` datetime DEFAULT NULL,
  `nama_bank` varchar(150) DEFAULT NULL,
  `tanggal_post` datetime NOT NULL,
  `tanggal_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Trigger `header_transaksi`
--
DELIMITER $$
CREATE TRIGGER `delete_header_transaksi` AFTER DELETE ON `header_transaksi` FOR EACH ROW DELETE FROM transaksi 
WHERE
kode_transaksi = old.kode_transaksi
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `transaksi_after_chgStatus` AFTER UPDATE ON `header_transaksi` FOR EACH ROW UPDATE transaksi
SET
id_user = new.id_user
WHERE
kode_transaksi = new.kode_transaksi
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `slug_kategori` varchar(255) NOT NULL,
  `nama_kategori` varchar(155) NOT NULL,
  `urutan` int(11) DEFAULT NULL,
  `tanggal_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `slug_kategori`, `nama_kategori`, `urutan`, `tanggal_update`) VALUES
(8, 'tas-wanita', 'Tas Wanita', 1, '2021-03-07 07:34:45'),
(9, 'dompet', 'Dompet', 2, '2021-03-17 14:47:28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `konfigurasi`
--

CREATE TABLE `konfigurasi` (
  `id_konfigurasi` int(11) NOT NULL,
  `namaweb` varchar(255) NOT NULL,
  `tagline` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `keywords` text DEFAULT NULL,
  `metatext` text DEFAULT NULL,
  `telepon` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `lokasi` int(1) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `rekening_pembayaran` varchar(255) DEFAULT NULL,
  `tanggal_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `konfigurasi`
--

INSERT INTO `konfigurasi` (`id_konfigurasi`, `namaweb`, `tagline`, `email`, `website`, `keywords`, `metatext`, `telepon`, `alamat`, `lokasi`, `facebook`, `instagram`, `deskripsi`, `logo`, `icon`, `rekening_pembayaran`, `tanggal_update`) VALUES
(2, 'Penjualan', 'No Selling Die', 'agungwahyu@gmail.com', 'penjualankita.com', 'jualan online', 'Jualan online', '085816908859', 'Umbulsari, Jember', 1, 'agung wahyu', 'agung_wahyu23', 'Jualan online', NULL, NULL, '6182119', '2021-03-11 17:50:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `status_pelanggan` varchar(20) NOT NULL,
  `nama_pelanggan` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(64) NOT NULL,
  `telepon` varchar(50) DEFAULT NULL,
  `alamat` varchar(300) DEFAULT NULL,
  `tanggal_daftar` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `tanggal_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `id_user`, `status_pelanggan`, `nama_pelanggan`, `email`, `password`, `telepon`, `alamat`, `tanggal_daftar`, `tanggal_update`) VALUES
(32, 0, 'Pending', 'Agung Wahyu Gunawan', 'agungwahyu23699@gmail.com', '7c222fb2927d828af22f592134e8932480637c0d', '085816908859', ' Jl. Umbulsari - Semboro, Gunungsari, Umbulsari, Jember', '2021-03-08 01:42:26', '2021-03-08 07:42:26'),
(33, 0, 'Pending', 'Syafitri', 'piki@gmail.com', '7c222fb2927d828af22f592134e8932480637c0d', '085816908859', ' Jl. Umbulsari - Semboro, Gunungsari, Umbulsari, Jember', '2021-03-08 01:51:41', '2021-03-08 07:51:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `kode_produk` varchar(20) NOT NULL,
  `url` varchar(255) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `slug_produk` varchar(255) NOT NULL,
  `keterangan` text NOT NULL,
  `keywords` text DEFAULT NULL,
  `harga_beli` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) DEFAULT NULL,
  `gambar` varchar(255) NOT NULL,
  `berat` float DEFAULT NULL,
  `ukuran` varchar(255) NOT NULL,
  `status_produk` varchar(20) NOT NULL,
  `tanggal_post` datetime NOT NULL,
  `tanggal_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_produk`, `id_user`, `id_kategori`, `kode_produk`, `url`, `nama_produk`, `slug_produk`, `keterangan`, `keywords`, `harga_beli`, `harga`, `stok`, `gambar`, `berat`, `ukuran`, `status_produk`, `tanggal_post`, `tanggal_update`) VALUES
(20, 10, 8, '1', 'https://shopee.co.id/-SIAP-KIRIM-TAS-RAFAELA-NETT-i.94079720.5276615590', 'TAS RAFAELA NETT', 'tas-rafaela-nett-1', '<p>tes</p>\r\n', 'tes		', 15000, 25000, 833, 'fa3f37c150e4c668d988621f11db1a0e_tn.jpg', 220, '15x28', 'Publish', '2021-03-07 09:10:00', '2021-03-17 14:10:13'),
(21, 10, 9, 'SS1', 'https://shopee.co.id/SASA-WALLET-HANGING-CUTS-SADOW-i.17545368.9101487534', 'SASA WALLET HANGING CUTS SADOW', 'sasa-wallet-hanging-cuts-sadow-ss1', '<p>SAKO WALLET HANGING CUTS SADOW Redy warna</p>\r\n\r\n<p>hitam, navy, marron, yellow</p>\r\n\r\n<p>4 IN 1</p>\r\n\r\n<p>- Dikalungkan</p>\r\n\r\n<p>- Dilingkarkan ke badan</p>\r\n\r\n<p>- Disakuin di celana</p>\r\n\r\n<p>- Digantungin ke konci motor &amp; mobil</p>\r\n', '										', 4299, 19900, 1807271, 'd4c8fe0954aeb0fd7b1391358898b787_tn.jpg', 1000, '13 x 10', 'Publish', '2021-03-17 15:57:00', '2021-03-17 15:09:18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekening`
--

CREATE TABLE `rekening` (
  `id_rekening` int(11) NOT NULL,
  `nama_bank` varchar(100) NOT NULL,
  `nomor_rekening` varchar(20) NOT NULL,
  `nama_pemilik` varchar(150) NOT NULL,
  `gambar` varchar(100) DEFAULT NULL,
  `tanggal_post` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `kode_transaksi` varchar(255) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `tanggal_transaksi` datetime NOT NULL,
  `tanggal_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Trigger `transaksi`
--
DELIMITER $$
CREATE TRIGGER `barang_after_checkout` AFTER INSERT ON `transaksi` FOR EACH ROW UPDATE produk
SET
stok = stok-NEW.jumlah
WHERE
id_produk = new.id_produk
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `batal_beli` AFTER DELETE ON `transaksi` FOR EACH ROW UPDATE produk
SET
stok = stok+OLD.jumlah
WHERE
id_produk = OLD.id_produk
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(64) NOT NULL,
  `akses_level` varchar(20) NOT NULL,
  `tanggal_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `nama`, `email`, `username`, `password`, `akses_level`, `tanggal_update`) VALUES
(10, 'Admin', 'agungwahyu23699@gmail.com', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin', '2021-03-07 07:29:06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `variasi`
--

CREATE TABLE `variasi` (
  `id_var` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `nama_variasi` varchar(25) NOT NULL,
  `stok` int(11) NOT NULL,
  `tanggal_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `variasi`
--

INSERT INTO `variasi` (`id_var`, `id_produk`, `nama_variasi`, `stok`, `tanggal_update`) VALUES
(19, 20, 'BLACK', 49, '2021-03-17 08:05:00'),
(20, 20, 'YELLOW', 63, '2021-03-17 08:05:00'),
(21, 20, 'WHITE', 151, '2021-03-17 08:05:00'),
(22, 20, 'CREAM', 190, '2021-03-17 08:05:00'),
(23, 20, 'GUAVA', 130, '2021-03-17 08:06:00'),
(24, 20, 'ICE BLUE', 150, '2021-03-17 08:06:00'),
(25, 20, 'MOCCA', 100, '2021-03-17 08:06:00'),
(26, 21, ' Hitam', 98389, '2021-03-17 08:58:00'),
(27, 21, 'Navy', 99883, '2021-03-17 08:58:00'),
(28, 21, 'Abu-abu', 99916, '2021-03-17 08:58:00'),
(29, 21, 'Maroon', 99940, '2021-03-17 08:59:00'),
(30, 21, 'Yellow', 99948, '2021-03-17 08:59:00'),
(31, 21, 'Biru Muda', 99983, '2021-03-17 08:59:00'),
(32, 21, 'Cream', 99976, '2021-03-17 08:59:00'),
(33, 21, 'Cimy', 99893, '2021-03-17 09:00:00'),
(34, 21, 'Tata', 99887, '2021-03-17 09:00:00'),
(35, 21, 'Koya', 99992, '2021-03-17 09:00:00'),
(36, 21, 'Adidas', 99831, '2021-03-17 09:00:00'),
(37, 21, 'Convers', 99989, '2021-03-17 09:01:00'),
(38, 21, 'Puma', 99993, '2021-03-17 09:01:00'),
(39, 21, 'Nike', 99820, '2021-03-17 09:01:00'),
(40, 21, 'Transparan Hitam', 99892, '2021-03-17 09:01:00'),
(41, 21, 'Transparam Maroon', 99982, '2021-03-17 09:02:00'),
(42, 21, 'Transaparan Abu', 99981, '2021-03-17 09:02:00'),
(43, 21, 'Transparan Navy', 99979, '2021-03-17 09:02:00'),
(44, 21, 'SASA 2 SLOT HITAM', 9997, '2021-03-17 09:03:00'),
(45, 21, 'Coky', 0, '2021-03-17 09:03:00');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id_berita`);

--
-- Indeks untuk tabel `gambar`
--
ALTER TABLE `gambar`
  ADD PRIMARY KEY (`id_gambar`);

--
-- Indeks untuk tabel `header_transaksi`
--
ALTER TABLE `header_transaksi`
  ADD PRIMARY KEY (`id_header_transaksi`),
  ADD UNIQUE KEY `kode_transaksi` (`kode_transaksi`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `konfigurasi`
--
ALTER TABLE `konfigurasi`
  ADD PRIMARY KEY (`id_konfigurasi`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD UNIQUE KEY `kode_produk` (`kode_produk`);

--
-- Indeks untuk tabel `rekening`
--
ALTER TABLE `rekening`
  ADD PRIMARY KEY (`id_rekening`),
  ADD UNIQUE KEY `nomor_rekening` (`nomor_rekening`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indeks untuk tabel `variasi`
--
ALTER TABLE `variasi`
  ADD PRIMARY KEY (`id_var`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `berita`
--
ALTER TABLE `berita`
  MODIFY `id_berita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `gambar`
--
ALTER TABLE `gambar`
  MODIFY `id_gambar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `header_transaksi`
--
ALTER TABLE `header_transaksi`
  MODIFY `id_header_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `konfigurasi`
--
ALTER TABLE `konfigurasi`
  MODIFY `id_konfigurasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `rekening`
--
ALTER TABLE `rekening`
  MODIFY `id_rekening` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `variasi`
--
ALTER TABLE `variasi`
  MODIFY `id_var` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
