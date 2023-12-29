<?php
 require 'adminPerm.inc';//file eksternal berisi session
?>
<!DOCTYPE html><!--menginformasikan bahwa versi dokumen HTML adalah HTML5-->
<html lang="en"><!--Tag pembuka HTML dan memberi tahu browser bahwa semua konten di halaman tresebut adalah bahasa Inggris-->
<head><!--Tag pembuka Head-->
    <meta charset="utf-8"><!-- memberi informasi terhadap browser dan search engine untukmelakukan pengkodean karakter sesuai ketentuan UTF-8-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TAMBAH REKENING</title><!--Deklarasi Judul Halaman Web-->
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
        <div class="profil"><a href="register.php?Admin=admin.php?Admin=<?php if (isset($_POST['Admin'])) {
            echo $_POST['Admin'];
        } if (isset($_GET['Admin'])) {
            echo $_GET['Admin'];
        } // mengambil data Admin untuk dimasukkan dan dikirim melalui url ?>">Register Customer</a>
        </div>
    </div><!--Tag penutup sidebar-->
    <div class="isi"><!--Tag pembuka Isi-->
        <div class="isiriwayatreg"><!--Tag pembuka class Isiriwayatreg-->
            <h1 class="h1profil">TAMBAH SALDO REKENING</h1><!--menampilkan H1 Data Customer dan Rekening-->
            <?php include 'editRekProcess.php' //menyisipkan untuk validasi form ?>
            <div class="error-message-form1"><?php echo $form_error; ?></div><!-- menampilkan eror form-->
            <form action="editRekening.php" method="POST"><!--Tag pembuka Form-->
                    <label>Jumlah Saldo:</label><!--Tag Label Jumlah Saldo-->
                <div class="inputan">
                    <input type="text" name="saldo" value="<?php if(isset($_POST['saldo'])) { //inputan jumlah saldo
                        echo htmlspecialchars($_POST['saldo']);
                    } //mengambil data dan menyimpan data ke dalam value inputan ?>">
                </div>
                <span class="error-message"><?php echo $saldo_error; ?></span><!-- menampilkan eror saldo-->
                <div>
                    <input type="hidden" name="no_rek"  value="<?php if(isset($_GET['no_rek'])) { //inputan no_rekening tapi hidden
                        $no_rek = $_GET['no_rek'];
                        echo htmlspecialchars($no_rek);}if(isset($_POST['no_rek'])) { 
                        $no_rek = $_POST['no_rek'];
                        echo htmlspecialchars($no_rek);}  //mengambil data dan menyimpan data ke dalam value inputan
                    ?>">
                </div>
                <div>
                    <input type="submit" name="submit" value="Tambah Saldo" class="updatewarna2"><!-- tombol Tambah Saldo-->
                    <input type="reset" name="reset" value="Reset" class="resetupdate"><!-- Tombol Reset-->
                </div>
            </form><!--penutup form-->
        </div>
    </div>
    <div class="footer"><!--tag pembuka class footer-->
        <div><p>Copyright © 2022, PAW2022-1-B05</p></div><!--Penampil nama kelompok-->
        <p>All Rights Reserved.</p>
    </div>

</body><!--Penutup tag body-->
</html><!--penutup tag html-->