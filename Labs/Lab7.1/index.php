<?php

	session_start();
	$mysqli= new mysqli('localhost', 'SIAD_lab', 'secretpass', 'SIAD_lab7');
	if($mysqli->connect_error)
		{
			die('Connection to the database has an error: ' . $mysqli->connect_error);
		}
	
	function checklogin($username,$password){
		$sql = "SELECT * FROM users WHERE username='$username' AND password = password('$password');";
		//echo "sql=$sql";
		global $mysqli;
		$result = $mysqli->query($sql);
		if($result->num_rows==1){
			return TRUE;
		}
        return FALSE;
    }

	$username=$_REQUEST["username"];
	$password=$_REQUEST["password"];
	
	if(isset($username) and isset($password)){
		if(checklogin($username,$password)){
			echo "Valid username and password !Welcome!<br>";
			$_SESSION["logged"]=TRUE;
			$_SESSION["username"]=$username;
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
		header("refresh:10;url=login.php");
	        echo "You have not logged in<br>";
		session_destroy();
	}
?>
