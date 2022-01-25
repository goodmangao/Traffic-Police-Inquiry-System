<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Add Owner</title>
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
	
	<form action="" method="post" name="inf">
	<a class="link" href="owner0.php">Owner</a>
	<a class="link" href="car0.php">Vehicle</a>
	<a class="link" href="report0.php">Report</a>
	<a class="cp" href="changepassword0.php">Change Password</a>
	<a class="logout" href="officeradd0.php">Officer Add</a>
	<a class="logout" href="logout.php">Log Out</a>
	<h1 align="center">Add Owner</h1>
	<p align="center">Name:<input type="text" name="up" /></p>
	<p align="center">Address:<input type="text" name="ua" /></p>
	<p align="center">LICENCE:<input type="text" name="ul" /></p>
	<p align="center"><input type="submit" name="sub" value="Submit"/></p>
	</form>
	<?php
    $dbownerID=NULL;
    $dbvehicleID=NULL;
	$dbvehicle=$_SESSION['sa'];
	$link = mysqli_connect('mysql.cs.nott.ac.uk','alysg10','YINVOZ','alysg10');
	if (!$link){
		exit('Database connection failed');
	}
	if (!empty($_POST["sub"])){
        $up = $_POST['up'];
		$ua = $_POST['ua'];
		$ul = $_POST['ul'];	
        mysqli_query ($link,"SET SQL_SAFE_UPDATES = 0;") ;
        mysqli_query($link,"INSERT INTO People (People_name, People_address, People_licence) VALUES('$up','$ua','$ul');");
		$res = mysqli_query($link,"select people_ID,Vehicle_ID from People,Vehicle where people_licence = '$ul' and Vehicle_licence = '$dbvehicle';");
		$row = mysqli_fetch_array($res);
		mysqli_query($link,"UPDATE Vehicle SET P_ID=('$row[0]') WHERE Vehicle_ID=$row[1];");
		$_SESSION['yes'] = 'Added successfully!';
		header('location:car.php');
	}
	?>
</body>
</html>