-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 16, 2017 at 07:17 AM
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
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(4, 'Area D', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_brgyinfo`
--

CREATE TABLE `tbl_brgyinfo` (
  `brgyinfo_name` varchar(100) NOT NULL,
  `brgyinfo_website` varchar(100) NOT NULL,
  `brgyinfo_email` varchar(100) NOT NULL,
  `brgyinfo_fb` varchar(100) NOT NULL,
  `brgyinfo_logo` text NOT NULL,
  `brgyinfo_case` varchar(10) NOT NULL,
  `brgyinfo_opening` time NOT NULL,
  `brgyinfo_closing` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_brgyinfo`
--

INSERT INTO `tbl_brgyinfo` (`brgyinfo_name`, `brgyinfo_website`, `brgyinfo_email`, `brgyinfo_fb`, `brgyinfo_logo`, `brgyinfo_case`, `brgyinfo_opening`, `brgyinfo_closing`) VALUES
('Payatas', 'brgypayatas.com', 'brgypayatas@gmail.com', 'facebook.com/brgypayatas', '', 'Lupon', '07:30:00', '18:00:00');

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
(4, '2017-08-11 17:37:33', 11, 'Kinuha ang aking pera noong August 8, 2017 sa amin sa purok1 noong alas 8 ng umaga', 'Lupon', 1),
(5, '2017-08-12 01:33:08', 46, 'NAgdagdag', 'Lupon', 1),
(6, '2017-08-12 01:33:13', 46, 'NAgdagdag', 'Lupon', 1);

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
(4, 6, NULL),
(5, 2, NULL),
(6, 3, NULL);

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
(46, 'dagdag', NULL, 1);

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
(2, 'Identification', NULL, '<p>TO WHOM IT MAY CONCERN:</p>\n<p>&nbsp; &nbsp; &nbsp; THIS IS TO CERTIFY THAT @name of legal age, Filipino and a bonafide resident of @adress since @year up to present.</p>\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; THIS FURTHER CERTIFIES that the applicant whose name mentioned above shall abide the rules and regulations of the PHILIPPINE ELECTRICAL CODE and such other requirements as may be imposed by the city governing agency/ department and for the purpose of securing a wiring permit/ clearance as requirement for @purpose.</p>\n<p>&nbsp;&nbsp;&nbsp; ISSUED this @date at @brgyaddress</p>', 1, 1),
(3, 'Identificdsad', NULL, '<p>TO WHOM IT MAY CONCERN:</p>\n<p>&nbsp; &nbsp; &nbsp; THIS IS TO CERTIFY THAT @name of legal age, Filipino and a bonafide resident of @adress since @year up to present.</p>\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; THIS FURTHER CERTIFIES that the applicant whose name mentioned above shall abide the rules and regulations of the PHILIPPINE ELECTRICAL CODE and such other requirements as may be imposed by the city governing agency/ department and for the purpose of securing a wiring permit/ clearance as requirement for @purpose.</p>\n<p>&nbsp;&nbsp;&nbsp; ISSUED this @date at @brgyaddress</p>', 1, 0),
(4, 'Electrical Clearance', NULL, '<p>TO WHOM IT MAY CONCERN:</p>\n<p>&nbsp; &nbsp; &nbsp; THIS IS TO CERTIFY THAT @name of legal age, Filipino and a bonafide resident of @adress since @year up to present.</p>\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; THIS FURTHER CERTIFIES that the applicant whose name mentioned above shall abide the rules and regulations of the PHILIPPINE ELECTRICAL CODE and such other requirements as may be imposed by the city governing agency/ department and for the purpose of securing a wiring permit/ clearance as requirement for @purpose.</p>\n<p>&nbsp;&nbsp;&nbsp; ISSUED this @date at @brgyaddress</p>', 3, 1),
(5, 'Electrical Clearance Trial', NULL, '<p>TO WHOM IT MAY CONCERN:</p>\n<p>&nbsp; &nbsp; &nbsp; THIS IS TO CERTIFY THAT @name of legal age, Filipino and a bonafide resident of @adress since @year up to present.</p>\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; THIS FURTHER CERTIFIES that the applicant whose name mentioned above shall abide the rules and regulations of the PHILIPPINE ELECTRICAL CODE and such other requirements as may be imposed by the city governing agency/ department and for the purpose of securing a wiring permit/ clearance as requirement for @purpose.</p>\n<p>&nbsp;&nbsp;&nbsp; ISSUED this @date at @brgyaddress</p>', 3, 0),
(6, 'Electrical Clearance Trial 1', NULL, '<p>TO WHOM IT MAY CONCERN:</p>\n<p>&nbsp; &nbsp; &nbsp; THIS IS TO CERTIFY THAT @name of legal age, Filipino and a bonafide resident of @adress since @year up to present.</p>\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; THIS FURTHER CERTIFIES that the applicant whose name mentioned above shall abide the rules and regulations of the PHILIPPINE ELECTRICAL CODE and such other requirements as may be imposed by the city governing agency/ department and for the purpose of securing a wiring permit/ clearance as requirement for @purpose.</p>\n<p>&nbsp;&nbsp;&nbsp; ISSUED this @date at @brgyaddress</p>', 3, 0),
(7, 'Electrical Clearance Trial 2', NULL, '<p>TO WHOM IT MAY CONCERN:</p>\n<p>&nbsp; &nbsp; &nbsp; THIS IS TO CERTIFY THAT @name of legal age, Filipino and a bonafide resident of @adress since @year up to present.</p>\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; THIS FURTHER CERTIFIES that the applicant whose name mentioned above shall abide the rules and regulations of the PHILIPPINE ELECTRICAL CODE and such other requirements as may be imposed by the city governing agency/ department and for the purpose of securing a wiring permit/ clearance as requirement for @purpose.</p>\n<p>&nbsp;&nbsp;&nbsp; ISSUED this @date at @brgyaddress</p>', 3, 0),
(8, 'Electrical Clearance 3', NULL, '<p>[0]-&gt;price_id</p>', 3, 0),
(9, 'BUSINESS CLEARANCE', NULL, '<p><strong>BUSINESS CLEARANCE</strong></p>\n<p>&nbsp;</p>\n<p><strong>THIS IS TO CERTIFY THAT @NAME KEME KEME</strong></p>', 1, 1);

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
(1, 2),
(1, 4),
(2, 4),
(1, 9);

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
(2, 4, '2017-08-14 08:00:00', 1),
(3, 5, '2017-08-15 08:00:00', 1),
(4, 6, '2017-08-15 08:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_hearingattendance`
--

CREATE TABLE `tbl_hearingattendance` (
  `ha_hearing` int(11) NOT NULL,
  `ha_personinvolve` int(11) NOT NULL,
  `ha_attented` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_hearingletter`
--

CREATE TABLE `tbl_hearingletter` (
  `hl_hearing` int(11) NOT NULL,
  `hl_personinvolve` int(11) NOT NULL,
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
(1, '2017-08-10 18:00:00', 'Nasunog ang bahay at kumakalat ito', 18, 121.1027744, 14.7170936, 2, 'On-going', NULL, '2017-08-15 14:47:05', 1),
(3, '2017-08-08 19:00:00', 'Na snatch', 20, 121.1023654, 14.7164064, 1, 'On-going', NULL, '2017-08-15 14:52:36', 1),
(6, '2017-08-06 22:56:00', 'nasunog', 1, 121.1000973, 14.70639, 2, 'On-going', NULL, '2017-08-15 14:56:24', 1),
(7, '2017-08-08 23:04:00', 'hala nasunog', 60, 121.0570569, 14.6723236, 2, 'On-going', NULL, '2017-08-15 15:04:30', 1),
(8, '2017-08-01 23:04:00', 'nasunog ulit', 64, 121.0976902, 14.7148185, 2, 'On-going', NULL, '2017-08-15 15:04:52', 1),
(9, '2017-08-02 23:46:00', 'xZxZx', 1, 121.1000973, 14.70639, 1, 'On-going', NULL, '2017-08-15 15:46:40', 1),
(10, '2017-08-02 12:06:00', 'Nakuha ang cellphone ni Jose Rizal habang naglalakad', 18, 121.1027744, 14.7170936, 1, 'On-going', NULL, '2017-08-15 19:23:14', 1);

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
(1, 'Snatching', NULL, 1),
(2, 'Fire', 'Natural Phenomenon', 1);

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
  `resident_id` int(11) DEFAULT NULL,
  `position_id` int(11) DEFAULT NULL,
  `official_exists` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_official`
--

INSERT INTO `tbl_official` (`official_id`, `resident_id`, `position_id`, `official_exists`) VALUES
(0, 0, 0, 1),
(1, 1, 1, 1),
(2, 2, 2, 1),
(3, 3, 2, 1),
(4, 4, 2, 1),
(5, 5, 6, 1),
(6, 9, 2, 1),
(7, 18, 5, 1);

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
(1, 'klein013', '5bc69ecd1706a38f47c73e029811166d2a653caf', NULL),
(6, 'milomilo', '1d3e862d86cc811bab87e4313830bd835c1087de', NULL),
(7, 'user01', '0497fe4d674fe37194a6fcb08913e596ef6a307f', NULL);

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
  `personinvolve_resident` int(11) NOT NULL,
  `personinvolve_case` int(11) NOT NULL,
  `personinvolve_type` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_personinvolve`
--

INSERT INTO `tbl_personinvolve` (`personinvolve_resident`, `personinvolve_case`, `personinvolve_type`) VALUES
(17, 4, 'R'),
(14, 4, 'C'),
(9, 5, 'R'),
(22, 5, 'C'),
(9, 6, 'R'),
(22, 6, 'C');

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
(3, '2017-08-11 00:00:00', 90);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_request`
--

CREATE TABLE `tbl_request` (
  `request_id` int(11) NOT NULL,
  `request_resident` int(11) NOT NULL,
  `request_clearance` int(11) NOT NULL,
  `request_purpose` text NOT NULL,
  `request_date` date NOT NULL,
  `request_expiry` date NOT NULL,
  `request_status` varchar(50) NOT NULL,
  `request_doc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(2, 'House Blueprint', 'Original or Photocopy of the house blueprint', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_resident`
--

CREATE TABLE `tbl_resident` (
  `resident_id` int(11) NOT NULL,
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
  `resident_exists` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_resident`
--

INSERT INTO `tbl_resident` (`resident_id`, `resident_fname`, `resident_mname`, `resident_lname`, `resident_bdate`, `resident_gender`, `resident_contact`, `resident_hno`, `resident_street`, `resident_yearstayed`, `resident_image`, `resident_exists`) VALUES
(0, 'admin', 'admin', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, 'uploads/payatas.png', 1),
(1, 'KZ', '', 'Tandingan', '1986-06-01', 'F', '+639992875678', 'Blk. 23 Lot 5 Phase 3 ', 1, 1996, 'uploads/16700466_1558096797537763_2979254293090447762_o.jpg', 1),
(2, 'Racidon', '', 'Bernarte', '1984-04-08', 'M', '+639999805678', '21 ', 15, 1985, '', 1),
(3, 'Silvia', '', 'Ambag', '1980-03-15', 'F', '+639292003741', 'Blk. 19 Lot 23 Phase 4 ', 8, 1999, '', 1),
(4, 'Iris Rowena', '', 'Bernardo', '1984-01-07', 'F', '+639181234568', 'Blk. 3 Lot 5 ', 4, 1984, '', 1),
(5, 'Emejidio', NULL, 'Gepila', '1946-07-21', 'M', '', 'Lot 32', 8, 1946, '', 1),
(7, 'Daizylyn', '', 'Palilo', '1996-02-28', 'F', '+639980289574', 'Lot 1', 6, 1996, '', 1),
(8, 'Rolan', '', 'Malvar', '1952-12-23', 'M', '+639982746475', 'Blk. 2 Lot 15 ', 41, 1961, '', 1),
(9, 'Klein', 'Aguinaldo', 'Soriano', '1999-01-13', 'M', '09129856738', '34', 2, 2000, 'uploads/human.png', 1),
(12, 'Victoria', 'Tecson', 'Caringal', '1994-07-13', 'F', '09782197329', '983', 52, 1995, 'uploads/human.png', 1),
(14, 'Bill', '', 'Ambag', '1962-11-22', 'M', '+639982746476', 'Blk. 1 Lot 12 ', 39, 1987, '', 1),
(15, 'Redentor', '', 'Pablo', '1973-04-09', 'M', '+639982236476', '13 ', 21, 1979, '', 1),
(16, 'Maria Elena', '', 'Adarna', '1989-08-01', 'F', '+639981236476', 'Blk. 12 Lot 1 ', 18, 1989, '', 1),
(17, 'Mark', '', 'Zuckerberg', '1992-07-20', 'F', '+639980982476', '29 ', 29, 1994, '', 1),
(18, 'Yeng', NULL, 'Constantino', '1989-05-21', 'F', NULL, 'AAA', 63, 1989, 'uploads/13895409_1755819031353061_189628979544695294_n.png', 1),
(22, 'Pau', NULL, 'Duque', '1992-08-24', 'F', NULL, 'sssss', 63, 2017, 'uploads/human.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_residentuser`
--

CREATE TABLE `tbl_residentuser` (
  `resident_username` varchar(30) NOT NULL,
  `resident_password` varchar(30) NOT NULL,
  `resident_login` datetime NOT NULL,
  `resident_long` double NOT NULL,
  `resident_lat` double NOT NULL,
  `resident_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(39, 'Cherry Street', 3, 1),
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
(64, 'Manila Gravel Pit Rd', 4, 1);

--
-- Indexes for dumped tables
--

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
  ADD KEY `request_resident` (`request_resident`);

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
-- Indexes for table `tbl_residentuser`
--
ALTER TABLE `tbl_residentuser`
  ADD PRIMARY KEY (`resident_username`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_area`
--
ALTER TABLE `tbl_area`
  MODIFY `area_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_case`
--
ALTER TABLE `tbl_case`
  MODIFY `case_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tbl_caseskp`
--
ALTER TABLE `tbl_caseskp`
  MODIFY `caseskp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table `tbl_casestage`
--
ALTER TABLE `tbl_casestage`
  MODIFY `casestage_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tbl_clearance`
--
ALTER TABLE `tbl_clearance`
  MODIFY `clearance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tbl_hearing`
--
ALTER TABLE `tbl_hearing`
  MODIFY `hearing_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_incident`
--
ALTER TABLE `tbl_incident`
  MODIFY `incident_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tbl_incidentcat`
--
ALTER TABLE `tbl_incidentcat`
  MODIFY `incidentcat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_minutes`
--
ALTER TABLE `tbl_minutes`
  MODIFY `minutes_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_official`
--
ALTER TABLE `tbl_official`
  MODIFY `official_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tbl_officialuser`
--
ALTER TABLE `tbl_officialuser`
  MODIFY `official_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
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
  MODIFY `price_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_requirement`
--
ALTER TABLE `tbl_requirement`
  MODIFY `requirement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_resident`
--
ALTER TABLE `tbl_resident`
  MODIFY `resident_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `tbl_settlement`
--
ALTER TABLE `tbl_settlement`
  MODIFY `settlement_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_street`
--
ALTER TABLE `tbl_street`
  MODIFY `street_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
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
  ADD CONSTRAINT `ha_personinvolve` FOREIGN KEY (`ha_personinvolve`) REFERENCES `tbl_personinvolve` (`personinvolve_resident`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_hearingletter`
--
ALTER TABLE `tbl_hearingletter`
  ADD CONSTRAINT `hl_hearing` FOREIGN KEY (`hl_hearing`) REFERENCES `tbl_hearing` (`hearing_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `hl_personinvolve` FOREIGN KEY (`hl_personinvolve`) REFERENCES `tbl_personinvolve` (`personinvolve_resident`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
  ADD CONSTRAINT `resident_id` FOREIGN KEY (`resident_id`) REFERENCES `tbl_resident` (`resident_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_officialuser`
--
ALTER TABLE `tbl_officialuser`
  ADD CONSTRAINT `official_id` FOREIGN KEY (`official_id`) REFERENCES `tbl_official` (`official_id`) ON DELETE NO ACTION;

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
  ADD CONSTRAINT `request_resident` FOREIGN KEY (`request_resident`) REFERENCES `tbl_resident` (`resident_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_resident`
--
ALTER TABLE `tbl_resident`
  ADD CONSTRAINT `resident_street` FOREIGN KEY (`resident_street`) REFERENCES `tbl_street` (`street_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
