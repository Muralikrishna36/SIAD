<style>
body {
        background-image: url("bcg.jpg");
} 
 
</style>
<?php
session_start();
session_destroy();
echo "you hav been logged out<br>";
echo "<a href='login.php'>Click here to login</a>";
?>
