<?php
session_start();
if(!hash_equals($_SESSION['token'], $_POST['token'])){
	die("Request forgery detected");
}
//Establishes connection to databse and stores some session variables into local file variables
$comment = (string) $_POST["comment"];
$story= $_SESSION["activeStory"];
$title = $_SESSION["storyName"];
$author = $_SESSION["storyAuthor"];
$id = $_SESSION["storyID"];
$servername = 'localhost';
$serveruser = 'ben';
$serverpass = 'swimming';
$database = 'Mod3';
$table = "Comments";
$user = $_SESSION["activeUser"];
$mysqli = new mysqli($servername, $serveruser, $serverpass, $database);
if($mysqli->connect_errno) {
  printf("Connection Failed: %s\n", $mysqli->connect_error);
  exit;
}
//Inserts a comment into the databse
$stmt = $mysqli->prepare("INSERT INTO $table (story_name, comment_author, comment) VALUES (?,?,?)");
if(!$stmt){
printf("Query Prep Failed: %s\n", $mysqli->error);
exit;
}
$stmt->bind_param('sss', $title, $user, $comment);
$stmt->execute();
$stmt->close();
header("Location: http://ec2-34-227-117-216.compute-1.amazonaws.com/~BenFortier/Moduele3/news/homepage.php");

 ?>
