<?php
session_start();
//Homepage.php is main file, starts by creating and saving the current stories information. This is done through a series of queries.
$_POST['token']  = $_SESSION['token'];
if(!hash_equals($_SESSION['token'], $_POST['token'])){
	die("Request forgery detected");
}
$_SESSION["activeComments"];
$_SESSION["myStories"];
$servername = 'localhost';
$serveruser = 'ben';
$serverpass = 'swimming';
$database = 'Mod3';
$table = "Stories";
$activeStory = $_SESSION["storyID"];
$mysqli = new mysqli($servername, $serveruser, $serverpass, $database);

if($mysqli->connect_errno) {
  printf("Connection Failed: %s\n", $mysqli->connect_error);
  exit;
}
$stmt = $mysqli->prepare("SELECT story_id,story_name, story_user, story,link FROM $table WHERE story_id = ? " );
$stmt->bind_param('s', $activeStory);

if(!$stmt){
  printf("Query Prep Failed: %s\n", $mysqli->error);
  exit;
}
$stmt->execute();
$stmt->bind_result($sID,$sName, $sUser, $st,$l);

while($stmt->fetch()){
$_SESSION["storyID"] = $sID;
$_SESSION["storyName"] = $sName;
$_SESSION["storyAuthor"] = $sUser;
$_SESSION["activeStory"]  = $st;
$_SESSION["link"] = $l;
}

$stmt->close();





$stmt = $mysqli->prepare("SELECT story_name FROM $table WHERE story_user = ?" );
$stmt->bind_param('s',$_SESSION["activeUser"]);
if(!$stmt){
  printf("Query Prep Failed: %s\n", $mysqli->error);
  exit;
}
$stmt->execute();
$result = $stmt->get_result();

$count = 0;
while( $row = $result->fetch_assoc()){

    $new_array[$count] = $row["story_name"];
    $count++;
}
$_SESSION["myStories"]=$new_array;
$stmt->close();


$stmt = $mysqli->prepare("SELECT story_name FROM $table" );
if(!$stmt){
  printf("Query Prep Failed: %s\n", $mysqli->error);
  exit;
}
$stmt->execute();
$result = $stmt->get_result();

$count = 0;
while( $row = $result->fetch_assoc()){
    $new_array[$count] = $row["story_name"];
    $count++;
}
$_SESSION["totalStories"]=$new_array;
$stmt->close();

$table = "Comments";

$stmt = $mysqli->prepare("SELECT comment, comment_author, comment_id FROM $table WHERE story_name= ?" );
$stmt->bind_param('s',$_SESSION["storyName"]);
if(!$stmt){
  printf("Query Prep Failed: %s\n", $mysqli->error);
  exit;
}
$stmt->execute();
$result = $stmt->get_result();

$count = 0;
while( $row = $result->fetch_assoc()){

    $new_array[$count] = $row["comment"];
    $array2[$count]=$row["comment_author"];
    $array3[$count]=$row["comment_id"];
    $count++;
}
$_SESSION["storyComments"]=$new_array;
$_SESSION["commentAuthors"]=$array2;
$_SESSION["commentID"] = $array3;
$stmt->close();
$link = $_SESSION["link"];
 ?>

<DOCTYPE! html>
<hmtl>
<head>
  <link rel="stylesheet" href= "login.css">
  <title>HOMEPAGE</title>
</head>

<body>
  <h1>
    What's New(s)?
  </h1>

