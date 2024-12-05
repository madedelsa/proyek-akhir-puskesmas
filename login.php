<?php
    include "koneksi.php";
    session_start();

    if(isset($_SESSION["username"])){
        header("Location: index.php");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Puskesmas Babarsari</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/login_style.css">
</head>
<body>
    <div class="login-card">
        <h1>Puskesmas Babarsari</h1>

        <?php if(isset($_GET["gagal"])) : ?>
            <p class="text-danger text-center">Username atau password salah!</p>
        <?php endif; ?>
        
        <form action="proses.php" method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Nama Pengguna</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Kata Sandi</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan kata sandi" required>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-success" name="submitLogin">Masuk</button>
            </div>
        </form>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>