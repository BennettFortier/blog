<DOCTYPE! html>
<hmtl>
  <head>
    <title>Edit Username</title>
  </head>
  <body>
    <form action="editUsername.php" method="POST">
      <input type="text" name="newUser" >
      <input type="hidden" name="tokens" value="<?php session_start(); echo $_SESSION['token'];?>" />
      <input type="submit" name = "buttons" value="Submit  New Username"/>
    </form>
  </body>
  </html>
