<html>
<style>
body {
        background-image: url("bcg.jpg");
} 
 
</style>
<h1>Add a new user</h1>
<?php
//require "auth.php";
echo "current time: " . date("Y-m-d h:i:sa");
$rand = openssl_random_pseudo_bytes(16);
$_SESSION["nocsrftoken"] = $rand;
?>
<form action="adduser.php" method="POST" class="form login">
<input type="hidden" name="secrettoken" value="<?php echo $rand;?>"/><br>
Username:<input type="text" name="newusername" required pattern="\w+"/> <br>
Password: <input type="password" name="newpassword" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"/> <br>
Confirm Password: <input type="password" name="newpassword2" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"/> <br><!..todo: check the password patterns and characters are same or not.!>
<button class ="button" type="submit">
Create a new user
</button>
</form>
</html>
