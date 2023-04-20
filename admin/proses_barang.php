<?php
session_start();

// Cek apakah pengguna telah login
if (!isset($_SESSION['username'])) {
    header('Location: ../login.php');
    exit;
}

// Cek apakah pengguna memiliki izin untuk mengakses halaman ini
if ($_SESSION['role'] !== 'admin') {
    header('Location: ../unauthorized.php');
    exit;
}
?>
<?php
include '../koneksi.php'; 
if(!empty($_POST['kode_barang'])){
    $kodebarang = $_POST["kode_barang"];
    $namabarang = $_POST["nama_barang"];
    $jenis = $_POST['jenis_brg'];
    $stock = $_POST['stock'];
    $spek = $_POST['spek_brg'];
    $satuan = $_POST['satuan_brg'];
    mysqli_query($kon,"INSERT INTO daftar_barang (kode,nama_barang,jenis,stock,spek,satuan) VALUES ('".strtoupper($kodebarang)."','".strtoupper($namabarang)."','$jenis','$stock','$spek','".strtoupper($satuan)."')");
       header("location:index.php");
    echo "<script>alert('Data Barang berhasil disimpan')</script>";
}else{
}
?>
