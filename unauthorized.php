<?php 

session_start();

// Cek apakah pengguna telah login
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}


?>
<!DOCTYPE html>
<html>
<head>
    <title>Akses Ditolak</title>
    <script>
        alert('Anda tidak memiliki izin untuk mengakses halaman ini!');
    </script>
</head>
<body>
    <h1>Akses Ditolak</h1>

    <p>Anda tidak memiliki izin untuk mengakses halaman ini.</p>

    <p><a href="logout.php">Keluar</a></p>
</body>
</html>
