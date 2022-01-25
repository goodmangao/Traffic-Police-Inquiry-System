<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Add vehicle record</title>
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
	
	<form action="" method="post" name="inf">
	<a class="link" href="owner0.php">Owner</a>
	<a class="link" href="car0.php">Vehicle</a>
	<a class="link" href="report0.php">Report</a>
	<a class="cp" href="changepassword0.php">Change Password</a>
	<a class="logout" href="logout.php">Log Out</a>
	<h1 align="center">Add vehicle record</h1>
		<p align="center">TYPE:<input type="text" name="sn" /></p>
		<p align="center">COLOR:<input type="text" name="ss" /></p>
		<p align="center">LICENCE:<input type="text" name="sa" /></p>
		<p align="center">OWNER LICENCE:<input type="text" name="sm" /></p>
		<p align="center"><input type="submit" name="sub" value="Submit"/></p>
	</form>
	<?php
	
	$link = mysqli_connect('mysql.cs.nott.ac.uk','alysg10','YINVOZ','alysg10');
	if (!$link){
		exit('Database connection failed');
	}
	if (!empty($_POST["sub"])){
		$sn = $_POST['sn'];
		$ss = $_POST['ss'];
		$sa = $_POST['sa'];
		$sm = $_POST['sm'];
		mysqli_query($link,"INSERT INTO Vehicle (Vehicle_type, Vehicle_colour, Vehicle_licence) VALUES('$sn','$ss','$sa')");
		
		$_SESSION['sm']=$sm;
		$_SESSION['sa']=$sa;	
	
		$res = mysqli_query($link,"select People_licence from People where People_licence = '$sm';" );
		$row = mysqli_fetch_array($res);
		if (is_null($row)) {		 
		?> 
			<script type="text/javascript">  
			window.location.href="veowneradd.php"; 
			</script> 
			<?php 
		}
		else{
			$res1 = mysqli_query($link,"select r1.people_ID,r2.Vehicle_ID from People r1,Vehicle r2 where r1.people_licence = '$sm' and r2.Vehicle_licence = '$sa';");
			$row1 = mysqli_fetch_array($res1);
			mysqli_query($link,"UPDATE Vehicle SET P_ID = $row1[0] where Vehicle_ID=$row1[1];");
			$_SESSION['yes'] = 'Added successfully!';
			header('location:car.php');
	}	
	}
	?>
</body>
</html>