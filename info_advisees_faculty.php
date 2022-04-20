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
	<h1 class="page_name">Advisee Information</h1>
	<h2>List of Advisees</h2>
	<table class="credit_table">
	<tr>
    <th width="180px"><p>Name</p></th>
    <th width="80px"><p>Student ID</p></th>
	<th width="250px"><p>Email</p></th>
    <th width="80px"><p>Year</p></th>
    <th width="85px"><p>Alt PIN</p></th>
    </tr>';
	
	$username = $_SESSION['username'];
	
	$query1 = "SELECT firstName, lastName, studentID, studentEmail, classStanding, alternatePIN FROM student WHERE advisorID = '$username'";
	mysqli_multi_query($connect, $query1);
	
	do {
		if ($result = mysqli_store_result($connect)) {
			while ($advisee = mysqli_fetch_row($result)) {
				echo '<tr><td><p>'; echo $advisee[0]; echo ' '; echo $advisee[1];
				echo '</p></td><td><p>';
				echo $advisee[2];
				echo '</p></td><td><p>';
				echo $advisee[3];
				echo '</p></td><td><p>';
				echo $advisee[4];
				echo '</p></td><td><p>';
				if (is_null($advisee[5]))
					echo 'Not received';
				else
					echo $advisee[5];
				echo '</p></td></tr>';
			}
		}
	}
	while (mysqli_next_result($connect));
	echo '
	</table>
	<br>
	<h2>Detailed Advisee Information</h2>
	<form id="advisee" action="" method="post" class="">
		<label for="adviseeID" style="font-size:14px;">Enter Student ID: </label>
		<input type="text" name="adviseeID" placeholder=" 00000000 " id="adviseeID" length="8" size="7" required>
		<input style="margin-left:10px;" type="submit" value="Search" name="Search">
	</form>
	<br><br>';
	
	if(isset($_POST['Search'])) {
		$adviseeID = $_POST['adviseeID'];
		$query2 = "SELECT * FROM student WHERE studentID = '$adviseeID'";
		$result2 = mysqli_query($connect, $query2);
		$student = mysqli_fetch_assoc($result2);
		echo '
		<table align="center" class="info_table">
		<tr>
			<th min-width="120px"><p>First Name:</p></th>
			<td><p>'; echo $student['firstName']; echo '</p></td>
		</tr>
		<tr>
			<th><p>Last Name:</p></th>
			<td><p>'; echo $student['lastName']; echo '</p></td>
		</tr>
		<tr>
			<th><p>Student ID:</p></th>
			<td><p>'; echo $student['studentID']; echo '</p></td>
		</tr>
		<tr>
			<th><p>Alternate PIN:</p></th>
			<td><p>';
				if (is_null($student['alternatePIN']))
						echo 'Not received';
					else
						echo $student['alternatePIN'];
				echo '</p></td>
		</tr>
		<tr>
			<th><p>Email Address:</p></th>
			<td><p>'; echo $student['studentEmail']; echo '</p></td>
		</tr>
		<tr>
			<th><p>Class Standing:</p></th>
			<td><p>'; echo $student['classStanding']; echo '</p></td>
		</tr>
		<tr>
			<th><p>Year Enrolled:</p></th>
			<td><p>'; echo $student['yearEnrolled']; echo '</p></td>
		</tr>
		<tr>
			<th><p>Year Graduating:</p></th>
			<td><p>'; echo $student['yearGraduating']; echo '</p></td>
		</tr>
		
		</table>';
	}
	

	
echo '	
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