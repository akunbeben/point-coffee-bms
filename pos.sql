-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Jul 2020 pada 19.41
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.1

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
  `ket` varchar(40) NOT NULL,
  `idtoko` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `idtoko` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barista`
--

INSERT INTO `barista` (`id`, `nik`, `nama`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `jabatan`, `alamat`, `no_hp`, `status_kerja`, `status_perkawinan`, `idtoko`) VALUES
(3, 2013137279, 'Rizqi Isfahani', 'Banjarmasin', '1997-02-14', 'Laki-Laki', 'Leader ', 'Banjarmasin', '082248106185', 'Tetap', 'Tidak Kawin', 2),
(4, 2013131313, 'Benny Rahmat', 'Kuala Kapuas', '1997-06-10', 'Laki-laki', 'Crew', 'Banjarbaru', '082212345678', 'Tetap', 'Belum Menikah', 2),
(5, 2013131515, 'User Coba', 'Kuala Kapuas', '1997-06-10', 'Laki-laki', 'Clerk', 'Banjarmasin', '082212345678', 'Tetap', 'Belum Menikah', 4),
(6, 2013131777, 'User Coba 2', 'Kuala Kapuas', '1997-06-10', 'Laki-laki', 'Clerk', 'Banjarmasin', '082212345678', 'Tetap', 'Belum Menikah', 3),
(7, 2013131717, 'User Test', 'Kuala Kapuas', '2020-06-29', 'Laki-laki', 'Clerk', 'Banjarbaru', '082212345678', 'Tetap', 'Belum Menikah', 5),
(8, 201230123, 'Usman', 'Banjarmasin', '2020-02-20', 'Laki - Laki', 'Barista Leader', 'Banjarmasin', '082212345678', 'Kontrak', 'Menikah', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `initial`
--

CREATE TABLE `initial` (
  `id` int(11) NOT NULL,
  `nik` int(11) NOT NULL,
  `lastinitialdate` datetime DEFAULT NULL,
  `modal` int(11) NOT NULL,
  `shift` int(11) NOT NULL,
  `idtoko` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `initial`
--

INSERT INTO `initial` (`id`, `nik`, `lastinitialdate`, `modal`, `shift`, `idtoko`) VALUES
(1, 0, NULL, 0, 0, 2),
(2, 0, NULL, 0, 0, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `initialog`
--

CREATE TABLE `initialog` (
  `id` int(11) NOT NULL,
  `nik` int(11) NOT NULL,
  `lastinitialdate` datetime NOT NULL,
  `modal` int(11) NOT NULL,
  `shift` int(11) NOT NULL,
  `idtoko` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `initialog`
--

INSERT INTO `initialog` (`id`, `nik`, `lastinitialdate`, `modal`, `shift`, `idtoko`) VALUES
(1, 2013137279, '2020-07-19 22:10:04', 200000, 1, 2),
(2, 2013131313, '2020-07-19 22:27:17', 200000, 2, 2),
(3, 2013131777, '2020-07-19 22:33:52', 200000, 1, 3),
(4, 2013131777, '2020-07-19 22:39:29', 200000, 2, 3),
(6, 2013131313, '2020-07-20 00:37:01', 200000, 1, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kasir_keranjang`
--

CREATE TABLE `kasir_keranjang` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `konversi`
--

