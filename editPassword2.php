<DOCTYPE! html>
<hmtl>
  <head>
    <title>Edit Password</title>
  </head>
  <body>
    <form action="editPassword.php" method="post">
      <input type="password" name="newPass" >
      <input type="hidden" name="token" value="<?php session_start(); echo $_SESSION['token'];?>" />
      <input type="submit" name = "buttons" value="Submit  New Password"/>
    </form>
  </body>
  </html>
