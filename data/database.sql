-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 20, 2020 at 12:20 PM
-- Server version: 5.7.31-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `manage_author`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `password`) VALUES
(1, 'admin', 'admin@admin.com', '123');

-- --------------------------------------------------------

--
-- Table structure for table `author_details`
--

CREATE TABLE `author_details` (
  `author_id` int(11) NOT NULL,
  `first_author` varchar(255) DEFAULT NULL,
  `co_author` varchar(255) DEFAULT NULL,
  `national_type` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `journal_name` varchar(255) DEFAULT NULL,
  `date_published` date DEFAULT NULL,
  `year_published` year(4) DEFAULT NULL,
  `issn` varchar(255) DEFAULT NULL,
  `volume` varchar(255) DEFAULT NULL,
  `page` varchar(255) DEFAULT NULL,
  `impact` varchar(255) DEFAULT NULL,
  `citation` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `author_details`
--

INSERT INTO `author_details` (`author_id`, `first_author`, `co_author`, `national_type`, `title`, `journal_name`, `date_published`, `year_published`, `issn`, `volume`, `page`, `impact`, `citation`, `description`, `attachment`, `status`) VALUES
(1, 'Goindh Singh', 'Taghore', 'Indian', 'Data Center Analaysis', 'Shiva kumar', '2020-10-14', 0000, '9999', '2', '78', 'fast data ', 'home', 'COmpleted the project and published', NULL, 'active'),
(4, 'Amit Garg ', 'Suresh', 'Foregin', 'Junior Level Books Introduction to Compute', 'Book Of compute', '2020-10-09', 2020, '978-93-5019-561-1', '2', '555', 'cricitcal', '23', 'Completd the Research\r\n', 'mca_books16.pdf', 'active'),
(5, 'Officia laborum reic', 'Explicabo Libero od', 'Inventore labore exc', 'Commodo necessitatib', 'Steel David', '2018-01-19', 2018, 'Qui architecto dolor', 'Nam sint nihil qui a', 'Voluptatem et et sit', 'Assumenda quos dicta', 'Eu est ea pariatur ', 'Voluptatem eos nos', 'mca_books16.pdf', 'inactive'),
(6, 'test', 'test 1', 'test 2', 'test 3', 'test4', '2015-09-24', 2015, 'test 5', 'test 6', 'test 7', 'test 8', 'test 9', 'Testing Comments', 'presentation', 'inactive');

-- --------------------------------------------------------

--
-- Table structure for table `deleteduser`
--

CREATE TABLE `deleteduser` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `deltime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `deleteduser`
--

INSERT INTO `deleteduser` (`id`, `email`, `deltime`) VALUES
(21, 'suji@gmail.com', '2020-10-19 16:44:22'),
(22, 'test@gmail.com', '2020-10-19 16:44:26'),
(23, 'vogiw@mailinator.com', '2020-10-19 18:06:46'),
(24, 'vogiw@mailinator.com', '2020-10-19 18:06:50');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `sender` varchar(50) NOT NULL,
  `reciver` varchar(50) NOT NULL,
  `title` varchar(100) NOT NULL,
  `feedbackdata` varchar(500) NOT NULL,
  `attachment` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `sender`, `reciver`, `title`, `feedbackdata`, `attachment`) VALUES
(1, 'vivek@gmail.com', 'Admin', 'semma', 'test', ' '),
(2, 'Admin', 'vivek@gmail.com', '', 'welcome', ''),
(3, 'vivek@gmail.com', 'Admin', 'semma', 'test', ' '),
(4, 'vivek@gmail.com', 'Admin', 'hello', 'need request', ' '),
(5, 'Admin', 'vivek@gmail.com', '', 'ok da request filled', ''),
(6, 'admin', 'Admin', 'hello', 'need request', ' '),
(7, 'vivek@gmail.com', 'Admin', 'bug facing in add publication', 'plz revert', 'adobe-scan-28-sep-2020.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `notiuser` varchar(50) NOT NULL,
  `notireciver` varchar(50) NOT NULL,
  `notitype` varchar(50) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `notiuser`, `notireciver`, `notitype`, `time`) VALUES
(18, 'vivek@gmail.com', 'Admin', 'Create Account', '2020-10-19 16:13:33'),
(19, 'vivek@gmail.com', 'Admin', 'Send Feedback', '2020-10-19 16:17:27'),
(20, 'vivek@gmail.com', 'Admin', 'Send Feedback', '2020-10-19 16:20:39'),
(21, 'suji@gmail.com', 'Admin', 'Create Account', '2020-10-19 16:22:27'),
(22, 'suji@gmail.com', 'Admin', 'Create Account', '2020-10-19 16:28:17'),
(23, 'test@gmail.com', 'Admin', 'Create Account', '2020-10-19 16:32:23'),
(24, 'test@gmail.com', 'Admin', 'Send Feedback', '2020-10-19 16:33:47'),
(25, 'vivek@gmail.com', 'Admin', 'Send Feedback', '2020-10-19 16:48:55'),
(26, 'Admin', 'vivek@gmail.com', 'Send Message', '2020-10-19 16:49:12'),
(27, 'vivek@gmail.com', 'Admin', 'Send Feedback', '2020-10-19 16:49:16'),
(28, 'suji@gmail.com', 'Admin', 'Create Account', '2020-10-19 17:12:32'),
(29, 'suji@gmail.com', 'Admin', 'Create Account', '2020-10-19 17:14:54'),
(30, 'wipicumypa@mailinator.com', 'Admin', 'Create Account', '2020-10-19 17:20:28'),
(31, 'wipicumypa@mailinator.com', 'Admin', 'Create Account', '2020-10-19 17:21:18'),
(32, 'gusyq@mailinator.com', 'Admin', 'Create Account', '2020-10-19 17:21:30'),
(33, 'gusyq@mailinator.com', 'Admin', 'Create Account', '2020-10-19 17:23:18'),
(34, 'gusyq@mailinator.com', 'Admin', 'Create Account', '2020-10-19 17:23:22'),
(35, 'gikotuxaze@mailinator.com', 'Admin', 'Create Account', '2020-10-19 17:24:31'),
(36, 'gikotuxaze@mailinator.com', 'Admin', 'Create Account', '2020-10-19 17:24:54'),
(37, 'gikotuxaze@mailinator.com', 'Admin', 'Create Account', '2020-10-19 17:24:57'),
(38, 'gikotuxaze@mailinator.com', 'Admin', 'Create Account', '2020-10-19 17:25:16'),
(39, 'vogiw@mailinator.com', 'Admin', 'Create Account', '2020-10-19 17:27:00'),
(40, 'vogiw@mailinator.com', 'Admin', 'Create Account', '2020-10-19 17:27:12'),
(41, 'vivek@gmail.com', 'Admin', 'Send Feedback', '2020-10-19 17:29:14'),
(42, 'Admin', 'vivek@gmail.com', 'Send Message', '2020-10-19 17:29:42'),
(43, 'admin', 'Admin', 'Send Feedback', '2020-10-19 17:29:49'),
(44, 'vivek@gmail.com', 'Admin', 'Send Feedback', '2020-10-19 19:38:11'),
(45, 'vivek@gmail.com', 'Admin', 'Send Feedback', '2020-10-19 20:06:18'),
(46, 'admin', 'Admin', 'Send Feedback', '2020-10-20 04:24:17'),
(47, 'vivek@gmail.com', 'Admin', 'Send Feedback', '2020-10-20 05:17:49'),
(48, 'vivek@gmail.com', 'Admin', 'Send Feedback', '2020-10-20 05:39:41'),
(49, 'vivek@gmail.com', 'Admin', 'Send Feedback', '2020-10-20 06:47:54');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `designation` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  `status` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `gender`, `mobile`, `designation`, `image`, `status`) VALUES
(20, 'vivek', 'vivek@gmail.com', '123', 'Male', '8807869210', 'Developer', 'avatar.png', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `author_details`
--
ALTER TABLE `author_details`
  ADD PRIMARY KEY (`author_id`);

--
-- Indexes for table `deleteduser`
--
ALTER TABLE `deleteduser`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
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
-- AUTO_INCREMENT for table `author_details`
--
ALTER TABLE `author_details`
  MODIFY `author_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `deleteduser`
--
ALTER TABLE `deleteduser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
