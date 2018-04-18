-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2018 at 05:17 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jobrows`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `label` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `imageurl` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `label`, `description`, `imageurl`) VALUES
(1, 'Crafting', 'Hand made stuff, painting, etc ', './images/slide3.jpg'),
(2, 'IT', 'Web dev, web design, design, video editing, photo editing, etc ..', './images/slide1.jpg'),
(3, 'Tutoring', ' privately Teaching other people', './images/slide2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `demand`
--

CREATE TABLE `demand` (
  `id` int(5) NOT NULL,
  `title` varchar(50) NOT NULL,
  `des` longtext NOT NULL,
  `date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `open` tinyint(1) NOT NULL DEFAULT '1',
  `username` varchar(30) NOT NULL,
  `id_governorate` int(11) NOT NULL,
  `category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `demand_comment`
--

CREATE TABLE `demand_comment` (
  `id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `content` longtext NOT NULL,
  `id_demand` int(11) NOT NULL,
  `id_user` varchar(30) NOT NULL,
  `fake_user_id` int(11) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `demand_deal`
--

CREATE TABLE `demand_deal` (
  `id` int(11) NOT NULL,
  `id_demand` int(11) NOT NULL,
  `fake_user_id` int(11) NOT NULL,
  `ammount` int(11) NOT NULL,
  `id_user` varchar(50) NOT NULL,
  `id_user_accepted` varchar(50) NOT NULL,
  `progress` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `governorate`
--

CREATE TABLE `governorate` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `governorate`
--

INSERT INTO `governorate` (`id`, `name`) VALUES
(1, 'Tunis'),
(2, 'Ariana'),
(3, 'Ben Arous'),
(4, 'Kairaouan'),
(5, 'Mahdia'),
(6, 'Manouba'),
(7, 'Mounastir'),
(8, 'Nabeul'),
(9, 'Sfax'),
(10, 'Sousse'),
(11, 'Zaghouane'),
(12, 'Beja'),
(13, 'Gabes'),
(14, 'Gafsa'),
(15, 'Jendouba'),
(16, 'Kasserine'),
(17, 'Gbeli'),
(18, 'Le Kef'),
(19, 'Mednine '),
(20, 'Sidi Bouzid'),
(21, 'Tozeur'),
(22, 'Tataouine'),
(23, 'Seliana'),
(24, 'Bizerte');

-- --------------------------------------------------------

--
-- Table structure for table `offer`
--

CREATE TABLE `offer` (
  `id` int(5) NOT NULL,
  `title` varchar(50) NOT NULL,
  `des` longtext NOT NULL,
  `date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `open` tinyint(1) NOT NULL DEFAULT '1',
  `username` varchar(30) NOT NULL,
  `id_governorate` int(11) NOT NULL,
  `category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `offer_comment`
--

CREATE TABLE `offer_comment` (
  `id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `content` longtext NOT NULL,
  `id_offer` int(11) NOT NULL,
  `id_user` varchar(30) NOT NULL,
  `fake_user_id` int(11) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `offer_comment`
--

INSERT INTO `offer_comment` (`id`, `price`, `content`, `id_offer`, `id_user`, `fake_user_id`, `date_time`) VALUES
(10, 18, 'Hiiiii', 12, 'khalil20', 12345, '2018-04-13 20:33:29'),
(11, 821, 'I am spam hic', 12, 'khalil20', 12345, '2018-04-13 20:54:36'),
(12, 821, 'I am spam hic', 12, 'khalil20', 12345, '2018-04-13 20:54:39'),
(13, 821, 'I am spam hic', 12, 'khalil20', 12345, '2018-04-13 21:04:38'),
(14, 821, 'I am spam hic', 12, 'khalil20', 12345, '2018-04-13 21:06:14'),
(15, 120, 'sdsd', 1, 'khalil20', 19309, '2018-04-14 20:00:41'),
(16, 3, '', 1, 'khalil20', 19309, '2018-04-16 13:55:05'),
(17, 3, '', 1, 'khalil20', 19309, '2018-04-16 13:55:15');

-- --------------------------------------------------------

--
-- Table structure for table `offer_deal`
--

CREATE TABLE `offer_deal` (
  `id` int(11) NOT NULL,
  `id_offer` int(11) NOT NULL,
  `fake_user_id` int(11) NOT NULL,
  `ammount` int(11) NOT NULL,
  `id_user` varchar(50) NOT NULL,
  `id_user_accepted` varchar(50) NOT NULL,
  `progress` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `offer_deal`
--

INSERT INTO `offer_deal` (`id`, `id_offer`, `fake_user_id`, `ammount`, `id_user`, `id_user_accepted`, `progress`) VALUES
(7, 12, 12345, 821, 'khalil20', 'khalil20', 25),
(8, 12, 12345, 821, 'khalil20', 'khalil20', 25),
(247, 0, 12345, 0, '', 'khalil20', 25),
(248, 0, 19309, 0, '', 'khalil20', 25);

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `id` int(11) NOT NULL,
  `score` decimal(10,2) NOT NULL,
  `id_rated` varchar(30) NOT NULL,
  `id_evaluator` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(50) NOT NULL,
  `name` varchar(30) NOT NULL,
  `gender` varchar(5) NOT NULL,
  `birthday` date NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `name`, `gender`, `birthday`, `email`, `password`) VALUES
('AhmedBenYaghlen210', 'Ahmed Ben Yaghlen', 'male', '0000-00-00', 'byahmed97@gmail.com', 'tbs1234'),
('Aichamarzougui52', 'Aicha marzougui', 'femal', '0000-00-00', 'aichouch29@outlook.fr', 'tbs1235'),
('AmineSaied98', 'Amine Saied', 'male', '0000-00-00', 'aminesaied@outlook.com', 'tbs1236'),
('AymenMerai35', 'Aymen Merai', 'male', '0000-00-00', 'aymenmeraitaraji@gmail.com', 'tbs1237'),
('chemHagui14', 'chem Hagui', 'femal', '0000-00-00', 'haguichem98@gmail.com', 'tbs1238'),
('eyafeguiri12', 'eya feguiri', 'femal', '0000-00-00', 'eyafguiri@hotmail.com', 'tbs1239'),
('FaresGhaffari45', 'Fares Ghaffari', 'male', '0000-00-00', 'frsghaffari@gmail.com', 'tbs1240'),
('FatmaEzzahraSahli53', 'Fatma Ezzahra Sahli ', 'femal', '0000-00-00', 'fatmasahli1997@hotmail.com', 'tbs1241'),
('FirasNeffeti78', 'Firas Neffeti ', 'male', '0000-00-00', 'firasnaffa2016@gmail.com', 'tbs1242'),
('GhassenBenhajyahya73', 'Ghassen Ben haj yahya ', 'male', '0000-00-00', 'ghassenbenhadjyahia@gmail.com', 'tbs1243'),
('Gouiderchayma15', 'Gouider chayma', 'femal', '0000-00-00', 'gouiderchayma123@gmail.com', 'tbs1244'),
('HindKhmiri78', 'Hind Khmiri', 'femal', '0000-00-00', 'Hind-kmeery@hotmail.com', 'tbs1245'),
('JlassiMalek45', 'Jlassi Malek', 'femal', '0000-00-00', 'jelassimalek97@gmail.com', 'tbs1246'),
('KhalilElOuni65', 'Khalil El Ouni', 'male', '0000-00-00', 'Khalilouni97@gmail.com', 'tbs1247'),
('LamisAbdeladhim47', 'Lamis Abdeladhim', 'femal', '0000-00-00', 'abdeladhimlamis@gmail.com', 'tbs1248'),
('marwenkhazri63', 'marwen khazri', 'male', '0000-00-00', 'khazrimarwen@outlook.fr', 'tbs1249'),
('moetezsifaoui35', 'moetez sifaoui', 'male', '0000-00-00', 'sifaoui.moetez@yahoo.com', 'tbs1250'),
('MohamedAmineGouiaa73', 'Mohamed Amine Gouiaa', 'male', '0000-00-00', 'Gouiaamedamine@gmail.com', 'tbs1251'),
('Mootezbenchiekh28', 'Mootez ben chiekh', 'male', '0000-00-00', 'mootezbencheikh@gmail.com', 'tbs1252'),
('nadineromdhani007', 'nadine romdhani', 'femal', '0000-00-00', 'nadineromdhani0123@gmail.com', 'tbs1262'),
('NadineRomdhani27', 'Nadine Romdhani', 'femal', '0000-00-00', 'Nadineromdhani0123@gmail.com', 'tbs1253'),
('NouhaMeddeb42', 'Nouha Meddeb', 'femal', '0000-00-00', 'nouhameddeb@outlook.fr', 'tbs1254'),
('RachedFares25', 'Rached Fares', 'male', '0000-00-00', 'rachedfares@yahoo.com ', 'tbs1255'),
('RanimBenSlama52', 'Ranim Ben Slama', 'femal', '0000-00-00', 'ranimbenslama3399@gmail.com', 'tbs1256'),
('Raouashaiek62', 'Raoua shaiek', 'femal', '0000-00-00', 'raoua.shayk1@gmail.com', 'tbs1257'),
('RayhanGarbout41', 'Rayhan Garbout', 'femal', '0000-00-00', 'rayhanagarbout@gmail.com', 'tbs1258'),
('RouaKlai52', 'Roua Klai', 'femal', '0000-00-00', 'roua_klai@gmail.com', 'tbs1259'),
('sarrabenslama23', 'sarra benslama', 'femal', '0000-00-00', 'sarrabenslama55@gmail.com', 'tbs1260'),
('SendaBouhrira22', 'Senda Bouhrira', 'femal', '0000-00-00', 'sinda.bouhrira@gmail.com', 'tbs1261');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `demand`
--
ALTER TABLE `demand`
  ADD PRIMARY KEY (`id`),
  ADD KEY `c4` (`id_governorate`),
  ADD KEY `c5` (`category`),
  ADD KEY `c2` (`username`);

--
-- Indexes for table `demand_comment`
--
ALTER TABLE `demand_comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `c21` (`id_demand`),
  ADD KEY `c22` (`id_user`);

--
-- Indexes for table `demand_deal`
--
ALTER TABLE `demand_deal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `c31` (`id_demand`),
  ADD KEY `c32` (`id_user`),
  ADD KEY `c33` (`id_user_accepted`);

--
-- Indexes for table `governorate`
--
ALTER TABLE `governorate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offer`
--
ALTER TABLE `offer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `c4` (`id_governorate`),
  ADD KEY `c5` (`category`),
  ADD KEY `c2` (`username`);

--
-- Indexes for table `offer_comment`
--
ALTER TABLE `offer_comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `c21` (`id_offer`),
  ADD KEY `c22` (`id_user`);

--
-- Indexes for table `offer_deal`
--
ALTER TABLE `offer_deal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `c31` (`id_offer`),
  ADD KEY `c32` (`id_user`),
  ADD KEY `c33` (`id_user_accepted`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id_rated`,`id_evaluator`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `c1` (`id_evaluator`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `demand`
--
ALTER TABLE `demand`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `demand_comment`
--
ALTER TABLE `demand_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `demand_deal`
--
ALTER TABLE `demand_deal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=251;

--
-- AUTO_INCREMENT for table `governorate`
--
ALTER TABLE `governorate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `offer`
--
ALTER TABLE `offer`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `offer_comment`
--
ALTER TABLE `offer_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `offer_deal`
--
ALTER TABLE `offer_deal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=249;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `demand`
--
ALTER TABLE `demand`
  ADD CONSTRAINT `c2` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `c4` FOREIGN KEY (`id_governorate`) REFERENCES `governorate` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `c5` FOREIGN KEY (`category`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `demand_comment`
--
ALTER TABLE `demand_comment`
  ADD CONSTRAINT `c21` FOREIGN KEY (`id_demand`) REFERENCES `demand` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `c22` FOREIGN KEY (`id_user`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `demand_deal`
--
ALTER TABLE `demand_deal`
  ADD CONSTRAINT `c33` FOREIGN KEY (`id_user_accepted`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `offer`
--
ALTER TABLE `offer`
  ADD CONSTRAINT `c10` FOREIGN KEY (`category`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `c11` FOREIGN KEY (`id_governorate`) REFERENCES `governorate` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `c12` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
