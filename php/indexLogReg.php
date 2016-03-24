
<html>

<head>

<title>LogRegister</title>

<link rel="stylesheet" type="text/css" href="indexLogIn.css" />
<script type="text/javascript" src="js/jquery-1.5.1.min.js"></script>
<script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type='text/javascript' src="ajax.js"></script>

</head>
<body>

<form action="/php/confirmRegister.php" method="POST" id="access_register">

User name:<br/> <input type="text" name="aUser" maxlength="20" minlength="5" /><br/><br/>

Email address:<br/> <input type="text" name="auEmail" maxlength="60" minlength="15" /><br/>
Repeat email address:<br/> <input type="text" name="rauEmail" maxlength="60" minlength="15" /><br/><br/>


Password:<br/><input type="text" name="auPassword" maxlength="20" minlength="5"/><br/>
Repeat password:<br/><input type="text" name="rauPassword" maxlength="20" minlength="5"/><br/><br/>

<input type="submit" value="Register" id="iButton" name="createUser"/>
<input type="reset" value="Reset" id="iButton" />
<div id="back_register" onclick="loadDoc()">Back</div>

</form>

</body>

</html>
