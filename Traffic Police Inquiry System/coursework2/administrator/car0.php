
<!doctype html>
<html>
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>car.php</title>
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
	<form action="http://mersey.cs.nott.ac.uk/~alysg10/coursework2/administrator/car.php" method="post" name="indexf">	
	<a class="link" href="owner0.php">Owner</a>
	<a class="link" href="car0.php">Vehicle</a>
	<a class="link" href="report0.php">Report</a>
	<a class="cp" href="changepassword0.php">Change Password</a>
	<a class="logout" href="officeradd0.php">Officer Add</a>
	<a class="logout" href="logout.php">Log Out</a>
		<h1 align="center">Vehicle Information</h1>
		<p align="center"><input type="button" value="Add" name="inbut" onClick="location.href='http://mersey.cs.nott.ac.uk/~alysg10/coursework2/administrator/vehicleadd.php'" />
		<input type="text" name="sel" /><input type="submit" value="Search" name="sub" /></p>
		<table align="center" border="1px" cellspacing="0px" width="800px" ;>
			<tr><th>ID</th><th>TYPE</th><th>COLOR</th><th>CAR LICENCE</th><th>OWNER</th><th>OWNER LICENCE</th></tr>
</body>
</html>
               