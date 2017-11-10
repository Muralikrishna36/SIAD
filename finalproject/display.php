<?php
	
	//$lifetime= 1200;
	//session_set_cookie_params($lifetime);
	//header("refresh:1200;url=logout.php");
	//session_start();
	$mysqli= new mysqli('localhost', 'SIAD_lab', 'secretpass', 'SIAD_lab7');
	if($mysqli->connect_error)
		{
			die('Connection to the database has an error: ' . $mysqli->connect_error);
		}
	$sql = "SELECT *from users;";
	$result = $mysqli->query($sql);
		if($result->num_rows>0){
			while($row=$result->fetch_assoc()){
				echo "username=" . htmlentities($row['username']). ",password=" . htmlentities($row['password'])."<br>";
			}
			return TRUE;
		}else{
        echo "No posts";
    }
	
?>
