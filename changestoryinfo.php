<?php
session_start();
if(!hash_equals($_SESSION['token'], $_POST['token'])){
	die("Request forgery detected");
}

$curStory =  (string) $_POST['per1'];

$servername = 'localhost';
$serveruser = 'ben';
$serverpass = 'swimming';
$database = 'Mod3';
$table = "Stories";
//Establishes connection to datbase
$mysqli = new mysqli($servername, $serveruser, $serverpass, $database);

if($mysqli->connect_errno) {
  printf("Connection Failed: %s\n", $mysqli->connect_error);
  exit;
}
//Recovers all the story's information from database
$stmt = $mysqli->prepare("SELECT story_id,story_name, story_user, story, link FROM $table WHERE story_name = ?" );
$stmt->bind_param('s',$curStory);


if(!$stmt){
  printf("Query Prep Failed: %s\n", $mysqli->error);
  exit;
}
$stmt->execute();
$stmt->bind_result($sID,$sName, $sUser, $st, $li);

//updates session variables
while($stmt->fetch()){
$_SESSION["storyID"] = $sID;
$_SESSION["storyName"] = $sName;
$_SESSION["storyAuthor"] = $sUser;
$_SESSION["activeStory"]  = $st;
$_SESSION["link"]  = $li;
}

header("Location: http://ec2-34-227-117-216.compute-1.amazonaws.com/~BenFortier/Moduele3/news/homepage.php");



 ?>
