<?php
    include "koneksi.php";
    session_start();

    if(!isset($_SESSION["username"])){
        header("Location: login.php");
    }

    if(isset($_GET["editProfile"])){
        $id = $_GET["editProfile"];
        $queryData = mysqli_query($conn, "SELECT * FROM users where username = '$id'");
        $result = mysqli_fetch_assoc($queryData);
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
                <img src="assets/gambar/<?= $data["gambar"] ?>" alt="Foto Profil" class="profile-img">
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

    <div class="card text-center">
        <form action="proses.php" class="container" method="post" enctype="multipart/form-data">
            <img src="assets/gambar/<?= $data["gambar"] ?>" alt="Foto Profil Pengguna" class="profile-img mb-0">
            <label for="uploadGambar" class="upload-label">
                <i class="bi bi-pencil-square upload-icon"></i>
            </label>
            <input type="file" id="uploadGambar" name="gambar" class="d-none" accept="image/*">

            <div class="row mt-3">
                <label class="col-4 col-label" for="nama">Nama</label>
                <div class="col-1 col-separator">:</div>
                <div class="col-7 col-value">
                    <input type="text" name="nama" id="nama" class="form-control" value="<?= $data["nama"] ?>" required>
                </div>
            </div>
            <div class="row">
                <label class="col-4 col-label" for="email">Email</label>
                <div class="col-1 col-separator">:</div>
                <div class="col-7 col-value">
                    <input type="email" name="email" id="email" class="form-control" value="<?= $data["email"] ?>">
                </div>
            </div>
            <div class="row">
                <label class="col-4 col-label" for="telepon">Telepon</label>
                <div class="col-1 col-separator">:</div>
                <div class="col-7 col-value">
                    <input type="text" name="telepon" id="telepon" class="form-control" value="<?= $data["telepon"] ?>">
                </div>
            </div>
            <div class="row">
                <label class="col-4 col-label" for="password">Password</label>
                <div class="col-1 col-separator">:</div>
                <div class="col-7 col-value">
                    <input type="text" name="password" id="password" class="form-control" value="<?= $data["password"] ?>">
                </div>
            </div>
            <input type="hidden" name="username" value="<?= $id; ?>">
            <input type="hidden" name="role" value="<?= $result["role"]; ?>">
            <input type="hidden" name="gambarLama" value="<?= $data["gambar"] ?>">
            <button type="submit" name="submitEditProfil" class="btn btn-success mb-4">Simpan</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>