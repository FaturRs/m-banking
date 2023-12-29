<?php
 require 'adminPerm.inc'; //membutuhkan session
?>
<?php 

	if(isset($_POST['id_customer'])) {  //kondisi ketika post ada
		include '../dbconnect.php'; //koneksi ke db
		$statement = $dbc->prepare("SELECT * FROM customer WHERE ID_CUSTOMER = :customer"); //pdo dan query
		$statement->bindValue(':customer', $_POST['id_customer']); //mengambil data 
		$statement->execute(); //eksekusi program
 
		foreach ($statement as $data){} //memasukkan kedalam array
	}
	if(isset($_GET['id_customer'])) { //konsidi ketika get ada
		include '../dbconnect.php';
		$statement = $dbc->prepare("SELECT * FROM customer WHERE ID_CUSTOMER = :customer");
		$statement->bindValue(':customer', $_GET['id_customer']);
		$statement->execute();

		foreach ($statement as $data){}
	}
	
?>
<!DOCTYPE html><!--menginformasikan bahwa versi dokumen HTML adalah HTML5-->
<html lang="en"><!--Tag pembuka HTML dan memberi tahu browser bahwa semua konten di halaman tresebut adalah bahasa Inggris-->
<head><!--Tag pembuka Head-->
	<meta charset="utf-8"><!-- memberi informasi terhadap browser dan search engine untukmelakukan pengkodean karakter sesuai ketentuan UTF-8-->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>TRANSFER KE REKENING SENDIRI</title><!--Deklarasi Judul Halaman Web-->
	<link rel="stylesheet" type="text/css" href="../style/stylecust.css"><!-- elemen <link> untuk menghubungkan file html dengan file css eksternal -->
</head><!--Tag penutup Head-->
<body><!--Tag pembuka Body-->
	<div class="menu"><!--Tag pembuka Class menu-->
		<img src="../img/logo_kecil.png" class="logoatas" alt="logokecilBRI"><!--menampilkan gambar logo kecil BRI diatas-->
		<div class="mobile">MOBILE BANKING BRI <small class="cust">customer(<?php echo "{$data['NAMA_CUSTOMER']}"; ?>)</small></div>
	</div>
	<div class="sidebar"><!--Tag pembuka Sidebar-->
		<div class="dasboard"><a href="dasboard.php?customer_id=<?php if(isset($_POST['id_customer'])) { 
						echo ($_POST['id_customer']);
					} if(isset($_GET['id_customer'])) { 
						$id_customer = $_GET['id_customer'];
						echo ($id_customer);
					} //menampilkan dan mengambil data ke url ?>">Dasboard</a>
		</div>
		<div class="profil"><a href="profil.php?customer_id=<?php if(isset($_POST['id_customer'])) { 
						echo ($_POST['id_customer']);
					} if(isset($_GET['id_customer'])) { 
						$id_customer = $_GET['id_customer'];
						echo ($id_customer);
					} //menampilkan dan mengambil data ke url ?>">Profil</a>
		</div>
		<div class="rekening"><a href="rekening.php?customer_id=<?php if(isset($_POST['id_customer'])) { 
						echo ($_POST['id_customer']);
					} if(isset($_GET['id_customer'])) { 
						$id_customer = $_GET['id_customer'];
						echo ($id_customer);
					} //menampilkan dan mengambil data ke url ?>">Rekening</a>
		</div>
	</div><!--Tag penutup sidebar-->
	<div class="isi"><!--Tag pembuka Isi-->
		<div class="ditransak1">
			<h1 class="translain">Transfer Ke Rekening Sendiri</h1>
			<?php include 'tfProses.php' ?>
			<span><?php echo $form_error; ?></span>
			<form action="transaksi2.php" method="post">
				<label>Jumlah Transfer</label>
			<div class="inputantran">
				<input type="text" name="jumlahtf" value="<?php if(isset($_POST['jumlahtf'])) { 
						$Tf = $_POST['jumlahtf'];
						echo htmlspecialchars($Tf);
					} //mengambil data dan menyimpan data ke form?>">
			</div>
				<span class="error-message"><?php echo $jumlahtf_error; //pesan eror ?></span><br>
				<label>Pilih Rekening:</label>
			<div class="inputantran">
				<select name = "rekpenerima">
					<option value="">...</option>
					<?php 
					include '../dbconnect.php'; //koneksi db

					if (isset($_GET['id_customer'])) {
						$statement = $dbc->prepare("SELECT * FROM rekening WHERE ID_CUSTOMER = :customer"); //pdo dan query
						$statement->bindValue(':customer', $_GET['id_customer'] ); //mengambil data dari url
						$statement->execute(); //eksekusi program

						foreach ($statement as $data){ //memasukkan ke dalam array
						?>
							<option value="<?php echo $data['NO_REKENING'] ?>"><?php echo $data['NO_REKENING'] //cetak kedalam dropdown html ?></option>
						<?php 
							};
					}
					else if (isset($_POST['id_customer'])) {
						$statement2 = $dbc->prepare("SELECT * FROM rekening WHERE ID_CUSTOMER = :customer"); //pdo dan query
						$statement2->bindValue(':customer', $_POST['id_customer'] ); //mengambil data dari form
						$statement2->execute(); //eksekusi program

						foreach ($statement2 as $data){ //memasukkan ke dalam array
						?>
							<option value="<?php echo $data['NO_REKENING'] ?>"><?php echo $data['NO_REKENING'] ?></option>
						<?php 
							};
		
						}
					?>
				</select>
			</div>
				<span class="error-message"><?php echo $rekpenerima_error; ?></span>
			<div>
				<input type="hidden" name="norek" value= 
					"<?php if(isset($_GET['no_rek'])) { 
						$no_rek = $_GET['no_rek'];
						echo htmlspecialchars($no_rek);
					} if(isset($_POST['norek'])) { 
						$norek = $_POST['norek'];
						echo htmlspecialchars($norek);
					} //mengambil data dari from atau url ?>">
			</div>	
			<div>
				<input type="hidden" name="id_customer" value= 
					"<?php if(isset($_GET['id_customer'])) { 
						$customer = $_GET['id_customer'];
						echo htmlspecialchars($customer);
					} if(isset($_POST['id_customer'])) { 
						$customer = $_POST['id_customer'];
						echo htmlspecialchars($customer);
					} //mengambil data dari from atau url ?>">
			</div>
			<div>
				<a class="kembali1" href="rekening.php?customer_id=<?php if(isset($_POST['id_customer'])) { 
						echo ($_POST['id_customer']);
					} if(isset($_GET['id_customer'])) { 
						$id_customer = $_GET['id_customer'];
						echo ($id_customer);
					} //mengambil data dari from atau url ?>">Kembali Ke Rekening</a>
				<input type="submit" name="submit" value="Transfer" class="updatewarna">
				
			</div>
		</form>
		</div>
	</div>
	<div class="footer"><!--tag pembuka class footer-->
		<div><p>Copyright © 2022, PAW2022-1-B05</p></div><!--Penampil nama kelompok-->
		<p>All Rights Reserved.</p>
	</div>
</body><!--Penutup tag body-->
</html><!--penutup tag html-->