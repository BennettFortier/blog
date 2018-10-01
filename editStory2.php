<?php
session_start();
if(!hash_equals($_SESSION['token'], $_POST['token'])){
	die("Request forgery detected");
}

$newStory = $_POST["editStory"];
$newTitle = $_POST["retitle"];
$newLink = $_POST["relink"];

$servername = 'localhost';
$serveruser = 'ben';
$serverpass = 'swimming';
$database = 'Mod3';
$table = "Stories";
$user = $_SESSION["activeUser"];
$activeStory = $_SESSION["storyName"];

$mysqli = new mysqli($servername, $serveruser, $serverpass, $database);


if($mysqli->connect_errno) {
  printf("Connection Failed: %s\n", $mysqli->connect_error);
  exit;
}
//Changes the story information to newly updated information
$stmt = $mysqli->prepare("UPDATE $table SET story = '$newStory', link = '$newLink', story_name = '$newTitle' WHERE  story_name = '$activeStory'  ");

if(!$stmt){
  printf("Query Prep Failed: %s\n", $mysqli->error);
  exit;
}
$stmt->execute();
$stmt->close();
$_SESSION["storyName"]=$newTitle;
header("Location: http://ec2-34-227-117-216.compute-1.amazonaws.com/~BenFortier/Moduele3/news/homepage.php");
 ?>
