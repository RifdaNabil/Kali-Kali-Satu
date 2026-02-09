<?php
    $listPerawatan= [
        ["Perawatan 1" ,"Meremajakan Kulit", "Rp 150.000", "img/perawatan1.jpg"],
        ["Perawatan 2" ,"Merapikan Kuku Anda", "Rp 100.000", "img/perawatan2.jpg"],
        ["Perawatan 3" ,"Menyegarkan Kulit Kepala", "Rp 50.000", "img/perawatan3.jpg"],
        ["Perawatan 4" ,"Model Terbaru Mengikuti Tren", "Rp 120.000", "img/perawatan4.jpg"],
    ];
       
?>

<!doctype html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Klinik Estetika</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <style>
        .carousel-item img{
            height: 650px;
            object-fit: cover;
        }
    </style>
</head>
  <body>    
    <!--Navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Klinik Estetika</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <a class="nav-link" href="index.php">Beranda</a>
            <a class="nav-link" href="#perawatan">Daftar Perawatan</a>
        </div>
        <div class="d-flex ms-auto">
            <a class="btn btn-primary" href="#">Logout</a>
        </div>
        </div>
    </div>
    </nav>

    <!-- Carousel -->
    <section id="carouselExampleCaptions" class="carousel slide">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3" aria-label="Slide 4"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
            <img src="img/perawatan1.jpg" class="d-block w-100" alt="Mengaplikasikan Masker Wajah">
            <div class="carousel-caption d-none d-md-block">
                <h5>First slide label</h5>
                <p>Some representative placeholder content for the first slide.</p>
            </div>
            </div>
            <div class="carousel-item">
            <img src="img/perawatan2.jpg" class="d-block w-100" alt="Manicure">
            <div class="carousel-caption d-none d-md-block">
                <h5>Second slide label</h5>
                <p>Some representative placeholder content for the second slide.</p>
            </div>
            </div>
            <div class="carousel-item">
            <img src="img/perawatan3.jpg" class="d-block w-100" alt="Keramas">
            <div class="carousel-caption d-none d-md-block">
                <h5>Third slide label</h5>
                <p>Some representative placeholder content for the third slide.</p>
            </div>
            </div>
            <div class="carousel-item">
            <img src="img/perawatan4.jpg" class="d-block w-100" alt="Styling Rambut">
            <div class="carousel-caption d-none d-md-block">
                <h5>Fourth slide label</h5>
                <p>Some representative placeholder content for the second slide.</p>
            </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </section>  

    <!-- List Perawatan -->
    <section id="perawatan" class="container my-5">
        <h2 class="text-center mb-4">Daftar Perawatan Klinik Estetika</h2>
        <div class="row row-cols-1 row-cols-md-4 g-4">
            <?php foreach($listPerawatan as $index => $tampil) : ?>
            <div class="col">
                <div class="card h-100">
                    <img src="<?= $tampil[3]; ?>" class="card-img-top" alt="<?= $tampil[0]; ?>">
                    <div class="card-body text-center">
                        <h5 class="card-title"><?= $tampil[0]; ?></h5>
                        <p class="card-text"><?= $tampil[1]; ?></p>
                        <p class="card-text"><strong><?= $tampil[2] ; ?></strong></p>
                        <a href="pesan.php?index=<?= $index ?>" class="btn btn-primary">Pilih Perawatan</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </section>
    
    <!--Footer-->
    <footer class="bg-secondary text-white text-center py-3">
        &copy; 2024 Klinik Estetika. All rights reserved.
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>