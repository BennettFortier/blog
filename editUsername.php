<?php
session_start();

if(!hash_equals($_SESSION['token'], $_POST['tokens'])){
	die("Request forgery detected");
}

$servername = 'localhost';
$serveruser = 'ben';
$serverpass = 'swimming';
$database = 'Mod3';
$table = "Person";
$user = $_SESSION["activeUser"];
$newUsername = $_POST["newUser"];

$mysqli = new mysqli($servername, $serveruser, $serverpass, $database);
if($mysqli->connect_errno) {
  printf("Connection Failed: %s\n", $mysqli->connect_error);
  exit;
}
//updates the username and the author of the stories and comments from the old username to the new username.
$stmt = $mysqli->prepare("SELECT password,username FROM $table WHERE username = ?" );
$stmt->bind_param("s",$newUsername);
if(!$stmt){
  printf("Query Prep Failed: %s\n", $mysqli->error);
  exit;
}
$stmt->execute();
$stmt->bind_result($p,$u);

while($stmt->fetch()){
$temp = $p;
$tempUser = $u;
}
$stmt->close();
if($tempUser != NULL){
header("Location: http://ec2-34-227-117-216.compute-1.amazonaws.com/~BenFortier/Moduele3/news/reRegister.html");
}
else{

  $mysqli = new mysqli($servername, $serveruser, $serverpass, $database);
  if($mysqli->connect_errno) {
    printf("Connection Failed: %s\n", $mysqli->connect_error);
    exit;
  }
  $stmt = $mysqli->prepare("UPDATE $table SET username = ? WHERE  username = ? ");
	$stmt->bind_param("ss",$newUsername, $user);

  if(!$stmt){
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
  }

  $stmt->execute();
  $stmt->close();

  $stmt = $mysqli->prepare("UPDATE Comments SET comment_author = ? WHERE  comment_author = ? ");
	$stmt->bind_param("ss",$newUsername, $user);

  if(!$stmt){
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
  }

  $stmt->execute();
  $stmt->close();

   $stmt = $mysqli->prepare("UPDATE Stories SET story_user = ? WHERE  story_user = ? ");
	 $stmt->bind_param("ss",$newUsername, $user);

  if(!$stmt){
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
  }

  $stmt->execute();
  $stmt->close();

  $_SESSION["activeUser"]=$newUsername;
  header("Location: http://ec2-34-227-117-216.compute-1.amazonaws.com/~BenFortier/Moduele3/news/homepage.php");




}
 ?>
