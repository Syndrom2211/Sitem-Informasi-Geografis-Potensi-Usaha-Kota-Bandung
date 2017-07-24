-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 24, 2017 at 07:25 AM
-- Server version: 5.6.35
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `firdamda_dinas_usaha`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun_dinas`
--

CREATE TABLE `akun_dinas` (
  `id_akun` int(11) NOT NULL,
  `nip` varchar(255) NOT NULL,
  `password` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akun_dinas`
--

INSERT INTO `akun_dinas` (`id_akun`, `nip`, `password`) VALUES
(1, '196202061987031013', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `akun_pengusaha`
--

CREATE TABLE `akun_pengusaha` (
  `no_ktp` varchar(16) NOT NULL,
  `nama_pengusaha` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(35) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `tempat_lahir` varchar(30) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `foto_ktp` varchar(255) NOT NULL,
  `status_akun` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `data_history`
--

CREATE TABLE `data_history` (
  `id_history` int(5) NOT NULL,
  `id_usaha` int(5) DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  `tgl` date NOT NULL,
  `waktu` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `data_kecamatan`
--

CREATE TABLE `data_kecamatan` (
  `id_kecamatan` int(5) NOT NULL,
  `kecamatan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_kecamatan`
--

INSERT INTO `data_kecamatan` (`id_kecamatan`, `kecamatan`) VALUES
(1, 'Andir'),
(2, 'Antapani'),
(3, 'Arcamanik'),
(4, 'Astanaanyar'),
(5, 'Babakanciparay'),
(6, 'Bandung Kidul'),
(7, 'Bandung Kulon'),
(8, 'Bandung Wetan'),
(9, 'Batununggal'),
(10, 'Bojongloa Kaler'),
(11, 'Bojongloa Kidul'),
(12, 'Buahbatu'),
(13, 'Cibeunying Kaler'),
(14, 'Cibeunying Kidul'),
(15, 'Cibiru'),
(16, 'Cicendo'),
(17, 'Cidadap'),
(18, 'Cinambo'),
(19, 'Coblong'),
(20, 'Gedebage'),
(21, 'Kiaracondong'),
(22, 'Lengkong'),
(23, 'Mandalajati'),
(24, 'Panyileukan'),
(25, 'Rancasari'),
(26, 'Regol'),
(27, 'Sukajadi'),
(28, 'Sukasari'),
(29, 'Sumurbandung'),
(30, 'Ujungberung');

-- --------------------------------------------------------

--
-- Table structure for table `data_kelurahan`
--

CREATE TABLE `data_kelurahan` (
  `id_kelurahan` int(5) NOT NULL,
  `kelurahan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_kelurahan`
--

INSERT INTO `data_kelurahan` (`id_kelurahan`, `kelurahan`) VALUES
(1, 'Campaka'),
(2, 'Ciroyom'),
(3, 'Dunguscariang'),
(4, 'Garuda'),
(5, 'Kebonjeruk'),
(6, 'Maleber'),
(7, 'Antapani Kidul'),
(8, 'Antapani Kulon'),
(9, 'Antapani Tengah'),
(10, 'Antapani Wetan'),
(11, 'Cisaranten Endah'),
(12, 'CIsaranten Kulon'),
(13, 'Cisaranten Bina Harapan'),
(14, 'Sukamiskin'),
(15, 'Cibadak'),
(16, 'Karanganyar'),
(17, 'Karasak'),
(18, 'Nyengseret'),
(19, 'Panjunan'),
(20, 'Pelindunghewan'),
(21, 'Babakan'),
(22, 'Babakanciparay'),
(23, 'Cirangrang'),
(24, 'Margahayu Utara'),
(25, 'Margasuka'),
(26, 'Sukahaji'),
(27, 'Batununggal'),
(28, 'Kujangsari'),
(29, 'Mengger'),
(30, 'Wates'),
(31, 'Caringin'),
(32, 'Cibuntu'),
(33, 'Cigondewah'),
(34, 'Cigondewah Kidul'),
(35, 'Cigondewah Rahayu'),
(36, 'Cijerah'),
(37, 'Gempolsari'),
(38, 'Warungmuncang'),
(39, 'Cihapit'),
(40, 'Citarum'),
(41, 'Tamansari'),
(42, 'Binong'),
(43, 'Cibangkong'),
(44, 'Gumuruh'),
(45, 'Kacapiring'),
(46, 'Kebongedang'),
(47, 'Kebonwaru'),
(48, 'Meleer'),
(49, 'Samoja'),
(50, 'Babakan Asih'),
(51, 'Babakan Tarogong'),
(52, 'Jamika'),
(53, 'Kopo'),
(54, 'Suka Asih'),
(55, 'CIbaduyut'),
(56, 'Cibaduyut Kidul'),
(57, 'Cibaduyut Wetan'),
(58, 'Kebon Lega'),
(59, 'Mekarwangi'),
(60, 'Situsaeur'),
(61, 'Cijawura'),
(62, 'Jatisari'),
(63, 'Margasari'),
(64, 'Sekejati'),
(65, 'Cigadung'),
(66, 'Cihaurgeulis'),
(67, 'Neglasari'),
(68, 'Sukaluyu'),
(69, 'Cicadas'),
(70, 'Cikutra'),
(71, 'Padasuka'),
(72, 'Pasirlayung'),
(73, 'Sukamaju'),
(74, 'Sukapada'),
(75, 'Cipadung'),
(76, 'Cisurupan'),
(77, 'Palasari'),
(78, 'Pasirbiru'),
(79, 'Arjuna'),
(80, 'Husen Sastranegara'),
(81, 'Pajajaran'),
(82, 'Pamoyanan'),
(83, 'Pasirkaliki'),
(84, 'Sukaraja'),
(85, 'Ciumbuleuit'),
(86, 'Hegarmanah'),
(87, 'Ledeng'),
(88, 'Babakan Penghulu'),
(89, 'Cisaranten Wetan'),
(90, 'Pakemitan'),
(91, 'Sukamulya'),
(92, 'Cipaganti'),
(93, 'Dago'),
(94, 'Lebakgede'),
(95, 'Lebaksiliwangi'),
(96, 'Sadangserang'),
(97, 'Sekeloa'),
(98, 'Cimincrang'),
(99, 'Cisaranten'),
(100, 'Rancabolang'),
(101, 'Rancanumpang'),
(102, 'Babakansari'),
(103, 'Babakansurabaya'),
(104, 'Cicaheum'),
(105, 'Kebonkangkung'),
(106, 'Kebunjayanti'),
(107, 'Sukapura'),
(108, 'Burangrang'),
(109, 'Cijagra'),
(110, 'Cikawao'),
(111, 'Lingkar Selatan'),
(112, 'Malabar'),
(113, 'Paledang'),
(114, 'Turangga'),
(115, 'Jatihandap'),
(116, 'Karangpamulang'),
(117, 'Pasir Impun'),
(118, 'Sindangjaya'),
(119, 'Cipadung Kidul'),
(120, 'Cipadung Kulon'),
(121, 'Cipadung Wetan'),
(122, 'Mekarmulya'),
(123, 'Cipamokolan'),
(124, 'Darwati'),
(125, 'Manjahlega'),
(126, 'Mekarmulya'),
(127, 'Ancol'),
(128, 'Balonggede'),
(129, 'Ciateul'),
(130, 'Cigereleng'),
(131, 'Ciseureuh'),
(132, 'Pasirluyu'),
(133, 'Pungkur'),
(134, 'Cipedes'),
(135, 'Pasteur'),
(136, 'Sukabungah'),
(137, 'Sukagalih'),
(138, 'Sukawarna'),
(139, 'Gegerkalong'),
(140, 'Isola'),
(141, 'Sarijadi'),
(142, 'Sukarasa'),
(143, 'Babakanciamis'),
(144, 'Braga'),
(145, 'Kebonpisang'),
(146, 'Merdeka'),
(147, 'Cigending'),
(148, 'Pasanggrahan'),
(149, 'Pasirendah'),
(150, 'Pasirjati'),
(151, 'Pasirwangi'),
(152, 'Ujungberung');

-- --------------------------------------------------------

--
-- Table structure for table `data_konfirmasi_lupas`
--

CREATE TABLE `data_konfirmasi_lupas` (
  `id_konfirmasi` int(5) NOT NULL,
  `email` varchar(255) NOT NULL,
  `kode` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `data_sektorusaha`
--

CREATE TABLE `data_sektorusaha` (
  `id_sektor` int(5) NOT NULL,
  `sektor_usaha` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_sektorusaha`
--

INSERT INTO `data_sektorusaha` (`id_sektor`, `sektor_usaha`) VALUES
(1, 'Periklanan'),
(2, 'Arsitektur'),
(3, 'Pasar Barang Seni'),
(4, 'Kerajinan'),
(5, 'Desain'),
(6, 'Fashion'),
(7, 'Video'),
(8, 'Film dan Fotografi'),
(9, 'Permainan Interaktif'),
(10, 'Musik'),
(11, 'Seni Pertunjukan'),
(12, 'Penerbitan dan Percetakan'),
(13, 'Layanan Komputer dan Piranti Lunak'),
(14, 'Televisi dan Radio'),
(15, 'Riset dan Pengembangan'),
(16, 'Kuliner');

-- --------------------------------------------------------

--
-- Table structure for table `data_skalausaha`
--

CREATE TABLE `data_skalausaha` (
  `id_skala` int(5) NOT NULL,
  `skala_usaha` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_skalausaha`
--

INSERT INTO `data_skalausaha` (`id_skala`, `skala_usaha`) VALUES
(1, 'Mikro'),
(2, 'Kecil'),
(3, 'Menengah');

-- --------------------------------------------------------

--
-- Table structure for table `data_usaha`
--

CREATE TABLE `data_usaha` (
  `id_usaha` int(11) NOT NULL,
  `no_ktp` varchar(16) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `produk` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `kelurahan` varchar(20) NOT NULL,
  `kecamatan` varchar(20) NOT NULL,
  `no_telp` varchar(13) NOT NULL,
  `longitude_lokasi` text NOT NULL,
  `latitude_lokasi` text NOT NULL,
  `skala` varchar(50) NOT NULL,
  `sektor` varchar(50) NOT NULL,
  `foto_satu` text,
  `foto_dua` text,
  `foto_tiga` text,
  `foto_empat` text,
  `foto_lima` text,
  `status_usaha` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `data_wilayah`
--

CREATE TABLE `data_wilayah` (
  `id_wilayah` int(5) NOT NULL,
  `id_kecamatan` int(5) DEFAULT NULL,
  `id_kelurahan` int(5) DEFAULT NULL,
  `kota` varchar(50) NOT NULL,
  `kode_pos` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_wilayah`
--

INSERT INTO `data_wilayah` (`id_wilayah`, `id_kecamatan`, `id_kelurahan`, `kota`, `kode_pos`) VALUES
(30, 1, 1, 'Bandung', '40184'),
(31, 1, 2, 'Bandung', '40182'),
(32, 1, 3, 'Bandung', '40183'),
(33, 1, 4, 'Bandung', '40184'),
(34, 1, 5, 'Bandung', '40181'),
(35, 1, 6, 'Bandung', '40184'),
(36, 2, 7, 'Bandung', '40291'),
(37, 2, 8, 'Bandung', '40291'),
(38, 2, 9, 'Bandung', '40291'),
(39, 2, 10, 'Bandung', '40291'),
(40, 3, 11, 'Bandung', '40293'),
(41, 3, 12, 'Bandung', '40293'),
(42, 3, 13, 'Bandung', '40294'),
(43, 3, 14, 'Bandung', '40293'),
(44, 4, 15, 'Bandung', '40241'),
(45, 4, 16, 'Bandung', '40241'),
(46, 4, 17, 'Bandung', '40243'),
(47, 4, 18, 'Bandung', '40242'),
(48, 4, 19, 'Bandung', '40242'),
(49, 4, 20, 'Bandung', '40243'),
(50, 5, 21, 'Bandung', '40222'),
(51, 5, 22, 'Bandung', '40223'),
(52, 5, 23, 'Bandung', '40227'),
(53, 5, 24, 'Bandung', '40224'),
(54, 5, 25, 'Bandung', '40225'),
(55, 5, 26, 'Bandung', '40221'),
(56, 6, 27, 'Bandung', '40266'),
(57, 6, 28, 'Bandung', '40287'),
(58, 6, 29, 'Bandung', '40267'),
(59, 6, 30, 'Bandung', '40256'),
(60, 7, 31, 'Bandung', '40212'),
(61, 7, 32, 'Bandung', '40212'),
(62, 7, 33, 'Bandung', '40214'),
(63, 7, 34, 'Bandung', '40214'),
(64, 7, 35, 'Bandung', '40215'),
(65, 7, 36, 'Bandung', '40213'),
(66, 7, 37, 'Bandung', '40215'),
(67, 7, 38, 'Bandung', '40211'),
(68, 8, 39, 'Bandung', '40114'),
(69, 8, 41, 'Bandung', '40116'),
(70, 9, 42, 'Bandung', '40275'),
(71, 9, 43, 'Bandung', '40273'),
(72, 9, 44, 'Bandung', '40275'),
(73, 9, 45, 'Bandung', '40271'),
(74, 9, 46, 'Bandung', '40274'),
(75, 9, 47, 'Bandung', '40272'),
(76, 9, 48, 'Bandung', '40274'),
(77, 9, 49, 'Bandung', '40273'),
(78, 10, 50, 'Bandung', '40232'),
(79, 10, 51, 'Bandung', '40232'),
(80, 10, 52, 'Bandung', '40231'),
(81, 10, 53, 'Bandung', '40233'),
(82, 10, 54, 'Bandung', '40231'),
(83, 11, 55, 'Bandung', '40236'),
(84, 11, 56, 'Bandung', '40239'),
(85, 11, 57, 'Bandung', '40238'),
(86, 11, 58, 'Bandung', '40235'),
(87, 11, 59, 'Bandung', '40237'),
(88, 11, 60, 'Bandung', '40237'),
(89, 12, 61, 'Bandung', '40287'),
(90, 12, 62, 'Bandung', '40286'),
(91, 12, 63, 'Bandung', '40286'),
(92, 12, 64, 'Bandung', '40287'),
(93, 13, 65, 'Bandung', '40191'),
(94, 13, 66, 'Bandung', '40122'),
(95, 13, 67, 'Bandung', '40124'),
(96, 13, 68, 'Bandung', '40123'),
(97, 14, 69, 'Bandung', '40121'),
(98, 14, 70, 'Bandung', '40124'),
(99, 14, 71, 'Bandung', '40125'),
(100, 14, 72, 'Bandung', '40192'),
(101, 14, 73, 'Bandung', '40121'),
(102, 14, 74, 'Bandung', '40125'),
(103, 15, 75, 'Bandung', '40614'),
(104, 15, 76, 'Bandung', '40614'),
(105, 15, 77, 'Bandung', '40615'),
(106, 15, 78, 'Bandung', '40615'),
(107, 16, 79, 'Bandung', '40172'),
(108, 16, 80, 'Bandung', '40174'),
(109, 16, 81, 'Bandung', '40173'),
(110, 16, 82, 'Bandung', '40173'),
(111, 16, 83, 'Bandung', '40171'),
(112, 17, 85, 'Bandung', '40142'),
(113, 17, 86, 'Bandung', '40141'),
(114, 17, 87, 'Bandung', '40143'),
(115, 18, 88, 'Bandung', '40294'),
(116, 18, 89, 'Bandung', '40294'),
(117, 18, 90, 'Bandung', '40294'),
(118, 18, 91, 'Bandung', '40294'),
(119, 19, 92, 'Bandung', '40131'),
(120, 19, 93, 'Bandung', '40135'),
(121, 19, 94, 'Bandung', '40132'),
(122, 19, 95, 'Bandung', '40132'),
(123, 19, 96, 'Bandung', '40133'),
(124, 19, 97, 'Bandung', '40134'),
(125, 20, 98, 'Bandung', '40294'),
(126, 20, 99, 'Bandung', '40294'),
(127, 20, 100, 'Bandung', '40294'),
(128, 20, 101, 'Bandung', '40294'),
(129, 21, 102, 'Bandung', '40283'),
(130, 21, 103, 'Bandung', '40281'),
(131, 21, 104, 'Bandung', '40282'),
(132, 21, 105, 'Bandung', '40283'),
(133, 21, 106, 'Bandung', '40281'),
(134, 21, 107, 'Bandung', '40285'),
(135, 22, 108, 'Bandung', '40262'),
(136, 22, 109, 'Bandung', '40265'),
(137, 22, 110, 'Bandung', '40261'),
(138, 22, 111, 'Bandung', '40263'),
(139, 22, 112, 'Bandung', '40262'),
(140, 22, 113, 'Bandung', '40264'),
(141, 22, 114, 'Bandung', '40264'),
(142, 23, 115, 'Bandung', '40195'),
(143, 23, 116, 'Bandung', '40195'),
(144, 23, 117, 'Bandung', '40195'),
(145, 23, 118, 'Bandung', '40195'),
(146, 24, 119, 'Bandung', '40614'),
(147, 24, 120, 'Bandung', '40614'),
(148, 24, 121, 'Bandung', '40614'),
(149, 24, 122, 'Bandung', '40614'),
(150, 25, 123, 'Bandung', '40292'),
(151, 25, 124, 'Bandung', '40292'),
(152, 25, 125, 'Bandung', '402925'),
(153, 25, 122, 'Bandung', '40292'),
(154, 26, 127, 'Bandung', '40254'),
(155, 26, 128, 'Bandung', '40251'),
(156, 26, 129, 'Bandung', '40252'),
(157, 26, 130, 'Bandung', '40253'),
(158, 26, 131, 'Bandung', '40255'),
(159, 26, 132, 'Bandung', '40254'),
(160, 26, 133, 'Bandung', '40252'),
(161, 27, 134, 'Bandung', '40162'),
(162, 27, 135, 'Bandung', '40161'),
(163, 27, 136, 'Bandung', '40162'),
(164, 27, 137, 'Bandung', '40163'),
(165, 27, 138, 'Bandung', '40164'),
(166, 28, 139, 'Bandung', '40153'),
(167, 28, 140, 'Bandung', '40154'),
(168, 28, 141, 'Bandung', '40151'),
(169, 28, 142, 'Bandung', '40152'),
(170, 29, 143, 'Bandung', '40117'),
(171, 29, 144, 'Bandung', '40111'),
(172, 29, 145, 'Bandung', '40112'),
(173, 29, 146, 'Bandung', '40113'),
(174, 30, 147, 'Bandung', '40611'),
(175, 30, 148, 'Bandung', '40617'),
(176, 30, 149, 'Bandung', '40619'),
(177, 30, 150, 'Bandung', '40616'),
(178, 30, 151, 'Bandung', '40618'),
(179, 30, 152, 'Bandung', '40611');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun_dinas`
--
ALTER TABLE `akun_dinas`
  ADD PRIMARY KEY (`id_akun`);

--
-- Indexes for table `akun_pengusaha`
--
ALTER TABLE `akun_pengusaha`
  ADD PRIMARY KEY (`no_ktp`);

--
-- Indexes for table `data_history`
--
ALTER TABLE `data_history`
  ADD PRIMARY KEY (`id_history`),
  ADD KEY `id_usaha` (`id_usaha`);

--
-- Indexes for table `data_kecamatan`
--
ALTER TABLE `data_kecamatan`
  ADD PRIMARY KEY (`id_kecamatan`);

--
-- Indexes for table `data_kelurahan`
--
ALTER TABLE `data_kelurahan`
  ADD PRIMARY KEY (`id_kelurahan`);

--
-- Indexes for table `data_konfirmasi_lupas`
--
ALTER TABLE `data_konfirmasi_lupas`
  ADD PRIMARY KEY (`id_konfirmasi`);

--
-- Indexes for table `data_sektorusaha`
--
ALTER TABLE `data_sektorusaha`
  ADD PRIMARY KEY (`id_sektor`);

--
-- Indexes for table `data_skalausaha`
--
ALTER TABLE `data_skalausaha`
  ADD PRIMARY KEY (`id_skala`);

--
-- Indexes for table `data_usaha`
--
ALTER TABLE `data_usaha`
  ADD PRIMARY KEY (`id_usaha`),
  ADD KEY `FK_pengusaha` (`no_ktp`);

--
-- Indexes for table `data_wilayah`
--
ALTER TABLE `data_wilayah`
  ADD PRIMARY KEY (`id_wilayah`),
  ADD KEY `FK_kelurahan` (`id_kelurahan`),
  ADD KEY `id_kecamatan` (`id_kecamatan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akun_dinas`
--
ALTER TABLE `akun_dinas`
  MODIFY `id_akun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `data_history`
--
ALTER TABLE `data_history`
  MODIFY `id_history` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `data_kecamatan`
--
ALTER TABLE `data_kecamatan`
  MODIFY `id_kecamatan` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `data_kelurahan`
--
ALTER TABLE `data_kelurahan`
  MODIFY `id_kelurahan` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;
--
-- AUTO_INCREMENT for table `data_konfirmasi_lupas`
--
ALTER TABLE `data_konfirmasi_lupas`
  MODIFY `id_konfirmasi` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `data_sektorusaha`
--
ALTER TABLE `data_sektorusaha`
  MODIFY `id_sektor` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `data_skalausaha`
--
ALTER TABLE `data_skalausaha`
  MODIFY `id_skala` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `data_wilayah`
--
ALTER TABLE `data_wilayah`
  MODIFY `id_wilayah` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=180;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `data_history`
--
ALTER TABLE `data_history`
  ADD CONSTRAINT `FK_id_usaha<datausaha` FOREIGN KEY (`id_usaha`) REFERENCES `data_usaha` (`id_usaha`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `data_usaha`
--
ALTER TABLE `data_usaha`
  ADD CONSTRAINT `FK_pengusaha` FOREIGN KEY (`no_ktp`) REFERENCES `akun_pengusaha` (`no_ktp`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `data_wilayah`
--
ALTER TABLE `data_wilayah`
  ADD CONSTRAINT `FK_IDKecamatan` FOREIGN KEY (`id_kecamatan`) REFERENCES `data_kecamatan` (`id_kecamatan`),
  ADD CONSTRAINT `FK_Kelurahan` FOREIGN KEY (`id_kelurahan`) REFERENCES `data_kelurahan` (`id_kelurahan`) ON DELETE SET NULL ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
