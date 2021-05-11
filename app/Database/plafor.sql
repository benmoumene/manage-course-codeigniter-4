-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 11 mai 2021 à 13:34
-- Version du serveur :  10.4.17-MariaDB
-- Version de PHP : 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `plafor`
--

-- --------------------------------------------------------

--
-- Structure de la table `acquisition_level`
--

CREATE TABLE `acquisition_level` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `acquisition_level`
--

INSERT INTO `acquisition_level` (`id`, `name`) VALUES
(1, 'Non expliqué'),
(2, 'Expliqué'),
(3, 'Exercé'),
(4, 'Autonome');

-- --------------------------------------------------------

--
-- Structure de la table `acquisition_status`
--

CREATE TABLE `acquisition_status` (
  `id` int(11) NOT NULL,
  `fk_objective` int(11) NOT NULL,
  `fk_user_course` int(11) NOT NULL,
  `fk_acquisition_level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `acquisition_status`
--

INSERT INTO `acquisition_status` (`id`, `fk_objective`, `fk_user_course`, `fk_acquisition_level`) VALUES
(1, 1, 1, 1),
(2, 2, 1, 1),
(3, 3, 1, 1),
(4, 4, 1, 1),
(5, 5, 1, 1),
(6, 6, 1, 1),
(7, 7, 1, 1),
(8, 8, 1, 1),
(9, 9, 1, 1),
(10, 10, 1, 1),
(11, 11, 1, 1),
(12, 12, 1, 1),
(13, 13, 1, 1),
(14, 14, 1, 1),
(15, 15, 1, 1),
(16, 16, 1, 1),
(17, 17, 1, 1),
(18, 18, 1, 1),
(19, 19, 1, 1),
(20, 20, 1, 1),
(21, 21, 1, 1),
(22, 22, 1, 1),
(23, 23, 1, 1),
(24, 24, 1, 1),
(25, 25, 1, 1),
(26, 26, 1, 1),
(27, 27, 1, 1),
(28, 28, 1, 1),
(29, 29, 1, 1),
(30, 30, 1, 1),
(31, 31, 1, 1),
(32, 32, 1, 1),
(33, 33, 1, 1),
(34, 34, 1, 1),
(35, 35, 1, 1),
(36, 36, 1, 1),
(37, 37, 1, 1),
(38, 38, 1, 1),
(39, 39, 1, 1),
(40, 40, 1, 1),
(41, 41, 1, 1),
(42, 42, 1, 1),
(43, 43, 1, 1),
(44, 44, 1, 1),
(45, 45, 1, 1),
(46, 46, 1, 1),
(47, 47, 1, 1),
(48, 48, 1, 1),
(49, 49, 1, 1),
(50, 50, 1, 1),
(51, 51, 1, 1),
(52, 52, 1, 1),
(53, 53, 1, 1),
(54, 54, 1, 1),
(55, 55, 1, 1),
(56, 56, 1, 1),
(57, 57, 1, 1),
(58, 58, 1, 1),
(59, 59, 1, 1),
(60, 60, 1, 1),
(61, 61, 1, 1),
(62, 62, 1, 1),
(63, 63, 1, 1),
(64, 64, 1, 1),
(65, 65, 1, 1),
(66, 66, 1, 1),
(67, 67, 1, 1),
(68, 68, 1, 1),
(69, 69, 1, 1),
(70, 70, 1, 1),
(71, 71, 1, 1),
(72, 72, 1, 1),
(73, 73, 1, 1),
(74, 177, 2, 1),
(75, 178, 2, 1),
(76, 179, 2, 1),
(77, 180, 2, 1),
(78, 181, 2, 1),
(79, 182, 2, 1),
(80, 183, 2, 1),
(81, 184, 2, 1),
(82, 185, 2, 1),
(83, 186, 2, 1),
(84, 187, 2, 1),
(85, 188, 2, 1),
(86, 189, 2, 1),
(87, 190, 2, 1),
(88, 191, 2, 1),
(89, 192, 2, 1),
(90, 193, 2, 1),
(91, 194, 2, 1),
(92, 195, 2, 1),
(93, 196, 2, 1),
(94, 197, 2, 1),
(95, 198, 2, 1),
(96, 199, 2, 1),
(97, 200, 2, 1),
(98, 201, 2, 1),
(99, 202, 2, 1),
(100, 203, 2, 1),
(101, 204, 2, 1),
(102, 205, 2, 1),
(103, 206, 2, 1),
(104, 207, 2, 1),
(105, 208, 2, 1),
(106, 209, 2, 1),
(107, 210, 2, 1),
(108, 211, 2, 1),
(109, 212, 2, 1),
(110, 213, 2, 1),
(111, 214, 2, 1),
(112, 215, 2, 1),
(113, 216, 2, 1),
(114, 217, 2, 1),
(115, 218, 2, 1),
(116, 219, 2, 1),
(117, 220, 2, 1),
(118, 221, 2, 1),
(119, 222, 2, 1),
(120, 223, 2, 1),
(121, 224, 2, 1),
(122, 225, 2, 1),
(123, 226, 2, 1),
(124, 227, 2, 1),
(125, 228, 2, 1),
(126, 229, 2, 1),
(127, 230, 2, 1),
(128, 231, 2, 1),
(129, 232, 2, 1),
(130, 233, 2, 1),
(131, 234, 2, 1),
(132, 235, 2, 1),
(133, 236, 2, 1),
(134, 237, 2, 1),
(135, 238, 2, 1),
(136, 239, 2, 1),
(137, 240, 2, 1),
(138, 241, 2, 1),
(139, 242, 2, 1),
(140, 243, 2, 1),
(141, 244, 2, 1),
(142, 245, 2, 1),
(143, 246, 2, 1),
(144, 247, 2, 1),
(145, 248, 2, 1),
(146, 249, 2, 1),
(147, 250, 2, 1),
(148, 251, 2, 1),
(149, 252, 2, 1),
(150, 253, 2, 1),
(151, 254, 2, 1),
(152, 255, 2, 1),
(153, 256, 2, 1),
(154, 257, 2, 1),
(155, 258, 2, 1),
(156, 259, 2, 1),
(157, 260, 2, 1),
(158, 261, 2, 1),
(159, 262, 2, 1),
(160, 263, 2, 1),
(161, 264, 2, 1),
(162, 265, 2, 1),
(163, 266, 2, 1),
(164, 267, 3, 1),
(165, 268, 3, 1),
(166, 269, 3, 1),
(167, 270, 3, 1),
(168, 271, 3, 1),
(169, 272, 3, 1),
(170, 273, 3, 1),
(171, 274, 3, 1),
(172, 275, 3, 1),
(173, 276, 3, 1),
(174, 277, 3, 1),
(175, 278, 3, 1),
(176, 279, 3, 1),
(177, 280, 3, 1),
(178, 281, 3, 1),
(179, 282, 3, 1),
(180, 283, 3, 1),
(181, 284, 3, 1),
(182, 285, 3, 1),
(183, 286, 3, 1),
(184, 287, 3, 1),
(185, 288, 3, 1),
(186, 289, 3, 1),
(187, 290, 3, 1),
(188, 291, 3, 1),
(189, 292, 3, 1),
(190, 293, 3, 1),
(191, 294, 3, 1),
(192, 295, 3, 1),
(193, 296, 3, 1),
(194, 297, 3, 1),
(195, 298, 3, 1),
(196, 299, 3, 1),
(197, 300, 3, 1),
(198, 301, 3, 1),
(199, 302, 3, 1),
(200, 303, 3, 1),
(201, 304, 3, 1),
(202, 305, 3, 1),
(203, 306, 3, 1),
(204, 307, 3, 1),
(205, 308, 3, 1),
(206, 309, 3, 1),
(207, 310, 3, 1),
(208, 311, 3, 1),
(209, 312, 3, 1),
(210, 313, 3, 1),
(211, 314, 3, 1),
(212, 315, 3, 1),
(213, 316, 3, 1),
(214, 317, 3, 1),
(215, 318, 3, 1),
(216, 319, 3, 1),
(217, 320, 3, 1),
(218, 321, 3, 1),
(219, 322, 3, 1),
(220, 323, 3, 1),
(221, 324, 3, 1),
(222, 325, 3, 1),
(223, 326, 3, 1),
(224, 327, 3, 1),
(225, 328, 3, 1),
(226, 329, 3, 1),
(227, 330, 3, 1),
(228, 331, 3, 1),
(229, 332, 3, 1),
(230, 1, 4, 1),
(231, 2, 4, 1),
(232, 3, 4, 1),
(233, 4, 4, 1),
(234, 5, 4, 1),
(235, 6, 4, 1),
(236, 7, 4, 1),
(237, 8, 4, 1),
(238, 9, 4, 1),
(239, 10, 4, 1),
(240, 11, 4, 1),
(241, 12, 4, 1),
(242, 13, 4, 1),
(243, 14, 4, 1),
(244, 15, 4, 1),
(245, 16, 4, 1),
(246, 17, 4, 1),
(247, 18, 4, 1),
(248, 19, 4, 1),
(249, 20, 4, 1),
(250, 21, 4, 1),
(251, 22, 4, 1),
(252, 23, 4, 1),
(253, 24, 4, 1),
(254, 25, 4, 1),
(255, 26, 4, 1),
(256, 27, 4, 1),
(257, 28, 4, 1),
(258, 29, 4, 1),
(259, 30, 4, 1),
(260, 31, 4, 1),
(261, 32, 4, 1),
(262, 33, 4, 1),
(263, 34, 4, 1),
(264, 35, 4, 1),
(265, 36, 4, 1),
(266, 37, 4, 1),
(267, 38, 4, 1),
(268, 39, 4, 1),
(269, 40, 4, 1),
(270, 41, 4, 1),
(271, 42, 4, 1),
(272, 43, 4, 1),
(273, 44, 4, 1),
(274, 45, 4, 1),
(275, 46, 4, 1),
(276, 47, 4, 1),
(277, 48, 4, 1),
(278, 49, 4, 1),
(279, 50, 4, 1),
(280, 51, 4, 1),
(281, 52, 4, 1),
(282, 53, 4, 1),
(283, 54, 4, 1),
(284, 55, 4, 1),
(285, 56, 4, 1),
(286, 57, 4, 1),
(287, 58, 4, 1),
(288, 59, 4, 1),
(289, 60, 4, 1),
(290, 61, 4, 1),
(291, 62, 4, 1),
(292, 63, 4, 1),
(293, 64, 4, 1),
(294, 65, 4, 1),
(295, 66, 4, 1),
(296, 67, 4, 1),
(297, 68, 4, 1),
(298, 69, 4, 1),
(299, 70, 4, 1),
(300, 71, 4, 1),
(301, 72, 4, 1),
(302, 73, 4, 1);

-- --------------------------------------------------------

--
-- Structure de la table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('l8c5ovs7kjvvm4kt3ghh37rohlca458b', '127.0.0.1', 1620718518, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632303731383531383b6c6f676765645f696e7c623a303b5f63695f70726576696f75735f75726c7c733a33393a22687474703a2f2f6c6f63616c686f73742f63695f7061636b626173655f76342f7075626c69632f223b),
('02ise7d4bdun88l1so9rmofflt3karvl', '127.0.0.1', 1620718973, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632303731383937333b6c6f676765645f696e7c623a303b5f63695f70726576696f75735f75726c7c733a33393a22687474703a2f2f6c6f63616c686f73742f63695f7061636b626173655f76342f7075626c69632f223b),
('vf3t9qndb30lualt5r6d8bt8fpdok6d5', '127.0.0.1', 1620719541, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632303731393534313b6c6f676765645f696e7c623a303b5f63695f70726576696f75735f75726c7c733a33393a22687474703a2f2f6c6f63616c686f73742f63695f7061636b626173655f76342f7075626c69632f223b),
('rq68tn33eu26q1tjqk2asncsqkhp32er', '127.0.0.1', 1620720138, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632303732303133383b6c6f676765645f696e7c623a303b5f63695f70726576696f75735f75726c7c733a34303a22687474703a2f2f6c6f63616c686f73742f706c61666f7256332f706c61666f722f7075626c69632f223b),
('ec3tlqvumibpnse577ehhi4do0quijp6', '127.0.0.1', 1620720497, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632303732303439373b6c6f676765645f696e7c623a313b5f63695f70726576696f75735f75726c7c733a33313a22687474703a2f2f6c6f63616c686f73742f706c61666f722f7075626c69632f223b61667465725f6c6f67696e5f72656469726563747c733a33303a22687474703a2f2f6c6f63616c686f73742f706c61666f722f7075626c6963223b757365725f69647c693a313b757365726e616d657c733a353a2261646d696e223b757365725f6163636573737c693a343b),
('jl0hrld1e9ncaapjm0oi01j63ejab4o7', '127.0.0.1', 1620721413, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632303732313431333b6c6f676765645f696e7c623a313b5f63695f70726576696f75735f75726c7c733a36303a22687474703a2f2f6c6f63616c686f73742f706c61666f722f7075626c69632f706c61666f722f61646d696e2f6c6973745f636f757273655f706c616e223b61667465725f6c6f67696e5f72656469726563747c733a33303a22687474703a2f2f6c6f63616c686f73742f706c61666f722f7075626c6963223b757365725f69647c693a313b757365726e616d657c733a353a2261646d696e223b757365725f6163636573737c693a343b),
('89ogar248bmimsmk8kjlnfm036eo8lgb', '127.0.0.1', 1620721714, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632303732313731343b6c6f676765645f696e7c623a313b5f63695f70726576696f75735f75726c7c733a36363a22687474703a2f2f6c6f63616c686f73742f706c61666f722f7075626c69632f706c61666f722f61646d696e2f6c6973745f636f6d706574656e63655f646f6d61696e223b61667465725f6c6f67696e5f72656469726563747c733a33303a22687474703a2f2f6c6f63616c686f73742f706c61666f722f7075626c6963223b757365725f69647c693a313b757365726e616d657c733a353a2261646d696e223b757365725f6163636573737c693a343b),
('hmmfr2lbfgludriibrfellltt4ov8bnk', '127.0.0.1', 1620722278, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632303732323237383b6c6f676765645f696e7c623a313b5f63695f70726576696f75735f75726c7c733a36363a22687474703a2f2f6c6f63616c686f73742f706c61666f722f7075626c69632f706c61666f722f61646d696e2f6c6973745f636f6d706574656e63655f646f6d61696e223b61667465725f6c6f67696e5f72656469726563747c733a33303a22687474703a2f2f6c6f63616c686f73742f706c61666f722f7075626c6963223b757365725f69647c693a313b757365726e616d657c733a353a2261646d696e223b757365725f6163636573737c693a343b),
('pqms2amsbtgv27lkucdrnsh2kegv9adn', '127.0.0.1', 1620722832, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632303732323833323b6c6f676765645f696e7c623a313b5f63695f70726576696f75735f75726c7c733a36363a22687474703a2f2f6c6f63616c686f73742f706c61666f722f7075626c69632f706c61666f722f61646d696e2f6c6973745f636f6d706574656e63655f646f6d61696e223b61667465725f6c6f67696e5f72656469726563747c733a33303a22687474703a2f2f6c6f63616c686f73742f706c61666f722f7075626c6963223b757365725f69647c693a313b757365726e616d657c733a353a2261646d696e223b757365725f6163636573737c693a343b),
('pdaanfinpo087khsgmvm7iia32ukd5q7', '127.0.0.1', 1620723284, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632303732333238343b6c6f676765645f696e7c623a313b5f63695f70726576696f75735f75726c7c733a36363a22687474703a2f2f6c6f63616c686f73742f706c61666f722f7075626c69632f706c61666f722f61646d696e2f6c6973745f636f6d706574656e63655f646f6d61696e223b61667465725f6c6f67696e5f72656469726563747c733a33303a22687474703a2f2f6c6f63616c686f73742f706c61666f722f7075626c6963223b757365725f69647c693a313b757365726e616d657c733a353a2261646d696e223b757365725f6163636573737c693a343b),
('7pdcvblhssa3npif1rkc5thh30hr0btr', '127.0.0.1', 1620723793, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632303732333739333b6c6f676765645f696e7c623a313b5f63695f70726576696f75735f75726c7c733a36363a22687474703a2f2f6c6f63616c686f73742f706c61666f722f7075626c69632f706c61666f722f61646d696e2f6c6973745f636f6d706574656e63655f646f6d61696e223b61667465725f6c6f67696e5f72656469726563747c733a33303a22687474703a2f2f6c6f63616c686f73742f706c61666f722f7075626c6963223b757365725f69647c693a313b757365726e616d657c733a353a2261646d696e223b757365725f6163636573737c693a343b),
('u2t1tdjeo04ng2hg2muk4ac9llg6gc47', '127.0.0.1', 1620724383, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632303732343338333b6c6f676765645f696e7c623a313b5f63695f70726576696f75735f75726c7c733a36363a22687474703a2f2f6c6f63616c686f73742f706c61666f722f7075626c69632f706c61666f722f61646d696e2f6c6973745f636f6d706574656e63655f646f6d61696e223b61667465725f6c6f67696e5f72656469726563747c733a33303a22687474703a2f2f6c6f63616c686f73742f706c61666f722f7075626c6963223b757365725f69647c693a313b757365726e616d657c733a353a2261646d696e223b757365725f6163636573737c693a343b),
('ru8e1aba7d20jqplr6ld4fu3ghdheok1', '127.0.0.1', 1620724728, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632303732343732383b6c6f676765645f696e7c623a313b5f63695f70726576696f75735f75726c7c733a36363a22687474703a2f2f6c6f63616c686f73742f706c61666f722f7075626c69632f706c61666f722f61646d696e2f6c6973745f636f6d706574656e63655f646f6d61696e223b61667465725f6c6f67696e5f72656469726563747c733a33303a22687474703a2f2f6c6f63616c686f73742f706c61666f722f7075626c6963223b757365725f69647c693a313b757365726e616d657c733a353a2261646d696e223b757365725f6163636573737c693a343b),
('bgms7pj3kakjv4fs2svbk0rnvf55v36g', '127.0.0.1', 1620725108, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632303732353130383b6c6f676765645f696e7c623a313b5f63695f70726576696f75735f75726c7c733a36363a22687474703a2f2f6c6f63616c686f73742f706c61666f722f7075626c69632f706c61666f722f61646d696e2f6c6973745f636f6d706574656e63655f646f6d61696e223b61667465725f6c6f67696e5f72656469726563747c733a33303a22687474703a2f2f6c6f63616c686f73742f706c61666f722f7075626c6963223b757365725f69647c693a313b757365726e616d657c733a353a2261646d696e223b757365725f6163636573737c693a343b),
('7ao9jstrlgbpfij63v6udqtivih43bpt', '127.0.0.1', 1620725507, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632303732353530373b6c6f676765645f696e7c623a313b5f63695f70726576696f75735f75726c7c733a35393a22687474703a2f2f6c6f63616c686f73742f706c61666f722f7075626c69632f706c61666f722f61646d696e2f6c6973745f61707072656e74696365223b61667465725f6c6f67696e5f72656469726563747c733a33303a22687474703a2f2f6c6f63616c686f73742f706c61666f722f7075626c6963223b757365725f69647c693a313b757365726e616d657c733a353a2261646d696e223b757365725f6163636573737c693a343b),
('vfgpi9otrn8fi1uo8kp0al3bvkqjuvg2', '127.0.0.1', 1620726360, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632303732363336303b6c6f676765645f696e7c623a313b5f63695f70726576696f75735f75726c7c733a35393a22687474703a2f2f6c6f63616c686f73742f706c61666f722f7075626c69632f706c61666f722f61646d696e2f6c6973745f61707072656e74696365223b61667465725f6c6f67696e5f72656469726563747c733a33303a22687474703a2f2f6c6f63616c686f73742f706c61666f722f7075626c6963223b757365725f69647c693a313b757365726e616d657c733a353a2261646d696e223b757365725f6163636573737c693a343b),
('5ha39a1toesvlfup0e5ko8cv4hvn9dq0', '127.0.0.1', 1620729378, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632303732393337383b6c6f676765645f696e7c623a313b5f63695f70726576696f75735f75726c7c733a35393a22687474703a2f2f6c6f63616c686f73742f706c61666f722f7075626c69632f706c61666f722f61646d696e2f6c6973745f61707072656e74696365223b61667465725f6c6f67696e5f72656469726563747c733a33303a22687474703a2f2f6c6f63616c686f73742f706c61666f722f7075626c6963223b757365725f69647c693a313b757365726e616d657c733a353a2261646d696e223b757365725f6163636573737c693a343b),
('tb5go5nr444neneel1ogemdnd8m38g41', '127.0.0.1', 1620729828, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632303732393832383b6c6f676765645f696e7c623a313b5f63695f70726576696f75735f75726c7c733a35393a22687474703a2f2f6c6f63616c686f73742f706c61666f722f7075626c69632f706c61666f722f61646d696e2f6c6973745f61707072656e74696365223b61667465725f6c6f67696e5f72656469726563747c733a33303a22687474703a2f2f6c6f63616c686f73742f706c61666f722f7075626c6963223b757365725f69647c693a313b757365726e616d657c733a353a2261646d696e223b757365725f6163636573737c693a343b),
('dbtlv5stn9sp5sis3r2qoeohed2d5srg', '127.0.0.1', 1620730178, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632303733303137383b6c6f676765645f696e7c623a313b5f63695f70726576696f75735f75726c7c733a35393a22687474703a2f2f6c6f63616c686f73742f706c61666f722f7075626c69632f706c61666f722f61646d696e2f6c6973745f61707072656e74696365223b61667465725f6c6f67696e5f72656469726563747c733a33303a22687474703a2f2f6c6f63616c686f73742f706c61666f722f7075626c6963223b757365725f69647c693a313b757365726e616d657c733a353a2261646d696e223b757365725f6163636573737c693a343b),
('rihih82if836asho7bc04g1fg90coil7', '127.0.0.1', 1620730479, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632303733303437393b6c6f676765645f696e7c623a313b5f63695f70726576696f75735f75726c7c733a35393a22687474703a2f2f6c6f63616c686f73742f706c61666f722f7075626c69632f706c61666f722f61646d696e2f6c6973745f61707072656e74696365223b61667465725f6c6f67696e5f72656469726563747c733a33303a22687474703a2f2f6c6f63616c686f73742f706c61666f722f7075626c6963223b757365725f69647c693a313b757365726e616d657c733a353a2261646d696e223b757365725f6163636573737c693a343b),
('13uldti1vleg3cg1dptmtsqpaj5ukc1e', '127.0.0.1', 1620730948, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632303733303934383b6c6f676765645f696e7c623a313b5f63695f70726576696f75735f75726c7c733a35393a22687474703a2f2f6c6f63616c686f73742f706c61666f722f7075626c69632f706c61666f722f61646d696e2f6c6973745f61707072656e74696365223b61667465725f6c6f67696e5f72656469726563747c733a33303a22687474703a2f2f6c6f63616c686f73742f706c61666f722f7075626c6963223b757365725f69647c693a313b757365726e616d657c733a353a2261646d696e223b757365725f6163636573737c693a343b),
('db046jsdu3h94vvfn80ajpuqf27eaopr', '127.0.0.1', 1620732400, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632303733323430303b6c6f676765645f696e7c623a313b5f63695f70726576696f75735f75726c7c733a35393a22687474703a2f2f6c6f63616c686f73742f706c61666f722f7075626c69632f706c61666f722f61646d696e2f6c6973745f61707072656e74696365223b61667465725f6c6f67696e5f72656469726563747c733a33303a22687474703a2f2f6c6f63616c686f73742f706c61666f722f7075626c6963223b757365725f69647c693a313b757365726e616d657c733a353a2261646d696e223b757365725f6163636573737c693a343b),
('1dcv7dc5k8jl2u09igc7tok7dtp5edjg', '127.0.0.1', 1620732490, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632303733323430303b6c6f676765645f696e7c623a313b5f63695f70726576696f75735f75726c7c733a35393a22687474703a2f2f6c6f63616c686f73742f706c61666f722f7075626c69632f706c61666f722f61646d696e2f6c6973745f61707072656e74696365223b61667465725f6c6f67696e5f72656469726563747c733a33303a22687474703a2f2f6c6f63616c686f73742f706c61666f722f7075626c6963223b757365725f69647c693a313b757365726e616d657c733a353a2261646d696e223b757365725f6163636573737c693a343b);

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `fk_trainer` int(11) NOT NULL,
  `fk_acquisition_status` int(11) NOT NULL,
  `comment` text NOT NULL,
  `date_creation` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `competence_domain`
--

CREATE TABLE `competence_domain` (
  `id` int(11) NOT NULL,
  `fk_course_plan` int(11) NOT NULL,
  `symbol` varchar(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `archive` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `competence_domain`
--

INSERT INTO `competence_domain` (`id`, `fk_course_plan`, `symbol`, `name`, `archive`) VALUES
(1, 1, 'A', 'Saisie, interprétation et mise en œuvre des exigences des applications', NULL),
(2, 1, 'B', 'Développement d’applications en tenant compte des caractéristiques de qualité', NULL),
(3, 1, 'C', 'Création et maintenance de données ainsi que de leurs structures ', NULL),
(4, 1, 'D', ' Mise en service d’appareils TIC', NULL),
(5, 1, 'E', 'Travail sur des projets', NULL),
(6, 2, 'AA', 'Mise en service d’appareils TIC', NULL),
(7, 2, 'B', 'Mise en service de serveurs et réseaux', NULL),
(8, 2, 'C', 'Garantie de l’exploitation TIC ', NULL),
(9, 2, 'D', 'Assistance aux utilisateurs', NULL),
(10, 2, 'E', 'Développement d’applications en tenant compte des caractéristiques de qualité', NULL),
(11, 2, 'F', 'Travaux dans le cadre de projets', NULL),
(12, 3, 'A', 'Mise en service d’appareils TIC', NULL),
(13, 3, 'B', 'Planification, installation, et configuration des réseaux', NULL),
(14, 3, 'C', 'Planification, installation, et configuration des serveurs', NULL),
(15, 3, 'D', 'Maintenance de réseaux et serveurs', NULL),
(16, 3, 'E', 'Travail sur des projets', NULL),
(17, 4, 'A', 'Installation, mise en service et maintenance de terminaux ICT utilisateurs', NULL),
(18, 4, 'B', 'Garantie du bon fonctionnement de l’exploitation de terminaux ICT utilisateurs en réseau', NULL),
(19, 4, 'C', 'Soutien des utilisateurs dans la mise en œuvre des moyens ICT', NULL),
(20, 4, 'D', 'Déroulement de travaux de support ICT', NULL),
(21, 1, 'XXX', 'TEST1', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `course_plan`
--

CREATE TABLE `course_plan` (
  `id` int(11) NOT NULL,
  `formation_number` varchar(5) NOT NULL,
  `official_name` varchar(100) NOT NULL,
  `date_begin` date NOT NULL,
  `archive` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `course_plan`
--

INSERT INTO `course_plan` (`id`, `formation_number`, `official_name`, `date_begin`, `archive`) VALUES
(1, '88601', ' Informaticien/-ne CFC Développement d\'applications', '2014-08-01', NULL),
(2, '88602', ' Informaticien/-ne CFC Informatique d\'entreprise', '2014-08-01', NULL),
(3, '88603', ' Informaticien/-ne CFC Technique des systèmes', '2014-08-01', NULL),
(4, '88605', ' Opératrice en informatique / Opérateur en informatique CFC', '2018-08-01', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `objective`
--

CREATE TABLE `objective` (
  `id` int(11) NOT NULL,
  `fk_operational_competence` int(11) NOT NULL,
  `symbol` varchar(10) NOT NULL,
  `taxonomy` int(5) NOT NULL,
  `name` varchar(350) NOT NULL,
  `archive` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `objective`
--

INSERT INTO `objective` (`id`, `fk_operational_competence`, `symbol`, `taxonomy`, `name`, `archive`) VALUES
(1, 1, 'A.1.1', 4, 'Enregistrer les besoins et discuter les solutions possibles, s’entretenir avec le client/supérieur sur les restrictions des exigences', NULL),
(2, 1, 'A.1.2', 4, ' Confirmer les exigences en ses propres termes (traiter et en déduire, lister les questions)', NULL),
(3, 1, 'A.1.3', 3, 'Eclaircir toutes les questions de la liste (questions sur les solutions, l’environnement, les dépendances, estimation temporelle)', NULL),
(4, 1, 'A.1.4', 4, 'Présenter les exigences de manière structurée (par ex. avec UML), élaborer le cahier des charges et le subdiviser en types d‘exigences', NULL),
(5, 1, 'A.1.5', 4, 'Vérifier avec le mandant la solution concernant l’exhaustivité, ainsi que la clarté, et conclure par une confirmation écrite', NULL),
(6, 2, 'A.2.1', 4, 'Elaborer aussi loin que possibles plusieurs variantes de solutions en regard des exigences et de la satisfaction du client (par ex. dans le GUI ou sur la plateforme (PC, tablette))', NULL),
(7, 2, 'A.2.2', 4, 'Représenter des comparaisons de variantes et d‘évaluations (y compris, produits), conseiller la clientèle dans le choix (avantages, désavantages, problèmes de la solution) sur la base de leur analyse des valeurs utiles', NULL),
(8, 2, 'A.2.3', 4, 'Choisir une procédure de résolution des problèmes, par ex. développement de prototypes, recherche de solutions de ce qui peut être résolu avec l’informatique, ou autres moyens tels qu’organisation ou formation', NULL),
(9, 3, 'A.3.1', 4, 'Vérifier si toutes les exigences ont été reprises et remplies avec la solution choisie', NULL),
(10, 3, 'A.3.2', 3, 'Ecrire une offre, sur la base de leur planification, pour la réalisation et l’introduction de la nouvelle application', NULL),
(11, 3, 'A.3.3', 3, 'Obtenir la confirmation et la distribution du mandat du client', NULL),
(12, 4, 'B.1.1', 5, 'Elaborer un concept de tests comme base pour un développement efficace et l’assurance qualité d’une nouvelle application', NULL),
(13, 4, 'B.1.2', 5, 'Appliquer des méthodes pour la détermination de cas de tests', NULL),
(14, 4, 'B.1.3', 3, 'Mettre à disposition, sauvegarder et documenter les données des tests', NULL),
(15, 4, 'B.1.4', 3, 'Elaborer et exécuter des cas de tests (Blackbox), automatiser dans les cas possible', NULL),
(16, 4, 'B.1.5', 3, 'Saisir les résultats dans un protocole de tests en vue d’une répétition', NULL),
(17, 4, 'B.1.6', 4, 'Evaluer les résultats des tests et, le cas échéant, en déduire des mesures', NULL),
(18, 4, 'B.1.7', 4, 'Garantir que toutes les fonctions ont été testées et que les éventuelles erreurs ont été corrigées', NULL),
(19, 5, 'B.2.1', 4, 'Résoudre les prescriptions d’entreprises avec des directives techniques (web, mobile, desktop, automates)', NULL),
(20, 5, 'B.2.2', 4, 'Appliquer des modèles d’architecture dans les solutions (Multitier, Frameworks, Patterns)', NULL),
(21, 5, 'B.2.3', 3, 'Satisfaire des exigences non-fonctionnelles telles que temps de réponse, stabilité, disponibilité', NULL),
(22, 5, 'B.2.4', 3, 'Prise en compte de standards internationaux et spécifiques à l’entreprise dans le cadre des solutions', NULL),
(23, 6, 'B.3.1', 4, 'Fonctionnalité conviviales, par ex. la même fonction déclenche toujours la même action, lorsque l’on feuillette, les informations introduites restent, etc ', NULL),
(24, 6, 'B.3.2', 4, 'Evaluation des modes de déroulement et des applications appropriées', NULL),
(25, 6, 'B.3.3', 4, 'Programmer les applications en tenant compte des suites de tests, de débogage, de dépannage, de maintenance, d’efficience énergétique, de la protection des données, des règles en termes de licences, etc. et documenter de manière continue', NULL),
(26, 6, 'B.3.4', 3, 'Utiliser des standards et processus de développement', NULL),
(27, 6, 'B.3.5', 3, 'Appliquer des méthodes de projets (PAP, Jackson, diagramme d‘état, diagramme de classe) et les Software design-Patterns', NULL),
(28, 6, 'B.3.6', 3, 'Respecter la convention des codes', NULL),
(29, 6, 'B.3.7', 3, 'Editer, documenter du code source (par ex. code en ligne, ..) et documenter en vue de faciliter la maintenance', NULL),
(30, 6, 'B.3.8', 3, 'Tester l’application et tout documenter', NULL),
(31, 7, 'B.4.1', 4, 'Prendre en compte des exigences standards et ergonomiques, voir et toucher. Atteindre un bon effet convivial lors de l’utilisation des nouvelles applications', NULL),
(32, 7, 'B.4.2', 3, 'Prendre en compte les CD/CI (Corporate Design/Corporate identity)', NULL),
(33, 7, 'B.4.3', 3, 'Développer de manière conviviale, validation des champs de saisie, aide à la saisie des entrées', NULL),
(34, 7, 'B.4.4', 3, 'Codage GUI convivial, séparation des éléments utilisateurs du code', NULL),
(35, 7, 'B.4.5', 3, 'Prendre en compte les conditions de communication, par ex. communication asynchrone et veiller à de bonnes performances', NULL),
(36, 7, 'B.4.6', 3, 'Tester l’application de manière exhaustive et tout documenter', NULL),
(37, 8, 'B.5.1', 3, 'Organiser des tests systèmes, des tests de remise, des tests nonfonctionnels, des tests négatifs pour lesquels il faut préparer des données de test, documenter le tout', NULL),
(38, 8, 'B.5.2', 3, 'Respecter les standards', NULL),
(39, 8, 'B.5.3', 4, 'Elaborer la documentation technique pour les utilisateurs, et l’exploitation', NULL),
(40, 8, 'B.5.4', 4, 'Organiser des révisions en phase, déroulement itératif afin de respecter la planification temporel et de qualité', NULL),
(41, 9, 'B.6.1', 4, 'Planifier l’introduction avec la procédure définie, y compris, l’assurance, le cas échéant, d’un retour à la situation initiale en cas de besoin', NULL),
(42, 9, 'B.6.2', 3, 'Organiser et transmettre la migration des données avec les éventuelles conversions nécessaires', NULL),
(43, 9, 'B.6.3', 3, 'Préparer la remise de la production', NULL),
(44, 9, 'B.6.4', 3, 'Organiser en temps voulu l’instruction et l’information des utilisateurs', NULL),
(45, 10, 'C.1.1', 4, 'Identifier des entités et leurs relations, en élaborer un modèle en plusieurs niveaux d‘abstraction (normaliser)', NULL),
(46, 10, 'C.1.2', 4, 'Décrire des entités et déterminer des types de données', NULL),
(47, 10, 'C.1.3', 4, 'Convertir les exigences dans des modèles standards de notation (UML, ERD etc.)', NULL),
(48, 10, 'C.1.4', 4, 'Formuler des données adéquates de test (tenir compte des conditions limites)', NULL),
(49, 11, 'C.2.1', 4, 'Choisir un modèle approprié de base de données (relationnelle, hiérarchique, etc.) et déterminer le produit (DBMS)', NULL),
(50, 11, 'C.2.2', 4, 'Elaborer le modèle physique (par ex. DDL, Referential Integrity, Constraints) et dénormaliser (Performance)', NULL),
(51, 11, 'C.2.3', 4, 'Exécuter les tests de charge et de performance, optimiser en conséquence et assurer la possibilité de maintenance', NULL),
(52, 11, 'C.2.4', 3, 'Assurer la sécurité des données (sauvegarde, disponibilité, etc.) et la protection des données (e.a. les droits d’accès)', NULL),
(53, 11, 'C.2.5', 4, 'Planifier et exécuter la migration de données', NULL),
(54, 12, 'C.3.1', 3, 'Déterminer les interfaces et technologies d‘accès (par ex. SQL statiques/dynamiques, ADO, HQL, OR-Mapper, Stored Procedures, etc.)', NULL),
(55, 12, 'C.3.2', 4, 'Appliquer le concept de transaction et programmer l’accès aux données', NULL),
(56, 12, 'C.3.3', 4, 'Vérifier l’accès des données en performance et exigences, le cas échéant, optimiser', NULL),
(57, 12, 'C.3.4', 4, 'Faire le test de remise et vérifier les résultats, au besoin, entreprendre les mesures nécessaires', NULL),
(58, 13, 'D.1.1', 3, 'Remarques: comme ces activités ne peuvent pas être effectuées dans toutes les entreprises formatrices, il n’y a pas d’objectifs évaluateurs obligatoires qui sont fixés. Toutes les actions ont lieu dans le cadre des cours interentreprises', NULL),
(59, 14, 'E.1.1', 4, 'Analyser la quantité de travail sur la base des documents existants et élaborer une planification du travail', NULL),
(60, 14, 'E.1.2', 3, 'Prendre les mesures de préparation en vue de la résolution, élaborer les checklist et la planification, documenter le déroulement, élaborer la liste de matériel, etc', NULL),
(61, 14, 'E.1.3', 3, 'Procurer les droits d’accès, les licences, etc. et mettre à disposition l’environnement de travail', NULL),
(62, 14, 'E.1.4', 4, 'Exécuter les tâches conformément à la planification, déterminer régulièrement l’état du projet et en rapporter', NULL),
(63, 14, 'E.1.5', 3, 'Tester toutes les fonctions et installations de manière conséquente durant le travail, et les documenter selon des standards', NULL),
(64, 14, 'E.1.6', 4, 'Instruire les utilisateurs et élaborer à cet effet une bonne documentation technique', NULL),
(65, 14, 'E.1.7', 3, 'Assurer la remontée des données du client, des tests et systèmes, etc', NULL),
(66, 15, 'E.2.1', 3, 'Présenter les méthodes de gestion de projets de l’entreprise', NULL),
(67, 15, 'E.2.2', 4, 'Organiser le travail selon les méthodes usuelles de gestion de projets dans l’entreprise, et élabore une planification réaliste en temps et ressources', NULL),
(68, 15, 'E.2.3', 3, 'Définir et distribuer des tâches partielles, respectivement prendre en charge de telles tâches et les exécuter', NULL),
(69, 15, 'E.2.4', 3, 'Présenter et démontrer des solutions', NULL),
(70, 15, 'E.2.5', 4, 'Elaborer le rapport final du projet (Réflexion en méthodes, déroulement, temps et ressources)', NULL),
(71, 15, 'E.2.6', 4, 'Refléter le travail du projet et assurer le transfert des connaissances', NULL),
(72, 16, 'E.3.1', 3, 'Communiquer dans le cadre du projet avec toutes les personnes concernées par le biais de contacts réguliers et discussions sur l’avancement des travaux, les interfaces, les nouvelles solutions, les problèmes', NULL),
(73, 16, 'E.3.2', 5, 'Entretiens par des contacts réguliers et discussions avec les clients, respectivement le mandant, sur les souhaits, les questions et besoins, vérifier à l’aide de questions ciblées si les souhaits ont été correctement et précisément saisis', NULL),
(74, 17, 'A.1.1', 4, 'Etre capable de recevoir, comprendre, planifier et mettre en œuvre un mandat client (organisation, méthodologie, ergonomie, optimisation de l’énergie)', NULL),
(75, 17, 'A.1.2', 4, 'Evaluation et acquisition de matériel et logiciels appropriés, et les présenter à son supérieur. Après quoi, ils acquièrent le tout, y compris les licences nécessaires', NULL),
(76, 17, 'A.1.3', 3, 'Pouvoir entreprendre des configurations de base en tenant compte des mesures de sécurité et de protection des données y.c. le filtrage des contenus, malware, et virus), pouvoir prendre comme aide un ouvrage de référence avec un langage standard et une langue supplémentaire (D/E ou F/I/E)', NULL),
(77, 17, 'A.1.4', 3, 'Pouvoir insérer des composants TIC dans des réseaux selon directives et avec des connaissances sur les technologies actuelles', NULL),
(78, 17, 'A.1.5', 3, 'Pouvoir installer, manuellement ou automatiquement, des applications selon directives du client en tenant compte des systèmes environnants et des aspects techniques des licences, ainsi que migrer des données', NULL),
(79, 17, 'A.1.6', 3, 'Mettre hors service des composants TIC et les éliminer professionnellement en tenant compte de la protection des données, des lignes directrices et des procédures d’entreprise', NULL),
(80, 17, 'A.1.7', 6, 'Contrôle des fonctions et remise au client (test final et protocole de remise)', NULL),
(81, 18, 'A.2.1', 4, 'Etre capable de recevoir un mandat client, planifier la mise en œuvre (organisation, méthodologie, ergonomie, optimisation énergétique)', NULL),
(82, 18, 'A.2.2', 4, 'Entreprendre l’évaluation et l’acquisition de matériel et logiciels appropriés en tenant compte des prescriptions et des compatibilités de l‘entreprise (y.c. licences), et les présenter à son supérieur', NULL),
(83, 18, 'A.2.3', 3, 'Acquérir le matériel, les logiciels et les licences', NULL),
(84, 18, 'A.2.4', 3, 'Entreprendre des configurations de base et pouvoir implémenter des services de base (par ex. accès distant, synchronisation des données, etc.) en tenant compte des mesures de sécurité et de protection des données', NULL),
(85, 18, 'A.2.5', 3, 'Tester et documenter la configuration/disponibilité et fonctionnalité de la nouvelle installation', NULL),
(86, 19, 'A.3.1', 4, 'Etre capable de recevoir, comprendre, planifier et mettre en œuvre un mandat client (organisation, méthodologie)', NULL),
(87, 19, 'A.3.2', 4, 'Evaluation et acquisition des appareils appropriés (imprimante, copieur, NAS, appareils multimédia, etc.) en tenant compte des prescriptions et des compatibilités de l‘entreprise, et les présenter à son supérieur', NULL),
(88, 19, 'A.3.3', 3, 'Acquérir les appareils et entreprendre les configurations de base (accès, droits, acomptes, rapports etc.)', NULL),
(89, 19, 'A.3.4', 3, 'Tester et documenter la configuration/disponibilité et la fonctionnalité des nouveaux matériels et logiciels installés', NULL),
(90, 19, 'A.3.5', 3, 'Instruire les utilisateurs sur le maniement et les caractéristiques des nouveaux appareils', NULL),
(91, 20, 'B.1.1', 4, 'Clarifier et régler la situation et l’accès, rack, énergie électrique, besoins de climatisation, UPS, connexion au réseau, respectivement les faire installer', NULL),
(92, 20, 'B.1.2', 3, 'acquérir le matériel et logiciels, entreprendre les configurations et services de base des serveurs (par ex. DHCP, DNS, accès distant, etc.) en tenant compte des mesures de sécurité et de protection des données, pouvoir prendre comme aide un ouvrage de référence avec un langage standard et une langue supplémentaire (D/E ou F/I/E)', NULL),
(93, 20, 'B.1.3', 3, 'Tester et documenter la configuration/disponibilité et la fonctionnalité des nouveaux matériels et logiciels installés', NULL),
(94, 21, 'B.2.1', 4, 'Ingénierie des besoins: reconnaître et classer les besoins du client y.c. de la sécurité, transférer sur la topologie du réseau en tenant compte des avantages et inconvénients d’une solution, possibilité d’extension, maintenance, prix, distance, etc', NULL),
(95, 21, 'B.2.2', 4, 'Planification et concept de la structure réseau appropriée (Provider, WLAN, Switch, Router etc.) en tenant compte des besoins en largeur de bande, des médias, de la disponibilité et des services (Voice, unified Communication, Video, etc.), présenter la solution au supérieur', NULL),
(96, 21, 'B.2.3', 3, 'Installer, mettre en réseau et configurer des composants (par ex. VLAN, Routing)', NULL),
(97, 21, 'B.2.4', 3, 'Visualiser et documenter les réseaux et leur topologie', NULL),
(98, 22, 'B.3.1', 4, 'Conseil à la clientèle en regard de la sécurité et l’archivage des données, recueillir et analyser les besoins du client et, au besoin, aviser sur les effets du risque', NULL),
(99, 22, 'B.3.2', 4, 'Elaboration d’un concept en tenant compte de toutes les contraintes telles que les besoins de l’entreprise, les règles légales, sécurité et protection des données, les us et coutumes de la branche, les médias, les performances et la durée de vie', NULL),
(100, 22, 'B.3.3', 3, 'Installation des systèmes en tenant compte des précautions nécessaires de sécurité (droits d’accès, sécurité des données, reprise après sinistre), performance, et installer la disponibilité', NULL),
(101, 22, 'B.3.4', 3, 'Tester, valider et exécuter la restauration des données, documenter le travail', NULL),
(102, 23, 'C.1.1', 3, 'Lire et interpréter des schémas (plan électrique, plan réseau) et pouvoir documenter les modifications exécutées', NULL),
(103, 23, 'C.1.2', 3, 'Surveiller et administrer le réseau (monitoring: performance, flux de données, stabilité, malware, firewall, etc.)', NULL),
(104, 23, 'C.1.3', 4, 'Poursuivre les incohérences et, le cas échéant, proposer des mesures appropriées, resp. les prendre selon les directives de l’entreprise', NULL),
(105, 23, 'C.1.4', 3, 'Concevoir et réaliser des extensions réseau en tenant compte des coûts d’acquisition et d’exploitation et éliminer dans les règles les appareils remplacés', NULL),
(106, 23, 'C.1.5', 3, 'Découvrir et éliminer toutes les pannes possibles de connexion (switchs, routeurs, etc.), y.c. mettre en œuvre des scénarios de secours selon checklist', NULL),
(107, 24, 'C.2.1', 3, 'Exécuter les tâches régulières de maintenance, d’entretien et de surveillance (journalières, hebdomadaires, mensuelles, etc.), y.c. l’exécution régulière de mise à jour, contrôle de génération, ressources selon un déroulement par checklist', NULL),
(108, 24, 'C.2.2', 3, 'Assurer la sécurité système et d’exploitation. Respecter les droits, vérifier les règles d’authentification et d’autorisation et les mettre en œuvre de manière conséquente', NULL),
(109, 24, 'C.2.3', 3, 'Surveiller des services de serveurs (par ex. gestion des logfiles, queues d‘impression, messagerie/données, etc.) et entreprendre les mesures nécessaires', NULL),
(110, 24, 'C.2.4', 3, 'Installation et configuration des services de communication et groupeware (par ex.sharepoint, Lotus Notes, etc.), gestion des délais, des tâches et des documents', NULL),
(111, 24, 'C.2.5', 3, 'Tester et documenter la fonctionnalité, les performances et la sécurité des systèmes', NULL),
(112, 25, 'C.3.1', 4, 'Accueillir, comprendre, planifier et mettre en œuvre un mandat client (organisation, méthodologie)', NULL),
(113, 25, 'C.3.2', 4, 'Concept des droits d’accès y.c. élaborer le partage en tenant compte des exigences de la communication en réseau (applications d’impression, de téléphonie, VPN, spécifiques à l’entreprise)', NULL),
(114, 25, 'C.3.3', 3, 'Installer, mettre en œuvre et ajuster aux spécificités du client un service d’annuaire en tenant compte de la protection et de la sécurité des données ainsi que des conditions d’accès', NULL),
(115, 25, 'C.3.4', 3, 'Tester et documenter la fonctionnalité', NULL),
(116, 26, 'C.4.1', 4, 'Accueillir, comprendre et planifier un mandat du client, planifier la mise en œuvre (organisation, méthodologie)', NULL),
(117, 26, 'C.4.2', 4, 'Elaborer un concept de la performance et des interfaces en tenant compte de toutes les dépendances des services disponibles, y.c. les questions de droits d’accès et logiciels appropriés', NULL),
(118, 26, 'C.4.3', 3, 'Installer les services de communication et groupeware (par ex. serveur de messagerie, serveur VOIP, DMS, etc.) en tenant compte des précautions nécessaires de sécurité (protection virale, filtrage des contenus et spams), de performance et de disponibilité', NULL),
(119, 26, 'C.4.4', 3, 'Tester et documenter la configuration, la disponibilité, la fonctionnalité du matériel et logiciels nouvellement installés', NULL),
(120, 27, 'D.1.1', 4, 'Introduction de nouveaux collaborateurs dans la structure TIC de l’entreprise, instruire les clients/collaborateurs lors de l’introduction de nouveaux matériels et logiciels, ainsi que de nouveaux outils', NULL),
(121, 27, 'D.1.2', 3, 'Conseiller et soutenir les utilisateurs lors de la mise en œuvre d’automatisations bureautiques (par ex. mise en place de nouveaux outils, ou macros pour simplifier les tâches)', NULL),
(122, 27, 'D.1.3', 3, 'Expliquer les particularités spécifiques à l’entreprise dans le comportement avec les données et les lignes directrices de la sécurité', NULL),
(123, 27, 'D.1.4', 3, 'Elaborer la documentation pour les utilisateurs', NULL),
(124, 28, 'D.2.1', 3, 'Accueillir et saisir les demandes et problèmes des clients, poser les bonnes questions, afin de cerner et résoudre rapidement le problème', NULL),
(125, 28, 'D.2.2', 3, 'Support téléphonique ou par accès distant, si nécessaire sur place chez les utilisateurs, poser des questions ciblées en cas de problèmes techniques', NULL),
(126, 28, 'D.2.3', 3, 'Conseiller les utilisateurs sur la manière de résoudre un problème ou comment ils peuvent faciliter leurs activités avec de nouveaux outils', NULL),
(127, 28, 'D.2.4', 3, 'Expliquer au client le comportement avec les données et les lignes directrices de la sécurité', NULL),
(128, 29, 'E.1.1', 3, 'Elaborer un concept de tests comme base pour un développement efficace et l’assurance qualité d’une nouvelle application', NULL),
(129, 29, 'E.1.2', 4, 'Appliquer des méthodes pour la détermination de cas de tests', NULL),
(130, 29, 'E.1.3', 3, 'Mettre à disposition, sauvegarder et documenter les données des tests', NULL),
(131, 29, 'E.1.4', 3, 'Elaborer et exécuter des cas de tests (Blackbox), automatiser dans les cas possible', NULL),
(132, 29, 'E.1.5', 3, 'Saisir les résultats dans un protocole de tests en vue d’une répétition', NULL),
(133, 29, 'E.1.6', 3, 'Evaluer les résultats des tests et, le cas échéant, en déduire des mesures', NULL),
(134, 29, 'E.1.7', 3, 'Garantir que toutes les fonctions ont été testées et que les éventuelles erreurs ont été corrigées', NULL),
(135, 30, 'E.2.1', 4, 'Fonctionnalité conviviales, par ex. la même fonction déclenche toujours la même action, lorsque l’on feuillette, les informations introduites restent, etc', NULL),
(136, 30, 'E.2.2', 4, 'Evaluation des modes de déroulement et des applications appropriées', NULL),
(137, 30, 'E.2.3', 4, 'Programmer les applications en tenant compte des suites de tests, de débogage, de dépannage, de maintenance, etc. et documenter de manière continue', NULL),
(138, 30, 'E.2.4', 3, 'Utiliser des standards et processus de développement', NULL),
(139, 30, 'E.2.5', 3, 'Appliquer des méthodes de projets (PAP, Jackson, diagramme d‘état, diagramme de classe) et les Softwaredesign-Patterns', NULL),
(140, 30, 'E.2.6', 3, 'Respecter la convention des codes', NULL),
(141, 30, 'E.2.7', 3, 'Editer, documenter du code source (par ex. code en ligne, ..) et documenter en vue de faciliter la maintenance', NULL),
(142, 30, 'E.2.8', 3, 'Tester l’application et tout documenter', NULL),
(143, 31, 'E.3.1', 4, 'Prendre en compte des exigences standards et ergonomiques, voir et toucher. Atteindre un bon effet convivial lors de l’utilisation des nouvelles applications', NULL),
(144, 31, 'E.3.2', 3, 'Prendre en compte les CD/CI (Corporate Design/Corporate identity)', NULL),
(145, 31, 'E.3.3', 3, 'Développer de manière conviviale, validation des champs de saisie, aide à la saisie des entrées', NULL),
(146, 31, 'E.3.4', 3, 'Codage GUI convivial, séparation des éléments utilisateurs du code', NULL),
(147, 31, 'E.3.5', 3, 'Prendre en compte les conditions de communication, par ex. communication asynchrone et veiller à de bonnes performances', NULL),
(148, 31, 'E.3.6', 3, 'Tester l’application de manière exhaustive et tout documenter', NULL),
(149, 32, 'E.4.1', 4, 'Choisir un modèle approprié de base de données (relationnelle, hiérarchique, etc.) et déterminer le produit (DBMS)', NULL),
(150, 32, 'E.4.2', 3, 'Elaborer le modèle physique (par ex. DDL, Referential Integrity, Constraints) et dénormaliser (Performance)', NULL),
(151, 32, 'E.4.3', 3, 'Exécuter les tests de charge et de performance, optimiser en conséquence et assurer la possibilité de maintenance', NULL),
(152, 32, 'E.4.4', 3, 'Assurer la sécurité des données (sauvegarde, disponibilité, etc.) et la protection des données (e.a. les droits d’accès)', NULL),
(153, 32, 'E.4.5', 4, 'Planifier et exécuter la migration de données', NULL),
(154, 33, 'E.5.1', 3, 'Déterminer les interfaces et technologies d‘accès (par ex. SQL statiques/dynamiques, ADO, HQL, OR-Mapper, Stored Procedures, etc.)', NULL),
(155, 33, 'E.5.2', 3, 'Appliquer le concept de transaction et programmer l’accès aux données', NULL),
(156, 33, 'E.5.3', 3, 'Vérifier l’accès des données en performance et exigences, le cas échéant, optimiser', NULL),
(157, 33, 'E.5.4', 4, 'Faire le test de remise et vérifier les résultats, au besoin, entreprendre les mesures nécessaires', NULL),
(158, 34, 'F.1.1', 3, 'Analyser et comprendre l’étendue de travail, élaborer une planification des travaux', NULL),
(159, 34, 'F.1.2', 3, 'Prendre les mesures de préparation en vue de la résolution, élaborer les checklist et la planification, documenter le déroulement, élaborer la liste de matériel, etc', NULL),
(160, 34, 'F.1.3', 3, 'Acquérir et ordonner du matériel, le préparer pour l’installation, etc. y.c. les solutions de secours', NULL),
(161, 34, 'F.1.4', 3, 'Exécuter les tâches, conformément à la planification, efficacement de pas à pas', NULL),
(162, 34, 'F.1.5', 3, 'Planifier et exécuter des tests, lesquels seront documentés dans l’inventaire des nouvelles installations', NULL),
(163, 34, 'F.1.6', 3, 'Remettre l’installation et faire signer le protocole de remise au client', NULL),
(164, 34, 'F.1.7', 3, 'Instruire les utilisateurs sur les modifications de leurs applications', NULL),
(165, 35, 'F.2.1', 4, 'Analyser et comprendre l’étendue de travail de sa propre contribution, élaborer une planification des travaux en tenant compte des ressources disponibles', NULL),
(166, 35, 'F.2.2', 3, 'Elaborer le mandat selon les directives en termes de délai et dans le cadre du budget, subdiviser les résultats dans le projet global', NULL),
(167, 35, 'F.2.3', 3, 'Informer constamment la direction de projet de sa propre initiative sur les modifications et déviations', NULL),
(168, 35, 'F.2.4', 3, 'Elaborer la documentation du projet, les rapports, la correspondance du projet, etc. selon directives', NULL),
(169, 35, 'F.2.5', 3, 'Mettre à disposition des collègues ses propres expériences issues du projet', NULL),
(170, 36, 'F.3.1', 3, 'Communiquer dans le cadre du projet avec toutes les personnes concernées par le biais de contacts réguliers et discussions sur l’avancement des travaux, les interfaces, les nouvelles solutions, les problèmes', NULL),
(171, 36, 'F.3.2', 3, 'Entretiens par des contacts réguliers et discussions avec les clients, respectivement le mandant, sur les souhaits, les questions et besoins, vérifier à l’aide de questions ciblées si les souhaits ont été correctement et précisément saisis', NULL),
(177, 42, 'A.1.1', 4, 'Etre capable de recevoir, comprendre, planifier et mettre en œuvre un mandat client (organisation, méthodologie, ergonomie, optimisation de l’énergie)', NULL),
(178, 42, 'A.1.2', 4, 'Évaluation et acquisition de matériel et logiciels appropriés, et les présenter à son supérieur', NULL),
(179, 42, 'A.1.3', 3, 'Pouvoir entreprendre des configurations de base en tenant compte des mesures de sécurité et de protection des données y.c. le filtrage des contenus, malware, et virus), pouvoir prendre comme aide un ouvrage de référence avec un langage standard et une langue supplémentaire (D/E ou F/I/E)', NULL),
(180, 42, 'A.1.4', 3, 'Pouvoir insérer des composants TIC dans des réseaux selon directives et avec des connaissances sur les technologies actuelles', NULL),
(181, 42, 'A.1.5', 3, 'Pouvoir installer, manuellement ou automatiquement, des applications selon directives du client en tenant compte des systèmes environnants et des aspects techniques des licences, ainsi que migrer des données', NULL),
(182, 42, 'A.1.6', 3, 'Mettre hors service des composants TIC et les éliminer professionnellement en tenant compte de la protection des données, des lignes directrices et des procédures d’entreprise', NULL),
(183, 42, 'A.1.7', 3, 'Contrôle des fonctions et remise au client (test final et protocole de remise)', NULL),
(184, 42, 'A.1.8', 4, 'Exécuter un contrôle fonctionnel pour l’assurance qualité, et remise de la nouvelle installation au client (contrôle final, protocole de remise)', NULL),
(185, 43, 'A.2.1', 4, 'Accueillir le mandat du client et planifier la mise en œuvre\r\n(organisation, méthodes de travail, optimisation de l’énergie)', NULL),
(186, 43, 'A.2.2', 4, 'Choisir le matériel et logiciels appropriés en tenant compte\r\ndes directives matérielles (y compris, les exigences de la virtualisation), présenter des propositions de solutions au supérieur', NULL),
(187, 43, 'A.2.3', 4, 'Clarifier et régler la situation et l’accès, rack, énergie électrique, besoins de climatisation, UPS, connexion au réseau, respectivement les faire installer', NULL),
(188, 43, 'A.2.4', 3, 'Acquérir le matériel et logiciels, entreprendre les configurations et services de base des serveurs (par ex. DHCP, DNS, accès distant, etc.) en tenant compte des mesures de sécurité et de protection des données, pouvoir prendre comme aide un ouvrage de référence avec un langage standard et une langue supplémentaire (D/E ou F/I/E)', NULL),
(189, 43, 'A.2.5', 3, 'Tester et documenter la configuration/disponibilité et la fonctionnalité des nouveaux matériels et logiciels installés', NULL),
(190, 44, 'A.3.1', 4, 'Accueillir le mandat du client et planifier la mise en œuvre (organisation, méthodes de travail, optimisation de l’énergie)', NULL),
(191, 44, 'A.3.2', 4, 'Evaluer et acquérir les composants réseaux appropriés en tenant compte des besoins en largeur de bande, des moyens, des prérequis et compatibilité du matériel. Présenter la solution au supérieur', NULL),
(192, 44, 'A.3.3', 3, 'Clarifier et régler la situation et l’accès, rack, énergie électrique, besoins de climatisation, UPS, connexion au réseau', NULL),
(193, 44, 'A.3.4', 3, ' Entreprendre la configuration de base (accès, mot clés, etc.), tester et documenter les résultats', NULL),
(194, 45, 'B.1.1', 4, 'Ingénierie des besoins: reconnaître et classer les besoins du client y.c. de la sécurité, transférer sur la topologie du réseau en tenant compte des avantages et inconvénients d’une solution, possibilité d’extension, maintenance, prix, distance, etc', NULL),
(195, 45, 'B.1.2', 4, 'Planification et concept de la structure réseau appropriée (Provider, WLAN, Switch, Router etc.) en tenant compte des besoins en largeur de bande, des médias, de la disponibilité et des services (Voice, unified Communication, Video, etc.), présenter la solution au supérieur', NULL),
(196, 45, 'B.1.3', 3, 'Installer, mettre en réseau et configurer des composants (par ex. VLAN, Routing)', NULL),
(197, 45, 'B.1.4', 3, 'Visualiser et documenter les réseaux et leur topologie', NULL),
(198, 46, 'B.2.1', 3, 'Reconnaître et évaluer les critères de sécurité en tenant compte des besoins du client et de l‘environnement', NULL),
(199, 46, 'B.2.2', 3, 'Concevoir des mesures de sécurité dans le réseau afin de minimiser les risques (filtrage MAC, malware/virus, VLAN, VPN y.c. le cryptage, security-gateways, contrôles des accès), planifier la mise en œuvre', NULL),
(200, 46, 'B.2.3', 3, 'Mettre en œuvre les mesures de sécurité et tester leurs fonctionnalités', NULL),
(201, 46, 'B.2.4', 3, 'Documenter la solution et élaborer le mode d’emploi utilisateurs', NULL),
(202, 47, 'B.3.1', 5, 'Surveiller la performance, la sécurité, la disponibilité, les accès (IDS ou accès des personnes), contenu des données, journaux log, analyser et proposer des mesures avec des outils appropriés (Realtime-Monitoring ou contrôles périodiques)', NULL),
(203, 47, 'B.3.2', 5, 'Proposer des scénarios (incl. pour des situations extrêmes et de secours) et planifier les étapes nécessaires d‘amélioration', NULL),
(204, 47, 'B.3.3', 3, 'Mettre en œuvre des adaptations dans le réseau (incl. mise en service de NMS), documenter celles-ci et vérifier leur efficacité', NULL),
(205, 48, 'B.4.1', 5, 'Concevoir et évaluer des systèmes de sauvegarde de données en tenant compte des besoins du client, des dispositions juridiques, des besoins en sécurité et protection des données, du réemploi (même à long termes, par ex. 20 ans) ainsi que de l’environnement', NULL),
(206, 48, 'B.4.2', 5, 'Planifier et implémenter des systèmes de sauvegarde incl. des solutions de backup', NULL),
(207, 48, 'B.4.3', 3, 'Tester l’installation (test fonctionnel et de remise) et documenter celle-ci ainsi que les résultats', NULL),
(208, 49, 'C.1.1', 4, 'Accueillir, comprendre, planifier et mettre en œuvre un mandat client (organisation, méthodologie)', NULL),
(209, 49, 'C.1.2', 4, 'Concept des droits d’accès y.c. élaborer le partage en tenant compte des exigences de la communication en réseau (applications d’impression, de téléphonie, VPN, spécifiques à l’entreprise)', NULL),
(210, 49, 'C.1.3', 3, 'Installer, mettre en œuvre et ajuster aux spécificités du client un service d’annuaire en tenant compte de la protection et de la sécurité des données ainsi que des conditions d’accès', NULL),
(211, 49, 'C.1.4', 3, 'Tester et documenter la fonctionnalité', NULL),
(212, 50, 'C.2.1', 5, 'Enregistrer le mandat du client et planifier la mise en œuvre (organisation, méthodes de travail, optimisation de l’énergie)', NULL),
(213, 50, 'C.2.2', 4, 'Élaborer le concept en tenant compte de toutes les dépendances des services disponibles, de la performance et des interfaces incl. les questions de droits d’accès', NULL),
(214, 50, 'C.2.3', 3, 'Installer les services (par ex. serveurs web, de bases de données, de terminaux, d‘imprimantes, etc.) en tenant compte des précautions de sécurité incl. les mesures de protection antivirus', NULL),
(215, 50, 'C.2.4', 3, 'Tester la configuration, la disponibilité et la fonctionnalité du nouveau matériel et logiciels installés, verbaliser ces tests dans la documentation', NULL),
(216, 51, 'C.3.1', 4, 'Accueillir, comprendre et planifier un mandat du client, planifier la mise en œuvre (organisation, méthodologie)', NULL),
(217, 51, 'C.3.2', 4, 'Élaborer un concept de la performance et des interfaces en tenant compte de toutes les dépendances des services disponibles, y.c. les questions de droits d’accès et logiciels appropriés', NULL),
(218, 51, 'C.3.3', 3, 'Installer les services de communication et groupeware (par ex. serveur de messagerie, serveur VOIP, DMS, etc.) en tenant compte des précautions nécessaires de sécurité (protection virale, filtrage des contenus et spams), de performance et de disponibilité', NULL),
(219, 51, 'C.3.4', 3, 'Tester et documenter la configuration, la disponibilité, la fonctionnalité du matériel et logiciels nouvellement installés', NULL),
(220, 52, 'C.4.1', 5, 'Conseil à la clientèle en regard de la sécurité et l’archivage des données, recueillir et analyser les besoins du client et, au besoin, aviser sur les effets du risque', NULL),
(221, 52, 'C.4.2', 4, 'Élaboration d’un concept en tenant compte de toutes les contraintes telles que les besoins de l’entreprise, les règles légales, les us et coutumes de la branche, les médias, les performances et la durée de vie', NULL),
(222, 52, 'C.4.3', 3, 'Installation des systèmes en tenant compte des précautions nécessaires de sécurité (droits d’accès, sécurité des données, reprise après sinistre), performance, et installer la disponibilité', NULL),
(223, 52, 'C.4.4', 3, 'Tester, valider et exécuter la restauration des données, documenter le travail', NULL),
(224, 53, 'C.5.1', 4, 'Accueillir, comprendre et planifier un mandat du client, planifier la mise en œuvre (organisation, méthodologie)', NULL),
(225, 53, 'C.5.2', 4, 'Élaborer un concept en tenant compte des offres de fournisseurs existants, dépendances des services disponibles, de la performance et des interfaces, incl. les questions de droits d’accès', NULL),
(226, 53, 'C.5.3', 3, 'Installer les services réseaux (par ex. les services cloud, CMS, serveurs web et d‘applications, etc.) incl. les langages des scripts ou de programmation côté serveur en tenant compte des précautions nécessaires de sécurité, de la performance et de la disponibilité', NULL),
(227, 53, 'C.5.4', 3, 'Tester les fonctionnalités en charge, resp. sous des conditions aggravées, verbaliser la solution et les résultats des tests', NULL),
(228, 54, 'D.1.1', 3, 'Lire et interpréter des schémas (plan électrique, plan réseau) et pouvoir documenter les modifications exécutées', NULL),
(229, 54, 'D.1.2', 3, 'Surveiller et administrer le réseau (monitoring: performance, flux de données, stabilité, malware, firewall, etc.)', NULL),
(230, 54, 'D.1.3', 5, 'Poursuivre les incohérences et, le cas échéant, proposer des mesures appropriées, resp. les prendre selon les directives de l’entreprise', NULL),
(231, 54, 'D.1.4', 3, 'Concevoir et réaliser des extensions réseau en tenant compte des coûts d’acquisition et d’exploitation et éliminer dans les règles les appareils remplacés', NULL),
(232, 54, 'D.1.5', 3, 'Découvrir et éliminer toutes les pannes possibles de connexion (switchs, routeurs, etc.), y.c. mettre en œuvre des scénarios de secours selon checklist', NULL),
(233, 54, 'D.1.6', 3, 'Tester la fonctionnalité, la performance, la sécurité et documenter les résultats', NULL),
(234, 55, 'D.2.1', 3, 'Exécuter les tâches régulières de maintenance, d’entretien et de surveillance (journalières, hebdomadaires, mensuelles, etc.), y.c. l’exécution régulière de mise à jour, contrôle de génération, ressources selon un déroulement par checklist', NULL),
(235, 55, 'D.2.2', 3, 'Assurer la sécurité système et d’exploitation. Respecter les droits, vérifier les règles d’authentification et d’autorisation et les mettre en œuvre de manière conséquente', NULL),
(236, 55, 'D.2.3', 3, 'Surveiller des services de serveurs (par ex. gestion des logfiles, queues d‘impression, messagerie/données, etc.) et entreprendre les mesures nécessaires', NULL),
(237, 55, 'D.2.4', 3, 'Installation et configuration des services de communication et groupeware (par ex. sharepoint, Lotus Notes, etc.), gestion des délais, des tâches et des documents', NULL),
(238, 55, 'D.2.5', 3, 'Tester et documenter la fonctionnalité, les performances et la sécurité des systèmes. ', NULL),
(239, 56, 'D.3.1', 3, 'Gérer et distribuer des licences, mises à jour, maintenir la liste des générations de logiciels, actualiser localement les logiciels de sécurité', NULL),
(240, 56, 'D.3.2', 3, 'Administrer le cycle de vie des appareils en tenant compte des aspects économiques et de durabilité. En cas de besoin, échanger les appareils', NULL),
(241, 56, 'D.3.3', 3, 'Entreprendre des extensions sur le matériel et logiciels, y compris les adaptations de configurations en tenant compte de toutes les implications sur les systèmes', NULL),
(242, 56, 'D.3.4', 3, 'Informer et instruire les utilisateurs', NULL),
(243, 57, 'D.4.1', 3, 'Analyser le mandat ou les besoins (utilisateurs/système), enregistrer le processus et en prendre acte', NULL),
(244, 57, 'D.4.2', 4, 'Développer une solution et la présenter au supérieur ou à l’utilisateur', NULL),
(245, 57, 'D.4.3', 3, 'Automatiser des processus (par ex. déploiement de logiciels, processus de serveurs, envoi automatisé de messages, etc.) à l’aide d’outils appropriés (par ex. scripts)', NULL),
(246, 57, 'D.4.4', 3, 'Assurer que le processus automatisé remplisse la totalité des fonctionnalités en tenant compte de la couverture de tous les systèmes environnants, documenter les fonctionnalités', NULL),
(247, 58, 'D.5.1', 4, 'Clarifier les possibilités et la faisabilité de systèmes de déploiement de logiciels et évaluer les offres', NULL),
(248, 58, 'D.5.2', 4, 'Clarifier les conditions d’installation et leur compatibilité avec les systèmes environnants, proposer une solution', NULL),
(249, 58, 'D.5.3', 3, 'Mettre en service des systèmes de déploiement possibles dans un environnement de test, tester et documenter les fonctionnalités', NULL),
(250, 58, 'D.5.4', 3, 'Exécuter le déploiement des logiciels, surveiller et documenter celui-ci', NULL),
(251, 58, 'D.5.5', 3, 'Informer les utilisateurs selon les besoins', NULL),
(252, 59, 'E.1.1', 3, 'Analyser et comprendre l’étendue de travail, élaborer une planification des travaux', NULL),
(253, 59, 'E.1.2', 3, 'Prendre les mesures de préparation en vue de la résolution, élaborer les checklist et la planification, documenter le déroulement, élaborer la liste de matériel, etc', NULL),
(254, 59, 'E.1.3', 3, 'Acquérir et ordonner du matériel, le préparer pour l’installation, etc. y.c. les solutions de secours', NULL),
(255, 59, 'E.1.4', 3, 'Exécuter les tâches, conformément à la planification, efficacement de pas à pas', NULL),
(256, 59, 'E.1.5', 3, 'Planifier et exécuter des tests, lesquels seront documentés dans l’inventaire des nouvelles installations', NULL),
(257, 59, 'E.1.6', 3, 'Remettre l’installation et faire signer le protocole de remise au client', NULL),
(258, 59, 'E.1.7', 3, 'Instruire les utilisateurs sur les modifications de leurs applications', NULL),
(259, 59, 'E.1.8', 3, 'Retourner le matériel et appareils non nécessaires, éliminer correctement le matériel inutilisable', NULL),
(260, 60, 'E.2.1', 4, 'Analyser et comprendre l’étendue de travail de sa propre contribution, élaborer une planification des travaux en tenant compte des ressources disponibles', NULL),
(261, 60, 'E.2.2', 3, 'Élaborer le mandat selon les directives en termes de délai et dans le cadre du budget, subdiviser les résultats dans le projet global', NULL),
(262, 60, 'E.2.3', 3, 'Informer constamment la direction de projet de sa propre initiative sur les modifications et déviations', NULL),
(263, 60, 'E.2.4', 3, 'Élaborer la documentation du projet, les rapports, la correspondance du projet, etc. selon directives', NULL),
(264, 60, 'E.2.5', 3, 'Mettre à disposition des collègues ses propres expériences issues du projet', NULL),
(265, 61, 'E.3.1', 3, 'Communiquer dans le cadre du projet avec toutes les personnes concernées par le biais de contacts réguliers et discussions sur l’avancement des travaux, les interfaces, les nouvelles solutions, les problèmes', NULL),
(266, 61, 'E.3.2', 3, 'Entretiens par des contacts réguliers et discussions avec les clients, respectivement le mandant, sur les souhaits, les questions et besoins, vérifier à l’aide de questions ciblées si les souhaits ont été correctement et précisément saisis', NULL),
(267, 62, 'A.1.1', 2, 'Expliquent les tâches et fonctions des systèmes d’exploitation courants', NULL),
(268, 62, 'A.1.2', 4, 'Installent et configurent les systèmes d’exploitation courants selon directives, cernent rapidement les problèmes et les résolvent ou les transmettent à l’instance correcte', NULL),
(269, 62, 'A.1.3', 3, 'Installent et configurent des appareils périphériques et leurs extensions', NULL),
(270, 62, 'A.1.4', 3, 'Installent des terminaux sur place selon les spécifications de l’entreprise et du point de vue de l’efficacité énergétique, la sécurité du travail, la protection de la santé et de l’environnement', NULL),
(271, 62, 'A.1.5', 3, 'Mettent en œuvre des prescriptions et des processus dans le cadre de la gestion de la durée de vie des produits', NULL),
(272, 62, 'A.1.6', 1, 'Exécutent des mises à jour de logiciel d’entreprise selon guides et informations des producteurs', NULL),
(273, 62, 'A.1.7', 3, 'Appliquent des commandes spécifiques sur des systèmes d’exploitation courants', NULL),
(274, 62, 'A.1.8', 3, 'Trient les déchets et appareils hors service, les dirigent vers le recyclage / réutilisation selon l’état technique', NULL),
(275, 63, 'A.2.1', 3, 'Installent et configurent des applications standards et les administrent', NULL),
(276, 63, 'A.2.2', 2, 'Actualisent les logiciels existants avec une version actuelle', NULL),
(277, 63, 'A.2.3', 3, 'Décrivent les diverses variantes de licences', NULL),
(278, 63, 'A.2.4', 3, 'Appliquent les processus de la gestion des licences', NULL),
(279, 64, 'A.3.1', 4, 'Exécutent des tests de fonctions selon directives et évaluent les résultats', NULL),
(280, 64, 'A.3.2', 3, 'Adaptent les tests de fonctions existants sur la base de nouvelles conditions cadres', NULL),
(281, 64, 'A.3.3', 4, 'Élaborent et documentent les déroulements de tests de fonctions et contrôlent ceux-ci sur leur exactitude', NULL),
(282, 65, 'A.4.1', 3, 'Appliquent des scripts et contrôlent leur exécution', NULL),
(283, 65, 'A.4.2', 4, 'Entreprennent des adaptations sur la fonctionnalité du script', NULL),
(284, 65, 'A.4.3', 3, 'Programment des scripts simples selon directives', NULL),
(285, 66, 'B.1.1', 2, 'Expliquent les tâches et fonctions de chaque composant d’un réseau (switch, routeur, firewall, serveur, système de mémorisation, points d’accès WLAN)', NULL),
(286, 66, 'B.1.2', 4, 'Intègrent les terminaux ICT utilisateurs (PC, notebook, appareils mobiles, imprimantes, appareils multifonctionnels et appareils de télécommunication) dans un environnement réseau existant', NULL),
(287, 66, 'B.1.3', 4, 'Décèlent les pannes et peuvent les cerner dans un environnement réseau, les résolvent ou les transmettent à l’instance correcte', NULL),
(288, 66, 'B.1.4', 2, 'Instruisent les utilisateurs lors de l’installation et l’utilisation d’applications et services Cloud', NULL),
(289, 67, 'B.2.1', 3, 'Relient les logiciels du terminal ICT utilisateurs avec les services concernés du serveur', NULL),
(290, 67, 'B.2.2', 2, 'Attribuent les services serveurs usuels (DNS, DHCP, services d‘annuaire, serveurs Groupware) à leurs fonctions dans le réseau et expliquent leurs tâches/fonctions', NULL),
(291, 67, 'B.2.3', 4, 'Décèlent parmi les services serveurs usuels (DNS, DHCP, services d‘annuaire, serveurs Groupware) les pannes et peuvent les résoudre ou les transmettent à l’instance correcte', NULL),
(292, 67, 'B.2.4', 3, 'Utilisent et configurent les services serveurs mis en œuvre dans l’entreprise sur les terminaux ICT utilisateurs (PC, notebook, tablettes, smartphones)', NULL),
(293, 68, 'B.3.1', 2, 'Décrivent les bases de la sécurité informatique (sécurité des données, protection des données, disponibilité) et expliquent les possibilités de mesures de protection contre les menaces dans le domaine des ICT', NULL),
(294, 68, 'B.3.2', 3, 'Installent et configurent les logiciels de protection usuels sur les terminaux ICT utilisateurs et les maintiennent au niveau actuel', NULL),
(295, 68, 'B.3.3', 3, 'Protègent les terminaux ICT utilisateurs des dangers actuels sur la base des directives de l’entreprise', NULL),
(296, 68, 'B.3.4', 3, 'Appliquent les directives et processus de sécurité internes à l’entreprise de manière conforme à la situation', NULL),
(297, 68, 'B.3.5', 3, 'Appliquent les procédures nécessaires pour déceler et éliminer les attaques de logiciels malveillants sur les terminaux ICT utilisateurs', NULL),
(298, 69, 'C.1.1', 3, 'Décrivent les éléments du contenu d’une instruction et les mettent en œuvre dans la pratique', NULL),
(299, 69, 'C.1.2', 2, 'Préparent systématiquement des présentations et décrivent les facteurs de succès (rhétorique, langage corporel) lors de leur exécution', NULL),
(300, 69, 'C.1.3', 3, 'Appliquent les logiciels appropriés pour la réalisation de présentations', NULL),
(301, 69, 'C.1.4', 3, 'Utilisent divers médias et moyens d’aide, afin de soutenir les présentations', NULL),
(302, 69, 'C.1.5', 3, 'Mettent en œuvre les instructions/présentations avec toutes les mesures nécessaires (contenus, structuration, préparation, exécution, approfondissement, préparation des ressources nécessaires, etc.)', NULL),
(303, 70, 'C.2.1', 3, 'Formulent des objectifs simples et clairs, et peuvent interpréter des objectifs prescrits', NULL),
(304, 70, 'C.2.2', 3, 'Appliquent des directives et modèles de documentation de l‘entreprise', NULL),
(305, 70, 'C.2.3', 3, 'Acquièrent, avec les moyens mis à disposition, les informations nécessaires', NULL),
(306, 70, 'C.2.4', 4, 'Trient l’indispensable du superflu et fixent les bonnes priorités', NULL),
(307, 70, 'C.2.5', 3, 'Élaborent des modes d’emploi compréhensibles et clairement structurés', NULL),
(308, 70, 'C.2.6', 3, 'Utilisent des techniques appropriées de visualisation afin de présenter les déclarations de manière compréhensible et efficace', NULL),
(309, 70, 'C.2.7', 3, 'Appliquent les outils logiciels appropriés pour la réalisation de la documentation', NULL),
(310, 71, 'C.3.1', 3, 'Saisissent les exigences du client ainsi que la réalité de la situation, et entament les étapes suivantes de l‘acquisition', NULL),
(311, 71, 'C.3.2', 3, 'Acquièrent, de la part du client et de l’objet à acquérir, les informations importantes pour la situation donnée', NULL),
(312, 71, 'C.3.3', 4, 'Comparent les données acquises et confrontent les avantages et inconvénients des divers produits du point de vue économique, écologique et technique, puis les documentent', NULL),
(313, 71, 'C.3.4', 3, 'Présentent au client des recommandations sous forme verbales ou écrites, et les justifient', NULL),
(314, 71, 'C.3.5', 3, 'Déroulent les activités administratives d’un processus d’acquisition (offres, confirmation du mandat, procès-verbal du travail, facture, etc.)', NULL),
(315, 72, 'D.1.1', 2, 'Prennent note des demandes ou besoins des clients qui peuvent se présenter et déterminent, par des questions ciblées, le problème', NULL),
(316, 72, 'D.1.2', 4, 'Cernent rapidement les problèmes et sont capables de les éliminer ou les transmettent à l’instance correcte', NULL),
(317, 72, 'D.1.3', 3, 'Entament des préparations pour éluder les questions, élaborent des checklists et estiment l‘investissement', NULL),
(318, 72, 'D.1.4', 3, 'Mettent en œuvre efficacement et de manière structurée les mandats en respectant les prescriptions', NULL),
(319, 72, 'D.1.5', 3, 'Documentent le déroulement afin que l’utilisateur et/ou l’équipe puisse saisir l‘état des travaux', NULL),
(320, 72, 'D.1.6', 2, 'Informent les clients sur l’état des travaux et, selon besoins, instruisent les clients afin de résoudre les problèmes', NULL),
(321, 72, 'D.1.7', 3, 'Appliquent correctement les termes techniques et conformément à la situation lors de la communication avec l’équipe, les partenaires de l’organisation ICT et les clients', NULL),
(322, 73, 'D.2.1', 3, 'Appliquent diverses techniques de communication, afin de traiter les problèmes de manière ciblée', NULL),
(323, 73, 'D.2.2', 3, 'Appliquent des modèles de communication dans la collaboration avec des clients et leur propre équipe', NULL),
(324, 73, 'D.2.3', 3, 'Utilisent les retours afin de s’engager et d’apporter une contribution pour le succès de l’équipe', NULL),
(325, 73, 'D.2.4', 2, 'Expliquent le processus dynamique de l’équipe (rôles et normes) et décrivent les diverses phases de développement de l’équipe', NULL),
(326, 73, 'D.2.5', 2, 'Décrivent les causes et la dynamique des conflits', NULL),
(327, 73, 'D.2.6', 4, 'Décèlent à temps les situations de conflits et prend les mesures en conséquence', NULL),
(328, 74, 'D.3.1', 3, 'Appliquent un modèle (méthode des 6 pas) pour la mise en œuvre d’une action exhaustive', NULL),
(329, 74, 'D.3.2', 2, 'Décrivent comment des projets sont planifiés, structurés efficacement, démarrés, exécutés et clos', NULL),
(330, 74, 'D.3.3', 3, 'Élaborent des plans pour un déroulement systématique des mandats en tenant compte des ressources, des délais, des problèmes et des divisions du travail', NULL);
INSERT INTO `objective` (`id`, `fk_operational_competence`, `symbol`, `taxonomy`, `name`, `archive`) VALUES
(331, 74, 'D.3.4', 3, 'Utilisent de manière ciblée des sources d’informations et acquièrent les informations manquantes', NULL),
(332, 74, 'D.3.5', 3, 'Appliquent des méthodes et principes pour l’amélioration de l’efficacité du travail dans le cadre des travaux journaliers', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `operational_competence`
--

CREATE TABLE `operational_competence` (
  `id` int(11) NOT NULL,
  `fk_competence_domain` int(11) NOT NULL,
  `name` varchar(150) DEFAULT NULL,
  `symbol` varchar(10) NOT NULL,
  `methodologic` text DEFAULT NULL,
  `social` text DEFAULT NULL,
  `personal` text DEFAULT NULL,
  `archive` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `operational_competence`
--

INSERT INTO `operational_competence` (`id`, `fk_competence_domain`, `name`, `symbol`, `methodologic`, `social`, `personal`, `archive`) VALUES
(1, 1, 'Analyser, structurer et documenter les exigences ainsi que les besoins', 'A1', 'Travail structuré, documentation adéquate', 'Comprendre et sentir les problèmes du client, communication avec des partenaires', 'Fiabilité, autoréflexion, interrogation constructive du problème', '2021-05-11 08:16:49'),
(2, 1, 'Elaborer diverses propositions de solutions incluant les interfaces utilisateurs requises', 'A2', 'Travail structuré, documentation adéquate, appliquer des techniques de créativité, techniques de décision', 'Comprendre et sentir les problèmes du client, communication avec des partenaires, modération, travail en réseau', 'Interrogation constructive du problème, s’informer de manière autonome sur les diverses solutions', '2021-05-11 08:16:49'),
(3, 1, 'Vérifier l’exhaustivité des exigences et des besoins dans les propositions de solution choisies', 'A3', 'Techniques de validation, assurance qualité, techniques de présentation  et de démonstration', '', 'Précision dans le travail', '2021-05-11 08:16:49'),
(4, 2, 'Elaborer un concept de tests, mettre en application divers déroulements de tests et tester systématiquement les applications ', 'B1', '', 'Capacité de critique mutuelle', 'Développer préventivement, estimer les conséquences', '2021-05-11 08:16:49'),
(5, 2, 'Mettre en œuvre des directives d’architecture dans un projet concret', 'B2', '', '', 'Capacités d’abstraction', '2021-05-11 08:16:49'),
(6, 2, 'Développer et documenter des applications conformément aux besoins du client en utilisant des modèles appropriés de déroulement', 'B3', 'Travail structuré et systématique, capacités d‘abstraction, compétences de modélisation, acquisition d‘informations, développer efficacement, tenir compte de la charge du réseau', 'Travail en groupe, capacités de communication, capacités de critiques, orientation client, disponibilités pour la reprise de l‘existant', 'Penser économies d‘entreprises, persévérance, conscience de la qualité, capacité de compréhension rapide', '2021-05-11 08:16:49'),
(7, 2, 'Implémenter des applications et des interfaces utilisateurs en fonction des besoins du client et du projet', 'B4', 'Orientation client, développement approprié au marché, appliquer des techniques innovatrices', 'Travail en groupe, empathie', 'Capacités innovatrices, créativité', '2021-05-11 08:16:49'),
(8, 2, 'Garantir la qualité des applications', 'B5', 'Travail reproductible, description propres des versions de l‘application, gestion de projets', 'Capacité de critiques et de conflits, empathie', 'Vérification autocritique des résultats, méticulosité', '2021-05-11 08:16:49'),
(9, 2, 'Préparer et mettre en œuvre l’introduction des applications', 'B6', 'Gestion de projets', 'Capacités de communication, travail en réseau, déroulement sensible', 'Conscience de la responsabilité', '2021-05-11 08:16:49'),
(10, 3, 'Identifier et analyser des données, puis développer avec des modèles de données appropriés', 'C1', 'Déroulement structuré, comportement avec des outils de présentation, développement itératif', 'Communication avec des clients, travail en groupe', 'Précision, abstraction, remise en question critique', '2021-05-11 08:16:49'),
(11, 3, 'Mettre en œuvre un modèle de données dans une base de données', 'C2', '', '', 'Capacité d’abstraction', '2021-05-11 08:16:49'),
(12, 3, 'Accéder à des données à partir d’applications avec un langage approprié', 'C3', '', '', '', '2021-05-11 08:16:49'),
(13, 4, 'Installer et configurer, selon des directives, des postes de travail ainsi que des services de serveurs dans l’exploitation locale du réseau', 'D1', 'Considération de la valeur utile, déroulement systématique, check liste, méthode de travail durable économiquement, écologiquement, socialement', 'Orientation client, communication écrite et orale', 'Autoréflexion critique', '2021-05-11 08:16:49'),
(14, 5, 'Préparer, structurer et documenter des travaux et mandats de manière systématique et efficace', 'E1', 'Déroulement structuré, déroulement systématique selon check list, documentation des travaux', 'Travail en groupe, prêt à aider, intérêt global, tenir une conversation en langue étrangère, compréhension des rôles', 'Fiabilité, bon comportement, capacité élevée de charges, s’identifier à l’entreprise', '2021-05-11 08:16:49'),
(15, 5, 'Collaborer à des projets et travailler selon des méthodes de projets', 'E2', 'Méthodes de travail, pensée transversale, considération des variantes, analyse des grandeurs utiles, pensée en réseau, techniques de présentation et de ventes', 'Faculté de travail en groupe, développer et mettre en œuvre selon les besoins, communiquer selon le niveau et les utilisateurs, comportement respectueux et adapté avec les collaborateurs', 'Réflexion, disposé à l‘apprentissage, intérêts, capacité decritiques, capacité d’endurance jusqu’à la conclusion', '2021-05-11 08:16:49'),
(16, 5, 'Dans le cadre de projets, communiquer de manière ciblée et adaptée à l’interlocuteur', 'E3', 'Méthodes de travail, pensée en réseau, techniques de présentation et de ventes', 'Travail en groupe, communiquer conformément au niveau et aux utilisateurs, comportement respectueux et approprié avec toutes les personnes de contact à tous les niveaux, communication précise\r\n', 'Réflexion, prêt à apprendre, intérêt, capacité de critiques, capacité de résistance', '2021-05-11 08:16:49'),
(17, 6, 'Evaluer et mettre en service une place de travail utilisateur', 'A1', 'Analyse des valeurs utiles, déroulement systématique, faire de checklist, technique commerciale, méthode durable de travail (économiquement, écologiquement, socialement)', 'Orientation client, communication écrite et orale', 'Conscience de la responsabilité, fiabilité, autoréflexion critique', '2021-05-11 08:16:49'),
(18, 6, 'Installer et synchroniser sur le réseau interne des appareils mobiles des utilisateurs', 'A2', 'Analyse des valeurs utiles, déroulement systématique, faire de checklist, technique commerciale, méthode durable de travail (économiquement, écologiquement, socialement)', 'Orientation client, communication écrite et orale, comportement convivial avec le client', 'Conscience de la responsabilité, fiabilité, autoréflexion critique', '2021-05-11 08:16:49'),
(19, 6, 'Connecter et configurer des appareils périphériques', 'A3', 'Analyse des valeurs utiles, déroulement systématique, faire de checklist, technique commerciale, méthode durable de travail (économiquement, écologiquement, socialement)', 'Orientation client, communication écrite et orale, langage adapté au client', 'Conscience de la responsabilité, fiabilité, autoréflexion critique', '2021-05-11 08:16:49'),
(20, 7, 'Mettre en service des systèmes serveurs', 'B1', 'Analyse des valeurs utiles, déroulement systématique, faire de checklist, technique commerciale, méthode durable de travail (économiquement, écologiquement, socialement)', 'Orientation client, communication écrite et orale', 'Autoréflexion critique', '2021-05-11 08:16:49'),
(21, 7, 'Installer des réseaux et leurs topologies', 'B2', 'Déroulement analytique, principe de Pareto, techniques de visualisation, diagrammes, techniques de décision', 'Faire des entretiens professionnels en anglais', 'Méthode précise de travail, conscience de la responsabilité, capacités d’abstraction', '2021-05-11 08:16:49'),
(22, 7, 'Elaborer et mettre en œuvre des concepts de sécurité des données, de sécurité système et d’archivage', 'B3', 'Actions préventives', 'Conseil', 'Penser et travailler de manière disciplinée, comportement dans les situations de stress', '2021-05-11 08:16:49'),
(23, 8, 'Assurer la maintenance de réseaux et les développer', 'C1', 'déroulement systématique, faire de checklist, technique commerciale, méthode durable de travail (économiquement, écologiquement, socialement)', '', 'Précision, fiable, actions attentives', '2021-05-11 08:16:49'),
(24, 8, 'Assurer la maintenance et administrer des serveurs', 'C2', 'Pensée systématique et préventive, considération de l’ensemble, remise en question systématique, travail durable (économiquement, écologiquement, socialement)', 'Travail en groupe, entretien professionnel en anglais', 'Travail patient et autocritique, conscience de la qualité, autoréflexion, éthique, discrétion, discipline', '2021-05-11 08:16:49'),
(25, 8, 'Planifier, mettre en œuvre des services d’annuaires et des autorisations', 'C3', 'Techniques d’interrogation', 'Empathie', 'Comprendre et interpréter des documents anglais', '2021-05-11 08:16:49'),
(26, 8, 'Mettre en service et configurer des services de communication et de soutien des travaux de groupe (groupeware)', 'C4', 'Techniques d’entretien, pensée systématique et préventive, considération de l’ensemble, remise en question systématique', 'Travailler en groupe', 'Travail patient et auto-critique, sens de la qualité, autoreflexion', '2021-05-11 08:16:49'),
(27, 9, 'Instruire et aider les utilisateurs dans l’utilisation des moyens informatiques', 'D1', 'Techniques d’interrogation, déroulement structuré, travailler selon checklist, établir des documents de première aide', 'Capacité de communication, comportement avec autrui en situation de stress, comportement selon le niveau hiérarchique', 'Garder le calme, résistance au stress, maîtriser sa propre nervosité', '2021-05-11 08:16:49'),
(28, 9, 'Assurer des tâches de support par le biais du contact client et résoudre les problèmes sur place', 'D2', 'Techniques d’interrogation, déroulement structuré, travailler selon checklist', 'Capacité de communication, comportement avec autrui en situation de stress, comportement selon le niveau hiérarchique', 'Garder le calme, résistance au stress, maîtriser sa propre nervosité', '2021-05-11 08:16:49'),
(29, 10, 'Elaborer des concepts de tests, mettre en application divers déroulements de tests et tester systématiquement les applications ', 'E1', '', 'Capacité de critique mutuelle', 'Développer préventivement, estimer les conséquences', '2021-05-11 08:16:49'),
(30, 10, 'Développer et documenter des applications de manière conviviale en utilisant des modèles appropriés de déroulement', 'E2', 'Utiliser efficacement l’environnement logiciels, travail systématique et structuré, capacités d’abstraction, compétences en modélisation, acquisition d’informations, développer efficacement, observer la charge du réseau', 'Travail en groupe, capacités de communication, de critique, de compromis, orientation client, disponibilité, reprise de l’existant', 'Pensée économique, capacité de résistance, conscience de la qualité, capacité de saisie rapide', '2021-05-11 08:16:49'),
(31, 10, 'Développer et implémenter des interfaces utilisateurs pour des applications selon les besoins du client', 'E3', 'Orientation client, concept centré sur l’utilisateur, application de techniques innovantes', 'Travail en groupe, empathie', 'Capacité d’innovation, créativité', '2021-05-11 08:16:49'),
(32, 10, 'Mettre en œuvre des modèles de données dans une base de données', 'E4', '', '', 'Capacité d’abstraction', '2021-05-11 08:16:49'),
(33, 10, 'Accéder à des données à partir d’applications avec un langage approprié', 'E5', '', '', '', '2021-05-11 08:16:49'),
(34, 11, 'Préparer, structurer, exécuter et documenter des travaux et des mandats de manière systématique et efficace', 'F1', 'Déroulement structuré, déroulement systématique selon checklist, documentation des travaux', 'Travail en groupe, prêt à aider, intérêt global, tenir une conversation en langue étrangère, compréhension des rôles', 'Fiabilité, bon comportement, capacité élevée de charges, s’identifier à l’entreprise', '2021-05-11 08:16:49'),
(35, 11, 'Collaborer à des projets', 'F2', 'Déroulement structuré, déroulement systématique selon checklist, documentation des travaux', 'Travail en groupe, prêt à aider, intérêt global, tenir une conversation en langue étrangère, compréhension des rôles', 'Fiabilité, bon comportement, capacité élevée de charges, s’identifier à l’entreprise, réfléchir en commun dans le projet', '2021-05-11 08:16:49'),
(36, 11, 'Dans le cadre de projets, communiquer de manière ciblée et adaptée à l’interlocuteur', 'F3', 'Méthodes de travail, pensée en réseau, techniques de présentation et de ventes', 'Travail en groupe, communiquer conformément au niveau et aux utilisateurs, comportement respectueux et approprié avec toutes les personnes de contact à tous les niveaux, communication précise', 'Réflexion, prêt à apprendre, intérêt, capacité de critiques, capacité de résistance', '2021-05-11 08:16:49'),
(42, 12, 'Choisir et mettre en service une place de travail utilisateur', 'A1', 'Analyse des valeurs utiles, déroulement systématique,\r\nfaire des checklists, technique commerciale, méthode durable de travail (économiquement, écologiquement, socialement).', 'Orientation client, communication écrite et orale.', 'Conscience de la responsabilité, fiabilité, auto-réflexion critique.', '2021-05-11 08:16:49'),
(43, 12, 'Choisir et mettre en service des systèmes serveurs', 'A2', 'Analyse des valeurs utiles, déroulement systématique, faire des\r\nchecklists, travail durable (économiquement, écologiquement,\r\nsocialement).', 'Orientation client, communication écrite et orale.', 'Auto-réflexion critique.', '2021-05-11 08:16:49'),
(44, 12, 'Choisir des composants réseau et les mettre en service', 'A3', 'Analyse des valeurs utiles, déroulement systématique, faire des\r\nchecklists, technique commerciale, méthode durable de travail\r\n(économiquement, écologiquement, socialement).', 'Communication écrite et orale, empathie, travail en groupe,\r\nlangage adapté au public cible.', 'Auto-réflexion critique, capacités d‘abstraction.', '2021-05-11 08:16:49'),
(45, 13, 'Planifier et installer des réseaux ainsi que leur topologie', 'B1', 'Déroulement analytique, principe de Pareto, techniques de visualisation, diagrammes, techniques de décision.', 'Faire des entretiens professionnels en anglais.', 'Méthode précise de travail, conscience de la responsabilité,\r\ncapacités d’abstraction.', '2021-05-11 08:16:49'),
(46, 13, 'Planifier et assurer la sécurité réseau ainsi que l’accès distant', 'B2', 'Déroulement analytique, principe de Pareto.', 'Reconnaître et classer les besoins en sécurité du client.', 'Travail précis, conscience de la responsabilité.', '2021-05-11 08:16:49'),
(47, 13, 'Surveiller des réseaux et garantir leur sécurité et leur capacité de fonctionnement', 'B3', 'Agir de manière préventive.', 'Conscience de la hiérarchie.', 'Discrétion (comportement avec des données confidentielles), fiabilité, précision.', '2021-05-11 08:16:49'),
(48, 13, 'Planifier, installer et exploiter des systèmes de sauvegarde de données en réseau', 'B4', 'Agir de manière préventive.', '', 'Discrétion (comportement avec des données confidentielles), fiabilité, précision, éthique, discrétion, secret professionnel.', '2021-05-11 08:16:49'),
(49, 14, 'Planifier, mettre en œuvre des services d’annuaires et des autorisations', 'C1', 'Techniques d’interrogation.', 'Empathie.', 'Comprendre et interpréter des documents anglais.', '2021-05-11 08:16:49'),
(50, 14, 'Mettre en service et configurer les services étendus des serveurs', 'C2', 'Techniques d‘entretiens, pensées préventive et systématique,\r\nconsidération globale, remise en question systématique.', 'Travail en groupe.', 'Travail patient et auto-critique, sens de la qualité, auto-réflexion.', '2021-05-11 08:16:49'),
(51, 14, 'Mettre en service et configurer des services de communication ainsi que de soutien des travaux de groupe (groupeware)', 'C3', 'Techniques d’entretien, pensée systématique et préventive,\r\nconsidération de l’ensemble, remise en question systématique.', 'Travailler en groupe.', 'Travail patient et auto-critique, sens de la qualité, auto-réflexion.', '2021-05-11 08:16:49'),
(52, 14, 'Élaborer et mettre en œuvre des concepts de sécurité des données, de sécurité des systèmes et d’archivage', 'C4', 'Actions préventives.', 'Conseil.', 'Penser et travailler de manière disciplinée, comportement dans les situations de stress.', '2021-05-11 08:16:49'),
(53, 14, 'Offrir des services via le réseau en prenant des mesures de sécurité', 'C5', 'Techniques d’entretien, pensée systématique et préventive,\r\nconsidération de l’ensemble, remise en question systématique.', 'Travailler en groupe.', 'Travail patient et auto-critique, sens de la qualité, auto-réflexion.', '2021-05-11 08:16:49'),
(54, 15, 'Assurer la maintenance de réseaux et les développer', 'D1', 'Déroulement systématique, faire des checklists, technique commerciale, méthode durable de travail (économiquement, écologiquement, socialement).', '', 'Précision, fiable, actions attentives.', '2021-05-11 08:16:49'),
(55, 15, 'Assurer la maintenance et administrer des serveurs', 'D2', 'Pensée systématique et préventive, considération de l’ensemble, remise en question systématique, travail durable\r\n(économiquement, écologiquement, socialement).', 'Travail en groupe, entretien professionnel en anglais.', 'Travail patient et autocritique, conscience de la qualité, auto-réflexion, éthique, discrétion, discipline.', '2021-05-11 08:16:49'),
(56, 15, 'Assurer la maintenance et administrer les équipements des utilisateurs', 'D3', 'Pensée systématique et préventive, considération de l’ensemble, remise en question systématique.', 'Travail en groupe, comportement diplomatique avec les utilisateurs.', 'Travail patient et autocritique, conscience de la qualité, auto-réflexion.', '2021-05-11 08:16:49'),
(57, 15, 'Enregistrer, standardiser et automatiser des processus TIC', 'D4', 'Déroulement structuré et orienté objectif, pensée et action préventive.', 'Conseil, comportement dans des situations de stress.', 'Penser et travailler de manière disciplinée.', '2021-05-11 08:16:49'),
(58, 15, 'Planifier, mettre en service et appliquer des systèmes de déploiement pour des applications', 'D5', 'Pensée préventive.', 'Appliquer l’anglais oralement et par écrit.', 'Réflexion, discipline et capacité d‘endurance.', '2021-05-11 08:16:49'),
(59, 16, 'Préparer, structurer et documenter des travaux et mandats de manière systématique et efficace', 'E1', 'Déroulement structuré, déroulement systématique selon checklist, documentation des travaux.', 'Travail en groupe, prêt à aider, intérêt global, tenir une conversation en langue étrangère, compréhension des rôles.', 'Fiabilité, bon comportement, capacité élevée de charges, s’identifier à l’entreprise.', '2021-05-11 08:16:49'),
(60, 16, 'Collaborer à des projets', 'E2', 'Déroulement structuré, déroulement systématique selon checklist, documentation des travaux.', 'Travail en groupe, prêt à aider, intérêt global, tenir une conversation en langue étrangère, compréhension des rôles.', 'Fiabilité, bon comportement, capacité élevée de charges, s’identifier à l’entreprise, réfléchir en commun dans le projet.', '2021-05-11 08:16:49'),
(61, 16, 'Dans le cadre de projets, communiquer de manière ciblée et adaptée à l’interlocuteur', 'E3', 'Méthodes de travail, pensée en réseau, techniques de présentation et de ventes.', 'Travail en groupe, communiquer conformément au niveau et aux utilisateurs, comportement respectueux et approprié avec toutes les personnes de contact à tous les niveaux, communication précise.', 'Réflexion, prêt à apprendre, intérêt, capacité de critiques, capacité de résistance.', '2021-05-11 08:16:49'),
(62, 17, 'Installer et configurer des terminaux ICT utilisateurs ainsi que des systèmes d’exploitation et en assurer la maintenance', 'A1', 'Techniques de travail, approche et action interdisciplinaires axées sur les processus, comportement écologique et économique.', 'Capacité à communiquer, aptitude au travail en équipe.', 'Autonomie et responsabilité, résistance au stress, flexibilité, apprentissage tout au long de la vie.', '2021-05-11 08:16:49'),
(63, 17, 'Installer et configurer des applications standard', 'A2', 'Techniques de travail, approche et action interdisciplinaires axées sur les processus, comportement économique.', '', 'Autonomie et responsabilité, résistance au stress, flexibilité, apprentissage tout au long de la vie.', '2021-05-11 08:16:49'),
(64, 17, 'Exécuter et évaluer des tests de fonctionnalité', 'A3', 'Techniques de travail, comportement économique.', '', 'Autonomie et responsabilité.', '2021-05-11 08:16:49'),
(65, 17, 'Mettre en œuvre des scripts d’automatisation', 'A4', 'Techniques de travail, comportement économique.', '', 'Autonomie et responsabilité.', '2021-05-11 08:16:49'),
(66, 18, 'Connecter à l’infrastructure réseau des périphériques compatibles réseau ainsi que des services connexes et résoudre les pannes', 'B1', 'Techniques de travail, approche et actions interdisciplinaires, comportement économique.', 'Capacité à communiquer, aptitude au travail en équipe.', 'Autonomie et responsabilité, résistance au stress, flexibilité, apprentissage tout au long de la vie.', '2021-05-11 08:16:49'),
(67, 18, 'Connecter des terminaux ICT utilisateurs aux prestations de serveur et résoudre les pannes', 'B2', 'Techniques de travail, approche et action interdisciplinaires axées sur les processus, comportement économique.', 'Capacité à communiquer, aptitude au travail en équipe.', 'Autonomie et responsabilité, résistance au stress, flexibilité, apprentissage tout au long de la vie.', '2021-05-11 08:16:49'),
(68, 18, 'Assurer la sécurité des terminaux ICT utilisateurs', 'B3', 'Techniques de travail, approche et action interdisciplinaires axées sur les processus, comportement économique.', 'Capacité à communiquer.', 'Autonomie et responsabilité, résistance au stress, flexibilité, apprentissage tout au long de la vie.', '2021-05-11 08:16:49'),
(69, 19, 'Instruire et soutenir les utilisateurs dans la mise en œuvre des moyens ICT', 'C1', 'Techniques de travail, techniques de présentation, comportement économique.', 'Capacité à communiquer.', 'Capacité à analyser sa pratique, autonomie et responsabilité, résistance au stress, flexibilité.', '2021-05-11 08:16:49'),
(70, 19, 'Élaborer et adapter des modes d’emploi et checklists pour les utilisateurs', 'C2', 'Techniques de travail, approche et action interdisciplinaires axées sur les processus, techniques de présentation, comportement économique.', 'Capacité à communiquer.', 'Autonomie et responsabilité, flexibilité.', '2021-05-11 08:16:49'),
(71, 19, 'Conseiller et soutenir les clients lors de l’acquisition d’appareils terminaux ICT', 'C3', 'Techniques de travail, approche et action interdisciplinaires axées sur les processus, techniques de présentation, comportement économique.', 'Capacité à communiquer, aptitude au travail en équipe.', 'Autonomie et responsabilité, flexibilité.', '2021-05-11 08:16:49'),
(72, 20, 'Traiter les demandes des clients au 1er et 2e niveau du support', 'D1', 'Techniques de travail, approche et action interdisciplinaires axées sur les processus, techniques de présentation, stratégies d’information et de communication, économique.', 'Capacité à communiquer, aptitude au travail en équipe.', 'Autonomie et responsabilité, résistance au stress, flexibilité, apprentissage tout au long de la vie.', '2021-05-11 08:16:49'),
(73, 20, 'Se comporter de manière adéquate avec les clients et l’équipe', 'D2', 'Techniques de travail, stratégies d’information et de communication.', 'Capacité à communiquer, capacité à gérer des conflits, aptitude au travail en équipe.', 'Capacité à analyser sa pratique, autonomie et responsabilité.', '2021-05-11 08:16:49'),
(74, 20, 'Exécuter, selon des méthodes spécifiques, les travaux dans l’environnement ICT et collaborer à des projets', 'D3', 'Techniques de travail, approche et action interdisciplinaires axées sur les processus, stratégies d’information et de communication, comportement économique.', 'Capacité à communiquer, aptitude au travail en équipe.', 'Autonomie et responsabilité, flexibilité.', '2021-05-11 08:16:49');

-- --------------------------------------------------------

--
-- Structure de la table `trainer_apprentice`
--

CREATE TABLE `trainer_apprentice` (
  `id` int(11) NOT NULL,
  `fk_trainer` int(11) NOT NULL,
  `fk_apprentice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `trainer_apprentice`
--

INSERT INTO `trainer_apprentice` (`id`, `fk_trainer`, `fk_apprentice`) VALUES
(1, 2, 4),
(5, 2, 4),
(4, 3, 4),
(2, 3, 5),
(3, 6, 7);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `fk_user_type` int(11) NOT NULL,
  `username` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `archive` timestamp NULL DEFAULT current_timestamp(),
  `date_creation` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `fk_user_type`, `username`, `password`, `archive`, `date_creation`) VALUES
