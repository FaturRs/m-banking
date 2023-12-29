<?php
 require 'adminPerm.inc'; //file eksternal berisi session
?>
<!DOCTYPE html><!--menginformasikan bahwa versi dokumen HTML adalah HTML5-->
<html lang="en"><!--Tag pembuka HTML dan memberi tahu browser bahwa semua konten di halaman tresebut adalah bahasa Inggris-->
<head><!--Tag pembuka Head-->
	<meta charset="utf-8"><!-- memberi informasi terhadap browser dan search engine untukmelakukan pengkodean karakter sesuai ketentuan UTF-8-->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>KELOLA AKUN CUSTOMER</title><!--Deklarasi Judul Halaman Web-->
	<link rel="stylesheet" type="text/css" href="../style/stylecust.css"><!-- elemen <link> untuk menghubungkan file html dengan file css eksternal -->
</head><!--Tag penutup Head-->
<body><!--Tag pembuka Body-->
	<div class="menu"><!--Tag pembuka Class menu-->
		<img src="../img/logo_kecil.png" class="logoatas" alt="logokecilBRI"><!--menampilkan gambar logo kecil BRI diatas-->
		<div class="mobile">MOBILE BANKING BRI</div><!--Tag judul di menu-->
	</div>
	<div class="sidebar"><!--Tag pembuka Sidebar-->
		<div class="dasboard"><a href="admin.php?Admin=<?php if(isset($_POST['Admin'])){echo $_POST['Admin'];}if(isset($_GET['Admin'])){echo $_GET['Admin'];
		} // mengambil data Admin untuk dimasukkan dan dikirim melalui url ?>">Data Customer</a>
		</div>
		<div class="profil"><a href="register.php?Admin=<?php if (isset($_POST['Admin'])) {
			echo $_POST['Admin'];
		} if (isset($_GET['Admin'])) {
			echo $_GET['Admin'];
		} // mengambil data Admin untuk dimasukkan dan dikirim melalui url  ?>">Register Customer</a>
		</div>
	</div><!--Tag penutup sidebar-->
	<div class="isi"><!--Tag pembuka Isi-->
		<div class="isiriwayatreg"><!--Tag pembuka Isiriwayat-->
			<?php include 'UpdateAdmin.php' //menyisipkan untuk validasi form ?>
			<h1 class="h1profil">KELOLA AKUN CUSTOMER</h1><!--menampilkan H1 Data Customer dan Rekening-->
			<span class="error-message-form1"><?php echo $form_error; ?></span><br><!-- menampilkan eror form-->
			<form action="editCust.php" method="POST"><!--Tag pembuka Form-->
				<label class="labelreg">Nama</label><!--Tag Label Nama-->
				<div class="inputan">
					<input type="text" name="nama" value="<?php if(isset($_POST['nama'])) { //inputan rekening
						echo htmlspecialchars($_POST['nama']);
					}else echo $nama; //mengambil data dan menyimpan data ke dalam value inputan ?>" >
				</div>	
				<span class="error-message"><?php echo $name_error; ?></span><br><!--Penampil eror isian nama-->
				<label class="labelreg">No.Telp:</label><!--Label  Untuk Telepon-->
				<div class="inputan">
					<input type="text" name="phone" value="<?php if(isset($_POST['phone'])) { //inputan nomor telepon
						echo htmlspecialchars($_POST['phone']);
					}else echo $phone; //mengabil data dan menyimpan data ke dalam value inputan ?>" >
				</div>
				<span class="error-message"><?php echo $phone_error; ?></span><br><!--Penampil eror isian telepon-->
				<label class="labelreg">Alamat:</label><!--Label alamat-->
				<div class="inputan">
					<input type="text" name="alamat" value="<?php if(isset($_POST['alamat'])) { //inputan alamat
						echo htmlspecialchars($_POST['alamat']);
					}else echo $alamat; //mengabil data dan menyimpan data ke dalam value inputan ?>" >
				</div>
				<span class="error-message"><?php echo $alamat_error; ?></span><br><!--Penampil eror isian alamat-->
				<label class="labelreg">Username:</label><!--Label username-->
				<div class="inputan">
					<input type="text" name="username" value="<?php if(isset($_POST['username'])) { //inputan username
						echo htmlspecialchars($_POST['username']);
					}else echo $username; //mengabil data dan menyimpan data ke dalam value inputan ?>" >
				</div>
				<span class="error-message"><?php echo $username_error; ?></span><br><!--Penampil eror isian username-->
				<label class="labelreg">Password:</label><!--label password-->
				<div class="inputan">
					<input type="password" name="password"  value="<?php if(isset($_POST['password'])) { //inputan username
						echo htmlspecialchars($_POST['password']);
					} //mengambil data dan menyimpan data ke dalam value inputan ?>">
				</div>
					<span class="error-message"><!--Penampil eror password-->
					<?php echo $password_error; ?>
					</span><br>
				<div class="inputan">
					<input type="hidden" name="Admin"  value="<?php if(isset($_POST['Admin'])) { //inputan admin tapi hidden
						echo htmlspecialchars($_POST['Admin']);
					} if(isset($_GET['Admin'])) { 
						$Admin = $_GET['Admin'];
						echo htmlspecialchars($Admin);
					} //mengambil data dan menyimpan data ke dalam value inputan ?>">
				</div>
				<div class="inputan">
					<input type="hidden" name="id_customer"  value="<?php if(isset($_POST['id_customer'])) { //inputan id_customer tapi hidden
						echo htmlspecialchars($_POST['id_customer']);
					} if(isset($_GET['id_customer'])) { 
						$id_customer = $_GET['id_customer'];
						echo htmlspecialchars($id_customer);
					} //mengambil data dan menyimpan data ke dalam value inputan ?>">
				</div>
				<div>
					<input type="submit" name="submit" value="Update Data" class="updatewarna"><!--tombol update data-->
					<input type="reset" name="reset" value="Reset" class="resetupdate"><!--tombol reset-->
						<a class="buttonup1" href="addRekening.php?id_customer=<?php if (isset($_GET['id_customer'])) {
					echo $_GET['id_customer'];
					} else  echo $_POST['id_customer'] ?>&Admin=<?php if (isset($_GET['Admin'])) {
					echo $_GET['Admin'];
					} else  echo $_POST['Admin'] //mengirim url beserta data yang diambil dari url ?>">Tambah Rekening</a><!--tombol Tambah rekening-->
				</div>
			</form><!--penutup form-->
			<br><!--jarak-->
			<div>
			<?php
			if (isset($_GET['id_customer'])) { // ketika variabel tidak null
				include '../dbconnect.php';
				$statement2 = $dbc->prepare("SELECT customer.* , rekening.* FROM customer JOIN rekening ON customer.ID_CUSTOMER = rekening.ID_CUSTOMER WHERE customer.ID_CUSTOMER = :customer"); //pdo dan query untuk melihat data customer beserta rekening di database dengan join
				$statement2->bindValue(':customer', $_GET['id_customer']); //mengabil data id customer dari url
				
				$statement2->execute(); //eksekusi program
				echo "<div class='table1'>"; //menampilkan kedalam html
				echo "<table>";
				echo "<tr>";
				echo "<th>No.</th>";
				echo "<th>No.Rekening</th>";
				echo "<th>Saldo</th>";
				echo "<th colspan = '2'>Opsi</th>";
				echo "</tr>";
				$count = 1; //membuat count
				foreach ($statement2 as $row) { //memasukkan data hasil query kedalam array
					echo "<tr>";
					echo "<td>$count</td>";
					echo "<td>{$row['NO_REKENING']}</td>";
					echo "<td>{$row['JUMLAH_SALDO']}</td>"; //menampilkan kedalam html ?>
					<td><a class="updatewarna1" href="editRekening.php?no_rek=<?php echo $row['NO_REKENING'] ?>&Admin=<?php echo $row['NAMA_ADMIN'] ?>">Tambah Saldo</a></td>
					<td><a class="resetupdate" href="deleteRekening.php?no_rek=<?php echo $row['NO_REKENING'] ?>&Admin=<?php echo $row['NAMA_ADMIN'] ?>">Delete</a></td>
					</tr>

				<?php 
					$count += 1; //count bertambah setiap perulangan
				}
				echo '</table>';
				echo "</div>"; 
			} else if (isset($_POST['id_customer'])){ //jika variabel null maka eksekusi di bawah
				include '../dbconnect.php'; //menyisipkan untuk validasi form
				$statement2 = $dbc->prepare("SELECT customer.* , rekening.* FROM customer JOIN rekening ON customer.ID_CUSTOMER = rekening.ID_CUSTOMER WHERE customer.ID_CUSTOMER = :customer"); //pdo dan query untuk melihat data customer beserta rekening di database dengan join
				$statement2->bindValue(':customer', $_POST['id_customer']); //mengambil data id customer dari url
				
				$statement2->execute(); //eksekusi program
				echo "<div class='table1'>"; //menampilkan kedalam html
				echo "<table>";
				echo "<tr>";
				echo "<th>No.</th>";
				echo "<th>No.Rekening</th>";
				echo "<th>Saldo</th>";
				echo "<th colspan = '2'>Opsi</th>";
				echo "</tr>";
				$count = 1;
				foreach ($statement2 as $row) { //memasukkan data hasil query kedalam array
					echo "<tr>";
					echo "<td>$count</td>";
					echo "<td>{$row['NO_REKENING']}</td>";
					echo "<td>{$row['JUMLAH_SALDO']}</td>"; ?>
					<td><a class="updatewarna1" href="editRekening.php?no_rek=<?php echo $row['NO_REKENING'] ?>&Admin=<?php echo $row['NAMA_ADMIN'] ?>">Tambah Saldo</a></td>
					<td><a class="resetupdate" href="deleteRekening.php?no_rek=<?php echo $row['NO_REKENING'] ?>">Delete</a></td>
					</tr>

				<?php 
					$count += 1; //count bertambah setiap perulangan
				}
			echo '</table>';
			echo "</div>";
			} ?>
			</div>
		</div>
	</div><!--Penutup isi-->
	<div class="footer"><!--tag pembuka class footer-->
		<div><p>Copyright © 2022, PAW2022-1-B05</p></div><!--Penampil nama kelompok-->
		<p>All Rights Reserved.</p>
	</div>

</body><!--Penutup tag body-->
</html><!--penutup tag html-->