<html>
<style>
body {
        background-image: url("bcg.jpg");
} 
 
</style>
<h1>Edit comment</h1>
<?php
require "auth.php";
echo "current time: " . date("Y-m-d h:i:sa");
$time = date("Y-m-d h:i:sa");
$rand2 = openssl_random_pseudo_bytes(16);
$_SESSION["nocsrftoken2"] = $rand2;
$commentid = $_POST['commentid'];
//echo "commentid = " .$commentid."<br>";
$username=$_SESSION["username"];
?>
<form action="editcomment.php" method="POST" class="form login">
<input type="hidden" name="commentid" value= "<?php echo $commentid ;?>"/>
<input type="hidden" name="secrettoken" value="<?php echo $rand2 ;?>"/><br>
Title:<input type="text" name="Comment_title" /> <br>
Content: <input type="text" name="Comment_content" /> <br> 
<button class ="button" type="Post">
Edit comment
</button>
</form>
</html>