(1, 1, 'admin', '$2y$10$tUB5R1MGgbO.zD//WArnceTY8IgnFkVVsudIdHBxIrEXJ2z3WBvcK', NULL, '2020-07-09 06:11:05'),
(2, 2, 'FormateurDev', '$2y$10$Q3H8WodgKonQ60SIcu.eWuVKXmxqBw1X5hMpZzwjRKyCTB1H1l.pe', NULL, '2020-07-09 11:15:24'),
(3, 2, 'FormateurSysteme', '$2y$10$v8qCvWlas8DvVkOxY6k4JufPAxFvJxYRLU0tMMbSJYNQjos27RHMK', NULL, '2020-07-09 11:15:47'),
(4, 3, 'ApprentiDev', '$2y$10$6TLaMd5ljshybxANKgIYGOjY0Xur9EgdzcEPy1bgy2b8uyWYeVoEm', NULL, '2020-07-09 11:16:05'),
(5, 3, 'ApprentiSysteme', '$2y$10$m..hDbyG41hMRak6Y/b/pO7n3bgy/V2mnATpRvWzrY2rXrXbm6nbi', NULL, '2020-07-09 11:16:27'),
(6, 2, 'FormateurOperateur', '$2y$10$SbMYPxqnngLjxVGlG4hW..lrc.pr5Dd74nY.KqdANtEESIvmGRpWi', NULL, '2020-07-09 11:24:22'),
(7, 3, 'ApprentiOperateur', '$2y$10$jPNxV2ZZ6Il2LiBQ.CWhNOoud6NsMRFILwHN8kpD410shWeiGpuxK', NULL, '2020-07-09 11:24:45');

