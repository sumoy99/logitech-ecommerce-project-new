-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2024 at 08:07 AM
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
-- Database: `agency_install_check_2`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_settings`
--

DROP TABLE IF EXISTS `about_settings`;
CREATE TABLE `about_settings` (
  `id` int(11) NOT NULL,
  `key` varchar(250) DEFAULT NULL,
  `value` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `about_settings`
--

INSERT INTO `about_settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'banner_video_url', 'https://www.youtube.com/watch?v=jPBfZrgvpSo', '2024-05-13 00:55:28', '2024-06-09 23:54:39'),
(2, 'banner_video_thumbnail', '17155837351.png', '2024-05-13 01:01:41', '2024-05-13 01:02:15'),
(3, 'aboout_us_title', 'Best Digital Solutiuon Provider Agency', '2024-05-13 01:28:05', '2024-06-09 23:54:39'),
(4, 'aboout_us_subtitle', 'Professional Design Agency to provide solutions', '2024-05-13 01:28:05', '2024-06-09 23:54:39'),
(5, 'aboout_us_des', 'On the other hand denounce with righteous and dislike men who beguile and demoralizes by the charms of pleasure thes moment, so blinded by desire that they cannot', '2024-05-13 01:28:05', '2024-06-09 23:54:39'),
(6, 'about_us_list', '[\"Digital Creative Agency\",\"Professional Problem Solutions\",\"Web Design & Development\"]', '2024-05-13 01:29:37', '2024-06-09 23:54:39'),
(7, 'about_us_img', '17155861132.png', '2024-05-13 01:29:37', '2024-05-13 01:41:53'),
(8, 'how_we_are_title', 'Build Grow & Manage Your Brand Identitys', '2024-05-13 01:56:13', '2024-06-09 23:54:39'),
(9, 'how_we_are_subtitle', 'Professional Design Agency to provide solutions', '2024-05-13 01:56:13', '2024-06-09 23:54:39'),
(10, 'how_we_are_des', 'NexaFlux is a premier Brand, Design & Development Agency. We specialize in innovative branding, digital design, and development solutions, blending creativity and technical excellence to bring your vision to life.', '2024-05-13 01:56:13', '2024-06-09 23:54:39'),
(11, 'how_we_are_img', '17155887873.png', '2024-05-13 02:26:27', '2024-05-13 02:26:27'),
(12, 'testimonials_title', 'What Our Client’s About Us', '2024-05-13 03:22:44', '2024-06-09 23:54:39'),
(13, 'testimonials_subtitle', 'Professional Design Agency to provide solutions', '2024-05-13 03:22:44', '2024-06-09 23:54:39'),
(14, 'partners_title', 'We’ve 1534+ Global Partners', '2024-05-13 05:14:07', '2024-06-09 23:54:39'),
(15, 'partaner_subtitle', 'Professional Design Agency to provide solutions', '2024-05-13 05:14:07', '2024-06-09 23:54:39');

-- --------------------------------------------------------

--
-- Table structure for table `agency_progresses`
--

