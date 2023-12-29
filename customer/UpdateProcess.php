<?php 

$name_error=''; //pesan eror
$phone_error=''; 
$alamat_error=''; 
$form_error=''; 

if (isset($_GET['id_customer']) ) { //mengambil data dari url
	include '../dbconnect.php'; //koneksi db

	$statement1 = $dbc->prepare("SELECT * FROM customer WHERE ID_CUSTOMER = :customer_id "); //pdo dan query
	$statement1->bindValue(':customer_id', $_GET['id_customer']); //mengambil data dari url
	$statement1->execute(); //eksekusi program
	$nama= ''; //variabel kosong
	$phone = '';
	$alamat = '';

	foreach ($statement1 as $data){ //memasukkan data ke dalam array
		$nama = $data['NAMA_CUSTOMER']; //data di array di masukkan ke dalam variabel array
		$phone  = $data['NO_TELP_CUST'];
		$alamat = $data['ALAMAT_CUSTOMER'];
	};
}

	
if (isset($_POST['nama']) || isset($_POST['phone']) || isset($_POST['alamat']) || isset($_POST['id_customer'])) { //variabel ketika ada

	
 	
	require 'validate.php'; //membutuhkan validasi eksternal
	validateName($name_error, $_POST['nama']); //validasi nama
	validatePhone($phone_error, $_POST['phone']); //validasi telpon
	validateAddress($alamat_error, $_POST['alamat']); //validasi alamat


	if (validateName($name_error, $_POST['nama']) == true && validatePhone($phone_error, $_POST['phone']) == true && validateAddress($alamat_error, $_POST['alamat']) == true ) //ketika validasi bernilai true
	{	
		checkProfile($_POST['nama'], $_POST['phone'], $_POST['alamat'] , $_POST['id_customer']); //menjalankan fungsi cekprofil
		if(checkProfile($_POST['nama'], $_POST['phone'], $_POST['alamat'] , $_POST['id_customer'] ) == true) {
			$form_error = '<span class="sukses">Berhasil Update profil</span>'; //pesan eror
		}

	}else{
		$form_error = '<span class="eror">Data tidak sesuai</span>'; //pesan eror
	}
}


	function checkProfile($nama, $phone, $alamat,  $customer){ //fungsi cek profil
		include '../dbconnect.php'; //koneksi db

		$statement = $dbc->prepare("UPDATE customer SET NAMA_CUSTOMER = :nama, ALAMAT_CUSTOMER = :alamat, NO_TELP_CUST = :telpon  WHERE ID_CUSTOMER = :customer_id"); //pdo dan query
		$statement->bindValue(':nama', $nama); //mengambil data dari parameter
		$statement->bindValue(':alamat', $alamat);
		$statement->bindValue(':telpon', $phone);
		$statement->bindValue(':customer_id', $customer);

		$statement->execute();  //eksekusi program

		return true; //dikembalikan nilai true
	}


?>