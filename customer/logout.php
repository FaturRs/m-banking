<?php 
	session_start(); //memulai session
	session_destroy(); //menghapus session
	header("location:../index.php"); //akan diarahkan ke index
?>