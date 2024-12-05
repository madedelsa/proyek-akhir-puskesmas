<?php 
    include "koneksi.php";
    session_start();

    if(!isset($_SESSION["username"])){
        header("Location: login.php");
        exit;
    }

    if(isset($_GET['editDataBalita'])){
        $id = $_GET['editDataBalita'];
        $queryData = mysqli_query($conn, "SELECT * FROM catatan_balita where id = '$id'");
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
    <title>Edit Data Balita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/edit_style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Puskesmas Babarsari</a>
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
                <li class="nav-item"><a class="nav-link" href="index.php">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="profil.php">Profil</a></li>
                <li class="nav-item"><a class="nav-link" href="dataBalita.php">Data Kesehatan Balita</a></li>
                <li class="nav-item"><a class="nav-link" href="dataLansia.php">Data Kesehatan Lansia</a></li>
                <li class="nav-item"><a class="nav-link" href="proses.php?logout=true">Keluar</a></li>
            </ul>
        </div>
    </div>

    <div class="form-container">
        <h1 class="text-center">Edit Data Balita</h1>
        <form action="proses.php" method="post">
            <div class="form-group">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" name="nama" id="nama" class="form-control" value="<?= $result["nama"]?>">
            </div>

            <div class="form-group">
                <label for="usia" class="form-label">Usia (Bulan)</label>
                <input type="number" name="usia" id="usia" class="form-control" value="<?= $result["usia"]?>">
            </div>

            <div class="form-group">
                <label for="beratBadan" class="form-label">Berat Badan (Kg)</label>
                <input type="number" name="beratBadan" id="beratBadan" class="form-control" value="<?= $result["berat_badan"]?>">
            </div>

            <div class="form-group">
                <label for="tinggiBadan" class="form-label">Tinggi Badan (Cm)</label>
                <input type="number" name="tinggiBadan" id="tinggiBadan" class="form-control" value="<?= $result["tinggi_badan"]?>">
            </div>

            <div class="form-group">
                <label for="catatan" class="form-label">Catatan</label>
                <textarea name="catatan" id="catatan" class="form-control"><?= $result["catatan"]?></textarea>
            </div>

            <input type="hidden" name="id" value="<?= $id; ?>">
            <input type="hidden" name="username" value="<?= $data["username"]; ?>"> 
            <button type="submit" class="btn btn-success btn-block w-100" name="submitUpdateBalita">
                <i class="bi bi-pencil-square"></i> Update
            </button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>