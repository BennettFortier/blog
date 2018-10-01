<?php
session_start();
if(!hash_equals($_SESSION['token'], $_POST['token'])){
	die("Request forgery detected");
}

$servername = 'localhost';
$serveruser = 'ben';
$serverpass = 'swimming';
$database = 'Mod3';
$table = "Person";
$user = $_SESSION["activeUser"];
$newPassword = $_POST["newPass"];

$mysqli = new mysqli($servername, $serveruser, $serverpass, $database);


if($mysqli->connect_errno) {
  printf("Connection Failed: %s\n", $mysqli->connect_error);
  exit;
}
$insertPassword = password_hash($newPassword, PASSWORD_DEFAULT);
//updates password to newly hashed password
$stmt = $mysqli->prepare("UPDATE $table SET password = '$insertPassword' WHERE  username ='$user' ");

if(!$stmt){
  printf("Query Prep Failed: %s\n", $mysqli->error);
  exit;
}

$stmt->execute();
$stmt->close();

header("Location: http://ec2-34-227-117-216.compute-1.amazonaws.com/~BenFortier/Moduele3/news/homepage.php");



 ?>
