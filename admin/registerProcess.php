<?php

	$name_error=''; //pesan eror
	$phone_error=''; 
	$alamat_error=''; 
	$username_error=''; 
	$password_error=''; 
	$form_error=''; 
	
	
 if (isset($_POST['nama']) || isset($_POST['phone']) || isset($_POST['alamat']) || isset($_POST['username']) || isset($_POST['password']) || isset($_POST['Admin'])) { //cek variabel kosong 
 	
	require 'validate.php'; //membutuhkan file php eksternal
	validateName($name_error, $_POST['nama']); //validasi nama
	validatePhone($phone_error, $_POST['phone']); //validasi telpon
	validateAddress($alamat_error, $_POST['alamat']); //validasi alamat
	validateUsername($username_error, $_POST['username']); //validasi username
	validatePass($password_error, $_POST['password']); //validasi passsword


	if (validateName($name_error, $_POST['nama']) == true && validatePhone($phone_error, $_POST['phone']) == true && validateAddress($alamat_error, $_POST['alamat']) == true && validateUsername($username_error, $_POST['username']) == true && validatePass($password_error, $_POST['password'])== true) //semua validasi bernilai true
	{	
		
		if(checkRegister($_POST['nama'], $_POST['phone'], $_POST['alamat'] , $_POST['username'], $_POST['password'], $_POST['Admin'])==true) {
			$form_error = '<span class="sukses">Berhasil Register Akun'; //pesan eror
			
		}else{
			$form_error = '<span class="eror">Username telah terpakai'; //pesan eror
		}

	}else{
		$form_error = '<span class="eror">Data tidak sesuai'; //pesan eror
	}
}


	function checkRegister($nama, $phone, $alamat,  $username, $password, $admin){
		include '../dbconnect.php'; //fungsi register akun

		$statement1 = $dbc->prepare("SELECT * FROM customer WHERE USERNAME_CUST = :username");
		$statement1->bindValue(':username', $username);
		$statement1->execute();
		$row='';
		foreach ($statement1 as $row) {
			$row['USERNAME_CUST'];
		}
		$cek = $row;
		if ($cek > 0) {
			return false;
		}else{
			$statement = $dbc->prepare("INSERT INTO customer(NAMA_ADMIN, NAMA_CUSTOMER, ALAMAT_CUSTOMER, NO_TELP_CUST, USERNAME_CUST, PASSWORD_CUST) VALUES (:admin, :nama, :alamat, :telpon, :username, SHA2(:password,0))"); //pdo dan query
			$statement->bindValue(':nama', $nama); //mengambil data dari parameter
			$statement->bindValue(':alamat', $alamat);
			$statement->bindValue(':telpon', $phone);
			$statement->bindValue(':admin', $admin);
			$statement->bindValue(':username', $username);
			$statement->bindValue(':password', $password);

			$statement->execute(); //eksekusi program

			return true; //mengembalikan nilai true

		}

		
	}


?>