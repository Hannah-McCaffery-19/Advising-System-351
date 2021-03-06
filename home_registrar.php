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
			<a href="home_registrar.html"><h1>Advising System</h1></a>
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
	<h1 class="page_name">Home</h1>
	<h1>Notice: Fall Registration</h1>
	<h2>Registration Periods for Currently Enrolled Students:</h2>
	<h3>Friday, March 18, 2022 - Friday, April 1, 2022</h3>
	<br>
	<h3>Graduate Students</h3>
	<p>&emsp;&emsp;Friday, March 18, 2022 - opens at 10 a.m.</p>
	<h3>Undergraduates with at least 106 earned credit hours</h3>
	<p>&emsp;&emsp;Tuesday, March 22, 2022 - opens at 7 a.m.</p>
	<h3>Undergraduates with 90 - 105 earned credit hours</h3>
	<p>&emsp;&emsp;Tuesday, March 22, 2022 - Opens at 7:30 a.m.</p>
	<h3>Undergraduates with 76 - 89 earned credit hours</h3>
	<p>&emsp;&emsp;Thursday, March 24, 2022 - opens at 7 a.m.</p>
	<h3>Undergraduates with 60 - 75 earned credit hours</h3>
	<p>&emsp;&emsp;Thursday, March 24, 2022 - opens at 7:30 a.m.</p>
	<h3>Undergraduates with 46 - 59 earned credit hours</h3>
	<p>&emsp;&emsp;Monday, March 28, 2022 - opens at 7 a.m.</p>
	<h3>Undergraduates with 30 - 45 earned credit hours</h3>
	<p>&emsp;&emsp;Monday, March 28, 2022 - opens at 7:30 a.m.</p>
	<h3>Undergraduates with 16 - 29 earned credit hours</h3>
	<p>&emsp;&emsp;Wednesday, March 30, 2022 - opens at 7 a.m.</p>
	<h3>Undergraduates with at most 15 earned credit hours</h3>
	<p>&emsp;&emsp;Wednesday, March 30, 2022 - opens at 7:30 a.m.</p>
	<br>
	<h3>Registration closes Friday, April 1, 2022 at 11:59 p.m. for all graduate and undergraduate students.</h3>
	<br><br>
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