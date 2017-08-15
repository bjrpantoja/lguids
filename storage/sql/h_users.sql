-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 19, 2017 at 12:50 PM
-- Server version: 5.6.35-1+deb.sury.org~xenial+0.1
-- PHP Version: 5.6.30-7+deb.sury.org~xenial+1

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `handa_db2`
--

--
-- Dumping data for table `h_users`
--

INSERT INTO `h_users` (`u_id`, `u_username`, `u_password`, `u_fname`, `u_mname`, `u_lname`, `u_number`, `is_updated`, `is_admin`, `is_active`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'kevs', '$2y$10$yWc8jfPZCanxB/jM8ZuXrOnHRZ.fTlVDnkjGBqXw1CFfk28CSM5/G', 'Kevin', 'Brian', 'Paris', '639069741897', 1, 1, 1, 'bJEkk2ghjAYc4IqR0KmCrUe6BjCHqr6NeQcN5Ht4AzCMFb3zLQX94HjESO01', '2015-12-16 07:15:35', '2016-06-23 05:33:49');
SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
