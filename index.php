<?php
session_start();

if (isset($_GET['reset'])) {
    session_destroy();
    header("Location: index.php");
    exit;
}

if (!isset($_SESSION['stok'])) {
    $_SESSION['stok'] = [
        "Dead Poets Society" => 10,
        "500 Days Of Summer" => 10,
        "Totto-Chan : The Girl at the Window" => 10
    ];
}

$filmData= [
    ["Dead Poets Society","dead.jpg"],
    ["500 Days Of Summer","summer.jpg"],
    ["Totto-Chan : The Girl at the Window","toto.jpg"]
];
?>

<!doctype html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kali Kali Satu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .card-img-top{
            height: 500px;
            object-fit: cover;
        } 
    </style>

</head>
    <body>
        <!--NAVBAR-->
        <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand h1" href="index.php">Kali Kali Satu</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="#film">Lihat Film</a>
            </div>
            </div>
        </div>
        </nav>
        <!--HERO-->
        <section class="container mt-4 text-center">
            <div class="p-5">
                <h1 class="fw-bold">Selamat Datang di Kali Kali Satu</h1>
                <p class="col-md-8 mx-auto">
                    Tempat terbaik untuk menonton film favorit Anda bersama keluarga dan teman-teman.
                </p>
                <a href="#film" class="btn btn-primary btn-lg">Lihat Film</a>
            </div>
        </section>
        <!--CARD-->
        <section class="container mt-4 text-center" id="film">
            <div class="row">
                <?php foreach($filmData as $film): ?>
                <div class="col-md-4 mb-3">
                    <div class="card h-100">
                        <img src="img/<?php echo $film[1]; ?>" class="card-img-top" alt="<?php echo $film[0]; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $film[0]; ?></h5>
                            <p class="text-muted">Stok tiket: <?= $_SESSION['stok'][$film[0]] ?></p>
                            <?php if ($_SESSION['stok'][$film[0]] > 0): ?>
                            <a href="pesan.php?film=<?= urlencode($film[0]) ?>&gambar=<?= $film[1] ?>" 
                            class="btn btn-primary">
                            Pesan Tiket
                            </a>
                            <?php else: ?>
                                <button class="btn btn-secondary" disabled>
                                Stok Habis
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>

        <a href="?reset=true" class="btn btn-danger mb-3">
            Reset Stok
        </a>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>

