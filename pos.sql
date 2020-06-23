-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Jun 2020 pada 16.04
-- Versi server: 10.1.31-MariaDB
-- Versi PHP: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `aktiva`
--

CREATE TABLE `aktiva` (
  `id` int(11) NOT NULL,
  `aktiva_name` varchar(25) NOT NULL,
  `aktiva_desc` varchar(50) NOT NULL,
  `category` int(11) NOT NULL,
  `subcategory` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `ket` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `aktiva`
--

INSERT INTO `aktiva` (`id`, `aktiva_name`, `aktiva_desc`, `category`, `subcategory`, `qty`, `harga`, `ket`) VALUES
(1, 'Monitor', 'Zyrex 14', 16, 19, 1, 750000, 'Komputer 5');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barista`
--

CREATE TABLE `barista` (
  `id` int(11) NOT NULL,
  `nik` int(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` varchar(100) NOT NULL,
  `jabatan` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_hp` varchar(13) NOT NULL,
  `status_kerja` varchar(100) NOT NULL,
  `status_perkawinan` varchar(100) NOT NULL,
  `kodetoko` varchar(4) NOT NULL,
  `nama_toko` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barista`
--

INSERT INTO `barista` (`id`, `nik`, `nama`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `jabatan`, `alamat`, `no_hp`, `status_kerja`, `status_perkawinan`, `kodetoko`, `nama_toko`) VALUES
(3, 2013137279, 'Rizqi Isfahani', 'Banjarmasin', '1997-02-14', 'Laki-Laki', 'Leader ', 'Banjarmasin', '082248106185', 'Tetap', 'Tidak Kawin', 'THXU', 'IDM A Yani KM 19 Banjarbaru');

-- --------------------------------------------------------

--
-- Struktur dari tabel `initial`
--

CREATE TABLE `initial` (
  `id` int(11) NOT NULL,
  `nik` int(11) NOT NULL,
  `lastinitialdate` datetime NOT NULL,
  `modal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `initialog`
--

CREATE TABLE `initialog` (
  `id` int(11) NOT NULL,
  `nik` int(11) NOT NULL,
  `lastinitialdate` datetime NOT NULL,
  `modal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `lookupvalue`
--

CREATE TABLE `lookupvalue` (
  `id` int(11) NOT NULL,
  `desc` varchar(30) NOT NULL,
  `valuetype` varchar(4) NOT NULL,
  `singkatan` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `lookupvalue`
--

INSERT INTO `lookupvalue` (`id`, `desc`, `valuetype`, `singkatan`) VALUES
(1, 'Gram', '1000', 'g'),
(2, 'Mililiter', '1000', 'ml'),
(3, 'Liter', '1000', 'ltr'),
(4, 'Fluid Ounce', '1000', 'oz'),
(5, 'Kilo Gram', '1000', 'kg'),
(6, 'Piece', '1001', 'pcs'),
(7, 'Package', '1001', 'pack'),
(8, 'Botol', '1001', 'btl'),
(9, 'Kaleng', '1001', 'klg'),
(10, 'Laki - Laki', '1002', 'L'),
(11, 'Perempuan', '1002', 'P'),
(12, 'Unit Cup', '1003', 'Cup'),
(13, 'Unit Bottle', '1003', 'Btl'),
(14, 'Size Ice', '1006', '16 Oz'),
(15, 'Size Hot', '1006', '8 Oz'),
(16, 'Store Equipment', '1004', 'se'),
(17, 'Machinery', '1004', 'Mk'),
(18, 'Tools', '1004', 'Tools'),
(19, 'Computer', '1005', 'Com'),
(20, 'Mesin Kopi', '1005', 'MK'),
(21, 'Peralatan', '1005', 'Tools'),
(22, 'Barista Leader', '1007', 'L'),
(23, 'Barista', '1007', 'B'),
(24, 'Kontrak', '1008', 'SK'),
(25, 'Tetap', '1008', 'SK'),
(26, 'Menikah', '1008', 'SP'),
(27, 'Belum Menikah', '1008', 'SP');

-- --------------------------------------------------------

--
-- Struktur dari tabel `member`
--

CREATE TABLE `member` (
  `id` int(11) NOT NULL,
  `id_member` int(20) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `noktp` int(16) NOT NULL,
  `nohp` varchar(13) NOT NULL,
  `jk` int(11) NOT NULL,
  `alamat` varchar(30) NOT NULL,
  `stampid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `member`
--

INSERT INTO `member` (`id`, `id_member`, `nama`, `noktp`, `nohp`, `jk`, `alamat`, `stampid`) VALUES
(2, 2147483647, 'Rizqi Isfahani', 2147483647, '082248106186', 10, 'Banjarmasin Selatan', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `prdcd` varchar(8) NOT NULL,
  `singkatan` varchar(40) NOT NULL,
  `desc` varchar(60) NOT NULL,
  `unit` text NOT NULL,
  `size` varchar(6) NOT NULL,
  `price` int(11) NOT NULL,
  `sellingprice` int(11) NOT NULL,
  `idtoko` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `product`
--

INSERT INTO `product` (`id`, `prdcd`, `singkatan`, `desc`, `unit`, `size`, `price`, `sellingprice`, `idtoko`) VALUES
(1, '20034422', 'P/C Hot Ice', 'Point Coffe Panas Dingin Panas', 'Cup', '16 Oz', 21000, 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `stock`
--

CREATE TABLE `stock` (
  `id` int(11) NOT NULL,
  `prdcd` varchar(8) NOT NULL,
  `deskripsi` varchar(30) NOT NULL,
  `harga` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `kategori` int(11) NOT NULL,
  `satuan` int(11) NOT NULL,
  `idtoko` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `stock`
--

INSERT INTO `stock` (`id`, `prdcd`, `deskripsi`, `harga`, `jumlah`, `kategori`, `satuan`, `idtoko`) VALUES
(2, '20034422', 'Cokelat Panas', 321321, 1, 6, 1, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `supco` varchar(4) NOT NULL,
  `nama_supplier` varchar(30) NOT NULL,
  `alamat1` varchar(40) NOT NULL,
  `alamat2` varchar(40) NOT NULL,
  `telp1` varchar(13) NOT NULL,
  `telp2` varchar(13) NOT NULL,
  `idtoko` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`id`, `supco`, `nama_supplier`, `alamat1`, `alamat2`, `telp1`, `telp2`, `idtoko`) VALUES
(1, 'S6JH', 'PT Indogrosir 6', 'Jakarta Pusat', 'Jl A Yani KM 12', '0511232134', '0511255882', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `toko`
--

CREATE TABLE `toko` (
  `id` int(11) NOT NULL,
  `kodetoko` varchar(4) NOT NULL,
  `nama_toko` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `kota` varchar(40) NOT NULL,
  `rt` varchar(3) NOT NULL,
  `rw` varchar(3) NOT NULL,
  `telp` varchar(13) NOT NULL,
  `kodepos` varchar(5) NOT NULL,
  `buka` date NOT NULL,
  `namafrc` varchar(30) NOT NULL,
  `ka_toko` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `toko`
--

INSERT INTO `toko` (`id`, `kodetoko`, `nama_toko`, `alamat`, `kota`, `rt`, `rw`, `telp`, `kodepos`, `buka`, `namafrc`, `ka_toko`) VALUES
(1, 'THXU', 'A Yani KM 19 ', 'Jl A Yani KM 19', 'Banjarbaru', '001', '001', '05112323444', '70254', '2020-05-18', 'PT Indomarco Prismatama', 'Tirta Juniar');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `aktiva`
--
ALTER TABLE `aktiva`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `barista`
--
ALTER TABLE `barista`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `initial`
--
ALTER TABLE `initial`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `initialog`
--
ALTER TABLE `initialog`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `lookupvalue`
--
ALTER TABLE `lookupvalue`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idtoko` (`idtoko`);

--
-- Indeks untuk tabel `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kategori` (`kategori`),
  ADD KEY `satuan` (`satuan`),
  ADD KEY `idtoko` (`idtoko`);

--
-- Indeks untuk tabel `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `toko`
--
ALTER TABLE `toko`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `aktiva`
--
ALTER TABLE `aktiva`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `barista`
--
ALTER TABLE `barista`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `initial`
--
ALTER TABLE `initial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `initialog`
--
ALTER TABLE `initialog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `lookupvalue`
--
ALTER TABLE `lookupvalue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `member`
--
ALTER TABLE `member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `toko`
--
ALTER TABLE `toko`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
