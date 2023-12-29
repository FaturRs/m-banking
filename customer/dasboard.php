<?php
 require 'adminPerm.inc'; //memulai session
?>
<?php 
	include '../dbconnect.php'; //koneksi db
	$statement = $dbc->prepare("SELECT * FROM customer WHERE ID_CUSTOMER = :customer"); //mengambil data dari db
	$statement->bindValue(':customer', $_GET['customer_id']); //mengambil data dari url
	$statement->execute(); //eksekusi program

	foreach ($statement as $data) //memasukkan data ke array
?>
<!DOCTYPE html><!--menginformasikan bahwa versi dokumen HTML adalah HTML5-->
<html lang="en"><!--Tag pembuka HTML dan memberi tahu browser bahwa semua konten di halaman tresebut adalah bahasa Inggris-->
<head><!--Tag pembuka Head-->
	<meta charset="utf-8"><!-- memberi informasi terhadap browser dan search engine untukmelakukan pengkodean karakter sesuai ketentuan UTF-8-->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>DASBOARD</title><!--Deklarasi Judul Halaman Web-->
	<link rel="stylesheet" type="text/css" href="../style/stylecust.css"><!-- elemen <link> untuk menghubungkan file html dengan file css eksternal -->
</head><!--Tag penutup Head-->
<body><!--Tag pembuka Body-->
	<div class="menu"><!--Tag pembuka Class menu-->
		<img src="../img/logo_kecil.png" class="logoatas" alt="logokecilBRI"><!--menampilkan gambar logo kecil BRI diatas-->
		<div class="mobile">MOBILE BANKING BRI <small class="cust">customer(<?php echo "{$data['NAMA_CUSTOMER']}"; //cetak data dari array ?>)</small></div>
	</div>
	<div class="sidebar"><!--Tag pembuka Sidebar-->
		<div class="dasboard"><a href="dasboard.php?customer_id=<?php echo $_GET['customer_id'] //cetak data dari array?>">Dasboard</a>
		</div>
		<div class="profil"><a href="profil.php?customer_id=<?php echo $_GET['customer_id'] //cetak data dari array ?>">Profil</a>
		</div>
		<div class="rekening"><a href="rekening.php?customer_id=<?php echo $_GET['customer_id'] //cetak data dari array?>">Rekening</a>
		</div>
	</div><!--Tag penutup sidebar-->
	<div class="isi"><!--Tag pembuka Isi-->
		<p class="selamat">Selamat Datang Di Mobile Banking BRI <?php echo "{$data['NAMA_CUSTOMER']}"; //cetak data dari array ?></p>
		<p class="selamat2">Mobile Banking BRI merupakan Aplikasi Keuangan Digital berbasis data internet yang memberikan kemudahan bagi nasabah untuk melakukan transfer ke pengguna BRI lainnya.</p>
	</div>
	<div class="footer"><!--tag pembuka class footer-->
		<div><p>Copyright © 2022, PAW2022-1-B05</p></div><!--Penampil nama kelompok-->
		<p>All Rights Reserved.</p>
	</div>

</body><!--Penutup tag body-->
</html><!--penutup tag html-->
