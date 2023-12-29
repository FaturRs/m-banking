<?php
	session_start(); //memulai session
	if (!isset($_SESSION['IsAdmin'])) { //ketika session kosong
		header("Location: http://localhost/PAW2022-1-B05_website/login.php"); //maka akan diarahkan untuk login
		exit(); //mengakhiri session
	}
?>