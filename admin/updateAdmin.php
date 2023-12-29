<?php

$name_error=''; //pesan error
$phone_error=''; 
$alamat_error=''; 
$username_error=''; 
$password_error=''; 
$form_error=''; 

if (isset($_GET['id_customer']) ) { //ketika variabel tidak null
	include '../dbconnect.php'; //koneksi ke database

	$statement1 = $dbc->prepare("SELECT * FROM customer WHERE ID_CUSTOMER = :customer_id "); //pdo dan query untuk melihat daya customer
	$statement1->bindValue(':customer_id', $_GET['id_customer']); //mengambil data dari url
	$statement1->execute(); //eksekusi program
	$nama= '';  //membuat variabel
	$phone = '';
	$alamat = '';
	$username ='';

	foreach ($statement1 as $data){ //memasukkan ke dalam array
		$nama = $data['NAMA_CUSTOMER'];
		$phone  = $data['NO_TELP_CUST'];
		$alamat = $data['ALAMAT_CUSTOMER'];
		$username = $data['USERNAME_CUST'];
	};
}
	
 if (isset($_POST['nama']) || isset($_POST['phone']) || isset($_POST['alamat']) || isset($_POST['username']) || isset($_POST['password']) || isset($_POST['Admin']) || isset($_POST['id_customer'])) { //ketika variabel tidak null
 	
	require 'validate.php'; //membutuhkan file validasi eksternal
	validateName($name_error, $_POST['nama']); //validasi nama
	validatePhone($phone_error, $_POST['phone']); //validasi telpon
	validateAddress($alamat_error, $_POST['alamat']); //validasi alamat
	validateUsername($username_error, $_POST['username']); //validasi username
	validatePass($password_error, $_POST['password']); //validasi password


	if (validateName($name_error, $_POST['nama']) == true && validatePhone($phone_error, $_POST['phone']) == true && validateAddress($alamat_error, $_POST['alamat']) == true && validateUsername($username_error, $_POST['username']) == true && validatePass($password_error, $_POST['password'])== true)
	{	//jika validasi bernilai true
		
		if(checkRegister($_POST['nama'], $_POST['phone'], $_POST['alamat'] , $_POST['username'], $_POST['password'], $_POST['Admin'], $_POST['id_customer']) == true) {//fungsi register
			$form_error = '<span class="sukses">Berhasil Update Akun</span>'; //pesan eror
			
		}

	}else{
		$form_error = '<span class="eror">Data tidak sesuai</span>'; //pesan eror
	}
}


	function checkRegister($nama, $phone, $alamat,  $username, $password, $admin, $customer){ //fungsi update customer
		include '../dbconnect.php'; //koneksi ke database

		$statement = $dbc->prepare("UPDATE customer SET NAMA_CUSTOMER = :nama , ALAMAT_CUSTOMER = :alamat, NO_TELP_CUST = :telpon, USERNAME_CUST = :username, PASSWORD_CUST = SHA2(:password,0) WHERE ID_CUSTOMER = :customer"); // pdo dan query untuk update customer
		$statement->bindValue(':nama', $nama); //mengambil data dari parameter
		$statement->bindValue(':alamat', $alamat);
		$statement->bindValue(':telpon', $phone);
		$statement->bindValue(':username', $username);
		$statement->bindValue(':password', $password);
		$statement->bindValue(':customer', $customer);

		$statement->execute(); //eksekusi program

		return true; //kembalikan true
	}


?>