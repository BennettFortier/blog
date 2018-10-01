<DOCTYPE! html>
<html>
<head>
 <link rel="stylesheet" type= "text/css" href= "login.css">
 <title>News</title>
</head>

<body>
<form action = "login.php" method ="POST">
  <h2>


    <label for="user"><h1>Username</h1><br></label>
    <input type="text"  name = "username" id="user"  placeholder="Enter Username">



    <div class="form-group">
      <label for="exampleInputPassword1"><h1>Password</h1><br></label>
      <input type="password" class="form-control" name = "password" id="exampleInputPassword1" placeholder="Password">
    </div>


  <input type="submit" name = "buttons" value="Login"/>
  <input type="reset" name = "buttons"/>
  <input type="submit" name = "buttons" value="Register"/><br>
  <input type="submit" name = "buttons" value="Continue Without Login"/>
  </h2>
</form>
</body>

<html>
