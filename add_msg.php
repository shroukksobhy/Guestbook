<!DOCTYPE html>
<html>
<head>
	<title>Guestbook</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"><script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</head>
<body>
	<div class="container">
	<header>
	<nav class="navbar navbar-light bg-light">
  	<a class="navbar-brand">Guestbook</a>

  
<?php 
require 'db.php';
session_start();
if(isset($_SESSION['name']) && $_SESSION['name']!="") {
  echo '<h3>Welcome '.$_SESSION['name'].'</h3>';
  echo '<navbar><h4><a href="logout.php">Logout</a></h4></navbar>';

 ?>
</nav>
<form class="form" method="post" enctype="multipart/form-data">
	<div class="form-group shadow-textarea">
		<label>Message</label>
		<textarea name="message" class="form-control" placeholder="Write something here..."></textarea>
	</div>
			 <button type="submit" class="btn btn-primary" name="submit">Submit</button>
			 <a href="home.php" class="btn btn-info">View all my messages</a>



	
</form>
<?php
} else { 
  header('location:index.php');
}
?>

</header>
</div>
</body>
</html>
<?php
if(isset($_POST['submit'])){
	$comment=$_POST['message'];
	$users_id=$_SESSION['id'];
	$datetime = date("y-m-d h:i:s");
	$sql="INSERT INTO msgs(message,users_id,createdone) values('$comment','$users_id','$datetime')";
	$query=$db->prepare($sql);
	$query->execute();
}
?>