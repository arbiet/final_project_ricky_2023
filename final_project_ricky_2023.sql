-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2023 at 05:49 PM
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
(63, 'Beams', 'beams_logo.jpg', 'Japan', 'https://www.beams.co.jp'),
(65, 'Lyle and Scott', 'default.jpg', 'British', 'www.lyleandscott.com'),
(66, 'GXG', 'default1.jpg', 'france', 'www.cnwear.com'),
(67, 'Giordano', 'default2.jpg', 'Italy', 'www.giordano.com'),
(68, 'JogunShop', 'default3.jpg', 'Korea', 'www.en.jogunshop.com'),
(69, 'Rageblue', 'default4.jpg', 'Japan', 'www.adastria.co.jp'),
(70, 'Dickies', 'default5.jpg', 'United States', 'www.dickies.com'),
(71, 'Spao', 'default6.jpg', 'Korea', 'www.m.spao.com'),
(72, 'H&M', 'default7.jpg', 'Sweden', 'www.hm.com'),
(73, 'Coen', 'default8.jpg', 'Japan', 'www.coen.co.jp'),
(74, 'Aigle', 'default9.jpg', 'France', 'www.aigle.com'),
(75, 'Levi\\\'s', 'default10.jpg', 'United States', 'www.Levi.com'),
(76, 'Whoau', 'default11.jpg', 'Korea', 'www.m.whoau.com'),
(77, 'Kangol', 'default12.jpg', 'British', 'www.kangol.com'),
(78, 'Alpha Industries', 'default13.jpg', 'United States', 'www.alphaindustries.com'),
(79, 'Fila', 'default14.jpg', 'Korea', 'www.fila.com'),
(80, 'O\\\'neill', 'default15.jpg', 'United States', 'www.us.oneill.com'),
(81, 'Zip', 'default16.jpg', 'Australia', 'www.zip.co'),
(82, 'Jeep', 'default17.jpg', 'United States', 'www.jeep-outfitter.com'),
(83, 'Bean Pole', 'default18.jpg', 'Korea', 'www.cnwear.com'),
(84, 'Lotto', 'default19.jpg', 'Italy', 'www.lotto.it.com'),
(85, 'Toyo', 'default20.jpg', 'Japan', 'www.toyo-enterprise.co.jp'),
(86, 'Xlarge', 'default21.jpg', 'United States', 'www.xlarge.com'),
(87, 'Helly Hansen', 'default22.jpg', 'Norway', 'www.hellyhansen.com'),
(88, 'Swagger', 'default23.jpg', 'Japan', 'www.hypebeast.com'),
(89, 'Polo Ralph Lauren', 'default24.jpg', 'United States', 'www.ralphlauren.com'),
(90, 'Stooge', 'default25.jpg', 'Japan', 'www.etsy.com'),
(91, 'Nii', 'default26.jpg', 'Korea', 'www.m.nii.co.kr'),
(92, 'Vision Street Wear', 'default27.jpg', 'United States', 'www.visionstreetwear.com'),
(93, 'Wack inc', 'default28.jpg', 'British', 'www.depop.com'),
(94, 'Twode', 'default29.jpg', 'British', 'www.twodeclothing.com'),
(95, 'Rugged House', 'default30.jpg', 'United States', 'www.us.wconcept.com'),
(96, 'WildCat', 'default31.jpg', 'South African', 'www.za.ultimatewildcat.com');

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
(80, 'Streetwear Princess'),
(81, 'Long Sleeve'),
(82, 'Boxy Oversize Down Jacket'),
(83, 'Cordura Jacket'),
(84, 'Outdor Gorpcore Jacket'),
(85, 'Bikers Jacket'),
(86, 'Parka Jacket'),
(87, 'Riversible Jacket'),
(88, 'Coach Jacket'),
(89, 'Windbreaker Jacket'),
(90, 'Trucker Jacket'),
(91, 'Fleece Jacket'),
(92, 'Chore Jacket'),
(93, 'Puffer Jacket'),
(94, 'Sport Jacket'),
(95, 'Bomber Jacket'),
(96, 'Varsity Jacket'),
(97, 'Leather Jacket'),
(98, 'Pea Coat'),
(99, 'Over Coat'),
(100, 'Reversible Jacket'),
(101, 'Polo Shirt'),
(102, 'Flanel Shirt'),
(103, 'Oxford Shirt'),
(104, 'Denim Shirt'),
(105, 'Twill Shirt'),
(106, 'Fishtail Parka Jacket'),
(107, 'Cagoule Jacket'),
(108, 'Linen Jacket'),
(109, 'Cordura Sherpa Jacket');

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
(40, 'Toadstool'),
(41, 'White Plaid Patern'),
(42, 'White Stripes Patern'),
(43, 'Army Green'),
(44, 'Olive Green'),
(45, 'Blue Stripes Patern'),
(46, 'Blue Denim'),
(47, 'Cream'),
(48, 'Maroon'),
(49, 'Charcoal/Gray'),
(50, 'Sage Green'),
(51, 'Red Stripes Patern'),
(52, 'Light Blue'),
(53, 'Black White Buttondown Patern'),
(54, 'Black White Stripes Patern'),
(55, 'Black'),
(56, 'Brown'),
(57, 'Black Brown'),
(58, 'Black Leather'),
(59, 'Dark Blue Denim'),
(60, 'White Blue'),
(61, 'Blue'),
(62, 'Light Blue Denim'),
(63, 'Green'),
(64, 'Light Green'),
(65, 'Dark Blue Denim'),
(66, 'Black and White'),
(67, 'Red');

-- --------------------------------------------------------

--
-- Table structure for table `DailyTransactions`
--

