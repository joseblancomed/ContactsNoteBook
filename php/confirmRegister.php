<?php
	session_start();
	require("db.php");
	$newUser = new dbConnection();
?>
<html>

<head>

<title>Register Successful</title>

<link rel="stylesheet" type="text/css" href="cssIndex.css" />
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
<?php	
	if (isset($_POST['createUser']))
	{
		$actionAdd = $newUser->add_user($_POST['aUser'],$_POST['auEmail'],$_POST['rauEmail'],$_POST['auPassword'],$_POST['rauPassword']);
		if ($actionAdd)
			echo "<script language='JavaScript'>chargeBalloonConfirmation();</script>";
		else
			echo "<script language='JavaScript'>chargeBalloonIssue();</script>";
	}
?>
</form>

</body>

</html>
