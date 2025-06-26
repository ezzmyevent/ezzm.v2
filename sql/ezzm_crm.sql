-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2025 at 11:22 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ezzmyevent2025`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'ezzmyevent@admin.com', '$2a$12$UH0AAeyvuX1RjsHweLGAcuvHE9P6kPr8lrQg/3BOAfdRSrquxH/2y', '2025-03-10 07:01:47', '2025-05-22 04:42:28'),
(2, 'search@admin.com', '$2a$12$UH0AAeyvuX1RjsHweLGAcuvHE9P6kPr8lrQg/3BOAfdRSrquxH/2y', '2025-03-10 07:01:47', '2025-05-22 10:30:37');

-- --------------------------------------------------------

--
-- Table structure for table `app_login`
--

CREATE TABLE `app_login` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `app_login`
--

INSERT INTO `app_login` (`id`, `role_id`, `username`, `category`, `created_at`, `updated_at`) VALUES
(1, 3, '1111111113', 'Zapping', '2022-04-25 08:45:54', '2022-04-25 08:45:54'),
(3, 2, '1111111112', 'Visitor Onground', '2022-04-25 08:45:54', '2022-04-25 08:45:54');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sortname` varchar(10) NOT NULL,
  `name` varchar(150) NOT NULL,
  `phonecode` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `sortname`, `name`, `phonecode`) VALUES
(1, 'AF', 'Afghanistan', '93'),
(2, 'AL', 'Albania', '355'),
(3, 'DZ', 'Algeria', '213'),
(4, 'AS', 'American Samoa', '1684'),
(5, 'AD', 'Andorra', '376'),
(6, 'AO', 'Angola', '244'),
(7, 'AI', 'Anguilla', '1264'),
(8, 'AQ', 'Antarctica', '0'),
(9, 'AG', 'Antigua And Barbuda', '1268'),
(10, 'AR', 'Argentina', '54'),
(11, 'AM', 'Armenia', '374'),
(12, 'AW', 'Aruba', '297'),
(13, 'AU', 'Australia', '61'),
(14, 'AT', 'Austria', '43'),
(15, 'AZ', 'Azerbaijan', '994'),
(16, 'BS', 'Bahamas The', '1242'),
(17, 'BH', 'Bahrain', '973'),
(18, 'BD', 'Bangladesh', '880'),
(19, 'BB', 'Barbados', '1246'),
(20, 'BY', 'Belarus', '375'),
(21, 'BE', 'Belgium', '32'),
(22, 'BZ', 'Belize', '501'),
(23, 'BJ', 'Benin', '229'),
(24, 'BM', 'Bermuda', '1441'),
(25, 'BT', 'Bhutan', '975'),
(26, 'BO', 'Bolivia', '591'),
(27, 'BA', 'Bosnia and Herzegovina', '387'),
(28, 'BW', 'Botswana', '267'),
(29, 'BV', 'Bouvet Island', '0'),
(30, 'BR', 'Brazil', '55'),
(31, 'IO', 'British Indian Ocean Territory', '246'),
(32, 'BN', 'Brunei', '673'),
(33, 'BG', 'Bulgaria', '359'),
(34, 'BF', 'Burkina Faso', '226'),
(35, 'BI', 'Burundi', '257'),
(36, 'KH', 'Cambodia', '855'),
(37, 'CM', 'Cameroon', '237'),
(38, 'CA', 'Canada', '1'),
(39, 'CV', 'Cape Verde', '238'),
(40, 'KY', 'Cayman Islands', '1345'),
(41, 'CF', 'Central African Republic', '236'),
(42, 'TD', 'Chad', '235'),
(43, 'CL', 'Chile', '56'),
(44, 'CN', 'China', '86'),
(45, 'CX', 'Christmas Island', '61'),
(46, 'CC', 'Cocos (Keeling) Islands', '672'),
(47, 'CO', 'Colombia', '57'),
(48, 'KM', 'Comoros', '269'),
(49, 'CG', 'Congo', '242'),
(50, 'CD', 'Congo The Democratic Republic Of The', '242'),
(51, 'CK', 'Cook Islands', '682'),
(52, 'CR', 'Costa Rica', '506'),
(53, 'CI', 'Cote D Ivoire (Ivory Coast)', '225'),
(54, 'HR', 'Croatia (Hrvatska)', '385'),
(55, 'CU', 'Cuba', '53'),
(56, 'CY', 'Cyprus', '357'),
(57, 'CZ', 'Czech Republic', '420'),
(58, 'DK', 'Denmark', '45'),
(59, 'DJ', 'Djibouti', '253'),
(60, 'DM', 'Dominica', '1767'),
(61, 'DO', 'Dominican Republic', '1809'),
(62, 'TP', 'East Timor', '670'),
(63, 'EC', 'Ecuador', '593'),
(64, 'EG', 'Egypt', '20'),
(65, 'SV', 'El Salvador', '503'),
(66, 'GQ', 'Equatorial Guinea', '240'),
(67, 'ER', 'Eritrea', '291'),
(68, 'EE', 'Estonia', '372'),
(69, 'ET', 'Ethiopia', '251'),
(70, 'XA', 'External Territories of Australia', '61'),
(71, 'FK', 'Falkland Islands', '500'),
(72, 'FO', 'Faroe Islands', '298'),
(73, 'FJ', 'Fiji Islands', '679'),
(74, 'FI', 'Finland', '358'),
(75, 'FR', 'France', '33'),
(76, 'GF', 'French Guiana', '594'),
(77, 'PF', 'French Polynesia', '689'),
(78, 'TF', 'French Southern Territories', '0'),
(79, 'GA', 'Gabon', '241'),
(80, 'GM', 'Gambia The', '220'),
(81, 'GE', 'Georgia', '995'),
(82, 'DE', 'Germany', '49'),
(83, 'GH', 'Ghana', '233'),
(84, 'GI', 'Gibraltar', '350'),
(85, 'GR', 'Greece', '30'),
(86, 'GL', 'Greenland', '299'),
(87, 'GD', 'Grenada', '1473'),
(88, 'GP', 'Guadeloupe', '590'),
(89, 'GU', 'Guam', '1671'),
(90, 'GT', 'Guatemala', '502'),
(91, 'XU', 'Guernsey and Alderney', '44'),
(92, 'GN', 'Guinea', '224'),
(93, 'GW', 'Guinea-Bissau', '245'),
(94, 'GY', 'Guyana', '592'),
(95, 'HT', 'Haiti', '509'),
(96, 'HM', 'Heard and McDonald Islands', '0'),
(97, 'HN', 'Honduras', '504'),
(98, 'HK', 'Hong Kong S.A.R.', '852'),
(99, 'HU', 'Hungary', '36'),
(100, 'IS', 'Iceland', '354'),
(101, 'IN', 'India', '91'),
(102, 'ID', 'Indonesia', '62'),
(103, 'IR', 'Iran', '98'),
(104, 'IQ', 'Iraq', '964'),
(105, 'IE', 'Ireland', '353'),
(106, 'IL', 'Israel', '972'),
(107, 'IT', 'Italy', '39'),
(108, 'JM', 'Jamaica', '1876'),
(109, 'JP', 'Japan', '81'),
(110, 'XJ', 'Jersey', '44'),
(111, 'JO', 'Jordan', '962'),
(112, 'KZ', 'Kazakhstan', '7'),
(113, 'KE', 'Kenya', '254'),
(114, 'KI', 'Kiribati', '686'),
(115, 'KP', 'Korea North', '850'),
(116, 'KR', 'Korea South', '82'),
(117, 'KW', 'Kuwait', '965'),
(118, 'KG', 'Kyrgyzstan', '996'),
(119, 'LA', 'Laos', '856'),
(120, 'LV', 'Latvia', '371'),
(121, 'LB', 'Lebanon', '961'),
(122, 'LS', 'Lesotho', '266'),
(123, 'LR', 'Liberia', '231'),
(124, 'LY', 'Libya', '218'),
(125, 'LI', 'Liechtenstein', '423'),
(126, 'LT', 'Lithuania', '370'),
(127, 'LU', 'Luxembourg', '352'),
(128, 'MO', 'Macau S.A.R.', '853'),
(129, 'MK', 'Macedonia', '389'),
(130, 'MG', 'Madagascar', '261'),
(131, 'MW', 'Malawi', '265'),
(132, 'MY', 'Malaysia', '60'),
(133, 'MV', 'Maldives', '960'),
(134, 'ML', 'Mali', '223'),
(135, 'MT', 'Malta', '356'),
(136, 'XM', 'Man (Isle of)', '44'),
(137, 'MH', 'Marshall Islands', '692'),
(138, 'MQ', 'Martinique', '596'),
(139, 'MR', 'Mauritania', '222'),
(140, 'MU', 'Mauritius', '230'),
(141, 'YT', 'Mayotte', '269'),
(142, 'MX', 'Mexico', '52'),
(143, 'FM', 'Micronesia', '691'),
(144, 'MD', 'Moldova', '373'),
(145, 'MC', 'Monaco', '377'),
(146, 'MN', 'Mongolia', '976'),
(147, 'MS', 'Montserrat', '1664'),
(148, 'MA', 'Morocco', '212'),
(149, 'MZ', 'Mozambique', '258'),
(150, 'MM', 'Myanmar', '95'),
(151, 'NA', 'Namibia', '264'),
(152, 'NR', 'Nauru', '674'),
(153, 'NP', 'Nepal', '977'),
(154, 'AN', 'Netherlands Antilles', '599'),
(155, 'NL', 'Netherlands The', '31'),
(156, 'NC', 'New Caledonia', '687'),
(157, 'NZ', 'New Zealand', '64'),
(158, 'NI', 'Nicaragua', '505'),
(159, 'NE', 'Niger', '227'),
(160, 'NG', 'Nigeria', '234'),
(161, 'NU', 'Niue', '683'),
(162, 'NF', 'Norfolk Island', '672'),
(163, 'MP', 'Northern Mariana Islands', '1670'),
(164, 'NO', 'Norway', '47'),
(165, 'OM', 'Oman', '968'),
(166, 'PK', 'Pakistan', '92'),
(167, 'PW', 'Palau', '680'),
(168, 'PS', 'Palestinian Territory Occupied', '970'),
(169, 'PA', 'Panama', '507'),
(170, 'PG', 'Papua new Guinea', '675'),
(171, 'PY', 'Paraguay', '595'),
(172, 'PE', 'Peru', '51'),
(173, 'PH', 'Philippines', '63'),
(174, 'PN', 'Pitcairn Island', '0'),
(175, 'PL', 'Poland', '48'),
(176, 'PT', 'Portugal', '351'),
(177, 'PR', 'Puerto Rico', '1787'),
(178, 'QA', 'Qatar', '974'),
(179, 'RE', 'Reunion', '262'),
(180, 'RO', 'Romania', '40'),
(181, 'RU', 'Russia', '70'),
(182, 'RW', 'Rwanda', '250'),
(183, 'SH', 'Saint Helena', '290'),
(184, 'KN', 'Saint Kitts And Nevis', '1869'),
(185, 'LC', 'Saint Lucia', '1758'),
(186, 'PM', 'Saint Pierre and Miquelon', '508'),
(187, 'VC', 'Saint Vincent And The Grenadines', '1784'),
(188, 'WS', 'Samoa', '684'),
(189, 'SM', 'San Marino', '378'),
(190, 'ST', 'Sao Tome and Principe', '239'),
(191, 'SA', 'Saudi Arabia', '966'),
(192, 'SN', 'Senegal', '221'),
(193, 'RS', 'Serbia', '381'),
(194, 'SC', 'Seychelles', '248'),
(195, 'SL', 'Sierra Leone', '232'),
(196, 'SG', 'Singapore', '65'),
(197, 'SK', 'Slovakia', '421'),
(198, 'SI', 'Slovenia', '386'),
(199, 'XG', 'Smaller Territories of the UK', '44'),
(200, 'SB', 'Solomon Islands', '677'),
(201, 'SO', 'Somalia', '252'),
(202, 'ZA', 'South Africa', '27'),
(203, 'GS', 'South Georgia', '0'),
(204, 'SS', 'South Sudan', '211'),
(205, 'ES', 'Spain', '34'),
(206, 'LK', 'Sri Lanka', '94'),
(207, 'SD', 'Sudan', '249'),
(208, 'SR', 'Suriname', '597'),
(209, 'SJ', 'Svalbard And Jan Mayen Islands', '47'),
(210, 'SZ', 'Swaziland', '268'),
(211, 'SE', 'Sweden', '46'),
(212, 'CH', 'Switzerland', '41'),
(213, 'SY', 'Syria', '963'),
(214, 'TW', 'Taiwan', '886'),
(215, 'TJ', 'Tajikistan', '992'),
(216, 'TZ', 'Tanzania', '255'),
(217, 'TH', 'Thailand', '66'),
(218, 'TG', 'Togo', '228'),
(219, 'TK', 'Tokelau', '690'),
(220, 'TO', 'Tonga', '676'),
(221, 'TT', 'Trinidad And Tobago', '1868'),
(222, 'TN', 'Tunisia', '216'),
(223, 'TR', 'Turkey', '90'),
(224, 'TM', 'Turkmenistan', '7370'),
(225, 'TC', 'Turks And Caicos Islands', '1649'),
(226, 'TV', 'Tuvalu', '688'),
(227, 'UG', 'Uganda', '256'),
(228, 'UA', 'Ukraine', '380'),
(229, 'AE', 'United Arab Emirates', '971'),
(230, 'GB', 'United Kingdom', '44'),
(231, 'US', 'United States', '1'),
(232, 'UM', 'United States Minor Outlying Islands', '1'),
(233, 'UY', 'Uruguay', '598'),
(234, 'UZ', 'Uzbekistan', '998'),
(235, 'VU', 'Vanuatu', '678'),
(236, 'VA', 'Vatican City State (Holy See)', '39'),
(237, 'VE', 'Venezuela', '58'),
(238, 'VN', 'Vietnam', '84'),
(239, 'VG', 'Virgin Islands (British)', '1284'),
(240, 'VI', 'Virgin Islands (US)', '1340'),
(241, 'WF', 'Wallis And Futuna Islands', '681'),
(242, 'EH', 'Western Sahara', '212'),
(243, 'YE', 'Yemen', '967'),
(244, 'YU', 'Yugoslavia', '38'),
(245, 'ZM', 'Zambia', '260'),
(246, 'ZW', 'Zimbabwe', '263');

