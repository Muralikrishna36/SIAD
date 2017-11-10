<style>
body {
        background-image: url("bcg.jpg");
} 
 
</style>
<?php
	require "auth.php";
	$secrettoken = $_POST["secrettoken"];
	if(!isset($secrettoken) or ($secrettoken != $_SESSION["nocsrftoken2"])){
	echo "Cross site forging detected!!";
	die();
	}
	function editcomment($commentid,$title,$content,$time,$username,$postid){
		$commentid = $_POST['commentid'];
		//echo "commentid = " .$commentid."<br>";
		$commentid = mysql_real_escape_string($commentid);
		$title = mysql_real_escape_string($title);
		$content = mysql_real_escape_string($content);
		$time = mysql_real_escape_string($time);
		$commenter = mysql_real_escape_string($commenter);
		$postid = mysql_real_escape_string($postid);

		$sql = "UPDATE comments SET title='$title',content='$content' Where commentid='$commentid' ;";
		//echo "sql=$sql";
		global $mysqli;
		$result = $mysqli->query($sql);
		if($result==TRUE){
		echo "comment has been edited<br>";
		}else{
		echo "error editing comment :". $mysqli->error;    
    		}
	} 

	$commentid = htmlspecialchars($_POST["Commentid"]);
	$title = htmlspecialchars($_POST["Comment_title"]);
	$content = htmlspecialchars($_POST["Comment_content"]);
	$time = htmlspecialchars($_POST["Time"]);
	$commenter = htmlspecialchars($_POST["Commenter"]);
	$postid = htmlspecialchars($_POST["Postid"]);
	//$commentid = $_POST['commentid'];
	//echo "commentid = " .$commentid."<br>";
	if(isset($commentid) and isset($title) and isset($content) and isset($time) and isset($commenter) and isset($postid)){
		editcomment($commentid,$title,$content,$time,$username,$postid);
    	}
?>
<a href='indexafterlogin.php'> Click here to go back to posts</a>
