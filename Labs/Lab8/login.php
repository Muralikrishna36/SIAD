<h1>Login</h1>
<?php

echo "current time: " . date("Y-m-d h:i:sa");
?>
<form action="index1.php" method="POST" class="form login">
Username:<input type="text"  name="username" /> <br><!--/*required pattern="\w+"-->
Password: <input type="password"   name="password" /> <br><!--required pattern="(?=.*[A-Z]).{6,}"-->
<button class ="button" type="submit">
Login
</button>
</form>
</html>

