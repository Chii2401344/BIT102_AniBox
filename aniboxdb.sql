-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 20, 2025 at 03:43 PM
-- Server version: 8.0.41
-- PHP Version: 8.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aniboxdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `anime`
--

CREATE TABLE `anime` (
  `Ani_ID` int NOT NULL,
  `Title` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `Status` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `Episodes` int NOT NULL,
  `Release_Date` date NOT NULL,
  `Studio` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `Genre` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `Popularity` int NOT NULL,
  `Description` varchar(500) COLLATE utf8mb4_general_ci NOT NULL,
  `AvgRating` int NOT NULL,
  `Cover_Img` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `Banner_Img` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `anime`
--

INSERT INTO `anime` (`Ani_ID`, `Title`, `Status`, `Episodes`, `Release_Date`, `Studio`, `Genre`, `Popularity`, `Description`, `AvgRating`, `Cover_Img`, `Banner_Img`) VALUES
(1, 'Bocchi The Rock', 'Completed', 12, '2022-10-08', 'CloverWorks', 'Comedy', 184669, 'Hitori \"Bocchi\" Gotoh, a socially anxious girl who loves guitar, joins a band to make friends and overcome her shyness, leading to hilarious and heartfelt moments.', 9, 'assets/img/cover-bocchi-the-rock.jpg', 'assets/img/banner-bocchi-the-rock.png'),
(2, 'One Piece', 'Airing', 1123, '1999-10-20', 'Toei Animation', 'Action', 583912, 'A young pirate, Luffy, sets sail with his crew to find the legendary One Piece treasure and become the Pirate King, facing powerful enemies and uncovering world-shaking secrets..', 9, 'assets/img/cover-one-piece.jpg', 'assets/img/banner-one-piece.jpg'),
(3, 'Your Name', 'Completed', 1, '2016-08-26', 'CoMix Wave Films', 'Romance', 574037, 'Two strangers, Taki and Mitsuha, mysteriously swap bodies across time, forming a deep connection and racing to change fate before disaster strikes.', 9, 'assets/img/cover-kimi-no-na-wa.jpg', 'assets/img/banner-kimi-no-na-wa.png'),
(4, 'K-On!', 'Completed', 13, '2009-04-03', 'Kyoto Animation', 'Comedy', 235639, 'Yui Hirasawa enrolls in high school, but she is without a band and is unable to read music. This will soon change when she discovers the Light Music Club.', 8, 'assets/img/cover-k-on.jpg', 'assets/img/cover-k-on.jpg'),
(5, 'Girls Band Cry', 'Completed', 13, '2024-04-06', 'Toei Animation', 'Comedy', 44717, 'A group of young women from different backgrounds form a band, using music as a way to express their struggles, dreams, and emotions.', 8, 'assets/img/cover-girls-band-cry.jpg', 'assets/img/cover-girls-band-cry.jpg'),
(6, 'Laid-Back Camp', 'Completed', 12, '2018-01-04', 'C-Station', 'Comedy', 144843, 'A group of friends go on relaxing camping trips, enjoying nature, good food, and each other\'s company.', 8, 'assets/img/cover-laid-back-camp.jpg', 'assets/img/cover-laid-back-camp.jpg'),
(7, 'Fullmetal Alchemist: Brotherhood', 'Completed', 64, '2009-04-05', 'Bones', 'Action', 598938, 'Two brothers search for a Philosopher\'s Stone after an attempt to revive their deceased mother goes awry.', 9, 'assets/img/cover-fullmetal-alchemist.jpg', 'assets/img/cover-fullmetal-alchemist.jpg'),
(8, 'Hunter x Hunter (2011)', 'Completed', 148, '2011-10-02', 'Madhouse', 'Action', 694821, 'A young boy embarks on a journey to become a Hunter and find his long-lost father. He encounters powerful allies and complex challenges along the way.', 9, 'assets/img/cover-hunterxhunter.jpg', 'assets/img/cover-hunterxhunter.jpg'),
(9, 'Naruto', 'Completed', 220, '2002-10-03', 'Pierrot', 'Action', 597163, 'Naruto Uzumaki, a young ninja who seeks recognition from his peers and dreams of becoming the leader of his village. DATTEBAYO!', 8, 'assets/img/cover-naruto.jpg', 'assets/img/cover-naruto.jpg'),
(10, 'A Silent Voice', 'Completed', 1, '2016-09-17', 'Kyoto Animation', 'Romance', 574463, 'After bullying Shoko, a girl with hearing impairment, Shoya is consumed with guilt. Soon, several things go downhill and he sets out to make amends.', 9, 'assets/img/cover-a-silent-voice.jpg', 'assets/img/cover-a-silent-voice.jpg'),
(11, 'Weathering With You', 'Completed', 1, '2019-07-19', 'CoMix Wave Films', 'Romance', 292001, 'A high school student facing financial struggles meets a young girl who has the ability to control the weather.', 8, 'assets/img/cover-weathering-with-you.jpg', 'assets/img/cover-weathering-with-you.jpg'),
(12, 'Suzume', 'Completed', 1, '2022-11-11', 'CoMix Wave Films', 'Romance', 146461, 'As the skies turn red and the planet trembles, a determined teenager named Suzume sets out on a mission to save her country.', 8, 'assets/img/cover-suzume.jpg', 'assets/img/cover-suzume.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `favourite`
--

CREATE TABLE `favourite` (
  `Fav_ID` int NOT NULL,
  `User_ID` int NOT NULL,
  `Ani_ID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `favourite`
--

INSERT INTO `favourite` (`Fav_ID`, `User_ID`, `Ani_ID`) VALUES
(1, 1, 1),
(2, 1, 4),
(3, 1, 6),
(4, 2, 1),
(5, 2, 2),
(6, 2, 4),
(7, 3, 2),
(8, 3, 8),
(9, 3, 9),
(10, 4, 3),
(11, 4, 9),
(12, 4, 11);

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `Rev_ID` int NOT NULL,
  `User_ID` int NOT NULL,
  `Ani_ID` int NOT NULL,
  `Rating` int NOT NULL,
  `Content` varchar(500) COLLATE utf8mb4_general_ci NOT NULL,
  `Rev_Date` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`Rev_ID`, `User_ID`, `Ani_ID`, `Rating`, `Content`, `Rev_Date`) VALUES
(1, 3, 2, 10, 'bro one piece or one PEAK', '2024-05-21 10:42:11'),
(2, 1, 1, 8, 'I don\'t watch anime but my friend told me to give this anime a good review', '2024-08-27 00:00:00'),
(3, 1, 2, 8, 'I don\'t watch anime but my friend told me to give this anime a good review', '2024-08-27 00:00:00'),
(4, 1, 3, 7, 'I don\'t watch anime but my friend told me to give this anime a good review', '2024-08-27 00:00:00'),
(5, 3, 1, 6, 'I thought it was going to be about a rock', '2024-11-14 10:50:46'),
(6, 2, 2, 10, 'someone commented one peak.. so true', '2024-12-21 10:50:46'),
(7, 2, 3, 8, 'tbh i can\'t even remember their names lol', '2025-01-04 11:02:13'),
(8, 2, 1, 10, 'so funny i peed myself', '2025-02-02 11:02:13'),
(9, 3, 3, 8, 'OMG so sad...', '2025-03-10 11:02:13');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `User_ID` int NOT NULL,
  `Username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `Email` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `Password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `About` varchar(500) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Profile_Img` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '../assets/img/default.jpg',
  `Banner_Img` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '../assets/img/default_banner.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`User_ID`, `Username`, `Email`, `Password`, `About`, `Profile_Img`, `Banner_Img`) VALUES
(1, 'B2300486', 'B2300486@helplive.edu.my', '$2y$10$AnIYBI/AlwgxZpueJD2fe.z646w2VstE13NHQeG.HcDoMyLNAqOT2', 'Bello~~~ I\'m Joy nyeahhehehehheheheh', '../assets/img/icon-puppy.jpg', '../assets/img/default_banner.jpg'),
(2, 'B2401344', 'B2401344@helplive.edu.my', '$2y$10$CEaYhtFMjNqlaLX4UVxKNOpR.mNp/4AD2tuXd2oUh1WNTAy5eEF8W', 'Hello!! Im Chii!! :3', '../assets/img/icon-espurr.jpg', '../assets/img/default_banner.jpg'),
(3, 'B2401026', 'B2401026@helplive.edu.my', '$2y$10$rOCFoct6xQ64cSA9Q/p8NumceoDH7IUkAWJUQqSRb8CqRcWp0x3E6', 'Howdy! Im Haqal', '../assets/img/pfp3.jpg', '../assets/img/default_banner.jpg'),
(4, 'B2401411', 'B2401411@helplive.edu.my', '$2y$10$W1gdJ7/wugZpXHjI5jNJfe9w19.sFqaMnuMxCFpNgI4Ch9RgZTwbq', 'Annyeong!! Watashi wa Natasha! HAHAHAHHA', '../assets/img/icon-chiikawa.jpg', '../assets/img/default_banner.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `watchlist`
--

CREATE TABLE `watchlist` (
  `WL_ID` int NOT NULL,
  `User_ID` int NOT NULL,
  `Ani_ID` int NOT NULL,
  `Status` varchar(10) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `watchlist`
--

INSERT INTO `watchlist` (`WL_ID`, `User_ID`, `Ani_ID`, `Status`) VALUES
(1, 1, 1, 'Completed'),
(2, 1, 4, 'Completed'),
(3, 1, 6, 'Completed'),
(4, 1, 7, 'Watching'),
(5, 1, 8, 'Planning'),
(6, 2, 1, 'Completed'),
(7, 2, 2, 'Completed'),
(8, 2, 4, 'Completed'),
(9, 2, 5, 'Watching'),
(10, 2, 6, 'Planning'),
(11, 3, 2, 'Completed'),
(12, 3, 8, 'Completed'),
(13, 3, 9, 'Completed'),
(14, 3, 10, 'Watching'),
(15, 3, 11, 'Planning'),
(16, 4, 3, 'Completed'),
(17, 4, 9, 'Completed'),
(18, 4, 11, 'Completed'),
(19, 4, 12, 'Watching'),
(20, 4, 1, 'Planning');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anime`
--
ALTER TABLE `anime`
  ADD PRIMARY KEY (`Ani_ID`);

--
-- Indexes for table `favourite`
--
ALTER TABLE `favourite`
  ADD PRIMARY KEY (`Fav_ID`),
  ADD KEY `User_ID` (`User_ID`),
  ADD KEY `Ani_ID` (`Ani_ID`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`Rev_ID`),
  ADD KEY `User_ID` (`User_ID`),
  ADD KEY `Ani_ID` (`Ani_ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`User_ID`),
  ADD UNIQUE KEY `Username` (`Username`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `watchlist`
--
ALTER TABLE `watchlist`
  ADD PRIMARY KEY (`WL_ID`),
  ADD KEY `User_ID` (`User_ID`),
  ADD KEY `Ani_ID` (`Ani_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anime`
--
ALTER TABLE `anime`
  MODIFY `Ani_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `favourite`
--
ALTER TABLE `favourite`
  MODIFY `Fav_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `Rev_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `User_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `watchlist`
--
ALTER TABLE `watchlist`
  MODIFY `WL_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `favourite`
--
ALTER TABLE `favourite`
  ADD CONSTRAINT `favourite_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `user` (`User_ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `favourite_ibfk_2` FOREIGN KEY (`Ani_ID`) REFERENCES `anime` (`Ani_ID`) ON DELETE CASCADE;

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `user` (`User_ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`Ani_ID`) REFERENCES `anime` (`Ani_ID`) ON DELETE CASCADE;

--
-- Constraints for table `watchlist`
--
ALTER TABLE `watchlist`
  ADD CONSTRAINT `watchlist_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `user` (`User_ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `watchlist_ibfk_2` FOREIGN KEY (`Ani_ID`) REFERENCES `anime` (`Ani_ID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
