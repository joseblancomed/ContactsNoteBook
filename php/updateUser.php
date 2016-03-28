<?php

	session_start();
	
	$cFile = include("db.php");
	if ($cFile)
		$person = new dbConnection();
	else
		echo "<script language='JavaScript'>alert('Fail to choose the file PHP');</script>";
?>
<html>

<head>

<title>Example databases with Classes</title>

<!---- Cascade ----->
<link rel="stylesheet" type="text/css" href="indexLogIn.css" />
<link rel="stylesheet" type="text/css" href="cssIndex.css" />
<link rel="stylesheet" type="text/css" href="css.css" />
<link rel="stylesheet" type="text/css" href="cssBackground.css" />
<link rel="stylesheet" type="text/css" href="cssUpdateUserInfo.css" />

<!---- JavaScript ----->

<script type="text/javascript" src="js/jquery-1.5.1.min.js"></script>
<script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript" src="ajax.js"></script>

</head>
<body onload="chargeBalloonIUser()" >

<?php
	
	function getInfoUser($nameUser)
	{
		$connectionDB = mysqli_connect("localhost","root","","ContactNoteBook");
		
		$registerUser  = mysqli_query($connectionDB, "select id,nameUser, emailUser, passwordUser  from users where nameUser='".$nameUser."';");
		$reg = mysqli_fetch_row($registerUser);
		
		return $reg;
	}
	
	function updateTableName($oldName, $newName)
	{
		$connectionDB = mysqli_connect("localhost","root","","ContactNoteBook");
		$varOldName = "contactPeople_".$oldName;
		$varNewName = "contactPeople_".$newName;
		mysqli_query($connectionDB, "RENAME TABLE `".$varOldName."` TO `".$varNewName."`");	 
		//echo "<script language='JavaScript'>alert('".$varOldName." ' + ' ".$varNewName."')</script>"; 
	}
	
	function setInfoUser($id, $nameUser, $emailUser, $passwordUser)
	{
		
		//echo "<script language='JavaScript'>alert(' ".$id." ' + ' ".$nameUser." ' + ' ".$emailUser." ' + ' ".$passwordUser." ')</script>"; 
		$connectionDB = mysqli_connect("localhost","root","","ContactNoteBook");
		
		$checkUser  = mysqli_query($connectionDB, "select id,nameUser, emailUser, passwordUser  from users where id=".$id.";");
		$reg = mysqli_fetch_row($checkUser);
		
		$assingInfo = mysqli_query($connectionDB, "update users set nameUser='".$nameUser."', emailUser='".$emailUser."',passwordUser='".$passwordUser."' where id=".$id.";");	
		
		$userUpdated  = mysqli_query($connectionDB, "select id,nameUser, emailUser, passwordUser  from users where id=".$id.";");
		$regUpdated = mysqli_fetch_row($userUpdated);
		
		if ($reg[1] != $nameUser)
		{
			$_SESSION['id'] = $regUpdated[1];
			updateTableName($reg[1],$regUpdated[1]);
		}		
	/*  
		if ($assingInfo)
			return true;
		else
			return false; */
	}
	
	if (($_SESSION['id']!="default" && $_SESSION['password']!="default" ) && ($_SESSION['id']!="" && $_SESSION['password']!="" )) 
	{
		echo "<form action='#' method='POST' id='informationUser'><fieldset id=\"balloonIUser\" onload=\"loadDoc()\" ></fielset>
			</form><div id='writeText'></div>".$person->who_session_is_update();	
	}
	else
		header('Location:accessFail.php');
	
	
	if (isset($_POST['saveItUpdate']))
	{
	 	setInfoUser($_POST['iId'],$_POST['nName'],$_POST['nEmail'],$_POST['nPassword']);
		echo "<script language='JavaScript'>chargeBalloonIUser()</script>";	
		$person->who_session_is_update();
	}
?>

</body>
</html>
