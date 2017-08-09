-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 07, 2017 at 05:32 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mt_holidays`
--
CREATE DATABASE IF NOT EXISTS `mt_holidays` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `mt_holidays`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `adminId` int(11) NOT NULL AUTO_INCREMENT,
  `userName` varchar(50) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `fullName` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(220) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`adminId`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminId`, `userName`, `fullName`, `email`, `password`, `status`) VALUES
(2, 'admin@example.com', 'Admin', 'admin@example.com', 'YWRtaW4=~71de505ba84cc0900e2e7d41f4d84cac9d064c1f', 1);

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

DROP TABLE IF EXISTS `banner`;
CREATE TABLE IF NOT EXISTS `banner` (
  `bannerId` int(11) NOT NULL AUTO_INCREMENT,
  `caption` varchar(350) DEFAULT NULL,
  `image` varchar(370) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `url` varchar(350) DEFAULT NULL,
  PRIMARY KEY (`bannerId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`bannerId`, `caption`, `image`, `status`, `url`) VALUES
(2, 'test caption', '28e5b986f75600bb94f22fd7f7439cea.JPG', 1, 'http://test.com/');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `categoryId` int(11) NOT NULL AUTO_INCREMENT,
  `parrentCategoryId` int(11) NOT NULL,
  `categoryName` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `image` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `type` int(11) NOT NULL,
  PRIMARY KEY (`categoryId`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryId`, `parrentCategoryId`, `categoryName`, `image`, `status`, `type`) VALUES
(5, 0, 'Standard  & Medium Resort', NULL, 1, 1),
(3, 0, 'Tour & Package', NULL, 1, 2),
(4, 0, 'Cheap Holidays', NULL, 1, 1),
(6, 0, 'Luxurey & Supper Luxury Resort', NULL, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cms`
--

DROP TABLE IF EXISTS `cms`;
CREATE TABLE IF NOT EXISTS `cms` (
  `cmsId` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `metaTitle` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `metaKeyWord` text COLLATE latin1_general_ci NOT NULL,
  `metaDescription` text COLLATE latin1_general_ci NOT NULL,
  `shortBody` text COLLATE latin1_general_ci NOT NULL,
  `body` longtext COLLATE latin1_general_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`cmsId`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `cms`
--

INSERT INTO `cms` (`cmsId`, `title`, `metaTitle`, `metaKeyWord`, `metaDescription`, `shortBody`, `body`, `status`) VALUES
(1, 'test title', 'test title', 'test title', 'test title', 'test title', '<p>\r\n	<img alt="" src="http://localhost/md-holidays/assets/ck_files/1497284409.jpg" style="height: 94px; width: 125px;" xss="removed" />test title</p>\r\n', 1);

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

DROP TABLE IF EXISTS `country`;
CREATE TABLE IF NOT EXISTS `country` (
  `countryId` int(11) NOT NULL AUTO_INCREMENT,
  `countryCode` varchar(3) NOT NULL DEFAULT '',
  `countryName` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`countryId`)
) ENGINE=MyISAM AUTO_INCREMENT=240 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`countryId`, `countryCode`, `countryName`) VALUES
(1, 'US', 'United States'),
(2, 'CA', 'Canada'),
(3, 'AF', 'Afghanistan'),
(4, 'AL', 'Albania'),
(5, 'DZ', 'Algeria'),
(6, 'DS', 'American Samoa'),
(7, 'AD', 'Andorra'),
(8, 'AO', 'Angola'),
(9, 'AI', 'Anguilla'),
(10, 'AQ', 'Antarctica'),
(11, 'AG', 'Antigua and/or Barbuda'),
(12, 'AR', 'Argentina'),
(13, 'AM', 'Armenia'),
(14, 'AW', 'Aruba'),
(15, 'AU', 'Australia'),
(16, 'AT', 'Austria'),
(17, 'AZ', 'Azerbaijan'),
(18, 'BS', 'Bahamas'),
(19, 'BH', 'Bahrain'),
(20, 'BD', 'Bangladesh'),
(21, 'BB', 'Barbados'),
(22, 'BY', 'Belarus'),
(23, 'BE', 'Belgium'),
(24, 'BZ', 'Belize'),
(25, 'BJ', 'Benin'),
(26, 'BM', 'Bermuda'),
(27, 'BT', 'Bhutan'),
(28, 'BO', 'Bolivia'),
(29, 'BA', 'Bosnia and Herzegovina'),
(30, 'BW', 'Botswana'),
(31, 'BV', 'Bouvet Island'),
(32, 'BR', 'Brazil'),
(33, 'IO', 'British lndian Ocean Territory'),
(34, 'BN', 'Brunei Darussalam'),
(35, 'BG', 'Bulgaria'),
(36, 'BF', 'Burkina Faso'),
(37, 'BI', 'Burundi'),
(38, 'KH', 'Cambodia'),
(39, 'CM', 'Cameroon'),
(40, 'CV', 'Cape Verde'),
(41, 'KY', 'Cayman Islands'),
(42, 'CF', 'Central African Republic'),
(43, 'TD', 'Chad'),
(44, 'CL', 'Chile'),
(45, 'CN', 'China'),
(46, 'CX', 'Christmas Island'),
(47, 'CC', 'Cocos (Keeling) Islands'),
(48, 'CO', 'Colombia'),
(49, 'KM', 'Comoros'),
(50, 'CG', 'Congo'),
(51, 'CK', 'Cook Islands'),
(52, 'CR', 'Costa Rica'),
(53, 'HR', 'Croatia (Hrvatska)'),
(54, 'CU', 'Cuba'),
(55, 'CY', 'Cyprus'),
(56, 'CZ', 'Czech Republic'),
(57, 'DK', 'Denmark'),
(58, 'DJ', 'Djibouti'),
(59, 'DM', 'Dominica'),
(60, 'DO', 'Dominican Republic'),
(61, 'TP', 'East Timor'),
(62, 'EC', 'Ecudaor'),
(63, 'EG', 'Egypt'),
(64, 'SV', 'El Salvador'),
(65, 'GQ', 'Equatorial Guinea'),
(66, 'ER', 'Eritrea'),
(67, 'EE', 'Estonia'),
(68, 'ET', 'Ethiopia'),
(69, 'FK', 'Falkland Islands (Malvinas)'),
(70, 'FO', 'Faroe Islands'),
(71, 'FJ', 'Fiji'),
(72, 'FI', 'Finland'),
(73, 'FR', 'France'),
(74, 'FX', 'France, Metropolitan'),
(75, 'GF', 'French Guiana'),
(76, 'PF', 'French Polynesia'),
(77, 'TF', 'French Southern Territories'),
(78, 'GA', 'Gabon'),
(79, 'GM', 'Gambia'),
(80, 'GE', 'Georgia'),
(81, 'DE', 'Germany'),
(82, 'GH', 'Ghana'),
(83, 'GI', 'Gibraltar'),
(84, 'GR', 'Greece'),
(85, 'GL', 'Greenland'),
(86, 'GD', 'Grenada'),
(87, 'GP', 'Guadeloupe'),
(88, 'GU', 'Guam'),
(89, 'GT', 'Guatemala'),
(90, 'GN', 'Guinea'),
(91, 'GW', 'Guinea-Bissau'),
(92, 'GY', 'Guyana'),
(93, 'HT', 'Haiti'),
(94, 'HM', 'Heard and Mc Donald Islands'),
(95, 'HN', 'Honduras'),
(96, 'HK', 'Hong Kong'),
(97, 'HU', 'Hungary'),
(98, 'IS', 'Iceland'),
(99, 'IN', 'India'),
(100, 'ID', 'Indonesia'),
(101, 'IR', 'Iran (Islamic Republic of)'),
(102, 'IQ', 'Iraq'),
(103, 'IE', 'Ireland'),
(104, 'IL', 'Israel'),
(105, 'IT', 'Italy'),
(106, 'CI', 'Ivory Coast'),
(107, 'JM', 'Jamaica'),
(108, 'JP', 'Japan'),
(109, 'JO', 'Jordan'),
(110, 'KZ', 'Kazakhstan'),
(111, 'KE', 'Kenya'),
(112, 'KI', 'Kiribati'),
(113, 'KP', 'Korea, Democratic People''s Republic of'),
(114, 'KR', 'Korea, Republic of'),
(115, 'KW', 'Kuwait'),
(116, 'KG', 'Kyrgyzstan'),
(117, 'LA', 'Lao People''s Democratic Republic'),
(118, 'LV', 'Latvia'),
(119, 'LB', 'Lebanon'),
(120, 'LS', 'Lesotho'),
(121, 'LR', 'Liberia'),
(122, 'LY', 'Libyan Arab Jamahiriya'),
(123, 'LI', 'Liechtenstein'),
(124, 'LT', 'Lithuania'),
(125, 'LU', 'Luxembourg'),
(126, 'MO', 'Macau'),
(127, 'MK', 'Macedonia'),
(128, 'MG', 'Madagascar'),
(129, 'MW', 'Malawi'),
(130, 'MY', 'Malaysia'),
(131, 'MV', 'Maldives'),
(132, 'ML', 'Mali'),
(133, 'MT', 'Malta'),
(134, 'MH', 'Marshall Islands'),
(135, 'MQ', 'Martinique'),
(136, 'MR', 'Mauritania'),
(137, 'MU', 'Mauritius'),
(138, 'TY', 'Mayotte'),
(139, 'MX', 'Mexico'),
(140, 'FM', 'Micronesia, Federated States of'),
(141, 'MD', 'Moldova, Republic of'),
(142, 'MC', 'Monaco'),
(143, 'MN', 'Mongolia'),
(144, 'MS', 'Montserrat'),
(145, 'MA', 'Morocco'),
(146, 'MZ', 'Mozambique'),
(147, 'MM', 'Myanmar'),
(148, 'NA', 'Namibia'),
(149, 'NR', 'Nauru'),
(150, 'NP', 'Nepal'),
(151, 'NL', 'Netherlands'),
(152, 'AN', 'Netherlands Antilles'),
(153, 'NC', 'New Caledonia'),
(154, 'NZ', 'New Zealand'),
(155, 'NI', 'Nicaragua'),
(156, 'NE', 'Niger'),
(157, 'NG', 'Nigeria'),
(158, 'NU', 'Niue'),
(159, 'NF', 'Norfork Island'),
(160, 'MP', 'Northern Mariana Islands'),
(161, 'NO', 'Norway'),
(162, 'OM', 'Oman'),
(163, 'PK', 'Pakistan'),
(164, 'PW', 'Palau'),
(165, 'PA', 'Panama'),
(166, 'PG', 'Papua New Guinea'),
(167, 'PY', 'Paraguay'),
(168, 'PE', 'Peru'),
(169, 'PH', 'Philippines'),
(170, 'PN', 'Pitcairn'),
(171, 'PL', 'Poland'),
(172, 'PT', 'Portugal'),
(173, 'PR', 'Puerto Rico'),
(174, 'QA', 'Qatar'),
(175, 'RE', 'Reunion'),
(176, 'RO', 'Romania'),
(177, 'RU', 'Russian Federation'),
(178, 'RW', 'Rwanda'),
(179, 'KN', 'Saint Kitts and Nevis'),
(180, 'LC', 'Saint Lucia'),
(181, 'VC', 'Saint Vincent and the Grenadines'),
(182, 'WS', 'Samoa'),
(183, 'SM', 'San Marino'),
(184, 'ST', 'Sao Tome and Principe'),
(185, 'SA', 'Saudi Arabia'),
(186, 'SN', 'Senegal'),
(187, 'SC', 'Seychelles'),
(188, 'SL', 'Sierra Leone'),
(189, 'SG', 'Singapore'),
(190, 'SK', 'Slovakia'),
(191, 'SI', 'Slovenia'),
(192, 'SB', 'Solomon Islands'),
(193, 'SO', 'Somalia'),
(194, 'ZA', 'South Africa'),
(195, 'GS', 'South Georgia South Sandwich Islands'),
(196, 'ES', 'Spain'),
(197, 'LK', 'Sri Lanka'),
(198, 'SH', 'St. Helena'),
(199, 'PM', 'St. Pierre and Miquelon'),
(200, 'SD', 'Sudan'),
(201, 'SR', 'Suriname'),
(202, 'SJ', 'Svalbarn and Jan Mayen Islands'),
(203, 'SZ', 'Swaziland'),
(204, 'SE', 'Sweden'),
(205, 'CH', 'Switzerland'),
(206, 'SY', 'Syrian Arab Republic'),
(207, 'TW', 'Taiwan'),
(208, 'TJ', 'Tajikistan'),
(209, 'TZ', 'Tanzania, United Republic of'),
(210, 'TH', 'Thailand'),
(211, 'TG', 'Togo'),
(212, 'TK', 'Tokelau'),
(213, 'TO', 'Tonga'),
(214, 'TT', 'Trinidad and Tobago'),
(215, 'TN', 'Tunisia'),
(216, 'TR', 'Turkey'),
(217, 'TM', 'Turkmenistan'),
(218, 'TC', 'Turks and Caicos Islands'),
(219, 'TV', 'Tuvalu'),
(220, 'UG', 'Uganda'),
(221, 'UA', 'Ukraine'),
(222, 'AE', 'United Arab Emirates'),
(223, 'GB', 'United Kingdom'),
(224, 'UM', 'United States minor outlying islands'),
(225, 'UY', 'Uruguay'),
(226, 'UZ', 'Uzbekistan'),
(227, 'VU', 'Vanuatu'),
(228, 'VA', 'Vatican City State'),
(229, 'VE', 'Venezuela'),
(230, 'VN', 'Vietnam'),
(231, 'VG', 'Virigan Islands (British)'),
(232, 'VI', 'Virgin Islands (U.S.)'),
(233, 'WF', 'Wallis and Futuna Islands'),
(234, 'EH', 'Western Sahara'),
(235, 'YE', 'Yemen'),
(236, 'YU', 'Yugoslavia'),
(237, 'ZR', 'Zaire'),
(238, 'ZM', 'Zambia'),
(239, 'ZW', 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `enjay_type`
--

DROP TABLE IF EXISTS `enjay_type`;
CREATE TABLE IF NOT EXISTS `enjay_type` (
  `enjoyTypeId` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(110) NOT NULL,
  `image` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`enjoyTypeId`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `enjay_type`
--

INSERT INTO `enjay_type` (`enjoyTypeId`, `name`, `image`, `status`) VALUES
(13, 'Honeymoon', 'ee1bb5acb055f13e052fb3c71d87cd2b.png', 1),
(14, 'Diving', 'd8e80f6c21b36d8c0ebb73f38dc59a54.png', 1),
(15, 'Family', 'b7cde38f0bd15d096badb539fd4d8800.png', 1),
(16, 'Business', 'a61db79ac6574a01cf5efa374a056f0e.png', 1),
(17, 'Leisure', '3538b506c45440923b4570072db0693c.png', 1),
(18, 'Excursion', '2bb48c798c052e3de0680158bea59a6d.png', 1),
(19, 'Restaurant', 'ada3429125c79d84c59beff8dd954253.png', 1),
(20, 'Bar', '3959a1c5e19bdfc7f8be1c0b16bbb88d.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `facility`
--

DROP TABLE IF EXISTS `facility`;
CREATE TABLE IF NOT EXISTS `facility` (
  `facilityId` int(11) NOT NULL AUTO_INCREMENT,
  `facility` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`facilityId`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `facility`
--

INSERT INTO `facility` (`facilityId`, `facility`, `status`) VALUES
(1, 'Wifi in public areas', 1),
(2, 'Wifi in rooms', 1),
(3, 'Fax/Copy Services', 1),
(4, 'Laundry Seravices', 1),
(5, '24 hrs Front Desk', 1),
(6, 'Dry Cleanoing', 1),
(7, 'Airport Transport', 1);

-- --------------------------------------------------------

--
-- Table structure for table `factfile`
--

DROP TABLE IF EXISTS `factfile`;
CREATE TABLE IF NOT EXISTS `factfile` (
  `factfileId` bigint(20) NOT NULL AUTO_INCREMENT,
  `factfile` varchar(40) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`factfileId`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `factfile`
--

INSERT INTO `factfile` (`factfileId`, `factfile`, `status`) VALUES
(1, 'Located at Airport', 1),
(2, 'Seeplane available', 1),
(3, '2nd height vilal in maldives', 1),
(4, 'checkin 2 pm', 1),
(5, 'checkout 12 am', 1),
(6, '2 bar', 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu_category`
--

DROP TABLE IF EXISTS `menu_category`;
CREATE TABLE IF NOT EXISTS `menu_category` (
  `menuCategoryId` int(11) NOT NULL AUTO_INCREMENT,
  `menuCategoryName` varchar(50) NOT NULL,
  `menuParentCategoryId` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`menuCategoryId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_category`
--

INSERT INTO `menu_category` (`menuCategoryId`, `menuCategoryName`, `menuParentCategoryId`, `status`) VALUES
(1, 'Resort', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `resort`
--

DROP TABLE IF EXISTS `resort`;
CREATE TABLE IF NOT EXISTS `resort` (
  `resortId` bigint(20) NOT NULL AUTO_INCREMENT,
  `title` varchar(350) NOT NULL,
  `shortBody` varchar(350) DEFAULT NULL,
  `body` text,
  `overview` varchar(350) NOT NULL,
  `mapZoomLevel` tinyint(1) NOT NULL DEFAULT '1',
  `latitude` varchar(30) DEFAULT NULL,
  `longitude` varchar(30) DEFAULT NULL,
  `addedDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `metaDescription` varchar(550) DEFAULT NULL,
  `metaKeywords` varchar(300) DEFAULT NULL,
  `metaTitle` varchar(150) NOT NULL,
  `location` varchar(100) NOT NULL,
  `contactInfo` varchar(350) NOT NULL,
  `categoryId` int(11) NOT NULL,
  PRIMARY KEY (`resortId`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `resort`
--

INSERT INTO `resort` (`resortId`, `title`, `shortBody`, `body`, `overview`, `mapZoomLevel`, `latitude`, `longitude`, `addedDate`, `status`, `metaDescription`, `metaKeywords`, `metaTitle`, `location`, `contactInfo`, `categoryId`) VALUES
(3, 'Bandos Maldives', NULL, NULL, 'Bandos Maldives', 1, '25.299999', '28.299999', '2017-06-30 16:47:43', 1, 'Bandos Maldives meta description', 'Bandos Maldives meta', 'Bandos Maldives meta title', 'Hulumale Island', '<p>\r\n value="</p>\r\n<p>\r\n Bandos Maldives<br>\r\n  </p>\r\n<p>\r\n "</p>', 0);

-- --------------------------------------------------------

--
-- Table structure for table `resort_enjay_type`
--

DROP TABLE IF EXISTS `resort_enjay_type`;
CREATE TABLE IF NOT EXISTS `resort_enjay_type` (
  `resortEnjayTypeId` bigint(20) NOT NULL AUTO_INCREMENT,
  `resortId` int(11) NOT NULL,
  `enjayTypeId` int(11) NOT NULL,
  PRIMARY KEY (`resortEnjayTypeId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `resort_enjay_type_ratting`
--

DROP TABLE IF EXISTS `resort_enjay_type_ratting`;
CREATE TABLE IF NOT EXISTS `resort_enjay_type_ratting` (
  `resortEnjayTypeRattingId` bigint(20) NOT NULL AUTO_INCREMENT,
  `resortEnjayTypeId` int(11) NOT NULL,
  `ratting` int(11) NOT NULL,
  `IP` varchar(30) NOT NULL,
  `addedDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`resortEnjayTypeRattingId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `resort_facility`
--

DROP TABLE IF EXISTS `resort_facility`;
CREATE TABLE IF NOT EXISTS `resort_facility` (
  `resortFacilityId` bigint(20) NOT NULL AUTO_INCREMENT,
  `resortId` int(11) NOT NULL,
  `facilityId` int(11) NOT NULL,
  PRIMARY KEY (`resortFacilityId`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `resort_facility`
--

INSERT INTO `resort_facility` (`resortFacilityId`, `resortId`, `facilityId`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 1, 7),
(8, 1, 8),
(9, 1, 9),
(16, 3, 1),
(17, 3, 2),
(18, 3, 5);

-- --------------------------------------------------------

--
-- Table structure for table `resort_factfile`
--

DROP TABLE IF EXISTS `resort_factfile`;
CREATE TABLE IF NOT EXISTS `resort_factfile` (
  `resortFactfileId` bigint(20) NOT NULL AUTO_INCREMENT,
  `resortId` int(11) NOT NULL,
  `factfileId` int(11) NOT NULL,
  PRIMARY KEY (`resortFactfileId`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `resort_factfile`
--

INSERT INTO `resort_factfile` (`resortFactfileId`, `resortId`, `factfileId`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 1, 7),
(8, 1, 8),
(18, 3, 1),
(19, 3, 2),
(20, 3, 3),
(21, 3, 4);

-- --------------------------------------------------------

--
-- Table structure for table `resort_image`
--

DROP TABLE IF EXISTS `resort_image`;
CREATE TABLE IF NOT EXISTS `resort_image` (
  `resortImageId` int(11) NOT NULL AUTO_INCREMENT,
  `resortId` int(11) NOT NULL,
  `image` varchar(250) NOT NULL,
  `caption` varchar(150) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `featured` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`resortImageId`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `resort_image`
--

INSERT INTO `resort_image` (`resortImageId`, `resortId`, `image`, `caption`, `status`, `featured`) VALUES
(16, 3, 'a7ff9b9e4502856f155464d2282a3e29.jpg', NULL, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `resort_ratting`
--

DROP TABLE IF EXISTS `resort_ratting`;
CREATE TABLE IF NOT EXISTS `resort_ratting` (
  `resortRattingId` bigint(20) NOT NULL AUTO_INCREMENT,
  `resortId` bigint(20) NOT NULL,
  `ratting` tinyint(4) NOT NULL,
  `IP` varchar(25) NOT NULL,
  `rate_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`resortRattingId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `resort_room`
--

DROP TABLE IF EXISTS `resort_room`;
CREATE TABLE IF NOT EXISTS `resort_room` (
  `resortRoomId` int(11) NOT NULL AUTO_INCREMENT,
  `roomTypeId` int(11) NOT NULL,
  `image` varchar(100) NOT NULL,
  `title` varchar(50) NOT NULL,
  `orderNo` int(11) DEFAULT NULL,
  `totalNosRoom` int(11) DEFAULT NULL,
  `taxAndServiceCharges` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `roomDescription` varchar(500) DEFAULT NULL,
  `resortId` int(11) NOT NULL,
  `needPay` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`resortRoomId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `resort_room_charges`
--

DROP TABLE IF EXISTS `resort_room_charges`;
CREATE TABLE IF NOT EXISTS `resort_room_charges` (
  `resortRoomChargesId` bigint(20) NOT NULL AUTO_INCREMENT,
  `resortRoomId` int(11) NOT NULL,
  `bookingStartDate` date NOT NULL,
  `bookingEndDate` date NOT NULL,
  `oneAdult` int(11) NOT NULL,
  `twoAdult` int(11) NOT NULL,
  `threeAdult` int(11) NOT NULL,
  `fourAdult` int(11) NOT NULL,
  `extraPerAdult` int(11) NOT NULL,
  `childRate` int(11) NOT NULL,
  `maxChild` tinyint(1) NOT NULL DEFAULT '1',
  `infantRate` int(11) NOT NULL,
  `maxInfant` tinyint(1) NOT NULL DEFAULT '1',
  `extraChargesForInfantChild` int(11) NOT NULL,
  PRIMARY KEY (`resortRoomChargesId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `resort_sports_recreation`
--

DROP TABLE IF EXISTS `resort_sports_recreation`;
CREATE TABLE IF NOT EXISTS `resort_sports_recreation` (
  `resortSportsRecreationId` bigint(20) NOT NULL AUTO_INCREMENT,
  `resortId` int(11) NOT NULL,
  `sportsRecreationId` int(11) NOT NULL,
  PRIMARY KEY (`resortSportsRecreationId`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `resort_sports_recreation`
--

INSERT INTO `resort_sports_recreation` (`resortSportsRecreationId`, `resortId`, `sportsRecreationId`) VALUES
(3, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `room_details`
--

DROP TABLE IF EXISTS `room_details`;
CREATE TABLE IF NOT EXISTS `room_details` (
  `roomDetailsId` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(30) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`roomDetailsId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room_details`
--

INSERT INTO `room_details` (`roomDetailsId`, `title`, `status`) VALUES
(1, 'Facing to beach', 1);

-- --------------------------------------------------------

--
-- Table structure for table `room_type`
--

DROP TABLE IF EXISTS `room_type`;
CREATE TABLE IF NOT EXISTS `room_type` (
  `roomTypeId` int(11) NOT NULL AUTO_INCREMENT,
  `roomType` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`roomTypeId`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room_type`
--

INSERT INTO `room_type` (`roomTypeId`, `roomType`, `status`) VALUES
(2, 'tet', 1),
(3, 'Standard Room', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sports_recreation`
--

DROP TABLE IF EXISTS `sports_recreation`;
CREATE TABLE IF NOT EXISTS `sports_recreation` (
  `sportsRecreationId` bigint(20) NOT NULL AUTO_INCREMENT,
  `sportsRecreation` varchar(70) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`sportsRecreationId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sports_recreation`
--

INSERT INTO `sports_recreation` (`sportsRecreationId`, `sportsRecreation`, `status`) VALUES
(2, 'Volly Ball', 1);

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

DROP TABLE IF EXISTS `state`;
CREATE TABLE IF NOT EXISTS `state` (
  `stateId` bigint(11) NOT NULL AUTO_INCREMENT,
  `stateName` varchar(255) DEFAULT NULL,
  `countryId` int(11) NOT NULL,
  PRIMARY KEY (`stateId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`stateId`, `stateName`, `countryId`) VALUES
(1, 'Alabama', 1),
(2, 'Alaska', 1),
(3, 'Arizona', 1),
(4, 'Arkansas', 1),
(5, 'California', 1),
(6, 'Colorado', 1),
(7, 'Connecticut', 1),
(8, 'Delaware', 1),
(9, 'Florida', 1),
(10, 'Georgia', 1),
(11, 'Hawaii', 1),
(12, 'Idaho', 1),
(13, 'Illinois', 1),
(14, 'Indiana', 1),
(15, 'Iowa', 1),
(16, 'Kansas', 1),
(17, 'Kentucky', 1),
(18, 'Louisiana', 1),
(19, 'Maine', 1),
(20, 'Maryland', 1),
(21, 'Massachusetts', 1),
(22, 'Michigan', 1),
(23, 'Minnesota', 1),
(24, 'Mississippi', 1),
(25, 'Missouri', 1),
(26, 'Montana', 1),
(27, 'Nebraska', 1),
(28, 'Nevada', 1),
(29, 'New Hampshire', 1),
(30, 'New Jersey', 1),
(31, 'New Mexico', 1),
(32, 'New York', 1),
(33, 'North Carolina', 1),
(34, 'North Dakota', 1),
(35, 'Ohio', 1),
(36, 'Oklahoma', 1),
(37, 'Oregon', 1),
(38, 'Pennsylvania', 1),
(39, 'Rhode Island', 1),
(40, 'South Carolina', 1),
(41, 'South Dakota', 1),
(42, 'Tennessee', 1),
(43, 'Texas', 1),
(44, 'Utah', 1),
(45, 'Vermont', 1),
(46, 'Virginia', 1),
(47, 'Washington', 1),
(48, 'West Virginia', 1),
(49, 'Wisconsin', 1),
(50, 'Wyoming', 1),
(52, 'Puerto Rico', 1),
(53, 'U.S. Virgin Islands', 1),
(54, 'American Samoa', 1),
(55, 'Guam', 1),
(56, 'Northern Mariana Islands', 1),
(60, 'Alberta ', 2),
(61, 'British Columbia ', 2),
(62, 'Manitoba ', 2),
(63, 'New Brunswick ', 2),
(64, 'Newfoundland and Labrador ', 2),
(65, 'Nova Scotia ', 2),
(66, 'Ontario ', 2),
(67, 'Prince Edward Island ', 2),
(68, 'Quebec ', 2),
(69, 'Saskatchewan ', 2),
(70, 'Northwest Territories ', 2),
(71, 'Nunavut ', 2),
(72, 'Yukon Territory ', 2),
(73, 'ANDAMAN AND NICOBAR ISLANDS', 99),
(74, 'ANDHRA PRADESH', 99),
(75, 'ASSAM', 99),
(76, 'BIHAR', 99),
(77, 'CHATTISGARH', 99),
(78, 'CHANDIGARH', 99),
(79, 'DAMAN AND DIU', 99),
(80, 'DELHI', 99),
(81, 'DADRA AND NAGAR HAVELI', 99),
(82, 'GOA', 99),
(83, 'GUJARAT', 99),
(84, 'HIMACHAL PRADESH', 99),
(85, 'HARYANA', 99),
(86, 'JAMMU AND KASHMIR', 99),
(87, 'JHARKHAND', 99),
(88, 'KERALA', 99),
(89, 'KARNATAKA', 99),
(90, 'LAKSHADWEEP', 99),
(91, 'MEGHALAYA', 99),
(92, 'MAHARASHTRA', 99),
(93, 'MANIPUR', 99),
(94, 'MADHYA PRADESH', 99),
(95, 'MIZORAM', 99),
(96, 'NAGALAND', 99),
(97, 'ORISSA', 99),
(98, 'PUNJAB', 99),
(99, 'PONDICHERRY', 99),
(100, 'RAJASTHAN', 99),
(101, 'SIKKIM', 99),
(102, 'TAMIL NADU', 99),
(103, 'TRIPURA', 99),
(104, 'UTTARAKHAND', 99),
(105, 'UTTAR PRADESH', 99),
(106, 'WEST BENGAL', 99),
(107, 'Others', 1000);

-- --------------------------------------------------------

--
-- Table structure for table `system_constants`
--

DROP TABLE IF EXISTS `system_constants`;
CREATE TABLE IF NOT EXISTS `system_constants` (
  `constantId` int(11) NOT NULL AUTO_INCREMENT,
  `constantName` varchar(200) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `constantValue` varchar(200) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `description` varchar(240) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`constantId`),
  UNIQUE KEY `ConstantName` (`constantName`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `system_constants`
--

INSERT INTO `system_constants` (`constantId`, `constantName`, `constantValue`, `description`) VALUES
(1, 'AdminMail', 'admin@admin.com', 'admin email'),
(2, 'SiteMail', 'judhisahoo@gmail.com', 'judhisahoo@gmail.com'),
(3, 'MetaTitle', 'http://www.amateurtaekwondoassociationofdhenkanal.com', 'http://www.amateurtaekwondoassociationofdhenkanal.com'),
(4, 'MetaKeyWord', 'Taekwondow', 'Taekwondow'),
(5, 'SupportEmail', 'judhisahoo@gmail.com', 'Email id for support inquiry message'),
(6, 'MetaDescription', 'Maldive traverller  For You Description', ''),
(7, 'ContactNo', '9556644964', NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