CREATE TABLE `konversi` (
  `id` int(11) NOT NULL,
  `prdcd` varchar(128) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal_konversi` datetime NOT NULL,
  `konversi_oleh` varchar(128) NOT NULL,
  `idtoko` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `konversi`
--

INSERT INTO `konversi` (`id`, `prdcd`, `jumlah`, `tanggal_konversi`, `konversi_oleh`, `idtoko`) VALUES
(1, '20034422', 10, '2020-06-24 01:03:22', 'Benny Rahmat', 2),
(2, '20034422', 10, '2020-06-24 01:09:19', 'Benny Rahmat', 2),
(3, '20034422', 5, '2020-06-24 01:16:56', 'Benny Rahmat', 2),
(4, '20034422', 1, '2020-06-24 01:34:58', 'Benny Rahmat', 2),
(5, '20034422', 1, '2020-06-24 01:35:18', 'Benny Rahmat', 2),
(6, '20034422', 10, '2020-06-24 01:38:09', 'Benny Rahmat', 2),
(7, '20034422', 1, '2020-07-09 23:59:55', 'Rizqi Isfahani', 2),
(8, '20034422', 1, '2020-07-15 01:50:53', 'Rizqi Isfahani', 2),
(9, '20034422', 1, '2020-07-15 01:53:20', 'Rizqi Isfahani', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `lookupvalue`
--

CREATE TABLE `lookupvalue` (
  `id` int(11) NOT NULL,
  `desc` varchar(128) NOT NULL,
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
(26, 'Menikah', '1011', 'SP'),
(27, 'Belum Menikah', '1011', 'SP'),
(28, 'Draft', '1009', 'Draft'),
(29, 'Pending', '1009', 'Pndng'),
(30, 'Approved', '1009', 'Apprv'),
(31, 'Rejected', '1009', 'Rjctd'),
(32, '<span class=\"badge badge-danger\">Belum Diproses</span>', '1010', '-'),
(34, '<span class=\"badge badge-warning\">Sedang Diproses</span>', '1010', '-'),
(35, '<span class=\"badge badge-success\">Selesai Diproses</span>', '1010', '-'),
(36, 'Es Batu/Es Krim', '1012', 'ES'),
(37, 'Susu', '1012', 'SS'),
(38, 'Bahan Baku', '1012', 'BB'),
(39, 'Plastic Cutlery', '1012', 'PC');

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
(2, 2147483647, 'Rizqi Isfahani', 2147483647, '082248106186', 10, 'Banjarmasin Selatan', NULL),
(3, 0, 'Umum', 0, '0', 10, 'Umum', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan`
--

CREATE TABLE `penjualan` (
  `id` int(11) NOT NULL,
  `struk` varchar(128) NOT NULL,
  `kasir` varchar(128) NOT NULL,
  `member` varchar(128) NOT NULL,
  `total_belanja` int(11) NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `keuntungan` int(11) NOT NULL,
  `kembalian` int(11) NOT NULL,
  `tanggal_transaksi` datetime NOT NULL,
  `idtoko` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `penjualan`
--

INSERT INTO `penjualan` (`id`, `struk`, `kasir`, `member`, `total_belanja`, `total_bayar`, `keuntungan`, `kembalian`, `tanggal_transaksi`, `idtoko`) VALUES
(1, '33701240', 'Danielle Kihn DDS', 'fugiat', 28425, 21768, 158230, 199896, '2020-07-09 03:58:15', 2),
(2, '22190451', 'Mohammed Hilpert', 'temporibus', 24926, 111803, 12029, 35166, '2020-07-05 17:18:04', 2),
(3, '55336536', 'Kip Hills', 'quaerat', 67377, 63516, 167712, 145910, '2020-07-09 12:47:51', 3),
(4, '64102993', 'Lydia Muller', 'alias', 84316, 119539, 22938, 51171, '2020-07-05 13:12:28', 2),
(5, '35557302', 'Prof. Carrie Mann', 'sint', 64184, 121289, 81707, 151538, '2020-07-14 00:30:04', 4),
(6, '16074606', 'Miss Helen Spinka IV', 'doloremque', 45444, 70704, 112139, 141912, '2020-07-18 18:52:47', 2),
(7, '72391839', 'Evangeline Ledner', 'aut', 186829, 66974, 47741, 137049, '2020-07-12 13:02:19', 3),
(8, '06404062', 'Hassie Rodriguez', 'occaecati', 148387, 104162, 80726, 24965, '2020-07-04 01:35:46', 2),
(9, '44676209', 'Gerardo Moore', 'molestias', 10244, 148881, 114273, 50529, '2020-07-10 17:06:42', 2),
(10, '88153513', 'Torrance Gusikowski', 'ratione', 17700, 102048, 59403, 184733, '2020-07-16 09:10:54', 2),
(11, '93271622', 'Kenton Bogan', 'eveniet', 88056, 177727, 10645, 158082, '2020-07-04 08:39:46', 2),
(12, '80378914', 'Napoleon Hammes', 'et', 60781, 20471, 75478, 75398, '2020-07-21 00:44:50', 3),
(13, '03017722', 'Lawson Gorczany', 'fuga', 167193, 92786, 26334, 38708, '2020-07-13 07:48:38', 3),
(14, '52795633', 'Elian Doyle', 'voluptate', 194461, 17932, 38789, 30807, '2020-07-04 11:14:24', 2),
(15, '26635712', 'Prof. Myles Larkin PhD', 'quisquam', 102558, 87826, 77911, 146496, '2020-07-15 18:42:05', 3),
(16, '52042300', 'Glenda Kirlin I', 'nihil', 74392, 99885, 84807, 19648, '2020-07-16 08:38:43', 3),
(17, '64783130', 'Cali Mohr', 'blanditiis', 35163, 86515, 171423, 129176, '2020-07-09 05:29:40', 3),
(18, '70551396', 'Hadley Wolf', 'animi', 175690, 152889, 128068, 56148, '2020-07-16 19:48:55', 3),
(19, '13723859', 'Dora Witting', 'possimus', 113286, 175852, 19164, 174481, '2020-06-24 16:43:54', 2),
(20, '31767767', 'Xzavier Bosco', 'ipsa', 73546, 121641, 145352, 186704, '2020-06-28 23:56:26', 2),
(21, '11500469', 'Ashleigh Leuschke', 'voluptas', 67632, 73128, 186430, 113707, '2020-07-05 04:44:13', 3),
(22, '75520212', 'Mr. Hoyt Botsford DVM', 'aut', 87131, 20729, 101284, 45285, '2020-07-05 13:37:40', 3),
(23, '39391636', 'Ms. Brooklyn Nader I', 'consequatur', 11970, 149732, 110130, 185213, '2020-06-24 13:21:17', 3),
(24, '53802194', 'Ines Connelly', 'nesciunt', 45954, 17833, 144471, 84818, '2020-07-13 07:28:01', 3),
(25, '56563863', 'Vernie Deckow', 'ut', 32590, 40574, 34229, 114800, '2020-07-15 11:47:29', 4),
(26, '93839433', 'Prof. Darron Kemmer', 'ut', 64697, 65089, 174872, 50068, '2020-07-09 12:27:13', 4),
(27, '00115568', 'Dr. Rashad Willms', 'sed', 38828, 151134, 118287, 54534, '2020-07-04 05:12:31', 3),
(28, '01494280', 'Miss Marianne Windler', 'ut', 178446, 190420, 33110, 146814, '2020-06-27 12:41:45', 4),
(29, '28844501', 'Archibald Mosciski II', 'nihil', 33251, 28178, 132973, 182815, '2020-07-15 04:50:58', 4),
(30, '03700433', 'Prof. Kaitlin Pacocha III', 'ipsum', 59951, 123303, 151625, 170037, '2020-06-25 05:56:40', 2),
(31, '45509070', 'Dejuan Mraz', 'similique', 186699, 18562, 108312, 87972, '2020-07-06 16:32:21', 3),
(32, '18319699', 'Adam Paucek', 'tempora', 190131, 102728, 85369, 156919, '2020-07-16 15:50:21', 3),
(33, '60633880', 'Amari Balistreri', 'magnam', 106667, 106730, 46421, 192117, '2020-07-14 17:35:33', 4),
(34, '70910308', 'Titus Mitchell', 'suscipit', 139940, 74271, 80570, 94064, '2020-07-10 19:33:42', 2),
(35, '88032771', 'Amos Heidenreich', 'labore', 188486, 11731, 12837, 107103, '2020-06-28 03:09:15', 2),
(36, '33379272', 'Prof. Gabriella Jones III', 'at', 152469, 108493, 186318, 71677, '2020-07-16 11:37:06', 2),
(37, '24565677', 'Isaias Volkman', 'molestias', 45181, 194756, 186193, 11076, '2020-07-01 10:41:10', 2),
(38, '53291035', 'Carole Shanahan', 'non', 108044, 37889, 195041, 107440, '2020-07-10 11:44:06', 3),
(39, '41363768', 'Maribel Hills', 'sit', 41717, 91510, 44473, 94139, '2020-07-15 06:05:39', 2),
(40, '16871663', 'Gussie Gerhold', 'minima', 56770, 10526, 113250, 46505, '2020-07-12 00:45:47', 3),
(41, '63317206', 'Clement Hilpert', 'nobis', 194725, 136873, 104026, 48924, '2020-06-28 16:03:40', 4),
(42, '79738200', 'Dr. Maryjane Feeney', 'eligendi', 49657, 81968, 22420, 96751, '2020-07-06 20:11:55', 4),
(43, '75700508', 'Nicolette Will', 'est', 183827, 24911, 33375, 197398, '2020-07-10 08:04:39', 2),
(44, '35871705', 'Lysanne Cummerata', 'quod', 84539, 87997, 64821, 143446, '2020-07-13 07:34:06', 2),
(45, '59617013', 'Adrian Ferry', 'nesciunt', 197477, 17242, 19784, 102302, '2020-07-09 20:16:41', 4),
(46, '39275387', 'Joanne Larson', 'facilis', 61312, 93028, 107517, 43329, '2020-07-06 22:59:41', 2),
(47, '94892307', 'Prof. Estella Douglas', 'voluptatum', 191116, 120335, 155485, 36970, '2020-06-21 17:49:39', 2),
(48, '10293874', 'Flavie Littel', 'maiores', 10456, 15791, 139765, 14869, '2020-07-09 18:39:13', 4),
(49, '57634708', 'Sammy Gulgowski', 'excepturi', 57594, 10477, 172359, 21101, '2020-07-15 11:31:46', 4),
(50, '54420359', 'Juliana Prohaska IV', 'sed', 75824, 28686, 11502, 68785, '2020-06-28 04:32:38', 3),
(51, '02548654', 'Jeanne Ondricka', 'et', 118988, 115647, 152609, 82483, '2020-07-04 01:46:34', 2),
(52, '11149422', 'Jackeline Cole', 'soluta', 76977, 173139, 44903, 20282, '2020-06-29 20:23:52', 2),
(53, '61137844', 'Marco O\'Hara', 'autem', 139087, 29654, 177355, 147877, '2020-06-28 23:30:48', 3),
(54, '64911397', 'Dr. Brandyn Satterfield V', 'voluptatum', 166503, 127408, 128597, 123785, '2020-06-25 12:01:32', 2),
(55, '90486579', 'Jada Boehm', 'ut', 151068, 192817, 146365, 165342, '2020-07-14 00:16:29', 3),
(56, '20769178', 'Carolyne Zieme', 'odit', 199403, 52421, 39495, 189146, '2020-07-21 08:44:45', 2),
(57, '50833535', 'Vivianne Rohan', 'maxime', 85218, 136088, 159119, 12033, '2020-06-28 06:16:20', 2),
(58, '21915345', 'Dr. Reece Hoppe', 'repudiandae', 115597, 171720, 149023, 150351, '2020-06-28 10:41:28', 4),
(59, '28932215', 'Buck Gutmann', 'delectus', 46919, 64446, 113380, 175087, '2020-07-15 13:49:04', 2),
(60, '05982523', 'Prof. Zackery Prohaska DVM', 'in', 175246, 97021, 193742, 137107, '2020-07-21 15:14:20', 2),
(61, '90756290', 'Mrs. Bria Leannon', 'ex', 103123, 87983, 95598, 90377, '2020-06-28 09:10:56', 2),
(62, '70870848', 'Ignacio Gusikowski', 'accusantium', 46039, 103205, 168475, 166158, '2020-06-30 07:11:19', 3),
(63, '59764984', 'Kaitlyn Stokes Sr.', 'occaecati', 79416, 130869, 13580, 31650, '2020-06-22 01:09:24', 3),
(64, '09443976', 'Miss Angelica Turner', 'consequatur', 170397, 128762, 102481, 58717, '2020-07-12 14:35:49', 2),
(65, '72170458', 'Lindsey Kunde', 'et', 140633, 132641, 70645, 153358, '2020-06-26 04:20:11', 2),
(66, '75166397', 'Mr. Ramon Toy', 'repellat', 84842, 123704, 180433, 39123, '2020-07-07 02:00:10', 2),
(67, '17099271', 'Jaiden Witting', 'ut', 191400, 61516, 127768, 70501, '2020-07-16 09:59:33', 2),
(68, '93797221', 'Miss Tabitha Mayer', 'laboriosam', 163040, 101849, 194580, 30052, '2020-07-15 09:11:54', 4),
(69, '47844896', 'Kylee Stamm III', 'ut', 94047, 59369, 60394, 134315, '2020-07-10 15:06:34', 2),
(70, '37271725', 'Mylene King', 'iusto', 16625, 96319, 140884, 169355, '2020-07-21 01:29:33', 2),
(71, '29322374', 'Nayeli Hermann', 'minima', 95520, 142803, 44485, 31459, '2020-07-19 08:31:22', 3),
(72, '92600263', 'Queen Wintheiser', 'eum', 80072, 77354, 155971, 12972, '2020-06-25 17:11:32', 3),
(73, '85527775', 'Ole Wolff Jr.', 'consequatur', 73076, 119418, 163823, 42454, '2020-07-11 21:24:09', 2),
(74, '90513923', 'Danyka Anderson', 'praesentium', 70239, 23706, 163356, 24792, '2020-07-10 11:39:25', 2),
(75, '51196691', 'Frances Dooley V', 'placeat', 111177, 10772, 107228, 161818, '2020-07-16 02:17:12', 4),
(76, '92306516', 'Alexane Leannon IV', 'totam', 79475, 181845, 105743, 71794, '2020-07-21 05:12:33', 2),
(77, '03113783', 'Lysanne Boyle', 'id', 32438, 47991, 195814, 23378, '2020-07-07 05:43:39', 4),
(78, '96821060', 'Brandi Harvey', 'quo', 160295, 138731, 56252, 107779, '2020-07-19 10:08:45', 2),
(79, '70673494', 'Destany Koelpin', 'expedita', 91993, 135916, 56664, 115839, '2020-07-09 15:01:46', 3),
(80, '37466640', 'Cielo Sauer V', 'esse', 92689, 32670, 120921, 13505, '2020-07-17 10:43:01', 3),
(81, '52407116', 'Mr. Harley Kreiger I', 'repellat', 166404, 177211, 183999, 65791, '2020-07-19 05:24:44', 2),
(82, '68795481', 'Coy Johns', 'magni', 40404, 83876, 128278, 63341, '2020-07-08 14:02:37', 4),
(83, '58672693', 'Arlo Hudson', 'ex', 120391, 94259, 150585, 56433, '2020-06-30 17:16:08', 2),
(84, '70699692', 'Alex Windler Jr.', 'quos', 58150, 73173, 135960, 142767, '2020-07-10 00:31:21', 2),
(85, '42837343', 'Mrs. Ramona Rau', 'asperiores', 69625, 163966, 68593, 40227, '2020-06-26 12:01:00', 2),
(86, '01501117', 'Conor Reynolds', 'nam', 48726, 163949, 31432, 51517, '2020-07-17 20:48:04', 2),
(87, '38259494', 'Nella Weissnat', 'vel', 187015, 13655, 115073, 80266, '2020-07-07 18:49:35', 2),
(88, '74161355', 'Etha McCullough', 'enim', 82561, 175372, 120285, 25789, '2020-06-22 10:36:35', 2),
(89, '39541635', 'Kamryn Kassulke', 'in', 67426, 106070, 113242, 81022, '2020-07-13 04:29:25', 2),
(90, '79530590', 'Consuelo Hammes', 'alias', 32111, 114079, 185037, 46701, '2020-06-22 05:12:18', 3),
(91, '24381543', 'Barney Sporer', 'nam', 186101, 57431, 189795, 144133, '2020-07-15 06:49:01', 3),
(92, '37817565', 'Rafael Gerhold', 'dicta', 182305, 141118, 170332, 27536, '2020-07-04 02:09:58', 4),
(93, '98785780', 'Magdalena Weimann', 'impedit', 146631, 83335, 136758, 102631, '2020-06-28 19:01:42', 2),
(94, '54632196', 'Green Berge', 'perspiciatis', 61144, 146909, 51209, 158646, '2020-07-12 21:02:42', 4),
(95, '71994819', 'David Quigley', 'ut', 129706, 129602, 110516, 60834, '2020-06-24 16:28:58', 3),
(96, '82443733', 'Dr. Jackeline Kris', 'reprehenderit', 19675, 182442, 72584, 189996, '2020-07-05 20:28:09', 2),
(97, '20315955', 'Mr. Willis Goyette', 'eos', 93112, 120281, 67180, 54059, '2020-07-06 20:39:02', 2),
(98, '53576866', 'Rosalyn Maggio', 'itaque', 129494, 67275, 73043, 130350, '2020-07-01 08:39:48', 2),
(99, '52595707', 'Mr. Eleazar Conn DDS', 'aliquam', 11571, 61816, 44392, 136490, '2020-06-25 06:24:09', 2),
(100, '40384245', 'Margarett Block', 'sunt', 164270, 20028, 80731, 93375, '2020-07-03 21:40:37', 4),
(101, '0000000101', '2013131313', 'Umum', 23000, 23000, 2000, 0, '2020-07-22 02:44:37', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan_detail`
--

CREATE TABLE `penjualan_detail` (
  `id` int(11) NOT NULL,
  `penjualan_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `penjualan_detail`
--

INSERT INTO `penjualan_detail` (`id`, `penjualan_id`, `product_id`, `quantity`) VALUES
(1, 1, 1, 5),
(2, 2, 13, 6),
(3, 3, 1, 10),
(4, 4, 1, 10),
(5, 5, 1, 10),
(6, 5, 13, 5),
(8, 6, 2, 7),
(9, 101, 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan_non_tunai`
--

CREATE TABLE `penjualan_non_tunai` (
  `id` int(11) NOT NULL,
  `no_struk` varchar(128) NOT NULL,
  `no_kartu` varchar(128) NOT NULL,
  `bank` varchar(128) NOT NULL,
  `approval` varchar(128) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `penjualan_non_tunai`
--

INSERT INTO `penjualan_non_tunai` (`id`, `no_struk`, `no_kartu`, `bank`, `approval`, `total`) VALUES
(1, '0000000101', '656756756576', 'BRI', '56567', 23000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `permintaan_barang`
--

CREATE TABLE `permintaan_barang` (
  `id` int(11) NOT NULL,
  `kodesupplier` int(11) DEFAULT NULL,
  `kodepermintaan` varchar(128) NOT NULL,
  `idtoko` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `idbarista` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  `kategori` int(11) NOT NULL,
  `is_deleted` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `permintaan_barang`
--

INSERT INTO `permintaan_barang` (`id`, `kodesupplier`, `kodepermintaan`, `idtoko`, `tanggal`, `idbarista`, `status`, `kategori`, `is_deleted`) VALUES
(1, 2, 'RF0000001', 2, '2020-06-22 01:44:21', 4, 30, 0, 0),
(2, 1, 'RF0000002', 2, '2020-06-22 01:49:19', 4, 30, 0, 0),
(3, 2, 'RF0000003', 2, '2020-06-22 23:14:38', 4, 30, 0, 0),
(4, 1, 'RF0000004', 2, '2020-07-09 20:39:41', 3, 30, 0, 0),
(5, 1, 'RF0000005', 2, '2020-07-14 21:22:08', 3, 30, 0, 0),
(6, 1, 'RF0000006', 2, '2020-07-14 21:23:39', 3, 30, 0, 0),
(7, 1, 'RF0000007', 2, '2020-07-14 21:24:36', 3, 30, 0, 0),
(8, 1, 'RF0000008', 2, '2020-07-14 23:51:49', 3, 30, 0, 0),
(9, 1, 'RF0000009', 2, '2020-07-15 02:16:28', 3, 30, 0, 0),
(10, 1, 'RF0000010', 3, '2020-07-16 23:32:57', 6, 30, 0, 0),
(11, 1, 'RF0000011', 2, '2020-07-16 23:46:38', 3, 30, 0, 0),
(12, 1, 'RF0000012', 2, '2020-07-17 00:19:16', 3, 30, 0, 0),
(13, 1, 'RF0000013', 3, '2020-07-18 21:46:05', 6, 30, 0, 0),
(14, 2, 'RF0000014', 3, '2020-07-18 22:27:59', 6, 28, 0, 0),
(15, 2, 'RF0000015', 4, '2020-07-18 22:28:59', 5, 30, 0, 0),
(16, 1, 'RF0000016', 4, '2020-07-18 22:41:49', 5, 28, 0, 0),
(17, 1, 'RF0000017', 5, '2020-07-18 22:43:18', 7, 30, 0, 0),
(18, 3, 'RF0000018', 2, '2020-07-22 19:49:19', 4, 30, 0, 0),
(19, 1, 'RF0000019', 2, '2020-07-22 23:48:05', 4, 28, 0, 1),
(20, 1, 'RF0000020', 2, '2020-07-22 23:48:49', 4, 28, 0, 1),
(21, 3, 'RF0000021', 2, '2020-07-22 23:55:04', 4, 28, 0, 1),
(22, 3, 'RF0000022', 2, '2020-07-23 00:02:24', 4, 30, 0, 0),
(23, 1, 'RF0000023', 2, '2020-07-25 22:12:11', 3, 28, 0, 1),
(24, 1, 'RF0000024', 2, '2020-07-25 22:37:12', 3, 30, 0, 0),
(25, 1, 'RF0000025', 2, '2020-07-25 22:44:52', 3, 30, 36, 0),
(26, 3, 'RF0000026', 2, '2020-07-26 00:29:48', 3, 30, 36, 0),
(27, 2, 'RF0000027', 2, '2020-07-26 00:44:59', 3, 30, 37, 0),
(28, 5, 'RF0000028', 2, '2020-07-26 00:58:07', 3, 30, 38, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `permintaan_barang_detail`
--

CREATE TABLE `permintaan_barang_detail` (
  `id` int(11) NOT NULL,
  `kodepermintaan` varchar(128) NOT NULL,
  `prdcd` varchar(128) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `permintaan_barang_detail`
--

INSERT INTO `permintaan_barang_detail` (`id`, `kodepermintaan`, `prdcd`, `jumlah`) VALUES
(1, 'RF0000001', '20034422', 10),
(2, 'RF0000001', '20410023', 10),
(3, 'RF0000002', '20034422', 5),
(4, 'RF0000003', '20410023', 10),
(5, 'RF0000003', '20034422', 5),
(6, 'RF0000004', '20034422', 5),
(7, 'RF0000005', '20034422', 5),
(8, 'RF0000007', '20034422', 10),
(9, 'RF0000006', '20034422', 7),
(10, 'RF0000008', '20034422', 3),
(11, 'RF0000008', '20410023', 5),
(12, 'RF0000009', '20034422', 10),
(13, 'RF0000009', '20410023', 5),
(14, 'RF0000010', '20034422', 100),
(15, 'RF0000010', '20410023', 100),
(17, 'RF0000011', '20410072', 100),
(18, 'RF0000012', '20410025', 5),
(19, 'RF0000013', '20034422', 10),
(20, 'RF0000013', '20410072', 100),
(21, 'RF0000013', '20410025', 100),
(22, 'RF0000015', '20034422', 100),
(23, 'RF0000017', '20034422', 10),
(24, 'RF0000017', '20410023', 10),
(25, 'RF0000017', '20410072', 10),
(26, 'RF0000017', '20410025', 10),
(27, 'RF0000017', '20410056', 10),
(28, 'RF0000018', '20034422', 10),
(29, 'RF0000018', '20410025', 10),
(30, 'RF0000022', '20034422', 20),
(31, 'RF0000022', '20410072', 8),
(32, 'RF0000024', '20034422', 8),
(33, 'RF0000025', '20034422', 7),
(35, 'RF0000026', '20034422', 10),
(36, 'RF0000027', '20410023', 10),
(37, 'RF0000028', '20410072', 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `prdcd` varchar(8) NOT NULL,
  `singkatan` varchar(40) NOT NULL,
  `desc` varchar(60) NOT NULL,
  `unit` int(11) NOT NULL,
  `size` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `sellingprice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `product`
--

INSERT INTO `product` (`id`, `prdcd`, `singkatan`, `desc`, `unit`, `size`, `price`, `sellingprice`) VALUES
(1, '20034422', 'Espresso', 'Point Coffe Panas Dingin Panas', 1, 14, 21000, 23000),
(2, '20410023', 'Affogato', 'Affogato', 2, 15, 20000, 30000),
(13, '20410042', 'Cold Brew - Caramel', 'Cold Brew - Caramel', 2, 15, 13000, 16000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `profit`
--

CREATE TABLE `profit` (
  `id` int(11) NOT NULL,
  `shift_1` int(11) NOT NULL,
  `shift_2` int(11) NOT NULL,
  `pendapatan_kotor` int(11) NOT NULL,
  `ppn` int(11) NOT NULL,
  `profit` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `idtoko` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `profit`
--

INSERT INTO `profit` (`id`, `shift_1`, `shift_2`, `pendapatan_kotor`, `ppn`, `profit`, `tanggal`, `idtoko`) VALUES
(1, 230000, 310000, 540000, 54000, 40000, '2020-07-19', 3),
(2, 220000, 230000, 450000, 45000, 48000, '2020-07-19', 2),
(3, 0, 0, 0, 0, 0, '2020-07-29', 2),
(4, 0, 0, 0, 0, 0, '2020-07-29', 2),
(5, 0, 0, 0, 0, 0, '2020-07-29', 2),
(6, 0, 0, 0, 0, 0, '2020-07-29', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `proses_barang`
--

CREATE TABLE `proses_barang` (
  `id` int(11) NOT NULL,
  `surat_jalan` varchar(128) DEFAULT NULL,
  `supplier` varchar(128) NOT NULL,
  `kodepermintaan` varchar(128) NOT NULL,
  `jumlah_barang` int(11) DEFAULT NULL,
  `tanggal_terima` datetime DEFAULT NULL,
  `status` int(1) NOT NULL,
  `idtoko` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `proses_barang`
--

INSERT INTO `proses_barang` (`id`, `surat_jalan`, `supplier`, `kodepermintaan`, `jumlah_barang`, `tanggal_terima`, `status`, `idtoko`) VALUES
(1, 'SJ0001', 'HD12 - HD Supplier', 'RF0000001', 20, '2020-06-22 01:45:58', 35, 2),
(3, 'SJ202006220001', 'HD12 - HD Supplier', 'RF0000003', 15, '2020-06-22 23:17:28', 35, 2),
(4, 'SJ3217987', 'S6JH - PT Indogrosir 6', 'RF0000004', 5, '2020-07-09 21:10:04', 35, 2),
(5, 'INVSJ0123809', 'S6JH - PT Indogrosir 6', 'RF0000005', 5, '2020-07-14 22:14:26', 35, 2),
(6, 'INV888890098', 'S6JH - PT Indogrosir 6', 'RF0000006', 7, '2020-07-14 23:49:54', 35, 2),
(7, 'INVSJ0012390', 'S6JH - PT Indogrosir 6', 'RF0000008', 8, '2020-07-14 23:52:51', 35, 2),
(8, 'INVS12039812', 'S6JH - PT Indogrosir 6', 'RF0000007', 10, '2020-07-15 00:25:12', 35, 2),
(9, 'SJ12037123', 'S6JH - PT Indogrosir 6', 'RF0000009', 15, '2020-07-16 23:03:42', 35, 2),
(10, 'SJ19283012983', 'S6JH - PT Indogrosir 6', 'RF0000010', 200, '2020-07-16 23:37:36', 35, 3),
(11, 'SJ10298090', 'S6JH - PT Indogrosir 6', 'RF0000011', 100, '2020-07-17 00:10:29', 35, 2),
(12, 'SJ12938018', 'S6JH - PT Indogrosir 6', 'RF0000012', 5, '2020-07-17 01:10:55', 35, 2),
(13, 'SJ120398', 'S6JH - PT Indogrosir 6', 'RF0000013', 210, '2020-07-18 22:07:15', 35, 3),
(14, 'SJ091231', 'HD12 - HD Supplier', 'RF0000015', 100, '2020-07-18 22:39:40', 35, 4),
(15, '019283019823', 'S6JH - PT Indogrosir 6', 'RF0000017', 50, '2020-07-18 22:44:55', 35, 5),
(16, '7878', 'S8J6 - PT Diamond Ice', 'RF0000018', 20, '2020-07-22 23:45:53', 35, 2),
(17, '65465', 'S8J6 - PT Diamond Ice', 'RF0000022', 28, '2020-07-25 22:33:53', 35, 2),
(18, 'AGCAS0912', 'S6JH - PT Indogrosir 6', 'RF0000024', 8, '2020-07-26 01:33:56', 35, 2),
(19, 'ASKJH', 'S6JG - PT Indogrosir 7', 'RF0000028', 10, '2020-07-26 01:29:59', 35, 2),
(20, '98712009', 'HD12 - HD Supplier', 'RF0000027', 10, '2020-07-26 01:31:57', 35, 2),
(21, 'AVSSCA0912', 'S8J6 - PT Diamond Ice', 'RF0000026', 10, '2020-07-26 01:33:37', 35, 2),
(22, 'ASGEUA01928', 'S6JH - PT Indogrosir 6', 'RF0000025', 7, '2020-07-26 01:41:39', 35, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `proses_barang_detail`
--

CREATE TABLE `proses_barang_detail` (
  `id` int(11) NOT NULL,
  `surat_jalan` varchar(128) NOT NULL,
  `prdcd` varchar(128) NOT NULL,
  `harga` int(11) NOT NULL,
  `kategori` int(11) NOT NULL,
  `satuan` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `proses_barang_detail`
--

INSERT INTO `proses_barang_detail` (`id`, `surat_jalan`, `prdcd`, `harga`, `kategori`, `satuan`, `jumlah`, `total`) VALUES
(1, 'SJ0001', '20034422', 20000, 6, 1, 10, 0),
(2, 'SJ0001', '20410023', 30000, 9, 2, 10, 0),
(7, 'SJ202006220001', '20034422', 10000, 6, 1, 5, 0),
(8, 'SJ202006220001', '20410023', 5000, 6, 1, 10, 0),
(9, 'SJ202006220001', '20034422', 20000, 6, 1, 5, 0),
(10, 'SJ3217987', '20034422', 20000, 7, 2, 5, 0),
(16, 'INVSJ0123809', '20034422', 5000, 6, 1, 5, 100000),
(19, 'INV888890098', '20034422', 0, 6, 1, 7, 140000),
(20, 'INVSJ0012390', '20034422', 0, 6, 1, 3, 60000),
(21, 'INVSJ0012390', '20410023', 0, 6, 2, 5, 25000),
(23, 'INVS12039812', '20034422', 500000, 7, 1, 10, 200000),
(24, 'SJ12037123', '20034422', 0, 6, 2, 10, 200000),
(25, 'SJ12037123', '20410023', 0, 7, 1, 5, 25000),
(27, 'SJ19283012983', '20034422', 0, 6, 1, 100, 2000000),
(28, 'SJ19283012983', '20410023', 0, 7, 1, 100, 500000),
(30, 'SJ10298090', '20410072', 0, 6, 1, 100, 2000000),
(31, 'SJ12938018', '20410025', 0, 6, 1, 5, 65000),
(32, 'SJ120398', '20034422', 0, 6, 1, 10, 200000),
(33, 'SJ120398', '20410072', 0, 6, 1, 100, 2000000),
(34, 'SJ120398', '20410025', 0, 6, 1, 100, 1300000),
(35, 'SJ091231', '20034422', 0, 6, 1, 100, 2000000),
(36, '019283019823', '20034422', 0, 6, 1, 10, 200000),
(37, '019283019823', '20410023', 0, 6, 1, 10, 50000),
(38, '019283019823', '20410072', 0, 6, 1, 10, 200000),
(39, '019283019823', '20410025', 0, 6, 1, 10, 130000),
(40, '019283019823', '20410056', 0, 6, 1, 10, 20000),
(41, '7878', '20034422', 0, 0, 0, 10, 200000),
(42, '7878', '20410025', 0, 0, 0, 10, 130000),
(43, '65465', '20034422', 0, 0, 0, 20, 400000),
(44, 'ASKJH', '20410072', 0, 0, 0, 10, 200000),
(45, '98712009', '20410023', 0, 0, 0, 10, 50000),
(46, 'AVSSCA0912', '20034422', 0, 0, 0, 10, 200000),
(47, 'AGCAS0912', '20034422', 0, 0, 0, 8, 160000),
(48, 'ASGEUA01928', '20034422', 0, 0, 0, 7, 140000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `proses_barang_detail_temp`
--

CREATE TABLE `proses_barang_detail_temp` (
  `id` int(11) NOT NULL,
  `surat_jalan` varchar(128) NOT NULL,
  `prdcd` varchar(128) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `retur_barang`
--

CREATE TABLE `retur_barang` (
  `id` int(11) NOT NULL,
  `kode_retur` varchar(128) NOT NULL,
  `tanggal_retur` datetime NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `jumlah_item` int(11) DEFAULT NULL,
  `dibuat_oleh` varchar(128) NOT NULL,
  `idtoko` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `retur_barang`
--

INSERT INTO `retur_barang` (`id`, `kode_retur`, `tanggal_retur`, `supplier_id`, `jumlah_item`, `dibuat_oleh`, `idtoko`) VALUES
(1, 'RET-BMS-000001', '2020-06-23 19:56:52', 1, 10, 'Benny Rahmat', 2),
(2, 'RET-BMS-000002', '2020-06-23 19:57:59', 2, 15, 'Benny Rahmat', 2),
(3, 'RET-BMS-000003', '2020-06-23 20:52:32', 2, 10, 'Benny Rahmat', 2),
(4, 'RET-BMS-000004', '2020-07-10 01:54:11', 1, 12, 'Rizqi Isfahani', 2),
(5, 'RET-BMS-000005', '2020-07-15 23:07:01', 1, 3, 'Rizqi Isfahani', 2),
(6, 'RET-BMS-000006', '2020-07-15 23:12:02', 1, 7, 'Rizqi Isfahani', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `retur_barang_detail`
--

CREATE TABLE `retur_barang_detail` (
  `id` int(11) NOT NULL,
  `retur_id` int(11) NOT NULL,
  `prdcd` varchar(128) NOT NULL,
  `keterangan` text NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `retur_barang_detail`
--

INSERT INTO `retur_barang_detail` (`id`, `retur_id`, `prdcd`, `keterangan`, `jumlah`) VALUES
(1, 1, '20034422', 'TESTING', 10),
(2, 2, '20034422', '', 5),
(3, 2, '20410023', '', 10),
(5, 3, '20034422', '', 10),
(6, 4, '20034422', 'TESTING', 2),
(7, 4, '20410023', 'Rusak', 10),
(8, 5, '20034422', 'Rusak', 2),
(9, 5, '20410023', 'Expired', 1),
(10, 6, '20034422', 'Expired', 5),
(11, 6, '20410023', 'Expired', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `stock`
--

CREATE TABLE `stock` (
  `id` int(11) NOT NULL,
  `prdcd` varchar(8) NOT NULL,
  `deskripsi` varchar(30) NOT NULL,
  `harga` int(11) NOT NULL,
  `kategori` int(11) NOT NULL,
  `satuan` int(11) NOT NULL,
  `jenis` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `stock`
--

INSERT INTO `stock` (`id`, `prdcd`, `deskripsi`, `harga`, `kategori`, `satuan`, `jenis`) VALUES
(2, '20034422', 'Es Batu', 20000, 6, 1, 36),
(3, '20410023', 'Diamond Milk', 5000, 9, 2, 37),
(4, '20410072', 'Oreo Vanilla 137 gr', 20000, 8, 3, 38),
(5, '20410025', 'Cup 16 Oz', 13000, 7, 2, 39),
(6, '20410056', 'Cup 8 Oz', 2000, 6, 1, 39);

-- --------------------------------------------------------

--
-- Struktur dari tabel `stock_toko`
--

CREATE TABLE `stock_toko` (
  `id` int(11) NOT NULL,
  `idtoko` int(11) NOT NULL,
  `idstock` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `stock_toko`
--

INSERT INTO `stock_toko` (`id`, `idtoko`, `idstock`, `jumlah`) VALUES
(1, 2, 2, 77),
(2, 2, 3, 17),
(3, 3, 2, 110),
(4, 3, 3, 100),
(5, 2, 4, 110),
(6, 2, 5, 15),
(7, 3, 4, 100),
(8, 3, 5, 100),
(9, 4, 2, 100),
(10, 5, 2, 10),
(11, 5, 3, 10),
(12, 5, 4, 10),
(13, 5, 5, 10),
(14, 5, 6, 10);

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
  `kategori` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`id`, `supco`, `nama_supplier`, `alamat1`, `alamat2`, `telp1`, `telp2`, `kategori`) VALUES
(1, 'S6JH', 'PT Indogrosir 6', 'Jakarta Pusat', 'Jl A Yani KM 12', '0511232134', '0511255882', 36),
(2, 'HD12', 'HD Supplier', 'Banjarmasin', 'Banjarmasin', '123123', '1123123', 37),
(3, 'S8J6', 'PT Diamond Ice', 'Banjarmasin', 'Banjarmasin', '0811127621', '0811127621', 36),
(4, 'S8J7', 'PT Diamond', 'Banjarmasin', 'Banjarmasin', '123123', '1123123', 39),
(5, 'S6JG', 'PT Indogrosir 7', 'Banjarmasin', 'Banjarmasin', '0811127621', '0811127621', 38);

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
  `ka_toko` varchar(30) NOT NULL,
  `latitude` varchar(128) NOT NULL,
  `longitude` varchar(128) NOT NULL,
  `is_deleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `toko`
--

INSERT INTO `toko` (`id`, `kodetoko`, `nama_toko`, `alamat`, `kota`, `rt`, `rw`, `telp`, `kodepos`, `buka`, `namafrc`, `ka_toko`, `latitude`, `longitude`, `is_deleted`) VALUES
(1, 'OFC0', 'PT. Indomarco Prismatama', 'Jalan A Yani KM 12.2', 'Kab. Banjar', '001', '001', '0511608159', '70712', '2015-05-01', 'PT.Indomarco Prismatama', 'Dika', '', '', 0),
(2, 'TPAJ', 'IDM A YANI KM 33.9', 'Jalan A Yani KM 33.9', 'Banjarbaru', '006', '002', '0811882288', '70723', '2020-06-13', 'PT.Indomarco Prismatama', 'Dika', '-3.442587', '114.826237', 0),
(3, 'TA4W', 'IDM A YANI KM 4', 'Jl. Gerilya No.5, Pemurus Luar', 'Banjarmasin', '001', '001', '0811882288', '70706', '2020-06-01', 'PT.Indomarco Prismatama', 'Riki Pratama', '-3.338527', '114.618411', 0),
(4, 'TWH9', 'IDM MAYJEN SUTOYO', 'Jl. Mayjen Sutoyo S No.455a, Tlk. Dalam', 'Banjarmasin', '001', '001', '0811882288', '70706', '2020-06-14', 'PT.Indomarco Prismatama', 'Ferry Salim', '-3.320886', '114.581001', 0),
(5, 'THXU', 'IDM A YANI KM 19', 'Jalan A Yani KM 19', 'Banjarbaru', '006', '002', '0811882288', '70723', '2020-06-01', 'PT.Indomarco Prismatama', 'Erick', '-3.444335', '114.699383', 0),
(7, 'TE5H', 'A YANI KM 24.7', 'Landasan Ulin', 'Banjarbaru', '006', '002', '0811882288', '70724', '2015-07-20', 'PT.Indomarco Prismatama', 'Dedy Ways', '-3.441983', '114.744696', 0),
(8, 'T4ES', 'IDM YOS SUDARSO PLK', 'Jl. Yos Sudarso', 'Palangkaraya', '006', '002', '0811882288', '70723', '2017-06-13', 'PT.Indomarco Prismatama', 'Ferdinand Napitupulu', '-2.211585', '113.908899', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tutup_harian`
--

CREATE TABLE `tutup_harian` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `total` int(11) NOT NULL,
  `kas` int(11) NOT NULL,
  `pergantian` int(11) NOT NULL,
  `variance` int(11) NOT NULL,
  `ppn` int(11) NOT NULL,
  `jumlah_customer` int(11) NOT NULL,
  `jumlah_item` int(11) NOT NULL,
  `idtoko` int(11) NOT NULL,
  `tanggal_tutup_harian` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tutup_harian`
--

INSERT INTO `tutup_harian` (`id`, `tanggal`, `total`, `kas`, `pergantian`, `variance`, `ppn`, `jumlah_customer`, `jumlah_item`, `idtoko`, `tanggal_tutup_harian`) VALUES
(2, '2020-07-19', 594000, 540000, 54000, 0, 54000, 2, 25, 3, '2020-07-19 23:07:54'),
(3, '2020-07-19', 495000, 431000, 64000, 0, 45000, 3, 21, 2, '2020-07-19 23:42:38');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tutup_shift`
--

CREATE TABLE `tutup_shift` (
  `id` int(11) NOT NULL,
  `nik` varchar(128) NOT NULL,
  `tanggal_tutup_shift` datetime NOT NULL,
  `total` int(11) NOT NULL,
  `kas` int(11) NOT NULL,
  `shift` int(11) NOT NULL,
  `pergantian` int(11) NOT NULL,
  `variance` int(11) NOT NULL,
  `ppn` int(11) NOT NULL,
  `profit` int(11) NOT NULL,
  `jumlah_struk` int(11) NOT NULL,
  `jumlah_item` int(11) NOT NULL,
  `idtoko` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tutup_shift`
--

INSERT INTO `tutup_shift` (`id`, `nik`, `tanggal_tutup_shift`, `total`, `kas`, `shift`, `pergantian`, `variance`, `ppn`, `profit`, `jumlah_struk`, `jumlah_item`, `idtoko`) VALUES
(1, '2013137279', '2020-07-19 22:25:44', 220000, 201000, 1, 41000, 0, 22000, 0, 2, 11, 2),
(2, '2013131313', '2020-07-19 22:27:49', 230000, 230000, 2, 23000, 0, 23000, 0, 1, 10, 2),
(3, '2013131777', '2020-07-19 22:34:33', 230000, 230000, 1, 23000, 0, 23000, 20000, 1, 10, 3),
(4, '2013131777', '2020-07-19 22:40:10', 310000, 310000, 2, 31000, 0, 31000, 35000, 1, 15, 3),
(6, '2013131313', '2020-07-23 03:38:15', 354287, 200000, 1, 189716, 0, 35429, 340980, 4, 1, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `idtoko` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `idtoko`) VALUES
(1, 'admin', '$2y$10$EzGeMY.gkbnxFgZW94drFO6f946a5X0vGXLoXVYz86u3iS.dZPRE2', 1),
(2, 'TPAJ', '$2y$10$Zxnr5ZFT/iKkefEKdYFu3OeeSnjznZSDKHMgyl3iofRneRZHYeWFq', 2),
(3, 'TA4W', '$2y$10$jh8A5XQTSCfUTz1nzqoEPu/Fjb9ovPzNkaeHxEXO31oxMHfzfECQa', 3),
(4, 'TWH9', '$2y$10$CVcJuJDNl37vi15E0KKeI.SWG9Fclls8.z9RpTibXKJdNSMsjyJTm', 4),
(5, 'THXU', '$2y$10$rqZIQgKXWYs2Wvce1rG6s.P/YcO1UCxunvIlrXUHJRt554qwatOpC', 5),
(6, 'TKYD', '$2y$10$i1Qygo4TyIUnThIO1JounOdUYlP6F.EoNpvS4dg6tzbfUxmW5LwSi', 6),
(7, 'TE5H', '$2y$10$mjSuCBEQXJZImvIs/SWJLeE8m7lmkRExY9h2z12P0e4WgpjXaJoFS', 7);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `aktiva`
--
ALTER TABLE `aktiva`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idtoko` (`idtoko`);

--
-- Indeks untuk tabel `barista`
--
ALTER TABLE `barista`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idtoko` (`idtoko`);

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
-- Indeks untuk tabel `kasir_keranjang`
--
ALTER TABLE `kasir_keranjang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indeks untuk tabel `konversi`
--
ALTER TABLE `konversi`
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
-- Indeks untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `penjualan_detail`
--
ALTER TABLE `penjualan_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `penjualan_non_tunai`
--
ALTER TABLE `penjualan_non_tunai`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `permintaan_barang`
--
ALTER TABLE `permintaan_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `permintaan_barang_detail`
--
ALTER TABLE `permintaan_barang_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `profit`
--
ALTER TABLE `profit`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `proses_barang`
--
ALTER TABLE `proses_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `proses_barang_detail`
--
ALTER TABLE `proses_barang_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `proses_barang_detail_temp`
--
ALTER TABLE `proses_barang_detail_temp`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `retur_barang`
--
ALTER TABLE `retur_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `retur_barang_detail`
--
ALTER TABLE `retur_barang_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kategori` (`kategori`),
  ADD KEY `satuan` (`satuan`),
  ADD KEY `jenis` (`jenis`);

--
-- Indeks untuk tabel `stock_toko`
--
ALTER TABLE `stock_toko`
  ADD PRIMARY KEY (`id`);

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
-- Indeks untuk tabel `tutup_harian`
--
ALTER TABLE `tutup_harian`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tutup_shift`
--
ALTER TABLE `tutup_shift`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idtoko` (`idtoko`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `aktiva`
--
ALTER TABLE `aktiva`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `barista`
--
ALTER TABLE `barista`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `initial`
--
ALTER TABLE `initial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `initialog`
--
ALTER TABLE `initialog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `kasir_keranjang`
--
ALTER TABLE `kasir_keranjang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `konversi`
--
ALTER TABLE `konversi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `lookupvalue`
--
ALTER TABLE `lookupvalue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT untuk tabel `member`
--
ALTER TABLE `member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT untuk tabel `penjualan_detail`
--
ALTER TABLE `penjualan_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `penjualan_non_tunai`
--
ALTER TABLE `penjualan_non_tunai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `permintaan_barang`
--
ALTER TABLE `permintaan_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `permintaan_barang_detail`
--
ALTER TABLE `permintaan_barang_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT untuk tabel `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `profit`
--
ALTER TABLE `profit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `proses_barang`
--
ALTER TABLE `proses_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `proses_barang_detail`
--
ALTER TABLE `proses_barang_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT untuk tabel `proses_barang_detail_temp`
--
ALTER TABLE `proses_barang_detail_temp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `retur_barang`
--
ALTER TABLE `retur_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `retur_barang_detail`
--
ALTER TABLE `retur_barang_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `stock_toko`
--
ALTER TABLE `stock_toko`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `toko`
--
ALTER TABLE `toko`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tutup_harian`
--
ALTER TABLE `tutup_harian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tutup_shift`
--
ALTER TABLE `tutup_shift`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
