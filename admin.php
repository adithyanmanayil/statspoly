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
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale-1.0">
		<title>Admin's Portal</title>
		<link rel="stylesheet" href="statspoly.css">
		<script src="statspoly.js"></script>
	</head>
	
	<body>
		<div class="navbar">
			<div><a href="#">STATSPOLY</a></div>
			<div><a href="index.php">LOGOUT</a></div>
			<div><a href="#stats">STATS</a></div>
			<div><a href="#profile">HOME</a></div>
		</div>
		
		<div class="container">
			<div class="row">
				<div class="card-01">
					<h3>ASSIGN TUTOR</h3><br>
					<center>
						<form method="POST">
							<input type="number" class="num-inputs" name="tid" id="tid" placeholder="Tutor ID">
							<input type="text" class="text-inputs" name="tname" id="tname" placeholder="Name">
							<input type="number" class="num-inputs" name="mob" id="mob" placeholder="Mobile Number">
							<input type="email" class="text-inputs" name="tmail" id="tmail" placeholder="E-Mail"><br>
							<div style="margin: 0 auto; letter-spacing: 1em;">
								<h4 style="letter-spacing: 0.2em; font-weight: 600; line-height: 2em;">SEMESTER</h4>
								<label style="letter-spacing: 1.5em; padding-left: 1.5em;">123456</label><br>
								<input type="radio" name="sem" value="1">
								<input type="radio" name="sem" value="2">
								<input type="radio" name="sem" value="3">
								<input type="radio" name="sem" value="4">
								<input type="radio" name="sem" value="5">
								<input type="radio" name="sem" value="6">
							</div>
							<input type="button" class="btn-ppt" value="Generate" onClick="genlogin();"><br>
							<input type="text" class="text-inputs" name="username" id="username" placeholder="Username">
							<input type="text" class="text-inputs" name="pwd" id="pwd" placeholder="Password"><br>
							<input type="submit" class="btn-ppt" value="Save" name="regtutor">
						</form><?php
                        if(isset($_POST['regtutor'])){
							$admn=$_POST["tid"];
							$name=$_POST["tname"];
							$mob=$_POST["mob"];
                            $mail=$_POST["tmail"];
                            $pwd=$_POST["pwd"];
							$tsem=$_POST["sem"];
							$sql="SELECT * FROM registration WHERE sem='$tsem' and type=0";
							$result=$conn->query($sql);
							if($result->num_rows>0){
								$sql2="UPDATE registration SET tid='$admn' WHERE sem='$tsem' AND type=0";
								$conn->query($sql2);
							}
							$sql2="insert into registration values('$admn', '$name', '$mob', '$mail', '$pwd', 1, '$tsem', 0)";
							$conn->query($sql2);
							header("Location:admin.php");
						}
						?>
					</center>
				</div>
				<div class="card-01">
					<h3>REMOVE TUTOR</h3><br>
					<center>
					<form method="post">
						<input list="your_datalist" name="rvalue" class='text-inputs' placeholder="Student Name">
						<datalist id="your_datalist">
							<?php
							$query = "SELECT * FROM registration WHERE type=1";
							$result = mysqli_query($conn, $query);
							while ($row = mysqli_fetch_array($result)) {
								echo "<option value=".$row['name'].">";
							}
							?>
						</datalist>
						<input type="submit" class="btn-ppt" name="srremstud" value="Details"><br>
					</form>
					<div class="yscroll">
					<?php
					$sql="SELECT * FROM registration WHERE type=1";
					$result=$conn->query($sql);
					if(!isset($_POST['srremstud'])){
						if($result->num_rows>0){
							$z=1;
							while($row=$result->fetch_assoc()){
								echo "<form method='POST'>";
								echo "<table style='width: 100%'>";
								if ($result->num_rows>0){
									echo "<tr>";
									echo "<th style='width: 30%;'>Name</th>";
									echo "<td>".$row['name']."</td>";
									echo "</tr>";
									echo "<tr>";
									echo "<th>Tutor ID</th>";
									echo "<td><input type='text' name='radmn$z' value=".$row["admn"]." readonly style='font-weight: 500; width: 90%; margin: 0 auto;'></td>";
									echo "</tr>";
									echo "<tr>";
									echo "<th>Mail ID</th>";
									echo "<td>".$row['mail']."</td>";
									echo "</tr>";
									echo "<tr>";
									echo "<th>Mobile</th>";
									echo "<td>".$row['mobile']."</td>";
									echo "</tr>";
		
								}
								echo "</table>";
								echo "<input type='submit' class='btn-ppt' name='remstud' value='Remove'>";
								echo "</form>";
							}
						}
					}
					
					if(isset($_POST['srremstud'])){
						$rstud=$_POST['rvalue'];
						$sql="SELECT * FROM registration WHERE name like '%$rstud%' AND type=1";
						$result=$conn->query($sql);
						if($result->num_rows>0){
							$z=1;
							while($row=$result->fetch_assoc()){
								echo "<form method='POST'>";
								echo "<table style='width: 100%'>";
								if ($result->num_rows>0){
									echo "<tr>";
									echo "<th style='width: 30%;'>Name</th>";
									echo "<td>".$row['name']."</td>";
									echo "</tr>";
									echo "<tr>";
									echo "<th>Tutor ID</th>";
									echo "<td><input type='text' name='radmn$z' value=".$row["admn"]." readonly style='font-weight: 500; width: 90%; margin: 0 auto;'></td>";
									echo "</tr>";
									echo "<tr>";
									echo "<th>Mail ID</th>";
									echo "<td>".$row['mail']."</td>";
									echo "</tr>";
									echo "<tr>";
									echo "<th>Mobile</th>";
									echo "<td>".$row['mobile']."</td>";
									echo "</tr>";
		
								}
								echo "</table>";
								echo "<input type='submit' class='btn-ppt' name='remstud' value='Remove'>";
								echo "</form>";
							}
						}
					}
					if (isset($_POST['remstud'])) {
						$z=1;
						$rvalue = $_POST["radmn$z"];
						$query = "DELETE FROM registration WHERE admn = '$rvalue'";
						$result=mysqli_query($conn, $query);
						$query2 = "DELETE FROM results WHERE admn= '$rvalue'";
						$result2=mysqli_query($conn, $query2);
					}
					?>
					</div>
					</center>
				</div>
			</div>
			<div class="row">
				<div class="card-02" id="div-app">
					<h3>APPEND SUBJECTS</h3><br>
					<center>
						<form method="POST">
							<select class="dd-opt" name="subsem">
								<option value='1'>SEMESTER 1</option>
								<option value='2'>SEMESTER 2</option>
								<option value='3'>SEMESTER 3</option>
								<option value='4'>SEMESTER 4</option>
								<option value='5'>SEMESTER 5</option>
								<option value='6'>SEMESTER 6</option>
							</select><br>
							<input type="number" class="num-inputs" id="subcode" name="subcode" placeholder="Subject Code">
							<input type="text" class="text-inputs" id="subname" name="subname" placeholder="Subject Name">
							<input type="text" class="text-inputs" id="subcredit" name="subcredit" placeholder="Credit"><br>
							<input type="submit" class="btn-ppt" name='subsubmit' value="Save" onClick="save();">
						</form>
						<?php
						if(isset($_POST['subsubmit'])){
							if(isset($_POST['subsem'])){
								$isubsem=$_POST['subsem'];
							}
							$isubcode=$_POST["subcode"];
							$isubname=$_POST["subname"];
							$isubcredit=$_POST["subcredit"];
							$sql="insert into subjects values('$isubcode', '$isubname', '$isubcredit', '$isubsem')";
							$conn->query($sql);
							header("Location:admin.php#div-app");
						}
						?>	
					</center>
				</div>
				<div class="card-02" id="div-rem">
					<h3>REMOVE SUBJECTS</h3><br>
					<center>
					<form method="post">
						<input list="stud_datalist" name="value" class='text-inputs' placeholder="Subject Name">
						<datalist id="stud_datalist">
							<?php
							$query = "SELECT name FROM subjects";
							$result = mysqli_query($conn, $query);
							while ($row = mysqli_fetch_array($result)) {
								echo '<option value="' . $row['name'] . '">';
							}
							?>
						</datalist>
						<?php echo'<a href="#div-app"><input type="submit" class="btn-ppt" name="remsub" value="Remove"></a>'?>
					</form>
					<?php
					if (isset($_POST['remsub'])) {
						$value = $_POST['value'];
						$query = "DELETE FROM subjects WHERE name = '$value'";
						mysqli_query($conn, $query);
						$query2 = "DELETE FROM results WHERE name = '$value'";
						mysqli_query($conn, $query2);
						header("Location:admin.php#div-rem");
					}
					$conn->query($query);
					?>
					</center>
				</div>
			</div>
			<div class="card-03">
				<h3>MARKLIST</h3>
				<form method="POST">
					<select class="dd-opt" name="resultsem">
						<option value='1'>SEMESTER 1</option>
						<option value='2'>SEMESTER 2</option>
						<option value='3'>SEMESTER 3</option>
						<option value='4'>SEMESTER 4</option>
						<option value='5'>SEMESTER 5</option>
						<option value='6'>SEMESTER 6</option>
					</select>
					<input type="submit" class="btn-ppt" name="showresult" value="Results"><br>
				</form>
				<?php
				if(isset($_POST['showresult'])){
					if(isset($_POST['resultsem'])){
						$ressem=$_POST['resultsem'];
					}
					$sql = "SELECT DISTINCT registration.admn
							FROM registration
							INNER JOIN results ON registration.admn = results.admn
							INNER JOIN subjects ON results.code = subjects.code
							WHERE registration.sem = $ressem AND subjects.sem= $ressem AND registration.type=0
							ORDER BY registration.admn";
					$result = $conn->query($sql);
					echo "<center><div class='card-03' style='width: 100%; margin: 1em auto;'>";
					echo "<form method='POST'>";
					echo "<table border=1; style='background-color: #555; width: 90%; margin: 0 auto;'>";
					$s1="SELECT * FROM subjects WHERE sem=$ressem";
					$r1=$conn->query($s1);
					$scount=0;
					if($r1->num_rows>0){
						echo "<tr><th style='width: 5%;'>Admn</th><th style='width: 30%;'>Name</th>";
						while($row1=$r1->fetch_assoc()){
							echo "<th style='width: 5%;'>".$row1['code']."</th>";
							$scount++;
						}
						$s2 = "SELECT registration.admn, registration.name, results.grade, results.imark, results.sem
							FROM registration
							INNER JOIN results ON registration.admn=results.admn
							WHERE results.sem = $ressem";
						$r2 = $conn->query($s2);
						$printed_admns = array();
						while ($row2 = $r2->fetch_assoc()) {
							$admn = $row2['admn'];
							if (!in_array($admn, $printed_admns)) {
								echo "</tr><tr><td>".$admn."</td>";
								echo "<td>".$row2['name']."</td>";
								$s3="SELECT * FROM results WHERE sem=$ressem AND admn=$admn";
								$r3=$conn->query($s3);
								while ($row3 = $r3->fetch_assoc()) {
									echo "<td>".$row3['grade']."</td>";
								}
								echo "<br>";
								$printed_admns[] = $admn;
							}
						}

					}else{
						echo "No results found!";
					}
					echo "</table>";
					echo "</form>";
				}
				?>
			</div>
		</div>
	</body>
</html>
