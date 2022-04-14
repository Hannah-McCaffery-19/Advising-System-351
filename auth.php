<?php
session_start();

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'mydb';

//Connecting to mydb
$connect = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

//Connection error throw
if (mysqli_connect_errno()) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

//Username or password not set throw
if (!isset($_POST['username']) or !isset($_POST['password'])){
	echo 'CNU ID or Password were not set.';
}

//Create variables from login form data
$username = trim($_POST['username']);
$password = trim($_POST['password']);
$usertype = $_POST['usertype'];

//Debug echoes
echo ("Username entered: $username");
echo "<br>";
echo ("Password entered: $password");
echo "<br>";

//Student login
if ($usertype == 'Student') {
	echo ("User type: Student");
	echo "<br>";
	$query = "SELECT * FROM student WHERE 'student ID'='$username' AND 'password'='$password'";
	$result = mysqli_query($connect, $query);
	$row = mysqli_fetch_assoc($result);
	
	//Debug echoes
	echo ("Query completed. Result:");
	echo "<br>";
	echo ($row);
	echo "<br>";
	
	if (is_null($row)) {
		echo "An error was encountered while attempting student login.";
	} 
	else {
		echo "You are logged in as a student!";
		//reimplement session stuff once login works
	}
}

// Faculty login
if ($usertype == 'Faculty') {
	echo ("User type: Advisor");
	echo "<br>";
	$query = "SELECT * FROM faculty WHERE 'faculty ID'='$username' AND 'password'='$password'";
	$result = mysqli_query($connect, $query);
	$row = mysqli_fetch_assoc($result);
	
	//Debug echoes
	echo ("Query completed. Result:");
	echo "<br>";
	echo ($row);
	echo "<br>";
	
	if (is_null($row)) {
		echo "An error was encountered while attempting advisor login.";
	} 
	else {
		echo "You are logged in as an advisor!";
		//reimplement session stuff once login works
	}
}



?>