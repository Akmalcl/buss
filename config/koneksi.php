<?php
// Mengabaikan pesan kesalahan terkait fitur yang sudah kedaluwarsa (deprecated)
error_reporting(E_ALL & ~E_DEPRECATED);

$host = "localhost";
$user = "root";
$password = "";
$database = "socommerce";

// Mencoba koneksi ke database
$conn = mysqli_connect($host, $user, $password, $database);
?>
