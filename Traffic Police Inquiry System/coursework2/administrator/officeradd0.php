<!doctype html> 
<html> 
<head> 
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>addaccount.php</title>
    <link rel="shortcut icon" type="image/x-icon" href="http://mersey.cs.nott.ac.uk/~alysg10/coursework2/police.ico">
	  <link rel="stylesheet" href="http://mersey.cs.nott.ac.uk/~alysg10/coursework2/commen.css">
</head> 
<?php
	session_start();      //open SESSION
function rep($reply,$urladdress) {//The first parameter is the reply message, and the second parameter is the jump address
    echo ("<script type='text/javascript'> alert('{$reply}');location=('{$urladdress}');</script>");
    exit;
}      
	if ($_SESSION["username"] != "Daniels") {
    rep('Sorry, you are not logged in and have no access!','logout.php');
}
?>
<body>  
  
  <a class="link" href="owner0.php">Owner</a>
	<a class="link" href="car0.php">Vehicle</a>
	<a class="link" href="report0.php">Report</a>
	<a class="cp" href="changepassword0.php">Change Password</a>
  <a class="logout" href="officeradd0.php">Officer Add</a>
	<a class="logout" href="logout.php">Log Out</a>
  <h1 align="center">Add Officer</h1>
  <form action="http://mersey.cs.nott.ac.uk/~alysg10/coursework2/administrator/officeradd.php" method="post" name="form_register" onsubmit="return check()"> 
  <p align="center">Username:<input type="text" name="username" id="username"></p>
  <p align="center">Password:<input type="password" name="password" id="password"></p>
  <p align="center">Assert password:<input type="password" name="assertpassword" id="assertpassword"></p>
  <p align="center"><input type="submit" value="ADD"> </p>
  
  </form> 
  
  <script type="text/javascript"> 
    function check() { 
      var username=document.getElementById("username").value; 
      var password=document.getElementById("password").value; 
      var assertpassword=document.getElementById("assertpassword").value; 
      var regex=/^[/s]+$/; 
        
      if(regex.test(username)||username.length==0){ 
        alert("The username format is incorrect"); 
        return false; 
      } 
      if(regex.test(password)||password.length==0){ 
        alert("Password format is incorrect"); 
        return false;     
      } 
      if(password!=assertpassword){ 
        alert("The two passwords are inconsistent"); 
        return false; 
      } 
    } 
  </script> 
</body> 
</html>