<?php
session_start();

// Cek apakah pengguna telah login
if (!isset($_SESSION['username'])) {
    header('Location: ../login.php');
    exit;
}

// Cek apakah pengguna memiliki izin untuk mengakses halaman ini
if ($_SESSION['role'] !== 'user') {
    header('Location: ../unauthorized.php');
    exit;
}
?>
<?php
include '../koneksi.php';
if(!empty($_POST['kode_transaksi'])){
    $kode = mysqli_real_escape_string($kon,$_POST['kode_transaksi']);
    $nama = mysqli_real_escape_string($kon,$_POST['nama_barang']);
    $jenis = mysqli_real_escape_string($kon,$_POST['jenis']);
    $untuk = mysqli_real_escape_string($kon,$_POST['brg_to']);
    $jumlah = mysqli_real_escape_string($kon,$_POST['jumlah']);
    $tanggal = date('Y-m-d');
    $q = "SELECT stock FROM daftar_barang where nama_barang='$nama'";
    $stockawal = mysqli_query($kon,$q);
    $stockawal = mysqli_fetch_array($stockawal);
    $stockakhir = 0;
    $stockawal = $stockawal['stock'];
    if($jenis=="Masuk")$stockakhir = $stockawal+$jumlah;
    if($jenis=="Keluar")$stockakhir = $stockawal - $jumlah;
    $q = "INSERT INTO transaksi (kode_trans,barang,jenis_trans,brg_to,jumlah_trans,tanggal) VALUES ('".strtoupper($kode)."','".strtoupper($nama)."','$jenis','$untuk','$jumlah',STR_TO_DATE('$tanggal','%Y-%m-%d'));";
    $q .= "INSERT INTO laporan_trans (kode_trans,nama_brg,jenis_trans,brg_to,jumlah_trans,stock_awal,stock_akhir,tanggal) VALUES ('".strtoupper($kode)."','".strtoupper($nama)."','$jenis','$untuk','$jumlah','$stockawal','$stockakhir',STR_TO_DATE('$tanggal','%Y-%m-%d'));";
    $q .= "UPDATE daftar_barang SET stock='$stockakhir' WHERE nama_barang='$nama';";
    mysqli_multi_query($kon,$q)or die("Error: ".mysqli_error($kon));
    header("location:index.php");
    echo "</div><h2>Sukses</h2>";
    echo "<script>alert('Data Berhasil Disimpan')</script>";
}else{
    
}
?> 