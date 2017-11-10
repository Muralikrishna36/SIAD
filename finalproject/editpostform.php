<html>
<style>
body {
        background-image: url("bcg.jpg");
} 
 
</style>
<h1>Edit post</h1>
<?php
require "auth.php";
echo "current time: " . date("Y-m-d h:i:sa");
$postid = $_POST['postid'];
$sql = "SELECT *from posts where postid='$postid';";
$posts = $mysqli->query($sql);
	echo "<br>Posts:<br><br>";
	while($row=$posts->fetch_assoc()){
	$postid =$row['postid'];
	echo  htmlentities($row['username']) . "<br>".htmlentities($row['time']). "<br>Title= ". htmlentities($row['title']). "<br>Content= " . htmlentities($row['content'])."<br>";
}
$time = date("Y-m-d h:i:sa");
$rand1 = openssl_random_pseudo_bytes(16);
$_SESSION["nocsrftoken1"] = $rand1;

$username=$_SESSION["username"]
?>
<form action="editpost.php" method="POST" class="form login">
<input type="hidden" name="postid" value= "<?php echo $postid;?>"/>
<input type="hidden" name="secrettoken" value="<?php echo $rand1;?>"/><br>
Title:<input type="text" name="Post_title" /> <br>
Content: <input type="text" name="Post_content" /> <br> 
<button class ="button" type="Post">
Create a new post
</button>
</form>
</html>
