-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2024 at 10:04 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms_ineza_eliane_222014600`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `ID` int(10) NOT NULL,
  `AppointimentDate` date DEFAULT NULL,
  `AppointmentTime` time DEFAULT NULL,
  `Patient` int(11) DEFAULT NULL,
  `Clinic` int(11) DEFAULT NULL,
  `Doctor` int(11) DEFAULT NULL,
  `ReasonAppointment` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`ID`, `AppointimentDate`, `AppointmentTime`, `Patient`, `Clinic`, `Doctor`, `ReasonAppointment`) VALUES
(1, '2004-06-16', '10:17:00', 7, 1, 8, 'Operation'),
(2, '2024-04-10', '01:00:00', 7, 4, 6, 'Operation'),
(3, '2024-04-10', '01:00:00', 7, 4, 6, 'Operation'),
(4, '2024-04-10', '01:00:00', 7, 4, 6, 'Operation'),
(5, '2024-04-12', '02:00:00', 2, 1, 8, 'Operation'),
(6, '2024-04-02', '00:00:00', 111, 1, 7, 'Advice'),
(7, '2024-04-02', '00:00:00', 111, 1, 7, 'Advice'),
(9, '2024-04-04', '14:36:00', 2, 1, 1, 'Operation'),
(10, '2024-04-06', '08:00:00', 114, 4, 11, 'Operation'),
(11, '2024-04-12', '09:00:00', 121, 4, 12, 'Medical checkup'),
(12, '2024-04-03', '11:00:00', 111, 5, 6, 'Operation');

-- --------------------------------------------------------

--
-- Table structure for table `clinic`
--

CREATE TABLE `clinic` (
  `ID` int(11) NOT NULL,
  `ClinicName` varchar(30) DEFAULT NULL,
  `Addresss` varchar(30) DEFAULT NULL,
  `Type` varchar(30) DEFAULT NULL,
  `PhoneNumber` varchar(30) DEFAULT NULL,
  `Email` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clinic`
--

