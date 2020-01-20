-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2020 at 04:39 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scm-kemah-pancasila`
--

-- --------------------------------------------------------

--
-- Table structure for table `agenda`
--

CREATE TABLE `agenda` (
  `id_agenda` int(11) NOT NULL,
  `id_agenda_kategori` int(11) DEFAULT NULL,
  `judul` text NOT NULL,
  `lokasi` varchar(200) DEFAULT NULL,
  `deskripsi` text,
  `image` text NOT NULL,
  `date` date NOT NULL,
  `seo` text NOT NULL,
  `status` enum('Y','N') DEFAULT NULL,
  `view` int(11) NOT NULL,
  `last_update` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agenda`
--

INSERT INTO `agenda` (`id_agenda`, `id_agenda_kategori`, `judul`, `lokasi`, `deskripsi`, `image`, `date`, `seo`, `status`, `view`, `last_update`) VALUES
(5, 1, 'Vivamus egestas tincidunt enim,', NULL, '<p>Vivamus egestas tincidunt enim, sed tempor lectus consequat ac. Integer eleifend lacus id est ornare, tristique cursus nibh faucibus. Mauris ac urna quis sem pulvinar ultricies. Donec cursus eros in sapien fringilla hendrerit. Aenean quis enim in quam fermentum volutpat.</p>', 'vivamus-egestas-tincidunt-enim-413-17627.png', '2020-01-06', 'vivamus-egestas-tincidunt-enim', 'Y', 59, '2020-01-17 15:51:13'),
(7, 2, 'Vivamus egestas tincidunt enim,', NULL, '<p>Vivamus egestas tincidunt enim, sed tempor lectus consequat ac. Integer eleifend lacus id est ornare, tristique cursus nibh faucibus. Mauris ac urna quis sem pulvinar ultricies. Donec cursus eros in sapien fringilla hendrerit. Aenean quis enim in quam fermentum volutpat.</p>', 'vivamus-egestas-tincidunt-enim-789-17627.png', '2020-01-10', 'vivamus-egestas-tincidunt-enim', 'Y', 17, '2020-01-17 16:22:44'),
(6, 2, 'Vivamus egestas tincidunt enim,', NULL, '<p>Vivamus egestas tincidunt enim, sed tempor lectus consequat ac. Integer eleifend lacus id est ornare, tristique cursus nibh faucibus. Mauris ac urna quis sem pulvinar ultricies. Donec cursus eros in sapien fringilla hendrerit. Aenean quis enim in quam fermentum volutpat.</p>', 'sparkling-clean-609-17627.png', '2020-01-09', 'vivamus-egestas-tincidunt-enim', 'Y', 62, '2020-01-09 13:32:30');

-- --------------------------------------------------------

--
-- Table structure for table `amenities`
--

