<?php
	include '../dbconnect.php'; //koneksi db

	$statement3 = $dbc->prepare("DELETE FROM transfer WHERE NO_REKENING = :rekening"); //pdo dan query
	$statement3->bindValue(':rekening', $_GET['no_rek'] ); //mengambil data dari url
	$statement3->execute(); //eksekusi program

	$statement = $dbc->prepare("DELETE FROM rekening WHERE NO_REKENING = :rekening"); //pdo dan query
	$statement->bindValue(':rekening', $_GET['no_rek'] ); //mengambil data dari url
	$statement->execute(); //eksekusi program
	
	$Admin = $_GET['Admin']; //mengambil data dari url
	header("Location: http://localhost/PAW2022-1-B05_website/admin/admin.php?Admin=$Admin") //setelah program di atas di eksekusi maka akan diarahkan ke halaman admin
?>