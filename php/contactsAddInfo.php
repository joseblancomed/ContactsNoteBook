

<?php
	require("db.php");
	session_start();	
?>

<?php
	
	$consultContacts = new dbConnection();
	$consultContacts->viewAddRegister();
?>
