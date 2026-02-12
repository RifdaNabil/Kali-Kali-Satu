<?php
session_start();

// Ambil riwayat dari session
$riwayat = $_SESSION['riwayat'] ?? [];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Pemesanan - Citra Sport</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!--Navbar-->
    <nav class="navbar bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
            <h3>Citra Sport</h3>
        </a>
    </div>
    </nav>

    <div class="container mt-5">
        <h3 class="text-center mb-4">Riwayat Pemesanan</h3>

        <?php if (empty($riwayat)) { ?>
            <div class="alert alert-warning text-center">
                Belum ada riwayat pemesanan
            </div>
        <?php } else { ?>
            <table class="table table-bordered text-center">
                <thead class="table-success">
                    <tr>
                        <th>No</th>
                        <th>Lapangan</th>
                        <th>Nama</th>
                        <th>Durasi</th>
                        <th>Tanggal & Jam</th>
                        <th>Total Harga</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; foreach ($riwayat as $data) { ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $data['judul'] ?></td>
                        <td><?= $data['nama'] ?></td>
                        <td><?= $data['durasi'] ?> Jam</td>
                        <td><?= $data['tanggal'] ?></td>
                        <td>Rp <?= number_format($data['total'],0,',','.') ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } ?>

        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </div>

</body>
</html>
