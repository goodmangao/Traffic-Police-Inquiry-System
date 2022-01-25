<!doctype html> 
<html> 
<head> 
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>changeword.php</title>
    <link rel="shortcut icon" type="image/x-icon" href="http://mersey.cs.nott.ac.uk/~alysg10/coursework2/police.ico">
	<link rel="stylesheet" href="http://mersey.cs.nott.ac.uk/~alysg10/coursework2/commen.css">
</head> 
<?php
	session_start();      //open SESSION
function rep($reply,$urladdress) {//The first parameter is the reply message, and the second parameter is the jump address
    echo ("<script type='text/javascript'> alert('{$reply}');location=('{$urladdress}');</script>");
    exit;
}      
	if ($_SESSION["username"] == "") {
    rep('Sorry, you are not logged in and have no access!','logout.php');
}
?>
<body> 
  <?php
  $oldpassword = $_REQUEST ["oldpassword"]; 
  $newpassword = $_REQUEST ["newpassword"]; 
	
	$link = mysqli_connect('mysql.cs.nott.ac.uk','alysg10','YINVOZ','alysg10');
	if (!$link){
		exit('Database connection failed!');
	}
  $dbusername = null; 
  $dbpassword = null; 
  $res = mysqli_query ( $link, "select Password_Password from Passwords where Password_Amount ='{$_SESSION["username"]}';" ); 
  while ( $row = mysqli_fetch_array ( $res ) ) {  
    $dbpassword = $row ["Password_Password"]; 
  } 
  if ($oldpassword != $dbpassword) { 
    ?> 
  <script type="text/javascript"> 
    alert("wrong password"); 
    window.location.href="changepassword0.php"; 
  </script> 
  <?php
  } 
  if ($oldpassword == $dbpassword){
    $_SESSION["newpassword"]=$newpassword;
    mysqli_query ($link,"SET SQL_SAFE_UPDATES = 0;") ;
    mysqli_query ($link, "update Passwords set Password_Password='{$newpassword}' where Password_Amount='{$_SESSION["username"]}';" ) ;//If the above user name and password are determined to be good, update into the database
    mysqli_close ($link );
  ?> 
  <script type="text/javascript"> 
    alert("Password reset successfully"); 
    window.location.href="login.html"; 
  </script>
 <?php
}  ?> 
</body> 
</html> 