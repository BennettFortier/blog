<?php
session_start();
if(!hash_equals($_SESSION['token'], $_POST['token'])){
	die("Request forgery detected");
}
//Takes in the ID of the comment and whether or not to edit or remove
$Edit = (int)$_POST['Edit'];
$Remove = (int)$_POST['Remove'];
for($j=0; $j<count($_SESSION["commentAuthors"]) ;$j++){
  $new = (string)$_POST[$_SESSION["commentID"][$j]] ;
  if($new != NULL){
    $comment = $new;
  }
}


if($Remove == NULL){
  edit($Edit, $comment);
}
else{
  remove($Remove);
}
//Removes the comment through removing it from database
function remove($Remove){
  $newComment = $new;
  $val = $Edit;
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

  $stmt = $mysqli->prepare("DELETE FROM $table WHERE  comment_id ='$Remove' ");

  if(!$stmt){
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
  }

  $stmt->execute();
  $stmt->close();

  header("Location: http://ec2-34-227-117-216.compute-1.amazonaws.com/~BenFortier/Moduele3/news/homepage.php");
}

//Edits the users comment
function edit($Edit, $new){

  $newComment = $new;
  $val = $Edit;
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


  $stmt = $mysqli->prepare("UPDATE $table SET comment = '$newComment' WHERE  comment_id = '$val'");


  if(!$stmt){
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
  }

  $stmt->execute();
  $stmt->close();

  header("Location: http://ec2-34-227-117-216.compute-1.amazonaws.com/~BenFortier/Moduele3/news/homepage.php");

}

 ?>
