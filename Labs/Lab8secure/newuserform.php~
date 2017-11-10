<html>
<h1>Add a new user</h1>
<?php
require "auth.php";
echo "current time: " . date("Y-m-d h:i:sa");
$rand = openssl_random_pseudo_bytes(16);
echo "\$rand = $rand";
$_SESSION["nocsrftoken"] = $rand;
?>
<form action="adduser.php" method="POST" class="form login">
<input type="hidden" name="secrettoken" value="<?php echo $rand;?>"/><br>
Username:<input type="text" name="newusername" /> <br>
Password: <input type="password" name="newpassword" /> <br>
Confirm Password: <input type="password" name="newpassword2" /> <br><!..todo: check the password patterns and characters are same or not.!>
<button class ="button" type="submit">
Create a new user
</button>
</form>
</html>
