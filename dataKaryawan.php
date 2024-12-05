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

    $queryData = mysqli_query($conn, "SELECT * FROM users WHERE role != 'admin'");
    $i = 1;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Karyawan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/data_style.css">
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
            <?php if($data["role"] == "admin") : ?>
                <img src="assets/gambar/<?= $data["gambar"] ?>" alt="Foto Profil" class="profile-img">
            <?php else : ?>
                <a href="profil.php">
                    <img src="assets/gambar/<?= $data["gambar"] ?>" alt="Foto Profil" class="profile-img">
                </a>
            <?php endif; ?>
            <h5 class="text-center"><?= $data["nama"] ?></h5>
            <ul class="navbar-nav mt-4">
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

    <div class="container mt-4">
        <h1 class="text-center mb-4">Data Karyawan</h1>

        <?php if(isset($_GET["deleteSuccess"])) : ?>
            <p class="text-success text-center">Berhasil menghapus data</p>
        <?php endif; ?>
        <?php if(isset($_GET["deleteGagal"])) : ?>
            <p class="text-success text-center">Berhasil menghapus data</p>
        <?php endif; ?>
        <?php if(isset($_GET["resetSuccess"])) : ?>
            <p class="text-success text-center">Berhasil mereset data</p>
        <?php endif; ?>
        <?php if(isset($_GET["resetGagal"])) : ?>
            <p class="text-danger text-center">Gagal mereset data</p>
        <?php endif; ?>
        <?php if(isset($_GET["insertKaryawan"])) : ?>
            <p class="text-success text-center">Berhasil menambah data</p>
        <?php endif; ?>


        <div class="d-flex justify-content-end mb-3">
            <a href="tambahDataKaryawan.php" class="btn btn-primary"><i class="bi bi-plus-circle"></i>Tambah Data</a>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-success text-center">
                    <tr>
                        <th>No</th>
                        <th>Gambar</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Email</th>
                        <th>Telepon</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($result = mysqli_fetch_assoc($queryData)) : ?>
                    <tr>
                        <td class="text-center align-middle"><?= $i++ ?></td>
                        <td class="text-center align-middle">
                            <img src="assets/gambar/<?= $result["gambar"] ?>" alt="" class="img-thumbnail" style="max-width: 80px; max-height: 80px;">
                        </td>
                        <td class="text-center align-middle"><?= $result["nama"] ?></td>
                        <td class="text-center align-middle"><?= $result["username"] ?></td>
                        <td class="text-center align-middle"><?= $result["password"] ?></td>
                        <td class="text-center align-middle"><?= $result["email"] ?></td>
                        <td class="text-center align-middle"><?= $result["telepon"] ?></td>
                        <td class="text-center align-middle">
                            <div class="d-flex gap-2 justify-content-center">
                                <a href="proses.php?resetDataKaryawan=<?= $result["username"] ?>" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil-square"></i> Reset
                                </a>
                                <a href="proses.php?deleteDataKaryawan=<?= $result["username"] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                    <i class="bi bi-trash"></i> Hapus
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>