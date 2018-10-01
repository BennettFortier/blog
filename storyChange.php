<?php
session_start();
if(!hash_equals($_SESSION['token'], $_POST['token'])){
	die("Request forgery detected");
}
$Edit = (string)$_POST['Edit'];
$Remove = (string)$_POST['Remove'];
$_SESSION["storyToEdit"] = $Edit;





if($Remove == NULL){

  header("Location: http://ec2-34-227-117-216.compute-1.amazonaws.com/~BenFortier/Moduele3/news/editStory.php");
}
else{
  remove($Remove);
}
//Removes the story and comments on the story by searching and removing the storyID from databse
function remove($Remove){
  $Remove = $_SESSION["storyName"];
  $newComment = $new;
  $val = $Edit;
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

  $stmt = $mysqli->prepare("DELETE FROM $table WHERE story_name =? ");

	$stmt->bind_param('s', $Remove);
  if(!$stmt){
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
  }

  $stmt->execute();
  $stmt->close();


  $stmt = $mysqli->prepare("DELETE FROM Comments WHERE story_name = ?");
	$stmt->bind_param('s', $Remove);

  if(!$stmt){
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
  }

  $stmt->execute();
  $stmt->close();

  $stmt = $mysqli->prepare("SELECT story_id,story_name, story_user, story FROM $table ORDER BY RAND() limit 1;" );
  if(!$stmt){
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
  }
  $stmt->execute();
  $stmt->bind_result($sID,$sName, $sUser, $st);

  while($stmt->fetch()){
  $_SESSION["storyID"] = $sID;
  $_SESSION["storyName"] = $sName;
  $_SESSION["storyAuthor"] = $sUser;
  $_SESSION["activeStory"]  = $st;
  }




  $stmt->close();
  header("Location: http://ec2-34-227-117-216.compute-1.amazonaws.com/~BenFortier/Moduele3/news/homepage.php");
}

 ?>
