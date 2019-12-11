<?php
require 'db.php';
?>

<div class="container">

	<form class="form" method="post" enctype="multipart/form-data">
  <div class="form-group">
  	<label>Name</label>
  	<input type="text" name="name" class="form-control" placeholder="Enter name" required>
  </div>
  <div class="form-group">
    <label >Email address</label>
    <input type="email" class="form-control" name="email" placeholder="Enter email" required>
  </div>
  <div class="form-group">
    <label>Password</label>
    <input type="password" name="password" class="form-control" placeholder="Password" required>
  </div>

  <button type="submit" class="btn btn-primary" name="create">Submit</button><br>
</form>
</div>
<?php
if (isset($_POST["create"])){

	$name=$_POST['name'];
	$email=$_POST['email'];
	$password=$_POST['password'];
	$sql="SELECT COUNT(email) AS  num FROM users WHERE email='$email'";
	$query=$db->prepare($sql);
	$query->execute();
	$row = $query->fetch(PDO::FETCH_ASSOC);
	if($row['num']>0){
		die('That Email already exists!');

	}
	$passwordHash = password_hash($password, PASSWORD_BCRYPT, array("cost" => 12));
	$sql="INSERT INTO users(name,email,password) VALUES('$name','$email','$passwordHash')";
	$query=$db->prepare($sql);
	$result = $query->execute();
	if($result){
	echo'<div class="alert alert-success" role="alert">
 	Created successfuly.. now you can login.
	</div>';
	}



	

}
?>