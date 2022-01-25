<!doctype html> 
<html> 
<head> 
  <meta charset="UTF-8"> 
  <title>Log in</title> 
</head> 
<body> 
  <?php 
    session_start();//Log in to the system to open a session content
    $username=$_REQUEST["username"];//Get the username in html (via post request) 
    $password=$_REQUEST["password"];//Get the password in html (via post request) 
  
    $link=mysqli_connect("mysql.cs.nott.ac.uk","alysg10","YINVOZ","alysg10");//Connect to mysql database, account name alysg10, password alysg10
    if (!$link) { 
      die('Database connection failed'.$mysql_error()); 
    } 
    
    $dbusername=null; 
    $dbpassword=null; 
    $result="SELECT Password_Amount, Password_Password FROM Passwords WHERE Password_Amount = '$username' ;";//Find out the information corresponding to the user name，

    $res = mysqli_query($link,$result);
    $row=mysqli_fetch_array($res); {
    $dbusername=$row[0];
    $dbpassword=$row[1];
    } 
    if (is_null($dbusername)) { 
  ?> 
  <script type="text/javascript"> 
    alert("Username does not exist"); 
    window.location.href="login.html"; 
  </script> 
  <?php 
    } 
    else { 
      if ($dbpassword!=$password){//Jump back to the login.html interface when the corresponding password is incorrect
  ?> 
  <script type="text/javascript"> 
    alert("wrong password"); 
    window.location.href="login.html"; 
  </script> 
  <?php 
      } 
      else { 
        if ($dbusername!="Daniels"){
          $_SESSION["username"]=$username;
          $_SESSION["password"]=$password; 
          $_SESSION["newpassword"]=$password;
          $_SESSION["code"]=mt_rand(0, 100000);//Attach a random value to the session to prevent users from directly accessing welcome.php through the calling interface
  ?> 
  <script type="text/javascript"> 
    window.location.href="http://mersey.cs.nott.ac.uk/~alysg10/coursework2/officer/owner0.php"; 
  </script> 
  <?php 
        }
        else{
          $_SESSION["username"]=$username; 
          $_SESSION["password"]=$password; 
          $_SESSION["newpassword"]=$password;
          $_SESSION["code"]=mt_rand(0, 100000);
  ?> 
  <script type="text/javascript"> 
    window.location.href="http://mersey.cs.nott.ac.uk/~alysg10/coursework2/administrator/owner0.php"; 
  </script> 
  <?php 
        }
      } 
    } 
  mysql_close($link);//Close the database connection, if you don’t close it, an error will occur the next time you connect
  ?> 
</body> 
</html> 