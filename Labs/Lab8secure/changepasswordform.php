<html>
<h1>Change the password</h1>
<?php
require "auth.php";
echo "current time: " . date("Y-m-d h:i:sa");
?>
<form action="changepassword.php" method="POST" class="form login">
Change password for <?php echo $_SESSION["username"]; ?> <br>
New Password: <input type="password" name="newpassword" /> <br>
Confirm New Password: <input type="password" name="newpassword2" /> <br><!..todo: check the password patterns and characters are same or not.!>
<button class ="button" type="submit">
Change password
</button>
</form>
</html>
