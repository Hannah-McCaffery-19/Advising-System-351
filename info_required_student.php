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
	<form action="" method="POST">';
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
  </form>';
  if(isset($_POST['Major'])){
    
	if (($open = fopen("MajorReqs.csv", "r")) !== FALSE) {
		echo "<h2>".$_POST['Major'].":</h2>";
  
		while (($data = fgetcsv($open, 1000, ",")) !== FALSE) { 
			if($data[0] == $_POST['Major']){
				$i = 1;
				echo "<h3>Required Calasses:</h3>";
				while ($data[$i] != '') {
					if($i %10 == 0){
						echo "<br>";
					}
					echo $data[$i]."  ";
					$i+=1;
				}
			}
		}
		fclose($open);
	}
	
	if (($open = fopen("MajorElectives.csv", "r")) !== FALSE) {
  
		while (($data = fgetcsv($open, 1100, ",")) !== FALSE) { 
			if($data[0] == $_POST['Major']){
				$i = 1;
				echo "<h3>Required Elective Classes:</h3><br>";
				while ($data[$i] != '') {
					if($i %12 == 0){
						echo "<br>";
					}
					if($data[$i] == "||"){
						$i += 1;
						$j = 1;
						echo "<br><h4>complete one of the following:</h4>";
						while($data[$i] != "\||"){
							if($j%12==0){
								echo "<br>";
							}
							echo $data[$i]."  ";
							$i += 1;
							$j +=1;
						}
						$i += 1;
					}
					elseif($data[$i] =="|&") {
						$i+= 1;
						$j =1;
						echo "<br><h4>complete one of the following catagories:</h4>";
						while($data[$i] != "\&|"){
							if($j%12==0){
								echo "<br>";
							}
							if($data[$i] == "|"){
								echo "<h5> or </h5>";
								$i += 1;
							}
							echo $data[$i]." ";
							$i += 1;
							$j += 1;
						}
						$i += 1;
					}
					elseif(substr($data[$i], 0, 1) == 's') {
						echo "<br><h4>select ".substr($data[$i], 1)." courses from the following list: </h4>";
						$i += 1;
						$j = 1;
						while (substr($data[$i], 0, 2) != "\s") {
							if($j%12==0){
								echo "<br>";
							}
							echo $data[$i]."  ";
							$i += 1;
							$j += 1;
						}
						$i += 1;
					}
					elseif(substr($data[$i], 0, 1) == "n") {
						if(substr($data[$i], 4, 1) == "o"){
							echo "<br><h4>complete ".substr($data[$i], 1, 2)." credit hours from the following list only ".substr($data[$i], 5, 1)."can be ".substr($data[$i], 7)." level: </h4>";
						}
						elseif(substr($data[$i], 3, 1) == "o"){
							echo "<br><h4>complete ".substr($data[$i], 1, 2)." credit hours from the following list only ". substr($data[$i], 4, 1)."can be ".substr($data[$i], 6)+" level: </h4>";
						}
						else{
							echo "<br><h4>complete ".substr($data[$i], 1, 2)." credit hours from the following list :</h4>";
						}
						$i += 1;
						$j =1;
						while (substr($data[$i], 0, 2) != '\n') {
							if($j%12==0){
								echo "<br>";
							}
							echo " ".$data[$i];
							$i += 1;
							
							
						}
						$i += 1;
					}
					else{
						echo $data[$i]."  ";
						$i+=1;
					}
				}
			}
		}
		fclose($open);
	}
}
	
	echo '<br>
	<h2>Minor</h2>
	<form action="" method="POST">
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
  if(isset($_POST['Minor'])){
    
	if (($open = fopen("MinorReqs.csv", "r")) !== FALSE) {
		echo "<h2>".$_POST['Minor'].":</h2>";
  
		while (($data = fgetcsv($open, 1000, ",")) !== FALSE) { 
			if($data[0] == $_POST['Minor']){
				$i = 1;
				echo "<h3>Required Calasses:</h3>";
				while ($data[$i] != '') {
					if($i %10 == 0){
						echo "<br>";
					}
					echo $data[$i]."  ";
					$i+=1;
				}
			}
		}
		fclose($open);
	}
	
	if (($open = fopen("MinorElectives.csv", "r")) !== FALSE) {
  
		while (($data = fgetcsv($open, 1000, ",")) !== FALSE) { 
			if($data[0] == $_POST['Minor']){
				$i = 1;
				echo "<h3>Required Elective Calasses:</h3><br>";
				while ($data[$i] != "") {
					if($i %12 == 0){
						echo "<br>";
					}
					if($data[$i] == "||"){
						$i += 1;
						$j = 1;
						echo "<br><h4>complete one of the following:</h4>";
						while($data[$i] != "\||"){
							if($j%12==0){
								echo "<br>";
							}
							echo $data[$i]."  ";
							$i += 1;
							$j +=1;
						}
						$i += 1;
					}
					elseif($data[$i] =="|&") {
						$i+= 1;
						$j =1;
						echo "<br><h4>complete one of the following catagories:</h4>";
						while($data[$i] != "\&|"){
							if($j%12==0){
								echo "<br>";
							}
							if($data[$i] == "|"){
								echo "<h5> or </h5>";
								$i += 1;
							}
							echo $data[$i]." ";
							$i += 1;
							$j += 1;
						}
						$i += 1;
					}
					elseif(substr($data[$i], 0, 1) == 's') {
						echo "<br><h4>select ".substr($data[$i], 1)." courses from the following list: </h4>";
						$i += 1;
						$j = 1;
						while (substr($data[$i], 0, 2) != "\s") {
							if($j%12==0){
								echo "<br>";
							}
							echo $data[$i]."  ";
							$i += 1;
							$j += 1;
						}
						$i += 1;
					}
					elseif(substr($data[$i], 0, 1) == "n") {
						if(substr($data[$i], 4, 1) == "o"){
							echo "<br><h4>complete ".substr($data[$i], 1, 2)." credit hours from the following list only ".substr($data[$i], 5, 1)."can be ".substr($data[$i], 7)." level: </h4>";
						}
						elseif(substr($data[$i], 3, 1) == "o"){
							echo "<br><h4>complete ".substr($data[$i], 1, 2)." credit hours from the following list only ". substr($data[$i], 4, 1)."can be ".substr($data[$i], 6)+" level: </h4>";
						}
						else{
							echo "<br><h4>complete ".substr($data[$i], 1, 2)." credit hours from the following list :</h4>";
						}
						$i += 1;
						$j =1;
						while (substr($data[$i], 0, 2) != '\n') {
							if($j%12==0){
								echo "<br>";
							}
							echo " ".$data[$i];
							$i += 1;
							
							
						}
						$i += 1;
					}
					else{
						echo $data[$i]."  ";
						$i+=1;
					}
				}
			}
		}
		fclose($open);
	}
  }
  echo '
</div>

</div>
<br><br>
<div class="footer">
	<p>&copy; Copyright Christopher Newport University 2022</p>
	<a href="mailto:register@cnu.edu">Questions? Contact the Office of the Registrar at register@cnu.edu</a>

</div>



</div>
</body>
';
?>