<!DOCTYPE html> 
<html> 
<head> 
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>changeword.php</title>
    <link rel="shortcut icon" type="image/x-icon" href="http://mersey.cs.nott.ac.uk/~alysg10/coursework2/police.ico">
	  <link rel="stylesheet" type="text/css" href="http://mersey.cs.nott.ac.uk/~alysg10/coursework2/commen.css"> 
</style> 
</head> 
<?php
	session_start();      //open SESSION
function rep($reply,$urladdress) {//The first parameter is the reply message, and the second parameter is the jump address
    echo ("<script type='text/javascript'> alert('{$reply}');location=('{$urladdress}');</script>");
    exit;
}      
	if ($_SESSION["username"] == "" ) {
    rep('Sorry, you are not logged in and have no access!','logout.php');
}
function rep1($reply1,$urladdress1) {
  echo ("<script type='text/javascript'> alert('{$reply1}');location=('{$urladdress1}');</script>");
  exit;
}      
if ( $_SESSION["newpassword"]!=$_SESSION["password"]) {
  rep1('You have successfully changed your password, please log in again','logout.php');
}
?>
<body>     
  <a class="link" href="owner0.php">Owner</a>
	<a class="link" href="car0.php">Vehicle</a>
	<a class="link" href="report0.php">Report</a>
	<a class="cp" href="changepassword0.php">Change Password</a>
	<a class="logout" href="logout.php">Log Out</a>
  <form action="http://mersey.cs.nott.ac.uk/~alysg10/coursework2/officer/changepassword.php" method="post" onsubmit="return alter()"> 
    <h1 align="center">Change Password</h1>
    <div class="container">
        Username:<?php
        echo $_SESSION["username"]
        ?></div>
    <div  class="container" >Old Password:<input type="password" name="oldpassword" id ="oldpassword"/><br/> </div>       
    <div class="container">New password:<input type="password" name="newpassword" id="newpassword"/><br/></div> 
    <div  class="container">Assert password:<input type="password" name="assertpassword" id="assertpassword"/><br/> </div> 
    <div  class="container"><input type="submit" value="Change Password" onclick="return alter()"> 
    </div>
  </form>  
  <script type="text/javascript"> 
    function alter() {     
      var oldpassword=document.getElementById("oldpassword").value; 
      var newpassword=document.getElementById("newpassword").value; 
      var assertpassword=document.getElementById("assertpassword").value; 
      var regex=/^[/s]+$/; 
      if(regex.test(oldpassword)||oldpassword.length==0){ 
        alert("Password format is incorrect"); 
        return false; 
      } 
      if(regex.test(newpassword)||newpassword.length==0) { 
        alert("The new password format is incorrect"); 
        return false; 
      } 
      if (assertpassword != newpassword||assertpassword==0) { 
        alert("Two password entries are inconsistent"); 
        return false; 
      } 
      return true;  
    } 
  </script>  
</body> 
</html> 