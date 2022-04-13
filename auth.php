<?php
session_start();

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'mydb';

//Connecting to mydb
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

//Connection error throw
if (mysqli_connect_errno()) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

//Student ID and Password not entered throw
if (!isset($_POST['student ID'], $_POST['password'])) {
	exit('Please enter your CNU ID and password.');
}

// Prepare SQL - uncertain if this is the proper way to do this, ask lapke
if ($stmt = $con->prepare('SELECT password FROM student WHERE student ID = ?')) {
	// Bind student student ID to string
	$stmt->bind_param('s', $_POST['student ID']);
	$stmt->execute();
	// Store the result, check database
	$stmt->store_result();
	
	
	if ($stmt->num_rows > 0) {
	$stmt->bind_result($password);
	$stmt->fetch();
	// Account exists, verify password
	if ($_POST['password'] === $password) {
		// Verification success, create user session
		session_regenerate_id();
		$_SESSION['user_id'] = $_POST['student ID'];
		echo 'Welcome, student ' . $_SESSION['user_id'];
	} else {
		// Incorrect password
		echo 'Incorrect School ID and/or password!';
	}
} else {
	// Incorrect student_ID
	echo 'Incorrect School ID and/or password!';
}


	$stmt->close();
}
?>