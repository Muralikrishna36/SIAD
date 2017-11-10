<style>
body {
        background-image: url("bcg.jpg");
} 
 
</style>
<?php
	$postid = $_POST['postid'];
	$mysqli= new mysqli('localhost', 'SIAD_lab', 'secretpass', 'SIAD_lab7');
	if($mysqli->connect_error)
		{
			die('Connection to the database has an error: ' . $mysqli->connect_error);
		}
	$sql = "DELETE FROM comments WHERE postid='$postid';";
	//echo "sql=$sql";
	global $mysqli;
		$result = $mysqli->query($sql);
		if($result==TRUE){
		echo " comments have been deleted<br>";
		}else{
		echo "error deleting comment :". $mysqli->error;    
    		}
	$sql = "DELETE FROM posts WHERE postid='$postid';";
	//echo "sql=$sql";
	global $mysqli;
		$result = $mysqli->query($sql);
		if($result==TRUE){
		echo " post has been deleted<br>";
		}else{
		echo "error deleting post :". $mysqli->error;    
    		}
	
?>
<a href='indexafterlogin.php'> Click here to go back to posts</a>
