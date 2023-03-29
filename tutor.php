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

<html>
    <head>
        <meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale-1.0">
		<title>Tutor's Portal</title>
		<link rel="stylesheet" href="statspoly.css">
		<script src="statspoly.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="card-02" id="div-app">
                    <h3>APPEND STUDENT</h3><br>
                    <center>
                        <form method="POST">
							<input type="number" class="num-inputs" name="admn" id="tid" placeholder="Admission Number">
							<input type="text" class="text-inputs" name="name" id="tname" placeholder="Student Name">
							<input type="number" class="num-inputs" name="mob" id="mob" placeholder="Mobile Number">
							<input type="email" class="text-inputs" name="mail" id="tmail" placeholder="E-Mail"><br>
							<input type="button" class="btn-ppt" value="Generate" onClick="genlogin();"><br>
							<input type="text" class="text-inputs" name="username" id="username" placeholder="Username">
							<input type="text" class="text-inputs" name="pwd" id="pwd" placeholder="Password"><br>
							<input type="submit" name="regstud" class="btn-ppt" value="Save">
						</form>
                        <?php
                        if(isset($_POST['regstud'])){
							$admn=$_POST["admn"];
							$name=$_POST["name"];
							$mob=$_POST["mob"];
                            $mail=$_POST["mail"];
                            $pwd=$_POST["pwd"];
							$sql="insert into registration values('$admn', '$name', '$mob', '$mail', '$pwd', 0)";
							$conn->query($sql);
							header("Location:tutor.php#div-app");
						}
						?>
                    </center>
                </div>
                <div class="card-02" id="div-rem">
                    <h3>REMOVE STUDENTS</h3>
                    <center>
					<form method="post">
						<input list="your_datalist" name="value" class='text-inputs' placeholder="Student Name">
						<datalist id="your_datalist">
							<?php
							$query = "SELECT * FROM registration";
							$result = mysqli_query($conn, $query);
							while ($row = mysqli_fetch_array($result)) {
								echo '<option value="' . $row['name'].'--'.$row['admn'].'">';
							}
							?>
						</datalist>
                        <input type="submit" class="btn-ppt" name="remstud" value="Remove" onClick="get_admn();">
					</form>
					<?php
					if (isset($_POST['remstud'])) {
						$value = $_POST['value'];
						$query = "DELETE FROM registration WHERE name = '$value'";
						mysqli_query($conn, $query);
						header("Location:tutor.php#div-rem");
					}
					$conn->query($query);
					?>
					</center>
                </div>
            </div>
			<div class="row">
				<div class="card-03">
					<h3>VERIFICATION</h3>
					<?php
					
					?>
				</div>
			</row>
        </div>
    </body>
</html>
