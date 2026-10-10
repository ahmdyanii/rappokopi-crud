-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 10, 2026 at 08:39 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rappokopi`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', '0192023a7bbd73250516f069df18b500');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `harga` int(11) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `nama`, `kategori`, `harga`, `foto`, `deskripsi`) VALUES
(1, 'Rappokopi Aren', 'Kopi', 13000, 'images/Rappokopi Aren.png', 'Kopi susu dengan gula aren khas Rappokopi.'),
(2, 'Butterscotch Aren', 'Kopi', 18000, 'images/Butterscotch Aren.png', 'Paduan kopi aren dengan manisnya butterscotch.'),
(3, 'Pandan Aren', 'Kopi', 18000, 'images/Pandan Aren.png', 'Kopi aren dengan aroma pandan yang wangi.'),
(4, 'Hazelnut Aren', 'Kopi', 18000, 'images/Hazelnut Aren.png', 'Kopi susu aren dengan rasa hazelnut.'),
(5, 'Caramel Aren', 'Kopi', 18000, 'images/Caramel Aren.png', 'Kopi susu aren dengan sirup karamel.'),
(6, 'Ice Kopi Susu', 'Kopi', 20000, 'images/Ice Kopi Susu.png', 'Es kopi susu segar untuk menemani harimu.'),
(7, 'Ice Kopi Pandan', 'Kopi', 20000, 'images/Ice Kopi Pandan.png', 'Es kopi susu dengan kesegaran pandan.'),
(8, 'Hot Kopi Susu', 'Kopi', 16000, 'images/Hot Kopi Susu.png', 'Kopi susu panas yang menenangkan.'),
(9, 'Pink Boy', 'Nonkopi', 18000, 'images/Pink Boy.png', 'Minuman segar non-kopi andalan kami.'),
(10, 'Yoghurt Mango', 'Nonkopi', 18000, 'images/Yoghurt Mango.png', 'Kesegaran yoghurt berpadu dengan rasa mangga.'),
(11, 'Yoghurt Lecy', 'Nonkopi', 18000, 'images/Yoghurt Lecy.png', 'Yoghurt manis asam dengan kesegaran leci.'),
(12, 'Ice Chocolate', 'Nonkopi', 18000, 'images/Ice Chocolate.png', 'Minuman cokelat dingin yang manis dan pekat.'),
(13, 'Ice Greentea', 'Nonkopi', 18000, 'images/Ice Greentea.png', 'Es teh hijau manis yang menyegarkan.'),
(14, 'Ice Thaitea', 'Nonkopi', 18000, 'images/Ice Thaitea.png', 'Es teh khas Thailand dengan perpaduan susu pekat.'),
(15, 'Ice Lemon Tea', 'Nonkopi', 15000, 'images/Ice Lemon Tea.png', 'Es teh dengan perasan lemon murni yang segar.'),
(16, 'Hot Chocolate', 'Nonkopi', 16000, 'images/Hot Chocolate.png', 'Cokelat panas yang lembut dan menghangatkan.'),
(17, 'Hot Lemon Tea', 'Nonkopi', 16000, 'images/Hot Lemon Tea.png', 'Teh lemon hangat yang melegakan.'),
(18, 'Creamy Aren', 'Kopi', 18000, 'images/Creamy Aren.png', 'Kopi susu ekstra creamy dengan sentuhan aren.'),
(19, 'Coffee Creamy', 'Kopi', 20000, 'images/Coffee Creamy.png', 'Kopi dengan tekstur ekstra creamy yang lembut.'),
(20, 'Butterscotch Sea Salt', 'Kopi', 22000, 'images/Butterscotch Sea Salt.png', 'Paduan manis butterscotch dan gurihnya sea salt.'),
(21, 'Coffee Creamy Pistachio', 'Kopi', 20000, 'images/Coffee Creamy Pistachio.png', 'Kopi creamy dengan cita rasa kacang pistachio.'),
(22, 'Coffee Creamy Hazelnut', 'Kopi', 20000, 'images/Coffee Creamy Hazelnut.png', 'Kopi creamy dengan paduan sirup hazelnut.'),
(23, 'Coffee Creamy Caramel', 'Kopi', 20000, 'images/Coffee Creamy Caramel.png', 'Kopi creamy dengan manisnya karamel.'),
(24, 'Americano Signature', 'Kopi', 18000, 'images/Americano Signature.png', 'Kopi hitam khas Rappokopi yang berkarakter.'),
(25, 'Berry Cano', 'Kopi', 25000, 'images/Berry Cano.png', 'Kopi hitam segar dengan sentuhan rasa buah beri.'),
(26, 'Black Peach', 'Kopi', 25000, 'images/Black Peach.png', 'Kopi hitam dengan paduan rasa peach yang unik.'),
(27, 'Black Sunrise', 'Kopi', 25000, 'images/Black Sunrise.png', 'Kopi hitam segar untuk mengawali harimu.'),
(28, 'Hot Americano', 'Kopi', 16000, 'images/Hot Americano.png', 'Kopi hitam panas yang klasik dan nikmat.'),
(29, 'Matcha Latte', 'Nonkopi', 20000, 'images/Matcha Latte.png', 'Rasa matcha pekat dengan susu yang lembut.'),
(30, 'Strawberry Matcha', 'Nonkopi', 25000, 'images/Strawberry Matcha.png', 'Perpaduan unik matcha dengan manisnya stroberi.'),
(31, 'Butterscotch Matcha', 'Nonkopi', 25000, 'images/Butterscotch Matcha.png', 'Matcha yang disajikan dengan butterscotch.');

-- --------------------------------------------------------

--
-- Table structure for table `promo`
--

CREATE TABLE `promo` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `ketentuan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `promo`
--

INSERT INTO `promo` (`id`, `nama`, `harga`, `foto`, `deskripsi`, `ketentuan`) VALUES
(1, 'Sebotol Gembira (1 Botol)', 85000, 'images/Sebotol Gembira.png', 'Satu botol ukuran literan untuk stok kesegaranmu di rumah.', 'Berlaku periode 7–31 September 2026.'),
(2, 'Sebotol Gembira (2 Botol)', 150000, 'images/Sebotol Gembira2.png', 'Dua botol ukuran literan, lebih hemat dan seru untuk dinikmati bersama.', 'Berlaku periode 7–31 September 2026.'),
(3, 'Stengah Liter / Semini', 50000, 'images/Sebotol Gembira3.png', 'Tersedia juga ukuran Stengah Liter (50K) dan Semini (25K) dengan harga normal.', 'Harga normal di luar promo Sebotol Gembira.'),
(4, 'Paket Cheerful 1', 30000, 'images/Paket Cheerful 1.png', 'Paket seru berisi 2 pilihan minuman nikmat untuk menemani harimu.', 'Berlaku untuk varian tertentu.'),
(5, 'Paket Cheerful 2', 40000, 'images/Paket Cheerful 2.png', 'Paket spesial berisi 2 varian minuman favorit pilihan.', 'Berlaku untuk varian tertentu.'),
(6, 'Paket Cheerful 3', 30000, 'images/Paket Cheerful 3.png', 'Nikmati kombinasi 2 gelas minuman lezat dengan harga lebih hemat.', 'Berlaku untuk varian tertentu.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promo`
--
ALTER TABLE `promo`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `promo`
--
ALTER TABLE `promo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
