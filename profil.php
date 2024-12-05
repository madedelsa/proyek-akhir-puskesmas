<?php
    include "koneksi.php";
    session_start();

    if (!isset($_SESSION["username"])) {
        header("Location: login.php");
        exit;
    }

    if(isset($_SESSION["username"])){
        $username = $_SESSION["username"];
        $query = mysqli_query($conn, "SELECT * FROM users where username = '$username'");
        $data = mysqli_fetch_assoc($query);
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/profile_style.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="">Puskesmas Babarsari</a>
            <button class="btn btn-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                Menu
            </button>
        </div>
    </nav>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <a href="profil.php">
                <img src="assets/gambar/<?= $data["gambar"]; ?>" alt="Foto Profil" class="profile-img">
            </a>
            <h5 class="text-center"><?= $data["nama"] ?></h5>
            <ul class="navbar-nav mt-4">
                <li class="nav-item"><a class="nav-link active" href="index.php">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="profil.php">Profil</a></li>
                <li class="nav-item"><a class="nav-link" href="dataBalita.php">Data Kesehatan Balita</a></li>
                <li class="nav-item"><a class="nav-link" href="dataLansia.php">Data Kesehatan Lansia</a></li>
                <li class="nav-item"><a class="nav-link" href="proses.php?logout=true">Keluar</a></li>
            </ul>
        </div>
    </div>

    <div class="card">
        <a href="editProfil.php?editProfile=<?= $data["username"]; ?>" class="edit-button" title="Edit Profil">
            <i class="bi bi-pencil"></i>
        </a>
        <img src="assets/gambar/<?= $data["gambar"] ?>" alt="Foto Profil Pengguna" class="card-img-top">
        <div class="card-body text-center">
            <h4 class="card-title mb-4"><?= $data["nama"] ?></h4>
            <div class="container">
                <div class="row">
                    <div class="col-4 col-label">Email</div>
                    <div class="col-1 col-separator">:</div>
                    <div class="col-7 col-value"><?= $data["email"]; ?></div>
                </div>
                <div class="row">
                    <div class="col-4 col-label">Telepon</div>
                    <div class="col-1 col-separator">:</div>
                    <div class="col-7 col-value"><?= $data["telepon"]; ?></div>
                </div>
                <div class="row">
                    <div class="col-4 col-label">Password</div>
                    <div class="col-1 col-separator">:</div>
                    <div class="col-7 col-value"><?= $data["password"]; ?></div>
                </div>
            </div>

            <?php if(isset($_GET["editSuccess"])) : ?>
                <p class="text-success text-center">Berhasil mengubah data</p>
            <?php endif; ?> 
            <?php if(isset($_GET["uploadFailed"])) : ?>
                <p class="text-danger text-center">Gagal mengunggah foto</p>
            <?php endif; ?> 
            <?php if(isset($_GET["invalidFileType"])) : ?>
                <p class="text-danger text-center">Tipe file tidak sesuai</p>
            <?php endif; ?> 

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>