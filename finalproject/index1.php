<html>
<body>
<h1>Flyers Blog</h1> 
<style>
body {
        background-image: url("bcg.jpg");
} 
 
</style>
<div align = "right">
<br><img src="flyer.jpg" alt="Flyer blog img" align="left" width="1080" height="300"><br>
<form action="newuserform.php" method="POST" class="form login">
<button class ="button" type="submit">
Sign up!
</button>
</form>
<form action="login.php" method="POST" class="form login">
<button class ="button" type="submit">
Log-in
</button>
</form>
</div>
<p style="clear: both;">
<?php
	$mysqli= new mysqli('localhost', 'SIAD_lab', 'secretpass', 'SIAD_lab7');
	if($mysqli->connect_error)
		{
			die('Connection to the database has an error: ' . $mysqli->connect_error);
		}
	$sql = "SELECT *from posts;";
	$posts = $mysqli->query($sql);
	if($posts->num_rows>0){
			echo '<br><span style="color: Black; font-size: 20px;">Posts:<br><br>';;
			while($row=$posts->fetch_assoc()){
				$postid =$row['postid'];
				echo '<span style="color: Black; font-size: 20px;">' .htmlentities($row['username']) . "<br>".htmlentities($row['time']). "<br>Title= ". htmlentities($row['title']). "<br>Content= " . htmlentities($row['content'])."<br>";
				echo '<form action="viewcommentsfornonusers.php" method="POST" class="form login"><input type="hidden" name="postid" value="'.$postid.'" >' . '
				<button class ="button" type="Post">
				View comments..
				</button>
				</form>';
				/*echo '<form action="editpostform.php" method="POST" class="form login">
				<button class ="button" type="Post">
				Edit post..
				</button>
				</form>';
				echo '<form action="deletepost.php" method="POST" class="form login">
				<button class ="button" type="Post">
				Delete post..
				</button>
				</form>';
				$sql1 = "SELECT * FROM comments WHERE postid='$postid';";
				$comments = $mysqli->query($sql1);
				if($comments->num_rows>0){
				while($row1 = $comments->fetch_assoc()){
					echo "Comments:<br>";
					echo  $row['postid'] .htmlentities($row1['commenter']) . "<br>".htmlentities($row['time']). "<br>Title= ". htmlentities($row1['title']). "<br>Content=" . htmlentities($row1['content'])."<br>";
	
				}
				return TRUE;
				}else{
					echo "Comments:<br>";
        				echo "No comments yet<br><br>";
    				}*/		
			}
			return TRUE;
			}else{
        			echo "No posts yet";
    			}
?>
</p>
</body>
</html>
