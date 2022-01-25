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
	$link = mysqli_connect('mysql.cs.nott.ac.uk','alysg10','YINVOZ','alysg10');
	if (!$link){
		exit('Database connection failed');
	}
?>
<body>
	<form action="" method="post" name="inf">
	<a class="link" href="owner0.php">Owner</a>
	<a class="link" href="car0.php">Vehicle</a>
	<a class="link" href="report0.php">Report</a>
	<a class="cp" href="changepassword0.php">Change Password</a>
	<a class="logout" href="logout.php">Log Out</a>
	<h1 align="center">Add Report</h1>
	<p align="center">Date:<input type="text" name="td" /></p>
	<p align="center">Report:<input type="text" name="tr" /></p>
	<p align="center">DRIVER LICENCE:<input type="text" name="tdr" /></p>
	<p align="center">Vehicle LICENCE:<input type="text" name="tv" /></p>
	<p align="center" >Offence:<select style="width: 15%" name="to" >
	<option selected="selected" value="">-- Please select offence --</option>
	<?php 
	$res3 = mysqli_query($link,"select Offence_description from Offence order by Offence_ID;");
	while ($row3 = mysqli_fetch_array($res3)){
	?>
	<option value="<?php echo $row3[0]; ?>"><?php echo $row3[0]; ?></option>
	<?php } ?>
	</select>
	</p>	
	<p align="center"><input type="submit" name="sub" value="Submit"/></p>
	</form>
	<?php
	
	
	if (!empty($_POST["sub"])){
		$td = $_POST['td'];
		$tr = $_POST['tr'];
		$tdr = $_POST['tdr'];
		$tv = $_POST['tv'];
		$to = $_POST['to'];
		$res = mysqli_query($link,"select r1.People_ID, r2.Vehicle_ID, r3.Offence_ID from People r1,Vehicle r2,Offence r3 where People_licence='$tdr' and Vehicle_licence='$tv' and Offence_description = '$to' ;");
		$row = mysqli_fetch_array($res);
		if (!empty($row[0])){
			mysqli_query($link,"INSERT INTO Incident(People_ID,Vehicle_ID,Incident_Date,Incident_Report,Offence_ID) VALUES ('$row[0]','$row[1]','$td','$tr','$row[2]');");
			$_SESSION['yes'] = 'Added successfully!';
			header('location:report.php');
		}
		$res1 = mysqli_query($link,"select r1.People_ID from People r1 where People_licence='$tdr' ;");
		$row1 = mysqli_fetch_array($res1);
		if (is_null($row1)){		 
			?> 
				<script type="text/javascript">  
				window.location.href="reowneradd.php"; 
				</script> 
				<?php 
			}
		$res2 = mysqli_query($link,"select r2.Vehicle_ID from Vehicle r2 where Vehicle_licence='$tv' ;");
		$row2 = mysqli_fetch_array($res2);
		if (is_null($row2)){		 
			?> 
				<script type="text/javascript">  
				window.location.href="revehicleadd.php"; 
				</script> 
				<?php 
			}
		
	}
	?>
</body>
</html>