<?php 
session_start();
		unset($_SESSION['login']);
		session_unset();
		session_destroy();
		$_SESSION = array();
		setcookie('nip','',time()-3600);
		setcookie('id','',time()-3600);
		setcookie('key','',time()-3600);


	header("Location: login.php");
	exit();	

	







 ?>