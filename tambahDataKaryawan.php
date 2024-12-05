<?php
    include "koneksi.php";
    session_start();

    if(!isset($_SESSION["username"])){
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
    <title>Tambah Data Karyawan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg" style="background-color: #198754;">
        <div class="container-fluid">
            <div class="navbar-brand text-white">Puskesmas Babarsari</div>
            <button class="btn btn-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                Menu
            </button>
        </div>
    </nav>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header">
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <?php if($data["role"] == "admin") : ?>
                <img src="assets/gambar/<?= $data["gambar"] ?>" alt="Foto Profil" class="profile-img">
            <?php else : ?>
                <a href="profil.php">
                    <img src="assets/gambar/<?= $data["gambar"] ?>" alt="Foto Profil" class="profile-img">
                </a>
            <?php endif; ?>
            <h5 class="text-center mb-5"><?= $data["nama"] ?></h5>
            <ul class="navbar-nav">
                <?php if($data["role"] == "admin") : ?>
                    <li class="nav-item"><a class="nav-link" href="dataKaryawan.php">Data Karyawan</a></li>
                <?php else : ?>
                    <li class="nav-item"><a class="nav-link active" href="index.php">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="profil.php">Profil</a></li>
                    <li class="nav-item"><a class="nav-link" href="dataBalita.php">Data Kesehatan Balita</a></li>
                    <li class="nav-item"><a class="nav-link" href="dataLansia.php">Data Kesehatan Lansia</a></li>
                <?php endif; ?>
                <li class="nav-item"><a class="nav-link" href="proses.php?logout=true">Keluar</a></li>
            </ul>
        </div>
    </div>

    <div class="container mt-5">
        <h1 class="text-center mb-4" style="color: #198754;">Tambah Data Karyawan</h1>
        <form action="proses.php" method="post">
            <div class="form-group mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" name="nama" id="nama" class="form-control" required>
            </div>
            <div class="form-group mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" id="username" class="form-control" required>
            </div>
            <div class="form-group mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="text" name="password" id="password" class="form-control" required>
            </div>
            <div class="form-group mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" name="email" id="email" class="form-control" required>
            </div>
            <div class="form-group mb-3">
                <label for="role" class="form-label">Role(admin/karyawan)</label>
                <input type="text" name="role" id="role" class="form-control" required>
            </div>
            <div class="form-group mb-3">
                <label for="telepon" class="form-label">Telepon</label>
                <input type="text" name="telepon" id="telepon" class="form-control" required>
            </div>
            <input type="hidden" name="gambar" value="profile.jpg">
            <button type="submit" class="btn btn-success w-100" name="submitTambahKaryawan">Tambah</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>