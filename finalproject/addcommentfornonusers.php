<style>
body {
        background-image: url("bcg.jpg");
} 
 
</style>
<?php
	//require "auth.php";
	$mysqli= new mysqli('localhost', 'SIAD_lab', 'secretpass', 'SIAD_lab7');
	if($mysqli->connect_error){
		die('Connection to the database has an error: ' . $mysqli->connect_error);
	}
	/*$secrettoken = $_POST["secrettoken"];
	//echo "debug>\$secrettoken = $secrettoken <br>\$_SESSION["nocsrftoken"]= ". $_SESSION["nocsrftoken"];
	if(!isset($secrettoken) or ($secrettoken != $_SESSION["nocsrftoken2"])){
	echo "Cross site forging detected!!";
	die();
	}*/
	function addcomment($commentid,$title,$content,$time,$commenter,$postid){

		$commentid=mysql_real_escape_string($commentid);
		$title=mysql_real_escape_string($title);
		$content=mysql_real_escape_string($content);
		$time=mysql_real_escape_string($time);
		$commenter=mysql_real_escape_string($commenter);
		$postid=mysql_real_escape_string($postid);

		$sql = "INSERT INTO comments VALUES('$commentid','$title','$content','$time','$commenter','$postid');";
		//echo "sql=$sql";
		global $mysqli;
		$result = $mysqli->query($sql);
		if($result==TRUE){
		echo "new comment has been posted<br>";
		}else{
		echo "error adding comment :". $mysqli->error;    
    		}
	}

	$commentid = htmlspecialchars($_POST["Commentid"]);
	$title = htmlspecialchars($_POST["Comment_title"]);
	$content = htmlspecialchars($_POST["Comment_content"]);
	$time = htmlspecialchars($_POST["Time"]);
	$commenter = htmlspecialchars($_POST["Commenter"]);
	$postid = htmlspecialchars($_POST['Postid']);
	//echo "debug> username=$username;<br>";
	
	if(isset($commentid) and isset($title) and isset($content) and isset($time) and isset($commenter) and isset($postid)){
		addcomment($commentid,$title,$content,$time,$commenter,$postid);
    	}
?>
<a href='index1.php'> Click here to go back to posts</a>
