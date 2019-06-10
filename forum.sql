-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: May 26, 2019 at 02:35 PM
-- Server version: 5.7.26-0ubuntu0.16.04.1
-- PHP Version: 7.2.18-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `forum`
--

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `p_id` int(11) NOT NULL,
  `t_id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `p_comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`p_id`, `t_id`, `username`, `p_comment`) VALUES
(8, 11, 'tester', 'wagelaaa sehh! share shareeee'),
(9, 11, 'Nani', 'nais'),
(10, 11, 'tester', 'apasehh'),
(11, 11, 'tester', 'terlaluuu'),
(13, 11, 'admin', 'wew'),
(14, 11, 'admin', 'ewe'),
(15, 11, '123', 'bagaimanaa?'),
(16, 11, '123', 'how can ?'),
(17, 11, 'hahasia', 'coba'),
(18, 11, 'mungkinini', 'apayaa tiod?'),
(19, 18, 'admin', 'Wowowo'),
(21, 11, '123', 'wow');

-- --------------------------------------------------------

--
-- Table structure for table `topic`
--

CREATE TABLE `topic` (
  `t_id` int(11) NOT NULL,
  `t_name` varchar(40) NOT NULL,
  `username` varchar(30) NOT NULL,
  `t_desc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `topic`
--

INSERT INTO `topic` (`t_id`, `t_name`, `username`, `t_desc`) VALUES
(11, 'Login berhasil!', 'wardhanadty', 'akhirnya sesion dan login berhasil thx w3.'),
(15, 'adawdad', '123', 'awdwad'),
(16, 'wowowow', '123', 'awdawdaw'),
(17, '123123123', '123', 'adawdwd'),
(18, '123123123123', '123', '23123123'),
(19, 'erbaidawd', '123', 'adwawdokaw'),
(20, 'mungkin ini', 'mungkinini', 'mungkin tidak');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(30) CHARACTER SET latin1 NOT NULL,
  `password` varchar(60) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`) VALUES
('123', '$2y$10$pvHVW8p9Sf7/qbMFUoeL7uwl1akEccngpx.wbr5rktizhWxdRpEku'),
('admin', '$2y$10$p4D1m88nA7N0qUnZ49KJDe/7h.r/qhd9KNvJNeiVfnRL9UKH/.LHK'),
('hahasia', '$2y$10$GDOiAnxtu3DWik8CZ/Z2uOrijbquZChuW6VMCKFR9kzeBDUsWy6i.'),
('he', '$2y$10$Rqd57Bz47DbD8E76Jlwy4.mJQ4rloCYTrS2iULKST6znH6rGEAXuu'),
('jjajs', '$2y$10$Uh/lvYlcpgJTxKPoc5HET.qfy5JFU9dKm7wJKkTBgxOZNIwmQ0UaW'),
('jjjjkkj', '$2y$10$DOUyRnwuOyvC.pz9j5ma2ewfjnWKlxRnLZmRCHnNriKa8WIUrevyq'),
('jjkjkjjk', '$2y$10$QaGfXjeojquy3EElLPyrfuTWDKh4qPtF33KM18.S6KdVstgfOo.D2'),
('mungkinini', '$2y$10$HxMOQF8vb400ruWA8d1Hge4oT4wXR4l/JryipjiadZlQEfBC90rqG'),
('nanda', '$2y$10$OF42gj1aRKZ7UI6GvEfuMOjWwQR3ZynDOWLS1v7t51k91pXyAJT6u'),
('Nani', '$2y$10$Z1UVc1zuMFmehOoLj8DvzuR0jBjPXHo7anrzQaSltgYQ.DdlvtOlG'),
('root', '$2y$10$6/z3lRsPNh0t67Pc81q.juI2/Mi/ZNx2fJbZlEnXBIie3TiQr9iw2'),
('test', '$2y$10$c10115PLBwiHne0I/5rt7.l17XMuo3tZOOgBpqRGC/Ik3sFBx53Wu'),
('tester', '$2y$10$6SCnva0vlpFhd49Q1gYur.Q6FPL8GWPqEXUU/5JUTwspX5gvfZ6Um'),
('wardhanadty', '$2y$10$UqzEny3fD7aTGpWokcJmXOktMk/Gj1lfo4l6F/r8Dsr9oQSu1TUcq'),
('xyz', '$2y$10$ORL3VcNu77bYeI/.v7CzROCr7mmBWeZ06HMY7LJpa7xV0pbBd4pJa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`p_id`),
  ADD KEY `t_id` (`t_id`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `topic`
--
ALTER TABLE `topic`
  ADD PRIMARY KEY (`t_id`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `topic`
--
ALTER TABLE `topic`
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`),
  ADD CONSTRAINT `post_ibfk_2` FOREIGN KEY (`t_id`) REFERENCES `topic` (`t_id`);

--
-- Constraints for table `topic`
--
ALTER TABLE `topic`
  ADD CONSTRAINT `topic_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
