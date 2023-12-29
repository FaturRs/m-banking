<?php
 require 'adminPerm.inc';//file eksternal berisi session
?>
<!DOCTYPE html><!--menginformasikan bahwa versi dokumen HTML adalah HTML5-->
<html lang="en"><!--Tag pembuka HTML dan memberi tahu browser bahwa semua konten di halaman tresebut adalah bahasa Inggris-->
<head><!--Tag pembuka Head-->
	<meta charset="utf-8"><!-- memberi informasi terhadap browser dan search engine untukmelakukan pengkodean karakter sesuai ketentuan UTF-8-->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Register Customer</title><!--Deklarasi Judul Halaman Web-->
	<link rel="stylesheet" type="text/css" href="../style/stylecust.css"><!-- elemen <link> untuk menghubungkan file html dengan file css eksternal -->
</head><!--Tag penutup Head-->
<body><!--Tag pembuka Body-->
	<div class="menu"><!--Tag pembuka Class menu-->
		<img src="../img/logo_kecil.png" class="logoatas" alt="logokecilBRI"><!--menampilkan gambar logo kecil BRI diatas-->
		<div class="mobile">MOBILE BANKING BRI</div><!--Tag judul di menu-->
	</div>
	<div class="sidebar"><!--Tag pembuka Sidebar-->
		<div class="dasboard"><a href="admin.php?Admin=<?php if (isset($_POST['Admin'])) {
			echo $_POST['Admin'];
		} if (isset($_GET['Admin'])) {
			echo $_GET['Admin'];
		} // mengambil data Admin untuk dimasukkan dan dikirim melalui url ?>">Data Customer</a>
		</div>
		<div class="profil"><a href="register.php?Admin=<?php if (isset($_POST['Admin'])) {
			echo $_POST['Admin'];
		} if (isset($_GET['Admin'])) {
			echo $_GET['Admin'];
		} // mengambil data Admin untuk dimasukkan dan dikirim melalui url ?>">Register Customer</a>
		</div>
	</div><!--Tag penutup sidebar-->
	<div class="isi"><!--Tag pembuka Isi-->
		<div class="isiriwayatreg"><!--Tag pembuka Isiriwayatreg-->
			<?php include 'registerProcess.php' //menyisipkan untuk validasi form ?>
			<h1 class="h1profil">REGISTER AKUN CUSTOMER</h1><!--menampilkan H1 Data Customer dan Rekening-->
			<span class="error-message-form1"><?php echo $form_error; ?></span><br><!-- menampilkan eror form-->
			<form action="register.php" method="POST"><!--Tag pembuka Form-->
				<label class="labelreg">Nama</label><!--Tag Label Nama-->
				<div class="inputan">
					<input type="text" name="nama" value="<?php if(isset($_POST['nama'])) { 
						$nama = $_POST['nama'];
						echo htmlspecialchars($nama);
					} //mengambil data dan menyimpan data ke dalam value inputan ?>" >
				</div>	
					<span class="error-message"><?php echo $name_error; ?></span><br><!--Penampil eror isian nama-->
					<label class="labelreg">No.Telp:</label><!--Label  Untuk Telepon-->
				<div class="inputan">
					<input type="text" name="phone" value="<?php if(isset($_POST['phone'])) { //inputan nomor telepon
						echo htmlspecialchars($_POST['phone']);
					} //mengambil data dan menyimpan data ke dalam value inputan ?>">
				</div>
					<span class="error-message">
					<?php echo $phone_error;  ?><!--Penampil eror isian telepon-->
					</span><br>
					<label class="labelreg">Alamat:</label><!--Label alamat-->
				<div class="inputan">
					<input type="text" name="alamat"  value="<?php if(isset($_POST['alamat'])) {//inputan alamat 
						echo htmlspecialchars($_POST['alamat']);
					} //mengambil data dan menyimpan data ke dalam value inputan ?>">
				</div>
					<span class="error-message">
					<?php echo $alamat_error; ?><!--Penampil eror isian alamat-->
					</span><br>
					<label class="labelreg">Username:</label><!--Label username-->
				<div class="inputan">
					<input type="text" name="username"  value="<?php if(isset($_POST['username'])) { //inputan username
						echo htmlspecialchars($_POST['username']);
					} //mengambil data dan menyimpan data ke dalam value inputan ?>">
				</div>
					<span class="error-message">
					<?php echo $username_error; ?><!--Penampil eror isian username-->
					</span><br>
					<label class="labelreg">Password:</label><!--label password-->
				<div class="inputan">
					<input type="password" name="password"  value="<?php if(isset($_POST['password'])) { //inputan password 
						echo htmlspecialchars($_POST['password']);
					} //mengambil data dan menyimpan data ke dalam value inputan ?>">
				</div>
					<span class="error-message">
					<?php echo $password_error; //penampil error password ?>
					</span><br>
				<div class="inputan">
					<input type="hidden" name="Admin"  value="<?php if(isset($_POST['Admin'])) { //inputan username admin tapi hidden
						echo htmlspecialchars($_POST['Admin']);
					} if(isset($_GET['Admin'])) { 
						$Admin = $_GET['Admin'];
						echo htmlspecialchars($Admin);
					} //mengambil data dan menyimpan data ke dalam value inputan ?>">
				</div>
				<div class="geser">
					<input type="submit" name="submit" value="Register Akun" class="riw"><!--tombol Register Akun-->
					<input type="reset" name="reset" value="Reset" class="resetupdate"><!--tombol reset-->
				</div>
			</form>
		</div>
	</div><!--Penutup isi-->
	<div class="footer"><!--tag pembuka class footer-->
		<div><p>Copyright © 2022, PAW2022-1-B05</p></div><!--Penampil nama kelompok-->
		<p>All Rights Reserved.</p>
	</div>

</body><!--Penutup tag body-->
</html><!--penutup tag html-->