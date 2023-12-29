<?php
 require 'adminPerm.inc'; //membutuhkan session
?>
<?php 
	include '../dbconnect.php'; //koneksi ke db
	$statement = $dbc->prepare("SELECT * FROM customer WHERE ID_CUSTOMER = :customer"); //pdo dan query
	$statement->bindValue(':customer', $_GET['id_customer']); //mengambil data ke url
	$statement->execute(); //eksekusi program

	foreach ($statement as $data) //memasukkan ke dalam array
?>
<!DOCTYPE html><!--menginformasikan bahwa versi dokumen HTML adalah HTML5-->
<html lang="en"><!--Tag pembuka HTML dan memberi tahu browser bahwa semua konten di halaman tresebut adalah bahasa Inggris-->
<head><!--Tag pembuka Head-->
	<meta charset="utf-8"><!-- memberi informasi terhadap browser dan search engine untukmelakukan pengkodean karakter sesuai ketentuan UTF-8-->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>RIWAYAT TRANSAKSI</title><!--Deklarasi Judul Halaman Web-->
	<link rel="stylesheet" type="text/css" href="../style/stylecust.css"><!-- elemen <link> untuk menghubungkan file html dengan file css eksternal -->
</head><!--Tag penutup Head-->
<body><!--Tag pembuka Body-->
	<div class="menu"><!--Tag pembuka Class menu-->
		<img src="../img/logo_kecil.png" class="logoatas" alt="logokecilBRI"><!--menampilkan gambar logo kecil BRI diatas-->
		<div class="mobile">MOBILE BANKING BRI <small class="cust">customer(<?php echo "{$data['NAMA_CUSTOMER']}"; //menampilkan data array ke html  ?>)</small></div>
	</div>
	<div class="sidebar"><!--Tag pembuka Sidebar-->
		<div class="dasboard"><a href="dasboard.php?customer_id=<?php echo $_GET['id_customer'] //menampilkan data array ke html ?>">Dasboard</a>
		</div>
		<div class="profil"><a href="profil.php?customer_id=<?php echo $_GET['id_customer'] //menampilkan data array ke html ?>">Profil</a>
		</div>
		<div class="rekening"><a href="rekening.php?customer_id=<?php echo $_GET['id_customer'] //menampilkan data array ke html ?>">Rekening</a>
		</div>
	</div><!--Tag penutup sidebar-->
	<div class="isi"><!--Tag pembuka Isi-->
		<div class="isiriwayat">
			<h1>Riwayat Transaksi</h1>
			<div class="isiriwayat2">
				<?php
				include '../dbconnect.php'; //koneksi db

				$statement = $dbc->prepare("SELECT * FROM transfer WHERE NO_REKENING = :no_rek"); //pdo dan query
				$statement->bindValue(':no_rek', $_GET['no_rek']); //mengambil data dari url
				$statement->execute(); //eksekusi program

				echo "<table>";
				echo "<tr>";
				echo "<th>No.</th>";
				echo "<th>Jumlah Transaksi</th>";
				echo "<th>Tanggal Transaksi</th>";
				echo "<th>No. Rekening Penerima</th>";
				echo "</tr>";
				$count = 1; //membuat count
				foreach ($statement as $row) { //memasukkan data ke array
					echo "<tr>";
					echo "<td>{$count}</td>"; //menampilakn data array ke html 	
					echo "<td>{$row['JUMLAH_TRANSAKSI']}</td>";	
					echo "<td>{$row['TGL_TRANSAKSI']}</td>";	
					echo "<td>{$row['NO_REKENING_PENERIMA']}</td>";	
					echo "</tr>";
					$count += 1; //menambah count
				}
				echo "</table>";
				?>
			</div>
			<a class="buttonback" href="rekening.php?customer_id=<?php echo $_GET['id_customer']; //mengirim  link besarta data ke url?>">Kembali Ke Rekening</a>
		</div>
	</div>
	<div class="footer"><!--tag pembuka class footer-->
		<div><p>Copyright © 2022, PAW2022-1-B05</p></div><!--Penampil nama kelompok-->
		<p>All Rights Reserved.</p>
	</div>
</body><!--Penutup tag body-->
</html><!--penutup tag html-->