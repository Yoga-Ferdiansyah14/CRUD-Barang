<?php
include 'config/db.php';

$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM barang WHERE id=$id");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "Data tidak ditemukan!";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $kode = $_POST['kode'];
    $nama = $_POST['nama_barang'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga_satuan'];
    $jumlah = $_POST['jumlah'];

    // Upload foto baru jika ada
    $foto_baru = $_FILES['foto']['name'];
    $tmp = $_FILES['foto']['tmp_name'];
    $path = "uploads/";

    if ($foto_baru != "") {
        $nama_foto_baru = uniqid() . "_" . $foto_baru;
        move_uploaded_file($tmp, $path . $nama_foto_baru);

        // Hapus foto lama kalau ada
        if ($data['foto'] != "") {
            unlink($path . $data['foto']);
        }
    } else {
        $nama_foto_baru = $data['foto']; // tetap pakai foto lama
    }

    // Update data
    $sql = "UPDATE barang SET 
                kode='$kode', 
                nama_barang='$nama', 
                deskripsi='$deskripsi',
                harga_satuan='$harga',
                jumlah='$jumlah',
                foto='$nama_foto_baru'
            WHERE id=$id";
    $update = mysqli_query($conn, $sql);

    if ($update) {
        header("Location: index.php");
    } else {
        echo "Gagal mengupdate data: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Barang</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Edit Barang</h2>
    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label>Kode Barang</label>
            <input type="text" name="kode" class="form-control" value="<?= $data['kode'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Nama Barang</label>
            <input type="text" name="nama_barang" class="form-control" value="<?= $data['nama_barang'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control"><?= $data['deskripsi'] ?></textarea>
        </div>
        <div class="mb-3">
            <label>Harga Satuan</label>
            <input type="number" name="harga_satuan" class="form-control" value="<?= $data['harga_satuan'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Jumlah</label>
            <input type="number" name="jumlah" class="form-control" value="<?= $data['jumlah'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Foto</label><br>
            <?php if ($data['foto']): ?>
                <img src="uploads/<?= $data['foto'] ?>" width="100"><br><br>
            <?php endif; ?>
            <input type="file" name="foto" class="form-control">
            <small class="text-muted">Kosongkan jika tidak ingin mengganti foto</small>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</body>
</html>
