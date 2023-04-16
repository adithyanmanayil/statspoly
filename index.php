<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "statspoly";

$conn = new mysqli($hostname, $username, $password, $database);
if ($conn->connect_error){
	die("Connection Failed" . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale-1.0">
		<title>Login's Portal</title>
		<link rel="stylesheet" href="statspoly.css">
		<script src="statspoly.js"></script>
	</head>
    <body>
        <div class="container">
			<div class="row">
				<div class="card-02 login" style="margin: 5em auto; height: auto;">
                    <h3 style='font-size: 20px;'>STATSPOLY</h3>
                    <h3 style='font-size: 10px;'>SEEK EASY</h3><br>
                    <center>
                        <form method="POST">
                            <h3>LOGIN</h3>
                            <input type="number" class='num-inputs' name='user' placeholder='Username'><br>
                            <input type="password" class='text-inputs' name='pwd' placeholder='Password'><br>
                            <input type="submit" class='btn-ppt' value='Login' name='login'>
                        </form>
                        <?php
                       session_start();

                       if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                           if(isset($_POST['login'])){
                               $user=$_POST['user'];
                               $pwd=$_POST['pwd'];
                               $sql="SELECT * FROM registration WHERE mobile='$user'";
                               $result = $conn->query($sql);
                               if ($result->num_rows > 0) {
                                   $row = $result->fetch_assoc();
                                   if ($row['password'] === $pwd){
                                       // Password matches
                                       $_SESSION['user_admn'] = $row['admn'] ;
                                       $_SESSION['user_pwd'] = $row['password'];
                                       $_SESSION['user_sem'] = $row['sem'] ;
                                       $_SESSION['user_type'] = $row['type'] ;
                                       if($row['type']==0){
                                           header("Location:student.php");
                                           exit;
                                       }
                                       if($row['type']==1){
                                           header("Location:tutor.php");
                                           exit;
                                       }
                                       if($row['type']==2){
                                           header("Location:admin.php");
                                           exit;
                                       }
                                   } else {
                                       echo "Incorrect password";
                                   }
                               } else {
                                   echo "User not found";
                               }
                           }
                       }
                       
                       // Display error message if there was an error
                       if (isset($error)) {
                           echo "<p>Error: $error</p>";
                       }
                       
                       // Check if user is logged in and redirect to login page if not
                       if (!isset($_SESSION['user_admn'])) {
                           header('Location: index.php');
                           exit;
                       }
                       
                       // User is logged in, display page content here
                       
                        ?>
                    </center>
                </div>
            </div>
        </div>
    </body>
</html>
