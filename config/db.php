<?php
$host = "localhost";
$user = "root";
$pass = ""; // Kosongkan kalau kamu pakai XAMPP default
$db   = "crud_barang";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
