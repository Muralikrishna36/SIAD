<style>
body {
        background-image: url("bcg.jpg");
} 
 
</style>
<?php
	require "auth.php";
	$secrettoken = $_POST["secrettoken"];
	if(!isset($secrettoken) or ($secrettoken != $_SESSION["nocsrftoken1"])){
	echo "Cross site forging detected!!";
	die();
	}
	
	function editpost($postid,$title,$content,$time,$username){
		$postid = $_POST['postid'];
		$postid = mysql_real_escape_string($postid);
		$title = mysql_real_escape_string($title);
		$content = mysql_real_escape_string($content);
		$time = mysql_real_escape_string($time);
		$username = mysql_real_escape_string(1$username);
		
		$sql = "UPDATE posts SET title='$title',content='$content' Where postid='$postid' ;";
		//echo "postid = " .$postid."<br>";
		//echo "sql=$sql";
		global $mysqli;
		$result = $mysqli->query($sql);
		if($result==TRUE){
		echo "post has been edited<br>";
		}else{
		echo "error editing post :". $mysqli->error;    
    		}
	} 

	$postid = htmlspecialchars($_POST["Postid"]);
	$title = htmlspecialchars($_POST["Post_title"]);
	$content = htmlspecialchars($_POST["Post_content"]);
	$time = htmlspecialchars($_POST["Time"]);
	$username = htmlspecialchars($_POST["Username"]);
	
	if(isset($postid) and isset($title) and isset($content) and isset($time) and isset($username)){
		editpost($postid,$title,$content,$time,$username);
    	}
?>
<a href='indexafterlogin.php'> Click here to go back to posts</a>
