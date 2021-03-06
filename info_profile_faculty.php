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
			<a href="home_faculty.php"><h1>Advising System</h1></a>
			<h2>Faculty Portal</h2>
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
	<a href="home_faculty.php"><h3>Home</h3></a>
	<img class="navline" src="images/divider.png">
	<a href="info_P_faculty.php"><h3>Information</h3></a>
	<a href="info_profile_faculty.php"><p>My Profile</p></a>
	<a href="info_advisees_faculty.php"><p>My Advisees</p></a>
	<a href="info_courses_faculty.php"><p>List of Classes</p></a>
	<img class="navline" src="images/divider.png">
	<a href="meet_P_faculty.php"><h3>Meeting</h3></a>
	<a href="meet_sched_faculty.php"><p>Schedule Meeting</p></a>
	<a href="meet_view_faculty.php"><p>View Meetings</p></a>
	<img class="navline" src="images/divider.png">
	<a href="eval_P_faculty.php"><h3>Evaluation</h3></a>
	<a href="eval_create_faculty.php"><p>Generate Evaluation</p></a>
	<a href="eval_view_faculty.php"><p>View Evaluations</p></a>
	<img class="navline" src="images/divider.png">
	<a href="contact_faculty.php"><h3>Contact</h3></a>
	<br><br>
</div>

<div class="content">
	<h1 class="page_name">My Profile</h1>
	<h2>Personal Information</h2>
	<table class="info_table">
	<tr>
		<th><p>Name:</p></th>
		<td><p>'; echo $_SESSION['firstname']; echo' '; echo $_SESSION['lastname']; echo '</p></td>
	</tr>
	<tr>
		<th><p>CNU ID:</p></th>
		<td><p>'; echo $_SESSION['username']; echo '</p></td>
	</tr>
	<tr>
		<th><p>Email:</p></th>
		<td><p>'; echo $_SESSION['email']; echo '</p></td>
	</tr>';
	
	$username = $_SESSION['username'];
	$query1 = "SELECT * FROM faculty WHERE facultyID = '$username'";
	$result1 = mysqli_query($connect, $query1);
	$faculty = mysqli_fetch_assoc($result1);
	
	echo '
	<tr>
		<th><p>Phone:</p></th>
		<td><p>'; echo $faculty['facultyPhone']; echo '</p></td>
	</tr>
	<tr>
		<th><p>Office:</p></th>
		<td><p>'; echo $faculty['office']; echo '</p></td>
	</tr>
	<tr>
		<th><p>Department:</p></th>
		<td><p>'; echo $faculty['department_fk_dept']; echo '</p></td>
	</tr>
	</table>
	<br><br>';
	
	$facultyID = $_SESSION['username'];
	
	echo '
	<h2>My Availability</h2>
	<table class="info_table">
	<tr>
		<th><p>Monday:</p></th>
		<td><p>';
		echo '&emsp;';
		$query = "SELECT * FROM availability WHERE facultyID_fk_avail = '$facultyID' AND day = 'Monday'";
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
		$query = "SELECT * FROM availability WHERE facultyID_fk_avail = '$facultyID' AND day = 'Tuesday'";
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
		$query = "SELECT * FROM availability WHERE facultyID_fk_avail = '$facultyID' AND day = 'Wednesday'";
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
		$query = "SELECT * FROM availability WHERE facultyID_fk_avail = '$facultyID' AND day = 'Thursday'";
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
		$query = "SELECT * FROM availability WHERE facultyID_fk_avail = '$facultyID' AND day = 'Friday'";
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