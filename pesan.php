<?php
session_start();

// DATA DARI INDEX
$film   = $_GET['film'] ?? '';
$gambar = $_GET['gambar'] ?? '';

// HARGA
$hargaReguler = 75000;
$hargaVIP     = 150000;
$biayaAdmin   = 2500;

// INPUT FORM
$jam     = $_POST['jam'] ?? '';
$ruangan = $_POST['ruangan'] ?? '';
$jumlah  = $_POST['jumlah'] ?? '';
$diskon  = $_POST['kode'] ?? '';

// TOTAL
$hargaTiket = 0;
$hargaDiskon=0;
$totalAdmin = 0;
$total      = 0;

// PROSES
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if ($ruangan === 'Reguler') {
        $hargaTiket = $hargaReguler;
    } elseif ($ruangan === 'VIP') {
        $hargaTiket = $hargaVIP;
    }

    if ($diskon == 'COUPLETIX' && $jumlah == 2) {
        $hargaDiskon = ($hargaTiket*$jumlah) * 0.25;
    }elseif ($diskon == 'SINGLETIX' && $jumlah == 1) {
        $hargaDiskon = ($hargaTiket*$jumlah) * 0.30;
    }

    $totalAdmin = $biayaAdmin * $jumlah;
    $total = ($hargaTiket * $jumlah)  - $hargaDiskon + $totalAdmin;

    if (isset($_POST['simpan'])) {
    // CEK STOK
        if ($_SESSION['stok'][$film] >= $jumlah) {
        $_SESSION['stok'][$film] -= $jumlah;
        } else {
            echo "<script>
                alert('Stok tiket tidak mencukupi');
                window.location.href='index.php';
                </script>";
            exit;
        }
        echo "
        <script>
        alert(
            'Pesanan Berhasil !\\n\\n' +
            'Film        : $film\\n' +
            'Jam Tayang  : $jam\\n' +
            'Ruangan     : $ruangan\\n' +
            'Jumlah Tiket: $jumlah\\n' +
            'Biaya Admin : Rp " . number_format($totalAdmin) . "\\n' +
            'Total Diskon: Rp" . number_format($hargaDiskon) . "\\n' +
            'Total Bayar : Rp " . number_format($total) . "'
        );
        window.location.href='index.php';
        </script>";
        exit;
    }
}
?>
<!doctype html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Pemesanan Tiket - Kali Kali Satu</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<div class="container mt-4">

<h3>Pemesanan Tiket - Kali Kali Satu</h3>
<hr>

<!-- INFO FILM -->
 <div class="mb-3 text-center">
<img src="img/<?= $gambar ?>" width="200" alt="<?= $film ?>">
<p><strong><?= $film ?></strong></p>
</div>

<form method="post">

<!-- JAM -->
<label>Jam Tayang</label><br>
<input type="radio" name="jam" value="12.00" <?= $jam=='12.00'?'checked':'' ?>> 12.00
<input type="radio" name="jam" value="16.00" <?= $jam=='16.00'?'checked':'' ?>> 16.00
<input type="radio" name="jam" value="18.00" <?= $jam=='18.00'?'checked':'' ?>> 18.00
<br><br>

<!-- RUANGAN -->
<label>Ruangan</label><br>
<input type="radio" name="ruangan" value="Reguler" <?= $ruangan=='Reguler'?'checked':'' ?>> Reguler (75.000)
<input type="radio" name="ruangan" value="VIP" <?= $ruangan=='VIP'?'checked':'' ?>> VIP (150.000)
<br><br>

<!-- JUMLAH -->
<label>Jumlah Tiket</label>
<input type="number" name="jumlah" class="form-control mb-3" value="<?= $jumlah ?>">

<!-- VOUCHER -->
<label>Kode Voucher</label>
<input type="text" name="kode" class="form-control mb-3" value="<?= $diskon ?>">

<!-- HITUNG -->
<button type="submit" name="hitung" class="btn btn-secondary mb-3">
Hitung Total
</button>

<br>

<!-- TOTAL -->
<label>Total Bayar</label>
<input type="text" class="form-control mb-3"
value="<?= $total ? 'Rp '.number_format($total) : '' ?>" readonly>

<!-- SIMPAN -->
<button type="submit" name="simpan" class="btn btn-success">
Simpan
</button>

</form>
</div>
</body>
</html>
