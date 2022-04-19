<?php
session_start();

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
	<a href="home_registrar.php"><p>List of Courses</p></a>
	<img class="navline" src="images/divider.png">
	<a href="home_registrar.php"><h3>Student Accounts</h3></a>
	<a href="home_registrar.php"><p>Create Student Accounts</p></a>
	<a href="home_registrar.php"><p>Generate Alternate PINs</p></a>
	<img class="navline" src="images/divider.png">
	<a href="home_registrar.php"><h3>Evaluation</h3></a>
	<a href="home_registrar.php"><p>Create Courses</p></a>
	<a href="home_registrar.php"><p>Edit Course Information</p></a>
	<img class="navline" src="images/divider.png">
	<a href="home_registrar.php"><h3>Contact</h3></a>
	<br><br>
</div>

<div class="content">
	<h1 class="page_name">Registrar - Home</h1>
	<h1>Overview</h1>
	<p>Your personal profile and the upcoming term course schedule can be viewed here. See below for specific page functions.</p>
	<br>
	<h2>My Profile</h2>
	<p>View your faculty profile.</p>
	<br>
	<h2>List of Courses</h2>
	<p>View the list of courses available in the upcoming registration period.</p>
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