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
	<h1 class="page_name">View Meetings</h1>
	<h2>Created Meetings</h2>
	<p>TODO: query meeting, format each result in table with an edit and delete button</p>
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
?>