<?php
$servername = "localhost"; // nama server database
$username = "root"; // username database
$password = ""; // password database
$dbname = "inventory"; // nama database

// membuat koneksi ke database
$kon = mysqli_connect($servername, $username, $password, $dbname);

// memeriksa koneksi
if (!$kon) {
    die("Connection failed: " . mysqli_connect_error());
}

?>
