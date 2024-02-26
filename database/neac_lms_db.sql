-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 03, 2023 at 06:48 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `neac_lms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_accounts`
--

CREATE TABLE `tbl_accounts` (
  `id` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `accountPicture` varchar(200) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `userType` int(11) NOT NULL,
  `dateCreated` datetime NOT NULL,
  `modifiedBy` varchar(100) DEFAULT NULL,
  `dateModified` datetime DEFAULT NULL,
  `isActive` int(11) NOT NULL,
  `worksite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_accounts`
--

INSERT INTO `tbl_accounts` (`id`, `firstName`, `lastName`, `accountPicture`, `username`, `password`, `email`, `userType`, `dateCreated`, `modifiedBy`, `dateModified`, `isActive`, `worksite`) VALUES
(1, 'Jason', 'Trestiza', 'emp_image/t1TSybSbavSfzWjF4E36t074emBAzVy52VFHwKHZ.png', 'user1', '$2y$10$P.7.sWnItse7HaoNsVIvnuoyME4Hk.e9nzrdTNpB6Ltzl9n8SC.e6', 'jason@neac.com', 1, '2022-11-24 08:24:00', '1', '2023-01-31 08:56:22', 1, 0),
(2, 'Grace', 'Macasieb', NULL, 'dg.macasieb', '$2y$10$pvv8fSusuDrCZhANZ/zqXO6Vy33QdlRyzYf.gHOVAZc/zyf/z08Je', 'dg.macasieb@gmail.com', 3, '2022-11-24 08:44:00', 'Jason Trestiza', '2023-01-11 15:52:00', 1, 0),
(3, 'Diana Ann', 'Angoluan', NULL, 'da.angoluan', '$2y$10$HHPFugYHmsb.VsL5R43AZOuwEbQlXOh9Oby/qKxjaDS3fXPbUNZcW', 'da.angoluan@gmail.com', 2, '2022-11-24 08:51:00', '3', '2023-01-28 10:52:04', 1, 1),
(4, 'Marinette', 'Francisco', NULL, 'm.francisco', 'neactest1', 'm.francisco@gmail.com', 2, '2022-11-24 08:52:00', NULL, NULL, 1, 0),
(5, 'Nena Grace', 'Dela Cruz', NULL, 'ng.delacruz', '$2y$10$vFHauM918qdakGMDVLZxFezreVxqm99R/cmB7opoPIcqsZ8FnzjUK', 'ng.delacruz@gmail.com', 2, '2022-11-24 08:53:00', NULL, NULL, 1, 0),
(6, 'Nannette', 'Rosero', NULL, 'n.rosero', 'neactest1', 'n.rosero@gmail.com', 2, '2022-11-24 08:53:00', NULL, NULL, 1, 0),
(7, 'Rozette', 'Nonato', NULL, 'r.nonato', '$2y$10$y1hC38ULXcXtFBza6lrhr.RusfiTQyMYEeQ.pwL/33X0ctkzLa526', 'r.nonato@gmail.com', 3, '2022-11-24 08:54:00', NULL, NULL, 1, 0),
(8, 'Ma. Concepcion', 'Lanzanas', NULL, 'mc.concepcion', '$2y$10$sg00pnV44H6yS8KPS0LEdOtUl5wUYVktjrkBcQzKkhH9vvOTehRPS', 'mc.concepcion@gmail.com', 3, '2022-11-24 08:54:00', 'Jason Trestiza', '2023-01-11 16:07:20', 1, 0),
(9, 'Rodelisa', 'Balboa', NULL, 'r.balboa', '$2y$10$RyaeknF9FlgQ9hz4yJNoOeh9gVd04U3sPupgIT5PxogMSp7I9WKf2', 'r.balboa@gmail.com', 3, '2022-11-24 09:00:00', 'Jason Trestiza', '2023-01-11 16:09:02', 1, 0),
(10, 'Maricar', 'Magdaleno', NULL, 'm.magdaleno', '$2y$10$n467QEhUgrnVl8cGQonJAu32TM.DANVGuIORZpeI3ez/lVP3ZOy6G', 'm.magdaleno@gmail.com', 2, '2022-11-24 09:03:00', 'Jason Trestiza', '2023-01-03 16:54:13', 1, 0),
(11, 'Christine', 'Balaguer', NULL, 'c.balaguer', 'neactest1', 'c.balaguer@gmail.com', 2, '2022-11-24 09:04:00', NULL, NULL, 1, 0),
(12, 'Rachel', 'Pelesco', NULL, 'r.pelesco', 'neactest1', 'r.pelesco@gmail.com', 2, '2022-11-24 09:04:00', NULL, NULL, 1, 0),
(13, 'Notchie', 'Malmis', NULL, 'n.malmis', 'neactest1', 'n.malmis@gmail.com', 2, '2022-11-24 09:05:00', '30', '2022-12-17 16:13:43', 1, 0),
(14, 'Christine', 'Dela Rama', NULL, 'c.delarama', 'neactest1', 'c.delarama@gmail.com', 2, '2022-11-24 09:07:00', NULL, NULL, 1, 0),
(15, 'Chricia Kate', 'Algabre', NULL, 'ck.algabre', 'neactest1', 'ck.algabre@gmail.com', 2, '2022-11-24 09:07:00', NULL, NULL, 1, 0),
(16, 'Lady Lyn', 'Caraca', NULL, 'lady.caraca', 'neactest1', 'lady.caraca@gmail.com', 2, '2022-11-24 09:08:00', NULL, NULL, 1, 0),
(17, 'Joenel', 'De Leon', NULL, 'j.deleon', 'neactest1', 'j.deleon@gmail.com', 2, '2022-11-24 09:12:00', NULL, NULL, 1, 0),
(18, 'Ritchell', 'Pinohon', NULL, 'r.pinohon', 'neactest1', 'r.pinohon@gmail.com', 2, '2022-11-24 09:12:00', NULL, NULL, 1, 0),
(19, 'Joyce Anne', 'Venus', NULL, 'ja.venus', 'neactest1', 'ja.venus@gmail.com', 2, '2022-11-24 09:13:00', '1', '2023-01-03 16:39:40', 1, 0),
(20, 'Melody', 'Vergara', NULL, 'm.vergara', 'neactest1', 'm.vergara@gmail.com', 2, '2022-11-24 09:13:00', NULL, NULL, 1, 0),
(21, 'Anna Marie', 'Dizon', NULL, 'am.dizon', 'neactest1', 'am.dizon@gmail.com', 2, '2022-11-24 09:15:00', NULL, NULL, 1, 0),
(22, 'Micka Andrea', 'Godoy', NULL, 'ma.godoy', 'neactest1', 'ma.godoy@gmail.com', 2, '2022-11-24 09:15:00', NULL, NULL, 1, 0),
(23, 'Lance Christian', 'Lapuz', NULL, 'lc.lapuz', 'neactest1', 'lc.lapuz@gmail.com', 2, '2022-11-24 09:16:00', NULL, NULL, 1, 1),
(24, 'Rosemary', 'Emata', NULL, 'r.emata', 'neactest1', 'r.emata@gmail.com', 3, '2022-11-24 09:17:00', NULL, NULL, 1, 0),
(25, 'Mary Jane', 'Dizon', NULL, 'mj.dizon', 'neactest1', 'mj.dizon@gmail.com', 3, '2022-11-24 09:17:00', NULL, NULL, 1, 0),
(26, 'Twinkle', 'Wasawas', 'emp_image/ciyJfyryVUXUn6mZoPKc1FX5EEJyQvh4MnR3XdZi.png', 't.wasawas', '$2y$10$gLCDDIQ8rqAsjdeF5KAF4eDpczSS.VWElE3tFNRS84/Inc3xA.h2G', 't.wasawas@neac.com', 2, '2022-11-29 16:22:00', NULL, NULL, 1, 1),
(27, 'Melzen', 'Diokno', NULL, 'm.marketing', '$2y$10$obbXub6cAqMKkWdA23AJ8Of9XRJBdzT3vo319wwtTT9dmcaEvH45C', 'm.marketing@neac.com', 4, '2022-12-08 13:33:00', '1', '2023-01-28 10:53:06', 1, 0),
(28, 'Ellen', 'Amigo', NULL, 'e.amigo', '$2y$10$mY55MKqS/Bn2D6Hoz9N3suerGchEam.p/yyFEiTtYgxnw.V0kwh7m', 'e.amigo@neac.com', 2, '2022-12-12 12:18:00', '28', '2022-12-13 14:59:32', 1, 1),
(29, 'Rachelle', 'Quiped', 'emp_image/JQvwlkCfGvhENgYAcGsPlDh2X2CgSh7ardK3ejTT.jpg', 'r.quiped', '$2y$10$J5mKPbaHWPLJ8c6p263F/.F/d9wuLZsT7a4Qt1qHUZeqBvnz2B5HG', 'r.quiped@neac.com', 2, '2022-12-13 10:21:00', 'Jason Trestiza', '2023-01-09 11:16:56', 1, 1),
(30, 'Liza', 'Daquil', NULL, 'l.daquil', '$2y$10$WJ4zi29Qm5ueZK9TBUtLz..sLbtF.1rSVzLCPmoi/4b/MbVyEWMAe', 'l.daquil@neac.com', 2, '2022-12-13 15:31:00', NULL, NULL, 1, 1),
(31, 'Cielo', 'Jumao-as', NULL, 'c.jumaoas', '$2y$10$4c/mPUGInU.DeZZp4ja5WeQFsug/RczyvIfCOQK3nhEsHc1PwwiW.', 'c.jumaoas@neac.com', 2, '2022-12-20 12:40:00', 'Jason Trestiza', '2023-01-09 12:47:05', 1, 1),
(32, 'Jolan', 'Pineda', NULL, 'j.pineda', '$2y$10$EnQkOYCNacv72ew0n8psd.u5l/IjcuPi7QGGvoj0swYctd7S/593a', 'j.pineda@neac.com', 2, '2022-12-20 12:48:00', 'Jason Trestiza', '2023-01-07 14:08:03', 1, 0),
(33, 'Liezl Diana', 'Balingit', NULL, 'ld.balingit', '$2y$10$3rDPjC5PQ5rSfMpHzPWMh.xvBMhthomgRmIN3GXlzjx7eIFJx/giq', 'ld.balingit@neac.com', 2, '2022-12-20 12:57:00', 'Jason Trestiza', '2023-01-09 12:47:31', 1, 1),
(34, 'Norfel', 'NEAC', NULL, 'neac.norfel', '$2y$10$dR8Fma9SgeIxqdu9Xmnj4eMyjbvM1HrLvxuS5cwdKWplniYRTr1Cy', 'neac.norfel@neac.com', 2, '2022-12-20 13:07:00', NULL, NULL, 1, 0),
(35, 'Anne', 'Abaya', NULL, 'a.abaya', '$2a$04$JsOygpFGnoAig.UwU02aFuFD3wbT3aTSOU0rKDGljy4ubzAjP4IGy', 'a.abaya@neac.com', 0, '2023-01-09 11:08:41', NULL, NULL, 1, 1),
(36, 'Christoper', 'NEAC', NULL, 'neac.christoper', '$2y$10$DJN9ERITcP3d57sQGgyEwucOFcd9Jr2e964CHClPB.553.EcvDULC', 'c.neac@neac.com', 2, '2023-01-09 11:13:10', NULL, NULL, 1, 1),
(37, 'Carlo', 'NEAC', NULL, 'neac.carlo', '$2y$10$FypsvY2LipKU9M4Z6wMp6.eu7fIPqzFCqwa/Ny.acYXbn6ht/nVbO', 'neac_carlo@neac.com', 2, '2023-01-09 11:14:34', NULL, NULL, 1, 1),
(38, 'Ela', 'NEAC', NULL, 'neac.ella', '$2y$10$9CT2f8tn3WFLDi3JYqnz.uJODSKST7QIhfnA/ODYNLMzCfmvD.aXq', 'neac.ella@neac.com', 2, '2023-01-09 11:15:05', NULL, NULL, 1, 1),
(39, 'Yanie', 'NEAC', NULL, 'neac.yanie', '$2y$10$P2AvCpwiV7FF0DEJGmctK.cC./UU7YvaGO66vLQ95vo7wM9tQzWTy', 'neac.yanie@neac.com', 2, '2023-01-09 11:15:32', NULL, NULL, 1, 1),
(40, 'Nowella', 'NEAC', NULL, 'neac.nowella', '$2y$10$Yd8b32TAkSZpalFp6G7n8OU9gVAhE5PNB5povCtQEoQOOOkLa5FpC', 'nowella@neac.com', 2, '2023-01-09 11:16:20', NULL, NULL, 1, 1),
(41, 'Extra', 'LC', NULL, 'extralc@neac.com', '$2y$10$iD4A98fpB3zwD5v.yYGEIO8CLiJUWD7ZQXIOd5SExwIbwk5u8ceRa', 'extralc@neac.com', 2, '2023-01-31 08:52:08', '1', '2023-01-31 08:52:29', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_campaign`
--

CREATE TABLE `tbl_campaign` (
  `campaign_number` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `reach` int(11) DEFAULT NULL,
  `impressions` int(11) DEFAULT NULL,
  `link_clicks` int(11) DEFAULT NULL,
  `post_engagement` int(11) DEFAULT NULL,
  `nmc` int(11) DEFAULT NULL,
  `amount_spent` float DEFAULT NULL,
  `createdBy` int(11) NOT NULL,
  `dateCreated` datetime NOT NULL,
  `modifiedBy` int(11) DEFAULT NULL,
  `dateModified` datetime DEFAULT NULL,
  `isActive` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_campaign`
--

INSERT INTO `tbl_campaign` (`campaign_number`, `month`, `year`, `reach`, `impressions`, `link_clicks`, `post_engagement`, `nmc`, `amount_spent`, `createdBy`, `dateCreated`, `modifiedBy`, `dateModified`, `isActive`) VALUES
(1, 1, 2020, 418945, 1020872, 4052, 33641, 738, 620.17, 29, '2022-12-16 15:20:00', 1, '2023-01-31 09:51:06', 1),
(2, 2, 2020, 421811, 1045378, 3814, 32794, 786, 669.57, 29, '2022-12-16 15:20:00', NULL, NULL, 1),
(3, 3, 2020, 445592, 967810, 3268, 64395, 741, 590.2, 29, '2022-12-16 15:21:00', NULL, NULL, 1),
(4, 4, 2020, 592111, 1170113, 5186, 43845, 2190, 655.85, 29, '2022-12-16 15:21:00', NULL, NULL, 1),
(5, 5, 2020, 397917, 925312, 6874, 14229, 877, 700.65, 29, '2022-12-16 15:22:00', NULL, NULL, 1),
(6, 6, 2020, 232392, 588057, 3024, 4937, 590, 554.2, 29, '2022-12-16 15:22:00', NULL, NULL, 1),
(7, 7, 2020, 298596, 780183, 3258, 12256, 888, 679.39, 29, '2022-12-16 15:22:00', NULL, NULL, 1),
(8, 8, 2020, 240209, 530745, 2316, 5848, 832, 666.89, 29, '2022-12-16 15:26:00', NULL, NULL, 1),
(9, 9, 2020, 343406, 679111, 3491, 36240, 1236, 613.66, 29, '2022-12-16 15:27:00', NULL, NULL, 1),
(10, 10, 2020, 319394, 722659, 2943, 19737, 1067, 668.82, 29, '2022-12-16 15:27:00', NULL, NULL, 1),
(11, 11, 2020, 326063, 679962, 3232, 27981, 1177, 661.32, 29, '2022-12-16 15:28:00', 1, '2023-01-03 16:43:47', 1),
(12, 12, 2020, 266867, 690088, 2482, 28516, 654, 626.24, 29, '2022-12-16 15:28:00', 1, '2023-02-03 12:10:08', 1),
(13, 1, 2021, 520023, 1130916, 7359, 53343, 1428, 890.93, 29, '2022-12-16 15:42:00', 1, '2022-12-21 16:39:14', 1),
(14, 2, 2021, 763700, 1699344, 9813, 17831, 1215, 1000, 29, '2022-12-16 15:40:00', 1, '2022-12-21 16:39:42', 1),
(15, 3, 2021, 622931, 1324390, 10310, 32068, 1463, 972.96, 29, '2022-12-16 15:54:00', 1, '2022-12-21 16:40:19', 1),
(16, 4, 2021, 866956, 2080040, 14473, 22626, 1258, 989.2, 29, '2022-12-16 15:55:00', 1, '2022-12-21 16:41:27', 1),
(17, 5, 2021, 929415, 2170656, 12914, 19638, 1417, 1058.38, 1, '2022-12-21 16:41:00', NULL, NULL, 1),
(18, 6, 2021, 580568, 1303587, 9137, 10447, 1042, 815.23, 1, '2022-12-21 16:42:00', NULL, NULL, 1),
(19, 7, 2021, 802775, 1976238, 11379, 21090, 1482, 1011.29, 1, '2022-12-21 16:42:00', NULL, NULL, 1),
(20, 8, 2021, 759507, 1904531, 10781, 19231, 1380, 926.44, 1, '2022-12-21 16:42:00', NULL, NULL, 1),
(21, 9, 2021, 664453, 1575737, 9037, 16907, 1145, 884.01, 1, '2022-12-21 16:43:00', NULL, NULL, 1),
(22, 10, 2021, 481080, 1274487, 3967, 5676, 1740, 818.49, 1, '2022-12-21 16:43:00', NULL, NULL, 1),
(23, 11, 2021, 474827, 1367222, 4025, 15191, 1661, 928.09, 1, '2022-12-21 16:44:00', NULL, NULL, 1),
(24, 12, 2021, 415885, 1216487, 3367, 13259, 1382, 833.37, 1, '2022-12-21 16:44:00', NULL, NULL, 1),
(25, 1, 2022, 563643, 1794126, 6792, 43980, 1809, 997.88, 1, '2022-12-21 16:45:00', NULL, NULL, 1),
(26, 2, 2022, 541488, 1911684, 6391, 45166, 1919, 1014.14, 1, '2022-12-21 16:45:00', NULL, NULL, 1),
(27, 3, 2022, 539941, 1593559, 4707, 35893, 1634, 1048.6, 1, '2022-12-21 16:46:00', NULL, NULL, 1),
(28, 4, 2022, 539680, 1706588, 4293, 24444, 1303, 854.68, 1, '2022-12-21 16:47:00', NULL, NULL, 1),
(29, 5, 2022, 810552, 2331347, 8014, 58728, 1596, 1116.25, 1, '2022-12-21 16:47:00', NULL, NULL, 1),
(30, 6, 2022, 594538, 1667890, 5502, 43678, 1511, 1025.82, 1, '2022-12-21 16:48:00', NULL, NULL, 1),
(31, 7, 2022, 932382, 2589279, 9390, 55054, 2686, 1414.91, 1, '2022-12-21 16:49:00', NULL, NULL, 1),
(32, 8, 2022, 1374501, 3576549, 16894, 95842, 3996, 1609.95, 1, '2022-12-21 16:49:00', NULL, NULL, 1),
(33, 9, 2022, 1904624, 4497657, 22214, 95450, 5059, 2003.84, 1, '2022-12-21 16:49:00', NULL, NULL, 1),
(34, 10, 2022, 2360915, 5898883, 25830, 50970, 8202, 2664.84, 1, '2022-12-21 16:50:00', NULL, NULL, 1),
(35, 11, 2022, 3623797, 9217781, 31836, 42938, 11043, 3603.72, 1, '2022-12-21 16:50:00', 1, '2023-01-03 16:41:20', 1),
(36, 12, 2022, 0, 0, 0, 0, 0, 0, 1, '2022-12-26 10:09:28', 1, '2022-12-26 13:10:39', 1),
(37, 1, 2023, 0, 0, 0, 0, 0, 0, 1, '2023-01-28 16:23:27', NULL, NULL, 1),
(38, 2, 2023, 0, 0, 0, 0, 0, 0, 1, '2023-01-28 16:24:49', NULL, NULL, 1),
(39, 3, 2023, 0, 0, 0, 0, 0, 0, 1, '2023-01-28 16:25:35', NULL, NULL, 1),
(40, 4, 2023, 0, 0, 0, 0, 0, 0, 1, '2023-01-28 16:25:54', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_fbanalytics`
--

CREATE TABLE `tbl_fbanalytics` (
  `fbanalytics_number` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `page_likes` int(11) DEFAULT NULL,
  `post_reach` int(11) DEFAULT NULL,
  `post_engagement` int(11) DEFAULT NULL,
  `videos` int(11) DEFAULT NULL,
  `createdBy` int(11) NOT NULL,
  `dateCreated` datetime NOT NULL,
  `modifiedBy` int(11) DEFAULT NULL,
  `dateModified` datetime DEFAULT NULL,
  `isActive` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_fbanalytics`
--

INSERT INTO `tbl_fbanalytics` (`fbanalytics_number`, `month`, `year`, `page_likes`, `post_reach`, `post_engagement`, `videos`, `createdBy`, `dateCreated`, `modifiedBy`, `dateModified`, `isActive`) VALUES
(1, 1, 2022, 789, 362386, 30550, 70542, 1, '2023-01-28 17:24:58', NULL, NULL, 1),
(2, 2, 2022, 879, 395228, 25523, 65925, 1, '2023-01-28 17:43:02', NULL, NULL, 1),
(3, 3, 2022, 776, 401701, 24150, 66412, 1, '2023-01-28 22:34:44', 1, '2023-01-31 10:05:34', 1),
(4, 4, 2022, 760, 376138, 24150, 44843, 1, '2023-01-31 10:05:58', 1, '2023-01-31 12:56:34', 1),
(5, 5, 2022, 887, 525287, 43010, 85277, 1, '2023-01-31 10:06:23', 1, '2023-01-31 12:58:04', 1),
(6, 6, 2022, 998, 382151, 33648, 69618, 1, '2023-01-31 10:06:41', 1, '2023-01-31 12:58:28', 1),
(7, 7, 2022, 1013, 523164, 41516, 72838, 1, '2023-01-31 12:55:20', 1, '2023-01-31 12:58:51', 1),
(8, 8, 2022, 1063, 890831, 69904, 98597, 1, '2023-01-31 12:55:28', 1, '2023-01-31 12:59:11', 1),
(9, 9, 2022, 1284, 1805013, 91117, 98170, 1, '2023-01-31 12:55:31', 1, '2023-01-31 12:59:40', 1),
(10, 10, 2022, 1735, 1554669, 79679, 38708, 1, '2023-01-31 12:55:33', 1, '2023-01-31 13:00:29', 1),
(11, 11, 2022, 1679, 2426105, 108400, 29562, 1, '2023-01-31 12:55:35', 1, '2023-01-31 13:01:06', 1),
(12, 12, 2022, 1256, 1431798, 79079, 31003, 1, '2023-01-31 12:55:36', 1, '2023-01-31 13:01:45', 1),
(13, 1, 2023, 0, 0, 0, 0, 1, '2023-01-31 13:54:05', 1, '2023-02-03 12:11:04', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_inquiries`
--

CREATE TABLE `tbl_inquiries` (
  `inquiryID` int(11) NOT NULL,
  `inquiryLeadSource` int(11) NOT NULL,
  `applicantFirstName` varchar(50) DEFAULT NULL,
  `applicantLastName` varchar(50) DEFAULT NULL,
  `applicantName` varchar(100) DEFAULT NULL,
  `fbName` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phoneNumber` varchar(50) DEFAULT NULL,
  `countryReside` varchar(200) DEFAULT NULL,
  `serviceType` varchar(100) NOT NULL,
  `paymentStatus` varchar(100) DEFAULT NULL,
  `datePaid` datetime DEFAULT NULL,
  `scoring` int(11) NOT NULL,
  `assignedLC` int(11) DEFAULT NULL,
  `notes` longtext DEFAULT NULL,
  `representative` int(11) DEFAULT NULL,
  `createdBy` int(11) DEFAULT NULL,
  `dateCreated` datetime NOT NULL,
  `modifiedBy` varchar(100) DEFAULT NULL,
  `dateModified` datetime DEFAULT NULL,
  `isActive` int(11) NOT NULL,
  `sampDate` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_inquiries`
--

INSERT INTO `tbl_inquiries` (`inquiryID`, `inquiryLeadSource`, `applicantFirstName`, `applicantLastName`, `applicantName`, `fbName`, `email`, `phoneNumber`, `countryReside`, `serviceType`, `paymentStatus`, `datePaid`, `scoring`, `assignedLC`, `notes`, `representative`, `createdBy`, `dateCreated`, `modifiedBy`, `dateModified`, `isActive`, `sampDate`) VALUES
(1, 1, 'Pearly Joy', 'Abucejo', 'Pearly Joy Abucejo', NULL, 'trestizajason1@gmail.com', NULL, NULL, '1', '2', '2023-01-09 12:51:33', 3, 10, NULL, 28, 0, '2022-12-15 11:10:00', 'Jason Trestiza', '2023-01-09 12:51:33', 1, '2023-01-09T12:51'),
(2, 1, 'Karly', 'De La Cruz', 'Karly De La Cruz', NULL, 'Pearlyabucejo@gmail.com', NULL, NULL, '1', '2', '2023-01-09 12:52:20', 3, NULL, NULL, 28, 0, '2022-12-15 11:10:00', 'Jason Trestiza', '2023-01-09 12:52:20', 1, '2023-01-09T12:52'),
(3, 1, 'April', 'Arbas', 'April Arbas', NULL, NULL, NULL, NULL, '3', '2', '2023-01-06 13:50:00', 3, NULL, NULL, 28, 0, '2022-12-15 11:10:00', '1', '2023-01-13 15:17:04', 1, '2023-01-06T13:50'),
(4, 1, 'Khai', 'Mantes', 'Khai Mantes', NULL, NULL, NULL, NULL, '1,7', '2,1', '2023-01-09 12:53:28', 3, NULL, NULL, 28, 0, '2022-12-15 11:10:00', 'Jason Trestiza', '2023-01-09 12:53:28', 1, '2023-01-09T12:53,'),
(5, 1, 'Jovelle', 'Lorenzo', 'Jovelle Lorenzo', NULL, NULL, NULL, NULL, '1', '2', '2023-01-09 12:52:45', 3, NULL, NULL, 28, 0, '2022-12-15 11:10:00', 'Jason Trestiza', '2023-01-09 12:52:45', 1, '2023-01-09T12:52'),
(6, 1, 'Tin', 'Capule-Diaz', 'Tin Capule-Diaz', NULL, NULL, NULL, NULL, '1', '2', '2023-01-09 12:54:01', 3, NULL, '3RD PARTY OF Louie Gene Eseo Diaz', 28, 0, '2022-12-15 11:10:00', 'Jason Trestiza', '2023-01-09 12:54:01', 1, '2023-01-09T12:53'),
(7, 1, 'Caresse Carelle Bete', 'Padilla', 'Caresse Carelle Bete Padilla', 'fb.me/ccb.padilla', NULL, NULL, NULL, '3,7', '2,3', '2023-01-09 10:26:19', 3, NULL, NULL, 29, 0, '2022-11-21 11:10:00', 'Jason Trestiza', '2023-01-09 10:26:19', 1, '2023-01-09T10:25,2023-01-09T10:25'),
(8, 1, 'Vis', 'Byers', 'Vis Byers', NULL, 'elvisbyers@gmail.com', NULL, NULL, '9', '2', '2023-01-09 13:13:18', 3, NULL, NULL, 30, 0, '2022-11-21 11:17:00', 'Jason Trestiza', '2023-01-09 13:13:18', 1, '2023-01-09T13:13'),
(9, 1, 'Len', 'Del', 'Len Del', NULL, NULL, NULL, NULL, '1', '2', '2023-01-09 14:02:56', 3, NULL, NULL, 29, 0, '2022-11-21 11:17:00', 'Jason Trestiza', '2023-01-09 14:02:56', 1, '2023-01-09T13:49'),
(10, 1, 'Marlon Edgar', 'Cabico', 'Marlon Edgar Cabico', 'Angela Cabico', NULL, NULL, NULL, '1', '2', '2023-01-09 14:02:28', 3, NULL, NULL, 30, 0, '2022-11-21 11:17:00', 'Jason Trestiza', '2023-01-09 14:02:28', 1, '2023-01-09T14:01'),
(11, 1, 'Van', 'Garcia', 'Van Garcia', NULL, 'garciavanessa8610@yahoo.com', NULL, NULL, '1', '2', '2023-01-09 14:04:18', 3, NULL, NULL, 30, 0, '2022-11-21 11:17:00', 'Jason Trestiza', '2023-01-09 14:04:18', 1, '2023-01-09T14:04'),
(12, 1, 'Cristina', 'Soberano', 'Cristina Soberano', NULL, 'teenasoberano7@gmail.com', NULL, NULL, '1', '1', '2023-01-09 14:29:51', 3, NULL, NULL, 30, 0, '2022-11-21 11:17:00', 'Jason Trestiza', '2023-01-09 14:29:51', 1, ''),
(13, 1, 'PiaLorraine', 'Colangoy-Josal', 'PiaLorraine Colangoy-Josal', NULL, NULL, NULL, NULL, '1,3,6', '4,1,1', '2023-01-09 09:49:34', 3, NULL, NULL, 30, 0, '2022-11-21 11:17:00', 'Jason Trestiza', '2023-01-09 09:49:34', 1, '2023-01-09T09:49,2023-01-09T09:47,'),
(14, 1, 'Cherie', 'Coca', 'Cherie Cocabzxc', NULL, NULL, NULL, NULL, '1,5', '3,2', '2023-01-11 08:40:15', 3, NULL, NULL, 30, 0, '2022-11-21 11:17:00', 'Jason Trestiza', '2023-01-11 08:40:15', 1, '2023-01-11T08:40,2023-01-11T08:40'),
(15, 1, 'Rusha', 'Tumali', 'Rusha Tumalia', NULL, NULL, NULL, NULL, '1', '2', NULL, 3, NULL, NULL, 29, 0, '2022-11-21 11:17:00', '1', '2023-01-13 09:06:55', 1, '2023-01-13T09:06'),
(16, 1, 'Magilieca Cabansag', 'Baua', 'Magilieca Cabansag Baua', NULL, 'magiliecacabansag@gmail.com', NULL, NULL, '1', '2', NULL, 3, NULL, NULL, 30, 0, '2022-11-21 11:17:00', '1', '2023-01-13 09:29:40', 1, '2023-01-13T09:29'),
(17, 1, 'Rochell Ann', 'Lagazon - Granil', 'Rochell Ann Lagazon - Granil', NULL, 'rochellanngranil@gmail.com', NULL, NULL, '2', '2', '2023-01-26 15:58:00', 3, NULL, NULL, 30, 0, '2022-11-21 11:17:00', '1', '2023-01-26 15:58:15', 1, '2023-01-26T15:58'),
(18, 1, 'Sheryl', 'Alfonso- Sergio', 'Sheryl Alfonso- Sergio', NULL, NULL, NULL, NULL, '1', '1', NULL, 1, NULL, NULL, 30, 0, '2022-11-21 11:17:00', '1', '2023-02-03 12:26:54', 1, NULL),
(19, 1, 'Cheska', 'Sarmiento', 'Cheska Sarmiento', NULL, 'cheskasarmiento12@gmail.com', NULL, NULL, '1', '1', NULL, 1, NULL, NULL, 30, 0, '2022-11-21 11:17:00', NULL, NULL, 1, NULL),
(20, 1, 'Erika', 'Arzadon', 'Erika Arzadon', NULL, NULL, NULL, NULL, '1', '1', NULL, 1, NULL, NULL, 30, 0, '2022-11-21 11:17:00', NULL, NULL, 1, NULL),
(21, 1, 'Ella', 'Ramirez', 'Ella Ramirez', NULL, NULL, NULL, NULL, '22', '1', NULL, 1, NULL, NULL, 30, 0, '2022-11-21 11:17:00', NULL, NULL, 1, NULL),
(22, 1, 'Carol', 'Florida', 'Carol Florida', NULL, NULL, NULL, NULL, '1', '1', NULL, 1, NULL, NULL, 30, 0, '2022-11-21 11:17:00', NULL, NULL, 1, NULL),
(23, 1, 'Angel Lopez', 'Lumbania', 'Angel Lopez Lumbania', NULL, NULL, NULL, NULL, '1', '2', '2023-01-07 16:03:05', 3, NULL, NULL, 30, 0, '2022-11-21 11:17:00', 'Jason Trestiza', '2023-01-07 16:03:05', 1, '2023-01-07T16:02'),
(24, 1, 'Cm', 'Jm', 'Cm Jm', NULL, NULL, NULL, NULL, '22', '2', '2023-01-09 12:54:51', 3, NULL, NULL, 26, 0, '2022-11-20 11:17:00', 'Jason Trestiza', '2023-01-09 12:54:51', 1, '2023-01-09T12:54'),
(25, 1, 'Juliet Pascual', 'Ildefonso', 'Juliet Pascual Ildefonso', NULL, NULL, NULL, NULL, '22', '2', '2023-01-09 12:55:10', 3, NULL, NULL, 30, 0, '2022-11-20 11:17:00', 'Jason Trestiza', '2023-01-09 12:55:10', 1, '2023-01-09T12:55'),
(26, 1, 'Jeraldine', 'Ramirez', 'Jeraldine Ramirez', NULL, 'ramirezjeraldine15@yahoo.com', NULL, NULL, '13', '1', NULL, 1, NULL, NULL, 3, 0, '2022-11-19 11:17:00', NULL, NULL, 1, NULL),
(27, 1, 'Abegail Ragos', 'Agabao', 'Abegail Ragos Agabao', NULL, 'charmgail_agabao@yahoo.com', NULL, NULL, '13', '1', NULL, 1, NULL, NULL, 3, 0, '2022-11-20 11:17:00', NULL, NULL, 1, NULL),
(28, 1, 'Hillary Manzano', 'Acedo-Mangondatu', 'Hillary Manzano Acedo-Mangondatu', NULL, NULL, NULL, NULL, '13', '1', NULL, 1, NULL, NULL, 31, 0, '2022-11-21 12:42:00', NULL, NULL, 1, NULL),
(29, 1, 'Vierna Casil', 'Pamaus', 'Vierna Casil Pamaus', NULL, NULL, NULL, NULL, '11', '1', NULL, 1, NULL, NULL, 31, 0, '2022-11-21 12:42:00', NULL, NULL, 1, NULL),
(30, 1, 'Gellie Ann', 'Fullon', 'Gellie Ann Fullon', NULL, NULL, NULL, NULL, '11', '1', NULL, 1, NULL, NULL, 31, 0, '2022-11-21 12:42:00', NULL, NULL, 1, NULL),
(31, 1, 'Irish Lucero', 'Lozada', 'Irish Lucero Lozada', NULL, NULL, NULL, NULL, '11', '1', NULL, 1, NULL, NULL, 31, 0, '2022-11-21 12:42:00', NULL, NULL, 1, NULL),
(32, 1, 'Novamae Directo', 'Biccay', 'Novamae Directo Biccay', NULL, 'biccayn@gmail.com', '09657020377', NULL, '11', '1', NULL, 1, NULL, NULL, 31, 0, '2022-11-22 12:42:00', NULL, NULL, 1, NULL),
(33, 1, NULL, NULL, 'Ireneehla Cabugwang', NULL, 'ireneehlacabugwang@gmail.com', NULL, NULL, '13', '1', '2023-01-13 08:17:52', 1, NULL, NULL, 31, 0, '2022-11-22 12:42:00', '1', '2023-01-13 08:17:52', 1, ''),
(34, 1, 'Jerome San Andres', 'Martinez Jr.', 'Jerome San Andres Martinez Jr.', NULL, NULL, NULL, NULL, '11', '1', NULL, 1, NULL, NULL, 32, 0, '2022-11-22 12:50:00', NULL, NULL, 1, NULL),
(35, 1, 'Ellie', 'Si', 'Ellie Si', NULL, 'biananliezl@yahoo.com', NULL, 'Philippines', '11', '1', NULL, 2, NULL, NULL, 32, 0, '2022-11-08 12:50:00', NULL, NULL, 1, NULL),
(36, 1, 'Zel', 'Beltran', 'Zel Beltran', NULL, 'riziel.beltran87@gmail.com', '09491974275', 'Philippines', '14', '1', NULL, 1, NULL, NULL, 32, 0, '2022-11-08 12:50:00', NULL, NULL, 1, NULL),
(37, 1, 'Meanne', 'Atienza-Arellano', 'Meanne Atienza-Arellano', NULL, 'maryannarellano968@yahoo.com', NULL, 'Philippines', '11', '1', NULL, 1, NULL, NULL, 32, 0, '2022-11-08 12:50:00', NULL, NULL, 1, NULL),
(38, 1, 'Frncsco', 'Krna', 'Frncsco Krna', NULL, NULL, NULL, NULL, '11', '1', NULL, 1, NULL, NULL, 32, 0, '2022-11-08 12:50:00', NULL, NULL, 1, NULL),
(39, 1, 'Ylaissa', 'Burgos', 'Ylaissa Burgos', NULL, 'burgosylaissajoy@gmail.com', NULL, 'Philippines', '14', '1', NULL, 1, NULL, NULL, 32, 0, '2022-11-08 12:50:00', NULL, NULL, 1, NULL),
(40, 1, 'Mary Edgielyn', 'Garcia', 'Mary Edgielyn Garcia', NULL, 'gedgielyn@ymail.com', NULL, 'Philippines', '13', '1', NULL, 1, NULL, NULL, 32, 0, '2022-11-08 12:50:00', NULL, NULL, 1, NULL),
(41, 1, 'Deen', 'de Jesus', 'Deen de Jesus', NULL, NULL, NULL, 'Philippines', '13', '1', NULL, 1, NULL, NULL, 32, 0, '2022-11-08 12:50:00', NULL, NULL, 1, NULL),
(42, 1, 'Joella', 'Kiakan', 'Joella Kiakan', NULL, 'Nurseella11@gmail.com', NULL, 'Philippines', '13', '2', '2023-01-09 12:55:27', 3, NULL, 'megaman', 31, 0, '2022-11-08 12:50:00', 'Jason Trestiza', '2023-01-09 12:55:27', 1, '2023-01-09T12:55'),
(43, 1, 'Suraifa', 'Mokamad-Akmad', 'Suraifa Mokamad-Akmad', NULL, NULL, NULL, 'Philippines', '11', '1', NULL, 1, NULL, NULL, 31, 0, '2022-08-06 12:50:00', NULL, NULL, 1, NULL),
(44, 1, 'Robella', 'Aluad', 'Robella Aluad', 'Rob Ella Perseveres', 'ella06_aluad@yahoo.com', '09914313371', NULL, '11', '2', '2023-01-09 12:55:42', 3, NULL, 'RN', 33, 0, '2022-08-04 12:58:00', 'Jason Trestiza', '2023-01-09 12:55:42', 1, '2023-01-09T12:55'),
(45, 1, 'Kristine', 'Maniego', 'Kristine Maniego', 'XTine Maniego', 'maniegokris@gmail.com', '09282852158', NULL, '13', '1', NULL, 1, NULL, NULL, 33, 0, '2022-08-04 12:58:00', NULL, NULL, 1, NULL),
(46, 1, 'Karen Joy', 'Buenaflor', 'Karen Joy Buenaflor', NULL, 'karenjoybuenaflor@yahoo.com', NULL, NULL, '11', '1', NULL, 1, NULL, NULL, 3, 0, '2022-08-23 12:58:00', NULL, NULL, 1, NULL),
(47, 1, 'Eden', 'Haro', 'Eden Haro', NULL, 'eden4ever@yahoo.com', NULL, NULL, '13', '1', NULL, 1, NULL, NULL, 3, 0, '2022-08-23 12:58:00', NULL, NULL, 1, NULL),
(48, 1, 'Marve', 'Arenas', 'Marve Arenas', NULL, 'marve_gurl@yahoo.com', NULL, NULL, '11', '1', NULL, 1, NULL, NULL, 3, 0, '2022-08-23 12:58:00', NULL, NULL, 1, NULL),
(49, 1, 'Christine', 'Rey', 'Christine Rey', NULL, 'chreyclarts@gmail.com', NULL, NULL, '14', '1', NULL, 1, NULL, NULL, 3, 0, '2022-08-23 12:58:00', NULL, NULL, 1, NULL),
(50, 6, 'Torres', 'Mel', 'Torres Mel', NULL, NULL, NULL, 'Germany', '1', '1', NULL, 1, NULL, NULL, 26, 0, '2022-11-21 12:58:00', NULL, NULL, 1, NULL),
(51, 6, 'Engel', 'Grazie', 'Engel Grazie', NULL, 'agathagashka@gmail.com', NULL, NULL, '1', '1', NULL, 1, NULL, NULL, 30, 0, '2022-11-30 12:58:00', NULL, NULL, 1, NULL),
(52, 6, 'Cathy', 'Alvarez', 'Cathy Alvarez', NULL, 'alvarezhk@yahoo.co.uk', NULL, NULL, '1', '1', NULL, 1, NULL, NULL, 26, 0, '2022-12-13 12:58:00', NULL, NULL, 1, NULL),
(53, 6, 'Jean Rose', 'Vidal', 'Jean Rose Vidal', NULL, 'jeanvidal024@gmail.com', '09278538935', 'Philippines', '14', '1', NULL, 1, NULL, NULL, 2, 0, '2022-07-20 12:58:00', NULL, NULL, 1, NULL),
(54, 6, 'Jayvanny', 'Guevarra', 'Jayvanny Guevarra', 'Jayvanny T. Guevarra', 'jayvannymara@gmail.com', '09489911807', 'Philippines', '15', '1', NULL, 1, NULL, NULL, 2, 0, '2022-07-20 12:58:00', NULL, NULL, 1, NULL),
(55, 6, 'Joyce', 'Bernardo', 'Joyce Bernardo', NULL, NULL, NULL, 'Philippines', '1', '1', NULL, 1, NULL, NULL, 30, 0, '2022-04-20 12:58:00', NULL, NULL, 1, NULL),
(56, 6, 'Pat', 'Pua-Belgar', 'Pat Pua-Belgar', 'Pat Pua-Belgar', NULL, NULL, NULL, '1', '1', NULL, 1, NULL, NULL, 34, 0, '2022-05-10 13:07:00', NULL, NULL, 1, NULL),
(57, 6, 'Charlaine', 'Mesa', 'Charlaine Mesa', NULL, 'charlainep03@yahoo.com', NULL, NULL, '1', '1', NULL, 1, NULL, NULL, 26, 0, '2022-06-23 13:07:00', NULL, NULL, 1, NULL),
(58, 6, 'Khadija Nasser', 'Ammad', 'Khadija Nasser Ammad', NULL, 'khadijaammad00@gmail.com', '09473579690', NULL, '14', '2', '2023-01-09 12:55:55', 3, NULL, 'Referral applicant from AFR Agency', 2, 0, '2022-08-02 13:07:00', 'Jason Trestiza', '2023-01-09 12:55:55', 1, '2023-01-09T12:55'),
(59, 6, 'Bernadette', 'Respicio-Roman', 'Bernadette Respicio-Roman', NULL, 'bernadetterroman@gmail.com', NULL, NULL, '1', '1', NULL, 1, NULL, NULL, 30, 0, '2022-07-20 13:07:00', NULL, NULL, 1, NULL),
(60, 6, 'Venus', 'Caparas', 'Venus Caparas', NULL, NULL, NULL, NULL, '4', '1', NULL, 1, NULL, NULL, 30, 0, '2022-10-05 13:07:00', NULL, NULL, 1, NULL),
(61, 6, 'Thelma', 'Mayuga', 'Thelma Mayuga', NULL, NULL, NULL, NULL, '5', '1', NULL, 1, NULL, NULL, 29, 0, '2022-11-03 13:07:00', NULL, NULL, 1, NULL),
(62, 6, 'Jenn', 'Atong', 'Jenn Atong', NULL, 'ciara_2192@yahoo.com.', '09663918167', NULL, '17', '2', '2022-05-22 10:52:00', 3, NULL, 'under ADEL agency Referral', 33, 0, '2022-05-01 13:07:00', 'Jason Trestiza', '2022-12-22 10:53:01', 1, NULL),
(63, 6, 'Kathrine Grace Dimaano', 'Arago-Genil', 'Kathrine Grace Dimaano Arago-Genil', 'Kath Rine', 'kgdarago@yahoo.com', NULL, 'Philippines', '13', '1', NULL, 1, NULL, NULL, 31, 0, '2022-06-02 13:07:00', NULL, NULL, 1, NULL),
(64, 6, 'Wilson Asinas', 'Puyaoan', 'Wilson Asinas Puyaoan', NULL, 'wap013092@gmail.com', NULL, 'Philippines', '13', '1', NULL, 1, NULL, NULL, 31, 0, '2022-06-02 13:07:00', NULL, NULL, 1, NULL),
(65, 6, 'Mukhtar Jamad', 'Arakama', 'Mukhtar Jamad Arakama', NULL, 'muktar25arakama@gmail.com', '0562707342', NULL, '11', '2', '2022-07-07 10:55:00', 3, NULL, 'Radtech referred by Wife- nuraina santos Ladjamoddin', 33, 0, '2022-06-16 13:07:00', 'Jason Trestiza', '2022-12-22 10:55:25', 1, NULL),
(66, 6, 'Jojean Mary Yuro', 'Dumogho', 'Jojean Mary Yuro Dumogho', 'Jojean Mary Yuro Dumogho', 'jojeandumogho94@gmail.com', '09668345055', 'Philippines', '14', '2', '2022-07-07 10:57:00', 3, NULL, 'Referral from Skills agency', 2, 0, '2022-07-07 13:07:00', 'Jason Trestiza', '2022-12-22 10:57:25', 1, NULL),
(67, 6, 'Menchie Gaurino', 'Moreño', 'Menchie Gaurino Moreño', 'Menchie Gaurino Moreño', 'queencer_08@yahoo.com', '09612130862', 'Philippines', '15', '1', NULL, 1, NULL, NULL, 2, 0, '2022-07-07 13:07:00', NULL, NULL, 1, NULL),
(68, 2, 'Kristine', 'Garcia', 'Kristine Garcia', NULL, 'linardlee429@gmail.com', NULL, NULL, '11', '2', '2022-11-22 10:57:00', 3, NULL, NULL, 31, 0, '2022-11-21 13:18:00', 'Jason Trestiza', '2022-12-22 10:58:05', 1, NULL),
(69, 2, 'Wiselen Ember Jabarani', 'Barrios', 'Wiselen Ember Jabarani Barrios', NULL, 'wissybarrios@gmail.com', NULL, NULL, '18', '2', '2022-11-10 10:58:00', 3, NULL, NULL, 31, 0, '2022-11-08 13:18:00', 'Jason Trestiza', '2022-12-22 10:58:33', 1, NULL),
(70, 2, 'Imran', 'Ahmed', 'Imran Ahmed', NULL, 'anuking323@gmail.com', NULL, NULL, '13', '1', NULL, 1, NULL, NULL, 33, 0, '2022-06-17 13:18:00', NULL, NULL, 1, NULL),
(71, 2, 'Mohammad', 'Abrar', 'Mohammad Abrar', NULL, 'abrar.bbk@gmail.com', '09140452775', NULL, '13', '1', NULL, 1, NULL, NULL, 33, 0, '2022-06-15 13:18:00', NULL, NULL, 1, NULL),
(72, 2, 'Amir', 'Khan', 'Amir Khan', NULL, 'amirduke1@gmail.com', '08738087800', NULL, '13', '1', NULL, 1, NULL, NULL, 33, 0, '2022-05-11 13:18:00', NULL, NULL, 1, NULL),
(73, 2, 'Jonah Daguyen', 'Vilog', 'Jonah Daguyen Vilog', 'Jonah Daguyen Vilog', 'jdaguyenvilog@gmail.com', '09122979627', NULL, '11', '1', NULL, 1, NULL, NULL, 2, 0, '2022-11-08 13:18:00', NULL, NULL, 1, NULL),
(74, 2, 'Kaharudin', 'Tending', 'Kaharudin Tending', 'Kaharudin A. Tending', 'kaharudintending1.1@gmail.com', '09553886024', 'Philippines', '11', '1', NULL, 1, NULL, NULL, 2, 0, '2022-11-08 13:18:00', NULL, NULL, 1, NULL),
(75, 2, 'Judith', 'Ycay', 'Judith Ycay', 'Kaharudin A. Tending', 'judytheycay@gmail.com', NULL, NULL, '11', '1', NULL, 1, NULL, NULL, 31, 0, '2022-08-23 13:18:00', NULL, NULL, 1, NULL),
(76, 2, 'May Anne A.', 'Muñoz', 'May Anne A. Muñoz', NULL, 'munozmayanne032514@gmail.com', '09982163117', NULL, '14', '2', '2022-08-30 10:59:00', 3, NULL, 'MEGA MANPOWER', 31, 0, '2022-08-26 13:18:00', 'Jason Trestiza', '2022-12-22 10:59:50', 1, NULL),
(77, 2, 'Angelique', 'Equio', 'Angelique Equio', NULL, 'angeliquebequio@gmail.com', NULL, NULL, '13', '1', NULL, 1, NULL, NULL, 31, 0, '2022-08-26 13:18:00', NULL, NULL, 1, NULL),
(78, 2, 'Rozan', 'Villanueva', 'Rozan Villanueva', 'Rozan Villanueva', 'rozanvilla21@yahoo.com', NULL, NULL, '1', '2', '2022-11-11 11:00:00', 3, NULL, 'Referral from Razel Villanueva', 26, 0, '2022-11-07 13:18:00', 'Jason Trestiza', '2022-12-22 11:00:50', 1, NULL),
(79, 2, 'Mary Joy', 'Aggulen', 'Mary Joy Aggulen', 'Mary Joy Aggulen', 'aggulenmaryjoy@gmail.com', NULL, NULL, '3', '2', '2022-11-07 11:01:00', 3, NULL, NULL, 28, 0, '2022-11-07 13:18:00', 'Jason Trestiza', '2022-12-22 11:01:23', 1, NULL),
(80, 2, 'Leslie Jade', 'David', 'Leslie Jade David', NULL, 'davidlesliejade@gmail.com', NULL, NULL, '1', '2', '2022-12-14 11:01:00', 3, NULL, NULL, 30, 0, '2022-11-07 13:18:00', 'Jason Trestiza', '2022-12-22 11:02:05', 1, NULL),
(81, 2, 'Virgilio', 'Frando', 'Virgilio Frando', NULL, 'virgiliofrando@yahoo.com', NULL, NULL, '1', '2', '2022-11-09 11:02:00', 3, NULL, 'Referral from Lexter Heredero', 26, 0, '2022-11-08 13:18:00', 'Jason Trestiza', '2022-12-22 11:02:55', 1, NULL),
(82, 2, 'Jansen', 'Tungpalan', 'Jansen Tungpalan', 'Jansen Tungpalan', 'jansen_tungpalan@yahoo.com', NULL, NULL, '1', '1', NULL, 1, NULL, NULL, 26, 0, '2022-11-08 13:18:00', NULL, NULL, 1, NULL),
(83, 2, 'Cherry Mae Y.', 'Cobarrubias', 'Cherry Mae Y. Cobarrubias', NULL, 'cherrymaecobarrubias@yahoo.com', NULL, NULL, '1', '1', NULL, 1, NULL, NULL, 30, 0, '2022-11-08 13:18:00', NULL, NULL, 1, NULL),
(84, 2, 'Nikka', 'Melocoton', 'Nikka Melocoton', NULL, 'nikkamelocoton@yahoo.com', NULL, NULL, '1', '1', NULL, 1, NULL, NULL, 26, 0, '2022-11-09 13:18:00', NULL, NULL, 1, NULL),
(85, 2, 'Rachel', 'Elgincolin', 'Rachel Elgincolin', NULL, 'rachel_che1985@yahoo.com', NULL, NULL, '1', '1', NULL, 1, NULL, NULL, 30, 0, '2022-11-10 13:18:00', NULL, NULL, 1, NULL),
(86, 2, NULL, NULL, 'Rosselle Mago', 'Rosselle Mago', 'sellemago@icloud.com', NULL, NULL, '1', '2', '2023-01-26 09:23:00', 3, NULL, NULL, 26, 0, '2022-12-18 13:18:00', '1', '2023-01-26 09:23:51', 1, '2023-01-26T09:23'),
(87, 2, 'Mavie Joy Pineda', 'Mallorca', 'Mavie Joy Pineda Mallorca', NULL, 'maviejoy.mallorca@deped.gov.ph', NULL, NULL, '1', '1', NULL, 1, NULL, NULL, 30, 0, '2022-12-19 13:18:00', NULL, NULL, 1, NULL),
(88, 3, 'Caleigh', 'Bode', 'Caleigh Bode', NULL, NULL, NULL, NULL, '13', '2', '2022-12-19 11:03:00', 3, NULL, NULL, 33, 0, '2022-11-09 13:04:00', 'Jason Trestiza', '2022-12-22 11:03:31', 1, NULL),
(89, 3, 'Dannie', 'Abbott', 'Dannie Abbott', NULL, NULL, NULL, NULL, '1', '2', '2022-02-14 11:03:00', 3, NULL, NULL, 28, 0, '2022-01-19 13:05:00', 'Jason Trestiza', '2022-12-22 11:03:57', 1, NULL),
(90, 3, 'Abdul', 'Kuhic', 'Abdul Kuhic', NULL, NULL, NULL, NULL, '2', '1', NULL, 1, NULL, NULL, 28, 0, '2022-05-19 13:05:00', NULL, NULL, 1, NULL),
(91, 3, 'Henry', 'Osinski', 'Henry Osinski', NULL, NULL, NULL, NULL, '11', '1', NULL, 1, NULL, NULL, 31, 0, '2022-07-14 13:05:00', NULL, NULL, 1, NULL),
(92, 3, 'Coby', 'Crona', 'Coby Crona', NULL, NULL, NULL, NULL, '1', '2', '2022-09-25 11:04:00', 3, NULL, NULL, 29, 0, '2022-09-19 13:05:00', 'Jason Trestiza', '2022-12-22 11:04:39', 1, NULL),
(93, 3, 'Rebekah', 'Block', 'Rebekah Block', NULL, NULL, NULL, NULL, '13', '1', NULL, 1, NULL, NULL, 33, 0, '2022-02-05 13:05:00', NULL, NULL, 1, NULL),
(94, 3, 'Trent', 'Wolff', 'Trent Wolff', NULL, NULL, NULL, NULL, '1', '2', '2022-03-25 11:04:00', 3, NULL, NULL, 30, 0, '2022-03-14 13:05:00', 'Jason Trestiza', '2022-12-22 11:05:03', 1, NULL),
(95, 3, 'Kali', 'Kunde', 'Kali Kunde', NULL, NULL, NULL, NULL, '11', '1', NULL, 1, NULL, NULL, 31, 0, '2022-11-14 13:05:00', NULL, NULL, 1, NULL),
(96, 3, 'Cali', 'Ebert', 'Cali Ebert', NULL, NULL, NULL, NULL, '11', '1', NULL, 1, NULL, NULL, 2, 0, '2022-06-29 13:05:00', NULL, NULL, 1, NULL),
(97, 3, 'Zack', 'Kunde', 'Zack Kunde', NULL, NULL, NULL, NULL, '3', '2', '2022-05-19 11:05:00', 3, NULL, NULL, 30, 0, '2022-04-04 13:05:00', 'Jason Trestiza', '2022-12-22 11:05:30', 1, NULL),
(98, 3, 'Leda', 'Johnson', 'Leda Johnson', NULL, NULL, NULL, NULL, '2', '1', NULL, 1, NULL, NULL, 29, 0, '2022-07-14 13:05:00', NULL, NULL, 1, NULL),
(99, 3, 'Deja', 'Bosco', 'Deja Bosco', NULL, NULL, NULL, NULL, '13', '1', NULL, 1, NULL, NULL, 33, 0, '2022-08-14 13:05:00', NULL, NULL, 1, NULL),
(100, 3, 'Ryleigh', 'Lesch', 'Ryleigh Lesch', NULL, NULL, NULL, NULL, '11', '1', NULL, 1, NULL, NULL, 2, 0, '2022-12-14 13:05:00', NULL, NULL, 1, NULL),
(101, 3, 'Brianne', 'Stamm', 'Brianne Stamm', NULL, NULL, NULL, NULL, '1', '1', NULL, 1, NULL, NULL, 29, 0, '2022-11-11 13:05:00', NULL, NULL, 1, NULL),
(102, 3, 'Ettie', 'Dach I', 'Ettie Dach I', NULL, NULL, NULL, NULL, '13', '1', NULL, 1, NULL, NULL, 33, 0, '2022-09-01 13:05:00', NULL, NULL, 1, NULL),
(103, 3, 'Angel', 'Becker', 'Angel Becker', NULL, NULL, NULL, NULL, '1', '2', '2022-11-28 11:05:00', 3, NULL, NULL, 30, 0, '2022-11-24 13:05:00', 'Jason Trestiza', '2022-12-22 11:05:57', 1, NULL),
(104, 3, 'Zul', 'Wisozk', 'Zul Wisozk', NULL, NULL, NULL, NULL, '11', '1', NULL, 1, NULL, NULL, 2, 0, '2022-01-17 13:05:00', NULL, NULL, 1, NULL),
(105, 3, 'Julien', 'Kuphal', 'Julien Kuphal', NULL, NULL, NULL, NULL, '13', '1', NULL, 1, NULL, NULL, 33, 0, '2022-07-24 13:05:00', NULL, NULL, 1, NULL),
(106, 3, 'Audra', 'Frami', 'Audra Frami', NULL, NULL, NULL, NULL, '1', '2', '2022-07-07 11:06:00', 3, NULL, NULL, 29, 0, '2022-05-01 13:05:00', 'Jason Trestiza', '2022-12-22 11:06:26', 1, NULL),
(107, 3, 'Sadye', 'Doyle', 'Sadye Doyle', NULL, NULL, NULL, NULL, '11', '2', '2022-05-05 11:06:00', 3, NULL, NULL, 2, 0, '2022-04-29 13:05:00', 'Jason Trestiza', '2022-12-22 11:06:45', 1, NULL),
(108, 4, 'Melby', 'Muyot', 'Melby Muyot', NULL, 'melby.muyot1177@yahoo.com', NULL, NULL, '1', '1', NULL, 1, NULL, NULL, 1, 0, '2022-12-20 14:06:19', 'Jason Trestiza', '2022-12-21 14:06:49', 1, NULL),
(109, 4, 'Alyssa Isabel', 'Pingol', 'Alyssa Isabel Pingol', NULL, 'pingolalyssaisabel@gmail.com', NULL, NULL, '1', '1', NULL, 1, NULL, NULL, 1, 0, '2022-12-15 14:06:33', NULL, NULL, 1, NULL),
(110, 4, 'Allen', 'Jucucan', 'Allen Jucucan', NULL, 'allen_jucucan11@yahoo.com', NULL, NULL, '9', '1', NULL, 1, NULL, NULL, 1, 0, '2022-12-13 14:07:16', NULL, NULL, 1, NULL),
(111, 4, 'Criselle Ann', 'Cortez', 'Criselle Ann Cortez', NULL, 'crisellebawan08@gmail.com', NULL, NULL, '1', '1', NULL, 1, NULL, NULL, 1, 0, '2022-12-08 14:06:00', NULL, NULL, 1, NULL),
(112, 4, 'Mary Anne', 'Lagman', 'Mary Anne Lagman', NULL, 'maaaaannelagman@gmail.com', NULL, NULL, '1', '1', NULL, 1, NULL, NULL, 1, 0, '2022-12-07 14:06:00', NULL, NULL, 1, NULL),
(113, 4, 'Aladin', 'Cerezo', 'Aladin Cerezo', NULL, 'dinx_29@yahoo.com', NULL, NULL, '1', '1', NULL, 1, NULL, NULL, 1, 0, '2022-11-29 14:06:00', NULL, NULL, 1, NULL),
(114, 4, 'Noelyn', 'Abella', 'Noelyn Abella', NULL, 'noelyn_84@yahoo.com', NULL, NULL, '1', '1', NULL, 1, NULL, NULL, 1, 0, '2022-11-28 14:06:00', NULL, NULL, 1, NULL),
(115, 4, 'Jomarina', 'Antonio', 'Jomarina Antonio', NULL, 'jma.antonio@yahoo.com', NULL, NULL, '1', '1', NULL, 1, NULL, NULL, 1, 0, '2022-11-24 14:06:00', NULL, NULL, 1, NULL),
(116, 4, 'Edu', 'Valdez Jr.', 'Edu Valdez Jr.', NULL, 'eduvaldezjr@yahoo.com', NULL, NULL, '1', '1', NULL, 1, NULL, NULL, 1, 0, '2022-11-22 14:06:00', NULL, NULL, 1, NULL),
(117, 4, 'Shallmanezzer Oberio', 'Regalado', 'Shallmanezzer Oberio Regalado', NULL, 'shallmanezzer@yahoo.com', NULL, NULL, '1', '1', NULL, 1, NULL, NULL, 1, 0, '2022-11-23 14:06:00', NULL, NULL, 1, NULL),
(118, 4, 'Irene', 'Dela Vega', 'Irene Dela Vega', NULL, 'irened0428@gmail.com', NULL, NULL, '1', '1', NULL, 1, NULL, NULL, 1, 0, '2022-10-29 14:06:00', NULL, NULL, 1, NULL),
(119, 4, 'John Federic', 'Orendain', 'John Federic Orendain', NULL, 'johnf_tmpijnj@yahoo.com', NULL, NULL, '1', '1', NULL, 1, NULL, NULL, 1, 0, '2022-10-27 14:06:00', NULL, NULL, 1, NULL),
(120, 4, 'Marvin', 'Garcia', 'Marvin Garcia', NULL, NULL, NULL, NULL, '1', '1', NULL, 1, NULL, NULL, 1, 0, '2022-10-21 14:06:00', NULL, NULL, 1, NULL),
(121, 4, 'Denise', 'Angeles', 'Denise Angeles', NULL, 'dpa_1970@yahoo.com', NULL, NULL, '1', '1', NULL, 1, NULL, NULL, 1, 0, '2022-10-20 14:06:00', NULL, NULL, 1, NULL),
(122, 4, 'Krisna  Bernadette', 'Cantos', 'Krisna  Bernadette Cantos', NULL, 'cantoskrisnabernadette@gmail.com', '09171639939', NULL, '1', '1', NULL, 1, NULL, NULL, 1, 0, '2022-10-08 14:06:00', NULL, NULL, 1, NULL),
(123, 4, 'Michelle Ashley', 'Genterola', 'Michelle Ashley Genterola', NULL, 'mich_tasky@yahoo.com', NULL, NULL, '1', '2', '2023-01-09 11:50:30', 3, NULL, NULL, 1, 0, '2022-09-21 14:06:00', 'Jason Trestiza', '2023-01-09 11:50:30', 1, '2023-01-09T11:50'),
(124, 4, 'Joenel Lazaro', 'Saturno', 'Joenel Lazaro Saturno', NULL, 'nelaustron@gmail.com', NULL, NULL, '1', '1', NULL, 1, NULL, NULL, 1, 0, '2022-08-31 14:06:00', NULL, NULL, 1, NULL),
(125, 4, 'Anne', 'Dimayacyac', 'Anne Dimayacyac', NULL, 'john_dhee@yahoo.com', NULL, NULL, '21', '1', NULL, 1, NULL, NULL, 1, 0, '2022-07-25 14:06:00', NULL, NULL, 1, NULL),
(126, 4, 'Jommel Ryan', 'Lumibao', 'Jommel Ryan Lumibao', NULL, 'jommelryanclumibao@yahoo.com', NULL, NULL, '1', '1', NULL, 1, NULL, NULL, 1, 0, '2022-06-27 14:06:00', NULL, NULL, 1, NULL),
(127, 4, 'Andrea', 'Vergonio', 'Andrea Vergonio', NULL, 'andreavergonio87@gmail.com', NULL, NULL, '1', '1', NULL, 1, NULL, NULL, 1, 0, '2022-03-18 14:06:00', NULL, NULL, 1, NULL),
(128, 5, 'Rachelle Joan C.', 'Angeles', 'Rachelle Joan C. Angeles', NULL, NULL, NULL, NULL, '1', '2', '2022-12-26 09:18:00', 3, NULL, NULL, 10, 0, '2022-01-22 10:00:00', 'Jason Trestiza', '2022-12-26 09:18:35', 1, NULL),
(129, 5, 'Benjie Garaza', 'Rollan', 'Benjie Garaza Rollan', NULL, NULL, NULL, NULL, '22', '1', NULL, 1, NULL, NULL, 10, 0, '2022-02-22 10:00:00', NULL, NULL, 1, NULL),
(130, 5, 'Ann Pearlene Alas', 'Pasco', 'Ann Pearlene Alas Pasco', NULL, NULL, NULL, NULL, '7', '1', NULL, 1, NULL, NULL, 12, 0, '2022-03-22 10:00:00', NULL, NULL, 1, NULL),
(131, 5, 'Maria Rizza Maramot', 'Maluping', 'Maria Rizza Maramot Maluping', NULL, NULL, NULL, NULL, '7', '1', NULL, 1, NULL, NULL, 10, 0, '2022-04-22 10:00:00', NULL, NULL, 1, NULL),
(132, 5, 'Judith', 'De Roxas', 'Judith De Roxas', NULL, NULL, NULL, NULL, '1', '1', NULL, 1, NULL, NULL, 12, 0, '2022-05-22 10:00:00', NULL, NULL, 1, NULL),
(133, 5, 'Swissa  Miano', 'Lampano', 'Swissa  Miano Lampano', NULL, NULL, NULL, NULL, '7', '1', NULL, 1, NULL, NULL, 11, 0, '2022-06-22 10:00:00', NULL, NULL, 1, NULL),
(134, 5, 'Teodulo Maligaya', 'Hernandez', 'Teodulo Maligaya Hernandez', NULL, NULL, NULL, NULL, '1', '1', NULL, 1, NULL, NULL, 11, 0, '2022-07-22 10:00:00', NULL, NULL, 1, NULL),
(135, 5, 'Mayzel', 'Rio', 'Mayzel Rio', NULL, NULL, NULL, NULL, '1', '1', NULL, 1, NULL, NULL, 10, 0, '2022-08-22 10:00:00', NULL, NULL, 1, NULL),
(136, 5, 'Richelle', 'Rabino', 'Richelle Rabino', NULL, NULL, NULL, NULL, '1', '1', NULL, 1, NULL, NULL, 12, 0, '2022-09-22 10:00:00', NULL, NULL, 1, NULL),
(137, 5, 'John Michael	Torela', 'Awid', 'John Michael	Torela Awid', NULL, NULL, NULL, NULL, '1', '1', NULL, 1, NULL, NULL, 11, 0, '2022-10-22 10:00:00', NULL, NULL, 1, NULL),
(138, 5, 'Keenan Albert', 'Arangote', 'Keenan Albert Arangote', NULL, NULL, NULL, NULL, '1', '1', NULL, 1, NULL, NULL, 10, 0, '2022-11-22 10:00:00', NULL, NULL, 1, NULL),
(139, 5, 'Mary Mariel', 'Macaraya', 'Mary Mariel Macaraya', NULL, NULL, NULL, NULL, '1', '1', NULL, 1, NULL, NULL, 10, 0, '2022-12-22 10:00:00', NULL, NULL, 1, NULL),
(140, 5, 'Narianne Kay Alfonso', 'Menor', 'Narianne Kay Alfonso Menor', NULL, NULL, NULL, NULL, '1', '1', NULL, 1, NULL, NULL, 12, 0, '2022-01-02 10:00:00', NULL, NULL, 1, NULL),
(141, 5, 'Jennel', 'Dela Torre', 'Jennel Dela Torre', NULL, NULL, NULL, NULL, '1', '1', NULL, 1, NULL, NULL, 14, 0, '2022-02-02 10:00:00', NULL, NULL, 1, NULL),
(142, 5, 'Larraine Vissia Ellis Hernandez', 'Rosales', 'Larraine Vissia Ellis Hernandez Rosales', NULL, NULL, NULL, NULL, '1', '1', NULL, 1, NULL, NULL, 10, 0, '2022-03-05 10:00:00', NULL, NULL, 1, NULL),
(143, 5, 'Ruiji', 'Burgos', 'Ruiji Burgos', NULL, NULL, NULL, NULL, '1', '1', NULL, 1, NULL, NULL, 10, 0, '2022-03-05 10:00:00', NULL, NULL, 1, NULL),
(144, 5, 'Edmundo Gallietos', 'Ferrer', 'Edmundo Gallietos Ferrer', NULL, NULL, NULL, NULL, '1', '1', NULL, 1, NULL, NULL, 12, 0, '2022-04-05 10:00:00', NULL, NULL, 1, NULL),
(145, 5, 'Aizel Jane', 'Lim', 'Aizel Jane Lim', NULL, NULL, NULL, NULL, '1', '1', NULL, 1, NULL, NULL, 10, 0, '2022-05-05 10:00:00', NULL, NULL, 1, NULL),
(146, 5, 'Kimpee', 'Buan', 'Kimpee Buan', NULL, NULL, NULL, NULL, '1', '1', NULL, 1, NULL, NULL, 11, 0, '2022-05-05 10:00:00', NULL, NULL, 1, NULL),
(147, 5, 'Maria Lady Jeanne Velonza', 'Paje', 'Maria Lady Jeanne Velonza Paje', NULL, NULL, NULL, NULL, '1', '1', NULL, 1, NULL, NULL, 12, 0, '2022-07-05 10:00:00', NULL, NULL, 1, NULL),
(148, 6, 'Alice', 'Sunga', 'Alice Sunga', NULL, 'alicesunga1012@gmail.com', NULL, NULL, '14', '2', '2022-06-05 10:54:00', 3, NULL, 'Referral of Ms. Rachelle Bonifacio', 31, 0, '2022-06-02 10:53:00', 'Jason Trestiza', '2022-12-22 10:54:48', 1, NULL),
(149, 6, 'Clare Ann', 'Elnar', 'Clare Ann Elnar', NULL, NULL, NULL, NULL, '16', '2', '2022-06-27 10:56:00', 3, NULL, NULL, 31, 0, '2022-06-23 10:55:00', 'Jason Trestiza', '2023-01-07 11:05:01', 1, '2023-01-07T11:04'),
(150, 1, 'Dagdag', 'Lang', 'Dagdag Lang', NULL, NULL, NULL, NULL, '1', '1', NULL, 1, NULL, NULL, 26, 0, '2022-12-22 13:25:00', NULL, NULL, 1, NULL),
(151, 4, 'Charlie', 'Bertuso', 'Charlie Bertuso', NULL, 'websupport@medexamscenter.com', NULL, NULL, '11', '2', '2023-01-11 09:20:22', 3, NULL, NULL, 13, 0, '2023-01-03 16:15:47', 'Jason Trestiza', '2023-01-11 09:20:22', 1, '2023-01-11T09:20'),
(152, 4, 'April', 'Arbas', 'April Arbas', NULL, 'test@test.com', NULL, NULL, '9', '2', '2023-01-11 09:11:00', 3, NULL, NULL, 10, 0, '2023-01-03 16:56:39', '1', '2023-01-13 15:18:07', 1, '2023-01-11T09:11'),
(153, 3, 'April', 'Arbas', 'April Arbas', NULL, NULL, NULL, NULL, '1,9,13', '1,1,1', NULL, 1, NULL, NULL, 10, 0, '2023-01-03 16:57:02', NULL, NULL, 1, NULL),
(154, 4, 'Sample', 'User Ito', 'Sample User Ito', NULL, NULL, NULL, NULL, '5,7', '1,1', NULL, 1, NULL, NULL, 5, 0, '2023-01-04 12:27:42', 'Jason Trestiza', '2023-01-11 09:04:30', 1, ','),
(155, 1, 'Ze', 'Haha', 'Ze Haha', 'fb.me/zeha', 'zeha@gmail.com', NULL, 'Bangladesh', '3', '1', NULL, 1, NULL, NULL, 8, 0, '2023-01-05 09:28:57', NULL, NULL, 1, ''),
(156, 1, 'Isa', 'pa', 'Isa pa', NULL, NULL, NULL, 'Bangladesh', '1,2,6,7,10,15', '1,1,1,1,1,1', NULL, 1, NULL, NULL, 16, 0, '2023-01-07 09:48:26', 'Jason Trestiza', '2023-01-11 09:24:36', 1, ',,,,,'),
(157, 1, NULL, NULL, 'Khadija Nasser Ammad', NULL, 'khadijaammad001@gmail.com', NULL, 'Bangladesh', '4,1', '1,1', NULL, 1, NULL, NULL, 15, 0, '2023-01-10 09:21:37', NULL, NULL, 1, NULL),
(158, 1, NULL, NULL, 'Uniki', NULL, NULL, NULL, 'Bangladesh', '4', '1', NULL, 1, NULL, NULL, 1, 0, '2023-01-10 09:43:57', NULL, NULL, 1, ''),
(159, 1, NULL, NULL, 'Unique Ito', 'fb.me/uniqto', NULL, NULL, 'Austria', '2,4,7', '1,1,1', NULL, 1, NULL, NULL, 20, 0, '2023-01-10 09:52:21', NULL, NULL, 1, ',,'),
(160, 1, NULL, NULL, 'Karma Police', NULL, 'hehehahazzzxxxx@gmail.com', NULL, 'Bahamas', '3,6', '1,1', NULL, 1, NULL, NULL, 16, 0, '2023-01-10 10:23:19', NULL, NULL, 1, ','),
(161, 1, NULL, NULL, 'Karma Police', NULL, 'hehehahazzzxxxxxxxxx@gmail.com', NULL, 'Bahamas', '3,6', '1,1', NULL, 1, NULL, NULL, 16, 0, '2023-01-10 10:50:25', NULL, NULL, 1, ','),
(162, 1, NULL, NULL, 'Karma Police', 'fb.me/ccb.padilla', 'hehehahazzzxxxxxxxxx@gmail.com', NULL, 'Bahamas', '7', '1', NULL, 1, NULL, NULL, 1, 0, '2023-01-10 11:06:19', NULL, NULL, 1, ''),
(163, 1, NULL, NULL, 'Karma Police', NULL, 'hehehahazzzxxxxxxxxx@gmail.com', NULL, 'Bahamas', '4,5', '1,1', NULL, 1, NULL, NULL, 1, 0, '2023-01-10 13:33:41', NULL, NULL, 1, ','),
(164, 1, NULL, NULL, 'sampleunique full name', NULL, NULL, NULL, NULL, '2', '1', NULL, 1, NULL, NULL, 1, 0, '2023-01-10 13:41:09', NULL, NULL, 1, ''),
(165, 1, NULL, NULL, 'testing hehe', NULL, NULL, NULL, NULL, '7', '1', NULL, 1, NULL, NULL, 2, 0, '2023-01-10 14:02:36', 'Jason Trestiza', '2023-01-11 09:28:25', 1, ''),
(166, 1, 'panga', 'lan', 'panga lan', 'fb.me/onieyanihh', NULL, NULL, NULL, '3', '1', NULL, 1, NULL, NULL, 1, 0, '2023-01-10 14:05:26', NULL, NULL, 1, ''),
(167, 1, 'JE', 'R', 'Je R', 'fb.me/ccb.padillaa', NULL, NULL, 'Bangladesh', '2,3,4,5,6,7', '1,1,1,1,1,1', NULL, 1, NULL, NULL, 20, 0, '2023-01-10 14:11:08', 'Jason Trestiza', '2023-01-11 09:27:59', 1, ',,,,,'),
(168, 1, NULL, NULL, 'Your Universe', NULL, NULL, NULL, 'Antarctica', '19', '2', '2023-01-13 14:35:00', 3, NULL, NULL, 19, 1, '2023-01-11 10:30:06', '1', '2023-01-13 14:37:00', 1, '2023-01-13T14:35'),
(169, 1, NULL, NULL, 'Kahit kailan', NULL, NULL, NULL, NULL, '7,8', '2,3', '2023-01-13 15:06:00', 3, NULL, NULL, 2, 1, '2023-01-11 13:39:14', '1', '2023-01-13 15:06:46', 1, '2023-01-13T15:06,2023-01-13T15:07'),
(170, 1, NULL, NULL, 'Applicant 170', NULL, NULL, NULL, NULL, '1,5', '1,1', NULL, 1, 2, NULL, 1, 1, '2023-01-11 13:42:45', 'Jason Trestiza', '2023-01-16 14:01:00', 1, ','),
(171, 3, NULL, NULL, 'John Doe', 'fb.me/johndoe', NULL, NULL, 'United States', '1', '1', NULL, 1, NULL, NULL, 1, 1, '2023-01-31 09:06:10', NULL, NULL, 1, ''),
(172, 3, NULL, NULL, 'Mary Jane', NULL, 'mjane@gmail.com', NULL, NULL, '4', '1', NULL, 1, NULL, NULL, 1, 1, '2023-01-31 09:06:55', '1', '2023-01-31 09:07:43', 1, ''),
(173, 7, NULL, NULL, 'Mary Dee', NULL, 'marydee@gmail.com', NULL, 'China', '1', '1', NULL, 2, NULL, NULL, 1, 1, '2023-01-31 15:33:34', NULL, NULL, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_leadsource`
--

CREATE TABLE `tbl_leadsource` (
  `leadsourceID` int(11) NOT NULL,
  `leadSourceName` varchar(75) NOT NULL,
  `leadSourceType` int(11) DEFAULT NULL,
  `isActive` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_leadsource`
--

INSERT INTO `tbl_leadsource` (`leadsourceID`, `leadSourceName`, `leadSourceType`, `isActive`) VALUES
(1, 'Facebook', NULL, 1),
(2, 'Email', NULL, 1),
(3, 'Website', NULL, 1),
(4, 'SOP', NULL, 1),
(5, 'Inhouse', NULL, 1),
(6, 'Agency', NULL, 1),
(7, 'Booking Appointment', NULL, 1),
(8, 'Additional Lead Source', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_months`
--

CREATE TABLE `tbl_months` (
  `month_number` int(11) NOT NULL,
  `month_name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_months`
--

INSERT INTO `tbl_months` (`month_number`, `month_name`) VALUES
(1, 'January'),
(2, 'February'),
(3, 'March'),
(4, 'April'),
(5, 'May'),
(6, 'June'),
(7, 'July'),
(8, 'August'),
(9, 'September'),
(10, 'October'),
(11, 'November'),
(12, 'December');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_scoring`
--

CREATE TABLE `tbl_scoring` (
  `scoringID` int(11) NOT NULL,
  `scoringName` varchar(35) NOT NULL,
  `isActive` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_scoring`
--

INSERT INTO `tbl_scoring` (`scoringID`, `scoringName`, `isActive`) VALUES
(1, 'Hot Lead', 1),
(2, 'Cold Lead', 1),
(3, 'Signed Up', 1),
(4, 'Additional Scoring 1', 0),
(5, 'Additional Scoring 2', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_services`
--

CREATE TABLE `tbl_services` (
  `serviceID` int(11) NOT NULL,
  `serviceName` varchar(50) NOT NULL,
  `isActive` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_services`
--

INSERT INTO `tbl_services` (`serviceID`, `serviceName`, `isActive`) VALUES
(1, 'NCLEX USA RN/PN', 1),
(2, 'NCLEX CANADA RN', 1),
(3, 'NCLEX AUSTRALIA RN', 1),
(4, 'NMC UK', 1),
(5, 'NMBI', 1),
(6, 'NCNZ', 1),
(7, 'VISA SCREEN', 1),
(8, 'LICENSE RENEWAL', 1),
(9, 'NPTE', 1),
(10, 'US MEDCODERS', 1),
(11, 'DOH-HAAD', 1),
(12, 'SCFHS', 1),
(13, 'DHA', 1),
(14, 'UAE-MOH', 1),
(15, 'OMSB', 1),
(16, 'DPH-MOPH', 1),
(17, 'NHRA-DATAFLOW', 1),
(18, 'PRC LICENSE RENEWAL', 1),
(19, 'CERTIFICATE OF GOOD STANDING', 1),
(20, 'LICENSE VALIDATION', 1),
(21, 'ONLINE REVIEW', 1),
(22, 'USRN LICENSE ENDORSEMENT', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_status`
--

CREATE TABLE `tbl_status` (
  `statusID` int(11) NOT NULL,
  `statusName` varchar(50) NOT NULL,
  `isActive` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_status`
--

INSERT INTO `tbl_status` (`statusID`, `statusName`, `isActive`) VALUES
(1, 'Inquiry', 1),
(2, 'Availed', 1),
(3, 'Forwarded to Requirements Team', 1),
(4, 'Forwarded to LC', 1),
(5, 'ADDITIONAL INQUIRY STATUS 1', 0),
(6, 'ADDITIONAL INQUIRY STATUS 2', 0),
(7, 'ADDITIONAL INQUIRY STATUS 3', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_usertype`
--

CREATE TABLE `tbl_usertype` (
  `utID` int(11) NOT NULL,
  `utName` varchar(25) NOT NULL,
  `isActive` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_usertype`
--

INSERT INTO `tbl_usertype` (`utID`, `utName`, `isActive`) VALUES
(1, 'Admin', 1),
(2, 'LC', 1),
(3, 'Manager/Supervisor', 1),
(4, 'Marketing', 1),
(5, 'QA', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_webacquisition`
--

CREATE TABLE `tbl_webacquisition` (
  `webacquisition_number` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `direct_traffic` int(11) DEFAULT NULL,
  `email_marketing` int(11) NOT NULL,
  `organic_search` int(11) DEFAULT NULL,
  `paid_search` int(11) DEFAULT NULL,
  `referrals` int(11) DEFAULT NULL,
  `social_media` int(11) DEFAULT NULL,
  `other_campaigns` int(11) NOT NULL,
  `offline_sources` int(11) NOT NULL,
  `display` int(11) NOT NULL,
  `createdBy` int(11) NOT NULL,
  `dateCreated` datetime NOT NULL,
  `modifiedBy` int(11) DEFAULT NULL,
  `dateModified` datetime DEFAULT NULL,
  `isActive` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_webacquisition`
--

INSERT INTO `tbl_webacquisition` (`webacquisition_number`, `month`, `year`, `direct_traffic`, `email_marketing`, `organic_search`, `paid_search`, `referrals`, `social_media`, `other_campaigns`, `offline_sources`, `display`, `createdBy`, `dateCreated`, `modifiedBy`, `dateModified`, `isActive`) VALUES
(1, 1, 2022, 3997, 66, 13648, 13484, 1939, 1930, 0, 0, 11, 1, '2023-01-28 19:00:38', 1, '2023-01-31 13:53:46', 1),
(2, 2, 2022, 4795, 69, 13446, 11506, 2317, 2016, 1, 0, 15, 1, '2023-01-31 13:54:54', 1, '2023-01-31 14:02:12', 1),
(3, 3, 2022, 4691, 87, 14766, 12257, 2718, 2266, 0, 0, 18, 1, '2023-01-31 13:59:59', NULL, NULL, 1),
(4, 4, 2022, 3934, 44, 14068, 11326, 2969, 1586, 0, 0, 6, 1, '2023-01-31 14:06:17', NULL, NULL, 1),
(5, 5, 2022, 4763, 3, 15716, 12377, 2940, 1914, 0, 0, 2735, 1, '2023-01-31 14:06:58', NULL, NULL, 1),
(6, 6, 2022, 4678, 3, 18761, 12928, 2251, 1882, 0, 0, 1144, 1, '2023-01-31 14:07:39', NULL, NULL, 1),
(7, 7, 2022, 5002, 2, 20031, 14002, 2026, 1875, 0, 0, 846, 1, '2023-01-31 14:08:04', NULL, NULL, 1),
(8, 8, 2022, 5150, 7, 20816, 12831, 2474, 2242, 0, 0, 1163, 1, '2023-01-31 14:08:30', NULL, NULL, 1),
(9, 9, 2022, 4696, 0, 19132, 11838, 2196, 1807, 0, 0, 1152, 1, '2023-01-31 14:08:55', NULL, NULL, 1),
(10, 10, 2022, 5104, 0, 18644, 10942, 2052, 1836, 0, 0, 915, 1, '2023-01-31 14:09:25', NULL, NULL, 1),
(11, 11, 2022, 4787, 1, 16880, 10083, 2277, 1834, 9, 0, 472, 1, '2023-01-31 14:09:49', NULL, NULL, 1),
(12, 12, 2022, 4336, 0, 15523, 9474, 1951, 1686, 3, 0, 629, 1, '2023-01-31 14:10:51', 1, '2023-02-03 12:10:53', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_accounts`
--
ALTER TABLE `tbl_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_campaign`
--
ALTER TABLE `tbl_campaign`
  ADD PRIMARY KEY (`campaign_number`);

--
-- Indexes for table `tbl_fbanalytics`
--
ALTER TABLE `tbl_fbanalytics`
  ADD PRIMARY KEY (`fbanalytics_number`);

--
-- Indexes for table `tbl_inquiries`
--
ALTER TABLE `tbl_inquiries`
  ADD PRIMARY KEY (`inquiryID`);

--
-- Indexes for table `tbl_leadsource`
--
ALTER TABLE `tbl_leadsource`
  ADD PRIMARY KEY (`leadsourceID`);

--
-- Indexes for table `tbl_months`
--
ALTER TABLE `tbl_months`
  ADD PRIMARY KEY (`month_number`);

--
-- Indexes for table `tbl_scoring`
--
ALTER TABLE `tbl_scoring`
  ADD PRIMARY KEY (`scoringID`);

--
-- Indexes for table `tbl_services`
--
ALTER TABLE `tbl_services`
  ADD PRIMARY KEY (`serviceID`);

--
-- Indexes for table `tbl_status`
--
ALTER TABLE `tbl_status`
  ADD PRIMARY KEY (`statusID`);

--
-- Indexes for table `tbl_usertype`
--
ALTER TABLE `tbl_usertype`
  ADD PRIMARY KEY (`utID`);

--
-- Indexes for table `tbl_webacquisition`
--
ALTER TABLE `tbl_webacquisition`
  ADD PRIMARY KEY (`webacquisition_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_accounts`
--
ALTER TABLE `tbl_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `tbl_campaign`
--
ALTER TABLE `tbl_campaign`
  MODIFY `campaign_number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `tbl_fbanalytics`
--
ALTER TABLE `tbl_fbanalytics`
  MODIFY `fbanalytics_number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_inquiries`
--
ALTER TABLE `tbl_inquiries`
  MODIFY `inquiryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=174;

--
-- AUTO_INCREMENT for table `tbl_leadsource`
--
ALTER TABLE `tbl_leadsource`
  MODIFY `leadsourceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_months`
--
ALTER TABLE `tbl_months`
  MODIFY `month_number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_scoring`
--
ALTER TABLE `tbl_scoring`
  MODIFY `scoringID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_services`
--
ALTER TABLE `tbl_services`
  MODIFY `serviceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tbl_status`
--
ALTER TABLE `tbl_status`
  MODIFY `statusID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_usertype`
--
ALTER TABLE `tbl_usertype`
  MODIFY `utID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_webacquisition`
--
ALTER TABLE `tbl_webacquisition`
  MODIFY `webacquisition_number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
