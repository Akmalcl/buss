-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Dec 17, 2022 at 11:59 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `database`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id` int(11) NOT NULL,
  `persen_sell` int(11) NOT NULL,
  `persen_res` int(11) NOT NULL,
  `satuan` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`id`, `persen_sell`, `persen_res`, `satuan`) VALUES
(1, 5, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_backup`
--

CREATE TABLE `tb_backup` (
  `id` int(11) NOT NULL,
  `file_name` text NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_balance`
--

CREATE TABLE `tb_balance` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  `pending` int(11) NOT NULL,
  `payout` int(11) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_balance`
--

INSERT INTO `tb_balance` (`id`, `userID`, `active`, `pending`, `payout`, `created_date`) VALUES
(1, 1, 0, 0, 0, '2022-12-14 23:59:55');

-- --------------------------------------------------------

--
-- Table structure for table `tb_bank`
--

CREATE TABLE `tb_bank` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `akun` text NOT NULL,
  `pemilik` text NOT NULL,
  `no_rek` text NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_banner`
--

CREATE TABLE `tb_banner` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `status` int(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_banner`
--

INSERT INTO `tb_banner` (`id`, `image`, `content`, `status`) VALUES
(1, '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_banner`
--

CREATE TABLE `tb_banners` (
  `id` int(11) NOT NULL,
  `catID` int(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `status` int(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_jenis`
--

CREATE TABLE `tb_jenis` (
  `id` int(11) NOT NULL,
  `jenis` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_jenis`
--

INSERT INTO `tb_jenis` (`id`, `jenis`, `image`, `status`) VALUES
(1, 'Game', 'fas fa-gamepad', 1),
(2, 'Pulsa', 'fas fa-mobile-alt', 1),
(3, 'Emoney', 'fab fa-google-wallet', 1),
(4, 'Social', 'fas fa-share-nodes', 1),
(5, 'Premium', 'fas fa-shopping-bag', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori`
--

CREATE TABLE `tb_kategori` (
  `id` int(11) NOT NULL,
  `slug` text NOT NULL,
  `kategori` text NOT NULL,
  `cekID` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `parent` int(11) NOT NULL DEFAULT 0,
  `deskripsi` text NOT NULL,
  `bantuan` text NOT NULL,
  `subtitle` text NOT NULL,
  `created_date` date NOT NULL,
  `user` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kategori`
--

INSERT INTO `tb_kategori` (`id`, `slug`, `kategori`, `cekID`, `image`, `parent`, `deskripsi`, `bantuan`, `subtitle`, `created_date`, `user`, `status`) VALUES
(1, 'apexlegendsmobile', 'Apex Legends Mobile', '', 'apex_legends_mobile.png', 1, '<ol style=\"margin-left: -25px;\">\r\n                <li>Masukan UserID dan Zone / Server ID</li>\r\n                <li>Pilih Layanan Yang Diinginkan</li>\r\n                <li>Pilih Metode Pembayaran</li>\r\n                <li>Masukan No. Whatsapp Anda agar mendapapat notifikasi</li>\r\n                <li>Klik Beli Sekarang dan Selesaikan Pembayaran</li>\r\n                <li>Tunggu Proses 1-2 Menit (event max 2jam) , Pesanan Anda akan Masuk Secara Otomatis</li>\r\n              </ol>', '', '', '0000-00-00', 'master', 0),
(2, 'arenaofvalor', 'Arena Of Valor', 'arena-of-valor', 'arena_of_valor.png', 1, '<ol style=\"margin-left: -25px;\">\r\n                <li>Masukan UserID dan Zone / Server ID</li>\r\n                <li>Pilih Layanan Yang Diinginkan</li>\r\n                <li>Pilih Metode Pembayaran</li>\r\n                <li>Masukan No. Whatsapp Anda agar mendapapat notifikasi</li>\r\n                <li>Klik Beli Sekarang dan Selesaikan Pembayaran</li>\r\n                <li>Tunggu Proses 1-2 Menit (event max 2jam) , Pesanan Anda akan Masuk Secara Otomatis</li>\r\n              </ol>', '', '', '0000-00-00', 'master', 1),
(3, 'au2mobile', 'AU2 MOBILE', '', 'au2_mobile.png', 1, '<ol style=\"margin-left: -25px;\">\r\n                <li>Masukan UserID dan Zone / Server ID</li>\r\n                <li>Pilih Layanan Yang Diinginkan</li>\r\n                <li>Pilih Metode Pembayaran</li>\r\n                <li>Masukan No. Whatsapp Anda agar mendapapat notifikasi</li>\r\n                <li>Klik Beli Sekarang dan Selesaikan Pembayaran</li>\r\n                <li>Tunggu Proses 1-2 Menit (event max 2jam) , Pesanan Anda akan Masuk Secara Otomatis</li>\r\n              </ol>', '', '', '0000-00-00', 'master', 1),
(4, 'betheking', 'Be The King', '', 'be_the_king.png', 1, '<ol style=\"margin-left: -25px;\">\r\n                <li>Masukan UserID dan Zone / Server ID</li>\r\n                <li>Pilih Layanan Yang Diinginkan</li>\r\n                <li>Pilih Metode Pembayaran</li>\r\n                <li>Masukan No. Whatsapp Anda agar mendapapat notifikasi</li>\r\n                <li>Klik Beli Sekarang dan Selesaikan Pembayaran</li>\r\n                <li>Tunggu Proses 1-2 Menit (event max 2jam) , Pesanan Anda akan Masuk Secara Otomatis</li>\r\n              </ol>', '', '', '0000-00-00', 'master', 1),
(5, 'chimeraland', 'Chimeraland', '', 'chimeraland.png', 1, '<ol style=\"margin-left: -25px;\">\r\n                <li>Masukan UserID dan Zone / Server ID</li>\r\n                <li>Pilih Layanan Yang Diinginkan</li>\r\n                <li>Pilih Metode Pembayaran</li>\r\n                <li>Masukan No. Whatsapp Anda agar mendapapat notifikasi</li>\r\n                <li>Klik Beli Sekarang dan Selesaikan Pembayaran</li>\r\n                <li>Tunggu Proses 1-2 Menit (event max 2jam) , Pesanan Anda akan Masuk Secara Otomatis</li>\r\n              </ol>', '', '', '0000-00-00', 'master', 1),
(6, 'callofdutymobile', 'Call of Duty MOBILE', 'call-of-duty-mobile', 'call_of_duty_mobile.png', 1, '<ol style=\"margin-left: -25px;\">\r\n                <li>Masukan UserID dan Zone / Server ID</li>\r\n                <li>Pilih Layanan Yang Diinginkan</li>\r\n                <li>Pilih Metode Pembayaran</li>\r\n                <li>Masukan No. Whatsapp Anda agar mendapapat notifikasi</li>\r\n                <li>Klik Beli Sekarang dan Selesaikan Pembayaran</li>\r\n                <li>Tunggu Proses 1-2 Menit (event max 2jam) , Pesanan Anda akan Masuk Secara Otomatis</li>\r\n              </ol>', '', '', '0000-00-00', 'master', 1),
(7, 'dragonraja', 'Dragon Raja', 'dragon-raja', 'dragon_raja.png', 1, '<ol style=\"margin-left: -25px;\">\r\n                <li>Masukan UserID dan Zone / Server ID</li>\r\n                <li>Pilih Layanan Yang Diinginkan</li>\r\n                <li>Pilih Metode Pembayaran</li>\r\n                <li>Masukan No. Whatsapp Anda agar mendapapat notifikasi</li>\r\n                <li>Klik Beli Sekarang dan Selesaikan Pembayaran</li>\r\n                <li>Tunggu Proses 1-2 Menit (event max 2jam) , Pesanan Anda akan Masuk Secara Otomatis</li>\r\n              </ol>', '', '', '0000-00-00', 'master', 1),
(8, 'dragonnestmseakoram', 'Dragon Nest M - Sea Koram', '', 'dragon_nest.png', 1, '<ol style=\"margin-left: -25px;\">\r\n                <li>Masukan UserID dan Zone / Server ID</li>\r\n                <li>Pilih Layanan Yang Diinginkan</li>\r\n                <li>Pilih Metode Pembayaran</li>\r\n                <li>Masukan No. Whatsapp Anda agar mendapapat notifikasi</li>\r\n                <li>Klik Beli Sekarang dan Selesaikan Pembayaran</li>\r\n                <li>Tunggu Proses 1-2 Menit (event max 2jam) , Pesanan Anda akan Masuk Secara Otomatis</li>\r\n              </ol>', '', '', '0000-00-00', 'master', 1),
(9, 'freefire', 'Free Fire', 'free-fire', 'free_fire.png', 1, '<ol style=\"margin-left: -25px;\">\r\n                <li>Masukan UserID dan Zone / Server ID</li>\r\n                <li>Pilih Layanan Yang Diinginkan</li>\r\n                <li>Pilih Metode Pembayaran</li>\r\n                <li>Masukan No. Whatsapp Anda agar mendapapat notifikasi</li>\r\n                <li>Klik Beli Sekarang dan Selesaikan Pembayaran</li>\r\n                <li>Tunggu Proses 1-2 Menit (event max 2jam) , Pesanan Anda akan Masuk Secara Otomatis</li>\r\n              </ol>', '', '', '0000-00-00', 'master', 1),
(10, 'freefiremax', 'Free Fire Max', 'free-fire-max', 'free_fire.png', 1, '<ol style=\"margin-left: -25px;\">\r\n                <li>Masukan UserID dan Zone / Server ID</li>\r\n                <li>Pilih Layanan Yang Diinginkan</li>\r\n                <li>Pilih Metode Pembayaran</li>\r\n                <li>Masukan No. Whatsapp Anda agar mendapapat notifikasi</li>\r\n                <li>Klik Beli Sekarang dan Selesaikan Pembayaran</li>\r\n                <li>Tunggu Proses 1-2 Menit (event max 2jam) , Pesanan Anda akan Masuk Secara Otomatis</li>\r\n              </ol>', '', '', '0000-00-00', 'master', 1),
(11, 'freefirepromo', 'Free Fire Promo', 'free-fire', 'free_fire.png', 1, '<ol style=\"margin-left: -25px;\">\r\n                <li>Masukan UserID dan Zone / Server ID</li>\r\n                <li>Pilih Layanan Yang Diinginkan</li>\r\n                <li>Pilih Metode Pembayaran</li>\r\n                <li>Masukan No. Whatsapp Anda agar mendapapat notifikasi</li>\r\n                <li>Klik Beli Sekarang dan Selesaikan Pembayaran</li>\r\n                <li>Tunggu Proses 1-2 Menit (event max 2jam) , Pesanan Anda akan Masuk Secara Otomatis</li>\r\n              </ol>', '', '', '0000-00-00', 'master', 1),
(13, 'genshinimpact', 'Genshin Impact', 'genshin-impact', 'genshin_impact.png', 1, '<ol style=\"margin-left: -25px;\">\r\n                <li>Masukan UserID dan Zone / Server ID</li>\r\n                <li>Pilih Layanan Yang Diinginkan</li>\r\n                <li>Pilih Metode Pembayaran</li>\r\n                <li>Masukan No. Whatsapp Anda agar mendapapat notifikasi</li>\r\n                <li>Klik Beli Sekarang dan Selesaikan Pembayaran</li>\r\n                <li>Tunggu Proses 1-2 Menit (event max 2jam) , Pesanan Anda akan Masuk Secara Otomatis</li>\r\n              </ol>', '', '', '0000-00-00', 'master', 1),
(14, 'honkaiimpact3', 'Honkai Impact 3', '', 'honkai_impact.png', 1, '<ol style=\"margin-left: -25px;\">\r\n                <li>Masukan UserID dan Zone / Server ID</li>\r\n                <li>Pilih Layanan Yang Diinginkan</li>\r\n                <li>Pilih Metode Pembayaran</li>\r\n                <li>Masukan No. Whatsapp Anda agar mendapapat notifikasi</li>\r\n                <li>Klik Beli Sekarang dan Selesaikan Pembayaran</li>\r\n                <li>Tunggu Proses 1-2 Menit (event max 2jam) , Pesanan Anda akan Masuk Secara Otomatis</li>\r\n              </ol>', '', '', '0000-00-00', 'master', 1),
(15, 'higgsdomino', 'Higgs Domino', 'higgs-domino', 'higgs_domino.png', 1, '<ol style=\"margin-left: -25px;\">\r\n                <li>Masukan UserID dan Zone / Server ID</li>\r\n                <li>Pilih Layanan Yang Diinginkan</li>\r\n                <li>Pilih Metode Pembayaran</li>\r\n                <li>Masukan No. Whatsapp Anda agar mendapapat notifikasi</li>\r\n                <li>Klik Beli Sekarang dan Selesaikan Pembayaran</li>\r\n                <li>Tunggu Proses 1-2 Menit (event max 2jam) , Pesanan Anda akan Masuk Secara Otomatis</li>\r\n              </ol>', '', '', '0000-00-00', 'master', 1),
(16, 'hyperfront', 'Hyper Front', '', 'hyper_front.png', 1, '<ol style=\"margin-left: -25px;\">\r\n                <li>Masukan UserID dan Zone / Server ID</li>\r\n                <li>Pilih Layanan Yang Diinginkan</li>\r\n                <li>Pilih Metode Pembayaran</li>\r\n                <li>Masukan No. Whatsapp Anda agar mendapapat notifikasi</li>\r\n                <li>Klik Beli Sekarang dan Selesaikan Pembayaran</li>\r\n                <li>Tunggu Proses 1-2 Menit (event max 2jam) , Pesanan Anda akan Masuk Secara Otomatis</li>\r\n              </ol>', '', '', '0000-00-00', 'master', 1),
(17, 'laplacem', 'Laplace M', 'laplace-m', 'laplace_m.png', 1, '<ol style=\"margin-left: -25px;\">\r\n                <li>Masukan UserID dan Zone / Server ID</li>\r\n                <li>Pilih Layanan Yang Diinginkan</li>\r\n                <li>Pilih Metode Pembayaran</li>\r\n                <li>Masukan No. Whatsapp Anda agar mendapapat notifikasi</li>\r\n                <li>Klik Beli Sekarang dan Selesaikan Pembayaran</li>\r\n                <li>Tunggu Proses 1-2 Menit (event max 2jam) , Pesanan Anda akan Masuk Secara Otomatis</li>\r\n              </ol>', '', '', '0000-00-00', 'master', 1),
(18, 'leagueoflegends', 'League of Legends', 'league-of-legends-wild-rift', 'league_of_legends.png', 1, '<ol style=\"margin-left: -25px;\">\r\n                <li>Masukan UserID dan Zone / Server ID</li>\r\n                <li>Pilih Layanan Yang Diinginkan</li>\r\n                <li>Pilih Metode Pembayaran</li>\r\n                <li>Masukan No. Whatsapp Anda agar mendapapat notifikasi</li>\r\n                <li>Klik Beli Sekarang dan Selesaikan Pembayaran</li>\r\n                <li>Tunggu Proses 1-2 Menit (event max 2jam) , Pesanan Anda akan Masuk Secara Otomatis</li>\r\n              </ol>', '', '', '0000-00-00', 'master', 1),
(19, 'lifeafter', 'LifeAfter', '', 'lifeafter.png', 1, '<ol style=\"margin-left: -25px;\">\r\n                <li>Masukan UserID dan Zone / Server ID</li>\r\n                <li>Pilih Layanan Yang Diinginkan</li>\r\n                <li>Pilih Metode Pembayaran</li>\r\n                <li>Masukan No. Whatsapp Anda agar mendapapat notifikasi</li>\r\n                <li>Klik Beli Sekarang dan Selesaikan Pembayaran</li>\r\n                <li>Tunggu Proses 1-2 Menit (event max 2jam) , Pesanan Anda akan Masuk Secara Otomatis</li>\r\n              </ol>', '', '', '0000-00-00', 'master', 1),
(20, 'lightofthel', 'Light of Thel', '', 'light_of_thel.png', 1, '<ol style=\"margin-left: -25px;\">\r\n                <li>Masukan UserID dan Zone / Server ID</li>\r\n                <li>Pilih Layanan Yang Diinginkan</li>\r\n                <li>Pilih Metode Pembayaran</li>\r\n                <li>Masukan No. Whatsapp Anda agar mendapapat notifikasi</li>\r\n                <li>Klik Beli Sekarang dan Selesaikan Pembayaran</li>\r\n                <li>Tunggu Proses 1-2 Menit (event max 2jam) , Pesanan Anda akan Masuk Secara Otomatis</li>\r\n              </ol>', '', '', '0000-00-00', 'master', 1),
(21, 'lita', 'Lita', '', 'lita-icon.webp', 1, '<ol style=\"margin-left: -25px;\">\r\n                <li>Masukan UserID dan Zone / Server ID</li>\r\n                <li>Pilih Layanan Yang Diinginkan</li>\r\n                <li>Pilih Metode Pembayaran</li>\r\n                <li>Masukan No. Whatsapp Anda agar mendapapat notifikasi</li>\r\n                <li>Klik Beli Sekarang dan Selesaikan Pembayaran</li>\r\n                <li>Tunggu Proses 1-2 Menit (event max 2jam) , Pesanan Anda akan Masuk Secara Otomatis</li>\r\n              </ol>', '', '', '0000-00-00', 'master', 1),
(22, 'lordsmobile', 'Lords Mobile', 'lords-mobile', 'lords_mobile.png', 1, '<ol style=\"margin-left: -25px;\">\r\n                <li>Masukan UserID dan Zone / Server ID</li>\r\n                <li>Pilih Layanan Yang Diinginkan</li>\r\n                <li>Pilih Metode Pembayaran</li>\r\n                <li>Masukan No. Whatsapp Anda agar mendapapat notifikasi</li>\r\n                <li>Klik Beli Sekarang dan Selesaikan Pembayaran</li>\r\n                <li>Tunggu Proses 1-2 Menit (event max 2jam) , Pesanan Anda akan Masuk Secara Otomatis</li>\r\n              </ol>', '', '', '0000-00-00', 'master', 1),
(23, 'lostsaga', 'Lost Saga', '', 'lost_saga.png', 1, '<ol style=\"margin-left: -25px;\">\r\n                <li>Masukan UserID dan Zone / Server ID</li>\r\n                <li>Pilih Layanan Yang Diinginkan</li>\r\n                <li>Pilih Metode Pembayaran</li>\r\n                <li>Masukan No. Whatsapp Anda agar mendapapat notifikasi</li>\r\n                <li>Klik Beli Sekarang dan Selesaikan Pembayaran</li>\r\n                <li>Tunggu Proses 1-2 Menit (event max 2jam) , Pesanan Anda akan Masuk Secara Otomatis</li>\r\n              </ol>', '', '', '0000-00-00', 'master', 1),
(24, 'marvelsuperwar', 'Marvel Super War', 'marvel-super-war', 'marvel_super_war.png', 1, '<ol style=\"margin-left: -25px;\">\r\n                <li>Masukan UserID dan Zone / Server ID</li>\r\n                <li>Pilih Layanan Yang Diinginkan</li>\r\n                <li>Pilih Metode Pembayaran</li>\r\n                <li>Masukan No. Whatsapp Anda agar mendapapat notifikasi</li>\r\n                <li>Klik Beli Sekarang dan Selesaikan Pembayaran</li>\r\n                <li>Tunggu Proses 1-2 Menit (event max 2jam) , Pesanan Anda akan Masuk Secara Otomatis</li>\r\n              </ol>', '', '', '0000-00-00', 'master', 1),
(25, 'mobilelegend', 'Mobile Legend', 'mobile-legends', 'mobile_legend.png', 1, '<ol style=\"margin-left: -25px;\">\r\n                <li>Masukan UserID dan Zone / Server ID</li>\r\n                <li>Pilih Layanan Yang Diinginkan</li>\r\n                <li>Pilih Metode Pembayaran</li>\r\n                <li>Masukan No. Whatsapp Anda agar mendapapat notifikasi</li>\r\n                <li>Klik Beli Sekarang dan Selesaikan Pembayaran</li>\r\n                <li>Tunggu Proses 1-2 Menit (event max 2jam) , Pesanan Anda akan Masuk Secara Otomatis</li>\r\n              </ol>', '', '', '0000-00-00', 'master', 1),
(26, 'mobilelegendsa', 'Mobile Legends A', 'mobile-legends', 'mobile_legends_a.png', 1, '<ol style=\"margin-left: -25px;\">\r\n                <li>Masukan UserID dan Zone / Server ID</li>\r\n                <li>Pilih Layanan Yang Diinginkan</li>\r\n                <li>Pilih Metode Pembayaran</li>\r\n                <li>Masukan No. Whatsapp Anda agar mendapapat notifikasi</li>\r\n                <li>Klik Beli Sekarang dan Selesaikan Pembayaran</li>\r\n                <li>Tunggu Proses 1-2 Menit (event max 2jam) , Pesanan Anda akan Masuk Secara Otomatis</li>\r\n              </ol>', '', '', '0000-00-00', 'master', 1),
(27, 'mobilelegendsb', 'Mobile Legends B', 'mobile-legends', 'mobile_legends_b.png', 1, '<ol style=\"margin-left: -25px;\">\r\n                <li>Masukan UserID dan Zone / Server ID</li>\r\n                <li>Pilih Layanan Yang Diinginkan</li>\r\n                <li>Pilih Metode Pembayaran</li>\r\n                <li>Masukan No. Whatsapp Anda agar mendapapat notifikasi</li>\r\n                <li>Klik Beli Sekarang dan Selesaikan Pembayaran</li>\r\n                <li>Tunggu Proses 1-2 Menit (event max 2jam) , Pesanan Anda akan Masuk Secara Otomatis</li>\r\n              </ol>', '', '', '0000-00-00', 'master', 1),
(29, 'mobilelegendsvilog', 'Mobile Legends Vilog', 'mobile-legends', 'ml-vilog-iconn.jpg', 1, '<ol style=\"margin-left: -25px;\">\r\n                <li>Masukan UserID dan Zone / Server ID</li>\r\n                <li>Pilih Layanan Yang Diinginkan</li>\r\n                <li>Pilih Metode Pembayaran</li>\r\n                <li>Masukan No. Whatsapp Anda agar mendapapat notifikasi</li>\r\n                <li>Klik Beli Sekarang dan Selesaikan Pembayaran</li>\r\n                <li>Tunggu Proses 1-2 Menit (event max 2jam) , Pesanan Anda akan Masuk Secara Otomatis</li>\r\n              </ol>', '', '', '0000-00-00', 'master', 1),
(30, 'mobilelegendsjokirank', 'Mobile Legends Joki Rank', 'mobile-legends', 'ml-joki-1-icon.png', 1, '<ol style=\"margin-left: -25px;\">\r\n                <li>Masukan UserID dan Zone / Server ID</li>\r\n                <li>Pilih Layanan Yang Diinginkan</li>\r\n                <li>Pilih Metode Pembayaran</li>\r\n                <li>Masukan No. Whatsapp Anda agar mendapapat notifikasi</li>\r\n                <li>Klik Beli Sekarang dan Selesaikan Pembayaran</li>\r\n                <li>Tunggu Proses 1-2 Menit (event max 2jam) , Pesanan Anda akan Masuk Secara Otomatis</li>\r\n              </ol>', '', '', '0000-00-00', 'master', 1),
(31, 'mobilelegendsmembership', 'Mobile Legends Membership', 'mobile-legends', 'mobile_legends_membership.png', 1, '<ol style=\"margin-left: -25px;\">\r\n                <li>Masukan UserID dan Zone / Server ID</li>\r\n                <li>Pilih Layanan Yang Diinginkan</li>\r\n                <li>Pilih Metode Pembayaran</li>\r\n                <li>Masukan No. Whatsapp Anda agar mendapapat notifikasi</li>\r\n                <li>Klik Beli Sekarang dan Selesaikan Pembayaran</li>\r\n                <li>Tunggu Proses 1-2 Menit (event max 2jam) , Pesanan Anda akan Masuk Secara Otomatis</li>\r\n              </ol>', '', '', '0000-00-00', 'master', 1),
(32, 'omegalegends', 'Omega Legends', '', 'omega_legends.png', 1, '<ol style=\"margin-left: -25px;\">\r\n                <li>Masukan UserID dan Zone / Server ID</li>\r\n                <li>Pilih Layanan Yang Diinginkan</li>\r\n                <li>Pilih Metode Pembayaran</li>\r\n                <li>Masukan No. Whatsapp Anda agar mendapapat notifikasi</li>\r\n                <li>Klik Beli Sekarang dan Selesaikan Pembayaran</li>\r\n                <li>Tunggu Proses 1-2 Menit (event max 2jam) , Pesanan Anda akan Masuk Secara Otomatis</li>\r\n              </ol>', '', '', '0000-00-00', 'master', 1),
(33, 'onepunchman', 'One Punch Man', '', 'one_punch_man.png', 1, '<ol style=\"margin-left: -25px;\">\r\n                <li>Masukan UserID dan Zone / Server ID</li>\r\n                <li>Pilih Layanan Yang Diinginkan</li>\r\n                <li>Pilih Metode Pembayaran</li>\r\n                <li>Masukan No. Whatsapp Anda agar mendapapat notifikasi</li>\r\n                <li>Klik Beli Sekarang dan Selesaikan Pembayaran</li>\r\n                <li>Tunggu Proses 1-2 Menit (event max 2jam) , Pesanan Anda akan Masuk Secara Otomatis</li>\r\n              </ol>', '', '', '0000-00-00', 'master', 1),
(34, 'pointblank', 'Point Blank', 'point-blank', 'point_blank.png', 1, '<ol style=\"margin-left: -25px;\">\r\n                <li>Masukan UserID dan Zone / Server ID</li>\r\n                <li>Pilih Layanan Yang Diinginkan</li>\r\n                <li>Pilih Metode Pembayaran</li>\r\n                <li>Masukan No. Whatsapp Anda agar mendapapat notifikasi</li>\r\n                <li>Klik Beli Sekarang dan Selesaikan Pembayaran</li>\r\n                <li>Tunggu Proses 1-2 Menit (event max 2jam) , Pesanan Anda akan Masuk Secara Otomatis</li>\r\n              </ol>', '', '', '0000-00-00', 'master', 1),
(35, 'pokertexas', 'Poker Texas', '', 'poker_texas.png', 1, '<ol style=\"margin-left: -25px;\">\r\n                <li>Masukan UserID dan Zone / Server ID</li>\r\n                <li>Pilih Layanan Yang Diinginkan</li>\r\n                <li>Pilih Metode Pembayaran</li>\r\n                <li>Masukan No. Whatsapp Anda agar mendapapat notifikasi</li>\r\n                <li>Klik Beli Sekarang dan Selesaikan Pembayaran</li>\r\n                <li>Tunggu Proses 1-2 Menit (event max 2jam) , Pesanan Anda akan Masuk Secara Otomatis</li>\r\n              </ol>', '', '', '0000-00-00', 'master', 1),
(36, 'pubgmobile', 'PUBG MOBILE', '', 'pubgm_global.png', 1, '<ol style=\"margin-left: -25px;\">\r\n                <li>Masukan UserID dan Zone / Server ID</li>\r\n                <li>Pilih Layanan Yang Diinginkan</li>\r\n                <li>Pilih Metode Pembayaran</li>\r\n                <li>Masukan No. Whatsapp Anda agar mendapapat notifikasi</li>\r\n                <li>Klik Beli Sekarang dan Selesaikan Pembayaran</li>\r\n                <li>Tunggu Proses 1-2 Menit (event max 2jam) , Pesanan Anda akan Masuk Secara Otomatis</li>\r\n              </ol>', '', '', '0000-00-00', 'master', 1),
(37, 'pubgmindoa', 'PUBGM INDO A', '', 'pubgm_indo_a.png', 1, '<ol style=\"margin-left: -25px;\">\r\n                <li>Masukan UserID dan Zone / Server ID</li>\r\n                <li>Pilih Layanan Yang Diinginkan</li>\r\n                <li>Pilih Metode Pembayaran</li>\r\n                <li>Masukan No. Whatsapp Anda agar mendapapat notifikasi</li>\r\n                <li>Klik Beli Sekarang dan Selesaikan Pembayaran</li>\r\n                <li>Tunggu Proses 1-2 Menit (event max 2jam) , Pesanan Anda akan Masuk Secara Otomatis</li>\r\n              </ol>', '', '', '0000-00-00', 'master', 1),
(38, 'pubgmindob', 'PUBGM INDO B', '', 'pubgm_indo_b.png', 1, '<ol style=\"margin-left: -25px;\">\r\n                <li>Masukan UserID dan Zone / Server ID</li>\r\n                <li>Pilih Layanan Yang Diinginkan</li>\r\n                <li>Pilih Metode Pembayaran</li>\r\n                <li>Masukan No. Whatsapp Anda agar mendapapat notifikasi</li>\r\n                <li>Klik Beli Sekarang dan Selesaikan Pembayaran</li>\r\n                <li>Tunggu Proses 1-2 Menit (event max 2jam) , Pesanan Anda akan Masuk Secara Otomatis</li>\r\n              </ol>', '', '', '0000-00-00', 'master', 1),
(39, 'ragnarokmeternallove', 'Ragnarok M: Eternal Love', 'ragnarok-m-eternal-love-big-cat-coin', 'ragnarok_m_eternal_love.png', 1, '<ol style=\"margin-left: -25px;\">\r\n                <li>Masukan UserID dan Zone / Server ID</li>\r\n                <li>Pilih Layanan Yang Diinginkan</li>\r\n                <li>Pilih Metode Pembayaran</li>\r\n                <li>Masukan No. Whatsapp Anda agar mendapapat notifikasi</li>\r\n                <li>Klik Beli Sekarang dan Selesaikan Pembayaran</li>\r\n                <li>Tunggu Proses 1-2 Menit (event max 2jam) , Pesanan Anda akan Masuk Secara Otomatis</li>\r\n              </ol>', '', '', '0000-00-00', 'master', 1),
(40, 'ragnarokxnextgeneration', 'RagnaroK X Next Generation', '', 'ragnarox-icon.jpg', 1, '<ol style=\"margin-left: -25px;\">\r\n                <li>Masukan UserID dan Zone / Server ID</li>\r\n                <li>Pilih Layanan Yang Diinginkan</li>\r\n                <li>Pilih Metode Pembayaran</li>\r\n                <li>Masukan No. Whatsapp Anda agar mendapapat notifikasi</li>\r\n                <li>Klik Beli Sekarang dan Selesaikan Pembayaran</li>\r\n                <li>Tunggu Proses 1-2 Menit (event max 2jam) , Pesanan Anda akan Masuk Secara Otomatis</li>\r\n              </ol>', '', '', '0000-00-00', 'master', 1),
(41, 'rideoutheroes', 'Ride Out Heroes', '', 'ride_out_heroes.png', 1, '<ol style=\"margin-left: -25px;\">\r\n                <li>Masukan UserID dan Zone / Server ID</li>\r\n                <li>Pilih Layanan Yang Diinginkan</li>\r\n                <li>Pilih Metode Pembayaran</li>\r\n                <li>Masukan No. Whatsapp Anda agar mendapapat notifikasi</li>\r\n                <li>Klik Beli Sekarang dan Selesaikan Pembayaran</li>\r\n                <li>Tunggu Proses 1-2 Menit (event max 2jam) , Pesanan Anda akan Masuk Secara Otomatis</li>\r\n              </ol>', '', '', '0000-00-00', 'master', 1),
(42, 'rulesofsurvivalpc', 'Rules of Survival PC', '', 'rules_of_survival_mobile.png', 1, '<ol style=\"margin-left: -25px;\">\r\n                <li>Masukan UserID dan Zone / Server ID</li>\r\n                <li>Pilih Layanan Yang Diinginkan</li>\r\n                <li>Pilih Metode Pembayaran</li>\r\n                <li>Masukan No. Whatsapp Anda agar mendapapat notifikasi</li>\r\n                <li>Klik Beli Sekarang dan Selesaikan Pembayaran</li>\r\n                <li>Tunggu Proses 1-2 Menit (event max 2jam) , Pesanan Anda akan Masuk Secara Otomatis</li>\r\n              </ol>', '', '', '0000-00-00', 'master', 1),
(43, 'sausageman', 'Sausage Man', '', 'sausage_man.png', 1, '<ol style=\"margin-left: -25px;\">\r\n                <li>Masukan UserID dan Zone / Server ID</li>\r\n                <li>Pilih Layanan Yang Diinginkan</li>\r\n                <li>Pilih Metode Pembayaran</li>\r\n                <li>Masukan No. Whatsapp Anda agar mendapapat notifikasi</li>\r\n                <li>Klik Beli Sekarang dan Selesaikan Pembayaran</li>\r\n                <li>Tunggu Proses 1-2 Menit (event max 2jam) , Pesanan Anda akan Masuk Secara Otomatis</li>\r\n              </ol>', '', '', '0000-00-00', 'master', 1),
(44, 'steamwalletcode', 'Steam Wallet Code', '', 'steam-icon-2.jpg', 2, '<ol style=\"margin-left: -25px;\">\r\n                          <li>Masukan UserID dan Zone / Server ID</li>\r\n                          <li>Pilih Layanan Yang Diinginkan</li>\r\n                          <li>Pilih Metode Pembayaran</li>\r\n                          <li>Masukan No. Whatsapp Anda agar mendapapat notifikasi</li>\r\n                          <li>Klik Beli Sekarang dan Selesaikan Pembayaran</li>\r\n                          <li>Tunggu Proses 1-2 Menit (event max 2jam) , Pesanan Anda akan Masuk Secara Otomatis</li>\r\n                      </ol>', '', '', '0000-00-00', 'master', 1),
(45, 'supersus', 'Super Sus', '', 'super_sus.png', 1, '<ol style=\"margin-left: -25px;\">\r\n                <li>Masukan UserID dan Zone / Server ID</li>\r\n                <li>Pilih Layanan Yang Diinginkan</li>\r\n                <li>Pilih Metode Pembayaran</li>\r\n                <li>Masukan No. Whatsapp Anda agar mendapapat notifikasi</li>\r\n                <li>Klik Beli Sekarang dan Selesaikan Pembayaran</li>\r\n                <li>Tunggu Proses 1-2 Menit (event max 2jam) , Pesanan Anda akan Masuk Secara Otomatis</li>\r\n              </ol>', '', '', '0000-00-00', 'master', 1),
(46, 'tomandjerrychase', 'Tom and Jerry Chase', 'tom-and-jerry-chase', 'tom_and_jerry_chase.png', 1, '<ol style=\"margin-left: -25px;\">\r\n                <li>Masukan UserID dan Zone / Server ID</li>\r\n                <li>Pilih Layanan Yang Diinginkan</li>\r\n                <li>Pilih Metode Pembayaran</li>\r\n                <li>Masukan No. Whatsapp Anda agar mendapapat notifikasi</li>\r\n                <li>Klik Beli Sekarang dan Selesaikan Pembayaran</li>\r\n                <li>Tunggu Proses 1-2 Menit (event max 2jam) , Pesanan Anda akan Masuk Secara Otomatis</li>\r\n              </ol>', '', '', '0000-00-00', 'master', 1),
(47, 'toweroffantasy', 'Tower of Fantasy', '', 'tower-of-fantasy-icon.webp', 1, '<ol style=\"margin-left: -25px;\">\r\n                <li>Masukan UserID dan Zone / Server ID</li>\r\n                <li>Pilih Layanan Yang Diinginkan</li>\r\n                <li>Pilih Metode Pembayaran</li>\r\n                <li>Masukan No. Whatsapp Anda agar mendapapat notifikasi</li>\r\n                <li>Klik Beli Sekarang dan Selesaikan Pembayaran</li>\r\n                <li>Tunggu Proses 1-2 Menit (event max 2jam) , Pesanan Anda akan Masuk Secara Otomatis</li>\r\n              </ol>', '', '', '0000-00-00', 'master', 1),
(48, 'valorant', 'Valorant', '', 'valorant.png', 1, '<ol style=\"margin-left: -25px;\">\r\n                <li>Masukan UserID dan Zone / Server ID</li>\r\n                <li>Pilih Layanan Yang Diinginkan</li>\r\n                <li>Pilih Metode Pembayaran</li>\r\n                <li>Masukan No. Whatsapp Anda agar mendapapat notifikasi</li>\r\n                <li>Klik Beli Sekarang dan Selesaikan Pembayaran</li>\r\n                <li>Tunggu Proses 1-2 Menit (event max 2jam) , Pesanan Anda akan Masuk Secara Otomatis</li>\r\n              </ol>', '', '', '0000-00-00', 'master', 1),
(49, 'zepeto', 'Zepeto', 'zepeto', 'zepeto.png', 1, '<ol style=\"margin-left: -25px;\">\r\n                <li>Masukan UserID dan Zone / Server ID</li>\r\n                <li>Pilih Layanan Yang Diinginkan</li>\r\n                <li>Pilih Metode Pembayaran</li>\r\n                <li>Masukan No. Whatsapp Anda agar mendapapat notifikasi</li>\r\n                <li>Klik Beli Sekarang dan Selesaikan Pembayaran</li>\r\n                <li>Tunggu Proses 1-2 Menit (event max 2jam) , Pesanan Anda akan Masuk Secara Otomatis</li>\r\n              </ol>', '', '', '0000-00-00', 'master', 1),
(50, 'youtubepremium', 'Youtube Premium', '', 'youtube_premium.png', 2, '<ol style=\"margin-left: -25px;\">\r\n                          <li>Masukan UserID dan Zone / Server ID</li>\r\n                          <li>Pilih Layanan Yang Diinginkan</li>\r\n                          <li>Pilih Metode Pembayaran</li>\r\n                          <li>Masukan No. Whatsapp Anda agar mendapapat notifikasi</li>\r\n                          <li>Klik Beli Sekarang dan Selesaikan Pembayaran</li>\r\n                          <li>Tunggu Proses 1-2 Menit (event max 2jam) , Pesanan Anda akan Masuk Secara Otomatis</li>\r\n                      </ol>', '', '', '0000-00-00', 'master', 1),
(51, 'facebook', 'Facebook', '', 'facebook.png', 5, '<ol style=\"margin-left: -25px;\">\r\n                          <li>Masukan Link / Username</li>\r\n                          <li>Pilih Layanan</li>\r\n                          <li>Masukan Layanan / Jumlah</li>\r\n                          <li>Pilih Metode Pembayaran</li>\r\n                          <li>Masukan No. Whatsapp Anda</li>\r\n                          <li>Klik Beli Sekarang dan Selesaikan Pembayaran</li>\r\n                          <li>Tunggu Proses 1-2 Menit, Pesanan Anda akan Masuk Secara Otomatis</li>\r\n                      </ol>', '', '', '0000-00-00', 'master', 1),
(52, 'telegram', 'Telegram', '', 'telegram.png', 5, '<ol style=\"margin-left: -25px;\">\r\n                          <li>Masukan Link / Username</li>\r\n                          <li>Pilih Layanan</li>\r\n                          <li>Masukan Layanan / Jumlah</li>\r\n                          <li>Pilih Metode Pembayaran</li>\r\n                          <li>Masukan No. Whatsapp Anda</li>\r\n                          <li>Klik Beli Sekarang dan Selesaikan Pembayaran</li>\r\n                          <li>Tunggu Proses 1-2 Menit, Pesanan Anda akan Masuk Secara Otomatis</li>\r\n                      </ol>', '', '', '0000-00-00', 'master', 1),
(53, 'tiktok', 'TikTok', '', 'tiktok.png', 5, '<ol style=\"margin-left: -25px;\">\r\n                          <li>Masukan Link / Username</li>\r\n                          <li>Pilih Layanan</li>\r\n                          <li>Masukan Layanan / Jumlah</li>\r\n                          <li>Pilih Metode Pembayaran</li>\r\n                          <li>Masukan No. Whatsapp Anda</li>\r\n                          <li>Klik Beli Sekarang dan Selesaikan Pembayaran</li>\r\n                          <li>Tunggu Proses 1-2 Menit, Pesanan Anda akan Masuk Secara Otomatis</li>\r\n                      </ol>', '', '', '0000-00-00', 'master', 1),
(54, 'twitter', 'Twitter', '', 'twitter.png', 5, '<ol style=\"margin-left: -25px;\">\r\n                          <li>Masukan Link / Username</li>\r\n                          <li>Pilih Layanan</li>\r\n                          <li>Masukan Layanan / Jumlah</li>\r\n                          <li>Pilih Metode Pembayaran</li>\r\n                          <li>Masukan No. Whatsapp Anda</li>\r\n                          <li>Klik Beli Sekarang dan Selesaikan Pembayaran</li>\r\n                          <li>Tunggu Proses 1-2 Menit, Pesanan Anda akan Masuk Secara Otomatis</li>\r\n                      </ol>', '', '', '0000-00-00', 'master', 1),
(55, 'youtube', 'Youtube', '', 'youtube.png', 5, '<ol style=\"margin-left: -25px;\">\r\n                          <li>Masukan Link / Username</li>\r\n                          <li>Pilih Layanan</li>\r\n                          <li>Masukan Layanan / Jumlah</li>\r\n                          <li>Pilih Metode Pembayaran</li>\r\n                          <li>Masukan No. Whatsapp Anda</li>\r\n                          <li>Klik Beli Sekarang dan Selesaikan Pembayaran</li>\r\n                          <li>Tunggu Proses 1-2 Menit, Pesanan Anda akan Masuk Secara Otomatis</li>\r\n                      </ol>', '', '', '0000-00-00', 'master', 1),
(56, 'instagram', 'Instagram', '', 'instagram.png', 5, '<ol style=\"margin-left: -25px;\">\r\n                          <li>Masukan Link / Username</li>\r\n                          <li>Pilih Layanan</li>\r\n                          <li>Masukan Layanan / Jumlah</li>\r\n                          <li>Pilih Metode Pembayaran</li>\r\n                          <li>Masukan No. Whatsapp Anda</li>\r\n                          <li>Klik Beli Sekarang dan Selesaikan Pembayaran</li>\r\n                          <li>Tunggu Proses 1-2 Menit, Pesanan Anda akan Masuk Secara Otomatis</li>\r\n                      </ol>', '', '', '0000-00-00', 'master', 1),
(57, 'axis', 'AXIS', '', 'axis.png', 3, '<ol style=\"margin-left: -25px;\">\r\n                          <li>Masukan Nomor Handphone</li>\r\n                          <li>Pilih Jenis Layanan</li>\r\n                          <li>Pilih Layanan Yang Diinginkan</li>\r\n                          <li>Pilih Metode Pembayaran</li>\r\n                          <li>Masukan No. Whatsapp Anda agar mendapapat notifikasi</li>\r\n                          <li>Klik Beli Sekarang dan Selesaikan Pembayaran</li>\r\n                          <li>Tunggu Proses 1-2 Menit, Pesanan Anda akan Masuk Secara Otomatis</li>\r\n                      </ol>', '', '', '0000-00-00', 'master', 0),
(58, 'bribrizzi', 'BRI BRIZZI', '', 'bri_brizzi.png', 4, '<ol style=\"margin-left: -25px;\">\r\n                <li>Masukan Nomor Tujuan</li>\r\n                <li>Pilih Nominal Yang Diinginkan</li>\r\n                <li>Pilih Metode Pembayaran</li>\r\n                <li>Masukan No. Whatsapp Anda</li>\r\n                <li>Klik Beli Sekarang dan Selesaikan Pembayaran</li>\r\n                <li>Tunggu Proses 1-2 Menit, Pesanan Anda akan Masuk Secara Otomatis</li>\r\n              </ol>', '', '', '0000-00-00', 'master', 1),
(59, 'byu', 'BY.U', '', 'byu.png', 3, '<ol style=\"margin-left: -25px;\">\r\n                          <li>Masukan Nomor Handphone</li>\r\n                          <li>Pilih Jenis Layanan</li>\r\n                          <li>Pilih Layanan Yang Diinginkan</li>\r\n                          <li>Pilih Metode Pembayaran</li>\r\n                          <li>Masukan No. Whatsapp Anda agar mendapapat notifikasi</li>\r\n                          <li>Klik Beli Sekarang dan Selesaikan Pembayaran</li>\r\n                          <li>Tunggu Proses 1-2 Menit, Pesanan Anda akan Masuk Secara Otomatis</li>\r\n                      </ol>', '', '', '0000-00-00', 'master', 1),
(60, 'dana', 'DANA', '', 'dana.png', 4, '<ol style=\"margin-left: -25px;\">\r\n                <li>Masukan Nomor Tujuan</li>\r\n                <li>Pilih Nominal Yang Diinginkan</li>\r\n                <li>Pilih Metode Pembayaran</li>\r\n                <li>Masukan No. Whatsapp Anda</li>\r\n                <li>Klik Beli Sekarang dan Selesaikan Pembayaran</li>\r\n                <li>Tunggu Proses 1-2 Menit, Pesanan Anda akan Masuk Secara Otomatis</li>\r\n              </ol>', '', '', '0000-00-00', 'master', 1),
(61, 'doku', 'DOKU', '', 'doku.png', 4, '<ol style=\"margin-left: -25px;\">\r\n                <li>Masukan Nomor Tujuan</li>\r\n                <li>Pilih Nominal Yang Diinginkan</li>\r\n                <li>Pilih Metode Pembayaran</li>\r\n                <li>Masukan No. Whatsapp Anda</li>\r\n                <li>Klik Beli Sekarang dan Selesaikan Pembayaran</li>\r\n                <li>Tunggu Proses 1-2 Menit, Pesanan Anda akan Masuk Secara Otomatis</li>\r\n              </ol>', '', '', '0000-00-00', 'master', 1),
(62, 'gopay', 'GO PAY', '', 'go_pay.png', 4, '<ol style=\"margin-left: -25px;\">\r\n                <li>Masukan Nomor Tujuan</li>\r\n                <li>Pilih Nominal Yang Diinginkan</li>\r\n                <li>Pilih Metode Pembayaran</li>\r\n                <li>Masukan No. Whatsapp Anda</li>\r\n                <li>Klik Beli Sekarang dan Selesaikan Pembayaran</li>\r\n                <li>Tunggu Proses 1-2 Menit, Pesanan Anda akan Masuk Secara Otomatis</li>\r\n              </ol>', '', '', '0000-00-00', 'master', 1),
(63, 'grab', 'GRAB', '', 'grab.png', 4, '<ol style=\"margin-left: -25px;\">\r\n                <li>Masukan Nomor Tujuan</li>\r\n                <li>Pilih Nominal Yang Diinginkan</li>\r\n                <li>Pilih Metode Pembayaran</li>\r\n                <li>Masukan No. Whatsapp Anda</li>\r\n                <li>Klik Beli Sekarang dan Selesaikan Pembayaran</li>\r\n                <li>Tunggu Proses 1-2 Menit, Pesanan Anda akan Masuk Secara Otomatis</li>\r\n              </ol>', '', '', '0000-00-00', 'master', 1),
(64, 'indosat', 'INDOSAT', '', 'indosat.png', 3, '<ol style=\"margin-left: -25px;\">\r\n                          <li>Masukan Nomor Handphone</li>\r\n                          <li>Pilih Jenis Layanan</li>\r\n                          <li>Pilih Layanan Yang Diinginkan</li>\r\n                          <li>Pilih Metode Pembayaran</li>\r\n                          <li>Masukan No. Whatsapp Anda agar mendapapat notifikasi</li>\r\n                          <li>Klik Beli Sekarang dan Selesaikan Pembayaran</li>\r\n                          <li>Tunggu Proses 1-2 Menit, Pesanan Anda akan Masuk Secara Otomatis</li>\r\n                      </ol>', '', '', '0000-00-00', 'master', 1),
(65, 'shopee', 'Shopee', '', 'shopee.png', 5, '<ol style=\"margin-left: -25px;\">\r\n                          <li>Masukan Link / Username</li>\r\n                          <li>Pilih Layanan</li>\r\n                          <li>Masukan Layanan / Jumlah</li>\r\n                          <li>Pilih Metode Pembayaran</li>\r\n                          <li>Masukan No. Whatsapp Anda</li>\r\n                          <li>Klik Beli Sekarang dan Selesaikan Pembayaran</li>\r\n                          <li>Tunggu Proses 1-2 Menit, Pesanan Anda akan Masuk Secara Otomatis</li>\r\n                      </ol>', '', '', '0000-00-00', 'master', 1),
(66, 'linkaja', 'LINKAJA', '', 'linkaja.png', 4, '<ol style=\"margin-left: -25px;\">\r\n                <li>Masukan Nomor Tujuan</li>\r\n                <li>Pilih Nominal Yang Diinginkan</li>\r\n                <li>Pilih Metode Pembayaran</li>\r\n                <li>Masukan No. Whatsapp Anda</li>\r\n                <li>Klik Beli Sekarang dan Selesaikan Pembayaran</li>\r\n                <li>Tunggu Proses 1-2 Menit, Pesanan Anda akan Masuk Secara Otomatis</li>\r\n              </ol>', '', '', '0000-00-00', 'master', 1),
(67, 'mandirietoll', 'MANDIRI E-TOLL', '', 'mandiri_etoll.png', 4, '<ol style=\"margin-left: -25px;\">\r\n                <li>Masukan Nomor Tujuan</li>\r\n                <li>Pilih Nominal Yang Diinginkan</li>\r\n                <li>Pilih Metode Pembayaran</li>\r\n                <li>Masukan No. Whatsapp Anda</li>\r\n                <li>Klik Beli Sekarang dan Selesaikan Pembayaran</li>\r\n                <li>Tunggu Proses 1-2 Menit, Pesanan Anda akan Masuk Secara Otomatis</li>\r\n              </ol>', '', '', '0000-00-00', 'master', 1),
(68, 'maxim', 'MAXIM', '', 'maxim.png', 4, '<ol style=\"margin-left: -25px;\">\r\n                <li>Masukan Nomor Tujuan</li>\r\n                <li>Pilih Nominal Yang Diinginkan</li>\r\n                <li>Pilih Metode Pembayaran</li>\r\n                <li>Masukan No. Whatsapp Anda</li>\r\n                <li>Klik Beli Sekarang dan Selesaikan Pembayaran</li>\r\n                <li>Tunggu Proses 1-2 Menit, Pesanan Anda akan Masuk Secara Otomatis</li>\r\n              </ol>', '', '', '0000-00-00', 'master', 1),
(69, 'ovo', 'OVO', '', 'ovo.png', 4, '<ol style=\"margin-left: -25px;\">\r\n                <li>Masukan Nomor Tujuan</li>\r\n                <li>Pilih Nominal Yang Diinginkan</li>\r\n                <li>Pilih Metode Pembayaran</li>\r\n                <li>Masukan No. Whatsapp Anda</li>\r\n                <li>Klik Beli Sekarang dan Selesaikan Pembayaran</li>\r\n                <li>Tunggu Proses 1-2 Menit, Pesanan Anda akan Masuk Secara Otomatis</li>\r\n              </ol>', '', '', '0000-00-00', 'master', 1),
(70, 'shopeepay', 'SHOPEE PAY', '', 'shopee_pay.png', 4, '<ol style=\"margin-left: -25px;\">\r\n                <li>Masukan Nomor Tujuan</li>\r\n                <li>Pilih Nominal Yang Diinginkan</li>\r\n                <li>Pilih Metode Pembayaran</li>\r\n                <li>Masukan No. Whatsapp Anda</li>\r\n                <li>Klik Beli Sekarang dan Selesaikan Pembayaran</li>\r\n                <li>Tunggu Proses 1-2 Menit, Pesanan Anda akan Masuk Secara Otomatis</li>\r\n              </ol>', '', '', '0000-00-00', 'master', 1),
(71, 'smartfren', 'SMARTFREN', '', 'smart.png', 3, '<ol style=\"margin-left: -25px;\">\r\n                          <li>Masukan Nomor Handphone</li>\r\n                          <li>Pilih Jenis Layanan</li>\r\n                          <li>Pilih Layanan Yang Diinginkan</li>\r\n                          <li>Pilih Metode Pembayaran</li>\r\n                          <li>Masukan No. Whatsapp Anda agar mendapapat notifikasi</li>\r\n                          <li>Klik Beli Sekarang dan Selesaikan Pembayaran</li>\r\n                          <li>Tunggu Proses 1-2 Menit, Pesanan Anda akan Masuk Secara Otomatis</li>\r\n                      </ol>', '', '', '0000-00-00', 'master', 0),
(72, 'tapcashbni', 'TAPCASH BNI', '', 'tapcash_bni.png', 4, '<ol style=\"margin-left: -25px;\">\r\n                <li>Masukan Nomor Tujuan</li>\r\n                <li>Pilih Nominal Yang Diinginkan</li>\r\n                <li>Pilih Metode Pembayaran</li>\r\n                <li>Masukan No. Whatsapp Anda</li>\r\n                <li>Klik Beli Sekarang dan Selesaikan Pembayaran</li>\r\n                <li>Tunggu Proses 1-2 Menit, Pesanan Anda akan Masuk Secara Otomatis</li>\r\n              </ol>', '', '', '0000-00-00', 'master', 1),
(73, 'telkomsel', 'TELKOMSEL', '', 'telkomsel.png', 3, '<ol style=\"margin-left: -25px;\">\r\n                          <li>Masukan Nomor Handphone</li>\r\n                          <li>Pilih Jenis Layanan</li>\r\n                          <li>Pilih Layanan Yang Diinginkan</li>\r\n                          <li>Pilih Metode Pembayaran</li>\r\n                          <li>Masukan No. Whatsapp Anda agar mendapapat notifikasi</li>\r\n                          <li>Klik Beli Sekarang dan Selesaikan Pembayaran</li>\r\n                          <li>Tunggu Proses 1-2 Menit, Pesanan Anda akan Masuk Secara Otomatis</li>\r\n                      </ol>', '', '', '0000-00-00', 'master', 1),
(74, 'tixid', 'TIX ID', '', 'tixid.png', 4, '<ol style=\"margin-left: -25px;\">\r\n                <li>Masukan Nomor Tujuan</li>\r\n                <li>Pilih Nominal Yang Diinginkan</li>\r\n                <li>Pilih Metode Pembayaran</li>\r\n                <li>Masukan No. Whatsapp Anda</li>\r\n                <li>Klik Beli Sekarang dan Selesaikan Pembayaran</li>\r\n                <li>Tunggu Proses 1-2 Menit, Pesanan Anda akan Masuk Secara Otomatis</li>\r\n              </ol>', '', '', '0000-00-00', 'master', 1),
(75, 'tri', 'TRI', '', 'tri.png', 3, '<ol style=\"margin-left: -25px;\">\r\n                          <li>Masukan Nomor Handphone</li>\r\n                          <li>Pilih Jenis Layanan</li>\r\n                          <li>Pilih Layanan Yang Diinginkan</li>\r\n                          <li>Pilih Metode Pembayaran</li>\r\n                          <li>Masukan No. Whatsapp Anda agar mendapapat notifikasi</li>\r\n                          <li>Klik Beli Sekarang dan Selesaikan Pembayaran</li>\r\n                          <li>Tunggu Proses 1-2 Menit, Pesanan Anda akan Masuk Secara Otomatis</li>\r\n                      </ol>', '', '', '0000-00-00', 'master', 1),
(76, 'xl', 'XL', '', 'xl.png', 3, '<ol style=\"margin-left: -25px;\">\r\n                          <li>Masukan Nomor Handphone</li>\r\n                          <li>Pilih Jenis Layanan</li>\r\n                          <li>Pilih Layanan Yang Diinginkan</li>\r\n                          <li>Pilih Metode Pembayaran</li>\r\n                          <li>Masukan No. Whatsapp Anda agar mendapapat notifikasi</li>\r\n                          <li>Klik Beli Sekarang dan Selesaikan Pembayaran</li>\r\n                          <li>Tunggu Proses 1-2 Menit, Pesanan Anda akan Masuk Secara Otomatis</li>\r\n                      </ol>', '', '', '0000-00-00', 'master', 1),
(77, 'pln', 'PLN', '', 'lightning.png', 4, '<ol style=\"margin-left: -25px;\">\r\n                <li>Masukan Nomor Tujuan</li>\r\n                <li>Pilih Nominal Yang Diinginkan</li>\r\n                <li>Pilih Metode Pembayaran</li>\r\n                <li>Masukan No. Whatsapp Anda</li>\r\n                <li>Klik Beli Sekarang dan Selesaikan Pembayaran</li>\r\n                <li>Tunggu Proses 1-2 Menit, Pesanan Anda akan Masuk Secara Otomatis</li>\r\n              </ol>', '', '', '0000-00-00', 'master', 1),
(78, 'canvapro', 'Canva Pro', '', 'canva_pro.png', 2, '<ol style=\"margin-left: -25px;\">\r\n                          <li>Masukan UserID dan Zone / Server ID</li>\r\n                          <li>Pilih Layanan Yang Diinginkan</li>\r\n                          <li>Pilih Metode Pembayaran</li>\r\n                          <li>Masukan No. Whatsapp Anda agar mendapapat notifikasi</li>\r\n                          <li>Klik Beli Sekarang dan Selesaikan Pembayaran</li>\r\n                          <li>Tunggu Proses 1-2 Menit (event max 2jam) , Pesanan Anda akan Masuk Secara Otomatis</li>\r\n                      </ol>', '', '', '0000-00-00', 'master', 1),
(79, 'disneyhotstar', 'Disney Hotstar', '', 'disney_hotstar.png', 2, '<ol style=\"margin-left: -25px;\">\r\n                          <li>Masukan UserID dan Zone / Server ID</li>\r\n                          <li>Pilih Layanan Yang Diinginkan</li>\r\n                          <li>Pilih Metode Pembayaran</li>\r\n                          <li>Masukan No. Whatsapp Anda agar mendapapat notifikasi</li>\r\n                          <li>Klik Beli Sekarang dan Selesaikan Pembayaran</li>\r\n                          <li>Tunggu Proses 1-2 Menit (event max 2jam) , Pesanan Anda akan Masuk Secara Otomatis</li>\r\n                      </ol>', '', '', '0000-00-00', 'master', 1),
(80, 'garenashellmurah', 'Garena Shell Murah', '', 'garena_shell_promo.png', 2, '<ol style=\"margin-left: -25px;\">\r\n                          <li>Masukan UserID dan Zone / Server ID</li>\r\n                          <li>Pilih Layanan Yang Diinginkan</li>\r\n                          <li>Pilih Metode Pembayaran</li>\r\n                          <li>Masukan No. Whatsapp Anda agar mendapapat notifikasi</li>\r\n                          <li>Klik Beli Sekarang dan Selesaikan Pembayaran</li>\r\n                          <li>Tunggu Proses 1-2 Menit (event max 2jam) , Pesanan Anda akan Masuk Secara Otomatis</li>\r\n                      </ol>', '', '', '0000-00-00', 'master', 1),
(81, 'iqiyipremium', 'iQIYI Premium', '', 'iqiyi_premium.png', 2, '<ol style=\"margin-left: -25px;\">\r\n                          <li>Masukan UserID dan Zone / Server ID</li>\r\n                          <li>Pilih Layanan Yang Diinginkan</li>\r\n                          <li>Pilih Metode Pembayaran</li>\r\n                          <li>Masukan No. Whatsapp Anda agar mendapapat notifikasi</li>\r\n                          <li>Klik Beli Sekarang dan Selesaikan Pembayaran</li>\r\n                          <li>Tunggu Proses 1-2 Menit (event max 2jam) , Pesanan Anda akan Masuk Secara Otomatis</li>\r\n                      </ol>', '', '', '0000-00-00', 'master', 1),
(82, 'netflixpremium', 'Netflix Premium', '', 'netflix_premium.png', 2, '<ol style=\"margin-left: -25px;\">\r\n                          <li>Masukan UserID dan Zone / Server ID</li>\r\n                          <li>Pilih Layanan Yang Diinginkan</li>\r\n                          <li>Pilih Metode Pembayaran</li>\r\n                          <li>Masukan No. Whatsapp Anda agar mendapapat notifikasi</li>\r\n                          <li>Klik Beli Sekarang dan Selesaikan Pembayaran</li>\r\n                          <li>Tunggu Proses 1-2 Menit (event max 2jam) , Pesanan Anda akan Masuk Secara Otomatis</li>\r\n                      </ol>', '', '', '0000-00-00', 'master', 1);
INSERT INTO `tb_kategori` (`id`, `slug`, `kategori`, `cekID`, `image`, `parent`, `deskripsi`, `bantuan`, `subtitle`, `created_date`, `user`, `status`) VALUES
(83, 'spotifypremium', 'Spotify Premium', '', 'spotify_premium.png', 2, '<ol style=\"margin-left: -25px;\">\r\n                          <li>Masukan UserID dan Zone / Server ID</li>\r\n                          <li>Pilih Layanan Yang Diinginkan</li>\r\n                          <li>Pilih Metode Pembayaran</li>\r\n                          <li>Masukan No. Whatsapp Anda agar mendapapat notifikasi</li>\r\n                          <li>Klik Beli Sekarang dan Selesaikan Pembayaran</li>\r\n                          <li>Tunggu Proses 1-2 Menit (event max 2jam) , Pesanan Anda akan Masuk Secara Otomatis</li>\r\n                      </ol>', '', '', '0000-00-00', 'master', 0),
(84, 'vidiopremier', 'Vidio Premier', '', 'vidio_premier.png', 2, '<ol style=\"margin-left: -25px;\">\r\n                          <li>Masukan UserID dan Zone / Server ID</li>\r\n                          <li>Pilih Layanan Yang Diinginkan</li>\r\n                          <li>Pilih Metode Pembayaran</li>\r\n                          <li>Masukan No. Whatsapp Anda agar mendapapat notifikasi</li>\r\n                          <li>Klik Beli Sekarang dan Selesaikan Pembayaran</li>\r\n                          <li>Tunggu Proses 1-2 Menit (event max 2jam) , Pesanan Anda akan Masuk Secara Otomatis</li>\r\n                      </ol>', '', '', '0000-00-00', 'master', 0),
(85, 'wetvpremium', 'WeTV Premium', '', 'wetv_premium.png', 2, '<ol style=\"margin-left: -25px;\">\r\n                          <li>Masukan UserID dan Zone / Server ID</li>\r\n                          <li>Pilih Layanan Yang Diinginkan</li>\r\n                          <li>Pilih Metode Pembayaran</li>\r\n                          <li>Masukan No. Whatsapp Anda agar mendapapat notifikasi</li>\r\n                          <li>Klik Beli Sekarang dan Selesaikan Pembayaran</li>\r\n                          <li>Tunggu Proses 1-2 Menit (event max 2jam) , Pesanan Anda akan Masuk Secara Otomatis</li>\r\n                      </ol>', '', '', '0000-00-00', 'master', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_konfirmasi`
--

CREATE TABLE `tb_konfirmasi` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `paymentID` varchar(25) NOT NULL,
  `kd_transaksi` varchar(25) NOT NULL,
  `image` varchar(255) NOT NULL,
  `tanggal` datetime NOT NULL,
  `bank_tujuan` text NOT NULL,
  `total` int(11) NOT NULL,
  `metode` varchar(25) NOT NULL DEFAULT 'transfer',
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_notif`
--

CREATE TABLE `tb_notif` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `note` text NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_order`
--

CREATE TABLE `tb_order` (
  `id` int(11) NOT NULL,
  `id_session` varchar(255) NOT NULL,
  `kd_transaksi` varchar(25) NOT NULL,
  `produkID` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `potongan` int(11) NOT NULL,
  `kode_unik` int(11) NOT NULL,
  `sub_total` int(11) NOT NULL,
  `voucher` text NOT NULL,
  `kategori` text NOT NULL,
  `title` text NOT NULL,
  `userID` text NOT NULL,
  `zoneID` text NOT NULL,
  `nickname` text NOT NULL,
  `trxID` text NOT NULL,
  `services` text NOT NULL,
  `status_order` text NOT NULL,
  `note` text NOT NULL,
  `full_name` text NOT NULL,
  `email` text NOT NULL,
  `no_hp` text NOT NULL,
  `metode` text NOT NULL,
  `created_date` datetime NOT NULL,
  `providerID` int(11) NOT NULL,
  `jenis` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_page`
--

CREATE TABLE `tb_page` (
  `id` int(11) NOT NULL,
  `slug` text NOT NULL,
  `nama_page` text NOT NULL,
  `content` longtext NOT NULL,
  `image` varchar(255) NOT NULL,
  `video` varchar(255) NOT NULL,
  `created_date` date NOT NULL,
  `last_update` date NOT NULL,
  `user` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_page`
--

INSERT INTO `tb_page` (`id`, `slug`, `nama_page`, `content`, `image`, `video`, `created_date`, `last_update`, `user`) VALUES
(5, 'kebijakan-privasi', 'Kebijakan Privasi', 'Edit', '', '', '0000-00-00', '2022-04-23', 'master'),
(3, 'faq', 'FAQ', 'Edit', '', '', '0000-00-00', '2022-04-23', 'master'),
(2, 'informasi-reseller', 'Informasi Reseller', '', '', '', '0000-00-00', '2022-12-15', 'master'),
(1, 'tentang-kami', 'Tentang Kami', 'Edit', '', '', '0000-00-00', '2022-04-23', 'master'),
(4, 'ketentuan-layanan', 'Ketentuan Layanan', 'Edit', '', '', '0000-00-00', '2022-04-23', 'master');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pemesan`
--

CREATE TABLE `tb_pemesan` (
  `id` int(11) NOT NULL,
  `id_session` varchar(100) NOT NULL,
  `kd_transaksi` varchar(25) NOT NULL,
  `full_name` text NOT NULL,
  `email` text NOT NULL,
  `alamat` text NOT NULL,
  `provinsi` text NOT NULL,
  `city` text NOT NULL,
  `kecamatan` text NOT NULL,
  `kelurahan` text NOT NULL,
  `kode_pos` text NOT NULL,
  `no_hp` text NOT NULL,
  `kode_unik` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `no_resi` varchar(100) NOT NULL,
  `tgl_kirim` date NOT NULL,
  `metode` text NOT NULL,
  `userID` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_poin`
--

CREATE TABLE `tb_poin` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  `pending` int(11) NOT NULL,
  `payout` int(11) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_popup`
--

CREATE TABLE `tb_popup` (
  `id` int(11) NOT NULL,
  `ip` text NOT NULL,
  `date` date NOT NULL,
  `status` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_popup`
--

INSERT INTO `tb_popup` (`id`, `ip`, `date`, `status`) VALUES
(4, '127.0.0.1', '2022-12-17', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tb_post`
--

CREATE TABLE `tb_post` (
  `id` int(11) NOT NULL,
  `slug` text NOT NULL,
  `title` text NOT NULL,
  `meta_desc` text NOT NULL,
  `keyword` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `video` varchar(200) NOT NULL,
  `content` longtext NOT NULL,
  `author` text NOT NULL,
  `kategori` text NOT NULL,
  `created_date` date NOT NULL,
  `last_update` date NOT NULL,
  `user` text NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_prepaid`
--

CREATE TABLE `tb_prepaid` (
  `id` int(11) NOT NULL,
  `slug` text NOT NULL,
  `code` text NOT NULL,
  `title` text NOT NULL,
  `kategori` text NOT NULL,
  `brand` text NOT NULL,
  `harga_modal` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `harga_reseller` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `created_date` date NOT NULL,
  `jenis` int(2) NOT NULL,
  `product_type` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_produk`
--

CREATE TABLE `tb_produk` (
  `id` int(11) NOT NULL,
  `slug` text NOT NULL,
  `code` text NOT NULL,
  `title` text NOT NULL,
  `kategori` text NOT NULL,
  `harga_modal` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `harga_reseller` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `currency` text NOT NULL,
  `status` int(11) NOT NULL,
  `created_date` date NOT NULL,
  `jenis` int(11) NOT NULL,
  `product_type` int(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_produk_social`
--

CREATE TABLE `tb_produk_social` (
  `id` int(11) NOT NULL,
  `slug` text NOT NULL,
  `code` text NOT NULL,
  `title` text NOT NULL,
  `kategori` text NOT NULL,
  `min_buy` int(11) NOT NULL,
  `max_buy` int(11) NOT NULL,
  `harga_modal` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `harga_reseller` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `created_date` date NOT NULL,
  `jenis` int(11) NOT NULL,
  `product_type` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_request_poin`
--

CREATE TABLE `tb_request_poin` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `rewardID` int(11) NOT NULL,
  `nominal` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `approve_date` datetime NOT NULL,
  `created_date` datetime NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_reward`
--

CREATE TABLE `tb_reward` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `nominal` text NOT NULL,
  `status` int(2) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_seo`
--

CREATE TABLE `tb_seo` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'logo.png',
  `instansi` text NOT NULL,
  `keyword` text NOT NULL,
  `deskripsi` text NOT NULL,
  `template` int(11) NOT NULL,
  `warna` int(2) NOT NULL,
  `footer` int(2) NOT NULL,
  `urlweb` text NOT NULL,
  `user` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_seo`
--

INSERT INTO `tb_seo` (`id`, `image`, `instansi`, `keyword`, `deskripsi`, `template`, `warna`, `footer`, `urlweb`, `user`, `date`) VALUES
(1, 'logo.png', 'Nama Usaha | Top Up Game Tanpa Ribet', 'Top Up Game Murah, Joki Mobile Legend dan Layanan Booster Social Media, Instant 24 Jam, Mobile Legends, Diamond Mobile Legends, Free Fire, DM FF,  Mobile, PUBGM, Genshin Impact, CODM, Valorant, Wild Rift', 'Game Top Up Adalah Tempat Top Up Game Murah, Joki Mobile Legends dan Booster Media Yang Aman, Murah dan Terpercaya. ByHansMart Menyediakan Layanan Top Up Games, Joki Mobile Legends, Booster Social Media. Untuk Mempermudah Pembayaran Anda Disini Kami Juga Menyediakan Berbagai Macam Metode Pembayaran', 4, 2, 2, 'http://localhost/topupgamecustom', 'master', '2020-01-10 20:55:37');

-- --------------------------------------------------------

--
-- Table structure for table `tb_slide`
--

CREATE TABLE `tb_slide` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `sort` int(11) NOT NULL,
  `user` text NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_slide`
--

INSERT INTO `tb_slide` (`id`, `image`, `deskripsi`, `sort`, `user`, `status`) VALUES
(1, 'slide_1.jpg', '', 1, 'master', 1),
(2, 'slide_2.jpg', '', 2, 'master', 1),
(18, 'slide_1.jpg', '', 1, 'master', 1),
(19, 'slide_master_20221215181904.png', '', 3, 'master', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_social`
--

CREATE TABLE `tb_social` (
  `id` int(11) NOT NULL,
  `facebook` text NOT NULL,
  `twitter` text NOT NULL,
  `googleplus` text NOT NULL,
  `instagram` text NOT NULL,
  `linkedin` text NOT NULL,
  `youtube` text NOT NULL,
  `date` datetime NOT NULL,
  `user` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_social`
--

INSERT INTO `tb_social` (`id`, `facebook`, `twitter`, `googleplus`, `instagram`, `linkedin`, `youtube`, `date`, `user`) VALUES
(1, 'https://www.facebook.com/gametopup.co.id', '#', 'https://google.com', 'https://www.instagram.com/gametopup.co.id/', '#', '#', '0000-00-00 00:00:00', 'master');

-- --------------------------------------------------------

--
-- Table structure for table `tb_stat`
--

CREATE TABLE `tb_stat` (
  `id` int(11) NOT NULL,
  `ip` text NOT NULL,
  `date` date NOT NULL,
  `hits` int(11) NOT NULL,
  `page` text NOT NULL,
  `user` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_stat`
--

INSERT INTO `tb_stat` (`id`, `ip`, `date`, `hits`, `page`, `user`) VALUES
(1, '127.0.0.1', '2022-11-06', 1, 'Beranda', 'master'),
(2, '127.0.0.1', '2022-11-06', 1, 'Beranda', 'master'),
(3, '127.0.0.1', '2022-11-06', 1, 'Beranda', 'master'),
(4, '127.0.0.1', '2022-11-06', 1, 'Beranda', 'master'),
(5, '127.0.0.1', '2022-11-06', 1, 'Beranda', 'master'),
(6, '127.0.0.1', '2022-11-06', 1, 'Beranda', 'master'),
(7, '127.0.0.1', '2022-11-06', 1, 'Beranda', 'master'),
(8, '127.0.0.1', '2022-11-06', 1, 'Beranda', 'master'),
(9, '127.0.0.1', '2022-11-06', 1, 'Beranda', 'master'),
(10, '127.0.0.1', '2022-11-06', 1, 'Beranda', 'master'),
(11, '127.0.0.1', '2022-11-06', 1, 'Beranda', 'master'),
(12, '127.0.0.1', '2022-11-06', 1, 'Beranda', 'master'),
(13, '127.0.0.1', '2022-11-06', 1, 'Beranda', 'master'),
(14, '127.0.0.1', '2022-11-06', 1, 'Beranda', 'master'),
(15, '127.0.0.1', '2022-11-06', 1, 'Beranda', 'master'),
(16, '127.0.0.1', '2022-11-06', 1, 'Beranda', 'master'),
(17, '127.0.0.1', '2022-11-06', 1, 'Beranda', 'master'),
(18, '127.0.0.1', '2022-11-06', 1, 'Beranda', 'master'),
(19, '127.0.0.1', '2022-11-06', 1, 'Beranda', 'master'),
(20, '127.0.0.1', '2022-11-06', 1, 'Beranda', 'master'),
(21, '127.0.0.1', '2022-11-06', 1, 'Beranda', 'master'),
(22, '127.0.0.1', '2022-11-06', 1, 'Beranda', 'master'),
(23, '127.0.0.1', '2022-11-06', 1, 'Beranda', 'master'),
(24, '127.0.0.1', '2022-11-06', 1, 'Beranda', 'master'),
(25, '127.0.0.1', '2022-11-06', 1, 'Beranda', 'master'),
(26, '127.0.0.1', '2022-11-06', 1, 'Beranda', 'master'),
(27, '127.0.0.1', '2022-11-06', 1, 'Beranda', 'master'),
(28, '127.0.0.1', '2022-11-06', 1, 'Beranda', 'master'),
(29, '127.0.0.1', '2022-11-06', 1, 'Beranda', 'master'),
(30, '127.0.0.1', '2022-11-06', 1, 'Beranda', 'master'),
(31, '127.0.0.1', '2022-11-06', 1, 'Beranda', 'master'),
(32, '127.0.0.1', '2022-11-06', 1, 'Beranda', 'master'),
(33, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(34, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(35, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(36, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(37, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(38, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(39, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(40, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(41, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(42, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(43, '127.0.0.1', '2022-11-07', 1, 'Order', 'master'),
(44, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(45, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(46, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(47, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(48, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(49, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(50, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(51, '127.0.0.1', '2022-11-07', 1, 'Masuk Akun', 'master'),
(52, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(53, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(54, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(55, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(56, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(57, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(58, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(59, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(60, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(61, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(62, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(63, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(64, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(65, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(66, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(67, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(68, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(69, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(70, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(71, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(72, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(73, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(74, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(75, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(76, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(77, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(78, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(79, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(80, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(81, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(82, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(83, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(84, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(85, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(86, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(87, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(88, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(89, '127.0.0.1', '2022-11-07', 1, 'Order', 'master'),
(90, '127.0.0.1', '2022-11-07', 1, 'Order', 'master'),
(91, '127.0.0.1', '2022-11-07', 1, 'Order', 'master'),
(92, '127.0.0.1', '2022-11-07', 1, 'Order', 'master'),
(93, '127.0.0.1', '2022-11-07', 1, 'Privacy Policy', 'master'),
(94, '127.0.0.1', '2022-11-07', 1, 'Privacy Policy', 'master'),
(95, '127.0.0.1', '2022-11-07', 1, 'Privacy Policy', 'master'),
(96, '127.0.0.1', '2022-11-07', 1, 'Cek Pesanan', 'master'),
(97, '127.0.0.1', '2022-11-07', 1, 'Masuk Akun', 'master'),
(98, '127.0.0.1', '2022-11-07', 1, 'Register Akun', 'master'),
(99, '127.0.0.1', '2022-11-07', 1, 'Register Akun', 'master'),
(100, '127.0.0.1', '2022-11-07', 1, 'Cek Pesanan', 'master'),
(101, '127.0.0.1', '2022-11-07', 1, 'Cek Pesanan', 'master'),
(102, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(103, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(104, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(105, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(106, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(107, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(108, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(109, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(110, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(111, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(112, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(113, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(114, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(115, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(116, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(117, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(118, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(119, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(120, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(121, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(122, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(123, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(124, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(125, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(126, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(127, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(128, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(129, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(130, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(131, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(132, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(133, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(134, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(135, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(136, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(137, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(138, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(139, '127.0.0.1', '2022-11-07', 1, 'Beranda', 'master'),
(140, '127.0.0.1', '2022-12-08', 1, 'Beranda', 'master'),
(141, '127.0.0.1', '2022-12-08', 1, 'Beranda', 'master'),
(142, '127.0.0.1', '2022-12-08', 1, 'Order', 'master'),
(143, '127.0.0.1', '2022-12-10', 1, 'Beranda', 'master'),
(144, '127.0.0.1', '2022-12-10', 1, 'Beranda', 'master'),
(145, '127.0.0.1', '2022-12-10', 1, 'Order', 'master'),
(146, '127.0.0.1', '2022-12-10', 1, 'Order', 'master'),
(147, '127.0.0.1', '2022-12-10', 1, 'Order', 'master'),
(148, '127.0.0.1', '2022-12-10', 1, 'Order', 'master'),
(149, '127.0.0.1', '2022-12-10', 1, 'Order', 'master'),
(150, '127.0.0.1', '2022-12-10', 1, 'Order', 'master'),
(151, '127.0.0.1', '2022-12-10', 1, 'Order', 'master'),
(152, '127.0.0.1', '2022-12-10', 1, 'Order', 'master'),
(153, '127.0.0.1', '2022-12-10', 1, 'Beranda', 'master'),
(154, '127.0.0.1', '2022-12-10', 1, 'Beranda', 'master'),
(155, '127.0.0.1', '2022-12-10', 1, 'Beranda', 'master'),
(156, '127.0.0.1', '2022-12-10', 1, 'Beranda', 'master'),
(157, '127.0.0.1', '2022-12-10', 1, 'Beranda', 'master'),
(158, '127.0.0.1', '2022-12-10', 1, 'Beranda', 'master'),
(159, '127.0.0.1', '2022-12-10', 1, 'Beranda', 'master'),
(160, '127.0.0.1', '2022-12-10', 1, 'Beranda', 'master'),
(161, '127.0.0.1', '2022-12-10', 1, 'Beranda', 'master'),
(162, '127.0.0.1', '2022-12-10', 1, 'Beranda', 'master'),
(163, '127.0.0.1', '2022-12-10', 1, 'Beranda', 'master'),
(164, '127.0.0.1', '2022-12-10', 1, 'Beranda', 'master'),
(165, '127.0.0.1', '2022-12-10', 1, 'Beranda', 'master'),
(166, '127.0.0.1', '2022-12-10', 1, 'Beranda', 'master'),
(167, '127.0.0.1', '2022-12-10', 1, 'Beranda', 'master'),
(168, '127.0.0.1', '2022-12-10', 1, 'Beranda', 'master'),
(169, '127.0.0.1', '2022-12-10', 1, 'Beranda', 'master'),
(170, '127.0.0.1', '2022-12-10', 1, 'Beranda', 'master'),
(171, '127.0.0.1', '2022-12-10', 1, 'Beranda', 'master'),
(172, '127.0.0.1', '2022-12-15', 1, 'Beranda', 'master'),
(173, '127.0.0.1', '2022-12-15', 1, 'Beranda', 'master'),
(174, '127.0.0.1', '2022-12-15', 1, 'Beranda', 'master'),
(175, '127.0.0.1', '2022-12-15', 1, 'Beranda', 'master'),
(176, '127.0.0.1', '2022-12-15', 1, 'Beranda', 'master'),
(177, '127.0.0.1', '2022-12-15', 1, 'Beranda', 'master'),
(178, '127.0.0.1', '2022-12-15', 1, 'Beranda', 'master'),
(179, '127.0.0.1', '2022-12-16', 1, 'Beranda', 'master'),
(180, '127.0.0.1', '2022-12-16', 1, 'Beranda', 'master'),
(181, '127.0.0.1', '2022-12-16', 1, 'Beranda', 'master'),
(182, '127.0.0.1', '2022-12-16', 1, 'Beranda', 'master'),
(183, '127.0.0.1', '2022-12-16', 1, 'Beranda', 'master'),
(184, '127.0.0.1', '2022-12-16', 1, 'Beranda', 'master'),
(185, '127.0.0.1', '2022-12-16', 1, 'Beranda', 'master'),
(186, '127.0.0.1', '2022-12-16', 1, 'Beranda', 'master'),
(187, '127.0.0.1', '2022-12-16', 1, 'Beranda', 'master'),
(188, '127.0.0.1', '2022-12-16', 1, 'Beranda', 'master'),
(189, '127.0.0.1', '2022-12-16', 1, 'Beranda', 'master'),
(190, '127.0.0.1', '2022-12-16', 1, 'Beranda', 'master'),
(191, '127.0.0.1', '2022-12-16', 1, 'Beranda', 'master'),
(192, '127.0.0.1', '2022-12-16', 1, 'Beranda', 'master'),
(193, '127.0.0.1', '2022-12-16', 1, 'Masuk Akun', 'master'),
(194, '127.0.0.1', '2022-12-16', 1, 'Masuk Akun', 'master'),
(195, '127.0.0.1', '2022-12-16', 1, 'Masuk Akun', 'master'),
(196, '127.0.0.1', '2022-12-16', 1, 'Beranda', 'master'),
(197, '127.0.0.1', '2022-12-16', 1, 'Privacy Policy', 'master'),
(198, '127.0.0.1', '2022-12-16', 1, 'Cek Pesanan', 'master'),
(199, '127.0.0.1', '2022-12-16', 1, 'Beranda', 'master'),
(200, '127.0.0.1', '2022-12-16', 1, 'Order', 'master'),
(201, '127.0.0.1', '2022-12-17', 1, 'Beranda', 'master'),
(202, '127.0.0.1', '2022-12-17', 1, 'Beranda', 'master'),
(203, '127.0.0.1', '2022-12-17', 1, 'Beranda', 'master'),
(204, '127.0.0.1', '2022-12-17', 1, 'Beranda', 'master'),
(205, '127.0.0.1', '2022-12-17', 1, 'Beranda', 'master'),
(206, '127.0.0.1', '2022-12-17', 1, 'Beranda', 'master'),
(207, '127.0.0.1', '2022-12-17', 1, 'Beranda', 'master'),
(208, '127.0.0.1', '2022-12-17', 1, 'Beranda', 'master'),
(209, '127.0.0.1', '2022-12-17', 1, 'Beranda', 'master'),
(210, '127.0.0.1', '2022-12-17', 1, 'Beranda', 'master'),
(211, '127.0.0.1', '2022-12-17', 1, 'Beranda', 'master'),
(212, '127.0.0.1', '2022-12-17', 1, 'Beranda', 'master'),
(213, '127.0.0.1', '2022-12-17', 1, 'Beranda', 'master'),
(214, '127.0.0.1', '2022-12-17', 1, 'Beranda', 'master'),
(215, '127.0.0.1', '2022-12-17', 1, 'Beranda', 'master'),
(216, '127.0.0.1', '2022-12-17', 1, 'Beranda', 'master'),
(217, '127.0.0.1', '2022-12-17', 1, 'Privacy Policy', 'master'),
(218, '127.0.0.1', '2022-12-17', 1, 'Beranda', 'master'),
(219, '127.0.0.1', '2022-12-17', 1, 'Beranda', 'master'),
(220, '127.0.0.1', '2022-12-17', 1, 'Beranda', 'master'),
(221, '127.0.0.1', '2022-12-17', 1, 'Beranda', 'master'),
(222, '127.0.0.1', '2022-12-17', 1, 'Beranda', 'master'),
(223, '127.0.0.1', '2022-12-17', 1, 'Beranda', 'master'),
(224, '127.0.0.1', '2022-12-17', 1, 'Beranda', 'master'),
(225, '127.0.0.1', '2022-12-17', 1, 'Beranda', 'master'),
(226, '127.0.0.1', '2022-12-17', 1, 'Beranda', 'master'),
(227, '127.0.0.1', '2022-12-17', 1, 'Beranda', 'master'),
(228, '127.0.0.1', '2022-12-17', 1, 'Beranda', 'master'),
(229, '127.0.0.1', '2022-12-17', 1, 'Beranda', 'master'),
(230, '127.0.0.1', '2022-12-17', 1, 'Beranda', 'master'),
(231, '127.0.0.1', '2022-12-17', 1, 'Beranda', 'master'),
(232, '127.0.0.1', '2022-12-17', 1, 'Beranda', 'master'),
(233, '127.0.0.1', '2022-12-17', 1, 'Beranda', 'master'),
(234, '127.0.0.1', '2022-12-17', 1, 'Beranda', 'master'),
(235, '127.0.0.1', '2022-12-17', 1, 'Beranda', 'master'),
(236, '127.0.0.1', '2022-12-17', 1, 'Beranda', 'master'),
(237, '127.0.0.1', '2022-12-17', 1, 'Beranda', 'master'),
(238, '127.0.0.1', '2022-12-17', 1, 'Beranda', 'master'),
(239, '127.0.0.1', '2022-12-17', 1, 'Beranda', 'master'),
(240, '127.0.0.1', '2022-12-17', 1, 'Beranda', 'master'),
(241, '127.0.0.1', '2022-12-17', 1, 'Beranda', 'master'),
(242, '127.0.0.1', '2022-12-17', 1, 'Beranda', 'master'),
(243, '127.0.0.1', '2022-12-17', 1, 'Beranda', 'master'),
(244, '127.0.0.1', '2022-12-17', 1, 'Beranda', 'master'),
(245, '127.0.0.1', '2022-12-17', 1, 'Beranda', 'master'),
(246, '127.0.0.1', '2022-12-17', 1, 'Beranda', 'master'),
(247, '127.0.0.1', '2022-12-17', 1, 'Beranda', 'master'),
(248, '127.0.0.1', '2022-12-17', 1, 'Beranda', 'master'),
(249, '127.0.0.1', '2022-12-17', 1, 'Beranda', 'master'),
(250, '127.0.0.1', '2022-12-17', 1, 'Beranda', 'master'),
(251, '127.0.0.1', '2022-12-17', 1, 'Beranda', 'master'),
(252, '127.0.0.1', '2022-12-17', 1, 'Beranda', 'master'),
(253, '127.0.0.1', '2022-12-17', 1, 'Beranda', 'master'),
(254, '127.0.0.1', '2022-12-17', 1, 'Beranda', 'master'),
(255, '127.0.0.1', '2022-12-17', 1, 'Beranda', 'master'),
(256, '127.0.0.1', '2022-12-17', 1, 'Beranda', 'master');

-- --------------------------------------------------------

--
-- Table structure for table `tb_testi`
--

CREATE TABLE `tb_testi` (
  `id` int(11) NOT NULL,
  `kd_transaksi` text NOT NULL,
  `produkID` int(11) NOT NULL,
  `full_name` text NOT NULL,
  `content` mediumtext NOT NULL,
  `date` datetime NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_token`
--

CREATE TABLE `tb_token` (
  `id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_token`
--

INSERT INTO `tb_token` (`id`, `token`) VALUES
(1, 'a248b138a36df34839268cfc00d09055'),
(2, 'f3db84bb1a61d3338ba71823de2eb965'),
(3, 'd410c34e70884d6fdb050a946d685ee0'),
(4, 'cbe63f0632003c36d10676a9224b0532'),
(5, 'f9a7a28e8b033646c4ced3955306f29a'),
(6, '6f79f99463e2c227adc7431fbbb974f2'),
(7, 'd050ae799b613ba43c9472d618f9188d');

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `id` int(11) NOT NULL,
  `kd_transaksi` varchar(16) NOT NULL,
  `date` datetime NOT NULL,
  `transaksi` text NOT NULL,
  `total` int(11) NOT NULL,
  `saldo` int(11) NOT NULL,
  `note` text NOT NULL,
  `providerID` int(2) NOT NULL,
  `jenis` text NOT NULL,
  `metode` text NOT NULL,
  `userID` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`id`, `kd_transaksi`, `date`, `transaksi`, `total`, `saldo`, `note`, `providerID`, `jenis`, `metode`, `userID`, `status`) VALUES
(1, 'INV/22/12/330', '2022-12-15 05:56:33', 'Top Up Saldo', 10000, 0, 'Top Up Saldo', 0, '1', 'Manual', 1, 1),
(2, 'INV/22/12/161', '2022-12-15 05:57:16', 'Top Up Saldo', 10000, 0, 'Top Up Saldo', 0, '1', 'Manual', 1, 1),
(3, 'INV/22/12/332', '2022-12-15 05:57:33', 'Top Up Saldo', 100000, 0, 'Top Up Saldo', 0, '1', 'Manual', 1, 1),
(4, 'INV/22/12/463', '2022-12-15 05:58:46', 'Top Up Saldo', 10000, 0, 'Top Up Saldo', 0, '1', 'Manual', 1, 1),
(5, 'INV/22/12/044', '2022-12-15 05:59:04', 'Top Up Saldo', 10000, 0, 'Top Up Saldo', 0, '1', 'Manual', 1, 1),
(6, 'INV/22/12/435', '2022-12-15 05:59:43', 'Top Up Saldo', 10000, 0, 'Top Up Saldo', 0, '1', 'Manual', 1, 1),
(7, 'INV/22/12/226', '2022-12-15 06:00:22', 'Top Up Saldo', 10000, 0, 'Top Up Saldo', 0, '1', 'Manual', 1, 1),
(8, 'INV/22/12/427', '2022-12-15 06:00:42', 'Top Up Saldo', 10000, 0, 'Top Up Saldo', 0, '1', 'Manual', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_tripay`
--

CREATE TABLE `tb_tripay` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `reference` text NOT NULL,
  `merchant_ref` text NOT NULL,
  `payment_method` text NOT NULL,
  `payment_name` text NOT NULL,
  `customer_email` text NOT NULL,
  `customer_phone` text NOT NULL,
  `amount` int(11) NOT NULL,
  `fee` int(11) NOT NULL,
  `amount_total` int(11) NOT NULL,
  `pay_code` text NOT NULL,
  `checkout_url` text NOT NULL,
  `status` text NOT NULL,
  `paid_time` datetime NOT NULL,
  `expired_time` datetime NOT NULL,
  `providerID` int(11) NOT NULL,
  `jenis_transaksi` int(11) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_tripayapi`
--

CREATE TABLE `tb_tripayapi` (
  `id` int(11) NOT NULL,
  `provider` text NOT NULL,
  `api_key` text NOT NULL,
  `private_key` text NOT NULL,
  `merchant_code` text NOT NULL,
  `jenis` int(2) NOT NULL,
  `status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_tripayapi`
--

INSERT INTO `tb_tripayapi` (`id`, `provider`, `api_key`, `private_key`, `merchant_code`, `jenis`, `status`) VALUES
(1, 'Tripay', '', '', '', 0, 0),
(2, 'ipaymu', '', '', '', 0, 0),
(3, 'duitku', '', '', '', 0, 0),
(4, 'Vip Reseller', '', '', '', 1, 0),
(5, 'Digiflazz', '', '', '', 1, 0),
(6, 'MedanPedia', '', '', '', 1, 0),
(7, 'Cekmutasi', '', '', '', 2, 0),
(8, 'Fonnte', '', '', '', 2, 0),
(9, 'Apigames', '', '', '', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `user` text NOT NULL,
  `pass` varchar(100) NOT NULL,
  `re_pass` text NOT NULL,
  `token_id` int(11) DEFAULT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'avatar5.png',
  `full_name` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_hp` text NOT NULL,
  `level` text NOT NULL,
  `join_date` datetime NOT NULL,
  `last_login` datetime NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `user`, `pass`, `re_pass`, `token_id`, `image`, `full_name`, `email`, `no_hp`, `level`, `join_date`, `last_login`, `status`) VALUES
(1, 'master', '0bc5302528ac90cd0455a3ec1fade041', 'demo123!!', 7, 'avatar5.png', 'Nama Usaha', 'email@gmail.com', '', 'superadmin', '2020-07-10 00:00:00', '2022-12-18 04:07:39', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_wa`
--

CREATE TABLE `tb_wa` (
  `id` int(11) NOT NULL,
  `api_key` text NOT NULL,
  `sender` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_backup`
--
ALTER TABLE `tb_backup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_balance`
--
ALTER TABLE `tb_balance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_bank`
--
ALTER TABLE `tb_bank`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_banner`
--
ALTER TABLE `tb_banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_banner`
--
ALTER TABLE `tb_banners`
  ADD PRIMARY KEY (`id`);
--
-- Indexes for table `tb_jenis`
--
ALTER TABLE `tb_jenis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_konfirmasi`
--
ALTER TABLE `tb_konfirmasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_notif`
--
ALTER TABLE `tb_notif`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_order`
--
ALTER TABLE `tb_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_page`
--
ALTER TABLE `tb_page`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_pemesan`
--
ALTER TABLE `tb_pemesan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_poin`
--
ALTER TABLE `tb_poin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_popup`
--
ALTER TABLE `tb_popup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_post`
--
ALTER TABLE `tb_post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_prepaid`
--
ALTER TABLE `tb_prepaid`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_produk`
--
ALTER TABLE `tb_produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_produk_social`
--
ALTER TABLE `tb_produk_social`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_request_poin`
--
ALTER TABLE `tb_request_poin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_reward`
--
ALTER TABLE `tb_reward`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_seo`
--
ALTER TABLE `tb_seo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_slide`
--
ALTER TABLE `tb_slide`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_social`
--
ALTER TABLE `tb_social`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_stat`
--
ALTER TABLE `tb_stat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_testi`
--
ALTER TABLE `tb_testi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_token`
--
ALTER TABLE `tb_token`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_tripay`
--
ALTER TABLE `tb_tripay`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_tripayapi`
--
ALTER TABLE `tb_tripayapi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_wa`
--
ALTER TABLE `tb_wa`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_backup`
--
ALTER TABLE `tb_backup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_balance`
--
ALTER TABLE `tb_balance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_bank`
--
ALTER TABLE `tb_bank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_banner`
--
ALTER TABLE `tb_banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_jenis`
--
ALTER TABLE `tb_jenis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `tb_konfirmasi`
--
ALTER TABLE `tb_konfirmasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_notif`
--
ALTER TABLE `tb_notif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_order`
--
ALTER TABLE `tb_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_page`
--
ALTER TABLE `tb_page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_pemesan`
--
ALTER TABLE `tb_pemesan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_poin`
--
ALTER TABLE `tb_poin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_popup`
--
ALTER TABLE `tb_popup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_post`
--
ALTER TABLE `tb_post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_prepaid`
--
ALTER TABLE `tb_prepaid`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_produk`
--
ALTER TABLE `tb_produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_produk_social`
--
ALTER TABLE `tb_produk_social`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_request_poin`
--
ALTER TABLE `tb_request_poin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_reward`
--
ALTER TABLE `tb_reward`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_seo`
--
ALTER TABLE `tb_seo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_slide`
--
ALTER TABLE `tb_slide`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tb_social`
--
ALTER TABLE `tb_social`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_stat`
--
ALTER TABLE `tb_stat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=257;

--
-- AUTO_INCREMENT for table `tb_testi`
--
ALTER TABLE `tb_testi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_token`
--
ALTER TABLE `tb_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_tripay`
--
ALTER TABLE `tb_tripay`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_tripayapi`
--
ALTER TABLE `tb_tripayapi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_wa`
--
ALTER TABLE `tb_wa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
