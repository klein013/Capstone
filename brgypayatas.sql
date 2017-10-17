
-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 29, 2017 at 08:19 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `brgypayatas`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` int(10) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(5, 'default', '{\"displayName\":\"App\\\\Jobs\\\\SendMessages\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"timeout\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendMessages\",\"command\":\"O:21:\\\"App\\\\Jobs\\\\SendMessages\\\":5:{s:21:\\\"\\u0000*\\u0000incidentcontroller\\\";a:2:{s:7:\\\"numbers\\\";a:2:{i:0;O:8:\\\"stdClass\\\":1:{s:16:\\\"resident_contact\\\";s:13:\\\"+639997078154\\\";}i:1;O:8:\\\"stdClass\\\":1:{s:16:\\\"resident_contact\\\";s:13:\\\"+639292003741\\\";}}s:8:\\\"incident\\\";s:8:\\\"Stealing\\\";}s:6:\\\"\\u0000*\\u0000job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";O:13:\\\"Carbon\\\\Carbon\\\":3:{s:4:\\\"date\\\";s:26:\\\"2017-08-19 12:37:20.000000\\\";s:13:\\\"timezone_type\\\";i:3;s:8:\\\"timezone\\\";s:3:\\\"UTC\\\";}}\"}}', 0, NULL, 1503146240, 1503146180),
(6, 'default', '{\"displayName\":\"App\\\\Jobs\\\\SendMessages\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"timeout\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendMessages\",\"command\":\"O:21:\\\"App\\\\Jobs\\\\SendMessages\\\":5:{s:21:\\\"\\u0000*\\u0000incidentcontroller\\\";a:2:{s:7:\\\"numbers\\\";a:2:{i:0;O:8:\\\"stdClass\\\":1:{s:16:\\\"resident_contact\\\";s:13:\\\"+639997078154\\\";}i:1;O:8:\\\"stdClass\\\":1:{s:16:\\\"resident_contact\\\";s:13:\\\"+639292003741\\\";}}s:8:\\\"incident\\\";s:4:\\\"Fire\\\";}s:6:\\\"\\u0000*\\u0000job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";O:13:\\\"Carbon\\\\Carbon\\\":3:{s:4:\\\"date\\\";s:26:\\\"2017-08-22 07:32:00.000000\\\";s:13:\\\"timezone_type\\\";i:3;s:8:\\\"timezone\\\";s:3:\\\"UTC\\\";}}\"}}', 0, NULL, 1503387120, 1503387060),
(7, 'default', '{\"displayName\":\"App\\\\Jobs\\\\SendMessages\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"timeout\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendMessages\",\"command\":\"O:21:\\\"App\\\\Jobs\\\\SendMessages\\\":5:{s:21:\\\"\\u0000*\\u0000incidentcontroller\\\";a:2:{s:7:\\\"numbers\\\";a:4:{i:0;O:8:\\\"stdClass\\\":1:{s:16:\\\"resident_contact\\\";s:13:\\\"+639997078154\\\";}i:1;O:8:\\\"stdClass\\\":1:{s:16:\\\"resident_contact\\\";s:13:\\\"+639292003741\\\";}i:2;O:8:\\\"stdClass\\\":1:{s:16:\\\"resident_contact\\\";s:13:\\\"+639101010101\\\";}i:3;O:8:\\\"stdClass\\\":1:{s:16:\\\"resident_contact\\\";s:13:\\\"+639909090909\\\";}}s:8:\\\"incident\\\";s:10:\\\"Carnapping\\\";}s:6:\\\"\\u0000*\\u0000job\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";O:13:\\\"Carbon\\\\Carbon\\\":3:{s:4:\\\"date\\\";s:26:\\\"2017-08-29 15:46:21.000000\\\";s:13:\\\"timezone_type\\\";i:3;s:8:\\\"timezone\\\";s:3:\\\"UTC\\\";}}\"}}', 0, NULL, 1504021581, 1504021521);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2017_08_16_072716_create_jobs_table', 1),
(2, '2017_08_16_072755_create_failed_jobs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_area`
--

