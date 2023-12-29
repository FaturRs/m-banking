<?php
 require 'adminPerm.inc'; //membutuhkan session
?>
<?php 
	include '../dbconnect.php'; //koneksi db
	$statement = $dbc->prepare("SELECT * FROM customer WHERE ID_CUSTOMER = :customer"); //pdo dan query
	$statement->bindValue(':customer', $_GET['customer_id']); //mengambil data dari url
	$statement->execute(); //eksekusi program
 
	foreach ($statement as $data) //memasukkan data array
?>
<!DOCTYPE html><!--menginformasikan bahwa versi dokumen HTML adalah HTML5-->
<html lang="en"><!--Tag pembuka HTML dan memberi tahu browser bahwa semua konten di halaman tresebut adalah bahasa Inggris-->
<head><!--Tag pembuka Head-->
	<meta charset="utf-8"><!-- memberi informasi terhadap browser dan search engine untukmelakukan pengkodean karakter sesuai ketentuan UTF-8-->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>REKENING</title><!--Deklarasi Judul Halaman Web-->
	<link rel="stylesheet" type="text/css" href="../style/stylecust.css"><!-- elemen <link> untuk menghubungkan file html dengan file css eksternal -->
</head><!--Tag penutup Head-->
<body><!--Tag pembuka Body-->
	<div class="menu"><!--Tag pembuka Class menu-->
		<img src="../img/logo_kecil.png" class="logoatas" alt="logokecilBRI"><!--menampilkan gambar logo kecil BRI diatas-->
		<div class="mobile">MOBILE BANKING BRI <small class="cust">customer(<?php echo "{$data['NAMA_CUSTOMER']}"; //menampilkan data dari array ?>)</small></div>
	</div>
	<div class="sidebar"><!--Tag pembuka Sidebar-->
		<div class="dasboard"><a href="dasboard.php?customer_id=<?php echo $_GET['customer_id'] //menampilkan data dari array ?>">Dasboard</a>
		</div>
		<div class="profil"><a href="profil.php?customer_id=<?php echo $_GET['customer_id'] //menampilkan data dari array ?>">Profil</a>
		</div>
		<div class="rekening"><a href="rekening.php?customer_id=<?php echo $_GET['customer_id'] //menampilkan data dari array ?>">Rekening</a>
		</div>
	</div><!--Tag penutup sidebar-->
	<div class="isi"><!--Tag pembuka Isi-->
		<div class="isirekening">
			<div class="isirekening2">
				<table>
				<tr><td colspan="6" class="rekeningcust">REKENING CUSTOMER</td></tr>
				<?php
				include '../dbconnect.php';
					$statement2 = $dbc->prepare("SELECT customer.* , rekening.* FROM customer JOIN rekening ON customer.ID_CUSTOMER = rekening.ID_CUSTOMER WHERE customer.ID_CUSTOMER = :customer"); //pdo dan query
					$statement2->bindValue(':customer', $_GET['customer_id']); //mengambil data dari url
					$statement2->execute(); //eksekusi program
					echo "<tr>"; //menampilkan data ke html
					echo "<th>No.</th>";
					echo "<th>No.Rekening</th>";
					echo "<th>Saldo</th>";
					echo "<th colspan = '3'>Riwayat & Transfer</th>";
					echo "</tr>";
					$count = 1; //membuat count
					foreach ($statement2 as $row) { //memasukkan data ke array
					echo "<tr>";
					echo "<td>$count</td>";
					echo "<td>{$row['NO_REKENING']}</td>";
					echo "<td>{$row['JUMLAH_SALDO']}</td>"; ?>
					<td><a class="riw" href="riwayat.php?no_rek=<?php echo $row['NO_REKENING'] ?>&id_customer=<?php echo $row['ID_CUSTOMER'] ?>">Riwayat</a></td>
					<td><a class="transak1" href="transaksi.php?no_rek=<?php echo $row['NO_REKENING'] ?>&id_customer=<?php echo $row['ID_CUSTOMER'] ?>">Transfer Ke Rekening lain</a></td>
					<td><a class="transak2" href="transaksi2.php?no_rek=<?php echo $row['NO_REKENING'] ?>&id_customer=<?php echo $row['ID_CUSTOMER'] ?>">Transfer Ke Rekening Sendiri</a></td>
					</tr>

				<?php 
					$count += 1; //count akan bertambah
				}
				echo '</table>';

					$statement3 = $dbc->prepare("SELECT customer.* , rekening.* FROM customer JOIN rekening ON customer.ID_CUSTOMER = rekening.ID_CUSTOMER WHERE customer.ID_CUSTOMER = :customer"); //pdo dan query
					$statement3->bindValue(':customer', $_GET['customer_id']); //mengambil data dari url
					
					$statement3->execute(); //eksekusi program
					echo "<br>"; //menampilkan ke html 	
					echo "<table>";
					echo "<tr class='rekeningcust'><td colspan='5'>DEBIT & KREDIT REKENING</td></tr>";
					echo "<tr>";
					echo "<th>No.</th>";
					echo "<th>No.Rekening</th>";
					echo "<th>Debit</th>";
					echo "<th>Kredit</th>";
					echo "<th>Tanggal</th>";
					echo "</tr>";
					$count = 1; //membuat count
					foreach ($statement3 as $row) { //memasukkan data ke array
						echo "<tr>";
						echo "<td>$count</td>";
						echo "<td>{$row['NO_REKENING']}</td>";
						echo "<td>{$row['DEBIT_REKENING']}</td>";
						echo "<td>{$row['KREDIT_REKENING']}</td>"; 
						echo "<td>{$row['TGL_UPDATE_REK']}</td>"; 
						
						$count += 1; //count akan bertambah
					}
						echo '</tr>';
						echo '</table>';
				?>
			</div>
		</div>
	</div>
	<div class="footer"><!--tag pembuka class footer-->
		<div><p>Copyright © 2022, PAW2022-1-B05</p></div><!--Penampil nama kelompok-->
		<p>All Rights Reserved.</p>
	</div>

</body><!--Penutup tag body-->
</html><!--penutup tag html-->