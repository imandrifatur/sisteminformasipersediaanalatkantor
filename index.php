<?php 

session_start();

// Cek apakah pengguna telah login
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}


?>