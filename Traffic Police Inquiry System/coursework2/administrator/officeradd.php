<!doctype html> 
<html> 
<head> 
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>login</title>
  <link rel="shortcut icon" type="image/x-icon" href="http://mersey.cs.nott.ac.uk/~alysg10/coursework2/police.ico">
  <link rel="stylesheet" href="login.css">
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
  <?php 
    session_start(); 
    $username=$_REQUEST["username"]; 
    $password=$_REQUEST["password"];  
    
    $link = mysqli_connect('mysql.cs.nott.ac.uk','alysg10','YINVOZ','alysg10');
    if (!$link){
      exit('Database connection failed');
    }
    $dbusername=null; 
    $dbpassword=null; 
    $result=mysql_query($link, "select * from Passwords where Password_Amount ='{$username}';"); 
    while ($row=mysql_fetch_array($result)) { 
      $dbusername=$row["username"]; 
      $dbpassword=$row["password"]; 
    } 
    
    if(!is_null($dbusername)){ 
  ?> 
  <script type="text/javascript"> 
    alert("User already exists"); 
    window.location.href="officeradd0.php"; 
  </script>  
  <?php 
    } else{
       mysqli_query ($link, "insert into Passwords(Password_Amount,Password_Password) values ('{$username}','{$password}');"); 
    
  ?> 
  <script type="text/javascript"> 
    alert("registration success"); 
    window.location.href="officeradd0.php"; 
  </script> 
  <?php    
    }
  mysql_close($link);
  ?>  
</body> 
</html> 