CREATE TABLE `amenities` (
  `id_amenities` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `seo` varchar(200) NOT NULL,
  `image` varchar(200) NOT NULL,
  `description` text,
  `dateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('1','0') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `amenities`
--

INSERT INTO `amenities` (`id_amenities`, `nama`, `seo`, `image`, `description`, `dateTime`, `status`) VALUES
(4, 'Armada Sangat Memadai', 'armada-sangat-memadai', 'armada-sangat-memadai-506-truck.png', '<p>Kami menyediakan armada yang dilengkapi dengan tanki stainless yang higienis untuk menjaga kualitas air bersih anda.</p>', '2019-12-19 17:00:00', '1'),
(5, 'Perijinan Usaha Lengkap', 'perijinan-usaha-lengkap', 'perijinan-lengkap-990-file.png', '<p>Segala izin telah lengkap dan terdaftar sebagai jaminan penyalur air bersih terbaik yang resmi dan legal.</p>', '2019-12-12 17:00:00', '1'),
(6, 'Lolos Uji Laboratorium', 'lolos-uji-laboratorium', 'lolos-uji-laboratorium-671-chemicals.png', '<p>Diambil dari mata air terlindung untuk kualitas terbaik. Kami melakukan uji test laboratorium secara berkala untuk menjamin kualitas air bagi para konsumen.</p>', '2019-12-12 17:00:00', '1'),
(7, 'Sumber Mata Air Tepercaya', 'sumber-mata-air-tepercaya', 'sumber-mata-air-tepercaya-941-h2o.png', '<p style=\"text-align: justify;\">Kami memastikan anda mendapatkan pasokan air bersih berkualitas dari sumber mata air terlindung yang hanya dapat diakses oleh Tirta Jaya.</p>\r\n<p style=\"text-align: justify;\">Sumber mata air kami dikelola secara professional.</p>', '2019-12-12 17:00:00', '1');

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `id_blog` int(11) NOT NULL,
  `id_blog_kategori` int(11) DEFAULT NULL,
  `judul` text NOT NULL,
  `deskripsi` text,
  `image` text NOT NULL,
  `date` date NOT NULL,
  `seo` text NOT NULL,
  `status` enum('Y','N') DEFAULT NULL,
  `view` int(11) NOT NULL,
  `last_update` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`id_blog`, `id_blog_kategori`, `judul`, `deskripsi`, `image`, `date`, `seo`, `status`, `view`, `last_update`) VALUES
(5, 1, 'Etiam sit amet sollicitudin mi.', '<p>Nullam placerat purus sed lectus lobortis varius. Curabitur placerat massa orci, tempor porta quam vulputate sed. Vestibulum suscipit arcu a diam congue mattis. Phasellus lobortis lorem erat, nec mollis ex iaculis ac. Curabitur finibus justo volutpat nisl accumsan convallis. Duis ultrices tempor nulla, eget porttitor lacus condimentum ac.</p>', 'etiam-sit-amet-sollicitudin-mi-738-file.png', '2020-01-07', 'etiam-sit-amet-sollicitudin-mi', 'Y', 59, '2020-01-17 15:51:23'),
(7, 2, 'Etiam sit amet sollicitudin mi.', '<p>Nullam placerat purus sed lectus lobortis varius. Curabitur placerat massa orci, tempor porta quam vulputate sed. Vestibulum suscipit arcu a diam congue mattis. Phasellus lobortis lorem erat, nec mollis ex iaculis ac. Curabitur finibus justo volutpat nisl accumsan convallis. Duis ultrices tempor nulla, eget porttitor lacus condimentum ac.</p>', 'glassware-much-like-plates-690-file.png', '2020-01-07', 'etiam-sit-amet-sollicitudin-mi', 'Y', 6, '2020-01-17 15:13:08'),
(6, 2, 'Etiam sit amet sollicitudin mi.', '<p>Nullam placerat purus sed lectus lobortis varius. Curabitur placerat massa orci, tempor porta quam vulputate sed. Vestibulum suscipit arcu a diam congue mattis. Phasellus lobortis lorem erat, nec mollis ex iaculis ac. Curabitur finibus justo volutpat nisl accumsan convallis. Duis ultrices tempor nulla, eget porttitor lacus condimentum ac.</p>', 'etiam-sit-amet-sollicitudin-mi-171-file.png', '2020-01-07', 'etiam-sit-amet-sollicitudin-mi', 'Y', 57, '2020-01-17 15:51:19');

-- --------------------------------------------------------

--
-- Table structure for table `blog_kategori`
--

CREATE TABLE `blog_kategori` (
  `id_blog_kategori` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `seo` varchar(120) NOT NULL,
  `gambar` text NOT NULL,
  `status` enum('Y','N') DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog_kategori`
--

INSERT INTO `blog_kategori` (`id_blog_kategori`, `nama`, `seo`, `gambar`, `status`) VALUES
(1, 'Students', 'students', '', NULL),
(2, 'Staff and Parents', 'staff-and-parents', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id_brand` int(11) NOT NULL,
  `id_produk_kategori` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `seo` varchar(200) NOT NULL,
  `image` varchar(200) NOT NULL,
  `catalog` text,
  `cover` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id_brand`, `id_produk_kategori`, `nama`, `seo`, `image`, `catalog`, `cover`) VALUES
(28, 4, 'F&B Linen', 'fb-linen', 'fb-linen-380-fb-linen.jpg', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `campus`
--

CREATE TABLE `campus` (
  `id_campus` int(11) NOT NULL,
  `name` text NOT NULL,
  `deskripsi` text,
  `image` text NOT NULL,
  `seo` text NOT NULL,
  `status` enum('Y','N') DEFAULT NULL,
  `last_update` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `campus`
--

INSERT INTO `campus` (`id_campus`, `name`, `deskripsi`, `image`, `seo`, `status`, `last_update`) VALUES
(5, 'Campus 1', '<p>Kampus 1</p>\r\n<p>alamat : Jalan Dewi Sartika No. 31, Tegalklaten, Klaten</p>', '', 'campus-1', 'Y', '2019-11-04 14:35:20'),
(7, 'Campus 3', '<p>Kampus 3</p>\r\n<p>Alamat : Jalan Cempaka No. 5, Ngepos, Klaten</p>', '', 'campus-3', 'Y', '2019-11-04 14:36:09'),
(6, 'Campus 2', '<p>Kampus 2</p>\r\n<p>Alamat : Jalan Tentara Pelajar, Gayamprit, Klaten</p>', '', 'campus-2', 'Y', '2019-11-04 14:35:45');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `id_client` int(11) NOT NULL,
  `id_client_kategori` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `seo` varchar(200) NOT NULL,
  `image` varchar(200) NOT NULL,
  `url` varchar(200) DEFAULT NULL,
  `dateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('1','0') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id_client`, `id_client_kategori`, `nama`, `seo`, `image`, `url`, `dateTime`, `status`) VALUES
(4, 0, 'Dikpora', 'dikpora', 'dikpora-997-tut_wuri.png', '#', '2020-01-02 17:00:00', '1'),
(5, 0, 'Rejomulia', 'rejomulia', 'rejomulia-787-rejomulia.png', '#', '2020-01-05 17:00:00', '1'),
(6, 0, 'BPIP', 'bpip', 'bpip-382-logo-bpip-baru.png', '#', '2020-01-02 17:00:00', '1');

-- --------------------------------------------------------

--
-- Table structure for table `client_kategori`
--

CREATE TABLE `client_kategori` (
  `id_client_kategori` int(11) NOT NULL,
  `judul` varchar(250) NOT NULL,
  `seo` varchar(250) NOT NULL,
  `status` enum('0','1') NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `download`
--

CREATE TABLE `download` (
  `id_download` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `seo` varchar(200) NOT NULL,
  `image` varchar(200) NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('1','0') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `download`
--

INSERT INTO `download` (`id_download`, `nama`, `seo`, `image`, `dateTime`, `status`) VALUES
(1, 'Slider', 'slider', 'slider-143-1.jpg', '2019-11-04 17:00:00', '1'),
(2, 'tes', 'tes', 'tes-410-4 Days _ Luang Prabang Photography trip with Bobby Lee _ Country Holidays Singapore.pdf', '2019-11-04 17:00:00', '1');

-- --------------------------------------------------------

--
-- Table structure for table `enquiry`
--

CREATE TABLE `enquiry` (
  `id_enquiry` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(25) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `id_produk` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `message` text NOT NULL,
  `attachment` varchar(250) DEFAULT NULL,
  `status` enum('0','1') NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `enquiry`
--

INSERT INTO `enquiry` (`id_enquiry`, `name`, `email`, `phone`, `id_produk`, `alamat`, `message`, `attachment`, `status`, `dateTime`) VALUES
(15, 'mastop', 'tes@gmail.com', '0896568656', '1', 'Jogja', 'Test', NULL, '1', '2019-07-06 08:03:16');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id_gallery` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `seo` varchar(200) NOT NULL,
  `image` varchar(200) NOT NULL,
  `url` varchar(200) DEFAULT NULL,
  `dateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('1','0') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id_gallery`, `id_kategori`, `nama`, `seo`, `image`, `url`, `dateTime`, `status`) VALUES
(1, 1, 'Gunung Slamet', 'gunung-slamet', 'gunung-slamet-355-DJI_0045.JPG', NULL, '2019-12-20 10:00:00', '1'),
(2, 1, 'Sumber Mata Air Gunung Slamet', 'sumber-mata-air-gunung-slamet', 'sumber-mata-air-gunung-slamet-646-DJI_0051.JPG', NULL, '2019-12-20 10:00:00', '1'),
(3, 1, 'Sumber Mata Air Gunung Slamet', 'sumber-mata-air-gunung-slamet', 'sumber-mata-air-gunung-slamet-30-DJI_0064.JPG', NULL, '2019-12-20 10:00:00', '1'),
(4, 2, 'Crew', 'crew', 'crew-367-DSC05043.JPG', NULL, '2019-12-22 17:00:00', '1');

-- --------------------------------------------------------

--
-- Table structure for table `gallery_kategori`
--

CREATE TABLE `gallery_kategori` (
  `id_kategori` int(11) NOT NULL,
  `judul` varchar(250) NOT NULL,
  `seo` varchar(250) NOT NULL,
  `status` enum('0','1') NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gallery_kategori`
--

INSERT INTO `gallery_kategori` (`id_kategori`, `judul`, `seo`, `status`, `dateTime`) VALUES
(1, 'Pusat', 'pusat', '0', '2019-12-21 03:30:54'),
(2, 'Crew', 'crew', '0', '2019-12-23 04:12:11');

-- --------------------------------------------------------

--
-- Table structure for table `hastags`
--

CREATE TABLE `hastags` (
  `id` int(11) NOT NULL,
  `tag` varchar(100) DEFAULT NULL,
  `category` enum('ig') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hastags`
--

INSERT INTO `hastags` (`id`, `tag`, `category`) VALUES
(1, 'kemahpancasila2019', 'ig');

-- --------------------------------------------------------

--
-- Table structure for table `kontak`
--

CREATE TABLE `kontak` (
  `id_kontak` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `judul` varchar(150) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `image` varchar(200) NOT NULL,
  `deskripsi` tinytext CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `tgl_posting` date NOT NULL,
  `jenis` enum('address','phone','email','location') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kontak`
--

INSERT INTO `kontak` (`id_kontak`, `nama`, `judul`, `image`, `deskripsi`, `tgl_posting`, `jenis`) VALUES
(7, 'Email', 'support@kemahpancasila.com', 'email-599-email.png', 'Email                                                ', '2018-04-06', 'email'),
(8, 'Customer Service', '0811 268 775', 'call-248-phone-receiver.png', 'Call Now                                                       ', '2018-04-06', 'phone'),
(1, 'Address', 'Jl. Ki Ageng Pemanahan No.30A, Sorosutan, Kec. Umbulharjo, Kota Yogyakarta, Daerah Istimewa Yogyakarta 55162', '', '                                                ', '2018-04-06', 'address'),
(14, 'Whatsapp', '081 1255 1355', '', '', '0000-00-00', 'address');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id_messages` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(25) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `attachment` varchar(250) NOT NULL,
  `status` enum('0','1') NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id_messages`, `name`, `email`, `phone`, `subject`, `message`, `attachment`, `status`, `dateTime`) VALUES
(12, 'yorn', 'yorn@gmail.com', '09832786', 'test', 'tes', '', '1', '2019-07-05 08:13:33'),
(13, 'Steve Jobs', 'addthisjs@gmail.com', '094805694', 'Permission issue', 'frtujfg', '', '1', '2019-12-17 08:19:57');

-- --------------------------------------------------------

--
-- Table structure for table `modul`
--

CREATE TABLE `modul` (
  `id_modul` int(5) NOT NULL,
  `nama_modul` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `link` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `static_content` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `gambar` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `publish` enum('Y','N') CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'Y',
  `status` enum('user','admin') CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `aktif` enum('Y','N') CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'Y',
  `urutan` int(5) NOT NULL,
  `link_seo` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `modul`
--

INSERT INTO `modul` (`id_modul`, `nama_modul`, `link`, `static_content`, `gambar`, `publish`, `status`, `aktif`, `urutan`, `link_seo`) VALUES
(2, 'Web Keyword', '?module=keyword', 'kemah pancasila,', '', 'Y', 'admin', 'Y', 0, ''),
(4, 'Vision And Mission', '', '<p class=\"mt-4\">Menjadi perusahaan distribusi air bersih dan sehat yang unggul dalam kualitas.</p>\r\n<hr />\r\n<ul class=\"w3l-right-book mt-4\">\r\n<li>Menyediakan air bersih yang resmi legal, &amp; memperhatikan kelestarian lingkungan</li>\r\n<li>Menyediakan air bersih yang sehat, berkualitas dan teruji laboratorium</li>\r\n<li>Memberikan pelayanan yang ramah, sopan, dan berorientasi pada pelanggan</li>\r\n<li>Menggunakan kendaraan dan tangki air dengan kondisi bagus, bersih, dan terawat</li>\r\n<li>Meningkatkan kinerja SDM yang dimiliki untuk mencapai loyalitas pelanggan</li>\r\n</ul>', '468-b1.png', 'Y', 'admin', 'Y', 0, ''),
(1, 'Web Tittle', '?module=tittle', 'Kemah Pancasila', '', 'Y', 'admin', 'Y', 0, ''),
(3, 'Web Diskripsi', '?module=diskripsi', 'Kemah Pancasila', '', 'Y', 'admin', 'Y', 0, ''),
(5, 'About Us', '', '<p>Air sebagai sumber kehidupan <strong>73%</strong> zat pembentuk tubuh manusia adalah <strong>Air</strong>. Populasi manusia terus bertambah, kebutuhan akan air bersih meningkat. Sementara ketersediaan iar bersih menurun.</p>\r\n<p>Lingkungan hidup kita semakin maju, semakin padat semakin tercemar. Ketersediaan air tanah sangat menipis baik kuantitas maupun kualitas.</p>\r\n<p>Maka, kami hadir untuk memberikan <strong>SOLUSI TEPAT BAGI KEBUTUHAN AIR BERKUALITAS.</strong></p>', '541-file.png', 'Y', 'admin', 'Y', 0, ''),
(10, 'Welcome', '', '<p style=\"text-align: justify;\">CV. Melati Mas adalah perusahaan yang secara khusus memasok berbagai kebutuhan Hotel, Restoran dan Rumah Sakit dengan berbagai merk dan kwalitas yang memenuhi standar Hotel, Restoran dan Rumah Sakit.</p>\r\n<p style=\"text-align: justify;\">CV. Melati Mas tidak hanya menjual produk-produk LINEN (Bed Linen, Room Linen , Table Linen), Akan tetapi kami juga menjual berbagai macam kebutuhan seperti BANQUET EQUIPMENT (China Ware, Glass Ware, Flat Ware), KITCHEN EQUIPMENT (Cook Ware, Food Preparative, Kitchen Accessories, Kitchen Utensil, Knife, Cutting and Carving Tool, Board, Butchery Supplies, Catering and Transport Equipment), LAUNDRY MACHINE, LAUNDRY EQUIPMENT, HOUSKEEPING EQUIPMENT Selain itu kami juga menjual kebutuhan lainnya dengan jumlah produknya yang mencapai lebih dari 3.000 items dari berbagai merk yang memenuhi standar Hotel, Restoran dan Rumah Sakit.</p>', '', 'Y', 'admin', 'Y', 0, ''),
(6, 'Maps', '', 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15810.552719725321!2d110.3773248!3d-7.8280649!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xac8d90905871c1b5!2sJogjaSite.com!5e0!3m2!1sid!2sid!4v1576640694237!5m2!1sid!2sid', '', 'Y', 'admin', 'Y', 0, ''),
(7, 'Info Kontak', '', '<p style=\"text-align: left;\"><strong>info@otoplus.co.id</strong></p>', '', 'Y', 'admin', 'Y', 0, ''),
(8, 'Testimoni', '', '<p>Testimoni&nbsp;</p>', '', 'Y', 'admin', 'Y', 0, ''),
(11, 'Cara Pemesanan', '', '<div class=\"about-title\">\r\n<h2>Cara Pemesanan</h2>\r\n<p>Untuk info pemesanan hubungi kami :<br/>\r\nJl. P. Wirosobo no:100 Wirosaban Sorosutan Umbulharjo Yogyakarta<br/>\r\nPhone : 0811254215<br/>\r\nE-mail: mitrautamatenda@gmail.com <br/>\r\nWebsite: www.MUtendaJogja.com</p>\r\n</div>', 'img750x320.jpg', 'Y', 'admin', 'Y', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `id_brand` int(11) NOT NULL,
  `id_produk_kategori` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `seo` varchar(250) NOT NULL,
  `deskripsi` text NOT NULL,
  `image` text NOT NULL,
  `date` date NOT NULL,
  `status` enum('Y','N') NOT NULL,
  `best_seller` enum('Y','N') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `id_brand`, `id_produk_kategori`, `nama`, `seo`, `deskripsi`, `image`, `date`, `status`, `best_seller`) VALUES
(1, 28, 4, 'Napkin & Placemat ', 'napkin--placemat-', '', 'napkin--placemat--567-94Model & Tableset 3.jpg', '2019-07-06', 'Y', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `produk_kategori`
--

CREATE TABLE `produk_kategori` (
  `id_produk_kategori` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `seo` varchar(120) NOT NULL,
  `gambar` text NOT NULL,
  `status` enum('Y','N') DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk_kategori`
--

INSERT INTO `produk_kategori` (`id_produk_kategori`, `nama`, `seo`, `gambar`, `status`) VALUES
(1, 'Chinaware', 'chinnaware', '', NULL),
(2, 'Glassware', 'glassware', '', NULL),
(3, 'Cutleries', 'cutleries', '', NULL),
(4, 'Linen', 'linen', '', NULL),
(5, 'Kitchen Equipment', 'kitchen-equipment', '', NULL),
(6, 'Kitchen Utensil', 'kitchen-utensil', '', NULL),
(7, 'Furniture', 'furniture', '', NULL),
(8, 'Housekeeping Equipment', 'housekeeping-equipment', '', NULL),
(11, 'Amenities', 'amenities', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

CREATE TABLE `program` (
  `id_program` int(11) NOT NULL,
  `id_program_kategori` int(11) DEFAULT NULL,
  `judul` text NOT NULL,
  `deskripsi` text,
  `image` text NOT NULL,
  `date` date NOT NULL,
  `seo` text NOT NULL,
  `status` enum('Y','N') DEFAULT NULL,
  `view` int(11) NOT NULL,
  `last_update` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `program`
--

INSERT INTO `program` (`id_program`, `id_program_kategori`, `judul`, `deskripsi`, `image`, `date`, `seo`, `status`, `view`, `last_update`) VALUES
(5, 2, 'Donec id interdum tellus.', '<p style=\"text-align: justify;\">Etiam massa ante, suscipit id libero a, vulputate ullamcorper nisl. Maecenas sed consequat tellus. Nunc finibus tincidunt nulla. Curabitur iaculis purus dui, sed ullamcorper dui congue vitae. Interdum et malesuada fames ac ante ipsum primis in faucibus. Aliquam eget arcu ex. Maecenas ac purus quis orci congue ultrices. Maecenas sed nisl malesuada, molestie tortor sed, congue dolor. Praesent hendrerit ullamcorper enim vitae pellentesque. Donec quis rhoncus dolor, egestas placerat risus.</p>', 'donec-id-interdum-tellus-838-kemah.png', '2020-01-09', 'donec-id-interdum-tellus', 'Y', 60, '2020-01-09 13:44:07'),
(6, 2, 'Donec id interdum tellus.', '<p style=\"text-align: justify;\">Etiam massa ante, suscipit id libero a, vulputate ullamcorper nisl. Maecenas sed consequat tellus. Nunc finibus tincidunt nulla. Curabitur iaculis purus dui, sed ullamcorper dui congue vitae. Interdum et malesuada fames ac ante ipsum primis in faucibus. Aliquam eget arcu ex. Maecenas ac purus quis orci congue ultrices. Maecenas sed nisl malesuada, molestie tortor sed, congue dolor. Praesent hendrerit ullamcorper enim vitae pellentesque. Donec quis rhoncus dolor, egestas placerat risus.</p>', 'donec-id-interdum-tellus-920-kemah.png', '2020-01-09', 'donec-id-interdum-tellus', 'Y', 56, '2020-01-17 15:28:44');

-- --------------------------------------------------------

--
-- Table structure for table `program_kategori`
--

CREATE TABLE `program_kategori` (
  `id_program_kategori` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `seo` varchar(120) NOT NULL,
  `gambar` text NOT NULL,
  `status` enum('Y','N') DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `program_kategori`
--

INSERT INTO `program_kategori` (`id_program_kategori`, `nama`, `seo`, `gambar`, `status`) VALUES
(1, 'Students', 'students', '', NULL),
(2, 'Staff and Parents', 'staff-and-parents', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `school`
--

CREATE TABLE `school` (
  `id_school` int(11) NOT NULL,
  `name` text NOT NULL,
  `deskripsi` text,
  `image` text NOT NULL,
  `seo` text NOT NULL,
  `status` enum('Y','N') DEFAULT NULL,
  `last_update` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `school`
--

INSERT INTO `school` (`id_school`, `name`, `deskripsi`, `image`, `seo`, `status`, `last_update`) VALUES
(5, 'Preschool in English', '<p>(coming soon)</p>', '', 'preschool-in-english', 'Y', '2019-10-28 10:52:26'),
(7, 'Kindergarten in English', '<p>(coming soon)</p>', '', 'kindergarten-in-english', 'Y', NULL),
(6, 'Full Day School', '<p>The parents are able to choose whether their children study in regular class only or join Speak First Full-Day School.<br />Orang tua diperbolehkan untuk memilih apakah anak mereka mengikuti kelas reguler saja atau juga mengikuti Speak First Full-Day School. </p>', '', 'full-day-school', 'Y', '2019-10-28 10:54:37'),
(8, 'Bilingual Primary School', '<p style=\"text-align: justify;\">Speak First Bilingual Primary School (SD Dwibahasa Speak First), also known as SD Speak First is the first and only Integrated Bilingual Primary School in Central Klaten. SD Speak First started to serve the community in academic years 2010/2011. Two classes have been graduated from SD Speak First with excellent achievement. SD Speak First also got an A for the accreditation process (<strong>Terakreditasi A</strong>).<br />Our goals are to develop our students&rsquo; academic and non-academic skills, English skills and characters to enrich the education in Klaten.</p>\r\n<p style=\"text-align: justify;\"><br />Speak First Bilingual Primary School (SD Dwibahasa Speak First) atau yang lebih dikenal dengan SD Speak First adalah SD Terpadu Dwibahasa pertama dan satu&ndash;satunya di Klaten Tengah. SD Speak First mulai melayani masyarakat pada tahun ajaran 2010/2011, dan telah meluluskan 2 angkatan. Adapun SD Speak First telah memperoleh nilai <strong>AKREDITASI A</strong>.<br />Tujuan Speak First adalah terwujudnya harapan pihak sekolah dan orang tua/ wali murid dalam memajukan pendidikan di kota Klaten, dan mengembangkan akademik, keterampilan berbahasa Inggris, serta karakter anak.</p>', '', 'bilingual-primary-school', 'Y', NULL),
(9, 'English Course', '<p>(coming soon)</p>', '', 'english-course', 'Y', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `school_sub`
--

CREATE TABLE `school_sub` (
  `id_school_sub` int(11) NOT NULL,
  `id_school` int(11) NOT NULL,
  `name` text NOT NULL,
  `deskripsi` text,
  `seo` text NOT NULL,
  `status` enum('Y','N') DEFAULT NULL,
  `last_update` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `school_sub`
--

INSERT INTO `school_sub` (`id_school_sub`, `id_school`, `name`, `deskripsi`, `seo`, `status`, `last_update`) VALUES
(7, 5, 'Monthly Activities', '<ul>\r\n<li>Audio-visual</li>\r\n<li>Swimming</li>\r\n<li>Cooking</li>\r\n<li>Mini trip</li>\r\n</ul>', 'monthly-activities', 'Y', '2019-10-29 14:16:19'),
(6, 5, 'Creative Learning Center', '<ul>\r\n<li>Science</li>\r\n<li>Block</li>\r\n<li>Role play</li>\r\n<li>Art</li>\r\n<li>Literacy</li>\r\n<li>Moral and religion</li>\r\n</ul>', 'creative-learning-center', 'Y', '2019-10-29 14:15:57'),
(4, 5, 'Classes', '<ul>\r\n<li>Blue Class (2-3 years old toddlers)</li>\r\n<li>Yellow Class (3-4 years old toddlers)</li>\r\n</ul>', 'classes', 'Y', '2019-10-29 14:15:04'),
(5, 5, 'Daily Activities', '<ul>\r\n<li>Class time</li>\r\n<li>Playground time</li>\r\n<li>Creative learning center</li>\r\n<li>Snack time</li>\r\n<li>Brush teeth</li>\r\n</ul>', 'daily-activities', 'Y', '2019-10-29 14:15:38'),
(8, 5, 'Annual Activities', '<ul>\r\n<li>Annual Performance</li>\r\n<li>Fieldtrip</li>\r\n<li>Halal bihalal&amp; Natal</li>\r\n</ul>', 'annual-activities', 'Y', '2019-10-29 14:16:51'),
(9, 5, 'Special Occasion', '<ul>\r\n<li>Charity</li>\r\n<li>Medical Check-Up</li>\r\n<li>Native Guest</li>\r\n</ul>', 'special-occasion', 'Y', '2019-10-29 14:17:10'),
(14, 6, 'Daily Activities', '<ul>\r\n<li>Bible and religion time</li>\r\n<li>Lunch time</li>\r\n<li>Creative area</li>\r\n<li>Nap time</li>\r\n</ul>', 'daily-activities', 'Y', NULL),
(15, 7, 'Daily Activities', '<ol>\r\n<li>Gym or flag ceremony</li>\r\n<li>Classroom time</li>\r\n<li>Group time</li>\r\n<li>Creative area</li>\r\n<li>Snack time and brush teeth</li>\r\n<li>Playground time</li>\r\n</ol>', 'daily-activities', 'Y', NULL),
(16, 7, 'Creative Area', '<ol>\r\n<li>Art</li>\r\n<li>Music</li>\r\n<li>House corner</li>\r\n<li>Library</li>\r\n<li>Toys</li>\r\n<li>Literacy</li>\r\n<li>Block</li>\r\n<li>Puzzle</li>\r\n<li>Playdough</li>\r\n<li>Math</li>\r\n<li>Science</li>\r\n<li>Computer</li>\r\n</ol>', 'creative-area', 'Y', NULL),
(17, 7, 'Religion Area', '<ol>\r\n<li>Moslem</li>\r\n<li>Christian</li>\r\n</ol>', 'religion-area', 'Y', NULL),
(18, 7, 'Extracurriculars', '<ol>\r\n<li>Drum band</li>\r\n<li>Literacy / mini drama</li>\r\n<li>Drawing and coloring</li>\r\n<li>Dance</li>\r\n</ol>', 'extracurriculars', 'Y', NULL),
(19, 7, 'Monthly Activities', '<ol>\r\n<li>Cooking</li>\r\n<li>Gardening</li>\r\n<li>Mini trip</li>\r\n<li>Science</li>\r\n<li>Role play</li>\r\n<li>Swimming</li>\r\n</ol>', 'monthly-activities', 'Y', NULL),
(20, 7, 'Annual Activities', '<ol>\r\n<li>Field trip</li>\r\n<li>Annual performance</li>\r\n<li>Halal bihalal and Christmas</li>\r\n<li>Graduation day</li>\r\n</ol>', 'annual-activities', 'Y', NULL),
(21, 7, 'Special Occasion', '<ol>\r\n<li>Psychological consultation</li>\r\n<li>Medical check-up</li>\r\n<li>Native guest</li>\r\n</ol>', 'special-occasion', 'Y', NULL),
(22, 7, 'Achievement', '<ol>\r\n<li>Vocabulary</li>\r\n<li>Coloring</li>\r\n<li>Drum band</li>\r\n<li>Story telling</li>\r\n<li>Gebyar PAUD (Klaten &amp; Jawa Tengah)</li>\r\n</ol>', 'achievement', 'Y', NULL),
(23, 8, 'Schedule', '<p>Monday-Thursday&nbsp;&nbsp; : 07.00 &ndash; 14.30 (including extracurricular activities)</p>', 'schedule', 'Y', NULL),
(24, 8, 'Subjects', '<ol>\r\n<li>Bahasa Indonesia</li>\r\n<li>Matematika</li>\r\n<li>IPA</li>\r\n<li>IPS</li>\r\n<li>PKn</li>\r\n<li>Agama</li>\r\n<li>Seni Budaya</li>\r\n<li>Bahasa Jawa</li>\r\n<li>English</li>\r\n<li>Character building</li>\r\n<li>Physical Exercise and Health</li>\r\n<li>Computer</li>\r\n<li>Art</li>\r\n</ol>', 'subjects', 'Y', NULL),
(25, 8, 'Extracurriculars', '<ol>\r\n<li>Pramuka (Scout)</li>\r\n<li>Baca Tulis Alquran dan Iqra&rsquo;</li>\r\n<li>Pendalaman Alkitab</li>\r\n<li>English Drama</li>\r\n<li>Drawing and Coloring</li>\r\n<li>Dance Class</li>\r\n<li>School Band</li>\r\n<li>Advanced Drawing</li>\r\n<li>Choir</li>\r\n<li>Violin</li>\r\n<li>Swimming</li>\r\n<li>Tutor dan tambahan pelajaran</li>\r\n</ol>', 'extracurriculars', 'Y', NULL),
(26, 8, 'Flagship Programs', '<ol>\r\n<li style=\"text-align: justify;\"><u> Singapore Immersion Program</u></li>\r\n</ol>\r\n<p style=\"text-align: justify; padding-left: 30px;\">The students visit one of the well-known schools in Singapore and some educative tourism objects. This program teaches the students to implement the materials that they have studied at school. The students can practice using their English with the people there. This program also builds the students&rsquo; self-dependence and responsibility.</p>\r\n<ol style=\"text-align: justify;\" start=\"2\">\r\n<li><u> Local Immersion Program</u></li>\r\n</ol>\r\n<p style=\"text-align: justify; padding-left: 30px;\">The students visit one of the well-known schools in Yogyakarta. They study and practice their English skills there. This program prepares the students for Singapore Immersion Program.</p>\r\n<ol style=\"text-align: justify;\" start=\"3\">\r\n<li><u> School Camp </u></li>\r\n</ol>\r\n<p style=\"text-align: justify; padding-left: 30px;\">School Camp program builds the students&rsquo; self-dependence and responsibility.</p>\r\n<ol style=\"text-align: justify;\" start=\"4\">\r\n<li><u> Entrepreneurship Program</u></li>\r\n</ol>\r\n<p style=\"text-align: justify; padding-left: 30px;\">This program is held every 3 months. The goal of this program is to implement student&rsquo;s Math skills, leadership and creativity.</p>\r\n<ol style=\"text-align: justify;\" start=\"5\">\r\n<li><u> Mini Trip/ Field Trip</u></li>\r\n</ol>\r\n<p style=\"text-align: justify; padding-left: 30px;\">This program is usually held every semester, after the semester test. However, pop-up trips often appear during the learning time. The students visit educative places around Klaten.</p>\r\n<ol style=\"text-align: justify;\" start=\"6\">\r\n<li><u> Talent Show/ Annual Performance</u></li>\r\n</ol>\r\n<p style=\"text-align: justify;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; The students show their amazing talents in this annual performance.</p>\r\n<hr />\r\n<ol style=\"text-align: justify;\">\r\n<li><em><u> Singapore Immersion Program</u></em></li>\r\n</ol>\r\n<p style=\"text-align: justify; padding-left: 30px;\"><em>Kegiatan belajar di sekolah lain yang mirip Speak First di Singapura, dengan tujuan studi banding, mempraktekkan kemampuan berbahasa Inggris, menerapkan materi yang telah dipelajari di sekolah, sekaligus melatih kemandirian dan tanggung jawab siswa.</em></p>\r\n<ol style=\"text-align: justify;\" start=\"2\">\r\n<li><em><u> Local Immersion Program</u></em></li>\r\n</ol>\r\n<p style=\"text-align: justify; padding-left: 30px;\"><em>Kegiatan belajar di sekolah lain (di Yogyakarta) yang mirip Speak First untuk studi banding dan mempraktekkan kemampuan berbahasa Inggris, sekaligus melatih kemandirian siswa.</em></p>\r\n<ol style=\"text-align: justify;\" start=\"3\">\r\n<li><em><u> School Camp </u></em></li>\r\n</ol>\r\n<p style=\"text-align: justify; padding-left: 30px;\"><em>Kemah Sekolah untuk melatih kemandirian dan tanggung jawab siswa.</em></p>\r\n<ol style=\"text-align: justify;\" start=\"4\">\r\n<li><em><u> Entrepreneurship Program</u></em></li>\r\n</ol>\r\n<p style=\"text-align: justify; padding-left: 30px;\"><em>Kegiatan kewirausahaan di sekolah yang bertujuan untuk menerapkan kemampuan berhitung, kepemimpinan, dan kreativitas siswa.</em></p>\r\n<ol style=\"text-align: justify;\" start=\"5\">\r\n<li><em> <u> Mini Trip/ Field Trip</u></em></li>\r\n</ol>\r\n<p style=\"text-align: justify; padding-left: 30px;\"><em>Kegiatan kunjungan belajar ke tempat&ndash;tempat edukatif di sekitar Klaten. Biasanya dilaksanakan saat kegiatan jeda semester.</em></p>\r\n<ol style=\"text-align: justify;\" start=\"6\">\r\n<li><em> <u> Talent Show/ Annual Performance</u></em></li>\r\n</ol>\r\n<p style=\"text-align: justify; padding-left: 30px;\"><em>Ajang unjuk bakat siswa/i SD Speak First yang dilaksanakan setiap tahunnya.</em></p>', 'flagship-programs', 'Y', '2019-10-30 10:44:27'),
(27, 8, 'Achievement', '<ul>\r\n<li>1<sup>st</sup> winner of National Matematika Olympiad, Prime Generation,</li>\r\n<li>1<sup>st</sup>, 2<sup>nd</sup> and 3<sup>rd</sup> winner of Regional Matematika and Sains Olympiad, Prime Generation,</li>\r\n<li>2<sup>nd</sup> winner of international piano festival in Malaysia,</li>\r\n<li>2<sup>nd</sup> winner of Regional Sains Olympiad,</li>\r\n<li>1<sup>st</sup>, 2<sup>nd</sup>, 3<sup>rd</sup> winner and top ten winner of Province IPA, Matematika and English Olympiad, Emerald Education Center,</li>\r\n<li>top ten winner of National IPA, Matematika and English Olympiad, Emerald Education Center,</li>\r\n<li>3<sup>rd</sup> runner up of Purwacaraka Music School Choir Competition in Yogyakarta,</li>\r\n<li>3<sup>rd</sup> winner of Central Klaten painting competition,</li>\r\n<li>and many more!</li>\r\n</ul>', 'achievement', 'Y', '2019-11-21 16:09:31');

-- --------------------------------------------------------

--
-- Table structure for table `slide`
--

CREATE TABLE `slide` (
  `id_slide` int(11) NOT NULL,
  `kat` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `gambar` varchar(150) NOT NULL,
  `deskripsi` varchar(350) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slide`
--

INSERT INTO `slide` (`id_slide`, `kat`, `nama`, `gambar`, `deskripsi`) VALUES
(13, 1, 'Speak First', 'speak-first-423-6.jpg', 'Contoh deskripsi slide...'),
(14, 1, 'Speak First', 'speak-first-864-5.jpg', 'Contoh deskripsi sample slide 2 .....'),
(16, 1, 'Speak First', 'speak-first-855-4.jpg', ''),
(17, 1, 'Speak First', 'speak-first-10-3.jpg', ''),
(19, 1, 'Speak First', 'speak-first-420-2.jpg', ''),
(22, 5, 'kampus1', 'kampus1-311-kampus1.jpg', ''),
(23, 6, 'kampus2', 'kampus2-180-kampus2.jpg', ''),
(24, 7, 'kampus3', 'kampus3-852-kampus3.jpg', '');

-- --------------------------------------------------------

--
-- Table structure for table `slide_title`
--

CREATE TABLE `slide_title` (
  `id_slide_title` int(11) NOT NULL,
  `title1` varchar(20) DEFAULT NULL,
  `title2` varchar(50) DEFAULT NULL,
  `title3` varchar(50) DEFAULT NULL,
  `deskripsi` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slide_title`
--

INSERT INTO `slide_title` (`id_slide_title`, `title1`, `title2`, `title3`, `deskripsi`) VALUES
(1, '', 'Hotel, Restaurant, Hospital,', 'Supplier & Engineering', '');

-- --------------------------------------------------------

--
-- Table structure for table `sosmed`
--

CREATE TABLE `sosmed` (
  `id_sosmed` int(3) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `link` varchar(150) NOT NULL,
  `gambar` varchar(150) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sosmed`
--

INSERT INTO `sosmed` (`id_sosmed`, `nama`, `link`, `gambar`) VALUES
(2, 'Facebook', 'https://www.facebook.com/', '558715facebook.png'),
(3, 'Twitter', 'https://twitter.com/', '714263twitter.png'),
(4, 'Google +', 'https://www.plus.google.com/', 'google--558-653381google.png'),
(6, 'Instagram', 'https://instagram.com/', 'instagram-106-instagram.png');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id_staff` int(11) NOT NULL,
  `name` text NOT NULL,
  `deskripsi` text,
  `seo` text NOT NULL,
  `status` enum('Y','N') DEFAULT NULL,
  `last_update` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id_staff`, `name`, `deskripsi`, `seo`, `status`, `last_update`) VALUES
(1, 'Trainer', '<p>(coming soon)</p>', 'trainer', 'Y', '2020-01-08 11:18:28'),
(2, 'Fasilitator', '<p>(coming soon)</p>', 'fasilitator', 'Y', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `staff_gallery`
--

CREATE TABLE `staff_gallery` (
  `id_staff_gallery` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `seo` varchar(200) NOT NULL,
  `image` varchar(200) NOT NULL,
  `deskripsi` text,
  `dateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('1','0') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `staff_gallery`
--

INSERT INTO `staff_gallery` (`id_staff_gallery`, `id_kategori`, `nama`, `seo`, `image`, `deskripsi`, `dateTime`, `status`) VALUES
(1, 1, 'Mark Zuckerberg', 'mark-zuckerberg', 'mark-zuckerberg-134-mark-zuckerberg.jpg', '<p>Pulvinar neque laoreet suspendisse interdum consectetur libero id. Lacus viverra vitae congue eu consequat ac. In arcu cursus euismod quis viverra nibh. Et malesuada fames ac turpis. Diam sit amet nisl suscipit adipiscing bibendum est ultricies integer. Mi ipsum faucibus vitae aliquet nec ullamcorper sit amet. Convallis convallis tellus id interdum velit laoreet id donec. Laoreet sit amet cursus sit amet dictum sit. Vel eros donec ac odio tempor orci. Urna condimentum mattis pellentesque id nibh tortor id aliquet. Venenatis cras sed felis eget velit. Porta non pulvinar neque laoreet suspendisse interdum. Dis parturient montes nascetur ridiculus mus. Viverra accumsan in nisl nisi scelerisque. Ut tristique et egestas quis ipsum suspendisse. Sed cras ornare arcu dui vivamus. Tincidunt tortor aliquam nulla facilisi cras. Nulla aliquet enim tortor at auctor.</p>', '2020-01-07 17:00:00', '1'),
(2, 2, 'Bill Gates', 'bill-gates', 'bill-gates-231-bill-gates.jpeg', '<p>Ac feugiat sed lectus vestibulum mattis. At urna condimentum mattis pellentesque id. Tristique nulla aliquet enim tortor. Nam aliquam sem et tortor consequat. Ut morbi tincidunt augue interdum veli', '2020-01-07 17:00:00', '1'),
(12, 1, 'Bill Gates', 'bill-gates', 'bill-gates-82-bill-gates.jpeg', '<p>Pulvinar neque laoreet suspendisse interdum consectetur libero id. Lacus viverra vitae congue eu consequat ac. In arcu cursus euismod quis viverra nibh. Et malesuada fames ac turpis. Diam sit amet nisl suscipit adipiscing bibendum est ultricies integer. Mi ipsum faucibus vitae aliquet nec ullamcorper sit amet. Convallis convallis tellus id interdum velit laoreet id donec. Laoreet sit amet cursus sit amet dictum sit. Vel eros donec ac odio tempor orci. Urna condimentum mattis pellentesque id nibh tortor id aliquet. Venenatis cras sed felis eget velit. Porta non pulvinar neque laoreet suspendisse interdum. Dis parturient montes nascetur ridiculus mus. Viverra accumsan in nisl nisi scelerisque. Ut tristique et egestas quis ipsum suspendisse. Sed cras ornare arcu dui vivamus. Tincidunt tortor aliquam nulla facilisi cras. Nulla aliquet enim tortor at auctor.</p>', '2020-01-07 17:00:00', '1'),
(13, 1, 'Elon Musk', 'elon-musk', 'elon-musk-993-Elon-musk.jpg', '<p>Pulvinar neque laoreet suspendisse interdum consectetur libero id. Lacus viverra vitae congue eu consequat ac. In arcu cursus euismod quis viverra nibh. Et malesuada fames ac turpis. Diam sit amet nisl suscipit adipiscing bibendum est ultricies integer. Mi ipsum faucibus vitae aliquet nec ullamcorper sit amet. Convallis convallis tellus id interdum velit laoreet id donec. Laoreet sit amet cursus sit amet dictum sit. Vel eros donec ac odio tempor orci. Urna condimentum mattis pellentesque id nibh tortor id aliquet. Venenatis cras sed felis eget velit. Porta non pulvinar neque laoreet suspendisse interdum. Dis parturient montes nascetur ridiculus mus. Viverra accumsan in nisl nisi scelerisque. Ut tristique et egestas quis ipsum suspendisse. Sed cras ornare arcu dui vivamus. Tincidunt tortor aliquam nulla facilisi cras. Nulla aliquet enim tortor at auctor.</p>', '2020-01-07 17:00:00', '1'),
(14, 2, 'Jack Ma', 'jack-ma', 'jack-ma-887-JackMa-Alibaba.jpg', '<p>Ac feugiat sed lectus vestibulum mattis. At urna condimentum mattis pellentesque id. Tristique nulla aliquet enim tortor. Nam aliquam sem et tortor consequat. Ut morbi tincidunt augue interdum veli', '2020-01-07 17:00:00', '1');

-- --------------------------------------------------------

--
-- Table structure for table `statistik`
--

CREATE TABLE `statistik` (
  `ip` varchar(20) NOT NULL DEFAULT '',
  `tanggal` date NOT NULL,
  `hits` int(10) NOT NULL DEFAULT '1',
  `online` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `statistik`
--

INSERT INTO `statistik` (`ip`, `tanggal`, `hits`, `online`) VALUES
('::1', '2019-12-16', 2, '1579490856'),
('::1', '2019-12-17', 2, '1579490856'),
('::1', '2019-12-18', 2, '1579490856'),
('127.0.0.1', '2019-12-18', 122, '1576659138'),
('::1', '2019-12-19', 2, '1579490856'),
('::1', '2019-12-20', 2, '1579490856'),
('::1', '2019-12-21', 2, '1579490856'),
('::1', '2019-12-23', 2, '1579490856'),
('::1', '2019-12-24', 2, '1579490856'),
('::1', '2019-12-28', 2, '1579490856'),
('::1', '2019-12-30', 2, '1579490856'),
('::1', '2019-12-31', 2, '1579490856'),
('::1', '2020-01-02', 2, '1579490856'),
('::1', '2020-01-03', 2, '1579490856'),
('::1', '2020-01-04', 2, '1579490856'),
('::1', '2020-01-06', 2, '1579490856'),
('::1', '2020-01-07', 2, '1579490856'),
('::1', '2020-01-08', 2, '1579490856'),
('::1', '2020-01-09', 2, '1579490856'),
('::1', '2020-01-10', 2, '1579490856'),
('::1', '2020-01-17', 2, '1579490856'),
('::1', '2020-01-18', 2, '1579490856'),
('::1', '2020-01-20', 2, '1579490856');

-- --------------------------------------------------------

--
-- Table structure for table `testimonies`
--

CREATE TABLE `testimonies` (
  `id_testimonies` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `nama` varchar(400) NOT NULL,
  `say` text,
  `seo` varchar(200) NOT NULL,
  `image` varchar(200) NOT NULL,
  `url` varchar(200) DEFAULT NULL,
  `dateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('1','0') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `testimonies`
--

INSERT INTO `testimonies` (`id_testimonies`, `id_kategori`, `nama`, `say`, `seo`, `image`, `url`, `dateTime`, `status`) VALUES
(1, 0, 'Mr. Freeman', '<p>Quisque risus nibh, mattis vel diam non, fermentum pretium ipsum</p>', 'mr-freeman', 'halwan-alfisa-saifullah-st-mt--drg-rina-febriani-puspitasari-orang-tua-dari-999-admin-2019_08_23-Bpk.TeguhDwiKuncoroIbuIrwiarti.jpeg', '', '2020-01-03 17:00:00', '1'),
(3, 0, 'Mr. Silent', '<p>Quisque risus nibh, mattis vel diam non, fermentum pretium ipsum</p>', 'mr-silent', 'mr-silent-3-mmkomikmlongo.jpg', NULL, '2020-01-03 17:00:00', '1'),
(2, 0, 'Mr. Anjay', '<p>Quisque risus nibh, mattis vel diam non, fermentum pretium ipsum</p>', 'mr-anjay', 'mr-anjay-242-Troll-crying.jpg', NULL, '2020-01-03 17:00:00', '1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_users` int(2) NOT NULL,
  `foto` varchar(150) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(128) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `level` varchar(20) NOT NULL,
  `blokir` enum('Y','N') NOT NULL,
  `id_session` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_users`, `foto`, `username`, `password`, `nama_lengkap`, `email`, `no_telp`, `level`, `blokir`, `id_session`) VALUES
(1, 'full-name-190-user.png', 'yarto', 'QrUgcNdRjaE74hfEIeThKa/RaqA9N/KpBI+X7VeiyfE=', 'Aryo Subagja', 'bejomulyo716@gmail.com', '0000-0000-0000', 'admin', 'N', 'hhaiubm0c259il7kuktlja1tf2'),
(2, 'admin-72-bill-gates.jpeg', 'admin', 'xQ0uQUwW136yfA+KoZYjczLHr8PeIRYQyxDRN44GiOY=', 'Admin', 'support@kemahpancasila.com', '0811-2687-75', 'admin', 'N', '9056ptfqui1qn2s0vtagbsimdc');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`id_agenda`);

--
-- Indexes for table `amenities`
--
ALTER TABLE `amenities`
  ADD PRIMARY KEY (`id_amenities`);

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id_blog`);

--
-- Indexes for table `blog_kategori`
--
ALTER TABLE `blog_kategori`
  ADD PRIMARY KEY (`id_blog_kategori`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id_brand`);

--
-- Indexes for table `campus`
--
ALTER TABLE `campus`
  ADD PRIMARY KEY (`id_campus`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id_client`);

--
-- Indexes for table `client_kategori`
--
ALTER TABLE `client_kategori`
  ADD PRIMARY KEY (`id_client_kategori`);

--
-- Indexes for table `download`
--
ALTER TABLE `download`
  ADD PRIMARY KEY (`id_download`);

--
-- Indexes for table `enquiry`
--
ALTER TABLE `enquiry`
  ADD PRIMARY KEY (`id_enquiry`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id_gallery`);

--
-- Indexes for table `gallery_kategori`
--
ALTER TABLE `gallery_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `hastags`
--
ALTER TABLE `hastags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kontak`
--
ALTER TABLE `kontak`
  ADD PRIMARY KEY (`id_kontak`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id_messages`);

--
-- Indexes for table `modul`
--
ALTER TABLE `modul`
  ADD PRIMARY KEY (`id_modul`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `produk_kategori`
--
ALTER TABLE `produk_kategori`
  ADD PRIMARY KEY (`id_produk_kategori`);

--
-- Indexes for table `program`
--
ALTER TABLE `program`
  ADD PRIMARY KEY (`id_program`);

--
-- Indexes for table `program_kategori`
--
ALTER TABLE `program_kategori`
  ADD PRIMARY KEY (`id_program_kategori`);

--
-- Indexes for table `school`
--
ALTER TABLE `school`
  ADD PRIMARY KEY (`id_school`);

--
-- Indexes for table `school_sub`
--
ALTER TABLE `school_sub`
  ADD PRIMARY KEY (`id_school_sub`);

--
-- Indexes for table `slide`
--
ALTER TABLE `slide`
  ADD PRIMARY KEY (`id_slide`);

--
-- Indexes for table `slide_title`
--
ALTER TABLE `slide_title`
  ADD PRIMARY KEY (`id_slide_title`);

--
-- Indexes for table `sosmed`
--
ALTER TABLE `sosmed`
  ADD PRIMARY KEY (`id_sosmed`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id_staff`);

--
-- Indexes for table `staff_gallery`
--
ALTER TABLE `staff_gallery`
  ADD PRIMARY KEY (`id_staff_gallery`);

--
-- Indexes for table `testimonies`
--
ALTER TABLE `testimonies`
  ADD PRIMARY KEY (`id_testimonies`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agenda`
--
ALTER TABLE `agenda`
  MODIFY `id_agenda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `amenities`
--
ALTER TABLE `amenities`
  MODIFY `id_amenities` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `id_blog` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `blog_kategori`
--
ALTER TABLE `blog_kategori`
  MODIFY `id_blog_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id_brand` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `campus`
--
ALTER TABLE `campus`
  MODIFY `id_campus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id_client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `client_kategori`
--
ALTER TABLE `client_kategori`
  MODIFY `id_client_kategori` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `download`
--
ALTER TABLE `download`
  MODIFY `id_download` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `enquiry`
--
ALTER TABLE `enquiry`
  MODIFY `id_enquiry` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id_gallery` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `gallery_kategori`
--
ALTER TABLE `gallery_kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hastags`
--
ALTER TABLE `hastags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kontak`
--
ALTER TABLE `kontak`
  MODIFY `id_kontak` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id_messages` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `modul`
--
ALTER TABLE `modul`
  MODIFY `id_modul` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `produk_kategori`
--
ALTER TABLE `produk_kategori`
  MODIFY `id_produk_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `program`
--
ALTER TABLE `program`
  MODIFY `id_program` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `program_kategori`
--
ALTER TABLE `program_kategori`
  MODIFY `id_program_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `school`
--
ALTER TABLE `school`
  MODIFY `id_school` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `school_sub`
--
ALTER TABLE `school_sub`
  MODIFY `id_school_sub` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `slide`
--
ALTER TABLE `slide`
  MODIFY `id_slide` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `slide_title`
--
ALTER TABLE `slide_title`
  MODIFY `id_slide_title` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sosmed`
--
ALTER TABLE `sosmed`
  MODIFY `id_sosmed` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id_staff` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `staff_gallery`
--
ALTER TABLE `staff_gallery`
  MODIFY `id_staff_gallery` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `testimonies`
--
ALTER TABLE `testimonies`
  MODIFY `id_testimonies` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
