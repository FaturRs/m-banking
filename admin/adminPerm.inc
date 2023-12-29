<?php
	session_start(); //memulai session
	if (!isset($_SESSION['IsAdmin'])) { //kondisi ketika session kosong
		header("Location: http://localhost/PAW2022-1-B05_website/login.php"); //akan diarahkan ke login
		exit(); //mengakhiri session
	}
?>