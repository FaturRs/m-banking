<?php
	include '../dbconnect.php'; //koneksi ke database sql

	$statement = $dbc->prepare("SELECT * FROM customer"); //pdo dan query untuk melihat data customer di db
	
	$statement->execute(); //eksekusi program
	echo "<table>"; // menampilkan data ke html
	echo "<tr>";
	echo "<th>No.</th>";
	echo "<th>Daftar Akun</th>";
	echo "<th colspan='2'>Opsi</th>";
	echo "</tr>";
	$count = 1; //variabel untuk count
	foreach ($statement as $row) { //memasukkan data hasil query ke dalam array
		echo "<tr>";
		echo "<td>$count</td>";
		echo "<td>{$row['NAMA_CUSTOMER']}</td>"; //menampilkan data ke html ?>
		
		<td><a class="updatewarna1" href="editCust.php?Admin=<?php echo $_GET['Admin'] ?>&id_customer=<?php echo $row['ID_CUSTOMER'] //mengirim link beserta data ke dalam url ?>">Edit</a></td>
		<td><a class="resetupdate" href="deleteCust.php?Admin=<?php echo $_GET['Admin'] ?>&id_customer=<?php echo $row['ID_CUSTOMER'] //mengirim link beserta data ke dalam url ?>">Delete</a></td>
		</tr>

	<?php 
		$count += 1; // count bertambah setiap perulangan
	}
	echo '</table>';

?>