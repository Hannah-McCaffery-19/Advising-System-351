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
	<h1 class="page_name">Create Class</h1>
	<h2>Generate a New Class</h2>';
	if(isset($_POST['Create'])) {
		$firstName = $_POST['firstName'];
		$lastName = $_POST['lastName'];
		$studentPhone = $_POST['studentPhone'];
		$studentAddress = $_POST['studentAddress'];
		$classStanding = $_POST['classStanding'];
		$yearEnrolled = $_POST['yearEnrolled'];
		$advisorEmail = $_POST['advisor'];
		
		$yearEnd = substr($yearEnrolled, -2);
		$change = 'Change';
		$dot = '.';
		$domain = '@cnu.edu';
		
		//student ID
		$prefixID = '009';
		$randID = rand(10000, 99999);
		$studentID = $prefixID . $randID;
		
		//password Change. + year
		$password = $change . $dot . $yearEnd;
		
		//email first name + last name + year @cnu.edu
		$studentEmail = $firstName . $lastName . $dot . $yearEnd . $domain;
		
		//year graduating enrolled + 4
		$yearGraduating = $yearEnrolled + 4;
		
		//advisor query id from email
		$query2 = "SELECT facultyID FROM faculty WHERE facultyEmail = '$advisorEmail'";
		$result2 = mysqli_query($connect, $query2);
		$myadvisor = mysqli_fetch_assoc($result2);
		$advisorID = $myadvisor['facultyID'];
		
		//echo $studentID;
		//echo $firstName;
		//echo $lastName;
		//echo $password;
		//echo $studentEmail;
		//echo $studentPhone;
		//echo $studentAddress;
		//echo $classStanding;
		//echo $yearEnrolled;
		//echo $yearGraduating;
		//echo $advisorID;			
		
		$query1 = "INSERT INTO `student`(`studentID`, `firstName`, `lastName`, `password`, `studentEmail`, `studentPhone`, `studentAddress`, `classStanding`, `yearEnrolled`, `yearGraduating`, `alternatePIN`, `advisorID`) VALUES ('$studentID','$firstName','$lastName','$password','$studentEmail','$studentPhone','$studentAddress','$classStanding','$yearEnrolled','$yearGraduating','NULL','$advisorID')";
		$result1 = mysqli_query($connect, $query1);
		
		echo '<h3>Student Created.</h3><br><br>';
	}

	
	
	echo '
	<form id="student" action="" method="post" class="req_form">
	
	<label for="firstName">First Name: </label>
	<input type="text" name="firstName" id="firstName" required>
	
	<br><br><label for="lastName">Last Name: </label>
	<input type="text" name="lastName" id="lastName" required>
	
	<br><br><label for="studentPhone">Phone #: </label>
	<input type="text" name="studentPhone" id="studentPhone">
	
	<br><br><label for="studentAddress">Address: </label>
	<input type="text" name="studentAddress" id="studentAddress">
	
	<br><br><label for="classStanding">Class Standing: </label>
	<select name="classStanding" id="classStanding" required>
	<option value="Freshman">Freshman</option>
	<option value="Sophomore">Sophomore</option>
	<option value="Junior">Junior</option>
	<option value="Senior">Senior</option>
	</select>
	
	<br><br><label for="yearEnrolled">Year Enrolled: </label>
	<input name="yearEnrolled" id="yearEnrolled" type="number" min="1900" max="2099" step="1" value="2022" required>
	
	<br><br><label for="advisor">Advisor: </label>
	<select id="advisor" name="advisor" required>';
	$query1 = "SELECT facultyEmail FROM faculty";
	mysqli_multi_query($connect, $query1);
	
	do {
		if ($result1 = mysqli_store_result($connect)) {
			while ($advisor = mysqli_fetch_row($result1)) {
				echo '<option value="'; echo $advisor[0]; echo'">'; echo $advisor[0]; echo '</option>';
			}
		}
	}
	while (mysqli_next_result($connect));
	
	echo '
	</select>
	
	<br><br><input type="submit" value="Create" name="Create">
	</form>
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