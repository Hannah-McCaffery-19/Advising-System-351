-- MySQL Script generated by MySQL Workbench
-- Tue Feb  8 19:49:17 2022
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';



-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 ;
USE `mydb` ;


-- -----------------------------------------------------
-- Table `mydb`.`Department`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Department` (
  `deptName` VARCHAR(90) NOT NULL,
  `deptChairID_fk_fac` CHAR(8) NULL,
  PRIMARY KEY (`deptName`));



-- -----------------------------------------------------
-- Table `mydb`.`Faculty`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Faculty` (
  `facultyID` CHAR(8) NOT NULL,
  `firstName` VARCHAR(45) NOT NULL,
  `lastName` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `facultyEmail` VARCHAR(60) NOT NULL,
  `facultyPhone` VARCHAR(15) NULL,
  `office` VARCHAR(20) NULL,
  `role` ENUM('Faculty','Chair','Registrar') NOT NULL DEFAULT 'Faculty',
  `department_fk_dept` VARCHAR(90) NULL,
  PRIMARY KEY (`facultyID`),
  INDEX `fk_Department_Faculty1_idx` (`department_fk_dept` ASC),
  CONSTRAINT `fk_Department_Faculty1`
    FOREIGN KEY (`department_fk_dept`)
    REFERENCES `mydb`.`Department` (`deptName`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);




ALTER TABLE `mydb`.`Department`
  ADD CONSTRAINT `fk_Faculty_Department1`
	FOREIGN KEY (`deptChairID_fk_fac`)
    REFERENCES `mydb`.`Faculty` (`facultyID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION;




-- -----------------------------------------------------
-- Table `mydb`.`Availability`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Availability` (
  `facultyID_fk_avail` CHAR(8) NOT NULL,
  `day` ENUM('Monday','Tuesday','Wednesday','Thursday','Friday') NOT NULL,
  `availabilityStart` TIME NOT NULL,
  `availabilityEnd` TIME NOT NULL,
  INDEX `fk_Availability_Faculty1_idx` (`facultyID_fk_avail` ASC),
  CONSTRAINT `fk_Availability_Faculty1`
    FOREIGN KEY (`facultyID_fk_avail`)
    REFERENCES `mydb`.`Faculty` (`facultyID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);
  
  


-- -----------------------------------------------------
-- Table `mydb`.`General_Course_Listing`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`General_Course_Listing` (
  `courseID` VARCHAR(8) NOT NULL,
  `className` VARCHAR(60) NOT NULL,
  `creditHours` INT(1) NOT NULL DEFAULT '0',
  `areaOfLLC` VARCHAR(10) NULL,
  `pre-requisite` TEXT NULL,
  `co-requisite` TEXT NULL,
  `restrictions` TEXT NULL,
  `courseDesc` TEXT NULL,
  PRIMARY KEY (`courseID`));




-- -----------------------------------------------------
-- Table `mydb`.`Class`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Class` (
  `classCRN` CHAR(4) NOT NULL,
  `courseID_fk_GCL` VARCHAR(8) NOT NULL,
  `facultyID_fk_class` CHAR(8) NULL,
  `section` VARCHAR(4) NULL,
  `term` ENUM('Fall','Spring','May','Summer') NOT NULL DEFAULT 'Fall',
  `year` YEAR(4) NOT NULL DEFAULT 2019,
  `location` VARCHAR(15) NULL,
  PRIMARY KEY (`classCRN`),
  INDEX `fk_Class_GCL1_idx` (`courseID_fk_GCL` ASC),
  INDEX `fk_Class_Faculty1_idx` (`facultyID_fk_class` ASC),
  CONSTRAINT `fk_Class_GCL1`
    FOREIGN KEY (`courseID_fk_GCL`)
    REFERENCES `mydb`.`General_Course_Listing` (`courseID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Class_Faculty1`
    FOREIGN KEY (`facultyID_fk_class`)
    REFERENCES `mydb`.`Faculty` (`facultyID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);




-- -----------------------------------------------------
-- Table `mydb`.`Majors`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Majors` (
  `majorName` VARCHAR(45) NOT NULL,
  `deptName_fk_maj` VARCHAR(90) NOT NULL,
  `requiredClasses` TEXT NOT NULL,
  `electiveClasses` TEXT NULL,
  PRIMARY KEY (`majorName`),
  INDEX `fk_Majors_Department1_idx` (`deptName_fk_maj` ASC),
  CONSTRAINT `fk_Majors_Department1`
    FOREIGN KEY (`deptName_fk_maj`)
    REFERENCES `mydb`.`Department` (`deptName`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);



-- -----------------------------------------------------
-- Table `mydb`.`Minors`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Minors` (
  `minorName` VARCHAR(45) NOT NULL,
  `deptName_fk_min` VARCHAR(90) NOT NULL,
  `requiredClasses` TEXT NOT NULL,
  `electiveClasses` TEXT NULL,
  PRIMARY KEY (`minorName`),
  INDEX `fk_Minors_Department1_idx` (`deptName_fk_min` ASC),
  CONSTRAINT `fk_Minors_Department1`
    FOREIGN KEY (`deptName_fk_min`)
    REFERENCES `mydb`.`Department` (`deptName`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `mydb`.`Student`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Student` (
  `studentID` CHAR(8) NOT NULL,
  `firstName` VARCHAR(45) NOT NULL,
  `lastName` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `studentEmail` VARCHAR(60) NOT NULL,
  `studentPhone` VARCHAR(15) NULL,
  `studentAddress` VARCHAR(80) NULL,
  `classStanding` ENUM('Freshman','Sophomore','Junior','Senior') NOT NULL DEFAULT 'Freshman',
  `yearEnrolled` YEAR(4) NOT NULL,
  `yearGraduating` YEAR(4) NOT NULL,
  `alternatePIN` CHAR(6) NULL,
  `advisorID` CHAR(8) NOT NULL,
  PRIMARY KEY (`studentID`),
  INDEX `fk_Student_Faculty1_idx` (`advisorID` ASC),
  CONSTRAINT `fk_Student_Faculty1`
    FOREIGN KEY (`advisorID`)
    REFERENCES `mydb`.`Faculty` (`facultyID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);
    
    
    
    
-- -----------------------------------------------------
-- Table `mydb`.`Meeting`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Meeting` (
  `meetingID` CHAR(6) NOT NULL,
  `studentID_fk_meet` CHAR(8) NOT NULL,
  `facultyID_fk_meet` CHAR(8) NOT NULL,
  `location` VARCHAR(45) NOT NULL,
  `date` DATE NOT NULL,
  `timeStart` DATETIME NOT NULL,
  `timeEnd` DATETIME NOT NULL,
  `notes` TEXT NULL,
  PRIMARY KEY (`meetingID`),
  INDEX `fk_Meeting_Student1_idx` (`studentID_fk_meet` ASC),
  INDEX `fk_Meeting_Faculty1_idx` (`facultyID_fk_meet` ASC),
  CONSTRAINT `fk_Meeting_Student1`
    FOREIGN KEY (`studentID_fk_meet`)
    REFERENCES `mydb`.`Student` (`studentID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Meeting_Faculty1`
    FOREIGN KEY (`facultyID_fk_meet`)
    REFERENCES `mydb`.`Faculty` (`facultyID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);



-- -----------------------------------------------------
-- Table `mydb`.`Sending_PIN`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Sending_PIN` (
  `facultyID` CHAR(8) NOT NULL,
  `studentID` CHAR(8) NOT NULL,
  `status` ENUM('Sent','Not Sent') NOT NULL DEFAULT 'Not Sent');


    
-- -----------------------------------------------------
-- Table `mydb`.`Records`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Records` (
  `recordID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `studentID_fk_rec` CHAR(8) NOT NULL,
  `courseID_fk_rec` VARCHAR(8) NOT NULL,
  `grade` VARCHAR(2) NOT NULL,
  `termTaken` ENUM('Fall','Spring','May','Summer') NOT NULL,
  `yearTaken` YEAR(4) NOT NULL,
  PRIMARY KEY (`recordID`),
  INDEX `fk_Records_StudentID1_idx` (`studentID_fk_rec` ASC),
  CONSTRAINT `fk_Records_StudentID1`
    FOREIGN KEY (`studentID_fk_rec`)
    REFERENCES `mydb`.`Student` (`studentID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  INDEX `fk_Records_courseID1_idx` (`courseID_fk_rec` ASC),
  CONSTRAINT `fk_Records_courseID1`
    FOREIGN KEY (`courseID_fk_rec`)
    REFERENCES `mydb`.`General_Course_Listing` (`courseID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);



-- -----------------------------------------------------
-- Table `mydb`.`Evaluations`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Evaluations` (
  `evalID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `studentID_fk_eval` CHAR(8) NOT NULL,
  `evalGrade` ENUM('A','B','C','D') NOT NULL,
  `created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `generatedBy` ENUM('Student','Faculty','Registrar') NOT NULL,
  PRIMARY KEY (`evalID`),
  INDEX `fk_Evaluations_StudentID1_idx` (`studentID_fk_eval` ASC),
  CONSTRAINT `fk_Evaluations_StudentID1`
    FOREIGN KEY (`studentID_fk_eval`)
    REFERENCES `mydb`.`Student` (`studentID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);




-- -----------------------------------------------------
-- Table `mydb`.`Override`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Override` (
  `overrideID` INT NOT NULL,
  `overrideStatus` VARCHAR(45) NULL,
  `overrideTime` VARCHAR(45) NULL,
  `studentID` CHAR(8) NOT NULL,
  PRIMARY KEY (`overrideID`));
  


-- -----------------------------------------------------
-- Table `mydb`.`Declared_Minor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Declared_Minor` (
  `studentID_fk_declmin` CHAR(8) NOT NULL,
  `minorName_fk_declmin` VARCHAR(45) NOT NULL,
  CONSTRAINT `fk_Declared_Minor_Student1`
    FOREIGN KEY (`studentID_fk_declmin`)
    REFERENCES `mydb`.`Student` (`studentID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Declared_Minor_Minors1`
    FOREIGN KEY (`minorName_fk_declmin`)
    REFERENCES `mydb`.`Minors` (`minorName`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  PRIMARY KEY (`studentID_fk_declmin`, `minorName_fk_declmin`));



-- -----------------------------------------------------
-- Table `mydb`.`Declared_Major`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Declared_Major` (
  `studentID_fk_declmaj` CHAR(8) NOT NULL,
  `majorName_fk_declmaj` VARCHAR(45) NOT NULL,
  CONSTRAINT `fk_Declared_Major_Student1`
    FOREIGN KEY (`studentID_fk_declmaj`)
    REFERENCES `mydb`.`Student` (`studentID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Declared_Major_Majors1`
    FOREIGN KEY (`majorName_fk_declmaj`)
    REFERENCES `mydb`.`Majors` (`majorName`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  PRIMARY KEY (`studentID_fk_declmaj`, `majorName_fk_declmaj`));
  
  

INSERT INTO `department` (`deptName`, `deptChairID_fk_fac`) 
VALUES ('Communication', NULL), ('Economics', NULL), 
('Education/Teacher Preparation', NULL), ('English', NULL), 
('Fine Art and Art History', NULL), ('History', NULL), 
('Leadership and American Studies', NULL), 
('Luter School of Business', NULL), ('Mathematics', NULL), 
('Military Science', NULL), 
('Modern and Classical Languages and Literatures', NULL), 
('Molecular Biology and Chemistry', NULL), ('Music', NULL), 
('Neuroscience', NULL), ('Organismal and Environmental Biology', NULL), 
('Philosophy and Religion', NULL), ('Political Science', NULL), 
('Physics, Computer Science and Engineering', NULL), 
('Psychology', NULL), ('Sociology, Social Work and Anthropology', NULL), 
('Theater and Dance', NULL);



  INSERT INTO `faculty`
  (`facultyID`, `firstName`, `lastName`, `password`, 
  `facultyEmail`, `facultyPhone`, `office`, 
  `role`, `department_fk_dept`)
  VALUES ('00912116','Michael','Lapke','DatabaseDev3000',
  'michael.lapke@cnu.edu','7575948921','Luter 331','Faculty',
  'Physics, Computer Science and Engineering'),
  ('00918954','Anton','Riedl','PCSErocks',
  'riedl@cnu.edu','7575947829','Luter 313A','Chair',
  'Physics, Computer Science and Engineering'),
  ('00982178','Kevin','Hughes','ILoveEmails123',
  'kmhughes@cnu.edu','7575947160','DSU 3148','Registrar',NULL);
  
  
  
  INSERT INTO `student`
  (`studentID`, `firstName`, `lastName`, `password`, 
  `studentEmail`, `studentPhone`, `studentAddress`, 
  `classStanding`, `yearEnrolled`, `yearGraduating`, 
  `alternatePIN`, `advisorID`) 
  VALUES ('00973437','Hannah','McCaffery','Change.19',
  'hannah.mccaffery.19@cnu.edu','8043895708',NULL,
  'Junior','2019','2023',NULL,'00912116'),
  ('00982800', 'Maddy', 'Jenkins', 'yuria3', 
  'madelyn.jenkins.19@cnu.edu', '5712238067', NULL, 
  'Junior', '2019', '2023', NULL, '00912116'), 
  ('00974556', 'Katie', 'Clements', 'KKdisco500', 
  'katelyn.clements.20@cnu.edu', '5409038040', NULL, 
  'Sophomore', '2020', '2024', NULL, '00912116'),
  ('00976378', 'Caitlyn', 'Berryhill', 'M0t0rb1ke', 
  'caitlyn.berryhill.21@cnu.edu', '4343389888', NULL, 
  'Freshman', '2021', '2025', NULL, '00912116');

  
  
  
  INSERT INTO `general_course_listing`
  (`courseID`, `className`, `creditHours`, `areaOfLLC`, 
  `pre-requisite`, `co-requisite`, `restrictions`, `courseDesc`) 
  VALUES ('CPSC150','Intro to Programming','3','LLFR',NULL,NULL,NULL,
  'This course is an introduction to problem solving and programming. Topics include using primitive and object types, defining Boolean and arithmetic expressions, using selection and iterative statements, defining and using methods, defining classes, creating objects and manipulating arrays. Emphasis is placed on designing, coding and testing programs using the above topics. Satisfies the logical reasoning foundation requirement.'),
  ('CPSC150L','Intro to Programming Lab','1',NULL,NULL,'CPSC 150 with a minimum grade of D-',NULL,
  'Laboratory course supports the concepts in CPSC 150 lecture with hands-on programming activities and language specific implementation. Laboratory exercises stress sound design principles, programming style, documentation, and debugging techniques. Lab fees apply each term.'),
  ('HIST112', 'The Modern World', '3', 'AIGM', NULL, NULL, NULL, 
  'A survey of world history centering on institutions, values, and cultural forms from the mid-16th century to the present.'),
  ('MATH140', 'Calculus and Analytic Geometry', '4', 'LLFM', 'MATH 130 with a minimum grade of C- OR MATH 132 with a minimum grade of C-', NULL, NULL, 
  'An introduction to the calculus of elementary functions, continuity, derivatives, methods of differentiation, the Mean Value Theorem, curve sketching, applications of the derivative, the definite integral, the Fundamental Theorems of Calculus, indefinite integrals, and log and exponential functions. The software package Mathematica will be used.\r\n\r\nPrerequisite: MATH 130 with a grade of C- or higher, or an acceptable score on the Calculus Readiness Assessment. More information on the Calculus Readiness Exam can be found here: https://my.cnu.edu/math/placement/'),
  ('PHYS151', 'College Physics I', '3', 'AINW', NULL, NULL, NULL, 
  'A presentation of the major concepts of physics, using algebra and trigonometry. For science students (but not for engineering, physics, or mathematics students). Topics covered include mechanics, thermodynamics, waves, electromagnetism, optics, and modern physics.'),
  ('PHYS151L', 'College Physics I Laboratory', '1', 'AINW', NULL, 'PHYS 151 with a minimum grade of D-', NULL, 
  'Physics laboratory activities to accompany the lecture part of the course. The laboratories introduce fundamental physical principles, rudimentary data analysis, and computer-aided control and data acquisition. Lab fees apply each term.');


INSERT INTO `class` (`classCRN`, `courseID_fk_GCL`, 
`facultyID_fk_class`, `section`, `term`, `year`, `location`) VALUES 
('8001', 'CPSC150', '00912116', '1', 'Fall', '2019', 'LUTR258'), 
('8002', 'CPSC150L', '00912116', '1', 'Fall', '2019', 'LUTER 121'), 
('8075', 'PHYS151', '00918954', '1', 'Fall', '2019', 'MCM114'), 
('8076', 'PHYS151L', '00918954', '1', 'Fall', '2019', 'MCM218');






INSERT INTO `records`
(`recordID`, `studentID_fk_rec`, `courseID_fk_rec`, 
`grade`, `termTaken`, `yearTaken`) 
VALUES (NULL,'00973437','CPSC150','B+','Fall','2019'),
(NULL, '00973437', 'CPSC150L', 'A', 'Fall', '2019'),
(NULL, '00973437', 'HIST112', 'B+', 'Fall', '2019'),
(NULL, '00973437', 'MATH140', 'B-', 'Fall', '2019'),
(NULL, '00973437', 'PHYS151', 'C', 'Fall', '2019'),
(NULL, '00973437', 'PHYS151L', 'A+', 'Fall', '2019');



INSERT INTO `availability` (`facultyID_fk_avail`, `day`, `availabilityStart`, `availabilityEnd`) VALUES 
('00912116', 'Monday', '12:00', '12:30'),
('00912116', 'Monday', '14:00', '15:00'),
('00912116', 'Tuesday', '11:00', '12:00'),
('00912116', 'Tuesday', '12:30', '13:30'),
('00912116', 'Tuesday', '16:00', '16:30'),
('00912116', 'Wednesday', '12:00', '12:30'),
('00912116', 'Wednesday', '14:00', '15:00'),
('00912116', 'Thursday', '11:00', '12:00'),
('00912116', 'Thursday', '12:30', '13:30'),
('00912116', 'Thursday', '16:00', '16:30'),
('00912116', 'Friday', '12:00', '12:30');



INSERT INTO `majors` (`majorName`, `deptName_fk_maj`, 
`requiredClasses`, `electiveClasses`) VALUES 
('Information Science', 'Physics, Computer Science and Engineering', 
'CPSC150 CPSC150L CPSC250 CPSC250L MATH125 ACCT200 ECON201 ECON202 BUSN303 PSYC202 CPSC445W CPSC215 CPSC216 CPSC335 CPSC350 CPSC351 CPSC440 CPEN371W', 'MATH135 MATH140 MATH148 MATH235 MATH260 CPSC336 CPSC428 CPSC429 CPSC255 CPSC280 CPSC480 BUSN305 CPSC336 CPSC441');

INSERT INTO `majors` (`majorName`, `deptName_fk_maj`, 
`requiredClasses`, `electiveClasses`) VALUES 
('Accounting', 'Luter School of Business', 
'ACCT201 ACCT202 BUSN231 CPSC215 ECON201 ECON202 MATH125 PHIL207 BUSN276L BUSN300 BUSN304 BUSN305 BUSN370 BUSN311 BUSN323 BUSN351 BUSN418 ACCT301 ACCT302 ACCT303 ACCT401 ACCT405 ACCT406W', 
'|| ACCT352 ACCT402 ACCT451 ACCT461 ACCT495 ACCT499 \\||'), 
('Applied Physics', 'Physics, Computer Science and Engineering', 
'CPEN214 CPSC150 CPSC150L CPSC250 CPSC250L PHYS201 PHYS201L PHYS202 PHYS202L PHYS301 PHYS303 PHYS304 PHYS340 PHYS341 PHYS351 PHYS402 PHYS406 ENGR211 ENGR211L MATH240 MATH250 MATH320 PCSE498W', 
'|| PHYS401 PHYS404 \\|| || MATH140 MATH148 MATH240 MATH250 MATH320 \\|| n6 ENGR211 & ENGR211L MATH350 MATH355 >=PHYS300 \\n6'), 
('Biochemistry', 'Molecular Biology and Chemistry', 
'CHEM121 CHEM121L CHEM122 CHEM122L CHEM321 CHEM321L CHEM322 CHEM322L MATH240 PHYS201 PHYS201L PHYS202 PHYS202L CHEM341 CHEM391W CHEM361 CHEM361L BIOL211 BIOL211L BIOL307 BIOL307L BIOL313 BIOL412 BIOL412L BCHM414 BCHM414L BCHM415 BCHM415L', 
'|| MATH140 MATH148 \\||'), 
('Biology', 'Molecular Biology and Chemistry', 
'BIOL211 BIOL211L BIOL212 BIOL212L BIOL213 BIOL213L BIOL391W BIOL491W CHEM103 CHEM103L CHEM104 CHEM104L MATH125', 
'>=MATH130 n21 o3-200 BIOL301 BIOL301L BIOL307 BIOL307L BIOL315 BIOL315L BIOL319 BIOL326 BIOL405 BIOL409 BIOL409L BIOL411 BIOL412 BIOL412L BIOL420 BIOL420L BIOL450 BIOL450L BCHM410 BCHM414 BCHM414L BCHM 395 BCHM415 BCHM415L \\n21'), 
('Biology- Cellular, Molecular, Physiological', 'Molecular Biology and Chemistry', 
'BIOL211 BIOL211L BIOL212 BIOL212L BIOL213 BIOL213L CHEM121 CHEM121L CHEM122 CHEM122L CHEM321 CHEM321L CHEM322 CHEM322L MATH125 PHYS151 PHYS151L PHYS152 PHYS152L', 
'n15 BIOL301 BIOL301L BIOL307 BIOL307L BIOL315 BIOL315L BIOL319 BIOL326 BIOL405 BIOL409 BIOL409L BIOL411 BIOL412 BIOL412L BIOL420 BIOL420L BIOL450 BIOL450L BCHM410 BCHM414 BCHM414L BCHM414L BCHM415 BCHM415L \\n15 n6 o3-200 >=BIOL200 \\n6'), 
('Biology- Environmental', 'Organismal and Environmental Biology', 
'BIOL211 BIOL211L BIOL212 BIOL212L BIOL213 BIOL213L CHEM121 CHEM121L CHEM122 CHEM122L CHEM321 CHEM321L CHEM322 CHEM322L MATH125 PHYS151 PHYS151L PHYS152 PHYS152L BIOL391W BIOL491W', 
'>=MATH130 n15 BIOL306 BIOL306L BIOL308 BIOL308L BIOL403 BIOL403L BIOL407 BIOL407L BIOL435 BIOL435L BIOL450 BIOL450L BIOL454 CHEM465 CHEM440 \\n15 n6 o3-200 >=BIOL200 \\n6'), 
('Biology- Integrative', 'Organismal and Environmental Biology', 
'BIOL211 BIOL211L BIOL212 BIOL212L BIOL213 BIOL213L CHEM121 CHEM121L CHEM122 CHEM122L CHEM321 CHEM321L CHEM322 CHEM322L MATH125 PHYS151 PHYS151L PHYS152 PHYS152L BIOL391W BIOL491W', 
'>=MATH130 n21 o3-200 BIOL211 BIOL211L BIOL212 BIOL212L BIOL213 BIOL213L BIOL391W BIOL491W CHEM103 CHEM103L CHEM104 CHEM104L CHEM121 CHEM121L CHEM122 CHEM122L CHEM321 CHEM321L CHEM322 CHEM322L BIOL391W \\n21'), 
('Biology- Organismal', 'Organismal and Environmental Biology', 
'BIOL211 BIOL211L BIOL212 BIOL212L BIOL213 BIOL213L CHEM121 CHEM121L CHEM122 CHEM122L CHEM321 CHEM321L CHEM322 CHEM322L MATH125 PHYS151 PHYS151L PHYS152 PHYS152L BIOL391W BIOL491W', 
'>=MATH130 n15 BIOL310 BIOL310L BIOL312 BIOL312L BIOL403 BIOL403L BIOL409 BIOL409L BIOL425 BIOL425L BIOL440 BIOL440L BIOL445 BIOL445L BIOL457 BIOL457L BIOL465 BIOL465L \\n15 n6 o3-200 >=BIOL200 \\n6'), 
('Chemistry', 'Molecular Biology and Chemistry', 
'CHEM121 CHEM121L CHEM122 CHEM122L CHEM321 CHEM321L CHEM322 CHEM322L MATH240 PHYS201 PHYS201L PHYS202 PHYS202L CHEM341 CHEM342 CHEM342L CHEM361 CHEM361L CHEM445 CHEM445L CHEM401 CHEM401L CHEM391W CHEM492W', 
'|| MATH140 MATH148 \\|| >=CHEM300 >=CHEM300'), 
('Communication Studies', 'Communication', 
'COMM201 COMM211 COMM222 COMM249 COMM352W COMM452W', 
'|| COMM318 COMM333 COMM350 COMM370 \\|| || COMM411 COMM433 COMM455 \\|| n15 o3-200 >=COMM200 \\n15'), 
('Computer Engineering', 'Physics, Computer Science and Engineering', 
'CHEM121 CHEM121L CHEM122 CHEM122L PHYS201 PHYS201L PHYS202 PHYS202L MATH240 MATH320 ENGR121 ENGR211 ENGR211L ENGR212 ENGR212L ENGR213 ENGR340 CPEN214 CPEN315 CPEN315L CPEN371W CPEN414 CPEN431 CPEN498W CPSC150 CPSC150L CPSC250 CPSC250L CPSC255 CPSC270 CPSC327 CPSC410 CPSC420', 
'|| ECON201 ECON202 \\|| || MATH140 MATH148 \\|| n6 CPEN422 CPEN495 CPSC360 CPSC425 CPSC428 CPSC440 CPSC450 CPSC470 CPSC471 CPSC472 CPSC475 CPSC480 CPSC495 PHYS421 PCSE495 CPSC501 CPSC502 \\n6'), 
('Computer Science', 'Physics, Computer Science and Engineering', 
'CPEN214 CPEN371W CPSC150 CPSC150L CPSC250L CPSC250L CPSC255 CPSC270 CPSC280 CPSC327 CPSC360 CPSC410 CPSC420 MATH240 PHYS341 ENGR213 CPSC498', 
'|| MATH140 MATH148 \\|| |& PHYS151 PHYS151L PHYS152 PHYS152L | PHYS201 PHYS201L PHYS202 PHYS202L \\&| || PHYS340 ENGR340 MATH235 MATH260 \\|| s3 CPSC425 CPSC428 CPSC440 CPSC450 CPSC460 CPSC470 CPSC471 CPSC475 CPSC480 CPSC485 CPSC495 >=CPSC500 MATH380 PHYS421 PHYS441 \\s3'), 
('Economics', 'Economics', 
'MATH125 ECON201 ECON202 CPSC215 ECON300 ECON303 ECON304 ECON485 ECON490W', 
's5 ECON400 ECON425 ECON465 ECON470 ECON475 >=ECON300 \\s5'), 
('Economics- Mathematical Economics', 'Economics', 
'MATH125 ECON201 ECON202 CPSC215 ECON300 ECON303 ECON304 ECON485 ECON490W MATH240 MATH250 MATH260 MATH320', 
'>=ECON300 >=ECON300'), 
('Electrical Engineering', 'Physics, Computer Science and Engineering', 
'CHEM121 CHEM121L CHEM122 CHEM122L PHYS201 PHYS201L PHYS202 PHYS202L PHYS341 MATH240 MATH320 CPSC150 CPSC150L CPSC250 CPSC250L CPSC327 CPEN214 CPEN371W ENGR121 ENGR211 ENGR211L ENGR212 ENGR212L ENGR340 EENG221 EENG311 EENG311L EENG321 EENG321L EENG361 EENG361L EENG498W', 
'|| ECON201 ECON202 \\|| || MATH140 MATH148 \\|| || MATH250 MATH335 ENGR213 \\|| n12 CPEN315 CPEN315L CPEN414 EENG421 CPEN422 EENG461 EENG481 \\n12'), 
('English', 'English', 
'ENGL200 ENGL201 ENGL202 ENGL308W ENGL490W', 
'|| ENGL309W ENGL326W ENGL350W ENGL351W ENGL352W ENGL353W ENGL365W ENGL454W \\|| || ENGL421 ENGL423 \\|| s6 >=ENGL300 \\s6'), 
('English- Literature', 'English', 
'ENGL200 ENGL201 ENGL202 ENGL308W ENGL490W', 
'|| ENGL309W ENGL326W ENGL350W ENGL351W ENGL352W ENGL353W ENGL365W ENGL454W \\|| || ENGL421 ENGL423 \\|| s6 ENGL304W ENGL313 ENGL315 ENGL316 ENGL320 ENGL324 ENGL329 ENGL341 ENGL342 ENGL343 ENGL345 ENGL346 ENGL356W ENGL372 ENGL373 ENGL374 ENGL376 ENGL380 ENGL381 ENGL393 ENGL395 ENGL410 ENGL412 ENGL415 ENGL416 ENGL428 ENGL429 ENGL476 ENGL495 \\s6'), 
('English- Writing', 'English', 
'ENGL200 ENGL201 ENGL202 ENGL308W ENGL490W', 
'|| ENGL309W ENGL326W ENGL350W ENGL351W ENGL352W ENGL353W ENGL365W ENGL454W \\|| || ENGL421 ENGL423 \\|| s6 ENGL250 ENGL309W ENGL331 ENGL339W ENGL339L ENGL350 ENGL351W ENGL352W ENGL353W ENGL365W ENGL450 ENGL452W ENGL453 ENGL454W ENGL462 ENGL491 ENGL499 \\s6'), 
('Environmental Studies', 'Organismal and Environmental Biology', 
'BIOL212 BIOL212L CHEM111L ECON203 EVST220 LDSP250 MATH125 ENGL393 PHIL376 POLS371W IDST490', 
'|| CHEM103 CHEM121 \\|| s4 ANTH325 ANTH331 CHEM104 CHEM104L ECON301 EVST395 GEOG211 GEOG308 HIST342 HIST343 POLS391 RSTD337 RSTD338 PHYS142 \\s4'), 
('Finance', 'Luter School of Business', 
'ACCT201 ACCT202 BUSN231 CPSC215 ECON201 ECON202 MATH125 PHIL207 BUSN276L BUSN300 BUSN304 BUSN305 BUSN370 BUSN311 BUSN323 BUSN351 BUSN418 FINC324 FINC325 FINC422 FINC425 FINC428W', 
'|| FINC424 FINC454 FINC495 FINC499 \\||'), 
('Fine and Performing Arts- Art History', 'Fine Art and Art History', 
'FNAR117 FNAR118 FNAR201 FNAR202 FNAR490W', 
'|| FNAR371 FNAR377 \\|| || FNAR373 FNAR379 \\|| || FNAR374 FNAR375 FNAR380 FNAR381 FNAR395 FNAR403 \\|| || FNAR117 FNAR118 FNAR121 FNAR128 FNAR204 FNAR205 FNAR224 FNAR226 FNAR227 FNAR241 FNAR251 FNAR252 FNAR322 FNAR324 FNAR326 FANR327 FNAR331 FNAR332 FNAR333 FNAR334 FNAR341 FNAR351 FNAR352 FNAR401 FNAR402 FNAR488 \\|| s5 FNAR375 FNAR378 FNAR380 FNAR381 FNAR395 FNAR490 CLST311 CLSE312 FNAR374 \\s5'), 
('Fine and Performing Arts- Studio Art', 
'Fine Art and Art History', 
'FNAR117 FNAR118 FNAR121 FNAR128 FNAR201 FNAR202 FNAR288', 
's4 FNAR322 FNAR324 FNAR326 FANR327 FNAR331 FNAR332 FNAR333 FNAR334 FNAR341 FNAR351 FNAR352 FNAR401 FNAR402 FNAR488 \\s4 s2 FNAR117 FNAR118 FNAR121 FNAR128 FNAR204 FNAR205 FNAR224 FNAR226 FNAR227 FNAR241 FNAR251 FNAR252 \\s2 s2 FNAR201 FNAR202 FNAR204 FNAR371 FNAR372 FNAR373 FNAR374 FNAR375 FNAR376 FNAR377 FNAR378 FNAR379 FNAR380 FNAR381 FNAR395 FNAR403 FNAR490 CLST311 CLST312 \\s2 || FNAR371 FNAR377 \\||');




INSERT INTO `minors` (`minorName`, `deptName_fk_min`, 
`requiredClasses`, `electiveClasses`) VALUES 
('Graphic Design', 'Fine Art and Art History', 
'FNAR118 FNAR128 FNAR334 FNAR335 FNAR336', NULL), 
('Computer Science', 'Physics, Computer Science and Engineering', 
'CPSC150 CPSC150L CPSC250 CPSC250L', NULL);



INSERT INTO `declared_major` (`studentID_fk_declmaj`, 
`majorName_fk_declmaj`) VALUES 
('00973437', 'Information Science');



INSERT INTO `declared_minor` (`studentID_fk_declmin`, `minorName_fk_declmin`) 
VALUES ('00973437', 'Graphic Design'), 
('00973437', 'Computer Science');



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
