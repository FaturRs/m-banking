<?php
 
	$saldo_error='';  //pesan eror
	$form_error=''; 
	
	
 if ( isset($_POST['saldo']) || isset($_POST['no_rek']) ) { //cek apakah data kosong
 	
	require 'validate.php'; //membutuhkan file php eksetrnal
	validateMoney($saldo_error, $_POST['saldo']); //validasi saldo


	if (validateMoney($saldo_error, $_POST['saldo']) == true) //validasi bernilai true 
	{	
		
		if(checkEditRek( $_POST['saldo'], $_POST['no_rek'] )==true) { //validasi bernilai true
			$form_error = '<span class="sukses">Berhasil Tambah saldo</span>'; //pesan eror
			
		}else{
			$form_error = '<span class="eror">No.Rekening telah terpakai</span>'; //pesan eror
		}

	}else{
		$form_error = '<span class="eror">Data tidak sesuai</span>'; //pesan eror
	}
}

function checkEditRek($saldo, $norek){ //fungsi edit rekening
	include '../dbconnect.php'; //koneksi ke dattabase

	$statement1 = $dbc->prepare("UPDATE rekening SET JUMLAH_SALDO  = JUMLAH_SALDO + :jumlahtf, DEBIT_REKENING = DEBIT_REKENING + :jumlahtf WHERE NO_REKENING = :norek"); //pdo dan query
	$statement1->bindValue(':jumlahtf', $saldo); //mengambil data dari parameter
	$statement1->bindValue(':norek', $norek);
	$statement1->execute(); //eksekusi program

	return true; //mengambalikan true

	}
?>
