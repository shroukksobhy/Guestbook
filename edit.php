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
 }
 ?>

</nav>

<?php


if(isset($_GET['action'])&& $_GET['action']=='edit'){
	$id=intval($_GET['id']);
	$edit=$db->query("SELECT * FROM msgs WHERE id='$id'");

	while ($row=$edit->fetch(PDO::FETCH_OBJ)) {
		# code...
		echo"<form method='POST'>
		Message:<input type='text' name='message' value='$row->message' class='form-control'/><br>
		<input type='submit' name='update' value='update' class='btn btn-info'/>
		 </form>";
		}

		 if(isset($_POST['update'])){
		 	//$id=intval($_GET['id']);
		 	$message=$_POST['message'];
		 	$date = date("y-m-d");
		 	$sql="UPDATE msgs SET message=?,createdone=? where id='$id'";
		 	$query=$db->prepare($sql);
		 	$query->execute([$message,$date]);
		 	header("location:home.php");
		 }
}
?>