INSERT INTO `clinic` (`ID`, `ClinicName`, `Addresss`, `Type`, `PhoneNumber`, `Email`) VALUES
(1, 'Umurage Medical Clinic', 'Muhanga', 'Private', '0786230115', 'umurageclinic@gmail.com'),
(2, 'Ineza Medical Clinic', 'Muhanga', 'Private', '0788452273', 'ineza@gmail.com'),
(4, 'Kabyayi Hospital', 'Muhanga', 'Public', '0786230115', 'kabyayi@gmail.com'),
(5, 'La providence Hospital', 'Muhanga', 'Private', '0788345678', 'laprovidence@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `contact_information`
--

CREATE TABLE `contact_information` (
  `ID` int(20) NOT NULL,
  `Name` varchar(50) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `Message` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_information`
--

INSERT INTO `contact_information` (`ID`, `Name`, `Email`, `Message`) VALUES
(1, 'Nyandwi Alphonse', 'nyandwi@gmail.com', 'I want support'),
(2, 'Mahoro Chany', 'mahorochany@gmail.com', 'I like this website for how it works');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `ID` int(20) NOT NULL,
  `FirstName` varchar(50) DEFAULT NULL,
  `LastName` varchar(50) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `PhoneNumber` varchar(30) DEFAULT NULL,
  `Specialization` varchar(30) DEFAULT NULL,
  `Qualification` varchar(30) DEFAULT NULL,
  `ExperienceYears` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`ID`, `FirstName`, `LastName`, `Email`, `PhoneNumber`, `Specialization`, `Qualification`, `ExperienceYears`) VALUES
(1, 'ELIANE', 'Ineza', 'inezaeliane0@gmail.com', '0786230115', 'pediatrician', 'A1', '7'),
(2, 'Batamuriza', 'Phiona', 'batamuriza@gmail.com', '0788452273', 'emergency', 'A1', '3'),
(5, 'Divine', 'Ineza', 'ineza@gmail.com', '0786230223', 'internal medicine', 'A0', '3'),
(6, 'Mahoro', 'Chany', 'mahorochany@gmail.com', '0786230234', 'neurosurgery', 'A0', '5'),
(7, 'KABERA', 'Paul', 'kabera@gmail.com', '0786230234', 'neurosurgery', 'A0', '5'),
(8, 'Batamuriza', 'Phiona', 'batamuriza@gmail.com', '0788452273', 'gynecology', 'A1', '5'),
(9, 'Batamuriza', 'Phiona', 'batamuriza@gmail.com', '0788452273', 'internal medicine', 'A0', '5'),
(11, 'uwiduhaye', 'yokebedi', 'uyokebedi03@gmail.com', '0791242135', 'ophthamology', 'A0', '17'),
(12, 'INGABIRE', 'Assoumpta', 'ingabire@gmail.com', '0786230115', 'emergency', 'A0', '5'),
(13, 'Kamaiza', 'Kevine', 'kamaliza@gmail.com', '0786230234', 'neurosurgery', 'A0', '20'),
(14, 'Dushime', 'Olvier', 'dushime@gmail.com', '0788452273', 'pediatrician', 'A0', '3'),
(17, 'Mizero', 'Aime', 'mizero@gmail.com', '0788567890', 'gynecology', 'A0', '5');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `ID` int(10) NOT NULL,
  `PatientName` varchar(50) DEFAULT NULL,
  `DateOfBirth` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Gender` varchar(20) DEFAULT NULL,
  `BloodType` varchar(30) DEFAULT NULL,
  `Allerigies` varchar(50) DEFAULT NULL,
  `MedicalCondition` varchar(50) DEFAULT NULL,
  `CurrentMedication` varchar(50) DEFAULT NULL,
  `Doctor` int(11) DEFAULT NULL,
  `Nurse` int(11) DEFAULT NULL,
  `Clinic` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`ID`, `PatientName`, `DateOfBirth`, `Gender`, `BloodType`, `Allerigies`, `MedicalCondition`, `CurrentMedication`, `Doctor`, `Nurse`, `Clinic`) VALUES
(14, 'IGIRANEZA Honore', '2024-04-02 22:00:00', 'male', 'B', 'Skin', 'Bad', 'Yes', 1, 1, 1),
(15, 'Hirwa Aldo', '2017-06-12 22:00:00', 'male', 'AB', 'Eyes', 'Moderate', 'Yes', 6, 2, 4),
(16, 'INGABIRE Nadine', '2006-06-06 22:00:00', 'female', 'O', 'Injuries', 'Bad', 'New', 7, 3, 4),
(18, 'INGABIRE Hoziane', '2020-06-17 22:00:00', 'female', 'B', 'Eyes', 'Bad', 'Yes', 9, 2, 4),
(19, 'INGABIRE Sandra', '2009-07-16 22:00:00', 'female', 'B', 'Injuries', 'Moderate', 'New', 11, 3, 4),
(20, 'SHIMWA Samuela', '2008-06-17 22:00:00', 'female', 'AB', 'Injuries', 'Bad', 'Old', 5, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `nurse`
--

CREATE TABLE `nurse` (
  `ID` int(30) NOT NULL,
  `FirstName` varchar(30) DEFAULT NULL,
  `LastName` varchar(30) DEFAULT NULL,
  `Email` varchar(30) DEFAULT NULL,
  `PhoneNumber` varchar(30) DEFAULT NULL,
  `Qualification` varchar(30) DEFAULT NULL,
  `ExperienceYears` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nurse`
--

INSERT INTO `nurse` (`ID`, `FirstName`, `LastName`, `Email`, `PhoneNumber`, `Qualification`, `ExperienceYears`) VALUES
(1, 'SHEMA', 'Aloys', 'shema@gmail.com', '0788452273', 'Masters', '7'),
(2, 'Esther', 'Ineza', 'ineza@gmail.com', '0786230115', 'A0', '10'),
(3, 'SHIMWA', 'Aldo', 'shimwa@gmail.com', '0788654321', 'A0', '10');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `ID` int(20) NOT NULL,
  `Firstname` varchar(50) DEFAULT NULL,
  `Lastname` varchar(50) DEFAULT NULL,
  `Email` varchar(30) DEFAULT NULL,
  `PhoneNumber` varchar(20) DEFAULT NULL,
  `DateOfBirth` date DEFAULT NULL,
  `Gender` varchar(30) DEFAULT NULL,
  `MedicalInsurance` varchar(30) DEFAULT NULL,
  `Country` varchar(30) DEFAULT NULL,
  `Province` varchar(30) DEFAULT NULL,
  `District` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`ID`, `Firstname`, `Lastname`, `Email`, `PhoneNumber`, `DateOfBirth`, `Gender`, `MedicalInsurance`, `Country`, `Province`, `District`) VALUES
(2, 'INEZA', 'Eliane', 'inezaeliane0@gmail.com', '0786230115', '2005-02-12', 'female', 'rama', 'Rwanda', 'South', 'Muhanga'),
(7, 'SHIMWA', 'Aldo', 'shimwa@gmail.com', '0788654321', '2017-06-13', 'male', 'mutual', 'Rwanda', 'South', 'Muhanga'),
(111, 'Nyandwi', 'Alphonse', 'nyandwi@gmail.com', '0788452273', '1997-08-13', 'female', 'mmi', 'Rwanda', 'North', 'Musanze'),
(114, 'Nshuti', 'Peter', 'nshuti@gmail.com', '0786230223', '2007-04-13', 'male', 'britam rwanda', 'Rwanda', 'WEST', 'KARONGI'),
(121, 'HIRWA ', 'Benjamin', 'hirwa@gmail.com', '0788567890', '2010-02-17', 'male', 'mutual', 'Rwanda', 'South', 'Muhanga');

-- --------------------------------------------------------

--
-- Table structure for table `user_information`
--

CREATE TABLE `user_information` (
  `ID` int(20) NOT NULL,
  `Firstname` varchar(30) DEFAULT NULL,
  `Lastname` varchar(30) DEFAULT NULL,
  `Username` varchar(30) DEFAULT NULL,
  `Email` varchar(30) DEFAULT NULL,
  `Phonenumber` varchar(30) DEFAULT NULL,
  `Password` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_information`
--

INSERT INTO `user_information` (`ID`, `Firstname`, `Lastname`, `Username`, `Email`, `Phonenumber`, `Password`) VALUES
(1, 'INEZA', 'Eliane', 'elianeineza', 'inezaeliane0@gmail.com', '0786230115', '222014600'),
(2, 'Nyirarugwiro', 'Benitha', 'benitha', 'nyirarugwiro@gmail.com', '0788452273', '1234'),
(3, 'IBYISHAKA', 'Elizabeth', 'elizabethibyishaka', 'ibyiskaka@gmail.com', '0788567890', '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Patient` (`Patient`),
  ADD KEY `Clinic` (`Clinic`),
  ADD KEY `Doctor` (`Doctor`);

--
-- Indexes for table `clinic`
--
ALTER TABLE `clinic`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `contact_information`
--
ALTER TABLE `contact_information`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Doctor` (`Doctor`),
  ADD KEY `Nurse` (`Nurse`),
  ADD KEY `Clinic` (`Clinic`);

--
-- Indexes for table `nurse`
--
ALTER TABLE `nurse`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user_information`
--
ALTER TABLE `user_information`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `clinic`
--
ALTER TABLE `clinic`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `contact_information`
--
ALTER TABLE `contact_information`
  MODIFY `ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `nurse`
--
ALTER TABLE `nurse`
  MODIFY `ID` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `user_information`
--
ALTER TABLE `user_information`
  MODIFY `ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `appointment_ibfk_1` FOREIGN KEY (`Patient`) REFERENCES `patient` (`ID`),
  ADD CONSTRAINT `appointment_ibfk_2` FOREIGN KEY (`Clinic`) REFERENCES `clinic` (`ID`),
  ADD CONSTRAINT `appointment_ibfk_3` FOREIGN KEY (`Doctor`) REFERENCES `doctor` (`ID`);

--
-- Constraints for table `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `history_ibfk_1` FOREIGN KEY (`Doctor`) REFERENCES `doctor` (`ID`),
  ADD CONSTRAINT `history_ibfk_2` FOREIGN KEY (`Nurse`) REFERENCES `nurse` (`ID`),
  ADD CONSTRAINT `history_ibfk_3` FOREIGN KEY (`Clinic`) REFERENCES `clinic` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
