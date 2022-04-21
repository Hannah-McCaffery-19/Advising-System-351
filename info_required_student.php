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
	<h1 class="page_name">Required Courses</h1>
	<h2>Liberal Learning Curriculum</h2>
	<br>
	<p>'; 
if (($open = fopen("LLCClasses.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($open, 1000, ",")) !== FALSE) {        
	echo '<h3>';
	echo $data[0];
	echo '</h3><br>';
	
	  for($j=1; $j<sizeof($data); $j++){
		  echo $data[$j];
		  echo '&emsp;';
	  }
	  echo '<br><br>';
    }
  
    fclose($open);
  }
	echo'</p>
	<br>
	<h2>Degree Requirements</h2> 
	<form id="degree" action="" method="POST" class="req_form">';
	
	echo '
	<label for="Major1">Major 1: </label>
	<select id="Major1" name="Major1">
    <option value=""></option>';
	$query1 = "SELECT majorName FROM majors";
	mysqli_multi_query($connect, $query1);
	
	do {
		if ($result1 = mysqli_store_result($connect)) {
			while ($major1 = mysqli_fetch_row($result1)) {
				echo '<option value= '; echo str_replace(" ", "_", $major1[0]); echo'>'; echo $major1[0]; echo '</option>';
			}
		}
	}
	while (mysqli_next_result($connect));
	
	echo '
	</select><br><br>
	<label for="Major2">Major 2: </label>
	<select id="Major2" name="Major2">
    <option value=""></option>';
	$query2 = "SELECT majorName FROM majors";
	mysqli_multi_query($connect, $query2);
	do {
		if ($result2 = mysqli_store_result($connect)) {
			while ($major2 = mysqli_fetch_row($result2)) {
				echo '<option value= '; echo str_replace(" ", "_", $major2[0]); echo'>'; echo $major2[0]; echo '</option>';
			}
		}
	}
	while (mysqli_next_result($connect));
	
	echo '
	</select><br><br>
	<label for="Minor1">Minor 1: </label>
	<select id="Minor1" name="Minor1">
    <option value=""></option>';
	$query3 = "SELECT minorName FROM minors";
	mysqli_multi_query($connect, $query3);
	do {
		if ($result3 = mysqli_store_result($connect)) {
			while ($minor1 = mysqli_fetch_row($result3)) {
				echo '<option value= '; echo str_replace(" ", "_", $minor1[0]); echo'>'; echo $minor1[0]; echo '</option>';
			}
		}
	}
	while (mysqli_next_result($connect));
	
	echo '
	</select><br><br>
	<label for="Minor2">Minor 2: </label>
	<select id="Minor2" name="Minor2">
    <option value=""></option>';
	$query4 = "SELECT minorName FROM minors";
	mysqli_multi_query($connect, $query4);
	do {
		if ($result4 = mysqli_store_result($connect)) {
			while ($minor2 = mysqli_fetch_row($result4)) {
				echo '<option value= '; echo str_replace(" ", "_", $minor2[0]); echo'>'; echo $minor2[0]; echo '</option>';
			}
		}
	}
	while (mysqli_next_result($connect));
	
	echo '</select><br><br><input type="submit" value="Submit" name="Submit">
	</form><br><br><br>';
	
	
	if(isset($_POST['Submit'])) {
		$subMajor1 = str_replace("_", " ", $_POST['Major1']);
		$subMajor2 = str_replace("_", " ", $_POST['Major2']);
		$subMinor1 = str_replace("_", " ", $_POST['Minor1']);
		$subMinor2 = str_replace("_", " ", $_POST['Minor2']);
		
		if($_POST['Major1'] != '') {
			$query5 = "SELECT * FROM majors WHERE majorName = '$subMajor1'";
			$result5 = mysqli_query($connect, $query5);
			$maj1info = mysqli_fetch_assoc($result5);
			echo '<h2>'; echo $maj1info['majorName']; echo '</h2>';
			echo '<h3>Department: '; echo $maj1info['deptName_fk_maj']; echo '</h3><br>';
			echo '<h3>Required Courses</h3>'; echo $maj1info['requiredClasses'];
			echo '<h3>Elective Courses</h3>'; echo $maj1info['electiveClasses']; echo '<br><br><br><br>';
		}
		
		if($_POST['Major2'] != '') {
			$query6 = "SELECT * FROM majors WHERE majorName = '$subMajor2'";
			$result6 = mysqli_query($connect, $query6);
			$maj2info = mysqli_fetch_assoc($result6);
			echo '<h2>'; echo $maj2info['majorName']; echo '</h2>';
			echo '<h3>Department: '; echo $maj2info['deptName_fk_maj']; echo '</h3><br>';
			echo '<h3>Required Courses</h3>'; echo $maj2info['requiredClasses'];
			echo '<h3>Elective Courses</h3>'; echo $maj2info['electiveClasses']; echo '<br><br><br><br>';
		}
		
		if($_POST['Minor1'] != '') {
			$query7 = "SELECT * FROM minors WHERE minorName = '$subMinor1'";
			$result7 = mysqli_query($connect, $query7);
			$min1info = mysqli_fetch_assoc($result7);
			echo '<h2>'; echo $min1info['minorName']; echo '</h2>';
			echo '<h3>Department: '; echo $min1info['deptName_fk_min']; echo '</h3><br>';
			echo '<h3>Required Courses</h3>'; echo $min1info['requiredClasses'];
			echo '<h3>Elective Courses</h3>'; echo $min1info['electiveClasses']; echo '<br><br><br><br>';
		}
		
		if($_POST['Minor2'] != '') {
			$query8 = "SELECT * FROM minors WHERE minorName = '$subMinor2'";
			$result8 = mysqli_query($connect, $query8);
			$min2info = mysqli_fetch_assoc($result8);
			echo '<h2>'; echo $min2info['minorName']; echo '</h2>';
			echo '<h3>Department: '; echo $min2info['deptName_fk_min']; echo '</h3><br>';
			echo '<h3>Required Courses</h3>'; echo $min2info['requiredClasses'];
			echo '<h3>Elective Courses</h3>'; echo $min2info['electiveClasses']; echo '<br><br><br><br>';
		}
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