-- --------------------------------------------------------

--
-- Table structure for table `entry_zapping`
--

CREATE TABLE `entry_zapping` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `location` varchar(100) NOT NULL,
  `unique_code` varchar(50) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `email_send` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;



--
-- Dumping data for table `entry_zapping`
--

INSERT INTO `entry_zapping` (`id`, `type`, `location`, `unique_code`, `status`, `email_send`, `created_at`) VALUES
(1, 'online', 'Entry', 'IMP237GQZH', 0, 1, '2025-01-25 13:24:51'),
(2, 'online', 'Entry', 'IMP23T5N7F', 0, 1, '2025-01-25 13:47:41'),
(3, 'online', 'Entry', 'IMP23V6R6X', 0, 1, '2025-01-25 13:50:20'),
(4, 'online', 'Entry', 'IMP233R6CM', 0, 1, '2025-01-25 13:50:32'),
(5, 'online', 'Entry', 'IMP23ZEUJU', 0, 1, '2025-01-25 13:50:45'),
(6, 'online', 'Entry', 'IMP23GXWU6', 0, 1, '2025-01-25 13:54:07'),
(7, 'online', 'Entry', 'IMP239I4UK', 0, 1, '2025-01-25 13:55:24'),
(8, 'online', 'Entry', 'IMP237ABB5', 0, 1, '2025-01-25 13:57:08'),
(9, 'online', 'Entry', 'IMP2372CTG', 0, 1, '2025-01-25 13:58:21'),
(10, 'online', 'Entry', 'IMP23N6KAA', 0, 1, '2025-01-25 13:58:28'),
(11, 'online', 'Entry', 'IMP23HPGW6', 0, 1, '2025-01-25 13:58:35'),
(12, 'online', 'Entry', 'IMP23PRKGE', 0, 1, '2025-01-25 13:58:53'),
(13, 'online', 'Entry', 'IMP234C95V', 0, 1, '2025-01-25 13:59:10'),
(14, 'online', 'Entry', 'IMP23HYMIX', 0, 1, '2025-01-25 14:00:43'),
(15, 'online', 'Entry', 'IMP23UCIDT', 0, 1, '2025-01-25 14:00:55'),
(16, 'online', 'Entry', 'IMP23AAC6U', 0, 1, '2025-01-25 14:03:13'),
(17, 'online', 'Entry', 'IMP23SZCYK', 0, 1, '2025-01-25 14:05:53'),
(18, 'online', 'Entry', 'IMP237ZUZ2', 0, 1, '2025-01-25 14:08:26'),
(19, 'online', 'Entry', 'IMP23NSZCQ', 0, 1, '2025-01-25 14:09:12'),
(20, 'online', 'Entry', 'IMP23D4U5Y', 0, 1, '2025-01-25 14:13:22'),
(21, 'online', 'Entry', 'IMP23BJFVS', 0, 1, '2025-01-25 14:17:13'),
(22, 'online', 'Entry', 'IMP23IUTDX', 0, 1, '2025-01-25 14:19:39'),
(23, 'online', 'Entry', 'IMP2377FR3', 0, 1, '2025-01-25 14:19:53'),
(24, 'online', 'Entry', 'IMP23GQTG9', 0, 1, '2025-01-25 14:19:58'),
(25, 'online', 'Entry', 'IMP23QZZAN', 0, 1, '2025-01-25 14:21:10'),
(26, 'online', 'Entry', 'IMP23Y2VVZ', 0, 1, '2025-01-25 14:21:23'),
(27, 'online', 'Entry', 'IMP23YWJW3', 0, 1, '2025-01-25 14:21:51'),
(28, 'online', 'Entry', 'IMP23SN8G6', 0, 1, '2025-01-25 14:22:50'),
(29, 'online', 'Entry', 'IMP23APIR2', 0, 1, '2025-01-25 14:25:14'),
(30, 'online', 'Entry', 'IMP23FJ2HD', 0, 1, '2025-01-25 14:25:47'),
(31, 'online', 'Entry', 'IMP23749YZ', 0, 1, '2025-01-25 14:26:17'),
(32, 'online', 'Entry', 'IMP23GPPAF', 0, 1, '2025-01-25 14:27:02'),
(33, 'online', 'Entry', 'IMP23ARS4Q', 0, 1, '2025-01-25 14:28:38'),
(34, 'online', 'Entry', 'IMP23KPU2V', 0, 1, '2025-01-25 14:29:50'),
(35, 'online', 'Entry', 'IMP23QFCM2', 0, 1, '2025-01-25 14:31:10'),
(36, 'online', 'Entry', 'IMP23PQKMS', 0, 1, '2025-01-25 14:32:30'),
(37, 'online', 'Entry', 'IMP23B28XZ', 0, 1, '2025-01-25 14:32:42'),
(38, 'online', 'Entry', 'IMP23EJQ7C', 0, 1, '2025-01-25 14:33:06'),
(39, 'online', 'Entry', 'IMP23B55XI', 0, 1, '2025-01-25 14:34:04'),
(40, 'online', 'Entry', 'IMP23WIWBE', 0, 1, '2025-01-25 14:36:02'),
(41, 'online', 'Entry', 'IMP238PIZ5', 0, 1, '2025-01-25 14:36:28'),
(42, 'online', 'Entry', 'IMP23HAUDK', 0, 1, '2025-01-25 14:37:28'),
(43, 'online', 'Entry', 'IMP23PENJK', 0, 1, '2025-01-25 14:38:10'),
(44, 'online', 'Entry', 'IMP235WQMQ', 0, 1, '2025-01-25 14:38:47'),
(45, 'online', 'Entry', 'IMP23XVN8K', 0, 1, '2025-01-25 14:42:10'),
(46, 'online', 'Entry', 'IMP23G9U6Y', 0, 1, '2025-01-25 14:43:16'),
(47, 'online', 'Entry', 'IMP236BWPU', 0, 1, '2025-01-25 14:43:23'),
(48, 'online', 'Entry', 'IMP23XZJMQ', 0, 1, '2025-01-25 14:46:08'),
(49, 'online', 'Entry', 'IMP23Y4CN3', 0, 1, '2025-01-25 14:48:09'),
(50, 'online', 'Entry', 'IMP232EYDV', 0, 1, '2025-01-25 14:51:38');


-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `banner_img` varchar(255) DEFAULT NULL,
  `event_date` varchar(255) DEFAULT NULL,
  `event_time` varchar(255) DEFAULT NULL,
  `event_address` text DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `prefix_uniquecode` varchar(255) DEFAULT NULL,
  `festival_dates` varchar(255) DEFAULT NULL,
  `festival_month_year` varchar(255) DEFAULT NULL,
  `facebook` text DEFAULT NULL,
  `twitter` text DEFAULT NULL,
  `linkedin` text DEFAULT NULL,
  `whatsapp` text DEFAULT NULL,
  `latitude` varchar(20) DEFAULT NULL,
  `longitude` varchar(20) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1 COMMENT '0-draft, 1- published, 2- deactivated',
  `registration_closed` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `name`, `title`, `description`, `banner_img`, `event_date`, `event_time`, `event_address`, `url`, `prefix_uniquecode`, `festival_dates`, `festival_month_year`, `facebook`, `twitter`, `linkedin`, `whatsapp`, `latitude`, `longitude`, `created`, `modified`, `status`, `registration_closed`) VALUES
