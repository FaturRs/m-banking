<?php

	$rekening_error=''; //membuat variabel berisikan informasi jika eror
	$saldo_error=''; //membuat variabel berisikan informasi jika eror
	$form_error=''; //membuat variabel berisikan informasi jika eror
	
	
 if (isset($_POST['rekening']) || isset($_POST['saldo']) || isset($_POST['id_customer']) ) {
 	
	require 'validate.php';
	validateRekening($rekening_error, $_POST['rekening']);
	validateMoney($saldo_error, $_POST['saldo']);


	if (validateRekening($rekening_error, $_POST['rekening']) == true &&
	validateMoney($saldo_error, $_POST['saldo']) == true)
	{	
		
		if(checkAddRek($_POST['rekening'], $_POST['saldo'], $_POST['id_customer'] )==true) {
			$form_error = '<span class="sukses">Berhasil Tambah rekening</span>';
			
		}else{
			$form_error = '<span class="eror">No.Rekening telah terpakai</span>';
		}

	}else{
		$form_error = '<span class="eror">Data tidak sesuai</span>';
	}
}

function checkAddRek($rekening, $saldo, $customer){
	include '../dbconnect.php';

	$statement = $dbc->prepare("SELECT * FROM rekening WHERE NO_REKENING = :rekening");
	$statement ->bindValue(':rekening',$rekening);
	$statement->execute();
	$row='';
	foreach ($statement as $row) {
		$row['NO_REKENING'];
	}
	$cek = $row;
	if ($cek > 0) {
		return false;
	}else{
		$statement1 = $dbc->prepare("INSERT INTO rekening(ID_CUSTOMER, NO_REKENING, JUMLAH_SALDO, DEBIT_REKENING, KREDIT_REKENING, TGL_UPDATE_REK) VALUES (:customer, :rekening, :saldo, :debit, :kredit , CURRENT_TIMESTAMP)");
		$statement1->bindValue(':rekening', $rekening);
		$statement1->bindValue(':saldo', $saldo);
		$statement1->bindValue(':customer', $customer);
		$statement1->bindValue(':debit', 0);
		$statement1->bindValue(':kredit', 0);
		$statement1->execute();

		return true;

	}
}
?>
