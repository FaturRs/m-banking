<?php
 require 'adminPerm.inc'; //membuat session
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
        <img src="../img/logo_kecil.png" class="logoatas" alt="logokecilBRI"><!--menampilkan gambar logo kecil diatas-->
        <div class="mobile">MOBILE BANKING BRI</div><!--Tag judul di menu-->
    </div>
    <div class="sidebar"><!--Tag pembuka Sidebar-->
        <div class="dasboard"><a href="admin.php?Admin=<?php if (isset($_POST['Admin'])) {
            echo $_POST['Admin'];
        } else if (isset($_GET['Admin'])) {
            echo $_GET['Admin'];
        } //mengambil data ke dalam value ?>">Data Customer</a>
        </div>
        <div class="profil"><a href="register.php?Admin=<?php if (isset($_POST['Admin'])) {
            echo $_POST['Admin'];
        } else if (isset($_GET['Admin'])) {
            echo $_GET['Admin'];
        } //mengambil data ke dalam value ?>">Register Customer</a>
        </div>
    </div>
    <div class="isi"><!--Tag pembuka Isi-->
        <div class="isiriwayatreg">
            <h1 class="h1profil">TAMBAH REKENING</h1><!--H1 tambah Rekening-->
            <?php include 'addRekProcess.php' ?><!--Include file addrekproscess.php-->
            <div class="error-message-form1"><?php echo $form_error; ?></div><!--Tag Penampil eror pada form-->
            <form action="addRekening.php" method="POST"><!--Tag pembuka Form-->
            
                    <label>No.rekening :</label><!--Tag Label-->
                <div class="inputan"><!--Tag pembuka class inputan-->
                    <input type="text" name="rekening" value="<?php if(isset($_POST['rekening'])) {//inputan rekening
                        $rekening = $_POST['rekening'];
                        echo htmlspecialchars($rekening);
                    } //mengambil data ke dalam value 
                ?>" ><!--Tag pembuka Head-->
                </div>  
                    <span class="error-message"><!--Penampil eror isian rekening-->
                    <?php echo $rekening_error; ?><!--memanggil eror isian rekening-->
                    </span><br>
                    <label>Jumlah Saldo:</label><!--Label-->
                <div class="inputan">
                    <input type="text" name="saldo" value="<?php if(isset($_POST['saldo'])) { //inputan saldo
                        echo htmlspecialchars($_POST['saldo']);
                    } //mengambil data ke dalam value
                ?>">
                </div>
                    <span class="error-message"><!--Penampil eror isian saldo-->
                    <?php echo $saldo_error; ?><!--pemanggil eror isian rekening-->
                    </span>
                <div class="inputan">
                    <input type="hidden" name="id_customer"  value="<?php if(isset($_GET['id_customer'])) { //inputan id_customer tapi hidden
                        $id_customer = $_GET['id_customer'];
                        echo htmlspecialchars($id_customer);} if(isset($_POST['id_customer'])) { 
                        echo htmlspecialchars($_POST['id_customer']);
                    }; //mengambil data ke dalam value
                    ?>">
                </div>
                <div class="inputan">
                    <input type="hidden" name="Admin"  value="<?php if(isset($_POST['Admin'])) { //inputan Admin tapi hidden
                        echo htmlspecialchars($_POST['Admin']);
                    } if(isset($_GET['Admin'])) { 
                        $Admin = $_GET['Admin'];
                        echo htmlspecialchars($Admin);
                        //mengambil data ke dalam value
                    }?>">
                </div><!--Tag Penutup Class isi-->
                <div>
                    <input type="submit" name="submit" value="Tambah Rekening" class="updatewarna2"><!--tombol tambah rekening-->
                    <input type="reset" name="reset" value="Reset" class="resetupdate"><!--tombol reset rekening-->
                </div>
            </form><!--Penutup Form-->
        </div><!--Penutup isiriwayat2-->
    </div><!--Penutup isi-->
    <div class="footer"><!--tag pembuka class footer-->
        <div><p>Copyright © 2022, PAW2022-1-B05</p></div><!--Penampil nama kelompok-->
        <p>All Rights Reserved.</p>
    </div>

</body><!--Penutup tag body-->
</html><!--penutup tag html-->