CREATE TABLE `tbl_area` (
  `area_id` int(11) NOT NULL,
  `area_name` text NOT NULL,
  `area_exists` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_area`
--

INSERT INTO `tbl_area` (`area_id`, `area_name`, `area_exists`) VALUES
(1, 'Area A', 1),
(2, 'Area B', 1),
(3, 'Area C', 1),
(4, 'Area D', 1),
(5, 'sadaddd', 0),
(6, 'Area E', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_brgyinfo`
--

CREATE TABLE `tbl_brgyinfo` (
  `brgyinfo_name` varchar(100) NOT NULL,
  `brgyinfo_city` varchar(50) DEFAULT NULL,
  `brgyinfo_region` varchar(50) DEFAULT NULL,
  `brgyinfo_website` varchar(100) NOT NULL,
  `brgyinfo_email` varchar(100) NOT NULL,
  `brgyinfo_fb` varchar(100) NOT NULL,
  `brgyinfo_logo` text NOT NULL,
  `brgyinfo_citylogo` text,
  `brgyinfo_case` varchar(10) NOT NULL,
  `brgyinfo_opening` time NOT NULL,
  `brgyinfo_closing` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_brgyinfo`
--

INSERT INTO `tbl_brgyinfo` (`brgyinfo_name`, `brgyinfo_city`, `brgyinfo_region`, `brgyinfo_website`, `brgyinfo_email`, `brgyinfo_fb`, `brgyinfo_logo`, `brgyinfo_citylogo`, `brgyinfo_case`, `brgyinfo_opening`, `brgyinfo_closing`) VALUES
('Barangay Payatas', 'Quezon City', 'Metro Manila', 'brgypayatas.com', 'brgypayatas@gmail.com', 'facebook.com/brgypayatas', 'images/payatas.png', 'images/qc.png', 'Lupon', '07:30:00', '18:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_case`
--

CREATE TABLE `tbl_case` (
  `case_id` int(11) NOT NULL,
  `case_filed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `case_caseskp` int(11) NOT NULL,
  `case_statement` text NOT NULL,
  `case_status` varchar(50) NOT NULL,
  `case_exists` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_case`
--

INSERT INTO `tbl_case` (`case_id`, `case_filed`, `case_caseskp`, `case_statement`, `case_status`, `case_exists`) VALUES
(1, '2017-08-29 16:48:43', 15, 'sadasdjaskljk', 'Mediation', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_caseallocation`
--

CREATE TABLE `tbl_caseallocation` (
  `caseallocation_case` int(11) NOT NULL,
  `caseallocation_official` int(11) DEFAULT NULL,
  `caseallocation_pangkat` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_caseallocation`
--

INSERT INTO `tbl_caseallocation` (`caseallocation_case`, `caseallocation_official`, `caseallocation_pangkat`) VALUES
(1, 8, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_caseskp`
--

CREATE TABLE `tbl_caseskp` (
  `caseskp_id` int(11) NOT NULL,
  `caseskp_name` varchar(100) NOT NULL,
  `caseskp_desc` text,
  `caseskp_exists` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_caseskp`
--

INSERT INTO `tbl_caseskp` (`caseskp_id`, `caseskp_name`, `caseskp_desc`, `caseskp_exists`) VALUES
(1, 'Unlawful use of means of publication and unlawful utterances', NULL, 1),
(2, 'Alarms and scandals', NULL, 1),
(3, 'Using false certificates', NULL, 1),
(4, 'Using fictitious names and concealing true names', NULL, 1),
(5, 'Illegal use of uniforms and insignias', NULL, 1),
(6, 'Physical injuries inflicted in a tumultuous affray', NULL, 1),
(7, 'Giving assistance to consummated suicide', NULL, 1),
(8, 'Responsibility of participants in a duel if only physical injuries are inflicted or no physical inju', NULL, 1),
(9, 'Less serious physical injuries', NULL, 1),
(10, 'Slight physical injuries and maltreatment', NULL, 1),
(11, 'Unlawful arrest', NULL, 1),
(12, 'Inducing a minor to abandon his/her home', NULL, 1),
(13, 'Abandonment of a person in danger and abandonment of one’s own victim', NULL, 1),
(14, 'Abandoning a minor (a child under seven [7] years old)', NULL, 1),
(15, 'Abandonment of a minor by perons entrusted with his/her custody indifference of parents', NULL, 1),
(16, 'Qualified tresspass to dwelling (without the use of violence and intimidation)', NULL, 1),
(17, 'Other forms of tresspass', NULL, 1),
(18, 'Light threats', NULL, 1),
(19, 'Other Light threats', NULL, 1),
(20, 'Grave coercion', NULL, 1),
(21, 'Light coercion', NULL, 1),
(22, 'Other similar coercions (compulsory purchase of merchandise and payment of wages by means of tokens)', NULL, 1),
(23, 'Formation, maintenance and prohibition of combination of capital or labor through violence or threat', NULL, 1),
(24, 'Discovering secrets through seizure and correspondence', NULL, 1),
(25, 'Revealing secrets with abuse of authority', NULL, 1),
(26, 'Theft (if the value of the property stolen does not exceed P50.00)', NULL, 1),
(27, 'Qualified theft (if the amount does not exceed P500)', NULL, 1),
(28, 'Occupation of real property or usurpation of real', NULL, 1),
(29, 'Rights in property', NULL, 1),
(30, 'Altering boundaries or landmarks', NULL, 1),
(31, 'Swindling or estafa (if the amount does not exceed P200.00)', NULL, 1),
(32, 'Other forms of swindling', NULL, 1),
(33, 'Swindling a minor', NULL, 1),
(34, 'Other deceits', NULL, 1),
(35, 'Removal, sale or pledge of mortgaged property', NULL, 1),
(36, 'Special cases of malicious mischief (if the value of the damaged property does not exceed P1,000.00)', NULL, 1),
(37, 'Other mischiefs (if the value of the damaged property does not exceed P1,000.00)', NULL, 1),
(38, 'Simple seduction', NULL, 1),
(39, 'Acts of lasciviousness with the consent of the offended party', NULL, 1),
(40, 'Threatening to publish and offer to prevent such publication for compensation', NULL, 1),
(41, 'Prohibiting publication of acts referred to in the course of official proceedings', NULL, 1),
(42, 'Incriminating innocent persons', NULL, 1),
(43, 'Intriguing against honor', NULL, 1),
(44, 'Issuing checks without sufficient funds', NULL, 1),
(45, 'Fencing of stolen properties if the property involved is not more than P50.00', NULL, 1),
(46, 'dagdag', NULL, 1),
(47, 'Extra Judicial Killings', 'pmataya', 0),
(48, 'Briefcase', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_casestage`
--

CREATE TABLE `tbl_casestage` (
  `casestage_id` int(11) NOT NULL,
  `casestage_name` varchar(30) NOT NULL,
  `casestage_no` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_casestage`
--

INSERT INTO `tbl_casestage` (`casestage_id`, `casestage_name`, `casestage_no`) VALUES
(1, 'Mediation', 1),
(2, 'Mediation', 2),
(3, 'Mediation', 3),
(4, 'Concillation', 1),
(5, 'Concillation', 2),
(6, 'Concillation', 3),
(7, 'Arbitration', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_clearance`
--

CREATE TABLE `tbl_clearance` (
  `clearance_id` int(11) NOT NULL,
  `clearance_type` varchar(100) NOT NULL,
  `clearance_desc` text,
  `clearance_content` text NOT NULL,
  `clearance_price` int(11) NOT NULL,
  `clearance_exists` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_clearance`
--

INSERT INTO `tbl_clearance` (`clearance_id`, `clearance_type`, `clearance_desc`, `clearance_content`, `clearance_price`, `clearance_exists`) VALUES
(1, 'Barangay Clearance A', NULL, '<p>TO WHOM IT MAY CONCERN:</p>\n<p style=\"padding-left: 30px;\">THIS IS TO CERTIFY THAT @name of legal age, filipino is a bonafide resident of @address since 2011 up to present</p>\n<p style=\"padding-left: 30px;\">THIS FURTHER CERTIFIES that upon verification of records filed in this office, the subject inidividual was a person of good standing in the community with good moral character and found to have</p>\n<p style=\"padding-left: 120px;\">NO DEROGATORY RECORD ON FILE</p>\n<p style=\"padding-left: 30px;\">THIS CERTIFICATION is being issued upon the request for securing clearance of RESIDENCY for @purpose .</p>\n<p style=\"padding-left: 30px;\">ISSUED this @date at @brgyaddress.</p>', 7, 1),
(2, 'Barangay Clearance B', NULL, '<p>TO WHOM IT MAY CONCERN:</p>\r\n<p style=\"padding-left: 30px;\">THIS IS TO CERTIFY THAT @name of legal age, filipino is a bonafide resident of @address since 2011 up to present</p>\r\n<p style=\"padding-left: 30px;\">THIS FURTHER CERTIFIES that upon verification of records filed in this office, the subject inidividual was a person of good standing in the community with good moral character and found to have</p>\r\n<p style=\"padding-left: 120px;\">NO DEROGATORY RECORD ON FILE</p>\r\n<p style=\"padding-left: 30px;\">THIS CERTIFICATION is being issued upon the request for securing clearance of RESIDENCY for @purpose .</p>\r\n<p style=\"padding-left: 30px;\">ISSUED this @date at @brgyaddress.</p>', 4, 1),
(3, 'Barangay Clearance C', NULL, '<p>TO WHOM IT MAY CONCERN:</p>\r\n<p style=\"padding-left: 30px;\">THIS IS TO CERTIFY THAT @name of legal age, filipino is a bonafide resident of @address since 2011 up to present</p>\r\n<p style=\"padding-left: 30px;\">THIS FURTHER CERTIFIES that upon verification of records filed in this office, the subject inidividual was a person of good standing in the community with good moral character and found to have</p>\r\n<p style=\"padding-left: 120px;\">NO DEROGATORY RECORD ON FILE</p>\r\n<p style=\"padding-left: 30px;\">THIS CERTIFICATION is being issued upon the request for securing clearance of RESIDENCY for @purpose .</p>\r\n<p style=\"padding-left: 30px;\">ISSUED this @date at @brgyaddress.</p>', 2, 1),
(4, 'Business Clearance A', NULL, '<p>da</p>', 9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_clearancerequirement`
--

CREATE TABLE `tbl_clearancerequirement` (
  `cr_requirement` int(11) NOT NULL,
  `cr_clearance` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_clearancerequirement`
--

INSERT INTO `tbl_clearancerequirement` (`cr_requirement`, `cr_clearance`) VALUES
(1, 1),
(5, 1),
(1, 4),
(3, 4);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_hearing`
--

CREATE TABLE `tbl_hearing` (
  `hearing_id` int(11) NOT NULL,
  `hearing_case` int(11) NOT NULL,
  `hearing_sched` datetime NOT NULL,
  `hearing_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_hearing`
--

INSERT INTO `tbl_hearing` (`hearing_id`, `hearing_case`, `hearing_sched`, `hearing_type`) VALUES
(1, 1, '2017-09-01 08:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_hearingattendance`
--

CREATE TABLE `tbl_hearingattendance` (
  `ha_hearing` int(11) NOT NULL,
  `ha_personinvolve` char(11) NOT NULL,
  `ha_attented` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_hearingletter`
--

CREATE TABLE `tbl_hearingletter` (
  `hl_hearing` int(11) NOT NULL,
  `hl_personinvolve` char(11) NOT NULL,
  `hl_lettertype` varchar(50) NOT NULL,
  `hl_datereceive` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_hs`
--

CREATE TABLE `tbl_hs` (
  `hs_id` int(11) NOT NULL,
  `hs_name` varchar(150) NOT NULL,
  `hs_desc` text NOT NULL,
  `hs_fromdate` time NOT NULL,
  `hs_todate` time NOT NULL,
  `hs_suspendedwork` varchar(50) NOT NULL,
  `hs_office` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_incident`
--

CREATE TABLE `tbl_incident` (
  `incident_id` int(11) NOT NULL,
  `incident_datetime` datetime NOT NULL,
  `incident_statement` text NOT NULL,
  `incident_street` int(11) NOT NULL,
  `incident_long` double DEFAULT NULL,
  `incident_lat` double DEFAULT NULL,
  `incident_cat` int(11) NOT NULL,
  `incident_status` varchar(30) DEFAULT NULL,
  `incident_notes` text,
  `incident_filed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `incident_exists` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_incident`
--

INSERT INTO `tbl_incident` (`incident_id`, `incident_datetime`, `incident_statement`, `incident_street`, `incident_long`, `incident_lat`, `incident_cat`, `incident_status`, `incident_notes`, `incident_filed`, `incident_exists`) VALUES
(1, '2017-08-09 08:08:00', 'Nakuha ang toyota vios ng dalawang lalaki', 1, 121.1000973, 14.70639, 3, 'Action Done', NULL, '2017-08-29 15:45:57', 1),
(12, '2017-08-19 08:05:00', 'Stealing', 67, 121.0907627, 14.7091863, 5, 'On-going', NULL, '2017-08-19 12:36:18', 1),
(34, '2017-08-22 12:00:00', 'sasasasasasasa', 25, 121.1029772, 14.7205701, 3, 'Action Done', 'The Incident is resolved last wednesday', '2017-08-29 15:38:58', 1),
(35, '2017-08-29 05:00:00', 'this is a description', 10, 121.1003649, 14.7087595, 3, 'Action Done', NULL, '2017-08-29 15:47:48', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_incidentcat`
--

CREATE TABLE `tbl_incidentcat` (
  `incidentcat_id` int(11) NOT NULL,
  `incidentcat_name` varchar(100) NOT NULL,
  `incidentcat_desc` text,
  `incidentcat_exists` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_incidentcat`
--

INSERT INTO `tbl_incidentcat` (`incidentcat_id`, `incidentcat_name`, `incidentcat_desc`, `incidentcat_exists`) VALUES
(1, 'Snatching', 'Stealing fastly', 1),
(2, 'Fire', 'Natural Phenomenon', 1),
(3, 'Carnapping', NULL, 1),
(5, 'Stealing', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_minutes`
--

CREATE TABLE `tbl_minutes` (
  `minutes_id` int(11) NOT NULL,
  `minutes_hearing` int(11) NOT NULL,
  `minutes_details` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_office`
--

CREATE TABLE `tbl_office` (
  `office_id` int(11) NOT NULL,
  `office_name` int(11) NOT NULL,
  `office_hno` int(11) NOT NULL,
  `office_street` int(11) NOT NULL,
  `office_brgy` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_official`
--

CREATE TABLE `tbl_official` (
  `official_id` int(11) NOT NULL,
  `resident_id` char(11) DEFAULT NULL,
  `position_id` int(11) DEFAULT NULL,
  `official_exists` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_official`
--

INSERT INTO `tbl_official` (`official_id`, `resident_id`, `position_id`, `official_exists`) VALUES
(0, '0', 0, 1),
(1, 'RES00000001', 1, 1),
(2, 'RES00000002', 2, 1),
(3, 'RES00000003', 2, 1),
(4, 'RES00000004', 2, 1),
(5, 'RES00000005', 6, 1),
(6, 'RES00000009', 2, 1),
(7, 'RES00000018', 5, 1),
(8, 'RES00000016', 2, 1),
(9, 'RES00000033', 2, 0),
(10, 'RES00000034', 7, 1),
(11, 'RES00000035', 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_officialuser`
--

CREATE TABLE `tbl_officialuser` (
  `official_id` int(11) NOT NULL,
  `official_username` varchar(30) NOT NULL,
  `official_password` char(40) NOT NULL,
  `last_log` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_officialuser`
--

INSERT INTO `tbl_officialuser` (`official_id`, `official_username`, `official_password`, `last_log`) VALUES
(0, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', NULL),
(8, 'defense', '7df726a5c25b0699480f155e332f22c82876438c', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pangkat`
--

CREATE TABLE `tbl_pangkat` (
  `pangkat_id` int(11) NOT NULL,
  `pangkat_president` int(11) NOT NULL,
  `pangkat_secretary` int(11) NOT NULL,
  `pangkat_member` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_personinvolve`
--

CREATE TABLE `tbl_personinvolve` (
  `personinvolve_resident` char(11) NOT NULL,
  `personinvolve_case` int(11) NOT NULL,
  `personinvolve_type` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_personinvolve`
--

INSERT INTO `tbl_personinvolve` (`personinvolve_resident`, `personinvolve_case`, `personinvolve_type`) VALUES
('RES00000005', 1, 'R'),
('RES00000009', 1, 'R'),
('RES00000002', 1, 'C'),
('RES00000003', 1, 'C'),
('RES00000034', 1, 'W'),
('RES00000014', 1, 'W');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_position`
--

CREATE TABLE `tbl_position` (
  `position_id` int(11) NOT NULL,
  `position_name` varchar(100) NOT NULL,
  `position_desc` text NOT NULL,
  `position_count` int(11) NOT NULL,
  `position_manage` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_position`
--

INSERT INTO `tbl_position` (`position_id`, `position_name`, `position_desc`, `position_count`, `position_manage`) VALUES
(0, 'Admin', '', 1, ''),
(1, 'Barangay Captain', '', 1, 'Blotter'),
(2, 'Lupon', '', 20, 'Blotter'),
(3, 'IT Admin', '', 0, 'Admin'),
(4, 'Secretary', '', 1, 'Clearance'),
(5, 'Desk Assistant', '', 0, 'Clearance'),
(6, 'BPSO', '', 0, 'Blotter'),
(7, 'Cashier', '', 0, 'Money');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_price`
--

CREATE TABLE `tbl_price` (
  `price_id` int(11) NOT NULL,
  `price_date` datetime NOT NULL,
  `price_amt` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_price`
--

INSERT INTO `tbl_price` (`price_id`, `price_date`, `price_amt`) VALUES
(1, '2017-07-29 00:00:00', 100),
(2, '2017-08-11 00:00:00', 10),
(3, '2017-08-11 00:00:00', 90),
(4, '2017-08-18 00:00:00', 122),
(5, '2017-08-18 00:00:00', 0),
(6, '2017-08-19 00:00:00', 65),
(7, '2017-08-20 00:00:00', 35),
(8, '2017-08-28 00:00:00', 121.1),
(9, '2017-08-28 00:00:00', 121.17);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_request`
--

CREATE TABLE `tbl_request` (
  `request_id` int(11) NOT NULL,
  `request_resident` char(11) NOT NULL,
  `request_clearance` int(11) NOT NULL,
  `request_purpose` text NOT NULL,
  `request_expiry` date NOT NULL,
  `request_status` varchar(50) DEFAULT NULL,
  `request_paymentdate` date DEFAULT NULL,
  `request_transaction` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_request`
--

INSERT INTO `tbl_request` (`request_id`, `request_resident`, `request_clearance`, `request_purpose`, `request_expiry`, `request_status`, `request_paymentdate`, `request_transaction`) VALUES
(1, 'RES00000002', 1, 'to live alone', '2018-08-23', 'For Release', '2017-08-28', 1),
(3, 'RES00000031', 2, 'all purpose', '2018-08-23', 'Unpaid', NULL, 3),
(4, 'RES00000026', 1, 'two less lonely people', '2018-08-24', 'For Release', '2017-08-28', 4),
(5, 'RES00000026', 2, 'two less lonely people 1', '2018-08-24', 'For Release', '2017-08-28', 4),
(6, 'RES00000026', 3, 'two less lonely people 3', '2018-08-24', 'For Release', '2017-08-28', 4),
(7, 'RES00000015', 2, 'all', '2018-08-28', 'For Release', '2017-08-28', 5),
(8, 'RES00000025', 1, 'this is a purpose', '2018-08-28', 'For Release', '2017-08-28', 6),
(9, 'RES00000007', 1, 'sometimes', '2018-08-28', 'For Release', '2017-08-28', 7),
(10, 'RES00000002', 1, 'asa', '2018-08-28', 'For Release', '2017-08-28', 8),
(11, 'RES00000002', 2, 'czx', '2018-08-28', 'For Release', '2017-08-28', 8);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_requirement`
--

CREATE TABLE `tbl_requirement` (
  `requirement_id` int(11) NOT NULL,
  `requirement_name` varchar(100) NOT NULL,
  `requirement_desc` text NOT NULL,
  `requirement_exists` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_requirement`
--

INSERT INTO `tbl_requirement` (`requirement_id`, `requirement_name`, `requirement_desc`, `requirement_exists`) VALUES
(1, 'Picture', 'A 1x1 picture', 1),
(2, 'House Blueprint', 'Original or Photocopy of the house blueprint', 0),
(3, 'Business Permit', 'Business Permit from City', 1),
(4, 'lalala', 'laalalal', 0),
(5, 'Voters ID', 'ds', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_resident`
--

CREATE TABLE `tbl_resident` (
  `resident_id` char(11) NOT NULL,
  `resident_fname` varchar(50) DEFAULT NULL,
  `resident_mname` varchar(50) DEFAULT NULL,
  `resident_lname` varchar(50) DEFAULT NULL,
  `resident_bdate` date DEFAULT NULL,
  `resident_gender` varchar(1) DEFAULT NULL,
  `resident_contact` varchar(15) DEFAULT NULL,
  `resident_hno` varchar(50) DEFAULT NULL,
  `resident_street` int(11) DEFAULT NULL,
  `resident_yearstayed` int(4) DEFAULT NULL,
  `resident_image` text,
  `resident_allowmessage` tinyint(1) DEFAULT NULL,
  `resident_exists` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_resident`
--

INSERT INTO `tbl_resident` (`resident_id`, `resident_fname`, `resident_mname`, `resident_lname`, `resident_bdate`, `resident_gender`, `resident_contact`, `resident_hno`, `resident_street`, `resident_yearstayed`, `resident_image`, `resident_allowmessage`, `resident_exists`) VALUES
('0', 'admin', 'admin', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, 'uploads/payatas.png', NULL, 1),
('RES00000001', 'KZ', NULL, 'Tandingan', '1986-06-01', 'F', '+639988693566', 'Blk. 23 Lot 5 Phase 3', 1, 1990, 'uploads/16700466_1558096797537763_2979254293090447762_o.jpg', 0, 1),
('RES00000002', 'Racidon', '', 'Bernarte', '1984-04-08', 'M', NULL, '21 ', 15, 1985, 'uploads/human.png', NULL, 1),
('RES00000003', 'Silvia', '', 'Ambag', '1980-03-15', 'F', NULL, 'Blk. 19 Lot 23 Phase 4 ', 8, 1999, 'uploads/human.png', NULL, 1),
('RES00000004', 'Iris Rowena', '', 'Bernardo', '1984-01-07', 'F', NULL, 'Blk. 3 Lot 5 ', 4, 1984, 'uploads/human.png', NULL, 1),
('RES00000005', 'Emejidio', NULL, 'Gepila', '1946-07-21', 'M', NULL, 'Lot 32', 8, 1946, 'uploads/human.png', NULL, 1),
('RES00000007', 'Daizylyn', '', 'Palilo', '1996-02-28', 'F', NULL, 'Lot 1', 6, 1996, 'uploads/human.png', NULL, 1),
('RES00000008', 'Rolan', '', 'Malvar', '1952-12-23', 'M', NULL, 'Blk. 2 Lot 15 ', 41, 1961, 'uploads/human.png', NULL, 1),
('RES00000009', 'Klein', 'Aguinaldo', 'Soriano', '1999-01-13', 'M', NULL, '34', 2, 2000, 'uploads/human.png', NULL, 1),
('RES00000012', 'Victoria', 'Tecson', 'Caringal', '1994-07-13', 'F', NULL, '983', 52, 1995, 'uploads/human.png', NULL, 0),
('RES00000014', 'Bill', '', 'Ambag', '1962-11-22', 'M', NULL, 'Blk. 1 Lot 12 ', 39, 1987, 'uploads/human.png', NULL, 1),
('RES00000015', 'Redentor', '', 'Pablo', '1973-04-09', 'M', '+639985543901', '13 ', 21, 1979, 'uploads/human.png', 0, 1),
('RES00000016', 'Maria Elena', '', 'Adarna', '1989-08-01', 'F', NULL, 'Blk. 12 Lot 1 ', 18, 1989, 'uploads/human.png', NULL, 1),
('RES00000017', 'Mark', '', 'Zuckerberg', '1992-07-20', 'F', '+639997078154', '29 ', 29, 1994, 'uploads/human.png', 1, 1),
('RES00000018', 'Yeng', NULL, 'Constantino', '1989-05-21', 'F', NULL, 'AAA', 63, 1989, 'uploads/13895409_1755819031353061_189628979544695294_n.png', NULL, 1),
('RES00000022', 'Pau', NULL, 'Duque', '1992-08-24', 'F', '+639292003741', 'sssss', 63, 2017, 'uploads/human.png', 1, 1),
('RES00000025', 'Judy Anne', NULL, 'Jacobo', '1999-10-07', 'F', '+639123456789', 'Lot 19. Blk. 10', 41, 2010, 'uploads/human.png', NULL, 1),
('RES00000026', 'Joviequel', NULL, 'Dela Cruz', '1999-12-18', 'F', '+639098765432', '347 Grand Villas', 64, 1999, 'uploads/human.png', NULL, 1),
('RES00000028', 'Paul', NULL, 'Sebastian', '1972-08-08', 'M', NULL, '128 Seville Village', 2, 1999, 'uploads/human.png', 1, 1),
('RES00000031', 'Nicolas', NULL, 'Mallari', '1998-04-02', 'M', NULL, 'Thirty', 67, 2000, 'uploads/human.png', NULL, 1),
('RES00000033', 'sad', NULL, 'dfsd', '2017-08-29', 'M', NULL, 'asd s', 15, 2017, 'uploads/human.png', 1, 1),
('RES00000034', 'djsaklj', NULL, 'Sample', '1999-08-29', 'M', '+639101010101', '23 Symphony', 8, 2000, 'uploads/human.png', 1, 1),
('RES00000035', 'Demi', NULL, 'Lovato', '1999-08-16', 'F', '+639909090909', '34 Just be Careful', 67, 2013, 'uploads/human.png', 1, 1);

--
-- Triggers `tbl_resident`
--
DELIMITER $$
CREATE TRIGGER `tbl_resident_insert` BEFORE INSERT ON `tbl_resident` FOR EACH ROW BEGIN
  INSERT INTO tbl_resident_seq VALUES (NULL);
  SET NEW.resident_id = CONCAT('RES', LPAD(LAST_INSERT_ID(), 8, '0'));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_residentreportedincident`
--

CREATE TABLE `tbl_residentreportedincident` (
  `resident_id` char(11) NOT NULL,
  `incident_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_residentuser`
--

CREATE TABLE `tbl_residentuser` (
  `resident_username` varchar(30) NOT NULL,
  `resident_password` char(40) NOT NULL,
  `resident_login` datetime DEFAULT NULL,
  `resident_long` double DEFAULT NULL,
  `resident_lat` double DEFAULT NULL,
  `resident_id` char(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_residentuser`
--

INSERT INTO `tbl_residentuser` (`resident_username`, `resident_password`, `resident_login`, `resident_long`, `resident_lat`, `resident_id`) VALUES
('markfb', 'f0db825feca71e649218fc6d2539c6812c42802e', NULL, NULL, NULL, 'RES00000017');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_resident_seq`
--

CREATE TABLE `tbl_resident_seq` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_resident_seq`
--

INSERT INTO `tbl_resident_seq` (`id`) VALUES
(23),
(24),
(25),
(26),
(27),
(28),
(29),
(30),
(31),
(33),
(34),
(35);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_settlement`
--

CREATE TABLE `tbl_settlement` (
  `settlement_id` int(11) NOT NULL,
  `settlement_hearing` int(11) NOT NULL,
  `settlement_datetime` datetime NOT NULL,
  `settlement_details` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_street`
--

CREATE TABLE `tbl_street` (
  `street_id` int(11) NOT NULL,
  `street_name` text NOT NULL,
  `street_area` int(11) NOT NULL,
  `street_exists` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_street`
--

INSERT INTO `tbl_street` (`street_id`, `street_name`, `street_area`, `street_exists`) VALUES
(1, 'Arayat Street', 1, 1),
(2, 'Nobel Street', 1, 1),
(3, 'Norton Street', 1, 1),
(4, 'Apo Street', 1, 1),
(5, 'Banahaw Street', 1, 1),
(6, 'Banawe Ish Street', 1, 1),
(7, 'Cordillera Street', 1, 1),
(8, 'Sierra Madre Street', 1, 1),
(9, 'Taal Street', 1, 1),
(10, 'Iriga Street', 1, 1),
(11, 'Malaya Street', 1, 1),
(12, 'Mayon Street', 1, 1),
(13, 'Makiling Street', 1, 1),
(14, 'Sierra Madre Street', 1, 1),
(15, 'Samat Street', 1, 1),
(16, 'Lunas Street', 1, 1),
(17, 'Kanlaon Street', 1, 1),
(18, 'Pampanga Street', 2, 1),
(19, 'Bulacan Street', 2, 1),
(20, 'Bicol Street', 2, 1),
(21, 'Scandivanian Street', 2, 1),
(22, 'Visayas Street', 2, 1),
(23, 'Katipunan Street', 2, 1),
(24, 'Clemente Street', 2, 1),
(25, 'Sta fe Street', 2, 1),
(26, 'Heron Street', 3, 1),
(27, 'Hornbill Street', 3, 1),
(28, 'Falcon Street', 3, 1),
(29, 'Eagle Street', 3, 1),
(30, 'Dove Street', 3, 1),
(31, 'Peacock Street', 3, 1),
(32, 'Bluebird Street', 3, 1),
(33, 'Manila Street', 3, 1),
(34, 'Love Bird Street', 3, 1),
(35, 'Faithful Street', 3, 1),
(36, 'Graceful Street', 3, 1),
(37, 'Livingful Street', 3, 1),
(38, 'Clover Street', 3, 1),
(39, 'Cherry Street', 2, 1),
(40, 'Aspen Street', 3, 1),
(41, 'Apple Street', 3, 1),
(42, 'Cedar Street', 3, 1),
(43, 'Cypress Street', 3, 1),
(44, 'Fern Street', 3, 1),
(45, 'Lemon Street', 3, 1),
(46, 'Maple Street', 3, 1),
(47, 'Aster Street', 3, 1),
(48, 'Magnolia Street', 3, 1),
(49, 'Marigold Street', 3, 1),
(50, 'Rose Street', 3, 1),
(51, 'Sunflower Street', 3, 1),
(52, 'Violet Street', 3, 1),
(53, 'Scarlet Street', 3, 1),
(54, 'Petunia Street', 3, 1),
(55, 'Lotus Street', 3, 1),
(56, 'Lilac Street', 3, 1),
(57, 'Jasmin Street', 3, 1),
(58, 'Daffodil Street', 3, 1),
(59, 'Ivy Street', 3, 1),
(60, 'Pines Street', 4, 1),
(61, 'Banawe Street', 4, 1),
(62, 'Samapaguita Street', 3, 1),
(63, 'Champaca Street', 2, 1),
(64, 'Manila Gravel Pit Rd', 4, 1),
(65, 'Yehey Street', 2, 0),
(66, 'Banawe', 2, 1),
(67, 'Payatas Street', 6, 1),
(68, 'Sample Street', 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_submittedrequirements`
--

CREATE TABLE `tbl_submittedrequirements` (
  `sr_request` int(11) NOT NULL,
  `sr_cr` int(11) NOT NULL,
  `sr_stat` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_trans`
--

CREATE TABLE `tbl_trans` (
  `trans_id` int(11) NOT NULL,
  `trans_resident` char(11) NOT NULL,
  `trans_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_trans`
--

INSERT INTO `tbl_trans` (`trans_id`, `trans_resident`, `trans_date`) VALUES
(1, 'RES00000002', '2017-08-23 15:36:59'),
(3, 'RES00000031', '2017-08-23 16:32:40'),
(4, 'RES00000026', '2017-08-24 14:28:23'),
(5, 'RES00000015', '2017-08-28 06:46:34'),
(6, 'RES00000025', '2017-08-28 10:09:33'),
(7, 'RES00000007', '2017-08-28 10:12:27'),
(8, 'RES00000002', '2017-08-28 10:28:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_reserved_at_index` (`queue`(191),`reserved_at`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_area`
--
ALTER TABLE `tbl_area`
  ADD PRIMARY KEY (`area_id`);

--
-- Indexes for table `tbl_brgyinfo`
--
ALTER TABLE `tbl_brgyinfo`
  ADD PRIMARY KEY (`brgyinfo_name`);

--
-- Indexes for table `tbl_case`
--
ALTER TABLE `tbl_case`
  ADD PRIMARY KEY (`case_id`),
  ADD KEY `case_caseskp` (`case_caseskp`),
  ADD KEY `case_status` (`case_status`);

--
-- Indexes for table `tbl_caseallocation`
--
ALTER TABLE `tbl_caseallocation`
  ADD KEY `caseallocation_case` (`caseallocation_case`),
  ADD KEY `caseallocation_official` (`caseallocation_official`),
  ADD KEY `caseallocation_pangkat` (`caseallocation_pangkat`);

--
-- Indexes for table `tbl_caseskp`
--
ALTER TABLE `tbl_caseskp`
  ADD PRIMARY KEY (`caseskp_id`);

--
-- Indexes for table `tbl_casestage`
--
ALTER TABLE `tbl_casestage`
  ADD PRIMARY KEY (`casestage_id`);

--
-- Indexes for table `tbl_clearance`
--
ALTER TABLE `tbl_clearance`
  ADD PRIMARY KEY (`clearance_id`),
  ADD KEY `clearance_price` (`clearance_price`);

--
-- Indexes for table `tbl_clearancerequirement`
--
ALTER TABLE `tbl_clearancerequirement`
  ADD KEY `cr_requirement` (`cr_requirement`),
  ADD KEY `cr_clearance` (`cr_clearance`);

--
-- Indexes for table `tbl_hearing`
--
ALTER TABLE `tbl_hearing`
  ADD PRIMARY KEY (`hearing_id`),
  ADD KEY `hearing_case` (`hearing_case`),
  ADD KEY `hearing_type` (`hearing_type`);

--
-- Indexes for table `tbl_hearingattendance`
--
ALTER TABLE `tbl_hearingattendance`
  ADD KEY `ha_hearing` (`ha_hearing`),
  ADD KEY `ha_personinvolve` (`ha_personinvolve`);

--
-- Indexes for table `tbl_hearingletter`
--
ALTER TABLE `tbl_hearingletter`
  ADD KEY `hl_hearing` (`hl_hearing`),
  ADD KEY `hl_personinvolve` (`hl_personinvolve`);

--
-- Indexes for table `tbl_hs`
--
ALTER TABLE `tbl_hs`
  ADD PRIMARY KEY (`hs_id`),
  ADD KEY `hs_office` (`hs_office`);

--
-- Indexes for table `tbl_incident`
--
ALTER TABLE `tbl_incident`
  ADD PRIMARY KEY (`incident_id`),
  ADD KEY `incident_street` (`incident_street`),
  ADD KEY `incident_cat` (`incident_cat`);

--
-- Indexes for table `tbl_incidentcat`
--
ALTER TABLE `tbl_incidentcat`
  ADD PRIMARY KEY (`incidentcat_id`);

--
-- Indexes for table `tbl_minutes`
--
ALTER TABLE `tbl_minutes`
  ADD PRIMARY KEY (`minutes_id`),
  ADD KEY `minutes_hearing` (`minutes_hearing`);

--
-- Indexes for table `tbl_office`
--
ALTER TABLE `tbl_office`
  ADD PRIMARY KEY (`office_id`),
  ADD KEY `office_brgy` (`office_brgy`),
  ADD KEY `office_street` (`office_street`);

--
-- Indexes for table `tbl_official`
--
ALTER TABLE `tbl_official`
  ADD PRIMARY KEY (`official_id`),
  ADD KEY `position_id` (`position_id`),
  ADD KEY `resident_id` (`resident_id`);

--
-- Indexes for table `tbl_officialuser`
--
ALTER TABLE `tbl_officialuser`
  ADD PRIMARY KEY (`official_username`),
  ADD KEY `official_id` (`official_id`);

--
-- Indexes for table `tbl_pangkat`
--
ALTER TABLE `tbl_pangkat`
  ADD PRIMARY KEY (`pangkat_id`);

--
-- Indexes for table `tbl_personinvolve`
--
ALTER TABLE `tbl_personinvolve`
  ADD KEY `personinvolve_case` (`personinvolve_case`),
  ADD KEY `personinvolve_resident` (`personinvolve_resident`);

--
-- Indexes for table `tbl_position`
--
ALTER TABLE `tbl_position`
  ADD PRIMARY KEY (`position_id`);

--
-- Indexes for table `tbl_price`
--
ALTER TABLE `tbl_price`
  ADD PRIMARY KEY (`price_id`);

--
-- Indexes for table `tbl_request`
--
ALTER TABLE `tbl_request`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `request_clearance` (`request_clearance`),
  ADD KEY `request_resident` (`request_resident`),
  ADD KEY `request_transaction` (`request_transaction`);

--
-- Indexes for table `tbl_requirement`
--
ALTER TABLE `tbl_requirement`
  ADD PRIMARY KEY (`requirement_id`);

--
-- Indexes for table `tbl_resident`
--
ALTER TABLE `tbl_resident`
  ADD PRIMARY KEY (`resident_id`),
  ADD KEY `resident_street` (`resident_street`);

--
-- Indexes for table `tbl_residentreportedincident`
--
ALTER TABLE `tbl_residentreportedincident`
  ADD KEY `incident_id` (`incident_id`),
  ADD KEY `reportresident_id` (`resident_id`);

--
-- Indexes for table `tbl_residentuser`
--
ALTER TABLE `tbl_residentuser`
  ADD PRIMARY KEY (`resident_username`),
  ADD KEY `resident_iduser` (`resident_id`);

--
-- Indexes for table `tbl_resident_seq`
--
ALTER TABLE `tbl_resident_seq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_settlement`
--
ALTER TABLE `tbl_settlement`
  ADD PRIMARY KEY (`settlement_id`),
  ADD KEY `settlement_hearing` (`settlement_hearing`);

--
-- Indexes for table `tbl_street`
--
ALTER TABLE `tbl_street`
  ADD PRIMARY KEY (`street_id`),
  ADD KEY `street_area` (`street_area`);

--
-- Indexes for table `tbl_submittedrequirements`
--
ALTER TABLE `tbl_submittedrequirements`
  ADD KEY `sr_request` (`sr_request`),
  ADD KEY `sr_cr` (`sr_cr`);

--
-- Indexes for table `tbl_trans`
--
ALTER TABLE `tbl_trans`
  ADD PRIMARY KEY (`trans_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_area`
--
ALTER TABLE `tbl_area`
  MODIFY `area_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tbl_case`
--
ALTER TABLE `tbl_case`
  MODIFY `case_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_caseskp`
--
ALTER TABLE `tbl_caseskp`
  MODIFY `caseskp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT for table `tbl_casestage`
--
ALTER TABLE `tbl_casestage`
  MODIFY `casestage_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tbl_clearance`
--
ALTER TABLE `tbl_clearance`
  MODIFY `clearance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_hearing`
--
ALTER TABLE `tbl_hearing`
  MODIFY `hearing_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_incident`
--
ALTER TABLE `tbl_incident`
  MODIFY `incident_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `tbl_incidentcat`
--
ALTER TABLE `tbl_incidentcat`
  MODIFY `incidentcat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbl_minutes`
--
ALTER TABLE `tbl_minutes`
  MODIFY `minutes_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_official`
--
ALTER TABLE `tbl_official`
  MODIFY `official_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tbl_officialuser`
--
ALTER TABLE `tbl_officialuser`
  MODIFY `official_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tbl_pangkat`
--
ALTER TABLE `tbl_pangkat`
  MODIFY `pangkat_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_position`
--
ALTER TABLE `tbl_position`
  MODIFY `position_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tbl_price`
--
ALTER TABLE `tbl_price`
  MODIFY `price_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tbl_request`
--
ALTER TABLE `tbl_request`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tbl_requirement`
--
ALTER TABLE `tbl_requirement`
  MODIFY `requirement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbl_resident_seq`
--
ALTER TABLE `tbl_resident_seq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `tbl_settlement`
--
ALTER TABLE `tbl_settlement`
  MODIFY `settlement_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_street`
--
ALTER TABLE `tbl_street`
  MODIFY `street_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
--
-- AUTO_INCREMENT for table `tbl_trans`
--
ALTER TABLE `tbl_trans`
  MODIFY `trans_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_case`
--
ALTER TABLE `tbl_case`
  ADD CONSTRAINT `case_caseskp` FOREIGN KEY (`case_caseskp`) REFERENCES `tbl_caseskp` (`caseskp_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_caseallocation`
--
ALTER TABLE `tbl_caseallocation`
  ADD CONSTRAINT `caseallocation_case` FOREIGN KEY (`caseallocation_case`) REFERENCES `tbl_case` (`case_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `caseallocation_official` FOREIGN KEY (`caseallocation_official`) REFERENCES `tbl_official` (`official_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `caseallocation_pangkat` FOREIGN KEY (`caseallocation_pangkat`) REFERENCES `tbl_pangkat` (`pangkat_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_clearance`
--
ALTER TABLE `tbl_clearance`
  ADD CONSTRAINT `clearance_price` FOREIGN KEY (`clearance_price`) REFERENCES `tbl_price` (`price_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_clearancerequirement`
--
ALTER TABLE `tbl_clearancerequirement`
  ADD CONSTRAINT `cr_clearance` FOREIGN KEY (`cr_clearance`) REFERENCES `tbl_clearance` (`clearance_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `cr_requirement` FOREIGN KEY (`cr_requirement`) REFERENCES `tbl_requirement` (`requirement_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_hearing`
--
ALTER TABLE `tbl_hearing`
  ADD CONSTRAINT `hearing_case` FOREIGN KEY (`hearing_case`) REFERENCES `tbl_case` (`case_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `hearing_type` FOREIGN KEY (`hearing_type`) REFERENCES `tbl_casestage` (`casestage_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_hearingattendance`
--
ALTER TABLE `tbl_hearingattendance`
  ADD CONSTRAINT `ha_hearing` FOREIGN KEY (`ha_hearing`) REFERENCES `tbl_hearing` (`hearing_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `ha_personinvolve` FOREIGN KEY (`ha_personinvolve`) REFERENCES `tbl_personinvolve` (`personinvolve_resident`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `tbl_hearingletter`
--
ALTER TABLE `tbl_hearingletter`
  ADD CONSTRAINT `hl_hearing` FOREIGN KEY (`hl_hearing`) REFERENCES `tbl_hearing` (`hearing_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `hl_personinvolve` FOREIGN KEY (`hl_personinvolve`) REFERENCES `tbl_personinvolve` (`personinvolve_resident`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `tbl_hs`
--
ALTER TABLE `tbl_hs`
  ADD CONSTRAINT `hs_office` FOREIGN KEY (`hs_office`) REFERENCES `tbl_office` (`office_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_incident`
--
ALTER TABLE `tbl_incident`
  ADD CONSTRAINT `incident_cat` FOREIGN KEY (`incident_cat`) REFERENCES `tbl_incidentcat` (`incidentcat_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `incident_street` FOREIGN KEY (`incident_street`) REFERENCES `tbl_street` (`street_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_minutes`
--
ALTER TABLE `tbl_minutes`
  ADD CONSTRAINT `minutes_hearing` FOREIGN KEY (`minutes_hearing`) REFERENCES `tbl_hearing` (`hearing_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_office`
--
ALTER TABLE `tbl_office`
  ADD CONSTRAINT `office_brgy` FOREIGN KEY (`office_brgy`) REFERENCES `tbl_brgyinfo` (`brgyinfo_name`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `office_street` FOREIGN KEY (`office_street`) REFERENCES `tbl_street` (`street_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_official`
--
ALTER TABLE `tbl_official`
  ADD CONSTRAINT `position_id` FOREIGN KEY (`position_id`) REFERENCES `tbl_position` (`position_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `resident_id` FOREIGN KEY (`resident_id`) REFERENCES `tbl_resident` (`resident_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `tbl_officialuser`
--
ALTER TABLE `tbl_officialuser`
  ADD CONSTRAINT `official_id` FOREIGN KEY (`official_id`) REFERENCES `tbl_official` (`official_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `tbl_personinvolve`
--
ALTER TABLE `tbl_personinvolve`
  ADD CONSTRAINT `personinvolve_case` FOREIGN KEY (`personinvolve_case`) REFERENCES `tbl_case` (`case_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `personinvolve_resident` FOREIGN KEY (`personinvolve_resident`) REFERENCES `tbl_resident` (`resident_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_request`
--
ALTER TABLE `tbl_request`
  ADD CONSTRAINT `request_clearance` FOREIGN KEY (`request_clearance`) REFERENCES `tbl_clearance` (`clearance_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `request_resident` FOREIGN KEY (`request_resident`) REFERENCES `tbl_resident` (`resident_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `request_transaction` FOREIGN KEY (`request_transaction`) REFERENCES `tbl_trans` (`trans_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `tbl_resident`
--
ALTER TABLE `tbl_resident`
  ADD CONSTRAINT `resident_street` FOREIGN KEY (`resident_street`) REFERENCES `tbl_street` (`street_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_residentreportedincident`
--
ALTER TABLE `tbl_residentreportedincident`
  ADD CONSTRAINT `incident_id` FOREIGN KEY (`incident_id`) REFERENCES `tbl_incident` (`incident_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `reportresident_id` FOREIGN KEY (`resident_id`) REFERENCES `tbl_resident` (`resident_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `tbl_residentuser`
--
ALTER TABLE `tbl_residentuser`
  ADD CONSTRAINT `resident_iduser` FOREIGN KEY (`resident_id`) REFERENCES `tbl_resident` (`resident_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_settlement`
--
ALTER TABLE `tbl_settlement`
  ADD CONSTRAINT `settlement_hearing` FOREIGN KEY (`settlement_hearing`) REFERENCES `tbl_hearing` (`hearing_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_street`
--
ALTER TABLE `tbl_street`
  ADD CONSTRAINT `street_area` FOREIGN KEY (`street_area`) REFERENCES `tbl_area` (`area_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_submittedrequirements`
--
ALTER TABLE `tbl_submittedrequirements`
  ADD CONSTRAINT `sr_cr` FOREIGN KEY (`sr_cr`) REFERENCES `tbl_clearancerequirement` (`cr_requirement`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `sr_request` FOREIGN KEY (`sr_request`) REFERENCES `tbl_request` (`request_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
