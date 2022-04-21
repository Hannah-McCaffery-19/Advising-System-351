<?php
session_start();

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'mydb';

$connect = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

echo '
<!DOCTYPE html>
<html lang="en">
<head>
<link href="style.css" rel="stylesheet">
<title>CNU Advising - Home</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
<div class="body_box">
<table class="hdr_table" cellpadding="0" cellspacing="0" >
	<tr>
		<td class="hdr_logo">
			<div class="cnu_name">
			<a href="http://www.cnu.edu"><img src="images/cnu_name.png" align="center" alt="CNU Logo"></a> 
			</div>
		</td>
		<td class="hdr_title">
			<a href="home_student.php"><h1>Advising System</h1></a>
			<h2>Student Portal</h2>
			<p>Christopher Newport University</p>
		</td>
		<td class="hdr_login">
			<h2>Welcome,</h2>
			<p>';
			echo $_SESSION['firstname'];
			echo ' ';
			echo $_SESSION['lastname'];
			echo '</p>
			<form id="logout" action="logout.php" method="post" class="logout_form">
				<input type="submit" value="Log Out">
			</form>
		</td>
	</tr>
</table>

<div class="main">

<div class="sidenav">
	<br>
	<a href="home_student.php"><h3>Home</h3></a>
	<img class="navline" src="images/divider.png">
	<a href="info_P_student.php"><h3>Information</h3></a>
	<a href="info_profile_student.php"><p>My Profile</p></a>
	<a href="info_advisor_student.php"><p>My Advisor</p></a>
	<a href="info_required_student.php"><p>Requirements</p></a>
	<a href="info_courses_student.php"><p>List of Classes</p></a>
	<img class="navline" src="images/divider.png">
	<a href="meet_P_student.php"><h3>Meeting</h3></a>
	<a href="meet_sched_student.php"><p>Schedule Meeting</p></a>
	<a href="meet_view_student.php"><p>View Meetings</p></a>
	<img class="navline" src="images/divider.png">
	<a href="eval_P_student.php"><h3>Evaluation</h3></a>
	<a href="eval_create_student.php"><p>Generate Evaluation</p></a>
	<a href="eval_view_student.php"><p>View Evaluations</p></a>
	<img class="navline" src="images/divider.png">
	<a href="contact_student.php"><h3>Contact</h3></a>
	<br><br>
</div>

<div class="content">
	<h1 class="page_name">Create a Meeting</h1>
	<h2>My Advisor\'s Availability</h2>';
	
	$advisorID = $_SESSION['advisor'];
	
	echo '
	<table class="info_table">
	<tr>
		<th><p>Monday:</p></th>
		<td><p>';
		echo '&emsp;';
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

		echo '</p></td>
	</tr>
	<tr>
		<th><p>Tuesday:</p></th>
		<td><p>';
		echo '&emsp;';
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

		echo '</p></td>
	</tr>
	<tr>
		<th><p>Wednesday:</p></th>
		<td><p>';
		echo '&emsp;';
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

		echo '</p></td>
	</tr>
	<tr>
		<th><p>Thursday:</p></th>
		<td><p>';
		echo '&emsp;';
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

		echo '</p></td>
	</tr>
	<tr>
		<th><p>Friday:</p></th>
		<td><p>';
		echo '&emsp;';
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

		echo '</p></td>
	</tr>
	</table>
	<br><br>
	
	<h2>Schedule a Meeting</h2>
	<form id="advisee" action="" method="post" class="req_form">';
	$meetID = rand(100000, 999999);
	echo'

	
	<label for="myDate">Date: </label>
	<input type="date" name="myDate" id="myDate"  required>
	<br><br><label for="timeStart">Start Time: </label>
	<input type="time" name="timeStart" id="timeStart" required>
	<br><br><label for="timeEnd">End Time: </label>
	<input type="time" name="timeEnd" id="timeEnd" required>
	<br><br><label for="myLocation">Location: </label>
	<input type="select" name="myLocation" id="myLocation" list="location" required>
	<datalist id="location">
	<option>Office</option>
	<option>Virtual</option>
	</datalist>
	<br><br><label for="myNotes">Notes: </label><br>
	<input type="text" name="myNotes" id="myNotes" size="40" style="height:120px;" required>
	<input type="hidden" name="meetingID" id="meetingID" value="'; echo $meetID; echo '" required>
	<input type="hidden" name="studentID_fk_meet" id="studentID" value="'; echo $_SESSION['username']; echo '" required>
	<input type="hidden" name="facultyID_fk_meet" id="facultyID" value="'; echo $_SESSION['advisor']; echo '" required>
	
	<br><br><input type="submit" value="Create" name="Create">
	</form>
	
	<br><br><br>
</div>

</div>
<div class="footer">
	<p>&copy; Copyright Christopher Newport University 2022</p>
	<a href="mailto:register@cnu.edu">Questions? Contact the Office of the Registrar at register@cnu.edu</a>

</div>



</div>
</body>
';
?>