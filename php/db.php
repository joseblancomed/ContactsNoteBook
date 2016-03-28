<?php

class dbConnection
{
	//In this point depend of you if you want create the variable as public o private

	//private $connection = mysqli_connect("server_name","user","password","database_name");
	
	public $connection ="";
	
	function __construct()
	{
		$this->connection = mysqli_connect("localhost","root","");
		$cDb=mysqli_query($this->connection, "create database if not exists contactNoteBook");		
		$scDB = mysqli_select_db($this->connection,"contactNoteBook");
		
		$tbl_user = mysqli_query($this->connection,"create table if not exists users(id int auto_increment, nameUser varchar(20), emailUser varchar(60), passwordUser varchar(20), link varchar(20), active bool, primary key(id));") or die ("There is some problem USER TABLE");
		$tbl_people = mysqli_query($this->connection,"create table if not exists contactPeople(id int auto_increment, name varchar(70), address varchar(300), telephone varchar(15),
		other_number varchar(15), primary key(id));") or die ("There is some problem PEOPLE TABLE");
	}
	
	function add_user($nUser, $nEmail, $nREmail, $nPassword, $nRPassword)
	{
		$this->connection = mysqli_connect("localhost","root","","contactNoteBook");
		
		if(($nEmail === $nREmail) &&  ($nPassword === $nRPassword) && ($nEmail!=="" && $nREmail!=="" && $nPassword !=="" && $nRPassword!==""))
		{
			$confirmAT = strpos($nEmail,'@');
			$confirmDOT = strpos($nEmail,'.');
			
			if ($confirmAT && $confirmDOT)
			{
			
				$query_user = mysqli_query($this->connection,"select id from users where nameUser='".$nUser."';");
				$qUser = mysqli_num_rows($query_user);
				
				$query_mail = mysqli_query($this->connection, "select id from users where emailUser='".$nEmail."';");
				$qMail = mysqli_num_rows($query_mail);
							
				if ($qMail===0 && $qUser===0 && $nUser!=="")
				{
					$insert_newUser = mysqli_query($this->connection, "insert into users (nameUser,emailUser,passwordUser,active) values ('".$nUser."','".$nEmail."','".$nPassword."',1);");
					if ($insert_newUser)
					{
						$tbl_people_custom = mysqli_query($this->connection,"create table if not exists contactPeople_".$nUser."(id int auto_increment, name varchar(70), address varchar(70), telephone varchar(15),
						other_number varchar(15), primary key(id));") or die ("<span style='color:red'>WARNING:</span> There is an issue CREATING THE TABLE FOR ".$nUser);
						
						if ($tbl_people_custom == 1)
							return true; 
						else
							return false;
					}
				}
				else if ($qMail===1 && $qUser===0 && $nUser!=="")
					echo "<script language='JavaScript'>alert(\"This mail is using, remember the password or press remember text\");</script>";			
				else if ($qMail===0 && $qUser===1 && $nUser!=="")
					echo "<script language='JavaScript'>alert(\"This user is using, please choose other Nick name\");</script>";			
				else if ($qMail===0 && $qUser===0 && $nUser==="")
					echo "<script language='JavaScript'>alert(\"The user name is mandatory\");</script>";
			}
			else
			{
				echo "<script language='JavaScript'>alert(\"There is some issue with the email, check it please\");</script>";
				return false;
			}
		}
		else
			return false;
		
	}
		
	function addRegister($fullName,$fullAddress,$numTele,$otherNum=0,$sessionUser)
	{
		$this->connection = mysqli_connect("localhost","root","","contactNoteBook");
		echo "<script language='JavaScript'>alert('".$otherNum."');</script>";
		//echo $this->connection;
		if (($fullName=="") && ($numTele=="" || $fullAddress==""))
			echo "<script language='JavaScript'>alert('The field telephone or address are mandatory, almost one of them');</script>";
		else
		{
			$regExists = mysqli_query($this->connection, "select id from contactPeople_".$sessionUser." where name='".$fullName."' and telephone='".$numTele."' and address= '".$fullAddress."';");
			
			if (mysqli_num_rows($regExists) == 0 )
			{
				$reg = mysqli_query($this->connection, "insert into contactPeople_".$sessionUser." (name, address, telephone,other_number) values (\"".$fullName."\",\"".$fullAddress."\",\"".$numTele."\",\"".$otherNum."\");");
				if (!($reg))
					echo "<script language='JavaScript'>alert('Please check the connection\nor check the parameters');</script>";
				readRegisters();
			}
			else
				echo "<script language='JavaScript'>alert('The contact already exists in the database');</script>";
				
		}
		
	}

