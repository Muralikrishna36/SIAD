<?php

	session_start();
	
	function checklogin($username,$password){
	if(($username=="admin") and ($password=="Abc123")){
		return TRUE;
	}
	return FALSE;
	}
	echo "Index page<br>\n";

	$username=$_REQUEST["username"];
	$password=$_REQUEST["password"];
	
	if(isset($username) and isset($password)){
		if(checklogin($username,$password)){
			echo "Valid username and password !Welcome!<br>";
			$_SESSION["logged"]=TRUE;
		}else{
			header("refresh:1; url=login.php");
			echo "Invalid username or password<br>";
			session_destroy();
		}
    	}

    if(isset($_SESSION["logged"])){
		echo "welcome back! you have logged in<br>";
		echo "<a href='logout.php'>Click here to logout</a>";
	}
	else{
		header("refresh:1;url=login.php");
		echo "You have not logged in<br>";
		session_destroy();
	}
?>
