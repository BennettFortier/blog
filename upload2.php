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
              <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />
      </form>
    </div>
  </div>

  <a href="http://ec2-34-227-117-216.compute-1.amazonaws.com/~BenFortier/Moduele3/news/upload.html">Upload</a>

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
        <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />
</form>
    </div>
  </div>


  <h3>
    <div class="dropdown">
    <button class="dropbtn"><?php session_start(); echo $_SESSION["activeUser"]; ?>
      <i class="fa fa-caret-down"></i>
    </button>
      <div class="dropdown-content">
        <a href="http://ec2-34-227-117-216.compute-1.amazonaws.com/~BenFortier/Moduele3/news/editUsername.html">Edit Username</a>
        <a href="http://ec2-34-227-117-216.compute-1.amazonaws.com/~BenFortier/Moduele3/news/editPassword.html">Edit Password</a>
        <a href="http://ec2-34-227-117-216.compute-1.amazonaws.com/~BenFortier/Moduele3/news/removeUser.html">Delete User</a>
      </div>
    </div>

    <a href="http://ec2-34-227-117-216.compute-1.amazonaws.com/~BenFortier/Moduele3/news/logout.php">Logout</a>
  </h3>
</div>
<br>
<br>

  <form action = "upload.php" method ="POST">
  <h3><input type="text"  name = "title" id="user"  placeholder="Enter Title">
    <br>
      <input type="text"  name = "link" id="user"  placeholder="Enter Link (Optional)">
  </h3>
  <h1><textarea  name = "story" placeholder="Type your story in here" ></textarea></h1>
<h2><input type="submit"  value="Submit"/></h2>
<input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />
</form>

</body>
</html>
