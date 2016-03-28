$(document).ready(function()
{
	$("#login").click(function(event){ $("#balloon").load("indexLogIn.php"); });
	
	$("#reg").click(function(event){ $("#balloon").load("indexLogReg.php");	});
	
	$("#clearForm").click(function(event){ $("#balloon").load("indexLogIn.php"); });
	
	$("#back_register").click(function(event){ $("#home").load("/php");	});
	
	$("#back_login").click(function(event){	$("#home").load("/php"); });
	
	$("#bUpdateUser").click(function(event){ window.location = "/php/updateUser.php"; });
	
	$("#bBack").click(function(event){ window.location = "/php/index.php"; });
	
	$("#saveItUpdate").click(function(event){ $("#balloonIUser").load("/php/updateUserInfo.php"); window.location.reload(); });	
			
});


function chargeBalloonConfirmation(){ $("#balloon").load("confirmAddUser.php"); };

function chargeBalloonIssue(){ $("#balloon").load("failAddUser.php"); };

function chargeLogInBalloonIssue(){ $("#balloon").load("failLogInUser.php"); };

function close_session(){ this.location="endSession.php"; };

function backIndex(){ this.location="/php"; };

function closeView()
{ 
	document.getElementById('viewTable').style.display='none'; 
	document.getElementById('viewForm').style.display='none'; 
};

function change()
{ 
	if (document.getElementById('pressIt').checked) 
		document.getElementById('eNum').style.visibility='visible'; 
	else 
		document.getElementById('eNum').style.visibility='hidden'; 
};

function chargeBalloonIUser() { $("#balloonIUser").load("/php/updateUserInfo.php"); };

function chargePages() { $("#tableIC").load("/php/contactsInfo.php"); };







