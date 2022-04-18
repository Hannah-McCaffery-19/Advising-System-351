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
			<a href="home_student.html"><h1>Advising System</h1></a>
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
	<a href="home_student.html"><h3>Home</h3></a>
	<img class="navline" src="images/divider.png">
	<a href="home_student.html"><h3>Information</h3></a>
	<a href="home_student.html"><p>My Profile</p></a>
	<a href="home_student.html"><p>My Advisor</p></a>
	<a href="home_student.html"><p>Requirements</p></a>
	<a href="home_student.html"><p>List of Courses</p></a>
	<img class="navline" src="images/divider.png">
	<a href="home_student.html"><h3>Meeting</h3></a>
	<a href="home_student.html"><p>Schedule Meeting</p></a>
	<a href="home_student.html"><p>View Meetings</p></a>
	<img class="navline" src="images/divider.png">
	<a href="home_student.html"><h3>Evaluation</h3></a>
	<a href="home_student.html"><p>Generate Evaluation</p></a>
	<a href="home_student.html"><p>View Evaluations</p></a>
	<img class="navline" src="images/divider.png">
	<a href="home_student.html"><h3>Contact</h3></a>
	<br><br>
</div>

<div class="content">
	<h1 class="page_name">Student Advising</h1>
	<h1>Lorem Ipsum</h1>
	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
	
	<h2>Lorem Ipsum</h2>
	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
	
	<h3>Lorem Ipsum</h3>
	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
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