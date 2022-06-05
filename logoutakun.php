<?php 
session_start();
		unset($_SESSION['akun']);
		
	header("Location: kelolaakun.php");
	exit();	


 ?>