<?php

session_start();

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'mydb';

$connect = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

$advisorID = $_SESSION['advisor'];


//Monday Availability
$query = "SELECT * FROM availability WHERE facultyID_fk_avail = '$advisorID' AND day = 'Monday'";
mysqli_multi_query($connect, $query);
do {
	if ($result = mysqli_store_result($connect)) {
		while ($available = mysqli_fetch_row($result)) {				
			echo substr($available[2], 0, -3); echo '-'; echo substr($available[3], 0, -3); echo '&emsp;';		
		}
	}
} 
while (mysqli_next_result($connect));


//Tuesday Availability
$query = "SELECT * FROM availability WHERE facultyID_fk_avail = '$advisorID' AND day = 'Tuesday'";
mysqli_multi_query($connect, $query);
do {
	if ($result = mysqli_store_result($connect)) {
		while ($available = mysqli_fetch_row($result)) {				
			echo substr($available[2], 0, -3); echo '-'; echo substr($available[3], 0, -3); echo '&emsp;';		
		}
	}
} 
while (mysqli_next_result($connect));


//Wednesday Availability
$query = "SELECT * FROM availability WHERE facultyID_fk_avail = '$advisorID' AND day = 'Wednesday'";
mysqli_multi_query($connect, $query);
do {
	if ($result = mysqli_store_result($connect)) {
		while ($available = mysqli_fetch_row($result)) {				
			echo substr($available[2], 0, -3); echo '-'; echo substr($available[3], 0, -3); echo '&emsp;';		
		}
	}
} 
while (mysqli_next_result($connect));


//Thursday Availability
$query = "SELECT * FROM availability WHERE facultyID_fk_avail = '$advisorID' AND day = 'Thursday'";
mysqli_multi_query($connect, $query);
do {
	if ($result = mysqli_store_result($connect)) {
		while ($available = mysqli_fetch_row($result)) {				
			echo substr($available[2], 0, -3); echo '-'; echo substr($available[3], 0, -3); echo '&emsp;';		
		}
	}
} 
while (mysqli_next_result($connect));


//Friday Availability
$query = "SELECT * FROM availability WHERE facultyID_fk_avail = '$advisorID' AND day = 'Friday'";
mysqli_multi_query($connect, $query);
do {
	if ($result = mysqli_store_result($connect)) {
		while ($available = mysqli_fetch_row($result)) {				
			echo substr($available[2], 0, -3); echo '-'; echo substr($available[3], 0, -3); echo '&emsp;';		
		}
	}
} 
while (mysqli_next_result($connect));



?>