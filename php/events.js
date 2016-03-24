
function chargeBalloonConfirmation()
{
	$("#balloon").load("confirmAddUser.php");
}

function chargeBalloonIssue()
{
	$("#balloon").load("failAddUser.php");
}

function chargeLogInBalloonIssue()
{
	$("#balloon").load("failLogInUser.php");
}

function close_session()
{
	this.location="endSession.php";
}

function backIndex()
{
	this.location="/php";
}

