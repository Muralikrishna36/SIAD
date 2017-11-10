<?php
	session_start();

	if(isset($_SESSION['views'])){
		$_SESSION['views']=$_SESSION['views'] + 1 ;
	}else{
		$_SESSION['views']=1;
	}
	echo "Hello world PHP!.\n You have visited me ".  $_SESSION['views']."times";
?>
