<?php
 require 'adminPerm.inc';//membuat session
?>
<!DOCTYPE html><!--menginformasikan bahwa versi dokumen HTML adalah HTML5-->
<html lang="en"><!--Tag pembuka HTML dan memberi tahu browser bahwa semua konten di halaman tresebut adalah bahasa Inggris-->
<head><!--Tag pembuka Head-->
	<meta charset="utf-8"><!-- memberi informasi terhadap browser dan search engine untukmelakukan pengkodean karakter sesuai ketentuan UTF-8-->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Data Customer</title><!--Deklarasi Judul Halaman Web-->
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
		} //mengambil data ke dalam value ?>">Data Customer</a>
		</div>
		<div class="profil"><a href="register.php?Admin=<?php echo $_GET['Admin'] ?>">Register Customer</a>
		</div>
	</div><!--Tag penutup sidebar-->
	<div class="isi"><!--Tag pembuka Isi-->
		<div class="isiriwayat"><!--pembuka tag isiriwayat-->
			<h1>Data Customer & Rekening Customer</h1><!--H1 Data Customer dan Rekening-->
			<div class="isiriwayat2"><!--pembuka class isiriwayat2-->
				<?php include 'admin.inc' ?><!--Include file admin.inc-->
			</div>
			<a class="logoutin" href="logout.php">LOGOUT</a><!--tombol logout-->
		</div><!--penutup class isiriwayat-->
	</div>
	<div class="footer"><!--tag pembuka class footer-->
		<div><p>Copyright © 2022, PAW2022-1-B05</p></div><!--Penampil nama kelompok-->
		<p>All Rights Reserved.</p>
	</div>

</body><!--Penutup tag body-->
</html><!--penutup tag html-->