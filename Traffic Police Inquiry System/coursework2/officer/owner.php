<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>owner.php</title>
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
	<form action="http://mersey.cs.nott.ac.uk/~alysg10/coursework2/officer/owner.php" method="post" name="indexf">
	<a class="link" href="owner0.php">Owner</a>
	<a class="link" href="car0.php">Vehicle</a>
	<a class="link" href="report0.php">Report</a>
	<a class="cp" href="changepassword0.php">Change Password</a>
	<a class="logout" href="logout.php">Log Out</a>
	<h1 align="center">Owner Information</h1>
	<p align="center"><input type="text" name="sel" />
	<input type="submit" value="Search" name="selsub" /></p>
	<table align="center" border="1px" cellspacing="0px" width="900px">
		<tr><th>ID</th><th>NAME</th><th>ADDRESS</th><th>LICENCE</th></tr>
	</form>
 <?php
	$dbname=NULL;
	$link = mysqli_connect('mysql.cs.nott.ac.uk','alysg10','YINVOZ','alysg10');
	if (!$link){
		exit('Database connection failed');
	}
	if (empty($_POST["selsub"])){
		$res = mysqli_query($link,"select * from people order by People_ID");//Full result set
	}else{
		$sel = $_POST["sel"];
		$res = mysqli_query($link,"select * from People where people_name like '%$sel%' or People_licence like '%$sel%'");	
	}	
	while ($row = mysqli_fetch_array($res)){
		$dbname='a';
		echo '<tr align="center">';
		echo "<td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td>";
		echo '</tr>';	
	}
	if (is_null($dbname)) {	 
		?> 
		<script type="text/javascript"> 
		   alert("Character does not exist"); 
		   window.location.href="owner0.php"; 
		</script> 
		<?php 
	}	
	mysqli_close($link);
 ?>
		</table>
</body>
</html>