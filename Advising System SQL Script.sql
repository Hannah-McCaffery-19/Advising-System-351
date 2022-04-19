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
  `facultyAddress` VARCHAR(80) NULL,
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



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
