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
	<h1 class="page_name">Generate Evaluation</h1>
	<h2>Create A New Evaluation</h2>
	<form action="" method="post"> Major 1:</action>
	<select id="Major" name="Major" required>
    <option value="_"></option>';
	if (($open = fopen("MajorReqs.csv", "r")) !== FALSE) {
  
    while (($data = fgetcsv($open, 1000, ",")) !== FALSE) {        
		echo "<option value= ". $data[0].">".$data[0]."</option>"; 
	}
	
    fclose($open);
  }
  echo '</select><br> Major 2:
  
  <select id="Major2" name="Major2">
    <option value="_"></option>';
	if (($open = fopen("MajorReqs.csv", "r")) !== FALSE) {
  
    while (($data = fgetcsv($open, 1000, ",")) !== FALSE) {        
		echo "<option value= ". $data[0].">".$data[0]."</option>"; 
	}
	
    fclose($open);
  }
  echo '</select><br><br>Minor 1:
  <select id="Minor1" name="Minor1">
    <option value="_"></option>';
	if (($open = fopen("MinorReqs.csv", "r")) !== FALSE) {
  
    while (($data = fgetcsv($open, 1000, ",")) !== FALSE) {        
		echo "<option value= ". $data[0].">".$data[0]."</option>"; 
	}
	
    fclose($open);
  }
  echo '</select><br>Minor 2:
  <select id="Minor2" name="Minor2">
    <option value="_"></option>';
	if (($open = fopen("MinorReqs.csv", "r")) !== FALSE) {
  
    while (($data = fgetcsv($open, 1000, ",")) !== FALSE) {        
		echo "<option value= ". $data[0].">".$data[0]."</option>"; 
	}
	
    fclose($open);
  }
  echo '</select>
  <br>
  <input type="submit">
  </form><br>';
  
if(isset($_POST['Major'])){
	echo '<table>
	<h3><tr><td>Requirement&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td>Fullfilled(yes/no)</td></tr></h3>';
	$studentCourses = [];
	$username = $_SESSION['username'];
	$query1 = "SELECT * FROM student WHERE studentID = '$username'";
	$result = mysqli_query($connect, $query1);
	$record = mysqli_fetch_row($result);
	if ($result = mysqli_store_result($connect)) {
			while ($record = mysqli_fetch_row($result)) {
				array_push($studentcourses, $record[2]);
			}
	}
	$majorReqs = getMajorReqs($_POST['Major']);
	$majorElectives = getMajorElectives($_POST['Major']);
	foreach($majorReqs as $c){
		echo '<tr><td>'.$c.'</td>';
		$f =0;
		$found = 0;
		while($f < sizeof($studentCourses) && $found == 0){
			if($studentCourses[$f] == $c){
				echo "<td>Y</td></tr>";
				$found = 1;
			}
			$f++;
		}
		if($found == 0) {
			echo "<td>N</td></tr>";
		}
	}
	echo '<tr><td>Major Electives</td><td></td></tr>';
	$i =0;
	while($i < sizeof($majorElectives)){
		if($majorElectives[$i] == "||"){
			$temp = $i;
			$i += 1;
			echo "<tr><td>Complete One of the following: ";
			while($majorElectives[$i] != "\||"){
				echo $majorElectives[$i]." ";
				$i += 1;
			}
			$i += 1;
			echo "</td><td>";
			$found = 0;
			while($majorElectives[$temp] != "\||" && $found == 0){
				$y = 0;
				while($y < sizeof($studentCourses) && found == 0){
					if($y == $majorElectives[$temp]){
						echo "Y</td></tr>";
					}
					$y++;
				}
				$temp++;
			}
			if ($found == 0){
				echo "N</td></tr>";
			}
		}
		elseif($majorElectives[$i] =="|&") {
			$i+= 1;
			$temp = $i;
			echo "<tr><td>Complete One of the following Sections: ";
			while($majorElectives[$i] != "\&|"){
				if($majorElectives[$i] == '|'){
					echo ' or ';
					$i++;
				}
				echo $majorElectives[$i]." ";
				$i += 1;
			}
			$i += 1;
			echo "</td><td>";
			$found = 0;
			while($majorElectives[$temp] != "\&|" && $found == 0){
				$y = 0;
				while($y < sizeof($studentCourses) && found == 0){
					if($y == $majorElectives[$temp]){
						echo "Y</td></tr>";
					}
					$y++;
				}
				$temp++;
			}
			if ($found == 0){
				echo "N</td></tr>";
			}
			$i += 1;
		}
			
		
		elseif(substr($majorElectives[$i], 0, 1) == 's') {
			$i += 1;
			while (substr($majorElectives[$i], 0, 2) != "\s") {
				$i += 1;
			}
			$i += 1;
		}
		elseif(substr($majorElectives[$i], 0, 1) == "n") {
			$i += 1;
			while (substr($majorElectives[$i], 0, 2) != '\n') {
				$i += 1;					
			}
			$i += 1;
		}
		else{
			echo $majorElectives[$i]."  ";
			$i+=1;
		}
	}
		
}
	



echo '</table>
</div>
</body>
';
function getMajorReqs($major) {
	$reqs =[];
	if (($open = fopen("MajorReqs.csv", "r")) !== FALSE) {
	while (($data = fgetcsv($open, 1000, ",")) !== FALSE) { 
		if($data[0] == $major){
			$i = 1;
			while ($data[$i] != '') {
				$i+=1;
				array_push($reqs, $data[$i]);
			}
		}
	}
	fclose($open);
	}
	return $reqs;
}
function getMajorElectives($major){
	$reqs = array();
	if (($open = fopen("MajorElectives.csv", "r")) !== FALSE) {
		
		while (($data = fgetcsv($open, 1100, ",")) !== FALSE) { 
			if($data[0] == $_POST['Major']){
				$i = 1;
				while ($data[$i] != "") {
					array_push($reqs, $data[$i]);
					$i++;
					
				}
			}
		}
		fclose($open);
	}
	return $reqs;
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
</body>';
	
?>