	function deleteRegister($sessionUser)
	{
		echo "<fieldset id='viewTable'>";
		
		$this->connection = mysqli_connect("localhost","root","","contactNoteBook");
		$eachreg = mysqli_query($this->connection, "select id,name,address,telephone,other_number from contactPeople_".$sessionUser.";");
				
		echo "<form action='#' method='post' id='viewform'>";

		echo "<br/><input type='hidden' name='chCont' id='chCont' readonly />";
		echo "<br/><br/>Choose the contact:<br/><select id='chooseid' onchange=\"document.getElementById('chCont').value = document.getElementById('chooseid').value\">";
		
		if (mysqli_num_rows($eachreg)>0)
		{
			echo "<option value='null'>-- choose one --</option>";
			while ($pos = mysqli_fetch_array($eachreg,MYSQLI_BOTH))
			{
				echo "<option value=".$pos['id'].">".$pos['name']."</option>";
			}
			echo "<option value='all'>-- All contacts -- </option>";
			echo "</select><input type='submit' value='Delete' name='deleteOne'/>";
			//alert(document.getElementById('chooseid').value)\" />";
		}
		else
		{	
			echo "<option>The contactNoteBook is empty</option></select></div>";
		}
		echo "</form>";
		echo "</fieldset>";
	
	}
	
	function deleteContact($id,$sessionUser)
	{
		//echo "<script language='JavaScript'>alert('".$id."');</script>";
		$this->connection = mysqli_connect("localhost","root","","contactNoteBook");
		//echo $this->connection;
		//echo "<script language='JavaScript'>alert('".$id."');</script>";
		
		if ($id!="all")
			$delReg = mysqli_query($this->connection, "delete from contactPeople_".$sessionUser." where id=".$id.";");
		else
			$delReg = mysqli_query($this->connection, "delete from contactPeople_".$sessionUser.";");
		if (!($delReg))
			echo "<script language='JavaScript'>alert('Had an issue deleting the contact');</script>";
		
	}
	
	function printTable($sessionUser)
	{
		//echo "<script language='JavaScript'>alert('".$sessionUser."');</script>";
		$this->connection = mysqli_connect("localhost","root","","contactNoteBook");
		//echo $this->connection;
		$eachRegTab = mysqli_query($this->connection, "select id,name,address,telephone,other_number from contactPeople_".$sessionUser.";");
		
		if (mysqli_num_rows($eachRegTab)>0)
		{
			echo "<table border=0 width='100%'><tr><th>Name</th><th>Address</th><th>Telephone</th><th>Other number</th></tr>";
			while ($regSaved = mysqli_fetch_array($eachRegTab,MYSQLI_BOTH))
				echo "<tr><td>".$regSaved['name']."</td><td>".$regSaved['address']."</td><td>".$regSaved['telephone']."</td><td>".$regSaved['other_number']."</td></tr>";
			echo "</table>";
		}
		else
			echo "<option>The contactBook is empty, PLEASE MAKE FRIENDS</option></select>";
		
		//echo "<br/><br/><input type='button' value='Close table' onClick='closeView();' />";
	}
	
	function updateContact($id, $nName, $nAddress, $nPhone, $nExtraPhone,$sessionUser)
	{	
		
		//echo "<script language='JavaScript'>alert('".$id." ' +  'Name: ".$nName." ' + 'Address: ".$nAddress." ' + 'New Phone: ".$nPhone." ' + ' - ".$nExtraPhone."');</script>";
		$this->connection = mysqli_connect("localhost","root","","contactNoteBook");
		//echo $this->connection;
		//echo "<script language='JavaScript'>alert('".$id."');</script>";
		$updReg = mysqli_query($this->connection, "update contactPeople_".$sessionUser." set name='".$nName."', address='".$nAddress."', telephone='".$nPhone."', other_number='".$nExtraPhone."' where id=".$id.";");
		if (!($updReg))
			echo "<script language='JavaScript'>alert('Had an issue updating the contact');</script>";
	}
	
