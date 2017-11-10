<?php
	require "auth.php";
	$secrettoken = $_POST["secrettoken"];
	//echo "debug>\$secrettoken = $secrettoken <br>\$_SESSION["nocsrftoken"]= ". $_SESSION["nocsrftoken"];
	if(!isset($secrettoken) or ($secrettoken != $_SESSION["nocsrftoken"])){
	echo "Cross site forging detected!!";
	die();
	}
	function adduser($username,$password){
		$username=mysql_real_escape_string($username);
		$password=mysql_real_escape_string($password);
		$sql = "INSERT INTO users VALUES('$username',password('$password'));";
		echo "sql=$sql";
		global $mysqli;
		$result = $mysqli->query($sql);
		if($result==TRUE){
		echo "new user '$username' has been added";
		}else{
		echo "error adding user '$username':". $mysqli->error;    
    		}
	}

	$username=$_REQUEST["newusername"];
	$password=$_REQUEST["newpassword"];
	//echo "debug> Newusername=$username; Newpassword=$password<br>";
	
	if(isset($username) and isset($password)){
		adduser($username,$password);
    	}
?>
