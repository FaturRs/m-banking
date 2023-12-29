<?php 
	$username_error='';  //pesan eror
	$pass_error=''; 
	$form_error=''; 
	if (isset($_POST['Login']) || isset($_POST['username']) || isset($_POST['password'])) { //ketika variabel ada
		require './customer/validate.php'; //koneksi db
		validateUsername($username_error, $_POST['username']); //validasi username
		validatePass($pass_error, $_POST['password']); //validasi password

		if (validateUsername($username_error, $_POST['username']) == true && validatePass($pass_error,$_POST['password']) == true )
		{	//validasi username dan password bernilai true
			checkCustomer($_POST['username'], $_POST['password']); //cek customer
			checkAdmin($_POST['username'], $_POST['password']); //cek admin
			if(checkCustomer($_POST['username'], $_POST['password']) == true && checkAdmin($_POST['username'], $_POST['password'])) { //cek ketik fungsi bernilai true
				$form_error = '<span class="eror">User Tidak Terdaftar</span>'; //pesan eror
			}

		}else{
			$form_error = '<span class="eror">Data tidak sesuai</span>'; //pesan eror
		}
	}

	function checkCustomer($username,$password){ //cekcustomer
		include 'dbconnect.php'; //koneksi db

		$statement = $dbc->prepare("SELECT * FROM customer WHERE USERNAME_CUST = :username AND PASSWORD_CUST = SHA2(:password,0)"); //pdo dan query
		$statement->bindValue(':username', $username); //mengambil data dari parameter
		$statement->bindValue(':password', $password);
		$statement->execute(); //eksekusi program
		$row=''; //variabel ksoong
		foreach ($statement as $row) { //memasukkan kedalam array
			echo "<h1>{$row['username']}</h1>"; //menampilkan array ke html
			echo "<p>{$row['password']}</p>";
		}
		$cek = $row; //memasukkan data array ke variabel kosong
		if ($cek > 0) { //ketika data lebih dari 0
			session_start(); //memulai session
			$_SESSION['IsAdmin'] = true ; //session bernilai true
			header("Location: http://localhost/PAW2022-1-B05_website/customer/dasboard.php?customer_id=$row[ID_CUSTOMER]"); //akan diarahkan ke halaman customer
			exit(); //mengakhiri session
		}else{
			return true; //jika tidak sesuai dikembalikan true
		}

	}

	function checkAdmin($username,$password){ //fungsi cek admin
		include 'dbconnect.php'; //koneksi ke db

		$statement = $dbc->prepare("SELECT * FROM admin WHERE USERNAME_ADMIN = :username AND PASS_ADMIN = SHA2(:password,0)"); //pdo dan query
		$statement->bindValue(':username', $username); //mengambil data dari parameter
		$statement->bindValue(':password', $password); 
		$statement->execute(); //mengeksuki program
		$row=''; //varibel kosong
		foreach ($statement as $row) { //memasukkan ke dalam array
			echo "<h1>{$row['username']}</h1>"; //menampilkan data dari array
			echo "<p>{$row['password']}</p>";
		}
		$cek = $row; //memasukkan array ke variabel kosong
		if ($cek > 0) { //ketika data di cek lebih dari 1
			session_start(); //memulai session
			$_SESSION['IsAdmin'] = true ; //session bernilai true
			header("Location: http://localhost/PAW2022-1-B05_website/admin/admin.php?Admin=$row[NAMA_ADMIN]"); //akan diarahkan ke halaman admin
			exit(); //mengakhiri session
		}else{
			return true; //jika tidak sesuai dikembalikan true
		}
	}

?>

<!DOCTYPE html><!--menginformasikan bahwa versi dokumen HTML adalah HTML5-->
<html lang="en"><!--Tag pembuka HTML dan memberi tahu browser bahwa semua konten di halaman tresebut adalah bahasa Inggris-->
<head><!--Tag pembuka Head-->
	<meta charset="utf-8"><!-- memberi informasi terhadap browser dan search engine untukmelakukan pengkodean karakter sesuai ketentuan UTF-8-->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>LOGIN</title><!--Deklarasi Judul Halaman Web-->
	<link rel="stylesheet" type="text/css" href="style/style.css"><!-- elemen <link> untuk menghubungkan file html dengan file css eksternal -->
</head><!--Tag penutup Head-->
<body><!--Tag pembuka Body-->
	<div class="content">
		<form action="login.php" method="post">
			<h3>LOGIN</h3>
			<small class="form-error"><?php echo $form_error; //pesan eror ?></small><br>
			<label>Username:</label>
			<div class="inputan">
				<input type="text" name="username" value="<?php if(isset($_POST['username'])) echo htmlspecialchars($_POST['username']) //mengambil data dan menyimpan data ke dalam isian form ?>">
			</div>
			<small class="error-message"><?php echo $username_error; //pesan eror ?></small><br>
			<label>Password:</label>
			<div class="inputan">
				<input type="password" name="password" value="<?php if(isset($_POST['password'])) echo htmlspecialchars($_POST['password']) //mengambil data dan menyimpan data ke dalam isian form ?>">
			</div>
			<small class="error-message"><?php echo $pass_error; //pesan eror ?></small>
			<div class="inputsbm">
				<input type="submit" name="submit" value="Login">
			</div>
		</form>
	</div>

</body><!--Penutup tag body-->
</html><!--penutup tag html-->