	function updateRegister($sessionUser)
	{
		echo "<fieldset id='viewTable'>";
		
		$this->connection = mysqli_connect("localhost","root","","contactNoteBook");
		$eachreg = mysqli_query($this->connection, "select id,name,address,telephone,other_number from contactpeople_".$sessionUser.";");
		
		echo "<form action='#' method='post' id='viewform'>";

		echo "<br/><input type='hidden' name='chOne' id='chOne' readonly />";
		echo "<br/><br/>Choose the contact:<br/><select id='chooseCt' onchange=\"document.getElementById('chOne').value = document.getElementById('chooseCt').value\">";
		
		if (mysqli_num_rows($eachreg)>0)
		{
			echo "<option value='null'>-- choose one --</option>";
			while ($pos = mysqli_fetch_array($eachreg,MYSQLI_BOTH))
			{
				echo "<option value=".$pos['id'].">".$pos['name']."</option>";
			}
			
			echo "</select>
			Name:&nbsp; <input type='text' name='nName' maxlength='70' /><br/><br/>

			Address:&nbsp;<input type='text' name='nAddress' maxlength='300' /><br/><br/>

			Telephone:&nbsp;<input type='text' name='nNumber' maxlength='15' /><br/><br/>

			Add mobile:&nbsp;<input type='checkbox' id='pressIt' checked onClick='change()'/><br/><br/>

			<span id='eNum'>Other number:&nbsp;<input type='text' name='nExtraNum' maxlength='15' /></span><br/>
			
			<input type='submit' value='Update' name='updateOne'/>";
			//alert(document.getElementById('chooseid').value)\" />";
		}
		else
			echo "<option>The notebook is empty</option></select>";
		echo "</form></fieldset>";

	}
	
	function extractUser($addressMail)
	{
		
		$this->connection = mysqli_connect("localhost","root","","contactNoteBook");
		$queryUserLogIn = mysqli_query($this->connection,"select nameUser from users where emailUser='".$addressMail."';");
		while($valueName = mysqli_fetch_array($queryUserLogIn,MYSQLI_BOTH))
			return $valueName['nameUser'];
		
	}
	
	/************* USER ***********/
	
	
	function user_logIn($nUser,$nPassword)
	{
		
		$this->connection = mysqli_connect("localhost","root","","contactNoteBook");
		
		$confirmAT = strpos($nUser,'@');
		$confirmDOT = strpos($nUser,'.');
		
		if ($confirmAT == true && $confirmDOT== true)
		{
			$query_user_login = mysqli_query($this->connection,"select id,nameUser from users where emailUser='".$nUser."' and passwordUser='".$nPassword."' and active=1;");
			$qUserLogIn = mysqli_num_rows($query_user_login);
			
			if($qUserLogIn == 0)
				return false;
			else
				return true;
		}
		else
		{
			$query_user_login = mysqli_query($this->connection,"select id from users where nameUser='".$nUser."' and passwordUser='".$nPassword."' and active=1;");
			$qUserLogIn = mysqli_num_rows($query_user_login);
			
			if($qUserLogIn == 0)
				return false;
			else
				return true;
		}
		
	}
	
	function who_session_is()
	{
		echo "<script type=\"text/javascript\" src=\"events.js\"></script><fieldset id='viewUser'>";
		
		echo "<div id='viewUserInfo'>";
		echo "<span style=\"float:left;\">WELCOME: ".$_SESSION['id']."</span><div id=\"bUpdateUser\" onclick=\"loadDoc()\">Modify</div><div id='bCloseSession' onclick=\"close_session();\">Close</div>";
		echo "</div>";
		
		echo "</fieldset>";
	}
	
	function who_session_is_update()
	{
		echo "<script type='text/javascript' src='events.js'></script><fieldset id='viewUser'>";
		
		echo "<div id='viewUserInfoUpdate'>";
		echo "<span style=\"float:left;\">WELCOME: ".$_SESSION['id']."</span><div id=\"bBack\" onclick=\"loadDoc()\">Back</div><div id='bCloseSession' onclick=\"close_session();\">Close</div>";
		echo "</div></fieldset>";
	}
			
	
	function __destruct()
	{
	}
};

?>