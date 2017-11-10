<?php
	require "auth.php";

	function changepassword($username,$password){
		$sql = "UPDATE users SET password=password('$password') WHERE username ='$username';";
		echo "sql=$sql";
		global $mysqli;
		$result = $mysqli->query($sql);
		if($result==TRUE){
		echo "Password has been updated";
		}else{
		echo "error changing password:". $mysqli->error;    
    }
}

	$username=$_SESSION["username"];
	$password=$_REQUEST["newpassword"];
	echo "debug>username=$username; password=$password<br>";
	
	if(isset($username) and isset($password)){
		changepassword($username,$password);
    	}
?>
