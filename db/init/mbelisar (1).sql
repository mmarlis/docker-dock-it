-- phpMyAdmin SQL Dump
-- version 5.1.4-dev+20220331.b9ddf0b305
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 08, 2025 at 05:13 PM
-- Server version: 10.4.34-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mbelisar`
--

-- --------------------------------------------------------

--
-- Table structure for table `phpFinal__LifeCycle`
--

CREATE TABLE `phpFinal__LifeCycle` (
  `CycleID` int(11) UNSIGNED NOT NULL,
  `CycleName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `phpFinal__LifeCycle`
--

INSERT INTO `phpFinal__LifeCycle` (`CycleID`, `CycleName`) VALUES
(1, 'Perennial'),
(2, 'Annual');

-- --------------------------------------------------------

--
-- Table structure for table `phpFinal__Plant`
--

CREATE TABLE `phpFinal__Plant` (
  `PlantID` int(11) UNSIGNED NOT NULL,
  `TypeID` int(11) NOT NULL,
  `SunExposure` varchar(100) NOT NULL,
  `CycleID` int(11) NOT NULL,
  `PlantName` varchar(100) NOT NULL,
  `phLevel` varchar(100) NOT NULL,
  `ImageName` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `phpFinal__Plant`
--

INSERT INTO `phpFinal__Plant` (`PlantID`, `TypeID`, `SunExposure`, `CycleID`, `PlantName`, `phLevel`, `ImageName`) VALUES
(1, 1, 'Full sun, tolerates partial shade', 1, 'Bachelor Buttons', '6.6-7.5', 'bachelors_buttons.jpg'),
(2, 1, 'Full sun', 1, 'Black Eyed Susan', '6.1-7.8', 'blackEyedSusan.jpg'),
(18, 1, 'Full sun ideal, or partial', 1, 'Canterbury Bells', '4.5-7.5', 'caterbury.jpg'),
(19, 1, 'Full sun, partial', 1, 'Forget-Me-Nots', '6.0-7.0', 'forgetmenots.jpg'),
(20, 1, 'Partial shade to full shade', 2, 'Couleus', '6.0-7.0', 'Coleus.jpg'),
(21, 1, 'Full sun', 1, 'Shasta Daisy', '7.2', 'shastadaisy.jpg'),
(22, 1, 'Full sun', 2, 'Four-o-Clocks', '6.1-6.5', 'fouroclocks.jpg'),
(23, 1, 'Full sun', 2, 'Gazania', '7.0', 'gazania.jpg'),
(24, 1, 'Full sun or partial shade', 2, 'Impatients', '6.0-6.5', 'impatients.jpg'),
(25, 1, 'Full sun, partial', 2, 'Viola Tricolor', '5.4-5.8', 'viola-tricolor.jpg'),
(26, 1, 'Full sun', 2, 'Marigold', '6.2-6.5', 'marigold.jpg'),
(27, 1, 'Full sun, partial', 2, 'Pansy', '5.4-5.8', 'pansies.jpg'),
(28, 1, 'Full sun, partial', 2, 'Petunia', '6.0-7.0', 'Petunia.jpg'),
(29, 1, 'Partial shade', 2, 'Schizanthus Orchid', '5.5-7.5', 'schizanthusorchid.jpg'),
(30, 1, 'Full sun', 2, 'Oriental Poppy', '6.5-7.0', 'poppy.JPG'),
(31, 1, 'Full sun', 1, 'Sunflower', '6.0-7.5', 'sunflower.jpg'),
(32, 1, 'Full sun', 2, 'Zinnia', '5.5-7.5', 'zinnias.jpg'),
(33, 2, 'Full sun', 1, 'Banana Pepper', '6.2-7.0', 'bananaPeppers.jpg'),
(34, 2, 'Full sun', 1, 'Cucumber', '6.0-7.0', 'cucumber.jpg'),
(35, 2, 'full sun', 1, 'Green Pepper', '6.0-7.0', 'greenPepper.jpg'),
(36, 2, 'full sun', 1, 'Jalapeno Pepper', '6.0-7.0', 'jalapenoPepper.jpg'),
(37, 2, 'full sun', 1, 'Kale', '5.5-6.8', 'kale.jpg'),
(38, 2, 'full sun, partial', 1, 'Snap Pea', '6.0-6.8', 'snapPea.jpg'),
(39, 2, 'Full sun', 1, 'Squash', '5.8-6.8', 'squash.jpg'),
(40, 2, 'Full sun', 1, 'White Onion', '5.5-6.5', 'white Onion.jpg'),
(41, 2, '1', 1, 'Garlic', '6.0-7.0', NULL),
(42, 3, '1', 1, 'Oregano', '6.5-7.0', NULL),
(43, 3, '1', 1, 'Chives', '6.0-7.0', NULL),
(44, 3, '2', 2, 'Cilantro', '6.2-6.8', NULL),
(45, 3, '3', 1, 'Mint', '6.0-7.0', NULL),
(46, 3, '1', 2, 'Rosemary', '6.0-7.0', NULL),
(47, 3, '1', 1, 'Sage', '6.0-6.7', NULL),
(48, 3, '3', 2, 'Terragon', '6.3-7.5', NULL),
(49, 3, '1', 2, 'Thyme', '6.0-7.0', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `phpFinal__PlantType`
--

CREATE TABLE `phpFinal__PlantType` (
  `TypeID` int(11) UNSIGNED NOT NULL,
  `TypeName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `phpFinal__PlantType`
--

INSERT INTO `phpFinal__PlantType` (`TypeID`, `TypeName`) VALUES
(1, 'Flower'),
(3, 'Herb'),
(2, 'Veggie');

-- --------------------------------------------------------

--
-- Table structure for table `phpFinal__User`
--

CREATE TABLE `phpFinal__User` (
  `UserID` int(10) UNSIGNED NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `phpFinal__User`
--

INSERT INTO `phpFinal__User` (`UserID`, `Email`, `Password`, `Role`) VALUES
(1, '?', '?', '?'),
(2, 'mbelisar@my.wctc.edu', '$2y$10$Qu9UORMCFL6Ovvh0Ybu0mejb.AHf9B34jT8Iw67hcJ6TIzyF8tj3q', 'user'),
(6, 'marianasmarlis@gmail.com', '$2y$10$wxXPJGQp3aJeUvFQC0Ov.OAxrxm0/HkIAphdLEycwGUKkrQR2HYxC', 'admin'),
(7, 'patjacob@gmail.com', '$2y$10$Me9h08WP.ek8k8sGV7VGE.a0eFO3iQPpMpe6soTZRbNoiFXye5JRS', 'user'),
(8, 'john@gmail.com', '$2y$10$86vHSgiY1nvOQm1r0ljNa.buBwJlM27h0HUwTYo4SI4X4M7cUo.Sy', 'user'),
(9, 'mari@gmail.com', '$2y$10$JKchEK/2PQ6qx22o.aYN4O1ckuw8COmlaUieAJZhq1swU.wEJRERW', 'user'),
(10, 'tyler', '$2y$10$SB/3KGDHJ40ibr9CbwsWM.hHIHDD2CTzNcPzIzK06zuijDlszlNgS', 'user'),
(11, 'mbelisar', '$2y$10$haqHKpRJ3oxQ3druk3Lp6eg10NGeD6cptNi6cXfCA1Zg9oe2yS4g2', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `phpFinal__UserNote`
--

CREATE TABLE `phpFinal__UserNote` (
  `noteID` int(11) UNSIGNED NOT NULL,
  `PlantID` int(11) NOT NULL,
  `CareTips` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `phpFinal__UserNote`
--

INSERT INTO `phpFinal__UserNote` (`noteID`, `PlantID`, `CareTips`) VALUES
(3, 1, 'Bachelor’s buttons do best in full sun, six hours per day. However, if you are a hot climate gardener, your bachelor’s buttons will appreciate afternoon shade and bloom longer into the summer. These are cool-season flowers, and they like good drainage but will tolerate relatively poor soil. '),
(21, 1, 'Growing bachelor\'s buttons can be as simple as throwing a handful of seeds onto some freshly turned soil. Given their almost weedy nature, it\'s easy to see how these plants grow in many gardens.'),
(22, 1, 'it\'s a pretty flower'),
(24, 22, 'beautiful flowers'),
(25, 22, 'hello'),
(26, 18, 'More flowers'),
(27, 18, 'hello\''),
(28, 1, 'beautiful flower'),
(29, 18, 'It\'s growing.'),
(30, 1, 'I like purple flowers');

-- --------------------------------------------------------

--
-- Table structure for table `phpFinal__UserPlants`
--

CREATE TABLE `phpFinal__UserPlants` (
  `UserPlantsID` int(11) UNSIGNED NOT NULL,
  `UserID` int(11) NOT NULL,
  `PlantID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `phpFinal__LifeCycle`
--
ALTER TABLE `phpFinal__LifeCycle`
  ADD PRIMARY KEY (`CycleID`);

--
-- Indexes for table `phpFinal__Plant`
--
ALTER TABLE `phpFinal__Plant`
  ADD PRIMARY KEY (`PlantID`),
  ADD KEY `TypeID` (`TypeID`);

--
-- Indexes for table `phpFinal__PlantType`
--
ALTER TABLE `phpFinal__PlantType`
  ADD PRIMARY KEY (`TypeID`),
  ADD KEY `TypeName` (`TypeName`);

--
-- Indexes for table `phpFinal__User`
--
ALTER TABLE `phpFinal__User`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `phpFinal__UserNote`
--
ALTER TABLE `phpFinal__UserNote`
  ADD PRIMARY KEY (`noteID`),
  ADD KEY `PlantID` (`PlantID`);

--
-- Indexes for table `phpFinal__UserPlants`
--
ALTER TABLE `phpFinal__UserPlants`
  ADD PRIMARY KEY (`UserPlantsID`),
  ADD KEY `UserID` (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `phpFinal__LifeCycle`
--
ALTER TABLE `phpFinal__LifeCycle`
  MODIFY `CycleID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `phpFinal__Plant`
--
ALTER TABLE `phpFinal__Plant`
  MODIFY `PlantID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `phpFinal__PlantType`
--
ALTER TABLE `phpFinal__PlantType`
  MODIFY `TypeID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `phpFinal__User`
--
ALTER TABLE `phpFinal__User`
  MODIFY `UserID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `phpFinal__UserNote`
--
ALTER TABLE `phpFinal__UserNote`
  MODIFY `noteID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `phpFinal__UserPlants`
--
ALTER TABLE `phpFinal__UserPlants`
  MODIFY `UserPlantsID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
