<html>

<head>

<title>LogIn</title>

<link rel="stylesheet" type="text/css" href="indexLogIn.css" />
<script type="text/javascript" src="js/jquery-1.5.1.min.js"></script>
<script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type='text/javascript' src="ajax.js"></script>

</head>
<body>

<form action="/php/confirmLogIn.php" method="POST" id="access_login">

User name or email address:<br/> <input type="text" name="aUser" maxlength="60" minlength="5" /><br/><br/>

Password:<br/><input type="text" name="aPassword" maxlength="20" minlength="8" /><br/><br/>

<input type="submit" value="LogIn" id="iButton" name="bLogIn" />
<input type="reset" value="Reset"  id="iButton"/>
<div id="back_login" onclick="loadDoc()">Back</div>

</form>

</body>

</html>