CREATE TABLE `DailyTransactions` (
  `TransactionID` int(11) NOT NULL,
  `StockID` int(11) DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `TransactionType` enum('In','Out') DEFAULT NULL,
  `TransactionDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `DailyTransactions`
--

INSERT INTO `DailyTransactions` (`TransactionID`, `StockID`, `Quantity`, `TransactionType`, `TransactionDate`) VALUES
(1, 7, 10, 'In', '2023-08-01'),
(2, 8, 5, 'In', '2023-08-01'),
(3, 9, 11, 'In', '2023-08-01'),
(4, 10, 4, 'In', '2023-08-01'),
(5, 11, 16, 'In', '2023-08-01'),
(6, 12, 3, 'In', '2023-08-01'),
(7, 13, 12, 'In', '2023-08-01'),
(8, 14, 6, 'In', '2023-08-01'),
(9, 15, 13, 'In', '2023-08-01'),
(10, 16, 7, 'In', '2023-08-01'),
(11, 17, 14, 'In', '2023-08-01'),
(12, 18, 6, 'In', '2023-08-01'),
(13, 19, 19, 'In', '2023-08-01'),
(14, 20, 14, 'In', '2023-08-01'),
(15, 21, 6, 'In', '2023-08-01'),
(16, 22, 16, 'In', '2023-08-01'),
(17, 23, 3, 'In', '2023-08-01'),
(18, 24, 18, 'In', '2023-08-01'),
(19, 25, 17, 'In', '2023-08-01'),
(20, 26, 17, 'In', '2023-08-01'),
(21, 27, 19, 'In', '2023-08-01'),
(23, 29, 16, 'In', '2023-08-01'),
(24, 30, 20, 'In', '2023-08-01'),
(25, 31, 18, 'In', '2023-08-01'),
(26, 32, 19, 'In', '2023-08-01'),
(27, 33, 20, 'In', '2023-08-01'),
(28, 34, 15, 'In', '2023-08-01'),
(29, 35, 19, 'In', '2023-08-01'),
(30, 36, 19, 'In', '2023-08-01'),
(31, 37, 20, 'In', '2023-08-01'),
(32, 38, 18, 'In', '2023-08-01'),
(33, 39, 20, 'In', '2023-08-01'),
(34, 40, 19, 'In', '2023-08-01'),
(35, 41, 18, 'In', '2023-08-01'),
(36, 42, 17, 'In', '2023-08-01'),
(37, 43, 16, 'In', '2023-08-01'),
(38, 44, 19, 'In', '2023-08-01'),
(39, 45, 18, 'In', '2023-08-01'),
(65, 46, 1, 'In', '2023-08-01'),
(66, 47, 1, 'In', '2023-08-01'),
(67, 48, 3, 'In', '2023-08-01'),
(74, 8, 1, 'Out', '2023-08-01'),
(75, 7, 4, 'Out', '2023-08-05'),
(76, 8, 1, 'Out', '2023-08-20'),
(77, 10, 2, 'Out', '2023-08-15'),
(78, 7, 2, 'Out', '2023-08-20'),
(79, 7, 2, 'Out', '2023-08-29'),
(80, 7, 10, 'In', '2023-09-01'),
(81, 8, 8, 'In', '2023-09-01'),
(82, 7, 3, 'Out', '2023-09-03'),
(83, 8, 3, 'Out', '2023-09-08'),
(84, 7, 2, 'Out', '2023-09-11'),
(85, 8, 4, 'Out', '2023-09-11'),
(86, 7, 4, 'Out', '2023-09-18'),
(87, 7, 15, 'In', '2023-10-01'),
(88, 8, 10, 'In', '2023-10-01'),
(89, 7, 5, 'Out', '2023-10-04'),
(90, 8, 3, 'Out', '2023-10-04'),
(91, 7, 4, 'Out', '2023-10-17'),
(92, 8, 3, 'Out', '2023-10-20'),
(93, 7, 2, 'Out', '2023-10-26'),
(94, 8, 3, 'Out', '2023-10-27'),
(95, 7, 3, 'Out', '2023-10-29'),
(96, 8, 1, 'Out', '2023-10-30'),
(97, 7, 20, 'In', '2023-11-01'),
(98, 8, 15, 'In', '2023-11-01'),
(99, 7, 3, 'Out', '2023-11-02'),
(100, 8, 2, 'Out', '2023-11-03'),
(101, 7, 5, 'Out', '2023-11-08'),
(102, 8, 3, 'Out', '2023-11-09'),
(103, 7, 5, 'Out', '2023-11-16'),
(104, 8, 4, 'Out', '2023-11-16'),
(105, 7, 5, 'Out', '2023-11-27'),
(106, 8, 4, 'Out', '2023-11-25'),
(107, 9, 4, 'Out', '2023-08-15'),
(108, 9, 3, 'Out', '2023-08-20'),
(109, 9, 20, 'In', '2023-09-01'),
(110, 10, 20, 'In', '2023-09-01'),
(111, 9, 4, 'Out', '2023-09-03'),
(112, 10, 4, 'Out', '2023-09-04'),
(113, 9, 5, 'Out', '2023-09-05'),
(114, 9, 5, 'Out', '2023-09-10'),
(115, 10, 5, 'Out', '2023-09-11'),
(116, 9, 6, 'Out', '2023-09-15'),
(117, 10, 6, 'Out', '2023-09-20'),
(118, 10, 4, 'Out', '2023-09-27'),
(119, 9, 24, 'In', '2023-10-01'),
(120, 10, 20, 'In', '2023-10-01'),
(121, 10, 7, 'Out', '2023-10-02'),
(122, 9, 12, 'Out', '2023-10-15'),
(123, 9, 4, 'Out', '2023-10-17'),
(124, 10, 8, 'Out', '2023-10-20'),
(125, 9, 8, 'Out', '2023-10-21'),
(126, 10, 6, 'Out', '2023-10-28'),
(127, 9, 25, 'In', '2023-11-01'),
(128, 10, 20, 'In', '2023-11-01'),
(129, 9, 9, 'Out', '2023-11-04'),
(130, 10, 5, 'Out', '2023-11-05'),
(131, 9, 8, 'Out', '2023-11-09'),
(132, 10, 4, 'Out', '2023-11-11'),
(133, 9, 7, 'Out', '2023-11-17'),
(134, 10, 6, 'Out', '2023-11-21'),
(135, 9, 2, 'Out', '2023-11-28'),
(136, 10, 5, 'Out', '2023-11-30'),
(137, 11, 3, 'Out', '2023-08-06'),
(138, 11, 2, 'Out', '2023-08-12'),
(139, 11, 4, 'Out', '2023-08-16'),
(140, 12, 2, 'Out', '2023-08-25'),
(141, 11, 5, 'Out', '2023-08-30'),
(142, 11, 20, 'In', '2023-09-01'),
(143, 12, 20, 'In', '2023-09-01'),
(144, 11, 4, 'Out', '2023-09-02'),
(145, 12, 5, 'Out', '2023-09-05'),
(146, 11, 6, 'Out', '2023-09-10'),
(147, 12, 4, 'Out', '2023-09-11'),
(148, 11, 6, 'Out', '2023-09-17'),
(149, 12, 7, 'Out', '2023-09-20'),
(150, 11, 24, 'In', '2023-10-01'),
(151, 12, 23, 'In', '2023-10-01'),
(152, 11, 10, 'Out', '2023-10-07'),
(153, 11, 5, 'Out', '2023-10-08'),
(154, 12, 8, 'Out', '2023-10-11'),
(155, 11, 7, 'Out', '2023-10-17'),
(156, 12, 10, 'Out', '2023-10-18'),
(157, 11, 5, 'Out', '2023-10-25'),
(158, 12, 7, 'Out', '2023-10-26'),
(159, 11, 25, 'In', '2023-11-01'),
(160, 12, 21, 'In', '2023-11-01'),
(161, 12, 7, 'Out', '2023-11-02'),
(162, 11, 8, 'Out', '2023-11-04'),
(163, 11, 6, 'Out', '2023-11-15'),
(164, 12, 9, 'Out', '2023-11-17'),
(165, 11, 5, 'Out', '2023-11-26'),
(166, 12, 8, 'Out', '2023-11-29'),
(167, 13, 2, 'Out', '2023-08-06'),
(168, 13, 3, 'Out', '2023-08-15'),
(169, 14, 3, 'Out', '2023-08-24'),
(170, 13, 4, 'Out', '2023-08-26'),
(171, 13, 15, 'In', '2023-09-01'),
(172, 14, 14, 'In', '2023-09-01'),
(173, 13, 7, 'Out', '2023-09-15'),
(174, 14, 5, 'Out', '2023-09-18'),
(175, 13, 6, 'Out', '2023-09-25'),
(176, 14, 7, 'Out', '2023-09-30'),
(177, 13, 18, 'In', '2023-10-01'),
(178, 14, 17, 'In', '2023-10-01'),
(179, 13, 7, 'Out', '2023-10-05'),
(180, 14, 6, 'Out', '2023-10-08'),
(181, 14, 7, 'Out', '2023-10-15'),
(182, 13, 8, 'Out', '2023-10-19'),
(183, 13, 6, 'Out', '2023-10-28'),
(184, 14, 4, 'Out', '2023-10-29'),
(185, 13, 16, 'In', '2023-11-01'),
(186, 14, 15, 'In', '2023-11-01'),
(187, 13, 4, 'Out', '2023-11-03'),
(188, 14, 5, 'Out', '2023-11-05'),
(189, 13, 6, 'Out', '2023-11-14'),
(190, 14, 5, 'Out', '2023-11-25'),
(191, 14, 6, 'Out', '2023-11-30'),
(192, 15, 3, 'Out', '2023-08-04'),
(193, 16, 5, 'Out', '2023-08-15'),
(194, 15, 6, 'Out', '2023-08-23'),
(195, 15, 16, 'In', '2023-09-01'),
(196, 16, 15, 'In', '2023-09-01'),
(197, 15, 6, 'Out', '2023-09-14'),
(198, 15, 7, 'Out', '2023-09-17'),
(199, 16, 6, 'Out', '2023-09-18'),
(200, 16, 8, 'Out', '2023-09-21'),
(201, 15, 14, 'In', '2023-10-01'),
(202, 16, 13, 'In', '2023-10-01'),
(203, 15, 7, 'Out', '2023-10-10'),
(204, 16, 6, 'Out', '2023-10-11'),
(205, 15, 8, 'Out', '2023-10-20'),
(206, 16, 7, 'Out', '2023-10-25'),
(207, 15, 16, 'In', '2023-11-01'),
(208, 16, 14, 'In', '2023-11-01'),
(209, 15, 10, 'Out', '2023-11-15'),
(210, 16, 7, 'Out', '2023-11-20'),
(211, 15, 4, 'Out', '2023-11-28'),
(212, 16, 6, 'Out', '2023-11-30'),
(213, 17, 4, 'Out', '2023-08-05'),
(214, 18, 2, 'Out', '2023-08-06'),
(215, 17, 4, 'Out', '2023-08-07'),
(216, 17, 2, 'Out', '2023-08-25'),
(217, 17, 15, 'In', '2023-03-01'),
(218, 18, 14, 'In', '2023-09-01'),
(219, 17, 4, 'Out', '2023-09-05'),
(220, 18, 6, 'Out', '2023-09-06'),
(221, 17, 6, 'Out', '2023-09-15'),
(222, 18, 7, 'Out', '2023-09-19'),
(223, 17, 16, 'In', '2023-10-01'),
(224, 18, 15, 'In', '2023-10-01'),
(225, 17, 9, 'Out', '2023-10-15'),
(226, 18, 8, 'Out', '2023-10-18'),
(227, 17, 7, 'Out', '2023-10-27'),
(228, 18, 7, 'Out', '2023-10-28'),
(229, 17, 17, 'In', '2023-11-01'),
(230, 18, 14, 'In', '2023-11-01'),
(231, 17, 8, 'Out', '2023-11-07'),
(232, 18, 8, 'Out', '2023-11-09'),
(233, 17, 5, 'Out', '2023-11-20'),
(234, 18, 6, 'Out', '2023-11-24'),
(235, 17, 7, 'Out', '2023-11-28'),
(236, 49, 14, 'In', '2023-08-01'),
(237, 19, 5, 'Out', '2023-08-08'),
(238, 49, 3, 'Out', '2023-08-11'),
(239, 19, 4, 'Out', '2023-08-16'),
(240, 19, 3, 'Out', '2023-08-20'),
(241, 49, 6, 'Out', '2023-08-25'),
(242, 19, 11, 'In', '2023-09-01'),
(243, 49, 10, 'In', '2023-09-01'),
(244, 19, 3, 'Out', '2023-09-07'),
(245, 19, 4, 'Out', '2023-09-08'),
(246, 19, 3, 'Out', '2023-09-15'),
(247, 49, 4, 'Out', '2023-09-18'),
(248, 19, 3, 'Out', '2023-09-20'),
(249, 49, 5, 'Out', '2023-09-30'),
(250, 19, 15, 'In', '2023-10-01'),
(251, 49, 11, 'In', '2023-10-01'),
(252, 19, 6, 'Out', '2023-10-05'),
(253, 49, 5, 'Out', '2023-10-14'),
(254, 19, 6, 'Out', '2023-10-18'),
(255, 49, 3, 'Out', '2023-10-24'),
(256, 49, 4, 'Out', '2023-10-27'),
(257, 19, 14, 'In', '2023-11-01'),
(258, 49, 14, 'In', '2023-11-01'),
(259, 19, 4, 'Out', '2023-11-06'),
(260, 19, 3, 'Out', '2023-11-07'),
(261, 49, 5, 'Out', '2023-11-09'),
(262, 19, 6, 'Out', '2023-11-18'),
(263, 49, 3, 'Out', '2023-11-20'),
(264, 19, 4, 'Out', '2023-11-25'),
(265, 49, 4, 'Out', '2023-11-29'),
(266, 20, 3, 'Out', '2023-08-07'),
(267, 20, 2, 'Out', '2023-08-16'),
(268, 21, 3, 'Out', '2023-09-20'),
(269, 20, 2, 'Out', '2023-08-30'),
(270, 20, 14, 'In', '2023-09-01'),
(271, 21, 12, 'In', '2023-09-01'),
(272, 20, 5, 'Out', '2023-08-06'),
(273, 20, 2, 'Out', '2023-08-08'),
(274, 22, 2, 'Out', '2023-08-10'),
(275, 22, 3, 'Out', '2023-08-17'),
(276, 22, 2, 'Out', '2023-08-25'),
(277, 23, 1, 'Out', '2023-08-28'),
(278, 22, 4, 'Out', '2023-08-30'),
(279, 22, 15, 'In', '2023-09-01'),
(280, 23, 11, 'In', '2023-09-01'),
(281, 22, 3, 'Out', '2023-09-05'),
(282, 22, 4, 'Out', '2023-09-10'),
(283, 23, 2, 'Out', '2023-09-15'),
(284, 22, 3, 'Out', '2023-09-20'),
(285, 22, 3, 'Out', '2023-09-24'),
(286, 23, 3, 'Out', '2023-09-25'),
(287, 22, 12, 'In', '2023-10-01'),
(288, 23, 12, 'In', '2023-10-01'),
(289, 22, 2, 'Out', '2023-10-05'),
(290, 22, 4, 'Out', '2023-10-10'),
(291, 23, 3, 'Out', '2023-10-15'),
(292, 22, 4, 'Out', '2023-10-17'),
(293, 23, 5, 'Out', '2023-10-20'),
(294, 23, 3, 'Out', '2023-10-27'),
(295, 22, 10, 'In', '2023-11-01'),
(296, 23, 10, 'In', '2023-11-01'),
(297, 22, 3, 'Out', '2023-11-08'),
(298, 23, 4, 'Out', '2023-11-09'),
(299, 22, 5, 'Out', '2023-11-14'),
(300, 22, 5, 'Out', '2023-11-19'),
(301, 23, 4, 'Out', '2023-11-20'),
(302, 23, 3, 'Out', '2023-11-27'),
(303, 24, 5, 'Out', '2023-08-06'),
(304, 24, 3, 'Out', '2023-08-16'),
(305, 24, 4, 'Out', '2023-08-29'),
(306, 24, 14, 'In', '2023-09-01'),
(307, 24, 6, 'Out', '2023-09-05'),
(308, 24, 3, 'Out', '2023-09-14'),
(309, 24, 2, 'Out', '2023-09-20'),
(310, 24, 13, 'In', '2023-10-01'),
(311, 24, 4, 'Out', '2023-10-11'),
(312, 24, 5, 'Out', '2023-10-16'),
(313, 24, 3, 'Out', '2023-10-24'),
(314, 24, 3, 'Out', '2023-10-29'),
(315, 24, 12, 'In', '2023-11-01'),
(316, 24, 3, 'Out', '2023-11-08'),
(317, 24, 4, 'Out', '2023-11-10'),
(318, 24, 5, 'Out', '2023-11-20'),
(319, 25, 4, 'Out', '2023-08-04'),
(320, 25, 3, 'Out', '2023-08-15'),
(321, 25, 5, 'Out', '2023-08-25'),
(322, 25, 12, 'In', '2023-09-01'),
(323, 25, 4, 'Out', '2023-09-06'),
(324, 25, 3, 'Out', '2023-09-15'),
(325, 25, 3, 'Out', '2023-09-25'),
(326, 25, 13, 'In', '2023-10-01'),
(327, 25, 5, 'Out', '2023-10-09'),
(328, 25, 3, 'Out', '2023-10-15'),
(329, 25, 5, 'Out', '2023-10-25'),
(330, 25, 14, 'In', '2023-11-01'),
(331, 25, 5, 'Out', '2023-11-07'),
(332, 25, 2, 'Out', '2023-11-14'),
(333, 25, 4, 'Out', '2023-11-18'),
(334, 25, 4, 'Out', '2023-11-28'),
(335, 26, 3, 'Out', '2023-08-07'),
(336, 26, 5, 'Out', '2023-08-18'),
(337, 26, 4, 'Out', '2023-08-28'),
(338, 26, 13, 'In', '2023-09-01'),
(339, 26, 3, 'Out', '2023-09-05'),
(340, 26, 6, 'Out', '2023-09-15'),
(341, 26, 4, 'Out', '2023-09-25'),
(342, 26, 14, 'In', '2023-10-01'),
(343, 26, 3, 'Out', '2023-10-06'),
(344, 26, 2, 'Out', '2023-10-10'),
(345, 26, 4, 'Out', '2023-10-16'),
(346, 26, 4, 'Out', '2023-10-28'),
(347, 26, 14, 'In', '2023-11-01'),
(348, 26, 5, 'Out', '2023-11-10'),
(349, 26, 4, 'Out', '2023-11-16'),
(350, 26, 3, 'Out', '2023-11-27'),
(351, 27, 4, 'Out', '2023-08-04'),
(352, 27, 2, 'Out', '2023-08-09'),
(353, 27, 4, 'Out', '2023-08-18'),
(354, 27, 4, 'Out', '2023-08-29'),
(355, 27, 14, 'In', '2023-09-01'),
(356, 27, 4, 'Out', '2023-09-05'),
(357, 27, 3, 'Out', '2023-09-16'),
(358, 27, 5, 'Out', '2023-09-24'),
(359, 27, 13, 'In', '2023-10-01'),
(360, 27, 3, 'Out', '2023-10-06'),
(361, 27, 4, 'Out', '2023-10-10'),
(362, 27, 5, 'Out', '2023-10-26'),
(363, 27, 14, 'In', '2023-11-01'),
(364, 27, 3, 'Out', '2023-11-07'),
(365, 27, 4, 'Out', '2023-11-15'),
(366, 27, 3, 'Out', '2023-11-22'),
(367, 27, 4, 'Out', '2023-11-29'),
(368, 29, 4, 'Out', '2023-08-04'),
(369, 29, 3, 'Out', '2023-08-16'),
(370, 29, 2, 'Out', '2023-08-25'),
(371, 29, 12, 'In', '2023-09-01'),
(372, 29, 3, 'Out', '2023-09-06'),
(373, 29, 4, 'Out', '2023-09-14'),
(374, 29, 3, 'Out', '2023-09-27'),
(375, 29, 13, 'In', '2023-10-01'),
(376, 29, 4, 'Out', '2023-10-08'),
(377, 29, 3, 'Out', '2023-10-14'),
(378, 29, 3, 'Out', '2023-10-20'),
(379, 29, 2, 'Out', '2023-10-25'),
(380, 29, 3, 'Out', '2023-10-28'),
(381, 29, 12, 'In', '2023-11-01'),
(382, 29, 4, 'Out', '2023-11-03'),
(383, 29, 4, 'Out', '2023-11-10'),
(384, 29, 2, 'Out', '2023-11-16'),
(385, 29, 2, 'Out', '2023-11-28'),
(386, 30, 3, 'Out', '2023-08-05'),
(387, 30, 4, 'Out', '2023-08-10'),
(388, 30, 3, 'Out', '2023-08-19'),
(389, 30, 3, 'Out', '2023-08-27'),
(390, 30, 12, 'In', '2023-09-01'),
(391, 30, 3, 'Out', '2023-09-06'),
(392, 30, 2, 'Out', '2023-09-16'),
(393, 30, 3, 'Out', '2023-09-20'),
(394, 30, 3, 'Out', '2023-09-27'),
(395, 30, 13, 'In', '2023-10-01'),
(396, 30, 3, 'Out', '2023-10-06'),
(397, 30, 4, 'Out', '2023-10-11'),
(398, 30, 3, 'Out', '2023-10-18'),
(399, 30, 4, 'Out', '2023-10-30'),
(400, 30, 14, 'In', '2023-11-01'),
(401, 30, 3, 'Out', '2023-11-05'),
(402, 30, 3, 'Out', '2023-11-10'),
(403, 30, 4, 'Out', '2023-11-15'),
(404, 30, 3, 'Out', '2023-11-24'),
(405, 31, 3, 'Out', '2023-08-04'),
(406, 31, 4, 'Out', '2023-08-09'),
(407, 31, 3, 'Out', '2023-08-19'),
(408, 31, 2, 'Out', '2023-08-27'),
(409, 31, 13, 'In', '2023-09-01'),
(410, 31, 3, 'Out', '2023-09-04'),
(411, 31, 3, 'Out', '2023-09-10'),
(412, 31, 3, 'Out', '2023-09-18'),
(413, 31, 3, 'Out', '2023-09-25'),
(414, 31, 12, 'In', '2023-10-01'),
(415, 31, 3, 'Out', '2023-10-06'),
(416, 31, 3, 'Out', '2023-10-10'),
(417, 31, 2, 'Out', '2023-10-17'),
(418, 31, 3, 'Out', '2023-10-24'),
(419, 31, 14, 'In', '2023-11-01'),
(420, 31, 3, 'Out', '2023-11-04'),
(421, 31, 4, 'Out', '2023-11-09'),
(422, 31, 3, 'Out', '2023-11-16'),
(423, 31, 3, 'Out', '2023-11-24'),
(424, 32, 3, 'Out', '2023-08-05'),
(425, 32, 3, 'Out', '2023-08-08'),
(426, 32, 2, 'Out', '2023-08-16'),
(427, 32, 3, 'Out', '2023-08-27'),
(428, 32, 14, 'In', '2023-09-01'),
(429, 32, 4, 'Out', '2023-09-04'),
(430, 32, 3, 'Out', '2023-09-10'),
(431, 32, 2, 'Out', '2023-09-16'),
(432, 32, 3, 'Out', '2023-09-24'),
(433, 32, 1, 'Out', '2023-09-28'),
(434, 32, 12, 'In', '2023-10-01'),
(435, 32, 4, 'Out', '2023-10-04'),
(436, 32, 3, 'Out', '2023-10-14'),
(437, 32, 3, 'Out', '2023-10-19'),
(438, 32, 4, 'Out', '2023-10-25'),
(439, 32, 13, 'In', '2023-11-01'),
(440, 32, 4, 'Out', '2023-11-06'),
(441, 32, 3, 'Out', '2023-11-15'),
(442, 32, 3, 'Out', '2023-11-20'),
(443, 32, 3, 'Out', '2023-11-28'),
(444, 33, 4, 'Out', '2023-08-05'),
(445, 33, 3, 'Out', '2023-08-10'),
(446, 33, 4, 'Out', '2023-08-25'),
(447, 33, 10, 'In', '2023-09-01'),
(448, 33, 3, 'Out', '2023-09-07'),
(449, 33, 3, 'Out', '2023-09-10'),
(450, 33, 4, 'Out', '2023-09-18'),
(451, 33, 12, 'In', '2023-10-01'),
(452, 33, 3, 'Out', '2023-10-07'),
(453, 33, 3, 'Out', '2023-10-15'),
(454, 33, 4, 'Out', '2023-10-19'),
(455, 33, 3, 'Out', '2023-10-27'),
(456, 33, 13, 'In', '2023-11-01'),
(457, 33, 3, 'Out', '2023-11-08'),
(458, 33, 4, 'Out', '2023-11-10'),
(459, 33, 5, 'Out', '2023-11-28'),
(460, 34, 3, 'Out', '2023-08-07'),
(461, 34, 5, 'Out', '2023-08-28'),
(462, 34, 8, 'In', '2023-09-01'),
(463, 34, 4, 'Out', '2023-09-10'),
(464, 34, 6, 'Out', '2023-09-25'),
(465, 34, 10, 'In', '2023-10-01'),
(466, 34, 5, 'Out', '2023-10-09'),
(467, 34, 6, 'Out', '2023-10-25'),
(468, 34, 10, 'In', '2023-11-01'),
(469, 34, 4, 'Out', '2023-11-16'),
(470, 34, 2, 'Out', '2023-11-30'),
(471, 35, 5, 'Out', '2023-08-15'),
(472, 35, 6, 'Out', '2023-08-25'),
(473, 35, 10, 'In', '2023-09-01'),
(474, 35, 4, 'Out', '2023-09-05'),
(475, 35, 5, 'Out', '2023-09-24'),
(476, 35, 13, 'In', '2023-10-01'),
(477, 35, 5, 'Out', '2023-10-16'),
(478, 35, 6, 'Out', '2023-10-28'),
(479, 35, 4, 'Out', '2023-10-30'),
(480, 35, 10, 'In', '2023-11-01'),
(481, 35, 4, 'Out', '2023-11-06'),
(482, 35, 5, 'Out', '2023-11-25'),
(483, 36, 4, 'Out', '2023-08-07'),
(484, 36, 6, 'Out', '2023-08-20'),
(486, 36, 10, 'In', '2023-10-01'),
(487, 37, 4, 'Out', '2023-08-05'),
(488, 37, 5, 'Out', '2023-08-14'),
(489, 37, 3, 'Out', '2023-08-29'),
(490, 37, 10, 'In', '2023-09-01'),
(491, 37, 5, 'Out', '2023-09-06'),
(492, 37, 4, 'Out', '2023-09-25'),
(493, 37, 10, 'In', '2023-10-01'),
(494, 37, 6, 'Out', '2023-10-10'),
(495, 37, 4, 'Out', '2023-10-25'),
(496, 37, 10, 'In', '2023-11-01'),
(497, 37, 4, 'Out', '2023-11-14'),
(498, 37, 4, 'Out', '2023-11-19'),
(499, 37, 4, 'Out', '2023-11-26'),
(500, 38, 3, 'Out', '2023-08-05'),
(501, 38, 4, 'Out', '2023-08-16'),
(502, 38, 3, 'Out', '2023-08-25'),
(503, 38, 10, 'In', '2023-09-01'),
(504, 38, 4, 'Out', '2023-09-05'),
(505, 38, 3, 'Out', '2023-09-17'),
(506, 38, 4, 'Out', '2023-09-26'),
(507, 38, 11, 'In', '2023-10-01'),
(508, 38, 4, 'Out', '2023-10-06'),
(509, 38, 3, 'Out', '2023-10-18'),
(510, 38, 3, 'Out', '2023-10-28'),
(511, 38, 12, 'In', '2023-11-01'),
(512, 38, 3, 'Out', '2023-11-27'),
(513, 38, 5, 'Out', '2023-11-14'),
(514, 38, 4, 'Out', '2023-11-26'),
(515, 39, 4, 'Out', '2023-08-11'),
(516, 39, 4, 'Out', '2023-08-18'),
(517, 39, 4, 'Out', '2023-08-20'),
(518, 40, 4, 'Out', '2023-08-07'),
(519, 40, 3, 'Out', '2023-08-15'),
(520, 40, 4, 'Out', '2023-08-25'),
(521, 40, 10, 'In', '2023-09-01'),
(522, 40, 4, 'Out', '2023-09-06'),
(523, 40, 4, 'Out', '2023-09-17'),
(524, 40, 2, 'Out', '2023-09-30'),
(525, 40, 11, 'In', '2023-10-01'),
(526, 40, 5, 'Out', '2023-10-12'),
(527, 40, 4, 'Out', '2023-10-20'),
(528, 40, 4, 'Out', '2023-10-28'),
(529, 40, 13, 'In', '2023-11-01'),
(530, 40, 6, 'Out', '2023-11-17'),
(531, 40, 5, 'Out', '2023-11-27'),
(532, 42, 4, 'Out', '2023-08-08'),
(533, 42, 4, 'Out', '2023-08-25'),
(534, 42, 8, 'In', '2023-09-01'),
(535, 42, 5, 'Out', '2023-09-16'),
(536, 42, 3, 'Out', '2023-09-29'),
(537, 42, 9, 'In', '2023-10-01'),
(538, 42, 5, 'Out', '2023-10-07'),
(539, 42, 4, 'Out', '2023-10-25'),
(540, 42, 10, 'In', '2023-11-01'),
(541, 42, 6, 'Out', '2023-11-14'),
(542, 42, 4, 'Out', '2023-11-25'),
(543, 43, 4, 'Out', '2023-08-10'),
(544, 43, 4, 'Out', '2023-08-26'),
(545, 43, 8, 'In', '2023-09-01'),
(546, 43, 4, 'Out', '2023-09-08'),
(547, 43, 3, 'Out', '2023-09-25'),
(548, 43, 9, 'In', '2023-10-01'),
(549, 43, 4, 'Out', '2023-10-08'),
(550, 43, 5, 'Out', '2023-10-24'),
(551, 43, 10, 'In', '2023-11-01'),
(552, 43, 5, 'Out', '2023-11-11'),
(553, 43, 5, 'Out', '2023-11-26'),
(554, 44, 4, 'Out', '2023-08-08'),
(555, 44, 6, 'Out', '2023-08-17'),
(556, 44, 8, 'In', '2023-09-01'),
(557, 44, 4, 'Out', '2023-09-15'),
(558, 44, 4, 'Out', '2023-09-24'),
(559, 44, 9, 'In', '2023-10-01'),
(560, 44, 4, 'Out', '2023-10-06'),
(561, 44, 5, 'Out', '2023-10-26'),
(562, 44, 9, 'In', '2023-11-01'),
(563, 44, 3, 'Out', '2023-11-15'),
(564, 44, 4, 'Out', '2023-11-16'),
(565, 44, 3, 'Out', '2023-11-28'),
(566, 45, 3, 'Out', '2023-08-19'),
(567, 45, 4, 'Out', '2023-08-21'),
(568, 45, 3, 'Out', '2023-08-29'),
(569, 45, 9, 'In', '2023-09-01'),
(570, 45, 4, 'Out', '2023-09-08'),
(571, 45, 4, 'Out', '2023-09-14'),
(572, 45, 3, 'Out', '2023-09-25'),
(573, 45, 9, 'In', '2023-10-01'),
(574, 45, 6, 'Out', '2023-10-25'),
(575, 45, 8, 'In', '2023-11-01'),
(576, 45, 6, 'Out', '2023-11-19'),
(577, 45, 4, 'Out', '2023-11-27'),
(579, 41, 4, 'Out', '2023-08-29'),
(580, 11, 1, 'In', '2023-12-04'),
(581, 7, 1, 'Out', '2023-12-02'),
(582, 8, 1, 'Out', '2023-12-05'),
(583, 11, 1, 'Out', '2023-12-05'),
(584, 13, 1, 'Out', '2023-12-06'),
(585, 41, 1, 'Out', '2023-12-06'),
(586, 36, 1, 'Out', '2023-12-08');

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
(63, 137648118, 'User logged in', '2023-11-30 11:22:39'),
(64, 137648118, 'User logged in', '2023-11-30 12:29:36'),
(65, 137648118, 'Product with ProductID: 1 has been deleted.', '2023-11-30 14:23:00'),
(66, 137648118, 'Product with ProductID: 2 has been deleted.', '2023-11-30 14:23:05'),
(67, 137648118, 'Category with Name: Long Sleeve has been created.', '2023-11-30 14:27:42'),
(68, 137648118, 'Category with Name: Boxy Oversize Down Jacket has been created.', '2023-11-30 14:45:42'),
(69, 137648118, 'Category with Name: Cordura Jacket has been created.', '2023-11-30 14:46:00'),
(70, 137648118, 'Category with Name: Outdor Gorpcore Jacket has been created.', '2023-11-30 14:46:36'),
(71, 137648118, 'Category with Name: Bikers Jacket has been created.', '2023-11-30 14:47:07'),
(72, 137648118, 'Category with Name: Parka Jacket has been created.', '2023-11-30 14:47:25'),
(73, 137648118, 'Category with Name: Riversible Jacket has been created.', '2023-11-30 14:47:47'),
(74, 137648118, 'Category with Name: Coach Jacket has been created.', '2023-11-30 14:48:04'),
(75, 137648118, 'Category with Name: Windbreaker Jacket has been created.', '2023-11-30 14:50:32'),
(76, 137648118, 'Category with Name: Trucker Jacket has been created.', '2023-11-30 14:51:03'),
(77, 137648118, 'Category with Name: Fleece Jacket has been created.', '2023-11-30 14:51:27'),
(78, 137648118, 'Category with Name: Chore Jacket has been created.', '2023-11-30 14:51:47'),
(79, 137648118, 'Category with Name: Puffer Jacket has been created.', '2023-11-30 14:52:07'),
(80, 137648118, 'Category with Name: Sport Jacket has been created.', '2023-11-30 14:52:33'),
(81, 137648118, 'Category with Name: Bomber Jacket has been created.', '2023-11-30 14:53:28'),
(82, 137648118, 'Category with Name: Varsity Jacket has been created.', '2023-11-30 14:54:06'),
(83, 137648118, 'Category with Name: Leather Jacket has been created.', '2023-11-30 14:54:52'),
(84, 137648118, 'Category with Name: Pea Coat has been created.', '2023-11-30 14:55:20'),
(85, 137648118, 'Category with Name: Over Coat has been created.', '2023-11-30 14:55:35'),
(86, 137648118, 'Category with Name: Reversible Jacket has been created.', '2023-11-30 14:56:16'),
(87, 137648118, 'Category with Name: Polo Shirt has been created.', '2023-11-30 14:59:11'),
(88, 137648118, 'Category with Name: Flanel Shirt has been created.', '2023-11-30 14:59:45'),
(89, 137648118, 'Category with Name: Oxford Shirt has been created.', '2023-11-30 15:00:10'),
(90, 137648118, 'Category with Name: Denim Shirt has been created.', '2023-11-30 15:00:30'),
(91, 137648118, 'Category with Name: Twill Shirt has been created.', '2023-11-30 15:00:45'),
(92, 137648118, 'Category with Name: Fishtail Parka Jacket has been created.', '2023-11-30 15:10:30'),
(93, 137648118, 'Category with Name: Cagoule Jacket has been created.', '2023-11-30 15:17:30'),
(94, 137648118, 'Brand with BrandName: Levi\\\'s has been updated.', '2023-11-30 15:21:41'),
(95, 137648118, 'Brand with BrandName: O\\\'neill has been updated.', '2023-11-30 15:22:29'),
(96, 137648118, 'Category with Name: Linen Jacket has been created.', '2023-11-30 15:37:29'),
(97, 137648118, 'Category with Name: Cordura Sherpa Jacket has been created.', '2023-11-30 15:39:29'),
(98, 137648118, 'Color with Name: Plaid Patern has been created.', '2023-11-30 16:01:00'),
(99, 137648118, 'Color with ColorName: White Plaid Patern has been updated.', '2023-11-30 16:01:37'),
(100, 137648118, 'Color with Name: White Stripes Patern has been created.', '2023-11-30 16:02:04'),
(101, 137648118, 'Color with Name: Army Green has been created.', '2023-11-30 16:02:34'),
(102, 137648118, 'Color with Name: Olive Green has been created.', '2023-11-30 16:05:17'),
(103, 137648118, 'Color with Name: Blue Stripes Patern has been created.', '2023-11-30 16:05:49'),
(104, 137648118, 'Color with Name: Blue Denim has been created.', '2023-11-30 16:06:06'),
(105, 137648118, 'Color with Name: Cream has been created.', '2023-11-30 16:06:26'),
(106, 137648118, 'Color with Name: Maroon has been created.', '2023-11-30 16:06:41'),
(107, 137648118, 'Color with Name: Charcoal/Gray has been created.', '2023-11-30 16:07:15'),
(108, 137648118, 'Color with Name: Sage Green has been created.', '2023-11-30 16:07:44'),
(109, 137648118, 'Color with Name: Red Stripes Patern has been created.', '2023-11-30 16:08:29'),
(110, 137648118, 'Color with Name: Light Blue has been created.', '2023-11-30 16:09:02'),
(111, 137648118, 'Color with Name: Black White Buttondown Patern has been created.', '2023-11-30 16:09:35'),
(112, 137648118, 'Color with Name: Black White Stripes Patern has been created.', '2023-11-30 16:10:09'),
(113, 137648118, 'Color with Name: Black has been created.', '2023-11-30 16:10:24'),
(114, 137648118, 'Color with Name: Brown has been created.', '2023-11-30 16:10:47'),
(115, 137648118, 'Color with Name: Black Brown has been created.', '2023-11-30 16:11:21'),
(116, 137648118, 'Color with Name: Black Leather has been created.', '2023-11-30 16:11:36'),
(117, 137648118, 'Color with Name: Dark Blue Denim has been created.', '2023-11-30 16:11:57'),
(118, 137648118, 'Color with Name: White Blue has been created.', '2023-11-30 16:12:24'),
(119, 137648118, 'Color with Name: Blue has been created.', '2023-11-30 16:12:59'),
(120, 137648118, 'Color with Name: Light Blue Denim has been created.', '2023-11-30 16:13:28'),
(121, 137648118, 'Color with Name: Green has been created.', '2023-11-30 16:13:48'),
(122, 137648118, 'Color with Name: Light Green has been created.', '2023-11-30 16:19:54'),
(123, 137648118, 'Color with Name: Dark Blue Denim has been created.', '2023-11-30 16:32:15'),
(124, 137648118, 'Color with Name: Black and White has been created.', '2023-11-30 16:33:39'),
(125, 137648118, 'Color with Name: Red has been created.', '2023-11-30 16:38:52'),
(126, 137648118, 'User logged in', '2023-12-05 11:07:14'),
(127, 137648118, 'User logged in', '2023-12-05 14:39:35'),
(128, 137648118, 'User logged out', '2023-12-05 14:42:59'),
(129, 137648118, 'User logged in', '2023-12-05 14:43:08'),
(130, 137648118, 'User logged out', '2023-12-05 15:18:51'),
(131, 137648118, 'User logged in', '2023-12-05 15:19:06'),
(132, 137648118, 'User with Username: ricky has been update.', '2023-12-05 15:20:18'),
(133, 137648118, 'User with Username: yohanes has been update.', '2023-12-05 15:21:18'),
(134, 137648118, 'User logged out', '2023-12-05 15:21:38'),
(135, 137648118, 'User logged in', '2023-12-05 15:21:52'),
(136, 137648118, 'User logged out', '2023-12-05 15:22:27'),
(137, 0, 'User logged in', '2023-12-05 15:22:36'),
(138, 0, 'User logged out', '2023-12-11 12:14:53'),
(139, 137648118, 'User logged in', '2023-12-11 12:15:04'),
(140, 2147483647, 'User logged in', '2023-12-13 01:20:19'),
(141, 2147483647, 'User logged in', '2023-12-14 00:27:52'),
(142, 2147483647, 'User logged out', '2023-12-14 14:56:56'),
(143, 0, 'User logged in', '2023-12-14 14:57:16'),
(144, 2147483647, 'User logged in', '2023-12-14 15:14:26'),
(145, 0, 'User logged in', '2023-12-14 15:34:00'),
(146, 0, 'User logged out', '2023-12-14 16:12:40'),
(147, 2147483647, 'User logged in', '2023-12-14 16:12:54'),
(148, 2147483647, 'User logged out', '2023-12-14 16:17:43'),
(149, 0, 'User logged in', '2023-12-14 16:17:57'),
(150, 0, 'User logged out', '2023-12-14 16:20:46'),
(151, 2147483647, 'User logged in', '2023-12-14 16:20:52'),
(152, 2147483647, 'User logged out', '2023-12-14 16:25:05'),
(153, 0, 'User logged in', '2023-12-14 16:25:18');

-- --------------------------------------------------------

--
-- Table structure for table `MonthlyProductStocks`
--

CREATE TABLE `MonthlyProductStocks` (
  `MonthlyStockID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `StockID` int(11) NOT NULL,
  `ColorID` int(11) NOT NULL,
  `BrandID` int(11) NOT NULL,
  `SizeID` int(11) NOT NULL,
  `Month` varchar(10) NOT NULL,
  `TotalStockIn` int(11) DEFAULT NULL,
  `TotalStockOut` int(11) DEFAULT NULL,
  `RemainingStock` int(11) DEFAULT NULL,
  `Restock` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `MonthlyProductStocks`
--

INSERT INTO `MonthlyProductStocks` (`MonthlyStockID`, `ProductID`, `StockID`, `ColorID`, `BrandID`, `SizeID`, `Month`, `TotalStockIn`, `TotalStockOut`, `RemainingStock`, `Restock`) VALUES
(1, 5, 12, 43, 56, 3, 'August', 3, 2, 1, 1),
(2, 5, 12, 43, 56, 3, 'September', 21, 16, 5, 1),
(3, 5, 12, 43, 56, 3, 'October', 28, 25, 3, 1),
(4, 5, 11, 43, 56, 4, 'August', 16, 14, 2, 1),
(5, 5, 11, 43, 56, 4, 'September', 22, 16, 6, 0),
(6, 5, 11, 43, 56, 4, 'October', 30, 27, 3, 1),
(7, 5, 11, 43, 56, 4, 'November', 28, 19, 9, 0),
(8, 9, 49, 51, 69, 3, 'August', 14, 9, 5, 1),
(9, 9, 49, 51, 69, 3, 'September', 15, 9, 6, 0),
(10, 9, 49, 51, 69, 3, 'October', 17, 12, 5, 1),
(11, 9, 19, 51, 69, 4, 'August', 19, 12, 7, 0),
(12, 9, 19, 51, 69, 4, 'September', 18, 13, 5, 1),
(13, 9, 19, 51, 69, 4, 'October', 20, 12, 8, 0),
(14, 15, 27, 58, 56, 4, 'August', 19, 14, 5, 1),
(15, 15, 27, 58, 56, 4, 'September', 19, 12, 7, 0),
(16, 15, 27, 58, 56, 4, 'October', 20, 12, 8, 0),
(17, 4, 10, 42, 56, 3, 'August', 4, 2, 2, 1),
(18, 4, 10, 42, 56, 3, 'September', 22, 19, 3, 1),
(19, 4, 10, 42, 56, 3, 'October', 23, 21, 2, 1),
(20, 4, 9, 42, 56, 4, 'August', 11, 7, 4, 1),
(21, 4, 9, 42, 56, 4, 'September', 24, 20, 4, 1),
(22, 4, 9, 42, 56, 4, 'October', 28, 24, 4, 1),
(23, 7, 16, 62, 56, 3, 'August', 7, 5, 2, 1),
(24, 7, 16, 62, 56, 3, 'September', 17, 14, 3, 1),
(25, 7, 16, 62, 56, 3, 'October', 16, 13, 3, 1),
(26, 7, 15, 62, 56, 4, 'August', 13, 9, 4, 1),
(27, 7, 15, 62, 56, 4, 'September', 20, 13, 7, 0),
(28, 7, 15, 62, 56, 4, 'October', 21, 15, 6, 0),
(29, 8, 18, 48, 68, 3, 'August', 6, 2, 4, 1),
(30, 8, 18, 48, 68, 3, 'September', 18, 13, 5, 1),
(31, 8, 18, 48, 68, 3, 'October', 20, 15, 5, 1),
(32, 8, 17, 48, 68, 4, 'March', 15, 0, 15, 0),
(33, 8, 17, 48, 68, 4, 'August', 29, 10, 19, 0),
(34, 8, 17, 48, 68, 4, 'September', 19, 10, 9, 0),
(35, 8, 17, 48, 68, 4, 'October', 25, 16, 9, 0),
(36, 13, 25, 44, 73, 4, 'August', 17, 12, 5, 1),
(37, 13, 25, 44, 73, 4, 'September', 17, 10, 7, 0),
(38, 13, 25, 44, 73, 4, 'October', 20, 13, 7, 0),
(39, 17, 29, 66, 76, 4, 'August', 16, 9, 7, 0),
(40, 17, 29, 66, 76, 4, 'September', 19, 10, 9, 0),
(41, 17, 29, 66, 76, 4, 'October', 22, 15, 7, 0),
(42, 20, 32, 60, 35, 4, 'August', 19, 11, 8, 0),
(43, 20, 32, 60, 35, 4, 'September', 22, 13, 9, 0),
(44, 20, 32, 60, 35, 4, 'October', 21, 14, 7, 0),
(45, 21, 33, 55, 77, 4, 'August', 20, 11, 9, 0),
(46, 21, 33, 55, 77, 4, 'September', 19, 10, 9, 0),
(47, 21, 33, 55, 77, 4, 'October', 21, 13, 8, 0);

-- --------------------------------------------------------

--
-- Table structure for table `MonthlyProductStockTests`
--

CREATE TABLE `MonthlyProductStockTests` (
  `MonthlyStockTestID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `StockID` int(11) NOT NULL,
  `ColorID` int(11) NOT NULL,
  `BrandID` int(11) NOT NULL,
  `SizeID` int(11) NOT NULL,
  `Month` varchar(10) NOT NULL,
  `TotalStockIn` int(11) DEFAULT NULL,
  `TotalStockOut` int(11) DEFAULT NULL,
  `RemainingStock` int(11) DEFAULT NULL,
  `Restock` tinyint(1) NOT NULL,
  `NaiveBayesPrediction` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `MonthlyProductStockTests`
--

INSERT INTO `MonthlyProductStockTests` (`MonthlyStockTestID`, `ProductID`, `StockID`, `ColorID`, `BrandID`, `SizeID`, `Month`, `TotalStockIn`, `TotalStockOut`, `RemainingStock`, `Restock`, `NaiveBayesPrediction`) VALUES
(1, 5, 12, 43, 56, 3, 'November', 24, 24, 0, 1, 1),
(2, 5, 11, 43, 56, 4, 'December', 10, 1, 9, 0, 0),
(3, 9, 49, 51, 69, 3, 'November', 19, 12, 7, 0, 0),
(4, 9, 19, 51, 69, 4, 'November', 22, 17, 5, 1, 1),
(5, 15, 27, 58, 56, 4, 'November', 22, 14, 8, 0, 0),
(6, 4, 10, 42, 56, 3, 'November', 22, 20, 2, 1, 1),
(7, 4, 9, 42, 56, 4, 'November', 29, 26, 3, 1, 1),
(8, 7, 16, 62, 56, 3, 'November', 17, 13, 4, 1, 1),
(9, 7, 15, 62, 56, 4, 'November', 22, 14, 8, 0, 0),
(10, 8, 18, 48, 68, 3, 'November', 19, 14, 5, 1, 1),
(11, 8, 17, 48, 68, 4, 'November', 26, 20, 6, 0, 1),
(12, 8, 47, 18, 68, 6, 'August', 1, 0, 1, 1, 0),
(13, 13, 25, 44, 73, 4, 'November', 21, 15, 6, 0, 0),
(14, 17, 29, 66, 76, 4, 'November', 19, 12, 7, 0, 0),
(15, 20, 32, 60, 35, 4, 'November', 20, 13, 7, 0, 0),
(16, 21, 33, 55, 77, 4, 'November', 21, 12, 9, 0, 0);

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
(3, 'LYLE AND SCOTT PLAID PATERN LS', '65689aaff315e_Web capture_30-11-2023_211931_www.instagram.com.jpeg', 'LYLE AND SCOTT PLAID PATERN LS BY LYLE AND SCOTT', 172000.00, 81, 65),
(4, 'UNIQLO STRIPES PATERN LS', '65689b59b364e_Web capture_30-11-2023_212411_www.instagram.com.jpeg', 'UNIQLO STRIPES PATERN LS BY UNIQLO', 119000.00, 81, 56),
(5, 'UNIQLO ARMY GREEN SHANGHAI LS', '65689c83e4738_Web capture_30-11-2023_212920_www.instagram.com.jpeg', 'UNIQLO ARMY GREEN SHANGHAI LS BY UNIQLO', 149000.00, 81, 56),
(6, 'GIORDANO OXFORD LS', '65689ce326cc3_Web capture_30-11-2023_213057_www.instagram.com.jpeg', 'GIORDANO OXFORD LS BY GIORDANO', 119000.00, 81, 67),
(7, 'UNIQLO 2 POCKET LS', '65689d380f175_Web capture_30-11-2023_213236_www.instagram.com.jpeg', 'UNIQLO 2 POCKET LS BY UNIQLO', 119000.00, 81, 56),
(8, 'MAROON BLANK LS', '65689dcf25311_Web capture_30-11-2023_213548_www.instagram.com.jpeg', 'MAROON BLANK LS BY JOGUNSHOP', 135000.00, 81, 68),
(9, 'OPEN COLLAR STRIPES PATERN LS', '65689e5edad14_Web capture_30-11-2023_213735_www.instagram.com.jpeg', 'OPEN COLLAR STRIPES PATERN LS BY RAGEBLUE', 150000.00, 81, 69),
(10, 'UNIQLO OXFORD LS', '65689eb5eca35_Web capture_30-11-2023_21390_www.instagram.com.jpeg', 'UNIQLO OXFORD LS BY UNIQLO', 119000.00, 81, 56),
(11, 'DICKIES BUTTONDOWN PATERN LS', '65689f1bb0def_Web capture_30-11-2023_214037_www.instagram.com.jpeg', 'DICKIES BUTTONDOWN PATERN LS BY DICKIES', 169000.00, 81, 70),
(12, 'HNM BOXY OVERSIZE DOWN JACKET', '6568a44d4a83a_Web capture_30-11-2023_214243_www.instagram.com.jpeg', 'HNM BOXY OVERSIZE DOWN JACKET BY HNM', 265000.00, 82, 72),
(13, 'COEN JAPAN CORDURA JACKET', '6568a4c3e8378_Web capture_30-11-2023_22453_www.instagram.com.jpeg', 'COEN JAPAN CORDURA JACKET BY COEN JAPAN', 184000.00, 83, 73),
(14, 'OUTDOR GORPCORE JACKET', '6568a52c31bd7_Web capture_30-11-2023_22639_www.instagram.com.jpeg', 'OUTDOR GORPCORE JACKET BY AIGLE', 225000.00, 84, 74),
(15, 'UNIQLO BIKERS HOODED JACKET', '6568a5933d428_Web capture_30-11-2023_2282_www.instagram.com.jpeg', 'UNIQLO BIKERS HOODED JACKET BY UNIQLO', 165000.00, 85, 56),
(17, 'WHOAU REVERSIBLE JACKET', '6568a6945269b_Web capture_30-11-2023_221240_www.instagram.com.jpeg', 'WHOAU REVERSIBLE JACKET BY WHOAU', 305000.00, 87, 76),
(18, 'KANGOL COACH JACKET', '6568a6dd4eb32_Web capture_30-11-2023_221348_www.instagram.com.jpeg', 'KANGOL COACH JACKET BY KANGOL', 198000.00, 88, 77),
(19, 'N3B ALPHA INDUSTRIES JACKET', '6568a763afaa7_Web capture_30-11-2023_221540_www.instagram.com.jpeg', 'N3B ALPHA INDUSTRIES JACKET BY ALPHA INDUSTRIES', 375000.00, 86, 78),
(20, 'FILA CAGOULE JACKET ', '6568a7d9d351e_Web capture_30-11-2023_221758_www.instagram.com.jpeg', 'FILA CAGOULE JACKET BY FILA', 210000.00, 107, 35),
(21, 'WB VTG TAPPED KANGOL SPORT', '6568a8388de51_Web capture_30-11-2023_221927_www.instagram.com.jpeg', 'WB VTG TAPPED KANGOL SPORT BY KANGOL', 235000.00, 82, 77),
(22, 'ONEIL OUTDOR WATERPROFF JACKET', '6568a956b39e9_Web capture_30-11-2023_222334_www.instagram.com.jpeg', 'ONEIL OUTDOR WATERPROFF JACKET BY ONEIL', 220000.00, 83, 80),
(23, 'TRUCKER SHERPA JACKET ', '6568a9e5e845d_Web capture_30-11-2023_222714_www.instagram.com.jpeg', 'TRUCKER SHERPA JACKET BY ZIP', 245000.00, 90, 81),
(24, 'JEEP MULTIPLE POCKET JACKET', '6568aa438dd71_Web capture_30-11-2023_222816_www.instagram.com.jpeg', 'JEEP MULTIPLE POCKET JACKET BY JEEP', 210000.00, 95, 82),
(25, 'M65 PARKA JACKET', '6568aaaa7f411_Web capture_30-11-2023_222947_www.instagram.com.jpeg', 'M65 PARKA JACKET BY BEAN POLE', 450000.00, 86, 83),
(26, 'ZARA MAN FULLZIP JACKET', '6568ab08d6d91_Web capture_30-11-2023_223120_www.instagram.com.jpeg', 'ZARA MAN FULLZIP JACKETBY ZARA MAN', 265000.00, 95, 4),
(27, 'VTG 90S LOTTO WB JACKET', '6568abbfe454b_Web capture_30-11-2023_223458_www.instagram.com.jpeg', 'VTG 90S LOTTO WB JACKET BY LOTTO', 265000.00, 94, 84),
(28, 'ALPHA INDUSTRI PRIMALOV BOMBER', '6568ac0eee4e7_Web capture_30-11-2023_22363_www.instagram.com.jpeg', 'ALPHA INDUSTRI PRIMALOV BOMBER BY ALPHA INDUSTRI', 350000.00, 95, 78),
(29, 'ZARA MAN LINEN JACKET', '6568ac78c7f53_Web capture_30-11-2023_223750_www.instagram.com.jpeg', 'ZARA MAN LINEN JACKET BY ZARA MAN', 245000.00, 108, 4),
(30, 'VTG TOYO SUGARCANE KORDUROY SHERPA JACKET', '6568acfa219b7_Web capture_30-11-2023_223951_www.instagram.com.jpeg', 'VTG TOYO SUGARCANE KORDUROY SHERPA JACKET BY TOYO SUGARCANE', 315000.00, 109, 85),
(31, 'KANGOL WINDBRAKER JACKET ', '6568ad6a0eeca_Web capture_30-11-2023_224122_www.instagram.com.jpeg', 'KANGOL WINDBRAKER JACKET BY KANGOL', 186000.00, 89, 77),
(32, 'XLARGE TANKER JACKET', '6568ae05c21df_Web capture_30-11-2023_224420_www.instagram.com.jpeg', 'XLARGE TANKER JACKET BY XLARGE', 398000.00, 86, 86),
(33, 'ADIDAS TRHEE FOIL JACKET BY ADIDAS', '6568ae745abe9_Web capture_30-11-2023_224637_www.instagram.com.jpeg', 'ADIDAS TRHEE FOIL JACKET BY ADIDAS', 285000.00, 83, 2);

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
(7, 3, 4, 41, 5),
(8, 3, 3, 41, 4),
(9, 4, 4, 42, 3),
(10, 4, 3, 42, 2),
(11, 5, 4, 43, 9),
(12, 5, 3, 43, 0),
(13, 6, 4, 64, 7),
(14, 6, 3, 64, 4),
(15, 7, 4, 62, 8),
(16, 7, 3, 62, 4),
(17, 8, 4, 48, 6),
(18, 8, 3, 48, 5),
(19, 9, 4, 51, 5),
(20, 10, 4, 52, 12),
(21, 10, 3, 52, 15),
(22, 11, 4, 53, 6),
(23, 11, 3, 53, 8),
(24, 12, 4, 55, 7),
(25, 13, 4, 44, 7),
(26, 14, 4, 57, 8),
(27, 15, 4, 58, 8),
(29, 17, 4, 66, 7),
(30, 18, 4, 56, 8),
(31, 19, 4, 55, 9),
(32, 20, 4, 60, 7),
(33, 21, 4, 55, 9),
(34, 22, 4, 47, 8),
(35, 23, 4, 46, 8),
(36, 24, 4, 67, 18),
(37, 25, 4, 55, 7),
(38, 26, 4, 55, 8),
(39, 27, 4, 61, 8),
(40, 28, 4, 50, 8),
(41, 29, 4, 61, 13),
(42, 30, 4, 62, 9),
(43, 31, 4, 55, 9),
(44, 32, 4, 56, 8),
(45, 33, 4, 55, 7),
(46, 3, 5, 14, 0),
(47, 8, 6, 18, 0),
(48, 3, 1, 14, 0),
(49, 9, 3, 51, 7);

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
(0, 'ricky', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f', 'rickylaschka@gmail.com', 'Ricky Laschka Zidane Santoso', '2000-08-05', 'Male', 'Pare', '085236777545', 2, '2023-12-14 16:25:18', '2023-12-14 23:25:18', NULL, '653e5a409b4fb.jpeg', NULL),
(137648118, 'yohanes', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f', 'yohanes@gmail.com', 'Yohanes putra yesus', '1999-11-10', 'Male', 'tunglur', '081235682766', 1, '2023-12-11 12:15:04', '2023-12-11 19:15:04', NULL, 'default.png', NULL),
(2147483647, 'admin1', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f', 'admin1@gmail.com', 'admin1', NULL, NULL, NULL, NULL, 1, '2023-12-14 16:20:52', '2023-12-14 23:20:52', NULL, 'default.png', NULL);

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
  ADD KEY `dailytransaction_ibfk_1` (`StockID`);

--
-- Indexes for table `LogActivities`
--
ALTER TABLE `LogActivities`
  ADD PRIMARY KEY (`LogID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `MonthlyProductStocks`
--
ALTER TABLE `MonthlyProductStocks`
  ADD PRIMARY KEY (`MonthlyStockID`),
  ADD KEY `monthlyproductstocks_ibfk_1` (`ProductID`),
  ADD KEY `monthlyproductstocks_ibfk_2` (`StockID`),
  ADD KEY `monthlyproductstocks_ibfk_3` (`ColorID`),
  ADD KEY `monthlyproductstocks_ibfk_4` (`BrandID`),
  ADD KEY `monthlyproductstocks_ibfk_5` (`SizeID`);

--
-- Indexes for table `MonthlyProductStockTests`
--
ALTER TABLE `MonthlyProductStockTests`
  ADD PRIMARY KEY (`MonthlyStockTestID`),
  ADD KEY `monthlyproductstocktests_ibfk_1` (`ProductID`),
  ADD KEY `monthlyproductstocktests_ibfk_2` (`StockID`),
  ADD KEY `monthlyproductstocktests_ibfk_3` (`ColorID`),
  ADD KEY `monthlyproductstocktests_ibfk_4` (`BrandID`),
  ADD KEY `monthlyproductstocktests_ibfk_5` (`SizeID`);

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
  MODIFY `BrandID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `Categories`
--
ALTER TABLE `Categories`
  MODIFY `CategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `Colors`
--
ALTER TABLE `Colors`
  MODIFY `ColorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `DailyTransactions`
--
ALTER TABLE `DailyTransactions`
  MODIFY `TransactionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=587;

--
-- AUTO_INCREMENT for table `LogActivities`
--
ALTER TABLE `LogActivities`
  MODIFY `LogID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;

--
-- AUTO_INCREMENT for table `MonthlyProductStocks`
--
ALTER TABLE `MonthlyProductStocks`
  MODIFY `MonthlyStockID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `MonthlyProductStockTests`
--
ALTER TABLE `MonthlyProductStockTests`
  MODIFY `MonthlyStockTestID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `Products`
--
ALTER TABLE `Products`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `Sizes`
--
ALTER TABLE `Sizes`
  MODIFY `SizeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `Stocks`
--
ALTER TABLE `Stocks`
  MODIFY `StockID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `DailyTransactions`
--
ALTER TABLE `DailyTransactions`
  ADD CONSTRAINT `dailytransactions_ibfk_1` FOREIGN KEY (`StockID`) REFERENCES `stocks` (`StockID`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `LogActivities`
--
ALTER TABLE `LogActivities`
  ADD CONSTRAINT `LogActivity_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `MonthlyProductStocks`
--
ALTER TABLE `MonthlyProductStocks`
  ADD CONSTRAINT `monthlyproductstocks_ibfk_1` FOREIGN KEY (`ProductID`) REFERENCES `Products` (`ProductID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `monthlyproductstocks_ibfk_2` FOREIGN KEY (`StockID`) REFERENCES `Stocks` (`StockID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `monthlyproductstocks_ibfk_3` FOREIGN KEY (`ColorID`) REFERENCES `Colors` (`ColorID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `monthlyproductstocks_ibfk_4` FOREIGN KEY (`BrandID`) REFERENCES `Brands` (`BrandID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `monthlyproductstocks_ibfk_5` FOREIGN KEY (`SizeID`) REFERENCES `Sizes` (`SizeID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `MonthlyProductStockTests`
--
ALTER TABLE `MonthlyProductStockTests`
  ADD CONSTRAINT `monthlyproductstocktests_ibfk_1` FOREIGN KEY (`ProductID`) REFERENCES `Products` (`ProductID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `monthlyproductstocktests_ibfk_2` FOREIGN KEY (`StockID`) REFERENCES `Stocks` (`StockID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `monthlyproductstocktests_ibfk_3` FOREIGN KEY (`ColorID`) REFERENCES `Colors` (`ColorID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `monthlyproductstocktests_ibfk_4` FOREIGN KEY (`BrandID`) REFERENCES `Brands` (`BrandID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `monthlyproductstocktests_ibfk_5` FOREIGN KEY (`SizeID`) REFERENCES `Sizes` (`SizeID`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `sizes_ibfk_2` FOREIGN KEY (`SizeID`) REFERENCES `sizes` (`SizeID`) ON DELETE SET NULL ON UPDATE SET NULL,
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
