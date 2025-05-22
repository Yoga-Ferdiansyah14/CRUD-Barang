<?php
include 'config/db.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Barang</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <a href="logout.php" class="btn btn-danger float-end">Logout</a>

    <h2 class="mb-4">Data Barang</h2>
    <a href="tambah.php" class="btn btn-primary mb-3">Tambah Barang</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama Barang</th>
                <th>Deskripsi</th>
                <th>Harga Satuan</th>
                <th>Jumlah</th>
                <th>Foto</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = mysqli_query($conn, "SELECT * FROM barang ORDER BY id DESC");
            while ($row = mysqli_fetch_assoc($query)) {
                echo "<tr>";
                echo "<td>{$row['kode']}</td>";
                echo "<td>{$row['nama_barang']}</td>";
                echo "<td>{$row['deskripsi']}</td>";
                echo "<td>Rp " . number_format($row['harga_satuan']) . "</td>";
                echo "<td>{$row['jumlah']}</td>";
                echo "<td>";
                if ($row['foto']) {
                    echo "<img src='uploads/{$row['foto']}' width='80'>";
                } else {
                    echo "-";
                }
                echo "</td>";
                echo "<td>
                    <a href='edit.php?id={$row['id']}' class='btn btn-sm btn-warning'>Edit</a>
                    <a href='hapus.php?id={$row['id']}' class='btn btn-sm btn-danger' onclick=\"return confirm('Yakin ingin hapus?')\">Hapus</a>
                </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>
