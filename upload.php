<?php
session_start();
if(!hash_equals($_SESSION['token'], $_POST['token'])){
	die("Request forgery detected");
}
$story = (string) $_POST["story"];
$title = (string)$_POST["title"];
$link = (string) $_POST["link"];
$servername = 'localhost';
$serveruser = 'ben';
$serverpass = 'swimming';
$database = 'Mod3';
$table = "Stories";
$user = $_SESSION["activeUser"];
$mysqli = new mysqli($servername, $serveruser, $serverpass, $database);
if($mysqli->connect_errno) {
  printf("Connection Failed: %s\n", $mysqli->connect_error);
  exit;
}

//Inserts the database the newly updated story
$stmt = $mysqli->prepare("INSERT INTO $table (link, story, story_user, story_name) VALUES (?,?,?,?)");
if(!$stmt){
printf("Query Prep Failed: %s\n", $mysqli->error);
exit;
}
$stmt->bind_param('ssss', $link, $story, $user, $title);
$stmt->execute();
$stmt->close();
header("Location: http://ec2-34-227-117-216.compute-1.amazonaws.com/~BenFortier/Moduele3/news/homepage.php");

 ?>
