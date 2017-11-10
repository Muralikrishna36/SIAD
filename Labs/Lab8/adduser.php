<?php
	require "auth.php";

	function adduser($username,$password){
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
	echo "debug> Newusername=$username; Newpassword=$password<br>";
	
	if(isset($username) and isset($password)){
		adduser($username,$password);
    	}
?>
