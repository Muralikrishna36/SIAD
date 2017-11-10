<?php
	require "authentication.php";
	
	function adduser($username,$password){
		$sql="INSERT INTO users VALUES('$username',password($password));";
		echo"sql=$sql";
		global $mysqli;
		$result=$musqli->query($sql);
		if($result==TRUE){
			echo "New username/password is added";
		}else 
		{
			echo "Failed to add user.Error: ". $mysqli->error;
		}
	}
	$username=$_REQUEST["newusername"];
	$password=$_REQUEST["newpassword"];
	echo "debug> NewUsername=$username; Newpassword=$password<br>";
	if(isset($username) and isset($password)){
		adduser($username,$password);
	}
?>



