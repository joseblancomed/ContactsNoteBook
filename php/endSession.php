<?php
	session_start();
	session_destroy();
	$_SESSION['id']="default";
	$_SESSION['password']="default";
	
	header("location:/php");
?>