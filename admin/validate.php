<?php
function validateName(&$username_error,$field_name) 
{	//validasi nama
	$huruf = "/^[a-zA-Z' ']+$/"; //regex
	$spasi = "/^[' ']+$/";
	if (!isset($field_name) ||empty($field_name)){ //ketika isian kosong
		$username_error= '<span class="eror">Nama tidak boleh kosong</span>'; //pesan eror
	}else if (!preg_match($huruf,$field_name) || preg_match($spasi,$field_name)){ //tidak sesuai dengan regex
		$username_error = '<span class="eror">Nama harus huruf alfabet</span>';
	}else{
		$username_error = '<span class="sukses">Format Nama Benar</span>'; //kondisi benar
		return true; //dikembalikan nilai true
	}
}

function validateUsername(&$username_error,$field_name)
{  //validasi username
	$username = "/^[0-9]+$/"; //regex
	$huruf = "/^[a-zA-Z]+$/";
	$finalusername = "/^[0-9a-zA-Z]+$/";
	if (!isset($field_name)||empty($field_name)){ //ketika isian kosong 
		$username_error= '<span class="eror">Username tidak boleh kosong</span>'; //pesan eror
	}else if (preg_match($username,$field_name)){ //ketika isian cuma angka
		$username_error = '<span class="eror">username harus disi minimal 1 huruf</span>';
	}else if (preg_match($huruf,$field_name)){ //ketika isian cuma huruf
		$username_error = '<span class="eror">username harus disi minimal 1 angka</span>';
	}else if (!preg_match($finalusername,$field_name)){  //tidak sesuai regex
		$username_error = '<span class="eror">username harus kombinasi angka dan huruf</span>';
	}else{
		$username_error = '<span class="sukses">Format Username Benar</span>'; //kondisi benar
		return true; //dikembalikan nilai true
	}
}

function validatePass(&$pass_error,$field_name)
{	//validasi password
	$pass = "/^[0-9]+$/"; //regex
	$huruf = "/^[a-zA-Z]+$/";
	$finalpass = "/^[0-9a-zA-Z]+$/";
	if (!isset($field_name)||empty($field_name)){ //ketika isian kosong
		$pass_error= '<span class="eror">Password tidak boleh kosong</span>';
	}else if (preg_match($pass,$field_name)){ //isian cuma angka
		$pass_error = '<span class="eror">Password harus disi minimal 1 huruf</span>';
	}else if (preg_match($huruf,$field_name)){ //isian cuma huruf
		$pass_error = '<span class="eror">Password harus disi minimal 1 angka</span>';
	}else if (!preg_match($finalpass,$field_name)){ //tidak sesuai regex
		$pass_error = '<span class="eror">Password harus kombinasi angka dan huruf</span>';
	}else if (strlen($field_name) < 5){ //panjang karakter isian kurang dari 5
		$pass_error = '<span class="eror">Password minimal 5 karakter</span>';
	}else if (strlen($field_name) > 12){ //panjang karakter isian lebih dari 12
		$pass_error = '<span class="eror">Password maksimal 12 karakter</span>';
	}else{
		$pass_error = '<span class="sukses">Format Password Benar</span>'; //kondisi benar
		return true; //dokembalikan true
	}
}

function validatePhone(&$phone_error,$field_name)
{	//validasi no.telpon
	$nomer = "/^[0-9]+$/"; //regex
	if (!isset($field_name)||empty($field_name)){ //ketika isian kosong
		$phone_error= '<span class="eror">No. Telp tidak boleh kosong</span>'; //pesan eror
	}else if (!preg_match($nomer,$field_name)){ //ketika isian tidak numerik
		$phone_error = '<span class="eror">No. Telp harus disi numerik</span>';
	}else if (strlen($field_name) != 12){ //ketika panjang digit tidak 12 digit
		$phone_error = '<span class="eror">No. Telp harus 12 digit</span>';
	}else{
		$phone_error = '<span class="sukses">Format Nomor Telepon Benar</span>'; //kondisi benar
		return true; //dikembalikan true
	}
}

function validateAddress(&$alamat_error,$field_name)
{	//validasi alamat
	$huruf = "/^[a-zA-Z0-9' '.]+$/"; //regex
	$spasi = "/^[' ']+$/";
	if (!isset($field_name) ||empty($field_name)){ //ketika isian kosong
		$alamat_error= '<span class="eror">Alamat tidak boleh kosong</span>'; //pesan eror
	}else if (!preg_match($huruf,$field_name) || preg_match($spasi,$field_name)){ //ketika isian tidak hruf atau angka atau kombinasinya
		$alamat_error = '<span class="eror">Alamat harus huruf alfanumerik</span>';
	}else{
		$alamat_error = '<span class="sukses">Format Alamat Benar</span>'; //kondisi benar
		return true; //dikembalikan nilai true
	}
}

function validateMoney(&$money_error,$field_name)
{	//validasi saldo/uang
	$nomer = "/^[0-9]+$/"; //regex
	if (!isset($field_name)||empty($field_name)){ //ketika isian kosong
		$money_error= '<span class="eror">Jumlah Transfer tidak boleh kosong</span>'; //pesan eror
	}else if (!preg_match($nomer,$field_name)){ //ketika isian tidak angka
		$money_error = '<span class="eror">Jumlah Transfer harus disi angka</span>';
	}else{
		$money_error = '<span class="sukses">Format Sudah Benar</span>'; //kondisi benar
		return true; //dikembalikan nilai true
	}
}

function validateRekening(&$rekening_error,$field_name)
{	//validasi rekening
	$nomer = "/^[0-9]+$/"; //regex
	if (!isset($field_name)||empty($field_name)){ //ketika isian kosong
		$rekening_error= '<span class="eror">Rekening tidak boleh kosong</span>'; //pesan eror
	}else if (!preg_match($nomer,$field_name)){ //ketika isian tidak angka
		$rekening_error = '<span class="eror">Rekening harus disi numerik</span>';
	}else if (strlen($field_name) != 4){ //ketika rekening tidak 4 digit
		$rekening_error = '<span class="eror">Rekening harus 4 digit</span>';
	}else{
		$rekening_error = '<span class="sukses">Format Rekening Benar</span>'; //kondisi benar
		return true; //dikembalikan true
	}
}

?>