(1, 'EZZM_CRM', 'EZZ Day: Ezzmyevent 2025', 'India largetst tech show for startups', 'https://s3.ap-south-1.amazonaws.com/jlf2022regdata.bucket/HSBC2023/CityRegistration/1656061473banner.vision.1920x500.png remove_this_url', '25th March 2026', '', 'JECC, Jaipur', 'http://ezzm.v2/', 'ezz', '25', 'January', 'javscript:void(0);', 'javscript:void(0);', 'javscript:void(0);', 'javscript:void(0);', NULL, NULL, '2025-03-10 00:00:00', '2025-05-22 00:00:00', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `mobile_no` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `feed_1` varchar(255) DEFAULT NULL,
  `feed_2` varchar(255) DEFAULT NULL,
  `feed_3` longtext DEFAULT NULL,
  `feed_4` longtext DEFAULT NULL,
  `feed_5` varchar(255) DEFAULT NULL,
  `feed_6` varchar(255) DEFAULT NULL,
  `feed_7` varchar(255) DEFAULT NULL,
  `feed_8` longtext DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `form_settings`
--

CREATE TABLE `form_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `module_id` int(11) DEFAULT NULL,
  `form_squence` int(11) NOT NULL DEFAULT 0,
  `module_name` varchar(255) DEFAULT NULL,
  `field_title` text NOT NULL,
  `field_name` varchar(255) DEFAULT NULL,
  `field_type` varchar(255) DEFAULT NULL,
  `required` int(11) NOT NULL DEFAULT 1,
  `unique_field` int(11) NOT NULL DEFAULT 0,
  `for_multi_select` tinyint(4) NOT NULL DEFAULT 0,
  `filter` int(11) NOT NULL DEFAULT 0,
  `value` text NOT NULL,
  `show_in` int(11) NOT NULL DEFAULT 1 COMMENT '1=front, 2=backend, 3=both',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `form_settings`
--

INSERT INTO `form_settings` (`id`, `module_id`, `form_squence`, `module_name`, `field_title`, `field_name`, `field_type`, `required`, `unique_field`, `for_multi_select`, `filter`, `value`, `show_in`, `created_at`, `updated_at`) VALUES
(11, 1, 4, 'interface,onsite', 'Adults', 'adults', 'checkbox', 0, 0, 0, 0, 'Father,Mother,Spouse,Father-in-law,Mother-in-law', 2, NULL, NULL),
(12, 1, 8, 'interface,onsite', 'Kid_1', 'kid_1', 'select', 0, 0, 0, 0, '0-6|7-12|13-18', 2, NULL, NULL),
(15, 1, 10, 'interface,onsite', 'Kid_2', 'kid_2', 'select', 0, 0, 0, 0, '0-6|7-12|13-18', 2, NULL, NULL),
(16, 1, 1, 'interface,onsite', 'Name', 'name', 'text', 0, 0, 0, 0, '', 2, NULL, NULL),
(17, 1, 2, 'interface,onsite', 'Email', 'email', 'email', 0, 0, 0, 0, '', 2, NULL, NULL),
(18, 1, 3, 'interface,onsite', 'Phone', 'phone', 'phone', 0, 0, 0, 0, '', 2, NULL, NULL),
(19, 1, 5, 'interface,onsite', 'adult_1', 'guest1_name', 'text', 0, 0, 0, 0, '', 2, NULL, NULL),
(20, 1, 6, 'interface,onsite', 'adult_2', 'guest2_name', 'text', 0, 0, 0, 0, '', 2, NULL, NULL),
(21, 1, 7, 'interface,onsite', 'adult_3', 'guest3_name', 'text', 0, 0, 0, 0, '', 2, NULL, NULL),
(22, 1, 9, 'interface,onsite', 'kid1 Name', 'kid1_name', 'text', 0, 0, 0, 0, '', 2, NULL, NULL),
(23, 1, 11, 'interface,onsite', 'kid2 Name', 'kid2_name', 'text', 0, 0, 0, 0, '', 2, NULL, NULL),
(24, 1, 0, 'interface,onsite', 'EMP Code', 'emp_code', 'text', 0, 0, 0, 0, '', 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `guests`
--

CREATE TABLE `guests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_type` varchar(20) DEFAULT NULL,
  `emp_code` varchar(255) DEFAULT NULL,
  `adult_1` varchar(100) DEFAULT NULL,
  `adult_2` varchar(100) DEFAULT NULL,
  `spouse` varchar(100) DEFAULT NULL,
  `kid_1` varchar(100) DEFAULT NULL,
  `kid_2` varchar(100) DEFAULT NULL,
  `guest1_name` varchar(255) DEFAULT NULL,
  `guest2_name` varchar(255) DEFAULT NULL,
  `guest3_name` varchar(255) DEFAULT NULL,
  `kid1_name` varchar(255) DEFAULT NULL,
  `kid2_name` varchar(255) DEFAULT NULL,
  `unique_code` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `details_updated` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `guests`
--

INSERT INTO `guests` (`id`, `user_type`, `emp_code`, `adult_1`, `adult_2`, `spouse`, `kid_1`, `kid_2`, `guest1_name`, `guest2_name`, `guest3_name`, `kid1_name`, `kid2_name`, `unique_code`, `created_at`, `updated_at`, `details_updated`) VALUES
(6, NULL, NULL, NULL, NULL, NULL, '0-6', NULL, NULL, NULL, NULL, 'A', NULL, 'IMP23ATZJQ8N', '2025-01-10 17:42:11', '2025-01-10 17:42:11', 0),
(23, NULL, NULL, NULL, NULL, NULL, '0-6', '7-12', NULL, NULL, NULL, 'xx', 'yu', 'IMP23C8R52', '2025-01-10 18:50:40', '2025-01-10 18:50:40', 0),
(25, NULL, NULL, NULL, 'Father', 'Father', NULL, NULL, NULL, 'Test', 'Test', NULL, NULL, 'IMP23FV2BM', '2025-01-12 18:43:34', '2025-01-12 18:43:34', 0),
(26, NULL, NULL, NULL, NULL, 'Mother', NULL, '7-12', NULL, NULL, 'mother', NULL, 'kid2', 'IMP23ATWAMU5', '2025-01-13 10:38:57', '2025-01-13 10:38:57', 0),
(32, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'IMP23RRXCI', '2025-01-13 11:43:01', '2025-01-13 11:43:01', 0),
(33, NULL, NULL, NULL, NULL, NULL, '0-6', NULL, NULL, NULL, NULL, 'chinu', NULL, 'IMP23ATN92FD', '2025-01-13 13:11:17', '2025-01-13 13:11:17', 0),
(34, NULL, NULL, NULL, NULL, NULL, NULL, '13-18', NULL, NULL, NULL, NULL, 'Adithya', 'IMP23Z3QM3', '2025-01-13 16:43:22', '2025-01-13 16:43:22', 0),
(35, NULL, NULL, NULL, NULL, NULL, '0-6', NULL, NULL, NULL, NULL, 'Test', NULL, 'IMP23N8982', '2025-01-13 20:07:33', '2025-01-13 20:07:33', 0),
(36, NULL, NULL, NULL, NULL, NULL, NULL, '13-18', NULL, NULL, NULL, NULL, 'ggggg', 'IMP23ATEGDHT', '2025-01-15 13:13:13', '2025-01-15 13:13:13', 0),
(37, NULL, NULL, NULL, NULL, NULL, NULL, '0-6', NULL, NULL, NULL, NULL, 'kid', 'IMP23UQS3Z', '2025-01-15 14:27:18', '2025-01-15 14:27:18', 0),
(39, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'IMP23ATYGXA9', '2025-01-15 15:08:46', '2025-01-15 15:08:46', 0),
(40, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'IMP23HAUDK', '2025-01-25 14:36:08', '2025-01-25 14:36:08', 0),
(41, NULL, NULL, NULL, NULL, NULL, NULL, '0-6', NULL, NULL, NULL, NULL, 'vihan', 'IMP23PQ5V3', '2025-01-25 15:31:52', '2025-01-25 15:31:52', 0),
(42, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'IMP23FZEX9', '2025-01-25 16:55:00', '2025-01-25 16:55:00', 0),
(43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'IMP235WUAX', '2025-01-25 16:57:23', '2025-01-25 16:57:23', 0),
(44, NULL, NULL, NULL, NULL, NULL, '0-6', NULL, NULL, NULL, NULL, 'Aruahi', NULL, 'IMP23CSVZN', '2025-01-25 17:44:44', '2025-01-25 17:44:44', 0),
(45, NULL, NULL, NULL, NULL, NULL, '13-18', '13-18', NULL, NULL, NULL, 'daksh', 'arav', 'IMP23G996Y', '2025-06-12 10:15:26', '2025-06-12 10:15:26', 0);

-- --------------------------------------------------------

--
-- Table structure for table `mail_templates`
--

CREATE TABLE `mail_templates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `attachment` longtext DEFAULT NULL,
  `content` blob NOT NULL,
  `reminder_status` varchar(255) DEFAULT NULL,
  `active_to_cron` int(11) DEFAULT 0,
  `user_category` varchar(255) NOT NULL DEFAULT 'all',
  `status` enum('0','1') NOT NULL,
  `is_deleted` enum('0','1') DEFAULT '0',
  `identifier` varchar(255) DEFAULT NULL,
  `template_type` enum('transactional','promotional') NOT NULL DEFAULT 'promotional',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mail_templates`
--

INSERT INTO `mail_templates` (
  `title`, `subject`, `attachment`, `content`, `reminder_status`, `active_to_cron`,
  `user_category`, `status`, `is_deleted`, `identifier`, `template_type`,
  `created_at`, `updated_at`
) VALUES (
  'Registration Confirmed: Sample',
  'Confirmation for All-In India Event',
  '##eticket_path##',
  '<?xml version="1.0" encoding="UTF-8"?>
  <!DOCTYPE html>
  <html>
  <head>
    <style>
      .eventlogo { display: inline-block; height: 55px; }
      .bannermage img { width: 100%; }
    </style>
  </head>
  <body>
    <p><b>Dear ##name##,</b></p>
    <p>Thank you for registering for the All-In India Event!</p>
    <p><strong>Event Details:</strong></p>
    <ul>
      <li><strong>Date:</strong> December 14, 2025</li>
      <li><strong>Time:</strong> 11:30 AM – 5:30 PM</li>
      <li><strong>Location:</strong> Jaipur Atlantic, Greater Noida</li>
    </ul>
    <p><strong>Note:</strong></p>
    <ul>
      <li>Your office ID card is <strong>mandatory</strong>.</li>
      <li>The event is for employees only. No exceptions.</li>
    </ul>
    <p>Please adhere to the UKG code of conduct. For FAQs and guidelines, click
    <a href="https://cdn7.gstatic.com/Smart-Reg/ukg/event/1734064646FAQS.pdf">here</a>.</p>
    <p><strong>Queries:</strong></p>
    <ul>
      <li>Transport: <strong>7838258628</strong></li>
      <li>Security: <strong>7838496798</strong></li>
    </ul>
    <p>Looking forward to seeing you there!</p>
    <p>Best regards,<br><strong>Team UKG</strong></p>
  </body>
  </html>',
  '1',
  1,
  'all',
  '1',
  '0',
  'registration_confirmed',
  'promotional',
  '2025-06-26 10:00:00',
  '2025-06-26 10:00:00'
);

-- --------------------------------------------------------

--
-- Table structure for table `master_otp`
--
CREATE TABLE `master_otp` (
  `id` INT(11) NOT NULL ,
  `user_id` INT(11) NOT NULL,
  `otp_code` VARCHAR(6) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `expires_at` TIMESTAMP NOT NULL,
  `is_used` TINYINT(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `master_otp`
INSERT INTO `master_otp` (`user_id`, `otp_code`, `created_at`, `expires_at`, `is_used`) VALUES
(0, '123456', '2025-06-26 10:30:00', '2025-06-26 10:35:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--


CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `module_permissions`
--

CREATE TABLE `module_permissions` (
  `id` int NOT NULL,
  `module` varchar(255) DEFAULT NULL,
  `permission` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `module_permissions`
--

INSERT INTO `module_permissions` (`id`, `module`, `permission`) VALUES
(1, 'Tickets', 'Add'),
(2, 'Tickets', 'Edit'),
(3, 'Tickets', 'Delete'),
(4, 'Tickets', 'View'),
(5, 'Tickets', 'Export'),
(6, 'Tickets', 'Import'),
(7, 'Tickets', 'Approve'),
(8, 'Tickets', 'Reject'),
(9, 'Tickets', 'View All'),
(10, 'Tickets', 'Manage');

-- --------------------------------------------------------

--
-- Table structure for table `online_registration_unique_codes`
--

CREATE TABLE `online_registration_unique_codes` (
  `id` int(11) NOT NULL,
  `unique_code` varchar(20) NOT NULL,
  `is_used` tinyint(4) NOT NULL DEFAULT 0,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `online_registration_unique_codes`
--

INSERT INTO `online_registration_unique_codes` (`id`, `unique_code`, `is_used`, `modified`) VALUES
(250000, 'TVCVB', 1, '2024-12-18 10:26:42'),
(250001, '8PPEX', 1, '2024-12-18 11:57:25'),
(250002, 'PEI4F', 1, '2024-12-18 12:04:13'),
(250003, '4GV34', 1, '2024-12-18 12:30:15'),
(250004, 'PAYKT', 1, '2024-12-18 13:16:17'),
(250005, 'JRNCA', 1, '2024-12-18 13:17:33'),
(250006, '2WYKX', 1, '2024-12-18 13:23:08'),
(250007, 'ZIE7S', 1, '2024-12-18 14:04:48'),
(250008, 'THZ8S', 1, '2024-12-18 14:15:20'),
(250009, 'WDVFN', 1, '2024-12-18 14:28:59'),
(250010, 'ZZTSF', 1, '2024-12-18 14:31:05'),
(250011, 'MYT6A', 1, '2024-12-18 14:34:51'),
(250012, 'N7Y9V', 1, '2024-12-18 14:35:23'),
(250013, 'M9QBQ', 1, '2024-12-18 14:37:23'),
(250014, '7HPHD', 1, '2024-12-18 14:37:43'),
(250015, 'UXHDN', 1, '2024-12-18 14:38:48'),
(250016, 'ZJ9K8', 1, '2024-12-18 14:38:57'),
(250017, 'KM4JM', 1, '2024-12-18 14:39:06'),
(250018, 'ZBYCE', 1, '2024-12-18 14:39:19'),
(250019, 'PMYTD', 1, '2024-12-18 14:58:49'),
(250020, '6C5IT', 1, '2024-12-18 14:59:33'),
(250021, 'FU5DK', 1, '2024-12-19 12:06:04'),
(250022, 'AIPMN', 1, '2024-12-19 18:19:36'),
(250023, '5DSD5', 1, '2024-12-19 18:20:05'),
(250024, 'X66Z7', 1, '2024-12-19 18:20:54'),
(250025, '5ECTR', 1, '2024-12-21 11:20:56'),(252355, '6EXIN', 0, NULL),
(252356, 'W68HW', 0, NULL),
(252357, '6M4KF', 0, NULL),
(252358, '39C2W', 0, NULL),
(252359, 'WNM36', 0, NULL),
(252360, 'ZY84U', 0, NULL),
(252361, '49YTD', 0, NULL),
(252362, 'GBG8K', 0, NULL),
(252363, 'BSF2Q', 0, NULL),
(252364, 'RBKD4', 0, NULL),
(252365, 'CFBPB', 0, NULL),
(252366, 'UGFSH', 0, NULL),
(252367, 'WAUEZ', 0, NULL),
(252368, '5KAQK', 0, NULL),
(252369, 'Y9MSJ', 0, NULL),
(252370, 'MBZHB', 0, NULL),
(252371, 'VMZVN', 0, NULL),
(252372, '9FQDW', 0, NULL),
(252373, '9BIZQ', 0, NULL),
(252374, 'CZ4R5', 0, NULL),
(252375, 'U4WAE', 0, NULL),
(252376, 'ZXM7M', 0, NULL),
(252377, '8UD6E', 0, NULL),
(252378, 'TBCYR', 0, NULL),
(252379, 'KM5VT', 0, NULL),
(252380, 'YTQTJ', 0, NULL),
(252381, 'HZDAG', 0, NULL),
(252382, '9E27U', 0, NULL),
(252383, 'P8BN7', 0, NULL),
(252384, 'QSSTB', 0, NULL),
(252385, 'MHNRW', 0, NULL),
(252386, 'HG3Q5', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `redeems`
--

CREATE TABLE `redeems` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `smtps`
--
CREATE TABLE `smtps` (
  `id` BIGINT UNSIGNED NOT NULL ,
  `is_client_smtp` ENUM('yes', 'no') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendor` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `host` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sender_email` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reply_to` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `port` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `smtps`
--
-- original old copy code 

-- INSERT INTO `smtps` (`id`, `is_client_smtp`, `vendor`, `host`, `username`, `password`,
--  `sender_email`, `reply_to`, `port`, `token`, `created_at`, `updated_at`
-- ) VALUES(
-- 1, 'no', 'sendgrid', NULL, NULL, NULL, NULL, NULL, NULL, 
-- 'eb1e48e9-1f0f-484a-a4b0-feede3643b66', '2024-12-12 15:11:20', '2024-12-16 12:29:23'
-- );
  
  INSERT INTO `smtps` (
    `id`, `is_client_smtp`, `vendor`, `host`, `username`, `password`,
    `sender_email`, `reply_to`, `port`, `token`, `created_at`, `updated_at`
  ) VALUES (
    1, 'no', 'sendgrid', NULL, NULL, NULL, NULL, NULL, NULL,
    'eb1e48e9-1f0f-484a-a4b0-feede3643b66 fake token', '2024-12-12 15:11:20', '2024-12-16 12:29:23' 
  );


-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` BIGINT UNSIGNED NOT NULL ,
  `event_id` INT NOT NULL DEFAULT 1,
  `name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `slug` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `price` DECIMAL(10,2) NOT NULL,
  `gst` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
  `gst_status` TINYINT NOT NULL DEFAULT 0,
  `currency_symbol` VARCHAR(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `other_charges` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
  `min_qty` INT NOT NULL DEFAULT 1,
  `max_qty` INT NOT NULL DEFAULT 5,
  `day_qty` INT DEFAULT NULL,
  `status` TINYINT NOT NULL DEFAULT 1,
  `tic_ordering` INT NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `user_type` VARCHAR(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shortcode` VARCHAR(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '["invite", "add", "neutral", "rsvp"]',
  `m_badge_design` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `show_in` INT NOT NULL DEFAULT 1,
  `is_soldout` INT DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tickets`
--
INSERT INTO `tickets` (
  `id`, `event_id`, `name`, `category`, `slug`, `description`, `price`, `gst`, `gst_status`,
  `currency_symbol`, `other_charges`, `min_qty`, `max_qty`, `day_qty`, `status`,
  `tic_ordering`, `created_at`, `updated_at`, `user_type`, `shortcode`, `type`,
  `m_badge_design`, `show_in`, `is_soldout`
) VALUES (
  1, 1, 'Attendee', 'Attendee', 'attendee', '.', 0.00, 0.00, 0,
  '₹', 0.00, 1, 1, 1, 1,
  0, '2024-12-12 11:37:50', '2024-12-12 11:37:50', 'interface,onsite', 'AT', 'add',
  'https://cdn7.godcstatic.com/Smart-Reg/UKG/mbadge/1733983670Mobile-QR-Code.png', 0, 0
);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` BIGINT UNSIGNED NOT NULL ,
  `user_type` VARCHAR(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `update_ticket` TINYINT DEFAULT 0,
  `category` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` VARCHAR(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emp_code` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp_status` TINYINT NOT NULL DEFAULT 0,
  `otp_expires_at` TIMESTAMP NULL DEFAULT NULL,
  `lead_name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slot` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `primary_user` VARCHAR(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attendees` TINYINT NOT NULL DEFAULT 0,
  `adult_1` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adult_2` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `spouse` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kid_1` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kid_2` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_primary_user` TINYINT DEFAULT 0,
  `guest1_name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guest2_name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guest3_name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kid1_name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kid2_name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_goodies` TINYINT DEFAULT 0,
  `goodies_at` VARCHAR(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_goodies_kid_1` TINYINT DEFAULT 0,
  `is_goodies_kid_2` TINYINT DEFAULT 0,
  `country_code` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designation` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unique_code` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qrcode_path` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `eticket_path` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` TINYINT(1) NOT NULL DEFAULT 0,
  `event_status` TINYINT NOT NULL DEFAULT 0,
  `update_status` INT NOT NULL DEFAULT 0,
  `is_printed` TINYINT(1) NOT NULL DEFAULT 0,
  `is_printed_adult_1` INT NOT NULL DEFAULT 0,
  `is_printed_adult_2` INT NOT NULL DEFAULT 0,
  `is_printed_adult_3` INT NOT NULL DEFAULT 0,
  `is_printed_kid_1` INT NOT NULL DEFAULT 0,
  `is_printed_kid_2` INT NOT NULL DEFAULT 0,
  `printed_at` DATETIME DEFAULT NULL,
  `email_send` INT DEFAULT 0,
  `send_whatsapp` INT DEFAULT 0,
  `map_location` INT NOT NULL DEFAULT 0,
  `food_menu` INT NOT NULL DEFAULT 0,
  `metro` INT NOT NULL DEFAULT 0,
  `sendInvitation_whatsapp` TINYINT NOT NULL DEFAULT 0,
  `rem_email_send` INT DEFAULT 0,
  `feed_email_send` INT DEFAULT 0,
  `attendance_ballroom` TINYINT(1) NOT NULL DEFAULT 0,
  `attendance_lunch` TINYINT(1) NOT NULL DEFAULT 0,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `details_updated` INT NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_type`, `update_ticket`, `category`, `name`, `email`, `phone`, `emp_code`, `otp`, `otp_status`, `otp_expires_at`, `lead_name`, `date`, `slot`, `primary_user`, `attendees`, `adult_1`, `adult_2`, `spouse`, `kid_1`, `kid_2`, `is_primary_user`, `guest1_name`, `guest2_name`, `guest3_name`, `kid1_name`, `kid2_name`, `is_goodies`, `goodies_at`, `is_goodies_kid_1`, `is_goodies_kid_2`, `country_code`, `company`, `designation`, `unique_code`, `qrcode_path`, `eticket_path`, `status`, `event_status`, `update_status`, `is_printed`, `is_printed_adult_1`, `is_printed_adult_2`, `is_printed_adult_3`, `is_printed_kid_1`, `is_printed_kid_2`, `printed_at`, `email_send`, `send_whatsapp`, `map_location`, `food_menu`, `metro`, `sendInvitation_whatsapp`, `rem_email_send`, `feed_email_send`, `attendance_ballroom`, `attendance_lunch`, `created_at`, `updated_at`, `details_updated`) VALUES
(1, 'online', 0, 'Employee', 'Shlok Aggrawal', 'shlok0531@gmail.com', '8081094578', 'KAO001', '000000', 1, '2024-12-25 11:06:02', NULL, NULL, NULL, NULL, 1, 'Spouse', 'No', 'No', 'No', 'No', 0, 'IAS', NULL, NULL, NULL, NULL, 0, NULL, 0, 0, '+91', NULL, NULL, 'IMP23G996Y', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/qrcodes/IMP23G996Y.png', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/eticket/IMP23G996Y.png', 1, 1, 1, 1, 1, 0, 0, 0, 0, NULL, 1, 1, 1, 1, 1, 1, 1, 0, 2, 0, '2024-12-25 11:02:09', '2025-01-25 09:36:40', 1),
(2, 'online', 0, 'Employee', 'jahnvi', 'jahnvi@LKQCORP.com', '0000000000', 'KAO002', '970811', 1, '2025-01-17 13:24:20', NULL, NULL, NULL, NULL, 1, 'Spouse', 'No', 'No', '7-12', 'No', 0, 'Nandhini', NULL, NULL, 'Suhana', NULL, 0, NULL, 0, 0, '+91', NULL, NULL, 'IMP23ZEUJU', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/qrcodes/IMP23ZEUJU.png', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/eticket/IMP23ZEUJU.png', 1, 1, 2, 1, 1, 0, 0, 1, 0, NULL, 1, 1, 1, 1, 1, 1, 0, 0, 2, 0, '2025-01-17 13:20:54', '2025-01-25 08:13:23', 1),
(3, 'online', 0, 'Employee', 'test', 'test@LKQCORP.com', '1111111111', 'KAO003', '861543', 1, '2025-01-14 11:28:32', NULL, NULL, NULL, NULL, 1, 'Spouse', 'Father', 'Mother', '7-12', '13-18', 0, 'Harshitha T S', 'Nanjundappa SV', 'Manjula R', 'Jathin Krishna', 'Anvitha', 0, NULL, 0, 0, '+91', NULL, NULL, 'IMP23IU9MX', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/qrcodes/IMP23IU9MX.png', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/eticket/IMP23IU9MX.png', 1, 1, 2, 1, 1, 1, 1, 1, 1, NULL, 1, 1, 1, 1, 1, 1, 0, 0, 2, 0, '2025-01-14 11:25:15', '2025-01-25 09:31:20', 1),
(4, 'online', 0, 'Employee', 'Viraj paliwal', 'virajpaliwal4725@gmail.com', '9084347897', 'KAO009', '622771', 1, '2025-01-14 11:02:23', NULL, NULL, NULL, NULL, 1, 'Spouse', 'No', 'No', '7-12', '0-6', 0, 'Anuradha K', NULL, NULL, 'Arjun Nayak C', 'Nakul Nayak C', 0, NULL, 0, 0, '+91', NULL, NULL, 'IMP23YHMZ2', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/qrcodes/IMP23YHMZ2.png', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/eticket/IMP23YHMZ2.png', 1, 1, 1, 1, 1, 0, 0, 1, 1, NULL, 1, 1, 1, 1, 1, 1, 0, 0, 2, 0, '2024-12-27 12:52:02', '2025-01-25 10:29:24', 1),
(5, 'online', 0, 'Employee', 'ezzmyevent', 'ezzmyevent@gmail.com', '7985460986', 'KAO012', '963761', 1, '2025-01-14 13:31:09', NULL, NULL, NULL, NULL, 1, 'Spouse', 'Father-in-law', 'Mother-in-law', '7-12', '0-6', 0, 'Suma', 'Jagadish', 'Hemavathi', 'Aarna', 'Avyaktha', 0, NULL, 0, 0, '+91', NULL, NULL, 'IMP23FDH7E', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/qrcodes/IMP23FDH7E.png', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/eticket/IMP23FDH7E.png', 1, 1, 2, 1, 0, 0, 0, 0, 0, NULL, 1, 1, 1, 1, 1, 1, 0, 0, 2, 0, '2025-01-14 13:28:23', '2025-01-25 07:19:28', 1),
(6, 'online', 0, 'Employee', 'Avinash K K', 'agowda@LKQCORP.com', '9980294028', 'KAO021', '299396', 1, '2025-01-13 22:15:53', NULL, NULL, NULL, NULL, 1, 'Spouse', 'Father', 'Father-in-law', '0-6', 'No', 0, 'Shambhavi HY', 'Kalle Gowda', 'Yogesh', 'Aarush Gowda', NULL, 0, NULL, 0, 0, '+91', NULL, NULL, 'IMP23MMQS3', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/qrcodes/IMP23MMQS3.png', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/eticket/IMP23MMQS3.png', 1, 1, 1, 1, 0, 1, 0, 0, 0, NULL, 1, 1, 1, 1, 1, 1, 0, 0, 2, 0, '2025-01-13 22:11:43', '2025-01-25 07:43:09', 1),
(7, 'online', 0, 'Employee', 'Yogamunishwaran TN', 'ynagarajan@LKQCORP.com', '9916972526', 'KAO023', '427722', 1, '2025-01-16 14:35:04', NULL, NULL, NULL, NULL, 1, 'Spouse', 'No', 'No', '7-12', '0-6', 0, 'Harileka M', NULL, NULL, 'Nishanth T Y', 'Dhanvanth T Y', 0, NULL, 0, 0, '+91', NULL, NULL, 'IMP23QZZAN', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/qrcodes/IMP23QZZAN.png', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/eticket/IMP23QZZAN.png', 1, 1, 2, 1, 1, 0, 0, 1, 1, NULL, 1, 1, 1, 1, 1, 1, 0, 0, 2, 0, '2025-01-16 14:31:32', '2025-01-25 08:48:32', 1),
(8, 'online', 0, 'Employee', 'Kamal K S', 'kkamal@LKQCORP.com', '9845991301', 'KAO025', '674143', 1, '2025-01-14 12:32:39', NULL, NULL, NULL, NULL, 1, 'Spouse', 'No', 'No', '13-18', '7-12', 0, 'YASMEEN FATIMA', NULL, NULL, 'RAHIL SHAREEF', 'SAHIL AHMED', 0, NULL, 0, 0, '+91', NULL, NULL, 'IMP23N6NEG', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/qrcodes/IMP23N6NEG.png', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/eticket/IMP23N6NEG.png', 1, 1, 2, 1, 1, 0, 0, 1, 1, NULL, 1, 1, 1, 1, 1, 1, 0, 0, 2, 0, '2025-01-14 12:34:34', '2025-01-25 09:33:51', 1),
(9, 'online', 0, 'Employee', 'Suresh Kumar R', 'sr@LKQCORP.com', '9901652229', 'KAO029', '590866', 1, '2025-01-13 20:21:36', NULL, NULL, NULL, NULL, 1, 'Father', 'Mother', 'Spouse', '7-12', '0-6', 0, 'L Rajendran', 'R Vishalakshi', 'Shobha M', 'Nihant S', 'Sujana S', 0, NULL, 0, 0, '+91', NULL, NULL, 'IMP23WF7IG', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/qrcodes/IMP23WF7IG.png', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/eticket/IMP23WF7IG.png', 1, 1, 1, 1, 0, 1, 1, 1, 1, NULL, 1, 1, 1, 1, 1, 1, 0, 0, 2, 0, '2025-01-13 20:12:13', '2025-01-25 10:17:06', 1),
(10, 'online', 0, 'Employee', 'Prashantha R', 'rprashantha@LKQCORP.com', '9611144758', 'KAO033', '816526', 1, '2025-01-16 10:36:47', NULL, NULL, NULL, NULL, 1, 'No', 'No', 'No', 'No', 'No', 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, 0, '+91', NULL, NULL, 'IMP23Q35W9', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/qrcodes/IMP23Q35W9.png', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/eticket/IMP23Q35W9.png', 1, 1, 2, 1, 0, 0, 0, 0, 0, NULL, 1, 1, 1, 1, 1, 1, 0, 0, 2, 0, '2025-01-16 10:32:55', '2025-01-25 10:32:50', 1),
(11, 'online', 0, 'Employee', 'Darshan P Dave', 'ddave@LKQCORP.com', '9845047203', 'KAO037', '183514', 1, '2025-01-14 12:16:27', NULL, NULL, NULL, NULL, 1, 'Spouse', 'No', 'No', '13-18', '13-18', 0, 'Hiral Dholakia', NULL, NULL, 'Shriya Dave', 'Aarya Dave', 0, NULL, 0, 0, '+91', NULL, NULL, 'IMP234HEYS', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/qrcodes/IMP234HEYS.png', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/eticket/IMP234HEYS.png', 1, 1, 2, 1, 1, 0, 0, 0, 0, NULL, 1, 1, 1, 1, 1, 1, 0, 0, 2, 0, '2025-01-14 12:13:30', '2025-01-25 09:45:29', 1),
(12, 'online', 0, 'Employee', 'Arahanth SP', 'sarahanth@LKQCORP.com', '', 'KAO043', NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, 0, '+', NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 0, 0, 0, 0, 0, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2024-12-24 14:04:33', '2025-01-14 05:43:14', 0),
(13, 'online', 0, 'Employee', 'Shaila K N', 'nshaila@LKQCORP.com', '', 'KAO047', NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, 0, '+', NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 0, 0, 0, 0, 0, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2024-12-24 14:04:33', '2025-01-14 05:43:14', 0),
(14, 'online', 0, 'Employee', 'Sudheendra C', 'csudheendra@LKQCORP.com', '9886804424', 'KAO049', '548117', 1, '2025-01-14 19:25:10', NULL, NULL, NULL, NULL, 1, 'Spouse', 'Mother', 'No', '0-6', '7-12', 0, 'Sahana AV', 'Sathya Prema', NULL, 'Avyukth C', 'Aadvika C', 0, NULL, 0, 0, '+91', NULL, NULL, 'IMP23ZX7H7', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/qrcodes/IMP23ZX7H7.png', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/eticket/IMP23ZX7H7.png', 1, 1, 2, 1, 0, 0, 0, 0, 0, NULL, 1, 1, 1, 1, 1, 1, 0, 0, 2, 0, '2025-01-14 19:21:53', '2025-01-25 07:18:34', 1),
(15, 'online', 0, 'Employee', 'Karthic Kumar SG', 'skarthickumar@LKQCORP.com', '', 'KAO051', NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, 0, '+', NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 0, 0, 0, 0, 0, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2024-12-24 14:04:33', '2025-01-14 05:43:14', 0),
(16, 'online', 0, 'Employee', 'Lohith GK', 'klohith@LKQCORP.com', '9591232019', 'KAO053', '545233', 1, '2025-01-14 11:32:43', NULL, NULL, NULL, NULL, 1, 'Spouse', 'No', 'No', '0-6', 'No', 0, 'Priyanka', NULL, NULL, 'Takshvi', NULL, 0, NULL, 0, 0, '+91', NULL, NULL, 'IMP233NBSK', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/qrcodes/IMP233NBSK.png', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/eticket/IMP233NBSK.png', 1, 1, 2, 1, 1, 0, 0, 1, 0, NULL, 1, 1, 1, 1, 1, 1, 0, 0, 2, 0, '2025-01-14 11:29:14', '2025-01-25 10:50:05', 1),
(17, 'online', 0, 'Employee', 'Satheesh Kumar S', 'satheesh.kumar@eurocarparts.com', '9916708595', 'KAO063', '126523', 1, '2025-01-06 18:16:59', NULL, NULL, NULL, NULL, 1, 'Spouse', 'Father', 'Mother-in-law', '7-12', '13-18', 0, 'VANITHA', 'SAMU', 'GEETHA', 'PURVIK REDDY', 'HARITHSTHA', 0, NULL, 0, 0, '+91', NULL, NULL, 'IMP23MJ7HB', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/qrcodes/IMP23MJ7HB.png', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/eticket/IMP23MJ7HB.png', 1, 1, 1, 0, 0, 0, 0, 0, 0, NULL, 1, 1, 1, 1, 1, 1, 0, 0, 2, 0, '2025-01-06 18:14:34', '2025-01-25 05:21:25', 1),
(18, 'online', 0, 'Employee', 'Rajaram G', 'grajaram@LKQCORP.com', '9964241745', 'KAO066', '692212', 1, '2025-01-14 11:28:53', NULL, NULL, NULL, NULL, 1, 'Spouse', 'Mother', 'Mother-in-law', '0-6', '7-12', 0, 'Shyla G', 'Vijaya N', 'Chandramma', 'Deevana R Reddy', 'Dhanvitha R Reddy', 0, NULL, 0, 0, '+91', NULL, NULL, 'IMP23YWJW3', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/qrcodes/IMP23YWJW3.png', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/eticket/IMP23YWJW3.png', 1, 1, 2, 1, 1, 1, 1, 1, 1, NULL, 1, 1, 1, 1, 1, 1, 0, 0, 2, 0, '2025-01-14 11:25:06', '2025-01-25 08:51:27', 1),
(19, 'online', 0, 'Employee', 'Sasi Kiran S', 'skiran@LKQCORP.com', '8088285576', 'KAO078', '797889', 1, '2025-01-15 13:14:35', NULL, NULL, NULL, NULL, 1, 'Spouse', 'No', 'No', 'No', 'No', 0, 'Chetana Biradar', NULL, NULL, NULL, NULL, 0, NULL, 0, 0, '+91', NULL, NULL, 'IMP23DTF39', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/qrcodes/IMP23DTF39.png', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/eticket/IMP23DTF39.png', 1, 1, 2, 1, 1, 0, 0, 0, 0, NULL, 1, 1, 1, 1, 1, 1, 0, 0, 2, 0, '2025-01-15 13:11:08', '2025-01-25 09:41:36', 1),
(20, 'online', 0, 'Employee', 'Riyaz Ahmed', 'rahmed@LKQCORP.com', '9964447346', 'KAO080', '193940', 1, '2025-01-03 11:22:22', NULL, NULL, NULL, NULL, 1, 'No', 'No', 'No', '0-6', '7-12', 0, NULL, NULL, NULL, 'Rida', 'Azban', 0, NULL, 0, 0, '+91', NULL, NULL, 'IMP23QFCM2', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/qrcodes/IMP23QFCM2.png', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/eticket/IMP23QFCM2.png', 1, 1, 1, 1, 0, 0, 0, 1, 1, NULL, 1, 1, 1, 1, 1, 1, 0, 0, 2, 0, '2025-01-03 11:24:13', '2025-01-25 08:59:03', 1),
(21, 'online', 0, 'Employee', 'Tincy Sara John', 'tsjohn@LKQCORP.com', '9916569579', 'KAO084', '844619', 1, '2025-01-15 10:06:07', NULL, NULL, NULL, NULL, 1, 'Spouse', 'No', 'No', '0-6', '7-12', 0, 'Jackson Geo', NULL, NULL, 'Kate Jackson', 'Kenneth Jackson', 0, NULL, 0, 0, '+91', NULL, NULL, 'IMP23T5N7F', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/qrcodes/IMP23T5N7F.png', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/eticket/IMP23T5N7F.png', 1, 1, 2, 1, 1, 0, 0, 1, 1, NULL, 1, 1, 1, 1, 1, 1, 0, 0, 2, 0, '2025-01-15 10:02:40', '2025-01-25 08:15:14', 1),
(22, 'online', 0, 'Employee', 'Sanjeev Chawan', 'schawan@LKQCORP.com', '9844913046', 'KAO095', '188931', 1, '2025-01-14 12:53:33', NULL, NULL, NULL, NULL, 1, 'Spouse', 'No', 'No', '7-12', 'No', 0, 'Suma Chawan', NULL, NULL, 'Sudarshan Chavhan', NULL, 0, NULL, 0, 0, '+91', NULL, NULL, 'IMP232STUS', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/qrcodes/IMP232STUS.png', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/eticket/IMP232STUS.png', 1, 1, 2, 1, 1, 0, 0, 1, 0, NULL, 1, 1, 1, 1, 1, 1, 0, 0, 2, 0, '2025-01-14 12:53:06', '2025-01-25 09:35:25', 1),
(23, 'online', 0, 'Employee', 'Fayaz Ahamad', 'fayaz.ahamad@eurocarparts.com', '9686052771', 'KAO105', '043842', 1, '2025-01-14 19:17:04', NULL, NULL, NULL, NULL, 1, 'Spouse', 'Father-in-law', 'Mother-in-law', '13-18', '7-12', 0, 'Rubeena Banu', 'Fazalul Ali', 'Asha Begum', 'Aman Mohammed', 'Saman Mohammed', 0, NULL, 0, 0, '+91', NULL, NULL, 'IMP23AAC6U', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/qrcodes/IMP23AAC6U.png', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/eticket/IMP23AAC6U.png', 1, 1, 2, 1, 1, 1, 1, 1, 1, NULL, 1, 1, 1, 1, 1, 1, 0, 0, 2, 0, '2025-01-14 19:13:27', '2025-01-25 08:31:38', 1),
(24, 'online', 0, 'Employee', 'Pawan Kumar Baundwal', 'pkumar@LKQCORP.com', '9845310531', 'KAO107', '692910', 1, '2025-01-10 13:58:56', NULL, NULL, NULL, NULL, 1, 'Spouse', 'No', 'No', '7-12', '7-12', 0, 'Vineeta', NULL, NULL, 'Aayushi', 'Ishani', 0, NULL, 0, 0, '+91', NULL, NULL, 'IMP23HUVDG', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/qrcodes/IMP23HUVDG.png', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/eticket/IMP23HUVDG.png', 1, 1, 1, 1, 1, 0, 0, 1, 1, NULL, 1, 1, 1, 1, 1, 1, 0, 0, 2, 0, '2025-01-10 14:01:44', '2025-01-25 11:02:03', 1),
(25, 'online', 0, 'Employee', 'P Balasubramani', 'pbalasubramani@LKQCORP.com', '9986554700', 'KAO109', '984264', 1, '2025-01-14 20:13:13', NULL, NULL, NULL, NULL, 1, 'Spouse', 'Mother', 'No', '7-12', '7-12', 0, 'Suganya', 'Devaki', NULL, 'Nidhesh', 'Jeeva', 0, NULL, 0, 0, '+91', NULL, NULL, 'IMP23NSZCQ', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/qrcodes/IMP23NSZCQ.png', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/eticket/IMP23NSZCQ.png', 1, 1, 2, 1, 1, 0, 0, 1, 1, NULL, 1, 1, 1, 1, 1, 1, 0, 0, 2, 0, '2025-01-14 20:34:00', '2025-01-25 08:37:50', 1),
(26, 'online', 0, 'Employee', 'Karthick A', 'akarthick@LKQCORP.com', '9740909290', 'KAO114', '539504', 1, '2025-01-16 09:31:23', NULL, NULL, NULL, NULL, 1, 'Spouse', 'No', 'No', '7-12', '0-6', 0, 'Manimegalai', NULL, NULL, 'Kashwin', 'Aarush', 0, NULL, 0, 0, '+91', NULL, NULL, 'IMP23IUTDX', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/qrcodes/IMP23IUTDX.png', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/eticket/IMP23IUTDX.png', 1, 1, 2, 1, 1, 0, 0, 1, 1, NULL, 1, 1, 1, 1, 1, 1, 0, 0, 2, 0, '2025-01-16 09:29:57', '2025-01-25 08:48:26', 1),
(27, 'online', 0, 'Employee', 'Jagadish M', 'mohan.jagadish@eurocarparts.com', '9900457204', 'KAO115', '360064', 1, '2025-01-18 00:36:16', NULL, NULL, NULL, NULL, 1, 'Father', 'Mother', 'Spouse', '7-12', 'No', 0, 'Mohan', 'Harija', 'Bhagya', 'Yashika', NULL, 0, NULL, 0, 0, '+91', NULL, NULL, 'IMP23D6DJ8', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/qrcodes/IMP23D6DJ8.png', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/eticket/IMP23D6DJ8.png', 1, 1, 2, 1, 0, 0, 0, 0, 0, NULL, 1, 1, 1, 1, 1, 1, 0, 0, 2, 0, '2025-01-18 00:33:40', '2025-01-25 07:53:21', 1),
(28, 'online', 0, 'Employee', 'Dhiraj Dixit', 'ddixit@LKQCORP.com', '9739709978', 'KAO119', '593369', 1, '2025-01-22 13:02:08', NULL, NULL, NULL, NULL, 1, 'No', 'No', 'No', '0-6', '0-6', 0, NULL, NULL, NULL, 'Shivaye', 'Viha', 0, NULL, 0, 0, '+91', NULL, NULL, 'IMP23DCNGT', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/qrcodes/IMP23DCNGT.png', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/eticket/IMP23DCNGT.png', 1, 1, 2, 1, 0, 0, 0, 1, 1, NULL, 1, 1, 1, 1, 1, 1, 0, 0, 2, 0, '2025-01-22 12:59:25', '2025-01-25 10:48:00', 1),
(29, 'online', 0, 'Employee', 'Annappa Barkur', 'Annappa.Barkur@LKQCORP.com', '8147610250', 'KAO128', '001187', 1, '2025-01-16 17:53:19', NULL, NULL, NULL, NULL, 1, 'Mother', 'No', 'No', 'No', 'No', 0, 'Susheelamma', NULL, NULL, NULL, NULL, 0, NULL, 0, 0, '+91', NULL, NULL, 'IMP23GBF3F', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/qrcodes/IMP23GBF3F.png', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/eticket/IMP23GBF3F.png', 1, 1, 1, 0, 0, 0, 0, 0, 0, NULL, 1, 1, 1, 1, 1, 1, 0, 0, 2, 0, '2025-01-07 15:39:28', '2025-01-25 05:22:41', 1),
(30, 'online', 0, 'Employee', 'Kishan Bhandari', 'Kishan.Bhandari@LKQCORP.com', '9886403185', 'KAO134', '663066', 1, '2025-01-14 12:22:53', NULL, NULL, NULL, NULL, 1, 'Spouse', 'Mother-in-law', 'No', '13-18', 'No', 0, 'Ranjini Nagaraj', 'Nagarathna', NULL, 'Aadya', NULL, 0, NULL, 0, 0, '+91', NULL, NULL, 'IMP23DEHN6', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/qrcodes/IMP23DEHN6.png', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/eticket/IMP23DEHN6.png', 1, 1, 2, 1, 0, 0, 0, 0, 0, NULL, 1, 1, 1, 1, 1, 1, 0, 0, 2, 0, '2025-01-14 12:18:56', '2025-01-25 08:49:24', 1),
(31, 'online', 0, 'Employee', 'Durga Prasad B N', 'durga.bn@eurocarparts.com', '9845114672', 'KAO138', '277566', 1, '2025-01-14 16:41:42', NULL, NULL, NULL, NULL, 1, 'Spouse', 'Father-in-law', 'Mother-in-law', 'No', 'No', 0, 'Suma K V', 'Vijendra Rao', 'Sougandhika', NULL, NULL, 0, NULL, 0, 0, '+91', NULL, NULL, 'IMP23FA357', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/qrcodes/IMP23FA357.png', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/eticket/IMP23FA357.png', 1, 1, 2, 0, 0, 0, 0, 0, 0, NULL, 1, 1, 1, 1, 1, 1, 0, 0, 2, 0, '2025-01-14 16:38:15', '2025-01-25 05:22:53', 1),
(32, 'online', 0, 'Employee', 'Alok Kumar Mohapatra', 'Alok.Kumar@LKQCORP.com', '9036387849', 'KAO144', '430060', 1, '2025-01-08 00:02:35', NULL, NULL, NULL, NULL, 1, 'No', 'No', 'No', '13-18', 'No', 0, NULL, NULL, NULL, 'ARMAN MOHAPATRA', NULL, 0, NULL, 0, 0, '+91', NULL, NULL, 'IMP23BCBSA', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/qrcodes/IMP23BCBSA.png', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/eticket/IMP23BCBSA.png', 1, 1, 1, 1, 0, 0, 0, 1, 0, NULL, 1, 1, 1, 1, 1, 1, 0, 0, 2, 0, '2025-01-08 00:01:04', '2025-01-25 10:04:35', 1),
(33, 'online', 0, 'Employee', 'Veena M Togataveer', 'Veena.Manjunath@eurocarparts.com', '9686089091', 'KAO145', '109590', 1, '2025-01-16 16:17:23', NULL, NULL, NULL, NULL, 1, 'Spouse', 'Father', 'Mother', '0-6', '0-6', 0, 'Shiddu', 'Manjunath', 'Chandramma', 'Kashvee', 'Trishika', 0, NULL, 0, 0, '+91', NULL, NULL, 'IMP238D8X3', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/qrcodes/IMP238D8X3.png', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/eticket/IMP238D8X3.png', 1, 1, 2, 1, 1, 0, 0, 1, 1, NULL, 1, 1, 1, 1, 1, 1, 0, 0, 2, 0, '2025-01-16 16:13:43', '2025-01-25 11:09:55', 1),
(34, 'online', 0, 'Employee', 'Sandeep V Shetty', 'sandeep.shetty@eurocarparts.com', '9743073477', 'KAO146', '931025', 1, '2025-01-14 13:23:14', NULL, NULL, NULL, NULL, 1, 'Spouse', 'Mother-in-law', 'No', '0-6', 'No', 0, 'Amritha Shetty', 'Vasanti Shetty', NULL, 'Yashmika Shetty', NULL, 0, NULL, 0, 0, '+91', NULL, NULL, 'IMP23KVNZ9', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/qrcodes/IMP23KVNZ9.png', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/eticket/IMP23KVNZ9.png', 1, 1, 2, 1, 1, 1, 0, 1, 0, NULL, 1, 1, 1, 1, 1, 1, 0, 0, 2, 0, '2025-01-14 13:20:17', '2025-01-25 09:41:42', 1),
(35, 'online', 0, 'Employee', 'Vishal Ganjoo', 'Vishal.Ganjoo@lkqcorp.com', '9845966353', 'KAO147', '158986', 1, '2025-01-14 13:31:13', NULL, NULL, NULL, NULL, 1, 'No', 'No', 'No', 'No', 'No', 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, 0, '+91', NULL, NULL, 'IMP23XQK2N', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/qrcodes/IMP23XQK2N.png', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/eticket/IMP23XQK2N.png', 1, 1, 2, 1, 0, 0, 0, 0, 0, NULL, 1, 1, 1, 1, 1, 1, 0, 0, 2, 0, '2025-01-14 13:27:55', '2025-01-25 09:13:18', 1),
(36, 'online', 0, 'Employee', 'Pratima S Mudakanagoudar', 'pratima.mudakanagoudar@eurocarparts.com', '9008748032', 'KAO148', '338489', 1, '2025-01-15 11:46:03', NULL, NULL, NULL, NULL, 1, 'Spouse', 'Father-in-law', 'Mother-in-law', '0-6', '0-6', 0, 'Anand', 'Sangappa', 'Surekha', 'Janvi', 'Siri', 0, NULL, 0, 0, '+91', NULL, NULL, 'IMP23SN8G6', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/qrcodes/IMP23SN8G6.png', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/eticket/IMP23SN8G6.png', 1, 1, 2, 1, 1, 1, 1, 1, 1, NULL, 1, 1, 1, 1, 1, 1, 0, 0, 2, 0, '2025-01-15 11:42:11', '2025-01-25 08:52:07', 1),
(37, 'online', 0, 'Employee', 'Satheesh B G', 'Satheesh.Gururaj@lkqcorp.com', '9844257708', 'KAO149', '858469', 1, '2025-01-14 11:44:53', NULL, NULL, NULL, NULL, 1, 'Spouse', 'Father', 'Mother', '0-6', '0-6', 0, 'Kavitha B H', 'Gururaja B', 'Padma Gururaj', 'Shreesha S', 'Hethvik S', 0, NULL, 0, 0, '+91', NULL, NULL, 'IMP23ETQGW', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/qrcodes/IMP23ETQGW.png', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/eticket/IMP23ETQGW.png', 1, 1, 2, 0, 0, 0, 0, 0, 0, NULL, 1, 1, 1, 1, 1, 1, 0, 0, 2, 0, '2025-01-14 11:41:18', '2025-01-25 05:23:29', 1),
(38, 'online', 0, 'Employee', 'Sharanabasava G', 'sharanabasava.g@eurocarparts.com', '', 'KAO157', '838685', 1, '2025-01-08 18:27:29', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, 0, '+', NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 0, 0, 0, 0, 0, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2024-12-24 14:04:33', '2025-01-14 05:43:14', 0),
(39, 'online', 0, 'Employee', 'Ramamoorthi K', 'rxkrishnappa@LKQCORP.com', '9731516576', 'KAO165', '179349', 1, '2025-01-08 21:18:39', NULL, NULL, NULL, NULL, 1, 'Spouse', 'No', 'No', '13-18', '7-12', 0, 'Rashmi R', NULL, NULL, 'KeerthanRaj R', 'Saanavi R', 0, NULL, 0, 0, '+91', NULL, NULL, 'IMP23WFQX7', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/qrcodes/IMP23WFQX7.png', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/eticket/IMP23WFQX7.png', 1, 1, 1, 0, 0, 0, 0, 0, 0, NULL, 1, 1, 1, 1, 1, 1, 0, 0, 2, 0, '2025-01-08 21:16:50', '2025-01-25 05:23:36', 1),
(40, 'online', 0, 'Employee', 'Aruna M Kulavi', 'amkulavi@LKQCORP.com', '8904791281', 'KAO168', '841753', 1, '2025-01-14 16:43:52', NULL, NULL, NULL, NULL, 1, 'Father', 'Mother', 'No', 'No', 'No', 0, 'Mallanna', 'Thanuja', NULL, NULL, NULL, 0, NULL, 0, 0, '+91', NULL, NULL, 'IMP239EDYG', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/qrcodes/IMP239EDYG.png', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/eticket/IMP239EDYG.png', 1, 1, 2, 0, 0, 0, 0, 0, 0, NULL, 1, 1, 1, 1, 1, 1, 0, 0, 2, 0, '2025-01-14 16:40:00', '2025-01-25 05:23:42', 1),
(41, 'online', 0, 'Employee', 'Gayathri Shekar', 'gtshekar@lkqcorp.com', '9036893457', 'KAO169', '983869', 1, '2025-01-14 13:16:54', NULL, NULL, NULL, NULL, 1, 'Spouse', 'Father-in-law', 'Mother-in-law', 'No', 'No', 0, 'Harish', 'Dhananjaya', 'Nagarathna', NULL, NULL, 0, NULL, 0, 0, '+91', NULL, NULL, 'IMP23V6Z3B', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/qrcodes/IMP23V6Z3B.png', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/eticket/IMP23V6Z3B.png', 1, 1, 2, 1, 1, 0, 0, 0, 0, NULL, 1, 1, 1, 1, 1, 1, 0, 0, 2, 0, '2025-01-14 13:13:30', '2025-01-25 08:50:19', 1),
(42, 'online', 0, 'Employee', 'Manjunaath K R', 'KRManjunaath@LKQCORP.com', '9036511315', 'KAO171', '387726', 1, '2025-01-17 18:51:03', NULL, NULL, NULL, NULL, 1, 'Spouse', 'Mother', 'Mother-in-law', '0-6', '7-12', 0, 'Ramalakshmi', 'Kannamma', 'Subbulakshmi', 'Lakshit Raj M', 'Rupashree M', 0, NULL, 0, 0, '+91', NULL, NULL, 'IMP23GQTG9', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/qrcodes/IMP23GQTG9.png', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/eticket/IMP23GQTG9.png', 1, 1, 2, 1, 0, 1, 1, 1, 1, NULL, 1, 1, 1, 1, 1, 1, 0, 0, 2, 0, '2025-01-17 18:47:35', '2025-01-25 08:49:15', 1),
(43, 'online', 0, 'Employee', 'Srijith L Gowda', 'slgowda@LKQCORP.com', '', 'KAO174', '356991', 1, '2025-01-06 12:48:57', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, 0, '+', NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 0, 0, 0, 0, 0, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2024-12-24 14:04:33', '2025-01-15 07:23:50', 0),
(44, 'online', 0, 'Employee', 'Madhu Kiran T', 'mktumuluri@LKQCORP.com', '8553003338', 'KAO181', '292845', 1, '2025-01-15 15:56:30', NULL, NULL, NULL, NULL, 1, 'Spouse', 'No', 'No', 'No', 'No', 0, 'Thrishee', NULL, NULL, NULL, NULL, 0, NULL, 0, 0, '+91', NULL, NULL, 'IMP23M6EEE', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/qrcodes/IMP23M6EEE.png', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/eticket/IMP23M6EEE.png', 1, 1, 2, 1, 1, 0, 0, 0, 0, NULL, 1, 1, 1, 1, 1, 1, 0, 0, 2, 0, '2025-01-15 15:59:13', '2025-01-25 11:40:21', 1),
(45, 'online', 0, 'Employee', 'Kiran Kanaparthi', 'kiran.kanaparthi@lkqeurope.com', '6304685934', 'KAO182', '465361', 1, '2025-01-02 13:02:01', NULL, NULL, NULL, NULL, 1, 'Spouse', 'Father-in-law', 'Mother-in-law', '0-6', 'No', 0, 'Himaja', 'Suresh', 'Sowmya', 'Kiki', NULL, 0, NULL, 0, 0, '+91', NULL, NULL, 'IMP23K5VC8', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/qrcodes/IMP23K5VC8.png', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/eticket/IMP23K5VC8.png', 1, 1, 1, 0, 0, 0, 0, 0, 0, NULL, 1, 1, 1, 1, 1, 1, 0, 0, 2, 0, '2025-01-02 13:00:10', '2025-01-25 05:24:07', 1),
(46, 'online', 0, 'Employee', 'Chaithanya S V', 'csreddy@LKQCORP.com', '9742462201', 'KAO186', '870406', 1, '2025-01-14 15:10:07', NULL, NULL, NULL, NULL, 1, 'Father', 'Mother', 'Spouse', '0-6', 'No', 0, 'Venkata Shiva Reddy', 'Radha', 'Vidya', 'Udhvik', NULL, 0, NULL, 0, 0, '+91', NULL, NULL, 'IMP23X4P8C', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/qrcodes/IMP23X4P8C.png', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/eticket/IMP23X4P8C.png', 1, 1, 2, 1, 1, 1, 1, 1, 0, NULL, 1, 1, 1, 1, 1, 1, 0, 0, 2, 0, '2025-01-14 15:08:50', '2025-01-25 09:26:37', 1),
(47, 'online', 0, 'Employee', 'Veeranna M Hadimani', 'vmhadimani@LKQCORP.com', '7676550991', 'KAO204', '573406', 1, '2025-01-16 17:46:52', NULL, NULL, NULL, NULL, 1, 'Spouse', 'Father', 'Mother', '0-6', '0-6', 0, 'Shradha', 'Mallikarjun', 'Shobha', 'Vachana', 'Shritik', 0, NULL, 0, 0, '+91', NULL, NULL, 'IMP23EJQ7C', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/qrcodes/IMP23EJQ7C.png', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/eticket/IMP23EJQ7C.png', 1, 1, 2, 1, 1, 0, 0, 1, 1, NULL, 1, 1, 1, 1, 1, 1, 0, 0, 2, 0, '2025-01-16 17:42:56', '2025-01-25 09:02:32', 1),
(48, 'online', 0, 'Employee', 'Owais Ahmed Sharieff', 'owais.sharieff@eurocarparts.com', '9901078839', 'KAO211', '826161', 1, '2025-01-14 13:37:24', NULL, NULL, NULL, NULL, 1, 'Spouse', 'No', 'No', '0-6', 'No', 0, 'Parveen Taj', NULL, NULL, 'Raaina', NULL, 0, NULL, 0, 0, '+91', NULL, NULL, 'IMP232REPW', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/qrcodes/IMP232REPW.png', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/eticket/IMP232REPW.png', 1, 1, 2, 1, 0, 0, 0, 0, 0, NULL, 1, 1, 1, 1, 1, 1, 0, 0, 2, 0, '2025-01-14 13:34:19', '2025-01-25 09:10:30', 1),
(49, 'online', 0, 'Employee', 'Ravichandra Acharya', 'rxacharya@LKQCORP.com', '9986400601', 'KAO215', '945793', 1, '2025-01-14 17:58:56', NULL, NULL, NULL, NULL, 1, 'Spouse', 'No', 'No', '7-12', 'No', 0, 'Srilatha Samaga', NULL, NULL, 'Viraj Krishna', NULL, 0, NULL, 0, 0, '+91', NULL, NULL, 'IMP23HXRA7', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/qrcodes/IMP23HXRA7.png', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/eticket/IMP23HXRA7.png', 1, 1, 2, 1, 1, 0, 0, 1, 0, NULL, 1, 1, 1, 1, 1, 1, 0, 0, 2, 0, '2025-01-14 17:55:19', '2025-01-25 09:59:10', 1),
(50, 'online', 0, 'Employee', 'Syed Kaleemulla', 'sxkaleemulla@LKQCORP.com', '9972345185', 'KAO219', '355977', 1, '2025-01-14 20:20:56', NULL, NULL, NULL, NULL, 1, 'Father', 'Mother', 'Spouse', '0-6', 'No', 0, 'Syed Shafiulla', 'Farzana Begam', 'Khalida Khanum', 'Syed Luqman', NULL, 0, NULL, 0, 0, '+91', NULL, NULL, 'IMP23RCY33', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/qrcodes/IMP23RCY33.png', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/eticket/IMP23RCY33.png', 1, 1, 2, 0, 0, 0, 0, 0, 0, NULL, 1, 1, 1, 1, 1, 1, 0, 0, 2, 0, '2025-01-14 20:17:48', '2025-01-25 05:24:38', 1),
(51, 'onsite', 0, 'Employee', 'Guru Prasath', 'guru.prasath@eurocarparts.com', '9361521660', 'AP0071', NULL, 0, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, 0, NULL, NULL, NULL, 'IMP23ATWGY25', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/qrcodes/IMP23ATWGY25.png', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/eticket/IMP23ATWGY25.png', 1, 1, 0, 1, 0, 0, 0, 0, 0, NULL, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, '2025-01-25 13:43:57', '2025-01-25 08:14:12', 0),
(52, 'onsite', 0, 'Employee', 'Nihal Jagadish Salian', 'nihal.salian@eurocarparts.com', '7411099583', 'APP0072', NULL, 0, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, 0, NULL, NULL, NULL, 'IMP23ATXRN72', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/qrcodes/IMP23ATXRN72.png', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/eticket/IMP23ATXRN72.png', 1, 1, 0, 1, 0, 0, 0, 0, 0, NULL, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, '2025-01-25 13:44:41', '2025-01-25 08:15:11', 0),
(53, 'onsite', 0, 'Employee', 'Dileep', 'dxonganattu@lkqcorp.com', '7259998859', 'KAO1494', NULL, 0, NULL, NULL, NULL, NULL, NULL, 1, 'Spouse', NULL, NULL, '0-6', NULL, 0, 'Ambily', NULL, NULL, 'Aadvik', NULL, 0, NULL, 0, 0, NULL, NULL, NULL, 'IMP23ATRXR9A', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/qrcodes/IMP23ATRXR9A.png', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/eticket/IMP23ATRXR9A.png', 1, 1, 0, 1, 1, 0, 0, 1, 0, NULL, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, '2025-01-25 15:32:07', '2025-01-25 10:03:12', 0),
(54, 'onsite', 0, 'Employee', 'Jawad', 'mxjawad@lkqcorp.com', '8660895128', 'KAO294', NULL, 0, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, 0, NULL, NULL, NULL, 'IMP23AT89FYT', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/qrcodes/IMP23AT89FYT.png', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/eticket/IMP23AT89FYT.png', 1, 1, 0, 1, 0, 0, 0, 0, 0, NULL, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, '2025-01-25 16:33:12', '2025-01-25 11:04:12', 0),
(55, 'onsite', 0, 'Employee', 'Kavyashree C M', 'kavyashrre.madhavabhat@fource.nl', '7676839571', 'APP0039', NULL, 0, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, 0, NULL, NULL, NULL, 'IMP23AT9DIRU', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/qrcodes/IMP23AT9DIRU.png', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/eticket/IMP23AT9DIRU.png', 1, 1, 0, 1, 0, 0, 0, 0, 0, NULL, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, '2025-01-25 18:03:12', '2025-01-25 12:34:12', 0),
(56, 'onsite', 0, 'Employee', 'Keshavan S', 'kxselvaraj@lkqcorp.com', '9962993210', 'Kao3002', NULL, 0, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, 0, NULL, NULL, NULL, 'IMP23ATFSNHC', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/qrcodes/IMP23ATFSNHC.png', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/eticket/IMP23ATFSNHC.png', 1, 1, 0, 1, 0, 0, 0, 0, 0, NULL, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, '2025-01-25 19:14:11', '2025-01-27 12:32:06', 0);


-- --------------------------------------------------------

--
-- Table structure for table `users1`
--
DROP TABLE IF EXISTS `users1`;

CREATE TABLE `users1` (
  `id` BIGINT UNSIGNED NOT NULL ,
  `user_type` VARCHAR(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `update_ticket` TINYINT DEFAULT 0,
  `category` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` VARCHAR(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emp_code` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp_status` TINYINT NOT NULL DEFAULT 0,
  `otp_expires_at` TIMESTAMP NULL DEFAULT NULL,
  `lead_name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slot` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `primary_user` VARCHAR(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attendees` TINYINT NOT NULL DEFAULT 0,
  `adult_1` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adult_2` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `spouse` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kid_1` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kid_2` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_primary_user` TINYINT DEFAULT 0,
  `guest1_name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guest2_name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guest3_name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kid1_name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kid2_name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_goodies` TINYINT DEFAULT 0,
  `goodies_at` VARCHAR(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_goodies_kid_1` TINYINT DEFAULT 0,
  `is_goodies_kid_2` TINYINT DEFAULT 0,
  `country_code` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designation` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unique_code` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qrcode_path` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `eticket_path` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` TINYINT(1) NOT NULL DEFAULT 0,
  `event_status` TINYINT NOT NULL DEFAULT 0,
  `update_status` INT NOT NULL DEFAULT 0,
  `is_printed` TINYINT(1) NOT NULL DEFAULT 0,
  `is_printed_adult_1` INT NOT NULL DEFAULT 0,
  `is_printed_adult_2` INT NOT NULL DEFAULT 0,
  `is_printed_adult_3` INT NOT NULL DEFAULT 0,
  `is_printed_kid_1` INT NOT NULL DEFAULT 0,
  `is_printed_kid_2` INT NOT NULL DEFAULT 0,
  `printed_at` DATETIME DEFAULT NULL,
  `email_send` INT DEFAULT 0,
  `send_whatsapp` INT DEFAULT 0,
  `map_location` INT NOT NULL DEFAULT 0,
  `food_menu` INT NOT NULL DEFAULT 0,
  `metro` INT NOT NULL DEFAULT 0,
  `sendInvitation_whatsapp` TINYINT NOT NULL DEFAULT 0,
  `rem_email_send` INT DEFAULT 0,
  `feed_email_send` INT DEFAULT 0,
  `attendance_ballroom` TINYINT(1) NOT NULL DEFAULT 0,
  `attendance_lunch` TINYINT(1) NOT NULL DEFAULT 0,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `details_updated` INT NOT NULL DEFAULT 0,

  -- Optional indexes
  INDEX (`email`),
  INDEX (`phone`),
  INDEX (`unique_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users1`
--


INSERT INTO `users1` (`id`, `user_type`, `update_ticket`, `category`, `name`, `email`, `phone`, `emp_code`, `otp`, `otp_status`, `otp_expires_at`, `lead_name`, `date`, `slot`, `primary_user`, `attendees`, `adult_1`, `adult_2`, `spouse`, `kid_1`, `kid_2`, `is_primary_user`, `guest1_name`, `guest2_name`, `guest3_name`, `kid1_name`, `kid2_name`, `is_goodies`, `goodies_at`, `is_goodies_kid_1`, `is_goodies_kid_2`, `country_code`, `company`, `designation`, `unique_code`, `qrcode_path`, `eticket_path`, `status`, `event_status`, `update_status`, `is_printed`, `is_printed_adult_1`, `is_printed_adult_2`, `is_printed_adult_3`, `is_printed_kid_1`, `is_printed_kid_2`, `printed_at`, `email_send`, `send_whatsapp`, `map_location`, `food_menu`, `metro`, `sendInvitation_whatsapp`, `rem_email_send`, `feed_email_send`, `attendance_ballroom`, `attendance_lunch`, `created_at`, `updated_at`, `details_updated`) VALUES
(1, NULL, 0, NULL, 'Deepthi Umesha', 'deepthi.umesha@lkqeurope.com', '8431877133', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, '', '', '', '', '', 0, '', '', '', '', '', 0, NULL, 0, 0, NULL, NULL, NULL, NULL, 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/qrcodes/APP0025.png', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/eticket/APP0025.png', 1, 0, 0, 0, 0, 0, 0, 0, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2025-01-24 18:57:42', '2025-01-24 18:57:42', 0),
(2, NULL, 0, NULL, 'Gayathri Jagadesh', 'gayathri.jagadesh@lkqeurope.com', '8904193368', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, '', '', '', '', '', 0, '', '', '', '', '', 0, NULL, 0, 0, NULL, NULL, NULL, NULL, 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/qrcodes/APP0026.png', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/eticket/APP0026.png', 1, 0, 0, 0, 0, 0, 0, 0, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2025-01-24 18:57:42', '2025-01-24 18:57:42', 0),
(3, NULL, 0, NULL, 'Nevendiran Nehru', 'nxnehru@lkqcorp.com', '7397762997', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, 'Father', 'Mother', '', '', '', 0, 'NEHRU P', 'VISALATCHI N', '', '', '', 0, NULL, 0, 0, NULL, NULL, NULL, NULL, 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/qrcodes/APP0033.png', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/eticket/APP0033.png', 1, 0, 0, 0, 0, 0, 0, 0, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2025-01-24 18:57:42', '2025-01-24 18:57:42', 0),
(4, NULL, 0, NULL, 'Geetha b v', 'gxvenkatesh@lkqcorp.com', '7795480131', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, 'Mother', 'Father', '', '', '', 0, 'venkatesh', 'sujatha', '', '', '', 0, NULL, 0, 0, NULL, NULL, NULL, NULL, 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/qrcodes/APP0043.png', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/eticket/APP0043.png', 1, 0, 0, 0, 0, 0, 0, 0, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2025-01-24 18:57:42', '2025-01-24 18:57:42', 0),
(5, NULL, 0, NULL, 'Nandhini A B', 'nabhaskaran@lkqcorp.com', '9019940377', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, '', '', '', '', '', 0, '', '', '', '', '', 0, NULL, 0, 0, NULL, NULL, NULL, NULL, 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/qrcodes/APP0045.png', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/eticket/APP0045.png', 1, 0, 0, 0, 0, 0, 0, 0, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2025-01-24 18:57:42', '2025-01-24 18:57:42', 0),
(6, NULL, 0, NULL, 'Utsav TH', 'utsav.th@lkqeurope.com', '8884320100', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, '', '', '', '', '', 0, '', '', '', '', '', 0, NULL, 0, 0, NULL, NULL, NULL, NULL, 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/qrcodes/APP0062.png', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/eticket/APP0062.png', 1, 0, 0, 0, 0, 0, 0, 0, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2025-01-24 18:57:42', '2025-01-24 18:57:42', 0),
(7, NULL, 0, NULL, 'JeevithaGL', 'jxgl@LKQCORP.com', '8431984346', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, 'Father', 'Mother', '', '', '', 0, 'Lakshmi Narayan GM', 'Ambika Devi MM', '', '', '', 0, NULL, 0, 0, NULL, NULL, NULL, NULL, 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/qrcodes/APP0063.png', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/eticket/APP0063.png', 1, 0, 0, 0, 0, 0, 0, 0, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2025-01-24 18:57:42', '2025-01-24 18:57:42', 0),
(8, NULL, 0, NULL, 'Shanmukappa vaidya', 'shanmukappa.vaidya@eurocarparts.com', '', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, 'Spouse', 'Mother-in-Law', '', '0 - 6', '13 - 18', 0, 'Lakshmi', 'Shantamma', '', 'Sanvika', 'Pratibha', 0, NULL, 0, 0, NULL, NULL, NULL, NULL, 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/qrcodes/KAO1039.png', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/eticket/KAO1039.png', 1, 0, 0, 0, 0, 0, 0, 0, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2025-01-24 18:57:42', '2025-01-24 18:57:42', 0),
(9, NULL, 0, NULL, 'Puneeth', 'pxlokesh@lkqcorp.com', '7411140416', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, '', '', '', '', '', 0, '', '', '', '', '', 0, NULL, 0, 0, NULL, NULL, NULL, NULL, 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/qrcodes/KAO1055.png', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/eticket/KAO1055.png', 1, 0, 0, 0, 0, 0, 0, 0, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2025-01-24 18:57:42', '2025-01-24 18:57:42', 0),
(10, NULL, 0, NULL, 'MURALIMANOHARA U', 'muralimanohara.uliya@lkqeurope.com', '9480420116', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, '', '', '', '', '', 0, '', '', '', '', '', 0, NULL, 0, 0, NULL, NULL, NULL, NULL, 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/qrcodes/KAO1093.png', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/eticket/KAO1093.png', 1, 0, 0, 0, 0, 0, 0, 0, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2025-01-24 18:57:42', '2025-01-24 18:57:42', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_backup_2025`
DROP TABLE IF EXISTS `user_backup_2025`;

CREATE TABLE `user_backup_2025` (
  `id` BIGINT(20) UNSIGNED NOT NULL ,
  `user_type` VARCHAR(20) DEFAULT NULL,
  `update_ticket` TINYINT(4) DEFAULT 0,
  `category` VARCHAR(255) DEFAULT NULL,
  `name` VARCHAR(255) DEFAULT NULL,
  `email` VARCHAR(255) DEFAULT NULL,
  `phone` VARCHAR(50) DEFAULT NULL,
  `emp_code` VARCHAR(255) DEFAULT NULL,
  `otp` VARCHAR(255) DEFAULT NULL,
  `otp_expires_at` TIMESTAMP NULL DEFAULT NULL,
  `lead_name` VARCHAR(255) DEFAULT NULL,
  `date` VARCHAR(100) DEFAULT NULL,
  `slot` VARCHAR(255) DEFAULT NULL,
  `primary_user` VARCHAR(250) DEFAULT NULL,
  `adult_1` VARCHAR(100) DEFAULT NULL,
  `adult_2` VARCHAR(100) DEFAULT NULL,
  `spouse` VARCHAR(100) DEFAULT NULL,
  `kid_1` VARCHAR(100) DEFAULT NULL,
  `kid_2` VARCHAR(100) DEFAULT NULL,
  `is_primary_user` TINYINT(4) DEFAULT 0,
  `is_adult_1` TINYINT(4) DEFAULT 0,
  `is_adult_2` TINYINT(4) DEFAULT 0,
  `is_spouse` TINYINT(4) DEFAULT 0,
  `is_kid_1` TINYINT(4) DEFAULT 0,
  `is_kid_2` TINYINT(4) DEFAULT 0,
  `is_goodies` TINYINT(4) DEFAULT 0,
  `goodies_at` VARCHAR(200) DEFAULT NULL,
  `is_goodies_kid_1` TINYINT(4) DEFAULT 0,
  `is_goodies_kid_2` TINYINT(4) DEFAULT 0,
  `country_code` VARCHAR(100) DEFAULT NULL,
  `company` VARCHAR(255) DEFAULT NULL,
  `designation` VARCHAR(255) DEFAULT NULL,
  `unique_code` VARCHAR(255) DEFAULT NULL,
  `qrcode_path` TEXT,
  `eticket_path` TEXT,
  `status` TINYINT(1) NOT NULL DEFAULT 0,
  `is_printed` TINYINT(1) NOT NULL DEFAULT 0,
  `printed_at` DATETIME DEFAULT NULL,
  `email_send` INT(11) DEFAULT 0,
  `send_whatsapp` INT(11) DEFAULT 0,
  `sendInvitation_whatsapp` TINYINT(4) NOT NULL DEFAULT 0,
  `rem_email_send` INT(11) DEFAULT 0,
  `feed_email_send` INT(11) DEFAULT 0,
  `attendance_ballroom` TINYINT(1) NOT NULL DEFAULT 0,
  `attendance_lunch` TINYINT(1) NOT NULL DEFAULT 0,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `details_updated` INT(11) NOT NULL DEFAULT 0,

  -- optional performance indexes
  INDEX (`email`),
  INDEX (`unique_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users_name`
--
CREATE TABLE `users_name` (
  `id` BIGINT UNSIGNED NOT NULL ,
  `user_type` VARCHAR(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `update_ticket` TINYINT DEFAULT 0,
  `category` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` VARCHAR(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emp_code` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp_status` TINYINT(1) NOT NULL DEFAULT 0,
  `otp_expires_at` TIMESTAMP NULL DEFAULT NULL,
  `lead_name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slot` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `primary_user` VARCHAR(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attendees` TINYINT NOT NULL DEFAULT 0,
  `adult_1` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adult_2` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `spouse` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kid_1` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kid_2` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_primary_user` TINYINT DEFAULT 0,
  `guest1_name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guest2_name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guest3_name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kid1_name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kid2_name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_goodies` TINYINT DEFAULT 0,
  `goodies_at` VARCHAR(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_goodies_kid_1` TINYINT DEFAULT 0,
  `is_goodies_kid_2` TINYINT DEFAULT 0,
  `country_code` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designation` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unique_code` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qrcode_path` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `eticket_path` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` TINYINT(1) NOT NULL DEFAULT 0,
  `event_status` TINYINT NOT NULL DEFAULT 0,
  `is_printed` TINYINT(1) NOT NULL DEFAULT 0,
  `is_printed_adult_1` INT NOT NULL DEFAULT 0,
  `is_printed_adult_2` INT NOT NULL DEFAULT 0,
  `is_printed_adult_3` INT NOT NULL DEFAULT 0,
  `is_printed_kid_1` INT NOT NULL DEFAULT 0,
  `is_printed_kid_2` INT NOT NULL DEFAULT 0,
  `printed_at` DATETIME DEFAULT NULL,
  `email_send` INT DEFAULT 0,
  `send_whatsapp` INT DEFAULT 0,
  `sendInvitation_whatsapp` TINYINT NOT NULL DEFAULT 0,
  `rem_email_send` INT DEFAULT 0,
  `feed_email_send` INT DEFAULT 0,
  `attendance_ballroom` TINYINT(1) NOT NULL DEFAULT 0,
  `attendance_lunch` TINYINT(1) NOT NULL DEFAULT 0,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `details_updated` INT NOT NULL DEFAULT 0,

  -- performance-related indexes
  INDEX (`email`),
  INDEX (`unique_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--


INSERT INTO `users_name` (`id`, `user_type`, `update_ticket`, `category`, `name`, `email`, `phone`, `emp_code`, `otp`, `otp_status`, `otp_expires_at`, `lead_name`, `date`, `slot`, `primary_user`, `attendees`, `adult_1`, `adult_2`, `spouse`, `kid_1`, `kid_2`, `is_primary_user`, `guest1_name`, `guest2_name`, `guest3_name`, `kid1_name`, `kid2_name`, `is_goodies`, `goodies_at`, `is_goodies_kid_1`, `is_goodies_kid_2`, `country_code`, `company`, `designation`, `unique_code`, `qrcode_path`, `eticket_path`, `status`, `event_status`, `is_printed`, `is_printed_adult_1`, `is_printed_adult_2`, `is_printed_adult_3`, `is_printed_kid_1`, `is_printed_kid_2`, `printed_at`, `email_send`, `send_whatsapp`, `sendInvitation_whatsapp`, `rem_email_send`, `feed_email_send`, `attendance_ballroom`, `attendance_lunch`, `created_at`, `updated_at`, `details_updated`) VALUES
(1, 'online', 0, 'Employee', 'Shlok aggrawal', 'shlok0531@gmail.com', '8081094578', 'KAO001', '953285', 1, '2024-12-25 11:06:02', NULL, NULL, NULL, NULL, 1, 'Spouse', 'No', 'No', 'No', 'No', 0, 'Hema Kishore R', NULL, NULL, NULL, NULL, 0, NULL, 0, 0, '+91', NULL, NULL, 'IMP23G996Y', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/qrcodes/IMP23G996Y.png', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/eticket/IMP23G996Y.png', 1, 1, 0, 0, 0, 0, 0, 0, NULL, 1, 1, 0, 0, 0, 2, 0, '2024-12-25 11:02:09', '2024-12-25 05:33:03', 1),
(2, 'online', 0, 'Employee', 'test', 'ezzmyevent@gmail.com', '7985460986', 'KAO002', '091947', 1, '2024-12-30 18:39:36', NULL, NULL, NULL, NULL, 1, 'Spouse', 'No', 'No', '7-12', 'No', 0, 'Nandhini', NULL, NULL, 'Suhana', NULL, 0, NULL, 0, 0, '+91', NULL, NULL, 'IMP23ZEUJU', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/qrcodes/IMP23ZEUJU.png', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/eticket/IMP23ZEUJU.png', 1, 1, 0, 0, 0, 0, 0, 0, NULL, 1, 1, 0, 0, 0, 2, 0, '2024-12-30 18:39:38', '2024-12-30 13:10:04', 1),
(3, 'online', 0, 'Employee', 'viraj', 'virajpaliwal4572@gmail.com', '9084347897', 'KAO003', '568706', 1, '2025-01-06 12:50:14', NULL, NULL, NULL, NULL, 1, 'Spouse', 'Father', 'Mother', '7-12', '13-18', 0, 'Harshitha T S', 'Nanjundappa SV', 'Manjula R', 'Jathin Krishna', 'Anvitha', 0, NULL, 0, 0, '+91', NULL, NULL, 'IMP23IU9MX', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/qrcodes/IMP23IU9MX.png', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/eticket/IMP23IU9MX.png', 1, 1, 0, 0, 0, 0, 0, 0, NULL, 1, 1, 0, 0, 0, 2, 0, '2025-01-06 12:48:36', '2025-01-06 07:19:34', 1),
(4, 'online', 0, 'Employee', 'ezzmyevent', 'rchemberkana@LKQCORP.com', '9880454414', 'KAO009', '224182', 1, '2024-12-27 12:53:47', NULL, NULL, NULL, NULL, 1, 'Spouse', 'No', 'No', '7-12', '0-6', 0, 'Anuradha K', NULL, NULL, 'Arjun Nayak C', 'Nakul Nayak C', 0, NULL, 0, 0, '+91', NULL, NULL, 'IMP23YHMZ2', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/qrcodes/IMP23YHMZ2.png', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/eticket/IMP23YHMZ2.png', 1, 1, 0, 0, 0, 0, 0, 0, NULL, 1, 1, 0, 0, 0, 2, 0, '2024-12-27 12:52:02', '2024-12-27 07:22:05', 1),
(5, 'online', 0, 'Employee', 'Raju K S', 'raju.karadi@lkqeurope.com', '9880667594', 'KAO012', '134743', 1, '2025-01-02 20:50:15', NULL, NULL, NULL, NULL, 1, 'Spouse', 'Father-in-law', 'Mother-in-law', '7-12', '0-6', 0, 'Suma', 'Jagadish', 'Hemavathi', 'Aarna', 'Avyaktha', 0, NULL, 0, 0, '+91', NULL, NULL, 'IMP23FDH7E', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/qrcodes/IMP23FDH7E.png', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/eticket/IMP23FDH7E.png', 1, 1, 0, 0, 0, 0, 0, 0, NULL, 1, 1, 0, 0, 0, 2, 0, '2025-01-02 20:48:32', '2025-01-02 15:19:34', 1),
(6, 'online', 0, 'Employee', 'Avinash K K', 'agowda@LKQCORP.com', '9980294028', 'KAO021', '653072', 1, '2024-12-24 15:49:21', NULL, NULL, NULL, NULL, 1, 'Spouse', 'Father', 'Father-in-law', '0-6', 'No', 0, 'Shambhavi HY', 'Kalle Gowda', 'Yogesh', 'Aarush Gowda', NULL, 0, NULL, 0, 0, '+91', NULL, NULL, 'IMP23MMQS3', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/qrcodes/IMP23MMQS3.png', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/eticket/IMP23MMQS3.png', 1, 1, 0, 0, 0, 0, 0, 0, NULL, 1, 1, 0, 0, 0, 2, 0, '2024-12-24 15:43:53', '2024-12-24 10:15:03', 1),
(7, 'online', 0, 'Employee', 'Yogamunishwaran TN', 'ynagarajan@LKQCORP.com', '9916972526', 'KAO023', '762226', 1, '2025-01-03 16:21:22', NULL, NULL, NULL, NULL, 1, 'Spouse', 'No', 'No', '7-12', '0-6', 0, 'Harileka M', NULL, NULL, 'Nishanth T Y', 'Dhanvanth T Y', 0, NULL, 0, 0, '+91', NULL, NULL, 'IMP23QZZAN', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/qrcodes/IMP23QZZAN.png', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/eticket/IMP23QZZAN.png', 1, 1, 0, 0, 0, 0, 0, 0, NULL, 1, 1, 0, 0, 0, 2, 0, '2025-01-03 16:18:22', '2025-01-03 10:49:03', 1),
(8, 'online', 0, 'Employee', 'Kamal K S', 'kkamal@LKQCORP.com', '9845991301', 'KAO025', '537651', 1, '2024-12-28 08:51:31', NULL, NULL, NULL, NULL, 1, 'Spouse', 'Mother-in-law', 'No', '13-18', '7-12', 0, 'YASMEEN FATIMA', 'AZMATHUNISSA', NULL, 'RAHIL SHAREEF', 'SAHIL AHMED', 0, NULL, 0, 0, '+91', NULL, NULL, 'IMP23N6NEG', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/qrcodes/IMP23N6NEG.png', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/eticket/IMP23N6NEG.png', 1, 1, 0, 0, 0, 0, 0, 0, NULL, 1, 1, 0, 0, 0, 2, 0, '2024-12-28 08:50:02', '2024-12-28 03:21:08', 1),
(9, 'online', 0, 'Employee', 'Suresh Kumar R', 'sr@LKQCORP.com', '9901652229', 'KAO029', '906686', 1, '2025-01-10 20:16:54', NULL, NULL, NULL, NULL, 1, 'Father', 'Mother', 'Spouse', '7-12', '0-6', 0, 'L Rajendran', 'R Vishalakshi', 'Shobha M', 'Nihant S', 'Sujana S', 0, NULL, 0, 0, '+91', NULL, NULL, 'IMP23WF7IG', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/qrcodes/IMP23WF7IG.png', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/eticket/IMP23WF7IG.png', 1, 1, 0, 0, 0, 0, 0, 0, NULL, 1, 1, 0, 0, 0, 2, 0, '2025-01-10 20:14:05', '2025-01-10 14:45:34', 1),
(10, 'online', 0, 'Employee', 'Prashantha R', 'rprashantha@LKQCORP.com', '9611144758', 'KAO033', '254680', 1, '2024-12-24 17:57:11', NULL, NULL, NULL, NULL, 1, 'No', 'No', 'No', 'No', 'No', 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, 0, '+91', NULL, NULL, 'IMP23Q35W9', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/qrcodes/IMP23Q35W9.png', 'https://s3.ap-south-1.amazonaws.com/test.bucket.in/Smart-Reg/LKQI/eticket/IMP23Q35W9.png', 1, 1, 0, 0, 0, 0, 0, 0, NULL, 1, 1, 0, 0, 0, 2, 0, '2024-12-24 17:54:07', '2024-12-27 06:57:21', 1);


--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_login`
--
ALTER TABLE `app_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `entry_zapping`
--
ALTER TABLE `entry_zapping`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `form_settings`
--
ALTER TABLE `form_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guests`
--
ALTER TABLE `guests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mail_templates`
--
ALTER TABLE `mail_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mail_templates_reminder_status_unique` (`reminder_status`);

--
-- Indexes for table `master_otp`
--
ALTER TABLE `master_otp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `module_permissions`
--
ALTER TABLE `module_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `online_registration_unique_codes`
--
ALTER TABLE `online_registration_unique_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `redeems`
--
ALTER TABLE `redeems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `smtps`
--
ALTER TABLE `smtps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users1`
--
ALTER TABLE `users1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_backup_2025`
--
ALTER TABLE `user_backup_2025`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_name`
--
ALTER TABLE `users_name`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `app_login`
--
ALTER TABLE `app_login`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT for table `entry_zapping`
--
ALTER TABLE `entry_zapping`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=286;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `feedback`
--
  ALTER TABLE `feedback`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `form_settings`
--
ALTER TABLE `form_settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `guests`
--
ALTER TABLE `guests`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `mail_templates`
--
ALTER TABLE `mail_templates`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `master_otp`
--
ALTER TABLE `master_otp`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `module_permissions`
--
ALTER TABLE `module_permissions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `online_registration_unique_codes`
--
ALTER TABLE `online_registration_unique_codes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=300252;

--
-- AUTO_INCREMENT for table `redeems`
--
ALTER TABLE `redeems`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `smtps`
--
ALTER TABLE `smtps`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5315;

--
-- AUTO_INCREMENT for table `users1`
--
ALTER TABLE `users1`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=307;

--
-- AUTO_INCREMENT for table `user_backup_2025`
--
ALTER TABLE `user_backup_2025`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users_name`
--
ALTER TABLE `users_name`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1649;
COMMIT;

/*to give access to local host server xampp */

-- Localhost access (only for dev/XAMPP)
-- ⚠️ Avoid in production

GRANT ALL PRIVILEGES ON `ezzm_crm`.* TO 'root'@'localhost' IDENTIFIED BY '' WITH GRANT OPTION;

FLUSH PRIVILEGES;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