<div class="navbar">
  <a href="http://ec2-34-227-117-216.compute-1.amazonaws.com/~BenFortier/Moduele3/news/homepage.php">Home</a>

  <div class="dropdown">
    <button class="dropbtn">Stories
    <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <form action="changestoryinfo.php" method="POST">
              <select name="per1" id="per1">
                <option selected="selected">Choose a story</option>
                <?php
                session_start();
                  for($j=0; $j<count($_SESSION["totalStories"]) ;$j++){
                    $curStory =  $_SESSION["totalStories"][$j];
                      $_SESSION["updateStory"] = $curStory;
                     ?>
                    <option value="<?= $curStory?>"><?= $curStory ?></option>
                <?php
                  } ?>
              </select>
              <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />
              <input class="SubmitButton" type="submit" name="SUBMITBUTTON" value="Submit" style="font-size:20px; "/>
      </form>
    </div>
  </div>
  <?php
  if(0!=strcmp($_SESSION["activeUser"],"Guest")){
    ?>
    <a href="http://ec2-34-227-117-216.compute-1.amazonaws.com/~BenFortier/Moduele3/news/upload2.php">Upload</a>

    <div class="dropdown">
    <button class="dropbtn">My Stories
      <i class="fa fa-caret-down"></i>
    </button>
      <div class="dropdown-content">
  <form action="changestoryinfo.php" method="POST">
          <select name="per1" id="per1">
            <option selected="selected">Choose a story</option>
            <?php
            session_start();
              for($j=0; $j<count($_SESSION["myStories"]) ;$j++){
                $curStory =  $_SESSION["myStories"][$j];
                  $_SESSION["updateStory"] = $curStory;
                 ?>
                <option value="<?= $curStory?>"><?= $curStory ?></option>
            <?php
              } ?>
          </select>
          <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />
          <input class="SubmitButton" type="submit" name="SUBMITBUTTON" value="Submit" style="font-size:20px; "/>
  </form>
      </div>
    </div>


    <h3>
      <div class="dropdown">
      <button class="dropbtn"><?php session_start(); echo $_SESSION["activeUser"]; ?>
        <i class="fa fa-caret-down"></i>
      </button>
        <div class="dropdown-content">
          <a href="http://ec2-34-227-117-216.compute-1.amazonaws.com/~BenFortier/Moduele3/news/editUsername2.php">Edit Username</a>
          <a href="http://ec2-34-227-117-216.compute-1.amazonaws.com/~BenFortier/Moduele3/news/editPassword2.php">Edit Password</a>
          <a href="http://ec2-34-227-117-216.compute-1.amazonaws.com/~BenFortier/Moduele3/news/removeUser.html">Delete User</a>
        </div>
      </div>



    <?php
  }
  ?>
  <a href="http://ec2-34-227-117-216.compute-1.amazonaws.com/~BenFortier/Moduele3/news/logout.php">Logout</a>
</h3>
</div>
<br>
<br>

<h4><a href="<?=$link ?>"><?php echo $link; ?></a>


<br>
<br>
<?php
session_start();
echo($_SESSION["storyName"]);
echo("    ");
echo("by: " );
echo($_SESSION["storyAuthor"]);
?>
</h4>
<h1>
<br>
  <textarea readonly name="story" >
  <?php
  session_start();
  echo($_SESSION["activeStory"]);
  ?>
 </textarea>

<br>
<form action="storyChange.php" method="POST">

<?php
//creates a form that if it's the users story it allows them to edit or remove their story.

session_start();
if( 0 == strcmp($_SESSION["activeUser"],$_SESSION["storyAuthor"])){
  echo ("<button name='Edit' value=".$_SESSION["storyName"]." type='submit'>Edit</button>");
  echo ("<button name='Remove' value=".$_SESSION["storyName"]." type='submit'>Remove</button>");
}

 ?>
 <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />
</form>

<br>
<?php
if(0!=strcmp($_SESSION["activeUser"],"Guest")){
  ?>
  <form action = "comments.php" method ="POST">
  <input type="text"  name = "comment"   placeholder="Feel free to comment....">
  <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />
  <input type="submit" value="Comment"></input>
  <?php
}
?>


  <br>
</h1>
</form>

<h6>Comments:</h6>
<form action="commentChange.php" method="POST">
<h5>
  <?php
  //creates a form that if it's the users comment it allows them to edit or remove their comment.
  session_start();
  for($j=0; $j<count($_SESSION["commentAuthors"]) ;$j++){
  echo  $_SESSION["commentAuthors"][$j];
  echo (":  ");
  echo  $_SESSION["storyComments"][$j];
  if( 0 == strcmp($_SESSION["commentAuthors"][$j],$_SESSION["activeUser"])){
    echo (" <br>");
    echo ("<input type='text'  name = ".$_SESSION["commentID"][$j]."   placeholder='Edit your comment....''>");
    echo ("<button name='Edit' value=".$_SESSION["commentID"][$j]." type='submit'>Edit</button>");
    echo ("<button name='Remove' value=".$_SESSION["commentID"][$j]." type='submit'>Remove</button>");
  }
  echo nl2br ("\n");
}
  ?>
</h5>
<input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />
</form>


</body>
</html>
