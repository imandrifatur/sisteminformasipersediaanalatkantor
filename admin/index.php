
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

<!DOCTYPE html>
<html>
<head>
  <title>PT Angels Products</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
   <!-- Bootstrap CSS -->
   <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
      crossorigin="anonymous"
    />
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</head>
<body>
   <!-- Sidebar -->
   <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="index.php">PT Angels Products</a>
      <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarNav"
        aria-controls="navbarNav"
        aria-expanded="false"
        aria-label="Toggle navigation"
      ></button>
    </nav>

    <!-- Main Content -->
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3 col-lg-2 sidebar">
          <ul class="nav flex-column">
          <li class="nav-item">
              <a class="nav-link" href="index.php">DATA BARANG</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="laporan_transaksi.php">Laporan Transaksi</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../logout.php">Logout</a>
            </li>
          </ul>
        </div>
        <div class="col-md-9 col-lg-10 main">
          <h1>Data Barang</h1>
           <!-- Tombol untuk membuka modal -->
           <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalDataBarang">
  Tambah Data Barang
</button>
                <br><br>
        <?php 
// Koneksi ke basis data
include '../koneksi.php';
// Query untuk menampilkan data
$sql = "SELECT * FROM daftar_barang";

// Eksekusi query
$result = mysqli_query($kon, $sql);

// Tampilkan data dalam tabel
echo "<table id='example' class='table table-striped table-bordered' >";
echo "<thead>";
echo "<tr>
<th>Kode Barang</th>
<th>Nama Barang</th>
<th>Jenis</th>
<th>Stok</th>
<th>Satuan</th>
<th>Spesifikasi</th>
<th>Pilihan</th>
</tr>";
echo "</thead>";
echo "<tbody>";
while($row = mysqli_fetch_assoc($result)) {
  echo "<tr>
  <td>".$row["kode"]."</td>
  <td>".$row["nama_barang"]."</td>
  <td>".$row["jenis"]."</td>
  <td>".$row["stock"]."</td>
  <td>".$row["satuan"]."</td>
  <td>".$row["spek"]."</td>
  <td><a href='edit_barang.php?id=".$row["id"]."'>Edit</a>
  <a href='hapus_barang.php?id=".$row["id"]."' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")'>Hapus</a>
  </td>
  </tr>";
}
echo "</tbody>";
echo "</table>";

// Tutup koneksi ke basis data
mysqli_close($kon);
?>
</div>
              
              <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>
            </main>
          </div>
      </div>      

        </div>
      </div>
    </div>
        

      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<!-- memanggil JavaScript dari Bootstrap dan datatables.net -->
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
	<!-- inisialisasi datatables -->
	<script type="text/javascript">
		$(document).ready(function() {
			$('#example').DataTable();
		} );
	</script>
</body>
</html>

<!-- Modal -->
<div class="modal fade" id="modalDataBarang" tabindex="-1" role="dialog" aria-labelledby="#modalDataBarangLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="#modalDataBarangLabel">Form Tambah Data Barang</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="modalDataBarang" action="proses_barang.php" method="post">
      
        <div class="form-group">
                        <label>kode barang</label>
                       <input type="text" class="form-control" name="kode_barang" placeholder="kode barang ......"  required="required">
                        </div>
                          <div class="form-group">
                        <label>Nama barang</label>
                      <input type="text" class="form-control" name="nama_barang" placeholder="nama barang ......" required="required">
                        </div>
                          <div class="form-group">
                                    <label>katagori</label>
                                <select name="jenis_brg" class="form-control">
<?php
include '../koneksi.php';
$sql = "SELECT * FROM jenis";
$result = mysqli_query($kon,$sql);
while ($row = mysqli_fetch_array($result)) {
?>
<option value="<?php echo $row['jenis_barang']; ?>"><?php echo $row['jenis_barang'];?></option>
<?php
}  ?>
</select></div>

                                 <div class="form-group">
                                    <label>stock</label>
                                       <input type="number" class="form-control" name="stock" placeholder="jumlah barang ......" required="required" />
                                    </div>
                                    <div class="form-group">
                                    <label>spesifikasi</label>
                                    <textarea name="spek_brg" class="form-control" placeholder="spesifikasi barang ....."  required="required" /></textarea></div>
                                <div class="form-group">
                                    <label>satuan</label>
                                   <select name="satuan_brg" class="form-control">
<?php
include '../koneksi.php';
$sql = "SELECT * FROM satuan";
$result = mysqli_query($kon,$sql);
while ($row = mysqli_fetch_array($result)) {
?>
<option value="<?php echo $row['satuan_barang']; ?>"><?php echo $row['satuan_barang'];?></option>
<?php
}  ?>
    </select></div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Tambah Data</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>