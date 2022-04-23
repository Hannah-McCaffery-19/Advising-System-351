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
			<a href="home_registrar.php"><h1>Advising System</h1></a>
			<h2>Registrar Portal</h2>
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
	<a href="home_registrar.php"><h3>Home</h3></a>
	<img class="navline" src="images/divider.png">
	<a href="info_P_registrar.php"><h3>Information</h3></a>
	<a href="info_profile_registrar.php"><p>My Profile</p></a>
	<a href="info_courses_registrar.php"><p>List of Classes</p></a>
	<img class="navline" src="images/divider.png">
	<a href="acct_P_registrar.php"><h3>Student Accounts</h3></a>
	<a href="acct_create_registrar.php"><p>Create Student Accounts</p></a>
	<a href="acct_view_registrar.php"><p>View Accounts</p></a>
	<a href="acct_pins_registrar.php"><p>Generate Alternate PINs</p></a>
	<img class="navline" src="images/divider.png">
	<a href="schd_P_registrar.php"><h3>Schedule of Classes</h3></a>
	<a href="schd_create_registrar.php"><p>Create Class</p></a>
	<a href="schd_edit_registrar.php"><p>Edit Class Information</p></a>
	<img class="navline" src="images/divider.png">
	<a href="contact_registrar.php"><h3>Contact</h3></a>
	<br><br>
</div>
<div class="content">
	<h1 class="page_name">List of Classes</h1>
	<h2>Selection of Classes in the Upcoming Term</h2>
	<p>TODO: query class table and spit it out in a formatted table</p>
	<table class="info_table">
	<tr height="40px" style="font-size:1.3em">
	<th>CRN</th>
	<th>Course</th>
	<th>Section</th>
	<th>Instructor</th>
	<th>Term</th>
	<th>Year</th>
	<th>Location</th>
	</tr>
	';

	$query3 = "SELECT * FROM class";
	mysqli_multi_query($connect, $query3);
		do {
			if ($result3 = mysqli_store_result($connect)) {
				while ($class = mysqli_fetch_row($result3)) {
					echo '<tr>';
					echo '<td><p>'; echo $class[0]; echo '</p></td>';
					echo '<td><p>'; echo $class[1]; echo '</p></td>';
					echo '<td><p>'; echo $class[3]; echo '</p></td>';
					echo '<td><p>'; echo $class[2]; echo '</p></td>';
					echo '<td><p>'; echo $class[4]; echo '</p></td>';
					echo '<td><p>'; echo $class[5]; echo '</p></td>';
					echo '<td><p>'; echo $class[6]; echo '</p></td>';
					echo '</tr>';
				}
			}
		}
		while (mysqli_next_result($connect));

	echo '
	</table>
	<br>
</div>
</div>
<div class="footer">
	<p>&copy; Copyright Christopher Newport University 2022</p>
	<a href="mailto:register@cnu.edu">Questions? Contact the Office of the Registrar at register@cnu.edu</a>
</div>
</div>
</body>
';