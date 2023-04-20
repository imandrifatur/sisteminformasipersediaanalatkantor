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
$id=$_GET['id'];
mysqli_query($kon,"delete from daftar_barang where id='$id'");
header("location:index.php");

?>