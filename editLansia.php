<?php
    include "koneksi.php";
    session_start();

    if(!isset($_SESSION["username"])){
        header("Location: login.php");
        exit;
    }

    if(isset($_GET['editDataLansia'])){
        $id = $_GET['editDataLansia'];
        $queryData = mysqli_query($conn, "SELECT * FROM catatan_lansia where id = '$id'");
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
    <title>Edit Data Lansia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/edit_style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <div class="navbar-brand">Puskesmas Babarsari</div>
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
            <a href="profil.php">
                <img src="assets/gambar/<?= $data["gambar"] ?>" alt="Foto Profil" class="profile-img">
            </a>
            <h5 style="text-align: center;" class="mb-5"><?= $data["nama"] ?></h5>
            <ul class="navbar-item mt-3">
                <li class="nav-item"><a class="nav-link" href="index.php">Dasboard</a></li>
                <li class="nav-item"><a class="nav-link" href="profil.php">Profil</a></li>
                <li class="nav-item"><a class="nav-link" href="dataBalita.php">Data Kesehatan Balita</a></li>
                <li class="nav-item"><a class="nav-link" href="dataLansia.php">Data Kesehatan Lansia</a></li>
                <li class="nav-item"><a class="nav-link" href="proses.php?logout=true">Keluar</a></li>
            </ul>
        </div>
    </div>

    <div class="form-container mt-5">
        <h1 class="text-center mb-4" style="color: #198754;">Ubah Data Lansia</h1>
        <form action="proses.php" method="post">
            <div class="form-group mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" name="nama" id="nama" class="form-control" value="<?= $result["nama"]?>" required>
            </div>
            <div class="form-group mb-3">
                <label for="usia" class="form-label">Usia</label>
                <input type="number" name="usia" id="usia" class="form-control" value="<?= $result["usia"]?>"  required>
            </div>
            <div class="form-group mb-3">
                <label for="gulaDarah" class="form-label">Gula Darah</label>
                <input type="number" name="gulaDarah" id="gulaDarah" class="form-control" value="<?= $result["gula_darah"]?>"  required>
            </div>
            <div class="form-group mb-3">
                <label for="diastolik" class="form-label">Tekanan Darah Diastolik</label>
                <input type="number" name="diastolik" id="diastolik" class="form-control" value="<?= $result["td_diastolik"]?>"  required>
            </div>
            <div class="form-group mb-3">
                <label for="sistolik" class="form-label">Tekanan Darah Sistolik</label>
                <input type="number" name="sistolik" id="distolik" class="form-control" value="<?= $result["td_sistolik"]?>"  required>
            </div>
            <div class="form-group mb-3">
                <label for="catatan" class="form-label">Catatan</label>
                <textarea name="catatan" id="catatan" class="form-control"><?= $result["catatan"]?></textarea>
            </div>
            <input type="hidden" name="id" value="<?= $id ?>">
            <input type="hidden" name="username" value="<?= $data["username"]; ?>">
            <button type="submit" class="btn btn-success btn-block w-100" name="editDataLansia">
                <i class="bi bi-pencil-square"></i> Update
            </button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>