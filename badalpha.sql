-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 04, 2017 at 03:05 AM
-- Server version: 5.7.14
-- PHP Version: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `badalpha`
--

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `id` int(11) NOT NULL,
  `user_id` int(255) DEFAULT NULL,
  `league_id` int(255) DEFAULT NULL,
  `score` int(255) DEFAULT NULL,
  `strikes` int(20) DEFAULT NULL,
  `spares` int(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`id`, `user_id`, `league_id`, `score`, `strikes`, `spares`) VALUES
(1, 6, NULL, 145, 2, 4),
(2, 6, NULL, 150, 3, 3),
(3, 6, NULL, 138, 1, 3),
(5, 9, NULL, 200, 8, 2),
(6, 9, NULL, 212, 9, 3),
(7, 9, NULL, 110, 1, 1),
(8, 6, NULL, 136, 2, 5),
(9, 6, NULL, 158, 3, 4),
(10, 6, NULL, 168, 5, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `hashed_password` text,
  `email` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `bio` text,
  `avatar` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `hashed_password`, `email`, `city`, `state`, `bio`, `avatar`) VALUES
(2, 'sdfsdfsdfs', '$2y$10$R/J5yLG9VMCu65jYUow4NOcch27PqAhk1B0t9Z90u/Plbj7lmVJnS', 'asdflkj@gkjd.com', 'lkflksjdflkj', 'ldkfjslkdfsdf', 'sslkjslkdsldkfjsdlfkj', ''),
(6, 'WhisperedLullaby', '$2y$10$MnuvqjOs9KF9nSfC/JpsaO3eaphq/dAhI1GZ1ALV7QQQyPlxuLU6W', 'agnone.anthony@gmail.com', 'Pittsburgh', 'Pennsylvania', 'I love bowling so much because I have a 130 average and that makes me super awesome. Holy shit yes. Fuckin aye.', 'whisperedlullaby_avatar.jpg'),
(4, 'asassaas', '$2y$10$JxUFRcN2waic1Cr1dI8rG.LlHds2c5rtjEvrX2uNMEPDQ.nU1I8VC', 'agnone.anthony@gmail.com', 'Pittsburgh', 'Pennsylvania', 'love love your oval', ''),
(5, 'shouldwork', '$2y$10$3NNlDqugT9KdMLpRndGsyeoAPPNd.amG9j/4NAcdpWm0FTILfalX6', 'should@should.com', 'should', 'should', 'please', 'shouldwork_avatar.jpeg'),
(7, 'WhisperaLullaby', '$2y$10$GDYkTvoXxzJuHDP0Ud/X4uLPNvKK9g/NUePYMrSBWzI1NWe2.ACKO', 'agnone.anthony@gmail.com', 'Pittsburgh', 'Pennsylvania', 'fkldfsfsdkldsfklfsdklsdf', 'whisperalullaby_avatar.jpg'),
(8, 'BowlingDad', '$2y$10$yIZ.T/K4PcFIxfRFje/mjORcr5IPi3GM.a0Z14fT8N5t516IqAP1q', 'agnone.anthony@gmail.com', 'Pittsburgh', 'Pennsylvania', 'sdsd', 'bowlingdad_avatar.jpg'),
(9, 'abarclay06', '$2y$10$uNpp3o2KBA364LVox.3a7u0kJDRCSPTfAmXyp3rkku72ge4AK4gcq', 'abarclay06@gmail.com', 'Somerset', 'Pennsylvania', 'Bowling\'s the best.', 'abarclay06_avatar.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
