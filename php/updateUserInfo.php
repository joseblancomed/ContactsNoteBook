

<?php
	session_start();
	
	function getInfoUser($nameUser)
	{
		$connectionDB = mysqli_connect("localhost","root","","ContactNoteBook");
		
		$registerUser  = mysqli_query($connectionDB, "select id,nameUser, emailUser, passwordUser  from users where nameUser='".$nameUser."';");
		$reg = mysqli_fetch_row($registerUser);
		
		return $reg;
	}
	
	$resultArray = getInfoUser($_SESSION['id']);
	
	echo "<script type='text/javascript' src='//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js'></script>
	<script type='text/javascript' src='ajax.js'></script>
	
	
	<input type='hidden' value='".$resultArray[0]."' id='userIdInfo'  name='iId' readonly/><br/><br/>		

	Name:&nbsp; <input type='text' name='nName' maxlength='20' value='".$resultArray[1]."' id='userNameInfo'/><br/><br/>

	Email:&nbsp;<input type='text' name='nEmail' maxlength='60' value='".$resultArray[2]."' id='userEmailInfo'/><br/><br/>

	Password:&nbsp;<input type='text' name='nPassword' maxlength='20' value='".$resultArray[3]."' id='userPasswordInfo' /><br/><br/>

	<input type='submit' value='Modify' name='saveItUpdate' id=\"saveItUpdate\" onclick=\"this.disable;this.value='Saving...';loadDoc();\" />"; 
		
	
?>

