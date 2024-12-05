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

    $queryData = mysqli_query($conn, "SELECT * FROM catatan_lansia");
    $i = 1;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kesehatan Lansia</title>
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

    <div class="container mt-4">
        <h1 class="text-center mb-4">Data Kesehatan Lansia</h1>

        <?php if(isset($_GET["deleteSuccess"])) : ?>
            <p class="text-success text-center">Berhasil menghapus data</p>
        <?php endif; ?>
        <?php if(isset($_GET["deleteGagal"])) : ?>
            <p class="text-danger text-center">Gagal menghapus data</p>
        <?php endif; ?>
        <?php if(isset($_GET["editSuccess"])) : ?>
            <p class="text-success text-center">Berhasil mengubah data</p>
        <?php endif; ?>
        <?php if(isset($_GET["insertSuccess"])) : ?>
            <p class="text-success text-center">Berhasil menambah data</p>
        <?php endif; ?>

        <div class="d-flex justify-content-end mb-3">
            <a href="tambahDataLansia.php" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Tambah Data</a>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-success text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Usia</th>
                        <th>Gula Darah</th>
                        <th>TD (Diastolik)</th>
                        <th>TD (Sistolik)</th>
                        <th>Catatan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($result = mysqli_fetch_assoc($queryData)) : ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $result["nama"] ?></td>
                            <td><?= $result["usia"] ?></td>
                            <td><?= $result["gula_darah"] ?></td>
                            <td><?= $result["td_diastolik"] ?></td>
                            <td><?= $result["td_sistolik"] ?></td>
                            <td><?= $result["catatan"] ?></td>
                            <td class="d-flex gap-3 justify-content-center">
                                <a href="editLansia.php?editDataLansia=<?= $result["id"] ?>" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <a href="proses.php?deleteDataLansia=<?= $result["id"] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                    <i class="bi bi-trash"></i> Hapus
                                </a>
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