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
			<div><a href="#logout">LOGOUT</a></div>
			<div><a href="#stats">STATS</a></div>
			<div><a href="#grades">GRADES</a></div>
			<div><a href="#profile">PROFILE</a></div>
		</div>
		<div class="container">
			<h3 style="font-size: 3em; letter-spacing: 0.5em;">STATSPOLY</h3>
			<h3 style="line-height: 3em;" id="profile">-SEEK EASY!</h3>
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
				</div>
			</div>

			<?php /*?><?php
			$sem=1;
			for($i=1; $i<=6; $i++){
				echo"<div class='row' >";
				echo"<div class='card-03'>";
				echo"<h3>SEMESTER 0".$i."</h3><br>
					<center>
						<form method='POST'>";
							$sql = "SELECT * FROM subjects where sem=".$i;
							$result = $conn->query($sql);
							if ($result->num_rows>0){
								echo "<table><tr><th>CODE</th> <th>NAME</th> <th>CREDIT</th> <th>GRADE</th></tr>";
							}
							$count=1;
							while ($row = $result->fetch_assoc()){
								echo "<tr><td class='td-all' id='co$sem$count' name='co$sem$count'>".$row["code"]."</td><td class='td-name' name='n$sem$count'>".$row["name"]."</td><td class='td-all' id='c$sem$count' name='c$sem$count'>".$row["credit"]."</td><td class='td-all' id='gdd$sem$count' name='gdd$sem$count'>";
								echo "<select class='dd-inputs' id='g$sem$count' name='g$sem$count'><option value='s'>S</option><option value='a'>A</option><option value='b'>B</option><option value='b'>C</option><option value='d'>D</option><option value='e'>E</option><option value='f'>F</option></select></td>";
								$count += 1;
							}
							echo "</table>";
							$count -=1;
							echo "co$sem$count";
							$sem +=1;
							if(isset($_POST['sem1'])){
								$sql="INSERT INTO restults (admn) VALUES('$user')";
								$conn->query($sql);
							}
							echo "<input type='submit' class='btn-ppt' value='Save' name='sem$i'>";
						echo"</form>";
					echo"</center>
				</div>
			</div>";
			}
			?><?php */?>
			
			
			<?php
			$max_query = "SELECT MAX(sem) AS max_value FROM subjects";
			$result = $conn->query($max_query);
			$row = $result->fetch_assoc();
			$max_value = $row['max_value'];
			
			for($i=1; $i<=$max_value; $i++){
				echo"<div class='card-03' style='padding: 2em;'>";
				echo"<h3>SEMESTER 0$i</h3>";
				echo"<form method=POST style='margin: 2em auto;'>";
				echo"<table style='width: 100%; margin: 0 auto; border=0;'>";
				echo"<tr><th>CODE</th><th>NAME</th><th>CREDIT</th><th>GRADE</th></tr>";
				$sql="SELECT * FROM subjects where sem=$i";
				$result=$conn->query($sql);
				if($result->num_rows>0){
					$j=1;
					while($row=$result->fetch_assoc()){
						$ssem = "co" .$i.$j;
						$grade = "g" .$i.$j;
						echo "<tr>";
						//echo "<td style='padding: 0.5em; width: 10%;' name='$ssem'>".$row["code"]."</td>";
						echo "<td style='padding: 1em; width: 10%;'>
						<input type='text' name='$ssem' value=".$row["code"]." readonly style='font-weight: 700; text-align: center; width: 100%;'>
						</td>";
						echo "<td style='text-align: left; width: 50%;'>".$row["name"]."</td>";
						echo "<td style='width: 5%;'>".$row["credit"]."</td>";
						echo "<td style='width: 35%;'>";
						//echo "<input type='text' class='text-inputs' name='$grade' style='text-align: center;'>";
						echo "<input type='radio' name='$grade' id='1$grade' value='S' style='margin: 0 0.5em;' required>";
						echo "<input type='radio' name='$grade' id='2$grade' value='A' style='margin: 0 0.5em;' required>";
						echo "<input type='radio' name='$grade' id='3$grade' value='B' style='margin: 0 0.5em;' required>";
						echo "<input type='radio' name='$grade' id='4$grade' value='C' style='margin: 0 0.5em;' required>";
						echo "<input type='radio' name='$grade' id='5$grade' value='D' style='margin: 0 0.5em;' required>";
						echo "<input type='radio' name='$grade' id='6$grade' value='E' style='margin: 0 0.5em;' required>";
						echo "<input type='radio' name='$grade' id='7$grade' value='F' style='margin: 0 0.5em;' required>";
						echo "<input type='hidden' name='$grade$i'>"
						?>
						<!--<select class='dd-inputs' id=$grade>
						<option value='1'>S</option>
						<option value='2'>A</option>
						<option value='3'>B</option>
						<option value='4'>C</option>
						<option value='5'>D</option>
						<option value='6'>E</option>
						<option value='7'>F</option>
						</select>-->
						<?php
						echo "</td>";
						echo "</tr>";
						$j++;
					}
				}
				echo "</table>";
				echo "<input type='submit' class='btn-ppt' name='savesem$i' value='Save'>";
				echo "<input type='submit' class='btn-ppt' name='updatesem$i' value='Update'>";
				echo "</form>";
				if(isset($_POST["savesem$i"])){
					$sql="SELECT * FROM subjects where sem=$i";
					$result=$conn->query($sql);
					if($result->num_rows>0){
						$y=1;
						while($row=$result->fetch_assoc()){
							$scode=$_POST["co$i$y"];
							$sgrade=$_POST["g$i$y"];
							$sql="INSERT INTO results(admn, code, grade) VALUES('$user', '$scode', '$sgrade')";
							$conn->query($sql);
							$y++;
						}
					}
				}
				if(isset($_POST["updatesem$i"])){
					$sql="SELECT * FROM subjects where sem=$i";
					$result=$conn->query($sql);
					if($result->num_rows>0){
						$y=1;
						while($row=$result->fetch_assoc()){
							$scode=$_POST["co$i$y"];
							$sgrade=$_POST["g$i$y"];
							$sql="UPDATE results SET grade='$sgrade' WHERE admn='$user' and code='$scode'";
							$conn->query($sql);
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