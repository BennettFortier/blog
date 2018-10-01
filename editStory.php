<DOCTYPE! html>
<html>
<head>
 <link rel="stylesheet" type= "text/css" href= "login.css">
 <title>Upload a story</title>
</head>
<body>

  <h1>
    What's New(s)?
  </h1>

<div class="navbar">
  <a href="http://ec2-34-227-117-216.compute-1.amazonaws.com/~BenFortier/Moduele3/news/homepage.php">Home</a>
<!-- Creates dropdown menu for all stories stored on database -->
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
              <input class="SubmitButton" type="submit" name="SUBMITBUTTON" value="Submit" style="font-size:20px; "/>
      </form>
    </div>
  </div>

  <a href="http://ec2-34-227-117-216.compute-1.amazonaws.com/~BenFortier/Moduele3/news/upload.html">Upload</a>
  <!-- Creates dropdown menu for users stories stored on database -->

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
        <input class="SubmitButton" type="submit" name="SUBMITBUTTON" value="Submit" style="font-size:20px; "/>
</form>
    </div>
  </div>

  <!-- Creates dropdown menu to deal with users changing account information -->

  <h3>
    <div class="dropdown">
    <button class="dropbtn"><?php session_start(); echo $_SESSION["activeUser"]; ?>
      <i class="fa fa-caret-down"></i>
    </button>
      <div class="dropdown-content">
        <a href="http://ec2-34-227-117-216.compute-1.amazonaws.com/~BenFortier/Moduele3/news/editUsername2.php">Edit Username</a>
        <a href="http://ec2-34-227-117-216.compute-1.amazonaws.com/~BenFortier/Moduele3/news/editPassword2.php">Edit Password</a>
        <a href="http://ec2-34-227-117-216.compute-1.amazonaws.com/~BenFortier/Moduele3/news/removeUser2.php">Delete User</a>
      </div>
    </div>

    <a href="http://ec2-34-227-117-216.compute-1.amazonaws.com/~BenFortier/Moduele3/news/logout.php">Logout</a>
  </h3>
</div>
<br>
<br>
<!-- Creates a form to view story. Allows to retitle, relink, rewrite story-->

<?php
     session_start();
     echo ("<form action = 'editStory2.php' method ='POST'>");
     echo ("<h3><input type = 'text' name = 'retitle' value = ".$_SESSION["storyName"].">");
     echo (" <br>");
     echo("<input type = 'text' name = 'relink' value = ".$_SESSION["link"]."></h3>");
     ?>

     <textarea name="editStory" >
     <?php
     session_start();
     echo($_SESSION["activeStory"]);
      ?>
    </textarea>

 <h2><input type="submit"  value="Submit"/></h2>
 </form>

</body>
</html>
