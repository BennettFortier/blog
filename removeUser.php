<?php
session_start();
$servername = 'localhost';
$serveruser = 'ben';
$serverpass = 'swimming';
$database = 'Mod3';
$table = "Person";
$user = $_SESSION["activeUser"];

$mysqli = new mysqli($servername, $serveruser, $serverpass, $database);


if($mysqli->connect_errno) {
  printf("Connection Failed: %s\n", $mysqli->connect_error);
  exit;
}
//Removes all the comments, stories, and specific user from the databses with the username = to current user.
$stmt = $mysqli->prepare("DELETE FROM $table WHERE  username = ?");
$stmt->bind_param('s', $user);

if(!$stmt){
  printf("Query Prep Failed: %s\n", $mysqli->error);
  exit;
}

$stmt->execute();
$stmt->close();

$stmt = $mysqli->prepare("DELETE FROM Stories WHERE  story_user = ?");
$stmt->bind_param('s', $user);

if(!$stmt){
  printf("Query Prep Failed: %s\n", $mysqli->error);
  exit;
}

$stmt->execute();
$stmt->close();

$stmt = $mysqli->prepare("DELETE FROM Comments WHERE  comment_author = ?");
$stmt->bind_param('s', $user);

if(!$stmt){
  printf("Query Prep Failed: %s\n", $mysqli->error);
  exit;
}

$stmt->execute();
$stmt->close();

header("Location: http://ec2-34-227-117-216.compute-1.amazonaws.com/~BenFortier/Moduele3/news/login2.php");

 ?>
