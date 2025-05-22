<?php
include 'config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $kode = $_POST['kode'];
    $nama = $_POST['nama_barang'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga_satuan'];
    $jumlah = $_POST['jumlah'];

    // Upload Foto
    $foto = $_FILES['foto']['name'];
    $tmp = $_FILES['foto']['tmp_name'];
    $path = "uploads/";

    if ($foto != "") {
        $nama_foto = uniqid() . "_" . $foto;
        move_uploaded_file($tmp, $path . $nama_foto);
    } else {
        $nama_foto = null;
    }

    // Simpan ke database
    $sql = "INSERT INTO barang (kode, nama_barang, deskripsi, harga_satuan, jumlah, foto) 
            VALUES ('$kode', '$nama', '$deskripsi', '$harga', '$jumlah', '$nama_foto')";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        header("Location: index.php");
    } else {
        echo "Gagal menyimpan data: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Barang</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Tambah Barang</h2>
    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label>Kode Barang</label>
            <input type="text" name="kode" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Nama Barang</label>
            <input type="text" name="nama_barang" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label>Harga Satuan</label>
            <input type="number" name="harga_satuan" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Jumlah</label>
            <input type="number" name="jumlah" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Foto (opsional)</label>
            <input type="file" name="foto" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</body>
</html>
