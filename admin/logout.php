<?php 
	session_start();
	session_destroy();//menghapus session
	header("location:../index.php");//dan kembali ke halaman login
?>