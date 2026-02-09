<?php
//mengambil nilai index dari URL
$id = $_GET['index'] ?? 0;

//data array daftar perawatan
$listPerawatan = [
    ["Perawatan 1" ,"Isi Deskripsi 1", 150000, "img/perawatan1.jpg"],
    ["Perawatan 2" ,"Isi Deskripsi 2", 100000, "img/perawatan2.jpg"],
    ["Perawatan 3" ,"Isi Deskripsi 3", 50000,  "img/perawatan3.jpg"],
    ["Perawatan 4" ,"Isi Deskripsi 4", 120000, "img/perawatan4.jpg"],
];

//inisialisasi variabel
$pilihPerawatan = $_POST['pilihPerawatan'] ?? $id;

// pengaman index array
if (!isset($listPerawatan[$pilihPerawatan])) {
    $pilihPerawatan = 0;
}

$hargaPerawatan = $listPerawatan[$pilihPerawatan][2];
$jumlahOrang    = $_POST['jumlah'] ?? "";
$ruangVIP       = isset($_POST['tambahan']);
$pembayaran     = $_POST['pembayaran'] ?? "";
$hitungTotal    = 0;
$kembalian      = 0;
$errors         = [];

//proses hitung total harga jika tombol dihitung ditekan
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['hitungTotal'])) {
        if ($jumlahOrang === "" || !is_numeric($jumlahOrang) || $jumlahOrang <= 0) {
            $errors[] = "Jumlah orang harus diisi dan berupa angka.";
        } else {
            $hitungTotal = $hargaPerawatan * $jumlahOrang;

            // tambahan ruang VIP
            if ($ruangVIP) {
                $hitungTotal += 5000;
            }
        }
    }

    //proses hitung kembalian jika tombol kembalian ditekan
    if (isset($_POST['hitungKembalian'])) {

        // pastikan total dihitung ulang
        if ($jumlahOrang === "" || !is_numeric($jumlahOrang) || $jumlahOrang <= 0) {
            $errors[] = "Jumlah orang harus diisi dan berupa angka.";
        } else {
            $hitungTotal = $hargaPerawatan * $jumlahOrang;
            if ($ruangVIP) {
                $hitungTotal += 50000;
            }
        }

        if ($pembayaran === "" || !is_numeric($pembayaran)) {
            $errors[] = "Pembayaran harus diisi dan berupa angka.";
        } elseif ($pembayaran < $hitungTotal) {
            $errors[] = "Pembayaran tidak boleh kurang dari total harga.";
            $kembalian = 0;
        } else {
            $kembalian = $pembayaran - $hitungTotal;
        }
    }
}

if (isset($_POST['simpan'])) {
    //proses simpan data pemesanan (bisa disimpan ke database atau file)
    //contoh: menampilkan pesan sukses

    // validasi semua data wajib diisi
    if (
        empty($_POST['nomor']) ||
        empty($_POST['tanggal']) ||
        empty($_POST['nama']) ||
        $jumlahOrang === "" ||
        !is_numeric($jumlahOrang) ||
        $pembayaran === "" ||
        !is_numeric($pembayaran)
    ) {
        $errors[] = "Semua data harus diisi dengan benar.";
    }

    // hitung ulang total (WAJIB, agar tidak tergantung tombol lain)
    if (!$errors) {
        $hitungTotal = $hargaPerawatan * $jumlahOrang;
        if ($ruangVIP) {
            $hitungTotal += 50000;
        }

        if ($pembayaran < $hitungTotal) {
            $errors[] = "Pembayaran tidak mencukupi.";
        }
    }

    if (!$errors) {
        $kembalian = $pembayaran - $hitungTotal;

        echo "<script>
            alert(
                'PEMESANAN BERHASIL\\n' +
                'No Transaksi : {$_POST['nomor']}\\n' +
                'Tanggal      : {$_POST['tanggal']}\\n' +
                'Nama         : {$_POST['nama']}\\n' +
                'Perawatan    : {$listPerawatan[$pilihPerawatan][0]}\\n' +
                'Jumlah Orang : $jumlahOrang\\n' +
                'VIP          : ".($ruangVIP ? "Ya (+Rp 5.000)" : "Tidak")."\\n' +
                'Total Harga  : Rp $hitungTotal\\n' +
                'Pembayaran   : Rp $pembayaran\\n' +
                'Kembalian    : Rp $kembalian'
            );
            window.location.href='index.php';
        </script>";
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemesanan Klinik Estetika</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-secondary shadow-sm">
<div class="container-fluid">
    <a class="navbar-brand" href="index.php">Klinik Estetika</a>
</div>
</nav>

<div class="container mt-5">
<div class="card">
<div class="card-header text-center bg-success text-white">
    <h5>Form Pemesanan</h5>
</div>

<div class="card-body">

<?php if ($errors) { ?>
<div class="alert alert-danger">
<ul>
<?php foreach ($errors as $err) echo "<li>$err</li>"; ?>
</ul>
</div>
<?php } ?>

<form method="POST">

<div class="mb-3">
<label class="form-label">Nomor Transaksi</label>
<input type="number" class="form-control" name="nomor" value="<?= $_POST['nomor'] ?? '' ?>">
</div>

<div class="mb-3">
<label class="form-label">Tanggal Pemesanan</label>
<input type="date" class="form-control" name="tanggal" value="<?= $_POST['tanggal'] ?? '' ?>">
</div>

<div class="mb-3">
<label class="form-label">Nama Pemesan</label>
<input type="text" class="form-control" name="nama" value="<?= $_POST['nama'] ?? '' ?>">
</div>

<label class="form-label">Pilihan Perawatan</label>
<select class="form-select mb-3" name="pilihPerawatan" onchange="this.form.submit()">
<?php foreach ($listPerawatan as $index => $tampil) { ?>
<option value="<?= $index ?>" <?= ($index == $pilihPerawatan) ? 'selected' : '' ?>>
<?= $tampil[0] ?>
</option>
<?php } ?>
</select>

<div class="mb-3">
<label class="form-label">Harga Perawatan</label>
<input type="text" class="form-control" value="<?= $hargaPerawatan ?>" readonly>
</div>

<div class="mb-3">
<label class="form-label">Jumlah Orang</label>
<input type="number" class="form-control" name="jumlah" value="<?= $jumlahOrang ?>">
</div>

<div class="form-check mb-3">
<input class="form-check-input" type="checkbox" name="tambahan" <?= $ruangVIP ? 'checked' : '' ?>>
<label class="form-check-label">Tambahan Ruang VIP (+Rp 50.000)</label>
</div>

<div class="mb-3">
<label class="form-label">Total Harga</label>
<input type="text" class="form-control" value="<?= $hitungTotal ?>" readonly>
</div>

<button class="btn btn-primary mb-3" name="hitungTotal">Hitung Total</button>

<div class="mb-3">
<label class="form-label">Pembayaran</label>
<input type="number" class="form-control" name="pembayaran" value="<?= $pembayaran ?>">
</div>

<div class="mb-3">
<label class="form-label">Kembalian</label>
<input type="text" class="form-control" value="<?= $kembalian ?>" readonly>
</div>

<button class="btn btn-primary" name="hitungKembalian">Hitung Kembalian</button>

<br><br>

<button type="reset" class="btn btn-danger">Batal</button>
<button type="submit" class="btn btn-success" name="simpan">Pesan Sekarang</button>

</form>
</div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
