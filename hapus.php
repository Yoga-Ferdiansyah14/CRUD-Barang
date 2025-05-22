<?php
include 'config/db.php';

$id = $_GET['id'];

// Ambil data barang (buat cek apakah ada fotonya)
$query = mysqli_query($conn, "SELECT * FROM barang WHERE id=$id");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "Data tidak ditemukan!";
    exit;
}

// Hapus foto dari folder uploads jika ada
if ($data['foto'] != "") {
    $path = "uploads/" . $data['foto'];
    if (file_exists($path)) {
        unlink($path);
    }
}

// Hapus data dari database
$delete = mysqli_query($conn, "DELETE FROM barang WHERE id=$id");

if ($delete) {
    header("Location: index.php");
} else {
    echo "Gagal menghapus data: " . mysqli_error($conn);
}
?>
