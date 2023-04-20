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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    @media print {
  /* Menampilkan tombol cetak saat dicetak */
  .print-button {
    display: none;
  }
}

</style>
</head>
<body>
<?php
// Koneksi ke database
include '../koneksi.php';
// Periksa apakah form telah disubmit
if (isset($_POST['submit'])) {
	$tanggal_mulai = $_POST['tanggal_mulai'];
	$tanggal_selesai = $_POST['tanggal_selesai'];

	// Query untuk mengambil data transaksi berdasarkan tanggal
	$query = "SELECT * FROM laporan_trans WHERE tanggal BETWEEN '$tanggal_mulai' AND '$tanggal_selesai'";
	$result = mysqli_query($kon, $query);

	// Cetak hasil laporan
    echo "<h2>PT ANGELS PRODUCTS</h2>";
	echo "<h2>Laporan Transaksi</h2>";
  echo $_SESSION['username']; 
    echo " <button type='button' class='print-button' onclick='window.print();'>Cetak</button>";
	echo "<p>Tanggal: " . date('d F Y', strtotime($tanggal_mulai)) . " - " . date('d F Y', strtotime($tanggal_selesai)) . "</p>";
    echo "<table border='1' >";
    echo "<thead>";
    echo "<tr>
    <th>Kode Transaksi</th>
    <th>Nama Barang</th>
    <th>Jenis Transaksi</th>
    <th>Barang Untuk</th>
    <th>Jumlah Transaksi</th>
    <th>Stok Awal</th>
    <th>Stok Akhir</th>
    <th>Tanggal</th>
    </tr>";
    echo "</thead>";
    echo "<tbody>";
    while($row = mysqli_fetch_assoc($result)) {
      echo "<tr>
      <td>".$row["kode_trans"]."</td>
      <td>".$row["nama_brg"]."</td>
      <td>".$row["jenis_trans"]."</td>
      <td>".$row["brg_to"]."</td>
      <td>".$row["jumlah_trans"]."</td>
      <td>".$row["stock_awal"]."</td>
      <td>".$row["stock_akhir"]."</td>
      <td>".date('d-m-Y',strtotime($row['tanggal']))."</td>
      </tr>";
    }
    echo "</tbody>";
    echo "</table>";

}
?>

</body>
</html>

