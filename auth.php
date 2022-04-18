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
	$query = "SELECT * FROM student WHERE studentID = '$username' AND password = '$password'";
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
	// Successful student login
	else {
		echo "You are logged in as a student!";
		$_SESSION['usertype'] = $usertype;
		$_SESSION['username'] = $row['studentID'];
		$_SESSION['firstname'] = $row['firstName'];
		$_SESSION['lastname'] = $row['lastName'];
		$_SESSION['email'] = $row['studentEmail'];
		$_SESSION['advisor'] = $row['advisorID'];

		header("Location: home_student.php");
	}
}

// Faculty login
elseif ($usertype == 'Faculty') {
	echo ("User type: Advisor");
	echo "<br>";
	$query = "SELECT * FROM faculty WHERE facultyID = '$username' AND password = '$password'";
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
	
	//Successful faculty login
	else {
		$_SESSION['username'] = $row['facultyID'];
		$_SESSION['firstname'] = $row['firstName'];
		$_SESSION['lastname'] = $row['lastName'];
		$_SESSION['email'] = $row['facultyEmail'];
		
		// Registrar login check
		if ($row['role'] == 'Registrar') {
			echo "You are logged in as a registrar!";
			$usertype = 'Registrar';
			$_SESSION['usertype'] = $usertype;
			header("Location: home_registrar.php");
		}
		
		// Dept. Chair not planned to be implemented, functions same as 
		//advisor level faculty in the system currently
		elseif ($row['role'] == 'Chair') {
			echo "You are logged in as a department chair!";
			$_SESSION['usertype'] = $usertype;
			header("Location: home_faculty.php");
		}
		
		// Faculty login
		else {
			echo "You are logged in as an advisor!";
			$_SESSION['usertype'] = $usertype;
			header("Location: home_faculty.php");
		}
	}
}

//This shouldn't be able to happen but just in case, user type throw
else {
	echo 'Unidentifiable user type.';
}


?>