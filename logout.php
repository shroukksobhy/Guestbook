<?php
session_start();
$_SESSION['email'] = "";
$_SESSION['name'] = "";
$_SESSION['password'] = "";
if(empty($_SESSION['name'])) header("location: index.php");
?>