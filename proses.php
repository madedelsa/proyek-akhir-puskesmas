<?php
    include "koneksi.php";

    // Proses login
    if(isset($_POST["submitLogin"])){
        $username = $_POST["username"];
        $password = $_POST["password"];

        $query = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username' AND password = '$password'");
        if(mysqli_num_rows($query)){
            session_start();
            $data = mysqli_fetch_assoc($query);
            if($data["username"] == "admin"){
                $_SESSION["username"] = $username;
                header("Location: index.php");
                exit;
            } else{
                $_SESSION["username"] = $username;
                header("Location: index.php");
                exit;
            }
        } else{
            header("Location: login.php?gagal=true");
            exit;
        }
    }

    // Proses Log Out
    if(isset($_GET['logout'])) {
        session_start();
        session_unset();
        session_destroy();
        header("Location: login.php?logout=true");
    }

    // Proses tambah Balita
    if(isset($_POST["submitTambahBalita"])){
        $nama = $_POST["nama"];
        $usia = $_POST["usia"];
        $berat_badan = $_POST["beratBadan"];
        $tinggi_badan = $_POST["tinggiBadan"];
        $catatan = $_POST["catatan"];

        $query = mysqli_query($conn, "INSERT INTO catatan_balita(nama, usia, berat_badan, tinggi_badan, catatan)
                    VALUES('$nama', $usia, $berat_badan, $tinggi_badan, '$catatan')");
        if($query){
            header("Location: dataBalita.php?insertBalitaSuccess=true");
            exit;
        }
    }

    //Proses Hapus Data Balita
    if(isset($_GET['deleteDataBalita'])) {
        $id = $_GET['deleteDataBalita'];
        $query = mysqli_query($conn, "DELETE FROM catatan_balita WHERE id = $id");
        if($query) {
            header("Location: dataBalita.php?hapusSukses=true");
        }
    }

    // Proses Edit Data Balita
    if(isset($_POST["submitUpdateBalita"])){
        $id = $_POST["id"];
        $nama = $_POST["nama"];
        $usia = $_POST["usia"];
        $berat_badan = $_POST["beratBadan"];
        $tinggi_badan = $_POST["tinggiBadan"];
        $catatan = $_POST["catatan"];

        $query = mysqli_query($conn, "UPDATE catatan_balita SET nama = '$nama', usia = '$usia', berat_badan = '$berat_badan', 
                    tinggi_badan = '$tinggi_badan', catatan = '$catatan' WHERE id = $id");
        if($query){
            header("Location: dataBalita.php?editSuccess=true");
            exit;
        }
    }

    // Proses Tambah Data Lansia
    if(isset($_POST["submitTambahLansia"])){
        $nama = $_POST["nama"];
        $usia = $_POST["usia"];
        $gula_darah = $_POST["gulaDarah"];
        $td_diastolik = $_POST["diastolik"];
        $td_sistolik = $_POST["sistolik"];
        $catatan = $_POST["catatan"];

        $query = mysqli_query($conn, "INSERT INTO catatan_lansia(nama, usia, gula_darah, td_diastolik, td_sistolik, catatan)
                    VALUES('$nama', $usia, $gula_darah, $td_diastolik, $td_sistolik, '$catatan')");
        if($query){
            header("Location: dataLansia.php?insertSuccess=true");
            exit;
        }
    }

    // Proses Edit Data Lansia
    if(isset($_POST["editDataLansia"])){
        $id = $_POST["id"];
        $nama = $_POST["nama"];
        $usia = $_POST["usia"];
        $gula_darah = $_POST["gulaDarah"];
        $td_diastolik = $_POST["diastolik"];
        $td_sistolik = $_POST["sistolik"];
        $catatan = $_POST["catatan"];

        $query = mysqli_query($conn, "UPDATE catatan_lansia SET nama = '$nama', usia = '$usia', gula_darah = '$gula_darah'
        , td_diastolik = '$td_diastolik', td_sistolik = '$td_sistolik', catatan = '$catatan' WHERE id = '$id'");
        if($query){
            header("Location: dataLansia.php?editSuccess=true");
            exit;
        }
    }

    // Proses Hapus Data Lansia
    if(isset($_GET["deleteDataLansia"])){
        $id = $_GET["deleteDataLansia"];
        $query = mysqli_query($conn, "DELETE FROM catatan_lansia WHERE id = $id");
        if($query){
            header("Location: dataLansia.php?deleteSuccess=true");
        } else{
            header("Location: dataLansia.php?deleteGagal=true");
        }
    }

    // Proses Edit Profil
    if (isset($_POST["submitEditProfil"])) {
        $nama = $_POST["nama"];
        $email = $_POST["email"];
        $telepon = $_POST["telepon"];
        $username = $_POST["username"];
        $password = $_POST["password"];
        $role = $_POST["role"];
        $gambarLama = $_POST["gambarLama"]; // Ambil data gambar lama dari input hidden
    
        // Cek apakah ada file gambar baru yang diunggah
        if (isset($_FILES["gambar"]) && $_FILES["gambar"]["error"] == 0) {
            $targetDir = "assets/gambar/";
            $fileName = pathinfo($_FILES["gambar"]["name"], PATHINFO_FILENAME); // Hanya nama file
            $fileExtension = strtolower(pathinfo($_FILES["gambar"]["name"], PATHINFO_EXTENSION)); // Ekstensi file
            $newFileName = $fileName . "." . $fileExtension; // Gabungkan nama file dan ekstensinya
    
            // Validasi ekstensi file
            $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
            if (in_array($fileExtension, $allowedTypes)) {
                $targetFilePath = $targetDir . $newFileName;
    
                // Pastikan nama file tidak duplikat
                $counter = 1;
                while (file_exists($targetFilePath)) {
                    $newFileName = $fileName . "_" . $counter . "." . $fileExtension;
                    $targetFilePath = $targetDir . $newFileName;
                    $counter++;
                }
    
                // Pindahkan file ke folder tujuan
                if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $targetFilePath)) {
                    $gambar = $newFileName; // Simpan nama file baru
                } else {
                    header("Location: profil.php?uploadFailed=true");
                    exit;
                }
            } else {
                header("Location: profil.php?invalidFileType=true");
                exit;
            }
        } else {
            $gambar = $gambarLama; // Jika tidak ada file baru, gunakan gambar lama
        }
    
        // Update data ke database
        $query = mysqli_query($conn, "UPDATE users SET nama = '$nama', username = '$username', password = '$password', 
            email = '$email', telepon = '$telepon', role = '$role', gambar = '$gambar' WHERE username = '$username'");
    
        if ($query) {
            $_SESSION["username"] = $username;
            header("Location: profil.php?editSuccess=true");
            exit;
        }
    }

    // Hapus Data Karyawan
    if(isset($_GET["deleteDataKaryawan"])){
        $username = $_GET["deleteDataKaryawan"];
        $query = mysqli_query($conn, "DELETE FROM users WHERE username = '$username'");
        if($query){
            header("Location: dataKaryawan.php?deleteSuccess=true");
        } else{
            header("Location: dataKaryawan.php?deleteGagal=true");
        }
    }

    // Proses Reset Data Karyawan
    if(isset($_GET["resetDataKaryawan"])){
        $username = $_GET["resetDataKaryawan"];
        $nama = "Belum Diatur";
        $role = "karyawan";
        $password = "karyawan";
        $gambar = "profile.jpg";
        $email = "Belum Diatur";
        $telepon = "Belum Diatur";

        $query = mysqli_query($conn, "UPDATE users SET nama = '$nama', username = '$username', password = '$password', email = '$email', telepon = '$telepon', role = '$role', gambar = '$gambar' WHERE username = '$username'");

        if($query){
            header("Location: dataKaryawan.php?resetSuccess=true");
            exit;
        }
        else{
            header("Location: dataKaryawan.php?resetGagal=true");
            exit;
        }
    }

    // Proses tambah Karyawan
    if(isset($_POST["submitTambahKaryawan"])){
        $nama = $_POST["nama"];
        $username = $_POST["username"];
        $password = $_POST["password"];
        $email = $_POST["email"];
        $role = $_POST["role"];
        $gambar = $_POST["gambar"];
        $telepon = $_POST["telepon"];

        $query = mysqli_query($conn, "INSERT INTO users(nama, username, password, email, telepon, role, gambar)
         VALUES ('$nama', '$username', '$password', '$email', '$telepon', '$role', '$gambar')");
        if($query){
            header("Location: dataKaryawan.php?insertKaryawan=true");
            exit;
        }
    }
?>