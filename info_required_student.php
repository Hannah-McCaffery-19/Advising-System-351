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
	<p>'; 
if (($open = fopen("LLCClasses.csv", "r")) !== FALSE) {
  
    while (($data = fgetcsv($open, 1000, ",")) !== FALSE) {        
	echo '<br><h3>';
	echo $data[0];
	echo '</h3><br>';
	
	  for($j=1; $j<sizeof($data); $j++){
		  if($j%10 == 0){
			  echo '<br>';
		  }
		  echo $data[$j];
		  echo '  ';
	  }
    }
  
    fclose($open);
  }
	echo'</p>
	<br>
	<h2>Major</h2> 
	<form action="info_required_student_major_form.php" method="POST">';
	echo '
	<select id="Major" name="Major">
    <option value="_"></option>';
	if (($open = fopen("MajorReqs.csv", "r")) !== FALSE) {
  
    while (($data = fgetcsv($open, 1000, ",")) !== FALSE) {        
		echo "<option value= ". $data[0].">".$data[0]."</option>"; 
	}
	
    fclose($open);
  }
  echo '</select>
  <input type="submit">
  </form>
	<br>
	<h2>Minor</h2>
	<form action="info_required_student_major_form.php" method="POST">';
	echo '
	<select id="Minor" name="Minor">
    <option value="_"></option>';
	if (($open = fopen("MinorReqs.csv", "r")) !== FALSE) {
  
    while (($data = fgetcsv($open, 1000, ",")) !== FALSE) {        
		echo "<option value= ". $data[0].">".$data[0]."</option>"; 
	}
	
    fclose($open);
  }
  echo '</select>
  <input type="submit">
  </form>';
  echo '
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