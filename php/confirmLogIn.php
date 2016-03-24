<?php

	$cFile = require("db.php");
		if ($cFile)
			$newLogin = new dbConnection();
		else
			echo "<script language='JavaScript'>alert('Fail to choose the file PHP');</script>";
		
	session_start();
	
	$_SESSION['id']="default";
	$_SESSION['password']="default";
	
	if ($_SESSION['id']!=="default" && $_SESSION['password']!=="default")
		header('location:index.php');
?>
<html>

<head>

<title>Login Unsuccessful</title>

<link rel="stylesheet" type="text/css" href="indexLogIn.css" />
<script type="text/javascript" src="js/jquery-1.5.1.min.js"></script>
<script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type='text/javascript' src="ajax.js"></script>
<script type='text/javascript' src="events.js"></script>

</head>
<body>

	<div id="home">
		<div id="balloon">
		
		</div>
		
	</div>
</body>

</html>
<?php
	if (isset($_POST['bLogIn']))
	{
		$queryUSR = new dbConnection();
		$resultLogIn = $newLogin->user_logIn($_POST['aUser'],$_POST['aPassword']);
		
		if ($resultLogIn == 1)
		{
			$confirmAT = strpos($_POST['aUser'],'@');
			$confirmDOT = strpos($_POST['aUser'],'.');
		
			if ($confirmAT !== false && $confirmDOT !== false)
				$_SESSION['id'] = $queryUSR->extractUser($_POST['aUser']);
			else 
				$_SESSION['id'] = $_POST['aUser'];
			
			$_SESSION['password']=$_POST['aPassword'];
			header('location:index.php');
		}
		else
			echo "<script language='JavaScript'>chargeLogInBalloonIssue();</script>";
	}
	
	
 
?>