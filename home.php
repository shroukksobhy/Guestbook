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

<a href="add_msg.php" class="btn btn-primary">Write Message</a>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Message</th>
      <th scope="col">Datetime</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <tr>
    <?php
    $id = $_SESSION['id'];
    $sql = "SELECT * FROM msgs WHERE msgs.users_id='$id'";
		$result = $db->prepare($sql);
		$result->execute();
		$count = $result->rowCount();
		while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			echo "<tr>";
			echo"<td>".$row['id']."</td>";
			echo "<td>".$row['message']."</td>";
			echo "<td>".$row['createdone']."</td>";
 		   echo"<td><a href='home.php?action=delete&id={$row['id']}' class='btn btn-danger'>Delete</a>";
 		   echo"<a href='edit.php?action=edit&id={$row['id']}' class='btn btn-info'>Edit</a>";


		}
		if(isset($_GET['action'])&& $_GET['action']=='delete'){
		$id=intval($_GET['id']);
		$delete=$db->query("DELETE FROM msgs WHERE id='$id'");
		$delete->execute();
		header("location:home.php");
		}
    ?>
      
    
  </tbody>
</table>
<?php
} else { 
  header('location:index.php');
}
?>

</body>
</html>
