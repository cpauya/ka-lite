-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2017 at 07:14 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `capstone`
--

-- --------------------------------------------------------

--
-- Table structure for table `college`
--

CREATE TABLE `college` (
  `college_id` int(10) UNSIGNED NOT NULL,
  `college_name` varchar(100) NOT NULL,
  `college_abbrev` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `college`
--

INSERT INTO `college` (`college_id`, `college_name`, `college_abbrev`) VALUES
(1, 'College of Computer Studies', 'CCS'),
(2, 'College of Business and Accountancy', 'CBA'),
(3, 'College of Health Sciences', 'CHS'),
(4, 'College of Education', 'CED'),
(5, 'College of Engineering', 'CEN'),
(6, 'College of Arts and Sciences', 'CAS'),
(7, 'College of Law', 'COL');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_id` int(10) UNSIGNED NOT NULL,
  `department_id` int(10) UNSIGNED NOT NULL,
  `course_name` varchar(100) NOT NULL,
  `course_abbrev` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `department_id`, `course_name`, `course_abbrev`) VALUES
(1, 1, 'Bachelor of Science in Information Technology', 'BSIT'),
(2, 2, 'Bachelor of Science in Computer Science', 'BSCS'),
(3, 3, 'Bachelor of Science in Business Administration Major in Financial Management', 'BSBA-FM'),
(4, 3, 'Bachelor of Science in Business Administration Major in Marketing Management', 'BSBA-MM'),
(5, 1, 'Bachelor of Science in Information Systems', 'BSIS'),
(6, 4, 'Bachelor of Law', 'LLB');

-- --------------------------------------------------------

--
-- Table structure for table `course_curriculum`
--

CREATE TABLE `course_curriculum` (
  `course_curriculum_id` int(10) UNSIGNED NOT NULL,
  `course_id` int(10) UNSIGNED NOT NULL,
  `curriculum_description` varchar(150) NOT NULL,
  `curriculum_year` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `course_curriculum`
--

INSERT INTO `course_curriculum` (`course_curriculum_id`, `course_id`, `curriculum_description`, `curriculum_year`) VALUES
(1, 1, 'Curriculum for Bachelor of Science in Information Technology', 2011),
(2, 2, 'Curriculum for Bachelor of Science in Computer Science', 2011),
(3, 3, 'Curriculum for Bachelor of Science in Business Administration Major in Financial Management', 2011);

-- --------------------------------------------------------

--
-- Table structure for table `curriculum_subjects`
--

CREATE TABLE `curriculum_subjects` (
  `course_curriculum_id` int(10) UNSIGNED NOT NULL,
  `subject_id` int(10) UNSIGNED NOT NULL,
  `subject_year` tinyint(3) UNSIGNED NOT NULL,
  `semester_offered` tinyint(3) UNSIGNED NOT NULL,
  `prerequisite` varchar(255) NOT NULL DEFAULT 'a:1:{i:0;s:4:"None";}' COMMENT 'Serialized',
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `curriculum_subjects`
--

INSERT INTO `curriculum_subjects` (`course_curriculum_id`, `subject_id`, `subject_year`, `semester_offered`, `prerequisite`, `date_added`) VALUES
(1, 1, 1, 1, 'a:1:{i:0;s:4:"None";}', '2017-02-05 04:21:50'),
(1, 2, 1, 1, 'a:1:{i:0;s:4:"None";}', '2017-02-05 04:25:02'),
(1, 3, 1, 1, 'a:1:{i:0;s:4:"None";}', '2017-02-05 04:25:25'),
(1, 4, 1, 1, 'a:1:{i:0;s:4:"None";}', '2017-02-05 04:25:45'),
(1, 5, 1, 1, 'a:1:{i:0;s:4:"None";}', '2017-02-05 04:26:09'),
(1, 6, 1, 1, 'a:1:{i:0;s:4:"None";}', '2017-02-05 04:26:30'),
(1, 7, 1, 1, 'a:1:{i:0;s:4:"None";}', '2017-02-05 04:26:39'),
(1, 8, 1, 1, 'a:1:{i:0;s:4:"None";}', '2017-02-05 04:26:50'),
(1, 9, 1, 1, 'a:1:{i:0;s:4:"None";}', '2017-02-05 04:27:06'),
(1, 10, 1, 1, 'a:1:{i:0;s:4:"None";}', '2017-02-05 04:27:31'),
(1, 11, 1, 1, 'a:1:{i:0;s:4:"None";}', '2017-02-05 04:27:43'),
(1, 12, 1, 2, 'a:2:{i:0;s:1:"1";i:1;s:1:"2";}', '2017-02-05 04:28:08'),
(1, 13, 1, 2, 'a:1:{i:0;s:1:"3";}', '2017-02-05 04:28:41'),
(1, 14, 1, 2, 'a:1:{i:0;s:1:"3";}', '2017-02-05 04:29:01'),
(1, 15, 1, 2, 'a:1:{i:0;s:4:"None";}', '2017-02-05 04:29:18'),
(1, 16, 1, 2, 'a:1:{i:0;s:1:"5";}', '2017-02-05 04:29:34'),
(1, 17, 1, 2, 'a:1:{i:0;s:4:"None";}', '2017-02-05 04:29:58'),
(1, 18, 1, 2, 'a:1:{i:0;s:4:"None";}', '2017-02-05 04:30:52'),
(1, 19, 1, 2, 'a:1:{i:0;s:1:"9";}', '2017-02-05 04:31:10'),
(1, 20, 1, 2, 'a:1:{i:0;s:2:"10";}', '2017-02-05 04:31:53'),
(1, 21, 1, 2, 'a:1:{i:0;s:2:"11";}', '2017-02-05 04:32:14'),
(1, 22, 2, 1, 'a:1:{i:0;s:2:"12";}', '2017-02-05 04:33:07'),
(1, 23, 2, 1, 'a:1:{i:0;s:2:"12";}', '2017-02-05 04:33:42'),
(1, 25, 2, 1, 'a:1:{i:0;s:1:"3";}', '2017-02-05 04:34:49'),
(1, 26, 2, 1, 'a:2:{i:0;s:2:"15";i:1;s:1:"4";}', '2017-02-05 04:35:21'),
(1, 27, 2, 1, 'a:1:{i:0;s:2:"16";}', '2017-02-05 04:36:18'),
(1, 28, 2, 1, 'a:1:{i:0;s:4:"None";}', '2017-02-05 04:36:43'),
(1, 29, 2, 1, 'a:1:{i:0;s:4:"None";}', '2017-02-05 04:37:11'),
(1, 30, 2, 1, 'a:1:{i:0;s:1:"8";}', '2017-02-05 04:38:17'),
(1, 31, 2, 1, 'a:1:{i:0;s:1:"9";}', '2017-02-05 04:38:44'),
(1, 32, 2, 2, 'a:1:{i:0;s:2:"22";}', '2017-02-05 04:39:16'),
(1, 33, 2, 2, 'a:1:{i:0;s:2:"22";}', '2017-02-05 06:09:37'),
(1, 34, 2, 2, 'a:1:{i:0;s:2:"22";}', '2017-02-05 06:10:08'),
(1, 35, 2, 2, 'a:1:{i:0;s:1:"3";}', '2017-02-05 06:10:43'),
(1, 36, 2, 2, 'a:1:{i:0;s:2:"26";}', '2017-02-05 06:11:17'),
(1, 37, 2, 2, 'a:1:{i:0;s:4:"None";}', '2017-02-05 06:11:49'),
(1, 38, 2, 2, 'a:1:{i:0;s:1:"9";}', '2017-02-05 06:12:22'),
(1, 39, 2, 2, 'a:1:{i:0;s:4:"None";}', '2017-02-05 06:13:17'),
(1, 40, 3, 1, 'a:1:{i:0;s:2:"32";}', '2017-02-05 06:15:05'),
(1, 41, 3, 1, 'a:1:{i:0;s:2:"34";}', '2017-02-05 06:15:37'),
(1, 42, 3, 1, 'a:1:{i:0;s:2:"32";}', '2017-02-05 06:16:06'),
(1, 24, 3, 1, 'a:1:{i:0;s:4:"None";}', '2017-02-05 06:17:02'),
(1, 43, 3, 1, 'a:1:{i:0;s:4:"None";}', '2017-02-05 06:17:27'),
(1, 44, 3, 1, 'a:1:{i:0;s:2:"37";}', '2017-02-05 06:17:51'),
(1, 45, 3, 2, 'a:1:{i:0;s:2:"42";}', '2017-02-05 06:18:50'),
(1, 46, 3, 2, 'a:2:{i:0;s:1:"1";i:1;s:1:"2";}', '2017-02-05 06:19:22'),
(1, 47, 3, 2, 'a:1:{i:0;s:2:"40";}', '2017-02-05 06:20:33'),
(1, 48, 3, 2, 'a:1:{i:0;s:19:"third_year_standing";}', '2017-02-05 06:21:00'),
(1, 49, 3, 2, 'a:1:{i:0;s:4:"None";}', '2017-02-05 06:22:06'),
(1, 50, 3, 2, 'a:1:{i:0;s:2:"41";}', '2017-02-05 06:22:43'),
(1, 51, 3, 2, 'a:1:{i:0;s:2:"40";}', '2017-02-05 06:23:36'),
(1, 52, 3, 2, 'a:1:{i:0;s:2:"26";}', '2017-02-05 06:24:06'),
(1, 53, 3, 3, 'a:1:{i:0;s:20:"fourth_year_standing";}', '2017-02-05 06:26:47'),
(1, 54, 4, 1, 'a:1:{i:0;s:2:"47";}', '2017-02-05 06:29:24'),
(1, 55, 4, 1, 'a:1:{i:0;s:20:"fourth_year_standing";}', '2017-02-05 06:29:43'),
(1, 56, 4, 1, 'a:1:{i:0;s:20:"fourth_year_standing";}', '2017-02-05 06:30:08'),
(1, 57, 4, 1, 'a:1:{i:0;s:2:"47";}', '2017-02-05 06:30:40'),
(1, 58, 4, 1, 'a:1:{i:0;s:1:"6";}', '2017-02-05 06:31:03'),
(1, 59, 4, 2, 'a:1:{i:0;s:20:"fourth_year_standing";}', '2017-02-05 06:32:54'),
(1, 60, 4, 2, 'a:1:{i:0;s:20:"fourth_year_standing";}', '2017-02-05 06:33:52'),
(1, 68, 4, 2, 'a:1:{i:0;s:20:"fourth_year_standing";}', '2017-02-05 06:34:38'),
(1, 61, 4, 2, 'a:1:{i:0;s:4:"None";}', '2017-02-05 06:36:04'),
(1, 62, 4, 2, 'a:1:{i:0;s:2:"36";}', '2017-02-05 06:36:27'),
(3, 15, 1, 1, 'a:1:{i:0;s:4:"None";}', '2017-04-05 11:16:00');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `department_id` int(10) UNSIGNED NOT NULL,
  `college_id` int(10) UNSIGNED NOT NULL,
  `department_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_id`, `college_id`, `department_name`) VALUES
(1, 1, 'IT Department'),
(2, 1, 'CS Department'),
(3, 2, 'Business Ad. Department'),
(4, 7, 'Law Department');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `student_id` varchar(10) NOT NULL,
  `course_id` int(10) UNSIGNED NOT NULL,
  `course_curriculum_id` int(10) UNSIGNED NOT NULL,
  `student_firstname` varchar(50) NOT NULL,
  `student_lastname` varchar(50) NOT NULL,
  `student_middlename` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `course_id`, `course_curriculum_id`, `student_firstname`, `student_lastname`, `student_middlename`) VALUES
('050962', 1, 1, 'Martina', 'Tagacay', 'Paradillo'),
('060880', 1, 1, 'Johaira', 'Lidasan', 'asd'),
('100992', 1, 1, 'Tarik-Adziz', 'Maneged', 'I'),
('101470', 2, 2, 'Peter', 'Carpenter', 'Welch'),
('101645', 2, 2, 'Annie', 'Gonzales', 'Patterson'),
('102201', 1, 1, 'Doris', 'Cruz', 'Murphy'),
('102635', 2, 2, 'Kathryn', 'Montgomery', 'Cooper'),
('105880', 1, 1, 'Ralph', 'Carpenter', 'Hunter'),
('106636', 1, 1, 'Dennis', 'Snyder', 'Ramos'),
('108636', 2, 2, 'Kathleen', 'Collins', 'Wilson'),
('109264', 2, 2, 'Donna', 'Burke', 'Walker'),
('109974', 2, 2, 'Larry', 'Richardson', 'Gray'),
('112373', 1, 1, 'Juan', 'Chavez', 'Payne'),
('112599', 2, 2, 'Emily', 'Moreno', 'Schmidt'),
('113280', 2, 2, 'Laura', 'Perkins', 'Anderson'),
('113855', 1, 1, 'Cheryl', 'Bryant', 'Williamson'),
('114022', 2, 2, 'Scott', 'Gomez', 'Taylor'),
('114434', 1, 1, 'Keith', 'Hunter', 'Stevens'),
('118971', 1, 1, 'Donald', 'Hamilton', 'Thomas'),
('120083', 2, 2, 'Scott', 'Cunningham', 'Long'),
('120892', 1, 1, 'Billy', 'Ramirez', 'Woods'),
('121453', 1, 1, 'Richard', 'Vasquez', 'Jacobs'),
('123081', 2, 2, 'Jose', 'Wood', 'Jackson'),
('125689', 2, 2, 'Carolyn', 'Robertson', 'Arnold'),
('125707', 1, 1, 'Teresa', 'Cole', 'Hughes'),
('127557', 1, 1, 'Shawn', 'Cooper', 'Stewart'),
('127574', 1, 1, 'Edward', 'Brown', 'Ray'),
('127667', 1, 1, 'Frances', 'Hayes', 'Mendoza'),
('128598', 1, 1, 'William', 'Morrison', 'Adams'),
('128674', 2, 2, 'Paul', 'Hudson', 'Hughes'),
('130061', 1, 1, 'Maruko', 'Aihara', 'Utto'),
('130063', 1, 1, 'Marwah', 'Oliveros', 'Utto'),
('130065', 1, 1, 'Donald', 'Trump', 'Duck'),
('130365', 1, 1, 'Eugene Essun', 'Oliveros', 'Vicente'),
('130367', 1, 1, 'Jigger Ryan', 'Algabre', 'Malingin'),
('131253', 2, 2, 'Carl', 'Clark', 'Payne'),
('131568', 2, 2, 'Christopher', 'Stevens', 'Burke'),
('132962', 1, 1, 'Christopher', 'Harrison', 'Alexander'),
('133814', 2, 2, 'Ralph', 'Cole', 'Ross'),
('136263', 2, 2, 'Victor', 'Hanson', 'Ortiz'),
('136589', 2, 2, 'Alan', 'Morgan', 'Bowman'),
('137014', 1, 1, 'Harry', 'Richardson', 'Perez'),
('138261', 2, 2, 'Johnny', 'West', 'Allen'),
('138640', 2, 2, 'Anthony', 'Bryant', 'Welch'),
('138988', 1, 1, 'Pamela', 'Sanders', 'Martinez'),
('139822', 1, 1, 'Ann', 'Shaw', 'Jacobs'),
('141100', 2, 2, 'Andrea', 'Knight', 'Garcia'),
('141912', 1, 1, 'Edward', 'Day', 'Lawrence'),
('142782', 2, 2, 'David', 'Porter', 'Gibson'),
('144594', 1, 1, 'Norma', 'Gray', 'Hayes'),
('145514', 1, 1, 'Martha', 'Gray', 'Russell'),
('148791', 2, 2, 'Benjamin', 'Lane', 'Harris'),
('149184', 1, 1, 'Stephen', 'Weaver', 'Moore'),
('149708', 2, 2, 'Julie', 'Reynolds', 'White'),
('151507', 1, 1, 'Mary', 'Howell', 'Perkins'),
('153622', 1, 1, 'Sandra', 'Lopez', 'Ortiz'),
('154376', 1, 1, 'Beverly', 'Foster', 'Murray'),
('154827', 1, 1, 'Steve', 'Turner', 'Robertson'),
('155379', 2, 2, 'Evelyn', 'Wagner', 'Stanley'),
('156852', 1, 1, 'Rebecca', 'Hill', 'Martinez'),
('157633', 1, 1, 'Eric', 'Ward', 'Montgomery'),
('157712', 1, 1, 'Susan', 'Nelson', 'Gilbert'),
('158080', 1, 1, 'Phyllis', 'Wallace', 'Flores'),
('159891', 1, 1, 'Pamela', 'Campbell', 'Williamson'),
('162171', 2, 2, 'Aaron', 'Ross', 'Chapman'),
('163409', 1, 1, 'Norma', 'Weaver', 'Ferguson'),
('164303', 1, 1, 'Diana', 'Henderson', 'Harvey'),
('165013', 2, 2, 'Sarah', 'Powell', 'Gilbert'),
('169153', 1, 1, 'Larry', 'Hall', 'Gutierrez'),
('171264', 2, 2, 'Antonio', 'Daniels', 'Brown'),
('172978', 1, 1, 'Nicole', 'Kelley', 'Gomez'),
('174687', 2, 2, 'Mark', 'Wallace', 'Young'),
('175606', 2, 2, 'Tina', 'Chapman', 'Smith'),
('176799', 1, 1, 'Kelly', 'Diaz', 'Miller'),
('177277', 1, 1, 'Doris', 'Harris', 'Moore'),
('177662', 2, 2, 'Ruby', 'Graham', 'Garza'),
('178049', 2, 2, 'Andrea', 'Alexander', 'Stone'),
('178898', 2, 2, 'Karen', 'Little', 'Williamson'),
('180008', 2, 2, 'Larry', 'Castillo', 'Rodriguez'),
('181390', 2, 2, 'Randy', 'Fox', 'Hughes'),
('181713', 1, 1, 'Howard', 'Lane', 'Greene'),
('182900', 1, 1, 'Jose', 'Price', 'Ortiz'),
('184145', 2, 2, 'Carol', 'Snyder', 'Scott'),
('187134', 1, 1, 'Gary', 'Simpson', 'Thomas'),
('188002', 2, 2, 'Margaret', 'Smith', 'Jones'),
('188021', 1, 1, 'Bruce', 'Bennett', 'Carroll'),
('188050', 1, 1, 'Jerry', 'Harvey', 'Edwards'),
('188449', 1, 1, 'Doris', 'Ortiz', 'Hansen'),
('189008', 1, 1, 'Lori', 'Garcia', 'Griffin'),
('189076', 1, 1, 'Laura', 'Simpson', 'Gomez'),
('189632', 2, 2, 'Martha', 'Hernandez', 'Carpenter'),
('190616', 2, 2, 'Donald', 'Black', 'Fernandez'),
('190711', 2, 2, 'Bonnie', 'Carpenter', 'Rogers'),
('190766', 1, 1, 'Justin', 'Ferguson', 'White'),
('192148', 2, 2, 'Martin', 'Olson', 'Wright'),
('195527', 1, 1, 'Sarah', 'Phillips', 'Ryan'),
('195956', 2, 2, 'Gloria', 'Ford', 'Ray'),
('197662', 2, 2, 'Jack', 'Evans', 'Williams'),
('199796', 2, 2, 'Gregory', 'Gilbert', 'Gutierrez'),
('201114', 1, 1, 'Stephanie', 'Diaz', 'Crawford'),
('202089', 1, 1, 'Christina', 'Hanson', 'Larson'),
('203904', 2, 2, 'Rachel', 'Hansen', 'Carpenter'),
('204325', 1, 1, 'Helen', 'Perez', 'Marshall'),
('204526', 2, 2, 'Terry', 'Long', 'Harrison'),
('204788', 1, 1, 'Amy', 'Watkins', 'Sanders'),
('207721', 2, 2, 'Martin', 'Myers', 'Murray'),
('208917', 2, 2, 'Emily', 'Lee', 'Fields'),
('212683', 1, 1, 'Ryan', 'Bell', 'Peters'),
('213549', 2, 2, 'Lillian', 'Hunter', 'Medina'),
('213562', 2, 2, 'Willie', 'Hawkins', 'Martin'),
('214550', 1, 1, 'Henry', 'Marshall', 'Robertson'),
('215985', 2, 2, 'Paula', 'Olson', 'Mills'),
('216195', 2, 2, 'Martin', 'Bishop', 'Mills'),
('216278', 2, 2, 'Brian', 'Robinson', 'Chavez'),
('218095', 2, 2, 'Anne', 'Torres', 'Frazier'),
('220962', 2, 2, 'Clarence', 'Reid', 'Jacobs'),
('221269', 1, 1, 'Michael', 'Hughes', 'Ruiz'),
('221714', 1, 1, 'Wanda', 'Reed', 'Montgomery'),
('221812', 1, 1, 'Paula', 'Medina', 'Howell'),
('222613', 1, 1, 'Earl', 'Meyer', 'Oliver'),
('223744', 2, 2, 'Steven', 'Long', 'Richardson'),
('224389', 2, 2, 'Carol', 'Jordan', 'Reyes'),
('224637', 1, 1, 'Heather', 'Powell', 'Sullivan'),
('227854', 2, 2, 'Sean', 'Clark', 'Powell'),
('228138', 1, 1, 'Andrea', 'Murphy', 'Black'),
('236150', 1, 1, 'Anne', 'Arnold', 'Olson'),
('236697', 2, 2, 'Victor', 'James', 'Williams'),
('236862', 1, 1, 'Adam', 'Rivera', 'Bradley'),
('237083', 1, 1, 'Brian', 'Willis', 'Simmons'),
('238572', 2, 2, 'Russell', 'Cole', 'Brooks'),
('238731', 2, 2, 'Diane', 'White', 'Pierce'),
('242269', 1, 1, 'Christine', 'Allen', 'Henry'),
('242729', 1, 1, 'Ronald', 'Reynolds', 'Knight'),
('246146', 2, 2, 'Roger', 'Ray', 'Watkins'),
('246284', 2, 2, 'Donna', 'Carpenter', 'Reyes'),
('246672', 2, 2, 'Samuel', 'Nelson', 'Meyer'),
('248895', 1, 1, 'Richard', 'Gilbert', 'Harris'),
('249077', 1, 1, 'Christopher', 'Fowler', 'Young'),
('250094', 1, 1, 'Barbara', 'Sims', 'Richards'),
('250851', 2, 2, 'Mark', 'Castillo', 'Wheeler'),
('252649', 1, 1, 'Janet', 'Ward', 'Warren'),
('253269', 1, 1, 'Ryan', 'Reed', 'Watson'),
('255072', 2, 2, 'Jerry', 'Mills', 'Foster'),
('256226', 1, 1, 'Alan', 'Morrison', 'Fox'),
('257168', 2, 2, 'Linda', 'Woods', 'Castillo'),
('259977', 1, 1, 'Gregory', 'Johnson', 'Owens'),
('261038', 2, 2, 'Beverly', 'Walker', 'Ray'),
('263550', 2, 2, 'Judy', 'Hawkins', 'Allen'),
('264662', 1, 1, 'Irene', 'Mitchell', 'Lane'),
('266551', 2, 2, 'Jeffrey', 'Howard', 'Lewis'),
('269205', 1, 1, 'Christine', 'Woods', 'Rose'),
('271053', 1, 1, 'Bruce', 'Mitchell', 'Gibson'),
('272496', 2, 2, 'Raymond', 'Matthews', 'Jackson'),
('275928', 2, 2, 'Sharon', 'Webb', 'Burton'),
('277577', 1, 1, 'Kathy', 'Bennett', 'Reynolds'),
('282998', 1, 1, 'Tammy', 'Bryant', 'Montgomery'),
('283594', 2, 2, 'Patrick', 'Mason', 'Lewis'),
('283834', 1, 1, 'Michelle', 'Mcdonald', 'Grant'),
('283974', 1, 1, 'Andrew', 'Jones', 'Fox'),
('284319', 2, 2, 'Jesse', 'Jenkins', 'Holmes'),
('288769', 2, 2, 'Ernest', 'Andrews', 'Wood'),
('291051', 2, 2, 'Dorothy', 'Harvey', 'Russell'),
('291385', 1, 1, 'Kenneth', 'Davis', 'Harrison'),
('297644', 1, 1, 'Carlos', 'King', 'Hawkins'),
('298921', 1, 1, 'Katherine', 'Palmer', 'Watson'),
('299495', 1, 1, 'Tina', 'Harrison', 'Hayes'),
('300436', 1, 1, 'Harry', 'Young', 'Bishop'),
('303108', 2, 2, 'Michelle', 'Perkins', 'Jones'),
('309725', 1, 1, 'Clarence', 'Schmidt', 'James'),
('311708', 1, 1, 'Brian', 'Thompson', 'Hudson'),
('312915', 2, 2, 'Sarah', 'Rose', 'Lawson'),
('313865', 2, 2, 'Kevin', 'Turner', 'Foster'),
('316140', 2, 2, 'Diana', 'Woods', 'Ramos'),
('316644', 2, 2, 'Stephen', 'Powell', 'Hill'),
('320457', 1, 1, 'Steven', 'Kim', 'Butler'),
('321669', 1, 1, 'Nancy', 'Taylor', 'Nguyen'),
('322286', 2, 2, 'Benjamin', 'Arnold', 'Morrison'),
('322952', 2, 2, 'Daniel', 'Harper', 'Bell'),
('323104', 1, 1, 'Wayne', 'Robertson', 'Warren'),
('327541', 2, 2, 'Jerry', 'Griffin', 'Payne'),
('328312', 1, 1, 'Robin', 'Cruz', 'Green'),
('329843', 1, 1, 'Carol', 'Hayes', 'Anderson'),
('330578', 1, 1, 'Keith', 'Fuller', 'Chavez'),
('331242', 2, 2, 'Deborah', 'Lane', 'Ryan'),
('331721', 2, 2, 'Christine', 'Cooper', 'Shaw'),
('332213', 2, 2, 'Justin', 'Gonzales', 'Turner'),
('332441', 2, 2, 'Arthur', 'Diaz', 'Gonzalez'),
('333608', 1, 1, 'Mildred', 'Murphy', 'Washington'),
('333663', 1, 1, 'Susan', 'Dixon', 'Rodriguez'),
('334601', 1, 1, 'Joseph', 'Gomez', 'Burton'),
('334610', 2, 2, 'Kathy', 'Kennedy', 'Edwards'),
('339084', 2, 2, 'Amy', 'Stewart', 'Webb'),
('341351', 1, 1, 'Charles', 'Simpson', 'Jordan'),
('342175', 1, 1, 'Laura', 'Gordon', 'Romero'),
('342522', 1, 1, 'Frances', 'Hudson', 'Williamson'),
('344917', 1, 1, 'Annie', 'Elliott', 'Miller'),
('347822', 2, 2, 'Kelly', 'Dunn', 'Richardson'),
('348175', 1, 1, 'Charles', 'Bell', 'Chapman'),
('350643', 1, 1, 'Jeffrey', 'Wright', 'Powell'),
('353017', 2, 2, 'Angela', 'Reynolds', 'Lane'),
('353599', 2, 2, 'Keith', 'Ruiz', 'Spencer'),
('353732', 2, 2, 'Nicole', 'Myers', 'Diaz'),
('354178', 1, 1, 'Frank', 'Powell', 'Lopez'),
('357865', 2, 2, 'Sara', 'Edwards', 'Cole'),
('358190', 1, 1, 'Craig', 'Olson', 'Ferguson'),
('359325', 1, 1, 'Debra', 'Harvey', 'Vasquez'),
('363267', 1, 1, 'Anna', 'Hansen', 'Hicks'),
('365196', 2, 2, 'Carolyn', 'Richardson', 'Scott'),
('366543', 2, 2, 'Ryan', 'Wood', 'Ferguson'),
('368018', 1, 1, 'Peter', 'Martin', 'Butler'),
('370569', 1, 1, 'Todd', 'Burns', 'Wallace'),
('371344', 1, 1, 'Barbara', 'Welch', 'Gibson'),
('372125', 2, 2, 'Scott', 'Kennedy', 'Arnold'),
('372317', 1, 1, 'Stephanie', 'Griffin', 'Ortiz'),
('372425', 2, 2, 'Teresa', 'Dunn', 'Welch'),
('373359', 1, 1, 'Carl', 'Bradley', 'Shaw'),
('374208', 2, 2, 'Catherine', 'Armstrong', 'Banks'),
('375298', 1, 1, 'Amy', 'Dixon', 'Stevens'),
('376948', 1, 1, 'Jane', 'Peters', 'Hill'),
('379078', 2, 2, 'Denise', 'Woods', 'Grant'),
('379485', 1, 1, 'Roger', 'Warren', 'White'),
('379590', 1, 1, 'Angela', 'Baker', 'Willis'),
('379909', 2, 2, 'Ashley', 'Howard', 'Webb'),
('381002', 2, 2, 'Melissa', 'Adams', 'Lee'),
('381502', 2, 2, 'Judith', 'Cooper', 'Turner'),
('382205', 2, 2, 'Jesse', 'Fox', 'Jenkins'),
('382944', 2, 2, 'George', 'Sullivan', 'Mccoy'),
('383881', 2, 2, 'Steve', 'Ramirez', 'Morales'),
('384099', 2, 2, 'Beverly', 'Grant', 'Allen'),
('385793', 2, 2, 'Joyce', 'Castillo', 'Campbell'),
('386427', 2, 2, 'Ernest', 'Peters', 'Cox'),
('387854', 1, 1, 'Maria', 'Simmons', 'Bailey'),
('388889', 2, 2, 'Bruce', 'Simpson', 'Ellis'),
('389202', 2, 2, 'Emily', 'Bryant', 'Flores'),
('390426', 1, 1, 'Patrick', 'Washington', 'Banks'),
('393825', 2, 2, 'Kimberly', 'Watson', 'Rogers'),
('394120', 1, 1, 'Samuel', 'Garza', 'Willis'),
('394307', 1, 1, 'Jeffrey', 'Hudson', 'Cooper'),
('396069', 2, 2, 'Evelyn', 'King', 'Hayes'),
('397038', 1, 1, 'Amy', 'Bowman', 'Knight'),
('397264', 2, 2, 'Billy', 'Coleman', 'Duncan'),
('397518', 2, 2, 'Jimmy', 'Stephens', 'Phillips'),
('397805', 1, 1, 'Shirley', 'Bradley', 'Jacobs'),
('397813', 1, 1, 'Emily', 'Peters', 'Richards'),
('398903', 1, 1, 'Angela', 'Long', 'Wallace'),
('398968', 2, 2, 'Susan', 'Franklin', 'Diaz'),
('401183', 2, 2, 'Arthur', 'Williams', 'Warren'),
('402609', 2, 2, 'Christopher', 'Carroll', 'Hudson'),
('402966', 2, 2, 'Pamela', 'Schmidt', 'Mccoy'),
('407028', 2, 2, 'Charles', 'Long', 'Henderson'),
('408614', 2, 2, 'Jerry', 'Little', 'Burton'),
('414967', 1, 1, 'Virginia', 'Stewart', 'Harrison'),
('415169', 1, 1, 'Jane', 'Shaw', 'Clark'),
('418224', 1, 1, 'Amanda', 'Woods', 'Sanders'),
('420427', 2, 2, 'Phillip', 'Daniels', 'Robinson'),
('425059', 2, 2, 'Jean', 'Foster', 'Hansen'),
('426228', 2, 2, 'Julie', 'Harvey', 'Montgomery'),
('426592', 2, 2, 'Emily', 'Kelley', 'Porter'),
('427181', 2, 2, 'Paul', 'Diaz', 'Robinson'),
('427844', 2, 2, 'Anthony', 'Young', 'Wright'),
('428035', 1, 1, 'Martha', 'Wright', 'Gonzalez'),
('428521', 1, 1, 'Irene', 'Rose', 'Meyer'),
('428811', 2, 2, 'Nicholas', 'Riley', 'Knight'),
('429150', 2, 2, 'Deborah', 'Larson', 'Lynch'),
('430944', 2, 2, 'William', 'Barnes', 'Jackson'),
('431109', 2, 2, 'Robin', 'Burke', 'Wheeler'),
('431328', 2, 2, 'Lillian', 'Rogers', 'Armstrong'),
('432770', 1, 1, 'Catherine', 'Vasquez', 'Day'),
('434859', 1, 1, 'Walter', 'Williams', 'Hall'),
('435070', 2, 2, 'Stephanie', 'Gutierrez', 'Williamson'),
('435199', 1, 1, 'Gloria', 'Bailey', 'Griffin'),
('435926', 1, 1, 'Marilyn', 'Harvey', 'Mason'),
('438066', 1, 1, 'Edward', 'Harrison', 'Burke'),
('440207', 2, 2, 'Rachel', 'Rodriguez', 'Murphy'),
('441793', 2, 2, 'Ryan', 'Baker', 'Burton'),
('444116', 1, 1, 'Kevin', 'Williamson', 'Kelly'),
('444744', 1, 1, 'Sarah', 'Hunter', 'Daniels'),
('444855', 2, 2, 'Ernest', 'Olson', 'Banks'),
('445993', 1, 1, 'Carolyn', 'Scott', 'Morales'),
('446119', 1, 1, 'Tammy', 'Harris', 'Watson'),
('446564', 2, 2, 'Alan', 'Cox', 'Barnes'),
('452441', 2, 2, 'Andrew', 'Chapman', 'Boyd'),
('454497', 2, 2, 'Ruth', 'Warren', 'Hudson'),
('455959', 1, 1, 'Catherine', 'Wallace', 'Mcdonald'),
('456419', 2, 2, 'Benjamin', 'Ramos', 'Kelley'),
('461088', 2, 2, 'Cheryl', 'Payne', 'Lane'),
('462355', 2, 2, 'Todd', 'Johnson', 'Mason'),
('464950', 2, 2, 'Mary', 'Stephens', 'Coleman'),
('465078', 1, 1, 'John', 'Jenkins', 'Hall'),
('465200', 2, 2, 'Joe', 'Dean', 'Wells'),
('465976', 2, 2, 'Kevin', 'Lopez', 'Hunter'),
('467675', 1, 1, 'Deborah', 'Dunn', 'Peters'),
('467704', 1, 1, 'Steve', 'Allen', 'Medina'),
('467718', 1, 1, 'Denise', 'Stevens', 'Day'),
('467744', 1, 1, 'Nancy', 'Wilson', 'Martin'),
('468458', 1, 1, 'Donald', 'Castillo', 'Hudson'),
('469315', 1, 1, 'Kevin', 'Price', 'Harris'),
('469799', 2, 2, 'Jean', 'Bell', 'Robertson'),
('471064', 1, 1, 'Bonnie', 'Frazier', 'Wood'),
('473838', 2, 2, 'Eugene', 'Garza', 'Wright'),
('474499', 2, 2, 'Ann', 'Kelly', 'Lawson'),
('474782', 2, 2, 'Jimmy', 'Payne', 'Nelson'),
('475764', 1, 1, 'Andrew', 'Ferguson', 'Mccoy'),
('476408', 1, 1, 'Andrew', 'Morgan', 'Ruiz'),
('481615', 2, 2, 'Stephen', 'Johnson', 'Phillips'),
('482466', 2, 2, 'Scott', 'Woods', 'Fuller'),
('484136', 1, 1, 'Jonathan', 'Barnes', 'Rice'),
('484395', 2, 2, 'Susan', 'Ford', 'Bryant'),
('484983', 2, 2, 'Amanda', 'Stephens', 'Porter'),
('485217', 1, 1, 'Earl', 'Price', 'Hansen'),
('485392', 2, 2, 'Phillip', 'Lane', 'Nichols'),
('486968', 1, 1, 'Terry', 'Morgan', 'Wells'),
('487421', 1, 1, 'Nicholas', 'Fields', 'Romero'),
('489184', 2, 2, 'Howard', 'Bryant', 'Bowman'),
('489232', 2, 2, 'Carlos', 'Flores', 'Garza'),
('490580', 1, 1, 'Fred', 'Martinez', 'Coleman'),
('490643', 2, 2, 'Mark', 'Myers', 'White'),
('495242', 1, 1, 'Lori', 'Hill', 'Greene'),
('496539', 1, 1, 'James', 'West', 'Sims'),
('496702', 1, 1, 'Howard', 'Burton', 'Chavez'),
('499852', 2, 2, 'Jose', 'Gibson', 'Phillips'),
('500478', 1, 1, 'Virginia', 'Peterson', 'Freeman'),
('501133', 2, 2, 'Donald', 'Hall', 'Castillo'),
('502256', 2, 2, 'Jesse', 'Mills', 'Mills'),
('502684', 2, 2, 'Phillip', 'Hicks', 'Fields'),
('504055', 2, 2, 'Kelly', 'Medina', 'Hicks'),
('504150', 2, 2, 'Maria', 'Willis', 'Armstrong'),
('505396', 2, 2, 'Wanda', 'Porter', 'Dunn'),
('505928', 1, 1, 'Debra', 'Martinez', 'Ward'),
('508062', 1, 1, 'Larry', 'Wagner', 'Duncan'),
('508637', 2, 2, 'Ruby', 'Hicks', 'Jenkins'),
('508742', 1, 1, 'Michael', 'Knight', 'Gray'),
('510905', 2, 2, 'Philip', 'Webb', 'Morrison'),
('511496', 1, 1, 'Wayne', 'Stone', 'Ward'),
('513771', 1, 1, 'Emily', 'Fox', 'Mills'),
('513797', 1, 1, 'Philip', 'Schmidt', 'Sanchez'),
('513954', 1, 1, 'Heather', 'Cox', 'Stewart'),
('516062', 1, 1, 'Jean', 'Turner', 'Hernandez'),
('516428', 1, 1, 'Beverly', 'Payne', 'Day'),
('516762', 1, 1, 'Martha', 'Ferguson', 'Cole'),
('518375', 1, 1, 'Robin', 'Gonzales', 'Lane'),
('518448', 1, 1, 'Tammy', 'Parker', 'Sanchez'),
('518711', 2, 2, 'Mary', 'Butler', 'Hunter'),
('519093', 2, 2, 'Jonathan', 'Wilson', 'Kelly'),
('520477', 1, 1, 'Larry', 'Sanchez', 'Thomas'),
('523570', 2, 2, 'Evelyn', 'Hamilton', 'Dixon'),
('524614', 2, 2, 'Frank', 'Price', 'Boyd'),
('524896', 3, 3, 'Abu Sayyaf', 'Abu', 'Fayyas'),
('525176', 2, 2, 'Lisa', 'Williamson', 'Brown'),
('527269', 2, 2, 'Willie', 'Sims', 'Owens'),
('527764', 2, 2, 'Kimberly', 'Ellis', 'Moore'),
('530099', 1, 1, 'Jack', 'Daniels', 'Bishop'),
('530127', 1, 1, 'Ralph', 'Jackson', 'Sullivan'),
('530486', 1, 1, 'Harold', 'Robertson', 'Mendoza'),
('531567', 1, 1, 'Marilyn', 'Payne', 'Hall'),
('532774', 1, 1, 'Kenneth', 'Crawford', 'Meyer'),
('534060', 1, 1, 'Norma', 'Cunningham', 'Stewart'),
('535393', 2, 2, 'Harry', 'Lawson', 'Bowman'),
('535517', 2, 2, 'Roy', 'Myers', 'Hansen'),
('537416', 2, 2, 'John', 'Garcia', 'Montgomery'),
('538429', 2, 2, 'Diane', 'Black', 'Harrison'),
('539479', 1, 1, 'Jeremy', 'Morgan', 'Gonzalez'),
('542670', 1, 1, 'Edward', 'Foster', 'Payne'),
('543089', 2, 2, 'Sarah', 'Brown', 'Rogers'),
('543868', 2, 2, 'Adam', 'Kennedy', 'Lane'),
('545695', 2, 2, 'Charles', 'Reid', 'Carroll'),
('547404', 1, 1, 'Benjamin', 'Miller', 'Reyes'),
('547495', 1, 1, 'Mildred', 'Daniels', 'Cruz'),
('548259', 1, 1, 'Katherine', 'Kelley', 'Ramos'),
('548704', 2, 2, 'Joyce', 'Price', 'Larson'),
('552425', 1, 1, 'Shirley', 'Sims', 'Carpenter'),
('552755', 1, 1, 'Jean', 'Moreno', 'Baker'),
('554881', 1, 1, 'Virginia', 'Hamilton', 'Stevens'),
('555274', 2, 2, 'Susan', 'Spencer', 'Gonzales'),
('555369', 1, 1, 'Adam', 'Garrett', 'Snyder'),
('555641', 2, 2, 'Larry', 'Stevens', 'Chavez'),
('559439', 2, 2, 'Donna', 'Lane', 'Lopez'),
('560255', 1, 1, 'Timothy', 'George', 'Watkins'),
('561427', 1, 1, 'Timothy', 'Phillips', 'Rose'),
('563244', 2, 2, 'Angela', 'White', 'Banks'),
('563745', 1, 1, 'Stephen', 'Cruz', 'Foster'),
('564338', 2, 2, 'Louise', 'Reyes', 'Woods'),
('565103', 1, 1, 'Julia', 'Ford', 'Jordan'),
('566633', 2, 2, 'Lawrence', 'Adams', 'Schmidt'),
('568251', 2, 2, 'Julia', 'Gardner', 'Russell'),
('570084', 1, 1, 'Julia', 'Taylor', 'Lane'),
('570247', 1, 1, 'Joseph', 'Ward', 'Wright'),
('572882', 2, 2, 'Angela', 'Oliver', 'Clark'),
('573252', 2, 2, 'Wayne', 'Diaz', 'Rose'),
('574095', 2, 2, 'Gloria', 'Gilbert', 'Turner'),
('574577', 1, 1, 'Joe', 'Harper', 'Bailey'),
('577894', 1, 1, 'Maria', 'Fowler', 'Sims'),
('577999', 1, 1, 'Paul', 'Parker', 'Diaz'),
('578727', 1, 1, 'Johnny', 'Stone', 'Meyer'),
('579495', 1, 1, 'Dennis', 'Perry', 'Lee'),
('580572', 2, 2, 'Heather', 'Lawson', 'Dixon'),
('580902', 2, 2, 'Roger', 'Elliott', 'Castillo'),
('581673', 2, 2, 'Bruce', 'Webb', 'Thompson'),
('581996', 2, 2, 'Janice', 'Lawrence', 'Romero'),
('582241', 2, 2, 'Donna', 'Ross', 'Perez'),
('583256', 1, 1, 'Janet', 'Mcdonald', 'Oliver'),
('584836', 1, 1, 'Laura', 'Montgomery', 'Schmidt'),
('585323', 1, 1, 'Emily', 'Collins', 'Owens'),
('586127', 1, 1, 'Susan', 'James', 'Cooper'),
('587826', 2, 2, 'Aaron', 'West', 'Medina'),
('588234', 2, 2, 'Patricia', 'Sanders', 'Foster'),
('590188', 2, 2, 'Bobby', 'Rogers', 'Hanson'),
('590269', 1, 1, 'Jessica', 'Reyes', 'Evans'),
('591418', 2, 2, 'Earl', 'Garrett', 'Sullivan'),
('594051', 1, 1, 'Peter', 'Boyd', 'Mcdonald'),
('594277', 1, 1, 'Emily', 'Wilson', 'Stewart'),
('594831', 2, 2, 'Lillian', 'Ruiz', 'Stanley'),
('597251', 2, 2, 'Joe', 'Montgomery', 'Stevens'),
('597308', 2, 2, 'Roy', 'Harris', 'King'),
('598001', 2, 2, 'Craig', 'Montgomery', 'James'),
('598720', 1, 1, 'Frances', 'Hughes', 'Robertson'),
('598963', 2, 2, 'Annie', 'Ellis', 'Stewart'),
('600142', 1, 1, 'Helen', 'Knight', 'Perez'),
('601174', 1, 1, 'Antonio', 'Rose', 'Bradley'),
('602198', 2, 2, 'Bonnie', 'Morris', 'Holmes'),
('602874', 2, 2, 'Justin', 'Stevens', 'Fox'),
('603064', 1, 1, 'Nancy', 'Wagner', 'Alvarez'),
('603301', 1, 1, 'Evelyn', 'Alvarez', 'Watson'),
('604371', 1, 1, 'Linda', 'Bowman', 'Myers'),
('604757', 1, 1, 'Ruby', 'Ford', 'Ramos'),
('605657', 2, 2, 'Roger', 'Perez', 'Fowler'),
('605819', 2, 2, 'Shirley', 'Mitchell', 'Arnold'),
('606006', 2, 2, 'Roy', 'Matthews', 'Johnston'),
('607301', 1, 1, 'Jack', 'Franklin', 'Wells'),
('607991', 1, 1, 'Ann', 'Cook', 'Greene'),
('607998', 1, 1, 'Joseph', 'Bennett', 'Sanchez'),
('609486', 1, 1, 'Jose', 'Hart', 'Miller'),
('610634', 2, 2, 'Ernest', 'Mcdonald', 'Carroll'),
('610734', 1, 1, 'Marie', 'Perez', 'Ryan'),
('611332', 2, 2, 'Julia', 'Garza', 'Freeman'),
('611877', 1, 1, 'Beverly', 'Jacobs', 'Ray'),
('612508', 2, 2, 'Donna', 'Cunningham', 'Ruiz'),
('612795', 2, 2, 'Heather', 'Meyer', 'Foster'),
('614541', 2, 2, 'Betty', 'Sullivan', 'Weaver'),
('619573', 1, 1, 'Jesse', 'Tucker', 'Hall'),
('620672', 2, 2, 'Nicholas', 'Harrison', 'Gomez'),
('620708', 1, 1, 'Steve', 'Simmons', 'Watson'),
('621172', 2, 2, 'Dennis', 'Morgan', 'Coleman'),
('623349', 1, 1, 'Doris', 'Meyer', 'Elliott'),
('623775', 1, 1, 'Ernest', 'Larson', 'Sanders'),
('624976', 2, 2, 'Diana', 'Williams', 'Rice'),
('625943', 1, 1, 'Jennifer', 'Fisher', 'Rogers'),
('628692', 2, 2, 'Albert', 'Robertson', 'Morris'),
('629354', 2, 2, 'Charles', 'Richards', 'Black'),
('630374', 2, 2, 'Anthony', 'Peters', 'Lopez'),
('631088', 2, 2, 'Kimberly', 'Matthews', 'Myers'),
('631413', 2, 2, 'Gloria', 'Stevens', 'Cole'),
('631755', 2, 2, 'Aaron', 'Butler', 'Hill'),
('631794', 1, 1, 'Jack', 'Lee', 'Murray'),
('632702', 1, 1, 'Larry', 'Dunn', 'Warren'),
('634443', 1, 1, 'Howard', 'Garza', 'Larson'),
('637114', 1, 1, 'Ann', 'Williamson', 'Medina'),
('643036', 1, 1, 'Julia', 'Flores', 'Stephens'),
('645309', 1, 1, 'Dorothy', 'Fisher', 'Andrews'),
('646723', 2, 2, 'Jeffrey', 'Palmer', 'Freeman'),
('648145', 2, 2, 'Julie', 'Jacobs', 'Peters'),
('648351', 2, 2, 'Michelle', 'Matthews', 'Duncan'),
('648634', 2, 2, 'Diane', 'Jordan', 'Moore'),
('648938', 1, 1, 'Ryan', 'Elliott', 'Nelson'),
('651965', 2, 2, 'Carol', 'Cook', 'Wagner'),
('653048', 2, 2, 'Frances', 'Scott', 'Mcdonald'),
('655019', 1, 1, 'Heather', 'Green', 'Thompson'),
('657158', 1, 1, 'Rose', 'Simpson', 'Jones'),
('657395', 1, 1, 'Richard', 'Morales', 'Andrews'),
('657997', 1, 1, 'Sarah', 'Holmes', 'Stewart'),
('659064', 1, 1, 'Victor', 'Alvarez', 'Dunn'),
('660921', 2, 2, 'Cynthia', 'Garcia', 'Mitchell'),
('662116', 1, 1, 'Gary', 'Ward', 'Howard'),
('662208', 1, 1, 'Gloria', 'Myers', 'Armstrong'),
('667109', 1, 1, 'Johnny', 'Lynch', 'Butler'),
('668031', 1, 1, 'Billy', 'Burns', 'Knight'),
('668481', 1, 1, 'Russell', 'Bradley', 'Butler'),
('668884', 2, 2, 'Julie', 'Burke', 'Gonzalez'),
('669965', 1, 1, 'Janice', 'Gardner', 'Martin'),
('670005', 1, 1, 'Anthony', 'Armstrong', 'Sanders'),
('670312', 1, 1, 'Pamela', 'Harris', 'Hernandez'),
('670351', 2, 2, 'Willie', 'Hughes', 'Morgan'),
('670718', 1, 1, 'Melissa', 'Long', 'Barnes'),
('672852', 1, 1, 'Jesse', 'Jackson', 'Green'),
('672868', 2, 2, 'Kathryn', 'Allen', 'Daniels'),
('674189', 1, 1, 'Alice', 'Harper', 'Adams'),
('674674', 1, 1, 'Teresa', 'Larson', 'Welch'),
('675899', 1, 1, 'Todd', 'Chapman', 'Austin'),
('676126', 2, 2, 'Jerry', 'Walker', 'Bryant'),
('676975', 2, 2, 'Eugene', 'Armstrong', 'Jackson'),
('678010', 2, 2, 'Kathryn', 'West', 'West'),
('678308', 2, 2, 'Randy', 'Watson', 'Richards'),
('680013', 2, 2, 'Thomas', 'Ortiz', 'Robinson'),
('680415', 2, 2, 'Joseph', 'Berry', 'Stephens'),
('681907', 1, 1, 'Doris', 'Welch', 'Gilbert'),
('683623', 1, 1, 'Jacqueline', 'Foster', 'Alvarez'),
('684185', 1, 1, 'Juan', 'Hamilton', 'Smith'),
('687200', 2, 2, 'Jose', 'Berry', 'Carroll'),
('687632', 1, 1, 'Aaron', 'Shaw', 'Peterson'),
('687656', 2, 2, 'Joshua', 'Howell', 'Robertson'),
('689811', 1, 1, 'Stephanie', 'Watkins', 'Hansen'),
('689913', 1, 1, 'Amanda', 'Burns', 'Jordan'),
('691617', 1, 1, 'Judith', 'Powell', 'Elliott'),
('692000', 2, 2, 'Ashley', 'Stanley', 'Lee'),
('692561', 1, 1, 'Chris', 'Ryan', 'Lynch'),
('693571', 2, 2, 'Theresa', 'Bryant', 'Williamson'),
('695839', 2, 2, 'Theresa', 'Tucker', 'Jones'),
('696560', 1, 1, 'Gloria', 'Weaver', 'Montgomery'),
('696999', 1, 1, 'Denise', 'Wilson', 'Alvarez'),
('698453', 2, 2, 'Gary', 'Simmons', 'Hanson'),
('698742', 1, 1, 'Jeremy', 'Carr', 'Bailey'),
('698769', 1, 1, 'Wanda', 'Taylor', 'Bailey'),
('703957', 2, 2, 'Cynthia', 'Sims', 'Kim'),
('704837', 1, 1, 'Kathryn', 'Jenkins', 'Hanson'),
('708606', 2, 2, 'Michael', 'Fox', 'Sullivan'),
('709727', 1, 1, 'Lori', 'Mason', 'Schmidt'),
('710152', 1, 1, 'Larry', 'Marshall', 'Burns'),
('711481', 2, 2, 'Terry', 'Morgan', 'Austin'),
('712184', 2, 2, 'Jeffrey', 'Morales', 'Harris'),
('712875', 1, 1, 'Anna', 'Cruz', 'Williams'),
('714283', 1, 1, 'Ruth', 'Brooks', 'Gardner'),
('714310', 2, 2, 'Helen', 'Medina', 'Jacobs'),
('714531', 2, 2, 'Stephen', 'Ellis', 'Oliver'),
('715222', 1, 1, 'Dennis', 'Cox', 'Sims'),
('716983', 1, 1, 'Pamela', 'Ray', 'Turner'),
('717500', 2, 2, 'Kevin', 'George', 'Hunt'),
('718125', 2, 2, 'Samuel', 'Welch', 'Vasquez'),
('719845', 2, 2, 'Martha', 'Rose', 'Morgan'),
('719925', 1, 1, 'Ruby', 'Sanders', 'Gonzales'),
('720230', 2, 2, 'Willie', 'Ferguson', 'Elliott'),
('721634', 1, 1, 'Nicole', 'Coleman', 'Nelson'),
('722980', 2, 2, 'Kathy', 'Rivera', 'Murphy'),
('724864', 2, 2, 'Scott', 'Mason', 'Simmons'),
('724894', 2, 2, 'Wayne', 'Reid', 'Diaz'),
('725740', 2, 2, 'Roger', 'Morrison', 'Foster'),
('727620', 1, 1, 'Frances', 'Torres', 'Gonzales'),
('729384', 2, 2, 'Michael', 'Jordan', 'Day'),
('729415', 1, 1, 'Julie', 'Coleman', 'Jacobs'),
('731854', 2, 2, 'Norma', 'Jacobs', 'Banks'),
('732260', 2, 2, 'Bonnie', 'Lopez', 'Perez'),
('734570', 2, 2, 'Tina', 'Gibson', 'Lynch'),
('737149', 2, 2, 'Andrew', 'Porter', 'Collins'),
('737420', 2, 2, 'Evelyn', 'West', 'Perkins'),
('739181', 1, 1, 'Elizabeth', 'Wilson', 'Chapman'),
('739658', 1, 1, 'Rebecca', 'Taylor', 'Pierce'),
('739765', 1, 1, 'Paul', 'Sims', 'Morris'),
('740517', 2, 2, 'Chris', 'Torres', 'Ward'),
('741139', 1, 1, 'Theresa', 'Franklin', 'Romero'),
('745077', 2, 2, 'Ernest', 'Ramos', 'Peters'),
('745253', 2, 2, 'Jane', 'Hicks', 'Thompson'),
('746132', 2, 2, 'Alice', 'Castillo', 'Harper'),
('746738', 1, 1, 'Harold', 'Gonzalez', 'Sullivan'),
('747683', 1, 1, 'Willie', 'Gardner', 'Robertson'),
('749061', 1, 1, 'Joyce', 'Howell', 'Ross'),
('751123', 1, 1, 'Joyce', 'Gutierrez', 'Scott'),
('753759', 1, 1, 'Ronald', 'Rogers', 'Anderson'),
('754742', 1, 1, 'Wanda', 'West', 'Washington'),
('756353', 1, 1, 'Jason', 'Fields', 'Johnston'),
('758310', 1, 1, 'Juan', 'Gutierrez', 'Henry'),
('758320', 2, 2, 'Nicholas', 'Gomez', 'Hicks'),
('759138', 1, 1, 'Gregory', 'Hughes', 'Williams'),
('759404', 1, 1, 'Adam', 'Kelley', 'Rose'),
('761532', 1, 1, 'Todd', 'Hudson', 'Reid'),
('761799', 1, 1, 'Joan', 'Kelly', 'Garza'),
('763335', 2, 2, 'Doris', 'Harper', 'Baker'),
('763583', 1, 1, 'Judy', 'Morales', 'Jordan'),
('765007', 2, 2, 'Bonnie', 'Wallace', 'Stewart'),
('765899', 1, 1, 'Mark', 'Lewis', 'Jones'),
('767415', 2, 2, 'Douglas', 'Adams', 'Perry'),
('768483', 2, 2, 'Roy', 'Hunt', 'Oliver'),
('770461', 2, 2, 'Anna', 'Mason', 'Frazier'),
('773489', 1, 1, 'Janet', 'Rivera', 'Webb'),
('773646', 2, 2, 'Gregory', 'Fernandez', 'Cunningham'),
('774541', 2, 2, 'Betty', 'Wallace', 'Smith'),
('774701', 2, 2, 'Keith', 'Williamson', 'Hall'),
('776197', 1, 1, 'Brian', 'Fox', 'Rogers'),
('778171', 1, 1, 'Jacqueline', 'Jones', 'Murray'),
('779079', 1, 1, 'Teresa', 'Lewis', 'Gordon'),
('779122', 2, 2, 'Melissa', 'Burke', 'Owens'),
('780534', 2, 2, 'Cheryl', 'King', 'Grant'),
('781275', 2, 2, 'Ann', 'Matthews', 'Webb'),
('781326', 1, 1, 'Cynthia', 'Bishop', 'Simpson'),
('782824', 2, 2, 'Martin', 'Lewis', 'Dixon'),
('788248', 2, 2, 'George', 'Hanson', 'Hicks'),
('788369', 1, 1, 'Jacqueline', 'Ramirez', 'Snyder'),
('789055', 2, 2, 'Amanda', 'Moore', 'Little'),
('793254', 1, 1, 'Gloria', 'Reed', 'Foster'),
('796443', 1, 1, 'Gary', 'Myers', 'Moreno'),
('799430', 2, 2, 'Rachel', 'Little', 'Ray'),
('799619', 2, 2, 'Louis', 'Wood', 'Davis'),
('800442', 2, 2, 'John', 'Rose', 'Burke'),
('800622', 1, 1, 'Barbara', 'Moore', 'Miller'),
('802295', 2, 2, 'John', 'Sanders', 'Brooks'),
('803011', 2, 2, 'Janet', 'Banks', 'Grant'),
('803940', 1, 1, 'Clarence', 'Matthews', 'Hill'),
('804355', 1, 1, 'Paul', 'Nguyen', 'Hicks'),
('805062', 2, 2, 'Ruth', 'Long', 'Simmons'),
('807419', 1, 1, 'Ryan', 'Patterson', 'Marshall'),
('807664', 2, 2, 'Frank', 'Hall', 'Rose'),
('807666', 2, 2, 'Norma', 'Roberts', 'George'),
('807806', 2, 2, 'Todd', 'Grant', 'Gutierrez'),
('808273', 2, 2, 'Patrick', 'Banks', 'Fisher'),
('808391', 2, 2, 'Rebecca', 'Young', 'Peterson'),
('808616', 2, 2, 'Katherine', 'Wright', 'Ramirez'),
('809180', 1, 1, 'Randy', 'Brown', 'Anderson'),
('809214', 2, 2, 'Johnny', 'Dunn', 'Bryant'),
('809387', 1, 1, 'Diana', 'Meyer', 'Phillips'),
('814268', 2, 2, 'Carolyn', 'Howard', 'Holmes'),
('815094', 2, 2, 'Joseph', 'Collins', 'Gonzales'),
('815158', 2, 2, 'Henry', 'Cook', 'Young'),
('815724', 2, 2, 'Gloria', 'Shaw', 'Butler'),
('816281', 1, 1, 'Howard', 'Hall', 'Holmes'),
('818073', 1, 1, 'Jacqueline', 'Mcdonald', 'Ross'),
('818308', 2, 2, 'Victor', 'Smith', 'Vasquez'),
('819780', 2, 2, 'Juan', 'Warren', 'Ford'),
('821872', 1, 1, 'Philip', 'Simpson', 'Woods'),
('822952', 2, 2, 'Gerald', 'Roberts', 'James'),
('823289', 2, 2, 'Kenneth', 'Crawford', 'Peterson'),
('825670', 1, 1, 'Sara', 'Wallace', 'Jacobs'),
('826930', 2, 2, 'Cheryl', 'Campbell', 'Alexander'),
('827956', 2, 2, 'Kimberly', 'Matthews', 'Lynch'),
('829468', 2, 2, 'Jason', 'Ramos', 'Hicks'),
('831605', 2, 2, 'Beverly', 'Matthews', 'Sanchez'),
('831872', 1, 1, 'Kelly', 'Payne', 'Ramos'),
('831985', 2, 2, 'David', 'Grant', 'Porter'),
('833949', 1, 1, 'Larry', 'Williamson', 'Black'),
('834486', 1, 1, 'Aaron', 'Carter', 'Mcdonald'),
('835960', 2, 2, 'Paula', 'Burke', 'Allen'),
('836458', 2, 2, 'Joshua', 'Murray', 'Banks'),
('841932', 1, 1, 'Heather', 'Murphy', 'Carpenter'),
('842979', 1, 1, 'Dennis', 'Nichols', 'Simpson'),
('843160', 1, 1, 'Ashley', 'Allen', 'Hansen'),
('844805', 1, 1, 'John', 'Boyd', 'Arnold'),
('845562', 2, 2, 'Jack', 'Johnson', 'Payne'),
('846740', 1, 1, 'Anne', 'Murphy', 'Elliott'),
('848303', 2, 2, 'Ashley', 'Harrison', 'Howard'),
('849033', 1, 1, 'Frank', 'Parker', 'Evans'),
('850345', 1, 1, 'Evelyn', 'Murray', 'Burke'),
('851899', 2, 2, 'Angela', 'Griffin', 'Coleman'),
('853768', 1, 1, 'Douglas', 'Sanchez', 'Hart'),
('854164', 1, 1, 'Roger', 'Johnston', 'Meyer'),
('854862', 2, 2, 'Ralph', 'Barnes', 'Walker'),
('856996', 1, 1, 'Raymond', 'Foster', 'Ellis'),
('860639', 2, 2, 'Cynthia', 'Adams', 'Price'),
('861918', 2, 2, 'Phyllis', 'Cook', 'Bishop'),
('863384', 1, 1, 'Louise', 'Garza', 'Collins'),
('863529', 1, 1, 'Rose', 'Morris', 'Bishop'),
('865505', 2, 2, 'Melissa', 'Lopez', 'Mendoza'),
('867509', 2, 2, 'Carol', 'Chavez', 'Williamson'),
('867572', 2, 2, 'Craig', 'Powell', 'Watkins'),
('867993', 2, 2, 'David', 'Snyder', 'Rogers'),
('868980', 1, 1, 'Wayne', 'Ellis', 'Ellis'),
('869302', 2, 2, 'Patricia', 'Fuller', 'Collins'),
('872374', 2, 2, 'Robert', 'Davis', 'Black'),
('872560', 1, 1, 'Sharon', 'Clark', 'Miller'),
('872570', 1, 1, 'Ralph', 'Payne', 'Willis'),
('876398', 1, 1, 'Justin', 'Hawkins', 'Black'),
('878320', 2, 2, 'Timothy', 'Evans', 'Carr'),
('879468', 1, 1, 'Jason', 'West', 'Pierce'),
('882231', 2, 2, 'Carolyn', 'Henderson', 'Martin'),
('882541', 2, 2, 'Gloria', 'Mills', 'Fox'),
('883874', 2, 2, 'Evelyn', 'Cunningham', 'Bell'),
('884753', 2, 2, 'Harry', 'Hall', 'Pierce'),
('885379', 1, 1, 'Charles', 'Edwards', 'Roberts'),
('885525', 1, 1, 'Annie', 'Rice', 'Harper'),
('885632', 1, 1, 'Margaret', 'Phillips', 'Banks'),
('885761', 1, 1, 'Jean', 'Snyder', 'Fields'),
('887693', 1, 1, 'Amy', 'Smith', 'Medina'),
('888758', 2, 2, 'Jerry', 'Wagner', 'Fuller'),
('891043', 1, 1, 'Martin', 'Allen', 'Nelson'),
('892519', 2, 2, 'Carlos', 'Mills', 'Nelson'),
('893126', 2, 2, 'Phyllis', 'Hart', 'Patterson'),
('894582', 1, 1, 'Amy', 'Rogers', 'Smith'),
('896189', 1, 1, 'Harry', 'Howell', 'Brown'),
('896467', 1, 1, 'Sara', 'Johnston', 'Edwards'),
('897167', 2, 2, 'Ryan', 'Henry', 'Ferguson'),
('897259', 2, 2, 'Tammy', 'Jenkins', 'Grant'),
('898336', 1, 1, 'Joshua', 'Bailey', 'Rose'),
('903559', 2, 2, 'Michael', 'Hayes', 'Cox'),
('904175', 2, 2, 'Diana', 'Spencer', 'Elliott'),
('904950', 1, 1, 'Alan', 'Frazier', 'Garrett'),
('911831', 1, 1, 'Roy', 'Lane', 'Moreno'),
('911841', 1, 1, 'Alice', 'White', 'Lopez'),
('912829', 2, 2, 'Edward', 'Ford', 'Bennett'),
('913771', 1, 1, 'Nicholas', 'Myers', 'Walker'),
('915330', 2, 2, 'Martin', 'Gray', 'Nguyen'),
('916301', 2, 2, 'Clarence', 'Hunt', 'Hall'),
('917315', 2, 2, 'Steven', 'Lawson', 'Dixon'),
('917594', 1, 1, 'Bobby', 'Howard', 'Perez'),
('919896', 2, 2, 'Douglas', 'Bradley', 'Larson'),
('921119', 1, 1, 'Walter', 'Fernandez', 'Burton'),
('923822', 1, 1, 'Lori', 'Stewart', 'Martin'),
('924930', 2, 2, 'Terry', 'Kim', 'Peterson'),
('925992', 2, 2, 'Tina', 'Morgan', 'Smith'),
('926031', 1, 1, 'Marie', 'Harvey', 'Diaz'),
('926874', 2, 2, 'Jack', 'Powell', 'Diaz'),
('927850', 1, 1, 'Judy', 'Cruz', 'Cole'),
('930138', 2, 2, 'Susan', 'Richardson', 'Alexander'),
('932309', 2, 2, 'Marilyn', 'Ross', 'West'),
('934719', 1, 1, 'Andrea', 'Schmidt', 'Howell'),
('934747', 2, 2, 'Martin', 'Hanson', 'Elliott'),
('934812', 1, 1, 'Todd', 'Sims', 'Harris'),
('935206', 1, 1, 'Craig', 'Simmons', 'Elliott'),
('935377', 2, 2, 'Betty', 'Medina', 'Lewis'),
('940972', 1, 1, 'Louis', 'Watkins', 'Rodriguez'),
('940991', 2, 2, 'Margaret', 'Smith', 'King'),
('942469', 2, 2, 'Deborah', 'Peterson', 'Young'),
('942869', 2, 2, 'Terry', 'Ellis', 'Berry'),
('943328', 2, 2, 'Aaron', 'Price', 'Hunt'),
('945087', 1, 1, 'Alice', 'Chapman', 'Bryant'),
('946031', 1, 1, 'Richard', 'Hunter', 'Stewart'),
('949262', 1, 1, 'Jonathan', 'White', 'Long'),
('950382', 2, 2, 'Susan', 'Robinson', 'Torres'),
('951057', 1, 1, 'Deborah', 'Spencer', 'Jackson'),
('955426', 2, 2, 'Bobby', 'Jacobs', 'Vasquez'),
('956041', 2, 2, 'Joyce', 'Peterson', 'Martinez'),
('957892', 2, 2, 'Gloria', 'Castillo', 'Washington'),
('958670', 2, 2, 'Matthew', 'Kelley', 'Jackson'),
('958851', 1, 1, 'Donna', 'Reynolds', 'Harris'),
('959044', 2, 2, 'Lois', 'Gomez', 'Phillips'),
('960318', 2, 2, 'Jack', 'Stephens', 'Payne'),
('962310', 2, 2, 'Joyce', 'Wilson', 'Lawson'),
('962398', 1, 1, 'Patrick', 'Wheeler', 'Morales'),
('963544', 2, 2, 'Benjamin', 'Willis', 'Green'),
('963704', 2, 2, 'Samuel', 'Boyd', 'Burton'),
('964164', 1, 1, 'Juan', 'Anderson', 'Armstrong'),
('965104', 1, 1, 'Donald', 'Cooper', 'Knight'),
('965107', 2, 2, 'Steven', 'Perkins', 'Diaz'),
('965562', 1, 1, 'Walter', 'Ellis', 'Gardner'),
('965681', 2, 2, 'Irene', 'Elliott', 'Dunn'),
('966104', 2, 2, 'Deborah', 'Phillips', 'Myers'),
('966537', 2, 2, 'Gary', 'Woods', 'Patterson'),
('966789', 1, 1, 'Annie', 'Greene', 'Armstrong'),
('967588', 1, 1, 'Joe', 'Peters', 'Oliver'),
('968921', 1, 1, 'Paula', 'Russell', 'Daniels'),
('970339', 2, 2, 'Jeffrey', 'Rice', 'Gutierrez'),
('970743', 2, 2, 'Donald', 'Webb', 'Morales'),
('970926', 1, 1, 'Walter', 'Martinez', 'Mitchell'),
('971831', 1, 1, 'Ann', 'Fowler', 'Garcia'),
('971844', 1, 1, 'Cheryl', 'Ray', 'Hayes'),
('972242', 2, 2, 'Lawrence', 'Payne', 'Ramirez'),
('972955', 1, 1, 'Lillian', 'Myers', 'Lopez'),
('977661', 1, 1, 'Patrick', 'Hughes', 'Fields'),
('977829', 1, 1, 'Patrick', 'Smith', 'Webb'),
('980541', 1, 1, 'John', 'Young', 'Moreno'),
('984628', 1, 1, 'Katherine', 'Lynch', 'Jones'),
('984782', 2, 2, 'Nicholas', 'Walker', 'Fields'),
('985549', 2, 2, 'Philip', 'Castillo', 'Cunningham'),
('985641', 1, 1, 'Kathleen', 'Dean', 'Cox'),
('986702', 1, 1, 'Betty', 'Wright', 'Hamilton'),
('987622', 2, 2, 'Nancy', 'Morgan', 'Gonzales'),
('988169', 1, 1, 'Steven', 'Pierce', 'Henry'),
('988489', 1, 1, 'Ann', 'Kim', 'Duncan'),
('988527', 2, 2, 'Jack', 'Jordan', 'Hunt'),
('988691', 2, 2, 'Frances', 'Ross', 'Mcdonald'),
('989393', 2, 2, 'Susan', 'Hunt', 'Collins'),
('989970', 1, 1, 'Donald', 'Martinez', 'Fox'),
('991648', 2, 2, 'Wayne', 'Mills', 'Johnson'),
('993128', 2, 2, 'Tina', 'Roberts', 'Wheeler'),
('993688', 2, 2, 'Howard', 'Hudson', 'Austin'),
('995880', 2, 2, 'Phillip', 'Little', 'Kim'),
('996655', 2, 2, 'Lillian', 'Grant', 'Spencer');

-- --------------------------------------------------------

--
-- Table structure for table `student_subjects`
--

CREATE TABLE `student_subjects` (
  `student_id` varchar(10) NOT NULL,
  `subject_id` int(10) UNSIGNED NOT NULL,
  `subject_remarks` text NOT NULL,
  `currently_enrolled` tinyint(1) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student_subjects`
--

INSERT INTO `student_subjects` (`student_id`, `subject_id`, `subject_remarks`, `currently_enrolled`) VALUES
('130365', 1, 'YToxOntpOjA7YToyOntzOjEwOiJkYXRlX2FkZGVkIjtzOjEwOiIwMy0xNy0yMDE3IjtzOjE1OiJzdWJqZWN0X3JlbWFya3MiO3M6NDoiUGFzcyI7fX0=', 0);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `subject_id` int(10) UNSIGNED NOT NULL,
  `course_code` varchar(50) NOT NULL,
  `descriptive_title` varchar(200) NOT NULL,
  `credit_units` tinyint(4) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subject_id`, `course_code`, `descriptive_title`, `credit_units`) VALUES
(1, 'ITE 111A', 'IT Fundamentals(Lecture)', 3),
(2, 'ITE 111B', 'IT Fundamentals(Laboratory)', 1),
(3, 'MATH 105', 'College Algebra', 3),
(4, 'SRA', 'Developmental Reading Lab', 3),
(5, 'FILI 112N', 'Komunikasyon sa Akademikong Filipino', 3),
(6, 'HIST 111', 'Survey of Philippine History', 3),
(7, 'PSYCH 111', 'General Psychology', 3),
(8, 'RS 111', 'Fundamentals of Christianity', 0),
(9, 'PE 112', 'Gymnastics. Self testing Activities with Health Education', 2),
(10, 'NSTP 1A', 'National Service Training Program 1', 3),
(11, 'ACM 11', 'Towards Effective Adjustment to College Life 1', 0),
(12, 'ITE 121', 'Fundamentals of Program Logic Formulation', 3),
(13, 'ITE 122', 'Discrete Structures', 3),
(14, 'MATH 115', 'Trigonometry', 3),
(15, 'ENGL 111', 'Communication Skills 1', 3),
(16, 'FILI 122N', 'Pagbasa at Pagsulat Tungo sa Pananaliksik', 3),
(17, 'ECON 111', 'Principles of Economics with Taxation', 3),
(18, 'RS 121', 'Jesus and His Message', 0),
(19, 'PE 122', 'Rhythmic Movements and Dance', 2),
(20, 'NSTP 1B', 'National Service Training Program 2', 3),
(21, 'ACM 12', 'Towards Effective Adjustment to College Life 2', 0),
(22, 'ITE 211', 'Advance Computer Programming', 3),
(23, 'ITE 212', 'Data Structures', 3),
(24, 'ITE 123', 'Human Computer Interaction', 3),
(25, 'ITE 213', 'Accounting Principles', 3),
(26, 'ENGL 121', 'Communication Skills II', 3),
(27, 'FILI 212N', 'Masining na Pagpapahayag', 3),
(28, 'RIZAL CRS', 'Rizal Life Works and Writings', 3),
(29, 'PHILO 110', 'Logic', 3),
(30, 'RS 211', 'Sacraments and Liturgy', 0),
(31, 'PE 212', 'Athletics/Group Games', 2),
(32, 'ITE 221', 'Object Oriented Programming', 3),
(33, 'ITE 222', 'Visual Programming', 3),
(34, 'ITE 311', 'Computer Organization and Assembly Language', 3),
(35, 'STAT 221', 'Probability and Statistics', 3),
(36, 'ENGL 211', 'Advance Grammar and Composition with Essay Writing', 3),
(37, 'CHEM 221N', 'Inorganic Chemistry', 4),
(38, 'PE 220', 'Athletics (Individual/Dual Sports)', 2),
(39, 'POLSCI 111', 'Fundamentals of Political Science (with Philippine Constitution/Geography)', 3),
(40, 'ITE 312', 'Database Management Systems 1', 3),
(41, 'ITE 321', 'Operating Systems', 3),
(42, 'ITE 223', 'Systems Analysis and Design', 3),
(43, 'SOCIO 123', 'Society and Culture (with Family Planning)', 3),
(44, 'PHYS 311N', 'College Physics', 4),
(45, 'ITE 322', 'Software Engineering', 3),
(46, 'ITE 323', 'Professional Ethics', 3),
(47, 'ITE 324', 'Web Programming', 3),
(48, 'ITE 325', 'Seminars and Field Trips', 3),
(49, 'ITE 326', 'Foreign Languages', 3),
(50, 'INFOTEC 311', 'Network Management', 3),
(51, 'INFOTEC 321', 'Database Management Systems 2', 3),
(52, 'SPEECH 112', 'Speech and Oral Communication, Public Speaking, Argumentation and Debate', 3),
(53, 'ITE 331', 'On-The-Job-Training', 9),
(54, 'INFOTEC 411', 'Multimedia Systems', 3),
(55, 'INFOTEC 412', 'Computer Graphics', 3),
(56, 'INFOTEC 413', '3D Modeling and Simulation', 3),
(57, 'INFOTEC 414', 'E-Business', 3),
(58, 'PEACE 100', 'Peace Education with Mindanao Education', 3),
(59, 'INFOTEC 421', 'Capstone Project (Technopreneurship)', 3),
(60, 'INFOTEC 422', 'Introduction to Games: Theory and Design', 3),
(61, 'HUM 411', 'Art Appreciation (with Beautification and Sanitation)', 3),
(62, 'LIT 112', 'Introduction to Literature with Philippine Literature', 3),
(64, 'LLB 01', 'Basic Law', 3),
(65, 'Fasdfasdf', 'sadfadfsdf', 3),
(66, 'qwe', 'qweqwe', 3),
(67, 'asdasdas', 'Dasdasda', 1),
(68, 'INFOTEC 423', 'Advanced Web Application', 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(128) NOT NULL,
  `user_registered` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `user_registered`) VALUES
(1, 'admin', '5af342a9d7c68f563e6a00e6f656c1d43976e3b9480c636020ba0706c529f0d7882f3b0de6b2c5871b548acdf78322fe13c419e427653bf02369f42d0e605145', '2017-01-16 12:57:44'),
(2, '130365', 'dcd9d409f3b1642b3c925b51b51393353c04364c58ea6578f31c2f2239a7a20c7d8c4e912a959e3735e3f760fecf94b0d8d6947c14831a8ad797045f7c15acda', '2017-01-16 12:57:44'),
(3, 'programhead', 'dcd9d409f3b1642b3c925b51b51393353c04364c58ea6578f31c2f2239a7a20c7d8c4e912a959e3735e3f760fecf94b0d8d6947c14831a8ad797045f7c15acda', '2017-01-16 12:57:44'),
(7, '996655', 'dcd9d409f3b1642b3c925b51b51393353c04364c58ea6578f31c2f2239a7a20c7d8c4e912a959e3735e3f760fecf94b0d8d6947c14831a8ad797045f7c15acda', '2017-01-16 13:10:34'),
(8, 'dean123', 'dcd9d409f3b1642b3c925b51b51393353c04364c58ea6578f31c2f2239a7a20c7d8c4e912a959e3735e3f760fecf94b0d8d6947c14831a8ad797045f7c15acda', '2017-01-16 21:06:07'),
(9, 'dean23', '1f66e3517d94148af8265f94483157465d62d273ef1700de8b62ae5225654372a692c613e0235f175921d051be3849b4b6451c8286b34ee65dd3fcd9dfa6a2e5', '2017-01-16 21:56:57'),
(10, '130061', 'dcd9d409f3b1642b3c925b51b51393353c04364c58ea6578f31c2f2239a7a20c7d8c4e912a959e3735e3f760fecf94b0d8d6947c14831a8ad797045f7c15acda', '2017-01-17 22:37:11'),
(11, 'maruko.aihara', 'dcd9d409f3b1642b3c925b51b51393353c04364c58ea6578f31c2f2239a7a20c7d8c4e912a959e3735e3f760fecf94b0d8d6947c14831a8ad797045f7c15acda', '2017-01-19 09:32:12'),
(12, '993688', '1f66e3517d94148af8265f94483157465d62d273ef1700de8b62ae5225654372a692c613e0235f175921d051be3849b4b6451c8286b34ee65dd3fcd9dfa6a2e5', '2017-01-23 11:14:15'),
(13, '060880', '991e936cb381ab708bb6cd07d1a31e3e7f04c419938ede4993023cfaee63111d988679a03bb18222b5a88a333f5099b45efc3105c84a0838e8dec4af13d55417', '2017-01-27 15:15:03');

-- --------------------------------------------------------

--
-- Table structure for table `users_meta`
--

CREATE TABLE `users_meta` (
  `umeta_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `meta_key` varchar(255) NOT NULL,
  `meta_value` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_meta`
--

INSERT INTO `users_meta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES
(1, 1, 'user_role', 'super_admin'),
(2, 1, 'user_role_description', 'Super Admin'),
(3, 1, 'user_capabilities', 'a:8:{i:0;s:22:"create_new_super_admin";i:1;s:15:"create_new_dean";i:2;s:23:"create_new_program_head";i:3;s:18:"create_new_student";i:4;s:18:"update_super_admin";i:5;s:11:"update_dean";i:6;s:19:"update_program_head";i:7;s:14:"update_student";}'),
(4, 1, 'first_name', 'Marrruwaa'),
(5, 1, 'last_name', 'Uttoski'),
(6, 2, 'user_role', 'student'),
(7, 2, 'user_role_description', 'Student'),
(8, 2, 'user_capabilities', 'a:1:{i:0;s:15:"view_curriculum";}'),
(9, 2, 'first_name', 'Eugene Essun'),
(10, 2, 'last_name', 'Oliveros'),
(11, 3, 'user_role', 'program_head'),
(12, 3, 'user_role_description', 'Program Head'),
(13, 3, 'user_capabilities', 'a:2:{i:0;s:18:"create_new_student";i:1;s:14:"update_student";}'),
(14, 3, 'first_name', 'Rodelyn'),
(15, 3, 'last_name', 'Garde'),
(22, 1, 'user_level', '10'),
(23, 2, 'user_level', '1'),
(24, 3, 'user_level', '3'),
(25, 7, 'user_role', 'student'),
(26, 7, 'user_role_description', 'Student'),
(27, 7, 'user_level', '1'),
(28, 7, 'user_capabilities', 'a:1:{i:0;s:15:"view_curriculum";}'),
(29, 7, 'first_name', 'Lillian'),
(30, 7, 'last_name', 'Grant'),
(31, 8, 'user_role', 'dean'),
(32, 8, 'user_role_description', 'Dean'),
(33, 8, 'user_level', '4'),
(34, 8, 'user_capabilities', 'a:4:{i:0;s:23:"create_new_program_head";i:1;s:18:"create_new_student";i:2;s:19:"update_program_head";i:3;s:14:"update_student";}'),
(35, 8, 'first_name', 'Martina'),
(36, 8, 'last_name', 'Tagacay'),
(37, 9, 'user_role', 'dean'),
(38, 9, 'user_role_description', 'Dean'),
(39, 9, 'user_level', '4'),
(40, 9, 'user_capabilities', 'a:4:{i:0;s:23:"create_new_program_head";i:1;s:18:"create_new_student";i:2;s:19:"update_program_head";i:3;s:14:"update_student";}'),
(41, 9, 'first_name', 'Martina'),
(42, 9, 'last_name', 'Tagacay'),
(43, 10, 'user_role', 'student'),
(44, 10, 'user_role_description', 'Student'),
(45, 10, 'user_level', '1'),
(46, 10, 'user_capabilities', 'a:1:{i:0;s:15:"view_curriculum";}'),
(47, 10, 'first_name', 'Maruko'),
(48, 10, 'last_name', 'Aihara'),
(49, 11, 'user_role', 'super_admin'),
(50, 11, 'user_role_description', 'Super Admin'),
(51, 11, 'user_level', '5'),
(52, 11, 'user_capabilities', 'a:8:{i:0;s:22:"create_new_super_admin";i:1;s:15:"create_new_dean";i:2;s:23:"create_new_program_head";i:3;s:18:"create_new_student";i:4;s:18:"update_super_admin";i:5;s:11:"update_dean";i:6;s:19:"update_program_head";i:7;s:14:"update_student";}'),
(53, 11, 'first_name', 'Maruko'),
(54, 11, 'last_name', 'Aihara'),
(55, 12, 'user_role', 'student'),
(56, 12, 'user_role_description', 'Student'),
(57, 12, 'user_level', '1'),
(58, 12, 'user_capabilities', 'a:1:{i:0;s:15:"view_curriculum";}'),
(59, 12, 'first_name', 'Howard'),
(60, 12, 'last_name', 'Hudson'),
(61, 13, 'user_role', 'student'),
(62, 13, 'user_role_description', 'Student'),
(63, 13, 'user_level', '1'),
(64, 13, 'user_capabilities', 'a:1:{i:0;s:15:"view_curriculum";}'),
(65, 13, 'first_name', 'Johaira'),
(66, 13, 'last_name', 'Lidasan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `college`
--
ALTER TABLE `college`
  ADD PRIMARY KEY (`college_id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `course_curriculum`
--
ALTER TABLE `course_curriculum`
  ADD PRIMARY KEY (`course_curriculum_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `curriculum_subjects`
--
ALTER TABLE `curriculum_subjects`
  ADD KEY `course_curriculum_id` (`course_curriculum_id`,`subject_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`department_id`),
  ADD KEY `college_id` (`college_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `student_subjects`
--
ALTER TABLE `student_subjects`
  ADD KEY `student_id` (`student_id`,`subject_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`subject_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `users_meta`
--
ALTER TABLE `users_meta`
  ADD PRIMARY KEY (`umeta_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `college`
--
ALTER TABLE `college`
  MODIFY `college_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `course_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `course_curriculum`
--
ALTER TABLE `course_curriculum`
  MODIFY `course_curriculum_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `department_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `subject_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `users_meta`
--
ALTER TABLE `users_meta`
  MODIFY `umeta_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
