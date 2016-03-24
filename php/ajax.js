$(document).ready(function()
{
	$("#login").click(function(event){
		$("#balloon").load("indexLogIn.php");
	});
	
	$("#reg").click(function(event){
		$("#balloon").load("indexLogReg.php");
	});
	
	$("#clearForm").click(function(event){
		$("#balloon").load("indexLogIn.php");
	});
	
	$("#back_register").click(function(event){
		$("#home").load("/php");
	});
	
	$("#back_login").click(function(event){
		$("#home").load("/php");
	});
	
	$("#bCloseSession").click(function(event){
		alert("hola");
	});
});
