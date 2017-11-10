<html>
<style>
body {
        background-image: url("bcg.jpg");
} 
 
</style>
<h1>Add a new comment</h1>
<?php
//require "auth.php";
echo "current time: " . date("Y-m-d h:i:sa");
$time = date("Y-m-d h:i:sa");
$rand = openssl_random_pseudo_bytes(16);
$commentid = openssl_random_pseudo_bytes(16);
$_SESSION["nocsrftoken2"] = $rand;
$commenter = Anonymous;
$postid = $_POST['postid'];
//echo "postid = " .$postid."<br>";
?>
<form action="addcommentfornonusers.php" method="POST" class="form login">
<input type="hidden" name="secrettoken" value="<?php echo $rand;?>"/><br>
<input type="hidden" name="Commentid" value="<?php echo $commentid;?>"/><br>
Title:<input type="text" name="Comment_title" /> <br>
Content: <input type="text" name="Comment_content" /> <br>
Time:<input type="text" name="Time" value="<?php echo $time;?>"/><br> 
Commenter:<input type="text" name="Commenter" value="<?php echo $commenter ?>"/><br>
Postid:<input type="hidden" name="Postid" value="<?php echo $postid?>"/><br>
<button class ="button" type="Comment">
Create a new comment
</button>
</form>
</html>
