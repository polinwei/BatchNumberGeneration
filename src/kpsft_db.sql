-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2022-10-18 13:54:14
-- 伺服器版本： 10.4.24-MariaDB
-- PHP 版本： 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `myphp`
--

CREATE DATABASE IF NOT EXISTS `kpsft` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `kpsft`;

-- initialize tables
DROP TABLE IF EXISTS `kmi_qrcode`;
DROP TABLE IF EXISTS `kmi_qrcode_detail`;
-- --------------------------------------------------------

--
-- 資料表結構 `kmi_qrcode`
--

CREATE TABLE `kmi_qrcode` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `qrcode_date` varchar(8) NOT NULL,
  `qrcode_no` varchar(10) NOT NULL,
  `qrcode_filename` varchar(50) NOT NULL,
  `createDate` datetime DEFAULT current_timestamp(),
  `updateDate` datetime DEFAULT NULL,
	CONSTRAINT pk_id PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `kmi_qrcode_detail` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `qrcode_date` varchar(8) NOT NULL,
  `qrcode_no` varchar(10) NOT NULL,
	`client_ip` varchar(100) NOT NULL,
  `createDate` datetime DEFAULT current_timestamp(),
  `updateDate` datetime DEFAULT NULL,
	CONSTRAINT pk_id PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
CREATE OR REPLACE INDEX idx_qrcode_detail on kmi_qrcode_detail(qrcode_date,qrcode_no);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
