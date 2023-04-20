
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
    <style>
       .form-group {
  margin-bottom: 1rem;
}

label {
  font-weight: bold;
}

.btn-primary {
  background-color: #007bff;
  border-color: #007bff;
}

.btn-primary:hover {
  background-color: #0069d9;
  border-color: #0062cc;
}

    </style>
    <title>PT Angels Products</title>
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
          <h1>Edit Data Barang</h1>
          <?php
include '../koneksi.php';
session_start();
if(!empty($_POST['kode_barang'])){
$id=$_GET['id'];
$kode=$_POST['kode_barang'];
$nama=$_POST['nama_barang'];
$jenis=$_POST['jenis_brg'];
$satuan=$_POST['satuan_brg'];
$stock=$_POST['stock'];
$spek=$_POST['spek_brg'];
$sql = "UPDATE daftar_barang SET kode='$kode',nama_barang='$nama',jenis='$jenis',stock='$stock',satuan='$satuan',spek='$spek' WHERE id=$id";
mysqli_query($kon,$sql);
Header("Location:index.php");
echo "<script>alert('Data Berhasil Di Update')</script>";
}

        $sql = "SELECT * FROM daftar_barang where id=".mysqli_real_escape_string($kon,$_GET['id'])."";
        $result = mysqli_query($kon,$sql);
         while($row = mysqli_fetch_array($result))
         {
           $values['kode'] = $row['kode'];
           $values['nama_barang'] = $row['nama_barang'];
           $values['jenis'] = $row['jenis'];
           $values['stock'] = $row['stock'];
           $values['spek'] = $row['spek'];
           $values['satuan'] = $row['satuan'];
    }
 ?>
<form name="edit_data" action="#" method="post" class="form-horizontal">
<div class="form-group">
                                    <label for="focusedinput" class="col-sm-2 control-label">kode barang</label>
                                    <div class="col-sm-2">
                                        <input type="text" name="kode_barang" maxlength="30" required="required" class="form-control1" id="focusedinput" value="<?php echo $values['kode'] ?>"/>
                                    </div>
                                    </div>
                                    <div class="form-group">
                                    <label for="focusedinput" class="col-sm-2 control-label">nama barang</label>
                                    <div class="col-sm-2">
                                        <input type="text" name="nama_barang" maxlength="30" required="required" class="form-control1" id="focusedinput" value="<?php echo $values['nama_barang'] ?>"/>
                                    </div>
                                    </div>
                                      <div class="form-group">
                                    <label for="selector1" class="col-sm-2 control-label">jenis</label>
                                    <div class="col-sm-4"><select name="jenis_brg" id="selector1" class="form-control1" >
                                    <?php
                                    include '../koneksi.php';
$sql = "SELECT * FROM jenis";
$result = mysqli_query($kon,$sql);
$selected = $values['jenis'];
while ($row = mysqli_fetch_array($result)) {
?>
<option value="<?php echo $row['jenis_barang']; ?>" <?php if($selected == $row['jenis_barang']){echo("selected");}?>><?php echo $row['jenis_barang'];?></option>
<?php
}  ?>
</select></div></div>
<div class="form-group">
                                    <label for="focusedinput" class="col-sm-2 control-label">stock</label>
                                    <div class="col-sm-4">
                                        <input type="number" name="stock" required="required" placeholder="jumlah...." class="form-control1" id="focusedinput" value="<?php echo $values['stock'] ?>" />
                                    </div>
                                    </div>
                                     <div class="form-group">
                                    <label for="txtarea1" class="col-sm-2 control-label">spesifikasi</label>
                                    <div class="col-sm-8"><textarea name="spek_brg" required="required" id="txtarea1" cols="50" rows="4" class="form-control1"><?php echo $values['spek'] ?> </textarea></div>
                                </div>
                                 <div class="form-group">
                                    <label for="selector1" class="col-sm-2 control-label">satuan</label>
                                    <div class="col-sm-4"><select name="satuan_brg" id="selector1" class="form-control1" >
                                    <?php
                                    include '../koneksi.php';
$sql = "SELECT * FROM satuan";
$result = mysqli_query($kon,$sql);
$selected = $values['satuan'];
while ($row = mysqli_fetch_array($result)) {
?>
<option value="<?php echo $row['satuan_barang']; ?>" <?php if($selected == $row['satuan_barang']){echo("selected");}?>><?php echo $row['satuan_barang'];?></option>
<?php
}  ?></select></div></div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
<!-- JS Bootstrap (membutuhkan jQuery dan Popper.js) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<!-- memanggil JavaScript dari Bootstrap dan datatables.net -->
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js"></script>
</body>
</html>