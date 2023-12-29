<?php
	include '../dbconnect.php'; //koneksi ke db

	$statement3 = $dbc->prepare("DELETE FROM transfer WHERE ID_CUSTOMER = :customer"); //pdo dan query
	$statement3->bindValue(':customer', $_GET['id_customer'] ); //mengambil data dari url
	$statement3->execute(); //eksekusi program

	$statement2 = $dbc->prepare("DELETE FROM rekening WHERE ID_CUSTOMER = :customer"); //pdo dan query
	$statement2->bindValue(':customer', $_GET['id_customer'] ); //mengambil data dari url
	$statement2->execute(); //eksekusi program
	
	$statement1 = $dbc->prepare("DELETE FROM customer WHERE ID_CUSTOMER = :customer"); //pdo dan query
	$statement1->bindValue(':customer', $_GET['id_customer'] ); //mengambil data dari url
	$statement1->execute(); //eksekusi program

	$Admin = $_GET['Admin']; //mengambil data dari url
	header("Location: http://localhost/PAW2022-1-B05_website/admin/admin.php?Admin=$Admin"); //setelah program di atas di eksekusi akan diarahkan ke halaman admin
?>