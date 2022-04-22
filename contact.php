<?php
session_start();

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'mydb';

$connect = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

// Validate inputs from contact form, set form variables
if(!isset($_POST['Send'])) {
	echo 'Error: email form not submitted.';
}

$_SESSION['sentEmail'] = 'true';

$to = $_POST['to'];
$subject = $_POST['subject'];
$message = $_POST['message'];
$headers = "From: " . $_SESSION['email'];

echo $to;
echo $subject;
echo $message;
echo $headers;

mail($to, $subject, $message, $headers);

header('Location: ' . $_SERVER['HTTP_REFERER']);


?>