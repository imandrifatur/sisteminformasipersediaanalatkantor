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
    <title>PT Angels Produtcts</title>
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
              <a class="nav-link" href="index.php">Transaksi Barang</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="laporan.php">Laporan Transaksi</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../logout.php">Logout</a>
            </li>
          </ul>
        </div>
        <div class="col-md-9 col-lg-10 main">
          <h1>Transaksi</h1>
           <!-- Tombol untuk membuka modal -->
           <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTransaksi">
  Entry Transaksi
</button>
<br/>
<br/>
<?php 
// Koneksi ke basis data
include '../koneksi.php';
// Query untuk menampilkan data
$sql = "SELECT * FROM transaksi";

// Eksekusi query
$result = mysqli_query($kon, $sql);

// Tampilkan data dalam tabel
echo "<table id='transaksi' class='table table-striped table-bordered' >";
echo "<thead>";
echo "<tr>
<th>Kode Transaksi</th>
<th>Nama Barang</th>
<th>Jenis Transaksi</th>
<th>barang untuk</th>
<th>Jumlah</th>
<th>Tanggal</th>
</tr>";
echo "</thead>";
echo "<tbody>";
while($row = mysqli_fetch_assoc($result)) {
  echo "<tr>
  <td>".$row["kode_trans"]."</td>
  <td>".$row["barang"]."</td>
  <td>".$row["jenis_trans"]."</td>
  <td>".$row["brg_to"]."</td>
  <td>".$row["jumlah_trans"]."</td>
  <td>".date('d-m-Y',strtotime($row['tanggal']))."</td>
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
			$('#transaksi').DataTable();
		} );
	</script>
</body>
</html>

<!-- Modal -->
<div class="modal fade" id="modalTransaksi" tabindex="-1" role="dialog" aria-labelledby="#modalTransaksiLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="#modalTransaksiLabel">Form Entry Transaksi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="modalTransaksi" action="proses_transaksi.php" method="post">
        <div class="form-group">
                        <label>kode barang</label>
                       <input type="text" name="kode_transaksi" class="form-control" style="text-transform:uppercase;" 
            value="<?php 
            include '../koneksi.php';
            $sql = "SELECT COUNT(*) as num FROM transaksi";
            $query=mysqli_query($kon,$sql)or die("Error: ".mysqli_error($kon));
            $total = mysqli_fetch_array($query);
            if($total['num']>0){
                if($total['num']>1){
                    $i=$total['num'];
                }else{ $i=1;}
                echo "TR".$i;}
            else{
                echo "TR0";
            }
            ?>" readonly/>
                        </div>
                          <div class="form-group">
                        <label>Nama barang</label>
                        <select name="nama_barang" class="form-control">
<?php
include '../koneksi.php';
$sql = "SELECT nama_barang from daftar_barang";
$result = mysqli_query($kon,$sql);
while ($row = mysqli_fetch_array($result)) {
?>
<option value="<?php echo $row['nama_barang']; ?>"><?php echo stripslashes($row['nama_barang']);?></option>
<?php
}  ?>
</select>
                        </div>
                         <div class="form-group">
                        <label>jenis</label>
                        <select name="jenis" class="form-control">
            <option value="Masuk">Masuk</option>
            <option value="Keluar">Keluar</option>
            </select></div>
             <div class="form-group">
                        <label>untuk</label>
                        <input type="text" name="brg_to" class="form-control" required="required" style="text-transform:uppercase;"/>
                        <div class="modal-footer"></div>
                         <div class="form-group">
                        <label>jumlah</label>
                        <input type="number" name="jumlah" class="form-control" required="required"/>
                        </div>
      
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Entry Data</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>