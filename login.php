<?php
require 'db.php';
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"><script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
	<header>
	<nav class="navbar navbar-light bg-light">
  	<a class="navbar-brand">Guestbook</a>
  	<navbar>
  	<a href="home.php">Home</a>
  	<a href="home.php">Register</a>
  	<a href="login.php">Login</a>
	</navbar>
	</nav>
	</header>
	<form class="form" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label>Email</label>
			<input type="email" name="email" class="form-control" required>
		</div>
		<div class="form-group">
			<label>Password</label>
			<input type="password" name="password" class="form-control" required>
		</div>
		 <button type="submit" class="btn btn-primary" name="login">Login</button>

	</form>
</div>
<?php
$msg = ""; 
if(isset($_POST["login"])){
	$email = $_POST['email'];
	$password = $_POST['password'];
	try{
 		$sql = "SELECT * FROM users WHERE email='$email'";
		$result = $db->prepare($sql);
		$result->execute();
		$count = $result->rowCount();
		$row = $result->fetch(PDO::FETCH_ASSOC);
		if($count==1 && !empty($row)){
			$validPassword = password_verify($password, $row['password']);
			if($validPassword){
				$_SESSION['email']=$row['email'];
				$_SESSION['password']=$row['password'];
				$_SESSION['name'] = $row['name'];
				$_SESSION['id'] =$row['id'];
		     	header("location: home.php");
		     	exit();
			}
			
		}else{
			$msg="Invalid email or password";
		}
		
 	}catch(PDOException $e){
 		echo "Error: ".$e->getMessage();
 	}
}
?>