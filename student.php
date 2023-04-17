<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "statspoly";

$conn = new mysqli($hostname, $username, $password, $database);
if ($conn->connect_error){
	die("Connection Failed" . $conn->connect_error);
}
session_start();
if (!isset($_SESSION['user_admn'])) {
    header('Location: index.php');
    exit;
}
$user=$_SESSION['user_admn'];
$usersem=$_SESSION['user_sem'];
$usertype=$_SESSION['user_type'];
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width-device-width, initial-scale-1.0">
		<title>Students's Portal</title>
		<link rel="stylesheet" href="statspoly.css">
	</head>
	
	<body>
		<div class="navbar">
			<div><a href="#">STATSPOLY</a></div>
			<div><a href="index.php">LOGOUT</a></div>
			<div><a href="#stats">STATS</a></div>
			<div><a href="#grades">GRADES</a></div>
			<div><a href="#profile">HOME</a></div>
			<div style="clear: both;"></div>
		</div>
		<div class="container">
			<h3 style="font-size: 3em; letter-spacing: 0.5em;">STATSPOLY</h3>
			<h3 style="line-height: 3em;">-SEEK EASY!</h3>
			<div class="row" id="profile">
				<div class="card-03">
					<h3>HOME</h3>
					<div class="profile">
						<?php
						$sql="SELECT * FROM registration WHERE admn=".$_SESSION['user_admn'];
						$result = $conn->query($sql);
						$row = $result->fetch_assoc();
						
						echo "<table>";
						if ($result->num_rows>0){
							echo "<tr>";
							echo "<th>Name</th>";
							echo "<td>".$row['name']."</td>";
							echo "</tr>";
							echo "<tr>";
							echo "<th>Admission Number</th>";
							echo "<td>".$row['admn']."</td>";
							echo "</tr>";
							echo "<tr>";
							echo "<th>Mail ID</th>";
							echo "<td>".$row['mail']."</td>";
							echo "</tr>";
							echo "<tr>";
							echo "<th id='grades'>Mobile</th>";
							echo "<td>".$row['mobile']."</td>";
							echo "</tr>";

						}
						echo "</table>";
						?>
					</div>
					<div class="row">
						<?php
						$max_query = "SELECT MAX(sem) AS max_value FROM subjects";
						$result = $conn->query($max_query);
						$row = $result->fetch_assoc();
						$max_value = $row['max_value'];
						
						for($i=1; $i<=$max_value; $i++){
							echo "<div class='card-01' style='float: left; width: 50%'>";
							echo "<h3>SEM".$i." CGPA</h3>";
							$s4 = "SELECT registration.admn, subjects.credit, results.grade , results.grade * subjects.credit AS result,
								subjects.credit * 10 AS credits
								FROM subjects
								INNER JOIN results ON subjects.code=results.code
								INNER JOIN registration ON registration.admn=results.admn
								WHERE registration.admn=$user AND registration.sem=$i";
								$formatted_cgpa=0;
								$r4 = $conn->query($s4);
								if($r4->num_rows>0){
								$cgpa=0;
								$res=0;
								$div=0;
								while($row4=$r4->fetch_assoc()){
									$s=0;
									$c=0;
									$c=$row4['credits'];
									$s=$row4['result'];
									$div+=$c;
									$res+=$s;
								}
								$cgpa=($res/$div)*10;
								$formatted_cgpa = number_format($cgpa, 2);
								echo $formatted_cgpa;
								}else{
									echo $formatted_cgpa;
								}
							echo "</div>";
						}						
						?>
						<div style="clear: both;"></div>
					</div>
				</div>
			</div>
			
			<?php
			$max_query = "SELECT MAX(sem) AS max_value FROM subjects";
			$result = $conn->query($max_query);
			$row = $result->fetch_assoc();
			$max_value = $row['max_value'];
			
			for($i=1; $i<=$max_value; $i++){
				echo"<div class='card-03 ' style='padding: 2em;'>";
				echo"<h3>SEMESTER 0$i</h3>";
				echo"<form method=POST style='margin: 2em auto;'>";
				echo"<table style='width: 100%; margin: 0 auto;'>";
				echo"<tr><th style='padding: 0 0.4em;'>CODE</th><th style='padding: 0 0.4em;'>NAME</th><th style='padding: 0 0.4em;'>CREDIT</th><th style='padding: 0 0.4em;'>Imark</th><th colspan='7'>GRADE</th></tr>";
				echo"<tr><td></td><td></td><td></td><td></td><td style='letter-spacing: 1em; padding-left: 0.8em;'>SABCDEF</td>";
				$sql="SELECT * FROM subjects where sem=$i AND 'type'=$usertype";
				$result=$conn->query($sql);
				if($result->num_rows>0){
					$j=1;
					while($row=$result->fetch_assoc()){
						$ssem = "co" .$i.$j;
						$grade = "g" .$i.$j;
						$simark = "i".$i.$j;
						echo "<tr>";
						echo "<td style='padding: 1em; width: 10%;'>
						<input type='text' name='$ssem' value=".$row["code"]." readonly style='font-weight: 700; text-align: center; width: 100%;'>
						</td>";
						echo "<td style='text-align: left; width: 45%;'>".$row["name"]."</td>";
						echo "<td style='width: 5%;'>".$row["credit"]."</td>";
						echo "<td style='width: 5%;'>";
						echo "<input type='text' name=$simark class='num-inputs' style='text-align: center; width: 100%; margin: 0;'>";
						echo "</td>";
						echo "<td style='width: 35%;'>";
						echo "<input type='radio' name='$grade' value='S' style='margin: 0 0.5em;'>";
						echo "<input type='radio' name='$grade' value='A' style='margin: 0 0.5em;'>";
						echo "<input type='radio' name='$grade' value='B' style='margin: 0 0.5em;'>";
						echo "<input type='radio' name='$grade' value='C' style='margin: 0 0.5em;'>";
						echo "<input type='radio' name='$grade' value='D' style='margin: 0 0.5em;'>";
						echo "<input type='radio' name='$grade' value='E' style='margin: 0 0.5em;'>";
						echo "<input type='radio' name='$grade' value='F' style='margin: 0 0.5em;'>";
						echo "</td>";
						echo "</tr>";
						$j++;
					}
				}
				echo "</table>";
				echo "<input type='submit' class='btn-ppt' name='sem$i' value='Save'>";
				echo "</form>";
				if(isset($_POST["sem$i"])){
					$sql="SELECT * FROM subjects where sem=$i";
					$result=$conn->query($sql);
					if($result->num_rows>0){
						$y=1;
						while($row=$result->fetch_assoc()){
							$scode=$_POST["co$i$y"];
							$sgrade=$_POST["g$i$y"];
							if($sgrade=='S'){
								$ssgrade=10;
							}
							else if($sgrade=='A'){
								$ssgrade=9;
							}
							else if($sgrade=='B'){
								$ssgrade=8;
							}
							else if($sgrade=='C'){
								$ssgrade=7;
							}
							else if($sgrade=='D'){
								$ssgrade=6;
							}
							else if($sgrade=='E'){
								$ssgrade=5;
							}
							else{
								$ssgrade=0;
							}
							$simark=$_POST["i$i$y"];
							$sql2="SELECT * FROM results WHERE admn='$user' AND code='$scode'";
							$result2=$conn->query($sql2);
							if($result2->num_rows>0){
								$sql21="UPDATE results SET grade='$ssgrade' WHERE admn='$user' AND code='$scode'";
								$conn->query($sql21);
								$sql22="UPDATE results SET imark='$simark' WHERE admn='$user' AND code='$scode'";
								$conn->query($sql22);
								$sql23="UPDATE results SET sem='$i' WHERE admn='$user' AND code='$scode'";
								$conn->query($sql23);
							}
							else{
								$sql22="INSERT INTO results (admn, code, grade, imark, sem) VALUES ('$user', '$scode', '$ssgrade', '$simark', '$i')";
								$conn->query($sql22);
							}
							$y++;
						}
					}
				}
				echo"</div>";
			}
			?>
		</div>	
	</body>
</html>