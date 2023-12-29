<?php
 require 'adminPerm.inc'; //memerlukan session
?>
<?php 

	if(isset($_POST['id_customer'])) { //cek variabel kosong
		include '../dbconnect.php'; //koneksi db
		$statement = $dbc->prepare("SELECT * FROM customer WHERE ID_CUSTOMER = :customer"); //pdo dan query
		$statement->bindValue(':customer', $_POST['id_customer']); //mengambil data dari form
		$statement->execute(); //ekseskusi program

		foreach ($statement as $data){} //masukkan k=data kedalam array
	}
	if(isset($_GET['id_customer'])) { //cek variabel kosong
		include '../dbconnect.php'; //koneksi db
		$statement = $dbc->prepare("SELECT * FROM customer WHERE ID_CUSTOMER = :customer"); //pdo dan query
		$statement->bindValue(':customer', $_GET['id_customer']); //mengambil data dari url
		$statement->execute(); //eksekusi program

		foreach ($statement as $data){} 
	}
	
?>
<!DOCTYPE html> <!--menginformasikan bahwa versi dokumen HTML adalah HTML5-->
<html lang="en"> <!--Tag pembuka HTML dan memberi tahu browser bahwa semua konten di halaman tresebut adalah bahasa Inggris-->
<head><!--Tag pembuka Head-->
	<meta charset="utf-8"><!-- memberi informasi terhadap browser dan search engine untukmelakukan pengkodean karakter sesuai ketentuan UTF-8-->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Update Profil</title>
	<link rel="stylesheet" type="text/css" href="../style/stylecust.css"><!-- elemen <link> untuk menghubungkan file html dengan file css eksternal -->
</head><!--Tag penutup Head-->
<body><!--Tag pembuka Body-->
	<div class="menu"><!--Tag pembuka Class menu-->
		<img src="../img/logo_kecil.png" class="logoatas" alt="logokecilBRI"><!--menampilkan gambar logo kecil diatas-->
		<div class="mobile">MOBILE BANKING BRI <small class="cust">customer(<?php echo "{$data['NAMA_CUSTOMER']}"; ?>)</small></div><!--Tag judul di menu-->
	</div>
	<div class="sidebar"><!--Tag pembuka Sidebar-->
		<div class="dasboard"><a href="dasboard.php?customer_id=<?php if(isset($_POST['id_customer'])) { 
						echo ($_POST['id_customer']);
					} if(isset($_GET['id_customer'])) { 
						$id_customer = $_GET['id_customer'];
						echo ($id_customer);
					} //mengambil data untuk dimasukkan ke dalam value ?>">Dasboard</a>
		</div>
		<div class="profil"><a href="profil.php?customer_id=<?php if(isset($_POST['id_customer'])) { 
						echo ($_POST['id_customer']);
					} if(isset($_GET['id_customer'])) { 
						$id_customer = $_GET['id_customer'];
						echo ($id_customer);
					} //mengambil data untuk dimasukkan ke dalam value ?>">Profil</a>
		</div>
		<div class="rekening"><a href="rekening.php?customer_id=<?php if(isset($_POST['id_customer'])) { 
						echo ($_POST['id_customer']);
					} if(isset($_GET['id_customer'])) { 
						$id_customer = $_GET['id_customer'];
						echo ($id_customer);
					} //mengambil data untuk dimasukkan ke dalam value ?>">Rekening</a>
		</div>
	</div>
	<div class="isi"><!--Tag pembuka Isi-->
		<div class="datacudat">
			<form action="customerUpdate.php" method="POST">
			<?php include 'UpdateProcess.php' ?>
			<h1 class="updatec">UPDATE COSTUMER</h1><!--H1 Update Customer-->
				<p class="error-message-form"><?php echo $form_error; ?></p><br><!--Penampil eror isian form-->
				<label>Nama :</label>
				<div class="inputan"><!--Tag pembuka class inputan-->
					<input type="text" name="nama" value="<?php if(isset($_POST['nama'])) { 
						$nama = $_POST['nama'];
						echo htmlspecialchars($nama);
					}else echo $nama; //mengambil data untuk dimasukkan ke dalam value ?>" >
				</div>
				<small class="laporaneror"><?php echo $name_error; ?></small><br>
				<label>No.Telp:</label>
				<div class="inputan">
					<input type="text" name="phone" value="<?php if(isset($_POST['phone'])) { 
						echo htmlspecialchars($_POST['phone']);
					} else echo $phone; //mengambil data untuk dimasukkan ke dalam value ?>">
				</div>
				<small class="laporaneror"><?php echo $phone_error; ?></small><br>
				<label>Alamat:</label>
				<div class="inputan">
					<input type="text" name="alamat"  value="<?php if(isset($_POST['alamat'])) { 
						echo htmlspecialchars($_POST['alamat']);
					} else echo $alamat; //mengambil data untuk dimasukkan ke dalam value ?>">
				</div>
				<small class="laporaneror"><?php echo $alamat_error; ?></small><br>
				<div class="inputan">
					<input type="hidden" name="id_customer"  value="<?php if(isset($_POST['id_customer'])) { 
						echo htmlspecialchars($_POST['id_customer']);
					} if(isset($_GET['id_customer'])) { 
						$id_customer = $_GET['id_customer'];
						echo htmlspecialchars($id_customer);
					} //mengambil data untuk dimasukkan ke dalam value ?>">
				</div>
				<div class="tombol"><a class="kembali" href="profil.php?customer_id=<?php if(isset($_POST['id_customer'])) { 
						echo ($_POST['id_customer']);
					} if(isset($_GET['id_customer'])) { 
						$id_customer = $_GET['id_customer'];
						echo ($id_customer);
					} //mengambil data untuk dimasukkan ke dalam value ?>">Kembali Ke Profil</a>
					<input type="submit" name="submit" value="Update Data" class="updatewarna"><!--tombol update data-->
					<input type="reset" name="reset" value="Reset" class="resetupdate"><!--tombol reset update data-->
				</div>
			</form><!--Penutup Form-->
	</div>
	</div>
	<div class="footer"><!--tag pembuka class footer-->
		<div><p>Copyright © 2022, PAW2022-1-B05</p></div><!--Penampil nama kelompok-->
		<p>All Rights Reserved.</p>
	</div>
	
</body><!--Penutup tag body-->
</html><!--penutup tag html-->