-- --------------------------------------------------------

--
-- Structure de la table `user_course`
--

CREATE TABLE `user_course` (
  `id` int(11) NOT NULL,
  `fk_user` int(11) NOT NULL,
  `fk_course_plan` int(11) NOT NULL,
  `fk_status` int(11) NOT NULL,
  `date_begin` date NOT NULL,
  `date_end` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user_course`
--

INSERT INTO `user_course` (`id`, `fk_user`, `fk_course_plan`, `fk_status`, `date_begin`, `date_end`) VALUES
(1, 4, 1, 1, '2020-07-09', '0000-00-00'),
(2, 5, 3, 1, '2020-07-09', '0000-00-00'),
(3, 7, 4, 1, '2020-07-09', '0000-00-00'),
(4, 5, 1, 1, '2021-05-06', '2021-08-20');

-- --------------------------------------------------------

--
-- Structure de la table `user_course_status`
--

CREATE TABLE `user_course_status` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user_course_status`
--

INSERT INTO `user_course_status` (`id`, `name`) VALUES
(1, 'En cours'),
(2, 'Réussi'),
(3, 'Échouée'),
(4, 'Suspendue'),
(5, 'Abandonnée');

-- --------------------------------------------------------

--
-- Structure de la table `user_type`
--

CREATE TABLE `user_type` (
  `id` int(11) NOT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `access_level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `user_type`
--

INSERT INTO `user_type` (`id`, `name`, `access_level`) VALUES
(1, 'Administrateur', 4),
(2, 'Formateur', 2),
(3, 'Apprenti', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `acquisition_level`
--
ALTER TABLE `acquisition_level`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `acquisition_status`
--
ALTER TABLE `acquisition_status`
  ADD PRIMARY KEY (`id`),
  ADD KEY `constraint_acquisition_statut_level` (`fk_acquisition_level`),
  ADD KEY `constraint_objective_acquisition_statut` (`fk_objective`),
  ADD KEY `constraint_user_acquisition_statut` (`fk_user_course`);

--
-- Index pour la table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Index pour la table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_acquisition_status` (`fk_acquisition_status`),
  ADD KEY `fk_trainer` (`fk_trainer`);

--
-- Index pour la table `competence_domain`
--
ALTER TABLE `competence_domain`
  ADD PRIMARY KEY (`id`),
  ADD KEY `constraint_competence_domain_course_plan` (`fk_course_plan`);

--
-- Index pour la table `course_plan`
--
ALTER TABLE `course_plan`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `objective`
--
ALTER TABLE `objective`
  ADD PRIMARY KEY (`id`),
  ADD KEY `constraint_operational_competence` (`fk_operational_competence`);

--
-- Index pour la table `operational_competence`
--
ALTER TABLE `operational_competence`
  ADD PRIMARY KEY (`id`),
  ADD KEY `constraint_domain_operational` (`fk_competence_domain`);

--
-- Index pour la table `trainer_apprentice`
--
ALTER TABLE `trainer_apprentice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_trainer` (`fk_trainer`,`fk_apprentice`),
  ADD KEY `fk_apprentice` (`fk_apprentice`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_user_type1_idx` (`fk_user_type`);

--
-- Index pour la table `user_course`
--
ALTER TABLE `user_course`
  ADD PRIMARY KEY (`id`),
  ADD KEY `constraint_user` (`fk_user`),
  ADD KEY `constraint_user_course_plan` (`fk_course_plan`),
  ADD KEY `constraint_status` (`fk_status`);

--
-- Index pour la table `user_course_status`
--
ALTER TABLE `user_course_status`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `acquisition_status`
--
ALTER TABLE `acquisition_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=303;

--
-- AUTO_INCREMENT pour la table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `competence_domain`
--
ALTER TABLE `competence_domain`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `course_plan`
--
ALTER TABLE `course_plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `objective`
--
ALTER TABLE `objective`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=333;

--
-- AUTO_INCREMENT pour la table `operational_competence`
--
ALTER TABLE `operational_competence`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT pour la table `trainer_apprentice`
--
ALTER TABLE `trainer_apprentice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `user_course`
--
ALTER TABLE `user_course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `user_course_status`
--
ALTER TABLE `user_course_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `acquisition_status`
--
ALTER TABLE `acquisition_status`
  ADD CONSTRAINT `constraint_acquisition_statut_level` FOREIGN KEY (`fk_acquisition_level`) REFERENCES `acquisition_level` (`id`),
  ADD CONSTRAINT `constraint_objective_acquisition_statut` FOREIGN KEY (`fk_objective`) REFERENCES `objective` (`id`),
  ADD CONSTRAINT `constraint_user_acquisition_statut` FOREIGN KEY (`fk_user_course`) REFERENCES `user_course` (`id`);

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`fk_acquisition_status`) REFERENCES `acquisition_status` (`id`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`fk_trainer`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `competence_domain`
--
ALTER TABLE `competence_domain`
  ADD CONSTRAINT `constraint_competence_domain_course_plan` FOREIGN KEY (`fk_course_plan`) REFERENCES `course_plan` (`id`);

--
-- Contraintes pour la table `objective`
--
ALTER TABLE `objective`
  ADD CONSTRAINT `constraint_operational_competence` FOREIGN KEY (`fk_operational_competence`) REFERENCES `operational_competence` (`id`);

--
-- Contraintes pour la table `operational_competence`
--
ALTER TABLE `operational_competence`
  ADD CONSTRAINT `constraint_domain_operational` FOREIGN KEY (`fk_competence_domain`) REFERENCES `competence_domain` (`id`);

--
-- Contraintes pour la table `trainer_apprentice`
--
ALTER TABLE `trainer_apprentice`
  ADD CONSTRAINT `trainer_apprentice_ibfk_1` FOREIGN KEY (`fk_trainer`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `trainer_apprentice_ibfk_2` FOREIGN KEY (`fk_apprentice`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_user_type1` FOREIGN KEY (`fk_user_type`) REFERENCES `user_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `user_course`
--
ALTER TABLE `user_course`
  ADD CONSTRAINT `constraint_status` FOREIGN KEY (`fk_status`) REFERENCES `user_course_status` (`id`),
  ADD CONSTRAINT `constraint_user` FOREIGN KEY (`fk_user`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `constraint_user_course_plan` FOREIGN KEY (`fk_course_plan`) REFERENCES `course_plan` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