DROP TABLE IF EXISTS `agency_progresses`;
CREATE TABLE `agency_progresses` (
  `id` int(11) NOT NULL,
  `agency_progress_title` varchar(250) DEFAULT NULL,
  `total_agency_progress` int(11) DEFAULT NULL,
  `agency_progress_icon` varchar(250) DEFAULT NULL,
  `status` varchar(250) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `all_blogs`
--

DROP TABLE IF EXISTS `all_blogs`;
CREATE TABLE `all_blogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `blog_title` varchar(250) DEFAULT NULL,
  `blog_subtitle` text DEFAULT NULL,
  `blog_category` varchar(250) DEFAULT NULL,
  `blog_description` text DEFAULT NULL,
  `blog_keywords` varchar(255) DEFAULT NULL,
  `blog_date` varchar(250) DEFAULT NULL,
  `blog_thumbnail` varchar(250) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `all_projects`
--

DROP TABLE IF EXISTS `all_projects`;
CREATE TABLE `all_projects` (
  `id` int(11) NOT NULL,
  `project_title` varchar(250) DEFAULT NULL,
  `project_category` int(11) DEFAULT NULL,
  `project_description` text DEFAULT NULL,
  `client` varchar(250) DEFAULT NULL,
  `project_date` varchar(250) DEFAULT NULL,
  `project_thumbnail` varchar(250) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog_categories`
--

DROP TABLE IF EXISTS `blog_categories`;
CREATE TABLE `blog_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_name` varchar(250) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `currency`
--

DROP TABLE IF EXISTS `currency`;
CREATE TABLE `currency` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `symbol` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `currency`
--

INSERT INTO `currency` (`id`, `name`, `code`, `symbol`) VALUES
(1, 'US Dollar', 'USD', '$'),
(2, 'Albanian Lek', 'ALL', 'Lek'),
(3, 'Algerian Dinar', 'DZD', 'دج'),
(4, 'Angolan Kwanza', 'AOA', 'Kz'),
(5, 'Argentine Peso', 'ARS', '$'),
(6, 'Armenian Dram', 'AMD', '֏'),
(7, 'Aruban Florin', 'AWG', 'ƒ'),
(8, 'Australian Dollar', 'AUD', '$'),
(9, 'Azerbaijani Manat', 'AZN', 'm'),
(10, 'Bahamian Dollar', 'BSD', 'B$'),
(11, 'Bahraini Dinar', 'BHD', '.د.ب'),
(12, 'Bangladeshi Taka', 'BDT', '৳'),
(13, 'Barbadian Dollar', 'BBD', 'Bds$'),
(14, 'Belarusian Ruble', 'BYR', 'Br'),
(15, 'Belgian Franc', 'BEF', 'fr'),
(16, 'Belize Dollar', 'BZD', '$'),
(17, 'Bermudan Dollar', 'BMD', '$'),
(18, 'Bhutanese Ngultrum', 'BTN', 'Nu.'),
(19, 'Bitcoin', 'BTC', '฿'),
(20, 'Bolivian Boliviano', 'BOB', 'Bs.'),
(21, 'Bosnia', 'BAM', 'KM'),
(22, 'Botswanan Pula', 'BWP', 'P'),
(23, 'Brazilian Real', 'BRL', 'R$'),
(24, 'British Pound Sterling', 'GBP', '£'),
(25, 'Brunei Dollar', 'BND', 'B$'),
(26, 'Bulgarian Lev', 'BGN', 'Лв.'),
(27, 'Burundian Franc', 'BIF', 'FBu'),
(28, 'Cambodian Riel', 'KHR', 'KHR'),
(29, 'Canadian Dollar', 'CAD', '$'),
(30, 'Cape Verdean Escudo', 'CVE', '$'),
(31, 'Cayman Islands Dollar', 'KYD', '$'),
(32, 'CFA Franc BCEAO', 'XOF', 'CFA'),
(33, 'CFA Franc BEAC', 'XAF', 'FCFA'),
(34, 'CFP Franc', 'XPF', '₣'),
(35, 'Chilean Peso', 'CLP', '$'),
(36, 'Chinese Yuan', 'CNY', '¥'),
(37, 'Colombian Peso', 'COP', '$'),
(38, 'Comorian Franc', 'KMF', 'CF'),
(39, 'Congolese Franc', 'CDF', 'FC'),
(40, 'Costa Rican ColÃ³n', 'CRC', '₡'),
(41, 'Croatian Kuna', 'HRK', 'kn'),
(42, 'Cuban Convertible Peso', 'CUC', '$, CUC'),
(43, 'Czech Republic Koruna', 'CZK', 'Kč'),
(44, 'Danish Krone', 'DKK', 'Kr.'),
(45, 'Djiboutian Franc', 'DJF', 'Fdj'),
(46, 'Dominican Peso', 'DOP', '$'),
(47, 'East Caribbean Dollar', 'XCD', '$'),
(48, 'Egyptian Pound', 'EGP', 'ج.م'),
(49, 'Eritrean Nakfa', 'ERN', 'Nfk'),
(50, 'Estonian Kroon', 'EEK', 'kr'),
(51, 'Ethiopian Birr', 'ETB', 'Nkf'),
(52, 'Euro', 'EUR', '€'),
(53, 'Falkland Islands Pound', 'FKP', '£'),
(54, 'Fijian Dollar', 'FJD', 'FJ$'),
(55, 'Gambian Dalasi', 'GMD', 'D'),
(56, 'Georgian Lari', 'GEL', 'ლ'),
(57, 'German Mark', 'DEM', 'DM'),
(58, 'Ghanaian Cedi', 'GHS', 'GH₵'),
(59, 'Gibraltar Pound', 'GIP', '£'),
(60, 'Greek Drachma', 'GRD', '₯, Δρχ, Δρ'),
(61, 'Guatemalan Quetzal', 'GTQ', 'Q'),
(62, 'Guinean Franc', 'GNF', 'FG'),
(63, 'Guyanaese Dollar', 'GYD', '$'),
(64, 'Haitian Gourde', 'HTG', 'G'),
(65, 'Honduran Lempira', 'HNL', 'L'),
(66, 'Hong Kong Dollar', 'HKD', '$'),
(67, 'Hungarian Forint', 'HUF', 'Ft'),
(68, 'Icelandic KrÃ³na', 'ISK', 'kr'),
(69, 'Indian Rupee', 'INR', '₹'),
(70, 'Indonesian Rupiah', 'IDR', 'Rp'),
(71, 'Iranian Rial', 'IRR', '﷼'),
(72, 'Iraqi Dinar', 'IQD', 'د.ع'),
(73, 'Israeli New Sheqel', 'ILS', '₪'),
(74, 'Italian Lira', 'ITL', 'L,£'),
(75, 'Jamaican Dollar', 'JMD', 'J$'),
(76, 'Japanese Yen', 'JPY', '¥'),
(77, 'Jordanian Dinar', 'JOD', 'ا.د'),
(78, 'Kazakhstani Tenge', 'KZT', 'лв'),
(79, 'Kenyan Shilling', 'KES', 'KSh'),
(80, 'Kuwaiti Dinar', 'KWD', 'ك.د'),
(81, 'Kyrgystani Som', 'KGS', 'лв'),
(82, 'Laotian Kip', 'LAK', '₭'),
(83, 'Latvian Lats', 'LVL', 'Ls'),
(84, 'Lebanese Pound', 'LBP', '£'),
(85, 'Lesotho Loti', 'LSL', 'L'),
(86, 'Liberian Dollar', 'LRD', '$'),
(87, 'Libyan Dinar', 'LYD', 'د.ل'),
(88, 'Lithuanian Litas', 'LTL', 'Lt'),
(89, 'Macanese Pataca', 'MOP', '$'),
(90, 'Macedonian Denar', 'MKD', 'ден'),
(91, 'Malagasy Ariary', 'MGA', 'Ar'),
(92, 'Malawian Kwacha', 'MWK', 'MK'),
(93, 'Malaysian Ringgit', 'MYR', 'RM'),
(94, 'Maldivian Rufiyaa', 'MVR', 'Rf'),
(95, 'Mauritanian Ouguiya', 'MRO', 'MRU'),
(96, 'Mauritian Rupee', 'MUR', '₨'),
(97, 'Mexican Peso', 'MXN', '$'),
(98, 'Moldovan Leu', 'MDL', 'L'),
(99, 'Mongolian Tugrik', 'MNT', '₮'),
(100, 'Moroccan Dirham', 'MAD', 'MAD'),
(101, 'Mozambican Metical', 'MZM', 'MT'),
(102, 'Myanmar Kyat', 'MMK', 'K'),
(103, 'Namibian Dollar', 'NAD', '$'),
(104, 'Nepalese Rupee', 'NPR', '₨'),
(105, 'Netherlands Antillean Guilder', 'ANG', 'ƒ'),
(106, 'New Taiwan Dollar', 'TWD', '$'),
(107, 'New Zealand Dollar', 'NZD', '$'),
(108, 'Nicaraguan CÃ³rdoba', 'NIO', 'C$'),
(109, 'Nigerian Naira', 'NGN', '₦'),
(110, 'North Korean Won', 'KPW', '₩'),
(111, 'Norwegian Krone', 'NOK', 'kr'),
(112, 'Omani Rial', 'OMR', '.ع.ر'),
(113, 'Pakistani Rupee', 'PKR', '₨'),
(114, 'Panamanian Balboa', 'PAB', 'B/.'),
(115, 'Papua New Guinean Kina', 'PGK', 'K'),
(116, 'Paraguayan Guarani', 'PYG', '₲'),
(117, 'Peruvian Nuevo Sol', 'PEN', 'S/.'),
(118, 'Philippine Peso', 'PHP', '₱'),
(119, 'Polish Zloty', 'PLN', 'zł'),
(120, 'Qatari Rial', 'QAR', 'ق.ر'),
(121, 'Romanian Leu', 'RON', 'lei'),
(122, 'Russian Ruble', 'RUB', '₽'),
(123, 'Rwandan Franc', 'RWF', 'FRw'),
(124, 'Salvadoran ColÃ³n', 'SVC', '₡'),
(125, 'Samoan Tala', 'WST', 'SAT'),
(126, 'Saudi Riyal', 'SAR', '﷼'),
(127, 'Serbian Dinar', 'RSD', 'din'),
(128, 'Seychellois Rupee', 'SCR', 'SRe'),
(129, 'Sierra Leonean Leone', 'SLL', 'Le'),
(130, 'Singapore Dollar', 'SGD', '$'),
(131, 'Slovak Koruna', 'SKK', 'Sk'),
(132, 'Solomon Islands Dollar', 'SBD', 'Si$'),
(133, 'Somali Shilling', 'SOS', 'Sh.so.'),
(134, 'South African Rand', 'ZAR', 'R'),
(135, 'South Korean Won', 'KRW', '₩'),
(136, 'Special Drawing Rights', 'XDR', 'SDR'),
(137, 'Sri Lankan Rupee', 'LKR', 'Rs'),
(138, 'St. Helena Pound', 'SHP', '£'),
(139, 'Sudanese Pound', 'SDG', '.س.ج'),
(140, 'Surinamese Dollar', 'SRD', '$'),
(141, 'Swazi Lilangeni', 'SZL', 'E'),
(142, 'Swedish Krona', 'SEK', 'kr'),
(143, 'Swiss Franc', 'CHF', 'CHf'),
(144, 'Syrian Pound', 'SYP', 'LS'),
(145, 'São Tomé and Príncipe Dobra', 'STD', 'Db'),
(146, 'Tajikistani Somoni', 'TJS', 'SM'),
(147, 'Tanzanian Shilling', 'TZS', 'TSh'),
(148, 'Thai Baht', 'THB', '฿'),
(149, 'Tongan pa\'anga', 'TOP', '$'),
(150, 'Trinidad & Tobago Dollar', 'TTD', '$'),
(151, 'Tunisian Dinar', 'TND', 'ت.د'),
(152, 'Turkish Lira', 'TRY', '₺'),
(153, 'Turkmenistani Manat', 'TMT', 'T'),
(154, 'Ugandan Shilling', 'UGX', 'UGX'),
(155, 'Ukrainian Hryvnia', 'UAH', '₴'),
(156, 'United Arab Emirates Dirham', 'AED', 'إ.د'),
(157, 'Uruguayan Peso', 'UYU', '$'),
(158, 'Afghan Afghani', 'AFA', '؋'),
(159, 'Uzbekistan Som', 'UZS', 'лв'),
(160, 'Vanuatu Vatu', 'VUV', 'VT'),
(161, 'Venezuelan BolÃvar', 'VEF', 'Bs'),
(162, 'Vietnamese Dong', 'VND', '₫'),
(163, 'Yemeni Rial', 'YER', '﷼'),
(164, 'Zambian Kwacha', 'ZMK', 'ZK'),
(165, 'PesosColombian Peso', 'COP', '$'),
(166, 'SEPA', 'EUR', '€'),
(167, 'Mozambican Metical', 'MZN', 'MT'),
(168, 'Peruvian Sol', 'SOL', 'S/'),
(169, 'Zambian Kwacha', 'ZMW', 'ZK');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `global_settings`
--

DROP TABLE IF EXISTS `global_settings`;
CREATE TABLE `global_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) DEFAULT NULL,
  `value` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `global_settings`
--

INSERT INTO `global_settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'system_name', 'NexaFlux', '2024-05-01 10:27:39', '2024-06-10 06:01:26'),
(2, 'system_title', 'NexaFlux', '2024-05-01 10:27:39', '2024-06-10 06:01:26'),
(3, 'navbar_title', 'NexaFlux', '2024-05-01 10:27:39', '2024-06-10 06:01:26'),
(4, 'system_email', NULL, '2024-05-01 10:27:39', '2024-06-10 06:01:26'),
(5, 'phone', '+1 (832) 896-3414', '2024-05-01 10:27:39', '2024-06-10 06:01:26'),
(6, 'fax', '+1 (906) 275-7314', '2024-05-01 10:27:39', '2024-06-10 06:01:26'),
(7, 'language', 'english', '2024-05-01 10:27:39', '2024-06-10 06:01:26'),
(8, 'address', 'DOHS, Mirpur 12, Dhaka', '2024-05-01 10:27:39', '2024-06-10 06:01:26'),
(9, 'timezone', 'Europe/Vienna', '2024-05-01 10:27:39', '2024-06-10 06:01:26'),
(10, 'dark_logo', '1717499574dark.png', '2024-05-01 12:36:04', '2024-06-04 11:12:54'),
(11, 'light_logo', '1717499636light.png', '2024-05-01 12:38:43', '2024-06-04 11:13:56'),
(12, 'favicon', '1717499673favicon.png', '2024-05-01 12:38:43', '2024-06-04 11:14:33'),
(13, 'smtp_protocol', NULL, '2024-05-01 12:56:33', '2024-06-04 06:11:06'),
(14, 'smtp_crypto', NULL, '2024-05-01 12:56:33', '2024-06-04 06:11:06'),
(15, 'smtp_host', NULL, '2024-05-01 12:56:33', '2024-06-04 06:11:06'),
(16, 'smtp_port', NULL, '2024-05-01 12:56:33', '2024-06-04 06:11:06'),
(17, 'smtp_user', NULL, '2024-05-01 12:56:33', '2024-06-04 06:11:06'),
(18, 'smtp_pass', NULL, '2024-05-01 12:56:33', '2024-06-04 06:11:06'),
(19, '_token', 'Ugx7SCFKcRofjQ7OWe055Mhhbk3icbxxbF0hsT9d', '2024-05-06 10:22:40', '2024-05-07 08:08:18'),
(20, 'contact_email', '[null,null]', '2024-05-06 10:22:40', '2024-06-10 06:00:40'),
(21, 'location', NULL, '2024-05-06 10:22:40', '2024-06-10 06:00:40'),
(22, 'location_url', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3649.439764646758!2d90.37372397391542!3d23.838512985390608!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c4246506cd07%3A0x70f2e187b70638cc!2sCreativeitem!5e0!3m2!1sen!2sbd!4v1714988407680!5m2!1sen!2sbd', '2024-05-06 10:22:40', '2024-06-10 06:00:40'),
(23, 'working_start_day', 'Saturday', '2024-05-06 10:22:40', '2024-06-10 06:00:40'),
(24, 'working_end_day', 'Thursday', '2024-05-06 10:22:40', '2024-06-10 06:00:40'),
(25, 'working_start_time', '10:00', '2024-05-06 10:22:40', '2024-06-10 06:00:40'),
(26, 'working_end_time', '18:00', '2024-05-06 10:22:40', '2024-06-10 06:00:40'),
(27, 'preloader', '0', '2024-05-06 10:25:56', '2024-06-10 06:01:26'),
(28, 'contact_number', '[null,null]', '2024-05-06 10:44:04', '2024-06-10 06:00:40'),
(29, 'system_currency', 'BDT', '2024-05-06 10:22:40', '2024-06-10 06:01:26'),
(30, 'currency_position', 'left-space', '2024-05-06 10:22:40', '2024-06-10 06:01:26'),
(31, 'global_currency', 'BDT', '2024-05-09 09:27:09', '2024-06-10 06:01:26'),
(32, 'banner_title', 'Brand, Design & Development Agency', '2024-05-28 09:54:15', '2024-06-10 06:00:40'),
(33, 'banner_subtitle', 'NexaFlux is a top Brand, Design & Development Agency, specializing in innovative branding, digital design, and development solutions. We bring visions to life with creativity and technical excellence.', '2024-05-28 09:54:15', '2024-06-10 06:00:40'),
(34, 'banner_img', '1717328850banner_img.png', '2024-05-28 09:55:34', '2024-06-02 11:47:30'),
(35, 'lets_work', 'Experience & innovative solutions for creative design & development agency', '2024-05-28 11:09:48', '2024-06-10 06:00:40'),
(36, 'lets_work_img', '1717390709lets_work_img.png', '2024-05-28 11:14:38', '2024-06-03 04:58:29'),
(37, 'testimonial_img', '1717391658testimonial_img.png', '2024-05-29 05:58:01', '2024-06-03 05:14:18'),
(38, 'contact_title', 'Have Any on Project Mind! Contact Us', '2024-05-29 06:15:41', '2024-06-10 06:00:40'),
(39, 'contact_subtitle', 'Sed ut perspiciatis unde omnis iste natus error voluptatem accusantium doloremque laudan tium, totam rem aperiam, eaque ipsa quae abillo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem', '2024-05-29 06:15:41', '2024-06-10 06:00:40'),
(40, 'fotter_logo', '1717499655fotter_logo.png', '2024-05-29 06:43:21', '2024-06-04 11:14:15'),
(53, 'social_media_icon', '[{\"social_media_icon\":\"fab fa-facebook\",\"social_media_url\":\"www.facebook.com\",\"social_media_name\":\"Facebook\"},{\"social_media_icon\":\"fab fa-instagram\",\"social_media_url\":\"www.instagram.com\",\"social_media_name\":\"Instagram\"},{\"social_media_icon\":\"fab fa-dribbble-square\",\"social_media_url\":\"www.dribbble.com\",\"social_media_name\":\"Dribble\"}]', '2024-05-29 09:33:09', '2024-06-10 06:00:40'),
(54, 'social_media_name', '[{\"social_media_icon\":\"fab fa-facebook\",\"social_media_url\":\"www.facebook.com\",\"social_media_name\":\"Facebook\"},{\"social_media_icon\":\"fab fa-instagram\",\"social_media_url\":\"www.instagram.com\",\"social_media_name\":\"Instagram\"},{\"social_media_icon\":\"fab fa-dribbble-square\",\"social_media_url\":\"www.dribbble.com\",\"social_media_name\":\"Dribble\"}]', '2024-05-29 09:33:09', '2024-06-10 06:00:40'),
(55, 'social_media_url', '[{\"social_media_icon\":\"fab fa-facebook\",\"social_media_url\":\"www.facebook.com\",\"social_media_name\":\"Facebook\"},{\"social_media_icon\":\"fab fa-instagram\",\"social_media_url\":\"www.instagram.com\",\"social_media_name\":\"Instagram\"},{\"social_media_icon\":\"fab fa-dribbble-square\",\"social_media_url\":\"www.dribbble.com\",\"social_media_name\":\"Dribble\"}]', '2024-05-29 09:33:09', '2024-06-10 06:00:40'),
(56, 'fotter_top_title', 'Modern Solutionsd For Creative Agency', '2024-05-29 09:52:32', '2024-06-10 06:00:40'),
(57, 'fotter_title', 'Subscribe Our Newsletter', '2024-05-29 09:52:32', '2024-06-10 06:00:40'),
(58, 'fotter_sub_title', 'Stay updated with the latest insights and exclusive offers from NexaFlux. Subscribe to our newsletter and be the first to know about our new projects, industry trends, and special promotions!', '2024-05-29 09:52:32', '2024-06-10 06:00:40'),
(59, 'copyright_text', '2024. All rights reserved development by Sumoy', '2024-05-29 09:57:50', '2024-06-10 06:00:40'),
(60, 'version', '1', '2024-05-01 10:27:39', '2024-05-28 09:43:28'),
(61, 'og_title', 'NexaFlux', '2024-05-30 12:46:30', '2024-06-08 10:48:06'),
(62, 'og_url', 'https://demo.creativeitem.com/laravel-themes/digital_agency/', '2024-05-30 12:46:30', '2024-06-08 10:48:06'),
(63, 'og_description', 'NexaFlux is a top Brand, Design & Development Agency, specializing in innovative branding, digital design, and development solutions. We bring visions to life with creativity and technical excellence.', '2024-05-30 12:46:30', '2024-06-08 10:48:06'),
(64, 'meta_description', 'NexaFlux is a top Brand, Design & Development Agency, specializing in innovative branding, digital design, and development solutions. We bring visions to life with creativity and technical excellence.', '2024-05-30 12:46:30', '2024-06-08 10:48:06'),
(65, 'keywords', 'digital agency, nexaflux,', '2024-05-30 12:46:30', '2024-06-08 10:48:06'),
(66, 'robots', 'noindex, nofollow', '2024-05-30 12:46:30', '2024-06-08 10:48:06'),
(67, 'canonical', 'https://demo.creativeitem.com/laravel-themes/digital_agency/', '2024-05-30 12:46:30', '2024-06-08 10:48:06'),
(68, 'twitter_card', 'summary', '2024-05-30 12:46:30', '2024-06-08 10:48:06'),
(69, 'twitter_title', 'NexaFlux', '2024-05-30 12:46:30', '2024-06-08 10:48:06'),
(70, 'twitter_description', 'NexaFlux is a top Brand, Design & Development Agency, specializing in innovative branding, digital design, and development solutions. We bring visions to life with creativity and technical excellence.', '2024-05-30 12:46:30', '2024-06-08 10:48:06'),
(71, 'og_image', '1717582472og_image.png', '2024-05-30 12:46:30', '2024-06-05 10:14:32'),
(72, 'twitter_image', '1717582472twitter_image.png', '2024-05-30 12:46:30', '2024-06-05 10:14:32'),
(73, 'our_service_og_title', 'NexaFlux Serivce', '2024-06-08 10:16:45', '2024-06-09 10:16:39'),
(74, 'our_service_og_url', 'https://demo.creativeitem.com/laravel-themes/digital_agency/services', '2024-06-08 10:16:45', '2024-06-09 10:16:39'),
(75, 'our_service_og_description', 'NexaFlux is a premier Brand, Design & Development Agency. We specialize in innovative brand identities, cutting-edge digital designs, and robust development solutions. Our expert team blends creativity and technical excellence to bring your vision to life. Drive your business forward with NexaFlux\'s tailored strategies and exceptional execution.', '2024-06-08 10:16:45', '2024-06-09 10:16:39'),
(76, 'our_service_meta_description', 'NexaFlux is a premier Brand, Design & Development Agency. We specialize in innovative brand identities, cutting-edge digital designs, and robust development solutions. Our expert team blends creativity and technical excellence to bring your vision to life. Drive your business forward with NexaFlux\'s tailored strategies and exceptional execution.', '2024-06-08 10:16:45', '2024-06-09 10:16:39'),
(77, 'our_service_keywords', 'Service, NexaFlux,', '2024-06-08 10:16:45', '2024-06-09 10:16:39'),
(78, 'our_service_robots', 'noindex, nofollow', '2024-06-08 10:16:45', '2024-06-09 10:16:39'),
(79, 'our_service_canonical', 'https://demo.creativeitem.com/laravel-themes/digital_agency/services', '2024-06-08 10:16:45', '2024-06-09 10:16:39'),
(80, 'our_service_twitter_card', 'summery', '2024-06-08 10:16:45', '2024-06-09 10:16:39'),
(81, 'our_service_twitter_title', 'NexaFlux Serivce', '2024-06-08 10:16:45', '2024-06-09 10:16:39'),
(82, 'our_service_twitter_description', 'NexaFlux is a premier Brand, Design & Development Agency. We specialize in innovative brand identities, cutting-edge digital designs, and robust development solutions. Our expert team blends creativity and technical excellence to bring your vision to life. Drive your business forward with NexaFlux\'s tailored strategies and exceptional execution.', '2024-06-08 10:16:45', '2024-06-09 10:16:39'),
(83, 'service_details_og_title', 'Service Details', '2024-06-08 10:37:46', '2024-06-09 10:18:53'),
(84, 'service_details_og_url', 'https://demo.creativeitem.com/laravel-themes/digital_agency/services_details', '2024-06-08 10:37:46', '2024-06-09 10:18:53'),
(85, 'service_details_og_description', 'Build Your Business Workflow Faster', '2024-06-08 10:37:46', '2024-06-09 10:18:53'),
(86, 'service_details_meta_description', 'Build Your Business Workflow Faster', '2024-06-08 10:37:46', '2024-06-09 10:18:53'),
(87, 'service_details_keywords', 'service details, service, nexaflux', '2024-06-08 10:37:46', '2024-06-09 10:18:53'),
(88, 'service_details_robots', 'noindex, nofollow', '2024-06-08 10:37:46', '2024-06-09 10:18:53'),
(89, 'service_details_canonical', 'https://demo.creativeitem.com/laravel-themes/digital_agency/services_details', '2024-06-08 10:37:46', '2024-06-09 10:18:53'),
(90, 'service_details_twitter_card', 'summary', '2024-06-08 10:37:46', '2024-06-09 10:18:53'),
(91, 'service_details_twitter_title', 'Service Details', '2024-06-08 10:37:46', '2024-06-09 10:18:53'),
(92, 'service_details_twitter_description', 'Build Your Business Workflow Faster', '2024-06-08 10:37:46', '2024-06-09 10:18:53'),
(93, 'author', 'NexaFlux', '2024-06-08 10:46:34', '2024-06-08 10:48:06'),
(94, 'publisher', 'NexaFlux', '2024-06-08 10:46:34', '2024-06-08 10:48:06'),
(95, 'portfolio_og_url', 'http://localhost/degital_agency/digital_agency_demo/projects', '2024-06-08 11:31:30', '2024-06-09 10:17:22'),
(96, 'portfolio_og_description', 'Professional Experience', '2024-06-08 11:31:30', '2024-06-09 10:17:22'),
(97, 'portfolio_meta_description', 'Professional Experience', '2024-06-08 11:31:30', '2024-06-09 10:17:22'),
(98, 'portfolio_keywords', 'projects, nexaflux', '2024-06-08 11:31:30', '2024-06-09 10:17:22'),
(99, 'portfolio_robots', 'noindex, nofollow', '2024-06-08 11:31:30', '2024-06-09 10:17:22'),
(100, 'portfolio_canonical', 'http://localhost/degital_agency/digital_agency_demo/projects', '2024-06-08 11:31:30', '2024-06-09 10:17:22'),
(101, 'portfolio_twitter_card', 'summary', '2024-06-08 11:31:30', '2024-06-09 10:17:22'),
(102, 'portfolio_twitter_title', 'NexaFlux Project', '2024-06-08 11:31:30', '2024-06-09 10:17:22'),
(103, 'portfolio_twitter_description', 'Professional Experience', '2024-06-08 11:31:30', '2024-06-09 10:17:22'),
(104, 'about_og_url', 'https://demo.creativeitem.com/laravel-themes/digital_agency/', '2024-06-08 11:34:31', '2024-06-09 10:19:23'),
(105, 'about_og_description', 'NexaFlux is a premier Brand, Design & Development Agency. We specialize in innovative branding, cutting-edge digital design, and robust development solutions, seamlessly blending creativity and technical excellence to bring your vision to life.', '2024-06-08 11:34:31', '2024-06-09 10:19:23'),
(106, 'about_meta_description', 'NexaFlux is a premier Brand, Design & Development Agency. We specialize in innovative branding, cutting-edge digital design, and robust development solutions, seamlessly blending creativity and technical excellence to bring your vision to life.', '2024-06-08 11:34:31', '2024-06-09 10:19:23'),
(107, 'about_keywords', 'about, nexaflux', '2024-06-08 11:34:31', '2024-06-09 10:19:23'),
(108, 'about_robots', 'noindex, nofollow', '2024-06-08 11:34:31', '2024-06-09 10:19:23'),
(109, 'about_canonical', 'https://demo.creativeitem.com/laravel-themes/digital_agency/about_us', '2024-06-08 11:34:31', '2024-06-09 10:19:23'),
(110, 'about_twitter_card', 'summary', '2024-06-08 11:34:31', '2024-06-09 10:19:23'),
(111, 'about_twitter_title', 'Best Digital Solutiuon Provider Agency', '2024-06-08 11:34:31', '2024-06-09 10:19:23'),
(112, 'about_twitter_description', 'NexaFlux is a premier Brand, Design & Development Agency. We specialize in innovative branding, cutting-edge digital design, and robust development solutions, seamlessly blending creativity and technical excellence to bring your vision to life.', '2024-06-08 11:34:31', '2024-06-09 10:19:23'),
(113, 'team_og_url', 'https://demo.creativeitem.com/laravel-themes/digital_agency/our_team', '2024-06-08 11:37:36', '2024-06-09 10:26:05'),
(114, 'team_og_description', 'Experience Team to Provide Ideas', '2024-06-08 11:37:36', '2024-06-09 10:26:05'),
(115, 'team_meta_description', 'Experience Team to Provide Ideas', '2024-06-08 11:37:36', '2024-06-09 10:26:05'),
(116, 'team_keywords', 'our team, nexaflux', '2024-06-08 11:37:36', '2024-06-09 10:26:05'),
(117, 'team_robots', 'noindex, nofollw', '2024-06-08 11:37:36', '2024-06-09 10:26:05'),
(118, 'team_canonical', 'https://demo.creativeitem.com/laravel-themes/digital_agency/our_team', '2024-06-08 11:37:36', '2024-06-09 10:26:05'),
(119, 'team_twitter_card', 'Experience Team to Provide Ideas', '2024-06-08 11:37:36', '2024-06-09 10:26:05'),
(120, 'team_twitter_title', 'Experience Team to Provide Ideas', '2024-06-08 11:37:36', '2024-06-09 10:26:05'),
(121, 'team_twitter_description', 'Experience Team to Provide Ideas', '2024-06-08 11:37:36', '2024-06-09 10:26:05'),
(122, 'blog_og_url', 'https://demo.creativeitem.com/laravel-themes/digital_agency/blogs', '2024-06-08 11:40:47', '2024-06-09 10:26:38'),
(123, 'blog_og_description', 'Blog Description', '2024-06-08 11:40:47', '2024-06-09 10:26:39'),
(124, 'blog_meta_description', 'Blog Description', '2024-06-08 11:40:47', '2024-06-09 10:26:39'),
(125, 'blog_keywords', 'blog, nexaflux', '2024-06-08 11:40:47', '2024-06-09 10:26:39'),
(126, 'blog_robots', 'noindex, nofollow', '2024-06-08 11:40:47', '2024-06-09 10:26:39'),
(127, 'blog_canonical', 'https://demo.creativeitem.com/laravel-themes/digital_agency/blogs', '2024-06-08 11:40:47', '2024-06-09 10:26:39'),
(128, 'blog_twitter_card', 'Summery', '2024-06-08 11:40:47', '2024-06-09 10:26:39'),
(129, 'blog_twitter_title', 'Blog', '2024-06-08 11:40:47', '2024-06-09 10:26:39'),
(130, 'blog_twitter_description', 'Blog Description', '2024-06-08 11:40:47', '2024-06-09 10:26:39'),
(131, 'contact_og_url', 'https://demo.creativeitem.com/laravel-themes/digital_agency/contact_us', '2024-06-08 11:42:55', '2024-06-09 10:27:11'),
(132, 'contact_og_description', 'Have Any Projects in Mind? Work Together', '2024-06-08 11:42:55', '2024-06-09 10:27:11'),
(133, 'contact_meta_description', 'Have Any Projects in Mind? Work Together', '2024-06-08 11:42:55', '2024-06-09 10:27:11'),
(134, 'contact_keywords', 'contact, nexaflux', '2024-06-08 11:42:55', '2024-06-09 10:27:11'),
(135, 'contact_robots', 'noindex, nofollow', '2024-06-08 11:42:55', '2024-06-09 10:27:11'),
(136, 'contact_canonical', 'https://demo.creativeitem.com/laravel-themes/digital_agency/contact_us', '2024-06-08 11:42:55', '2024-06-09 10:27:11'),
(137, 'contact_twitter_card', 'summary', '2024-06-08 11:42:55', '2024-06-09 10:27:11'),
(138, 'contact_twitter_title', 'Have Any Projects in Mind? Work Together', '2024-06-08 11:42:55', '2024-06-09 10:27:11'),
(139, 'contact_twitter_description', 'Have Any Projects in Mind? Work Together', '2024-06-08 11:42:55', '2024-06-09 10:27:11'),
(140, 'portfolio_og_title', 'Nexaflux Portfolio', '2024-06-09 07:14:53', '2024-06-09 10:17:22'),
(141, 'about_og_title', 'Nexaflux About', '2024-06-09 07:15:15', '2024-06-09 10:19:23'),
(142, 'team_og_title', 'Nexaflux Team', '2024-06-09 07:15:39', '2024-06-09 10:26:05'),
(143, 'blog_og_title', 'Nexaflux Blog', '2024-06-09 07:15:53', '2024-06-09 10:26:38'),
(144, 'contact_og_title', 'Nexaflux Contact', '2024-06-09 07:16:11', '2024-06-09 10:27:11'),
(145, 'our_service_og_image', '1717928199our_service_og_image.png', '2024-06-09 10:16:39', '2024-06-09 10:16:39'),
(146, 'our_service_twitter_image', '1717928199our_service_twitter_image.png', '2024-06-09 10:16:39', '2024-06-09 10:16:39'),
(147, 'portfolio_og_image', '1717928242portfolio_og_image.png', '2024-06-09 10:17:22', '2024-06-09 10:17:22'),
(148, 'portfolio_twitter_image', '1717928242portfolio_twitter_image.png', '2024-06-09 10:17:22', '2024-06-09 10:17:22'),
(149, 'service_details_og_image', '1717928333service_details_og_image.png', '2024-06-09 10:18:53', '2024-06-09 10:18:53'),
(150, 'service_details_twitter_image', '1717928333service_details_twitter_image.png', '2024-06-09 10:18:53', '2024-06-09 10:18:53'),
(151, 'about_og_image', '1717928552team_og_image.png', '2024-06-09 10:19:23', '2024-06-09 10:22:32'),
(152, 'team_og_image', '1717928765team_og_image.png', '2024-06-09 10:22:32', '2024-06-09 10:26:05'),
(153, 'blog_og_image', '1717928799blog_og_image.png', '2024-06-09 10:26:39', '2024-06-09 10:26:39'),
(154, 'contact_og_image', '1717928831contact_og_image.png', '2024-06-09 10:27:11', '2024-06-09 10:27:11');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

DROP TABLE IF EXISTS `language`;
CREATE TABLE `language` (
  `id` int(20) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `phrase` varchar(250) DEFAULT NULL,
  `translated` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`id`, `name`, `phrase`, `translated`) VALUES
(1, 'english', 'Language Settings', 'Language Settings'),
(2, 'english', 'Home', 'Home'),
(3, 'english', 'Settings', 'Settings'),
(4, 'english', 'Language list ', 'Language list '),
(5, 'english', 'Add language', 'Add language'),
(6, 'english', 'Language', 'Language'),
(7, 'english', 'Option', 'Option'),
(8, 'english', 'Edit phrase', 'Edit phrase'),
(9, 'english', 'Delete language', 'Delete language'),
(10, 'english', 'Add new language', 'Add new language'),
(11, 'english', 'No special character or space is allowed', 'No special character or space is allowed'),
(12, 'english', 'Valid examples', 'Valid examples'),
(13, 'english', 'Save', 'Save'),
(14, 'english', 'System default language can not be removed', 'System default language can not be removed'),
(15, 'english', 'Phrase updated', 'Phrase updated'),
(16, 'english', 'Update', 'Update'),
(33, 'english', 'System Settings', 'System Settings'),
(35, 'english', 'System Name', 'System Name'),
(37, 'english', 'System Title', 'System Title'),
(39, 'english', 'Navbar Title', 'Navbar Title'),
(41, 'english', 'System Email', 'System Email'),
(43, 'english', 'Phone', 'Phone'),
(45, 'english', 'Fax', 'Fax'),
(47, 'english', 'System Language', 'System Language'),
(49, 'english', 'Address', 'Address'),
(51, 'english', 'Timezone', 'Timezone'),
(53, 'english', 'Submit', 'Submit'),
(82, 'english', 'Dashboard', 'Dashboard'),
(85, 'english', 'System_Settings', 'System_Settings'),
(88, 'english', 'Visit Website', 'Visit Website'),
(91, 'english', 'SYSTEM LOGO', 'SYSTEM LOGO'),
(94, 'english', 'Dark logo', 'Dark logo'),
(97, 'english', 'Light logo', 'Light logo'),
(100, 'english', 'Favicon', 'Favicon'),
(103, 'english', 'Update Logo', 'Update Logo'),
(106, 'english', 'SMTP Settings', 'SMTP Settings'),
(109, 'english', 'Protocol', 'Protocol'),
(112, 'english', 'Smtp crypto', 'Smtp crypto'),
(115, 'english', 'Smtp host', 'Smtp host'),
(118, 'english', 'Smtp port', 'Smtp port'),
(121, 'english', 'Smtp username', 'Smtp username'),
(124, 'english', 'Smtp password', 'Smtp password'),
(127, 'english', 'Superadmin', 'Superadmin'),
(130, 'english', 'Verified', 'Verified'),
(133, 'english', 'Email', 'Email'),
(136, 'english', 'Phone Number', 'Phone Number'),
(139, 'english', 'Name', 'Name'),
(142, 'english', 'Birthday', 'Birthday'),
(145, 'english', 'Gender', 'Gender'),
(148, 'english', 'Photo', 'Photo'),
(151, 'english', 'My Account', 'My Account'),
(154, 'english', 'Details info', 'Details info'),
(157, 'english', 'Change Password', 'Change Password'),
(160, 'english', 'Reset Password', 'Reset Password'),
(163, 'english', 'Website Settings', 'Website Settings'),
(166, 'english', 'Contact Email', 'Contact Email'),
(169, 'english', 'Location', 'Location'),
(172, 'english', 'Location URL', 'Location URL'),
(175, 'english', 'Google map URL', 'Google map URL'),
(178, 'english', 'Saturday', 'Saturday'),
(181, 'english', 'Sunday', 'Sunday'),
(184, 'english', 'Monday', 'Monday'),
(187, 'english', 'Tuesday', 'Tuesday'),
(190, 'english', 'Wednesday', 'Wednesday'),
(193, 'english', 'Thursday', 'Thursday'),
(196, 'english', 'Friday', 'Friday'),
(199, 'english', 'Working Start Time', 'Working Start Time'),
(202, 'english', 'Working End Time', 'Working End Time'),
(205, 'english', 'Contact Number', 'Contact Number'),
(208, 'english', 'Contact Us', 'Contact Us'),
(211, 'english', 'Get In Touch', 'Get In Touch'),
(214, 'english', 'Have Any Project on \r\n                        Mind? Work Together', 'Have Any Project on \r\n                        Mind? Work Together'),
(217, 'english', 'Locations', 'Locations'),
(220, 'english', 'Email Address', 'Email Address'),
(223, 'english', 'Working Hours', 'Working Hours'),
(226, 'english', 'Message Us', 'Message Us'),
(229, 'english', 'Get Any Consultations', 'Get Any Consultations'),
(232, 'english', 'Contact With Us', 'Contact With Us'),
(235, 'english', 'Send Us Message', 'Send Us Message'),
(238, 'english', 'All Message', 'All Message'),
(241, 'english', 'Message', 'Message'),
(244, 'english', 'Read & Reply', 'Read & Reply'),
(247, 'english', 'Delete', 'Delete'),
(250, 'english', 'Date', 'Date'),
(253, 'english', 'View & Reply', 'View & Reply'),
(256, 'english', 'Our Service', 'Our Service'),
(259, 'english', 'Contact', 'Contact'),
(262, 'english', 'Services', 'Services'),
(265, 'english', 'What We Do', 'What We Do'),
(268, 'english', 'Popular Solution For\r\n                            Growth Business', 'Popular Solution For\r\n                            Growth Business'),
(271, 'english', 'Professional Design Agency to provide solutions', 'Professional Design Agency to provide solutions'),
(274, 'english', 'Discover More', 'Discover More'),
(277, 'english', 'Service Settings', 'Service Settings'),
(280, 'english', 'What we do Title', 'What we do Title'),
(283, 'english', 'What we do Sub Title', 'What we do Sub Title'),
(286, 'english', 'What We Do Section', 'What We Do Section'),
(289, 'english', 'Title', 'Title'),
(292, 'english', 'Sub Title', 'Sub Title'),
(295, 'english', 'Desciption', 'Desciption'),
(298, 'english', 'Service Section', 'Service Section'),
(301, 'english', 'Skills Section', 'Skills Section'),
(304, 'english', 'Image', 'Image'),
(307, 'english', 'Skill Name', 'Skill Name'),
(310, 'english', 'Skill Percentage', 'Skill Percentage'),
(313, 'english', 'Best Skills', 'Best Skills'),
(316, 'english', 'skill_title', 'skill_title'),
(319, 'english', 'Agency Statistics', 'Agency Statistics'),
(322, 'english', 'Package', 'Package'),
(325, 'english', 'Pricing', 'Pricing'),
(328, 'english', 'Add Package', 'Add Package'),
(331, 'english', 'Package price', 'Package price'),
(334, 'english', 'Status', 'Status'),
(337, 'english', 'Select a status', 'Select a status'),
(340, 'english', 'Active', 'Active'),
(343, 'english', 'Archive', 'Archive'),
(346, 'english', 'Features', 'Features'),
(349, 'english', 'Write Features', 'Write Features'),
(352, 'english', 'Description', 'Description'),
(355, 'english', 'Create package', 'Create package'),
(358, 'english', 'Write service', 'Write service'),
(361, 'english', 'Popular', 'Popular'),
(364, 'english', 'Price', 'Price'),
(367, 'english', 'Global Currency', 'Global Currency'),
(370, 'english', 'Select system currency', 'Select system currency'),
(373, 'english', 'Currency Position', 'Currency Position'),
(376, 'english', 'Left', 'Left'),
(379, 'english', 'Right', 'Right'),
(382, 'english', 'Left with a space', 'Left with a space'),
(385, 'english', 'Right with a space', 'Right with a space'),
(388, 'english', 'Pricing Package', 'Pricing Package'),
(391, 'english', 'Pricing Plan', 'Pricing Plan'),
(394, 'english', 'Latest Work', 'Latest Work'),
(397, 'english', 'Deactive', 'Deactive'),
(400, 'english', 'Actions', 'Actions'),
(403, 'english', 'Edit Package', 'Edit Package'),
(406, 'english', 'Edit', 'Edit'),
(409, 'english', 'Write a new features', 'Write a new features'),
(412, 'english', 'Update package', 'Update package'),
(415, 'english', 'Icon piker', 'Icon piker'),
(418, 'english', 'Service', 'Service'),
(421, 'english', 'Service List', 'Service List'),
(424, 'english', 'Add Service', 'Add Service'),
(427, 'english', 'Services Title', 'Services Title'),
(430, 'english', 'Service Icon', 'Service Icon'),
(433, 'english', 'Write a new service', 'Write a new service'),
(436, 'english', 'Read More', 'Read More'),
(439, 'english', 'Agency Progress', 'Agency Progress'),
(442, 'english', 'Add Progress', 'Add Progress'),
(445, 'english', 'Progress Title', 'Progress Title'),
(448, 'english', 'Total Progress', 'Total Progress'),
(451, 'english', 'Progress Icon', 'Progress Icon'),
(454, 'english', 'Icon', 'Icon'),
(457, 'english', 'Action', 'Action'),
(460, 'english', 'Edit Agency Progress', 'Edit Agency Progress'),
(463, 'english', 'Service Details', 'Service Details'),
(466, 'english', 'Service Detials', 'Service Detials'),
(469, 'english', 'Discription', 'Discription'),
(472, 'english', 'Features List Title', 'Features List Title'),
(475, 'english', 'Features List Subtitle', 'Features List Subtitle'),
(478, 'english', 'Features Title', 'Features Title'),
(481, 'english', 'Features Subtitle', 'Features Subtitle'),
(484, 'english', 'Process', 'Process'),
(487, 'english', 'Process-1 Title', 'Process-1 Title'),
(490, 'english', 'Process-1 Sub Title', 'Process-1 Sub Title'),
(493, 'english', 'Process-2 Title', 'Process-2 Title'),
(496, 'english', 'Process-2 Sub Title', 'Process-2 Sub Title'),
(499, 'english', 'Process-3 Title', 'Process-3 Title'),
(502, 'english', 'Process-3 Sub Title', 'Process-3 Sub Title'),
(505, 'english', 'Working Module', 'Working Module'),
(508, 'english', 'Step-1 Title', 'Step-1 Title'),
(511, 'english', 'Step-1 Subtitle', 'Step-1 Subtitle'),
(514, 'english', 'Step-2 Title', 'Step-2 Title'),
(517, 'english', 'Step-2 Sub Title', 'Step-2 Sub Title'),
(520, 'english', 'Step-3 Title', 'Step-3 Title'),
(523, 'english', 'Step-3 Sub Title', 'Step-3 Sub Title'),
(526, 'english', 'Step-4 Title', 'Step-4 Title'),
(529, 'english', 'Step-4 Sub Title', 'Step-4 Sub Title'),
(532, 'english', 'Step-1 Image', 'Step-1 Image'),
(535, 'english', 'Step-2 Image', 'Step-2 Image'),
(538, 'english', 'Step-3 Image', 'Step-3 Image'),
(541, 'english', 'Step-4 Image', 'Step-4 Image'),
(544, 'english', 'Step 01', 'Step 01'),
(547, 'english', 'Step 02', 'Step 02'),
(550, 'english', 'Step 03', 'Step 03'),
(553, 'english', 'Step 04', 'Step 04'),
(556, 'english', 'Pages', 'Pages'),
(559, 'english', 'About Us', 'About Us'),
(562, 'english', 'About Settings', 'About Settings'),
(565, 'english', 'banner_video_url', 'banner_video_url'),
(568, 'english', 'Banner Video URL', 'Banner Video URL'),
(571, 'english', 'Banner Video Thumbnail', 'Banner Video Thumbnail'),
(574, 'english', 'Short Description', 'Short Description'),
(577, 'english', 'list', 'list'),
(580, 'english', 'About List', 'About List'),
(583, 'english', 'About Us List', 'About Us List'),
(586, 'english', 'About Us Image', 'About Us Image'),
(589, 'english', 'How We Are', 'How We Are'),
(592, 'english', 'Testimonials', 'Testimonials'),
(595, 'english', 'Testimonial', 'Testimonial'),
(598, 'english', 'Add Testimonials', 'Add Testimonials'),
(601, 'english', 'Client Name', 'Client Name'),
(604, 'english', 'Designation', 'Designation'),
(607, 'english', 'Client Image', 'Client Image'),
(610, 'english', 'Create testimonial', 'Create testimonial'),
(613, 'english', 'Partners', 'Partners'),
(616, 'english', 'Partner Logo', 'Partner Logo'),
(619, 'english', ' Logo', ' Logo'),
(622, 'english', 'Upload', 'Upload'),
(625, 'english', 'Delete Logo', 'Delete Logo'),
(628, 'english', 'Expert Team', 'Expert Team'),
(631, 'english', 'Our Team', 'Our Team'),
(634, 'english', 'Meet Our Team', 'Meet Our Team'),
(637, 'english', 'Experience Team Members', 'Experience Team Members'),
(640, 'english', 'View All Member', 'View All Member'),
(643, 'english', 'Team Members', 'Team Members'),
(646, 'english', 'Our Team Members', 'Our Team Members'),
(649, 'english', 'Add Member', 'Add Member'),
(652, 'english', '', ''),
(655, 'english', 'Skill', 'Skill'),
(658, 'english', 'Skill Subtitle', 'Skill Subtitle'),
(661, 'english', 'Senior Member', 'Senior Member'),
(664, 'english', 'Yes/No', 'Yes/No'),
(667, 'english', 'Yes', 'Yes'),
(670, 'english', 'No', 'No'),
(673, 'english', 'Social Media Icon', 'Social Media Icon'),
(676, 'english', 'Social Media Url', 'Social Media Url'),
(679, 'english', 'Skill Level', 'Skill Level'),
(682, 'english', 'Name: ', 'Name: '),
(685, 'english', 'Designation: ', 'Designation: '),
(688, 'english', 'Designation : ', 'Designation : '),
(691, 'english', 'Description: ', 'Description: '),
(694, 'english', 'Skills', 'Skills'),
(697, 'english', 'Senior Team Member', 'Senior Team Member'),
(700, 'english', 'Senior Team Members', 'Senior Team Members'),
(703, 'english', 'Follw Me', 'Follw Me'),
(706, 'english', 'Team Details', 'Team Details'),
(709, 'english', 'Portfolio', 'Portfolio'),
(712, 'english', 'Our Portfolio', 'Our Portfolio'),
(715, 'english', 'Projects', 'Projects'),
(718, 'english', 'Project Category', 'Project Category'),
(721, 'english', 'Project', 'Project'),
(724, 'english', 'Category Title', 'Category Title'),
(727, 'english', 'Category Name', 'Category Name'),
(730, 'english', 'Create', 'Create'),
(733, 'english', 'Delete Category', 'Delete Category'),
(736, 'english', 'Edit Category', 'Edit Category'),
(739, 'english', 'All Project', 'All Project'),
(742, 'english', 'Add Project', 'Add Project'),
(745, 'english', 'Project Title', 'Project Title'),
(748, 'english', 'Project Description', 'Project Description'),
(751, 'english', 'Project Thumbnail', 'Project Thumbnail'),
(754, 'english', 'Client', 'Client'),
(757, 'english', 'Project Date', 'Project Date'),
(760, 'english', 'Back', 'Back'),
(763, 'english', 'Professional Experience', 'Professional Experience'),
(766, 'english', 'Project Details', 'Project Details'),
(769, 'english', 'Category', 'Category'),
(772, 'english', 'Clients', 'Clients'),
(775, 'english', 'Our Blog', 'Our Blog'),
(778, 'english', 'Blog Standard', 'Blog Standard'),
(781, 'english', 'Blogs', 'Blogs'),
(784, 'english', 'Blogs Category', 'Blogs Category'),
(787, 'english', 'All Blogs', 'All Blogs'),
(790, 'english', 'Add Blog', 'Add Blog'),
(793, 'english', 'blog Title', 'blog Title'),
(796, 'english', 'blog Category', 'blog Category'),
(799, 'english', 'blog Description', 'blog Description'),
(802, 'english', 'blog Date', 'blog Date'),
(805, 'english', 'blog Thumbnail', 'blog Thumbnail'),
(808, 'english', 'Blog sfdd Title', 'Blog sfdd Title'),
(811, 'english', ' Blog Title', ' Blog Title'),
(814, 'english', ' Blog Category', ' Blog Category'),
(817, 'english', ' Blog Description', ' Blog Description'),
(820, 'english', ' Blog Thumbnail', ' Blog Thumbnail'),
(823, 'english', ' Blog Date', ' Blog Date'),
(826, 'english', ' Blog Subtitle', ' Blog Subtitle'),
(829, 'english', 'Recent Blogs', 'Recent Blogs'),
(832, 'english', 'Blog Details', 'Blog Details'),
(835, 'english', 'Popular Tags', 'Popular Tags'),
(838, 'english', 'HOME SETTINGS', 'HOME SETTINGS'),
(841, 'english', 'Banner Title', 'Banner Title'),
(844, 'english', 'Banner Image', 'Banner Image'),
(847, 'english', 'Banner Sub Title', 'Banner Sub Title'),
(850, 'english', 'Let’s Talk Us', 'Let’s Talk Us'),
(853, 'english', 'Learn More Us', 'Learn More Us'),
(856, 'english', 'Show All', 'Show All'),
(859, 'english', 'Lets Work Title', 'Lets Work Title'),
(862, 'english', 'Lets Work Image', 'Lets Work Image'),
(865, 'english', 'Lets Work Together', 'Lets Work Together'),
(868, 'english', 'Lets Work', 'Lets Work'),
(871, 'english', 'Testimonaial Image', 'Testimonaial Image'),
(874, 'english', 'Contact Title', 'Contact Title'),
(877, 'english', 'Contact Subtitle', 'Contact Subtitle'),
(880, 'english', 'Email Us', 'Email Us'),
(883, 'english', 'Phone Us', 'Phone Us'),
(886, 'english', 'Articles News', 'Articles News'),
(889, 'english', 'Latest News & Blogs', 'Latest News & Blogs'),
(892, 'english', 'View More Blogs', 'View More Blogs'),
(895, 'english', 'Fotter Logo', 'Fotter Logo'),
(898, 'english', 'Links', 'Links'),
(901, 'english', 'About Agency', 'About Agency'),
(904, 'english', 'Latest News & Blog', 'Latest News & Blog'),
(907, 'english', 'Meet The Team', 'Meet The Team'),
(910, 'english', 'Popular Services', 'Popular Services'),
(913, 'english', 'Social Media Name', 'Social Media Name'),
(916, 'english', 'Work Start Day', 'Work Start Day'),
(919, 'english', 'Work End Day', 'Work End Day'),
(922, 'english', 'Fotter Top Title', 'Fotter Top Title'),
(925, 'english', 'Fotter Title', 'Fotter Title'),
(928, 'english', 'Fotter Sub Title', 'Fotter Sub Title'),
(931, 'english', 'Copyright Text', 'Copyright Text'),
(934, 'english', 'Follow', 'Follow'),
(937, 'english', 'PRODUCT UPDATE', 'PRODUCT UPDATE'),
(940, 'english', 'File', 'File'),
(943, 'english', 'About', 'About'),
(946, 'english', 'About this application', 'About this application'),
(949, 'english', 'Software version', 'Software version'),
(952, 'english', 'PHP version', 'PHP version'),
(955, 'english', 'Curl enable', 'Curl enable'),
(958, 'english', 'Enabled', 'Enabled'),
(961, 'english', 'Get customer support', 'Get customer support'),
(964, 'english', 'Customer support', 'Customer support'),
(967, 'english', 'Total Blogs', 'Total Blogs'),
(970, 'english', 'Total Service', 'Total Service'),
(973, 'english', 'Total Message', 'Total Message'),
(976, 'english', 'Total Project', 'Total Project'),
(979, 'english', 'Total Services', 'Total Services'),
(982, 'english', 'SEO', 'SEO'),
(985, 'english', 'SEO SETTINGS', 'SEO SETTINGS'),
(988, 'english', 'OG', 'OG'),
(991, 'english', 'Page Title', 'Page Title'),
(994, 'english', 'URL', 'URL'),
(997, 'english', 'Meta Description', 'Meta Description'),
(1000, 'english', 'Keywords', 'Keywords'),
(1003, 'english', 'Robots', 'Robots'),
(1006, 'english', 'Canonical', 'Canonical'),
(1009, 'english', 'Twitter', 'Twitter'),
(1012, 'english', 'Card', 'Card'),
(1015, 'english', 'Login', 'Login'),
(1018, 'english', 'Click the button to Login', 'Click the button to Login'),
(1021, 'english', 'Admin', 'Admin'),
(1024, 'english', 'Administration', 'Administration'),
(1027, 'english', 'Manage profile', 'Manage profile'),
(1030, 'english', 'Log out', 'Log out'),
(1033, 'english', 'View All Projects', 'View All Projects'),
(1036, 'english', 'Frontend Page', 'Frontend Page'),
(1039, 'english', 'Team', 'Team'),
(1042, 'english', 'HOME SEO SETTINGS', 'HOME SEO SETTINGS'),
(1045, 'english', 'Author', 'Author'),
(1048, 'english', 'Publisher', 'Publisher'),
(1051, 'english', 'OUR SERVICE SEO SETTINGS', 'OUR SERVICE SEO SETTINGS'),
(1054, 'english', 'SERVICE DETAILS SEO SETTINGS', 'SERVICE DETAILS SEO SETTINGS'),
(1057, 'english', 'PORTFOLIO SEO SETTINGS', 'PORTFOLIO SEO SETTINGS'),
(1060, 'english', 'ABOUT SEO SETTINGS', 'ABOUT SEO SETTINGS'),
(1063, 'english', 'TEAM SEO SETTINGS', 'TEAM SEO SETTINGS'),
(1066, 'english', 'BLOGS SEO SETTINGS', 'BLOGS SEO SETTINGS'),
(1069, 'english', 'CONTACT SEO SETTINGS', 'CONTACT SEO SETTINGS'),
(1072, 'english', 'Testimonial Image', 'Testimonial Image');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `reply` text DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `sent_date` varchar(255) DEFAULT NULL,
  `reply_date` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_04_30_103449_language', 2),
(5, '2024_05_01_095024_global_settings', 3),
(6, '2024_05_08_080002_service_settings', 4),
(7, '2024_05_09_062131_packages', 5),
(8, '2024_05_12_045103_services', 6),
(9, '2024_05_12_072902_agency_progress', 7),
(10, '2024_05_13_064027_about_settings', 8),
(11, '2024_05_13_095940_testimonials', 9),
(12, '2024_05_13_112241_partner_logos', 10),
(13, '2024_05_14_052402_team_members', 11),
(14, '2024_05_26_070637_project_category', 12),
(15, '2024_05_26_101102_all_projects', 13),
(16, '2024_05_27_073544_blog_categories', 14),
(17, '2024_05_27_081519_all_blogs', 15);

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

DROP TABLE IF EXISTS `packages`;
CREATE TABLE `packages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `price` int(50) DEFAULT NULL,
  `status` int(10) DEFAULT NULL,
  `features` varchar(250) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `type` varchar(250) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `partner_logos`
--

DROP TABLE IF EXISTS `partner_logos`;
CREATE TABLE `partner_logos` (
  `id` int(11) NOT NULL,
  `image` varchar(250) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `project_categories`
--

DROP TABLE IF EXISTS `project_categories`;
CREATE TABLE `project_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(250) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
CREATE TABLE `services` (
  `id` int(10) UNSIGNED NOT NULL,
  `service_title` varchar(250) DEFAULT NULL,
  `service_list` text DEFAULT NULL,
  `service_icon` varchar(250) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `service_settings`
--

DROP TABLE IF EXISTS `service_settings`;
CREATE TABLE `service_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(250) DEFAULT NULL,
  `value` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_settings`
--

INSERT INTO `service_settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(5, 'what_wd_title', 'Popular Solution For Growth Business', '2024-05-08 02:17:59', '2024-06-09 22:57:25'),
(6, 'what_wd_subtitle', 'Professional Design Agency to provide solutions', '2024-05-08 02:20:43', '2024-06-09 22:57:25'),
(7, 'what_wd_desc', 'NexaFlux is a premier Brand, Design & Development Agency. We specialize in innovative brand identities, cutting-edge digital designs, and robust development solutions. Our expert team blends creativity and technical excellence to bring your vision to life. Drive your business forward with NexaFlux\'s tailored strategies and exceptional execution.', '2024-05-08 02:20:44', '2024-06-09 22:57:25'),
(8, 'service_title', 'Creative Design Solutions', '2024-05-08 03:22:14', '2024-06-09 22:57:25'),
(9, 'service_subtitle', 'Professional Design Agency to provide solutions', '2024-05-08 03:22:14', '2024-06-09 22:57:25'),
(10, 'skill_title', 'Experience Team to Provide Ideas', '2024-05-08 03:24:07', '2024-06-09 22:57:25'),
(11, 'skill_subtitle', 'Professional Design Agency to provide solutions', '2024-05-08 03:24:07', '2024-06-09 22:57:25'),
(12, 'what_wd_img', '17155769811.png', '2024-05-08 03:38:11', '2024-05-12 23:09:41'),
(13, 'skill_img', '1715161369skill.png', '2024-05-08 03:42:49', '2024-05-08 03:42:49'),
(14, 'skill_name', '[\"Product Design:90\",\"Web Development:80\",\"UX\\/UI Strategy:20\"]', '2024-05-08 05:17:36', '2024-06-09 22:57:25'),
(16, 'agency_statistics_title', 'Why People’s Like Us', '2024-05-09 04:09:56', '2024-06-09 22:57:25'),
(17, 'agency_statistics_subtitle', 'Professional Design Agency to provide solutions', '2024-05-09 04:09:56', '2024-06-09 22:57:25'),
(18, 'pricing_pcg_title', 'Pricing Package', '2024-05-09 04:09:56', '2024-06-09 22:57:25'),
(19, 'pricing_pcg_subtitle', 'Professional Design Agency to provide solutions', '2024-05-09 04:09:56', '2024-06-09 22:57:25'),
(20, 'latest_work_title', 'Professional Experience', '2024-05-09 04:16:23', '2024-06-09 22:57:25'),
(21, 'latest_work_subtitle', 'Professional Design Agency to provide solutions', '2024-05-09 04:16:23', '2024-06-09 22:57:25'),
(22, 'features_title', 'Build Your Business Workflow Faster', '2024-05-12 05:46:52', '2024-06-09 22:59:48'),
(23, 'features_discription', 'At NexaFlux, our Custom Application Development service is dedicated to creating bespoke software solutions that cater to the specific needs of your business. We understand that every organization has unique challenges and requirements, which is why we focus on developing applications that are tailored to your exact specifications. Our experienced team of developers works closely with you to understand your goals, processes, and pain points, ensuring that the final product aligns perfectly with your business objectives.', '2024-05-12 06:12:06', '2024-06-09 22:59:48'),
(24, 'features_list_title', '[\"UX Design:At NexaFlux, our UX Design service is dedicated to crafting user experiences that are not only intuitive but also engaging. We understand the importance of user satisfaction in driving business success.\",\"Brand Strategy:NexaFlux\'s Brand Strategy service is focused on creating strong and cohesive brand identities that resonate with your target audience.\",\"Web Development:Our Web Development service at NexaFlux focuses on creating robust and scalable websites that perform seamlessly across all devices.\"]', '2024-05-12 06:12:06', '2024-06-09 22:59:48'),
(25, 'process_title', 'How Does We Works', '2024-05-12 06:50:38', '2024-06-09 22:59:48'),
(26, 'process_subtitle', 'Professional Design Agency to provide solutions', '2024-05-12 06:50:38', '2024-06-09 22:59:48'),
(27, 'process1_title', 'Project Layouts', '2024-05-12 06:50:38', '2024-06-09 22:59:48'),
(28, 'process1_subtitle', 'During this phase, we create detailed project plans, wireframes, and prototypes that outline the application\'s architecture and user interface.', '2024-05-12 06:50:38', '2024-06-09 22:59:48'),
(29, 'process2_title', 'Project Analysis', '2024-05-12 06:50:38', '2024-06-09 22:59:48'),
(30, 'process2_subtitle', 'Sed ut pericias unde omnis natus error sit voluptate ccusan tium dolore mque laudan', '2024-05-12 06:50:38', '2024-06-09 22:59:48'),
(31, 'process3_title', 'Final Results', '2024-05-12 06:50:38', '2024-06-09 22:59:48'),
(32, 'process3_subtitle', 'In the Project Analysis phase, we dive deep into understanding your business needs, user requirements, and the technical landscape.', '2024-05-12 06:50:38', '2024-06-09 22:59:48'),
(33, 'features_subtitle', 'Tailored Solutions for Unique Business Needs.', '2024-05-12 22:37:14', '2024-06-09 22:59:48'),
(34, 'working_module_title', 'Creative Web Design Process', '2024-05-12 23:14:06', '2024-06-09 22:59:48'),
(35, 'working_module_subtitle', 'Professional Design Agency to provide solutions', '2024-05-12 23:14:06', '2024-06-09 22:59:48'),
(36, 'step1_title', 'Make Smart Plan', '2024-05-12 23:14:06', '2024-06-09 22:59:48'),
(37, 'step1_subtitle', 'The first step in any successful application development project is creating a smart plan.', '2024-05-12 23:14:06', '2024-06-09 22:59:48'),
(38, 'step2_title', 'Prototype', '2024-05-12 23:14:06', '2024-06-09 22:59:48'),
(39, 'step2_subtitle', 'The prototyping phase transforms ideas into tangible visual representations.', '2024-05-12 23:14:06', '2024-06-09 22:59:48'),
(40, 'step3_title', 'Development', '2024-05-12 23:14:06', '2024-06-09 22:59:48'),
(41, 'step3_subtitle', 'During the development phase, our team of skilled developers brings the prototype to life.', '2024-05-12 23:14:06', '2024-06-09 22:59:48'),
(42, 'step4_title', 'Get Results', '2024-05-12 23:14:06', '2024-06-09 22:59:48'),
(43, 'step4_subtitle', 'The final phase is all about delivering results that matter. After rigorous testing and quality assurance.', '2024-05-12 23:14:06', '2024-06-09 22:59:48'),
(44, 'step1_image', '1715577573step_1.png', '2024-05-12 23:14:06', '2024-05-12 23:19:33'),
(45, 'step2_image', '1715577821step_2.png', '2024-05-12 23:23:41', '2024-05-12 23:23:41'),
(46, 'step3_image', '1715577885step_3.png', '2024-05-12 23:24:45', '2024-05-12 23:24:45'),
(47, 'step4_image', '1715577885step_4.png', '2024-05-12 23:24:45', '2024-05-12 23:24:45');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `team_members`
--

DROP TABLE IF EXISTS `team_members`;
CREATE TABLE `team_members` (
  `id` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `designation` varchar(250) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `social_icon_url` text DEFAULT NULL,
  `skill_title` varchar(250) DEFAULT NULL,
  `skill_subtitle` varchar(250) DEFAULT NULL,
  `skill_name_level` varchar(250) DEFAULT NULL,
  `image` varchar(250) DEFAULT NULL,
  `senior_team_member` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

DROP TABLE IF EXISTS `testimonials`;
CREATE TABLE `testimonials` (
  `id` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `designation` varchar(250) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(250) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `birthday` varchar(255) DEFAULT NULL,
  `language` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_settings`
--
ALTER TABLE `about_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `agency_progresses`
--
ALTER TABLE `agency_progresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `all_blogs`
--
ALTER TABLE `all_blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `all_projects`
--
ALTER TABLE `all_projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_categories`
--
ALTER TABLE `blog_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `currency`
--
ALTER TABLE `currency`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `global_settings`
--
ALTER TABLE `global_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `partner_logos`
--
ALTER TABLE `partner_logos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `project_categories`
--
ALTER TABLE `project_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_settings`
--
ALTER TABLE `service_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `team_members`
--
ALTER TABLE `team_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_settings`
--
ALTER TABLE `about_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `agency_progresses`
--
ALTER TABLE `agency_progresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `all_blogs`
--
ALTER TABLE `all_blogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `all_projects`
--
ALTER TABLE `all_projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_categories`
--
ALTER TABLE `blog_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `currency`
--
ALTER TABLE `currency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=170;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `global_settings`
--
ALTER TABLE `global_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=155;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `language`
--
ALTER TABLE `language`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1075;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `partner_logos`
--
ALTER TABLE `partner_logos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `project_categories`
--
ALTER TABLE `project_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service_settings`
--
ALTER TABLE `service_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `team_members`
--
ALTER TABLE `team_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
