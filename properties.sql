-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 13, 2025 at 10:08 PM
-- Server version: 8.0.41
-- PHP Version: 8.3.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dzm_str-properties`
--

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `RECORD_ID` int NOT NULL,
  `PROPERTY_NAME` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `CONTACT` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `HOUSE_NUMBER` int DEFAULT NULL,
  `STREET_NAME` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `CITY` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `DISTRICT` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `STATE` char(2) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ZIPCODE` int DEFAULT NULL,
  `PHONE_NUMBER` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `CITY_PERMITABLE` enum('yes','no') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ISHOA` enum('yes','no') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `HOA_ALLOWED` enum('yes','no') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `STATUS` enum('yes','no') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `NOTES` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`RECORD_ID`, `PROPERTY_NAME`, `CONTACT`, `HOUSE_NUMBER`, `STREET_NAME`, `CITY`, `DISTRICT`, `STATE`, `ZIPCODE`, `PHONE_NUMBER`, `CITY_PERMITABLE`, `ISHOA`, `HOA_ALLOWED`, `STATUS`, `NOTES`) VALUES
(6, 'Millenium On LaSalle', 'Libby', 29, 'S Lasalle St', 'Chicago', 'River North', 'IL', 60603, '(773) 570-2385', 'yes', 'yes', 'no', 'yes', 'They allow it but they are capped. '),
(7, 'Shoreham & Tides', 'Mallory', 360, 'E South Water St', 'Chicago', 'The Loop', 'IL', 60601, '(312) 872-0265', 'yes', 'yes', 'no', 'no', 'Not allowed'),
(8, 'Cityfront Place', '', 400, 'N McClurg', 'Chicago', 'River North', 'IL', 60611, '(312) 464-0440', 'yes', 'yes', 'no', 'no', 'No corp leases allowed'),
(9, 'Lofts At River East', 'Riley Shoe', 445, 'E Illinois St', 'Chicago', 'River North', 'IL', 60611, '(312) 854-1818', 'yes', 'yes', 'no', 'yes', 'Email reighly@groupfox.com Email Sent. Do follow up. follow up 2/10/25 not allowing corp leases at this time. answer was given from a gatekeeper and not riley.'),
(10, 'Aston Chicago', '', 200, 'E Illinois St', 'Chicago', 'River North', 'IL', 60611, '(224) 265-7291', 'yes', 'yes', 'yes', 'yes', 'Greystar Properties. Allows corp lease but they said they were capped. I applied for city permit and was approved, so the building is not capped. BACP approved 12/16/24'),
(11, 'Chicagoan', 'Planned Property Management', 750, 'N Rush St', 'Chicago', 'River North', 'IL', 60611, '(708) 797-9767', 'yes', '', NULL, 'yes', 'Left VM 2/10/25'),
(12, 'One Superior Place', '', 1, 'W Superior St', 'Chicago', 'River North', 'IL', 60654, '(773) 570-1675', 'yes', 'yes', 'no', 'no', 'No corp leases allowed'),
(13, 'West 77 Apartments', 'Izzy', 77, 'W Huron St', 'Chicago', 'River North', 'IL', 60654, '(224) 413-3369', 'no', '', NULL, 'no', 'Emailed proposal to west77@rtresi.com - applied for BACP 12/16/24 but was denied 12/17 for planned development zone.'),
(14, '640 N Wells', 'Windsor Property Mgmt', 640, 'N Wells St', 'Chicago', 'River North', 'IL', 60654, '(815) 205-5817', 'yes', '', NULL, 'yes', 'Message left with answering service, never got a call back. Another message left 2/10/2025'),
(15, 'Flair Tower', 'Windsor Property Management', 222, 'W Erie St', 'Chicago', 'River North', 'IL', 60654, '(773) 906-5034', 'yes', '', NULL, 'yes', 'Message left with answering service, no return phone call received. ANother VM left 2/10/25'),
(16, ' ', 'Whitney Wang', 170, 'W Polk St', 'Chicago', 'South Loop', 'IL', 60605, '(312) 857-4658', 'yes', '', NULL, 'yes', 'VM left, no return phone call'),
(17, 'Wells Place Apartments', 'RMK Management', 839, 'S Wells St', 'Chicago', 'South Loop', 'IL', 60607, '(773) 389-2974', 'yes', '', NULL, 'yes', 'Message left with answering service'),
(18, 'AMLI 900', 'AMLI Residential', 900, 'S Clark St', 'Chicago', 'South Loop', 'IL', 60605, '(815) 368-4574', 'yes', 'yes', 'yes', 'no', 'Allowed, but they already have an exclusive agreement with another company'),
(19, ' ', 'Brends Curtis', 1133, 'S Wabash Ave', 'Chicago', 'South Loop', 'IL', 60605, '(708) 846-8529', 'yes', 'yes', 'no', 'no', 'Not permitted per HOA'),
(20, 'AMLI', 'Leasing Team - Wii', 71, 'W Hubbard St', 'Chicago', 'River North', 'IL', 60654, '(888) 331-3185', 'no', 'yes', 'no', 'no', 'On prohibited list'),
(21, 'Pittsfield', '', 55, 'E Washington', 'Chicago', 'The Loop', 'IL', 60602, '(312) 629-8554', 'yes', 'yes', 'yes', 'yes', 'City is capped so would have to use address for alternate building. No close parking, All utilities for $250. No W/D in unit. No amenities. No DW. Low rent though. And manager is okay with corp lease and subletting'),
(22, '215 West', 'Lamia', 215, 'W Washington St', 'Chicago', 'The Loop', 'IL', 60606, '(312) 521-5900', 'yes', 'yes', 'yes', 'yes', 'afriling@willowbridgepc.com Send ABIGAIL an email with proposal. They allow it but are particular who they deal with. '),
(23, 'Randolph Tower City Apartments', 'Kim', 188, 'W Randolph St', 'Chicago', 'The Loop', 'IL', 60601, '(872) 285-7112', 'yes', 'yes', 'yes', 'yes', 'Kim said at first corp rentals not allowed but then after mentioning i would start with one unit and pickup a couple more in the spring she said that would be fine. So call back for clarification.'),
(24, 'Atwater Apartments', 'Jabria', 355, 'E Ohio St', 'Chicago', 'River North', 'IL', 60611, '(312) 376-8923', 'yes', '', NULL, 'yes', 'atwater@bozzuto.com attn Max. Send proposal email'),
(25, 'Aqua At Lakeshore East', '', 225, 'N Columbus Dr', 'Chicago', 'The Loop', 'IL', 60601, '(312) 278-2782', 'no', '', NULL, 'no', ''),
(26, 'North Harbor Tower', 'Destiny', 175, 'N Harbor Dr', 'Chicago', 'The Loop', 'IL', 60601, '(855) 613-1942', 'no', '', NULL, 'no', 'Prohibited List'),
(27, 'North Water Apartments', 'Olive', 340, 'E North Water St', 'Chicago', 'River North', 'IL', 60611, '(312) 822-0622', 'yes', 'yes', 'yes', 'yes', 'Peyton. BACP submitted and APPROVED for 332 E North Water. Olive said it was allowed but it has to be in the individuals name. $25 for trash Gas Heat. Xfinity or ATT. 2 floors of amenities. Dry cleaning & Alterations on site. 50th floor rooftop. Private balcony. Talk to Jeanine to negotiate lease terms. Olive said corp rentals were okay. Attached to Lowes Hotel. Parking $350 Really Nice!'),
(29, 'Chestnut Towers', 'Paulina', 121, 'W Chestnut St', 'Chicago', 'River North', 'IL', 60610, '(312) 335-3331', 'yes', 'yes', 'no', 'no', ''),
(30, 'Eight O Five', '', 805, 'N LaSalle Dr', 'Chicago', 'River North', 'IL', 60610, '(312) 779-1014', 'yes', '', NULL, 'yes', 'Left message with answering service'),
(31, ' ', 'Realtor', 744, 'N Clark St', 'Chicago', 'River North', 'IL', 60654, '(773) 872-1281', 'yes', 'yes', 'no', 'no', ''),
(32, 'Exhibit On Superior', 'Gabby', 165, 'W Superior St', 'Chicago', 'River North', 'IL', 60654, '(312) 661-5000', 'yes', 'yes', 'yes', 'no', 'Already working with 2 companies. Capped.'),
(33, 'Chateau On Wells', '', 707, 'N Wells St', 'Chicago', 'River North', 'IL', 60654, '(312) 235-6855', 'yes', '', NULL, 'yes', 'Msg left with answering service'),
(34, ' ', ' Realtor', 708, 'N Wells St', 'Chicago', 'River North', 'IL', 60654, '(847) 641-1547', 'yes', 'yes', 'no', 'no', ''),
(35, ' ', 'Realtor', 355, 'W Chicago Ave', 'Chicago', 'River North', 'IL', 60654, '(815) 307-2430', 'yes', 'yes', 'no', 'no', ''),
(36, 'Hugo River North', ' ', 751, 'N Hudson Ave', 'Chicago', 'River North', 'IL', 60654, '(312) 910-9453', 'yes', '', NULL, 'yes', 'VM'),
(37, 'The 808 Cleveland', 'Alan', 751, 'N Hudson Ave', 'Chicago', 'River North', 'IL', 60654, '(312) 910-9453', 'yes', 'yes', 'yes', 'yes', 'Avail Mid March to April 17th floor. Corp Lease Okay'),
(38, ' ', 'Realtor', 700, 'N Larrabee St', 'Chicago', 'River North', 'IL', 60654, '(312) 981-5500', 'yes', '', NULL, 'yes', 'VM'),
(39, 'Parc Huron', ' ', 469, 'W Huron St', 'Chicago', 'River North', 'IL', 60654, '(773) 804-8321', 'yes', 'yes', 'yes', 'no', 'Allowed but they are maxed'),
(40, ' ', 'Owner', 6, 'W Grand Ave', 'Chicago', 'River North', 'IL', 60654, '(312) 307-0196', 'yes', '', NULL, 'yes', 'Phone number not accepting calls is what the recording said'),
(41, 'Grand Plaza', '', 540, 'N State St', 'Chicago', 'River North', 'IL', 60654, '(312) 644-7263', 'yes', '', NULL, 'yes', 'VM 2/10/25'),
(42, ' ', ' Greystar', 505, 'N State St', 'Chicago', 'River North', 'IL', 60654, '(312) 828-0889', 'yes', 'yes', 'yes', 'yes', 'Nee to be on the preapproved list. email stateandgrand@greystar.com 2/10/25 sent email waiting on reply'),
(43, ' ', ' ', 29, 'W Hubbard St', 'Chicago', 'River North', 'IL', 60654, '(224) 938-0234', 'yes', '', NULL, 'yes', 'VM 2/10/25'),
(44, 'Env', ' ', 161, 'W Kinzie St', 'Chicago', 'River North', 'IL', 60661, '(312) 500-2794', 'yes', 'yes', 'no', 'no', 'No corp leases at this time. They have companies in there currently and dont want this activiy anymore so they are trying to get them out.'),
(46, 'Sienna Chicago', 'Mgmt Company', 423, 'E Ohio St', 'Chicago', 'Mag Mile', 'IL', 60611, '(312) 644-4230', 'yes', 'yes', 'no', 'no', 'no corp leases'),
(47, '  ', 'Realtor ', 474, 'N Lakeshore Dr #4002', 'Chicago', 'Mag Mile', 'IL', 60657, '(312) 253-7492', 'yes', '', NULL, 'yes', 'Problem with phone line try again'),
(48, 'Lake & Wells', ' ', 210, 'N Wells St', 'Chicago', 'The Loop', 'IL', 60601, '(312) 782-2002', 'yes', 'yes', 'yes', 'no', 'Currently capped 2/10/25'),
(49, 'Century Towers', ' ', 182, 'W Lake St', 'Chicago', 'The Loop', 'IL', 60601, '(312) 858-9661', 'yes', 'yes', 'no', 'no', 'not permitted'),
(50, ' ', 'Realtor', 201, 'N Westshore Dr #2308', 'Chicago', 'The Loop', 'IL', 60601, '(312) 927-7115', 'yes', '', NULL, 'yes', 'VM 2/10/25'),
(51, 'Parkline Chicago', 'Jazmine', 60, 'E Randolph St', 'Chicago', 'The Loop', 'IL', 60601, '(312) 883-6060', 'yes', 'yes', 'yes', 'yes', 'Called on 2/7/25. She is checking with property manager and will call back Monday. Follow up 2/10/25. Ask to speak with property manager. Not Jasmine. Lots of units available'),
(52, 'Marquee At Block 37', 'Kelsey', 25, 'W Randolph St', 'Chicago', 'The Loop', 'IL', 60601, '(312) 372-3737', 'yes', 'yes', 'yes', 'no', 'Leases expire in July or Aug 2025, check back with her then and she can check for availability. Corp Lease Okay. 2/10/25'),
(53, 'Compass', 'Mayra', 212, 'W Washington St #902', 'Chicago', 'The Loop', 'IL', 60606, '(312) 242-1000', 'yes', '', NULL, 'yes', 'Not the correct company, or unit number. Actual unit number is 1001 and compass is the name of the company not this current realtor. Was transferred though. Left VM 2/10/25. Follow up but get a phone number from compass and not the internet.'),
(54, 'Library Lofts', 'Prince', 619, 'S Lasalle St', 'Chicago', 'The Loop', 'IL', 60605, '(773) 554-5743', 'yes', 'yes', 'no', 'no', 'Corp Lease Not Allowed');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`RECORD_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `RECORD_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
