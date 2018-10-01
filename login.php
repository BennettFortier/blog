<?php

//Takes in the user's attempted login and password, and hashes it and saves it.
$user = (string) $_POST["username"];
$pw= (string) $_POST["password"];
$insertPassword = password_hash($pw, PASSWORD_DEFAULT);

chdir("/home/BenFortier/users");


$buttonSetting = $_POST['buttons'];
//Switch to change upon what button is pressed.
switch($buttonSetting) {
  case 'Login':
  Login($user, $pw);
  break;
  case 'Register':
  addUser($user, $insertPassword);
  break;
  case 'Continue Without Login':
  noUser();
  break;
}
//Function that checks to see if the passwords and usernames match, if so it logs them in.
function Login($user, $password){
  $servername = 'localhost';
  $serveruser = 'ben';
  $serverpass = 'swimming';
  $database = 'Mod3';

  $mysqli = new mysqli($servername, $serveruser, $serverpass, $database);

  if($mysqli->connect_errno) {
    printf("Connection Failed: %s\n", $mysqli->connect_error);
    exit;
  }

  $table = "Person";

  $stmt = $mysqli->prepare("SELECT password,username FROM $table WHERE username = ?" );
  $stmt -> bind_param("s",$user);
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

session_destroy();

session_start();


$_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(32));
  $stmt->close();
if($tempUser != NULL){
  if(password_verify($password,$temp)){
    $_SESSION["activeUser"]= $tempUser;
    $_SESSION["activePass"]= $temp;
    $servername = 'localhost';
    $serveruser = 'ben';
    $serverpass = 'swimming';
    $database = 'Mod3';
    $table = "Stories";

    $mysqli = new mysqli($servername, $serveruser, $serverpass, $database);

    if($mysqli->connect_errno) {
      printf("Connection Failed: %s\n", $mysqli->connect_error);
      exit;
    }

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
  else{
    header("Location: http://ec2-34-227-117-216.compute-1.amazonaws.com/~BenFortier/Moduele3/news/incorrectLogin.html");
  }
}
else{
  header("Location: http://ec2-34-227-117-216.compute-1.amazonaws.com/~BenFortier/Moduele3/news/incorrectLogin.html");
}

}

//Adds a user using the hashed password.
function addUser($user, $password){

  $servername = 'localhost';
  $serveruser = 'ben';
  $serverpass = 'swimming';
  $database = 'Mod3';
  //sets up connection to database
  $mysqli = new mysqli($servername, $serveruser, $serverpass, $database);
  $table = "Person";

  if($mysqli->connect_errno) {
  printf("Connection Failed: %s\n", $mysqli->connect_error);
  exit;
  }
  $stmt = $mysqli->prepare("SELECT password,username FROM $table WHERE username = ?" );
  $stmt->bind_param('s', $user);
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
  header("Location: http://ec2-34-227-117-216.compute-1.amazonaws.com/~BenFortier/Moduele3/news/incorrectLogin.html");
  }
  else{

      $stmt = $mysqli->prepare("insert into $table (username, password) values (?,?)");
      if(!$stmt){
      printf("Query Prep Failed: %s\n", $mysqli->error);
      exit;
      }
      $stmt->bind_param('ss', $user,$password);
      $stmt->execute();
      $stmt->close();
      header("Location: http://ec2-34-227-117-216.compute-1.amazonaws.com/~BenFortier/Moduele3/news/login2.php");  }

}
//Logs user in as Guest who has no permissions on website
function noUser(){
  session_destroy();
  session_start();
	$_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(32));
  $user = 'Guest';
  $_SESSION["activeUser"]= $user;
  header("Location: http://ec2-34-227-117-216.compute-1.amazonaws.com/~BenFortier/Moduele3/news/homepage.php");
}

?>
