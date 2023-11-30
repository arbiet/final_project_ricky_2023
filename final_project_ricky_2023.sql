-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2023 at 01:01 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `final_project_ricky_2023`
--

-- --------------------------------------------------------

--
-- Table structure for table `Brands`
--

CREATE TABLE `Brands` (
  `BrandID` int(11) NOT NULL,
  `BrandName` varchar(255) DEFAULT NULL,
  `BrandImage` varchar(255) DEFAULT NULL,
  `BrandCountry` varchar(50) DEFAULT NULL,
  `BrandWebsite` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Brands`
--

INSERT INTO `Brands` (`BrandID`, `BrandName`, `BrandImage`, `BrandCountry`, `BrandWebsite`) VALUES
(1, 'Nike', 'nike_logo.jpg', 'United States', 'https://www.nike.com'),
(2, 'Adidas', 'adidas_logo.jpg', 'Germany', 'https://www.adidas.com'),
(3, 'Gucci', 'gucci_logo.jpg', 'Italy', 'https://www.gucci.com'),
(4, 'Zara', 'zara_logo.jpg', 'Spain', 'https://www.zara.com'),
(5, 'H&M', 'hm_logo.jpg', 'Sweden', 'https://www2.hm.com'),
(6, 'Louis Vuitton', 'louisvuitton_logo.jpg', 'France', 'https://www.louisvuitton.com'),
(7, 'Balenciaga', 'balenciaga_logo.jpg', 'Spain', 'https://www.balenciaga.com'),
(8, 'Calvin Klein', 'calvinklein_logo.jpg', 'United States', 'https://www.calvinklein.us'),
(9, 'Prada', 'prada_logo.jpg', 'Italy', 'https://www.prada.com'),
(10, 'Chanel', 'chanel_logo.jpg', 'France', 'https://www.chanel.com'),
(11, 'Versace', 'versace_logo.jpg', 'Italy', 'https://www.versace.com'),
(12, 'Tommy Hilfiger', 'tommyhilfiger_logo.jpg', 'United States', 'https://global.tommy.com'),
(13, 'Hugo Boss', 'hugoboss_logo.jpg', 'Germany', 'https://www.hugoboss.com'),
(14, 'Dior', 'dior_logo.jpg', 'France', 'https://www.dior.com'),
(15, 'Yves Saint Laurent', 'ysl_logo.jpg', 'France', 'https://www.ysl.com'),
(16, 'Fendi', 'fendi_logo.jpg', 'Italy', 'https://www.fendi.com'),
(17, 'Puma', 'puma_logo.jpg', 'Germany', 'https://www.puma.com'),
(18, 'Burberry', 'burberry_logo.jpg', 'United Kingdom', 'https://www.burberry.com'),
(19, 'Under Armour', 'underarmour_logo.jpg', 'United States', 'https://www.underarmour.com'),
(20, 'Ralph Lauren', 'ralphlauren_logo.jpg', 'United States', 'https://www.ralphlauren.com'),
(21, 'Alexander McQueen', 'mcqueen_logo.jpg', 'United Kingdom', 'https://www.alexandermcqueen.com'),
(22, 'Dolce & Gabbana', 'dolcegabbana_logo.jpg', 'Italy', 'https://www.dolcegabbana.com'),
(23, 'Givenchy', 'givenchy_logo.jpg', 'France', 'https://www.givenchy.com'),
(24, 'GAP', 'gap_logo.jpg', 'United States', 'https://www.gap.com'),
(25, 'Levi\'s', 'levis_logo.jpg', 'United States', 'https://www.levi.com'),
(26, 'Reebok', 'reebok_logo.jpg', 'United States', 'https://www.reebok.com'),
(27, 'Balmain', 'balmain_logo.jpg', 'France', 'https://www.balmain.com'),
(28, 'Converse', 'converse_logo.jpg', 'United States', 'https://www.converse.com'),
(29, 'Saint Laurent', 'saintlaurent_logo.jpg', 'France', 'https://www.ysl.com'),
(30, 'DKNY', 'dkny_logo.jpg', 'United States', 'https://www.dkny.com'),
(31, 'Michael Kors', 'michaelkors_logo.jpg', 'United States', 'https://www.michaelkors.com'),
(32, 'Supreme', 'supreme_logo.jpg', 'United States', 'https://www.supremenewyork.com'),
(33, 'Abercrombie & Fitch', 'abercrombie_logo.jpg', 'United States', 'https://www.abercrombie.com'),
(34, 'Hollister', 'hollister_logo.jpg', 'United States', 'https://www.hollisterco.com'),
(35, 'Fila', 'fila_logo.jpg', 'Italy', 'https://www.fila.com'),
(36, 'Vans', 'vans_logo.jpg', 'United States', 'https://www.vans.com'),
(37, 'Armani', 'armani_logo.jpg', 'Italy', 'https://www.armani.com'),
(38, 'Steve Madden', 'stevemadden_logo.jpg', 'United States', 'https://www.stevemadden.com'),
(39, 'Columbia', 'columbia_logo.jpg', 'United States', 'https://www.columbia.com'),
(40, 'Herschel', 'herschel_logo.jpg', 'Canada', 'https://www.herschel.com'),
(41, 'Guess', 'guess_logo.jpg', 'United States', 'https://www.guess.com'),
(42, 'Timberland', 'timberland_logo.jpg', 'United States', 'https://www.timberland.com'),
(43, 'New Balance', 'newbalance_logo.jpg', 'United States', 'https://www.newbalance.com'),
(44, 'Wakai', 'wakai_logo.jpg', 'Indonesia', 'https://www.wakai.co.id'),
(45, 'Bateeq', 'bateeq_logo.jpg', 'Indonesia', 'https://www.bateeqshop.com'),
(46, 'Cotton Ink', 'cottonink_logo.jpg', 'Indonesia', 'https://www.cottonink.co.id'),
(47, 'Danar Hadi', 'danarhadi_logo.jpg', 'Indonesia', 'https://www.danarhadi.com'),
(48, 'Alleira Batik', 'alleira_logo.jpg', 'Indonesia', 'https://www.alleira.com'),
(49, 'Tarik Jeans', 'tarikjeans_logo.jpg', 'Indonesia', 'https://www.tarikjeans.com'),
(50, 'Tuneeca', 'tuneeca_logo.jpg', 'Indonesia', 'https://www.tuneeca.com'),
(51, 'Mygeisha', 'mygeisha_logo.jpg', 'Indonesia', 'https://www.mygeisha.co.id'),
(52, 'Zalora Indonesia', 'zalora_logo.jpg', 'Indonesia', 'https://www.zalora.co.id'),
(53, 'Berrybenka', 'berrybenka_logo.jpg', 'Indonesia', 'https://www.berrybenka.com'),
(54, 'Jenahara', 'jenahara_logo.jpg', 'Indonesia', 'https://www.jenahara.com'),
(55, 'Plaza Indonesia', 'plazaindonesia_logo.jpg', 'Indonesia', 'https://www.plazaindonesia.com'),
(56, 'Uniqlo Japan', 'uniqlo_logo.jpg', 'Japan', 'https://www.uniqlo.com/jp'),
(57, 'Muji', 'muji_logo.jpg', 'Japan', 'https://www.muji.com/jp'),
(58, 'Comme des Garçons', 'commedesgarcons_logo.jpg', 'Japan', 'https://www.comme-des-garcons.com'),
(59, 'Issey Miyake', 'isseymiyake_logo.jpg', 'Japan', 'https://www.isseymiyake.com'),
(60, 'Onitsuka Tiger', 'onitsukatiger_logo.jpg', 'Japan', 'https://www.onitsukatiger.com'),
(61, 'Shiseido', 'shiseido_logo.jpg', 'Japan', 'https://www.shiseido.co.jp'),
(62, 'Anello', 'anello_logo.jpg', 'Japan', 'https://www.anello.co.jp'),
(63, 'Beams', 'beams_logo.jpg', 'Japan', 'https://www.beams.co.jp');

-- --------------------------------------------------------

--
-- Table structure for table `Categories`
--

CREATE TABLE `Categories` (
  `CategoryID` int(11) NOT NULL,
  `CategoryName` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Categories`
--

INSERT INTO `Categories` (`CategoryID`, `CategoryName`) VALUES
(1, 'Athleisure'),
(2, 'Streetwear'),
(3, 'Techwear'),
(4, 'Workwear'),
(5, 'Casual'),
(6, 'Smart Casual'),
(7, 'Formal Wear'),
(8, 'Denim'),
(9, 'Vintage'),
(10, 'Retro'),
(11, 'Military Style'),
(12, 'Monochrome'),
(13, 'Sustainable Fashion'),
(14, 'Bohemian'),
(15, 'Surf Style'),
(16, 'Skatewear'),
(17, 'Preppy'),
(18, 'Urban Chic'),
(19, 'Minimalist'),
(20, 'Gothic'),
(21, 'Hipster'),
(22, 'Sporty'),
(23, 'Outdoor Adventure'),
(24, 'Artistic Expression'),
(25, 'Punk'),
(26, 'Rockabilly'),
(27, 'Modern Dandy'),
(28, 'Tech-Infused Fashion'),
(29, 'Rugged Style'),
(30, 'Tropical Vibes'),
(31, 'Cowboy Western'),
(32, 'Grunge'),
(33, 'Biker Style'),
(34, 'Nautical'),
(35, 'Military-Inspired'),
(36, 'Hip-Hop Streetwear'),
(37, 'Japanese Street Fashion'),
(38, 'Scandinavian Minimalism'),
(39, 'Athletic Techwear'),
(40, 'Workout Essentials'),
(41, 'Boho Chic'),
(42, 'Feminine Florals'),
(43, 'Power Suits'),
(44, 'Cottagecore'),
(45, 'Elevated Athleisure'),
(46, 'Retro Glam'),
(47, 'Sustainable Fashion'),
(48, 'Artistic Prints'),
(49, 'Casual Maximalism'),
(50, 'Monochromatic Outfits'),
(51, 'Bold Colors'),
(52, 'Classic Tailoring'),
(53, 'Vintage Vibes'),
(54, 'Preppy Elegance'),
(55, 'Minimalist Luxe'),
(56, 'Gothic Romance'),
(57, 'Modern Bohemian'),
(58, 'Street Style Diva'),
(59, 'Glam Rock'),
(60, 'Denim Days'),
(61, 'Romantic Ruffles'),
(62, 'Neon Dream'),
(63, 'Eco-Friendly Fashion'),
(64, 'Edgy Leather'),
(65, 'Modern Safari'),
(66, 'Bold Patterns'),
(67, 'Soft Pastels'),
(68, 'Urban Jungle'),
(69, 'Futuristic Fashion'),
(70, 'Girly Grunge'),
(71, 'Bohemian Nomad'),
(72, 'Casual Cool'),
(73, 'Effortless Chic'),
(74, 'Sporty Luxe'),
(75, 'Fierce Animal Prints'),
(76, 'Avant-Garde'),
(77, 'Tropical Paradise'),
(78, 'Artsy Boho'),
(79, 'Vintage Hollywood Glam'),
(80, 'Streetwear Princess');

-- --------------------------------------------------------

--
-- Table structure for table `Colors`
--

CREATE TABLE `Colors` (
  `ColorID` int(11) NOT NULL,
  `ColorName` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Colors`
--

INSERT INTO `Colors` (`ColorID`, `ColorName`) VALUES
(1, 'Living Coral'),
(2, 'Neo Mint'),
(3, 'Classic Blue'),
(4, 'Mellow Yellow'),
(5, 'Faded Denim'),
(6, 'Chive'),
(7, 'Biking Red'),
(8, 'Peach Pink'),
(9, 'Saffron'),
(10, 'Antique Moss'),
(11, 'Lapis Blue'),
(12, 'Coral Pink'),
(13, 'Galaxy Blue'),
(14, 'Orange Peel'),
(15, 'Cinnamon Stick'),
(16, 'Sugar Almond'),
(17, 'Biscay Green'),
(18, 'Champagne'),
(19, 'Blush'),
(20, 'Toffee'),
(21, 'Bleached Coral'),
(22, 'Aspen Gold'),
(23, 'Champagne Beige'),
(24, 'Jester Red'),
(25, 'Sweet Lilac'),
(26, 'Paloma'),
(27, 'Princess Blue'),
(28, 'Turmeric'),
(29, 'Pepper Stem'),
(30, 'Cerulean'),
(31, 'Pewter'),
(32, 'Ashley Blue'),
(33, 'Terracotta'),
(34, 'Frost Gray'),
(35, 'Cantaloupe'),
(36, 'Mango Mojito'),
(37, 'Fiesta'),
(38, 'Pink Peacock'),
(39, 'Brown Granite'),
(40, 'Toadstool');

-- --------------------------------------------------------

--
-- Table structure for table `DailyTransactions`
--

CREATE TABLE `DailyTransactions` (
  `TransactionID` int(11) NOT NULL,
  `ProductID` int(11) DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `TransactionType` enum('In','Out') DEFAULT NULL,
  `TransactionDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `LogActivities`
--

CREATE TABLE `LogActivities` (
  `LogID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `ActivityDescription` text DEFAULT NULL,
  `ActivityTimestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `LogActivities`
--

INSERT INTO `LogActivities` (`LogID`, `UserID`, `ActivityDescription`, `ActivityTimestamp`) VALUES
(18, 137648118, 'User logged out', '2023-11-23 19:19:21'),
(19, 137648118, 'User logged in', '2023-11-23 19:19:50'),
(20, 137648118, 'User logged in', '2023-11-23 20:48:14'),
(21, 137648118, 'User with Username: asfasgasg has been created with the following details - Full Name: asfasgasg, Role: 1, Account Status: Active, Activation Status: Activated.', '2023-11-23 21:12:30'),
(22, 137648118, 'User with UserID: 2147483647 has been deleted.', '2023-11-23 21:12:42'),
(23, 137648118, 'User logged in', '2023-11-23 23:45:50'),
(24, 137648118, 'User logged out', '2023-11-24 00:08:22'),
(25, 137648118, 'User logged in', '2023-11-24 00:08:27'),
(26, 137648118, 'User logged out', '2023-11-24 00:15:31'),
(27, 137648118, 'User logged in', '2023-11-24 00:15:37'),
(28, 137648118, 'User logged out', '2023-11-24 07:10:56'),
(29, 137648118, 'User logged in', '2023-11-24 07:11:02'),
(30, 137648118, 'User logged out', '2023-11-24 07:59:20'),
(31, 137648118, 'User logged in', '2023-11-24 07:59:30'),
(32, 137648118, 'User logged out', '2023-11-24 10:43:02'),
(33, 0, 'User logged in', '2023-11-24 10:43:15'),
(34, 0, 'User logged in', '2023-11-24 11:00:57'),
(35, 137648118, 'User logged in', '2023-11-24 13:00:16'),
(36, 137648118, 'User logged out', '2023-11-24 13:03:26'),
(37, 0, 'User logged in', '2023-11-24 13:03:33'),
(38, 0, 'User logged out', '2023-11-25 03:13:44'),
(39, 137648118, 'User logged in', '2023-11-25 03:13:50'),
(40, 137648118, 'User logged out', '2023-11-25 03:14:17'),
(41, 137648118, 'User logged in', '2023-11-25 03:14:27'),
(42, 137648118, 'User logged out', '2023-11-25 03:14:47'),
(43, 137648118, 'User logged in', '2023-11-25 03:14:52'),
(44, 137648118, 'User logged out', '2023-11-25 03:15:10'),
(45, 137648118, 'User logged in', '2023-11-25 03:15:15'),
(46, 137648118, 'User logged out', '2023-11-25 03:16:08'),
(47, 137648118, 'User logged in', '2023-11-25 03:17:19'),
(48, 137648118, 'User logged out', '2023-11-25 03:17:23'),
(49, 0, 'User logged in', '2023-11-25 03:17:31'),
(50, 0, 'User logged in', '2023-11-25 03:18:19'),
(51, 0, 'User logged out', '2023-11-25 03:32:46'),
(52, 0, 'User logged in', '2023-11-25 03:32:59'),
(53, 0, 'User logged out', '2023-11-25 04:35:31'),
(54, 0, 'User logged in', '2023-11-25 04:35:37'),
(55, 0, 'User logged out', '2023-11-25 04:46:20'),
(56, 0, 'User logged in', '2023-11-25 04:46:33'),
(57, 0, 'User logged in', '2023-11-25 04:49:16'),
(58, 0, 'User logged out', '2023-11-25 11:50:43'),
(59, 0, 'User logged in', '2023-11-30 11:12:45'),
(60, 0, 'User logged out', '2023-11-30 11:20:41'),
(61, 0, 'User logged in', '2023-11-30 11:20:58'),
(62, 0, 'User logged out', '2023-11-30 11:22:33'),
(63, 137648118, 'User logged in', '2023-11-30 11:22:39');

-- --------------------------------------------------------

--
-- Table structure for table `Products`
--

CREATE TABLE `Products` (
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(255) DEFAULT NULL,
  `ProductImage` varchar(1024) NOT NULL,
  `Description` text DEFAULT NULL,
  `Price` decimal(10,2) DEFAULT NULL,
  `CategoryID` int(11) DEFAULT NULL,
  `BrandID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Products`
--

INSERT INTO `Products` (`ProductID`, `ProductName`, `ProductImage`, `Description`, `Price`, `CategoryID`, `BrandID`) VALUES
(1, 'Stusy', '65687190f09df_0d3827390e463d1a6e6107206d339102--muscle-tanks-pumas.jpg', 'Description Stusy', 100000.00, 1, 1),
(2, 'Master Winks', '656871b2c571f_84b045bde5082646482c45feaa6765f0.jpg', 'Description Master Winks', 100.00, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `Roles`
--

CREATE TABLE `Roles` (
  `RoleID` int(11) NOT NULL,
  `RoleName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Roles`
--

INSERT INTO `Roles` (`RoleID`, `RoleName`) VALUES
(1, 'Administrator'),
(2, 'Pengelola Toko');

-- --------------------------------------------------------

--
-- Table structure for table `Sizes`
--

CREATE TABLE `Sizes` (
  `SizeID` int(11) NOT NULL,
  `SizeName` varchar(50) DEFAULT NULL,
  `SizeCode` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Sizes`
--

INSERT INTO `Sizes` (`SizeID`, `SizeName`, `SizeCode`) VALUES
(1, 'Small', 'S'),
(2, 'Medium', 'M'),
(3, 'Large', 'L'),
(4, 'XL', 'XL'),
(5, 'XXS', 'XXS'),
(6, 'XS', 'XS'),
(7, 'XXL', 'XXL'),
(8, '3XL', '3XL');

-- --------------------------------------------------------

--
-- Table structure for table `Stocks`
--

CREATE TABLE `Stocks` (
  `StockID` int(11) NOT NULL,
  `ProductID` int(11) DEFAULT NULL,
  `SizeID` int(11) DEFAULT NULL,
  `ColorID` int(11) DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Stocks`
--

INSERT INTO `Stocks` (`StockID`, `ProductID`, `SizeID`, `ColorID`, `Quantity`) VALUES
(1, 1, 1, 10, 10),
(2, 1, 3, 10, 11),
(3, 2, 2, 22, 111),
(4, 1, 1, 32, 11);

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `FullName` varchar(100) DEFAULT NULL,
  `DateOfBirth` date DEFAULT NULL,
  `Gender` varchar(10) DEFAULT NULL,
  `Address` text DEFAULT NULL,
  `PhoneNumber` varchar(20) DEFAULT NULL,
  `RoleID` int(11) DEFAULT NULL,
  `AccountCreationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `LastLogin` datetime DEFAULT NULL,
  `AccountStatus` varchar(20) DEFAULT NULL,
  `ProfilePictureURL` varchar(255) DEFAULT NULL,
  `ActivationStatus` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`UserID`, `Username`, `Password`, `Email`, `FullName`, `DateOfBirth`, `Gender`, `Address`, `PhoneNumber`, `RoleID`, `AccountCreationDate`, `LastLogin`, `AccountStatus`, `ProfilePictureURL`, `ActivationStatus`) VALUES
(0, 'ikimukti', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f', '19103020046@unpkediri.ac.id', 'Firmansyah Mukti Wijaya', '2023-10-12', 'Male', 'Nglaban 1111', '081216318022', 2, '2023-11-30 11:20:58', '2023-11-30 18:20:58', NULL, '653e5a409b4fb.jpeg', NULL),
(137648118, 'admin', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f', 'admin@ikimukti.com', 'Administrator', NULL, NULL, NULL, NULL, 1, '2023-11-30 11:22:39', '2023-11-30 18:22:39', NULL, 'default.png', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Brands`
--
ALTER TABLE `Brands`
  ADD PRIMARY KEY (`BrandID`);

--
-- Indexes for table `Categories`
--
ALTER TABLE `Categories`
  ADD PRIMARY KEY (`CategoryID`);

--
-- Indexes for table `Colors`
--
ALTER TABLE `Colors`
  ADD PRIMARY KEY (`ColorID`);

--
-- Indexes for table `DailyTransactions`
--
ALTER TABLE `DailyTransactions`
  ADD PRIMARY KEY (`TransactionID`),
  ADD KEY `dailytransaction_ibfk_1` (`ProductID`);

--
-- Indexes for table `LogActivities`
--
ALTER TABLE `LogActivities`
  ADD PRIMARY KEY (`LogID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `Products`
--
ALTER TABLE `Products`
  ADD PRIMARY KEY (`ProductID`),
  ADD KEY `product_ibfk_1` (`CategoryID`),
  ADD KEY `product_ibfk_2` (`BrandID`);

--
-- Indexes for table `Roles`
--
ALTER TABLE `Roles`
  ADD PRIMARY KEY (`RoleID`),
  ADD UNIQUE KEY `RoleName` (`RoleName`);

--
-- Indexes for table `Sizes`
--
ALTER TABLE `Sizes`
  ADD PRIMARY KEY (`SizeID`);

--
-- Indexes for table `Stocks`
--
ALTER TABLE `Stocks`
  ADD PRIMARY KEY (`StockID`),
  ADD KEY `stock_ibfk_2` (`SizeID`),
  ADD KEY `stock_ibfk_3` (`ColorID`),
  ADD KEY `stock_ibfk_1` (`ProductID`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Username` (`Username`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD KEY `users_ibfk_1` (`RoleID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Brands`
--
ALTER TABLE `Brands`
  MODIFY `BrandID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `Categories`
--
ALTER TABLE `Categories`
  MODIFY `CategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `Colors`
--
ALTER TABLE `Colors`
  MODIFY `ColorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `LogActivities`
--
ALTER TABLE `LogActivities`
  MODIFY `LogID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `Products`
--
ALTER TABLE `Products`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `Sizes`
--
ALTER TABLE `Sizes`
  MODIFY `SizeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `Stocks`
--
ALTER TABLE `Stocks`
  MODIFY `StockID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `DailyTransactions`
--
ALTER TABLE `DailyTransactions`
  ADD CONSTRAINT `dailytransactions_ibfk_1` FOREIGN KEY (`ProductID`) REFERENCES `products` (`ProductID`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `LogActivities`
--
ALTER TABLE `LogActivities`
  ADD CONSTRAINT `LogActivity_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `Users` (`UserID`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `Products`
--
ALTER TABLE `Products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`CategoryID`) REFERENCES `categories` (`CategoryID`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`BrandID`) REFERENCES `brands` (`BrandID`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `Stocks`
--
ALTER TABLE `Stocks`
  ADD CONSTRAINT `sizes_ibfk_2` FOREIGN KEY (`SizeID`) REFERENCES `Sizes` (`SizeID`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `stocks_ibfk_1` FOREIGN KEY (`ProductID`) REFERENCES `products` (`ProductID`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `stocks_ibfk_3` FOREIGN KEY (`ColorID`) REFERENCES `colors` (`ColorID`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `Users`
--
ALTER TABLE `Users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`RoleID`) REFERENCES `roles` (`RoleID`) ON DELETE SET NULL ON UPDATE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
