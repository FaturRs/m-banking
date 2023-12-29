<?php
	$jumlahtf_error=''; //pesan eror
	$rekpenerima_error=''; 

	$form_error=''; 
	
	
 if (isset($_POST['jumlahtf']) || isset($_POST['rekpenerima']) || isset($_POST['norek']) || isset($_POST['id_customer'])) { //cek variabel kosong
 	
	require 'validate.php'; //membutuhkan validasi
	validateMoney($jumlahtf_error, $_POST['jumlahtf']); //validasi jumlah tf
	validateRekening($rekpenerima_error, $_POST['rekpenerima']); //validasi rekening


	if (validateMoney($jumlahtf_error, $_POST['jumlahtf']) == true && validateRekening($rekpenerima_error, $_POST['rekpenerima']) == true )
	{	//validasi bernilai true
		include '../dbconnect.php'; //koneksi db
		$row1=''; //variabel kosong
		$statements = $dbc->prepare("SELECT * FROM rekening WHERE NO_REKENING = :rekpenerima"); //query dan pdo
		$statements->bindValue(':rekpenerima', $_POST['rekpenerima']); //mengambil data dari from
		$statements->execute(); //eksekusi program
		foreach ($statements as $row1){ //memasukkan ke dalam array
			 $row1['NO_REKENING'];
		};

		$statement = $dbc->prepare("SELECT * FROM rekening WHERE NO_REKENING = :norek"); //pdo dan query
		$statement->bindValue(':norek', $_POST['norek']); //mengambil data dari form
		$statement->execute(); //eksekusi program
		foreach ($statement as $row){ //memasukkan ke dalam array
			$saldo = $row['JUMLAH_SALDO'];
		};

		$cek = $row1; //memasukkan variabel row1 ke dalam cek

		if ($cek < 1) { //jika data di variabel cek kurang dari 1
			$form_error = "<span class='masalahform'>Rekening Penerima Tidak terdaftar</span>";; //pesan eror
		}else if ($_POST['rekpenerima'] == $_POST['norek']) { //cek norek dengan penerima
			$form_error = "<span class='masalahform'>Rekening Penerima tidak boleh sama dengan pengirim</span>"; 
		}else if ($_POST['jumlahtf'] <= $saldo) { //cek saldo mencukupi 
			$statement1 = $dbc->prepare("UPDATE rekening SET JUMLAH_SALDO  = JUMLAH_SALDO - :jumlahtf, KREDIT_REKENING = KREDIT_REKENING + :jumlahtf,TGL_UPDATE_REK=CURRENT_TIMESTAMP WHERE NO_REKENING = :norek"); //pdo dan query
			$statement1->bindValue(':jumlahtf', $_POST['jumlahtf']); //mengambil data dari form
			$statement1->bindValue(':norek', $_POST['norek']);
			$statement1->execute();

			$statement2 = $dbc->prepare("UPDATE rekening SET JUMLAH_SALDO  = JUMLAH_SALDO + :jumlahtf, DEBIT_REKENING = DEBIT_REKENING + :jumlahtf,TGL_UPDATE_REK=CURRENT_TIMESTAMP WHERE NO_REKENING = :rekpenerima"); //pdo dan query
			$statement2->bindValue(':jumlahtf', $_POST['jumlahtf']);
			$statement2->bindValue(':rekpenerima', $_POST['rekpenerima']);
			$statement2->execute();

			$statement3 = $dbc->prepare("INSERT INTO transfer(ID_CUSTOMER, NO_REKENING, JUMLAH_TRANSAKSI, TGL_TRANSAKSI, NO_REKENING_PENERIMA) VALUES (:id_customer, :norek, :jumlahtf, CURRENT_TIMESTAMP, :rekpenerima) ");
			$statement3->bindValue(':jumlahtf', $_POST['jumlahtf']); //pdo dan query
			$statement3->bindValue(':id_customer', $_POST['id_customer']);
			$statement3->bindValue(':norek', $_POST['norek']);
			$statement3->bindValue(':rekpenerima', $_POST['rekpenerima']);
			$statement3->execute();
			$form_error = "<span class='lolos'>Transfer Berhasil</span>"; //kondisi berhasil
		} else {
			$form_error = "<span class='masalahform'>Saldo Tidak Mencukupi</span>"; //pesan kesalahan
		}

	}else{
		$form_error = '<span class="masalahform">Transfer Gagal !</span>'; //pesan kesalahan
	}
}


?>