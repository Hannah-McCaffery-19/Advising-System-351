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
	<a href="home_student.php"><p>My Advisor</p></a>
	<a href="home_student.php"><p>Requirements</p></a>
	<a href="home_student.php"><p>List of Courses</p></a>
	<img class="navline" src="images/divider.png">
	<a href="home_student.php"><h3>Meeting</h3></a>
	<a href="home_student.php"><p>Schedule Meeting</p></a>
	<a href="home_student.php"><p>View Meetings</p></a>
	<img class="navline" src="images/divider.png">
	<a href="home_student.php"><h3>Evaluation</h3></a>
	<a href="home_student.php"><p>Generate Evaluation</p></a>
	<a href="home_student.php"><p>View Evaluations</p></a>
	<img class="navline" src="images/divider.png">
	<a href="home_student.php"><h3>Contact</h3></a>
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
	$query1 = "SELECT * FROM student WHERE studentID = '$username'";
	$result1 = mysqli_query($connect, $query1);
	$student = mysqli_fetch_assoc($result1);
	
	echo '
	</tr>
		<tr>
		<th><p>Class Standing:</p></th>
		<td><p>'; echo $student['classStanding']; echo '</p></td>
	</tr>
	</tr>
		<tr>
		<th><p>Year Enrolled:</p></th>
		<td><p>'; echo $student['yearEnrolled']; echo '</p></td>
	</tr>
	</tr>
		<tr>
		<th><p>Year Graduating:</p></th>
		<td><p>'; echo $student['yearGraduating']; echo '</p></td>
	</tr>
	</table>
	<br><br>
	<h2>Enrollment Records</h2>
	<table class="credit_table">
	<tr>
    <th width="120px"><p>Course</p></th>
    <th width="80px"><p>Taken</p></th>
    <th width="50px"><p>Grade</p></th>
    <th width="50px"><p>GPA</p></th>
    </tr>';
	
	$query2 = "SELECT * FROM records WHERE studentID_FK = '$username'";
	mysqli_multi_query($connect, $query2);
	$courses = array();
	$gpa = array();
	
	do {
		if ($result = mysqli_store_result($connect)) {
			while ($record = mysqli_fetch_row($result)) {
				array_push($courses, $record[2]);
				echo '<tr><td><p>'; echo $record[2];
				echo '</p></td><td><p>';
				echo $record[4]; echo ' '; echo $record[5];
				echo '</p></td><td><p>';
				echo $record[3];
				echo '</p></td><td><p>';
				if ($record[3] == 'A+') {
					echo '4.0';
					array_push($gpa, 4.0);
				}
				elseif ($record[3] == 'A') {
					echo '3.7';
					array_push($gpa, 3.7);
				}
				elseif ($record[3] == 'A-') {
					echo '3.5';
					array_push($gpa, 3.5);
				}
				elseif ($record[3] == 'B+') {
					echo '3.3';
					array_push($gpa, 3.3);
				}
				elseif ($record[3] == 'B') {
					echo '3.0';
					array_push($gpa, 3.0);
				}
				elseif ($record[3] == 'B-') {
					echo '2.7';
					array_push($gpa, 2.7);
				}
				elseif ($record[3] == 'C+') {
					echo '2.3';
					array_push($gpa, 2.3);
				}
				elseif ($record[3] == 'C') {
					echo '2.0';
					array_push($gpa, 2.0);
				}
				elseif ($record[3] == 'C-') {
					echo '1.7';
					array_push($gpa, 1.7);
				}
				elseif ($record[3] == 'D+') {
					echo '1.3';
					array_push($gpa, 1.3);
				}
				elseif ($record[3] == 'D') {
					echo '1.0';
					array_push($gpa, 1.0);
				}
				elseif ($record[3] == 'D-') {
					echo '0.7';
					array_push($gpa, 0.7);
				}
				elseif ($record[3] == 'F') {
					echo '0.0';
					array_push($gpa, 0.0);
				}
				echo '</p></td></tr>';
			}
		}
	}
	while (mysqli_next_result($connect));
	
	$creditTotal = 0;
	$count = 0;
	for ($i = 0; $i < count($courses); $i++) {
		$course = $courses[$i];
		$query3 = "SELECT SUM(creditHours) AS creditSum FROM general_course_listing WHERE courseID = '$course'";
		$result3 = mysqli_query($connect, $query3);
		$credit = mysqli_fetch_assoc($result3);
		$creditTotal += $credit['creditSum'];
		$count ++;
	}
	
	$cumulGPA = (array_sum($gpa))/$count;
	$cumulGPA = number_format($cumulGPA, 1, '.', '');
	
	echo '
	</table>
	<br>
	<table class="info_table">
	<tr>
		<th width="200px"><p>Total accumulated credits:</p></th>
		<td width="60px"><p>'; echo $creditTotal; echo '</p></td>
	</tr>
	<tr>
		<th width="200px"><p>Total cumulative GPA:</p></th>
		<td width="60px"><p>'; echo $cumulGPA; echo '</p></td>
	</tr>
	</table>
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