<!doctype html>
<html>
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>logout</title>
    <link rel="shortcut icon" type="image/x-icon" href="http://mersey.cs.nott.ac.uk/~alysg10/coursework2/police.ico">
	<link rel="stylesheet" href="http://mersey.cs.nott.ac.uk/~alysg10/coursework2/commen.css">

</head>
 
<body>
<?php
    session_start();
	if(isset($_SESSION["username"]))
	{
		session_unset();
		session_destroy();
	}
	header("location:http://mersey.cs.nott.ac.uk/~alysg10/coursework2/officer/login.html");
?>
</body>
</html>