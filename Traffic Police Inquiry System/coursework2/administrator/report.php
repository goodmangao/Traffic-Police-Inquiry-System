<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>report.php</title>
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
	<form action="http://mersey.cs.nott.ac.uk/~alysg10/coursework2/administrator/report.php" method="post" name="indexf">
	<a class="link" href="owner0.php">Owner</a>
	<a class="link" href="car0.php">Vehicle</a>
	<a class="link" href="report0.php">Report</a>
	<a class="cp" href="changepassword0.php">Change Password</a>
	<a class="logout" href="officeradd0.php">Officer Add</a>
	<a class="logout" href="logout.php">Log Out</a>
    <h1 align="center">Report Information</h1>
    <p align="center"><input type="button" value="Add" name="inbut" onClick="location.href='http://mersey.cs.nott.ac.uk/~alysg10/coursework2/administrator/reportadd.php'" />
    <input type="text" name="sel" />
    <input type="submit" value="Search" name="sub"/></p>
    <table align="center" border="1px" cellspacing="0px" width="900px">
        <tr><th>ID</th><th>Date</th><th>Report</th><th>Driver</th><th>Vehicle</th><th>Offence</th><th>Fine Amount</th><th>Fine Points</th><th>Operate</th></tr>
    </form> 
 <?php
	$dbname=NULL;
	
	$link = mysqli_connect('mysql.cs.nott.ac.uk','alysg10','YINVOZ','alysg10');
	if (!$link){
		exit('Database connection failed');
	}
	if (empty($_POST["sel"])){
		$res = mysqli_query($link,"SELECT r3.Incident_ID, r3.Incident_Date, r3.Incident_Report, r1.People_licence, r2.Vehicle_licence, r4.Offence_description, r5.Fine_Amount,r5.Fine_Points 
		from Incident r3 left join  People r1 on r3.People_ID=r1.People_ID 
		left join Vehicle r2 on r3.Vehicle_ID=r2.Vehicle_ID 
		left join Offence r4 on r3.Offence_ID=r4.Offence_ID
		left join Fines r5 on  r5.Incident_ID=r3.Incident_ID order by r3.Incident_ID;");
	}else{
		$sel = $_POST["sel"];
		$res = mysqli_query($link,"SELECT r3.Incident_ID, r3.Incident_Date, r3.Incident_Report, r1.People_licence, r2.Vehicle_licence, r4.Offence_description, r5.Fine_Amount,r5.Fine_Points 
		from Incident r3 left join  People r1 on r3.People_ID=r1.People_ID 
		left join Vehicle r2 on r3.Vehicle_ID=r2.Vehicle_ID 
		left join Offence r4 on r3.Offence_ID=r4.Offence_ID
		left join Fines r5 on  r5.Incident_ID=r3.Incident_ID
		where People_licence like '%$sel%' or Vehicle_licence like '%$sel%';");      
	}
	
	while ($row = mysqli_fetch_array($res)){
		$dbname='a';
		$res1 = mysqli_query($link,"SELECT r1.Fine_ID from Fines r1 where r1.Incident_ID=$row[0];");
		$row1 = mysqli_fetch_array($res1);
		echo '<tr align="center">';
		echo "<td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td><td>$row[4]</td><td>$row[5]</td><td>$row[6]</td><td>$row[7]</td>
			<td>
			<input type='submit' name='upsub$row[0]' value='change' />
			<input type='submit' name='addsub$row[0]' value='ADD' />
			</td>";
		echo '</tr>';
		if (!empty($_POST["upsub$row[0]"])){
			echo '<tr align="center">';
			echo "<td>$row[0]</td>
				<td><input type='text' name='chda' value='$row[1]' /></td>
				<td><input type='text' name='chre' value='$row[2]' /></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td><input type='submit' value='Confirm changes' name='upsubs$row[0]'/></td>";
			echo '</tr>';
		}
		if (!empty($_POST["upsubs$row[0]"])){
			$chda = $_POST['chda'];
			$chre = $_POST['chre'];
			mysqli_query($link,"update Incident set  Incident_Date='$chda',Incident_Report='$chre' where Incident_ID=$row[0]");
			header('location:#');
	}
		
		if (!empty($_POST["addsub$row[0]"])){
			echo '<tr align="center">';
			echo "<td>$row[0]</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td><input type='text' name='chfa' value='$row[6]' /></td>
				<td><input type='text' name='chfp' value='$row[7]' /></td>
				<td><input type='submit' value='Confirm add' name='addsubs$row[0]'/></td>";
			echo '</tr>';
		}
		if ((!empty($_POST["addsubs$row[0]"])) and (!empty($row1))) {
			$chfam = $_POST['chfa'];
			$chfpo = $_POST['chfp'];
		    mysqli_query($link,"UPDATE Fines SET Fine_Amount='$chfam',Fine_Points='$chfpo' WHERE Fine_ID='$row1[0]';");
			header('location:#');
}
		if ((!empty($_POST["addsubs$row[0]"])) and (empty($row1))){
			$chfa = $_POST['chfa'];
			$chfp = $_POST['chfp'];
			mysqli_query($link,"INSERT INTO Fines(Fine_Amount,Fine_Points,Incident_ID) VALUES ('$chfa ','$chfp','$row[0]') ;");
			header('location:#');
		}
		
	}
	if (is_null($dbname)) { 
		?> 
		<script type="text/javascript"> 
		   alert("Character does not exist"); 
		   window.location.href="report0.php"; 
		</script> 
		<?php 
	}	

	mysqli_close($link);
 ?>
		</table>
</body>
</html>