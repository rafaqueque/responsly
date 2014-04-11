-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 01, 2013 at 01:57 PM
-- Server version: 5.5.25
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gluwd_database`
--
DROP DATABASE `responsly_database`;
CREATE DATABASE `responsly_database` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `gluwd_database`;

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

DROP TABLE IF EXISTS `tickets`;
CREATE TABLE `tickets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `designation` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `date_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_added` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `email` text COLLATE utf8_unicode_ci NOT NULL,
  `password` text COLLATE utf8_unicode_ci NOT NULL,
  `verified` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `date_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_added` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `verified`, `date_updated`, `date_added`) VALUES
(5, 'Rafael', 'teste@oioi.com', '4028a0e356acc947fcd2bfbf00cef11e128d484a', '0', '2013-02-18 21:59:21', '0000-00-00 00:00:00');
--
-- Database: `responsly_database`
--
DROP DATABASE `responsly_database`;
CREATE DATABASE `responsly_database` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `responsly_database`;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
CREATE TABLE `payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_plan` int(11) NOT NULL,
  `reference` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `paypal_response` longtext NOT NULL,
  `paid` int(11) NOT NULL DEFAULT '0',
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `id_user`, `id_plan`, `reference`, `price`, `paypal_response`, `paid`, `date`) VALUES
(10, 1, 2, 'Regular51ba5c4728e933.61952696', 39.00, '{"TIMESTAMP":"2013-06-13T23:59:29Z","CORRELATIONID":"7e501621edcb6","ACK":"FAILURE","VERSION":"65.0","BUILD":"6444009","L_ERRORCODE0":"10415","L_SHORTMESSAGE0":"Transaction refused because of an invalid argument. See additional error messages for details.","L_LONGMESSAGE0":"A successful transaction has already been completed for this token.","L_SEVERITYCODE0":"Error"}', 0, '2013-06-14 00:59:29'),
(11, 1, 2, 'Regular51ba5ce488a818.58515331', 39.00, '{"TIMESTAMP":"2013-06-14T00:01:52Z","CORRELATIONID":"7f5ccb159d719","ACK":"FAILURE","VERSION":"65.0","BUILD":"6444009","L_ERRORCODE0":"10415","L_SHORTMESSAGE0":"Transaction refused because of an invalid argument. See additional error messages for details.","L_LONGMESSAGE0":"A successful transaction has already been completed for this token.","L_SEVERITYCODE0":"Error"}', 0, '2013-06-14 01:01:52'),
(12, 1, 2, 'Regular51ba5d75b3b107.04999333', 39.00, '{"TOKEN":"EC-56T30687A44372021","SUCCESSPAGEREDIRECTREQUESTED":"false","TIMESTAMP":"2013-06-14T00:02:34Z","CORRELATIONID":"bad2456b4f53e","ACK":"SUCCESS","VERSION":"65.0","BUILD":"6444009","TRANSACTIONID":"9AN843738P7996149","TRANSACTIONTYPE":"expresscheckout","PAYMENTTYPE":"instant","ORDERTIME":"2013-06-14T00:02:34Z","AMT":"39.00","FEEAMT":"1.43","TAXAMT":"0.00","CURRENCYCODE":"USD","PAYMENTSTATUS":"Completed","PENDINGREASON":"None","REASONCODE":"None","PROTECTIONELIGIBILITY":"Ineligible","INSURANCEOPTIONSELECTED":"false","SHIPPINGOPTIONISDEFAULT":"false","PAYMENTINFO_0_TRANSACTIONID":"9AN843738P7996149","PAYMENTINFO_0_TRANSACTIONTYPE":"expresscheckout","PAYMENTINFO_0_PAYMENTTYPE":"instant","PAYMENTINFO_0_ORDERTIME":"2013-06-14T00:02:34Z","PAYMENTINFO_0_AMT":"39.00","PAYMENTINFO_0_FEEAMT":"1.43","PAYMENTINFO_0_TAXAMT":"0.00","PAYMENTINFO_0_CURRENCYCODE":"USD","PAYMENTINFO_0_PAYMENTSTATUS":"Completed","PAYMENTINFO_0_PENDINGREASON":"None","PAYMENTINFO_0_REASONCODE":"None","PAYMENTINFO_0_PROTECTIONELIGIBILITY":"Ineligible","PAYMENTINFO_0_PROTECTIONELIGIBILITYTYPE":"None","PAYMENTINFO_0_ERRORCODE":"0","PAYMENTINFO_0_ACK":"Success"}', 1, '2013-06-14 01:02:34'),
(13, 1, 3, 'Premium51ba5eb98906b7.19474215', 99.00, '{"TOKEN":"EC-437672850U3398037","SUCCESSPAGEREDIRECTREQUESTED":"false","TIMESTAMP":"2013-06-14T00:08:35Z","CORRELATIONID":"80e3f0c6e5c76","ACK":"SUCCESS","VERSION":"65.0","BUILD":"6444009","TRANSACTIONID":"35E82130ML649154M","TRANSACTIONTYPE":"expresscheckout","PAYMENTTYPE":"instant","ORDERTIME":"2013-06-14T00:08:35Z","AMT":"99.00","FEEAMT":"3.17","TAXAMT":"0.00","CURRENCYCODE":"USD","PAYMENTSTATUS":"Completed","PENDINGREASON":"None","REASONCODE":"None","PROTECTIONELIGIBILITY":"Ineligible","INSURANCEOPTIONSELECTED":"false","SHIPPINGOPTIONISDEFAULT":"false","PAYMENTINFO_0_TRANSACTIONID":"35E82130ML649154M","PAYMENTINFO_0_TRANSACTIONTYPE":"expresscheckout","PAYMENTINFO_0_PAYMENTTYPE":"instant","PAYMENTINFO_0_ORDERTIME":"2013-06-14T00:08:35Z","PAYMENTINFO_0_AMT":"99.00","PAYMENTINFO_0_FEEAMT":"3.17","PAYMENTINFO_0_TAXAMT":"0.00","PAYMENTINFO_0_CURRENCYCODE":"USD","PAYMENTINFO_0_PAYMENTSTATUS":"Completed","PAYMENTINFO_0_PENDINGREASON":"None","PAYMENTINFO_0_REASONCODE":"None","PAYMENTINFO_0_PROTECTIONELIGIBILITY":"Ineligible","PAYMENTINFO_0_PROTECTIONELIGIBILITYTYPE":"None","PAYMENTINFO_0_ERRORCODE":"0","PAYMENTINFO_0_ACK":"Success"}', 1, '2013-06-14 01:08:36'),
(14, 1, 2, 'Regular520ce8dc7fab73.71545141', 39.00, '', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `payments_config`
--

DROP TABLE IF EXISTS `payments_config`;
CREATE TABLE `payments_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paypal_username` text NOT NULL,
  `paypal_password` text NOT NULL,
  `paypal_signature` text NOT NULL,
  `paypal_test_mode` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;


-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

DROP TABLE IF EXISTS `plans`;
CREATE TABLE `plans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `designation` text NOT NULL,
  `n_websites` int(11) NOT NULL DEFAULT '1',
  `check_cycle` int(11) NOT NULL DEFAULT '15',
  `has_sms_notifications` int(11) NOT NULL DEFAULT '0',
  `sms_limit` int(11) NOT NULL,
  `has_email_notifications` int(11) NOT NULL DEFAULT '0',
  `price` decimal(10,2) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`id`, `designation`, `n_websites`, `check_cycle`, `has_sms_notifications`, `sms_limit`, `has_email_notifications`, `price`, `date`) VALUES
(1, 'Free', 1, 30, 0, 0, 1, 0.00, '0000-00-00 00:00:00'),
(2, 'Regular', 6, 10, 1, 100, 1, 39.00, '0000-00-00 00:00:00'),
(3, 'Premium', 30, 5, 1, 300, 1, 99.00, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `servers`
--

DROP TABLE IF EXISTS `servers`;
CREATE TABLE `servers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_server_check_type` int(11) NOT NULL DEFAULT '1',
  `id_server_check_status` int(11) NOT NULL DEFAULT '1',
  `name` text NOT NULL,
  `host` text NOT NULL,
  `last_checked` datetime NOT NULL,
  `date_added` datetime NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `servers`
--

INSERT INTO `servers` (`id`, `id_user`, `id_server_check_type`, `id_server_check_status`, `name`, `host`, `last_checked`, `date_added`, `date`) VALUES
(1, 1, 1, 2, 'Personal website', 'rafael.pt', '2013-09-04 00:48:45', '2013-04-01 02:32:40', '2013-01-10 00:00:00'),
(2, 1, 2, 2, 'Can I leave?', 'canileave.com', '2013-08-15 15:41:55', '2013-04-01 02:32:40', '2013-01-10 00:00:00'),
(6, 1, 1, 3, 'Google DNS #1', '8.8.4.4', '2013-06-14 01:29:54', '2013-04-01 02:32:40', '0000-00-00 00:00:00'),
(8, 1, 1, 2, 'Webtuga server', 'rafaqueque.com', '2013-08-15 15:42:09', '2013-04-01 02:32:40', '0000-00-00 00:00:00'),
(9, 3, 1, 2, 'Test server', 'test.pt', '2013-06-14 01:29:56', '2013-04-01 02:32:40', '0000-00-00 00:00:00'),
(10, 1, 1, 2, 'Blog', 'blog.rafael.pt', '2013-09-04 00:49:17', '2013-05-01 04:19:18', '0000-00-00 00:00:00'),
(11, 1, 1, 1, 'Facebook', 'facebook.com', '0000-00-00 00:00:00', '2013-09-04 00:33:19', '0000-00-00 00:00:00'),
(12, 1, 1, 1, 'Twitter', 'twitter.com', '0000-00-00 00:00:00', '2013-09-04 00:33:32', '0000-00-00 00:00:00'),
(13, 1, 1, 1, 'Google', 'google.pt', '0000-00-00 00:00:00', '2013-09-04 00:33:50', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `servers_check_log`
--

DROP TABLE IF EXISTS `servers_check_log`;
CREATE TABLE `servers_check_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_server` int(11) NOT NULL,
  `id_server_check_type` int(11) NOT NULL,
  `host` text NOT NULL,
  `response_time` float NOT NULL COMMENT 'miliseconds',
  `sent_notification_email` int(11) NOT NULL DEFAULT '0',
  `sent_notification_sms` int(11) NOT NULL DEFAULT '0',
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=284 ;

--
-- Dumping data for table `servers_check_log`
--

INSERT INTO `servers_check_log` (`id`, `id_server`, `id_server_check_type`, `host`, `response_time`, `sent_notification_email`, `sent_notification_sms`, `date`) VALUES
(10, 1, 1, 'rafael.pt', 29, 0, 0, '2013-05-01 03:00:02'),
(11, 2, 2, 'canileave.com', 131, 0, 0, '2013-05-01 03:00:02'),
(12, 6, 1, '8.8.4.4', -1, 0, 0, '2013-05-01 03:00:02'),
(13, 8, 1, 'rafaqueque.com', 50, 0, 0, '2013-05-01 03:00:02'),
(14, 9, 1, 'test.pt', 187, 0, 0, '2013-05-01 03:00:02'),
(15, 6, 1, '8.8.4.4', -1, 0, 0, '2013-05-01 03:00:02'),
(16, 1, 1, 'rafael.pt', 26, 0, 0, '2013-05-01 03:00:02'),
(17, 1, 1, 'rafael.pt', 26, 0, 0, '2013-05-01 03:00:02'),
(18, 1, 1, 'rafael.pt', 20, 0, 0, '2013-05-01 04:05:36'),
(19, 1, 1, 'rafael.pt', 24, 0, 0, '2013-05-01 04:05:40'),
(20, 1, 1, 'rafael.pt', 21, 0, 0, '2013-05-01 04:06:23'),
(21, 1, 1, 'rafael.pt', 24, 0, 0, '2013-05-01 04:06:34'),
(22, 2, 2, 'canileave.com', 23, 0, 0, '2013-05-01 04:12:28'),
(23, 2, 2, 'canileave.com', 20, 0, 0, '2013-05-01 04:12:29'),
(24, 2, 2, 'canileave.com', 24, 0, 0, '2013-05-01 04:12:30'),
(25, 2, 2, 'canileave.com', 22, 0, 0, '2013-05-01 04:12:30'),
(26, 1, 1, 'rafael.pt', 21, 0, 0, '2013-05-01 04:12:34'),
(27, 8, 1, 'rafaqueque.com', 22, 0, 0, '2013-05-01 04:12:41'),
(28, 8, 1, 'rafaqueque.com', 20, 0, 0, '2013-05-01 04:12:42'),
(29, 8, 1, 'rafaqueque.com', 18, 0, 0, '2013-05-01 04:12:42'),
(30, 8, 1, 'rafaqueque.com', 20, 0, 0, '2013-05-01 04:12:43'),
(31, 8, 1, 'rafaqueque.com', 20, 0, 0, '2013-05-01 04:12:43'),
(32, 8, 1, 'rafaqueque.com', 26, 0, 0, '2013-05-01 04:12:44'),
(33, 1, 1, 'rafael.pt', 33, 0, 0, '2013-05-01 04:16:04'),
(34, 10, 1, 'blog.rafael.pt', 201, 0, 0, '2013-05-01 04:19:29'),
(35, 1, 1, 'rafael.pt', 50, 0, 0, '2013-05-02 02:23:04'),
(36, 1, 1, 'rafael.pt', 21, 0, 0, '2013-05-02 02:23:06'),
(37, 1, 1, 'rafael.pt', 23, 0, 0, '2013-05-02 02:23:09'),
(38, 1, 1, 'rafael.pt', 96, 0, 0, '2013-05-04 03:17:54'),
(39, 1, 1, 'rafael.pt', 17, 0, 0, '2013-05-04 03:17:55'),
(40, 1, 1, 'rafael.pt', 20, 0, 0, '2013-05-04 03:17:57'),
(41, 1, 1, 'rafael.pt', 20, 0, 0, '2013-05-04 03:18:04'),
(42, 1, 1, 'rafael.pt', 21, 0, 0, '2013-05-04 03:18:06'),
(43, 1, 1, 'rafael.pt', 19, 0, 0, '2013-05-04 03:18:08'),
(44, 6, 1, '8.8.4.4', -1, 0, 0, '2013-05-04 03:19:07'),
(45, 2, 2, 'canileave.com', 103, 0, 0, '2013-05-04 03:19:18'),
(46, 2, 2, 'canileave.com', 21, 0, 0, '2013-05-04 03:19:18'),
(47, 2, 2, 'canileave.com', 21, 0, 0, '2013-05-04 03:19:19'),
(48, 2, 2, 'canileave.com', 26, 0, 0, '2013-05-04 03:19:19'),
(49, 2, 2, 'canileave.com', 22, 0, 0, '2013-05-04 03:19:20'),
(50, 2, 2, 'canileave.com', 18, 0, 0, '2013-05-04 03:19:21'),
(51, 2, 2, 'canileave.com', 18, 0, 0, '2013-05-04 03:19:22'),
(52, 2, 2, 'canileave.com', 24, 0, 0, '2013-05-04 03:19:23'),
(53, 1, 1, 'rafael.pt', 398, 0, 0, '2013-05-29 00:07:56'),
(54, 1, 1, 'rafael.pt', 20, 0, 0, '2013-05-29 00:13:09'),
(55, 2, 2, 'canileave.com', 430, 0, 0, '2013-05-29 00:13:10'),
(56, 6, 1, '8.8.4.4', -1, 0, 0, '2013-05-29 00:13:20'),
(57, 8, 1, 'rafaqueque.com', 104, 0, 0, '2013-05-29 00:13:20'),
(58, 9, 1, 'test.pt', 151, 0, 0, '2013-05-29 00:13:20'),
(59, 10, 1, 'blog.rafael.pt', 493, 0, 0, '2013-05-29 00:13:20'),
(60, 1, 1, 'rafael.pt', 23, 0, 0, '2013-05-29 00:13:32'),
(61, 2, 2, 'canileave.com', 18, 0, 0, '2013-05-29 00:13:32'),
(62, 6, 1, '8.8.4.4', -1, 0, 0, '2013-05-29 00:13:42'),
(63, 8, 1, 'rafaqueque.com', 20, 0, 0, '2013-05-29 00:13:42'),
(64, 9, 1, 'test.pt', 48, 0, 0, '2013-05-29 00:13:42'),
(65, 10, 1, 'blog.rafael.pt', 126, 0, 0, '2013-05-29 00:13:42'),
(66, 8, 1, 'rafaqueque.com', 25, 0, 0, '2013-05-29 00:13:56'),
(67, 8, 1, 'rafaqueque.com', 20, 0, 0, '2013-05-29 00:13:59'),
(68, 8, 1, 'rafaqueque.com', 23, 0, 0, '2013-05-29 00:14:02'),
(69, 8, 1, 'rafaqueque.com', 22, 0, 0, '2013-05-29 00:14:04'),
(70, 1, 1, 'rafael.pt', 21, 0, 0, '2013-05-29 00:15:24'),
(71, 2, 2, 'canileave.com', 19, 0, 0, '2013-05-29 00:15:24'),
(72, 6, 1, '8.8.4.4', -1, 0, 0, '2013-05-29 00:15:34'),
(73, 8, 1, 'rafaqueque.com', 23, 0, 0, '2013-05-29 00:15:34'),
(74, 9, 1, 'test.pt', 49, 0, 0, '2013-05-29 00:15:34'),
(75, 10, 1, 'blog.rafael.pt', 146, 0, 0, '2013-05-29 00:15:34'),
(76, 1, 1, 'rafael.pt', 20, 0, 0, '2013-05-29 00:21:27'),
(77, 2, 2, 'canileave.com', 18, 0, 0, '2013-05-29 00:21:27'),
(78, 6, 1, '8.8.4.4', -1, 0, 0, '2013-05-29 00:21:37'),
(79, 8, 1, 'rafaqueque.com', 23, 0, 0, '2013-05-29 00:21:37'),
(80, 9, 1, 'test.pt', 435, 0, 0, '2013-05-29 00:21:38'),
(81, 10, 1, 'blog.rafael.pt', 154, 0, 0, '2013-05-29 00:21:38'),
(82, 1, 1, 'rafael.pt', 20, 0, 0, '2013-05-28 23:22:20'),
(83, 1, 1, 'rafael.pt', 21, 0, 0, '2013-05-28 23:22:22'),
(84, 1, 1, 'rafael.pt', 21, 0, 0, '2013-05-28 23:22:24'),
(85, 1, 1, 'rafael.pt', 23, 0, 0, '2013-05-28 23:22:27'),
(86, 1, 1, 'rafael.pt', 22, 0, 0, '2013-05-28 23:22:29'),
(87, 1, 1, 'rafael.pt', 18, 0, 0, '2013-05-29 00:23:23'),
(88, 2, 2, 'canileave.com', 20, 0, 0, '2013-05-29 00:23:23'),
(89, 6, 1, '8.8.4.4', -1, 0, 0, '2013-05-29 00:23:33'),
(90, 8, 1, 'rafaqueque.com', 21, 0, 0, '2013-05-29 00:23:33'),
(91, 9, 1, 'test.pt', 51, 0, 0, '2013-05-29 00:23:33'),
(92, 10, 1, 'blog.rafael.pt', 142, 0, 0, '2013-05-29 00:23:33'),
(93, 1, 1, 'rafael.pt', 22, 0, 0, '2013-05-29 00:23:36'),
(94, 2, 2, 'canileave.com', 20, 0, 0, '2013-05-29 00:23:36'),
(95, 6, 1, '8.8.4.4', -1, 0, 0, '2013-05-29 00:23:46'),
(96, 8, 1, 'rafaqueque.com', 21, 0, 0, '2013-05-29 00:23:46'),
(97, 9, 1, 'test.pt', 49, 0, 0, '2013-05-29 00:23:46'),
(98, 10, 1, 'blog.rafael.pt', 125, 0, 0, '2013-05-29 00:23:46'),
(99, 1, 1, 'rafael.pt', 22, 0, 0, '2013-05-29 00:25:14'),
(100, 2, 2, 'canileave.com', 20, 0, 0, '2013-05-29 00:25:14'),
(101, 6, 1, '8.8.4.4', -1, 0, 0, '2013-05-29 00:25:24'),
(102, 8, 1, 'rafaqueque.com', 19, 0, 0, '2013-05-29 00:25:24'),
(103, 9, 1, 'test.pt', 48, 0, 0, '2013-05-29 00:25:24'),
(104, 10, 1, 'blog.rafael.pt', 159, 0, 0, '2013-05-29 00:25:25'),
(105, 1, 1, 'rafael.pt', 20, 0, 0, '2013-05-28 23:26:34'),
(106, 2, 2, 'canileave.com', 23, 0, 0, '2013-05-28 23:26:34'),
(107, 6, 1, '8.8.4.4', -1, 0, 0, '2013-05-28 23:26:44'),
(108, 8, 1, 'rafaqueque.com', 21, 0, 0, '2013-05-28 23:26:44'),
(109, 9, 1, 'test.pt', 50, 0, 0, '2013-05-28 23:26:44'),
(110, 10, 1, 'blog.rafael.pt', 142, 0, 0, '2013-05-28 23:26:44'),
(111, 1, 1, 'rafael.pt', 22, 0, 0, '2013-05-28 23:26:47'),
(112, 2, 2, 'canileave.com', 18, 0, 0, '2013-05-28 23:26:47'),
(113, 6, 1, '8.8.4.4', -1, 0, 0, '2013-05-28 23:26:57'),
(114, 8, 1, 'rafaqueque.com', 21, 0, 0, '2013-05-28 23:26:57'),
(115, 9, 1, 'test.pt', 51, 0, 0, '2013-05-28 23:26:57'),
(116, 10, 1, 'blog.rafael.pt', 128, 0, 0, '2013-05-28 23:26:57'),
(117, 1, 1, 'rafael.pt', 18, 0, 0, '2013-05-28 23:26:59'),
(118, 2, 2, 'canileave.com', 19, 0, 0, '2013-05-28 23:26:59'),
(119, 6, 1, '8.8.4.4', -1, 0, 0, '2013-05-28 23:27:09'),
(120, 8, 1, 'rafaqueque.com', 17, 0, 0, '2013-05-28 23:27:09'),
(121, 9, 1, 'test.pt', 51, 0, 0, '2013-05-28 23:27:09'),
(122, 10, 1, 'blog.rafael.pt', 485, 0, 0, '2013-05-28 23:27:10'),
(123, 1, 1, 'rafael.pt', 95, 0, 0, '2013-06-06 19:10:20'),
(124, 2, 2, 'canileave.com', 105, 0, 0, '2013-06-06 19:10:20'),
(125, 6, 1, '8.8.4.4', -1, 0, 0, '2013-06-06 19:10:30'),
(126, 8, 1, 'rafaqueque.com', 102, 0, 0, '2013-06-06 19:10:31'),
(127, 9, 1, 'test.pt', 233, 0, 0, '2013-06-06 19:10:31'),
(128, 10, 1, 'blog.rafael.pt', 518, 0, 0, '2013-06-06 19:10:31'),
(129, 1, 1, 'rafael.pt', 21, 0, 0, '2013-06-06 19:10:34'),
(130, 2, 2, 'canileave.com', 18, 0, 0, '2013-06-06 19:10:34'),
(131, 6, 1, '8.8.4.4', -1, 0, 0, '2013-06-06 19:10:44'),
(132, 8, 1, 'rafaqueque.com', 22, 0, 0, '2013-06-06 19:10:44'),
(133, 9, 1, 'test.pt', 50, 0, 0, '2013-06-06 19:10:44'),
(134, 10, 1, 'blog.rafael.pt', 133, 0, 0, '2013-06-06 19:10:44'),
(135, 1, 1, 'rafael.pt', 23, 0, 0, '2013-06-06 19:10:48'),
(136, 2, 2, 'canileave.com', 19, 0, 0, '2013-06-06 19:10:48'),
(137, 6, 1, '8.8.4.4', -1, 0, 0, '2013-06-06 19:10:58'),
(138, 8, 1, 'rafaqueque.com', 19, 0, 0, '2013-06-06 19:10:58'),
(139, 9, 1, 'test.pt', 51, 0, 0, '2013-06-06 19:10:58'),
(140, 10, 1, 'blog.rafael.pt', 482, 0, 0, '2013-06-06 19:10:59'),
(141, 1, 1, 'rafael.pt', 20, 0, 0, '2013-06-06 19:11:03'),
(142, 2, 2, 'canileave.com', 20, 0, 0, '2013-06-06 19:11:03'),
(143, 6, 1, '8.8.4.4', -1, 0, 0, '2013-06-06 19:11:13'),
(144, 8, 1, 'rafaqueque.com', 23, 0, 0, '2013-06-06 19:11:13'),
(145, 9, 1, 'test.pt', 50, 0, 0, '2013-06-06 19:11:13'),
(146, 10, 1, 'blog.rafael.pt', 132, 0, 0, '2013-06-06 19:11:13'),
(147, 1, 1, 'rafael.pt', 22, 0, 0, '2013-06-06 19:11:25'),
(148, 2, 2, 'canileave.com', 21, 0, 0, '2013-06-06 19:11:25'),
(149, 6, 1, '8.8.4.4', -1, 0, 0, '2013-06-06 19:11:35'),
(150, 8, 1, 'rafaqueque.com', 20, 0, 0, '2013-06-06 19:11:35'),
(151, 9, 1, 'test.pt', 50, 0, 0, '2013-06-06 19:11:35'),
(152, 10, 1, 'blog.rafael.pt', 489, 0, 0, '2013-06-06 19:11:35'),
(153, 1, 1, 'rafael.pt', 20, 0, 0, '2013-06-06 19:11:42'),
(154, 2, 2, 'canileave.com', 20, 0, 0, '2013-06-06 19:11:42'),
(155, 6, 1, '8.8.4.4', -1, 0, 0, '2013-06-06 19:11:52'),
(156, 8, 1, 'rafaqueque.com', 21, 0, 0, '2013-06-06 19:11:52'),
(157, 9, 1, 'test.pt', 49, 0, 0, '2013-06-06 19:11:52'),
(158, 10, 1, 'blog.rafael.pt', 133, 0, 0, '2013-06-06 19:11:52'),
(159, 1, 1, 'rafael.pt', 21, 0, 0, '2013-06-06 19:12:17'),
(160, 2, 2, 'canileave.com', 21, 0, 0, '2013-06-06 19:12:17'),
(161, 6, 1, '8.8.4.4', -1, 0, 0, '2013-06-06 19:12:27'),
(162, 8, 1, 'rafaqueque.com', 21, 0, 0, '2013-06-06 19:12:27'),
(163, 9, 1, 'test.pt', 48, 0, 0, '2013-06-06 19:12:27'),
(164, 10, 1, 'blog.rafael.pt', 488, 0, 0, '2013-06-06 19:12:27'),
(165, 1, 1, 'rafael.pt', 46, 0, 0, '2013-06-11 01:38:52'),
(166, 2, 2, 'canileave.com', 182, 0, 0, '2013-06-11 01:38:52'),
(167, 6, 1, '8.8.4.4', -1, 0, 0, '2013-06-11 01:39:02'),
(168, 8, 1, 'rafaqueque.com', 105, 0, 0, '2013-06-11 01:39:02'),
(169, 9, 1, 'test.pt', 178, 0, 0, '2013-06-11 01:39:02'),
(170, 10, 1, 'blog.rafael.pt', 1534, 0, 0, '2013-06-11 01:39:04'),
(171, 1, 1, 'rafael.pt', 20, 0, 0, '2013-06-11 01:39:06'),
(172, 2, 2, 'canileave.com', 20, 0, 0, '2013-06-11 01:39:06'),
(173, 6, 1, '8.8.4.4', -1, 0, 0, '2013-06-11 01:39:16'),
(174, 8, 1, 'rafaqueque.com', 22, 0, 0, '2013-06-11 01:39:16'),
(175, 9, 1, 'test.pt', 48, 0, 0, '2013-06-11 01:39:16'),
(176, 10, 1, 'blog.rafael.pt', 133, 0, 0, '2013-06-11 01:39:16'),
(177, 1, 1, 'rafael.pt', 78, 0, 0, '2013-06-12 22:24:39'),
(178, 1, 1, 'rafael.pt', 22, 0, 0, '2013-06-12 22:24:42'),
(179, 1, 1, 'rafael.pt', 23, 0, 0, '2013-06-12 22:24:43'),
(180, 1, 1, 'rafael.pt', 20, 0, 0, '2013-06-12 22:24:44'),
(181, 1, 1, 'rafael.pt', 22, 0, 0, '2013-06-12 22:24:46'),
(182, 1, 1, 'rafael.pt', 103, 0, 0, '2013-06-13 23:14:17'),
(183, 1, 1, 'rafael.pt', 22, 0, 0, '2013-06-13 23:14:19'),
(184, 1, 1, 'rafael.pt', 20, 0, 0, '2013-06-13 23:14:19'),
(185, 1, 1, 'rafael.pt', 23, 0, 0, '2013-06-13 23:14:20'),
(186, 1, 1, 'rafael.pt', 24, 0, 0, '2013-06-13 23:14:21'),
(187, 1, 1, 'rafael.pt', 20, 0, 0, '2013-06-13 23:14:22'),
(188, 1, 1, 'rafael.pt', 19, 0, 0, '2013-06-13 23:14:23'),
(189, 1, 1, 'rafael.pt', 21, 0, 0, '2013-06-13 23:14:24'),
(190, 1, 1, 'rafael.pt', 23, 0, 0, '2013-06-13 23:14:25'),
(191, 1, 1, 'rafael.pt', 27, 0, 0, '2013-06-13 23:14:25'),
(192, 1, 1, 'rafael.pt', 23, 0, 0, '2013-06-13 23:14:26'),
(193, 1, 1, 'rafael.pt', 22, 0, 0, '2013-06-13 23:14:27'),
(194, 1, 1, 'rafael.pt', 22, 0, 0, '2013-06-13 23:14:28'),
(195, 1, 1, 'rafael.pt', 23, 0, 0, '2013-06-13 23:14:29'),
(196, 1, 1, 'rafael.pt', 21, 0, 0, '2013-06-13 23:30:38'),
(197, 2, 2, 'canileave.com', 127, 0, 0, '2013-06-13 23:30:38'),
(198, 6, 1, '8.8.4.4', -1, 0, 0, '2013-06-13 23:30:48'),
(199, 1, 1, 'rafael.pt', 23, 0, 0, '2013-06-13 23:31:44'),
(200, 2, 2, 'canileave.com', 18, 0, 0, '2013-06-13 23:31:44'),
(201, 6, 1, '8.8.4.4', -1, 0, 0, '2013-06-13 23:31:54'),
(202, 1, 1, 'rafael.pt', 21, 0, 0, '2013-06-13 23:32:28'),
(203, 2, 2, 'canileave.com', 19, 0, 0, '2013-06-13 23:32:28'),
(204, 6, 1, '8.8.4.4', -1, 0, 0, '2013-06-13 23:32:38'),
(205, 8, 1, 'rafaqueque.com', 175, 0, 0, '2013-06-13 23:32:38'),
(206, 9, 1, 'test.pt', 194, 0, 0, '2013-06-13 23:32:38'),
(207, 10, 1, 'blog.rafael.pt', 517, 0, 0, '2013-06-13 23:32:39'),
(208, 1, 1, 'rafael.pt', 23, 0, 0, '2013-06-13 23:33:19'),
(209, 2, 2, 'canileave.com', 20, 0, 0, '2013-06-13 23:33:19'),
(210, 6, 1, '8.8.4.4', -1, 0, 0, '2013-06-13 23:33:29'),
(211, 8, 1, 'rafaqueque.com', 24, 0, 0, '2013-06-13 23:33:29'),
(212, 9, 1, 'test.pt', 48, 0, 0, '2013-06-13 23:33:29'),
(213, 10, 1, 'blog.rafael.pt', 482, 0, 0, '2013-06-13 23:33:30'),
(214, 1, 1, 'rafael.pt', 21, 0, 0, '2013-06-13 23:36:37'),
(215, 2, 2, 'canileave.com', 20, 0, 0, '2013-06-13 23:36:37'),
(216, 6, 1, '8.8.4.4', -1, 1, 0, '2013-06-13 23:36:47'),
(217, 8, 1, 'rafaqueque.com', 1126, 0, 0, '2013-06-13 23:36:48'),
(218, 9, 1, 'test.pt', 58, 0, 0, '2013-06-13 23:36:48'),
(219, 10, 1, 'blog.rafael.pt', 149, 0, 0, '2013-06-13 23:36:49'),
(220, 11, 1, 'test', -1, 0, 0, '2013-06-14 01:22:47'),
(221, 11, 1, 'test', -1, 0, 0, '2013-06-14 01:22:50'),
(222, 1, 1, 'rafael.pt', 24, 0, 0, '2013-06-14 01:29:01'),
(223, 2, 2, 'canileave.com', 23, 0, 0, '2013-06-14 01:29:01'),
(224, 6, 1, '8.8.4.4', -1, 1, 0, '2013-06-14 01:29:11'),
(225, 8, 1, 'rafaqueque.com', 29, 0, 0, '2013-06-14 01:29:12'),
(226, 9, 1, 'test.pt', 473, 0, 0, '2013-06-14 01:29:13'),
(227, 10, 1, 'blog.rafael.pt', 171, 0, 0, '2013-06-14 01:29:13'),
(228, 1, 1, 'rafael.pt', 20, 0, 0, '2013-06-14 01:29:14'),
(229, 2, 2, 'canileave.com', 20, 0, 0, '2013-06-14 01:29:14'),
(230, 6, 1, '8.8.4.4', -1, 1, 0, '2013-06-14 01:29:24'),
(231, 8, 1, 'rafaqueque.com', 18, 0, 0, '2013-06-14 01:29:25'),
(232, 9, 1, 'test.pt', 49, 0, 0, '2013-06-14 01:29:25'),
(233, 10, 1, 'blog.rafael.pt', 127, 0, 0, '2013-06-14 01:29:25'),
(234, 1, 1, 'rafael.pt', 20, 0, 0, '2013-06-14 01:29:44'),
(235, 2, 2, 'canileave.com', 20, 0, 0, '2013-06-14 01:29:44'),
(236, 6, 1, '8.8.4.4', -1, 1, 0, '2013-06-14 01:29:54'),
(237, 8, 1, 'rafaqueque.com', 1122, 0, 0, '2013-06-14 01:29:55'),
(238, 9, 1, 'test.pt', 47, 0, 0, '2013-06-14 01:29:56'),
(239, 10, 1, 'blog.rafael.pt', 475, 0, 0, '2013-06-14 01:29:56'),
(240, 1, 1, 'rafael.pt', 65, 0, 0, '2013-08-15 15:40:17'),
(241, 1, 1, 'rafael.pt', 20, 0, 0, '2013-08-15 15:40:19'),
(242, 1, 1, 'rafael.pt', 21, 0, 0, '2013-08-15 15:40:20'),
(243, 1, 1, 'rafael.pt', 22, 0, 0, '2013-08-15 15:40:20'),
(244, 1, 1, 'rafael.pt', 19, 0, 0, '2013-08-15 15:40:21'),
(245, 1, 1, 'rafael.pt', 21, 0, 0, '2013-08-15 15:40:22'),
(246, 2, 2, 'canileave.com', 98, 0, 0, '2013-08-15 15:41:51'),
(247, 2, 2, 'canileave.com', 22, 0, 0, '2013-08-15 15:41:51'),
(248, 2, 2, 'canileave.com', 25, 0, 0, '2013-08-15 15:41:52'),
(249, 2, 2, 'canileave.com', 19, 0, 0, '2013-08-15 15:41:52'),
(250, 2, 2, 'canileave.com', 18, 0, 0, '2013-08-15 15:41:52'),
(251, 2, 2, 'canileave.com', 20, 0, 0, '2013-08-15 15:41:53'),
(252, 2, 2, 'canileave.com', 56, 0, 0, '2013-08-15 15:41:53'),
(253, 2, 2, 'canileave.com', 20, 0, 0, '2013-08-15 15:41:54'),
(254, 2, 2, 'canileave.com', 20, 0, 0, '2013-08-15 15:41:54'),
(255, 2, 2, 'canileave.com', 60, 0, 0, '2013-08-15 15:41:54'),
(256, 2, 2, 'canileave.com', 20, 0, 0, '2013-08-15 15:41:55'),
(257, 8, 1, 'rafaqueque.com', 177, 0, 0, '2013-08-15 15:42:02'),
(258, 8, 1, 'rafaqueque.com', 27, 0, 0, '2013-08-15 15:42:02'),
(259, 8, 1, 'rafaqueque.com', 23, 0, 0, '2013-08-15 15:42:03'),
(260, 8, 1, 'rafaqueque.com', 21, 0, 0, '2013-08-15 15:42:03'),
(261, 8, 1, 'rafaqueque.com', 22, 0, 0, '2013-08-15 15:42:03'),
(262, 8, 1, 'rafaqueque.com', 23, 0, 0, '2013-08-15 15:42:04'),
(263, 8, 1, 'rafaqueque.com', 18, 0, 0, '2013-08-15 15:42:04'),
(264, 8, 1, 'rafaqueque.com', 20, 0, 0, '2013-08-15 15:42:05'),
(265, 8, 1, 'rafaqueque.com', 22, 0, 0, '2013-08-15 15:42:05'),
(266, 8, 1, 'rafaqueque.com', 25, 0, 0, '2013-08-15 15:42:05'),
(267, 8, 1, 'rafaqueque.com', 19, 0, 0, '2013-08-15 15:42:06'),
(268, 8, 1, 'rafaqueque.com', 20, 0, 0, '2013-08-15 15:42:06'),
(269, 8, 1, 'rafaqueque.com', 23, 0, 0, '2013-08-15 15:42:06'),
(270, 8, 1, 'rafaqueque.com', 20, 0, 0, '2013-08-15 15:42:07'),
(271, 8, 1, 'rafaqueque.com', 24, 0, 0, '2013-08-15 15:42:09'),
(272, 10, 1, 'blog.rafael.pt', 158, 0, 0, '2013-08-15 15:42:16'),
(273, 10, 1, 'blog.rafael.pt', 547, 0, 0, '2013-08-15 15:42:16'),
(274, 10, 1, 'blog.rafael.pt', 125, 0, 0, '2013-08-15 15:42:16'),
(275, 10, 1, 'blog.rafael.pt', 419, 0, 0, '2013-08-15 15:42:17'),
(276, 10, 1, 'blog.rafael.pt', 122, 0, 0, '2013-08-15 15:42:17'),
(277, 10, 1, 'blog.rafael.pt', 121, 0, 0, '2013-08-15 15:42:18'),
(278, 10, 1, 'blog.rafael.pt', 125, 0, 0, '2013-08-15 15:42:18'),
(279, 10, 1, 'blog.rafael.pt', 122, 0, 0, '2013-08-15 15:42:18'),
(280, 10, 1, 'blog.rafael.pt', 131, 0, 0, '2013-08-15 15:42:19'),
(281, 10, 1, 'blog.rafael.pt', 124, 0, 0, '2013-08-15 15:42:20'),
(282, 1, 1, 'rafael.pt', 387, 0, 0, '2013-09-04 00:48:45'),
(283, 10, 1, 'blog.rafael.pt', 538, 0, 0, '2013-09-04 00:49:17');

-- --------------------------------------------------------

--
-- Table structure for table `servers_check_status`
--

DROP TABLE IF EXISTS `servers_check_status`;
CREATE TABLE `servers_check_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `css_label` text NOT NULL,
  `css_row` text NOT NULL,
  `chart_bg_color` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `servers_check_status`
--

INSERT INTO `servers_check_status` (`id`, `name`, `css_label`, `css_row`, `chart_bg_color`) VALUES
(1, 'Stand-by', '', '', ''),
(2, 'Ok', 'label-success', 'success', '#69A36A'),
(3, 'Error', 'label-important', 'error', '#b94a48');

-- --------------------------------------------------------

--
-- Table structure for table `servers_check_type`
--

DROP TABLE IF EXISTS `servers_check_type`;
CREATE TABLE `servers_check_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `servers_check_type`
--

INSERT INTO `servers_check_type` (`id`, `name`) VALUES
(1, 'HTTP/HTTPS (200 OK)'),
(2, 'Ping');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_plan` int(11) NOT NULL,
  `plan_valid_until` date NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `notification_email` text NOT NULL,
  `notification_cellphone_n` text NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `id_plan`, `plan_valid_until`, `name`, `email`, `password`, `notification_email`, `notification_cellphone_n`, `date`) VALUES
(1, 3, '2015-06-14', 'rafaqueque', 'rafaqueque@email.com', 'a27684f362c145e6c3d4497ac240b1a4066d68dc', 'c.rafael.s.albuquerque@gmail.com', '+351912302504', '0000-00-00 00:00:00'),
(3, 1, '2013-06-14', 'joaquim', 'jo@teste.pt', 'a27684f362c145e6c3d4497ac240b1a4066d68dc', '', '', '0000-00-00 00:00:00'),
(4, 1, '2013-06-14', 'Rafael Albuquerque Responsly', 'info@responsly.com', 'a27684f362c145e6c3d4497ac240b1a4066d68dc', '', '', '0000-00-00 00:00:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
